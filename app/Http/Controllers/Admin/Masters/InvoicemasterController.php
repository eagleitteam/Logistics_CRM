<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreInvoicemasterRequest;
use App\Http\Requests\Admin\Masters\UpdateInvoicemasterRequest;
use App\Models\Yearmaster;
use App\Models\Clientmaster;
use App\Models\Gstmaster;
use App\Models\Invoicemaster;
use App\Models\Invoiceadhoctripdata;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Models\TripMovement;
use App\Models\Companybillingmaster;
use App\Models\Numberingprefix;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoicemasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $invoicemasters = Invoicemaster::latest()->get();

        

        return view('admin.masters.invoicemaster')->with(['invoicemasters' => $invoicemasters]);
    }

        public function getTrips(Request $request)
    {
        $clientId = $request->client_id;
        $month = $request->month; // e.g. 08

        $trips = TripMovement::query()
            ->when($clientId, function ($q) use ($clientId) {
                $q->where('client_id', $clientId);
            })
            ->when($month, function ($q) use ($month) {
                $q->whereMonth('trip_date', $month);
            })
            ->whereNull('invoice_status')
            ->get();

        $options = $trips->map(function ($trip) {
            return [
                'id' => $trip->id,
                'text' => '(' . $trip->trip_date . ') '. $trip->origin . ' - '. $trip->destination ,
                'unique_no' => $trip->unique_no,
                'vehical_number' => $trip->VehicalNumber ? $trip->VehicalNumber->vehicle_number : '',
                'pod_number' => $trip->pod_number,
                'pod_status' => $trip->pod_status,
                'rate' => $trip->rate ?? 0,
            ];
        });

        // Client info fetch
        $clientData = $clientId ? Clientmaster::find($clientId) : null;

        // return response()->json($options);
        return response()->json([
            'trips' => $options,
            'client' => $clientData
        ]);
    }

    public function getFilteredTrips(Request $request)
    {
        $clientId = $request->client_id;
        $month = $request->month; // 01, 02, ...
        $tripIds = $request->trips ?? [];

        $query = TripMovement::query();

        if ($clientId) {
            $query->where('client_id', $clientId);
        }

        if ($month) {
            $query->whereMonth('trip_date', $month);
        }

        if (!empty($tripIds)) {
            $query->whereIn('id', $tripIds);
        }

        $trips = $query->with('VehicalNumber')->get();

        return response()->json($trips);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $yearmasters = Yearmaster::latest()->get();

        $clientmasters = Clientmaster::latest()->get();

        $gstmasters = Gstmaster::latest()->get();

        $invoicemasters = Invoicemaster::latest()->get();

        $companybillingmasters = Companybillingmaster::latest()->get();
        


        // 01 ते 12 format मध्ये months बनवतो
        $months = [];
        for ($m = 1; $m <= 12; $m++) {
            $months[] = str_pad($m, 2, '0', STR_PAD_LEFT);
        }

        // gstmaster सोबत companybillingmaster fetch करतो
        $companybillingmasters = Companybillingmaster::with('gstmaster')->latest()->get();

    
        // dd($companybillingmasters);
        // dd($gstmasters);
        return view('admin.masters.invoiceadhoc-create')->with(['yearmasters' => $yearmasters, 'clientmasters' => $clientmasters, 'gstmasters' => $gstmasters, 'invoicemasters' => $invoicemasters, 'months' => $months, 'companybillingmasters' => $companybillingmasters]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     */
            public function store(StoreInvoicemasterRequest $request)
        {
            try {
                DB::beginTransaction();

                $input = $request->validated();

                //generate invoice number
                // Get last invoice
                // $lastInvoiceData = Invoicemaster::latest()->first(); 

                // Get numbering prefix config
                // $prefixData = Numberingprefix::where('type', 1)->latest()->first();

                // $prefix   = $prefixData->prefix ?? '';
                // $digits   = $prefixData->digits ?? 3;
                // $postfix  = $prefixData->postfix ?? '';

                // If no previous invoice, start at 1
                // if (empty($lastInvoiceData)) {
                //     $nextNumber = 1;
                // } else {
                //     preg_match('/(\d+)/', $lastInvoiceData->invoice_number, $matches);
                //     $lastNumber = isset($matches[0]) ? (int)$matches[0] : 0;
                //     $nextNumber = $lastNumber + 1;
                // }
                // $numberPadded = str_pad($nextNumber, $digits, '0', STR_PAD_LEFT);               
                // $invoiceNumber = $prefix . '/' . $numberPadded . '/' . $postfix;

                // New logic: Use current year and month in invoice number
                // Get numbering prefix config
                $prefixData = Numberingprefix::where('type', 1)
                                            ->latest()
                                            ->first();

                $prefix   = $prefixData->prefix;       // 'INV'
                $digits   = $prefixData->digits;       // 3
                $postfix  = $prefixData->postfix;      // '2025-26'

                // Get last invoice from Invoicemaster
                $lastInvoiceData = Invoicemaster::latest('id')
                                                ->first();

                if (empty($lastInvoiceData)) {
                    // पहिला invoice → numberingprefix मधून सुरू करा
                    $nextNumber = 1;
                } else {
                    // उदा: INV/010/2025-26
                    $parts = explode('/', $lastInvoiceData->inv_no);

                    // Middle number घ्या (010)
                    $lastNumber = isset($parts[1]) ? (int)$parts[1] : 0;

                    // +1 करा
                    $nextNumber = $lastNumber + 1;
                }

                // Pad with digits (उदा: 010)
                $numberPadded = str_pad($nextNumber, $digits, '0', STR_PAD_LEFT);

                // Final invoice number तयार करा
                $invoiceNumber = $prefix . '/' . $numberPadded . '/' . $postfix;


                // active year
                $year_id = Yearmaster::where('status', 1)->where('freeze_status', 0)->first();

            
                // Step 1: Create Invoicemaster entry (array मधला TripsList वगळून)
                $invoiceMaster = Invoicemaster::create([
                    'inv_no'          => $invoiceNumber,
                    'inv_date'        => $input['inv_date'],
                    'client_id'       => $input['client_id'],
                    'year_id'         => $year_id->id ?? null,
                    'month'           => $input['month'] ?? null,
                    'termdays'        => $input['termdays'] ?? null,
                    'invoicePeriod'   => $input['invoicePeriod'] ?? null,
                    'billedTo'        => $input['billedTo'] ?? null,
                    'billedToAddress' => $input['billedToAddress'] ?? null,
                    'gstno'           => $input['gstno'] ?? null,
                    'invoiceType'     => $input['invoiceType'] ?? null,
                    'poNumber'        => $input['poNumber'] ?? null,
                ]);

                // Step 2 + Step 3: Loop through TripsList and handle both tables
                    if (!empty($input['TripsList'])) {
                        foreach ($input['TripsList'] as $tripData) {
                            [$tripId, $uniqueNo] = explode('|', $tripData);

                            // Insert in Invoiceadhoctripdata
                            Invoiceadhoctripdata::create([
                                'invoice_master_id' => $invoiceMaster->id,
                                'clientmaster_id'   => $input['client_id'],
                                'trip_movement_id'  => $tripId,
                                'unique_no'         => $uniqueNo,
                            ]);

                            // Update TripMovement
                            TripMovement::where('id', $tripId)->update([
                                'invocie_no'     => $invoiceNumber,   // spelling fix
                                'invoice_status' => 1,
                            ]);
                        }
                    }

                // dd([
                //     'invoice_master_id' => $invoiceMaster->id,
                //     'clientmaster_id'   => $invoiceMaster->client_id,
                //     'trip_movement_id'  => $tripId,
                //     'unique_no'         => $uniqueNo,
                // ]);



                DB::commit();

                return response()->json(['success' => 'Invoice created successfully!']);

            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'error' => 'Error creating Invoice: ' . $e->getMessage()
                ], 500);
            }
        }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
            // $invoice = Invoicemaster::findOrFail($id);
            $invoice = Invoicemaster::with('trips')->find($id);
            // $companybillingmasters = Companybillingmaster::with('bank')->find($id);
            $companybillingmasters = Companybillingmaster::with(['bank','gstmaster'])->find($id);
            $clientmasters = Clientmaster::latest()->get();

             // Debug:
            // dd($invoice);
            // dd($companybillingmasters);
            // dd($clientmasters);
            // dd($invoice->toArray());

        // Paths
        // $sealPath = public_path('admin/images/inv_image/seal.png');
        // $signPath = public_path('admin/images/inv_image/signature.png');
        // $finalPath = public_path('admin/images/inv_image/final_signature.png');

        // if (!file_exists($finalPath)) {
        //     $seal = imagecreatefrompng($sealPath);
        //     $sign = imagecreatefrompng($signPath);

        //     // Transparency enable
        //     imagesavealpha($seal, true);
        //     imagealphablending($seal, true);

        //     imagesavealpha($sign, true);
        //     imagealphablending($sign, true);

        //     // sizes
        //     $seal_w = imagesx($seal);
        //     $seal_h = imagesy($seal);
        //     $sign_w = imagesx($sign);
        //     $sign_h = imagesy($sign);

        //     // ---- Resize Seal proportional to signature ----
        //     $maxSealW = $sign_w * 0.8; // seal will cover 80% of signature width
        //     $maxSealH = $sign_h * 0.8; // seal will cover 80% of signature height

        //     $ratio = min($maxSealW / $seal_w, $maxSealH / $seal_h);
        //     $newSealW = intval($seal_w * $ratio);
        //     $newSealH = intval($seal_h * $ratio);

        //     $resizedSeal = imagecreatetruecolor($newSealW, $newSealH);
        //     imagesavealpha($resizedSeal, true);
        //     imagealphablending($resizedSeal, false);

        //     // transparent background
        //     $transparent = imagecolorallocatealpha($resizedSeal, 255, 255, 255, 127);
        //     imagefill($resizedSeal, 0, 0, $transparent);

        //     imagecopyresampled(
        //         $resizedSeal,
        //         $seal,
        //         0, 0, 0, 0,
        //         $newSealW, $newSealH,
        //         $seal_w, $seal_h
        //     );

        //     // ---- Create bigger transparent canvas ----
        //     $finalW = max($sign_w, $newSealW);
        //     $finalH = max($sign_h, $newSealH);

        //     $canvas = imagecreatetruecolor($finalW, $finalH);
        //     imagesavealpha($canvas, true);
        //     imagealphablending($canvas, false);
        //     $transparent = imagecolorallocatealpha($canvas, 255, 255, 255, 127);
        //     imagefill($canvas, 0, 0, $transparent);

        //     // ---- Place seal first (background) ----
        //     $seal_x = ($finalW - $newSealW) / 2;
        //     $seal_y = ($finalH - $newSealH) / 2;
        //     imagecopy($canvas, $resizedSeal, $seal_x, $seal_y, 0, 0, $newSealW, $newSealH);

        //     // ---- Place signature on top ----
        //     $sign_x = ($finalW - $sign_w) / 2;
        //     $sign_y = ($finalH - $sign_h) / 2;
        //     imagecopy($canvas, $sign, $sign_x, $sign_y, 0, 0, $sign_w, $sign_h);

        //     // save merged image (transparent PNG)
        //     imagepng($canvas, $finalPath);

        //     imagedestroy($seal);
        //     imagedestroy($sign);
        //     imagedestroy($resizedSeal);
        //     imagedestroy($canvas);
        // }

        // आता PDF ला final_signature.png पाठव
        // $pdf = Pdf::loadView('test', [
        //     'finalSignature' => 'admin/images/inv_image/final_signature.png'
        // ]);

        // return $pdf->stream('test.pdf'); // opens in browser

        //  Load PDF view and pass invoice data

        $logoPath = public_path($companybillingmasters->company_logo);
        $logoData = base64_encode(file_get_contents($logoPath));
        $logoSrc = 'data:image/png;base64,' . $logoData;

        $signaturePath = public_path($companybillingmasters->authorised_signature);
        $signatureData = base64_encode(file_get_contents($signaturePath));
        $signatureSrc = 'data:image/png;base64,' . $signatureData;

        $sealPath = public_path($companybillingmasters->company_seal);
        $sealData = base64_encode(file_get_contents($sealPath));
        $sealSrc = 'data:image/png;base64,' . $sealData;

            $pdf = Pdf::loadView('invoices', [
            'invoice' => $invoice,
            'companybillingmasters' => $companybillingmasters,
            'sealSrc'               => $sealSrc,
            'signatureSrc'               => $signatureSrc,
             'logoSrc'               => $logoSrc
            // 'finalSignature' => 'admin/images/inv_image/final_signature.png'
            ]);

        // Replace / with - or _
        $filename = 'invoice_' . str_replace(['/','\\'], ['_','_'], $invoice->inv_no) . '.pdf';



        //  Stream PDF in browser
        return $pdf->stream($filename);
    
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