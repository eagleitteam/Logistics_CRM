<x-admin.layout>
    <x-slot name="title">Department Master</x-slot>
    <x-slot name="heading">Add Department Master</x-slot>
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
                                <label class="col-form-label" for="department_code">Department Code <span class="text-danger">*</span></label>
                                <input class="form-control" id="department_code" name="department_code" type="text" placeholder="Enter Department Code">
                                <span class="text-danger invalid department_code_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="department_name">Department Name <span class="text-danger">*</span></label>
                                <input class="form-control" id="department_name" name="department_name" type="text" placeholder="Enter Department Name">
                                <span class="text-danger invalid department_name_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="head_of_department">Head of Department: <span class="text-danger">*</span></label>
                                <input class="form-control" id="head_of_department" name="head_of_department" type="text" placeholder="Enter Head of Department Name">
                                <span class="text-danger invalid head_of_department_err"></span>
                            </div>
                            
                            <div class="col-md-4">
                                <label class="col-form-label" for="Remark">Remark</label>
                                <input class="form-control" id="Remark" name="Remark" type="text" placeholder="Mention Remark If Any">

                            </div>
                            <div class="col-md-4">
                                <label for="FormSelectBankType" class="col-form-label">Branch Location<span class="text-danger">*</span></label>
                                                    <select id="FormSelectBankType" name="branch_locations" class="form-select" data-choices data-choices-sorting="true">
                                                        <option value="1" selected>Head Office</option>
                                                        <option value="3" >Delhi Branch</option>
                                                        <option value="2" >Gujrat Branch</option>
                                                    </select>
                                <span class="text-danger invalid branch_locations_err"></span>
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
                        <h4 class="card-title">Edit Department Details</h4>
                    </header>

                    <div class="card-body py-2">

                        <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                        <div class="mb-3 row">
                                <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="col-form-label" for="department_code">Department Code <span class="text-danger">*</span></label>
                                <input class="form-control" id="department_code" name="department_code" type="text" placeholder="Enter Department Code">
                                <span class="text-danger invalid department_code_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="department_name">Department Name <span class="text-danger">*</span></label>
                                <input class="form-control" id="department_name" name="department_name" type="text" placeholder="Enter Department Name">
                                <span class="text-danger invalid department_name_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="head_of_department">Head of Department: <span class="text-danger">*</span></label>
                                <input class="form-control" id="head_of_department" name="head_of_department" type="text" placeholder="Enter Head of Department Name">
                                <span class="text-danger invalid head_of_department_err"></span>
                            </div>
                            
                            <div class="col-md-4">
                                <label class="col-form-label" for="Remark">Remark</label>
                                <input class="form-control" id="Remark" name="Remark" type="text" placeholder="Mention Remark If Any">

                            </div>
                            <div class="col-md-4">
                                <label for="FormSelectBankType" class="col-form-label">Branch Location<span class="text-danger">*</span></label>
                                                    <select id="FormSelectBankType" name="branch_locations" class="form-select" data-choices data-choices-sorting="true">
                                                        <option value="1" selected>Head Office</option>
                                                        <option value="3" >Delhi Branch</option>
                                                        <option value="2" >Gujrat Branch</option>
                                                    </select>
                                <span class="text-danger invalid branch_locations_err"></span>
                            </div>
                            <div class="col-md-4">  
                                <label class="col-form-label" for="status" > Active / Inactive</label>
                                <select id="ForminputState" class="form-select" name="status">
                                    <option value="">Choose...</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                                <span class="text-danger invalid status_err"></span>
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
                @can('departmentmasters.create')
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
                                    <th>Department Code</th>
                                    <th>Department Name</th>
                                    <th>Head of Department</th>
                                    <th>Branch Location</th>
                                    <th>Remark</th>
                                    <th>status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departmentmasters as $departmentmasters)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $departmentmasters->department_code }}</td>
                                        <td>{{ $departmentmasters->department_name }}</td>
                                        <td>{{ $departmentmasters->head_of_department }}</td>
                                        <td>{{ $departmentmasters->branch_locations }}</td>
                                        <td>{{ $departmentmasters->Remark }}</td>
                                        <td>
                                            {{ $departmentmasters->status == 1 ? 'Active' : ($departmentmasters->status == 2 ? 'Inactive' : '')}}
                                        </td>
                                        <td>
                                            @can('departmentmasters.edit')
                                                <button class="edit-element btn btn-secondary px-2 py-1" title="Edit Vehicle" data-id="{{ $departmentmasters->id }}"><i data-feather="edit"></i></button>
                                            @endcan
                                            @can('departmentmasters.delete')
                                                <button class="btn btn-danger rem-element px-2 py-1" title="Delete Vehicle" data-id="{{ $departmentmasters->id }}"><i data-feather="trash-2"></i> </button>
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

{{-- Add --}}
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('department-master.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('department-master.index') }}';
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
        var url = "{{ route('department-master.edit', ':model_id') }}";

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
                    $("#editForm input[name='edit_model_id']").val(data.departmentmaster.id);
                    $("#editForm input[name='department_code']").val(data.departmentmaster.department_code);
                    $("#editForm input[name='department_name']").val(data.departmentmaster.department_name);
                    $("#editForm input[name='head_of_department']").val(data.departmentmaster.head_of_department);
                    $("#editForm input[name='branch_locations']").val(data.departmentmaster.branch_locations);
                    $("#editForm input[name='Remark']").val(data.departmentmaster.Remark);
                    $("#editForm select[name='status']").val(data.departmentmaster.status);
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
            var url = "{{ route('department-master.update', ':model_id') }}";

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
                            window.location.href = '{{ route('department-master.index') }}';
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
                title: "Are you sure to delete this Department Master?",
                icon: "warning",
                buttons: ["Cancel", "Confirm"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var model_id = $(this).attr("data-id");
                    var url = "{{ route('department-master.destroy', ':model_id') }}";

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