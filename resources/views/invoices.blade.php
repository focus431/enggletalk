<?php $page="invoices";?>
@extends('layout.mainlayout')
@section('content')	
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Invoices') }}</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">{{ __('Invoices') }}</h2>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
            
                <!-- Sidebar -->
                <div class="profile-sidebar">
                @include('layout.partials.sidebar')
                </div>
                <!-- /Sidebar -->
                
            </div>
            <div class="col-md-7 col-lg-8 col-xl-9">
                <div class="card card-table">
                    <div class="card-body">
                    
                        <!-- Invoice Table -->
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('Invoice No') }}</th>
                                        <th>{{ __('Plan') }}</th>
                                        <th>{{ __('Lessons') }}</th>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Paid On') }}</th>
                                        <th>{{ __('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
																	@foreach ($orderPlans as $order)
																	<tr>
																			<td>
																					<a href="{{ route('invoice.view', $order->id) }}">#INV-{{ $order->id }}</a>
																			</td>
																			<td>{{ $order->selected_plan }}</td>
																			<td>{{ $order->lessons }}</td>
																			<td>${{ $order->price }}</td>
																			<td>{{ $order->created_at->format('d M Y') }}</td>
																			<td class="text-end">
																					<div class="table-action">
																							<a href="{{ route('invoice.view', $order->id) }}" class="btn btn-sm bg-info-light">
																									<i class="far fa-eye"></i> View
																							</a>
																							<a href="{{ route('invoice.print', $order->id) }}" target="_blank" class="btn btn-sm bg-primary-light">
																									<i class="fas fa-print"></i> Print
																							</a>
																					</div>
																			</td>
																	</tr>
																	@endforeach
																	@if($orderPlans->isEmpty())
																	<tr>
																			<td colspan="6" class="text-center">No invoices found.</td>
																	</tr>
																	@endif
															</tbody>
															
															
                            </table>
                        </div>
                        <!-- /Invoice Table -->
                        
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>		
<!-- /Page Content -->	
@endsection
