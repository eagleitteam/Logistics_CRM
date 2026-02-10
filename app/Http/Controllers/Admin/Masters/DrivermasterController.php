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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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

        // Upload Aadhar Card
        if ($request->hasFile('aadhar_card_path')) {
            $file = $request->file('aadhar_card_path');
            $filename = 'aadhar_' . date('Ymd') . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('adharCard', $filename, 'public');
            $input['aadhar_card_path'] = $path;
        }

        // Upload PAN Card
        if ($request->hasFile('pan_card_path')) {
            $file = $request->file('pan_card_path');
            $filename = 'pan_' . date('Ymd') . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('panCard', $filename, 'public');
            $input['pan_card_path'] = $path;
        }

        // Upload Driving License
        if ($request->hasFile('driving_license_path')) {
            $file = $request->file('driving_license_path');
            $filename = 'license_' . date('Ymd') . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('drivingLicense', $filename, 'public');
            $input['driving_license_path'] = $path;
        }

        Drivermaster::create(Arr::only($input, (new Drivermaster())->getFillable()));

        DB::commit();

        return response()->json(['success' => 'Driver created successfully!']);

    } catch (\Exception $e) {
        DB::rollBack();
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
   public function edit(DriverMaster $driver_master, Request $request)
{
    
   return response()->json([
        'result' => 1,
        'DriverMaster' => $driver_master,
    ]);
}


    /**
     * Update the specified resource in storage.
     */
public function update(UpdateDrivermasterRequest $request)
{
    try {
        DB::beginTransaction();

        $input = $request->validated();

        // Find driver record
        $drivermaster = Drivermaster::findOrFail($request->edit_model_id);

        // Replace Aadhar Card if new file uploaded
        if ($request->hasFile('aadhar_card_path')) {
            if ($drivermaster->aadhar_card_path && Storage::disk('public')->exists($drivermaster->aadhar_card_path)) {
                Storage::disk('public')->delete($drivermaster->aadhar_card_path);
            }

            $file = $request->file('aadhar_card_path');
            $filename = 'aadhar_' . date('Ymd') . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('adharCard', $filename, 'public');
            $input['aadhar_card_path'] = $path;
        }

        // Replace PAN Card if new file uploaded
        if ($request->hasFile('pan_card_path')) {
            if ($drivermaster->pan_card_path && Storage::disk('public')->exists($drivermaster->pan_card_path)) {
                Storage::disk('public')->delete($drivermaster->pan_card_path);
            }

            $file = $request->file('pan_card_path');
            $filename = 'pan_' . date('Ymd') . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('panCard', $filename, 'public');
            $input['pan_card_path'] = $path;
        }

        // Replace Driving License if new file uploaded
        if ($request->hasFile('driving_license_path')) {
            if ($drivermaster->driving_license_path && Storage::disk('public')->exists($drivermaster->driving_license_path)) {
                Storage::disk('public')->delete($drivermaster->driving_license_path);
            }

            $file = $request->file('driving_license_path');
            $filename = 'license_' . date('Ymd') . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('drivingLicense', $filename, 'public');
            $input['driving_license_path'] = $path;
        }

        // Finally update driver record
        $drivermaster->update(Arr::only($input, $drivermaster->getFillable()));

        DB::commit();

        return response()->json(['success' => 'Driver updated successfully!']);
    } catch (\Exception $e) {
        DB::rollBack();
        return $this->respondWithAjax($e, 'updating', 'Driver');
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DriverMaster $driver_master, Request $request)
    {
        try {
            DB::beginTransaction();
            $driver_master->delete();
            DB::commit();
            return response()->json(['success' => 'Driver Master deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'Driver Master');
        }
    }
}
