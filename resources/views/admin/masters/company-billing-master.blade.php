<x-admin.layout>
    <x-slot name="title">Company Billing Master</x-slot>
    <x-slot name="heading">Company Billing Master</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


    <!-- Add Form -->
    <div class="row" id="addContainer" style="display:none;">
        <div class="col-sm-12">
            <div class="card">
                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="companyName" class="col-form-label">Company Name</label>
                                <input type="text" class="form-control" id="companyName" name="company_name" placeholder="Enter Company Name">
                                <span class="text-danger invalid company_name_err"></span>
                            </div>

                            <div class="col-md-6">
                                <label for="companyType" class="col-form-label">Company Type</label>
                                <select class="form-select" id="companyType" name="company_type">
                                    <option value="">Selected ....</option>
                                    <option value="1">Private Limited</option>
                                    <option value="2">Public Limited</option>
                                    <option value="3">LLP</option>
                                    <option value="4">Proprietorship</option>
                                </select>
                                <span class="text-danger invalid company_type_err"></span>
                            </div>

                            <!-- Proprietor Name (hidden by default) -->
                            <div class="col-md-6" id="proprietorDiv" style="display:none;">
                                <label for="proprietorName" class="col-form-label">Proprietor Name</label>
                                <input type="text" class="form-control" id="proprietorName" name="proprietor_name" placeholder="Enter Proprietor Name">
                                <span class="text-danger invalid proprietor_name_err"></span>
                            </div>

                            <div class="col-md-6">
                                <label for="panNumber" class="col-form-label">PAN Number</label>
                                <input type="text" class="form-control" id="panNumber" name="pan_number" placeholder="Enter PAN Number">
                                <span class="text-danger invalid pan_number_err"></span>
                            </div>

                            <div class="col-md-6">
                                <label for="gstStatus" class="col-form-label">GST Status</label>
                                <select class="form-select" id="gstStatus" name="gststatus">
                                    <option value="" selected>Select...</option>
                                    <option value="1">Register</option>
                                    <option value="2">Unregister</option>
                                </select>
                                <span class="text-danger invalid gststatus_err"></span>
                            </div>

                            <!-- GSTIN (hidden by default) -->
                            <div class="col-md-6" id="gstinDiv" style="display:none;">
                                <label for="gstin" class="col-form-label">GSTIN</label>
                                <input type="text" class="form-control" id="gstin" name="gstno" placeholder="Enter GST Number(15 Digits Only)">
                                <span class="text-danger invalid gstno_err"></span>
                            </div>

                            <div class="col-md-6">
                                <label for="revscharge" class="col-form-label">Reverse Charge Apply</label>
                                <select class="form-select" id="revscharge" name="revscharge">
                                    <option value="" selected>Select...</option>
                                    <option value="1">Apply</option>
                                    <option value="2">Not-Apply</option>
                                </select>
                                <span class="text-danger invalid revscharge_err"></span>
                            </div>
                        </div>

                        <!-- Billing Address -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            <i class="fas fa-address-card me-2"></i>Billing Information
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="addressLine1" class="form-label">Address Line 1</label>
                                                <input type="text" class="form-control" id="addressLine1" name="address_line1" placeholder="Enter Address Line 1">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="addressLine2" class="form-label">Address Line 2</label>
                                                <input type="text" class="form-control" id="addressLine2" name="address_line2" placeholder="Enter Address Line 2">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label for="city" class="form-label">City</label>
                                                <input type="text" class="form-control" id="city" name="city" placeholder="Enter City">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="state" class="form-label">State</label>
                                                <select class="form-select" id="state" name="state">
                                                    <option value="" selected disabled>Choose...</option>
                                                    @foreach ($statemasters as $statemasters)
                                                        <option value="{{ optional($statemasters)->id }}">
                                                            {{ optional($statemasters)->stateName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="pinCode" class="form-label">PIN Code</label>
                                                <input type="text" class="form-control" id="pinCode" name="pin_code" placeholder="Enter PIN Code">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="phoneNumber" class="form-label">Contact Number</label>
                                                <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter Contact Number">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="website" class="form-label">Website (If any)</label>
                                                <input type="url" class="form-control" id="website" name="website" placeholder="Enter Website URL">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label for="Bank_id" class="form-label">Select Bank</label>
                                                <select class="form-select" id="Bank_id" name="Bank_id">
                                                    <option value="" selected disabled>Choose...</option>
                                                    @foreach ($bankmasters as $bankmaster)
                                                        <option value="{{ optional($bankmaster)->id }}">
                                                            {{ optional($bankmaster)->Bank_Name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="gst" class="form-label">Select Applied GST Code</label>
                                                <select class="form-select" id="gst_code_id" name="gst_code_id">
                                                    <option value="" selected disabled>Choose...</option>
                                                    @foreach ($gstmasters as $gstmaster)
                                                        <option value="{{ optional($gstmaster)->id }}">
                                                            {{ optional($gstmaster)->gst_code }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end -->

                        <!-- Company Logo , Seal , Signature upload -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            <i class="fas fa-address-card me-2"></i>Document Upload
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="companyLogo" class="form-label">Upload Company Logo (PNG Format Only)</label>
                                                <input class="form-control" type="file" id="companyLogo" name="company_logo">
                                                <span class="text-danger invalid company_logo_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="companySeal" class="form-label">Upload Company Seal (PNG Format Only)</label>
                                                <input class="form-control" type="file" id="companySeal" name="company_seal">
                                                <span class="text-danger invalid company_seal_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="companySignature" class="form-label">Upload signature (PNG Format Only)</label>
                                                <input class="form-control" type="file" id="companySignature" name="company_signature">
                                                <span class="text-danger invalid company_signature_err"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end -->
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
                        <h4 class="card-title">Edit Company Billing Master</h4>
                    </header>

                    <div class="card-body py-2">

                        <input type="hidden" id="edit_model_id" name="edit_model_id" value="">

                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="companyName" class="col-form-label">Company Name</label>
                            <input type="text" class="form-control" id="companyName" name="company_name" placeholder="Enter Company Name">
                            <span class="text-danger invalid company_name_err"></span>
                        </div>

                        <div class="col-md-6">
                            <label for="companyType" class="col-form-label">Company Type</label>
                            <select class="form-select" id="edit_companyType" name="company_type">
                                <option value="">Selected ....</option>
                                <option value="1">Private Limited</option>
                                <option value="2">Public Limited</option>
                                <option value="3">LLP</option>
                                <option value="4">Proprietorship</option>
                            </select>
                            <span class="text-danger invalid company_type_err"></span>
                        </div>

                        <!-- Proprietor Name (hidden by default) -->
                        <div class="col-md-6" id="edit_proprietorDiv" style="display:none;">
                            <label for="proprietorName" class="col-form-label">Proprietor Name</label>
                            <input type="text" class="form-control" id="proprietorName" name="proprietor_name" placeholder="Enter Proprietor Name">
                            <span class="text-danger invalid proprietor_name_err"></span>
                        </div>

                        <div class="col-md-6">
                            <label for="panNumber" class="col-form-label">PAN Number</label>
                            <input type="text" class="form-control" id="panNumber" name="pan_number" placeholder="Enter PAN Number">
                            <span class="text-danger invalid pan_number_err"></span>
                        </div>

                        <div class="col-md-6">
                            <label for="gstStatus" class="col-form-label">GST Status</label>
                            <select class="form-select" id="edit_gstStatus" name="gststatus">
                                <option value="" selected>Select...</option>
                                <option value="1">Register</option>
                                <option value="2">Unregister</option>
                            </select>
                            <span class="text-danger invalid gststatus_err"></span>
                        </div>

                        <!-- GSTIN (hidden by default) -->
                        <div class="col-md-6" id="edit_gstinDiv" style="display:none;">
                            <label for="gstin" class="col-form-label">GSTIN</label>
                            <input type="text" class="form-control" id="gstin" name="gstno" placeholder="Enter GST Number(15 Digits Only)">
                            <span class="text-danger invalid gstno_err"></span>
                        </div>

                        <div class="col-md-6">
                            <label for="revscharge" class="col-form-label">Reverse Charge Apply</label>
                            <select class="form-select" id="revscharge" name="revscharge">
                                <option value="" selected>Select...</option>
                                <option value="1">Apply</option>
                                <option value="2">Not-Apply</option>
                            </select>
                            <span class="text-danger invalid revscharge_err"></span>
                        </div>
                    </div>

                    <!-- Billing Address -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <i class="fas fa-address-card me-2"></i>Billing Information
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="addressLine1" class="form-label">Address Line 1</label>
                                            <input type="text" class="form-control" id="addressLine1" name="address_line1" placeholder="Enter Address Line 1">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="addressLine2" class="form-label">Address Line 2</label>
                                            <input type="text" class="form-control" id="addressLine2" name="address_line2" placeholder="Enter Address Line 2">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter City">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="state" class="form-label">State</label>
                                            <select class="form-select" id="state" name="state">
                                                <option value="" selected disabled>Choose...</option>
                                                @foreach ($statemasters as $statemasters)
                                                    <option value="{{ optional($statemasters)->id }}">
                                                        {{ optional($statemasters)->stateName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="pinCode" class="form-label">PIN Code</label>
                                            <input type="text" class="form-control" id="pinCode" name="pin_code" placeholder="Enter PIN Code">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="phoneNumber" class="form-label">Contact Number</label>
                                            <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter Contact Number">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="website" class="form-label">Website (If any)</label>
                                            <input type="url" class="form-control" id="website" name="website" placeholder="Enter Website URL">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end -->

                    <!-- Company Logo , Seal , Signature upload -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <i class="fas fa-address-card me-2"></i>Document Upload
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="companyLogo" class="form-label">Upload Company Logo (PNG Format Only)</label>
                                            <input class="form-control" type="file" id="companyLogo" name="company_logo">
                                            <span class="text-danger invalid company_logo_err"></span>
                                            <br>
                                            <a id="edit_company_logo_document_view" href="#" target="_blank" style="display:none;" class="btn btn-sm btn-info mt-2">
                                            View company logo File
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="companySeal" class="form-label">Upload Company Seal (PNG Format Only)</label>
                                            <input class="form-control" type="file" id="companySeal" name="company_seal">
                                            <span class="text-danger invalid company_seal_err"></span>
                                            <br>
                                            <a id="edit_company_seal_document_view" href="#" target="_blank" style="display:none;" class="btn btn-sm btn-info mt-2">
                                            View company seal File
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="companySignature" class="form-label">Upload signature (PNG Format Only)</label>
                                            <input class="form-control" type="file" id="companySignature" name="company_signature">
                                            <span class="text-danger invalid company_signature_err"></span>
                                            <br>
                                            <a id="edit_company_signature_document_view" href="#" target="_blank" style="display:none;" class="btn btn-sm btn-info mt-2">
                                            View company signature File
                                            </a>
                                        </div>
                                    </div>
                                </div>
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
                @can('companybillingmaster.create')
                @if (!$hasRecords)
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
                    @endif
                @endcan
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Company Name</th>
                                    <th>Company Type</th>
                                    <th>Pan No</th>
                                    <th>Proprietor Name</th>
                                    <th>GST Status</th>
                                    <th>GST No</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companybillingmasters as $companybillingmasters)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $companybillingmasters->company_name }}</td>
                                        <td>{{ $companybillingmasters->company_type}}</td>
                                        <td>{{ $companybillingmasters->pan_number}}</td>
                                        <td>{{ $companybillingmasters->proprietor_name }}</td>
                                        <td>{{ $companybillingmasters->gststatus }}</td>
                                        <td>{{ $companybillingmasters->gstno }}</td>
                                        <td>
                                            @can('companybillingmaster.edit')
                                                <button class="edit-element btn btn-secondary px-2 py-1" title="Edit Company Billing Master" data-id="{{ $companybillingmasters->id }}"><i data-feather="edit"></i></button>
                                            @endcan
                                            @can('companybillingmaster.delete')
                                                <button class="btn btn-danger rem-element px-2 py-1" title="Delete Company Billing Master" data-id="{{ $companybillingmasters->id }}"><i data-feather="trash-2"></i> </button>
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

<!-- Add from Proprietor Name Div display -->

<script>
    document.getElementById("companyType").addEventListener("change", function () {
        const proprietorDiv = document.getElementById("proprietorDiv");
        if (this.value === "4") {
            proprietorDiv.style.display = "block"; // Show
        } else {
            proprietorDiv.style.display = "none";  // Hide
            document.getElementById("proprietorName").value = ""; // Clear input
        }
    });
</script>

<!--Add from GST Div display -->
<script>
    document.getElementById("gstStatus").addEventListener("change", function () {
        const gstinDiv = document.getElementById("gstinDiv");
        if (this.value === "1") {
            gstinDiv.style.display = "block"; // Show GSTIN
        } else {
            gstinDiv.style.display = "none";  // Hide GSTIN
            document.getElementById("gstin").value = ""; // Clear GSTIN field
        }
    });
</script>

<!-- Edit from Proprietor Name Div display -->

<script>
    document.getElementById("edit_companyType").addEventListener("change", function () {
        const proprietorDiv = document.getElementById("edit_proprietorDiv");
        if (this.value === "4") {
            proprietorDiv.style.display = "block"; // Show
        } else {
            proprietorDiv.style.display = "none";  // Hide
            document.getElementById("edit_proprietorName").value = ""; // Clear input
        }
    });
</script>

<!--edit from GST Div display -->
<script>
    document.getElementById("edit_gstStatus").addEventListener("change", function () {
        const gstinDiv = document.getElementById("edit_gstinDiv");
        if (this.value === "1") {
            gstinDiv.style.display = "block"; // Show GSTIN
        } else {
            gstinDiv.style.display = "none";  // Hide GSTIN
            document.getElementById("edit_gstin").value = ""; // Clear GSTIN field
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
            url: '{{ route('company-billing-master.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('company-billing-master.index') }}';
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
        var url = "{{ route('company-billing-master.edit', ':model_id') }}";

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
                    $("#editForm input[name='edit_model_id']").val(data.companybillingmaster.id);
                    $("#editForm input[name='company_name']").val(data.companybillingmaster.company_name);
                    $("#editForm select[name='company_type']").val(data.companybillingmaster.company_type);
                    $("#editForm input[name='pan_number']").val(data.companybillingmaster.pan_number);
                    $("#editForm input[name='proprietor_name']").val(data.companybillingmaster.proprietor_name);
                    $("#editForm select[name='gststatus']").val(data.companybillingmaster.gststatus);
                    $("#editForm input[name='gstno']").val(data.companybillingmaster.gstno);
                    $("#editForm select[name='revscharge']").val(data.companybillingmaster.revscharge);
                    $("#editForm input[name='address_line1']").val(data.companybillingmaster.address_line1);
                    $("#editForm input[name='address_line2']").val(data.companybillingmaster.address_line2);
                    $("#editForm input[name='city']").val(data.companybillingmaster.city);
                    $("#editForm select[name='state']").val(data.companybillingmaster.state);
                    $("#editForm input[name='pin_code']").val(data.companybillingmaster.pin_code);
                    $("#editForm input[name='contact_number']").val(data.companybillingmaster.contact_number);
                    $("#editForm input[name='email']").val(data.companybillingmaster.email);
                    $("#editForm input[name='website']").val(data.companybillingmaster.website);
                    
                    // Company Logo
                        if (data.companybillingmaster.company_logo) {
                            $("#edit_company_logo_document_view")
                                .attr("href", "/" + data.companybillingmaster.company_logo) // path set करा
                                .show(); // button दिसेल
                        } else {
                            $("#edit_company_logo_document_view").hide();
                        }

                        // Company Seal
                        if (data.companybillingmaster.company_seal) {
                            $("#edit_company_seal_document_view")
                                .attr("href", "/" + data.companybillingmaster.company_seal)
                                .show();
                        } else {
                            $("#edit_company_seal_document_view").hide();
                        }

                        // Signature
                        if (data.companybillingmaster.authorised_signature) {
                            $("#edit_company_signature_document_view")
                                .attr("href", "/" + data.companybillingmaster.authorised_signature)
                                .show();
                        } else {
                            $("#edit_company_signature_document_view").hide();
                        }

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
            var url = "{{ route('company-billing-master.update', ':model_id') }}";

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
                            window.location.href = '{{ route('company-billing-master.index') }}';
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


<!-- Delete -->
<script>
    $("#buttons-datatables").on("click", ".rem-element", function(e) {
        e.preventDefault();
        swal({
                title: "Are you sure to delete this Company Billing Master?",
                icon: "warning",
                buttons: ["Cancel", "Confirm"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var model_id = $(this).attr("data-id");
                    var url = "{{ route('company-billing-master.destroy', ':model_id') }}";

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

