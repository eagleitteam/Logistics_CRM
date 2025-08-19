<x-admin.layout>
    <x-slot name="title"> Sub Group Master</x-slot>
    <x-slot name="heading"> Sub Group Master</x-slot>
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
                                <label class="col-form-label" for="master_group_id">Master Group Name <span class="text-danger">*</span></label>
                                   <select class="form-select " id="master_group_id" name="master_group_id">
                                    <option value="" selected>Selected ...</option>
                                    @foreach($MasterGroup as $group)
                                    <option value="{{$group->id}}">{{$group->master_group_name}}</option>
                                    @endforeach
                                </select>           
                               <span class="text-danger invalid master_group_id_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="master_group_category_id">Master Group Category Name <span class="text-danger">*</span></label>
                                   <select class="form-select " id="master_group_category_id" name="master_group_category_id">
                                    <option value="" selected>Selected ...</option>
                                    @foreach($MasterGroupCategory as $group_category)
                                    <option value="{{$group_category->id}}">{{$group_category->group_name}}</option>
                                    @endforeach
                                </select>           
                               <span class="text-danger invalid master_group_id_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="sub_group_name"> Sub Group Master Name <span class="text-danger">*</span></label>
                                <input class="form-control" id="sub_group_name" name="sub_group_name" type="text" placeholder="Enter Sub Group Name">
                                <span class="text-danger invalid sub_group_name_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="dr_cr">Debit / Credit <span class="text-danger">*</span></label>
                                <select class="form-select " id="dr_cr" name="dr_cr">
                                    <option value="" selected>Selected ...</option>
                                    <option value="1">Debit</option>
                                    <option value="2">Credit</option>
                                </select>
                                <span class="text-danger invalid dr_cr_err"></span>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success" id="addSubmit">Submit</button>
                        <button type="reset" id="resetfrom" class="btn btn-warning">Reset</button>
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
                        <h4 class="card-title">Edit Sub Group Master </h4>
                    </header>

                    <div class="card-body py-2">

                        <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                        <div class="mb-3 row">
                             <div class="col-md-4">
                                <label class="col-form-label" for="master_group_id">Master Group Name <span class="text-danger">*</span></label>
                                   <select class="form-select " id="edit_master_group_id" name="master_group_id">
                                    <option value="" selected>Selected ...</option>
                                    @foreach($MasterGroup as $group)
                                    <option value="{{$group->id}}">{{$group->master_group_name}}</option>
                                    @endforeach
                                </select>           
                               <span class="text-danger invalid master_group_id_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="master_group_category_id">Master Group Category Name <span class="text-danger">*</span></label>
                                   <select class="form-select " id="edit_master_group_category_id" name="master_group_category_id">
                                    <option value="" selected>Selected ...</option>
                                     @foreach($MasterGroupCategory as $group_category)
                                    <option value="{{$group_category->id}}">{{$group_category->group_name}}</option>
                                    @endforeach
                                </select>           
                               <span class="text-danger invalid master_group_id_err"></span>
                            </div>

                             <div class="col-md-4">
                                <label class="col-form-label" for="group_name">Group master Category Name <span class="text-danger">*</span></label>
                                <input class="form-control" id="edit_sub_group_name" name="sub_group_name" type="text" placeholder="Enter Master Sub Group Name">
                                <span class="text-danger invalid group_name_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="dr_cr">Debit / Credit <span class="text-danger">*</span></label>
                                <select class="form-select " id="edit_dr_cr" name="dr_cr">
                                    <option value="" selected>Selected ...</option>
                                    <option value="1">Debit</option>
                                    <option value="2">Credit</option>
                                </select>
                                <span class="text-danger invalid dr_cr_err"></span>
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
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="">
                                    <button id="addToTable" class="btn btn-primary">Add Group Master Category<i class="fa fa-plus"></i></button>
                                    <button id="btnCancel" class="btn btn-danger" style="display:none;">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Group master Category Name</th>
                                    <th>Group master Category Name</th>
                                    <th>Group master Category Name</th>
                                    <th>Debit / Credit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($SubGroupMaster as $GroupsMaster)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $GroupsMaster->MasterGroup->master_group_name ?? 'N/A' }}</td>

                                        {{-- Master Group Category Name --}}
                                        <td>{{ $GroupsMaster->MasterGroupCategory->group_name ?? 'N/A' }}</td>
                                        <td>{{ $GroupsMaster->sub_group_name }}</td>
                                        @php
                                            $drCrLabel = [
                                                1 => 'Debit',
                                                2 => 'Credit',
                                            ];
                                        @endphp
                                        <td>{{ $drCrLabel[$GroupsMaster->dr_cr] ?? 'N/A' }}</td>
                                            {{-- <td>{{ $GroupsMaster->dr_cr }}</td> --}}
                                        <td>

                                                <button class="edit-element btn btn-secondary px-2 py-1" title="Edit Master Group" data-id="{{ $GroupsMaster->id }}"><i data-feather="edit"></i></button>
                                                <button class="btn btn-danger rem-element px-2 py-1" title="Delete Master Group" data-id="{{ $GroupsMaster->id }}"><i data-feather="trash-2"></i> </button>
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
            url: '{{ route('sub-group-master.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('sub-group-master.index') }}';
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
        var url = "{{ route('sub-group-master.edit', ':model_id') }}";
            

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'GET',
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function(data, textStatus, jqXHR) {
                 console.log(data); // Add this
                editFormBehaviour();
                if (!data.error) {
                    $("#editForm input[name='edit_model_id']").val(data.SubGroupMaster.id);
                    $("#edit_master_group_id").val(data.SubGroupMaster.master_group_id);
                    $("#edit_master_group_category_id").val(data.SubGroupMaster.master_group_category_id);
                    $("#edit_sub_group_name").val(data.SubGroupMaster.sub_group_name);
                    $("#edit_dr_cr").val(data.SubGroupMaster.dr_cr);
                } else {
                    alert(data.error);
                }
            },
            error: function(error, jqXHR, textStatus, errorThrown) {
                alert("Something went wrong");
            },
        });
    });


       $('#master_group_id').on('change', function () {
    var masterGroupId = $(this).val();

    if (masterGroupId !== "") {
        $.ajax({
            url: "{{ route('get.master.group.categories') }}",
            type: "GET",
            data: { master_group_id: masterGroupId },
            success: function (data) {
                console.log('Received Categories:', data); // Debug

                $('#master_group_category_id').empty();

                if (data.categories && data.categories.length > 0) {
                    $.each(data.categories, function (key, category) {
                        $('#master_group_category_id').append(
                            '<option value="' + category.id + '">' + category.group_name + '</option>'
                        );
                    });
                } else {
                    $('#master_group_category_id').append('<option value="">No categories found</option>');
                }
            },
            error: function (xhr) {
                console.error('Fetch error:', xhr.responseText);
                alert("Unable to fetch categories");
            }
        });
    } else {
        $('#master_group_category_id').html('<option value="">Select Master Group first</option>');
    }
});

// EDIT FORM: On change of master group in edit form
$('#edit_master_group_id').on('change', function () {
    var masterGroupId = $(this).val();

    if (masterGroupId !== "") {
        $.ajax({
            url: "{{ route('get.master.group.categories') }}",
            type: "GET",
            data: { master_group_id: masterGroupId },
            success: function (data) {
                console.log('Edit Form - Received Categories:', data); // Debug

                $('#edit_master_group_category_id').empty();

                if (data.categories && data.categories.length > 0) {
                    $.each(data.categories, function (key, category) {
                        $('#edit_master_group_category_id').append(
                            '<option value="' + category.id + '">' + category.group_name + '</option>'
                        );
                    });
                } else {
                    $('#edit_master_group_category_id').append('<option value="">No categories found</option>');
                }
            },
            error: function (xhr) {
                console.error('Edit Form - Fetch error:', xhr.responseText);
                alert("Unable to fetch categories for edit form");
            }
        });
    } else {
        $('#edit_master_group_category_id').html('<option value="">Select Master Group first</option>');
    }
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
            var url = "{{ route('sub-group-master.update', ':model_id') }}";

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
                            window.location.href = '{{ route('sub-group-master.index') }}';
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
                title: "Are you sure to delete this vehicle type?",
                icon: "warning",
                buttons: ["Cancel", "Confirm"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var model_id = $(this).attr("data-id");
                    var url = "{{ route('sub-group-master.destroy', ':model_id') }}";

                    $.ajax({
                        url: url.replace(':model_id', model_id),
                        type: 'POST',
                        data: {
                            '_method': "DELETE",
                            '_token': "{{ csrf_token() }}"
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




