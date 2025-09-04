<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreCompanybillingmasterRequest;
use App\Http\Requests\Admin\Masters\UpdateCompanybillingmasterRequest;
use App\Models\Companybillingmaster;
use App\Models\Statemaster;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CompanybillingmasterrController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statemasters = Statemaster::latest()->get();

        $companybillingmasters = Companybillingmaster::latest()->get();

        return view('admin.masters.company-billing-master')->with(['companybillingmasters' => $companybillingmasters, 'statemasters' => $statemasters]);
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
    // public function store(StoreCompanybillingmasterRequest $request)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $input = $request->validated();
    //         Companybillingmaster::create(Arr::only($input, (new Companybillingmaster())->getFillable()));
    //         DB::commit();

    //         return response()->json(['success' => 'Company billing master created successfully!']);
    //     } catch (\Exception $e) {
    //         return $this->respondWithAjax($e, 'creating', 'Companybillingmaster');
    //     }
    // }
                public function store(StoreCompanybillingmasterRequest $request)
        {
            try {
                DB::beginTransaction();

                $input = $request->validated();

                $companyBilling = Companybillingmaster::create(
                    Arr::only($input, (new Companybillingmaster())->getFillable())
                );

                $uploadPath = public_path('uploads/company_documents');

                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                // Company Logo
                if ($request->hasFile('company_logo')) {
                    $extension = $request->file('company_logo')->getClientOriginalExtension();
                    $fileName = 'logo.' . $extension;
                    $request->file('company_logo')->move($uploadPath, $fileName);

                    $companyBilling->company_logo = 'uploads/company_documents/' . $fileName;
                }

                // Company Seal
                if ($request->hasFile('company_seal')) {
                    $extension = $request->file('company_seal')->getClientOriginalExtension();
                    $fileName = 'seal.' . $extension;
                    $request->file('company_seal')->move($uploadPath, $fileName);

                    $companyBilling->company_seal = 'uploads/company_documents/' . $fileName;
                }

                // Company Signature
                if ($request->hasFile('company_signature')) {
                    $extension = $request->file('company_signature')->getClientOriginalExtension();
                    $fileName = 'signature.' . $extension;
                    $request->file('company_signature')->move($uploadPath, $fileName);

                    $companyBilling->authorised_signature = 'uploads/company_documents/' . $fileName;
                }

                $companyBilling->save();

                DB::commit();

                return response()->json(['success' => 'Company billing master created successfully!']);
            } catch (\Exception $e) {
                DB::rollBack();
                return $this->respondWithAjax($e, 'creating', 'Companybillingmaster');
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
   public function edit(Companybillingmaster $companybillingmaster, Request $request)
{

    $companybillingmaster = Companybillingmaster::find($request->model_id);
    if ($companybillingmaster) {
        return response()->json([
            'result' => 1,
            'companybillingmaster' => $companybillingmaster,
        ]);
    } else {
        return response()->json([
            'result' => 0,
            'message' => 'Companybillingmaster not found',
        ]);
    }

}

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateCompanybillingmasterRequest $request, Companybillingmaster $companybillingmaster)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            $companybillingmaster = Companybillingmaster::find($request->edit_model_id);
            $companybillingmaster->update(Arr::only($input, $companybillingmaster->getFillable()));
            DB::commit();

            return response()->json(['success' => 'Companybillingmaster updated successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'updating', 'Companybillingmaster');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Companybillingmaster $companybillingmaster, Request $request)
    {
         $companybillingmaster = Companybillingmaster::find($request->model_id);

        try {
            DB::beginTransaction();
            $companybillingmaster->delete();
            DB::commit();
            return response()->json(['success' => 'Companybillingmaster deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'Companybillingmaster');
        }
    }
}
