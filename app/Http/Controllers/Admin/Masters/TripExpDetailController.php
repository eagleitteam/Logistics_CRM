<?php

namespace App\Http\Controllers\Admin\Masters;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreExpDetailRequest;
use App\Http\Requests\Admin\Masters\UpdateTripMovementRequest;
use App\Models\TripMovement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use App\Models\TripExpDetail;

class TripExpDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreExpDetailRequest $request)
{
    try {
        DB::beginTransaction();

        $input = $request->validated();

        // echo "<pre>"; print_r($input); die;

        $tripMovement = TripMovement::findOrFail($request->trip_id);

        $input['trip_id']   = $tripMovement->id;
        $input['unique_no'] = $tripMovement->unique_no;

        TripExpDetail::create(
            Arr::only($input, (new TripExpDetail())->getFillable())
        );

        DB::commit();

        return response()->json(['success' => 'Trip Exp Detail created successfully!']);
    } catch (\Exception $e) {
        DB::rollBack();
        return $this->respondWithAjax($e, 'creating', 'Trip Exp Detail');
    }
}


    /**
     * Display the specified resource.
     */
    public function show(TripExpDetail $tripExpDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TripExpDetail $tripExpDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TripExpDetail $tripExpDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TripExpDetail $tripExpDetail)
    {
        //
    }
}
