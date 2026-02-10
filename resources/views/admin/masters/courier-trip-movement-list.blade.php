<x-admin.layout>
    <x-slot name="title">Add Courier Trip Movement</x-slot>
    <x-slot name="heading">Add Courier Trip Movement</x-slot>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="">
                                    <button id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="table table-bordered nowrap align-middle"
                               style="width:100%">
                            <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Unique Number</th>
                                <th>Vehical Number</th>
                                <th>POD Number</th>
                                <th>Courier</th>
                                <th>Courier Tracking Number</th>
                                <th>Courier Status</th>
                                <th>POD Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tripMovements as $movement)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $movement->unique_no }}</td>
                                    <td>{{ $movement->VehicalNumber->vehicle_number }}</td>
                                    <td>{{ $movement->pod_no }}</td>
                                    <td>{{ $movement->courier }}</td>
                                    <td>{{ $movement->courier_tracking_number }}</td>
                                    <td>{{ $movement->courier_status }}</td>
                                    <td>{{ $movement->pod_status }}</td>
                                    <td>
                                        <button class="edit-element btn btn-secondary px-2 py-1"
                                                title="Edit courier trip" data-id="{{ $movement->id }}">
                                            <i data-feather="edit"></i>
                                        </button>
                                        <button class="btn btn-danger rem-element px-2 py-1"
                                                title="Delete courier trip" data-id="{{ $movement->id }}">
                                            <i data-feather="trash-2"></i>
                                        </button>
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

    <!-- Modal -->
    <div class="modal fade" id="podModal" tabindex="-1" aria-labelledby="podModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editForm">
                @csrf
                <input type="hidden" id="edit_model_id" name="id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add / Update POD Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="edit_courier" class="form-label">Courier</label>
                            <input type="text" class="form-control" id="edit_courier" name="courier">
                            <span class="text-danger invalid courier_err"></span>
                        </div>

                        <div class="mb-3">
                            <label for="edit_courier_tracking_number" class="form-label">Courier Tracking Number</label>
                            <input type="text" class="form-control" id="edit_courier_tracking_number" name="courier_tracking_number">
                            <span class="text-danger invalid courier_tracking_number_err"></span>
                        </div>

                        <div class="mb-3">
                            <label for="edit_courier_date" class="form-label">Courier Date</label>
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

    $('#addToTable').on('click', function (e) {
    e.preventDefault(); // stop default button action
    window.location.href = "{{ route('add-courier-trip-movement.index') }}"; 
});

    // Edit button click → open modal
    $('#buttons-datatables').on('click', '.edit-element', function () {
        let id = $(this).data('id');

        $.ajax({
            url: "{{ route('trip-movement-courier.bulkEdit') }}",
            type: 'POST',
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function (data) {
                if (data.result) {
                    let record = data.record;

                    $("#editForm")[0].reset();
                    $("#edit_model_id").val(record.id);
                    $("#edit_courier").val(record.courier);
                    $("#edit_courier_tracking_number").val(record.courier_tracking_number);
                    $("#edit_courier_date").val(record.courier_date);

                    $("#podModal").modal('show');
                } else {
                    swal("Error!", "Record not found", "error");
                }
            }
        });
    });

    // Submit update
    $('#editForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('trip-movement-courier.updateBulk') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                swal("Success!", response.success, "success").then(() => {
                    $("#podModal").modal("hide");
                    location.reload(); // refresh table
                });
            },
            error: function () {
                swal("Error!", "Something went wrong", "error");
            }
        });
    });
</script>

<script>
    // Edit button click → open modal
    $('#buttons-datatables').on('click', '.edit-element', function () {
        let id = $(this).data('id');

        $.ajax({
            url: "{{ route('trip-movement-courier.bulkEdit') }}",
            type: 'POST',
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function (data) {
                if (data.result) {
                    let record = data.record;

                    $("#editForm")[0].reset();
                    $("#edit_model_id").val(record.id);
                    $("#edit_courier").val(record.courier);
                    $("#edit_courier_tracking_number").val(record.courier_tracking_number);
                    $("#edit_courier_date").val(record.courier_date);

                    $("#podModal").modal('show');
                } else {
                    swal("Error!", "Record not found", "error");
                }
            }
        });
    });

    // Submit update
    $('#editForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('trip-movement-courier.updateBulk') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                swal("Success!", response.success, "success").then(() => {
                    $("#podModal").modal("hide");
                    location.reload(); // refresh table
                });
            },
            error: function () {
                swal("Error!", "Something went wrong", "error");
            }
        });
    });

    // Delete courier details (nullify fields instead of deleting row)
    $('#buttons-datatables').on('click', '.rem-element', function () {
        let id = $(this).data('id');

        swal({
            title: "Are you sure?",
            text: "This will clear courier details for all records with the same courier & tracking number.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "{{ route('trip-movement-courier.deleteBulk') }}",
                    type: "POST",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        swal("Success!", response.success, "success").then(() => {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        let errorMessage = "Something went wrong";
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMessage = xhr.responseJSON.error;
                        }
                        swal("Error!", errorMessage, "error");
                    }
                });
            }
        });
    });
</script>