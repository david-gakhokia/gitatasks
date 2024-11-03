<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
</head>
<body>
    <h1>Make a Payment</h1>

    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('payment.initiate') }}" method="POST">
        @csrf
        <label for="amount">Amount (GEL):</label>
        <input type="number" id="amount" name="amount" required>
        <button type="submit">Pay Now</button>
    </form>
</body>
</html>
