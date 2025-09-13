<?php

namespace App\Http\Controllers\Admin\Masters;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreTripMovementRequest;
use App\Http\Requests\Admin\Masters\UpdateTripMovementRequest;
use App\Models\TripMovement;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\Drivermaster;
use App\Models\Clientmaster;
use App\Models\VehicleTypeMaster;
use App\Models\SelfVehicle;
use App\Models\TripExpDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

class TripMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $VehicleNo = SelfVehicle::where('deleted_at','=',null)->get();

        $Drivermaster = Drivermaster::where('status','=','1')->where('deleted_at','=',null)->get();

        $VehicleTypeMaster = VehicleTypeMaster::where('deleted_at','=',null)->get();

        $Clientmaster = Clientmaster::where('deleted_at','=',null)->get();

        $TripMovement = TripMovement::where('deleted_at','=',null)->get();

        return view('admin.masters.trip-movement')->with(['TripMovement'=>$TripMovement, 'VehicleNo'=>$VehicleNo, 'Drivermaster' => $Drivermaster, 'VehicleTypeMaster' => $VehicleTypeMaster,'Clientmaster' =>$Clientmaster]);

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

    public function store(StoreTripMovementRequest $request)
{
    try {
        DB::beginTransaction();

        $input = $request->validated();

        // 🔍 Find vehicle from Vehicle or SelfVehicle table
        $Selfvehicle = SelfVehicle::find($input['vehicle_no']); 

        if ($Selfvehicle) {
            // If found in self-vehicles, mark as self
            $input['vehicle_type_category'] = 1;
            $input['vendor_id'] = null;
        } else {
            $input['vehicle_type_category'] = 2;
            $input['vendor_id'] = $Selfvehicle->vendor_name ?? null;
        }

        // ✅ Always get the last number (including soft deleted)
        $lastTrip = TripMovement::withTrashed()->orderBy('id', 'desc')->first();

        if ($lastTrip && $lastTrip->unique_no) {
            $lastNo = intval($lastTrip->unique_no);
            $newNo = str_pad($lastNo + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNo = '001';
        }

        $input['unique_no'] = $newNo;

        TripMovement::create(
            Arr::only($input, (new TripMovement())->getFillable())
        );

        DB::commit();

        return response()->json(['success' => 'Trip movement created successfully!']);
    } catch (\Exception $e) {
        DB::rollBack();
        return $this->respondWithAjax($e, 'creating', 'Trip Movement');
    }
}



    

    /**
     * Display the specified resource.
     */
    public function show(TripMovement $tripMoment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(TripMovement $trip_movement, Request $request)
{
    $expDetail = \App\Models\TripExpDetail::where('trip_id', $trip_movement->id)->first();

        return response()->json([
            'result' => 1,
            'trip_movement' => $trip_movement,
            'exp_detail' => $expDetail
        ]);
    
}

    /**
     * Update the specified resource in storage.
     */
   public function update(UpdateTripMovementRequest $request, TripMovement $trip_movement)
{
    try {
        DB::beginTransaction();

        $input = $request->validated();

        // ✅ Vehicle check → self or vendor
        $selfVehicle = SelfVehicle::find($input['vehicle_no']);
        if ($selfVehicle) {
            $input['vehicle_type_category'] = 1; // self-owned
            $input['vendor_id'] = null;
        } else {
            $input['vehicle_type_category'] = 2; // vendor
            $input['vendor_id'] = $selfVehicle?->vendor_name;
        }

        // ✅ Handle POD No
        $input['pod_no'] = $request->pod_no ?? $trip_movement->pod_no;

        // ✅ Handle POD Document Upload
        if ($request->hasFile('pod_document')) {
            if ($trip_movement->pod_document && Storage::disk('public')->exists($trip_movement->pod_document)) {
                Storage::disk('public')->delete($trip_movement->pod_document);
            }

            $file = $request->file('pod_document');
            $filename = $trip_movement->unique_no . "_" . date('Ymd') . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('PodDocument', $filename, 'public');

            $input['pod_document'] = $path;
            $input['pod_status']   = 1;
        }

        // ✅ Update TripMovement
        $trip_movement->update(Arr::only($input, (new TripMovement())->getFillable()));

        // ✅ Update Trip Expense ONLY if record already exists
        if ($request->hasAny([
            'toll_charges',
            'loading_unloading_charges',
            'handing_charges',
            'holding_charges',
            'holding_days',
            'other_exp',
            'total_exp'
        ])) {
            $expDetail = TripExpDetail::where('trip_id', $trip_movement->id)->first();

            if ($expDetail) {
                $expDetail->update(
                    Arr::only($input, (new TripExpDetail())->getFillable())
                );
            }
            // else → do nothing (don’t create new record)
        }

        DB::commit();
        return response()->json(['success' => 'Trip Movement, POD & Expense details updated successfully!']);
    } catch (\Exception $e) {
        DB::rollBack();
        return $this->respondWithAjax($e, 'updating', 'Trip Movement');
    }
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TripMovement $trip_movement, Request $request)
    {

        try {
            DB::beginTransaction();
            $trip_movement->delete();
            DB::commit();
            return response()->json(['success' => 'Trip Movement deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'trip_movement');
        }
    }
}
