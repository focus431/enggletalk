<?php $page = 'paymentplan'; ?>
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
              <li class="breadcrumb-item active" aria-current="page">{{ __('Discount Plans') }}</li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title">{{ __('Discount Plans') }}</h2>
        </div>
      </div>
    </div>
  </div>
  <!-- /Breadcrumb -->

  <!-- Page Content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- 侧边栏 -->
        <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
          <!-- Sidebar -->
          <div class="profile-sidebar">
            @include('layout.partials.sidebar')
          </div>
          <!-- /Sidebar -->
        </div>

        <!-- 主体内容 -->
        <div class="col-md-7 col-lg-8 col-xl-9">
          <!-- 月繳方案 -->
          <div class="row paymentplan">
            <div class="col-2">
              <div class="card pay fixed-card title">
                <div class="card-body">
                  <h5 class="card-title">{{ __('Monthly') }}</h5>
                  <p class="card-text">{{ __('Renew') }}/30 {{ __('days') }}</p>
                </div>
              </div>
            </div>
            <div class="col-10">
              <div class="row paymentplan">
                @foreach ($plans->where('duration', 30) as $plan)
                  <div class="col-3">
                    <div class="card pay fixed-card" data-id="{{ $plan->id }}">
                      <div class="card-body">
                        <p class="card-text">
                          {{ number_format(round($plan->converted_price), 0) }} {{ $currency }}
                        </p>
                        <p class="card-text">{{ $plan->lessons }} {{ __('Classes') }}/{{ __('Monthly') }}</p>
                        <button class="btn btn-primary register-btn">{{ __('Booking') }}</button>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>

          <!-- 季繳方案 -->
          <div class="row paymentplan">
            <div class="col-2">
              <div class="card pay fixed-card title">
                <div class="card-body">
                  <h5 class="card-title">{{ __('Quarterly') }}</h5>
                  <p class="card-text">{{ __('Renew') }}/90 {{ __('days') }}</p>
                </div>
              </div>
            </div>
            <div class="col-10">
              <div class="row paymentplan">
                @foreach ($plans->where('duration', 90) as $plan)
                  <div class="col-3">
                    <div class="card pay fixed-card" data-id="{{ $plan->id }}">
                      <div class="card-body">
                        <p class="card-text">
                          {{ number_format(round($plan->converted_price), 0) }} {{ $currency }}
                        </p>
                        <p class="card-text">{{ $plan->lessons }} {{ __('Classes') }}/{{ __('Quarterly') }}</p>
                        <button class="btn btn-primary register-btn">{{ __('Booking') }}</button>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>

          <!-- 显示更多 -->
          <div class="row">
            <div class="col-12 text-center">
              <button id="show-more" class="btn btn-secondary">{{ __('Show More') }}</button>
            </div>
          </div>

          <div id="additional-plans" style="display: none;">
            <!-- 半年繳方案 -->
            <div class="row paymentplan">
              <div class="col-2">
                <div class="card pay fixed-card title">
                  <div class="card-body">
                    <h5 class="card-title">{{ __('Semi-Annual') }}</h5>
                    <p class="card-text">{{ __('Renew') }}/180 {{ __('days') }}</p>
                  </div>
                </div>
              </div>
              <div class="col-10">
                <div class="row paymentplan">
                  @foreach ($plans->where('duration', 180) as $plan)
                    <div class="col-3">
                      <div class="card pay fixed-card" data-id="{{ $plan->id }}">
                        <div class="card-body">
                          <p class="card-text">
                            {{ number_format(round($plan->converted_price), 0) }} {{ $currency }}
                          </p>
                          <p class="card-text">{{ $plan->lessons }} {{ __('Classes') }}/{{ __('Semi-Annual') }}</p>
                          <button class="btn btn-primary register-btn">{{ __('Booking') }}</button>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>

            <!-- 年繳方案 -->
            <div class="row paymentplan">
              <div class="col-2">
                <div class="card pay fixed-card title">
                  <div class="card-body">
                    <h5 class="card-title">{{ __('Annual') }}</h5>
                    <p class="card-text">{{ __('Renew') }}/365 {{ __('days') }}</p>
                  </div>
                </div>
              </div>
              <div class="col-10">
                <div class="row paymentplan">
                  @foreach ($plans->where('duration', 365) as $plan)
                    <div class="col-3">
                      <div class="card pay fixed-card" data-id="{{ $plan->id }}">
                        <div class="card-body">
                          <p class="card-text">
                            {{ number_format(round($plan->converted_price), 0) }} {{ $currency }}
                          </p>
                          <p class="card-text">{{ $plan->lessons }} {{ __('Classes') }}/{{ __('Annual') }}</p>
                          <button class="btn btn-primary register-btn">{{ __('Booking') }}</button>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div> <!-- /additional-plans -->
        </div> <!-- /col-md-7 -->
      </div> <!-- /row -->
    </div> <!-- /container-fluid -->
  </div> <!-- /content -->
  <!-- /Page Content -->
@endsection

@section('scripts')
  <script>
    window.isLoggedIn = @json($isLoggedIn);
    window.isMentee = @json($isMentee);
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const registerButtons = document.querySelectorAll('.register-btn');

      registerButtons.forEach(function(button) {
        button.addEventListener('click', function() {
          const cardElement = button.closest('.card');
          const cardId = cardElement.getAttribute('data-id');

          if (window.isLoggedIn) {
            if (window.isMentee) {
              // 建立表單並在新視窗開啟
              const form = document.createElement('form');
              form.method = 'POST';
              form.action = '/checkout';
              form.target = '_blank'; // 設置在新視窗開啟

              const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
              const csrfInput = document.createElement('input');
              csrfInput.type = 'hidden';
              csrfInput.name = '_token';
              csrfInput.value = csrfToken;

              const cardIdInput = document.createElement('input');
              cardIdInput.type = 'hidden';
              cardIdInput.name = 'card_id';
              cardIdInput.value = cardId;

              form.appendChild(csrfInput);
              form.appendChild(cardIdInput);
              document.body.appendChild(form);
              form.submit();
            } else {
              alert('{{ __('You are not a mentee, you cannot register!') }}');
            }
          } else {
            window.open(`/login?redirect_to=/checkout?card_id=${cardId}`, '_blank');
          }
        });
      });

      // 「显示更多」按钮的控制
      document.getElementById('show-more').addEventListener('click', function() {
        // 显示其他方案
        var additionalPlans = document.getElementById('additional-plans');
        additionalPlans.style.display = '';

        // 隐藏按钮本身
        this.style.display = 'none';
      });
    });
  </script>
@endsection
