<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Exports\TripMovementExport;
use App\Mail\DailyTripMovementMail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Companybillingmaster;

class TripMovementsMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:trip-movements-mail';

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
        $today = Carbon::today()->format('Y-m-d');
        $companyBillingData = Companybillingmaster::latest()->first();
        $fileName = "trip_movements_{$today}.xlsx";
        $filePath = storage_path("app/public/{$fileName}");
        $email = $companyBillingData->email ?? 'test@mailtrap.io';
        // Generate Excel file
        Excel::store(new TripMovementExport, "public/{$fileName}");

        // Define recipient email
        $recipient = $email; // replace with real email

        // Send the email with attachment
        Mail::to($recipient)->send(
            (new DailyTripMovementMail($today, $filePath))->attach($filePath)
        );


        $this->info("Trip movement report for {$today} sent successfully!");


    }
}
