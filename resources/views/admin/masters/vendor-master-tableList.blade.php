<x-admin.layout>
    <x-slot name="title">Add vendor Master</x-slot>
    <x-slot name="heading">Add vendor Master11</x-slot>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @can('vendormaster.create')
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
                                    <th>Company Name</th>
                                    <th>GST No.</th>
                                    <th>TDS %</th>
                                    <th>Contact Person Name</th>
                                    <th>Contact Person NO</th>
                                    <th>Alternate No</th>
                                    <th>Email Id</th>
                                    <th>City</th>
                                    <th>Pin Code</th>
                                    <th>State</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vendormasters as $vendormasters)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $vendormasters->name }}</td>
                                        <td>{{ $vendormasters->gst_no }}</td>
                                        <td>{{ $vendormasters->tds_rate }}</td>
                                        <td>{{ $vendormasters->contact_name }}</td>
                                        <td>{{ $vendormasters->contact_no }}</td>
                                        <td>{{ $vendormasters->alternate_contact_no }}</td>
                                        <td>{{ $vendormasters->email }}</td>
                                        <td>{{ $vendormasters->city }}</td>
                                        <td>{{ $vendormasters->pincode }}</td>
                                        <td>{{ $vendor->states->stateName }}</td>
                                        <td>
                                            @can('vendormaster.edit')
                                                <button class="edit-element btn btn-secondary px-2 py-1" title="Edit Vendor" data-id="{{ $vendormasters->id }}"><i data-feather="edit"></i></button>
                                            @endcan
                                            @can('vendormaster.delete')
                                                <button class="btn btn-danger rem-element px-2 py-1" title="Delete Vendor" data-id="{{ $vendormasters->id }}"><i data-feather="trash-2"></i> </button>
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

