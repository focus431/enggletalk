<?php $page = 'bookings-mentee'; ?>
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
        <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
          <div class="profile-sidebar">
            @include('layout.partials.sidebar')
          </div>
        </div>
        <!-- /Sidebar -->

        <!-- Booking summary -->
        <div class="col-md-7 col-lg-8 col-xl-9">
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
            {{-- <li class="nav-item">
              <a class="nav-link" id="cancel-tab" data-toggle="tab" href="#canceled"
                data-status="Canceled">{{ __('Cancellation') }}</a>
            </li> --}}
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
                  <input type="text" id="filterInput" placeholder="{{ __('Filter') }}"
                    style="margin-bottom: 20px; padding: 5px;">
                </div>
                <div class="table-responsive">
                  <table class="table table-hover table-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-center">{{ __('No.') }}</th>
                        <th>{{ __('Mentee Lists') }}</th>
                        <th>{{ __('Scheduled Date') }}</th>
                        <th class="text-center">{{ __('Scheduled Timings') }}</th>
                        <th class="text-center">{{ __('Status') }}</th>
                        <th class="text-center">{{ __('Action') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- 這裡可以使用傳遞過來的 google_meet_code -->
                      @isset($google_meet_code)
                        <!-- 使用 $google_meet_code -->
                      @endisset
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
      // 搜尋欄位
      initializeFilter();
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
      const itemsPerPage = 10; // 每页显示的项目数
      const startingIndex = (currentPage - 1) * itemsPerPage;

      if (Array.isArray(data.classSchedules.data)) {
        data.classSchedules.data.forEach((schedule, index) => {
          const tr = document.createElement('tr');
          tr.setAttribute('data-id', schedule.id);

          // Serial Number
          const tdSerial = document.createElement('td');
          tdSerial.className = 'text-center';
          tdSerial.textContent = startingIndex + index + 1;
          tr.appendChild(tdSerial);

          // Name
          const tdName = document.createElement('td');
          const h2 = document.createElement('h2');
          h2.className = 'table-avatar';
          const aName = document.createElement('a');
          aName.href = 'profile';
          const mentee = data.users.find(user => user.id === schedule.mentee_id);
          const fullName = mentee ? `${mentee.last_name} ${mentee.first_name}` : 'Unknown';
          aName.textContent = fullName;
          h2.appendChild(aName);
          tdName.appendChild(h2);
          tr.appendChild(tdName);

          // Date
          const tdDate = document.createElement('td');
          tdDate.textContent = schedule.schedule_date;
          tr.appendChild(tdDate);

          // Time - Convert from UTC to Local Time
          const tdTime = document.createElement('td');
          tdTime.className = 'text-center';
          const timeSpan = document.createElement('span');
          timeSpan.className = 'pending';

          // 获取用户的时区
          const userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

          // Convert start_time and end_time to local time
          const startTimeUTC = new Date(`${schedule.schedule_date}T${schedule.start_time}Z`);
          const endTimeUTC = new Date(`${schedule.schedule_date}T${schedule.end_time}Z`);
          const startTimeLocal = new Intl.DateTimeFormat('default', {
            hour: '2-digit',
            minute: '2-digit',
            hourCycle: 'h23',
            timeZone: userTimezone
          }).format(startTimeUTC);
          const endTimeLocal = new Intl.DateTimeFormat('default', {
            hour: '2-digit',
            minute: '2-digit',
            hourCycle: 'h23',
            timeZone: userTimezone
          }).format(endTimeUTC);




          //Time 
          timeSpan.textContent = `${startTimeLocal} - ${endTimeLocal}`;
          tdTime.appendChild(timeSpan);
          tr.appendChild(tdTime);



          // Status
          const tdStatus = document.createElement('td');
          tdStatus.className = 'text-center';
          const selectStatus = document.createElement('select'); // 声明并初始化 selectStatus 变量

          let options;
          switch (currentStatus) {
            case 'Completed':
              options = ['Completed'];
              break;
            case 'Absent':
              options = ['Absent'];
              break;
            default:
              options = ['Select', 'Completed', 'Canceled', 'Absent'];
              break;
          }

          options.forEach(option => {
            const optElement = document.createElement('option');
            optElement.value = option;
            optElement.textContent = option;
            if (schedule.status === option) {
              optElement.selected = true;
              if (currentStatus === 'Canceled' || currentStatus === 'Absent') {
                selectStatus.disabled = true;
              }
            }
            selectStatus.appendChild(optElement);
          });
          tdStatus.appendChild(selectStatus);
          tr.appendChild(tdStatus);

          // 添加事件监听器来处理状态变更
          addStatusChangeEventListener(selectStatus, tr, schedule, startTimeLocal, endTimeLocal);



          // Google Meet link
          const tdAction = document.createElement('td');
          tdAction.className = 'text-center';
          const actionBtn = document.createElement('a');
          actionBtn.className = 'btn btn-sm bg-info-light';
          actionBtn.innerHTML = '<i class="fas fa-video"></i> Video Call';

          // 假设 data.user.google_meet_code 是 roomId
          const googleMeetCode = data.user.google_meet_code;

          if (data.user.role === 'mentor' && googleMeetCode) {
            // 使用 roomId 生成 video-call 链接
            const videoCallUrl = `{{ route('video.call') }}?roomId=${googleMeetCode}`;
            actionBtn.setAttribute('data-meeting-url', videoCallUrl);
          } else {
            console.error('No matching mentor found or google_meet_code is missing');
            actionBtn.setAttribute('data-meeting-url', '');
          }

          if (schedule.status !== 'booked') {
            actionBtn.addEventListener('click', function(e) {
              e.preventDefault();
              alert('此連結在當前狀態下不可用。');
            });
          } else {
            actionBtn.addEventListener('click', function(e) {
              e.preventDefault();
              const meetingUrl = this.getAttribute('data-meeting-url');
              if (meetingUrl) {
                window.open(meetingUrl, '_blank');
              } else {
                console.error('No meeting URL found');
              }
            });
          }

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
            const aColText = a.querySelector(`td:nth-child(${index + 1})`).textContent.trim();
            const bColText = b.querySelector(`td:nth-child(${index + 1})`).textContent.trim();
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
      // 創建一個 div 元素來包含分頁控制項
      const paginationDiv = document.createElement('div');
      paginationDiv.className = 'pagination';

      // 檢查是否有上一頁的 URL，如果有，則添加「上一頁」的連結
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

      // 檢查是否有下一頁的 URL，如果有，則添加「下一頁」的連結
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

      // 清空先前的分頁控制項，然後添加新的分頁控制項
      document.getElementById('paginationDiv').innerHTML = '';
      document.getElementById('paginationDiv').appendChild(paginationDiv);
    }

    // 添加狀態更改的事件監聽器
    // 添加狀態更改的事件監聽器
    function addStatusChangeEventListener(selectStatus, tr, schedule, startTimeLocal, endTimeLocal) {
      // 添加這個檢查
      if (!schedule) {
        console.error('schedule 是 undefined，不會添加事件監聽器');
        return; // 直接返回，避免後續代碼執行
      }
      selectStatus.addEventListener('change', async function() {
        let selectedStatus = this.value;

        // 使用多語系的確認訊息
        const confirmMessage = @json(__('messages.confirm_status_change'));

        // 彈出確認訊息
        const isConfirmed = confirm(confirmMessage);
        if (!isConfirmed) {
          // 如果用戶取消，將選項重置為原始狀態
          this.value = schedule.status;
          return;
        }

        // 如果用户选择了 "Canceled"，则将实际传递的值设置为 "available"
        if (selectedStatus === 'Canceled') {
          selectedStatus = 'available';
        }

        const classScheduleId = tr.getAttribute('data-id');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const payload = {
          newStatus: selectedStatus,
          classScheduleId: schedule.id,
          menteeId: schedule.mentee_id,
          mentorId: schedule.user_id,
          scheduleDate: schedule.schedule_date,
          startTime: schedule.start_time,
          endTime: schedule.end_time,
          localstartTime: startTimeLocal,
          localendTime: endTimeLocal,
        };

        try {
          const updateResponse = await fetch('/update-booking-status', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify(payload)
          });
          if (updateResponse.ok) {
            const responseData = await updateResponse.json();
            console.log('Success:', responseData);
            alert('狀態已成功更新'); // 顯示提示訊息
            location.reload(); // 在提示框关闭后重整网页
          } else {
            console.error('Failed to update status. HTTP status:', updateResponse.status);
          }

        } catch (error) {
          console.error('Error:', error);
        }
      });
    }

    // 當前狀態和頁數
    let currentStatus = 'booked';
    let currentPage = 1;

    // 異步獲取預定資料
    async function fetchBookingsForMentee(status = 'booked', page = 1) {
      try {
        currentStatus = status;
        currentPage = page;
        const response = await fetch(`/getBookingsForMentor?status=${status}&page=${page}`);
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
            // 注意這裡更改了 data.classSchedules 為 data.classSchedules.data
            const schedule = data.classSchedules.data.find(schedule => schedule.id === parseInt(tr.getAttribute(
              'data-id')));
            // addStatusChangeEventListener(selectStatus, tr, schedule);
          }
        });
      } catch (error) {
        console.error('Error fetching or processing data:', error);
      }
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
