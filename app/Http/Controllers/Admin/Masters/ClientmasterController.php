<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreClientmasterRequest;
use App\Http\Requests\Admin\Masters\UpdateClientmasterRequest;
use App\Models\Clientmaster;
use App\Models\Statemaster;
use App\Models\Yearmaster;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Models\MasterGroupCategory;
use App\Models\MasterGroup;
use App\Models\SubGroupMaster;


class ClientmasterController extends Controller
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

        $clientmasters = Clientmaster::where('deleted_at','=',null)->get();

        return view('admin.masters.client-master')->with(['clientmasters'=>$clientmasters, 'statemasters' => $statemasters, 'yearmasters' => $yearmasters,'masterGroups' =>$masterGroups,'MasterGroupCategory'=>$MasterGroupCategory,'SubGroupMaster'=>$SubGroupMaster]);
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
    public function store(StoreClientmasterRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
           Clientmaster::create(Arr::only($input, (new Clientmaster())->getFillable()));
            DB::commit();

            return response()->json(['success' => 'client created successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'creating', 'Client');
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
   public function edit(Clientmaster $clientmaster, Request $request)
{

   $clientmaster = Clientmaster::find($request->model_id);
    if ($clientmaster) {
        return response()->json([
            'result' => 1,
            'clientmasters' => $clientmaster,
        ]);
    } else {
        return response()->json([
            'result' => 0,
            'message' => 'Clientmaster not found',
        ]);
    }
}


    /**
     * Update the specified resource in storage.
     */
public function update(UpdateClientmasterRequest $request, Clientmaster $clientmaster)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            $clientmaster = Clientmaster::find($request->edit_model_id);
            $clientmaster->update(Arr::only($input, $clientmaster->getFillable()));
            DB::commit();

            return response()->json(['success' => 'Client updated successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'updating', 'Client');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clientmaster $clientmaster, Request $request)
    {
        try {
            DB::beginTransaction();
            $clientmaster->delete();
            DB::commit();
            return response()->json(['success' => 'Client Master deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'Client Master');
        }
    }
}
