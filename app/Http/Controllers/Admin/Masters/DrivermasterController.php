<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreDrivermasterRequest;
use App\Http\Requests\Admin\Masters\UpdateDrivermasterRequest;
use App\Models\Drivermaster;
use App\Models\Statemaster;
use App\Models\Yearmaster;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Models\MasterGroupCategory;
use App\Models\MasterGroup;
use App\Models\SubGroupMaster;

class DrivermasterController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statemasters = Statemaster::latest()->get();

        $yearmasters = Yearmaster::latest()->get();

        $masterGroups = MasterGroup::latest()->get();

        $MasterGroupCategory = MasterGroupCategory::latest()->get();

        $SubGroupMaster = SubGroupMaster::latest()->get();

        $drivermasters = Drivermaster::where('deleted_at','=',null)->get();

        return view('admin.masters.driver-master')->with(['drivermaster'=>$drivermasters, 'statemasters' => $statemasters, 'yearmasters' => $yearmasters,'masterGroups' =>$masterGroups,'MasterGroupCategory'=>$MasterGroupCategory,'SubGroupMaster'=>$SubGroupMaster]);
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
    public function store(StoreDriverMasterRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            DriverMaster::create(Arr::only($input, (new DriverMaster())->getFillable()));
            DB::commit();

            return response()->json(['success' => 'driver created successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'creating', 'Driver');
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
   public function edit(DriverMaster $drivermaster, Request $request)
{
    
   return response()->json([
        'result' => 1,
        'DriverMaster' => $drivermaster,
    ]);
}


    /**
     * Update the specified resource in storage.
     */
public function update(UpdateDriverMasterRequest $request, DriverMaster $drivermaster)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            $drivermaster = DriverMaster::find($request->edit_model_id);
            $drivermaster->update(Arr::only($input, $drivermaster->getFillable()));
            DB::commit();

            return response()->json(['success' => 'Driver updated successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'updating', 'Driver');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DriverMaster $drivermaster, Request $request)
    {
        try {
            DB::beginTransaction();
            $drivermaster->delete();
            DB::commit();
            return response()->json(['success' => 'Driver Master deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'Driver Master');
        }
    }
}
