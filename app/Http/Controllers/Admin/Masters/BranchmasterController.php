<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreBranchmasterRequest;
use App\Http\Requests\Admin\Masters\UpdateBranchmasterRequest;
use App\Models\Branchmaster;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class BranchmasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $branchmasters = Branchmaster::latest()->get();

        return view('admin.masters.branch-master')->with(['branchmasters' => $branchmasters]);
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
    public function store(StoreBranchmasterRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            Branchmaster::create(Arr::only($input, (new Branchmaster())->getFillable()));
            DB::commit();

            return response()->json(['success' => 'branch master created successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'creating', 'Branchmaster');
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
   public function edit(Branchmaster $branchmaster, Request $request)
{

    $branchmaster = Branchmaster::find($request->model_id);
    if ($branchmaster) {
        return response()->json([
            'result' => 1,
            'branchmaster' => $branchmaster,
        ]);
    } else {
        return response()->json([
            'result' => 0,
            'message' => 'Branchmaster not found',
        ]);
    }

}

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateBranchmasterRequest $request, Branchmaster $branchmaster)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            $branchmaster = Branchmaster::find($request->edit_model_id);
            $branchmaster->update(Arr::only($input, $branchmaster->getFillable()));
            DB::commit();

            return response()->json(['success' => 'Branchmaster updated successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'updating', 'Branchmaster');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branchmaster $branchmaster, Request $request)
    {
         $branchmaster = Branchmaster::find($request->model_id);

        try {
            DB::beginTransaction();
            $branchmaster->delete();
            DB::commit();
            return response()->json(['success' => 'Branchmaster deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'Branchmaster');
        }
    }
}
