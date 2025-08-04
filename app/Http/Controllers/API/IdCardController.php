<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\IdCard;
use App\Models\School;
use App\Models\Invoice;
use App\Models\Client;
use App\Mail\InvoiceMail;
use App\Mail\ReceiptMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class IdCardController extends Controller
{
    /**
     * Display a listing of ID cards.
     */
    public function index()
    {
        $idCards = IdCard::with('school')->latest()->paginate(10);
        
        return response()->json($idCards);
    }

    /**
     * Store a newly created ID card order.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_number' => 'required|string|unique:id_cards,order_number',
            'card_type' => 'required|in:student,staff,visitor',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'order_date' => 'required|date',
            'delivery_date' => 'nullable|date|after_or_equal:order_date',
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['total_amount'] = $data['quantity'] * $data['unit_price'];

        $idCard = IdCard::create($data);

        // Update associated school's student count
        $this->updateSchoolStudentCount($idCard->customer_name);

        return response()->json([
            'message' => 'ID Card order created successfully',
            'idcard' => $idCard
        ], 201);
    }

    /**
     * Display the specified ID card order.
     */
    public function show(IdCard $idcard)
    {
        $idcard->load('school', 'invoices');

        return response()->json($idcard);
    }

    /**
     * Update the specified ID card order.
     */
    public function update(Request $request, IdCard $idcard)
    {
        $validator = Validator::make($request->all(), [
            'order_number' => 'required|string|unique:id_cards,order_number,' . $idcard->id,
            'card_type' => 'required|in:student,staff,visitor',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'order_date' => 'required|date',
            'delivery_date' => 'nullable|date|after_or_equal:order_date',
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['total_amount'] = $data['quantity'] * $data['unit_price'];

        $idcard->update($data);

        return response()->json([
            'message' => 'ID Card order updated successfully',
            'idcard' => $idcard
        ]);
    }

    /**
     * Remove the specified ID card order.
     */
    public function destroy(IdCard $idcard)
    {
        $idcard->delete();
        
        return response()->json([
            'message' => 'ID Card order deleted successfully'
        ]);
    }

    /**
     * Search ID card orders.
     */
    public function search(Request $request)
    {
        $term = $request->get('term', '');
        
        $idCards = IdCard::where('order_number', 'LIKE', "%{$term}%")
            ->orWhere('customer_name', 'LIKE', "%{$term}%")
            ->orWhere('customer_email', 'LIKE', "%{$term}%")
            ->orWhere('card_type', 'LIKE', "%{$term}%")
            ->with('school')
            ->latest()
            ->paginate(10);

        return response()->json($idCards);
    }

    /**
     * Get associated school for ID card order.
     */
    public function getSchool(IdCard $idcard)
    {
        // Try to find school by customer name
        $school = School::where('name', 'LIKE', "%{$idcard->customer_name}%")
            ->orWhere('email', $idcard->customer_email)
            ->first();

        if ($school) {
            return response()->json([
                'school' => $school->load('client'),
                'suggested' => true
            ]);
        }

        return response()->json([
            'school' => null,
            'suggested' => false,
            'message' => 'No matching school found'
        ]);
    }

    /**
     * Create invoice for ID card order.
     */
    public function createInvoice(Request $request, IdCard $idcard)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'nullable|exists:clients,id',
            'school_id' => 'nullable|exists:schools,id',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $client = null;

        // If school_id is provided, use school's client
        if ($request->school_id) {
            $school = School::find($request->school_id);
            if ($school && $school->client) {
                $client = $school->client;
            }
        }
        
        // If client_id is provided, use that client
        if ($request->client_id) {
            $client = Client::find($request->client_id);
        }

        // If no client found, create one from ID card customer info
        if (!$client) {
            $client = Client::create([
                'name' => $idcard->customer_name,
                'email' => $idcard->customer_email,
                'phone' => $idcard->customer_phone,
                'status' => 1,
            ]);
        }

        // Create invoice
        $invoice = Invoice::create([
            'invoice_no' => 'IDC-' . str_pad(Invoice::count() + 1, 6, '0', STR_PAD_LEFT),
            'slug' => 'idc-' . uniqid(),
            'client_id' => $client->id,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'sub_total' => $idcard->total_amount,
            'total_tax' => 0,
            'discount' => 0,
            'transport' => 0,
            'calculated_total' => $idcard->total_amount,
            'due_amount' => $idcard->total_amount,
            'note' => $request->description ?? "ID Card Order: {$idcard->order_number} - {$idcard->quantity} {$idcard->card_type} cards",
            'status' => 1,
            'created_by' => auth()->id(),
        ]);

        // Update ID card status if it was pending
        if ($idcard->status === 'pending') {
            $idcard->update(['status' => 'processing']);
        }

        return response()->json([
            'message' => 'Invoice created successfully for ID card order',
            'invoice' => $invoice->load('client'),
            'idcard' => $idcard
        ], 201);
    }

    /**
     * Send invoice email for ID card order.
     */
    public function sendInvoice(Request $request, $invoiceId)
    {
        try {
            $invoice = Invoice::with('client')->findOrFail($invoiceId);
            $email = $request->email;
            
            if (!$email) {
                return response()->json(['message' => 'Email address is required'], 400);
            }
            
            Mail::to($email)->send(new InvoiceMail($invoice));
            
            return response()->json([
                'message' => 'Invoice sent successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to send invoice',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Send payment receipt email for ID card order.
     */
    public function sendReceipt(Request $request, $invoiceId)
    {
        try {
            $invoice = Invoice::with('client')->findOrFail($invoiceId);
            $email = $request->email;
            
            if (!$email) {
                return response()->json(['message' => 'Email address is required'], 400);
            }
            
            Mail::to($email)->send(new ReceiptMail($invoice));
            
            return response()->json([
                'message' => 'Receipt sent successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to send receipt',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update school student and staff counts based on ID card quantities.
     */
    private function updateSchoolStudentCount($schoolName)
    {
        $school = School::where('name', 'LIKE', "%{$schoolName}%")->first();
        if ($school) {
            $calculatedStudentCount = $school->calculateStudentCount();
            $calculatedStaffCount = $school->calculateStaffCount();
            
            $school->update([
                'student_count' => $calculatedStudentCount,
                'staff_count' => $calculatedStaffCount
            ]);
        }
    }
}
