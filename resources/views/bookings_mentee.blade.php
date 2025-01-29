<?php $page = 'bookings-mentee'; ?>
@extends('layout.mainlayout')
@section('content')
  @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  @if (session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  @endif



  <!-- Breadcrumb -->
  <div class="breadcrumb-bar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-12 col-12">
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('My Classes') }}</li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title">{{ __('My Classes') }}</h2>
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
        <div class="col-md-5 col-lg-3 col-xl-3 theiaStickySidebar">
          <div class="profile-sidebar">
            @include('layout.partials.sidebar')
          </div>
        </div>
        <!-- /Sidebar -->

        <!-- Booking summary -->
        <div class="col-md-7 col-lg-9 col-xl-9">
          <h3 class="pb-3">{{ __('Booking Summary') }}</h3>

          <!-- Tabs navigation -->
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" id="upcoming-tab" data-toggle="tab" href="#upcoming"
                data-status="booked">{{ __('Upcoming') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="completed-tab" data-toggle="tab" href="#completed"
                data-status="Completed">{{ __('Completed') }}</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" id="absent-tab" data-toggle="tab" href="#absent"
                data-status="Absent">{{ __('Absent') }}</a>
            </li>
          </ul>

          <!-- Tabs content -->
          <div class="tab-content">

            <div class="tab-pane fade" id="upcoming">
              <!-- Your table for Upcoming will go here -->
            </div>
            <div class="tab-pane fade" id="completed">
              <!-- Your table for Completed will go here -->
            </div>
            <div class="tab-pane fade" id="canceled">
              <!-- Your table for Cancel will go here -->
            </div>
            <div class="tab-pane fade" id="absent">
              <!-- Your table for Absent will go here -->
            </div>
          </div>

          <!-- Existing Mentee List Tab -->
          <div class="tab-pane show active" id="mentee-list">
            <div class="card card-table">
              <div class="card-body">
                <div class="filter-section">
                  <input type="text" id="filterInput" placeholder="{{ __('輸入名字進行過濾') }}"
                    style="margin-bottom: 20px; padding: 5px;">
                </div>
                <div class="table-responsive">
                  <table class="table table-hover table-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-center">{{ __('Sort') }}</th>
                        <th>{{ __('Mentor Lists') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th class="text-center">{{ __('Timings') }}</th>
                        <th class="text-center">{{ __('Status') }}</th>
                        <th class="text-center">{{ __('Action') }}</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                  <div id="paginationDiv"></div>
                </div>
              </div>
            </div>
          </div>
          <!-- /Mentee List Tab -->
        </div>
        <!-- /Booking summary -->
      </div>
    </div>
  </div>
  <!-- /Page Content -->
@endsection

@section('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // 初始化：預設加載 'booked' 的數據
      fetchBookingsForMentee('booked');
      // 監聽選項卡變化
      handleTabFocus();
      // 添加表格排序功能
      addTableSorting();
      //搜尋欄位
      initializeFilter();
      // 初始化 Modal
      $('#reviewModal').modal();

      // 为两个模态框添加点击背景关闭功能
      $('#reviewModal, #reviewDetails').on('click', function(event) {
        if (event.target === this) {
          $(this).modal('hide');
        }
      });

      // 为两个模态框内的所有 “关闭” 按钮添加事件监听器
      $('.modal .close').on('click', function() {
        // 使用 closest 方法找到最近的模态框元素并关闭它
        $(this).closest('.modal').modal('hide');
      });

      // 如果有特定的关闭按钮（例如 ID 为 closeModalButton 的按钮），也可以为它们添加监听器
      $('.closeModalButton').on('click', function() {
        // 关闭按钮所在的模态框
        $(this).closest('.modal').modal('hide');
      });






      const stars = document.querySelectorAll('.rating .fa-star');
      stars.forEach(star => {
        star.addEventListener('click', function() {
          const rating = this.getAttribute('data-value');
          document.getElementById('ratingValue').value = rating;

          // 更新星星的顯示
          stars.forEach(s => {
            s.classList.remove('filled');
            if (s.getAttribute('data-value') <= rating) {
              s.classList.add('filled');
            }
          });
        });
      });



    });

    // 當前排序的列和方向
    let currentSortColumn = null;
    let currentSortDirection = 'asc';

    // 表格排序函數
    function sortTable(column, direction, tbody) {
      const rows = Array.from(tbody.querySelectorAll('tr'));
      const sortedRows = rows.sort((rowA, rowB) => {
        const cellA = rowA.querySelector(`td:nth-child(${column})`).textContent;
        const cellB = rowB.querySelector(`td:nth-child(${column})`).textContent;
        return cellA < cellB ? (direction === 'asc' ? -1 : 1) : (direction === 'asc' ? 1 : -1);
      });
      tbody.innerHTML = '';
      sortedRows.forEach((row, index) => {
        row.querySelector('td:first-child').textContent = index + 1;
        tbody.appendChild(row);
      });
    }







    // 將預定資料的生成進行封裝
    function generateBookingRows(data, tbody, currentPage) {
      const itemsPerPage = 10; // 或者您从服务器获取的实际数字
      const startingIndex = (currentPage - 1) * itemsPerPage;

      if (Array.isArray(data.classSchedules.data)) {
        data.classSchedules.data.forEach((schedule, index) => {
          const tr = document.createElement('tr');
          tr.setAttribute('data-id', schedule.id);

          // Serial Number
          const tdSerial = document.createElement('td');
          tdSerial.className = 'text-center';
          tdSerial.textContent = startingIndex + index + 1; // 这里加上了 startingIndex
          tr.appendChild(tdSerial);

          // Name
          const tdName = document.createElement('td');
          const h2 = document.createElement('h2');
          h2.className = 'table-avatar';
          const aName = document.createElement('a');
          aName.href = 'profile';
          const mentor = data.users.find(users => users.id === schedule.user_id);
          const fullName = mentor ? `${mentor.last_name} ${mentor.first_name}` : 'Unknown';
          aName.textContent = fullName;
          h2.appendChild(aName);
          tdName.appendChild(h2);
          tr.appendChild(tdName);

          // Date
          const tdDate = document.createElement('td');
          tdDate.textContent = schedule.schedule_date;
          tr.appendChild(tdDate);

          // Time
          const tdTime = document.createElement('td');
          tdTime.className = 'text-center';
          const timeSpan = document.createElement('span');
          timeSpan.className = 'pending';

          // 从UTC时间转换为本地时间
          const utcStartTime = new Date(`1970-01-01T${schedule.start_time}Z`);
          const utcEndTime = new Date(`1970-01-01T${schedule.end_time}Z`);
          // 使用Intl.DateTimeFormat格式化为本地时间
          const timeFormatOptions = {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false // 24小时制
          };
          const timeFormatter = new Intl.DateTimeFormat(undefined, timeFormatOptions);
          const localStartTime = timeFormatter.format(utcStartTime);
          const localEndTime = timeFormatter.format(utcEndTime);

          // 将本地时间添加到schedule对象中
          schedule.localStartTime = localStartTime;
          schedule.localEndTime = localEndTime;

          timeSpan.textContent = `${localStartTime} - ${localEndTime}`;
          tdTime.appendChild(timeSpan);
          tr.appendChild(tdTime);

          // Status
          const tdStatus = document.createElement('td');
          tdStatus.className = 'text-center';
          const selectStatus = document.createElement('select');
          selectStatus.className = 'form-control';

          // 根据当前选项卡调整状态选项
          let options;
          switch (currentStatus) {
            case 'Completed':
              options = ['Completed'];
              break;
            case 'Absent':
              options = ['Absent'];
              break;
            default:
              options = ['Select', 'Canceled'];
              break;
          }

          options.forEach(option => {
            const optElement = document.createElement('option');
            optElement.value = option;
            optElement.textContent = option;
            if (schedule.status === option) {
              optElement.selected = true;
            }
            selectStatus.appendChild(optElement);
          });

          // 在 "Canceled" 和 "Absent" 选项卡中禁用选择框
          if (currentStatus === 'Canceled' || currentStatus === 'Absent' || currentStatus === 'Completed') {
            selectStatus.disabled = true;
          }
          tdStatus.appendChild(selectStatus);
          tr.appendChild(tdStatus);

          // 创建表格的动作按钮
          const tdAction = document.createElement('td');
          tdAction.className = 'text-center';
          const actionBtn = document.createElement('a');
          actionBtn.className = 'btn btn-sm bg-info-light';

          // 判断 status，决定显示 Video Call 链接还是 Reviews
          if (schedule.status === 'booked') {
            actionBtn.innerHTML = '<i class="fas fa-video"></i> Video Call';

            // 获取 mentor 的 google_meet_code 并生成 video-call URL
            const googlemeetId = data.users.find(user => user.id === schedule.user_id);

            if (googlemeetId && mentor.google_meet_code) {
              // 生成 video-call 链接
              const roomId = mentor.google_meet_code;
              const videoCallUrl = `https://enggletalk.com.tw/video-call?roomId=${roomId}`;
              actionBtn.setAttribute('data-meeting-url', videoCallUrl);
            } else {
              console.error('No matching mentor found or google_meet_code is missing');
              actionBtn.setAttribute('data-meeting-url', ''); // 设置为空字符串或默认值
            }

            // 添加点击事件监听器
            actionBtn.addEventListener('click', function(e) {
              e.preventDefault();
              const meetingUrl = this.getAttribute('data-meeting-url');
              if (meetingUrl) {
                window.open(meetingUrl, '_blank');
              } else {
                console.error('No meeting URL found');
              }
            });
          } else {
            actionBtn.innerHTML = '<i class="fas fa-comments"></i>';
            actionBtn.addEventListener('click', function(e) {
              e.preventDefault();
              if (currentStatus === 'Completed') {
                document.getElementById('classScheduleId').value = schedule.id;
                document.getElementById('mentorId').value = schedule.user_id;
                document.getElementById('menteeId').value = schedule.mentee_id;
                $('#reviewModal').modal('show');
              }
            });
          }

          // 将按钮添加到表格的单元格中
          tdAction.appendChild(actionBtn);
          tr.appendChild(tdAction);


          tbody.appendChild(tr);
        });
      } else {
        console.error("data.classSchedules.data is not an array:", data.classSchedules.data);
      }
    }










    // 添加表格排序功能
    function addTableSorting() {
      document.querySelectorAll('th').forEach((headerCell, index) => {
        headerCell.addEventListener('click', () => {
          const tableElement = document.querySelector('table');
          const tbodyElement = tableElement.querySelector('tbody');
          const rows = Array.from(tbodyElement.querySelectorAll('tr'));
          const sortedRows = rows.sort((a, b) => {
            const aColText = a.querySelector(
                `td:nth-child(${index + 1})`).textContent
              .trim();
            const bColText = b.querySelector(
                `td:nth-child(${index + 1})`).textContent
              .trim();
            return aColText.localeCompare(bColText);
          });
          tbodyElement.innerHTML = '';
          sortedRows.forEach(row => {
            tbodyElement.appendChild(row);
          });
        });
      });
    }



    // 分頁功能
    function renderPagination(data) {
      const paginationDiv = document.createElement('div');
      paginationDiv.className = 'pagination';

      if (data.classSchedules.prev_page_url) {
        const prevLink = document.createElement('a');
        prevLink.href = '#';
        prevLink.innerHTML = '&laquo;';
        prevLink.addEventListener('click', (e) => {
          e.preventDefault(); // 阻止默認行為
          fetchBookingsForMentee(currentStatus, data.classSchedules.current_page - 1);
        });
        paginationDiv.appendChild(prevLink);
      }

      if (data.classSchedules.next_page_url) {
        const nextLink = document.createElement('a');
        nextLink.href = '#';
        nextLink.innerHTML = '&raquo;';
        nextLink.addEventListener('click', (e) => {
          e.preventDefault(); // 阻止默認行為
          fetchBookingsForMentee(currentStatus, data.classSchedules.current_page + 1);
        });
        paginationDiv.appendChild(nextLink);
      }

      document.getElementById('paginationDiv').innerHTML = '';
      document.getElementById('paginationDiv').appendChild(paginationDiv);
    }














    // 添加狀態更改的事件監聽器
    function addStatusChangeEventListener(selectStatus, tr, schedule) {
      if (!schedule) {
        console.error('schedule 是 undefined，不會添加事件監聽器');
        return; // 直接返回，避免後續代碼執行
      }

      selectStatus.addEventListener('change', async function() {
        let selectedStatus = this.value;
        // 如果選擇的是 "Select" 或者狀態沒有變化，则重置为 'Select' 并返回
        if (selectedStatus === 'Select' || selectedStatus === schedule.status) {
          this.value = 'Select';
          return;
        }

        // 如果状态更改为 "Canceled"，将状态更改为 "available"
        if (selectedStatus === 'Canceled') {
          selectedStatus = 'available';
        }

        // 如果狀態更改為 "Completed" 或者 "Canceled"，则显示确认对话框
        if (selectedStatus === 'Completed' || selectedStatus === 'available') {
          const isConfirmed = window.confirm(
            `{{ __('Are you sure you want to change the status to') }} ${selectedStatus === 'available' ? '{{ __('Canceled') }}' : '{{ __('Completed') }}'} {{ __('? This action cannot be undone.') }}`
          );

          if (!isConfirmed) {
            this.value = 'Select'; // 重置選擇
            return;
          }

          // 處理狀態更改
          await handleStatusChange(this, tr, schedule, selectedStatus);
        }

      });
    }



    async function updateBookingStatus(tr, schedule, newStatus) {
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const payload = {
        newStatus: newStatus,
        classScheduleId: schedule.id,
        menteeId: schedule.mentee_id,
        mentorId: schedule.user_id,
        scheduleDate: schedule.schedule_date,
        startTime: schedule.start_time,
        endTime: schedule.end_time,
        localstartTime: schedule.localStartTime,
        localendTime: schedule.localEndTime
      };

      console.log('Sending payload:', payload);

      try {
        const response = await fetch('/update-booking-status', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
          },
          body: JSON.stringify(payload)
        });

        if (!response) {
          throw new Error('No response received from the server.');
        }

        if (!response.ok) {
          const errorData = await response.json();
          console.error('Server responded with an error:', errorData);
          throw new Error('Failed to update booking status');
        }

        const responseData = await response.json();
        console.log('Server response:', responseData);
        return responseData; // 返回响应数据

      } catch (error) {
        console.error('Error during fetch:', error);
        throw error; // 抛出错误以便在调用者中处理
      }
    }

    async function handleStatusChange(selectElement, tr, schedule, newStatus) {
      try {
        const responseData = await updateBookingStatus(tr, schedule, newStatus);

        // alert('状态已成功更新');
        selectElement.disabled = true; // 禁用选择框
        location.reload();

      } catch (error) {
        console.error('Error:', error);
        alert('发生错误，无法更新状态');
        selectElement.value = schedule.status; // 重置选择
      }
    }








    // 當前狀態和頁數
    let currentStatus = 'booked';
    let currentPage = 1;

    // 異步獲取預定資料
    async function fetchBookingsForMentee(status = 'booked', page = 1) {
      try {
        currentStatus = status;
        currentPage = page;
        const response = await fetch(`/getBookingsForMentee?status=${status}&page=${page}`);
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        const data = await response.json();
        const tbody = document.querySelector('tbody');
        if (!tbody) {
          console.error('No tbody found');
          return;
        }
        tbody.innerHTML = '';
        generateBookingRows(data, tbody, currentPage);
        renderPagination(data);

        // 遍歷每一行，添加狀態更改事件監聽器
        tbody.querySelectorAll('tr').forEach(tr => {
          const selectStatus = tr.querySelector('select');
          if (selectStatus) {
            const schedule = data.classSchedules.data.find(schedule => schedule
              .id === parseInt(tr.getAttribute('data-id')));
            addStatusChangeEventListener(selectStatus, tr, schedule);
          }
        });

      } catch (error) {
        console.error('Error fetching or processing data:', error);
      }
    }









    // 處理選項卡焦點
    function handleTabFocus() {
      document.querySelectorAll('.nav-link').forEach(tab => {
        tab.addEventListener('click', (event) => {
          document.querySelectorAll('.nav-link').forEach(innerTab => {
            innerTab.classList.remove('active');
          });
          event.target.classList.add('active');
          const status = event.target.getAttribute('data-status');
          fetchBookingsForMentee(status);
        });
      });
    }
    // 初始化預設的 active tab
    const defaultActiveTab = document.querySelector('.nav-link.active');
    if (defaultActiveTab) {
      defaultActiveTab.style.backgroundColor = "#1e88e5";
      defaultActiveTab.style.color = "#FFF";
    }

    function handleTabFocus() {
      document.querySelectorAll('.nav-link').forEach(tab => {
        tab.addEventListener('click', (event) => {
          document.querySelectorAll('.nav-link').forEach(innerTab => {
            innerTab.classList.remove('active');
            innerTab.style.backgroundColor = ""; // 移除背景色
            innerTab.style.color = ""; // 移除字體顏色
          });
          event.target.classList.add('active');
          event.target.style.backgroundColor = "#1e88e5"; // 添加背景色
          event.target.style.color = "#FFF"; // 添加字體顏色
          const status = event.target.getAttribute('data-status');
          fetchBookingsForMentee(status);
        });
      });
    }






    // 初始化名單過濾功能
    function initializeFilter() {
      const filterInput = document.getElementById('filterInput');
      const tableBody = document.querySelector('tbody');
      filterInput.addEventListener('input', () => filterTable(filterInput, tableBody));
    }
    // 添加名單過濾功能
    function filterTable(inputElement, tbody) {
      const filterText = inputElement.value.toLowerCase();
      const rows = Array.from(tbody.querySelectorAll('tr'));
      rows.forEach(row => {
        const nameCell = row.querySelector('td:nth-child(2)'); // 假設名字在第二列
        if (nameCell) {
          const nameText = nameCell.textContent.toLowerCase();
          if (nameText.includes(filterText)) {
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        }
      });
    }
  </script>
@endsection
