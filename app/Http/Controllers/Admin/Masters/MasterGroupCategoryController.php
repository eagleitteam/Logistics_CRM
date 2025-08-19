<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreMasterGroupCategoryRequest;
use App\Http\Requests\Admin\Masters\UpdateMasterGroupCategoryRequest;
use App\Models\MasterGroupCategory;
use App\Models\MasterGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class MasterGroupCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $GroupsMasterCategory = MasterGroupCategory::latest()->get();
        $MasterGroup = MasterGroup::where('deleted_at','=',null)->get();

        return view('admin.masters.master-group-category')->with(['GroupsMasterCategory' => $GroupsMasterCategory, 'MasterGroup'=>$MasterGroup]);
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
    public function store(StoreMasterGroupCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
           MasterGroupCategory::create(Arr::only($input, (new MasterGroupCategory())->getFillable()));
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
   public function edit(MasterGroupCategory $group_master_category, Request $request)
{
    
   return response()->json([
        'result' => 1,
        'MasterGroupCategory' => $group_master_category,
    ]);
}


    /**
     * Update the specified resource in storage.
     */
public function update(UpdateMasterGroupCategoryRequest $request, MasterGroupCategory $group_master_category)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            $group_master_category = MasterGroupCategory::find($request->edit_model_id);
            $group_master_category->update(Arr::only($input, $group_master_category->getFillable()));
            DB::commit();

            return response()->json(['success' => 'Master Group Category updated successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'updating', 'Vehicle');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterGroupCategory $group_master_category, Request $request)
    {
        try {
            DB::beginTransaction();
            $group_master_category->delete();
            DB::commit();
            return response()->json(['success' => 'master group category deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'group_master_category');
        }
    }
}