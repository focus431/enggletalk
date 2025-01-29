@extends('layout.mainlayout_admin')
@section('content')
  <!-- Page Wrapper -->
  <div class="page-wrapper">
    <div class="content container-fluid">

      <!-- Page Header -->
      <div class="page-header">
        <div class="row">
          <div class="col-sm-12">
            <h3 class="page-title">List of Mentor</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index_admin">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="javascript:(0);">Users</a></li>
              <li class="breadcrumb-item active">Mentor</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /Page Header -->

      <!-- 主要內容 -->
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="datatable table table-hover table-center mb-0">
                  <thead>
                    <tr>
                      <th>Avatar</th>
                      <th data-field="created_at">Registration Date</th>
                      <th data-field="last_name">Mentor Name</th>
                      <th data-field="gender">Gender</th>
                      <th data-field="mobile">Rate</th>
                      <th data-field="details">Details</th> <!-- 新增 Details 列 -->
                      <th data-field="activated">Account Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- 動態加載數據 -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- 加载动画 -->
      <div id="loader" style="display:none;">
        <div class="spinner"></div>
      </div>
      
    </div>
  </div>
  <!-- /Page Wrapper -->
@endsection

@section('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      if ($.fn.DataTable.isDataTable('.datatable')) {
        $('.datatable').DataTable().destroy();
        $('.datatable tbody').empty(); // 如果列發生變化則清空
      }

      var table = $('.datatable').DataTable({
    serverSide: true,
    order: [[1, 'desc']], // 這裡指定第二列（即 created_at）作為預設排序，'desc' 表示降序
    ajax: function(data, callback, settings) {
        const sortField = data.columns[data.order[0].column].data || 'created_at'; // 確保默認使用 created_at 排序
        const sortDirection = data.order[0].dir || 'desc';
        const perPage = data.length;
        const currentPage = (data.start / perPage) + 1;

        fetch(
            `/get-users/mentor?sortField=${sortField}&sortDirection=${sortDirection}&page=${currentPage}&perPage=${perPage}&search=${data.search.value}`
        )
        .then(response => response.json())
        .then(json => {
            callback({
                recordsTotal: json.total,
                recordsFiltered: json.total,
                data: json.data
            });
        });
    },
    columns: [
        {
            data: 'avatar_path',
            render: function(data, type, row) {
                return `<img src="/storage/${data}" alt="Avatar" class="avatar-img rounded-circle responsive-avatar">`;
            },
            className: "text-center"
        },
        {
            data: 'created_at',
            render: function(data, type, row) {
                const date = new Date(data);
                return date.toLocaleDateString(); // 根據用戶的本地設置格式化日期
            }
        },
        {
            data: 'last_name',
            render: function(data, type, row) {
                return `${row.last_name} ${row.first_name}`;
            }
        },
        {
            data: 'gender'
        },
        {
            data: 'rate',
            render: function(data, type, row) {
                return `<input type="number" class="form-control rate-input" data-id="${row.id}" value="${data || ''}" step="10" min="0" >`;
            },
            className: "text-center"
        },
        {
            data: null,
            render: function(data, type, row) {
                return `<a href="/show-mentor/${row.id}" class="btn btn-sm btn-primary">View Details</a>`;
            },
            className: "text-center"
        },
        {
            data: 'activated',
            render: function(data, type, row) {
                const checked = data ? 'checked' : '';
                return `<div class="text-center">
                        <input type="checkbox" id="status_${row.id}" class="check" ${checked}>
                        <label for="status_${row.id}" class="checktoggle">checkbox</label>
                    </div>`;
            },
            className: "text-center"
        }
    ]
});


      // 監聽 rate 的變更事件
      document.addEventListener('input', function(event) {
        if (event.target.matches('.rate-input')) {
          let input = event.target;
          let id = input.getAttribute('data-id');
          let newRate = input.value;

          // 顯示讀取動畫
          let loader = document.querySelector('#loader');
          loader.style.display = 'block';

          fetch(`/admin/update-rate/${id}`, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
              },
              body: JSON.stringify({
                rate: newRate
              })
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                console.log('Rate updated successfully');
              } else {
                console.error('Error updating rate:', data.message);
              }
            })
            .catch(error => console.error('Error updating rate:', error))
            .finally(() => {
              // 隱藏讀取動畫
              loader.style.display = 'none';
            });
        }
      });

      // 監聽帳號激活狀態變更
      document.addEventListener('change', function(event) {
    if (event.target.matches('.check')) {
        let checkbox = event.target;
        let id = checkbox.id.replace('status_', '');
        let newValue = checkbox.checked ? 1 : 0;

        fetch(`/toggle-activation/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                activated: newValue
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Activation status updated successfully');
            }
        })
        .catch(error => console.error('Error updating activation status:', error));
    }
});

    });
  </script>
@endsection
