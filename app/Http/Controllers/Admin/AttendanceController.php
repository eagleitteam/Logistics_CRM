<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Drivermaster;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Drivermaster::all();
        return view('admin.add-attendance')->with(['employees' => $employees]);

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
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
    {
        $data = \App\Models\Attendance::where('month_id', $request->month_id)
            ->where('employee_id', $request->employee_id)
            ->first();

        return response()->json($data);
    }

     public function updateDays(Request $request)
    {
        $attendance = Attendance::where('employee_id', $request->employee_id)
            ->where('month_id', $request->month_id)
            ->first();

        if (!$attendance) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        $attendance->present_days = $request->present_days;
        $attendance->absent_days = $request->absent_days ?? 0;
        $attendance->save();

        return response()->json(['success' => true, 'message' => 'Attendance updated successfully.']);
    }

}
