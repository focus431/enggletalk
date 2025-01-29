<?php $page = "schedule-timings"; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Schedule Timings</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Schedule Timings</h2>
                <input type="hidden" id="userTimezone" value="{{ auth()->user()->timezone }}">
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

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Schedule Timings</h4>
                                <div class="profile-box">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card schedule-widget mb-0">

                                                <!-- Schedule Header -->
                                                <div class="schedule-header">


                                                    <!-- Schedule Nav -->
                                                    <div class="schedule-nav">
																											<ul class="nav nav-tabs nav-justified">
																													<li class="nav-item">
																															<a class="nav-link" data-date="monday" data-active="false" href="#slot_monday">{{ __('Monday') }}</a>
																													</li>
																													<li class="nav-item">
																															<a class="nav-link" data-date="tuesday" data-active="false" href="#slot_tuesday">{{ __('Tuesday') }}</a>
																													</li>
																													<li class="nav-item">
																															<a class="nav-link" data-date="wednesday" data-active="false" href="#slot_wednesday">{{ __('Wednesday') }}</a>
																													</li>
																													<li class="nav-item">
																															<a class="nav-link" data-date="thursday" data-active="false" href="#slot_thursday">{{ __('Thursday') }}</a>
																													</li>
																													<li class="nav-item">
																															<a class="nav-link" data-date="friday" data-active="false" href="#slot_friday">{{ __('Friday') }}</a>
																													</li>
																													<li class="nav-item">
																															<a class="nav-link" data-date="saturday" data-active="false" href="#slot_saturday">{{ __('Saturday') }}</a>
																													</li>
																													<li class="nav-item">
																															<a class="nav-link" data-date="sunday" data-active="false" href="#slot_sunday">{{ __('Sunday') }}</a>
																													</li>
																											</ul>
																									</div>
																									
																									
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="card-title d-flex justify-content-between">
                                    <a class="edit-link" data-bs-toggle="modal" href="#edit_time_slot"><i class="fa fa-edit mr-1"></i>Edit</a>
                                </h4>
                            </div>
                        </div>
                    </div>
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
                </div>
            </div>
        </div>
    </div>

</div>

</div>
<!-- /Page Content -->
@endsection
@section('scripts')
<script>
	document.addEventListener('DOMContentLoaded', function() {
			// 從PHP配置中獲取時間設定
			const classDuration = {!! config('schedule.class_duration', 50) !!}; // 課程時間，預設50分鐘
			const breakDuration = {!! config('schedule.break_duration', 10) !!}; // 休息時間，預設10分鐘
			const totalDuration = classDuration + breakDuration; // 總時間

			let needToUpdate = true;
			let eventListenerAdded = false;

			// 基础初始化
			basicInitialization();
			// 初始化选项卡点击事件
			initializeTabClicks();
			// 初始化保存更改按钮点击事件
			initializeSaveChanges();

			// 从服务器获取并比较时间表
			fetchAndCompareSchedules();
			
			// 移除這行，因為 basicInitialization() 中已經調用了
			// generateNextSevenDays();

			function createTimingElement(hour, minute) {
					const aElement = document.createElement("a");
					aElement.classList.add("timing");
					aElement.href = "#";

					const spanElement = document.createElement("span");
					const timeStart = `${String(hour).padStart(2, '0')}:${String(minute).padStart(2, '0')}`;
					const timeEndHour = minute + classDuration >= 60 ? hour + 1 : hour;
					const timeEndMinute = (minute + classDuration) % 60;
					const timeEnd = `${String(timeEndHour).padStart(2, '0')}:${String(timeEndMinute).padStart(2, '0')}`;

					spanElement.textContent = `${timeStart} - ${timeEnd}`;
					aElement.appendChild(spanElement);

					return aElement;
			}

			// 基础初始化
			function basicInitialization() {
					setCurrentDateAndDay();

					// 定義當前的開始日期為今天
					let currentStartDate = new Date();
					const weeklyParentElement = document.querySelector(".time-slot");
					generateNextSevenDays(currentStartDate);

					// 监听左右箭头点击事件
					setupWeekNavigation(currentStartDate, generateNextSevenDays);
			}

			// 设置周导航
			function setupWeekNavigation(currentStartDate, callback) {
					document.getElementById('prevWeek').addEventListener('click', async function() {
							// 添加條件以防止導航到今天以前的日期
							const today = new Date();
							const newStartDate = new Date(currentStartDate);
							newStartDate.setDate(currentStartDate.getDate() - 7);
							
							if (newStartDate >= today) {
									currentStartDate = newStartDate;
									generateNextSevenDays(currentStartDate);
									await fetchAndCompareSchedules(); // 等待獲取並比對時間表
									disablePastTimeSlots(); // 禁用過期時段
							}
					});

					document.getElementById('nextWeek').addEventListener('click', async function() {
							const newStartDate = new Date(currentStartDate);
							newStartDate.setDate(currentStartDate.getDate() + 7);
							
							// 檢查是否超過最大可預約天數
							const maxDaysAhead = {!! config('schedule.max_days_ahead', 62) !!};
							const maxDate = new Date();
							maxDate.setDate(maxDate.getDate() + maxDaysAhead);
							
							if (newStartDate <= maxDate) {
									currentStartDate = newStartDate;
									generateNextSevenDays(currentStartDate);
									await fetchAndCompareSchedules(); // 等待獲取並比對時間表
									disablePastTimeSlots(); // 禁用過期時段
							}
					});
			}

			// 新增一個函數來更新 time-slot 和 time-list
			function updateTimings(startDate) {
					const timeListElement = document.querySelector("#time-list"); // 假設這是你的 time-list 的父元素

					// 清空目前的 time-list
					timeListElement.innerHTML = '';

					// 這裡重新生成 time-list，並為每個項目添加新的 data-date
					// ...（這取決於你具體的需求和 generateDailyTimings 函數的實現）
			}

			// 移动日期
			function moveDateByDays(date, days) {
					date.setDate(date.getDate() + days);
			}

			// 设置当前日期和天
			function setCurrentDateAndDay() {
					const dateElement = document.querySelector('.mb-1'); // h4 元素
					const dayElement = document.querySelector('#current-day'); // p 元素

					const now = new Date();
					const options = {
							year: 'numeric',
							month: 'long',
							day: 'numeric'
					};
					const formattedDate = now.toLocaleDateString('en-US', options);
					const formattedDay = now.toLocaleDateString('en-US', {
							weekday: 'long'
					});

					dateElement.textContent = formattedDate;
					dayElement.textContent = formattedDay;
			}

			// 生成接下来的七天
			function generateNextSevenDays(startDate = new Date()) {
					const ulElement = document.querySelector('.day-slot ul');
					ulElement.innerHTML = ''; // 清空現有內容

					// 確保 startDate 是 Date 對象
					const start = new Date(startDate);
					const timeListElement = document.getElementById('time-list');
					timeListElement.innerHTML = ''; // 清空時間列表

					for (let i = 0; i < 7; i++) {
							const currentDate = new Date(start);
							currentDate.setDate(start.getDate() + i);
							
							// 創建日期顯示
							const liElement = document.createElement('li');
							const spanElement1 = document.createElement('span');
							const spanElement2 = document.createElement('span');
							
							spanElement1.textContent = currentDate.toLocaleDateString('en-US', { weekday: 'short' });
							spanElement2.textContent = `${currentDate.getDate()} ${currentDate.toLocaleDateString('en-US', { month: 'short' })}`;
							
							liElement.appendChild(spanElement1);
							liElement.appendChild(spanElement2);
							ulElement.appendChild(liElement);

							// 為每一天創建時間段
							const dayOfWeek = currentDate.toLocaleDateString('en-US', { weekday: 'long' });
							generateDailyTimings(currentDate, dayOfWeek, 8, 23, timeListElement);
					}

					// 更新當前日期顯示
					const currentDateElement = document.getElementById('current-date');
					const currentDayElement = document.getElementById('current-day');
					if (currentDateElement && currentDayElement) {
							currentDateElement.textContent = start.toLocaleDateString('en-US', {
									year: 'numeric',
									month: 'long',
									day: 'numeric'
							});
							currentDayElement.textContent = start.toLocaleDateString('en-US', { weekday: 'long' });
					}
			}

			// 生成周时间
			function generateWeeklyTimings(startHour, endHour, parentElement) {
					// 遍历每一天（从周一到周日）
					const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
					days.forEach(day => {

							// 创建一个单一的li元素
							const liElement = document.createElement("li");
							liElement.style.listStyleType = "none";
							liElement.classList.add(day);

							// 遍历每个小时
							for (let hour = startHour; hour < endHour; hour++) {

									// 两个时段：一个在小时开始，另一个在半小时
									[0].forEach(minute => {
											const aElement = document.createElement("a");
											aElement.classList.add("timing");
											aElement.href = "#";

											const spanElement = document.createElement("span");
											const timeStart = `${String(hour).padStart(2, '0')}:${String(minute).padStart(2, '0')}`;
											const timeEndHour = minute + 50 >= 60 ? hour + 1 : hour;
											const timeEndMinute = (minute + 50) % 60;
											const timeEnd = `${String(timeEndHour).padStart(2, '0')}:${String(timeEndMinute).padStart(2, '0')}`;

											spanElement.textContent = `${timeStart} - ${timeEnd}`;
											aElement.appendChild(spanElement);

											liElement.appendChild(aElement);
									});
							}

							// 将 li 元素添加到父元素
							parentElement.appendChild(liElement);
					});
			}

			// 生成每日时刻表
			function generateDailyTimings(date, dayOfWeek, startHour, endHour = 23, parentElement) {
					const liElement = document.createElement("li");
					liElement.classList.add('day-timing');
					liElement.classList.add(dayOfWeek); // 添加星期几作为类别
					liElement.setAttribute('data-date', date.toDateString()); // 设置日期

					for (let hour = startHour; hour <= endHour; hour++) {
							// 生成每小时的一个时段
							const firstElement = createTimingElement(hour, 0);
							liElement.appendChild(firstElement);
					}

					parentElement.appendChild(liElement);

					// 初始化时间选择器
					initCalendarTiming();
			}

			// 创建单个时刻元素
			function createTimingElement(hour, minute) {
					const aElement = document.createElement("a");
					aElement.classList.add("timing");
					aElement.href = "#";

					const spanElement = document.createElement("span");
					const timeStart = `${String(hour).padStart(2, '0')}:${String(minute).padStart(2, '0')}`;
					const timeEndHour = minute + 50 >= 60 ? hour + 1 : hour;
					const timeEndMinute = (minute + 50) % 60;
					const timeEnd = `${String(timeEndHour).padStart(2, '0')}:${String(timeEndMinute).padStart(2, '0')}`;

					spanElement.textContent = `${timeStart} - ${timeEnd}`;
					aElement.appendChild(spanElement);

					return aElement;
			}

			// 修改時間選項生成的邏輯
			function createTimeOptions(element, startHour = 8, endHour = 23, interval = totalDuration, offset = 0) {
					element.innerHTML = ''; // 清空現有選項
					let currentTime = startHour * 60 + offset; // 轉換為分鐘
					const endTime = endHour * 60;

					while (currentTime < endTime) {
							const hour = Math.floor(currentTime / 60);
							const minute = currentTime % 60;
							const timeStr = `${String(hour).padStart(2, '0')}:${String(minute).padStart(2, '0')}`;
							
							const option = document.createElement('option');
							option.value = timeStr;
							option.textContent = timeStr;
							element.appendChild(option);
							
							currentTime += interval; // 使用總時間間隔(課程時間+休息時間)
					}
			}

			// 為初始时间段创建时间选项
			function createTimeOptionsForInitialSlot() {
					const initialTimeSlot = document.querySelector('.timeSlot');
					createTimeOptions(initialTimeSlot.querySelector('.startTime'), 8, 23, totalDuration); // 使用總時間間隔
					createTimeOptions(initialTimeSlot.querySelector('.endTime'), 8, 23, totalDuration, classDuration); // 從課程結束時間開始
			}

			// Bootstrap 的模態框顯示事件
			$('#edit_time_slot').on('shown.bs.modal', function() {
					initializeTimeSlots();
			});

			// 添加新的时间段
			function addNewTimeSlot() {
					const initialTimeSlot = document.querySelector('.timeSlot');
					const newTimeSlot = initialTimeSlot.cloneNode(true);
					createTimeOptions(newTimeSlot.querySelector('.startTime'), 8, 23, totalDuration);
					createTimeOptions(newTimeSlot.querySelector('.endTime'), 8, 23, totalDuration, classDuration);
					document.getElementById('timeSlots').appendChild(newTimeSlot);
			}

			// 移除时间段
			function removeTimeSlot(e) {
					if (e.target.classList.contains('removeSlot')) {
							e.target.closest('.timeSlot').remove();
					}
			}

			// 初始化选项卡点击事件
			function initializeTabClicks() {
    const activeDays = []; // 用来存储当前选中的天数
    document.querySelectorAll('.nav-link').forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            toggleTab(this, activeDays); // 传递当前选中的tab元素和活动天数组
        });
    });
}

function toggleTab(tab, activeArray) {
    const isActive = tab.getAttribute('data-active') === 'true';
    const tabValue = tab.getAttribute('data-date');  // 获取data-date的值

    tab.classList.toggle('active');  // 切换选中状态的样式
    tab.setAttribute('data-active', String(!isActive));  // 切换data-active的值

    const index = activeArray.indexOf(tabValue);
    if (index > -1) {
        activeArray.splice(index, 1);  // 如果已经在数组中，移除它
    } else {
        activeArray.push(tabValue);  // 如果不在数组中，添加它
    }
}

			// 初始化保存更改按钮点击事件
			function initializeSaveChanges() {
					document.getElementById('saveChanges').addEventListener('click', function() {
							const activeDays = getActiveDays(); // 获取选定的日期
							if (activeDays.length === 0) {
									alert('Please select a day of the week first!');
									return;
							}

							let validTimeSlots = [];

							const now = new Date();
							const currentDay = now.getDay(); // 获取当前星期几 (0-6, 0是星期天)
							const currentTime = now.getHours() * 60 + now.getMinutes(); // 当前时间转换为分钟

							const daysOfWeek = {
									"Sunday": 0,
									"Monday": 1,
									"Tuesday": 2,
									"Wednesday": 3,
									"Thursday": 4,
									"Friday": 5,
									"Saturday": 6
							};

							const timeSlots = Array.from(document.querySelectorAll('.timeSlot')).map(slot => ({
									start_time: slot.querySelector('.startTime').value,
									end_time: slot.querySelector('.endTime').value,
									day_of_week: getActiveDays() // 获取选定的日期
							}));

							for (const slot of timeSlots) {
									if (slot.start_time === slot.end_time) {
											alert("The start time cannot be the same as the end time."); // 或者你可以使用其他提示方式
											return; // 提前退出函数，不进行后续的 saveChanges 调用
									}

									if (slot.start_time >= slot.end_time) {
											alert("The start time must be less than the end time."); // 或者你可以使用其他提示方式
											return; // 提前退出函数，不进行后续的 saveChanges 调用
									}

									for (const day of slot.day_of_week) {
											const dayIndex = daysOfWeek[day];

											if (dayIndex === currentDay) {
													// 仅在当天检查时间差
													const [selectedHour, selectedMinute] = slot.start_time.split(':').map(Number);
													const selectedStartTime = selectedHour * 60 + selectedMinute;

													if (selectedStartTime - currentTime >= 120) {
															validTimeSlots.push({
																	start_time: slot.start_time,
																	end_time: slot.end_time,
																	day_of_week: [day]
															});
													}
											} else {
													validTimeSlots.push({
															start_time: slot.start_time,
															end_time: slot.end_time,
															day_of_week: [day]
													});
											}
									}
							}

							if (validTimeSlots.length === 0) {
									alert("No valid time slots to save.");
									return;
							}

							// 转换时间为UTC
							validTimeSlots = validTimeSlots.map(slot => {
									slot.start_time = localToUTC(slot.start_time);
									slot.end_time = localToUTC(slot.end_time);
									return slot;
							});

							saveChanges(validTimeSlots, getActiveDays()); // 需要你自己实现这个函数
					});
			}

			// 获取选定的日期
			function getActiveDays() {
    return getActiveTabValues('.nav-link[data-date]');  // 使用data-date属性选择
}

function getActiveTabValues(selector) {
    return Array.from(document.querySelectorAll(selector))
        .filter(tab => tab.getAttribute('data-active') === 'true')
        .map(tab => tab.getAttribute('data-date'));  // 返回data-date的值
}

			// 保存更改
			function saveChanges(timeSlots, activeDays) {
					fetch('/schedule-timings', {
							method: 'POST',
							headers: {
									'Content-Type': 'application/json',
									'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
							},
							body: JSON.stringify({
									timeSlots,
									activeDays,
									// courseIds: selectedCourses
							})
					})
					.then(response => response.json())
					.then(data => console.log('成功：', data))
					.catch(error => console.error('错误：', error));
					$('#edit_time_slot').modal('hide');
					location.reload();
			}

			// 本地时间转换为 UTC 时间
			function localToUTC(localTime) {
					const localDateTime = new Date(`1970-01-01T${localTime}:00`);
					return localDateTime.toISOString().split('T')[1].slice(0, 5);
			}

			// 切换选项卡
			function initCalendarTiming() {
					if (eventListenerAdded) {
							return;
					}
					const parentElement = document.getElementById('time-list');
					parentElement.addEventListener("click", handleSchedule);
					eventListenerAdded = true;
			}

			// 監聽第一個 li 元素
			const ulElement = document.querySelector('.day-slot ul');
			const firstLiElement = ulElement.querySelector('li:first-child');

			// 獲取第二個 span 元素
			const secondSpanElement = firstLiElement.querySelector('span:nth-child(2)');

			// 監聽 span 元素的值變化
			let previousDate = secondSpanElement.textContent; // 保存之前的日期

			function checkDateChange() {
					const currentDate = secondSpanElement.textContent;

					// 檢查日期是否變化
					if (currentDate === previousDate) {
							// 日期沒有變化，可以保持原樣式
							firstLiElement.style.backgroundColor = '';
							firstLiElement.style.color = '';
					} else {
							// 日期變化了，設定新樣式
							const currentSpanDate = new Date().toLocaleDateString('en-US', {
									month: 'short'
							}) + ' ' + new Date().getDate();
							if (currentDate === currentSpanDate) {
									firstLiElement.style.backgroundColor = "#1e88e5";
									firstLiElement.style.color = "white";
							} else {
									firstLiElement.style.backgroundColor = '';
									firstLiElement.style.color = '';
							}
					}

					// 更新之前的日期
					previousDate = currentDate;
			}

			// 監聽 span 元素的值變化
			setInterval(checkDateChange, 1000); // 每秒檢查一次

			// 定義兩個變量來保存當前的開始日期和結束日期
			let currentStart = moment().subtract(6, 'days'); // 初始開始日期
			let currentEnd = moment(); // 初始結束日期

			// 函數：向前移動7天
			function moveBackwardSevenDays() {
					currentStart.subtract(7, 'days');
					currentEnd.subtract(7, 'days');
					$('.bookingrange').data('daterangepicker').setStartDate(currentStart);
					$('.bookingrange').data('daterangepicker').setEndDate(currentEnd);
			}

			// 函數：向後移動7天
			function moveForwardSevenDays() {
					currentStart.add(7, 'days');
					currentEnd.add(7, 'days');
					$('.bookingrange').data('daterangepicker').setStartDate(currentStart);
					$('.bookingrange').data('daterangepicker').setEndDate(currentEnd);
			}

			// 格式化時間，只保留時和分
			function formatTime(time) {
					const parts = time.split(':');
					return `${parts[0]}:${parts[1]}`;
			}

			// 從後端獲取時間表並進行比對
			async function fetchAndCompareSchedules() {
					try {
							// 從後端獲取資料
							const response = await fetch('/getschedule');
							if (!response.ok) {
									throw new Error('Network response was not ok');
							}
							const schedules = await response.json();

							// 清除所有現有的狀態標記
							document.querySelectorAll('.timing').forEach(timing => {
									timing.classList.remove('selected', 'booked', 'disabled');
									timing.style.pointerEvents = ''; // 重置點擊事件
							});

							// 獲取前端HTML中的day和time list
							const dayList = document.querySelectorAll('.day-timing');
							
							// 為每個時段檢查狀態
							dayList.forEach(dayElement => {
									const frontendDate = new Date(dayElement.getAttribute('data-date')).toLocaleDateString();
									const timeElements = dayElement.querySelectorAll('.timing');
									
									timeElements.forEach(timeElement => {
											const timeRange = timeElement.textContent.trim().split(' - ');
											const frontendStartTime = formatTime(timeRange[0]);
											const frontendEndTime = formatTime(timeRange[1]);

											// 查找匹配的預約記錄
											const matchingSchedule = schedules.find(schedule => {
													const backendDate = new Date(schedule.schedule_date).toLocaleDateString();
													const backendStartTime = utcToLocal(schedule.start_time);
													const backendEndTime = utcToLocal(schedule.end_time);
													
													return backendDate === frontendDate && 
														   backendStartTime === frontendStartTime && 
														   backendEndTime === frontendEndTime;
											});

											if (matchingSchedule) {
													timeElement.setAttribute('data-id', matchingSchedule.id);
													if (matchingSchedule.status === 'available') {
															timeElement.classList.add('selected');
													} else if (matchingSchedule.status === 'booked') {
															timeElement.classList.add('booked', 'disabled');
															timeElement.style.pointerEvents = 'none'; // 禁止點擊
													}
											}
									});
							});
					} catch (error) {
							console.error('Error fetching or processing data:', error);
					}
			}

			// UTC时间转换为本地时间
			function utcToLocal(utcTime) {
					const localDateTime = new Date(`1970-01-01T${utcTime}:00Z`);
					const localHours = localDateTime.getHours().toString().padStart(2, '0');
					const localMinutes = localDateTime.getMinutes().toString().padStart(2, '0');
					return `${localHours}:${localMinutes}`;
			}

			async function handleSchedule(event) {
    const target = event.target;

    if (target.matches(".timing, .timing *")) {
        event.preventDefault();
        const timing = target.closest(".timing");

        // 获取所选日期
        const listItem = timing.closest('.day-timing');
        const selectedDate = new Date(listItem.getAttribute('data-date')).toDateString();
        const today = new Date();
        const todayDate = today.toDateString();

        // 只有當天日期才檢查時間差
        if (selectedDate === todayDate) {
            // 获取当前时间
            const currentTime = today.getHours() * 60 + today.getMinutes(); // 当前时间转换为分钟

            // 获取所选时段的起始时间
            const timeRange = timing.querySelector("span").textContent.split(' - ');
            const selectedTime = timeRange[0];
            const [selectedHour, selectedMinute] = selectedTime.split(':').map(Number);
            const selectedStartTime = selectedHour * 60 + selectedMinute; // 所选时段的起始时间转换为分钟

            // 检查时间差是否小于2小时
            if (selectedStartTime - currentTime < 120) {
                alert("所選時段不足2小時，無法選擇！");
                return;
            }
        }

        // 切換 'selected' 類
        if (timing.classList.contains('selected')) {
            timing.classList.remove('selected');
        } else {
            timing.classList.add('selected');
        }

        // 獲取所需數據
        const existingDate = listItem.getAttribute('data-date');
        const existingDateObject = new Date(existingDate); // 创建日期对象

        // 获取日期的年、月、日
        const year = existingDateObject.getFullYear();
        const month = existingDateObject.getMonth() + 1; // 月份从 0 开始，所以要加 1
        const day = existingDateObject.getDate();

        // 格式化日期为 "YYYY-MM-DD" 形式
        const formattedDate = `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;

        const dayOfWeek = listItem.className.split(' ')[1];
        const [startTime, endTime] = timing.querySelector("span").textContent.split(' - ');

        // 本地时间转换为 UTC 时间
        const localStartTime = new Date(`${formattedDate}T${startTime}:00`);
        const localEndTime = new Date(`${formattedDate}T${endTime}:00`);
        const utcStartTime = localStartTime.toISOString().split('T')[1].slice(0, 5);
        const utcEndTime = localEndTime.toISOString().split('T')[1].slice(0, 5);

        // 組成對象
        const dataToSend = {
            existing_date: formattedDate,
            day_of_week: dayOfWeek,
            start_time: utcStartTime,
            end_time: utcEndTime,
            is_recurring: 0,
            status: timing.classList.contains('selected') ? 'available' : 'unavailable'
        };

        const url = '/handle-schedule'; // 新的整合後的路由
        const method = 'POST';

        try {
            const response = await fetch(url, {
                method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(dataToSend),
            });

            const data = await response.json();

            if (response.status === 200) {
                console.log('Operation successful:', data);
                timing.setAttribute('data-id', data.id); // 更新或設置 data-id
            } else {
                console.error('Operation failed:', data);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }
}


			function initCalendarTiming() {
					if (eventListenerAdded) {
							return;
					}
					const parentElement = document.getElementById('time-list');
					parentElement.addEventListener("click", handleSchedule);
					eventListenerAdded = true;
			}

			function disablePastTimeSlots() {
					const now = new Date();
					const currentDate = now.toDateString();
					const currentTime = now.getHours() * 60 + now.getMinutes(); // 当前时间转换为分钟

					const timeSlots = document.querySelectorAll('.day-timing');

					timeSlots.forEach(slot => {
							const slotDate = new Date(slot.getAttribute('data-date')).toDateString();

							if (slotDate === currentDate) {
									const timingElements = slot.querySelectorAll('.timing');

									timingElements.forEach(timing => {
											const timeRange = timing.querySelector("span").textContent.split(' - ');
											const selectedTime = timeRange[0];
											const [selectedHour, selectedMinute] = selectedTime.split(':').map(Number);
											const selectedStartTime = selectedHour * 60 + selectedMinute;

											if (selectedStartTime - currentTime < 120) {
													timing.classList.add('disabled');
													timing.addEventListener('click', function(event) {
															event.preventDefault();
													});
											}
									});
							}
					});
			}

			disablePastTimeSlots();

			// 初始化時間選項
			function initializeTimeSlots() {
					const timeSlots = document.querySelectorAll('.timeSlot');
					timeSlots.forEach(slot => {
							const startTimeSelect = slot.querySelector('.startTime');
							const endTimeSelect = slot.querySelector('.endTime');
							
							// 創建開始時間選項
							createTimeOptions(startTimeSelect, 8, 23, totalDuration);
							
							// 創建結束時間選項，加上課程時間作為偏移
							createTimeOptions(endTimeSelect, 8, 23, totalDuration, classDuration);
					});
			}

			// 添加新的時間段
			document.getElementById('addSlot').addEventListener('click', function() {
					const timeSlots = document.getElementById('timeSlots');
					const newSlot = document.querySelector('.timeSlot').cloneNode(true);
					
					// 重新初始化新時段的選項
					const startTimeSelect = newSlot.querySelector('.startTime');
					const endTimeSelect = newSlot.querySelector('.endTime');
					
					createTimeOptions(startTimeSelect, 8, 23, totalDuration);
					createTimeOptions(endTimeSelect, 8, 23, totalDuration, classDuration);
					
					timeSlots.appendChild(newSlot);
			});
	});
</script>

@endsection
