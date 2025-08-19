<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreSubGroupMasterRequest;
use App\Http\Requests\Admin\Masters\UpdateSubGroupMasterRequest;
use App\Models\MasterGroupCategory;
use App\Models\MasterGroup;
use App\Models\SubGroupMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class SubGroupMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $MasterGroup = MasterGroup::where('deleted_at','=',null)->get();
        $MasterGroupCategory = MasterGroupCategory::latest()->get();
        $SubGroupMaster = SubGroupMaster::latest()->get();

        return view('admin.masters.sub-group-master')->with(['MasterGroup' => $MasterGroup, 'MasterGroupCategory'=>$MasterGroupCategory,'SubGroupMaster'=>$SubGroupMaster]);
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
    public function store(StoreSubGroupMasterRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            SubGroupMaster::create(Arr::only($input, (new SubGroupMaster())->getFillable()));
            DB::commit();

            return response()->json(['success' => 'sub group master created successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'creating', 'Ward');
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
  public function edit(SubGroupMaster $sub_group_master)
{
    // Load relationships
    $sub_group_master->load(['MasterGroup', 'MasterGroupCategory']);

    return response()->json([
        'result' => 1,
        'SubGroupMaster' => $sub_group_master,
    ]);
}



    /**
     * Update the specified resource in storage.
     */
public function update(UpdateSubGroupMasterRequest $request, SubGroupMaster $sub_group_master)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            $sub_group_master = SubGroupMaster::find($request->edit_model_id);
            $sub_group_master->update(Arr::only($input, $sub_group_master->getFillable()));
            DB::commit();

            return response()->json(['success' => 'Sub Group Master updated successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'updating', 'sub_group_master');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubGroupMaster $sub_group_master, Request $request)
    {
        try {
            DB::beginTransaction();
            $sub_group_master->delete();
            DB::commit();
            return response()->json(['success' => 'sub group master deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'sub_group_master');
        }
    }

    public function getMasterGroupCategories(Request $request)
{
    $categories = MasterGroupCategory::where('master_group_id', $request->master_group_id)->get();

    return response()->json(['categories' => $categories]);
}
}