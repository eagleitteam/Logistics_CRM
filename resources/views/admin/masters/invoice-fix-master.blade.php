<x-admin.layout>
    <x-slot name="title">Invoice Fix Master</x-slot>
    <x-slot name="heading">Invoice Fix Master</x-slot>

   <!-- Add Form -->
    <div class="row" id="addContainer" style="display:none;">
        <div class="col-sm-12">
            <div class="card">
                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label for="filter_client" class="form-label">Select Client</label>
                                <select id="filter_client" name="clientmaster_id" class="form-control">
                                    <option value="">All Clients</option>
                                    @foreach($clientmasters as $client)
                                        <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" name="start_date" id="start_date" required>
                                <span class="text-danger invalid start_date_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" name="end_date" id="end_date" required>
                                <span class="text-danger invalid end_date_err"></span>
                            </div>
                            
                        </div>

                    </div>
                        <div class="card-body">
                            <h4 class="card-title">Invoice Add Vehicle Details</h4>
                            <button type="button" class="btn btn-primary" id="addVehicleBtn">Add Vehicle</button>
                            <br><br>

                            <div id="vehicleContainer">
                                <!-- First (compulsory) row - remove btn नाही -->
                                <div class="mb-3 row vehicle-row">
                                    <div class="col-md-3">
                                        <label class="form-label">Select Vehicle Number</label>
                                        <select class="form-control" name="self_vehicle_id[]">
                                            <option value="">All Vehicles</option>
                                            @foreach($VehicleNo as $vehicle)
                                                <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Select Vehicle Type</label>
                                        <select class="form-control" name="vehical_type[]">
                                            <option value="">..select type..</option>
                                            @foreach($VehicleTypeMaster as $type)
                                                <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Fixed KM / Month</label>
                                        <input type="number" class="form-control" name="fixed_km[]" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Fixed Price (₹)</label>
                                        <input type="number" class="form-control" name="fixed_price[]" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Extra KM Rate (₹)</label>
                                        <input type="number" class="form-control" name="extra_km_rate[]" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success" id="addSubmit">Submit</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

 
    {{-- view Form --}}
<div class="row" id="editContainer" style="display:none;">
    <div class="col-sm-12">
        <div class="card">
            <form class="theme-form" id="editForm" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="mb-3 row">
                        <div class="col-md-4">
                            <label for="view_client" class="form-label">Select Client</label>
                            <select id="view_client" name="clientmaster_id" class="form-control" disabled>
                                <option value="">All Clients</option>
                                @foreach($clientmasters as $client)
                                    <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="view_start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date" id="view_start_date" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="view_end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" name="end_date" id="view_end_date" readonly>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <h4 class="card-title">Invoice Vehicle Details</h4>
                    <div id="viewVehicleContainer">
                        <!-- vehicle rows will be appended dynamically -->
                    </div>
                </div>

                <div class="card-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeView()">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @can('invoicefixmaster.create')
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
                @endcan
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Client Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Vehicle Count</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fixvehicleclients  as $fixvehicleclients )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $fixvehicleclients->clientmaster_id}}</td>
                                        <td>{{ $fixvehicleclients->start_date}}</td>
                                        <td>{{ $fixvehicleclients->end_date}}</td>
                                        <td>{{ $fixvehicleclients->fixvehicles_count}}</td>

                                        <td>
                                            @can('invoicefixmaster.edit')
                                                <button class="edit-element btn btn-secondary " title="View Invoice Fix Master" data-id="{{ $fixvehicleclients->id }}"><i data-feather="eye"></i></button>
                                            @endcan
                                            @can('invoicefixmaster.delete')
                                                <button class="btn btn-danger rem-element px-2 py-1" title="Delete Invoice Fix Master" data-id="{{ $fixvehicleclients->id }}"><i data-feather="trash-2"></i> </button>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin.layout>

<script>
    // Add Vehicle Row
    document.getElementById('addVehicleBtn').addEventListener('click', function() {
        let container = document.getElementById('vehicleContainer');
        let firstRow = container.querySelector('.vehicle-row');

        // clone first row
        let newRow = firstRow.cloneNode(true);

        // Reset input & select values
        newRow.querySelectorAll('input').forEach(input => input.value = "");
        newRow.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

        // Add remove button फक्त new rows मध्ये
        if (!newRow.querySelector('.removeRow')) {
            let removeCol = document.createElement('div');
            removeCol.className = "col-md-1 d-flex align-items-end";
            removeCol.innerHTML = `<button type="button" class="btn btn-danger btn-sm removeRow">X</button>`;
            newRow.appendChild(removeCol);
        }

        container.appendChild(newRow);
    });

    // Remove Vehicle Row (except first row)
    document.addEventListener('click', function(e) {
        if(e.target.classList.contains('removeRow')){
            e.target.closest('.vehicle-row').remove();
        }
    });
</script>

{{-- Add --}}
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('invoicefixmaster.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('invoicefixmaster.index') }}';
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
        var url = "{{ route('invoicefixmaster.edit', ':model_id') }}";

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'GET',
            data: {
                '_token': "{{ csrf_token() }}",
                'model_id': model_id
            },
            success: function(data, textStatus, jqXHR) {
                editFormBehaviour();
                if (!data.error) {
                    $("#editForm input[name='edit_model_id']").val(data.fixvehicleclients.id);
                    $("#editForm select[name='clientmaster_id']").val(data.fixvehicleclients.clientmaster_id);
                    $("#editForm input[name='start_date']").val(data.fixvehicleclients.start_date);
                    $("#editForm input[name='end_date']").val(data.fixvehicleclients.end_date);
                    $("#editForm select[name='self_vehicle_id']").val(data.fixvehicleclients.self_vehicle_id);
                    $("#editForm select[name='vehical_type']").val(data.fixvehicleclients.vehical_type);
                    $("#editForm input[name='fixed_km']").val(data.fixvehicleclients.fixed_km);
                    $("#editForm input[name='fixed_price']").val(data.fixvehicleclients.fixed_price);
                    $("#editForm input[name='extra_km_rate']").val(data.fixvehicleclients.extra_km_rate);
                } else {
                    alert(data.error);
                }
            },
            error: function(error, jqXHR, textStatus, errorThrown) {
                alert("Something went wrong");
            },
        });
    });
</script>


<!-- Delete -->
<script>
    $("#buttons-datatables").on("click", ".rem-element", function(e) {
        e.preventDefault();
        swal({
                title: "Are you sure to delete this Year Master?",
                icon: "warning",
                buttons: ["Cancel", "Confirm"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var model_id = $(this).attr("data-id");
                    var url = "{{ route('invoicefixmaster.destroy', ':model_id') }}";

                    $.ajax({
                        url: url.replace(':model_id', model_id),
                        type: 'POST',
                        data: {
                            '_method': "DELETE",
                            '_token': "{{ csrf_token() }}",
                            'model_id': model_id
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

