<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreMasterGroupRequest;
use App\Http\Requests\Admin\Masters\UpdateMasterGroupRequest;
use App\Models\MasterGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class MasterGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $masterGroups = MasterGroup::latest()->get();

        return view('admin.masters.master-group')->with(['masterGroups' => $masterGroups]);
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
    public function store(StoreMasterGroupRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
           MasterGroup::create(Arr::only($input, (new MasterGroup())->getFillable()));
            DB::commit();

            return response()->json(['success' => 'master group created successfully!']);
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
   public function edit(MasterGroup $MasterGroup, Request $request)
{

   return response()->json([
        'result'      => 1,
        'MasterGroup' => $MasterGroup,
    ]);
}

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateMasterGroupRequest $request, MasterGroup $MasterGroup)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            $MasterGroup = MasterGroup::find($request->edit_model_id);
            $MasterGroup->update(Arr::only($input, $MasterGroup->getFillable()));
            DB::commit();

            return response()->json(['success' => 'Master Group updated successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'updating', 'Vehicle');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterGroup $MasterGroup, Request $request)
    {
        try {
            DB::beginTransaction();
            $MasterGroup->delete();
            DB::commit();
            return response()->json(['success' => 'master group deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'MasterGroup');
        }
    }
}