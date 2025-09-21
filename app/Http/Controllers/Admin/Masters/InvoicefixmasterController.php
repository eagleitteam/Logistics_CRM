<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreInvoicefixmasterRequest;
use App\Http\Requests\Admin\Masters\UpdateInvoicefixmasterRequest;
use App\Models\Fixvehicleclients;
use App\Models\Fixvehicles;
use App\Models\Clientmaster;
use App\Models\VehicleTypeMaster;
use App\Models\SelfVehicle;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class InvoicefixmasterController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $fixvehicleclients = Fixvehicleclients::with('client')->withCount('Fixvehicles')->latest()->get();

        return view('admin.masters.fixed-vehicle-list')->with(['fixvehicleclients' => $fixvehicleclients]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
        $VehicleNo = SelfVehicle::where('deleted_at','=',null)->get();

        $VehicleTypeMaster = VehicleTypeMaster::where('deleted_at','=',null)->get();

        $clientmasters = Clientmaster::latest()->get();
        return view('admin.masters.fixed-vehicle-create')->with(['clientmasters' => $clientmasters, 'VehicleNo'=>$VehicleNo, 'VehicleTypeMaster' => $VehicleTypeMaster, 'readonly' => false]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(StoreInvoicefixmasterRequest $request)
    {
        try {
            DB::beginTransaction();

            $input = $request->validated();

            // Step 1: Create fixvehicleclients entry
            $fixClient = Fixvehicleclients::create([
                'clientmaster_id'  => $input['clientmaster_id'],
                'start_date' => $input['start_date'],
                'end_date'   => $input['end_date'],
                'contract_title' => $input['contract_title'],
            ]);

            // Step 2: Get parallel arrays
            $self_vehicle_id = $input['self_vehicle_id'];
            $vehicalTypes   = $input['vehical_type'];
            $fixedKms       = $input['fixed_km'];
            $fixedPrices    = $input['fixed_price'];
            $extraKmRates   = $input['extra_km_rate'];

            // Step 3: Loop through arrays and insert row by row
            for ($i = 0; $i < count($self_vehicle_id); $i++) {
                Fixvehicles::create([
                    'fixvehicleclients_id' => $fixClient->id,
                    'clientmaster_id'      => $fixClient->clientmaster_id,
                    'self_vehicle_id'      => $self_vehicle_id[$i],
                    'vehical_type'         => $vehicalTypes[$i],
                    'fixed_km'             => $fixedKms[$i],
                    'fixed_price'          => $fixedPrices[$i],
                    'extra_km_rate'        => $extraKmRates[$i],
                ]);
            }

            DB::commit();

            return response()->json(['success' => 'Invoice Fix Master created successfully!']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Error creating Invoice Fix Master: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $fixvehicleclient = Fixvehicleclients::with('Fixvehicles')->where('id',$id)->first();

        if ($fixvehicleclient) {
            $VehicleNo = SelfVehicle::whereNull('deleted_at')->get();
            $VehicleTypeMaster = VehicleTypeMaster::whereNull('deleted_at')->get();
            $clientmasters = Clientmaster::latest()->get();
            //  dd($fixvehicleclient->toArray());
            return view('admin.masters.fixed-vehicle-create')->with([
                'clientmasters'      => $clientmasters,
                'VehicleNo'          => $VehicleNo,
                'VehicleTypeMaster'  => $VehicleTypeMaster,
                'fixvehicleclient'  => $fixvehicleclient,
                'readonly' => true,
            ]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fixvehicleclients $fixvehicleclients, Request $request)
    {
         $fixvehicleclients = Fixvehicleclients::find($request->model_id);

        try {
            DB::beginTransaction();

            // Step 1: Delete related fixvehicles
            Fixvehicles::where('fixvehicleclients_id', $fixvehicleclients->id)->delete();

            // Step 2: Delete parent record
            $fixvehicleclients->delete();
            
            DB::commit();
            return response()->json(['success' => 'Invoice Fix Master deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'Invoice Fix Master');
        }
    }
}
