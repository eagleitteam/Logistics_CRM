<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreGstmasterRequest;
use App\Http\Requests\Admin\Masters\UpdateGstmasterRequest;
use App\Models\Gstmaster;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class GstmasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gstmasters = Gstmaster::latest()->get();

        return view('admin.masters.gstrate-master')->with(['gstmasters' => $gstmasters]);
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
    public function store(StoreGstmasterRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            Gstmaster::create(Arr::only($input, (new Gstmaster())->getFillable()));
            DB::commit();

            return response()->json(['success' => 'GST master created successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'creating', 'Gstmaster');
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
   public function edit(Gstmaster $gstmaster, Request $request)
{

    $gstmaster = Gstmaster::find($request->model_id);
    if ($gstmaster) {
        return response()->json([
            'result' => 1,
            'gstmasters' => $gstmaster,
        ]);
    } else {
        return response()->json([
            'result' => 0,
            'message' => 'GST master not found',
        ]);
    }

}

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateGstmasterRequest $request, Gstmaster $gstmaster)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            $gstmaster = Gstmaster::find($request->edit_model_id);
            $gstmaster->update(Arr::only($input, $gstmaster->getFillable()));
            DB::commit();

            return response()->json(['success' => 'GST master updated successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'updating', 'Gstmaster');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gstmaster $gstmaster, Request $request)
    {
         $gstmaster = Gstmaster::find($request->model_id);

        try {
            DB::beginTransaction();
            $gstmaster->delete();
            DB::commit();
            return response()->json(['success' => 'GST master deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'GST master');
        }
    }
}
