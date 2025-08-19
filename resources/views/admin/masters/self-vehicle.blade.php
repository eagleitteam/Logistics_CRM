<x-admin.layout>
    <x-slot name="title">Self Vehical's Master</x-slot>
    <x-slot name="heading">Self Vehical's Master</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


    <!-- Add Form -->
    <div class="row" id="addContainer" style="display:none;">
        <div class="col-sm-12">
            <div class="card">
                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3 row">

                        <div class="col-md-4">
                                <label for="FormSelectBankType" class="form-label">Type<span
                                        class="text-danger">*</span></label>
                                <select id="type"  name="type" class="form-select" data-choices
                                    data-choices-sorting="true">
                                    <option>Select Type</option>
                                    <option value="1">Self</option>
                                    <option value="2">Vendor</option>
                                </select>
                                <span class="text-danger invalid type_err"></span>
                            </div>

                             <div class="col-md-4">
                                <label class="form-label" for="vehicle_number">Vehicle Number <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" id="vehicle_number" name="vehicle_number" type="text"
                                    placeholder="Enter Vehicle Number">
                                <span class="text-danger invalid vehicle_number_err"></span>
                            </div>

                            <!-- vendor details -->
                             <div class="row vendor-fields d-none md-4">
                            <div class="col-md-4">
                                <label class="col-form-label" for="vendor_name">Vendor Name <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" id="vendor_name" name="vendor_name" type="text"
                                    placeholder="Enter Vehicle Number">
                                <span class="text-danger invalid vendor_name_err"></span>
                            </div>

                               <div class="col-md-4">
                                <label for="FormSelectBankType" class="col-form-label">Status<span
                                        class="text-danger">*</span></label>
                                <select id="status_type"  name="status" class="form-select" data-choices
                                    data-choices-sorting="true">
                                    <option>Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="2">Mintenance</option>
                                    <option value="3">Inactive</option>
                                </select>
                                <span class="text-danger invalid status_err"></span>
                            </div>
                        </div>

                            <!-- self details -->
                             <div class="row self-fields d-none md-4">
                            <div class="col-md-4">
                                <label class="col-form-label" for="name">Select Vehical Type<span class="text-danger">*</span></label>
                                <select class="form-control" id="vehicle_id" name="vehicle_type_master_id" >
                                    <option value="">Select Vehical Type</option>
                                    @foreach ($vehicalTypes as $vehicalType)
                                        <option value="{{ $vehicalType->id }}">{{ $vehicalType->type_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger invalid vehicle_type_master_id_err"></span>
                            </div>

                            <div class="col-md-4">
                            <label for="fule_type" class="col-form-label">Fuel Type <span class="text-danger">*</span></label>
                            <select id="fule_type" name="fule_type" class="form-select" data-choices data-choices-sorting="true">
                            <option value="">Select from list</option>
                            <option value="1">Diesel</option>
                            <option value="2">CNG</option>
                            <option value="3">Electrical</option>
                            </select>
                            @error('fule_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="register_date" class="col-form-label">Register Date</label>
                                    <input type="date" class="form-control" id="register_date" name="register_date">
                                    <span class="text-danger invalid register_date_err"></span>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-4">
                                <label class="col-form-label" for="chassis_num">Chassis Number <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" id="chassis_num" name="chassis_num" type="text"
                                    placeholder="Enter Chassis Number">
                                <span class="text-danger invalid chassis_num_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="eng_num">Engine Number <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" id="eng_num" name="eng_num" type="text"
                                    placeholder="Enter Engine Number">
                                <span class="text-danger invalid eng_num_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="model_num">Model Number <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" id="model_num" name="model_num" type="text"
                                    placeholder="Enter Model Number">
                                <span class="text-danger invalid model_num_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="toll_stm">Toll STM Link With </label>
                                <input class="form-control" id="toll_stm" name="toll_stm" type="text"
                                    placeholder="Enter Refrance Toll STM Link With">
                                <span class="text-danger invalid toll_stm_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="remark">Remark </label>
                                <input class="form-control" id="remark" name="remark" type="text"
                                    placeholder="Enter Remarks">
                                <span class="text-danger invalid remark_err"></span>
                            </div>
                        

                            <br><br><br>
                            {{-- Start Tab Menu --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <header class="card-header">
                                        <h5 class="mb-3">Other Details tabs</h5>
                                    </header>
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="nav nav-pills arrow-navtabs nav-success bg-light mb-3 justify-content-between w-100"
                                                role="tablist">
                                                @foreach($SelfVehicleDOcument as $key => $document)
                                               <li class="nav-item" role="presentation">
                                                <a class="nav-link {{ $key === 0 ? 'active' : '' }}" 
                                                id="tab-{{ Str::slug($document->name, '-') }}-{{ $document->id }}" 
                                                data-bs-toggle="tab" 
                                                data-bs-target="#arrow-{{ Str::slug($document->name, '-') }}-{{ $document->id }}" 
                                                role="tab" 
                                                aria-controls="arrow-{{ Str::slug($document->name, '-') }}-{{ $document->id }}" 
                                                aria-selected="{{ $key === 0 ? 'true' : 'false' }}">
                                                {{ $document->name }}
                                                </a>

                                                </li>
                                                @endforeach
                                            </ul>
                                            <!-- Tab panes -->
                                           <div class="tab-content text-muted">
                                                @foreach($SelfVehicleDOcument as $key => $document1)
                                                <div class="tab-pane fade {{ $key === 0 ? 'show active' : '' }}" 
                                                id="arrow-{{ Str::slug($document1->name, '-') }}-{{ $document1->id }}" 
                                                role="tabpanel" 
                                                aria-labelledby="tab-{{ Str::slug($document1->name, '-') }}-{{ $document1->id }}">
                                                <!-- your form fields -->

                                                        
                                                        <div class="row">
                                                            <input type="hidden" name="documents[{{ $document1->id }}][tab_id]" value="{{ $document1->id }}">

                                                            <!-- Start Date -->
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{ $document1->name }} Start Date</label>
                                                                    <input type="date" 
                                                                        class="form-control" 
                                                                        id="{{ Str::slug($document1->name, '_') }}_start_date_{{ $document1->id }}" 
                                                                        name="documents[{{ $document1->id }}][start_date]">
                                                                    <span class="text-danger invalid documents[{{ $document1->id }}][start_date]_err"></span>                                                              
                                                                    </div>
                                                            </div>

                                                            <!-- End Date -->
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{ $document1->name }} End Date</label>
                                                                    <input type="date" 
                                                                        class="form-control" 
                                                                        id="{{ Str::slug($document1->name, '_') }}_end_date_{{ $document1->id }}" 
                                                                        name="documents[{{ $document1->id }}][end_date]">
                                                                        <span class="text-danger invalid documents[{{ $document1->id }}][end_date]_err"></span>                                                              
                                                                </div>
                                                            </div>

                                                            <!-- File Upload -->
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Upload {{ $document1->name }} Document (PDF)</label>
                                                                    <input class="form-control" 
                                                                        type="file" 
                                                                        id="{{ Str::slug($document1->name, '_') }}_file_{{ $document1->id }}" 
                                                                        name="documents[{{ $document1->id }}][file]">
                                                                 <span class="text-danger invalid documents[{{ $document1->id }}][file]_err"></span>                                                              
                                                                </div>
                                                            </div>

                                                            <!-- Extra field for Insurance -->
                                                            @if($document1->name == "Insurance")
                                                                <div class="col-md-4">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Insurance Company Name</label>
                                                                        <input type="text" 
                                                                            class="form-control" 
                                                                            id="insurance_company_name_{{ $document1->id }}" 
                                                                            name="documents[{{ $document1->id }}][company_name]">
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div>
                            </div>
                        </div>
                        <!--end col-->

                        {{-- End Tab Menu --}}
                    </div>

                
                <div class="card-footer">
                    <button type="submit" class="btn btn-success" id="addSubmit">Submit</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                </div>
            </form>
            </div>
        </div>
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
                        <table id="buttons-datatables" class="table table-bordered nowrap align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Vehical Number</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($SelfVehicle as $selfVehical)
                                    @php
                                       
                                        $fuelType = '';
                                        if($selfVehical->fule_type == 1)
                                            $fuelType = 'Diesel';
                                        elseif($selfVehical->fule_type == 2)
                                            $fuelType = 'CNG';
                                        elseif($selfVehical->fule_type == 3)
                                            $fuelType = 'Electric';
                                    @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <!-- <td>{{ $selfVehical?->vehicle_number }}</td> -->
                                    <td>{{ $selfVehical->vehicle_number }}</td>
                                    <td>{{ $selfVehical->type }}</td>
                                    <td>
                                         
                                        <button class="edit-element btn btn-secondary px-2 py-1" title="Edit Vehicle Entry"
                                            data-id="{{ $selfVehical->id }}"><i data-feather="edit"></i></button>
                                       
                                        <button class="btn btn-danger rem-element px-2 py-1" title="Delete Vehicle Entry"
                                            data-id="{{ $selfVehical->id }}"><i data-feather="trash-2"></i> </button>
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


{{-- Add --}}
<script>

    $(document).ready(function () {
    // Hide all extra fields initially
    $(".vendor-fields, .self-fields").addClass("d-none");

    $("#type").on("change", function () {
        let selected = $(this).val();

        // Hide all first
        $(".vendor-fields, .self-fields").addClass("d-none");

        if (selected === "1") { // Self
            $(".self-fields").removeClass("d-none");
        } else if (selected === "2") { // Vendor
            $(".vendor-fields").removeClass("d-none");
        }
    });
});


    $("#addForm").submit(function (e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('self-vehicle.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                        .then((action) => {
                            window.location.href = '{{ route('self-vehicle.index') }}';
                        });
                else
                    swal("Error!", data.error2, "error");
            },
            statusCode: {
                422: function (responseObject, textStatus, jqXHR) {
                    $("#addSubmit").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function (responseObject, textStatus, errorThrown) {
                    $("#addSubmit").prop('disabled', false);
                    swal("Error occured!", "Something went wrong please try again", "error");
                }
            }
        });

    });
</script>


<!-- Edit -->
<script>
    $("#buttons-datatables").on("click", ".edit-element", function (e) {
        e.preventDefault();
        var model_id = $(this).attr("data-id");
        var url = "{{ route('self-vehicle.edit', ':model_id') }}";

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'GET',
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function (data, textStatus, jqXHR) {
                           console.log(data); // check full response structure
    alert(JSON.stringify(data)); // show JSON response

                editFormBehaviour();
                if (!data.error) {
                  $("#editForm input[name='edit_model_id']").val(data.Selfvehicle.id);
                    $("#edit_vehicle_number").val(data.Selfvehicle.vehicle_number);
                    $("#edit_vehicle_type").val(data.Selfvehicle.vehicle_type.type_name);
                    $("#edit_fule_type").val(data.Selfvehicle.fule_type);
                    $("#edit_register_date").val(data.Selfvehicle.register_date);
                    $("#edit_chassis_num").val(data.Selfvehicle.chassis_num);
                    $("#edit_eng_num").val(data.Selfvehicle.eng_num);
                    $("#edit_model_num").val(data.Selfvehicle.model_num);
                    $("#edit_toll_stm").val(data.Selfvehicle.toll_stm);
                    $("#edit_remark").val(data.Selfvehicle.remark);


                } else {
                    alert(data.error);
                }
            },
            error: function (error, jqXHR, textStatus, errorThrown) {
                alert("Something went wrong");
            },
        });
    });
</script>


<!-- Update -->
<script>
    $(document).ready(function () {
        $("#editForm").submit(function (e) {
            e.preventDefault();
            $("#editSubmit").prop('disabled', true);
            var formdata = new FormData(this);
            formdata.append('_method', 'PUT');
            var model_id = $('#edit_model_id').val();
            var url = "{{ route('self-vehicle.update', ':model_id') }}";

            $.ajax({
                url: url.replace(':model_id', model_id),
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#editSubmit").prop('disabled', false);
                    if (!data.error2)
                        swal("Successful!", data.success, "success")
                            .then((action) => {
                                window.location.href = '{{ route('self-vehicle.index') }}';
                            });
                    else
                        swal("Error!", data.error2, "error");
                },
                statusCode: {
                    422: function (responseObject, textStatus, jqXHR) {
                        $("#editSubmit").prop('disabled', false);
                        resetErrors();
                        printErrMsg(responseObject.responseJSON.errors);
                    },
                    500: function (responseObject, textStatus, errorThrown) {
                        $("#editSubmit").prop('disabled', false);
                        swal("Error occurred!", "Something went wrong please try again", "error");
                    }
                }
            });
        });
    });
</script>


<!-- Delete -->
<script>
    $("#buttons-datatables").on("click", ".rem-element", function (e) {
        e.preventDefault();
        swal({
            title: "Are you sure to delete this vehicle type?",
            icon: "warning",
            buttons: ["Cancel", "Confirm"],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var model_id = $(this).attr("data-id");
                    var url = "{{ route('self-vehicle.destroy', ':model_id') }}";

                    $.ajax({
                        url: url.replace(':model_id', model_id),
                        type: 'POST',
                        data: {
                            '_method': "DELETE",
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function (data, textStatus, jqXHR) {
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
                        error: function (error, jqXHR, textStatus, errorThrown) {
                            swal("Error!", "Something went wrong", "error");
                        },
                    });
                }
            });
    });
</script>
