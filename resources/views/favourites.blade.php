<?php $page = 'favourites'; ?>
@extends('layout.mainlayout')
@section('content')
  <!-- Breadcrumb -->
  <div class="breadcrumb-bar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-8 col-12">
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index">{{ __('Home') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('Favourites') }}</li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title">{{ __('Favourites') }}</h2>
        </div>
        <div class="col-md-4 col-12">
          <form class="search-form custom-search-form">
            <div class="input-group">
              <input type="text" placeholder="{{ __('Search Favourites...') }}" class="form-control">
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
          </form>
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
          <div class="row row-grid">
            @foreach ($favorites as $favorite)
              <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="profile-widget" data-mentor-id="{{ $favorite->mentor->id }}">
                  <div class="user-avatar">
                    <a href="/profile/{{ $favorite->mentor->id }}">
                      <img class="img-fluid" alt="{{ __('User Image') }}"
                        src="{{ $favorite->mentor->avatar_path ? asset('storage/' . $favorite->mentor->avatar_path) : asset('assets/img/user/default-avatar.jpg') }}">
                    </a>
                    <a href="javascript:void(0)" class="fav-btn">
                      <i class="fas fa-heart heart-icon"></i> <!-- 爱心图标 -->
                    </a>
                  </div>
                  <div class="pro-content">
                    <h3 class="title">
                      <a href="/profile/{{ $favorite->mentor->id }}">{{ $favorite->mentor->first_name }}
                        {{ $favorite->mentor->last_name }}</a>
                      <i class="fas fa-check-circle verified"></i>
                    </h3>
                    <p class="speciality">{{ $favorite->mentor->speciality }}</p>
                    <div class="rating">
                      @for ($i = 0; $i < 5; $i++)
                        @if ($i < floor($favorite->mentor->average_rating))
                          <i class="fas fa-star filled"></i>
                        @else
                          <i class="fas fa-star"></i>
                        @endif
                      @endfor
                      <span class="d-inline-block average-rating">({{ $favorite->mentor->average_rating }})</span>
                      <span class="d-inline-block">{{ $favorite->mentor->reviews_count }} </span>
                    </div>
                    <ul class="available-info">
                      <li>
                        <i class="fas fa-map-marker-alt"></i> {{ $favorite->mentor->city }},
                        {{ $favorite->mentor->country }}
                      </li>
                      {{-- <li>
                        <i class="far fa-clock"></i> {{ __('Available on') }}
                        {{ $favorite->mentor->next_available_date }}
                      </li>
                      <li>
                        <i class="far fa-money-bill-alt"></i> ${{ $favorite->mentor->min_fee }} -
                        ${{ $favorite->mentor->max_fee }}
                        <i class="fas fa-info-circle" data-toggle="tooltip" title="{{ __('Fee range') }}"></i>
                      </li> --}}
                    </ul>
                    <div class="row row-sm">
                      <div class="col-6">
                        <a href="/profile/{{ $favorite->mentor->id }}" class="btn view-btn">{{ __('View Profile') }}</a>
                      </div>
                      <div class="col-6">
                        <a href="/booking/{{ $favorite->encryptedMentorId }}"
                          class="btn book-btn">{{ __('Book Now') }}</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>

          @if ($favorites->isEmpty())
            <p>{{ __('No favourites found.') }}</p>
          @endif

          <!-- Pagination Links -->
          <div class="blog-pagination mt-4">
            {{ $favorites->links('pagination::bootstrap-4') }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Page Content -->
@endsection

@section('scripts')
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      document.querySelectorAll('.fav-btn').forEach(favBtn => {
        favBtn.addEventListener('click', function() {
          toggleFavorite(this);
        });
      });
    });

    function toggleFavorite(favBtn) {
      const mentorId = favBtn.closest('.profile-widget').getAttribute('data-mentor-id');

      console.log("{{ __('Sending AJAX request with mentorId:') }}", mentorId);

      fetch('/toggle-favorite', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
            mentor_id: mentorId
          })
        })
        .then(response => response.json())
        .then(data => {
          console.log("{{ __('Received response:') }}", data);

          if (data.success) {
            const favIcon = favBtn.querySelector('i');

            if (data.is_favorited) {
              favIcon.classList.remove('far'); // 空心爱心
              favIcon.classList.add('fas'); // 实心爱心
            } else {
              favIcon.classList.remove('fas'); // 实心爱心
              favIcon.classList.add('far'); // 空心爱心
            }
          }
        })
        .catch(error => console.error('Error:', error));
    }
  </script>
@endsection
