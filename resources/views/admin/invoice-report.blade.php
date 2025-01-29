@extends('layout.mainlayout_admin')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Invoice Report</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index_admin">Dashboard</a></li>
                        <li class="breadcrumb-item active">Invoice Report</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Filter Form -->
        <div class="row mb-4">
            <div class="col-md-4">
                <form method="GET" action="{{ route('invoice-report') }}">
                    <div class="row">
                        <div class="col-md-6">
                            <select name="month" class="form-control">
                                @foreach (range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select name="year" class="form-control">
                                @foreach (range(date('Y'), date('Y') - 5) as $y)
                                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>						
            </div>
        </div>
        <!-- /Filter Form -->

        <!-- 显示 Ledger 数据 -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatable table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Number</th>
                                        <th>Month</th>
                                        <th>Teacher Name</th>
                                        <th>Classes</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ledgers as $ledger)
                                    <tr>
                                        <td><a href="invoice">{{ $ledger->id }}</a></td>
                                        <td>{{ $ledger->month }}</td>
                                        <td>{{ $ledger->teacher->first_name }} {{ $ledger->teacher->last_name }}</td>
                                        <td>{{ $ledger->total_lessons }}</td>
                                        <td>{{ $ledger->teacher->rate }}</td>
                                        <td>${{ $ledger->total_amount }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-pill {{ $ledger->status == 'paid' ? 'bg-success' : 'bg-warning' }} status-badge" data-id="{{ $ledger->id }}" data-status="{{ $ledger->status }}">
                                                {{ ucfirst($ledger->status) }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <!-- Bank Info 按钮 -->
                                                <a class="btn btn-sm bg-info-light" data-bs-toggle="modal" href="#bank_info_modal_{{ $ledger->teacher->id }}">
                                                    <i class="fe fe-info"></i> Bank Info
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Bank Info Modal -->
                                    <div class="modal fade" id="bank_info_modal_{{ $ledger->teacher->id }}" tabindex="-1" role="dialog" aria-labelledby="bankInfoModalLabel_{{ $ledger->teacher->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="bankInfoModalLabel_{{ $ledger->teacher->id }}">Bank Information for {{ $ledger->teacher->first_name }} {{ $ledger->teacher->last_name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Bank Name:</strong> {{ $ledger->teacher->bank_name }}</p>
                                                    <p><strong>Branch Name:</strong> {{ $ledger->teacher->branch_name }}</p>
                                                    <p><strong>SWIFT Code:</strong> {{ $ledger->teacher->swift_code }}</p>
                                                    <p><strong>Account Number:</strong> {{ $ledger->teacher->account_number }}</p>
                                                    <p><strong>Account Holder Name:</strong> {{ $ledger->teacher->account_holder_name }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Bank Info Modal -->

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>			
        </div>
    </div>			
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.status-badge').forEach(function(element) {
            element.addEventListener('click', function() {
                const ledgerId = this.getAttribute('data-id');
                const currentStatus = this.getAttribute('data-status');

                if (currentStatus !== 'paid') {
                    if (confirm("{{ __('messages.confirm_paid') }}")) {
                        fetch(`/admin/unpaidchange/${ledgerId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ status: 'paid' })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.classList.remove('bg-warning');
                                this.classList.add('bg-success');
                                this.textContent = '{{ __("Paid") }}';
                                this.setAttribute('data-status', 'paid');
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert("{{ __('messages.error_occurred') }}");
                        });
                    }
                }
            });
        });
    });
</script>
@endsection
