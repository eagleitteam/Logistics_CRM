<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Yearmaster;

class CheckYearAccess   
{
    public function handle(Request $request, Closure $next)
    {
        $activeYearId = session('active_year_id');

        if ($activeYearId) {
            $year = Yearmaster::find($activeYearId);

            if ($year) {
                // Share active year in all views
                view()->share('activeYear', $year);

                // ✅ Step 1: Check financial year date validity
                $today = now()->toDateString();

                if ($today < $year->start_date || $today > $year->end_date) {
                    // Optional JSON response for AJAX
                    if ($request->ajax()) {
                        return response()->json([
                            'error' => 'This financial year period has expired.'
                        ], 403);
                    }

                    return redirect()->back()->with('error', 'This financial year period has expired.');
                }

                // ✅ Step 2: Check frozen status (only view allowed)
                if ($year->status == 0 || $year->freeze_status == 1) {
                    if (in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
                        if ($request->ajax()) {
                            return response()->json([
                                'error' => 'This financial year is frozen. Only view is allowed.'
                            ], 403);
                        }

                        return redirect()->back()->with('error', 'This financial year is frozen. Only view is allowed.');
                    }
                }
            }
        }

        return $next($request);
    }
}
