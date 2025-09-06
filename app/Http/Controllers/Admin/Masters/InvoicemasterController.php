<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreInvoicemasterRequest;
use App\Http\Requests\Admin\Masters\UpdateInvoicemasterRequest;
use App\Models\Yearmaster;
use App\Models\Clientmaster;
use App\Models\Gstmaster;
use App\Models\Invoicemaster;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class InvoicemasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $yearmasters = Yearmaster::latest()->get();

        $clientmasters = Clientmaster::latest()->get();

        $gstmasters = Gstmaster::latest()->get();

        $invoicemasters = Invoicemaster::latest()->get();

        return view('admin.masters.invoice-master')->with(['yearmasters' => $yearmasters, 'clientmasters' => $clientmasters, 'gstmasters' => $gstmasters, 'invoicemasters' => $invoicemasters]);
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
    public function store(StoreInvoicemasterRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            Invoicemaster::create(Arr::only($input, (new Invoicemaster())->getFillable()));
            DB::commit();

            return response()->json(['success' => 'Invoice master created successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'creating', 'Invoice master');
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
   public function edit(Invoicemaster $invoicemasters, Request $request)
{

    $invoicemasters = Invoicemaster::find($request->model_id);
    if ($invoicemasters) {
        return response()->json([
            'result' => 1,
            'invoicemasters' => $invoicemasters,
        ]);
    } else {
        return response()->json([
            'result' => 0,
            'message' => 'Invoice master not found',
        ]);
    }

}

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateInvoicemasterRequest $request, Invoicemaster $invoicemasters)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            $invoicemasters = Invoicemaster::find($request->edit_model_id);
            $invoicemasters->update(Arr::only($input, $invoicemasters->getFillable()));
            DB::commit();

            return response()->json(['success' => 'Invoice master updated successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'updating', 'Invoice master');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoicemaster $invoicemasters, Request $request)
    {
         $invoicemasters = Invoicemaster::find($request->model_id);

        try {
            DB::beginTransaction();
            $invoicemasters->delete();
            DB::commit();
            return response()->json(['success' => 'Invoice master deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'Invoice master');
        }
    }
}
