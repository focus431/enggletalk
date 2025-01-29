@php
  $completionPercentage = $completionPercentage ?? 0;
@endphp

@if (Auth::check())
  @php
    $user = Auth::user();
  @endphp

  @if ($user->role == 'admin')
  
    <!-- Admin 的侧边栏项目 -->
  @elseif ($user->role == 'mentor')
    <!-- Mentor 的侧边栏项目 -->
    <div class="user-widget">
      <div class="pro-avatar" style="width: 150px; height: 150px; overflow: hidden;">
        <img src="{{ asset('storage/' . ($user->avatar_path ?? 'default-avatar.jpg')) }}" alt="User Image"
          style="width: 100%; height: 100%; object-fit: cover;">
      </div>
      <div class="rating">
        <i class="fas fa-star filled"></i>
        <i class="fas fa-star filled"></i>
        <i class="fas fa-star filled"></i>
        <i class="fas fa-star filled"></i>
        <i class="fas fa-star"></i>
      </div>
      <div class="user-info-cont">
        <h4 class="usr-name">{{ $user->last_name }} {{ $user->first_name }}</h4>
        <p class="mentee-type">{{ ucfirst($user->role) }}</p>
      </div>
    </div>
    <div class="progress-bar-custom">
      <h6>{{ __('Complete your profiles') }}</h6>
      <div class="pro-progress">
        <div class="tooltip-toggle" tabindex="0" style="width: {{ $completionPercentage }}%;"></div>
        <div class="tooltip">{{ round($completionPercentage, 2) }}%</div>
      </div>
    </div>

    <div class="custom-sidebar-nav">
      <ul>
        <li><a href="/dashboard_mentor" class="{{ Request::is('dashboard_mentor') ? 'active' : '' }}"><i
              class="fas fa-home"></i>{{ __('Dashboard') }} <span><i class="fas fa-chevron-right"></i></span></a></li>
        <li><a href="/bookings_mentor" class="{{ Request::is('bookings_mentor') ? 'active' : '' }}"><i
              class="fas fa-clock"></i>{{ __('My Classes') }} <span><i class="fas fa-chevron-right"></i></span></a>
        </li>
        <li><a href="/schedule-timings" class="{{ Request::is('schedule-timings') ? 'active' : '' }}"><i
              class="fas fa-hourglass-start"></i>{{ __('Scheduled') }} <span><i
                class="fas fa-chevron-right"></i></span></a></li>
        <li><a href="/remittances" class="{{ Request::is('remittances') ? 'active' : '' }}"><i
              class="fas fa-file-invoice"></i>{{ __('Remittances') }} <span><i
                class="fas fa-chevron-right"></i></span></a></li>
        <li><a href="/profile-settings-mentor" class="{{ Request::is('profile-settings-mentor') ? 'active' : '' }}"><i
              class="fas fa-user-cog"></i>{{ __('Profile') }} <span><i class="fas fa-chevron-right"></i></span></a>
        </li>
        <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="{{ Request::is('logout') ? 'active' : '' }}"><i class="fas fa-sign-out-alt"></i>{{ __('Logout') }}
            <span><i class="fas fa-chevron-right"></i></span></a></li>
      </ul>
    </div>
  @else
    <!-- Mentee 的侧边栏项目 -->
    <div class="user-widget">
      <div class="pro-avatar" style="width: 100px; height: 100px; overflow: hidden;">
        <img src="{{ asset('storage/' . ($user->avatar_path ?? 'default-avatar.jpg')) }}" alt="User Image"
          style="width: 100%; height: 100%; object-fit: cover;">
      </div>
      <div class="user-info-cont">
        <h4 class="usr-name">{{ $user->last_name }} {{ $user->first_name }}</h4>
        <p class="mentee-type">{{ ucfirst($user->role) }}</p>
      </div>
    </div>
    <div class="progress-bar-custom">
      <h6>{{ __('Complete your profiles') }}</h6>
      <div class="pro-progress">
        <div class="tooltip-toggle" tabindex="0" style="width: {{ $completionPercentage }}%;"></div>
        <div class="tooltip">{{ round($completionPercentage, 2) }}%</div>
      </div>
    </div>

    <div class="custom-sidebar-nav">
      <ul>
        <li><a href="/dashboard_mentee" class="{{ Request::is('dashboard_mentee') ? 'active' : '' }}"><i
              class="fas fa-home"></i>{{ __('Dashboard') }} <span><i class="fas fa-chevron-right"></i></span></a></li>
        <li><a href="/bookings_mentee" class="{{ Request::is('bookings_mentee') ? 'active' : '' }}"><i
              class="fas fa-clock"></i>{{ __('My Classes') }} <span><i class="fas fa-chevron-right"></i></span></a>
        </li>
        <li><a href="/favourites" class="{{ Request::is('favourites') ? 'active' : '' }}"><i
              class="fas fa-hourglass-start"></i>{{ __('favourites') }} <span><i
                class="fas fa-chevron-right"></i></span></a></li>
        <li><a href="/paymentplan" class="{{ Request::is('paymentplan') ? 'active' : '' }}"><i
              class="fas fa-user-cog"></i>{{ __('Plans') }} <span><i class="fas fa-chevron-right"></i></span></a>
        </li>
        <li><a href="/invoices" class="{{ Request::is('invoices') ? 'active' : '' }}"><i
              class="fas fa-file-invoice"></i>{{ __('Invoices') }} <span><i
                class="fas fa-chevron-right"></i></span></a>
        </li>
        <li><a href="/profile-settings-mentee" class="{{ Request::is('profile-settings-mentee') ? 'active' : '' }}"><i
              class="fas fa-user-cog"></i>{{ __('Profile') }} <span><i class="fas fa-chevron-right"></i></span></a>
        </li>
        <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="{{ Request::is('logout') ? 'active' : '' }}"><i class="fas fa-sign-out-alt"></i>{{ __('Logout') }}
            <span><i class="fas fa-chevron-right"></i></span></a></li>
      </ul>
    </div>
  @endif
@endif
