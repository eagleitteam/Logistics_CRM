<?php

namespace App\Exports;

use App\Models\TripMovement;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;

class TripMovementExport implements FromView
{
    public function view(): View
    {
        $today = Carbon::today()->format('Y-m-d');

        $tripData = TripMovement::whereDate('trip_date', $today)->get();

        return view('exports.trip_movements', [
            'tripData' => $tripData,
            'date' => $today
        ]);
    }
}
