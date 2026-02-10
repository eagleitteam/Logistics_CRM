<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreStatemasterRequest;
use App\Http\Requests\Admin\Masters\UpdateStatemasterRequest;
use App\Models\Statemaster;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class StatemasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statemasters = Statemaster::latest()->get();

        return view('admin.masters.state-master')->with(['statemasters' => $statemasters]);
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
    public function store(StoreStatemasterRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            Statemaster::create(Arr::only($input, (new Statemaster())->getFillable()));
            DB::commit();

            return response()->json(['success' => 'state master created successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'creating', 'Statemaster');
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
   public function edit(Statemaster $statemaster, Request $request)
{

    $statemaster = Statemaster::find($request->model_id);
    if ($statemaster) {
        return response()->json([
            'result' => 1,
            'statemasters' => $statemaster,
        ]);
    } else {
        return response()->json([
            'result' => 0,
            'message' => 'Statemaster not found',
        ]);
    }

}

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateStatemasterRequest $request, Statemaster $statemaster)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            $statemaster = Statemaster::find($request->edit_model_id);
            $statemaster->update(Arr::only($input, $statemaster->getFillable()));
            DB::commit();

            return response()->json(['success' => 'Statemaster updated successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'updating', 'Statemaster');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Statemaster $statemaster, Request $request)
    {
         $statemaster = Statemaster::find($request->model_id);

        try {
            DB::beginTransaction();
            $statemaster->delete();
            DB::commit();
            return response()->json(['success' => 'Statemaster deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'Statemaster');
        }
    }
}
