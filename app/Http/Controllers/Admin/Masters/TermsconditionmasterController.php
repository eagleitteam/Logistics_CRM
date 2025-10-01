<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreTermsconditionmasterRequest;
use App\Http\Requests\Admin\Masters\UpdateTermsconditionmasterRequest;
use App\Models\Termsconditionmaster;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TermsconditionmasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $termsconditionmasters = Termsconditionmaster::latest()->get();

        return view('admin.masters.terms-condition-master')->with(['termsconditionmasters' => $termsconditionmasters]);
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
    public function store(StoreTermsconditionmasterRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            Termsconditionmaster::create(Arr::only($input, (new Termsconditionmaster())->getFillable()));
            DB::commit();

            return response()->json(['success' => 'terms condition master created successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'creating', 'Termsconditionmaster');
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
   public function edit(Termsconditionmaster $termsconditionmaster, Request $request)
{

    $termsconditionmaster = Termsconditionmaster::find($request->model_id);
    if ($termsconditionmaster) {
        return response()->json([
            'result' => 1,
            'termsconditionmaster' => $termsconditionmaster,
        ]);
    } else {
        return response()->json([
            'result' => 0,
            'message' => 'Termsconditionmaster not found',
        ]);
    }

}

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateTermsconditionmasterRequest $request, Termsconditionmaster $termsconditionmaster)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            $termsconditionmaster = Termsconditionmaster::find($request->edit_model_id);
            $termsconditionmaster->update(Arr::only($input, $termsconditionmaster->getFillable()));
            DB::commit();

            return response()->json(['success' => 'Termsconditionmaster updated successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'updating', 'Termsconditionmaster');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Termsconditionmaster $termsconditionmaster, Request $request)
    {
         $termsconditionmaster = Termsconditionmaster::find($request->model_id);

        try {
            DB::beginTransaction();
            $termsconditionmaster->delete();
            DB::commit();
            return response()->json(['success' => 'Termsconditionmaster deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'Termsconditionmaster');
        }
    }
}
