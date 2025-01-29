@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title">Bookings</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="index_admin">Dashboard</a></li>
						<li class="breadcrumb-item active">Bookings</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		<div class="row">
			<div class="col-md-12">

				<!-- Recent Orders -->
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="myTable" class="datatable table table-hover table-center mb-0">
								<thead>
									<tr>
										<th>ID</th>
										<th>Mentor Name</th>
										<th>Weekly</th>
										<th>Mentee Name</th>
										<th>Booking Time</th>
										<th class="text-end">Status</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- /Recent Orders -->

			</div>
		</div>
	</div>
</div>
<!-- /Page Wrapper -->
@endsection

@section('scripts')
<script>
	document.addEventListener('DOMContentLoaded', function() {
		if ($.fn.DataTable.isDataTable('#myTable')) {
			$('#myTable').DataTable().clear().destroy();
		}

		$('#myTable').DataTable({
			processing: true,
			serverSide: true,
			searching: true,
			ajax: function(data, callback, settings) {
				const sortField = data.columns[data.order[0].column].data;
				const sortDirection = data.order[0].dir;
				const perPage = data.length;
				const currentPage = (data.start / perPage) + 1;
				const searchValue = data.search.value;

				fetch(`/get-class-schedules?sortField=${sortField}&sortDirection=${sortDirection}&page=${currentPage}&perPage=${perPage}&search=${searchValue}`)
					.then(response => response.json())
					.then(json => {
						callback({
							recordsTotal: json.recordsTotal,
							recordsFiltered: json.recordsFiltered,
							data: json.data
						});
					});
			},
			columns: [{
					data: 'id'
				},
				{
					data: 'mentor',
					render: function(data, type, row) {
						if (data) {
							return `
                            <h2 class="table-avatar">
                                <a href="profile/${data.id}" class="avatar avatar-sm me-2">
                                    <img class="avatar-img rounded-circle" src="/storage/${data.avatar_path}" alt="User Image">
                                </a>
                                <a href="profile/${data.id}">${data.last_name} ${data.first_name}</a>
                            </h2>
                        `;
						}
						return '';
					}
				},
				{
					data: 'day_of_week'
				},
				{
					data: 'mentee',
					render: function(data, type, row) {
						console.log(data);
						if (data) {
							return `
                <h2 class="table-avatar">
                    <a href="profile/${data.id}" class="avatar avatar-sm me-2">
											<img class="avatar-img rounded-circle" src="/storage/${data.avatar_path}" alt="User Image">
                    </a>
                    <a href="profile/${data.id}">${data.last_name} ${data.first_name}</a>
                </h2>`;
						}
						return '';
					}
				},

				{
					data: 'schedule_date',
					render: function(data, type, row) {
						// 將UTC時間轉換為本地時間
						var startTime = row.start_time ? new Date(data + 'T' + row.start_time + 'Z').toLocaleTimeString([], { hour: '2-digit', minute: '2-digit',hour12: false }) : '';
						var endTime = row.end_time ? new Date(data + 'T' + row.end_time + 'Z').toLocaleTimeString([], { hour: '2-digit', minute: '2-digit',hour12: false }) : '';
						return `${data} <span class="text-primary d-block">${startTime} - ${endTime}</span>`;
					}
				},
				{
					data: 'status',
					render: function(data, type, row) {
						var labelClass;
						var status = data.toLowerCase(); // 將狀態轉為小寫來進行比較，確保大小寫不敏感
						switch (status) {
							case 'completed':
								labelClass = 'bg-success'; // 綠色標籤，代表已完成
								break;
							case 'canceled':
								labelClass = 'bg-danger'; // 紅色標籤，代表已取消
								break;
							case 'absent':
								labelClass = 'bg-warning'; // 黃色標籤，代表缺席
								break;
							case 'booked':
								labelClass = 'bg-info'; // 藍色標籤，代表已預訂但尚未開始
								break;
							default:
								labelClass = 'bg-secondary'; // 灰色標籤，預設情況
						}
						return `<span class="badge badge-pill ${labelClass}">${data}</span>`;
					}
				}
			],
			lengthMenu: [10, 25, 50, 100], // 允許用戶選擇每頁顯示多少條記錄
			pageLength: 10, // 預設每頁的記錄數
		});
	});
</script>
@endsection
