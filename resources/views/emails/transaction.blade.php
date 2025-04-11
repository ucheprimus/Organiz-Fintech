<!DOCTYPE html>
<html>
<head>
    <title>Transaction Notification</title>
</head>
<body>
    <h2>Hello,</h2>
    <p>You have a new transaction:</p>
    <ul>
        <li><strong>Type:</strong> {{ $transactionData['type'] }}</li>
        <li><strong>Amount:</strong> ${{ number_format($transactionData['amount'], 2) }}</li>
        <li><strong>Date:</strong> {{ $transactionData['date'] }}</li>
        <li><strong>Status:</strong> {{ $transactionData['status'] }}</li>
    </ul>
    <p>Thank you!</p>
</body>
</html>
