<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tax Invoice</title>
    <style>
        body {
            font-family: 'Roboto', 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            background: #fff;
            color: #333;
        }

        .invoice-container {
            width: 95%;
            margin: auto;
            padding: 10px;
            position: relative;
            min-height: 100vh;
        }

        h1, h2, h3, .fw-bold {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-weight: bold;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 12px;
            table-layout: fixed; /* fix column alignment */
        }

        th, td {
            border: 1px solid #ccc;
            padding: 6px 8px;
            vertical-align: middle;
            word-wrap: break-word;
        }

        th {
            background: #f5f5f5;
            font-weight: 600;
            text-align: center;
        }

        .fw-bold { font-weight: bold; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }

        /* Column width classes */
        .col-10 { width: 10%; }
        .col-15 { width: 15%; }
        .col-20 { width: 20%; }
        .col-25 { width: 25%; }
        .col-30 { width: 30%; }
        .col-40 { width: 40%; }
        .col-50 { width: 50%; }

        /* Totals */
        .totals td {
            font-weight: bold;
            font-size: 11px;
        }
        .totals td:last-child {
            background: #fafafa;
        }

        /* Amount in Words */
        .amt-words td {
            font-style: italic;
            font-size: 12px;
            background: #fdfdfd;
        }

        /* No border rows */
        .no-border td, .no-border th {
            border: none;
        }
    </style>
</head>
<body>

<!-- Header -->
<table class="no-border">
    <tr>
        <td class="col-10" style="padding:2px; vertical-align:middle;">
            <img src="admin/images/inv_image/login-logo.png" alt="Company Logo" style="height:60px;">
        </td>
        <td class="col-90 text-center" style="padding:5px; vertical-align:middle;">
            <h3 style="font-size:14px; margin:0; letter-spacing:1px; color:#555;">TAX INVOICE</h3>
            <h2 style="font-size:20px; margin:5px 0 0 0; font-weight:bold; color:#000;">ADINATH LOGISTICS</h2>
        </td>
    </tr>
</table>

<!-- Invoice Details -->
<table>
    <tr>
        <td class="fw-bold text-left col-25">Invoice No:</td>
        <td class="col-25">{{ $invoice->inv_no ?? '-' }}</td>
        <td class="fw-bold text-left col-25">Credit Terms:</td>
        <td class="col-25">{{ $invoice->termdays ?? '-' }} Days</td>
    </tr>
    <tr>
        <td class="fw-bold text-left">Invoice Date:</td>
        <td>{{ $invoice->inv_date ?? '-' }}</td>
        <td class="fw-bold text-left">Transaction:</td>
        <td>{{ $invoice->transaction_type ?? '-' }}</td>
    </tr>
    <tr>
        <td class="fw-bold text-left">RO/PO Number:</td>
        <td>PO-2025-001</td>
        <td class="fw-bold text-left">Supply Nature:</td>
        <td>Services</td>
    </tr>
    <tr>
        <td class="fw-bold text-left">SAC No:</td>
        <td>{{ $invoice->sac_no ?? '-' }}</td>
        <td class="fw-bold text-left">Invoice Period:</td>
        <td>{{ $invoice->invoicePeriod ?? '-' }}</td>
    </tr>
    <tr>
        <td class="fw-bold text-left">Regular/Adhoc:</td>
        <td>{{ $invoice->invoiceType ?? 'Adhoc' }}</td>
        <td class="fw-bold text-left">Reverse Charge Apply:</td>
        <td>{{ $companybillingmasters->revscharge == 1 ? 'Yes' : 'No' }}</td>
    </tr>
</table>

<!-- Billed From / To -->
<table>
    <tr>
        <td class="col-50 text-left">
            <div class="fw-bold">Billed From:</div>
            <div class="fw-bold">{{ $companybillingmasters->company_name ?? '-' }}</div>
            <div>{{ $companybillingmasters->address_line1 ?? '-' }}</div>
            <div>{{ $companybillingmasters->address_line2 ?? '' }}</div>
        </td>
        <td class="col-50 text-left">
            <div class="fw-bold">Billed To:</div>
            <div class="fw-bold">{{ $invoice->client->name ?? '-' }}</div>
            <div>{{ $invoice->client->address ?? '-' }}</div>
            <div>{{ $invoice->client->city ?? '-' }} - {{ $invoice->client->pincode ?? '-' }}</div>
        </td>
    </tr>
</table>

<!-- GST Info -->
<table>
    <tr>
        <td class="fw-bold text-left col-25">From GSTIN:</td>
        <td class="col-25">{{ $companybillingmasters->gstno ?? '-' }}</td>
        <td class="fw-bold text-left col-25">To GSTIN:</td>
        <td class="col-25">{{ $invoice->client->gstno ?? '-' }}</td>
    </tr>
    <tr>
        <td class="fw-bold text-left">From PAN:</td>
        <td>{{ $companybillingmasters->pan_number ?? '-' }}</td>
        <td class="fw-bold text-left">To PAN:</td>
        <td>{{ $invoice->client->pan_number ?? '-' }}</td>
    </tr>
</table>

<!-- Items -->
<table>
    <thead>
        <tr>
            <th class="col-5">Sr No</th>
            <th class="col-10">Date</th>
            <th class="col-10">Vehicle No.</th>
            <th class="col-15">Origin</th>
            <th class="col-15">Destination</th>
            <th class="col-5">Types</th>
            <th class="col-10">Rate</th>
            <th class="col-10">Toll</th>
            <th class="col-10">Other Charges</th>
            <th class="col-10">Amount</th>
        </tr>
    </thead>
    <tbody>
          @forelse($invoice->trips as $key => $trip)
        <tr>
            <td class="text-center">{{ $key + 1 }}</td>
            <td class="text-center">{{ $trip->trip_date ?? '-' }}</td>
            <td class="text-center">{{ $trip->vehicle_no ?? '-' }}</td>
            <td class="text-center">{{ $trip->origin ?? '-' }}</td>
            <td class="text-center">{{ $trip->destination ?? '-' }}</td>
            <td class="text-center">{{ $trip->vehicle_type ?? '-' }}</td>
            <td class="text-right">{{ number_format($trip->rate ?? 0, 2) }}</td>
            <td class="text-right">{{ number_format($trip->toll ?? 0, 2) }}</td>
            <td class="text-right">{{ number_format($trip->other_charges ?? 0, 2) }}</td>
            <td class="text-right">{{ number_format($trip->amount ?? 0, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
    <!-- <tbody>
        <tr>
            <td>1</td><td>01-09-2025</td><td>MH04AB1234</td><td>Bhiwandi</td><td>Pune</td>
            <td>Truck</td><td>5000</td><td>300</td><td>20</td><td>5300.00</td>
        </tr>
        <tr>
            <td>2</td><td>03-09-2025</td><td>MH05CD5678</td><td>Bhiwandi</td><td>Nagpur</td>
            <td>Truck</td><td>12000</td><td>800</td><td>0</td><td>13000.00</td>
        </tr>
    </tbody> -->
</table>

<!-- Totals -->
<table class="totals">
    <tr>
        <td class="text-right col-80">Net Amount:</td>
        <td class="text-right col-20">18,300.00</td>
    </tr>
    <tr>
        <td class="text-right">Other Charges:</td>
        <td class="text-right">0.00</td>
    </tr>
    <tr>
        <td class="text-right">GST Amount:</td>
        <td class="text-right">1,647.00</td>
    </tr>
    <tr>
        <td class="text-right">Grand Total:</td>
        <td class="text-right">19,947.00</td>
    </tr>
</table>

<!-- Amount in Words -->
<table class="amt-words">
    <tr>
        <td class="fw-bold text-right col-20">Amount in Words:</td>
        <td class="text-left col-80">Rupees Nineteen Thousand Nine Hundred Forty-Seven Only</td>
    </tr>
</table>

<!-- Tax Split -->
<table>
    <tr>
        <th>IGST %</th><th>IGST Value</th>
        <th>CGST %</th><th>CGST Value</th>
        <th>SGST %</th><th>SGST Value</th>
        <th>Total GST</th>
    </tr>
    <tr>
        <td>-</td><td>-</td>
        <td>9%</td><td>823.50</td>
        <td>9%</td><td>823.50</td>
        <td>1,647.00</td>
    </tr>
</table>

<!-- Terms & Bank -->
<table>
    <tr>
        <td class="col-50 text-left" valign="top">
            <div class="fw-bold">Terms & Conditions:</div>
            <ol style="margin:0; padding-left:16px;">
                <li>Payment to be made within the credit period.</li>
                <li>Interest @18% p.a. applicable on late payments.</li>
                <li>Goods once sold/services rendered will not be refunded.</li>
                <li>All disputes subject to Mumbai jurisdiction.</li>
                <li>E.&O.E (Errors & Omissions Excepted).</li>
            </ol>
        </td>
        <td class="col-50 text-left" valign="top">
            <div class="fw-bold">Bank Details:</div>
            <table class="no-border">
                <tr><td class="fw-bold">A/c Holder:</td><td>Logistics Company</td></tr>
                <tr><td class="fw-bold">A/c No:</td><td>{{ $companybillingmasters->bank->BankAccountNo ?? '' }}</td></tr>
                <tr><td class="fw-bold">IFSC:</td><td>{{ $companybillingmasters->bank->BankIFSCCode ?? '' }}</td></tr>
                <tr><td class="fw-bold">Bank:</td><td>{{ $companybillingmasters->bank->Bank_Name ?? '' }}</td></tr>
                <tr><td class="fw-bold">Branch:</td><td>{{ $companybillingmasters->bank->BankBranch ?? '' }}</td></tr>
            </table>
        </td>
    </tr>
</table>

<!-- Disclaimer -->
<div style="font-size:10px; text-align:center; margin-top:20px;">
    **This is a computer-generated invoice and does not require a physical signature.
</div>

</body>
</html>
