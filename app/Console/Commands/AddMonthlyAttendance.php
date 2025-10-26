<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Attendance;
use App\Models\Drivermaster;
use Carbon\Carbon;


class AddMonthlyAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-monthly-attendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now();
        $month = $today->month;
        $year = $today->year;

        $today = Carbon::now();
        $month = $today->month;
        $year = $today->year;

        $fromDate = $today->copy()->startOfMonth()->toDateString(); // e.g. 2025-10-01
        $toDate = $today->copy()->endOfMonth()->toDateString(); 

        // Find financial year record based on current date
        $financialYear = \App\Models\Yearmaster::whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->first();

        if (!$financialYear) {
            $this->error("Financial year not found for date {$today->toDateString()}");
            return;
        }

        $employees = Drivermaster::all();
        $totalDays = $today->daysInMonth;

        $addedCount = 0;
        $skippedCount = 0;

        foreach ($employees as $employee) {
            $exists = Attendance::where('employee_id', $employee->id)
                ->where('yearmaster_id', $financialYear->id)
                ->where('month_id', $month)
                ->exists();

            if ($exists) {
                $this->info("⚠️ Attendance already exists for Employee ID {$employee->id} ({$month}-{$year})");
                $skippedCount++;
                continue;
            }

            Attendance::create([
                'yearmaster_id' => $financialYear->id,
                'employee_id' => $employee->id,
                'month_id' => $month,
                'year' => $year,
                'from_date' => $fromDate,
                'to_date' => $toDate,
                'total_days' => $totalDays,
                'present_days' => $totalDays,
                'absent_days' => 0,
                'leave_days' => 0,
                'half_days' => 0,
                'created_by' => 1, // optional: change as needed
            ]);

            $addedCount++;
        }

        $this->info(" Attendance created for {$addedCount} employees. Skipped {$skippedCount} existing records.");
    }
}
