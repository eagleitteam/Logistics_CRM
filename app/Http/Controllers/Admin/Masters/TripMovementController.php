<?php

namespace App\Http\Controllers\Admin\Masters;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreTripMovementRequest;
use App\Http\Requests\Admin\Masters\UpdateDrivermasterRequest;
use App\Models\TripMovement;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\Drivermaster;
use App\Models\Clientmaster;
use App\Models\VehicleTypeMaster;
use App\Models\SelfVehicle;
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

        return view('admin.masters.trip-movement')->with(['VehicleNo'=>$VehicleNo, 'Drivermaster' => $Drivermaster, 'VehicleTypeMaster' => $VehicleTypeMaster,'Clientmaster' =>$Clientmaster]);

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

            // ✅ This works because StoreTripMovementRequest extends FormRequest
            $input = $request->validated();

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
    public function show(TripMoment $tripMoment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TripMoment $tripMoment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TripMoment $tripMoment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TripMoment $tripMoment)
    {
        //
    }
}
