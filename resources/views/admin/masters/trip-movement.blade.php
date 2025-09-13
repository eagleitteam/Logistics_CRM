<x-admin.layout>
    <x-slot name="title">Daily Trip Movement Entry</x-slot>
    <x-slot name="heading">Daily Trip Movement Entry</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


    <div class="row" id="addContainer" style="display:none;">
        <div class="col-lg-12">
            <div class="card">
                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                    @csrf
                <div class="card-body">
                        <form action="javascript:void(0);">
                            <div class="row">
                                <div class="col-md-4">
                                    
                                        <label  class="col-form-label" for="TripDate" class="form-label">Date</label>
                                        <input type="date" class="form-control" id="TripDate" name="trip_date">
                                        <span class="text-danger invalid trip_date_err"></span>
                                </div>
                                <!--end col-->
                                
                                    <div class="col-md-4">
                                                    <label class="col-form-label" for="vehicle_no" >Vehical Number</label>
                                                    <select id="Forminputvehicle_no" class="form-select" name="vehicle_no">
                                                        <option value="">Select Vehical Number</option>
                                                         @foreach ($VehicleNo as $vehicalNumber)
                                                                <option value="{{ $vehicalNumber->id }}">{{ $vehicalNumber->vehicle_number }}</option>
                                                            @endforeach
                                                    </select>
                                                    <span class="text-danger invalid vehicle_no_err"></span>

                                                </div>
                                
                                <!--end col-->

                                <div class="col-md-4">
                                    <label class="col-form-label" for="name">Select Vehical Type<span class="text-danger">*</span></label>
                                    <select class="form-control" id="vehicle_type_id" name="vehicle_type_id">
                                        <option value="">Select Vehical Type</option>
                                        @foreach ($VehicleTypeMaster as $vehicalType)
                                            <option value="{{ $vehicalType->id }}">{{ $vehicalType->type_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger invalid vehicle_type_id_err"></span>
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                        <label for="origininput" class="col-form-label">Origin</label>
                                        <input type="text" class="form-control" placeholder="Origin" id="origininput" name="origin">
                                        <span class="text-danger invalid origin_err"></span>
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                    
                                        <label for="destinationinput" class="col-form-label">Destination</label>
                                        <input type="text" class="form-control" placeholder="Destination" id="destinationinput" name="destination">
                                    <span class="text-danger invalid destination_err"></span>
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                    
                                        <label for="rateinput" class="col-form-label">Trip Rate</label>
                                        <input type="number" class="form-control" placeholder="Trip Rate" id="rateinput" name="rate">
                                         <span class="text-danger invalid rate_err"></span>
                                </div>
                                <!--end col-->

                                <div class="col-md-4">
                                    <label class="col-form-label" for="name">Select Client<span class="text-danger">*</span></label>
                                    <select class="form-control" id="client_id" name="client_id">
                                        <option value="">Select Client</option>
                                        @foreach ($Clientmaster as $clients)
                                            <option value="{{ $clients->id }}">{{ $clients->client_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger invalid client_id_err"></span>
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                    <label class="col-form-label" for="name">Select Driver<span class="text-danger">*</span></label>
                                    <select class="form-control" id="driver_id" name="driver_id">
                                        <option value="">Select Driver</option>
                                        @foreach ($Drivermaster as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->first_name." ".$driver->last_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger invalid driver_id_err"></span>
                                </div>
                               
                                <!--end col-->
                                <div class="col-md-4">
                                        <label for="remarkinput" class="col-form-label">Remark</label>
                                        <input type="text" class="form-control" placeholder="Remark" id="remarkinput" name="remark">
                                    
                                </div>
                                <!--end col-->

                               <div class="col-lg-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>


                    </div>
                </form>
            </div>
        </div> <!-- end col -->
    </div>
    <!--end row-->

    {{-- Edit Form --}}
    <div class="row" id="editContainer" style="display:none;">
        <div class="col">
            <form class="form-horizontal form-bordered" method="post" id="editForm">
                @csrf
                <section class="card">
                    <header class="card-header">
                        <h4 class="card-title">Edit Daily Trip Movement Entry</h4>
                    </header>

                    <div class="card-body py-2">

                        <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                        <div class="mb-3 row">
                            <div class="col-md-4">          
                                <label  class="col-form-label" for="TripDate" class="form-label">Date</label>
                                <input type="date" class="form-control" id="edit_trip_date" name="trip_date">
                                 <span class="text-danger invalid trip_date_err"></span>     
                            </div>

                            <div class="col-md-4">
                                        <label class="col-form-label" for="vehicle_no" >Vehical Number</label>
                                        <select id="edit_vehicle_no" class="form-select" name="vehicle_no">
                                            <option value="">Select Vehical Number</option>
                                                @foreach ($VehicleNo as $vehicalNumber)
                                                        <option value="{{ $vehicalNumber->id }}">{{ $vehicalNumber->vehicle_number }}</option>
                                                @endforeach
                                        </select>
                                        <span class="text-danger invalid vehicle_no_err"></span>
                            </div>

                            <div class="col-md-4">
                                    <label class="col-form-label" for="name">Select Vehical Type<span class="text-danger">*</span></label>
                                    <select class="form-control" id="edit_vehicle_type_id" name="vehicle_type_id">
                                        <option value="">Select Vehical Type</option>
                                        @foreach ($VehicleTypeMaster as $vehicalType)
                                            <option value="{{ $vehicalType->id }}">{{ $vehicalType->type_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger invalid vehicle_id_err"></span>
                            </div>

                            <div class="col-md-4">
                                        <label for="origininput" class="col-form-label">Origin</label>
                                        <input type="text" class="form-control" placeholder="Origin" id="edit_origin" name="origin">
                                        <span class="text-danger invalid origin_err"></span>
                                </div>

                                <div class="col-md-4">
                                    
                                        <label for="destinationinput" class="col-form-label">Destination</label>
                                        <input type="text" class="form-control" placeholder="Destination" id="edit_destination" name="destination">
                                        <span class="text-danger invalid destination_err"></span>
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                    
                                        <label for="rateinput" class="col-form-label">Trip Rate</label>
                                        <input type="number" class="form-control" placeholder="Trip Rate" id="edit_rate" name="rate">
                                         <span class="text-danger invalid rate_err"></span>
                                </div>
                                <!--end col-->

                                <div class="col-md-4">
                                    <label class="col-form-label" for="name">Select Client<span class="text-danger">*</span></label>
                                    <select class="form-control" id="edit_client_id" name="client_id">
                                        <option value="">Select Client</option>
                                        @foreach ($Clientmaster as $clients)
                                            <option value="{{ $clients->id }}">{{ $clients->client_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger invalid client_id_err"></span>
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                    <label class="col-form-label" for="name">Select Driver<span class="text-danger">*</span></label>
                                    <select class="form-control" id="edit_driver_id" name="driver_id">
                                        <option value="">Select Driver</option>
                                        @foreach ($Drivermaster as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->first_name." ".$driver->last_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger invalid driver_id_err"></span>
                                </div>
                               
                                <!--end col-->
                                <div class="col-md-4">
                                        <label for="remarkinput" class="col-form-label">Remark</label>
                                        <input type="text" class="form-control" placeholder="Remark" id="edit_remark" name="remark">
                                </div>
                                <!--end col-->
                                            {{-- POD Details --}}
                                        <h1 id="pod_header" style="display:none;">POD Details</h1>
                                        <hr id="pod_hr" style="display:none;">
                                        <div class="mb-3 pod_field" style="display:none;">
                                            <label for="pod_no" class="form-label">POD No</label>
                                            <input type="text" class="form-control" id="edit_pod_no" name="pod_no">
                                            <span class="text-danger invalid pod_no_err"></span>
                                        </div>

                                        <div class="mb-3 pod_field" style="display:none;">
                                            <label for="pod_document" class="form-label">POD Document</label>
                                            <input type="file" class="form-control" id="edit_pod_document" name="pod_document">
                                            <span class="text-danger invalid pod_document_err"></span>
                                            <br>
                                            <a id="edit_pod_document_view" href="#" target="_blank" style="display:none;" class="btn btn-sm btn-info mt-2">View File</a>
                                        </div>

                                        {{-- Expense Details --}}
                                        <h1 id="exp_header" style="display:none;">Exp Details</h1>
                                        <hr id="exp_hr" style="display:none;">
                                        <div class="mb-3 exp_field" style="display:none;">
                                            <label for="toll_charges" class="form-label">Toll Charges</label>
                                            <input type="text" class="form-control calc-field" id="edit_toll_charges" name="toll_charges">
                                            <span class="text-danger invalid toll_charges_err"></span>
                                        </div>
                                        <div class="mb-3 exp_field" style="display:none;">
                                            <label for="loading_unloading_charges" class="form-label">Loading / Unloading Charges</label>
                                            <input type="text" class="form-control calc-field" id="edit_loading_unloading_charges" name="loading_unloading_charges">
                                            <span class="text-danger invalid loading_unloading_charges_err"></span>
                                        </div>
                                        <div class="mb-3 exp_field" style="display:none;">
                                            <label for="handing_charges" class="form-label">Handing Charges</label>
                                            <input type="text" class="form-control calc-field" id="edit_handing_charges" name="handing_charges">
                                            <span class="text-danger invalid handing_charges_err"></span>
                                        </div>
                                        <div class="mb-3 exp_field" style="display:none;">
                                            <label for="holding_charges" class="form-label">Holding Charges</label>
                                            <input type="text" class="form-control calc-field" id="edit_holding_charges" name="holding_charges">
                                            <span class="text-danger invalid holding_charges_err"></span>
                                        </div>
                                        <div class="mb-3 exp_field" style="display:none;">
                                            <label for="holding_days" class="form-label">Holding Days</label>
                                            <input type="text" class="form-control" id="edit_holding_days" name="holding_days">
                                            <span class="text-danger invalid holding_days_err"></span>
                                        </div>
                                        <div class="mb-3 exp_field" style="display:none;">
                                            <label for="other_exp" class="form-label">Other Exp</label>
                                            <input type="text" class="form-control calc-field" id="edit_other_exp" name="other_exp">
                                            <span class="text-danger invalid other_exp_err"></span>
                                        </div>
                                        <div class="mb-3 exp_field" style="display:none;">
                                            <label for="total_exp" class="form-label">Total Exp</label>
                                            <input type="text" class="form-control" id="edit_total_exp" name="total_exp" readonly>
                                            <span class="text-danger invalid total_exp_err"></span>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <button class="btn btn-primary" id="editSubmit">Submit</button>
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                    </div>
                                </section>
                            </form>
                        </div>
                        </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="">
                                    <button id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></button>
                                    <button id="btnCancel" class="btn btn-danger" style="display:none;">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                            <thead>
    <tr>
        <th>Sr No.</th>
        <th>Unique Number</th>
        <th>POD Number</th>
        <th>Vehicle Number</th>
        <th>Origin</th>
        <th>Destination</th>
        <th>Trip Date</th>
        <th>POD Status</th>
        <th>Expense Details</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
   @foreach ($TripMovement as $movement)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $movement->unique_no }}</td>
        <td>{{ $movement->pod_no }}</td>
        <td>{{ $movement->VehicalNumber->vehicle_number }}</td>
        <td>{{ $movement->origin }}</td>
        <td>{{ $movement->destination }}</td>
        <td>{{ $movement->trip_date }}</td>

        {{-- ✅ POD Status --}}
        <td>
            @if($movement->pod_status == 1)
                <span class="badge bg-success">POD Added</span>
            @else
                <button class="btn btn-info pod-element px-2 py-1"  
                        title="Add POD"  
                        data-id="{{ $movement->id }}">
                    <i data-feather="plus-circle"></i> ADD POD
                </button>
            @endif
        </td>

        {{-- ✅ Expense Details --}}
        <td>
            @if($movement->expDetails && $movement->expDetails->count() > 0)
                @foreach($movement->expDetails as $exp)
                    <div class="mb-1 small">
                        <strong>Toll:</strong> {{ $exp->toll_charges ?? 0 }},
                        <strong>Loading:</strong> {{ $exp->loading_unloading_charges ?? 0 }},
                        <strong>Handing:</strong> {{ $exp->handing_charges ?? 0 }},
                        <strong>Holding:</strong> {{ $exp->holding_charges ?? 0 }} × {{ $exp->holding_days ?? 0 }},
                        <strong>Other:</strong> {{ $exp->other_exp ?? 0 }},
                        <strong>Total:</strong> <span class="badge bg-primary">{{ $exp->total_exp ?? 0 }}</span>
                    </div>
                @endforeach
            @else
                <button class="btn btn-info exp-element px-2 py-1"  
                        title="Add Exp Details"  
                        data-trip_id="{{ $movement->id }}">
                    <i data-feather="plus-circle"></i> Add Exp Details
                </button>
            @endif
        </td>

        {{-- ✅ Action Buttons --}}
        <td>
            <button class="edit-element btn btn-secondary px-2 py-1" 
                    title="Edit trip" 
                    data-id="{{ $movement->id }}">
                <i data-feather="edit"></i>
            </button>

            <button class="btn btn-danger rem-element px-2 py-1" 
                    title="Delete trip" 
                    data-id="{{ $movement->id }}">
                <i data-feather="trash-2"></i>
            </button>
        </td>
    </tr>
    @endforeach
</tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- EPFO Modal -->
<div class="modal fade" id="podModal" tabindex="-1" aria-labelledby="podModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="podForm">
        @csrf
        <input type="hidden" id="pod_trip_id" name="pod_trip_id" value="">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add POD Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="mb-3">
                <label for="pod_no" class="form-label">POD No</label>
                <input type="text" class="form-control" id="pod_no" name="pod_no" required>
                 <span class="text-danger invalid pod_no_err"></span>
            </div>

            <div class="mb-3">
                <label for="pod_document" class="form-label">POD Document</label>
                <input type="file" class="form-control" id="pod_document" name="pod_document" required>
                <span class="text-danger invalid pod_document_err"></span>
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" id="podSubmit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
    </form>
  </div>
</div>

<!-- Exp Modal -->
<div class="modal fade" id="expModal" tabindex="-1" aria-labelledby="ExpModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="expForm">
        @csrf
        <input type="hidden" id="trip_id" name="trip_id" value="">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add POD Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="mb-3">
                <label for="toll_charges" class="form-label">Toll Charges</label>
                <input type="text" class="form-control calc-field" id="toll_charges" name="toll_charges">
                 <span class="text-danger invalid toll_charges_err"></span>
            </div>
            <div class="mb-3">
                <label for="loading_unloading_charges" class="form-label">Loading / Unloading Charges</label>
                <input type="text" class="form-control calc-field" id="loading_unloading_charges" name="loading_unloading_charges">
                 <span class="text-danger invalid loading_unloading_charges_err"></span>
            </div>
            <div class="mb-3">
                <label for="handing_charges" class="form-label">Handing Charges</label>
                <input type="text" class="form-control calc-field" id="handing_charges" name="handing_charges">
                 <span class="text-danger invalid handing_charges_err"></span>
            </div>
            <div class="mb-3">
                <label for="holding_charges" class="form-label">Holding Charges</label>
                <input type="text" class="form-control calc-field" id="holding_charges" name="holding_charges">
                 <span class="text-danger invalid holding_charges_err"></span>
            </div>
            <div class="mb-3">
                <label for="holding_days" class="form-label">Holding Days</label>
                <input type="text" class="form-control" id="holding_days" name="holding_days">
                 <span class="text-danger invalid holding_days_err"></span>
            </div>
            <div class="mb-3">
                <label for="other_exp" class="form-label">Other Exp</label>
                <input type="text" class="form-control calc-field" id="other_exp" name="other_exp">
                 <span class="text-danger invalid other_exp_err"></span>
            </div>
            <div class="mb-3">
                <label for="total_exp" class="form-label">Total Exp</label>
                <input type="text" class="form-control" id="total_exp" name="total_exp" readonly>
                 <span class="text-danger invalid total_exp_err"></span>
            </div>

            

          </div>
          <div class="modal-footer">
            <button type="submit" id="expSubmit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
    </form>
  </div>
</div>



</x-admin.layout>




{{-- Add --}}
<script>
function calculateTotal(context) {
    let toll = parseFloat($(context).find("[name='toll_charges']").val()) || 0;
    let loading = parseFloat($(context).find("[name='loading_unloading_charges']").val()) || 0;
    let handing = parseFloat($(context).find("[name='handing_charges']").val()) || 0;
    let holdingCharge = parseFloat($(context).find("[name='holding_charges']").val()) || 0;
    let holdingDays = parseFloat($(context).find("[name='holding_days']").val()) || 0;
    let other = parseFloat($(context).find("[name='other_exp']").val()) || 0;

    let total = toll + loading + handing + other + (holdingCharge * holdingDays);

    $(context).find("[name='total_exp']").val(total.toFixed(2));
}

// Works for both add/edit forms
$(document).on("keyup change", ".calc-field", function () {
    let form = $(this).closest("form"); 
    calculateTotal(form);
});
    // Open POD modal
$("#buttons-datatables").on("click", ".pod-element", function(e) {
    e.preventDefault();
    var tripId = $(this).data("id");
    $("#pod_trip_id").val(tripId); // store trip id in hidden field
    $("#podForm")[0].reset();
    $("#podModal").modal('show');
});
    // Open EXp modal
$("#buttons-datatables").on("click", ".exp-element", function(e) {
    e.preventDefault();
    var tripId1 = $(this).data("trip_id");  // ✅ now works
    $("#trip_id").val(tripId1); 
    $("#expForm")[0].reset();
    $("#expModal").modal('show');   
});
    function resetErrors() {
        $('.invalid').text('');
    }

    function printErrMsg(msg) {
        $.each(msg, function(key, value) {
            $('.' + key + '_err').text(value[0]);
        });
    }

    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('trip-movement.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('trip-movement.index') }}';
                    });
                else
                    swal("Error!", data.error2, "error");
            },
            statusCode: {
                422: function(responseObject, textStatus, jqXHR) {
                    $("#addSubmit").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function(responseObject, textStatus, errorThrown) {
                    $("#addSubmit").prop('disabled', false);
                    swal("Error occured!", "Something went wrong please try again", "error");
                }
            }
        });

    });
    $("#podForm").submit(function(e) {
        e.preventDefault();
        $("#podSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('trip-movement-pod.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('trip-movement.index') }}';
                    });
                else
                    swal("Error!", data.error2, "error");
            },
            statusCode: {
                422: function(responseObject, textStatus, jqXHR) {
                    $("#podSubmit").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function(responseObject, textStatus, errorThrown) {
                    $("#podSubmit").prop('disabled', false);
                    swal("Error occured!", "Something went wrong please try again", "error");
                }
            }
        });

    });
    $("#expForm").submit(function(e) {
        e.preventDefault();
        $("#expSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('trip-exp-detail.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                            window.location.href = '{{ route('trip-movement.index') }}';
                    });
                else
                    swal("Error!", data.error2, "error");
            },
            statusCode: {
                422: function(responseObject, textStatus, jqXHR) {
                    $("#expSubmit").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function(responseObject, textStatus, errorThrown) {
                    $("#expSubmit").prop('disabled', false);
                    swal("Error occured!", "Something went wrong please try again", "error");
                }
            }
        });

    });
</script>


<!-- Edit -->
<script>
$("#buttons-datatables").on("click", ".edit-element", function(e) {
    e.preventDefault();
    var model_id = $(this).attr("data-id");
    var url = "{{ route('trip-movement.edit', ':model_id') }}";

    $.ajax({
        url: url.replace(':model_id', model_id),
        type: 'GET',
        data: { '_token': "{{ csrf_token() }}" },
        success: function(data) {
            if (!data.error) {
                let trip = data.trip_movement;
                let exp  = data.exp_detail;

                $("#editForm input[name='edit_model_id']").val(trip.id);

                // Fill trip fields
                $("#edit_trip_date").val(trip.trip_date);
                $("#edit_vehicle_no").val(trip.vehicle_no);
                $("#edit_vehicle_type_id").val(trip.vehicle_type_id);
                $("#edit_origin").val(trip.origin);
                $("#edit_destination").val(trip.destination);
                $("#edit_rate").val(trip.rate);
                $("#edit_client_id").val(trip.client_id);
                $("#edit_driver_id").val(trip.driver_id);
                $("#edit_remark").val(trip.remark);

                // POD fields
                if (trip.pod_no || trip.pod_document) {
                    $("#pod_header, #pod_hr, .pod_field").show();
                    $("#edit_pod_no").val(trip.pod_no ?? '');
                    if (trip.pod_document) {
                        $("#edit_pod_document_view").attr("href", "/storage/" + trip.pod_document).show();
                    } else {
                        $("#edit_pod_document_view").hide();
                    }
                } else {
                    $("#pod_header, #pod_hr, .pod_field, #edit_pod_document_view").hide();
                }

                // Expense fields
                if (exp) {
                    $("#exp_header, #exp_hr, .exp_field").show();
                    $("#edit_toll_charges").val(exp.toll_charges ?? '');
                    $("#edit_loading_unloading_charges").val(exp.loading_unloading_charges ?? '');
                    $("#edit_handing_charges").val(exp.handing_charges ?? '');
                    $("#edit_holding_charges").val(exp.holding_charges ?? '');
                    $("#edit_holding_days").val(exp.holding_days ?? '');
                    $("#edit_other_exp").val(exp.other_exp ?? '');
                    $("#edit_total_exp").val(exp.total_exp ?? '');
                } else {
                    $("#exp_header, #exp_hr, .exp_field").hide();
                }

                $("#editContainer").show();
            } else {
                alert(data.error);
            }
        },
        error: function() {
            alert("Something went wrong");
        }
    });
});

</script>



<!-- Update -->
<script>
    $(document).ready(function() {
        $("#editForm").submit(function(e) {
            e.preventDefault();
            $("#editSubmit").prop('disabled', true);
            var formdata = new FormData(this);
            formdata.append('_method', 'PUT');
            var model_id = $('#edit_model_id').val();
            var url = "{{ route('trip-movement.update', ':model_id') }}";
            //
            $.ajax({
                url: url.replace(':model_id', model_id),
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#editSubmit").prop('disabled', false);
                    if (!data.error2)
                        swal("Successful!", data.success, "success")
                        .then((action) => {
                            window.location.href = '{{ route('trip-movement.index') }}';
                        });
                    else
                        swal("Error!", data.error2, "error");
                },
                statusCode: {
                    422: function(responseObject, textStatus, jqXHR) {
                        $("#editSubmit").prop('disabled', false);
                        resetErrors();
                        printErrMsg(responseObject.responseJSON.errors);
                    },
                    500: function(responseObject, textStatus, errorThrown) {
                        $("#editSubmit").prop('disabled', false);
                        swal("Error occured!", "Something went wrong please try again", "error");
                    }
                }
            });

        });
    });
</script>


<!-- Delete -->
<script>
    $("#buttons-datatables").on("click", ".rem-element", function(e) {
        e.preventDefault();
        swal({
                title: "Are you sure to delete this trip movement?",
                // text: "Make sure if you have filled Vendor details before proceeding further",
                icon: "info",
                buttons: ["Cancel", "Confirm"]
            })
            .then((justTransfer) => {
                if (justTransfer) {
                    var model_id = $(this).attr("data-id");
                    var url = "{{ route('trip-movement.destroy', ':model_id') }}";

                    $.ajax({
                        url: url.replace(':model_id', model_id),
                        type: 'POST',
                        data: {
                            '_method': "DELETE",
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function(data, textStatus, jqXHR) {
                            if (!data.error && !data.error2) {
                                swal("Success!", data.success, "success")
                                    .then((action) => {
                                        window.location.reload();
                                    });
                            } else {
                                if (data.error) {
                                    swal("Error!", data.error, "error");
                                } else {
                                    swal("Error!", data.error2, "error");
                                }
                            }
                        },
                        error: function(error, jqXHR, textStatus, errorThrown) {
                            swal("Error!", "Something went wrong", "error");
                        },
                    });
                }
            });
    });
</script>
