<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreInvoicemasterRequest;
use App\Http\Requests\Admin\Masters\UpdateInvoicemasterRequest;
use App\Models\Yearmaster;
use App\Models\Clientmaster;
use App\Models\Gstmaster;
use App\Models\Invoicemaster;
use App\Models\Invoiceadhoctripdata;
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

        // 01 ते 12 format मध्ये months बनवतो
        $months = [];
        for ($m = 1; $m <= 12; $m++) {
            $months[] = str_pad($m, 2, '0', STR_PAD_LEFT);
        }

        return view('admin.masters.invoice-master')->with(['yearmasters' => $yearmasters, 'clientmasters' => $clientmasters, 'gstmasters' => $gstmasters, 'invoicemasters' => $invoicemasters, 'months' => $months]);
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
            'text' => '(' . $trip->trip_date . ') '. $trip->origin . ' - '. $trip->destination ,
            'unique_no' => $trip->unique_no,
            'vehical_number' => $trip->VehicalNumber ? $trip->VehicalNumber->vehicle_number : '',
            'pod_number' => $trip->pod_number,
            'pod_status' => $trip->pod_status,
            'rate' => $trip->rate ?? 0,
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
     * 
     */
            public function store(StoreInvoicemasterRequest $request)
        {
            try {
                DB::beginTransaction();

                $input = $request->validated();

                // Step 1: Create Invoicemaster entry (array मधला TripsList वगळून)
                $invoiceMaster = Invoicemaster::create([
                    'inv_no'          => $input['inv_no'],
                    'inv_date'        => $input['inv_date'],
                    'client_id'       => $input['client_id'],
                    'year_id'         => $input['year_id'],
                    'month'           => $input['month'] ?? null,
                    'termdays'        => $input['termdays'] ?? null,
                    'invoicePeriod'   => $input['invoicePeriod'] ?? null,
                    'billedTo'        => $input['billedTo'] ?? null,
                    'billedToAddress' => $input['billedToAddress'] ?? null,
                    'gstno'           => $input['gstno'] ?? null,
                    'invoiceType'     => $input['invoiceType'] ?? null,
                    'poNumber'        => $input['poNumber'] ?? null,
                ]);

                // Step 2 + Step 3: Loop through TripsList and handle both tables
                    if (!empty($input['TripsList'])) {
                        foreach ($input['TripsList'] as $tripData) {
                            [$tripId, $uniqueNo] = explode('|', $tripData);

                            // Insert in Invoiceadhoctripdata
                            Invoiceadhoctripdata::create([
                                'invoice_master_id' => $invoiceMaster->id,
                                'clientmaster_id'   => $input['client_id'],
                                'trip_movement_id'  => $tripId,
                                'unique_no'         => $uniqueNo,
                            ]);

                            // Update TripMovement
                            TripMovement::where('id', $tripId)->update([
                                'invocie_no'     => $input['inv_no'],   // spelling fix
                                'invoice_status' => 1,
                            ]);
                        }
                    }

                // dd([
                //     'invoice_master_id' => $invoiceMaster->id,
                //     'clientmaster_id'   => $invoiceMaster->client_id,
                //     'trip_movement_id'  => $tripId,
                //     'unique_no'         => $uniqueNo,
                // ]);



                DB::commit();

                return response()->json(['success' => 'Invoice created successfully!']);

            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'error' => 'Error creating Invoice: ' . $e->getMessage()
                ], 500);
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