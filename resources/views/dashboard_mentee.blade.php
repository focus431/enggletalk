<?php $page = 'dashboard-mentee'; ?>
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
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title">Dashboard</h2>
        </div>
      </div>
    </div>
  </div>
  <!-- /Breadcrumb -->

  <!-- Page Content -->
  <div class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-5 col-lg-3 col-xl-3 theiaStickySidebar">
          <!-- Sidebar -->
          <div class="profile-sidebar">
            @include('layout.partials.sidebar')
          </div>
          <!-- /Sidebar -->
        </div>
        <div class="col-md-7 col-lg-9 col-xl-9">
          
          
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="card">
                <div class="card-body">
                  <div class="dash-widget-header">
                    <span class="dash-widget-icon text-primary border-primary">
                      <i class="fe fe-users"></i>
                    </span>
                    <div class="dash-count">
                      <h3><span>{{ $bookedCount }}</span></h3>
                    </div>
                  </div>
                  <div class="dash-widget-info">
                    <h6 class="text-muted">{{ __('Upcoming') }}</h6>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-primary w-50"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="card">
                <div class="card-body">
                  <div class="dash-widget-header">
                    <span class="dash-widget-icon text-success">
                      <i class="fe fe-credit-card"></i>
                    </span>
                    <div class="dash-count">
                      <h3>{{ $completedCount }}</span></h3>
                    </div>
                  </div>
                  <div class="dash-widget-info">
                    <h6 class="text-muted">{{ __('Completed') }}</h6>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-success w-50"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="card">
                <div class="card-body">
                  <div class="dash-widget-header">
                    <span class="dash-widget-icon text-danger border-danger">
                      <i class="fe fe-users"></i>
                    </span>
                    <div class="dash-count">
                      <h3>{{ $absentCount }}</h3>
                    </div>
                  </div>
                  <div class="dash-widget-info">
                    <h6 class="text-muted">{{ __('Absent') }}</h6>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-danger w-50"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="card">
                <div class="card-body">
                  <div class="dash-widget-header">
                    <span class="dash-widget-icon text-warning border-warning">
                      <i class="fe fe-folder"></i>
                    </span>
                    <div class="dash-count">
                      <h3>{{ $remaining }} </h3>
                      <h5> {{ $t_expired}} </h5>
                    </div>
                  </div>
                  <div class="dash-widget-info">
                    <h6 class="text-muted">{{ __('Remaining') }}</h6>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-warning w-50"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <!-- Sales Chart -->
              <div class="card card-chart">
                <div class="card-header">
                  <h4 class="card-title">{{ __('Upcoming') }}</h4>
                </div>
                <div class="card-body">
                  <canvas id="monthlyChart"></canvas>
                </div>
              </div>
              <!-- /Sales Chart -->
            </div>
          </div>
         

        </div>
      </div>

    </div>

  </div>
  <!-- /Page Content -->
@endsection

@section('scripts')
  <script>
    var bookedData = @json($bookedMonthly);
    var completedData = @json($completedMonthly);

    // 處理數據以適合於圖表
    // 假設 bookedData 和 completedData 是包含 {month: x, count: y} 對象的數組

    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
      'November', 'December'
    ];
    var bookedCounts = months.map(month => {
      var data = bookedData.find(data => data.month == months.indexOf(month) + 1);
      return data ? data.count : 0;
    });

    var completedCounts = months.map(month => {
      var data = completedData.find(data => data.month == months.indexOf(month) + 1);
      return data ? data.count : 0;
    });

    // 創建圖表
    var ctx = document.getElementById('monthlyChart').getContext('2d');
    var monthlyChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: months,
        datasets: [{
          label: 'Booked',
          data: bookedCounts,
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }, {
          label: 'Completed',
          data: completedCounts,
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
@endsection
