<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreNumberingprefixRequest;
use App\Http\Requests\Admin\Masters\UpdateNumberingprefixRequest;
use App\Models\Yearmaster;
use App\Models\Numberingprefix;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class NumberingprefixController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $yearmasters = Yearmaster::latest()->get();
        $numberingprefixes = Numberingprefix::latest()->get();

        return view('admin.masters.Numbering-prefix-master')->with(['yearmasters' => $yearmasters, 'numberingprefixes' => $numberingprefixes]);
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
    public function store(StoreNumberingprefixRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            Numberingprefix::create(Arr::only($input, (new Numberingprefix())->getFillable()));
            DB::commit();

            return response()->json(['success' => 'Numbering prefix created successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'creating', 'Numberingprefix');
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
   public function edit(Numberingprefix $numberingprefix, Request $request)
{

    $numberingprefix = Numberingprefix::find($request->model_id);
    if ($numberingprefix) {
        return response()->json([
            'result' => 1,
            'numberingprefix' => $numberingprefix,
        ]);
    } else {
        return response()->json([
            'result' => 0,
            'message' => 'Numbering prefix not found',
        ]);
    }

}

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateNumberingprefixRequest $request, Numberingprefix $numberingprefix)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            $numberingprefix = Numberingprefix::find($request->edit_model_id);
            $numberingprefix->update(Arr::only($input, $numberingprefix->getFillable()));
            DB::commit();

            return response()->json(['success' => 'Numbering prefix updated successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'updating', 'Numberingprefix');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Numberingprefix $numberingprefix, Request $request)
    {
         $numberingprefix = Numberingprefix::find($request->model_id);

        try {
            DB::beginTransaction();
            $numberingprefix->delete();
            DB::commit();
            return response()->json(['success' => 'Numbering prefix deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'Numberingprefix');
        }
    }
}
