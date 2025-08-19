<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreVendormasterRequest;
use App\Http\Requests\Admin\Masters\UpdateVendormasterRequest;
use App\Models\Vendormaster;
use App\Models\Statemaster;
use App\Models\Yearmaster;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Models\MasterGroupCategory;
use App\Models\MasterGroup;
use App\Models\SubGroupMaster;

class VendormasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendormasters = Vendormaster::latest()->get();
        $masterGroups = MasterGroup::latest()->get();
        $MasterGroupCategory = MasterGroupCategory::latest()->get();
        $SubGroupMaster = SubGroupMaster::latest()->get();

        return view('admin.masters.vendor-master-tableList')->with(['vendormasters' => $vendormasters,'masterGroups' =>$masterGroups,'MasterGroupCategory'=>$MasterGroupCategory,'SubGroupMaster'=>$SubGroupMaster]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statemasters = Statemaster::latest()->get();

        $yearmasters = Yearmaster::latest()->get();

        $vendormasters = Vendormaster::latest()->get();

        $masterGroups = MasterGroup::latest()->get();
        $MasterGroupCategory = MasterGroupCategory::latest()->get();
        $SubGroupMaster = SubGroupMaster::latest()->get();

        return view('admin.masters.vendor-master-addPage')->with(['vendormasters' => $vendormasters, 'statemasters' => $statemasters, 'yearmasters' => $yearmasters,'masterGroups' =>$masterGroups,'MasterGroupCategory'=>$MasterGroupCategory,'SubGroupMaster'=>$SubGroupMaster]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVendormasterRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            Vendormaster::create(Arr::only($input, (new Vendormaster())->getFillable()));
            DB::commit();

            return response()->json(['success' => 'vendor master created successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'creating', 'Vendormaster');
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
   public function edit(Vendormaster $vendormaster, Request $request)
{

    $vendormaster = Vendormaster::find($request->model_id);
    if ($vendormaster) {
        return response()->json([
            'result' => 1,
            'vendormasters' => $vendormaster,
        ]);
    } else {
        return response()->json([
            'result' => 0,
            'message' => 'Vendormaster not found',
        ]);
    }

}

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateVendormasterRequest $request, Vendormaster $vendormaster)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            $vendormaster = Vendormaster::find($request->edit_model_id);
            $vendormaster->update(Arr::only($input, $vendormaster->getFillable()));
            DB::commit();

            return response()->json(['success' => 'Vendormaster updated successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'updating', 'Vendormaster');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendormaster $vendormaster, Request $request)
    {
         $vendormaster = Vendormaster::find($request->model_id);

        try {
            DB::beginTransaction();
            $vendormaster->delete();
            DB::commit();
            return response()->json(['success' => 'Vendormaster deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'Vendormaster');
        }
    }
}
