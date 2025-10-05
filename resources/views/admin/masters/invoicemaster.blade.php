<x-admin.layout>
    <x-slot name="title">Invoice Master List</x-slot>
    <x-slot name="heading">Invoice Master List</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @can('invoicemaster.create')
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="">
                                    <a href="{{ route('invoicemaster.create') }}" class="btn btn-primary">
                                        Add <i class="fa fa-plus"></i>
                                    </a>

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
                                    <th>Inv Date</th>
                                    <th>Inv No</th>
                                    <th>Client ID</th>
                                    <th>Net Amount</th>
                                    <th>GST Amount</th>
                                    <th>Total Amount</th>
                                    <th>Year</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoicemasters as $invoicemasters)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $invoicemasters->inv_date }}</td>
                                        <td>{{ $invoicemasters->inv_no}}</td>
                                        <td>{{ $invoicemasters->client_id}}</td>
                                        <td>{{ $invoicemasters->net_amount}}</td>
                                        <td>{{ $invoicemasters->gst_amount}}</td>
                                        <td>{{ $invoicemasters->total_amount}}</td>
                                        <td>{{ $invoicemasters->year_id}}</td>
                                        <td>
                                            @can('invoicemaster.edit')
                                                <a href="{{ route('invoicemaster.show', $invoicemasters->id) }}" 
                                                    class="btn btn-secondary px-2 py-1" 
                                                    title="View Invoice PDF" 
                                                    target="_blank">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                            @endcan
                                            @can('invoicemaster.delete')
                                                <button class="btn btn-danger rem-element px-2 py-1" title="Delete Invoicemaster" data-id="{{ $invoicemasters->id }}"><i data-feather="trash-2"></i> </button>
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
                    var url = "{{ route('invoiceadhoc.destroy', ':model_id') }}";

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

