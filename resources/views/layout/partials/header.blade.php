<?php error_reporting(0); ?>
<!-- Loader -->
@if (Route::is(['map-grid', 'map-list']))
<div id="loader">
  <div class="loader">
    <span></span>
    <span></span>
  </div>
</div>
@endif
<!-- /Loader  -->

<!-- Header -->
<header class="header">
  <div class="header-fixed">
    <nav class="navbar navbar-expand-lg header-nav">
      <div class="navbar-header">
        <a id="mobile_btn" href="javascript:void(0);">
          <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
          </span>
        </a>
        <a href="/index" class="navbar-brand logo">
          <img src="/assets/img/logo.png" class="img-fluid" alt="Logo">
        </a>
      </div>
      <div class="main-menu-wrapper">
        <div class="menu-header">
          <a href="/index" class="menu-logo">
            <img src="/assets/img/logo.png" class="img-fluid" alt="Logo">
          </a>
          <a id="menu_close" class="menu-close" href="javascript:void(0);">
            <i class="fas fa-times"></i>
          </a>
        </div>
        <ul class="main-nav">
          @if (!Auth::check() || Auth::user()->role == 'mentee')
            @if(app()->getLocale() === 'vi')
              <!-- 越南語系時的下拉式選單 -->
              <li class="has-submenu">
                <a href="#" class="main-menu-link">
                  <i class="fas fa-bars"></i> 
                  {{ __('Menu') }}
                  <i class="fas fa-chevron-down"></i>
                </a>
                <ul class="submenu">
                  <li>
                    <a href="{{ url('/toeic-test/reading') }}">
                      <i class="fas fa-book-reader"></i> {{ __('TOEIC Reading') }}
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('/toeic-test/listening') }}">
                      <i class="fas fa-headphones"></i> {{ __('TOEIC Listening') }}
                    </a>
                  </li>
                  <li>
                    <a href="/course_info">
                      <i class="fas fa-info-circle"></i> {{ __('Course Introduction') }}
                    </a>
                  </li>
                  <li>
                    <a href="/search">
                      <i class="fas fa-search"></i> {{ __('Search Teachers') }}
                    </a>
                  </li>
                  <li>
                    <a href="/paymentplan">
                      <i class="fas fa-tags"></i> {{ __('Discount Plans') }}
                    </a>
                  </li>
                  <li>
                    <a href="/fqa">
                      <i class="fas fa-question-circle"></i> {{ __('FQA') }}
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('essays.index') }}">
                      <i class="fas fa-pencil-alt"></i> {{ __('Essay Correction') }}
                    </a>
                  </li>
                </ul>
              </li>
            @else
              <!-- 其他語系時的一般導航 -->
              <li class="has-submenu {{ Request::is('toeic-test/*') ? 'active' : '' }}">
                <a href="#" class="nav-link">
                  <i class="fas fa-graduation-cap"></i>
                  {{ __('TOEIC Test') }}
                  <i class="fas fa-chevron-down"></i>
                </a>
                <ul class="submenu">
                  <li class="{{ Request::is('toeic-test/reading') ? 'active' : '' }}">
                    <a href="{{ url('/toeic-test/reading') }}">
                      <i class="fas fa-book-reader"></i> {{ __('Reading Test') }}
                    </a>
                  </li>
                  <li class="{{ Request::is('toeic-test/listening') ? 'active' : '' }}">
                    <a href="{{ url('/toeic-test/listening') }}">
                      <i class="fas fa-headphones"></i> {{ __('Listening Test') }}
                    </a>
                  </li>
                </ul>
              </li>
              <li class="{{ Request::is('/course_info') ? 'active' : '' }}">
                <a href="/course_info">{{ __('Course Introduction') }}</a>
              </li>
              <li class="{{ Request::is('/search') ? 'active' : '' }}">
                <a href="/search">{{ __('Search Teachers') }}</a>
              </li>
              <li class="{{ Request::is('/paymentplan') ? 'active' : '' }}">
                <a href="/paymentplan">{{ __('Discount Plans') }}</a>
              </li>
              <li class="{{ Request::is('/fqa') ? 'active' : '' }}">
                <a href="/fqa">{{ __('FQA') }}</a>
              </li>
              <li class="{{ Request::is('essays*') ? 'active' : '' }}">
                <a href="{{ route('essays.index') }}">
                  <i class="fas fa-pencil-alt"></i> {{ __('Essay Correction') }}
                </a>
              </li>
            @endif

            <li class="login-link">
              <a href="login">{{ __('Login/Signup') }}</a>
            </li>
          @endif
        </ul>
      </div>

      <ul class="nav header-navbar-rht">
        @if (Auth::check())
        <!-- 已登入用戶選單 -->
        <li class="nav-item dropdown has-arrow logged-item">
          <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
            <span class="user-img">
              <img src="{{ asset('storage/' . (Auth::user()->avatar_path ?? 'default-avatar.jpg')) }}" class="rounded-circle" width="31" alt="User Image">
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-end">
            <div class="user-header">
              <div class="avatar avatar-sm">
                <img src="{{ asset('storage/' . (Auth::user()->avatar_path ?? 'default-avatar.jpg')) }}" class="avatar-img rounded-circle" alt="User Image">
              </div>
              <div class="user-text">
                <h6>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h6>
                <p class="text-muted mb-0">{{ ucfirst(Auth::user()->role) }}</p>
              </div>
            </div>
            <a class="dropdown-item" href="{{ Auth::user()->role == 'mentee' ? '/dashboard_mentee' : '/dashboard_mentor' }}">{{ __('Dashboard') }}</a>
            <a class="dropdown-item" href="/profile-settings-{{ Auth::user()->role }}">{{ __('Profile Settings') }}</a>
            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
          </div>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link header-login" href="/mentee-register">{{ __('Login/Signup') }}</a>
        </li>
        @endif

        <!-- 語言選擇 -->
        <li class="nav-item dropdown language-dropdown">
          <a href="#" class="nav-link dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown">
            <i class="fas fa-globe fa-lg text-primary"></i> 
            <span class="current-lang">{{ config('app.languages')[app()->getLocale()] ?? app()->getLocale() }}</span>
          </a>
          <div class="dropdown-menu language-menu dropdown-menu-end">
            @foreach (config('app.languages') as $lang => $language)
              <a class="dropdown-item lang-item d-flex align-items-center gap-3 py-2 px-3" href="{{ route('lang.switch', $lang) }}">
                @if($lang == 'en')
                  <span class="flag-icon">🇺🇸</span>
                @elseif($lang == 'zh_TW')
                  <span class="flag-icon">🇹🇼</span>
                @elseif($lang == 'zh_CN')
                  <span class="flag-icon">🇨🇳</span>
                @elseif($lang == 'ja')
                  <span class="flag-icon">🇯🇵</span>
                @elseif($lang == 'ko')
                  <span class="flag-icon">🇰🇷</span>
                @elseif($lang == 'vi')
                  <span class="flag-icon">🇻🇳</span>
                @endif
                <span class="lang-text">{{ $language }}</span>
              </a>
            @endforeach
          </div>
        </li>
      </ul>
    </nav>
  </div>
</header>

<style>
/* 語言選擇器樣式 */
.language-dropdown .nav-link {
  padding: 8px 15px;
  border-radius: 30px;
  transition: all 0.3s ease;
  background: rgba(13, 110, 253, 0.1);
}

.language-dropdown .nav-link:hover {
  background: rgba(13, 110, 253, 0.15);
}

.language-dropdown .current-lang {
  font-weight: 500;
  color: #333;
}

.language-menu {
  min-width: 200px;
  padding: 8px;
  border: none;
  border-radius: 12px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  transform: translateY(10px);
  opacity: 0;
  visibility: hidden;
  transition: all 0.3s ease;
}

.language-dropdown.show .language-menu {
  transform: translateY(0);
  opacity: 1;
  visibility: visible;
}

.lang-item {
  border-radius: 8px;
  margin: 2px 0;
  transition: all 0.2s ease;
}

.lang-item:hover {
  background-color: rgba(13, 110, 253, 0.1);
}

.lang-item .flag-icon {
  font-size: 1.5em;
  transition: transform 0.3s ease;
}

.lang-item:hover .flag-icon {
  transform: scale(1.2);
}

.lang-item .lang-text {
  font-weight: 500;
  color: #333;
}

/* 下拉選單樣式 */
.main-nav .has-submenu {
  position: relative;
}

.main-nav .has-submenu > a {
  padding: 10px 15px;
  display: flex;
  align-items: center;
  gap: 8px;
  color: #333;
  font-weight: 500;
}

.main-nav .submenu {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  background: white;
  box-shadow: 0 2px 15px rgba(0,0,0,0.1);
  border-radius: 8px;
  min-width: 220px;
  z-index: 1000;
  padding: 8px 0;
}

.main-nav .has-submenu:hover .submenu {
  display: block;
  animation: fadeInDown 0.3s ease;
}

.main-nav .submenu li a {
  padding: 10px 20px;
  display: flex;
  align-items: center;
  gap: 10px;
  color: #333;
  transition: all 0.3s ease;
  font-size: 14px;
}

.main-nav .submenu li a:hover {
  background: #f8f9fa;
  color: #0d6efd;
  padding-left: 25px;
}

.main-nav .submenu li.active a {
  color: #0d6efd;
  background: #e8f0fe;
}

/* 越南語系特殊樣式 */
html[lang="vi"] .main-nav .submenu {
  font-family: 'Roboto', sans-serif;
  min-width: 250px;
}

html[lang="vi"] .main-nav .submenu li a {
  font-size: 13px;
  padding: 12px 20px;
}

/* 動畫效果 */
@keyframes fadeInDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* 圖標樣式 */
.main-nav i {
  font-size: 16px;
}

.main-menu-link i.fas.fa-bars {
  font-size: 18px;
}

/* 語言選單樣式 */
.dropdown-menu {
  border-radius: 8px;
  box-shadow: 0 2px 15px rgba(0,0,0,0.1);
}

.dropdown-item {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 20px;
}

.dropdown-item:hover {
  background: #f8f9fa;
}

.flag-icon {
  width: 20px;
  height: 15px;
  display: inline-block;
  background-size: cover;
  margin-right: 8px;
}
</style>

<div class="main-wrapper">
  @section('scripts')
  <script src="{{ asset('assets/js/common-share.js') }}"></script>
  @endsection
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // 添加動畫效果
  const dropdowns = document.querySelectorAll('.language-dropdown');
  dropdowns.forEach(dropdown => {
    dropdown.addEventListener('show.bs.dropdown', function() {
      setTimeout(() => {
        this.querySelector('.language-menu').style.opacity = '1';
        this.querySelector('.language-menu').style.transform = 'translateY(0)';
      }, 0);
    });

    dropdown.addEventListener('hide.bs.dropdown', function() {
      this.querySelector('.language-menu').style.opacity = '0';
      this.querySelector('.language-menu').style.transform = 'translateY(10px)';
    });
  });
});
</script>