<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmation</title>
</head>

<body>
    <h1>Order Confirmation</h1>
    <p>Thank you for your order, {{ $order->customer_name }}!</p>
    <p>Here are the details of your order:</p>
    <ul>
        <li>Order ID : {{ $order->uuid }}</li>
        <li>Product Name : {{ $order->item_name }}</li>
        <li>Product Code : {{ $order->product_code }}</li>
        <li>Quantity : {{ $order->quantity }}</li>
        <li>Total Price : Rp. {{ $order->total }} (IDR)</li>
        <li>Order Date : {{ $order->order_date }}</li>
    </ul>
    <p>Please confirm your payment by replying to this email or contacting us via WhatsApp to <a href="wa.me/087875263434">here</a> before we process your order.</p>
    <p>We will notify you once your order is processed.</p>
    <p>Thank you for shopping with us!</p>
</body>

</html>