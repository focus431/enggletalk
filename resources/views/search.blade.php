<?php $page = 'search'; ?>
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
              <li class="breadcrumb-item active" aria-current="page">{{ __('Search') }}</li>
            </ol>
          </nav>

          <h2 class="breadcrumb-title" id="breadcrumb-title"></h2>
        </div>
        <div class="col-md-4 col-12 d-md-block d-none">
          <div class="sort-by">
            <span class="sort-title">{{ __('Sort by') }}</span>
            <span class="sortby-fliter">
              <select class="select">
                <option>{{ __('Select') }}</option>
                <option class="sorting">{{ __('Rating') }}</option>
                <option class="sorting">{{ __('Popular') }}</option>
                <option class="sorting">{{ __('Latest') }}</option>
                <option class="sorting">{{ __('Free') }}</option>
              </select>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Breadcrumb -->

  <!-- Page Content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">
          <a href="dashboard_mentee">
            <i class="fas fa-long-arrow-alt-left"></i> <span>{{ __('Back') }}</span>
          </a>
          <!-- Search Filter -->
          <div class="card search-filter">
            <div class="card-header">
              <h4 class="card-title mb-0">{{ __('Search Filter') }}</h4>
            </div>
            <div class="card-body">
              <div class="filter-widget">
                <div class="cal-icon">
                  <input type="text" class="form-control datetimepicker" placeholder="{{ __('Select Date') }}"
                    name='date'>
                </div>
              </div>
              <div class="filter-widget">
                <input type="text" class="form-control" placeholder="{{ __('Search by Mentor Name') }}"
                  name="mentor_name">
              </div>
              <div class="filter-widget">
                <h4>{{ __('Gender') }}</h4>
                <div>
                  <label class="custom_check">
                    <input type="radio" name="gender_type" value="male">
                    <span class="checkmark"></span>{{ __('Male') }}
                  </label>
                </div>
                <div>
                  <label class="custom_check">
                    <input type="radio" name="gender_type" value="female">
                    <span class="checkmark"></span> {{ __('Female') }}
                  </label>
                </div>
              </div>
              <!-- 在 Blade 模板中的课程复选框区域 -->
              <div class="filter-widget" id="courseFilter" data-courses="{{ $courses->toJson() }}">
                <h4>{{ __('Select Courses') }}</h4>
                <!-- 课程复选框将在此处动态生成 -->
              </div>

              <div class="btn-search">
                <button type="button" class="btn btn-block w-100"> {{ __('Search') }} </button>
              </div>
            </div>
          </div>
          <!-- /Search Filter -->
        </div>
        <div class="col-md-12 col-lg-8 col-xl-9">
          <!-- 在這裡添加一個 mentorListContainer div -->
          <div id="mentorListContainer">
            <!-- 原本的 mentor 卡片會在這裡生成 -->
          </div>

          @if ($paginatedMentors->currentPage() > $paginatedMentors->lastPage())
            <!-- 显示当前页超过最后一页的提示或处理 -->
          @endif
          <div class="load-more text-center">
            {{ $paginatedMentors->links('pagination::bootstrap-4') }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="reviewDetails" tabindex="-1" role="dialog" aria-labelledby="reviewDetailsLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <!-- Modal 內容開始 -->
      <div class="modal-content">
        <!-- 這裡是 Modal 的主要內容 -->
        <div class="doc-review review-listing">
          <!-- Review Listing -->
          <ul class="comments-list">
            <!-- Comment List -->

            <!-- /Comment List -->
          </ul>
          <!-- /Review Listing -->
        </div>
      </div>
      <!-- Modal 內容結束 -->
    </div>
  </div>
  <!-- /Page Content -->
@endsection

@section('scripts')
  <script>
    // 定義基礎 URL
    var baseUrl = "{{ asset('storage/') }}";
    // 将后端传递的 $averageRatings 变量转换为 JavaScript 对象
    var averageRatings = @json($averageRatings);

    console.log(averageRatings);
    // 在DOM加载完毕后执行
    document.addEventListener("DOMContentLoaded", function() {

      initializeCourseFilter();
      fetchMentorsWithPage();
      addSearchButtonEventListener();
      document.querySelectorAll('.fav-btn').forEach(favBtn => {
        console.log(favBtn);
        favBtn.addEventListener('click', function() {
          toggleFavorite(this);
        });
      });

    });
    document.addEventListener('click', function(event) {
      if (event.target.closest('.fav-btn')) {
        console.log("Favorite button clicked");
        toggleFavorite(event.target.closest('.fav-btn'));
      }
    });

    function toggleFavorite(favBtn) {
      // 从父元素中获取 mentor 的 ID
      const mentorId = favBtn.closest('.profile-widget').getAttribute('data-mentor-id');

      console.log("Sending AJAX request with mentorId:", mentorId);

      // 发送 AJAX 请求到后端以切换收藏状态
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
          console.log("Received response:", data);

          if (data.success) {
            // 获取图标元素
            const favIcon = favBtn.querySelector('i');

            // 根据响应数据切换图标状态
            if (data.is_favorited) {
              favIcon.classList.remove('far'); // 空心书签
              favIcon.classList.add('fas'); // 实心书签
            } else {
              favIcon.classList.remove('fas'); // 实心书签
              favIcon.classList.add('far'); // 空心书签
            }
          }
        })
        .catch(error => console.error('Error:', error));
    }

    function initializeCourseFilter() {
      var courseFilter = document.getElementById("courseFilter");
      if (courseFilter) {
        var coursesData = courseFilter.getAttribute("data-courses");

        if (coursesData && coursesData !== 'null') {
          try {
            var courses = JSON.parse(coursesData);
            console.log("Parsed Courses:", courses);
            // 确保 courses 不为空并处理数据
            if (courses.length > 0) {
              populateCourseFilter(courses, courseFilter);
            } else {
              console.warn("{{ __('No courses available to populate.') }}");
            }
          } catch (e) {
            console.error("{{ __('Failed to parse courses JSON') }}:", e);
          }
        } else {
          console.warn("{{ __('No courses data found.') }}");
        }
      } else {
        console.warn("{{ __('Course filter element not found.') }}");
      }
    }

    function populateCourseFilter(courses, courseFilter) {
      courses.forEach(function(course) {
        var divElement = createCourseElement(course);
        // 將 div 添加到過濾器區域
        courseFilter.appendChild(divElement);
      });
    }

    function createCourseElement(course) {
      // 創建 div 元素
      var divElement = document.createElement("div");

      // 創建 label 元素並設置其屬性和內容
      var labelElement = document.createElement("label");
      labelElement.className = "custom_check";
      labelElement.appendChild(createInputElement(course));
      labelElement.appendChild(createSpanElement());
      labelElement.appendChild(document.createTextNode(" " + course.name));

      // 將 label 添加到 div
      divElement.appendChild(labelElement);

      return divElement;
    }

    function createInputElement(course) {
      // 創建 input 元素
      var inputElement = document.createElement("input");
      inputElement.type = "checkbox";
      inputElement.name = "select_specialist";
      inputElement.id = "course_" + course.id;
      inputElement.value = course.id;

      return inputElement;
    }

    function createSpanElement() {
      // 創建 span 元素
      var spanElement = document.createElement("span");
      spanElement.className = "checkmark";

      return spanElement;
    }

    function addSearchButtonEventListener() {
      document.querySelector('.btn-search').addEventListener('click', function() {
        fetchMentorsWithPage();
      });
    }

    function fetchMentorsWithPage(page = 1) {
      var filters = collectFilters();
      performFetch(filters, page);
    }

    function collectFilters() {
      var filters = {};
      var gender = getSelectedGender();
      var selectedCourses = getSelectedCourses();
      var date = getSelectedDate();
      var mentorName = getMentorName();

      if (gender) filters.gender = gender;
      if (selectedCourses.length > 0) filters.courses = selectedCourses;
      if (date) filters.date = date;
      if (mentorName) filters.name = mentorName;

      return filters;
    }

    function getSelectedGender() {
      var genderElement = document.querySelector('input[name="gender_type"]:checked');
      return genderElement ? genderElement.value : null;
    }

    function getSelectedCourses() {
      return Array.from(document.querySelectorAll('input[name="select_specialist"]:checked')).map(function(input) {
        return input.value;
      });
    }

    function getSelectedDate() {
      return document.querySelector('input[name="date"]').value;
    }

    function getMentorName() {
      return document.querySelector('input[name="mentor_name"]').value;
    }

    function performFetch(filters, page) {
      fetch('/getMentors', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
            ...filters,
            page: page
          })
        })
        .then(response => response.json())
        .then(data => populateMentors(data));
    }

    function populateMentors(data) {
      const mentors = data.mentors;
      const encryptedMentorIds = data.encryptedMentorIds;
      const pagination = data.pagination;

      const mentorListContainer = document.getElementById('mentorListContainer');
      mentorListContainer.innerHTML = '';

      let rowGrid; // 用於存放每一行的 mentors

      mentors.forEach((mentor, index) => {
        // 每三個 mentors 就新建一個 row
        if (index % 4 === 0) {
          rowGrid = document.createElement('div');
          rowGrid.className = 'row row-grid';
          mentorListContainer.appendChild(rowGrid);
        }

        const mentorCard = createMentorCard(mentor, encryptedMentorIds[index]);
        rowGrid.appendChild(mentorCard);
      });

      // 更新總匹配數
      document.getElementById('breadcrumb-title').innerText = `${pagination.total} {{ __('Matches found') }}`;

      // 添加分頁控件
      let paginationHtml = `<ul class="pagination">`;
      for (let i = 1; i <= pagination.last_page; i++) {
        paginationHtml +=
          `<li class="page-item ${i === pagination.current_page ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
      }
      paginationHtml += `</ul>`;
      document.querySelector('.load-more').innerHTML = paginationHtml;

      // 添加事件監聽器
      document.querySelectorAll('.page-link').forEach(item => {
        item.addEventListener('click', function(e) {
          e.preventDefault();
          fetchMentorsWithPage(parseInt(this.getAttribute('data-page')));
        });
      });
    }

    function truncateToDecimalPlace(num, decimalPlaces) {
      const factor = Math.pow(10, decimalPlaces);
      return Math.floor(num * factor) / factor;
    }

    function createMentorCard(mentor, encryptedMentorId) {
      const colDiv = document.createElement('div');
      colDiv.className = 'col-md-3 col-lg-3 col-xl-3';

      const profileWidget = document.createElement('div');
      profileWidget.className = 'profile-widget';
      profileWidget.setAttribute('data-mentor-id', mentor.id);

      const userAvatar = document.createElement('div');
      userAvatar.className = 'user-avatar';

      const avatarLink = document.createElement('a');
      avatarLink.href = `/profile/${mentor.id}`;

      const avatarImg = document.createElement('img');
      avatarImg.className = 'img-fluid';
      avatarImg.alt = '{{ __('User Image') }}';
      avatarImg.src = baseUrl + '/' + (mentor.avatar_path ? mentor.avatar_path : 'default-avatar.jpg');

      avatarLink.appendChild(avatarImg);

      const favBtn = document.createElement('a');
      favBtn.href = 'javascript:void(0)';
      favBtn.className = 'fav-btn';

      const favIcon = document.createElement('i');
      favIcon.className = 'fas fa-heart heart-icon';

      favBtn.appendChild(favIcon);

      userAvatar.appendChild(avatarLink);
      userAvatar.appendChild(favBtn);

      const proContent = document.createElement('div');
      proContent.className = 'pro-content';

      const h3 = document.createElement('h3');
      h3.className = 'title';

      const aProfile = document.createElement('a');
      aProfile.href = `/profile/${mentor.id}`;
      aProfile.textContent = mentor.last_name + mentor.first_name;

      const iVerified = document.createElement('i');
      iVerified.className = 'fas fa-solid fa-user';
      iVerified.style.paddingLeft = '10px';
      if (mentor.gender === 'Male') {
        iVerified.style.color = 'dodgerblue';
      } else if (mentor.gender === 'Female') {
        iVerified.style.color = 'lightcoral';
      }

      h3.appendChild(aProfile);
      h3.appendChild(iVerified);

      const pSpeciality = document.createElement('p');
      pSpeciality.className = 'speciality';
      pSpeciality.textContent = mentor.speciality ? mentor.speciality : '{{ __('No speciality provided') }}';

      const ratingDiv = document.createElement('div');
      ratingDiv.className = 'rating';

      var mentorAverageRating = averageRatings[mentor.id];
      if (typeof mentorAverageRating !== 'number') {
        mentorAverageRating = 5;
      }

      for (let i = 0; i < 5; i++) {
        let star = document.createElement('i');
        if (i < Math.floor(mentorAverageRating)) {
          star.className = 'fas fa-star filled';
        } else if (i < mentorAverageRating) {
          star.className = 'fas fa-star-half-alt filled';
        } else {
          star.className = 'fas fa-star';
        }
        ratingDiv.appendChild(star);
      }

      const averageRating = document.createElement('span');
      averageRating.className = 'd-inline-block average-rating';
      averageRating.textContent = '(' + truncateToDecimalPlace(mentorAverageRating, 1) + ')';
      ratingDiv.appendChild(averageRating);

      const availableInfo = document.createElement('ul');
      availableInfo.className = 'available-info';

      const li1 = document.createElement('li');
      const i1 = document.createElement('i');
      i1.className = 'fas fa-map-marker-alt';
      li1.appendChild(i1);
      li1.appendChild(document.createTextNode(` ${mentor.city}, ${mentor.country}`));
      availableInfo.appendChild(li1);

      const li3 = document.createElement('li');
      const i3 = document.createElement('i');
      i3.className = 'fas fa-comment-dots';
      li3.appendChild(i3);
      var reviewTextNode = document.createTextNode(' {{ __('Reviews') }}');
      li3.appendChild(reviewTextNode);

      li3.addEventListener('click', function() {
        fetch('/bookings_mentee/reviews/' + mentor.id)
          .then(response => response.json())
          .then(reviews => {
            const commentsList = document.querySelector('#reviewDetails .comments-list');
            if (commentsList) {
              commentsList.innerHTML = '';
              reviews.forEach(review => {
                const localDateTime = new Date(review.created_at).toLocaleString('default', {
                  hour12: false,
                  year: 'numeric',
                  month: '2-digit',
                  day: '2-digit',
                  hour: '2-digit',
                  minute: '2-digit',
                });
                commentsList.innerHTML += `
          <li>
            <div class="comment">
              <img class="avatar rounded-circle" alt="{{ __('User Image') }}" src="${review.userImageUrl || 'assets/img/user/user.jpg'}">
              <div class="comment-body">
                <div class="meta-data">
                  <span class="comment-author">${mentor.first_name || '{{ __('Unknown Author') }}'}</span>
                  <span class="comment-date">${localDateTime || '{{ __('Unknown Date') }}'}</span>
                  <div class="review-count rating">
                    ${generateRatingStars(review.rating)}
                  </div>
                </div>
                <p class="recommended"><i class="far fa-thumbs-up"></i> {{ __('I recommend the') }} ${review.subject || '{{ __('this') }}'}</p>
                <p class="comment-content">${review.comment || '{{ __('No comment provided') }}'}</p>
                <div class="comment-reply">
                  <p class="recommend-btn">
                    <span>{{ __('Recommend?') }}</span>
                    <a href="#" class="like-btn">
                      <i class="far fa-thumbs-up"></i> {{ __('Yes') }}
                    </a>
                    <a href="#" class="dislike-btn">
                      <i class="far fa-thumbs-down"></i> {{ __('No') }}
                    </a>
                  </p>
                </div>
              </div>
            </div>
          </li>`;
              });
              $('#reviewDetails').modal('show');
            } else {
              console.error('{{ __('Comments list not found') }}');
            }
          })
          .catch(error => console.error('{{ __('Error') }}:', error));

        function generateRatingStars(rating) {
          let stars = '';
          for (let i = 0; i < 5; i++) {
            stars += i < rating ? '<i class="fas fa-star filled"></i>' : '<i class="fas fa-star"></i>';
          }
          return stars;
        }
      });

      const iInfo = document.createElement('i');
      iInfo.setAttribute('data-bs-toggle', 'tooltip');
      iInfo.setAttribute('title', '{{ __('Lorem Ipsum') }}');
      li3.appendChild(iInfo);
      availableInfo.appendChild(li3);

      const rowSm = document.createElement('div');
      rowSm.className = 'row row-sm';

      const col6a = document.createElement('div');
      col6a.className = 'col-6';

      const viewProfileBtn = document.createElement('a');
      viewProfileBtn.href = `/profile/${mentor.id}`;
      viewProfileBtn.className = 'btn view-btn';
      viewProfileBtn.textContent = '{{ __('View Profile') }}';

      col6a.appendChild(viewProfileBtn);

      const col6b = document.createElement('div');
      col6b.className = 'col-6';

      const bookNowBtn = document.createElement('a');
      bookNowBtn.href = `/booking/${encryptedMentorId}`;
      bookNowBtn.className = 'btn book-btn';
      bookNowBtn.textContent = '{{ __('Book Now') }}';

      col6b.appendChild(bookNowBtn);

      rowSm.appendChild(col6a);
      rowSm.appendChild(col6b);

      proContent.appendChild(h3);
      proContent.appendChild(pSpeciality);
      proContent.appendChild(ratingDiv);
      proContent.appendChild(availableInfo);
      proContent.appendChild(rowSm);

      profileWidget.appendChild(userAvatar);
      profileWidget.appendChild(proContent);

      colDiv.appendChild(profileWidget);

      return colDiv;
    }
  </script>
@endsection
