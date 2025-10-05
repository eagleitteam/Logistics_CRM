<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vehicle Document Expiry</title>
</head>
<body>
    <h2>Vehicle Document Expiry Alert</h2>
    <p>Dear User,</p>
    <p>
        The following vehicle document is either expiring soon or already expired:
    </p>

    <table border="1" cellspacing="0" cellpadding="6">
        <tr><th>Document Name</th><td>{{ $document->documentName }}</td></tr>
        <tr><th>Vehicle Number</th><td>{{ $document->vehicle_number }}</td></tr>
        <tr><th>End Date</th><td>{{ $document->end_date }}</td></tr>
        <tr><th>Status</th>
            <td>
                @if($document->end_date < date('Y-m-d'))
                    <span style="color:red;">Expired</span>
                @else
                    <span style="color:orange;">Expiring Soon</span>
                @endif
            </td>
        </tr>
    </table>

    <p>Please renew this document as soon as possible.</p>

    <br>
    <p>Regards,<br>{{ $companyBilling->company_name ?? 'Your Company' }}</p>
</body>
</html>
