<?php
namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Models\TripMovement;
use App\Models\Clientmaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Masters\StorePODTripMovementRequest;
use Illuminate\Support\Facades\DB;

class PODTripMomentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
{
    if ($request->ajax()) {
        $query = TripMovement::with('VehicalNumber')
            ->where('pod_status', 1) // Only trips with POD status = 1
            ->whereNull('deleted_at');

        if ($request->filled('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        $tripMovements = $query->get();

        $data = [];
        $sr = 1;
        foreach ($tripMovements as $trip) {
            $data[] = [
                'DT_RowIndex'    => $sr++,
                'id'             => $trip->id, // ✅ Add this
                'unique_no'      => $trip->unique_no,
                'VehicalNumber'  => [
                    'vehicle_number' => $trip->VehicalNumber->vehicle_number ?? '',
                ],
                'pod_no'         => $trip->pod_no ?? '',
                'courier'        => $trip->courier ?? '',
                'courier_tracking_number'        => $trip->courier_tracking_number ?? '',
                'courier_status' => $trip->courier_status ?? '',
                'pod_status'     => $trip->pod_status ?? '',
                'action'         => '
                    <a href="#" data-id="'.$trip->id.'" class="btn btn-sm btn-primary edit-element">Edit</a>
                    <a href="#" data-id="'.$trip->id.'" class="btn btn-sm btn-danger rem-element">Delete</a>
                ',
            ];
        }

        return response()->json([
            "draw" => intval($request->draw),            // required by DataTables
            "recordsTotal" => $tripMovements->count(),   // total records
            "recordsFiltered" => $tripMovements->count(),// after filter (same since we filter before get)
            "data" => $data                              // actual data
        ]);
    }

    $clients = Clientmaster::whereNull('deleted_at')->get();
    return view('admin.masters.add-courier-trip-movement', compact('clients'));
}


    /**
     * Show the form for creating a new resource.
     */
    
     public function courier_tripmovement_list()
    {
        $tripMovements = TripMovement::with('VehicalNumber')
            ->where('pod_status', 1)
            ->where('courier_status', 1)
            ->whereNull('deleted_at')
            ->get();

        return view('admin.masters.courier-trip-movement-list', compact('tripMovements'));
    }

    // Fetch single record for edit
    public function courier_bulkEdit(Request $request)
    {
        $id = $request->id;
        $tripMovement = TripMovement::find($id);

        if (!$tripMovement) {
            return response()->json(['result' => 0]);
        }

        return response()->json([
            'result' => 1,
            'record' => $tripMovement
        ]);
    }

    // Update all rows with same courier + tracking number
  public function courier_updateBulk(Request $request)
{
    $validated = $request->validate([
        'id' => 'required|integer|exists:trip_movements,id',
        'courier' => 'required|string',
        'courier_tracking_number' => 'required|string',
        'courier_date' => 'nullable|date',
        // add other validations if needed
    ]);

    // 1. Find original record
    $trip = TripMovement::findOrFail($validated['id']);

    $oldTracking = $trip->courier_tracking_number;
    $oldCourier  = $trip->courier; // optional: use if you want to match both fields
    $newTracking = $validated['courier_tracking_number'];
    $newCourier  = $validated['courier'];
    $newDate     = $validated['courier_date'] ?? null;

    if (empty($oldTracking)) {
        return response()->json(['error' => 'Original tracking number is empty. Cannot perform bulk update.'], 422);
    }

    // Build update payload
    $updateData = [
        'courier' => $newCourier,
        'courier_tracking_number' => $newTracking,
        'courier_date' => $newDate,
        'pod_status' => $request->pod_status ?? 1,
        'courier_status' => 1,
    ];

    // 2. Use transaction so either all update or none
    DB::transaction(function () use ($oldTracking, $oldCourier, $updateData, $trip) {
        // If you want to match only on tracking number:
        TripMovement::where('courier_tracking_number', $oldTracking)
            ->update($updateData);
    });

    return response()->json(['success' => 'All records with the old tracking number updated to the new one.']);
}

public function courier_deleteBulk(Request $request)
{
    $id = $request->id;

    // 1. Find the record first
    $trip = TripMovement::find($id);

    if (!$trip) {
        return response()->json(['error' => 'Record not found.'], 404);
    }

    $oldTracking = $trip->courier_tracking_number;
    $oldCourier  = $trip->courier;

    if (empty($oldTracking) || empty($oldCourier)) {
        return response()->json(['error' => 'Courier or Tracking number is empty. Cannot perform bulk delete.'], 422);
    }

    // 2. Build payload with NULL values
    $nullData = [
        'courier' => null,
        'courier_tracking_number' => null,
        'courier_date' => null,
        'courier_status' => null,
    ];

    // 3. Bulk update all rows with same courier + tracking number
    DB::transaction(function () use ($oldTracking, $oldCourier, $nullData) {
        TripMovement::where('courier', $oldCourier)
            ->where('courier_tracking_number', $oldTracking)
            ->update($nullData);
    });

    return response()->json(['success' => 'Courier details cleared successfully for all matching records.']);
}

    /**
     * Store a newly created resource in storage.
     */

    public function store(StorePODTripMovementRequest $request)
    {
        $data = $request->validated();

        $tripMovement = TripMovement::findOrFail($request->pod_trip_id);

        if ($request->hasFile('pod_document')) {
            $file = $request->file('pod_document');
            $filename = $request->unique_no . "_" . date('Ymd') . '_' . \Illuminate\Support\Str::random(6) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('PodDocument', $filename, 'public');
            $data['pod_document'] = $path;
        }

        $tripMovement->update(\Illuminate\Support\Arr::only($data, [
            'pod_no',
            'pod_document',
            'pod_status',
        ]));

        return response()->json(['success' => 'POD details saved successfully!']);
    }

 
    
    public function updateBulk(Request $request)
    {
    $ids = explode(",", $request->ids);

    if (empty($ids)) {
    return response()->json(['error' => 'No records selected']);
    }

    foreach ($ids as $id) {
    $tripMovement = TripMovement::find($id);
    if (!$tripMovement) continue;

    $updateData = [
    'pod_no' => $request->pod_no,
    'courier' => $request->courier,
    'courier_tracking_number' => $request->courier_tracking_number,
    'courier_date' => $request->courier_date,
    'pod_status' => $request->pod_status,
    'courier_status' => 1,
    ];

    // file upload
    if ($request->hasFile('pod_document')) {
    if ($tripMovement->pod_document && Storage::disk('public')->exists($tripMovement->pod_document)) {
    Storage::disk('public')->delete($tripMovement->pod_document);
    }

    $file = $request->file('pod_document');
    $filename = $tripMovement->unique_no . "_" . date('Ymd') . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
    $path = $file->storeAs('PodDocument', $filename, 'public');
    $updateData['pod_document'] = $path;
    }

    $tripMovement->update(array_filter($updateData));
    }

    return response()->json(['success' => 'Selected records updated successfully!']);
}



    /**
     * Remove the specified resource from storage.
     */
    // Bulk edit (just return multiple models for your modal)
public function bulkEdit(Request $request)
{
    $ids = $request->ids;

    if (!$ids || !is_array($ids)) {
        return response()->json(['error' => 'No IDs selected']);
    }

    $tripMovements = TripMovement::whereIn('id', $ids)->get();

    return response()->json([
        'result' => 1,
        'records' => $tripMovements
    ]);
}

public function bulkDelete(Request $request)
{
    $ids = $request->ids;

    if (!$ids || count($ids) == 0) {
        return response()->json([
            'status' => 'error',
            'message' => 'No records selected.'
        ], 400);
    }

    try {
        TripMovement::whereIn('id', $ids)->update([
            'courier' => null,
            'courier_tracking_number' => null,
            'courier_date' => null,
            'courier_status' => null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Courier details cleared successfully.'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong while clearing courier data.'
        ], 500);
    }
}



}
