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
                        <!-- Filter Form -->
                        <form method="GET" action="{{ route('remittances.index') }}" class="mb-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="month" class="form-control">
                                        @foreach (range(1, 12) as $m)
                                            <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="year" class="form-control">
                                        @foreach (range(now()->year - 5, now()->year) as $y)
                                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                                {{ $y }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                        <!-- Remittance Table -->
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>Total Lessons</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th>Paid On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($remittances as $remittance)
                                    <tr>
                                        <td>{{ $remittance->month }}</td>
                                        <td>{{ $remittance->total_lessons }}</td>
                                        <td>${{ number_format($remittance->total_amount, 2) }}</td>
                                        <td>{{ $remittance->status }}</td>
                                        <td>{{ $remittance->paid_on ? \Carbon\Carbon::parse($remittance->paid_on)->format('Y-m-d') : 'N/A' }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('remittances.show', [
                                                    'year' => $remittance->year, 
                                                    'userId' => $remittance->teacher_id
                                                ]) }}" class="btn btn-sm bg-info-light">
                                                <i class="far fa-eye"></i> View
                                            </a>
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                    @if($remittances->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">No remittances found.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /Remittance Table -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Content -->
@endsection
