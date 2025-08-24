<x-admin.layout>
    <x-slot name="title">Add New Driver Details</x-slot>
    <x-slot name="heading">Add New Driver Details</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}

                <div class="row" id="addContainer" style="display:none;">
                    <div class="col-sm-12">
                            <div class="card-body">
                                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

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

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="firstNameinput" class="form-label">First Name</label>
                                                    <input type="text" class="form-control" placeholder="First Name" id="firstNameinput" name="first_name">
                                                    <span class="text-danger invalid f_name_err"></span>

                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="lastNameinput" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control" placeholder="Last Name" id="lastNameinput" name="last_name">
                                                    <span class="text-danger invalid l_name_err"></span>

                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="mobileNoinput" class="form-label">Mobile Number</label>
                                                    <input type="tel" class="form-control" placeholder="Mobile Number" id="mobileNoinput" name="mobile_no">
                                                    <span class="text-danger invalid mobile_no_err"></span>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="JoingDate" class="form-label">Joining Date</label>
                                                    <input type="date" class="form-control" id="JoingDate" name="joining_date">
                                                    <span class="text-danger invalid joining_date_err"></span>
                                                </div>
                                        </div>
                                        <!--end col-->
                                            <!--end col-->
                                            <!-- <div class="col-md-4">
                                            <div class="mb-3">
                                            <label for="ResignationDate" class="form-label">Resignation Date</label>
                                            <input type="date" class="form-control" id="ResignationDate" name="resignation_date">
                                            <span class="text-danger invalid resignation_date_err"></span>
                                            </div>
                                            </div> -->
                                        <!--end col-->
                                        
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="basicSalaryinput" class="form-label">Basic Salary</label>
                                                    <input type="number" class="form-control" placeholder="Basic Salary" id="basicSalaryinput" name="basic_salary">
                                                    <span class="text-danger invalid basic_salary_err"></span>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="altContactinput" class="form-label">Alternate Contact Number</label>
                                                    <input type="number" class="form-control" placeholder="Alternate Contact Number" id="altContactinput" name="alternate_contact_no">
                                                    <span class="text-danger invalid alternate_contact_no_err"></span>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="emailidInput" class="form-label">Email Address</label>
                                                    <input type="email" class="form-control" placeholder="example@gmail.com" id="emailidInput" name="email">
                                                    <span class="text-danger invalid email_err"></span>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="address1ControlTextarea" class="form-label">Full Address</label>
                                                    <input type="text" class="form-control" placeholder="Address 1" id="address1ControlTextarea" name="address">
                                                    <span class="text-danger invalid address_err"></span>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="citynameInput" class="form-label">City</label>
                                                    <input type="text" class="form-control" placeholder="Enter your city" id="citynameInput" name="city">
                                                    <span class="text-danger invalid city_err"></span>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="pinCodeinput" class="form-label">PIN Code</label>
                                                    <input type="number" class="form-control" placeholder="Pin Code" id="pinCodeinput" name="pincode">
                                                    <span class="text-danger invalid pincode_err"></span>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="ForminputState" class="form-label">State</label>
                                                    <select id="ForminputState" class="form-select" name="state">
                                                        <option value="" selected disabled>Choose...</option>
                                                            @foreach ($statemasters as $statemaster)
                                                                    <option value="{{ optional($statemaster)->id }}">{{ optional($statemaster)->stateName }}</option>
                                                            @endforeach
                                                        
                                                    </select>
                                                    <span class="text-danger invalid status_err"></span>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <!--end col-->
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="ForminputStatus" class="form-label">Status</label>
                                                    <select id="ForminputStatus" class="form-select" name="status">
                                                    <option value="">Select...</option>
                                                    <option value="1">Active</option>
                                                    <option value="2">Inactive</option>        
                                                    </select>
                                                    <span class="text-danger invalid state_err"></span>
                                                </div>
                                            </div>
                                            <!--end col-->


                                        <!--Wizard col-->
                                        <div class="col-xl-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title mb-0">Payment Details & Upload Documents Tab</h4>
                                                </div><!-- end card header -->
                                                <div class="card-body">
                                                    {{-- <form action="#" class="form-steps" autocomplete="off"> --}}

                                                        <div class="step-arrow-nav mb-4">

                                                            <ul class="nav nav-pills custom-nav nav-justified" role="tablist">
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link done" id="steparrow-gen-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-gen-info" type="button" role="tab" aria-controls="steparrow-gen-info" aria-selected="false">Payment Details</button>
                                                                </li>
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link active" id="steparrow-description-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-description-info" type="button" role="tab" aria-controls="steparrow-description-info" aria-selected="true">Upload Documents</button>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                        <!-- Payments Details tab pane -->
                                                        <div class="tab-content">
                                                            <div class="tab-pane fade" id="steparrow-gen-info" role="tabpanel" aria-labelledby="steparrow-gen-info-tab">
                                                                <div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="steparrow-gen-info-email-input">Bank Name</label>
                                                                                <input type="text" class="form-control" id="steparrow-gen-info-email-input" placeholder="Enter Bank Name" name="bank_name" >
                                                                                <div class="invalid-feedback">Please Enter an Bank Name</div>
                                                                                <span class="text-danger invalid bank_name_err"></span>
                                                                            </div>
                                                                        </div>
                                                                         <!--end col-->
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="steparrow-gen-info-username-input">Branch</label>
                                                                                <input type="text" class="form-control" id="steparrow-gen-info-username-input" placeholder="Enter Branch" name="bank_branch" >
                                                                                <div class="invalid-feedback">Please enter a Branch</div>
                                                                                <span class="text-danger invalid bank_branch_err"></span>
                                                                            </div>
                                                                        </div>
                                                                         <!--end col-->
                                                                         <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="steparrow-gen-info-username-input">Bank A/c Number</label>
                                                                                <input type="number" class="form-control" id="steparrow-gen-info-username-input" placeholder="Enter Bank A/c Number" name="bank_account_no" >
                                                                                <div class="invalid-feedback">Please enter a Bank A/c Number</div>
                                                                                <span class="text-danger invalid bank_account_no_err"></span>
                                                                            </div>
                                                                        </div>
                                                                         <!--end col-->
                                                                         <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="steparrow-gen-info-username-input">Bank IFSC Code</label>
                                                                                <input type="text" class="form-control" id="steparrow-gen-info-username-input" placeholder="Enter Bank IFSC Code" name="ifsc_code" >
                                                                                <div class="invalid-feedback">Please enter a Bank IFSC Code</div>
                                                                                <span class="text-danger invalid bank_ifsc_code_err"></span>
                                                                            </div>
                                                                        </div>
                                                                         <!--end col-->

                                                                            <div class="card">
                                                                                <div class="card-header">
                                                                                    <h4 class="card-title mb-0">Gpay or Phone Pay Details (if it is)</h4>
                                                                                </div>
                                                                            </div>

                                                                         <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="steparrow-gen-info-username-input">Reference Person Name</label>
                                                                                <input type="text" class="form-control" id="steparrow-gen-info-username-input" placeholder="Enter Refance Person Name" name="upi_reference_name" >
                                                                                <div class="invalid-feedback">Please enter a Refance Name</div>
                                                                                <span class="text-danger invalid upi_reference_name_err"></span>
                                                                            </div>
                                                                        </div>
                                                                         <!--end col-->
                                                                         <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="steparrow-gen-info-username-input">GPay or PhonePe Number</label>
                                                                                <input type="number" class="form-control" id="steparrow-gen-info-username-input" placeholder="Enter Gpay or Phone Pay Number" name="upi_number" >
                                                                                <div class="invalid-feedback">Please enter a Gpay or Phone Pay Number</div>
                                                                                <span class="text-danger invalid gpay_number_err"></span>
                                                                            </div>
                                                                        </div>
                                                                         <!--end col-->
                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <!-- end tab pane -->

                                                            <!-- Upload Documents tab pane -->
                                                            <div class="tab-pane fade show active" id="steparrow-description-info" role="tabpanel" aria-labelledby="steparrow-description-info-tab">
                                                                <div class="row">

                                                                 <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="formFile" class="form-label"> Aadhar Card Number</label>
                                                                            <input class="form-control" type="text" id="aadhar_card_number" name="aadhar_card_number">
                                                                            <span class="text-danger invalid aadhar_card_number_err"></span>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="formFile" class="form-label">Upload Aadhar Card</label>
                                                                            <input class="form-control" type="file" id="aadhar_card_path" name="aadhar_card_path">
                                                                            <span class="text-danger invalid aadhar_card_path_err"></span>
                                                                        </div>
                                                                    </div>
                                                                   
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="formFile" class="form-label">Upload PANCard</label>
                                                                            <input class="form-control" type="file" id="pan_card_path" name="pan_card_path">
                                                                            <span class="text-danger invalid pan_card_path_err"></span>
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="formFile" class="form-label">Upload Driving Licence</label>
                                                                            <input class="form-control" type="file" id="driving_license_path" name="driving_license_path">
                                                                            <span class="text-danger invalid driving_license_path_err"></span>
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="driving_license_validity" class="form-label">Driving Licence Exp Date</label>
                                                                            <input type="date" class="form-control" id="driving_license_validity" name="driving_license_validity">
                                                                            <span class="text-danger invalid driving_license_validity_err"></span>
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->

                                                                        <div class="col-md-4">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="des-info-description-input">Remark / Description </label>
                                                                                <textarea class="form-control" placeholder="Enter Description" id="remark" rows="3" name="remark"></textarea>
                                                                                <div class="invalid-feedback">Please enter a description if any</div>
                                                                                <span class="text-danger invalid remark_err"></span>
                                                                            </div>
                                                                        </div>

                                                                </div>

                                                            </div>
                                                            <!-- end tab pane -->

                                                        </div>
                                                        <!-- end tab content -->
                                                    {{-- </form>x --}}
                                                </div>
                                                <!-- end card body -->
                                            </div>
                                            <!-- end card -->
                                        </div>
                                        <!-- end col -->
                                    </div>
                                            <div class="col-lg-12">
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-primary" id="addSubmit">Submit</button>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                </form>


                            </div>
                        </div>
                    </div> 
                </div>

                {{-- Edit Form --}}
                <div class="row" id="editContainer" style="display:none;">
                    <div class="col">
                        <form class="form-horizontal form-bordered" method="post" id="editForm" enctype="multipart/form-data">
                            @csrf
                            <section class="card">
                                <header class="card-header">
                                    <h4 class="card-title">Edit Vendor Master</h4>
                                </header>
                                <div class="card-body py-2">
                                    <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                                    <div class="mb-3 row">
                                        <!-- Category & Related Dropdowns in one line -->
                                        <div class="mb-3 row align-items-end">
                                            {{-- Category Selection --}}
                                            <div class="col-md-6">
                                                <label for="Master_Category" class="form-label">Category</label>
                                                <select class="form-select" name="categories" id="edit_categories">
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
                                                <select class="form-select" name="master_id" id="edit_master_id">
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
                                                <select class="form-select" name="group_id" id="edit_group_id">
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
                                                <select class="form-select" name="subgroup_id" id="edit_subgroup_id_1">
                                                    <option value="">Select Sub-Group</option>
                                                    @foreach($SubGroupMaster as $subgroup)
                                                        <option value="{{ $subgroup->id }}" data-master="{{ $subgroup->master_group_id }}" data-category="{{ $subgroup->master_group_category_id }}">
                                                            {{ optional($subgroup->MasterGroup)->master_group_name }} << {{ optional($subgroup->MasterGroupCategory)->group_name }} << {{ $subgroup->sub_group_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">First Name</label>
                                                <input type="text" class="form-control" placeholder="Frist Name" id="edit_firstNameinput" name="first_name">
                                                <span class="text-danger invalid f_name_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="lastNameinput" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" placeholder="Last Name" id="edit_lastNameinput" name="last_name">
                                                <span class="text-danger invalid l_name_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="mobileNoinput" class="form-label">Mobile Number</label>
                                                <input type="tel" class="form-control" placeholder="Mobile Number" id="edit_mobileNoinput" name="mobile_no">
                                                <span class="text-danger invalid mobile_no_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="JoingDate" class="form-label">Joing Date</label>
                                                <input type="date" class="form-control" id="edit_JoingDate" name="joining_date">
                                                <span class="text-danger invalid joining_date_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="JoingDate" class="form-label">Resigning Date</label>
                                                <input type="date" class="form-control" id="edit_Resigndate" name="resigning_date">
                                                <span class="text-danger invalid resigning_date_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="basicSalaryinput" class="form-label">Basic Salary</label>
                                                <input type="number" class="form-control" placeholder="Basic Salary" id="edit_basicSalaryinput" name="basic_salary">
                                                <span class="text-danger invalid basic_salary_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="altContactinput" class="form-label">Alternet Contact Number</label>
                                                <input type="number" class="form-control" placeholder="Alternet Contact Number" id="edit_altContactinput" name="alternate_contact_no">
                                                <span class="text-danger invalid alternate_contact_no_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="emailidInput" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" placeholder="example@gamil.com" id="edit_emailidInput" name="email">
                                                <span class="text-danger invalid email_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="address1ControlTextarea" class="form-label">Full Address</label>
                                                <input type="text" class="form-control" placeholder="Address 1" id="edit_address1ControlTextarea" name="address">
                                                <span class="text-danger invalid address_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="citynameInput" class="form-label">City</label>
                                                <input type="text" class="form-control" placeholder="Enter your city" id="edit_citynameInput" name="city">
                                                <span class="text-danger invalid city_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="pinCodeinput" class="form-label">PIN Code</label>
                                                <input type="number" class="form-control" placeholder="Pin Code" id="edit_pinCodeinput" name="pincode">
                                                <span class="text-danger invalid pincode_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="ForminputState" class="form-label">State</label>
                                                <select id="edit_ForminputState" class="form-select" name="state">
                                                    <option value="" selected disabled>Choose...</option>
                                                    @foreach ($statemasters as $statemaster)
                                                        <option value="{{ optional($statemaster)->id }}">{{ optional($statemaster)->stateName }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger invalid state_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="ForminputStatus" class="form-label">Status</label>
                                                <select id="edit_ForminputStatus" class="form-select" name="status">
                                                    <option value="">Select...</option>
                                                    <option value="1">Active</option>
                                                    <option value="2">Inactive</option>        
                                                </select>
                                                <span class="text-danger invalid state_err"></span>
                                            </div>
                                        </div>
                                        <!--Wizard col-->
                                        <div class="col-xl-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title mb-0">Payment Details & Upload Documents Tab</h4>
                                                </div><!-- end card header -->
                                                <div class="card-body">
                                                    {{-- <form action="#" class="form-steps" autocomplete="off"> --}}

                                                        <div class="step-arrow-nav mb-4">

                                                            <ul class="nav nav-pills custom-nav nav-justified" role="tablist">
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link done" id="steparrow-gen-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-gen-info" type="button" role="tab" aria-controls="steparrow-gen-info" aria-selected="false">Payment Details</button>
                                                                </li>
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link active" id="steparrow-description-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-description-info" type="button" role="tab" aria-controls="steparrow-description-info" aria-selected="true">Upload Documents</button>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                        <!-- Payments Details tab pane -->
                                                        <div class="tab-content">
                                                            <div class="tab-pane fade" id="steparrow-gen-info" role="tabpanel" aria-labelledby="steparrow-gen-info-tab">
                                                                <div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="steparrow-gen-info-email-input">Bank Name</label>
                                                                                <input type="text" class="form-control" id="edit_bank_name" placeholder="Enter Bank Name" name="bank_name" >
                                                                                <div class="invalid-feedback">Please Enter an Bank Name</div>
                                                                                <span class="text-danger invalid bank_name_err"></span>
                                                                            </div>
                                                                        </div>
                                                                         <!--end col-->
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="steparrow-gen-info-username-input">Branch</label>
                                                                                <input type="text" class="form-control" id="edit_bank_branch" placeholder="Enter Branch" name="bank_branch" >
                                                                                <div class="invalid-feedback">Please enter a Branch</div>
                                                                                <span class="text-danger invalid bank_branch_err"></span>
                                                                            </div>
                                                                        </div>
                                                                         <!--end col-->
                                                                         <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="steparrow-gen-info-username-input">Bank A/c Number</label>
                                                                                <input type="number" class="form-control" id="edit_bank_account_no" placeholder="Enter Bank A/c Number" name="bank_account_no" >
                                                                                <div class="invalid-feedback">Please enter a Bank A/c Number</div>
                                                                                <span class="text-danger invalid bank_account_no_err"></span>
                                                                            </div>
                                                                        </div>
                                                                         <!--end col-->
                                                                         <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="steparrow-gen-info-username-input">Bank IFSC Code</label>
                                                                                <input type="text" class="form-control" id="edit_ifsc_code" placeholder="Enter Bank IFSC Code" name="ifsc_code" >
                                                                                <div class="invalid-feedback">Please enter a Bank IFSC Code</div>
                                                                                <span class="text-danger invalid bank_ifsc_code_err"></span>
                                                                            </div>
                                                                        </div>
                                                                         <!--end col-->

                                                                            <div class="card">
                                                                                <div class="card-header">
                                                                                    <h4 class="card-title mb-0">Gpay or Phone Pay Details (if it is)</h4>
                                                                                </div>
                                                                            </div>

                                                                         <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="steparrow-gen-info-username-input">Reference Person Name</label>
                                                                                <input type="text" class="form-control" id="edit_upi_reference_name" placeholder="Enter Refance Person Name" name="upi_reference_name" >
                                                                                <div class="invalid-feedback">Please enter a Refance Name</div>
                                                                                <span class="text-danger invalid upi_reference_name_err"></span>
                                                                            </div>
                                                                        </div>
                                                                         <!--end col-->
                                                                         <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="steparrow-gen-info-username-input">GPay or PhonePe Number</label>
                                                                                <input type="number" class="form-control" id="edit_upi_number" placeholder="Enter Gpay or Phone Pay Number" name="upi_number" >
                                                                                <div class="invalid-feedback">Please enter a Gpay or Phone Pay Number</div>
                                                                                <span class="text-danger invalid gpay_number_err"></span>
                                                                            </div>
                                                                        </div>
                                                                         <!--end col-->
                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <!-- end tab pane -->

                                                            <!-- Upload Documents tab pane -->
                                                            <div class="tab-pane fade show active" id="steparrow-description-info" role="tabpanel" aria-labelledby="steparrow-description-info-tab">
                                                                <div class="row">

                                                                 <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="formFile" class="form-label"> Aadhar Card Number</label>
                                                                            <input class="form-control" type="text" id="edit_aadhar_card_number" name="aadhar_card_number">
                                                                            <span class="text-danger invalid aadhar_card_number_err"></span>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="formFile" class="form-label">Upload Aadhar Card</label>
                                                                            <input class="form-control" type="file" id="edit_aadhar_card_path" name="aadhar_card_path">
                                                                            <span class="text-danger invalid aadhar_card_path_err"></span>
                                                                        </div>
                                                                    </div>
                                                                   
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="formFile" class="form-label">Upload PANCard</label>
                                                                            <input class="form-control" type="file" id="edit_pan_card_path" name="pan_card_path">
                                                                            <span class="text-danger invalid pan_card_path_err"></span>
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="formFile" class="form-label">Upload Driving Licence</label>
                                                                            <input class="form-control" type="file" id="edit_driving_license_path" name="driving_license_path">
                                                                            <span class="text-danger invalid driving_license_path_err"></span>
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="driving_license_validity" class="form-label">Driving Licence Exp Date</label>
                                                                            <input type="date" class="form-control" id="edit_driving_license_validity" name="driving_license_validity">
                                                                            <span class="text-danger invalid driving_license_validity_err"></span>
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->

                                                                        <div class="col-md-4">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="des-info-description-input">Remark / Description </label>
                                                                                <textarea class="form-control" placeholder="Enter Description" id="edit_remark" rows="3" name="remark"></textarea>
                                                                                <div class="invalid-feedback">Please enter a description if any</div>
                                                                                <span class="text-danger invalid remark_err"></span>
                                                                            </div>
                                                                        </div>

                                                                </div>

                                                            </div>
                                                            <!-- end tab pane -->

                                                        </div>
                                                        <!-- end tab content -->
                                                    {{-- </form>x --}}
                                                </div>
                                                <!-- end card body -->
                                            </div>
                                            <!-- end card -->
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary" id="editSubmit">Submit</button>
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                    </div>
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
                                            <thead style="background-color: rgba(var(--vz-light-rgb), .75);">
                                                <tr>
                                                    <th class="table-srno-column">Sr No.</th>
                                                    <th>Name</th>
                                                    <th>Contact</th>
                                                    <th>Email</th>
                                                    <th>State</th>
                                                    <th>City</th>
                                                    <th>Pincode</th>
                                                    <th>Basic Salary</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($drivermaster as $drivermasters)
                                                <?php
                                                if($drivermasters->status == 1){
                                                    $status = 'Active';
                                                }else{
                                                    $status = 'Inactive';
                                                }
                                                ?>
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $drivermasters->first_name }} {{ $drivermasters->last_name }}</td>
                                                        <td>{{ $drivermasters->mobile_no }}</td>
                                                        <td>{{ $drivermasters->email }}</td>
                                                        <td>{{ $drivermasters->states->stateName }}</td>
                                                        <td>{{ $drivermasters->city }}</td>
                                                        <td>{{ $drivermasters->pincode }}</td>
                                                        <td>{{ $drivermasters->basic_salary }}</td>
                                                        <td>{{ $status }}</td>
                                                        <td>
                                                            @can('statemasters.edit')
                                                                <button class="edit-element btn btn-secondary px-2 py-1" title="Edit driver" data-id="{{ $drivermasters->id }}"><i data-feather="edit"></i></button>
                                                            @endcan
                                                            @can('statemasters.delete')
                                                                <button class="btn btn-danger rem-element px-2 py-1" title="Delete driver" data-id="{{ $drivermasters->id }}"><i data-feather="trash-2"></i> </button>
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

    });
</script>
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
         // Global error handling functions
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
            url: '{{ route('driver-master.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('driver-master.index') }}';
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

<script>
    $("#buttons-datatables").on("click", ".edit-element", function(e) {
        e.preventDefault();
        var model_id = $(this).attr("data-id");
        var url = "{{ route('driver-master.edit', ':model_id') }}";

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
            // hidden id
            $("#edit_model_id").val(data.DriverMaster.id);

            // personal details
            $("#edit_firstNameinput").val(data.DriverMaster.first_name);
            $("#edit_lastNameinput").val(data.DriverMaster.last_name);
            $("#edit_mobileNoinput").val(data.DriverMaster.mobile_no);
            $("#edit_JoingDate").val(data.DriverMaster.joining_date);
            $("#edit_Resigndate").val(data.DriverMaster.resigning_date);
            $("#edit_basicSalaryinput").val(data.DriverMaster.basic_salary);
            $("#edit_altContactinput").val(data.DriverMaster.alternate_contact_no);
            $("#edit_emailidInput").val(data.DriverMaster.email);
            $("#edit_address1ControlTextarea").val(data.DriverMaster.address);
            $("#edit_citynameInput").val(data.DriverMaster.city);
            $("#edit_pinCodeinput").val(data.DriverMaster.pincode);
            $("#edit_ForminputState").val(data.DriverMaster.state).trigger("change");
            $("#edit_ForminputStatus").val(data.DriverMaster.status).trigger("change");

            // payment details
            $("#edit_bank_name").val(data.DriverMaster.bank_name);
            $("#edit_bank_branch").val(data.DriverMaster.bank_branch);
            $("#edit_bank_account_no").val(data.DriverMaster.bank_account_no);
            $("#edit_ifsc_code").val(data.DriverMaster.ifsc_code);
            $("#edit_upi_reference_name").val(data.DriverMaster.upi_reference_name);
            $("#edit_upi_number").val(data.DriverMaster.upi_number);

            // documents
            $("#edit_aadhar_card_number").val(data.DriverMaster.aadhar_card_number);
            $("#edit_driving_license_validity").val(data.DriverMaster.driving_license_validity);
            $("#edit_remark").val(data.DriverMaster.remark);

            // dropdowns (category, master, group, sub-group)
            $("#edit_categories").val(data.DriverMaster.categories).trigger("change");
            $("#edit_master_id").val(data.DriverMaster.master_id);
            $("#edit_group_id").val(data.DriverMaster.group_id);
            $("#edit_subgroup_id_1").val(data.DriverMaster.subgroup_id);

            // =========================
            // file preview links
            // =========================
            let basePath = "/storage/"; // adjust path as per your storage

            // Aadhar
            if (data.DriverMaster.aadhar_card_path) {
            $("#edit_aadhar_card_path").next(".file-preview").remove(); // remove old preview
            $("#edit_aadhar_card_path").after(
            `<div class="file-preview mt-2">
            <a href="${basePath}${data.DriverMaster.aadhar_card_path}" target="_blank">View Aadhar</a>
            </div>`
            );
            }

            // PAN
            if (data.DriverMaster.pan_card_path) {
            $("#edit_pan_card_path").next(".file-preview").remove();
            $("#edit_pan_card_path").after(
            `<div class="file-preview mt-2">
            <a href="${basePath}${data.DriverMaster.pan_card_path}" target="_blank">View PAN</a>
            </div>`
            );
            }

            // Driving License
            if (data.DriverMaster.driving_license_path) {
            $("#edit_driving_license_path").next(".file-preview").remove();
            $("#edit_driving_license_path").after(
            `<div class="file-preview mt-2">
            <a href="${basePath}${data.DriverMaster.driving_license_path}" target="_blank">View Driving License</a>
            </div>`
            );
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

<script>
    $(document).ready(function() {
        $("#editForm").submit(function(e) {
            e.preventDefault();
            $("#editSubmit").prop('disabled', true);
            var formdata = new FormData(this);
            formdata.append('_method', 'PUT');
            var model_id = $('#edit_model_id').val();
            var url = "{{ route('driver-master.update', ':model_id') }}";

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
                            window.location.href = '{{ route('driver-master.index') }}';
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
                title: "Are you sure to delete this Driver Master?",
                icon: "warning",
                buttons: ["Cancel", "Confirm"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var model_id = $(this).attr("data-id");
                    var url = "{{ route('driver-master.destroy', ':model_id') }}";

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