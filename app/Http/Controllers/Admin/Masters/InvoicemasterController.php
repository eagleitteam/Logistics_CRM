<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreInvoicemasterRequest;
use App\Http\Requests\Admin\Masters\UpdateInvoicemasterRequest;
use App\Models\Yearmaster;
use App\Models\Clientmaster;
use App\Models\Gstmaster;
use App\Models\Invoicemaster;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Models\TripMovement;

class InvoicemasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $yearmasters = Yearmaster::latest()->get();

        $clientmasters = Clientmaster::latest()->get();

        $gstmasters = Gstmaster::latest()->get();

        $invoicemasters = Invoicemaster::latest()->get();

        return view('admin.masters.invoice-master')->with(['yearmasters' => $yearmasters, 'clientmasters' => $clientmasters, 'gstmasters' => $gstmasters, 'invoicemasters' => $invoicemasters]);
    }

    public function getTrips(Request $request)
{
    $clientId = $request->client_id;
    $month = $request->month; // e.g. 08

    $trips = TripMovement::query()
        ->when($clientId, function ($q) use ($clientId) {
            $q->where('client_id', $clientId);
        })
        ->when($month, function ($q) use ($month) {
            $q->whereMonth('trip_date', $month);
        })
        ->whereNull('invoice_status')
        ->get();

    $options = $trips->map(function ($trip) {
        return [
            'id' => $trip->id,
            'text' => $trip->origin . ' - ' . $trip->destination . ' (' . $trip->trip_date . ')',
        ];
    });

    return response()->json($options);
}

public function getFilteredTrips(Request $request)
{
    $clientId = $request->client_id;
    $month = $request->month; // 01, 02, ...
    $tripIds = $request->trips ?? [];

    $query = TripMovement::query();

    if ($clientId) {
        $query->where('client_id', $clientId);
    }

    if ($month) {
        $query->whereMonth('trip_date', $month);
    }

    if (!empty($tripIds)) {
        $query->whereIn('id', $tripIds);
    }

    $trips = $query->with('VehicalNumber')->get();

    return response()->json($trips);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(StoreInvoicemasterRequest $request)
    {
        DB::beginTransaction();
        try {
            $invoice = Invoicemaster::create($request->only([
                'inv_no', 'inv_date', 'client_id', 'year_id', 'template_id',
                'net_amount', 'gst_id', 'gst_amount', 'index_id', 'total_amount',
                'bank_id', 'terms_conditions',
                'po_number', 'sac_no', 'termdays', 'transaction_nature',
                'supply_nature', 'invoice_period', 'billed_from', 'billed_from_address'
            ]));

            // attach trips if you have pivot table
            if ($request->has('trip_ids')) {
                // Example: $invoice->trips()->sync($request->trip_ids);
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Invoice saved successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Invoicemaster $invoicemasters, Request $request)
{

    $invoicemasters = Invoicemaster::find($request->model_id);
    if ($invoicemasters) {
        return response()->json([
            'result' => 1,
            'invoicemasters' => $invoicemasters,
        ]);
    } else {
        return response()->json([
            'result' => 0,
            'message' => 'Invoice master not found',
        ]);
    }

}

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateInvoicemasterRequest $request, Invoicemaster $invoicemasters)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            $invoicemasters = Invoicemaster::find($request->edit_model_id);
            $invoicemasters->update(Arr::only($input, $invoicemasters->getFillable()));
            DB::commit();

            return response()->json(['success' => 'Invoice master updated successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'updating', 'Invoice master');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoicemaster $invoicemasters, Request $request)
    {
         $invoicemasters = Invoicemaster::find($request->model_id);

        try {
            DB::beginTransaction();
            $invoicemasters->delete();
            DB::commit();
            return response()->json(['success' => 'Invoice master deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'Invoice master');
        }
    }
}
