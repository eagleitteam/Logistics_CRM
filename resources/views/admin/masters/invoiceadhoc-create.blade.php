<x-admin.layout>
    <x-slot name="title">Invoice Master</x-slot>
    <x-slot name="heading">Invoice Master</x-slot>

        <!-- Filters -->
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="filter_client" class="form-label fw-bold">Select Client</label>
                <select id="filter_client" name="client_id" class="form-select">
                    <option value="">All Clients</option>
                    @foreach($clientmasters as $client)
                        <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="filter_month" class="form-label fw-bold">Select Month</label>
                <select id="filter_month" name="month" class="form-select">
                    <option value="">All Months</option>
                    @foreach($months as $month)
                        <option value="{{ $month }}">{{ $month }}</option>
                    @endforeach
                </select>
            </div>
        </div>

    <!-- Available Trips Section -->
    <div class="row">
        <!-- Left Side: Available Trips -->
        <div class="col-lg-8 mb-3">
            <div class="card shadow-sm">
                <div class="card-header bg-gray-500 text-white fw-bold d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fw-bold">Available Trips</h4>
                    <span class="badge bg-warning text-dark fs-6" id="availableCount">0 Trips</span>
                </div>
                <div class="card-body p-2">
                    <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                        <table class="table table-bordered nowrap table-sm table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th><input type="checkbox" id="selectAll"></th>
                                    <th>Unique No</th>
                                    <th>Vehicle No</th>
                                    <th>POD No</th>
                                    <th>Status</th>
                                    <th>Rate</th>
                                </tr>
                            </thead>
                            <tbody id="tripsTableBody">
                                <!-- Dynamically loaded -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Selected Trips Preview -->
        <div class="col-lg-4 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-gray-500 text-white fw-bold d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Selected Trips</h4>
                    <span class="badge bg-success text-white fs-6" id="selectedCount">count 0</span>
                </div>
                <div class="card-body p-2">
                    <ul class="list-group small" id="selectedTripsList" style="max-height: 280px; overflow-y: auto;"></ul>
                    <div class="mt-2 text-end fw-bold">
                        Net Total: <span id="selectedTotal">0</span>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button id="proceedBtn" class="btn btn-success w-100" disabled>Proceed to Invoice</button>
                </div>
            </div>
        </div>
    </div>

<!-- Hidden Invoice Section -->
<div id="invoiceSection" style="display:none;">
    <div class="card shadow mt-4 p-3">
    <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
        @csrf
        
        <!-- Hidden Fields -->
        <input type="hidden" name="client_id" id="hiddenClientId" value="">client_id
        <input type="hidden" name="month" id="hiddenMonth" value="">
        <input type="hidden" name="year_id" id="hiddenYear" value="1">
        <input type="hidden" name="TripsList[]" id="hiddenTripsList" value="">


        <!-- Invoice Header Section -->
        <div class="row mb-3 border-bottom pb-3">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="row g-2 mb-3 align-items-center">
                    <div class="col-4 fw-bold">Select Invoice Type:</div>
                    <div class="col-8">
                        <select id="invoiceType" name="invoiceType" class="form-select form-select-sm">
                            <option value="">Select Invoice type</option>
                            <option value="adhoc_invoice">adhoc invoice</option>
                            <option value="fix_vehicle_invoice">fix vehicle invoice</option>
                        </select>
                    </div>
                </div>

                <div class="row g-2 mb-3 align-items-center">
                    <div class="col-4 fw-bold">Tax Invoice No:</div>
                    <div class="col-8">
                        <input type="text" class="form-control form-control-sm" name="inv_no" id="invoiceNo">
                    </div>
                </div>

                <div class="row g-2 mb-3 align-items-center">
                    <div class="col-4 fw-bold">Invoice Date:</div>
                    <div class="col-8">
                        <input type="date" class="form-control form-control-sm" id="invoiceDate" name="inv_date">
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="row g-2 mb-3 align-items-center">
                    <div class="col-4 fw-bold">Credit Terms:</div>
                    <div class="col-8">
                        <input type="text" class="form-control form-control-sm" id="creditTerms" name="termdays" value="15 Days">
                    </div>
                </div>

                <div class="row g-2 mb-3 align-items-center">
                    <div class="col-4 fw-bold">Invoice Period:</div>
                    <div class="col-8">
                        <input type="text" class="form-control form-control-sm" id="invoicePeriod" name="invoicePeriod">
                    </div>
                </div>
                <!-- RO/PO Number -->
                    <div class="row g-2 mb-2 align-items-center">
                        <div class="col-4 fw-bold">RO/PO Number:</div>
                        <div class="col-8">
                            <input type="text" class="form-control form-control-sm" id="poNumber" name="poNumber">
                        </div>
                    </div>
                </div>
            </div>

            

        <!-- Billing Details -->
        <div class="row mb-3 border-bottom pb-3">
            <div class="col-md-6">
                <label for="billedTo" class="fw-bold mb-2">Billed To:</label>
                <input type="text" class="form-control form-control-sm mb-3" id="billedTo" value="ADINATH LOGISTICS" name="billedTo">

                <textarea class="form-control form-control-sm mb-3" id="billedToAddress" rows="2" name="billedToAddress">GROUND FLOOR,1035,ANANDNAGAR,CHARNIPADA ROAD,RAHNAL,RAHNAL,BHIWANDI,THANE,MAHARASHTRA 421302</textarea>

                <input type="text" class="form-control form-control-sm mb-2" id="gstno" value="GST No:- 27AAEFA1234D1Z5" name="gstno">
            </div>
        </div>

        <!-- Submit -->
        <div class="text-end mt-3">
            <button id="submitInvoiceBtn" class="btn btn-success">Submit Invoice</button>
        </div>
    </form>
    </div>
</div>

    
</x-admin.layout>

<script>
    $(document).ready(function () {
        let selectedTrips = [];
        let tripsData = [];

        function updateCounts() {
            let pending = tripsData.filter(t => !selectedTrips.find(s => s.id === t.id)).length;
            $('#availableCount').text(pending + ' Pending');
            $('#selectedCount').text(selectedTrips.length);
            $('#selectedTotal').text(selectedTrips.reduce((sum, t) => sum + (t.rate || 0), 0));
        }

        function loadTrips() {
            let clientId = $('#filter_client').val();
            let month = $('#filter_month').val();
            if (!clientId || !month) return;

            $.get("{{ route('get.trips') }}", { client_id: clientId, month: month }, function (res) {
                tripsData = res.map(trip => ({
                    ...trip,
                    rate: trip.rate || 0
                }));

                let rows = '';
                tripsData.forEach(trip => {
                    let checked = selectedTrips.find(t => t.id === trip.id) ? 'checked' : '';
                    rows += `
                        <tr>
                            <td><input type="checkbox" class="tripCheckbox" data-id="${trip.id}" data-unique_no="${trip.unique_no}" data-text="${trip.text}" data-rate="${trip.rate}" ${checked}></td>
                            <td>${trip.unique_no ?? ''}</td>
                            <td>${trip.vehical_number ?? ''}</td>
                            <td>${trip.trip_date ?? ''}</td>
                            <td>${trip.pod_status == 1 ? '<span class="badge bg-success">POD Added</span>' : '<span class="badge bg-warning">Pending</span>'}</td>
                            <td>${trip.rate ?? 0}</td>
                        </tr>
                    `;
                });
                $('#tripsTableBody').html(rows);
                updateCounts();
            });
        }

        $('#filter_client, #filter_month').on('change', function() {
            selectedTrips = [];
            $('#selectedTripsList').empty();
            $('#proceedBtn').prop('disabled', true);
            loadTrips();
        });

        $(document).on('change', '#selectAll', function () {
            $('.tripCheckbox').prop('checked', $(this).prop('checked')).trigger('change');
        });

        $(document).on('change', '.tripCheckbox', function () {
            let tripId = $(this).data('id');
            let uniqueNo = $(this).data('unique_no');
            let tripText = $(this).data('text');
            let tripRate = parseFloat($(this).data('rate')) || 0;

            if ($(this).is(':checked')) {
                if (!selectedTrips.find(t => t.id === tripId)) {
                    selectedTrips.push({ id: tripId, text: tripText, unique_no: uniqueNo, rate: tripRate });
                    $('#selectedTripsList').append(`<li class="list-group-item d-flex justify-content-between align-items-center" id="trip-${tripId}">
                        ${uniqueNo} ${tripText} (${tripRate})
                        <button class="btn btn-sm btn-outline-danger removeTrip" data-id="${tripId}">X</button>
                    </li>`);

                    
                }
            } else {
                // Uncheck → array, list, hidden field मधून काढा
                    selectedTrips = selectedTrips.filter(t => t.id != tripId);
                    $(`#trip-${tripId}`).remove();

                        }

            if ($('.tripCheckbox:checked').length === 0) {
                selectedTrips = [];
                $('#selectedTripsList').empty();
            }

            $('#proceedBtn').prop('disabled', selectedTrips.length === 0);
            updateCounts();
        });

        $(document).on('click', '.removeTrip', function () {
            let id = $(this).data('id');
            $(`.tripCheckbox[data-id="${id}"]`).prop('checked', false).trigger('change');
        });

            $('#proceedBtn').on('click', function () {

                $(this).prop('disabled', true);

                // Hidden field मध्ये selectedTrips IDs सेट करणे
                $('#hiddenTripsList').remove(); // जुना hidden input remove
                    let hiddenInputs = '';
                    selectedTrips.forEach(trip => {
                                    hiddenInputs += `<input type="hidden" name="TripsList[]" value="${trip.id}|${trip.unique_no}">`;
                    });
                    $('#addForm').append(hiddenInputs);

                    // 3) SelectAll checkbox disable
                    $('#selectAll').prop('disabled', true);

                    // 4) Trips table मधील checkboxes disable
                    $('#tripsTableBody input[type="checkbox"]').prop('disabled', true);

                    // 5) Selected Trips list readonly करणे → remove बटनं hide/disable
                    $('#selectedTripsList .removeTrip').prop('disabled', true).hide();

                $('#invoiceSection').slideDown();
                $('html, body').animate({ scrollTop: $('#invoiceSection').offset().top }, 500);
            });

        

        });
</script>


{{-- Add --}}
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#submitInvoiceBtn").prop('disabled', true);

        //  Hidden fields मध्ये value सेट करणे
        $('#hiddenClientId').val($('#filter_client').val());
        $('#hiddenMonth').val($('#filter_month').val());

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('invoiceadhoc.store') }}',
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


