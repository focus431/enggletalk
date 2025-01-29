@extends('layout.mainlayout')
@section('content')
  <!-- Home Banner -->
  <section class="section section-search">
    <div class="overlay"></div>
    <div class="container">
      <div class="banner-wrapper m-auto text-center">
        <div class="banner-header">
          <h1>{{ __('platform_title') }}</h1>
          <p>{{ __('platform_description') }}</p>
        </div>
        <!-- Search -->
        <div class="search-box">
          <form action="search" role="search">
            <div class="form-group search-info">
              <input type="text" class="form-control" placeholder="{{ __('register_then_enter_promo_code') }}" aria-label="搜尋課程">
            </div>
          </form>
        </div>
        <!-- /Search -->
      </div>
    </div>
  </section>
  <!-- /Home Banner -->

  <section class="section how-it-works">
    <div class="container">
      <div class="section-header text-center">
        <span>{{ __('Online English Learning Process') }}</span>
        <h2>{{ __('How to Start Online One-on-One English Courses?') }}</h2>
        <p class="sub-title">{{ __('Start your online English learning journey through simple steps') }}</p>
      </div>
      <div class="row">
        <div class="col-12 col-md-6 col-lg-4">
          <div class="feature-box text-center">
            <div class="feature-header">
              <div class="feature-icon">
                <span class="circle"></span>
                <i><img src="assets/img/icon-1.png" alt="註冊線上英文課程第一步" loading="lazy"></i>
              </div>
              <div class="feature-cont">
                <div class="feature-text">{{ __('Sign up') }}</div>
              </div>
            </div>
            <p class="mb-0">{{ __('Are you looking to join online Learning') }}</p>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="feature-box text-center">
            <div class="feature-header">
              <div class="feature-icon">
                <span class="circle"></span>
                <i><img src="assets/img/icon-2.png" alt="選擇您的線上英文老師" loading="lazy"></i>
              </div>
              <div class="feature-cont">
                <div class="feature-text">{{ __('Choose a Teacher') }}</div>
              </div>
            </div>
            <p class="mb-0">{{ __('Select the foreign English teacher that suits you and start one-on-one online classes.') }}</p>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="feature-box text-center">
            <div class="feature-header">
              <div class="feature-icon">
                <span class="circle"></span>
                <i><img src="assets/img/icon-3.png" alt="開始一對一線上英文課程" loading="lazy"></i>
              </div>
              <div class="feature-cont">
                <div class="feature-text">{{ __('Start Learning') }}</div>
              </div>
            </div>
            <p class="mb-0">{{ __('Begin your online English learning journey today') }}</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="section popular-courses">
    <div class="container">
      <div class="section-header text-center">
        <span>{{ __('Mentoring Goals') }}</span>
        <h2>{{ __('Popular Mentors') }}</h2>
        <p class="sub-title">{{ __('Do you want to move on next step?') }}</p>
      </div>

      <!-- 123 -->
      <div class="my-awesome-slider">

        <!-- 重複上面的結構以添加更多卡片 -->

      </div>



    </div>
  </section>

  <!-- Path section start -->
  <!-- <section class="section path-section">
               <div class="section-header text-center">
                <div class="container">
                 <span>{{ __('Opt for') }}</span>
                 <h2>{{ __('a unique experience that steps away from traditional physical classrooms,') }}</h2>
                 <p class="sub-title">{{ __('offering you a rich and diverse online learning journey.') }}</p>
                </div>
               </div>
               <div class="learning-path-col">
                <div class="container">
                 <div class="row">
                  <div class="col-12 col-md-4 col-lg-3">
                   <div class="large-col">
                    <a href="search" class="large-col-image">
                     <div class="image-col-merge">
                      <img src="assets/img/path-img1.jpg" alt="">
                      <div class="text-col">
                       <h5>Senior Teacher</h5>
                      </div>
                     </div>
                    </a>
                   </div>
                  </div>
                  <div class="col-12 col-md-4 col-lg-3">
                   <div class="large-col">
                    <a href="search" class="large-col-image">
                     <div class="image-col-merge">
                      <img src="assets/img/path-img2.jpg" alt="">
                      <div class="text-col">
                       <h5>Ui designer</h5>
                      </div>
                     </div>
                    </a>
                   </div>
                  </div>
                  <div class="col-12 col-md-4 col-lg-3">
                   <div class="large-col">
                    <a href="search" class="large-col-image">
                     <div class="image-col-merge">
                      <img src="assets/img/path-img3.jpg" alt="">
                      <div class="text-col">
                       <h5>IT Security</h5>
                      </div>
                     </div>
                    </a>
                   </div>
                  </div>
                  <div class="col-12 col-md-4 col-lg-3">
                   <div class="large-col">
                    <a href="search" class="large-col-image">
                     <div class="image-col-merge">
                      <img src="assets/img/path-img4.jpg" alt="">
                      <div class="text-col">
                       <h5>Front-End Developer</h5>
                      </div>
                     </div>
                    </a>
                   </div>
                  </div>
                  <div class="col-12 col-md-4 col-lg-3">
                   <div class="large-col">
                    <a href="search" class="large-col-image">
                     <div class="image-col-merge">
                      <img src="assets/img/path-img5.jpg" alt="">
                      <div class="text-col">
                       <h5>Web Developer</h5>
                      </div>
                     </div>
                    </a>
                   </div>
                  </div>
                  <div class="col-12 col-md-4 col-lg-3">
                   <div class="large-col">
                    <a href="search" class="large-col-image">
                     <div class="image-col-merge">
                      <img src="assets/img/path-img6.jpg" alt="">
                      <div class="text-col">
                       <h5>Administrator</h5>
                      </div>
                     </div>
                    </a>
                   </div>
                  </div>
                  <div class="col-12 col-md-4 col-lg-3">
                   <div class="large-col">
                    <a href="search" class="large-col-image">
                     <div class="image-col-merge">
                      <img src="assets/img/path-img7.jpg" alt="">
                      <div class="text-col">
                       <h5>Project Manager</h5>
                      </div>
                     </div>
                    </a>
                   </div>
                  </div>
                  <div class="col-12 col-md-4 col-lg-3">
                   <div class="large-col">
                    <a href="search" class="large-col-image">
                     <div class="image-col-merge">
                      <img src="assets/img/path-img8.jpg" alt="">
                      <div class="text-col">
                       <h5>PHP Developer</h5>
                      </div>
                     </div>
                    </a>
                   </div>
                  </div>
                 </div>
                 <div class="view-all text-center"><a href="#" class="btn btn-primary">View All</a></div>
                </div>
               </div>
              </section> -->
  <!-- Path section end -->







  
  <!-- Blog Section -->
  {{-- <section class="section section-blogs">
    <div class="container">

      <!-- Section Header -->
      <div class="section-header text-center">
        <span>{{ __('slogan.twoWords') }}</span>
        <h2>{{ __('slogan.fifteenWords') }}</h2>
        <p class="sub-title">{{ __('slogan.tenWords') }}</p>
      </div>
      <!-- /Section Header -->
      <div class="row blog-grid-row">
        @foreach ($blogs as $blog)
          <div class="col-md-6 col-lg-3 col-sm-12">
            <!-- Blog Post -->
            <div class="blog grid-blog">
              <div class="blog-image">
                <a href="{{ route('blog-details', $blog->id) }}">
                  <img class="img-fluid" src="/storage/{{ $blog->image }}" alt="{{ $blog->name }}">
                </a>
              </div>
              <div class="blog-content">
                <h3 class="blog-title"><a href="{{ route('blog-details', $blog->id) }}">{{ $blog->name }}</a></h3>
                <p class="mb-0">{{ Str::limit($blog->description, 150) }}</p>
              </div>
            </div>
            <!-- /Blog Post -->
          </div>
        @endforeach
      </div>
    </div>
  </section> --}}
  <!-- /Blog Section -->











  <!-- Statistics Section -->
  <section class="new-course new-course-join">
    <div class="container">
      <div class="new-course-background">
        <div class="row">
          <div class="col-lg-7 col-md-6 d-flex align-items-center">
            <div class="every-new-course aos aos-init aos-animate" data-aos="fade-up">
              <div class="new-course-text">
                <h1>{{ __('Empower Your Future with English') }}</h1>
                <p class="page-sub-text ">{{ __('Mastering English unlocks endless opportunities.') }}</p>
              </div>

            </div>
          </div>
          <div class="col-lg-5 col-md-6 d-flex align-items-end">
            <div class="new-course-img aos aos-init aos-animate" data-aos="fade-up">
              <img src="assets/img/join-2.png" alt="new course">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /Statistics Section -->
@endsection
@section('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      fetchMentors();

      function fetchMentors() {
        fetch('/getMentors', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
          })
          .then(response => response.json())
          .then(data => {
            buildMentorsCarousel(data.mentors);
          })
          .catch(error => console.error('Error:', error));
      }
    });

    function buildMentorsCarousel(mentors) {
      const carouselContainer = document.querySelector('.my-awesome-slider');
      carouselContainer.innerHTML = ''; // 清空現有的 Carousel 內容

      mentors.forEach(mentor => {

        const mentorElement = document.createElement('div');
        mentorElement.classList.add('card');

        mentorElement.innerHTML = `
      <div class="card-header">
        <img src="/storage/${mentor.avatar_path}" alt="${mentor.first_name} ${mentor.last_name}" loading="lazy">
      </div>
     
      <div class="card-footer">
        <!-- 可以根據需要添加更多內容 -->
				<div class="product-content">
        <h3 class="title"><a href="profile/${mentor.id}">${mentor.last_name} ${mentor.first_name}</a></h3>
									<div class="author-info">
										<div class="author-name">
											Senior Teacher
										</div>
									</div>
									<div class="rating">							
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star"></i>
										<span class="d-inline-block average-rating">5.0</span>
									</div>
									<div class="author-country font-size">
										<p class="mb-0"><i class="fas fa-map-marker-alt"></i> ${mentor.city}, ${mentor.country}</p>
									</div>
								</div>
      </div>
    `;
        carouselContainer.appendChild(mentorElement);
      });




      $(document).ready(function() {
        $('.my-awesome-slider').slick({
          dots: true,
          infinite: true,
          speed: 300,
          slidesToShow: 4, // 在大屏幕上一次顯示 4 個項目
          slidesToScroll: 1,
          adaptiveHeight: true,
          autoplay: true,
          autoplaySpeed: 4000,
          responsive: [{
              breakpoint: 1024, // 在 1024px 以下的屏幕寬度
              settings: {
                slidesToShow: 3, // 顯示 3 個項目
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 600, // 在 600px 以下的屏幕寬度
              settings: {
                slidesToShow: 2, // 顯示 2 個項目
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 480, // 在 480px 以下的屏幕寬度
              settings: {
                slidesToShow: 1, // 顯示 1 個項目
                slidesToScroll: 1
              }
            }
            // 您可以根據需要添加更多的斷點
          ]
        });
      });


    }
  </script>
@endsection
