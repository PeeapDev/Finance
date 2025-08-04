<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\VatRate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\VatRateResource;

class VatRateController extends Controller
{
    // define middleware
    public function __construct()
    {
        $this->middleware('can:vat-rate-management', ['except' => ['allVatRates']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return VatRateResource::collection(VatRate::latest()->paginate($request->perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate request
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:vat_rates',
            'code' => 'required|string|max:50|unique:vat_rates,code',
            'rate' => 'required|numeric|max:90',
            'note' => 'nullable|string|max:255',
            'isGroupTax' => 'boolean',
            'groupTaxItem' => 'required_if:isGroupTax,true|array',
        ]);

        if ($request->isGroupTax) {
            $groupTaxIds = collect($request->groupTaxItem)->pluck('id')->toArray();
            $totalRate = VatRate::whereIn('id', $groupTaxIds)->sum('rate');

            // Create the group tax rate
            $vatRate =  VatRate::create([
                'name' => $request->name,
                'code' => $request->code,
                'rate' => $totalRate,
                'note' => $request->note,
                'status' => $request->status,
                'is_group_tax' => true,
                'group_tax_ids' => $groupTaxIds,
            ]);
        } else {
            // Create a normal VAT rate
            $vatRate =  VatRate::create([
                'name' => $request->name,
                'code' => $request->code,
                'rate' => $request->rate,
                'note' => $request->note,
                'status' => $request->status,
                'is_group_tax' => false,
                'group_tax_ids' => null,
            ]);
        }

        // add activity log
        activity()
            ->causedBy(Auth::user())
            ->performedOn($vatRate)
            ->withProperties([
                'name' => "",
                'code' => '[' . $request->name . ']',
                'event' => 'Create'
            ])
            ->useLog('VAT Rate Created')
            ->log('VAT Rate Created');

        return $this->responseWithSuccess('VAT rate added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try {
            $vatRate = VatRate::where('slug', $slug)->first();

            return new VatRateResource($vatRate);
        } catch (Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $vatRate = VatRate::where('slug', $slug)->first();
        // validate request
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:vat_rates,name,' . $vatRate->id,
            'code' => 'required|string|max:50|unique:currencies,code,' . $vatRate->id,
            'rate' => 'required|numeric|max:90',
            'note' => 'nullable|string|max:255',
            'isGroupTax' => 'boolean',
            'groupTaxItem' => 'required_if:isGroupTax,true|array',
        ]);

        try {
            if ($request->isGroupTax) {
                $groupTaxIds = collect($request->groupTaxItem)->pluck('id')->toArray();
                $totalRate = VatRate::whereIn('id', $groupTaxIds)->sum('rate');

                // Create the group tax rate
                $vatRate->update([
                    'name' => $request->name,
                    'code' => $request->code,
                    'rate' => $totalRate,
                    'note' => $request->note,
                    'status' => $request->status,
                    'is_group_tax' => true,
                    'group_tax_ids' => $groupTaxIds,
                ]);
            } else {
                // Create a normal VAT rate
                $vatRate->update([
                    'name' => $request->name,
                    'code' => $request->code,
                    'rate' => $request->rate,
                    'note' => $request->note,
                    'status' => $request->status,
                ]);
            }

            // add activity log
            activity()
                ->causedBy(Auth::user())
                ->performedOn($vatRate)
                ->withProperties([
                    'name' => "",
                    'code' => '[' . $request->name . ']',
                    'event' => 'Update'
                ])
                ->useLog('Vat Rate Updated')
                ->log('Vat Rate Updated');

            return $this->responseWithSuccess('Vat Rate updated successfully');
        } catch (Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        try {
            $vatRate = VatRate::where('slug', $slug)->first();

            // add activity log
            activity()
                ->causedBy(Auth::user())
                ->performedOn($vatRate)
                ->withProperties([
                    'name' => "",
                    'code' => '[' . $vatRate->name . ']',
                    'event' => 'Delete'
                ])
                ->useLog('VAT Rate Deleted')
                ->log('VAT Rate Deleted');

            $vatRate->delete();

            return $this->responseWithSuccess('VAT rate deleted successfully');
        } catch (Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    /**
     * search resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $term = $request->term;

        $query = VatRate::where('name', 'LIKE', '%' . $term . '%')
            ->orWhere('code', 'LIKE', '%' . $term . '%')
            ->orWhere('rate', 'LIKE', '%' . $term . '%')
            ->latest()->paginate($request->perPage);

        return VatRateResource::collection($query);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allVatRates()
    {
        $vatRates = VatRate::where('status', 1)->latest()->get();

        return VatRateResource::collection($vatRates);
    }
}
