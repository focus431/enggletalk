<?php $page = 'profile'; ?>
@extends('layout.mainlayout')
@section('content')
  <!-- Breadcrumb -->
  <div class="breadcrumb-bar bg-gradient-light py-3 mb-4">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-12">
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb mb-0 bg-transparent">
              <li class="breadcrumb-item"><a href="index" class="text-primary hover-effect">{{ __('Home') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('Mentor Profile') }}</li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title mt-2 text-gradient">{{ __('Mentor Profile') }}</h2>
        </div>
      </div>
    </div>
  </div>
  <!-- /Breadcrumb -->

  <!-- Page Content -->
  <div class="content">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-10">
          <!-- Mentor Profile Card -->
          <div class="card main-profile-card shadow-hover rounded-lg overflow-hidden mb-4">
            <div class="card-body p-0">
              <div class="bg-gradient-primary p-4 text-white position-relative" style="min-height: 200px;">
                <div class="floating-shapes"></div>
                <div class="animated-background">
                  <div class="wave"></div>
                  <div class="wave"></div>
                  <div class="wave"></div>
                  <div class="geometric-shapes">
                    <div class="shape-1"></div>
                    <div class="shape-2"></div>
                    <div class="shape-3"></div>
                  </div>
                  <div class="particles">
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                  </div>
                </div>
                <div class="mentor-profile-img position-absolute" style="bottom: -50px; left: 30px; z-index: 2;">
                  <div class="pro-avatar-wrapper">
                    <div class="pro-avatar shadow-lg" style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden;">
                      <img src="{{ asset('storage/' . ($schedule->avatar_path ?? 'default-avatar.jpg')) }}"
                        alt="User Image" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="avatar-border"></div>
                  </div>
                </div>
              </div>
              
              <div class="p-4 pt-5 mt-5">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                  <div class="mentor-info">
                    <h3 class="mb-0 text-dark text-gradient-dark">{{ $schedule->last_name }}{{ $schedule->first_name }}</h3>
                    <p class="text-muted mb-2 fade-in">{{ ucfirst($schedule->role) }} · {{ $schedule->gender }}</p>
                    <div class="d-flex align-items-center country-badge">
                      <span id="country-name" class="flag-icon d-flex align-items-center" style="font-size: 1.5em; margin-right: 10px;"></span>
                      <span class="text-muted country-name" style="font-size: 1.1em;">{{ $schedule->country }}</span>
                    </div>
                  </div>
                  <div class="mentor-actions text-end">
                    <div class="rating mb-3 scale-in">
                      @for ($i = 0; $i < 5; $i++)
                        @if ($i < floor($averageRating))
                          <i class="fas fa-star text-warning glow"></i>
                        @else
                          <i class="fas fa-star text-muted"></i>
                        @endif
                      @endfor
                      <span class="ms-2 text-muted">({{ $averageRating }})</span>
                    </div>
                    <a class="btn btn-gradient-primary rounded-pill px-4 btn-hover-effect" 
                      href="{{ route('booking', ['encryptedUserId' => encrypt($schedule->id)]) }}">
                      <i class="fas fa-calendar-check me-2"></i>{{ __('Booking Now') }}
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /Mentor Profile Card -->

          <!-- About Me Card -->
          <div class="card content-card shadow-hover rounded-lg overflow-hidden mb-4">
            <div class="card-header bg-white py-3 border-bottom-gradient">
              <h4 class="card-title mb-0 d-flex align-items-center">
                <i class="fas fa-user-circle text-primary me-2"></i>
                {{ __('About Me') }}
              </h4>
            </div>
            <div class="card-body">
              <div class="about-content fade-in">
                {!! $schedule->about_me !!}
              </div>
            </div>
          </div>
          <!-- /About Me Card -->

          <!-- YouTube Video Card -->
          <div class="card content-card shadow-hover rounded-lg overflow-hidden mb-4">
            <div class="card-header bg-white py-3 border-bottom-gradient">
              <h4 class="card-title mb-0 d-flex align-items-center">
                <i class="fab fa-youtube text-danger me-2"></i>
                {{ __('Introduction Video') }}
              </h4>
            </div>
            <div class="card-body p-0 video-container" id="youtubeContainer">
              <!-- YouTube video will be inserted here -->
            </div>
          </div>
          <!-- /YouTube Video Card -->
        </div>
      </div>
    </div>
  </div>
  <!-- /Page Content -->

  <style>
    /* 漸變效果 */
    .bg-gradient-light {
      background: linear-gradient(120deg, #f8f9fa, #e9ecef);
    }
    
    .bg-gradient-primary {
      background: linear-gradient(135deg, #0d6efd, #0a58ca, #084298);
      position: relative;
      overflow: hidden;
    }

    .text-gradient {
      background: linear-gradient(120deg, #2c3e50, #3498db);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .text-gradient-dark {
      background: linear-gradient(120deg, #2c3e50, #34495e);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    /* 卡片效果 */
    .shadow-hover {
      transition: all 0.3s ease;
    }

    .shadow-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
    }

    /* 頭像效果 */
    .pro-avatar-wrapper {
      position: relative;
      padding: 3px;
    }

    .avatar-border {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      border: 4px solid rgba(255,255,255,0.9);
      border-radius: 50%;
      animation: borderRotate 8s linear infinite;
    }

    @keyframes borderRotate {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    /* 按鈕效果 */
    .btn-gradient-primary {
      background: linear-gradient(135deg, #0d6efd, #0a58ca);
      border: none;
      color: white;
      transition: all 0.3s ease;
    }

    .btn-hover-effect:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(13,110,253,0.4);
    }

    /* 評分星星效果 */
    .rating .fas.fa-star.glow {
      color: #ffc107;
      text-shadow: 0 0 5px rgba(255,193,7,0.5);
      animation: glowing 1.5s infinite alternate;
    }

    @keyframes glowing {
      from { text-shadow: 0 0 5px rgba(255,193,7,0.5); }
      to { text-shadow: 0 0 8px rgba(255,193,7,0.8); }
    }

    /* 漂浮形狀背景 */
    .floating-shapes {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 1;
    }

    .floating-shapes::before,
    .floating-shapes::after {
      content: '';
      position: absolute;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: rgba(255,255,255,0.1);
      animation: float 10s infinite linear;
    }

    .floating-shapes::after {
      width: 70px;
      height: 70px;
      animation-duration: 15s;
      animation-delay: -5s;
    }

    @keyframes float {
      0% { transform: translate(0, 0) rotate(0deg); }
      100% { transform: translate(100px, -100px) rotate(360deg); }
    }

    /* 內容卡片邊框效果 */
    .border-bottom-gradient {
      border-bottom: 3px solid;
      border-image: linear-gradient(to right, #0d6efd, #0a58ca);
      border-image-slice: 1;
    }

    /* 淡入動畫 */
    .fade-in {
      animation: fadeIn 0.8s ease-in;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* 縮放動畫 */
    .scale-in {
      animation: scaleIn 0.5s ease-out;
    }

    @keyframes scaleIn {
      from { transform: scale(0.9); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }

    /* 國家徽章效果 */
    .country-badge {
      background: rgba(13,110,253,0.1);
      padding: 10px 20px;
      border-radius: 25px;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 10px;
    }

    .country-badge:hover {
      background: rgba(13,110,253,0.2);
      transform: translateX(5px);
    }

    .country-badge .flag-icon {
      display: flex;
      align-items: center;
      justify-content: center;
      line-height: 1;
      transform: scale(1.2);
    }

    .country-badge .country-name {
      line-height: 1;
      font-weight: 500;
    }

    /* 視頻容器效果 */
    .video-container {
      position: relative;
      background: #000;
      border-radius: 0 0 0.5rem 0.5rem;
      overflow: hidden;
    }

    .video-container iframe {
      transition: all 0.3s ease;
    }

    .video-container:hover iframe {
      transform: scale(1.01);
    }

    /* 連結懸停效果 */
    .hover-effect {
      position: relative;
      text-decoration: none;
    }

    .hover-effect::after {
      content: '';
      position: absolute;
      width: 100%;
      height: 2px;
      bottom: -2px;
      left: 0;
      background: linear-gradient(to right, #0d6efd, #0a58ca);
      transform: scaleX(0);
      transition: transform 0.3s ease;
    }

    .hover-effect:hover::after {
      transform: scaleX(1);
    }

    /* 新增背景動畫效果 */
    .animated-background {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      overflow: hidden;
      z-index: 1;
    }

    /* 波浪效果 */
    .wave {
      position: absolute;
      width: 200%;
      height: 200%;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 45%;
      animation: wave 20s infinite linear;
      transform-origin: 50% 50%;
    }

    .wave:nth-child(2) {
      animation-duration: 17s;
      opacity: 0.3;
    }

    .wave:nth-child(3) {
      animation-duration: 25s;
      opacity: 0.2;
    }

    @keyframes wave {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    /* 幾何圖形 */
    .geometric-shapes {
      position: absolute;
      width: 100%;
      height: 100%;
    }

    .shape-1, .shape-2, .shape-3 {
      position: absolute;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 15px;
      animation: float-shape 15s infinite ease-in-out;
    }

    .shape-1 {
      width: 60px;
      height: 60px;
      top: 20%;
      left: 20%;
      transform: rotate(45deg);
    }

    .shape-2 {
      width: 40px;
      height: 40px;
      top: 60%;
      right: 20%;
      animation-delay: -7s;
    }

    .shape-3 {
      width: 50px;
      height: 50px;
      bottom: 20%;
      left: 50%;
      animation-delay: -3s;
      border-radius: 50%;
    }

    @keyframes float-shape {
      0%, 100% { transform: translateY(0) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(180deg); }
    }

    /* 粒子效果 */
    .particles {
      position: absolute;
      width: 100%;
      height: 100%;
    }

    .particle {
      position: absolute;
      width: 6px;
      height: 6px;
      background: rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      animation: particle-float 10s infinite linear;
    }

    .particle:nth-child(1) { top: 20%; left: 20%; animation-delay: 0s; }
    .particle:nth-child(2) { top: 60%; left: 80%; animation-delay: -2s; }
    .particle:nth-child(3) { top: 40%; left: 40%; animation-delay: -4s; }
    .particle:nth-child(4) { top: 80%; left: 60%; animation-delay: -6s; }
    .particle:nth-child(5) { top: 30%; left: 70%; animation-delay: -8s; }

    @keyframes particle-float {
      0% {
        transform: translate(0, 0) scale(1);
        opacity: 0.3;
      }
      25% {
        transform: translate(10px, -10px) scale(1.2);
        opacity: 0.6;
      }
      50% {
        transform: translate(20px, 0) scale(1);
        opacity: 0.3;
      }
      75% {
        transform: translate(10px, 10px) scale(0.8);
        opacity: 0.6;
      }
      100% {
        transform: translate(0, 0) scale(1);
        opacity: 0.3;
      }
    }

    /* 增強卡片陰影效果 */
    .main-profile-card {
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .main-profile-card:hover {
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }
  </style>
@endsection

@section('scripts')
  <script>
    // YouTube video embedding
    var youtubeLink = "{{ $schedule->youtube_link }}";
    var video_id = new URLSearchParams(new URL(youtubeLink).search).get("v");

    if (video_id) {
      var iframe = document.createElement('iframe');
      iframe.width = "100%";
      iframe.height = "500";
      iframe.src = "https://www.youtube.com/embed/" + video_id;
      iframe.frameBorder = "0";
      iframe.allowFullscreen = true;

      document.getElementById('youtubeContainer').appendChild(iframe);
    }

    // Country flags
    const countryToFlag = {
      'USA': '🇺🇸',
      'Taiwan': '🇹🇼',
      '台灣': '🇹🇼',
      'Philippines': '🇵🇭',
      '菲律賓': '🇵🇭',
    };

    const countryNameFromSchedule = "{{ $schedule->country }}";
    const countryNameElement = document.getElementById('country-name');
    countryNameElement.textContent = countryToFlag[countryNameFromSchedule] || countryNameFromSchedule;
  </script>
@endsection
