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
        <input type="hidden" name="client_id" id="hiddenClientId" value="">
        <input type="hidden" name="month" id="hiddenMonth" value="">
        <input type="hidden" name="TripsList[]" id="hiddenTripsList" value="">

        <!-- GST Section -->
            <div class="row mb-3 border-bottom pb-3">
                <div class="col-12">
                    <label class="fw-bold mb-2">GST Details:</label>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered text-center mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>IGST %</th>
                                    <th>IGST Value</th>
                                    <th>CGST %</th>
                                    <th>CGST Value</th>
                                    <th>SGST %</th>
                                    <th>SGST Value</th>
                                    <th>Total GST</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="igst_percent" id="igstPercent" value="{{ $companybillingmasters[0]->gstmaster->igst ?? 0 }}" readonly></td>
                                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="igst_value" id="igstValue" readonly></td>
                                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="cgst_percent" id="cgstPercent" value="{{ $companybillingmasters[0]->gstmaster->cgst ?? 0 }}" readonly></td>
                                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="cgst_value" id="cgstValue" readonly></td>
                                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="sgst_percent" id="sgstPercent" value="{{ $companybillingmasters[0]->gstmaster->sgst ?? 0 }}" readonly></td>
                                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="sgst_value" id="sgstValue" readonly></td>
                                    <td><input type="number" step="0.01" class="form-control form-control-sm" name="total_gst" id="totalGst" readonly></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Other Charges Section -->
<div class="row mb-3 border-bottom pb-3">
    <div class="col-12">
        <label class="fw-bold mb-2">Other Charges:</label>
        <div id="otherChargesWrapper">
            <!-- Existing row template -->
            <div class="row g-2 mb-2 other-charge-row">
                <div class="col-6">
                    <input type="text" class="form-control form-control-sm" name="otherChargeName[]" placeholder="Description">
                </div>
                <div class="col-4">
                    <input type="number" step="0.01" class="form-control form-control-sm otherChargeAmt" name="otherChargeAmt[]" placeholder="Amount">
                </div>
                <div class="col-2 text-center">
                    <button type="button" class="btn btn-danger btn-sm removeOtherCharge">Remove</button>
                </div>
            </div>
        </div>
        <button type="button" id="addOtherChargeBtn" class="btn btn-primary btn-sm mt-2">Add More</button>
    </div>
</div>

<!-- Totals Section -->
<div class="row mb-3">
    <div class="col-md-6">
        <div class="row g-2 mb-2">
            <div class="col-6 fw-bold">Trip Total Amount:</div>
            <div class="col-6">
                <input type="number" step="0.01" class="form-control form-control-sm" name="tripTotal" id="tripTotal" readonly>
            </div>
        </div>
        <div class="row g-2 mb-2">
            <div class="col-6 fw-bold">Other Charges Total:</div>
            <div class="col-6">
                <input type="number" step="0.01" class="form-control form-control-sm" name="otherTotal" id="otherTotal" readonly>
            </div>
        </div>
        <div class="row g-2 mb-2 border-top pt-2">
            <div class="col-6 fw-bold">Net Amount:</div>
            <div class="col-6">
                <input type="number" step="0.01" class="form-control form-control-sm" name="netAmount" id="netAmount" readonly>
            </div>
        </div>
        <div class="row g-2 mb-2 border-top pt-2">
            <div class="col-6 fw-bold">GST Amount:</div>
            <div class="col-6">
                <input type="number" step="0.01" class="form-control form-control-sm" name="totalGST" id="totalGST" readonly>
            </div>
        </div>
        <div class="row g-2 mb-2 border-top pt-2">
            <div class="col-6 fw-bold">Gross Amount:</div>
            <div class="col-6">
                <input type="number" step="0.01" class="form-control form-control-sm" name="grossTotal" id="grossTotal" readonly>
            </div>
        </div>
    </div>
</div>

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
                    <div class="col-4 fw-bold">Invoice Date:</div>
                    <div class="col-8">
                        <input type="date" class="form-control form-control-sm" id="invoiceDate" name="inv_date">
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="row g-2 mb-3 align-items-center">
                    <div class="col-4 fw-bold">Select Invoice Template:</div>
                    <div class="col-8">
                        <select id="invoiceTemplate" name="invoiceTemplate" class="form-select form-select-sm">
                            <option value="">Select Invoice template</option>
                            <option value="1">Template(with Holding)</option>
                            <option value="2">Template(without Holding)</option>
                            <option value="3">Template(without Holding)</option>
                            <option value="4">Template(without Holding)</option>
                        </select>
                    </div>
                </div>
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
                <input type="text" class="form-control form-control-sm mb-3" id="billedTo"  name="billedTo" readonly>

                <textarea class="form-control form-control-sm mb-3" id="billedToAddress" rows="2" name="billedToAddress" readonly></textarea>

                <input type="text" class="form-control form-control-sm mb-2" id="gstno"  name="gstno" readonly>
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

        function updateTripTotal() {
            let tripTotal = selectedTrips.reduce((sum, t) => sum + (t.rate || 0), 0);
            document.getElementById('tripTotal').value = tripTotal.toFixed(2);
            calculateTotals(); 
        }


        function loadTrips() {
            let clientId = $('#filter_client').val();
            let month = $('#filter_month').val();
            if (!clientId || !month) return;

            $.get("{{ route('get.trips') }}", { client_id: clientId, month: month }, function (res) {
                tripsData = res.trips.map(trip => ({
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

                // Client Details Auto-fill
                if(res.client){
                    $('#billedTo').val(res.client.client_name ?? '');
                    $('#billedToAddress').val(
                        (res.client.billing_address ?? '') + 
                        (res.client.city ? ', ' + res.client.city : '') + 
                        (res.client.state ? ', ' + res.client.state : '') + 
                        (res.client.pin_code ? ' - ' + res.client.pin_code : '')
                    );
                    $('#gstno').val("GST No:- " + (res.client.gst_no ?? 'N.A'));
                }

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
            updateTripTotal();
        });

        $(document).on('click', '.removeTrip', function () {
            let id = $(this).data('id');
            $(`.tripCheckbox[data-id="${id}"]`).prop('checked', false).trigger('change');
             updateTripTotal();
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

// Other Charges & Totals Calculation
<script>
    // Add more other charges
document.getElementById('addOtherChargeBtn').addEventListener('click', function() {
    let wrapper = document.getElementById('otherChargesWrapper');
    let row = document.createElement('div');
    row.classList.add('row', 'g-2', 'mb-2', 'other-charge-row');
    row.innerHTML = `
        <div class="col-6">
            <input type="text" class="form-control form-control-sm" name="otherChargeName[]" placeholder="Description">
        </div>
        <div class="col-4">
            <input type="number" step="0.01" class="form-control form-control-sm otherChargeAmt" name="otherChargeAmt[]" placeholder="Amount">
        </div>
        <div class="col-2 text-center">
            <button type="button" class="btn btn-danger btn-sm removeOtherCharge">&times;</button>
        </div>
    `;
    wrapper.appendChild(row);
});

// Remove row
document.addEventListener('click', function(e) {
    if(e.target && e.target.classList.contains('removeOtherCharge')){
        e.target.closest('.other-charge-row').remove();
        calculateTotals();
    }
});

// Calculate totals dynamically
document.addEventListener('input', function(e){
    if(e.target.classList.contains('otherChargeAmt') || e.target.id === 'tripTotal'){
        calculateTotals();
    }
});

function calculateTotals(){
    let tripTotal = parseFloat(document.getElementById('tripTotal').value) || 0;
    let otherTotal = 0;
    document.querySelectorAll('.otherChargeAmt').forEach(input => {
        otherTotal += parseFloat(input.value) || 0;
    });

    document.getElementById('otherTotal').value = otherTotal.toFixed(2);

    let netAmount = tripTotal + otherTotal;
    document.getElementById('netAmount').value = netAmount.toFixed(2);

    // Update GST
    updateGST(netAmount);
}


    // Example GST calculation function
    // function updateGST(netAmount){
    //         let igstPercent = parseFloat(document.getElementById('igstPercent').value) || 0;
    //         let cgstPercent = parseFloat(document.getElementById('cgstPercent').value) || 0;
    //         let sgstPercent = parseFloat(document.getElementById('sgstPercent').value) || 0;

    //         let igstValue = netAmount * igstPercent / 100;
    //         let cgstValue = netAmount * cgstPercent / 100;
    //         let sgstValue = netAmount * sgstPercent / 100;
    //         let totalGST = igstValue + cgstValue + sgstValue;

    //         document.getElementById('igstValue').value = igstValue.toFixed(2);
    //         document.getElementById('cgstValue').value = cgstValue.toFixed(2);
    //         document.getElementById('sgstValue').value = sgstValue.toFixed(2);

    //         // GST table field
    //         document.getElementById('totalGst').value = totalGST.toFixed(2);
    //         // Totals Section field
    //         if(document.getElementById('totalGST')){
    //             document.getElementById('totalGST').value = totalGST.toFixed(2);
    //         }

    //         // Gross Total = Net + GST
    //         let grossTotal = netAmount + totalGST;
    //         if(document.getElementById('grossTotal')){
    //             document.getElementById('grossTotal').value = grossTotal.toFixed(2);
    //         }
    //     }

    function updateGST(netAmount) {
            let igstPercent = parseFloat(document.getElementById('igstPercent').value) || 0;
            let cgstPercent = parseFloat(document.getElementById('cgstPercent').value) || 0;
            let sgstPercent = parseFloat(document.getElementById('sgstPercent').value) || 0;

            // Laravel blade madhe company ani client state code pass kara
            let companyState = "{{ $companybillingmasters[0]->state ?? '' }}";
            let clientState = "{{ $clientmasters[0]->state ?? '' }}";

            console.log("Company State:", companyState);
            console.log("Client State:", clientState);

            let igstValue = 0, cgstValue = 0, sgstValue = 0, totalGST = 0;

            if (companyState && clientState) {
                if (companyState === clientState) {
                    // Same state → CGST + SGST
                    cgstValue = netAmount * cgstPercent / 100;
                    sgstValue = netAmount * sgstPercent / 100;
                    igstValue = 0;
                } else {
                    // Different state → IGST
                    igstValue = netAmount * igstPercent / 100;
                    cgstValue = 0;
                    sgstValue = 0;
                }
            }

            totalGST = igstValue + cgstValue + sgstValue;

            // Update GST values in table
            document.getElementById('igstValue').value = igstValue.toFixed(2);
            document.getElementById('cgstValue').value = cgstValue.toFixed(2);
            document.getElementById('sgstValue').value = sgstValue.toFixed(2);

            document.getElementById('totalGst').value = totalGST.toFixed(2);
            if (document.getElementById('totalGST')) {
                document.getElementById('totalGST').value = totalGST.toFixed(2);
            }

            // Gross Total = Net + GST
            let grossTotal = netAmount + totalGST;
            if (document.getElementById('grossTotal')) {
                document.getElementById('grossTotal').value = grossTotal.toFixed(2);
            }
        }



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
                $("#submitInvoiceBtn").prop('disabled', false);
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
                    $("#submitInvoiceBtn").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function(responseObject, textStatus, errorThrown) {
                    $("#submitInvoiceBtn").prop('disabled', false);
                    swal("Error occured!", "Something went wrong please try again", "error");
                }
            }
        });

    });
</script>


