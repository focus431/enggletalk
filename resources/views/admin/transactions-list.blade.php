@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Transactions</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index_admin">Dashboard</a></li>
                        <li class="breadcrumb-item active">Transactions</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatable table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Number</th>
                                        <th>Order Date</th>
                                        <th>Name</th>
                                        <th>Classes</th>
                                        <th>Amount</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td><a href="invoice">#{{ $order->id }}</a></td>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i') }}</td>
                                        <td>{{ $order->last_name }} {{ $order->first_name }}</td>
                                        <td>{{ $order->lessons }} Classes</td>
                                        <td>${{ $order->price }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm {{ $order->status == 'Pending' ? 'btn-warning' : ($order->status == 'Confirmed' ? 'btn-success' : 'btn-danger') }}">
                                                {{ $order->status }}
                                            </button>
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary">Action</button>
                                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#" onclick="updateOrderStatus({{ $order->id }}, 'Pending')">Pending</a>
                                                    <a class="dropdown-item" href="#" onclick="updateOrderStatus({{ $order->id }}, 'Confirmed', true)">Confirmed</a>
                                                    <a class="dropdown-item" href="#" onclick="updateOrderStatus({{ $order->id }}, 'Reject')">Reject</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#" onclick="showPaymentProof('{{ $order->payment_proof }}')">Proof</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="edit_invoice_report" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Invoice</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form and input fields for editing -->
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Proof Modal -->
                                    <div class="modal fade" id="proof_modal" tabindex="-1" aria-labelledby="proofModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="proofModalLabel">Payment Proof</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img id="payment_proof_img" src="" alt="Payment Proof" class="img-fluid">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>          
        </div>
    </div>          
</div>
<!-- /Page Wrapper -->
@endsection

@section('scripts')
<script>
// 确保 CSRF Token 可以从 meta 标签中获取
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// 定义 updateOrderStatus 函数在全局作用域
function updateOrderStatus(orderId, status, sendEmail = false) {
    fetch('/admin/update-order-status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ id: orderId, status: status, sendEmail: sendEmail })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        console.log('Success:', data);
        alert('Order status updated successfully!');
        setTimeout(() => {
            location.reload(); // 重新加载页面以反映状态变化
        }, 500); // 延迟 0.5 秒
    })
    .catch((error) => {
        console.error('Error:', error);
        alert('Error updating order status.');
    });
}



// 定义 showPaymentProof 函数在全局作用域
function showPaymentProof(proofPath) {
    const path = proofPath.replace('public/', '');
    document.getElementById('payment_proof_img').src = `/storage/${path}`;
    var proofModal = new bootstrap.Modal(document.getElementById('proof_modal'));
    proofModal.show();
}
</script>
@endsection
