@extends('layout.mainlayout')
@section('content')        
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li> --}}
                        <li class="breadcrumb-item"><a href="{{ route('invoices') }}">Invoices</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Invoice View</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Invoice View</h2>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="invoice-content">
                    <div class="invoice-item">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="invoice-logo">
                                    <img src="{{ asset('assets/img/logo.png') }}" alt="logo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="invoice-details">
                                    <strong>Order:</strong> #INV-{{ $order->id }} <br>
                                    <strong>Issued:</strong> {{ $order->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Invoice Item -->
                    <div class="invoice-item">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="invoice-info">
                                    <strong class="customer-text">Invoice From</strong>
                                    <p class="invoice-details invoice-details-two">
                                        Ge Zhong Education Inc. <br>
                                        No. 123, Zhongshan Road, Taoyuan, Taiwan <br>
                                        Phone: +886 3 123 4567 <br>
                                        Email: info@gezhong.com
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="invoice-info invoice-info2">
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
                    <!-- /Invoice Item -->
                    
                    <!-- Invoice Item -->
                    <div class="invoice-item">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="invoice-info">
                                    <strong class="customer-text">Payment Method</strong>
                                    <p class="invoice-details invoice-details-two">
                                        {{ $order->payment_option }} <br>
                                        Payment proof: <a href="{{ asset($order->payment_proof) }}">View proof</a><br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Invoice Item -->
                    
                    <!-- Invoice Item -->
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
                    <!-- /Invoice Item -->
                    
                    <!-- Invoice Information -->
                    <div class="other-info">
                        <h4>Other information</h4>
                        <p class="text-muted mb-0">Additional information can be placed here.</p>
                    </div>
                    <!-- /Invoice Information -->
                    
                </div>
            </div>
        </div>

    </div>

</div>        
<!-- /Page Content -->
@endsection
