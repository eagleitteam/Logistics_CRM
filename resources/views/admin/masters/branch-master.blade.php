<x-admin.layout>
    <x-slot name="title">Branch Master</x-slot>
    <x-slot name="heading">Add Branch Master</x-slot>
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
                                <label class="col-form-label" for="branch_code">Branch Code <span class="text-danger">*</span></label>
                                <input class="form-control" id="branch_code" name="branch_code" type="text" placeholder="Enter Branch Code">
                                <span class="text-danger invalid branch_code_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="branch_location">Branch Location <span class="text-danger">*</span></label>
                                <input class="form-control" id="branch_location" name="branch_location" type="text" placeholder="Enter Branch Location">
                                <span class="text-danger invalid branch_location_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="head_of_branch">Head of Branch: <span class="text-danger">*</span></label>
                                <input class="form-control" id="head_of_branch" name="head_of_branch" type="text" placeholder="Enter Head of Branch Name">
                                <span class="text-danger invalid head_of_branch_err"></span>
                            </div>
                            
                            <div class="col-md-4">
                                <label class="col-form-label" for="remark">Remark</label>
                                <input class="form-control" id="remark" name="remark" type="text" placeholder="Mention Remark If Any">

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
                                <label class="col-form-label" for="branch_code">Branch Code <span class="text-danger">*</span></label>
                                <input class="form-control" id="branch_code" name="branch_code" type="text" placeholder="Enter Branch Code">
                                <span class="text-danger invalid branch_code_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="branch_location">Branch Location <span class="text-danger">*</span></label>
                                <input class="form-control" id="branch_location" name="branch_location" type="text" placeholder="Enter Branch Location">
                                <span class="text-danger invalid branch_location_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="head_of_branch">Head of Branch: <span class="text-danger">*</span></label>
                                <input class="form-control" id="head_of_branch" name="head_of_branch" type="text" placeholder="Enter Head of Branch Name">
                                <span class="text-danger invalid head_of_branch_err"></span>
                            </div>
                            
                            <div class="col-md-4">
                                <label class="col-form-label" for="remark">Remark</label>
                                <input class="form-control" id="remark" name="remark" type="text" placeholder="Mention Remark If Any">

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
                @can('branchmaster.create')
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
                                @foreach ($branchmasters as $branchmasters)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $branchmasters->branch_code }}</td>
                                        <td>{{ $branchmasters->branch_location }}</td>
                                        <td>{{ $branchmasters->head_of_branch }}</td>
                                        <td>{{ $branchmasters->remark }}</td>
                                        <td>
                                            {{ $branchmasters->status == 1 ? 'Active' : ($branchmasters->status == 2 ? 'Inactive' : '')}}
                                        </td>
                                        <td>
                                            @can('branchmaster.edit')
                                                <button class="edit-element btn btn-secondary px-2 py-1" title="Edit Vehicle" data-id="{{ $branchmasters->id }}"><i data-feather="edit"></i></button>
                                            @endcan
                                            @can('branchmaster.delete')
                                                <button class="btn btn-danger rem-element px-2 py-1" title="Delete Vehicle" data-id="{{ $branchmasters->id }}"><i data-feather="trash-2"></i> </button>
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
            url: '{{ route('branch-master.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('branch-master.index') }}';
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
        var url = "{{ route('branch-master.edit', ':model_id') }}";

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
                    $("#editForm input[name='edit_model_id']").val(data.branchmaster.id);
                    $("#editForm input[name='branch_code']").val(data.branchmaster.branch_code);
                    $("#editForm input[name='branch_location']").val(data.branchmaster.branch_location);
                    $("#editForm input[name='head_of_branch']").val(data.branchmaster.head_of_branch);
                    $("#editForm input[name='remark']").val(data.branchmaster.remark);
                    $("#editForm select[name='status']").val(data.branchmaster.status);
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
            var url = "{{ route('branch-master.update', ':model_id') }}";

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
                            window.location.href = '{{ route('branch-master.index') }}';
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
                title: "Are you sure to delete this Branch Master?",
                icon: "warning",
                buttons: ["Cancel", "Confirm"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var model_id = $(this).attr("data-id");
                    var url = "{{ route('branch-master.destroy', ':model_id') }}";

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