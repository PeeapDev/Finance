<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Invoice;
use App\Models\Client;
use App\Mail\InvoiceMail;
use App\Mail\ReceiptMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class SchoolController extends Controller
{
    /**
     * Display a listing of schools.
     */
    public function index()
    {
        $schools = School::with(['invoices' => function($query) {
            $query->latest()->take(5);
        }])->latest()->paginate(10);
        
        // Update student and staff counts for each school based on ID card quantities
        foreach ($schools as $school) {
            $calculatedStudentCount = $school->calculateStudentCount();
            $calculatedStaffCount = $school->calculateStaffCount();
            
            $updateData = [];
            if ($school->student_count != $calculatedStudentCount) {
                $updateData['student_count'] = $calculatedStudentCount;
            }
            if ($school->staff_count != $calculatedStaffCount) {
                $updateData['staff_count'] = $calculatedStaffCount;
            }
            
            if (!empty($updateData)) {
                $school->update($updateData);
            }
        }
        
        return response()->json($schools);
    }

    /**
     * Store a newly created school.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'contact_person' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string',
                'student_count' => 'nullable|integer|min:0',
                'staff_count' => 'nullable|integer|min:0',
                'yearly_fee' => 'nullable|numeric|min:0',
                'subscription_type' => 'nullable|in:basic,premium,enterprise',
                'subscription_start_date' => 'nullable|date',
                'subscription_end_date' => 'nullable|date|after:subscription_start_date',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $schoolData = $request->all();
            $schoolData['status'] = 1; // Set default status to active
            
            // Handle logo upload
            if ($request->hasFile('logo')) {
                $logoFile = $request->file('logo');
                $logoName = time() . '_' . $logoFile->getClientOriginalName();
                $logoPath = $logoFile->storeAs('school_logos', $logoName, 'public');
                $schoolData['logo_path'] = $logoPath;
            }
            
            // Remove logo from schoolData as it's not a database field
            unset($schoolData['logo']);
            
            $school = School::create($schoolData);
            
            // Create corresponding client for invoicing
            $clientId = 'CLI-' . str_pad(Client::count() + 1, 3, '0', STR_PAD_LEFT);
            $client = Client::create([
                'name' => $school->name,
                'client_id' => $clientId,
                'email' => $school->email,
                'phone' => $school->phone,
                'address' => $school->address,
                'status' => 1,
            ]);
            
            $school->client_id = $client->id;
            $school->save();

            return response()->json([
                'message' => 'School created successfully',
                'school' => $school->load('client')
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create school',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified school with invoices.
     */
    public function show(School $school)
    {
        $school->load([
            'client',
            'invoices' => function($query) {
                $query->with(['invoicePayments', 'client'])->latest();
            }
        ]);

        // Get invoice statistics
        $totalInvoices = $school->invoices->count();
        $paidInvoices = $school->invoices->where('status', 1)->where('due_amount', 0)->count();
        $pendingInvoices = $school->invoices->where('status', 1)->where('due_amount', '>', 0)->count();
        $totalAmount = $school->invoices->sum('sub_total');
        $paidAmount = $school->invoices->sum(function($invoice) {
            return $invoice->sub_total - $invoice->due_amount;
        });

        return response()->json([
            'school' => $school,
            'statistics' => [
                'total_invoices' => $totalInvoices,
                'paid_invoices' => $paidInvoices,
                'pending_invoices' => $pendingInvoices,
                'total_amount' => $totalAmount,
                'paid_amount' => $paidAmount,
                'due_amount' => $totalAmount - $paidAmount,
            ]
        ]);
    }

    /**
     * Update the specified school.
     */
    public function update(Request $request, School $school)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'student_count' => 'nullable|integer|min:0',
            'yearly_fee' => 'nullable|numeric|min:0',
            'subscription_type' => 'nullable|in:basic,premium,enterprise',
            'subscription_start_date' => 'nullable|date',
            'subscription_end_date' => 'nullable|date|after:subscription_start_date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $school->update($request->all());
        
        // Update corresponding client
        if ($school->client) {
            $school->client->update([
                'name' => $school->name,
                'email' => $school->email,
                'phone' => $school->phone,
                'address' => $school->address,
            ]);
        }

        return response()->json([
            'message' => 'School updated successfully',
            'school' => $school->load('client')
        ]);
    }

    /**
     * Remove the specified school.
     */
    public function destroy(School $school)
    {
        $school->delete();
        
        return response()->json([
            'message' => 'School deleted successfully'
        ]);
    }

    /**
     * Search schools.
     */
    public function search(Request $request)
    {
        $term = $request->get('term', '');
        
        $schools = School::where('name', 'LIKE', "%{$term}%")
            ->orWhere('email', 'LIKE', "%{$term}%")
            ->orWhere('phone', 'LIKE', "%{$term}%")
            ->with('client')
            ->latest()
            ->paginate(10);

        return response()->json($schools);
    }

    /**
     * Get school invoices.
     */
    public function getInvoices(School $school)
    {
        $invoices = $school->invoices()
            ->with(['invoicePayments', 'client'])
            ->latest()
            ->paginate(10);

        return response()->json($invoices);
    }

    /**
     * Create invoice for school.
     */
    public function createInvoice(Request $request, School $school)
    {
        $validator = Validator::make($request->all(), [
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'sub_total' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'items' => 'required|array',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Ensure school has a client
        if (!$school->client) {
            $client = Client::create([
                'name' => $school->name,
                'email' => $school->email,
                'phone' => $school->phone,
                'address' => $school->address,
                'status' => 1,
            ]);
            
            $school->client_id = $client->id;
            $school->save();
        }

        // Create invoice
        $invoice = Invoice::create([
            'invoice_no' => 'SCH-' . str_pad(Invoice::count() + 1, 6, '0', STR_PAD_LEFT),
            'slug' => 'sch-' . uniqid(),
            'client_id' => $school->client->id,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'sub_total' => $request->sub_total,
            'total_tax' => 0,
            'discount' => 0,
            'transport' => 0,
            'calculated_total' => $request->sub_total,
            'due_amount' => $request->sub_total,
            'note' => $request->description ?? 'School subscription invoice',
            'status' => 1,
            'created_by' => auth()->id(),
        ]);

        return response()->json([
            'message' => 'Invoice created successfully',
            'invoice' => $invoice->load('client')
        ], 201);
    }

    /**
     * Send invoice email to school.
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
     * Send payment receipt email.
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
}
