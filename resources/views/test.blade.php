<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tax Invoice</title>
    <style>
        body {
            /* font-family: 'DejaVu Sans', sans-serif; */
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

        h2, h3 {
            margin: 0;
            padding: 0;
        }

        .invoice-numbers, .bank-details table td:nth-child(2) {
            font-family: 'Courier New', monospace;
            letter-spacing: 0.5px;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
        }
        .header .title {
            text-align: center;
        }
        .header h3 {
            font-size: 14px;
            letter-spacing: 1px;
            color: #555;
        }
        .header h2 {
            font-size: 20px;
            font-weight: bold;
            margin-top: 5px;
            color: #000;
        }
        .header .logo img {
            height: 80px;
        }
      
        /* Table */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 12px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 6px 8px;
            text-align: center;
        }
        th {
            background: #f5f5f5;
            font-weight: 600;
        }
        .no-border td, .no-border th {
            border: none;
        }
        .fw-bold {
            font-weight: bold;
        }
        .text-left {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        /* Totals */
        .totals td {
            font-weight: bold;
            font-size: 11px;
        }
        .totals td:last-child {
            background: #fafafa;
            font-weight: bold;
        }
                /* Terms & Payment */
        .section-flex {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;  /* row madhe barobar suruvat karayla */
            margin-top: 15px;
            gap: 5px;
        }
        .terms {
            flex: 0 0 50%;   /* 50% width */
            font-size: 12px;
        }
        .terms .fw-bold {
            margin-bottom: 5px;
            display: block;
        }
        .bank-details {
            flex: 0 0 30%;   /* 30% width */
            text-align: right;
            font-size: 12px;
        }
        .bank-details .fw-bold {
            margin-bottom: 5px;
            display: block;
        }
        .bank-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .bank-details table td {
            padding: 1px 2px;
            text-align: right;
            border: none;
        }

        /* Signature */
        .signature-section {
            position: absolute;
            right: 20px;
            text-align: center;
        }
        .signature-box img {
            height: 70px;
            margin-bottom: 5px;
        }
        .signature-box div {
            font-size: 12px;
        }
        /* Amount in Words */
        .amt-words td {
            font-style: italic;
            font-size: 12px;
            background: #fdfdfd;
        }
    </style>
</head>
<body>

<table width="100%" style="border: none; margin-bottom:10px; border-collapse:collapse;">
    <tr>
        <!-- Logo -->
        <td width="10%" style="padding:2px; vertical-align:middle;">
            <img src="admin/images/inv_image/login-logo.png" alt="Company Logo" style="height:60px;">
        </td>

        <!-- Title -->
        <td width="90%" style="text-align:center; padding:5px; vertical-align:middle;">
            <h3 style="font-size:14px; margin:0; letter-spacing:1px; color:#555;">TAX INVOICE</h3>
            <h2 style="font-size:20px; margin:5px 0 0 0; font-weight:bold; color:#000;">ADINATH LOGISTICS</h2>
        </td>
    </tr>
</table>


    <!-- Invoice Details -->
    <table>
        <tr>
            <td class="fw-bold text-left">Invoice No:</td>
            <td>AL/NGB/ADH/036</td>
            <td class="fw-bold text-left">Credit Terms:</td>
            <td>15 Days</td>
        </tr>
        <tr>
            <td class="fw-bold text-left">Invoice Date:</td>
            <td>01-09-2025</td>
            <td class="fw-bold text-left">Transaction:</td>
            <td>Intra State</td>
        </tr>
        <tr>
            <td class="fw-bold text-left">RO/PO Number:</td>
            <td>PO-2025-001</td>
            <td class="fw-bold text-left">Supply Nature:</td>
            <td>Services</td>
        </tr>
        <tr>
            <td class="fw-bold text-left">SAC No:</td>
            <td>996511</td>
            <td class="fw-bold text-left">Invoice Period:</td>
            <td>Aug 2025</td>
        </tr>
        <tr>
            <td class="fw-bold text-left">Reguler/Adhoc:</td>
            <td>Adhoc</td>
            <td class="fw-bold text-left">Reverse Charge Apply:</td>
            <td>Yes</td>
        </tr>
    </table>

    <!-- Billed From / To -->
    <table>
        <tr>
            <td width="50%">
                <div class="fw-bold text-left">Billed From:</div>
                <div class="fw-bold text-left">ADINATH LOGISTICS</div>
                <div class="text-left">GROUND FLOOR,1035,ANANDNAGAR, BHIWANDI</div>
                <div class="text-left">ANANDNAGAR, BHIWANDI-12345</div>
            </td>
            <td width="50%">
                <div class="fw-bold text-left">Billed To:</div>
                <div class="fw-bold text-left">ABC ENTERPRISES</div>
                <div class="text-left">B/204, Athene, Lodha Paradise, Thane</div>
                <div class="text-left"> Lodha Paradise, Thane-12345</div>
            </td>
        </tr>
    </table>

    <!-- GSTIN -->
    <table>
        <tr>
            <td class="fw-bold text-left">From GSTIN:</td>
            <td>27CYFPK8134G1ZA</td>
            <td class="fw-bold text-left">To GSTIN:</td>
            <td>27AAGCK9452K1ZZ</td>
        </tr>
        <tr>
            <td class="fw-bold text-left">From PAN:</td>
            <td>CYFPK8134G</td>
            <td class="fw-bold text-left">To PAN:</td>
            <td>CYFPK8544G</td>
        </tr>
    </table>

    <!-- Items -->
    <table>
        <thead>
            <tr>
                <th>Sr No</th>
                <th>Date</th>
                <th>Vehicle No.</th>
                <th>Origin</th>
                <th>Destination</th>
                <th>Types</th>
                <th>Rate</th>
                <th>Toll</th>
                <th>Other<br>Charges</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>01-09-2025</td>
                <td>MH04AB1234</td>
                <td>Bhiwandi</td>
                <td>Pune</td>
                <td>Truck</td>
                <td>5000</td>
                <td>300</td>
                <td>20</td>
                <td>5300.00</td>
            </tr>
            <tr>
                <td>2</td>
                <td>03-09-2025</td>
                <td>MH05CD5678</td>
                <td>Bhiwandi</td>
                <td>Nagpur</td>
                <td>Truck</td>
                <td>12000</td>
                <td>800</td>
                <td>0</td>
                <td>13000.00</td>
            </tr>
        </tbody>
    </table>

    <!-- Totals -->
    <table class="totals">
        <tr>
            <td class="text-right">Net Amount:</td>
            <td class="text-right" width="20%">18,300.00</td>
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
            <td class="fw-bold text-right">Amount in Words:</td>
            <td class="text-left">Rupees Nineteen Thousand Nine Hundred Forty-Seven Only</td>
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

<table style="border: none; width:100%;">
    <tr>
        <!-- Terms -->
        <td width="50%" valign="top">
            <div class="fw-bold text-left">Terms & Conditions:</div>
            <ol class="text-left">
                <li style="margin-bottom: 8px;">Payment to be made within the credit period.</li>
                <li style="margin-bottom: 8px;">Interest @18% p.a. applicable on late payments.</li>
                <li style="margin-bottom: 8px;">Goods once sold/services rendered will not be refunded.</li>
                <li style="margin-bottom: 8px;">All disputes subject to Mumbai jurisdiction.</li>
                <li style="margin-bottom: 8px;">E.&O.E (Errors & Omissions Excepted).</li>
            </ol>
        </td>

        <!-- Bank Details -->
        <td width="40%" valign="top">
            <div class="fw-bold">Bank Details:</div>
            <table style="width:100%; border:none;">
                <tr>
                    <td class="fw-bold">A/c Holder:</td>
                    <td class="text-left">Logistics Company</td>
                </tr>
                <tr>
                    <td class="fw-bold">A/c No:</td>
                    <td class="text-left">2056102000009546</td>
                </tr>
                <tr>
                    <td class="fw-bold">IFSC:</td>
                    <td class="text-left">IBKL0002056</td>
                </tr>
                <tr>
                    <td class="fw-bold">Bank:</td>
                    <td class="text-left">IDBI BANK</td>
                </tr>
                <tr>
                    <td class="fw-bold">Branch:</td>
                    <td class="text-left">BHIWANDI , ANJURFATA</td>
                </tr>
            </table>
        </td>

        
    </tr>
</table>

<table style="border: none; width:30%; margin-left:auto; margin-right:0;">
    <tr >
        <!-- Signature -->
        <td width="30%" valign="top" style="text-align:right; border: none;">
            <img src="{{ public_path($finalSignature) }}" 
                 alt="Authorized Signatory" 
                 style="width:260px; height:auto;">
            <div style="margin-top: 5px; font-size: 12px; text-align:center">Authorized Signatory</div>
            <div style="font-size: 12px; text-align:center">Praful Chavan <br> (Proprietor)</div>
        </td>
    </tr>
</table>

<!-- Disclaimer -->
<div style="font-size:10px; text-align:center; margin-top:20px;">
    **This is a computer-generated invoice and does not require a physical signature.
</div>


</body>
</html>
