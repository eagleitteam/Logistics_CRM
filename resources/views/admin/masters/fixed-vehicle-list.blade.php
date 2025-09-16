<x-admin.layout>
    <x-slot name="title">Invoice Fix Master</x-slot>
    <x-slot name="heading">Invoice Fix Master</x-slot>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @can('invoicefixmaster.create')
                <a href="{{ route('invoicefixmaster.create') }}"
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="">
                                    <button class="btn btn-primary">Add <i class="fa fa-plus"></i></button>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endcan
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Client Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Vehicle Count</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fixvehicleclients  as $fixvehicleclients )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $fixvehicleclients?->client?->client_name}}</td>
                                        <td>{{ $fixvehicleclients->start_date}}</td>
                                        <td>{{ $fixvehicleclients->end_date}}</td>
                                        <td>{{ $fixvehicleclients->fixvehicles_count}}</td>

                                        <td>
                                            @can('invoicefixmaster.edit')
                                               <a href="{{ route('invoicefixmaster.show', $fixvehicleclients->id) }}">
                                                <button class="edit-element btn btn-secondary " title="View Invoice Fix Master" data-id="{{ $fixvehicleclients->id }}"><i data-feather="eye"></i></button>
                                                </a>
                                            @endcan
                                            @can('invoicefixmaster.delete')
                                                <button class="btn btn-danger rem-element px-2 py-1" title="Delete Invoice Fix Master" data-id="{{ $fixvehicleclients->id }}"><i data-feather="trash-2"></i> </button>
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


<!-- Delete -->
<script>
    $("#buttons-datatables").on("click", ".rem-element", function(e) {
        e.preventDefault();
        swal({
                title: "Are you sure to delete this Year Master?",
                icon: "warning",
                buttons: ["Cancel", "Confirm"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var model_id = $(this).attr("data-id");
                    var url = "{{ route('invoicefixmaster.destroy', ':model_id') }}";

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


