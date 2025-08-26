<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreDepartmentmasterRequest;
use App\Http\Requests\Admin\Masters\UpdateDepartmentmasterRequest;
use App\Models\Departmentmaster;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DepartmentmasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

         $departmentmasters = Departmentmaster::latest()->get();

        return view('admin.masters.department-master')->with(['departmentmasters' => $departmentmasters]);
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
    public function store(StoreDepartmentmasterRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            Departmentmaster::create(Arr::only($input, (new Departmentmaster())->getFillable()));
            DB::commit();

            return response()->json(['success' => 'Department master created successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'creating', 'Departmentmaster');
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
   public function edit(Departmentmaster $departmentmaster, Request $request)
{

    $departmentmaster = Departmentmaster::find($request->model_id);
    if ($departmentmaster) {
        return response()->json([
            'result' => 1,
            'departmentmaster' => $departmentmaster,
        ]);
    } else {
        return response()->json([
            'result' => 0,
            'message' => 'Departmentmaster not found',
        ]);
    }

}

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateDepartmentmasterRequest $request, Departmentmaster $departmentmaster)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            $departmentmaster = Departmentmaster::find($request->edit_model_id);
            $departmentmaster->update(Arr::only($input, $departmentmaster->getFillable()));
            DB::commit();

            return response()->json(['success' => 'Departmentmaster updated successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'updating', 'Departmentmaster');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departmentmaster $departmentmaster, Request $request)
    {
         $departmentmaster = Departmentmaster::find($request->model_id);

        try {
            DB::beginTransaction();
            $departmentmaster->delete();
            DB::commit();
            return response()->json(['success' => 'Departmentmaster deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'Departmentmaster');
        }
    }
}
