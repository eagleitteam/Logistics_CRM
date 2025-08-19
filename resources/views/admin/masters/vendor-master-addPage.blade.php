<x-admin.layout>
    <x-slot name="title">Add vendor Master</x-slot>
    <x-slot name="heading">Add vendor Master11</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}

    <style>
        .hidden-placeholder {
            visibility: hidden;
            position: absolute;
        }
    </style>

    <!-- Add Form -->
    <div class="row" id="addContainer" style="display:none;">
        <div class="col-sm-12">
            <div class="card">
                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="mb-3 row">
                            <!-- Category & Related Dropdowns in one line -->
                            <div class="mb-3 row align-items-end">
                                {{-- Category Selection --}}
                                <div class="col-md-6">
                                    <label for="Master_Category" class="form-label">Category</label>
                                    <select class="form-select" name="master_group_Category" id="master_group_id_ledger">
                                        <option value="">Select Group</option>
                                        <option value="3">Master Group</option>
                                        <option value="2">Group Group</option>
                                        <option value="1">Sub-Group Group</option>
                                    </select>
                                    <span class="text-danger invalid Master_Category_err"></span>
                                </div>

                                {{-- Master Group --}}
                                <div class="col-md-6 d-none" id="mastergroup_dropdown">
                                    <label class="form-label">Select Master Group</label>
                                    <select class="form-select" name="master_id" id="master_id">
                                        <option value="">Select Master Group</option>
                                        @foreach($masterGroups as $masterGroup)
                                            <option value="{{ $masterGroup->id }}"
                                                    data-master="{{ $masterGroup->master_id }}"
                                                    data-master-name="{{ $masterGroup->mastergroup->group_name ?? '' }}">
                                                {{ $masterGroup->master_group_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Group Dropdown --}}
                                <div class="col-md-6 d-none" id="group_dropdown">
                                    <label class="form-label">Group List</label>
                                    <select class="form-select" name="group_id" id="group_id">
                                        <option value="">Select Group</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}"
                                                    data-master="{{ $group->master_id }}"
                                                    data-master-name="{{ $group->mastergroup->group_name ?? '' }}">
                                                {{ $group->group_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Sub-Group Dropdown --}}
                                <div class="col-md-6 d-none" id="subgroup_dropdown">
                                    <label class="form-label">Sub-Group List</label>
                                    <select class="form-select" name="subgroup_id" id="subgroup_id_1">
                                        <option value="">Select Sub-Group</option>
                                        @foreach($subgroups as $subgroup)
                                            <option value="{{ $subgroup->id }}" data-master="{{ $subgroup->master_id }}">
                                                {{ $subgroup->subGroup_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="col-form-label">Vendor Company Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="Company Name" id="name">
                                    <span class="text-danger invalid name_err"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gstNoInput" class="form-label">GST NO <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="gst_no" placeholder="15 No GST Code -22AAAAA0000A1Z5" id="gstNoInput"  >
                                    <span class="text-danger invalid gst_no_err"></span>

                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contactPersonInput" class="form-label">Contact Person Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="contact_name" placeholder="Contact Person Name" id="contactPersonInput" >
                                    
                                    <span class="text-danger invalid contact_name_err"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contactNoInput" class="form-label">Contact Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="contact_no" placeholder="Contact Number" id="contactNoInput" >        
                                    <span class="text-danger invalid contact_no_err"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="altContactInput" class="form-label">Alternate Contact Number</label>
                                    <input type="tel" class="form-control" name="alternate_contact_no" placeholder="Alternate Contact Number" id="altContactInput" >
                                    
                                    <span class="text-danger invalid alternate_contact_no_err"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" placeholder="example@gmail.com" id="emailInput" >
                                    
                                    <span class="text-danger invalid email_err"></span>
                                </div>
                            </div>

                            <!-- Address Information -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="addressInput" class="form-label">Full Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="vendor_address" placeholder="Full Address" id="addressInput" >
                                    
                                    <span class="text-danger invalid vendor_address_err"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cityInput" class="form-label">City <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="city" placeholder="Enter your city" id="cityInput" >
                                    
                                    <span class="text-danger invalid city_err"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pinCodeInput" class="form-label">PIN Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pincode" placeholder="Pin Code" id="pinCodeInput" >
                                    
                                    <span class="text-danger invalid pincode_err"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="stateInput" class="form-label">State <span class="text-danger">*</span></label>
                                    <select id="stateInput" class="form-select" name="state" >
                                        <option value="" selected disabled>Choose...</option>
                                        @foreach ($statemasters as $statemasters)
                                                <option value="{{ optional($statemasters)->id }}">{{ optional($statemasters)->stateName }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>

                            <!-- TDS Information -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="tdsApplicableInput" class="form-label">TDS Applicable <span class="text-danger">*</span></label>
                                    <select id="tdsApplicableInput" class="form-select" name="tds_applicable" >
                                        <option value="" selected >Choose...</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    <span class="text-danger invalid tds_applicable_err"></span>
                                    
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="tdsRateInput" class="form-label">TDS %</label>
                                    <input type="number" class="form-control" name="tds_rate" placeholder="TDS %" id="tdsRateInput" min="0" max="100" step="0.01">
                                    
                                    <span class="text-danger invalid tds_rate_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                    <label for="recincomeamt" class="form-label">Opening AMT</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="openingamt"
                                        name="opening_amt"
                                        placeholder="Enter Opening Amount"
                                    />
                                </div>
                                <div class="col-md-4">
                                    <label for="tranDate" class="form-label">DR / CR</label>
                                    <select class="form-select" name="dr_cr" id="dr_cr">
                                            <option value="">Select...</option>
                                            <option value="1">Debit</option>
                                            <option value="2">Credit</option>
                                        </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="status-field" class="form-label">Opening Year</label>
                                    <select class="form-select" name="year" id="opening_year">
                                        <option value="">Select...</option>
                                        @foreach($yearmasters as $yearmasters)
                                                <option value="{{ $yearmasters->id }}">{{ $yearmasters->title }}</option>
                                            @endforeach
                                    </select>
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



    {{-- Edit Form --}}
    <div class="row" id="editContainer" style="display:none;">
        <div class="col">
            <form class="form-horizontal form-bordered" method="post" id="editForm">
                @csrf
                <section class="card">
                    <header class="card-header">
                        <h4 class="card-title">Edit Vendor Master</h4>
                    </header>

                    <div class="card-body py-2">

                        <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="col-form-label">Company Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="Company Name" id="name">
                                    <span class="text-danger invalid name_err"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gstNoInput" class="form-label">GST NO <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="gst_no" placeholder="22AAAAA0000A1Z5" id="gstNoInput"  >
                                    <span class="text-danger invalid gst_no_err"></span>

                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contactPersonInput" class="form-label">Contact Person Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="contact_name" placeholder="Contact Person Name" id="contactPersonInput" >
                                    <div class="invalid-feedback">Please provide contact person name.</div>
                                    <span class="text-danger invalid contact_name_err"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contactNoInput" class="form-label">Contact Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="contact_no" placeholder="Contact Number" id="contactNoInput" >
                                    <div class="invalid-feedback">Please provide a valid 10-digit mobile number.</div>
                                    <span class="text-danger invalid contact_no_err"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="altContactInput" class="form-label">Alternate Contact Number</label>
                                    <input type="tel" class="form-control" name="alternate_contact_no" placeholder="Alternate Contact Number" id="altContactInput" >
                                    <div class="invalid-feedback">Please provide a valid 10-digit mobile number.</div>
                                    <span class="text-danger invalid alternate_contact_no_err"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" placeholder="example@gmail.com" id="emailInput" >
                                    <div class="invalid-feedback">Please provide a valid email address.</div>
                                    <span class="text-danger invalid email_err"></span>
                                </div>
                            </div>

                            <!-- Address Information -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="addressInput" class="form-label">Full Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="vendor_address" placeholder="Address" id="addressInput" >
                                    <div class="invalid-feedback">Please provide the full address.</div>
                                    <span class="text-danger invalid vendor_address_err"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cityInput" class="form-label">City <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="city" placeholder="Enter your city" id="cityInput" >
                                    <div class="invalid-feedback">Please provide the city name.</div>
                                    <span class="text-danger invalid city_err"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pinCodeInput" class="form-label">PIN Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pincode" placeholder="Pin Code" id="pinCodeInput" >
                                    <div class="invalid-feedback">Please provide a valid 6-digit PIN code.</div>
                                    <span class="text-danger invalid pincode_err"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="stateInput" class="form-label">State <span class="text-danger">*</span></label>
                                    <select id="stateInput" class="form-select" name="state">
                                        <option value="" >Choose...</option>
                                        @foreach ($StateNameWithCode as $state)
                                            <option value="{{ optional($state)->id }}">{{ optional($state)->stateName }}</option>
                                            
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Please select a state.</div>
                                </div>
                            </div>

                            <!-- TDS Information -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="tdsApplicableInput" class="form-label">TDS Applicable <span class="text-danger">*</span></label>
                                    <select id="tdsApplicableInput" class="form-select" name="tds_applicable" >
                                        <option value="" selected >Choose...</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    <span class="text-danger invalid tds_applicable_err"></span>
                                    <div class="invalid-feedback">Please select TDS applicability.</div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="tdsRateInput" class="form-label">TDS %</label>
                                    <input type="number" class="form-control" name="tds_rate" placeholder="TDS %" id="tdsRateInput" min="0" max="100" step="0.01">
                                    <div class="invalid-feedback">TDS rate must be between 0 and 100.</div>
                                    <span class="text-danger invalid tds_rate_err"></span>
                                </div>
                            </div>
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
                @can('vendormaster.create')
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
                                    <th>Company Name</th>
                                    <th>GST No.</th>
                                    <th>TDS %</th>
                                    <th>Contact Person Name</th>
                                    <th>Contact Person NO</th>
                                    <th>Alternate No</th>
                                    <th>Email Id</th>
                                    <th>City</th>
                                    <th>Pin Code</th>
                                    <th>State</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vendormasters as $vendormasters)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $vendormasters->name }}</td>
                                        <td>{{ $vendormasters->gst_no }}</td>
                                        <td>{{ $vendormasters->tds_rate }}</td>
                                        <td>{{ $vendormasters->contact_name }}</td>
                                        <td>{{ $vendormasters->contact_no }}</td>
                                        <td>{{ $vendormasters->alternate_contact_no }}</td>
                                        <td>{{ $vendormasters->email }}</td>
                                        <td>{{ $vendormasters->city }}</td>
                                        <td>{{ $vendormasters->pincode }}</td>
                                        <td>{{ $vendor->states->stateName }}</td>
                                        <td>
                                            @can('vendormaster.edit')
                                                <button class="edit-element btn btn-secondary px-2 py-1" title="Edit Vendor" data-id="{{ $vendormasters->id }}"><i data-feather="edit"></i></button>
                                            @endcan
                                            @can('vendormaster.delete')
                                                <button class="btn btn-danger rem-element px-2 py-1" title="Delete Vendor" data-id="{{ $vendormasters->id }}"><i data-feather="trash-2"></i> </button>
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
    $(document).ready(function () {
        // Category dropdown change
        $('#master_group_id_ledger').on('change', function () {
            const selected = $(this).val();

            // Hide all first
            $('#mastergroup_dropdown, #group_dropdown, #subgroup_dropdown').addClass('d-none');

            // Reset all values
            $('#master_id, #group_id, #subgroup_id_1').val('');

            // Show relevant dropdown based on selected category
            if (selected == '1') {
                $('#subgroup_dropdown').removeClass('d-none');
            } else if (selected == '2') {
                $('#group_dropdown').removeClass('d-none');
            } else if (selected == '3') {
                $('#mastergroup_dropdown').removeClass('d-none');
            }
        });

        // Set master_id from Group dropdown
        $('#group_id').on('change', function () {
            const masterId = $(this).find(':selected').data('master') || '';
            $('#master_id').val(masterId);
        });

        // Set master_id from Subgroup dropdown
        $('#subgroup_id_1').on('change', function () {
            const masterId = $(this).find(':selected').data('master') || '';
            $('#master_id').val(masterId);
        });
    });
</script>



{{-- Add --}}
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('vendor-master.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('vendor-master.index') }}';
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
        var url = "{{ route('vendor-master.edit', ':model_id') }}";

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
                    $("#editForm input[name='edit_model_id']").val(data.statemasters.id);
                    $("#editForm input[name='stateCode']").val(data.statemasters.stateCode);
                    $("#editForm input[name='stateName']").val(data.statemasters.stateName);
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


<!-- Update -->
<script>
    $(document).ready(function() {
        $("#editForm").submit(function(e) {
            e.preventDefault();
            $("#editSubmit").prop('disabled', true);
            var formdata = new FormData(this);
            formdata.append('_method', 'PUT');
            var model_id = $('#edit_model_id').val();
            var url = "{{ route('vendor-master.update', ':model_id') }}";

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
                            window.location.href = '{{ route('vendor-master.index') }}';
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
                        swal("Error occurred!", "Something went wrong please try again", "error");
                    }
                }
            });
        });
    });
</script>


