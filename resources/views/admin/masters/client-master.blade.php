<x-admin.layout>
    <x-slot name="title"> Client Master</x-slot>
    <x-slot name="heading"> Client Master</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


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
                                    <label for="Master_Category" class="form-label">Select Groups Category</label>
                                    <select class="form-select" name="categories" id="categories">
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
                                                    data-master-name="{{ $masterGroup->group_name ?? '' }}">
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
                                        @foreach($MasterGroupCategory as $group)
                                            <option value="{{ $group->id }}"
                                                    data-master="{{ $group->master_group_id }}"
                                                    data-master-name="{{ $group->mastergroup->group_name ?? '' }}">
                                                {{$group->mastergroup->master_group_name}} << {{ $group->group_name }} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Sub-Group Dropdown --}}
                                <div class="col-md-6 d-none" id="subgroup_dropdown">
                                    <label class="form-label">Sub-Group List</label>
                                    <select class="form-select" name="subgroup_id" id="subgroup_id_1">
                                        <option value="">Select Sub-Group</option>
                                        @foreach($SubGroupMaster as $subgroup)
                                        <option value="{{ $subgroup->id }}" data-master="{{ $subgroup->master_group_id }}" data-category="{{ $subgroup->master_group_category_id }}">
                                        {{ optional($subgroup->MasterGroup)->master_group_name }} << {{ optional($subgroup->MasterGroupCategory)->group_name }} << {{ $subgroup->sub_group_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="col-form-label">Client Company Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="client_name" placeholder="Client Company Name" id="client_name">
                                    <span class="text-danger invalid client_name_err"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="name" class="col-form-label">GST Register Status<span class="text-danger">*</span></label>
                                    <div class="form-check form-switch form-switch-lg form-switch-success" dir="ltr">
                                        <input type="hidden" name="gst_status" id="gst_status" value="0"> <!-- hidden field for value -->
                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                        <label class="form-check-label" for="customSwitchsizelg">Click If 'Registered'</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4" id="gst_div" style="display: none;">
                                <div class="mb-3">
                                    <label for="gstNoInput" class="col-form-label">GST NO <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="gst_no" placeholder="15 No GST Code -22AAAAA0000A1Z5" id="gstNoInput">
                                    <span class="text-danger invalid gst_no_err"></span>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contactPersonInput" class="form-label">Contact Person Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="contact_name" placeholder="Contact Person Name" id="contact_name" >
                                    
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
                                    <label for="addressInput" class="form-label">Billing Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="billing_address" placeholder="Billing address" id="addressInput" >
                                    
                                    <span class="text-danger invalid billing_address_err"></span>
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
                                    <select id="stateInput" class="form-select" name="state">
                                        <option value="" selected disabled>Choose...</option>
                                        @foreach ($statemasters as $statemaster)
                                            <option value="{{ $statemaster->id }}" data-statecode="{{ $statemaster->stateCode }}">
                                                {{ $statemaster->stateName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            {{-- hidden field for statecode --}}
                                <input type="hidden" name="statecode" id="statecode">

                            <!-- billing_type Information -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="billing_type" class="form-label">Billing Type <span class="text-danger">*</span></label>
                                    <select id="billing_type" class="form-select" name="billing_type" >
                                        <option value="" selected >Choose...</option>
                                        <option value="0">Monthly Billing</option>
                                        <option value="1">Respective Date</option>
                                    </select>
                                    <span class="text-danger invalid billing_type_err"></span>
                                    
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="billing_date" class="form-label">Billing Date</label>
                                    <input type="date" class="form-control" name="billing_date" placeholder="Billing Date" id="billing_date" >
                                    <span class="text-danger invalid billing_date_err"></span>
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
                                    <select class="form-select" name="year_master" id="opening_year">
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
                        <h4 class="card-title">Edit Client Details</h4>
                    </header>

                    <div class="card-body py-2">

                        <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                        <div class="mb-3 row">
                            <!-- Category & Related Dropdowns in one line -->
                            <div class="mb-3 row align-items-end">
                                {{-- Category Selection --}}
                                <div class="col-md-6">
                                    <label for="Master_Category" class="form-label">Select Groups Category</label>
                                    <select class="form-select" name="edit_categories" id="edit_categories">
                                        <option value="">Select Group</option>
                                        <option value="3">Master Group</option>
                                        <option value="2">Group Group</option>
                                        <option value="1">Sub-Group Group</option>
                                    </select>
                                    <span class="text-danger invalid Master_Category_err"></span>
                                </div>

                                {{-- Master Group --}}
                                <div class="col-md-6 d-none" id="edit_mastergroup_dropdown">
                                    <label class="form-label">Select Master Group</label>
                                    <select class="form-select" name="edit_master_id" id="edit_master_id">
                                        <option value="">Select Master Group</option>
                                        @foreach($masterGroups as $masterGroup)
                                            <option value="{{ $masterGroup->id }}"
                                                    data-master="{{ $masterGroup->master_id }}"
                                                    data-master-name="{{ $masterGroup->group_name ?? '' }}">
                                                {{ $masterGroup->master_group_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Group Dropdown --}}
                                <div class="col-md-6 d-none" id="edit_group_dropdown">
                                    <label class="form-label">Group List</label>
                                    <select class="form-select" name="edit_group_id" id="edit_group_id">
                                        <option value="">Select Group</option>
                                        @foreach($MasterGroupCategory as $group)
                                            <option value="{{ $group->id }}"
                                                    data-master="{{ $group->master_group_id }}"
                                                    data-master-name="{{ $group->mastergroup->group_name ?? '' }}">
                                                {{$group->mastergroup->master_group_name}} << {{ $group->group_name }} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Sub-Group Dropdown --}}
                                <div class="col-md-6 d-none" id="edit_subgroup_dropdown">
                                    <label class="form-label">Sub-Group List</label>
                                    <select class="form-select" name="edit_subgroup_id" id="edit_subgroup_id_1">
                                        <option value="">Select Sub-Group</option>
                                        @foreach($SubGroupMaster as $subgroup)
                                        <option value="{{ $subgroup->id }}" data-master="{{ $subgroup->master_group_id }}" data-category="{{ $subgroup->master_group_category_id }}">
                                        {{ optional($subgroup->MasterGroup)->master_group_name }} << {{ optional($subgroup->MasterGroupCategory)->group_name }} << {{ $subgroup->sub_group_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="col-form-label">Client Company Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="client_name" placeholder="Client Company Name" id="client_name">
                                    <span class="text-danger invalid client_name_err"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="name" class="col-form-label">GST Register Status<span class="text-danger">*</span></label>
                                    <div class="form-check form-switch form-switch-lg form-switch-success" dir="ltr">
                                        <input type="hidden" name="gst_status" id="edit_gst_status" value="0"> <!-- hidden field for value -->
                                        <input type="checkbox" class="form-check-input" id="edit_customSwitchsizelg">
                                        <label class="form-check-label" for="edit_customSwitchsizelg">Click If 'Registered'</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4" id="edit_gst_div" style="display: none;">
                                <div class="mb-3">
                                    <label for="edit_gstNoInput" class="col-form-label">GST NO <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="gst_no" placeholder="15 No GST Code -22AAAAA0000A1Z5" id="edit_gstNoInput">
                                    <span class="text-danger invalid gst_no_err"></span>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contactPersonInput" class="form-label">Contact Person Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="contact_name" placeholder="Contact Person Name" id="contact_name" >
                                    
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
                                    <label for="addressInput" class="form-label">Billing Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="billing_address" placeholder="Billing address" id="addressInput" >
                                    
                                    <span class="text-danger invalid billing_address_err"></span>
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
                                    <select id="stateInput" class="form-select" name="state">
                                        <option value="" selected disabled>Choose...</option>
                                        @foreach ($statemasters as $statemaster)
                                            <option value="{{ $statemaster->id }}" data-statecode="{{ $statemaster->stateCode }}">
                                                {{ $statemaster->stateName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            {{-- hidden field for statecode --}}
                                <input type="hidden" name="statecode" id="statecode">

                            <!-- billing_type Information -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="billing_type" class="form-label">Billing Type <span class="text-danger">*</span></label>
                                    <select id="billing_type" class="form-select" name="billing_type" >
                                        <option value="" selected >Choose...</option>
                                        <option value="0">Monthly Billing</option>
                                        <option value="1">Respective Date</option>
                                    </select>
                                    <span class="text-danger invalid billing_type_err"></span>
                                    
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="billing_date" class="form-label">Billing Date</label>
                                    <input type="date" class="form-control" name="billing_date" placeholder="Billing Date" id="billing_date" >
                                    <span class="text-danger invalid billing_date_err"></span>
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
                                    <select class="form-select" name="year_master" id="year_master">
                                        <option value="">Select...</option>
                                        @foreach($yearmasters as $yearmasters)
                                                
                                            @endforeach
                                    </select>
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
                @can('clientmaster.create')
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
                                    <th>GST No</th>
                                    <th>Contact Person</th>
                                    <th>Contact Number</th>
                                    <th>Alternet  Number</th>
                                    <th>Email ID</th>
                                    <th>Sate Name</th>
                                    <th>Billing Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientmasters as $clientmasters)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $clientmasters->client_name }}</td>
                                        <td>{{ $clientmasters->gst_no }}</td>
                                        <td>{{ $clientmasters->contact_name }}</td>
                                        <td>{{ $clientmasters->contact_no }}</td>
                                        <td>{{ $clientmasters->alternate_contact_no }}</td>
                                        <td>{{ $clientmasters->email }}</td>
                                        <td>{{ $clientmasters->states->stateName }}</td>
                                        <!-- <td>{{ $clientmasters->billing_type }}</td> -->
                                        <td>
                                            @if($clientmasters->billing_type == 1)
                                                Immediate
                                            @elseif($clientmasters->billing_type == 2)
                                                Month End
                                            @elseif($clientmasters->billing_type == 3)
                                                Respestive Period
                                            @else
                                                Unknown
                                            @endif
                                        </td>
                                        <td>
                                            @can('clientmaster.edit')
                                                <button class="edit-element btn btn-secondary px-2 py-1" title="Edit Vehicle" data-id="{{ $clientmasters->id }}"><i data-feather="edit"></i></button>
                                            @endcan
                                            @can('clientmaster.delete')
                                                <button class="btn btn-danger rem-element px-2 py-1" title="Delete Vehicle" data-id="{{ $clientmasters->id }}"><i data-feather="trash-2"></i> </button>
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

<!-- gst status -->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const switchEl = document.getElementById("customSwitchsizelg");
        const gstDiv = document.getElementById("gst_div");
        const gstStatus = document.getElementById("gst_status");

        // initial check
        if (switchEl.checked) {
            gstDiv.style.display = "block";
            gstStatus.value = "1";
        }

        switchEl.addEventListener("change", function () {
            if (this.checked) {
                gstDiv.style.display = "block";
                gstStatus.value = "1";
            } else {
                gstDiv.style.display = "none";
                gstStatus.value = "0";
                document.getElementById("gstNoInput").value = ""; // optional: clear GST no when unchecked
            }
        });
    });

</script>

<!-- Master name drop down -->

<script>
    $(document).ready(function () {
        function resetGroupFields() {
            // Clear values
            $('#master_id').val('');
            $('#group_id').val('');
            $('#subgroup_id_1').val('');

            // Hide all dropdowns
            $('#mastergroup_dropdown, #group_dropdown, #subgroup_dropdown').addClass('d-none');
        }

        // On category change
        $('#categories').on('change', function () {
            const selected = $(this).val();
            resetGroupFields();

            switch (selected) {
                case '1': // Sub-Group
                    $('#subgroup_dropdown').removeClass('d-none');
                    break;
                case '2': // Group
                    $('#group_dropdown').removeClass('d-none');
                    break;
                case '3': // Master Group
                    $('#mastergroup_dropdown').removeClass('d-none');
                    break;
            }
        });

        // Set master_id from Group selection (only if category is 2)
        $('#group_id').on('change', function () {
            const category = $('#categories').val();
            if (category === '2') {
                const masterId = $(this).find(':selected').data('master') || '';
                $('#master_id').val(masterId);
            }
        });

        // Set master_id from Sub-Group selection (only if category is 1)
        $('#subgroup_id_1').on('change', function () {
            const category = $('#categories').val();
            if (category === '1') {
                const masterId = $(this).find(':selected').data('master') || '';
                $('#master_id').val(masterId);
            }
        });

        // GST toggle logic
        $('#customSwitchsizelg').on('change', function () {
            const isChecked = $(this).is(':checked');
            $('#gst_status').val(isChecked ? 1 : 0);
            $('#gst_div').toggle(isChecked);
        });

        // State code set from selected state
        $('#stateInput').on('change', function () {
            const stateCode = $(this).find(':selected').data('statecode') || '';
            $('#statecode').val(stateCode);
        });
    });
</script>


 <!-- state code -->

 <script>
    document.getElementById('stateInput').addEventListener('change', function() {
        let code = this.options[this.selectedIndex].getAttribute('data-statecode');
        document.getElementById('statecode').value = code;
    });

 </script>

 <!-- Edit gst status -->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const switchEl = document.getElementById("edit_customSwitchsizelg");
        const gstDiv = document.getElementById("edit_gst_div");
        const gstStatus = document.getElementById("edit_gst_status");

        // initial check
        if (switchEl.checked) {
            gstDiv.style.display = "block";
            gstStatus.value = "1";
        }

        switchEl.addEventListener("change", function () {
            if (this.checked) {
                gstDiv.style.display = "block";
                gstStatus.value = "1";
            } else {
                gstDiv.style.display = "none";
                gstStatus.value = "0";
                document.getElementById("edit_gstNoInput").value = ""; // optional: clear GST no when unchecked
            }
        });
    });

</script>

<!-- Edit Master name drop down -->

<script>
    $(document).ready(function () {
        function resetGroupFields() {
            // Clear values
            $('#edit_master_id').val('');
            $('#edit_group_id').val('');
            $('#edit_subgroup_id_1').val('');

            // Hide all dropdowns
            $('#edit_mastergroup_dropdown, #edit_group_dropdown, #edit_subgroup_dropdown').addClass('d-none');
        }

        // On category change
        $('#edit_categories').on('change', function () {
            const selected = $(this).val();
            resetGroupFields();

            switch (selected) {
                case '1': // Sub-Group
                    $('#edit_subgroup_dropdown').removeClass('d-none');
                    break;
                case '2': // Group
                    $('#edit_group_dropdown').removeClass('d-none');
                    break;
                case '3': // Master Group
                    $('#edit_mastergroup_dropdown').removeClass('d-none');
                    break;
            }
        });

        // Set master_id from Group selection (only if category is 2)
        $('#edit_group_id').on('change', function () {
            const category = $('#edit_categories').val();
            if (category === '2') {
                const masterId = $(this).find(':selected').data('master') || '';
                $('#edit_master_id').val(masterId);
            }
        });

        // Set master_id from Sub-Group selection (only if category is 1)
        $('#edit_subgroup_id_1').on('change', function () {
            const category = $('#edit_categories').val();
            if (category === '1') {
                const masterId = $(this).find(':selected').data('master') || '';
                $('#edit_master_id').val(masterId);
            }
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
            url: '{{ route('client-master.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('client-master.index') }}';
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
        var url = "{{ route('client-master.edit', ':model_id') }}";

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
                    $("#editForm input[name='edit_model_id']").val(data.clientmasters.id);
                    $("#editForm input[name='client_name']").val(data.clientmasters.client_name);
                    $("#editForm input[name='billing_address']").val(data.clientmasters.billing_address);
                    // GST Status set karaycha
                        $("#editForm input[name='gst_status']").val(data.clientmasters.gst_status);

                        // जर gst_status 1 असेल
                        if (data.clientmasters.gst_status == 1) {
                            // hidden field update
                            $("#edit_gst_status").val(1);

                            // switch checkbox check
                            $("#edit_customSwitchsizelg").prop('checked', true);

                            // GST div show
                            $("#edit_gst_div").show();

                            // GST NO value set
                            $("#editForm input[name='gst_no']").val(data.clientmasters.gst_no);
                        } else {
                            // gst_status 0 असेल तर
                            // $("#edit_gst_status").val(0);
                            // // $("#edit_customSwitchsizelg").prop('checked', false);
                            // // $("#edit_gst_div").hide();
                            // // $("#gstNoInput").val('');
                        }
                    // $("#editForm input[name='gst_no']").val(data.clientmasters.gst_no);
                    $("#editForm input[name='contact_name']").val(data.clientmasters.contact_name);
                    $("#editForm input[name='contact_no']").val(data.clientmasters.contact_no);
                    $("#editForm input[name='alternate_contact_no']").val(data.clientmasters.alternate_contact_no);
                    $("#editForm input[name='email']").val(data.clientmasters.email);
                    $("#editForm input[name='city']").val(data.clientmasters.city);
                    $("#editForm input[name='pincode']").val(data.clientmasters.pincode);
                    $("#editForm select[name='state']").val(data.clientmasters.state);
                    $("#editForm select[name='billing_type']").val(data.clientmasters.billing_type);
                    $("#editForm input[name='billing_date']").val(data.clientmasters.billing_date);

                    // Categories set
                    $("#editForm select[name='edit_categories']").val(data.clientmasters.categories).trigger('change');

                        // Hide सगळे dropdown सुरुवातीला
                        $("#edit_mastergroup_dropdown, #edit_group_dropdown, #edit_subgroup_dropdown").addClass('d-none');

                        // Categories नुसार कोणता dropdown दिसेल ते control करणे
                        if (data.clientmasters.categories == 3) { 
                            // Master Group
                            $("#edit_mastergroup_dropdown").removeClass('d-none');
                            $("#editForm select[name='edit_master_id']").val(data.clientmasters.master_id);
                        } 
                        else if (data.clientmasters.categories == 2) { 
                            // Group
                            $("#edit_group_dropdown").removeClass('d-none');
                            $("#editForm select[name='edit_group_id']").val(data.clientmasters.group_id);
                        } 
                        else if (data.clientmasters.categories == 1) { 
                            // Sub-Group
                            $("#edit_subgroup_dropdown").removeClass('d-none');
                            $("#editForm select[name='edit_subgroup_id']").val(data.clientmasters.subgroup_id);
                        }

                    $("#editForm input[name='opening_amt']").val(data.clientmasters.opening_amt);
                    $("#editForm select[name='dr_cr']").val(data.clientmasters.dr_cr);
                    $("#editForm select[name='year_master']").val(data.clientmasters.year_master);
                    $("#editForm select[name='status']").val(data.clientmasters.status);

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
            var url = "{{ route('client-master.update', ':model_id') }}";

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


<!-- Delete -->
<script>
    $("#buttons-datatables").on("click", ".rem-element", function(e) {
        e.preventDefault();
        swal({
                title: "Are you sure to delete this vendor Master?",
                icon: "warning",
                buttons: ["Cancel", "Confirm"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var model_id = $(this).attr("data-id");
                    var url = "{{ route('client-master.destroy', ':model_id') }}";

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

