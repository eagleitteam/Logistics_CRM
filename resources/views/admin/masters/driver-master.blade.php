<x-admin.layout>
    <x-slot name="title">Add New Driver Details</x-slot>
    <x-slot name="heading">Add New Driver Details</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}

                <div class="row">
                    <div class="col-sm-12">
                            <div class="card-body">
                                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                                    @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="firstNameinput" class="form-label">Frist Name</label>
                                                    <input type="text" class="form-control" placeholder="Frist Name" id="firstNameinput" name="f_name">
                                                    <span class="text-danger invalid f_name_err"></span>

                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="lastNameinput" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control" placeholder="Last Name" id="lastNameinput" name="l_name">
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
                                                <label for="JoingDate" class="form-label">Joing Date</label>
                                                <input type="date" class="form-control" id="JoingDate" name="joining_date">
                                                <span class="text-danger invalid joining_date_err"></span>
                                            </div>
                                        </div>
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
                                                    <label for="altContactinput" class="form-label">Alternet Contact Number</label>
                                                    <input type="number" class="form-control" placeholder="Alternet Contact Number" id="altContactinput" name="alternate_contact_no">
                                                    <span class="text-danger invalid alternate_contact_no_err"></span>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="emailidInput" class="form-label">Email Address</label>
                                                    <input type="email" class="form-control" placeholder="example@gamil.com" id="emailidInput" name="email">
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
                                                                                <input type="text" class="form-control" id="steparrow-gen-info-username-input" placeholder="Enter Bank IFSC Code" name="bank_ifsc_code" >
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
                                                                                <label class="form-label" for="steparrow-gen-info-username-input">Refance Person Name</label>
                                                                                <input type="text" class="form-control" id="steparrow-gen-info-username-input" placeholder="Enter Refance Person Name" name="reference_name" >
                                                                                <div class="invalid-feedback">Please enter a Refance Name</div>
                                                                                <span class="text-danger invalid reference_name_err"></span>
                                                                            </div>
                                                                        </div>
                                                                         <!--end col-->
                                                                         <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="steparrow-gen-info-username-input">Gpay or Phone Pay Number</label>
                                                                                <input type="number" class="form-control" id="steparrow-gen-info-username-input" placeholder="Enter Gpay or Phone Pay Number" name="gpay_number" >
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
                                                                            <label for="formFile" class="form-label">Upload Aadhar Card</label>
                                                                            <input class="form-control" type="file" id="formFile" name="aadhar_card_path">
                                                                            <span class="text-danger invalid aadhar_card_path_err"></span>
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="formFile" class="form-label">Upload PANCard</label>
                                                                            <input class="form-control" type="file" id="formFile" name="pan_card_path">
                                                                            <span class="text-danger invalid pan_card_path_err"></span>
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="formFile" class="form-label">Upload Driving Licence</label>
                                                                            <input class="form-control" type="file" id="formFile" name="driving_license_path">
                                                                            <span class="text-danger invalid driving_license_path_err"></span>
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="StartleaveDate" class="form-label">Driving Licence Exp Date</label>
                                                                            <input type="date" class="form-control" id="StartleaveDate" name="driving_license_validity">
                                                                            <span class="text-danger invalid driving_license_validity_err"></span>
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->

                                                                        <div class="col-md-4">
                                                                            <div class="mb-3">
                                                                                <label class="form-label" for="des-info-description-input">Remark / Description </label>
                                                                                <textarea class="form-control" placeholder="Enter Description" id="des-info-description-input" rows="3" name="remark"></textarea>
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
                    </div> <!-- end col -->
                </div>
                <!--end row-->



</x-admin.layout>


