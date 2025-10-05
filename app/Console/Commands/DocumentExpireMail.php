<?php

namespace App\Console\Commands;
use Carbon\Carbon;
use App\Models\VehicleDocumentDetails;
use App\Models\Companybillingmaster;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\VehicleDocumentExpiryMail;


class DocumentExpireMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:document-expire-mail';

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
        $today = Carbon::today();
        $fiveDaysLater = Carbon::today()->addDays(5);

        $today = Carbon::today()->format('Y-m-d');
        $fiveDaysLater = Carbon::today()->addDays(5)->format('Y-m-d');

        $getDocumentData = VehicleDocumentDetails::join('self_vehicles', 'self_vehicles.vehicle_number', '=', 'vehicle_document_details.vehicle_number')
            ->join('self_vehicle_d_ocuments', 'self_vehicle_d_ocuments.id', '=', 'vehicle_document_details.tab_id')
            ->where('self_vehicles.type', 1)
            ->whereNull('vehicle_document_details.deleted_at')
            ->where(function ($query) use ($today, $fiveDaysLater) {
                $query->whereBetween('vehicle_document_details.end_date', [$today, $fiveDaysLater])
                    ->orWhere('vehicle_document_details.end_date', '<', $today);
            })
            ->select('vehicle_document_details.*', 'self_vehicles.type', 'self_vehicles.vehicle_number','self_vehicle_d_ocuments.name as documentName')->get();
        
        $companyBillingData = Companybillingmaster::latest()->first();
        if ($getDocumentData->count() > 0 && $companyBillingData) {
            foreach ($getDocumentData as $getDocument) {
                info("getDocument = > " . json_encode($getDocument));
                try {
                    $email = $companyBillingData->email ?? 'test@mailtrap.io'; // fallback for testing

                    Mail::to($email)->send(
                        new VehicleDocumentExpiryMail($getDocument, $companyBillingData)
                    );

                    Log::info(" Expiry email sent for Document ID: {$getDocument->id}, Vehicle: {$getDocument->vehicle_number}");
                    
                    sleep(2); // prevent Mailtrap throttling
                } catch (\Exception $e) {
                    Log::error(" Failed sending mail for Document ID {$getDocument->id}: " . $e->getMessage());
                }
            }
        } else {
            Log::info("No expiring or expired documents found today.");
        }
    }
}
