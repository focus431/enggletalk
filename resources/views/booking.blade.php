@extends('layout.mainlayout')
@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/index">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Booking</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Booking</h2>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="booking-user-info">
                            <a href="profile" class="booking-user-img">
                                <img src="{{ asset('storage/' . $mentor->avatar_path ?? 'default-avatar.jpg') }}" width="145" alt="User Image">
                            </a>
                            <div class="booking-info">
                                <h4><a href="#">{{ $mentor->last_name }} {{ $mentor->first_name }}</a></h4>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star"></i>
                                <!-- <span class="d-inline-block average-rating">35</span> -->
                            </div>
                            <p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i>{{ $mentor->city }} City</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <a href="/bookings_mentee">
                    <i class="fas fa-long-arrow-alt-left"></i> <span>Back</span>
                </a>
            </div>
            <div id="notification" class="alert" style="display: none;"></div>

            <!-- Schedule Widget -->
            <div class="card booking-schedule schedule-widget">
                <!-- Schedule Header -->
                <div class="schedule-header">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Day Slot -->
                            <div class="day-slot">
                                <div class="row">
                                    <!--顯示今天的日期跟週幾-->
                                    <div class="col-12 col-sm-4 col-md-6">
                                        <h4 class="mb-1" id="current-date"></h4>
                                        <p class="text-muted" id="current-day"></p>
                                    </div>
                                    <div class="col-12 col-sm-8 col-md-6 text-sm-end">
                                        <div class="bookingrange btn btn-white btn-sm mb-3">
                                            <i class="far fa-calendar-alt me-2"></i>
                                            <span></span>
                                            <i class="fas fa-chevron-down ml-2"></i>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1 d-flex justify-content-start">
                                            <!-- 左箭头 -->
                                            <div class="arrow-buttons">
                                                <button id="prevWeek" class="btn custom-btn">←</button>
                                            </div>
                                        </div>
                                        <div class="col-md-1 d-flex justify-content-end">
                                            <!-- 右箭头 -->
                                            <div class="arrow-buttons">
                                                <button id="nextWeek" class="btn custom-btn">→</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Schedule Widget -->
                                <div class="card booking-schedule schedule-widget">
                                    <!-- Schedule Header -->
                                    <div class="schedule-header">
                                        <div class="row align-items-center">
                                            <div class="col-md-12">
                                                <!-- Day Slot -->
                                                <div class="day-slot">
                                                    <ul id="day-list">
                                                        <!-- Your list items here -->
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Day Slot -->
                        </div>
                    </div>
                    <!-- Time Slot -->
                    <div class="timing-container">
                        <div class="time-slot">
                            <ul id="time-list" class="clearfix no-bullets">
                                <!-- 這裡會動態生成時間區段 -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Schedule Widget -->
        </div>
    </div>
</div>
<!-- /Page Content -->
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const timeListElement = document.querySelector("#time-list");
    const dayListElement = document.querySelector("#day-list");
    const mentorId = "{{ $mentor->id }}";
    const loggedInUserId = "{{ $user->id }}";
    const userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    let currentStartDate = new Date();

    // 添加鎖定機制
    let isProcessing = false;
    const processingTimeslots = new Set();

    // 添加樣式
    const style = document.createElement('style');
    style.textContent = `
        .timing.processing {
            pointer-events: none;
            opacity: 0.7;
            cursor: not-allowed;
            position: relative;
        }
        .timing.processing::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    `;
    document.head.appendChild(style);

    checkRemainingClasses(loggedInUserId).then(remainingClasses => {
        if (remainingClasses <= 0) {
            showNotification('您的剩餘堂數不足，請先購買', 'alert-warning');
        }
        fetchClassSchedule(mentorId, userTimezone, remainingClasses);
    });

    function checkRemainingClasses(userId) {
        return fetch(`/check-remaining-classes`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ userId: userId })
        })
        .then(response => response.json())
        .then(data => data.remaining_classes ?? 0)
        .catch(error => {
            console.error('Error fetching remaining classes:', error);
            return 0;
        });
    }

    function fetchClassSchedule(mentorId, timezone, remainingClasses) {
        fetch(`/get-class-schedule/${mentorId}?timezone=${timezone}`)
            .then(response => response.json())
            .then(data => updateWeekDays(currentStartDate, data, remainingClasses))
            .catch(error => console.error('Error fetching class schedule:', error));
    }

    function updateWeekDays(startDate, fetchedData, remainingClasses) {
        timeListElement.innerHTML = '';
        dayListElement.innerHTML = '';

        const dates = Array.from({ length: 7 }, (_, i) => {
            const date = new Date(startDate);
            date.setDate(date.getDate() + i);
            return date;
        });

        dates.forEach(date => {
            const liElement = document.createElement("li");
            liElement.className = 'day-timing';
            liElement.dataset.date = date.toDateString();
            updateTimings(date, liElement, fetchedData, remainingClasses);
            timeListElement.appendChild(liElement);

            const liDayElement = document.createElement("li");
            liDayElement.innerHTML = `
                <span>${date.toLocaleDateString('en-US', { weekday: 'short' })}</span>
                <span>${date.getMonth() + 1}月${date.getDate()}</span>
            `;
            dayListElement.appendChild(liDayElement);
        });
    }

    function updateTimings(date, liElement, fetchedData, remainingClasses) {
        for (let hour = 8; hour < 24; hour++) {
            // 只生成每小時開始的一個時段
            [0].forEach(minute => {
                const element = createTimingElement(hour, minute, (minute + 50) % 60, fetchedData, date, new Date(), remainingClasses);
                liElement.appendChild(element);
            });
        }
    }

    function createTimingElement(hour, startMinute, endMinute, fetchedData, currentDate, currentTime, remainingClasses) {
        const aElement = document.createElement("a");
        aElement.classList.add("timing");

        const timeStart = `${String(hour).padStart(2, '0')}:${String(startMinute).padStart(2, '0')}`;
        const endHour = startMinute + 50 >= 60 ? hour + 1 : hour;
        const timeEnd = `${String(endHour).padStart(2, '0')}:${String(endMinute).padStart(2, '0')}`;

        const formattedCurrentDate = currentDate.toISOString().split('T')[0];
        const scheduleDate = new Date(`${formattedCurrentDate}T${timeStart}`);

        // 檢查是否為過去的時間
        const now = new Date();
        
        // 如果是過去的日期時間，則禁用
        if (scheduleDate < now) {
            aElement.classList.add('disabled');
            aElement.style.pointerEvents = 'none';
            aElement.style.backgroundColor = '#e9ecef';
            aElement.style.cursor = 'not-allowed';
            aElement.title = '此時段已過期';
        } else {
            const matchedItem = fetchedData.find(item => 
                item.schedule_date === formattedCurrentDate &&
                item.start_time.substring(0, 5) === timeStart &&
                item.end_time.substring(0, 5) === timeEnd
            );

            if (matchedItem) {
                if (matchedItem.status === 'available') {
                    aElement.classList.add('selected');
                } else if (matchedItem.status === 'booked') {
                    aElement.classList.add('booked');
                    if (matchedItem.mentee_id == loggedInUserId) {
                        aElement.classList.add('my-booking');
                    } else {
                        aElement.classList.add('others-booking');
                        aElement.title = "此时段已被其他学生预订";
                    }
                }

                if (matchedItem.status === 'available' || (matchedItem.status === 'booked' && matchedItem.mentee_id == loggedInUserId)) {
                    aElement.addEventListener('click', () => toggleBookingStatus(aElement, matchedItem, remainingClasses));
                } else {
                    aElement.classList.add('disabled');
                }
            } else {
                aElement.classList.add('disabled');
            }
        }

        aElement.innerHTML = `<span>${timeStart} - ${timeEnd}</span>`;
        return aElement;
    }

    // 添加一個函數來定期檢查和更新時間狀態
    function updateTimeSlotStatus() {
        const now = new Date();

        document.querySelectorAll('.day-timing').forEach(dayElement => {
            const date = new Date(dayElement.getAttribute('data-date'));

            dayElement.querySelectorAll('.timing').forEach(timing => {
                const timeText = timing.querySelector('span').textContent;
                const [startTime] = timeText.split(' - ');
                const [hour, minute] = startTime.split(':').map(Number);
                
                // 創建完整的日期時間對象
                const scheduleDate = new Date(date);
                scheduleDate.setHours(hour, minute, 0, 0);

                if (scheduleDate < now) {
                    timing.classList.add('disabled');
                    timing.style.pointerEvents = 'none';
                    timing.style.backgroundColor = '#e9ecef';
                    timing.style.cursor = 'not-allowed';
                    timing.title = '此時段已過期';
                }
            });
        });
    }

    // 每分鐘更新時間狀態
    setInterval(updateTimeSlotStatus, 60000);

    // 初始化時立即執行一次
    document.addEventListener('DOMContentLoaded', function() {
        updateTimeSlotStatus();
    });

    // 修改 toggleBookingStatus 函數
    async function toggleBookingStatus(element, matchedItem, remainingClasses) {
        // 檢查是否為過期時段
        const timeText = element.querySelector('span').textContent;
        const [startTime] = timeText.split(' - ');
        const [hour, minute] = startTime.split(':').map(Number);
        
        const now = new Date();
        const scheduleDate = new Date(matchedItem.schedule_date);
        
        // 設定預約時段的完整日期時間
        scheduleDate.setHours(hour, minute, 0, 0);
        
        // 如果是過去的日期時間，則不允許預約
        if (scheduleDate < now) {
            showNotification('無法選擇已過期的時段', 'alert-warning');
            return;
        }

        if (isProcessing || processingTimeslots.has(matchedItem.id)) {
            return;
        }

        if (loggedInUserId === mentorId) {
            showNotification("您不能預約自己的時段。", "alert-warning");
            return;
        }

        // 根據當前狀態決定新狀態
        let newStatus;
        if (matchedItem.status === 'available') {
            newStatus = 'booked';
            if (remainingClasses <= 0) {
                showNotification('您的剩餘堂數不足，請先購買課程。', 'alert-warning');
                return;
            }
        } else if (matchedItem.status === 'booked' && matchedItem.mentee_id == loggedInUserId) {
            newStatus = 'available';
        } else {
            showNotification('無法更改此時段狀態。', 'alert-warning');
            return;
        }

        // 立即更新 UI
        const originalClasses = element.className;
        const originalStatus = matchedItem.status;
        const originalMenteeId = matchedItem.mentee_id;

        // 更新狀態和 UI
        element.className = 'timing';
        if (newStatus === 'booked') {
            element.classList.add('booked', 'my-booking');
            matchedItem.status = 'booked';
            matchedItem.mentee_id = loggedInUserId;
            
            // 立即更新剩餘課程數
            const remainingClassesElement = document.querySelector('#remaining-classes');
            if (remainingClassesElement) {
                remainingClassesElement.textContent = (parseInt(remainingClassesElement.textContent) - 1).toString();
            }
        } else {
            element.classList.add('selected');
            matchedItem.status = 'available';
            matchedItem.mentee_id = null;
            
            // 立即更新剩餘課程數
            const remainingClassesElement = document.querySelector('#remaining-classes');
            if (remainingClassesElement) {
                remainingClassesElement.textContent = (parseInt(remainingClassesElement.textContent) + 1).toString();
            }
        }

        // 設置處理中狀態
        isProcessing = true;
        processingTimeslots.add(matchedItem.id);
        element.classList.add('processing');

        // 發送預約狀態更新請求
        fetch('/update-booking-status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                classScheduleId: matchedItem.id,
                newStatus: newStatus,
                menteeId: loggedInUserId,
                mentorId: mentorId
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.message) {
                showNotification(data.message, 'alert-success');
                
                // 更新剩餘課程數顯示（使用伺服器返回的準確數值）
                if (data.remaining_classes !== undefined) {
                    const remainingClassesElement = document.querySelector('#remaining-classes');
                    if (remainingClassesElement) {
                        remainingClassesElement.textContent = data.remaining_classes;
                    }
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // 發生錯誤時恢復原始狀態
            element.className = originalClasses;
            matchedItem.status = originalStatus;
            matchedItem.mentee_id = originalMenteeId;
            
            // 恢復剩餘課程數
            const remainingClassesElement = document.querySelector('#remaining-classes');
            if (remainingClassesElement && newStatus === 'booked') {
                remainingClassesElement.textContent = (parseInt(remainingClassesElement.textContent) + 1).toString();
            } else if (remainingClassesElement && newStatus === 'available') {
                remainingClassesElement.textContent = (parseInt(remainingClassesElement.textContent) - 1).toString();
            }
            
            showNotification('發生錯誤，請稍後再試。', 'alert-danger');
        })
        .finally(() => {
            // 立即移除處理中狀態
            isProcessing = false;
            processingTimeslots.delete(matchedItem.id);
            element.classList.remove('processing');
        });
    }

    // 優化通知顯示函數
    let notificationTimeout;
    let notificationContainer;
    
    function showNotification(message, className) {
        if (!notificationContainer) {
            notificationContainer = document.createElement('div');
            notificationContainer.id = 'notification-container';
            notificationContainer.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
            `;
            document.body.appendChild(notificationContainer);
        }

        const notification = document.createElement('div');
        notification.className = `alert ${className}`;
        notification.style.cssText = `
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 4px;
            min-width: 250px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            opacity: 1;
        `;
        notification.textContent = message;
        
        // 清除舊的通知
        while (notificationContainer.firstChild) {
            notificationContainer.removeChild(notificationContainer.firstChild);
        }
        
        notificationContainer.appendChild(notification);

        if (notificationTimeout) {
            clearTimeout(notificationTimeout);
        }

        notificationTimeout = setTimeout(() => {
            notification.remove();
        }, 2000);
    }

    document.getElementById('prevWeek').addEventListener('click', () => changeWeek(-7));
    document.getElementById('nextWeek').addEventListener('click', () => changeWeek(7));

    function changeWeek(days) {
        const newStartDate = new Date(currentStartDate);
        newStartDate.setDate(newStartDate.getDate() + days);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (newStartDate >= today || days > 0) {
            currentStartDate = newStartDate;
            updateDateInfo(currentStartDate);
            fetchClassSchedule(mentorId, userTimezone);
        } else {
            alert("不能查看過去的日期");
        }
    }

    function updateDateInfo(date) {
        document.getElementById('current-date').textContent = date.getFullYear();
    }

    updateDateInfo(currentStartDate);

    // 更新剩餘課程數的輔助函數
    function updateRemainingClasses(newCount) {
        const remainingClassesElement = document.getElementById('remaining-classes');
        if (remainingClassesElement) {
            remainingClassesElement.textContent = newCount;
        }
    }
});
</script>
@endsection