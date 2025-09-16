<x-admin.layout>
    <x-slot name="title">Invoice Fix Master</x-slot>
    <x-slot name="heading">Invoice Fix Master</x-slot>

   <!-- Add Form -->
    <div class="row" id="addContainer">
        <div class="col-sm-12">
            <div class="card">
                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label for="filter_client" class="form-label">Select Client</label>
                                <select id="filter_client" name="clientmaster_id" class="form-control" {{ $readonly ? 'disabled' : '' }}>
                                    <option value="">All Clients</option>
                                    @foreach($clientmasters as $client)
                                        <option value="{{ $client->id }}" 
                                            {{ isset($fixvehicleclient) && $fixvehicleclient->clientmaster_id == $client->id ? 'selected' : '' }}>
                                            {{ $client->client_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" name="start_date" id="start_date" 
                                       value="{{ isset($fixvehicleclient) ? $fixvehicleclient->start_date : '' }}"
                                       {{ $readonly ? 'readonly' : '' }}>
                                <span class="text-danger invalid start_date_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" name="end_date" id="end_date" 
                                       value="{{ isset($fixvehicleclient) ? $fixvehicleclient->end_date : '' }}"
                                       {{ $readonly ? 'readonly' : '' }}>
                                <span class="text-danger invalid end_date_err"></span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <h4 class="card-title">Invoice Add Vehicle Details</h4>

                        @if(!$readonly)
                            <button type="button" class="btn btn-primary" id="addVehicleBtn">Add Vehicle</button>
                            <br><br>
                        @endif

                        <div id="vehicleContainer">
                            @if(isset($fixvehicleclient) && $fixvehicleclient->fixvehicles->count())
                                @foreach($fixvehicleclient->fixvehicles as $vehicleData)
                                    <div class="mb-3 row vehicle-row">
                                        <div class="col-md-3">
                                            <label class="form-label">Select Vehicle Number</label>
                                            <select class="form-control" name="self_vehicle_id[]" {{ $readonly ? 'disabled' : '' }}>
                                                <option value="">All Vehicles</option>
                                                @foreach($VehicleNo as $vehicle)
                                                    <option value="{{ $vehicle->id }}" 
                                                        {{ $vehicleData->self_vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                                        {{ $vehicle->vehicle_number }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Select Vehicle Type</label>
                                            <select class="form-control" name="vehical_type[]" {{ $readonly ? 'disabled' : '' }}>
                                                <option value="">..select type..</option>
                                                @foreach($VehicleTypeMaster as $type)
                                                    <option value="{{ $type->id }}" 
                                                        {{ $vehicleData->vehical_type == $type->id ? 'selected' : '' }}>
                                                        {{ $type->type_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">Fixed KM / Month</label>
                                            <input type="number" class="form-control" name="fixed_km[]" 
                                                value="{{ $vehicleData->fixed_km }}" {{ $readonly ? 'readonly' : '' }}>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">Fixed Price (₹)</label>
                                            <input type="number" class="form-control" name="fixed_price[]" 
                                                value="{{ $vehicleData->fixed_price }}" {{ $readonly ? 'readonly' : '' }}>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">Extra KM Rate (₹)</label>
                                            <input type="number" class="form-control" name="extra_km_rate[]" 
                                                value="{{ $vehicleData->extra_km_rate }}" {{ $readonly ? 'readonly' : '' }}>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                {{-- Show one empty row for create --}}
                                <div class="mb-3 row vehicle-row">
                                    <div class="col-md-3">
                                        <label class="form-label">Select Vehicle Number</label>
                                        <select class="form-control" name="self_vehicle_id[]" {{ $readonly ? 'disabled' : '' }}>
                                            <option value="">All Vehicles</option>
                                            @foreach($VehicleNo as $vehicle)
                                                <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_number }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Select Vehicle Type</label>
                                        <select class="form-control" name="vehical_type[]" {{ $readonly ? 'disabled' : '' }}>
                                            <option value="">..select type..</option>
                                            @foreach($VehicleTypeMaster as $type)
                                                <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Fixed KM / Month</label>
                                        <input type="number" class="form-control" name="fixed_km[]" {{ $readonly ? 'readonly' : '' }}>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Fixed Price (₹)</label>
                                        <input type="number" class="form-control" name="fixed_price[]" {{ $readonly ? 'readonly' : '' }}>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Extra KM Rate (₹)</label>
                                        <input type="number" class="form-control" name="extra_km_rate[]" {{ $readonly ? 'readonly' : '' }}>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if(!$readonly)
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success" id="addSubmit">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    @else
                    <div class="card-footer">                            
                        <a href="{{ route('invoicefixmaster.index') }}">
                        <button type="button" class="btn btn-warning">Back</button>
                        </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-admin.layout>

@if(!$readonly)
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
@endif
