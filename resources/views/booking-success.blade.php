@extends('layout.mainlayout')
@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Booking</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Booking</h2>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content success-page-cont">
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-lg-6">

                <!-- Success Card -->
                <div class="card success-card">
                    <div class="card-body">
                        <div class="success-cont">
                            <i class="fas fa-check"></i>
                            <h3>Purchasing Successful!</h3>
                            <p>
    Our staff will activate your account as soon as possible.<br>
    Your details are as follows: 
    <strong>{{ session('orderPlan')->last_name }} {{ session('orderPlan')->first_name }}</strong><br>
    on <strong>{{ session('orderPlan')->selected_plan }}</strong><br>
    Lessons: <strong>{{ session('orderPlan')->lessons }}</strong><br>
    Price: <strong>${{ number_format(session('orderPlan')->price, 0) }}</strong><br>
    Duration: <strong>{{ session('orderPlan')->duration }} days</strong><br>
    Expiry Date: <strong>{{ session('orderPlan')->expiry_date->format('Y-m-d') }}</strong>
</p>

                            {{-- <a href="invoice-view" class="btn btn-primary view-inv-btn">View Invoice</a> --}}
                            <a href="/" class="btn btn-primary view-inv-btn">Return to Home</a>

                        </div>
                    </div>
                </div>
                              
                <!-- /Success Card -->
            </div>
        </div>

    </div>
</div>
<!-- /Page Content -->
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@endsection
