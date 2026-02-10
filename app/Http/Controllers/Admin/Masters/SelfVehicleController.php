<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreSelfVehicleRequest;
use App\Http\Requests\Admin\Masters\UpdateVehicleRequest;
use App\Models\SelfVehicle;
use App\Models\VehicleTypeMaster;
use App\Models\SelfVehicleDOcument;
use App\Models\Vendormaster;
use App\Models\VehicleDocumentDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class SelfVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $SelfVehicle = SelfVehicle::latest()->get();
        $vehicalTypes = VehicleTypeMaster::where('deleted_at','=',null)->get();
        $Vendormaster = Vendormaster::where('deleted_at','=',null)->get();
        $SelfVehicleDOcument = SelfVehicleDOcument::get();

        return view('admin.masters.self-vehicle')->with(['Vendormaster' => $Vendormaster, 'SelfVehicle' => $SelfVehicle,'vehicalTypes' => $vehicalTypes, 'SelfVehicleDOcument' => $SelfVehicleDOcument]);
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
    public function store(StoreSelfVehicleRequest $request)
    {
        try {
            DB::beginTransaction();

            $input = $request->validated();

            // ✅ Create vehicle
            $vehicle = SelfVehicle::create(
                Arr::only($input, (new SelfVehicle())->getFillable())
            );

            if ($request->has('documents')) {
            foreach ($request->documents as $docData) {
                if (!empty($docData['start_date']) || !empty($docData['end_date']) || !empty($docData['file'])) {

                $filePath = null;
                if (isset($docData['file']) && $docData['file'] instanceof \Illuminate\Http\UploadedFile) {
                    $filePath = 'vehicle_documents/' . time() . '_' . $docData['file']->getClientOriginalName();
                    $docData['file']->move(public_path('vehicle_documents'), $filePath);
                }

                VehicleDocumentDetails::create([
                    'vehicle_number' => $vehicle->vehicle_number,
                    'type'           => $vehicle->type,
                    'tab_id'         => $docData['tab_id'] ?? null,
                    'start_date'     => $docData['start_date'] ?? null,
                    'end_date'       => $docData['end_date'] ?? null,
                    'company_name'   => $docData['company_name'] ?? null,
                    'file'           => $filePath,
                    'created_by'     => auth()->id(),
                ]);
            }
        }
    }


        DB::commit();

        return response()->json(['success' => 'Vehicle created successfully!']);
    } catch (\Exception $e) {
        DB::rollBack();
        return $this->respondWithAjax($e, 'creating', 'Vehicle');
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
  public function edit(SelfVehicle $selfVehicle)
{
    $selfVehicle->load('vehicleType');

    return response()->json([
        'result'      => 1,
        'Selfvehicle' => $selfVehicle,
    ]);
}





    /**
     * Update the specified resource in storage.
     */
public function update(UpdateVehicleRequest $request, SelfVehicle $vehicle)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            $vehicle = SelfVehicle::find($request->edit_model_id);
            $vehicle->update(Arr::only($input, SelfVehicle::getFillables()));
            DB::commit();

            return response()->json(['success' => 'Ward updated successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'updating', 'Vehicle');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SelfVehicle $vehicle, Request $request)
    {
                    $vehicle = SelfVehicle::find($request->model_id);

        try {
            DB::beginTransaction();
            $vehicle->delete();
            DB::commit();
            return response()->json(['success' => 'vehicle deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'vehicle');
        }
    }
}