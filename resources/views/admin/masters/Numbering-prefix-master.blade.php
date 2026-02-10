<x-admin.layout>
    <x-slot name="title">Financial Year Master</x-slot>
    <x-slot name="heading">Financial Year Master</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


    <!-- Add Form -->
    <div class="row" id="addContainer" style="display:none;">
        <div class="col-sm-12">
            <div class="card">
                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="prefixYear" class="form-label">Year</label>
                                <select class="form-control" id="prefixYear" name="year">
                                    <option value="">-- Select Year --</option>
                                    @foreach($yearmasters as $yearmaster)
                                        <option value="{{ $yearmaster->id }}">{{ $yearmaster->title }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger invalid year_err"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="prefixType" class="form-label">Type</label>
                                <select class="form-select" id="prefixType" name="type" >
                                    <option value="">Select Type</option>
                                    <option value="1">Invoice</option>
                                    <option value="2">Cash Memo</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="prefixPre" class="form-label">Pre Fix</label>
                                <input type="text" class="form-control" id="prefixPre" name="prefix" maxlength="8">
                                <small class="text-muted">Max 8 characters</small>
                            </div>
                            <div class="col-md-4">
                                <label for="prefixDigits" class="form-label">Numbering Digits</label>
                                <select class="form-select" id="prefixDigits" name="digits" required>
                                    <option value="3">3 (001)</option>
                                    <option value="4">4 (0001)</option>
                                    <option value="5">5 (00001)</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="prefixPost" class="form-label">Post Fix</label>
                                <input type="text" class="form-control" id="prefixPost" name="postfix" maxlength="8">
                                <small class="text-muted">Max 8 characters</small>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="alert alert-info">
                                <strong>Sample Format:</strong> 
                                <span id="sampleFormat" >PRE/0001/POST</span>
                                <input type="hidden" name="sampleFormat" id="hiddenSampleFormat" value="">
                                <span id="formatLength" class="float-end">Length: <span id="lengthCount">12</span>/16 characters</span>
                            </div>
                            <div id="lengthWarning" class="alert alert-danger d-none">
                                Format exceeds 16 characters! Please adjust your pre/post fix.
                            </div>
                        </div>
                    </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="prefixStatus" class="form-label">Status</label>
                                <select class="form-select" id="prefixStatus" name="status" >
                                    <option value="1" selected>Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>
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
<!-- <div class="row" id="editContainer" style="display:none;">
        <div class="col">
            <form class="form-horizontal form-bordered" method="post" id="editForm">
                @csrf
                <section class="card">
                    <header class="card-header">
                        <h4 class="card-title">Edit Year Master</h4>
                    </header>

                    <div class="card-body py-2">
                        <input type="hidden" id="edit_model_id" name="edit_model_id" value="">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="prefixYear" class="form-label">Year</label>
                                <select class="form-control" id="prefixYear" name="year">
                                    <option value="">-- Select Year --</option>
                                    @foreach($yearmasters as $yearmaster)
                                        <option value="{{ $yearmaster->id }}">{{ $yearmaster->title }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger invalid year_err"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="prefixType" class="form-label">Type</label>
                                <select class="form-select" id="prefixType" name="type">
                                    <option value="">Select Type</option>
                                    <option value="1">Invoice</option>
                                    <option value="2">Cash Memo</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="prefixPre" class="form-label">Pre Fix</label>
                                <input type="text" class="form-control" id="prefixPre" name="prefix" maxlength="8">
                                <small class="text-muted">Max 8 characters</small>
                            </div>
                            <div class="col-md-4">
                                <label for="prefixDigits" class="form-label">Numbering Digits</label>
                                <select class="form-select" id="prefixDigits" name="digits" required>
                                    <option value="3">3 (001)</option>
                                    <option value="4">4 (0001)</option>
                                    <option value="5">5 (00001)</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="prefixPost" class="form-label">Post Fix</label>
                                <input type="text" class="form-control" id="prefixPost" name="postfix" maxlength="8">
                                <small class="text-muted">Max 8 characters</small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="alert alert-info">
                                    <strong>Sample Format:</strong>
                                    <span id="sampleFormat">PRE/0001/POST</span>
                                    <input type="hidden" name="sampleFormat" id="hiddenSampleFormat" value="">
                                    <span id="formatLength" class="float-end">
                                        Length: <span id="lengthCount">12</span>/16 characters
                                    </span>
                                </div>
                                <div id="lengthWarning" class="alert alert-danger d-none">
                                    Format exceeds 16 characters! Please adjust your pre/post fix.
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="prefixStatus" class="form-label">Status</label>
                                <select class="form-select" id="prefixStatus" name="status">
                                    <option value="1" selected>Active</option>
                                    <option value="2">Inactive</option>
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
</div> -->
<!-- Edit Form (updated IDs) -->
<div class="row" id="editContainer" style="display:none;">
    <div class="col">
        <form class="form-horizontal form-bordered" method="post" id="editForm">
            @csrf
            <section class="card">
                <header class="card-header">
                    <h4 class="card-title">Edit Year Master</h4>
                </header>

                <div class="card-body py-2">
                    <input type="hidden" id="edit_model_id" name="edit_model_id" value="">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editPrefixYear" class="form-label">Year</label>
                            <select class="form-control" id="editPrefixYear" name="year">
                                <option value="">-- Select Year --</option>
                                @foreach($yearmasters as $yearmaster)
                                    <option value="{{ $yearmaster->id }}">{{ $yearmaster->title }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger invalid year_err"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="editPrefixType" class="form-label">Type</label>
                            <select class="form-select" id="editPrefixType" name="type">
                                <option value="">Select Type</option>
                                <option value="1">Invoice</option>
                                <option value="2">Cash Memo</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="editPrefixPre" class="form-label">Pre Fix</label>
                            <input type="text" class="form-control" id="editPrefixPre" name="prefix" maxlength="8">
                            <small class="text-muted">Max 8 characters</small>
                        </div>
                        <div class="col-md-4">
                            <label for="editPrefixDigits" class="form-label">Numbering Digits</label>
                            <select class="form-select" id="editPrefixDigits" name="digits" required>
                                <option value="3">3 (001)</option>
                                <option value="4">4 (0001)</option>
                                <option value="5">5 (00001)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="editPrefixPost" class="form-label">Post Fix</label>
                            <input type="text" class="form-control" id="editPrefixPost" name="postfix" maxlength="8">
                            <small class="text-muted">Max 8 characters</small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="alert alert-info">
                                <strong>Sample Format:</strong>
                                <span id="editSampleFormat">PRE/0001/POST</span>
                                <input type="hidden" name="sampleFormat" id="editHiddenSampleFormat" value="">
                                <span id="editFormatLength" class="float-end">
                                    Length: <span id="editLengthCount">12</span>/16 characters
                                </span>
                            </div>
                            <div id="editLengthWarning" class="alert alert-danger d-none">
                                Format exceeds 16 characters! Please adjust your pre/post fix.
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editPrefixStatus" class="form-label">Status</label>
                            <select class="form-select" id="editPrefixStatus" name="status">
                                <option value="1" selected>Active</option>
                                <option value="2">Inactive</option>
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
            @can('numberingprefix.create')
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <button id="addToTable" class="btn btn-primary">
                                    Add <i class="fa fa-plus"></i>
                                </button>
                                <button id="btnCancel" class="btn btn-danger" style="display:none;">
                                    Cancel
                                </button>
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
                                <th>Sr. No.</th>
                                <th>Year</th>
                                <th>Type</th>
                                <th>Pre Fix</th>
                                <th>Numbering Dig</th>
                                <th>Post Fix</th>
                                <th>Sample Format</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($numberingprefixes as $numberingprefixes)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $numberingprefixes->years?->title }}</td>
                                    <td>{{ $numberingprefixes->type == 1 ? 'Invoice' : ($numberingprefixes->type == 2 ? 'Cash Memo' : '-') }}</td>
                                    <td>{{ $numberingprefixes->prefix }}</td>
                                    <td>{{ $numberingprefixes->digits }}</td>
                                    <td>{{ $numberingprefixes->postfix }}</td>
                                    <td>{{ $numberingprefixes->sampleFormat }}</td>
                                    <td>
                                        @if($numberingprefixes->status == '1')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>   
                                        @endif
                                    </td>
                                    <td>
                                        @can('numberingprefix.edit')
                                            <button class="edit-element btn btn-secondary px-2 py-1" 
                                                    title="Edit Numbering Prefix" 
                                                    data-id="{{ $numberingprefixes->id }}">
                                                <i data-feather="edit"></i>
                                            </button>
                                        @endcan

                                        @can('numberingprefix.delete')
                                            <button class="btn btn-danger rem-element px-2 py-1" 
                                                    title="Delete Numbering Prefix" 
                                                    data-id="{{ $numberingprefixes->id }}">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




</x-admin.layout>

<!-- Add Form pre fix and post fix format script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get form elements
    const preFixInput = document.getElementById('prefixPre');
    const postFixInput = document.getElementById('prefixPost');
    const digitsSelect = document.getElementById('prefixDigits');
    const sampleFormat = document.getElementById('sampleFormat');
    const lengthCount = document.getElementById('lengthCount');
    const lengthWarning = document.getElementById('lengthWarning');
    const saveBtn = document.getElementById('saveFormatBtn');
    
    // Function to update sample format
    function updateSampleFormat() {
        const preFix = preFixInput.value || 'PRE';
        const postFix = postFixInput.value || 'POST';
        const digits = parseInt(digitsSelect.value) || 4;
        
        // Create sample number with leading zeros
        const sampleNumber = '0'.repeat(digits - 1) + '1';
        
        // Construct full format
        const fullFormat = `${preFix}/${sampleNumber}/${postFix}`;
        const formatLength = fullFormat.length;
        
        // Update display
        sampleFormat.textContent = fullFormat;
        document.getElementById('hiddenSampleFormat').value = fullFormat;
        lengthCount.textContent = formatLength;
        
        // Check length limit
        if (formatLength > 16) {
            lengthCount.classList.add('text-danger');
            lengthWarning.classList.remove('d-none');
            saveBtn.disabled = true;
        } else {
            lengthCount.classList.remove('text-danger');
            lengthWarning.classList.add('d-none');
            saveBtn.disabled = false;
        }
        
        // Calculate maximum allowed post-fix length
        const maxPostFixLength = 16 - (preFix.length + digits + 2); // +2 for the slashes
        if (maxPostFixLength < 0) {
            postFixInput.setAttribute('maxlength', '0');
        } else {
            postFixInput.setAttribute('maxlength', maxPostFixLength.toString());
        }
    }
    
    // Add event listeners
    preFixInput.addEventListener('input', updateSampleFormat);
    postFixInput.addEventListener('input', updateSampleFormat);
    digitsSelect.addEventListener('change', updateSampleFormat);
    
    // Initial update
    updateSampleFormat();
});
</script>

<style>
#sampleFormat {
    font-family: monospace;
    font-weight: bold;
}
</style>

<!-- Edit Form prefix and postfix format script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get edit form elements
    const preFixInput = document.getElementById('editPrefixPre');
    const postFixInput = document.getElementById('editPrefixPost');
    const digitsSelect = document.getElementById('editPrefixDigits');
    const sampleFormat = document.getElementById('editSampleFormat');
    const lengthCount = document.getElementById('editLengthCount');
    const lengthWarning = document.getElementById('editLengthWarning');
    const saveBtn = document.getElementById('editSubmit'); // submit button
    
    // Function to update sample format for edit form
    function updateEditSampleFormat() {
        const preFix = preFixInput.value || 'PRE';
        const postFix = postFixInput.value || 'POST';
        const digits = parseInt(digitsSelect.value) || 4;
        
        // Create sample number with leading zeros
        const sampleNumber = '0'.repeat(digits - 1) + '1';
        
        // Construct full format
        const fullFormat = `${preFix}/${sampleNumber}/${postFix}`;
        const formatLength = fullFormat.length;
        
        // Update display
        sampleFormat.textContent = fullFormat;
        document.getElementById('editHiddenSampleFormat').value = fullFormat;
        lengthCount.textContent = formatLength;
        
        // Check length limit
        if (formatLength > 16) {
            lengthCount.classList.add('text-danger');
            lengthWarning.classList.remove('d-none');
            saveBtn.disabled = true;
        } else {
            lengthCount.classList.remove('text-danger');
            lengthWarning.classList.add('d-none');
            saveBtn.disabled = false;
        }
        
        // Calculate maximum allowed post-fix length
        const maxPostFixLength = 16 - (preFix.length + digits + 2); // +2 for slashes
        if (maxPostFixLength < 0) {
            postFixInput.setAttribute('maxlength', '0');
        } else {
            postFixInput.setAttribute('maxlength', maxPostFixLength.toString());
        }
    }
    
    // Add event listeners
    preFixInput.addEventListener('input', updateEditSampleFormat);
    postFixInput.addEventListener('input', updateEditSampleFormat);
    digitsSelect.addEventListener('change', updateEditSampleFormat);
    
    // Initial update
    updateEditSampleFormat();
});
</script>

<style>
#editSampleFormat {
    font-family: monospace;
    font-weight: bold;
}
</style>



{{-- Add --}}
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('numbering-prefix-master.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('numbering-prefix-master.index') }}';
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
        var url = "{{ route('numbering-prefix-master.edit', ':model_id') }}";

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
                    $("#editForm input[name='edit_model_id']").val(data.numberingprefix.id);
                    $("#editForm select[name='year']").val(data.numberingprefix.year);
                    $("#editForm select[name='type']").val(data.numberingprefix.type);
                    $("#editForm input[name='prefix']").val(data.numberingprefix.prefix);
                    $("#editForm select[name='digits']").val(data.numberingprefix.digits);
                    $("#editForm input[name='postfix']").val(data.numberingprefix.postfix);
                    // $("#editForm input[name='sampleFormat']").val(data.numberingprefix.sampleFormat);
                    $("#editForm select[name='status']").val(data.numberingprefix.status);
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
            var url = "{{ route('numbering-prefix-master.update', ':model_id') }}";

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
                            window.location.href = '{{ route('numbering-prefix-master.index') }}';
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
                title: "Are you sure to delete this numbering Prefix Master?",
                icon: "warning",
                buttons: ["Cancel", "Confirm"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var model_id = $(this).attr("data-id");
                    var url = "{{ route('numbering-prefix-master.destroy', ':model_id') }}";

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

