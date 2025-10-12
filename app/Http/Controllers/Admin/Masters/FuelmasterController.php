<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreFuelmasterRequest;
use App\Http\Requests\Admin\Masters\UpdateFuelmasterRequest;
use App\Models\Fuelmaster;
use App\Models\SelfVehicle;
use App\Models\Drivermaster;
use App\Models\Yearmaster;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class FuelmasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivermasters = Drivermaster::latest()->get();

        $fuelmasters = Fuelmaster::latest()->get();

        $SelfVehicle = SelfVehicle::latest()->get();

        return view('admin.masters.fuel-master')->with(['fuelmasters' => $fuelmasters, 'drivermasters' => $drivermasters,
        'SelfVehicle'=> $SelfVehicle ]); 
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
    public function store(StoreFuelmasterRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            Fuelmaster::create(Arr::only($input, (new Fuelmaster())->getFillable()));
            DB::commit();

            return response()->json(['success' => 'Fuelmaster created successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'creating', 'Fuelmaster');
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
   public function edit(Fuelmaster $fuelmaster, Request $request)
{

    $fuelmaster = Fuelmaster::find($request->model_id);
    if ($fuelmaster) {
        return response()->json([
            'result' => 1,
            'fuelmaster' => $fuelmaster,
        ]);
    } else {
        return response()->json([
            'result' => 0,
            'message' => 'Fuelmaster not found',
        ]);
    }

}

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateFuelmasterRequest $request, Fuelmaster $fuelmaster)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            $fuelmaster = Fuelmaster::find($request->edit_model_id);
            $fuelmaster->update(Arr::only($input, $fuelmaster->getFillable()));
            DB::commit();

            return response()->json(['success' => 'Fuelmaster updated successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'updating', 'Fuelmaster');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fuelmaster $fuelmaster, Request $request)
    {
         $fuelmaster = Fuelmaster::find($request->model_id);

        try {
            DB::beginTransaction();
            $fuelmaster->delete();
            DB::commit();
            return response()->json(['success' => 'Fuelmaster deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'Fuelmaster');
        }
    }
}
