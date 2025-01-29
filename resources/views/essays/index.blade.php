@extends('layout.mainlayout')

@section('styles')
<style>
    /* DataTables 客製化樣式 */
    .dataTables_wrapper {
        background: white;
        border-radius: 8px;
        padding: 20px;
        margin: 40px 0;  /* 增加上下間距 */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .dataTables_length select {
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 6px 36px 6px 12px;
        background-color: white;
        margin: 0 8px;
    }

    .dataTables_filter input {
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 6px 12px;
        min-width: 200px;
        margin-left: 8px;
    }

    table.dataTable {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }

    table.dataTable thead th {
        background-color: #f8fafc;
        padding: 12px !important;
        border-bottom: 2px solid #e2e8f0;
        font-weight: 600;
        color: #1a202c;
        text-align: center; /* 表頭文字置中 */
    }

    table.dataTable tbody td {
        padding: 8px 12px !important;
        border-bottom: 1px solid #e2e8f0;
        color: #4a5568;
        vertical-align: middle;
        text-align: center; /* 表格內容文字置中 */
    }

    table.dataTable tbody tr:hover {
        background-color: #f7fafc;
    }

    .status-badge {
        padding: 4px 12px;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
    }

    .status-badge.completed {
        background-color: #def7ec;
        color: #046c4e;
    }

    .status-badge.pending {
        background-color: #fef3c7;
        color: #92400e;
    }

    .action-button {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        background-color: #0d6efd;
        color: white;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.2s;
        font-size: 0.875rem;
        margin-right: 4px;
    }

    .action-button:hover {
        background-color: #0b5ed7;
        transform: translateY(-1px);
    }

    .delete-button {
        background-color: #dc3545;
    }

    .delete-button:hover {
        background-color: #bb2d3b;
    }

    .action-button svg {
        width: 14px;
        height: 14px;
        margin-right: 6px;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .dataTables_paginate {
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;
        gap: 4px;
    }

    .dataTables_paginate .paginate_button {
        padding: 8px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        background: white;
        color: #4a5568 !important;
        cursor: pointer;
        transition: all 0.2s;
    }

    .dataTables_paginate .paginate_button:hover {
        background-color: #f7fafc !important;
        border-color: #cbd5e0;
    }

    .dataTables_paginate .paginate_button.current {
        background-color: #0d6efd !important;
        border-color: #0d6efd;
        color: white !important;
    }
</style>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">{{ __('essays.title.list') }}</h1>
                <a href="{{ route('essays.create') }}" class="action-button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    {{ __('essays.title.create') }}
                </a>
            </div>

            <div class="overflow-x-auto">
                <table id="essaysTable" class="min-w-full">
                    <thead>
                        <tr>
                            <th>{{ __('essays.labels.title') }}</th>
                            <th>{{ __('essays.labels.word_count') }}</th>
                            <th>{{ __('essays.labels.submit_time') }}</th>
                            <th>{{ __('essays.labels.status') }}</th>
                            <th>{{ __('essays.labels.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($essays as $essay)
                        <tr>
                            <td>{{ $essay->title }}</td>
                            <td>{{ $essay->word_count }}</td>
                            <td>{{ $essay->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                @if($essay->correction)
                                <span class="status-badge completed">{{ __('essays.status.completed') }}</span>
                                @else
                                <span class="status-badge pending">{{ __('essays.status.pending') }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('essays.show', $essay) }}" class="action-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        {{ __('essays.buttons.view') }}
                                    </a>
                                    <form action="{{ route('essays.destroy', $essay) }}" method="POST" class="inline" 
                                          onsubmit="return confirm('{{ __('essays.messages.delete_confirm') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-button delete-button">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            {{ __('essays.buttons.delete') }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-12">
                                <div class="flex flex-col items-center justify-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <p class="text-lg font-medium">{{ __('essays.messages.no_essays') }}</p>
                                    <p class="text-sm mt-2">{{ __('essays.messages.start_writing') }}</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#essaysTable').DataTable({
        language: {
            "processing": "{{ __('datatable.processing') }}",
            "loadingRecords": "{{ __('datatable.loading') }}",
            "lengthMenu": "{{ __('datatable.length_menu') }}",
            "zeroRecords": "{{ __('datatable.zero_records') }}",
            "info": "{{ __('datatable.info') }}",
            "infoEmpty": "{{ __('datatable.info_empty') }}",
            "infoFiltered": "{{ __('datatable.info_filtered') }}",
            "search": "{{ __('datatable.search') }}",
            "paginate": {
                "first": "{{ __('datatable.first') }}",
                "previous": "{{ __('datatable.previous') }}",
                "next": "{{ __('datatable.next') }}",
                "last": "{{ __('datatable.last') }}"
            }
        },
        pageLength: 10,
        order: [[2, 'desc']],
        responsive: true,
        dom: '<"flex flex-col md:flex-row justify-between items-center mb-4"lf>rt<"flex flex-col md:flex-row justify-between items-center mt-4"ip>',
    });
});
</script>
@endsection 