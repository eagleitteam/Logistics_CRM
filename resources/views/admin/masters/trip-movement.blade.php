<x-admin.layout>
    <x-slot name="title">Daily Trip Movement Entry</x-slot>
    <x-slot name="heading">Daily Trip Movement Entry</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


    <div class="row">
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
                                    <select class="form-control" id="vehicle_id" name="vehicle_id">
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
                                   
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                    
                                        <label for="destinationinput" class="col-form-label">Destination</label>
                                        <input type="text" class="form-control" placeholder="Destination" id="destinationinput" name="destination">
                                    
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                    
                                        <label for="rateinput" class="col-form-label">Trip Rate</label>
                                        <input type="number" class="form-control" placeholder="Trip Rate" id="rateinput" name="rate">
                                    
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
                                    <span class="text-danger invalid client_id_err"></span>
                                </div>
                                <!--end col-->
                                <div class="col-md-2">
                                        <label for="driveAllowanceInput" class="col-form-label">Driver Allowance(As per Trip)</label>
                                        <input type="number" class="form-control" placeholder="Driver Allowance" id="driveAllowanceInput" name="per_day_allow">              
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





</x-admin.layout>


{{-- Add --}}
<script>
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
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function(data, textStatus, jqXHR) {
                editFormBehaviour();
                if (!data.error) {
                    $("#editForm input[name='edit_model_id']").val(data.ward.id);
                    $("#editForm input[name='name']").val(data.ward.name);
                    $("#editForm input[name='initial']").val(data.ward.initial);
                } else {
                    alert(data.error);
                }
            },
            error: function(error, jqXHR, textStatus, errorThrown) {
                alert("Some thing went wrong");
            },
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
                title: "Are you sure to delete this ward?",
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
