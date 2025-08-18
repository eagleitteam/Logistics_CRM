<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreYearmasterRequest;
use App\Http\Requests\Admin\Masters\UpdateYearmasterRequest;
use App\Models\Yearmaster;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class YearmasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $yearmasters = Yearmaster::latest()->get();

        return view('admin.masters.year-master')->with(['yearmasters' => $yearmasters]);
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
    public function store(StoreYearmasterRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            Yearmaster::create(Arr::only($input, (new Yearmaster())->getFillable()));
            DB::commit();

            return response()->json(['success' => 'year master created successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'creating', 'Yearmaster');
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
   public function edit(Yearmaster $yearmaster, Request $request)
{

    $yearmaster = Yearmaster::find($request->model_id);
    if ($yearmaster) {
        return response()->json([
            'result' => 1,
            'yearmasters' => $yearmaster,
        ]);
    } else {
        return response()->json([
            'result' => 0,
            'message' => 'Yearmaster not found',
        ]);
    }

}

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateYearmasterRequest $request, Yearmaster $yearmaster)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            $yearmaster = Yearmaster::find($request->edit_model_id);
            $yearmaster->update(Arr::only($input, $yearmaster->getFillable()));
            DB::commit();

            return response()->json(['success' => 'Yearmaster updated successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'updating', 'Yearmaster');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Yearmaster $yearmaster, Request $request)
    {
         $yearmaster = Yearmaster::find($request->model_id);

        try {
            DB::beginTransaction();
            $yearmaster->delete();
            DB::commit();
            return response()->json(['success' => 'Yearmaster deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'Yearmaster');
        }
    }
}
