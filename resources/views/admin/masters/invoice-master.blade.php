<x-admin.layout>
    <x-slot name="title">Invoice Master</x-slot>
    <x-slot name="heading">Invoice Master</x-slot>

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
                @foreach (range(1, 12) as $m)
                    @php
                        $monthValue = str_pad($m, 2, '0', STR_PAD_LEFT);
                        $monthName = date('F', mktime(0, 0, 0, $m, 1));
                    @endphp
                    <option value="{{ $monthValue }}">{{ $monthName }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label for="filter_trips" class="form-label">Select Trips</label>
            <select id="filter_trips" class="form-control" name="trips" multiple></select>
        </div>
    </div>

    <div class="col-md-8 text-end mb-3">
        <button id="addBtn" class="btn btn-primary" disabled>ADD</button>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
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
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Hidden Invoice Section (will show after ADD) --}}
    <div id="invoiceSection" style="display:none;">
        <div class="row mb-3 border-bottom pb-3">
            <div class="col-md-6">
                <div class="row g-2 mb-2">
                    <div class="col-4 fw-bold">Select Invoice Type:</div>
                    <div class="col-8">
                        <select id="invoiceType" class="form-control">
                            <option value="">Select Invoice type</option>
                            <option value="adhoc_invoice">adhoc invoice</option>
                            <option value="fix_vehicle_invoice">fix vehicle invoice</option>
                        </select>
                    </div>
                </div>
                <div class="row g-2 mb-2">
                    <div class="col-4 fw-bold">Tax Invoice No:</div>
                    <div class="col-8">
                        <input type="text" class="form-control form-control-sm" name="inv_no" id="invoiceNo" value="AL/NGB/ADH/036">
                    </div>
                </div>
                <div class="row g-2 mb-2">
                    <div class="col-4 fw-bold">Invoice Date:</div>
                    <div class="col-8">
                        <input type="date" class="form-control form-control-sm" id="invoiceDate" name="invoiceDate" >
                    </div>
                </div>
                <div class="row g-2 mb-2">
                    <div class="col-4 fw-bold">RO/PO Number:</div>
                    <div class="col-8">
                        <input type="text" class="form-control form-control-sm" id="poNumber" name="poNumber">
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-4 fw-bold">SAC NO:</div>
                    <div class="col-8">
                        <input type="text" class="form-control form-control-sm" id="sacNo" name="sacNo">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row g-2 mb-2">
                    <div class="col-4 fw-bold">Credit Terms:</div>
                    <div class="col-8">
                        <input type="text" class="form-control form-control-sm" id="creditTerms" name="termdays" value="15 Days">
                    </div>
                </div>
                <div class="row g-2 mb-2">
                    <div class="col-4 fw-bold">Transaction:</div>
                    <div class="col-8">
                        <select class="form-select form-select-sm" id="transactionNature">
                            <option value="Intra State" selected>Intra State</option>
                            <option value="Inter State">Inter State</option>
                        </select>
                    </div>
                </div>
                <div class="row g-2 mb-2">
                    <div class="col-4 fw-bold">Supply Nature:</div>
                    <div class="col-8">
                        <select class="form-select form-select-sm" id="supplyNature" name="supplyNature">
                            <option value="Services" selected>Services</option>
                            <option value="Goods">Goods</option>
                        </select>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-4 fw-bold">Invoice Period:</div>
                    <div class="col-8">
                        <input type="text" class="form-control form-control-sm" id="invoicePeriod" name="invoicePeriod">
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3 border-bottom pb-3">
            <div class="col-md-6">
                <label class="fw-bold">Billed From:</label>
                <input type="text" class="form-control form-control-sm mb-2" id="billedFrom" value="ADINATH LOGISTICS" name="billedFrom">
                <textarea class="form-control form-control-sm" id="billedFromAddress" rows="2" name="billedFromAddress">
GROUND FLOOR,1035,ANANDNAGAR,CHARNIPADA ROAD,RAHNAL,RAHNAL,BHIWANDI,THANE,MAHARASHTRA 421302
                </textarea>
            </div>
        </div>
        <div class="text-end mt-3">
        <button id="submitInvoiceBtn" class="btn btn-success">Submit Invoice</button>
    </div>
    </div>
</x-admin.layout>

{{-- Select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<script>
    $('#filter_trips').select2({
        placeholder: "Select Trips",
        allowClear: true
    });

    $(document).ready(function(){
        // Load trips when client or month changes
        function loadTrips() {
            let clientId = $('#filter_client').val();
            let month = $('#filter_month').val();

            if(clientId && month){
                $.ajax({
                    url: "{{ route('get.trips') }}",
                    method: "GET",
                    data: { client_id: clientId, month: month },
                    success: function(res) {
                        let options = '';
                        res.forEach(function(trip) {
                            options += `<option value="${trip.id}">${trip.text}</option>`;
                        });
                        $('#filter_trips').html(options).trigger('change');
                    }
                });
            }
        }

        $('#filter_client, #filter_month').on('change', loadTrips);

        // Enable ADD button if trips are selected
        $('#filter_trips').on('change', function(){
            if($(this).val().length > 0){
                $('#addBtn').prop('disabled', false);
            } else {
                $('#addBtn').prop('disabled', true);
            }
        });

        // On ADD button click → load table + show invoice section
        $('#addBtn').on('click', function(){
            let clientId = $('#filter_client').val();
            let month = $('#filter_month').val();
            let trips = $('#filter_trips').val();

            $.ajax({
                url: "{{ route('get.filtered.trips') }}",
                method: "GET",
                data: { client_id: clientId, month: month, trips: trips },
                success: function(res) {
                    let tbody = '';
                    res.forEach(function(trip, index) {
                        tbody += `
                            <tr>
                                <td>${index+1}</td>
                                <td>${trip.unique_no ?? ''}</td>
                                <td>${trip.vehical_number?.vehicle_number ?? ''}</td>
                                <td>${trip.pod_number ?? ''}</td>
                                <td>${trip.courier ?? ''}</td>
                                <td>${trip.courier_tracking_number ?? ''}</td>
                                <td>${trip.courier_status ?? ''}</td>
                                <td>${trip.pod_status == 1 ? '<span class="badge bg-success">POD Added</span>' : '<span class="badge bg-warning">Pending</span>'}</td>
                            </tr>
                        `;
                    });
                    $('#buttons-datatables tbody').html(tbody);

                    if(res.length > 0){
                        $('#invoiceSection').show(); // show invoice fields
                    }
                }
            });
        });
    });


    $('#submitInvoiceBtn').on('click', function(e){
    e.preventDefault();

    let data = {
        inv_no: $('#invoiceNo').val(),
        inv_date: $('#invoiceDate').val(),
        poNumber: $('#poNumber').val(),
        sacNo: $('#sacNo').val(),
        termdays: $('#creditTerms').val(),
        transactionNature: $('#transactionNature').val(),
        supplyNature: $('#supplyNature').val(),
        invoicePeriod: $('#invoicePeriod').val(),
        billedFrom: $('#billedFrom').val(),
        billedFromAddress: $('#billedFromAddress').val(),

        client_id: $('#filter_client').val(),
        month: $('#filter_month').val(),
        trip_ids: $('#filter_trips').val()
    };

    $.ajax({
        url: "{{ route('invoicemaster.store') }}", // ✅ use your store route
        type: "POST",
        data: data,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(res){
            alert(res.success);
            location.reload(); // refresh after success
        },
        error: function(xhr){
            if(xhr.responseJSON && xhr.responseJSON.errors){
                let errors = xhr.responseJSON.errors;
                let errorMessage = '';
                Object.keys(errors).forEach(function(key){
                    errorMessage += errors[key][0] + '\n';
                });
                alert("Validation Errors:\n" + errorMessage);
            } else {
                alert("Something went wrong while submitting.");
            }
        }
    });
});

</script>
