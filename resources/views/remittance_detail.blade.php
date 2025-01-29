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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Remittance Details') }}</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">{{ __('Remittance Details for ') }} {{ $selectedYear }}</h2>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                <div class="profile-sidebar">
                    @include('layout.partials.sidebar')
                </div>
            </div>
            <!-- /Sidebar -->

            <!-- Main Content -->
            <div class="col-md-7 col-lg-8 col-xl-9">
                <div class="card card-table">
                    <div class="card-body">
                        <!-- Filter Form -->
                        <form method="GET" action="{{ route('remittances.show', ['year' => $selectedYear, 'userId' => $userId]) }}" class="mb-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="month" class="form-control">
                                        @foreach (range(1, 12) as $m)
                                            <option value="{{ $m }}" {{ $selectedMonth == $m ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="year" class="form-control">
                                        @foreach (range(now()->year - 5, now()->year) as $y)
                                            <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>
                                                {{ $y }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
                                </div>
                            </div>
                        </form>
                        <!-- /Filter Form -->

                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mentee Name</th>
                                        <th>Date</th>
                                        <th>Day of Week</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $index => $detail)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $detail->mentee->last_name }}{{ $detail->mentee->first_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($detail->schedule_date)->format('Y-m-d') }}</td>
                                        <td>{{ ucfirst($detail->day_of_week) }}</td>
                                        <td>{{ $detail->start_time }}</td>
                                        <td>{{ $detail->end_time }}</td>
                                    </tr>
                                    @endforeach
                                    @if($details->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">No classes found for this month.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Main Content -->
        </div>
    </div>
</div>
<!-- /Page Content -->

@endsection
