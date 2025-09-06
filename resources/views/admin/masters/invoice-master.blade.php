<x-admin.layout>
    <x-slot name="title">Invoice Master</x-slot>
    <x-slot name="heading">Invoice Master</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


    <div class="row mb-3">
            <div class="col-md-4">
                <label for="filter_client" class="form-label">Select Client</label>
                <select id="filter_client" class="form-control">
                    <option value="">All Clients</option>
                    @foreach($clientmasters as $client)
                        <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="filter_month" class="form-label">Select Month</label>
                <select id="filter_month" class="form-control">
                    <option value="">All Months</option>
                    @foreach($months as $month)
                        <option value="{{ $month }}">{{ $month }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-8 text-end">
                <button id="editBtn" class="btn btn-primary" disabled>ADD</button>
                <button id="editBtnRoute" class="btn btn-primary" disabled>Edit</button>
            </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="table table-bordered nowrap align-middle"
                            style="width:100%">
                           <thead>
                            <tr>
                            <th></th>
                            <th>Sr No.</th>
                            <th>Unique Number</th>
                            <th>Vehical Number</th>
                            <th>POD Number</th>
                            <th>Courier</th>
                            <th>Courier Tracking Number</th>
                            <th>Courier Status</th>
                            <th>POD Status</th>
                            </tr>
                            </thead>
                             <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="podModal" tabindex="-1" aria-labelledby="podModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editForm">
        @csrf
    <input type="hidden" id="edit_model_ids" name="ids"> <!-- store multiple IDs -->
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add POD Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">


            <div class="mb-3">
                <label for="courier" class="form-label">Courier </label>
                <input type="text" class="form-control" id="edit_courier" name="courier">
                <span class="text-danger invalid courier_err"></span>

            </div>

            <div class="mb-3">
                <label for="courier_tracking_number" class="form-label">Courier Tracking Number</label>
                <input type="text" class="form-control" id="edit_courier_tracking_number" name="courier_tracking_number">
                <span class="text-danger invalid courier_tracking_number_err"></span>

            </div>

            <div class="mb-3">
                <label for="courier_date" class="form-label">Courier Date</label>
                <input type="date" class="form-control" id="edit_courier_date" name="courier_date">
                <span class="text-danger invalid courier_date_err"></span>
            </div>
            

          </div>
          <div class="modal-footer">
            <button type="submit" id="podSubmit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
    </form>
  </div>
</div>


</x-admin.layout>

<script>
            $('#editBtnRoute').on('click', function (e) {
            e.preventDefault(); // stop default button action
            window.location.href = "{{ route('trip-movement-curier-list.index') }}"; 
        });

        $(document).ready(function () {
                $("#editBtnRoute").prop('disabled', false);

            let selectedIds = [];

            var table = $('#buttons-datatables').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            searching: false,
            ajax: function(data, callback, settings) {
                // initially return empty data
                callback({ data: [], recordsTotal: 0, recordsFiltered: 0 });
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    render: function (data, type, row) {
                        if (row.courier_status == 1) {
                    return '<input type="checkbox" class="rowCheckbox" value="' + data + '" checked disabled>';
                } else {
                    return '<input type="checkbox" class="rowCheckbox" value="' + data + '">';
                }
                    },
                    orderable: false,
                    searchable: false
                },
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'unique_no', name: 'unique_no'},
                {data: 'VehicalNumber.vehicle_number', name: 'VehicalNumber.vehicle_number'},
                {data: 'pod_no', name: 'pod_no'},
                {data: 'courier', name: 'courier'},
                {data: 'courier_tracking_number', name: 'courier_tracking_number'},
                {data: 'courier_status', name: 'courier_status'},
                {data: 'pod_status', name: 'pod_status'}
            ]
        });



        $('#filter_client').on('change', function () {
            let clientId = $(this).val();

            if (clientId) {
                table.ajax.url("{{ route('add-courier-trip-movement.index') }}?client_id=" + clientId).load();
            } else {
                // clear table if "All Clients" is chosen
                table.clear().draw();
            }
        });


            // ✅ Select all
            $('#selectAll').on('change', function () {
                $('.rowCheckbox').prop('checked', $(this).prop('checked')).trigger('change');
            });

            // ✅ Track selected IDs

            // ✅ Edit button click → open modal with first selected ID
        $('#editBtn').on('click', function () {
            if (selectedIds.length === 0) return;

            // save selected ids into hidden input
            $("#edit_model_ids").val(selectedIds.join(",")); 

            // fetch first record only to prefill the form
            $.ajax({
                url: "{{ route('add-courier-trip-movement.bulkEdit') }}",
                type: 'POST',
                data: {
                    ids: selectedIds,
                    _token: "{{ csrf_token() }}"
                },
                success: function (data) {
                    if (data.result && data.records.length > 0) {
                        let record = data.records[0]; // just show first record for preview

                        $("#editForm")[0].reset();
                        $("#edit_pod_no").val(record.pod_no);
                        $("#edit_courier").val(record.courier);
                        $("#edit_courier_tracking_number").val(record.courier_tracking_number);
                        $("#edit_courier_date").val(record.courier_date);

                        if (record.pod_document) {
                            $("#edit_pod_document_view").attr("href", "/storage/" + record.pod_document).show();
                        } else {
                            $("#edit_pod_document_view").hide();
                        }

                        $("#podModal").modal('show');
                    } else {
                        swal("Error!", "No record found for editing", "error");
                    }
                }
            });
        });

        $('#editForm').on('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);
            formData.append("_token", "{{ csrf_token() }}");

            $.ajax({
                url: "{{ route('add-courier-trip-movement.updateBulk') }}", // 👈 new route
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    swal("Success!", response.success, "success").then(() => {
                        $("#podModal").modal("hide");
                        $('#buttons-datatables').DataTable().ajax.reload(null, false);
                        selectedIds = [];
                        $("#editBtn, #deleteBtn").prop('disabled', true);
                    });
                },
                error: function (xhr) {
                    swal("Error!", "Something went wrong", "error");
                }
            });
        });



            $('#buttons-datatables').on('change', '.rowCheckbox', function () {
            let id = $(this).val();

            if ($(this).prop('checked')) {
                if (!selectedIds.includes(id)) selectedIds.push(id);
            } else {
                selectedIds = selectedIds.filter(x => x !== id);
            }

            $("#editBtn, #deleteBtn").prop('disabled', selectedIds.length === 0);
        });

            // ✅ Edit button click → open modal with first selected ID
            // ✅ Edit button click → open modal with first selected ID
        // ✅ Bulk Delete button click → delete all selected




            
        });
</script>

{{-- Add --}}
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('invoicemaster.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('invoicemaster.index') }}';
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


