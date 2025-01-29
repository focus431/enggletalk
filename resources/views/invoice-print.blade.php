<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->id }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <style>
        body {
            background-color: #fff;
        }
        .invoice-content {
            padding: 30px;
        }
        .invoice-table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
        .invoice-table th,
        .invoice-table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
    <div class="invoice-content">
        <div class="invoice-item">
            <div class="row">
                <div class="col-md-6">
                    <div class="invoice-logo">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="logo">
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <p class="invoice-details">
                        <strong>Order:</strong> #INV-{{ $order->id }} <br>
                        <strong>Issued:</strong> {{ $order->created_at->format('d/m/Y') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="invoice-item">
            <div class="row">
                <div class="col-md-6">
                    <div class="invoice-info">
                        <strong class="customer-text">Invoice From</strong>
                        <p class="invoice-details">
                            Ge Zhong Education Inc. <br>
                            No. 123, Zhongshan Road, Taoyuan, Taiwan <br>
                            Phone: +886 3 123 4567 <br>
                            Email: info@gezhong.com
                        </p>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <div class="invoice-info">
                        <strong class="customer-text">Invoice To</strong>
                        <p class="invoice-details">
                            {{ $order->first_name }} {{ $order->last_name }}<br>
                            Address placeholder <br>
                            Email placeholder
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="invoice-item">
            <div class="row">
                <div class="col-md-12">
                    <div class="invoice-info">
                        <strong class="customer-text">Payment Method</strong>
                        <p class="invoice-details">
                            {{ $order->payment_option }} <br>
                            Payment proof: <a href="{{ asset($order->payment_proof) }}">View proof</a><br>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="invoice-item invoice-table-wrap">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="invoice-table table table-bordered">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $order->selected_plan }}</td>
                                    <td class="text-center">{{ $order->lessons }}</td>
                                    <td class="text-center">${{ $order->price / $order->lessons }}</td>
                                    <td class="text-end">${{ $order->price }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4 ms-auto">
                    <div class="table-responsive">
                        <table class="invoice-table-two table">
                            <tbody>
                            <tr>
                                <th>Subtotal:</th>
                                <td><span>${{ $order->price }}</span></td>
                            </tr>
                            <tr>
                                <th>Discount:</th>
                                <td><span>-0%</span></td>
                            </tr>
                            <tr>
                                <th>Total Amount:</th>
                                <td><span>${{ $order->price }}</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
