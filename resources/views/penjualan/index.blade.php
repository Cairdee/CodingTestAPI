@extends('layouts.app')

@section('page-title', 'Manage Penjualan')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-gradient shadow-sm" style="background: linear-gradient(135deg, #4338ca 0%, #7c3aed 100%); border-radius: 20px;">
                <div class="card-body text-white py-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="card-title mb-2 fw-bold">
                                <i class="fas fa-shopping-cart me-3"></i>
                                Manage Penjualan
                            </h1>
                            <p class="card-text mb-0 opacity-75">
                                Kelola data penjualan dan transaksi bisnis Anda
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="d-flex flex-column align-items-md-end">
                                <div class="mb-2">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    <span>{{ date('d F Y') }}</span>
                                </div>
                                <div class="small opacity-75">
                                    <i class="fas fa-clock me-2"></i>
                                    <span id="current-time"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 20px;">
                <div class="card-body py-3">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('penjualans.create') }}" class="btn btn-primary btn-lg shadow-sm">
                                <i class="fas fa-plus-circle me-2"></i>
                                Create Head Penjualan
                            </a>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-light text-dark px-3 py-2 fs-6">
                                <i class="fas fa-database me-2"></i>
                                Total Records: <span id="total-records">-</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body text-white">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-subtitle mb-2 opacity-75">Total Penjualan</h6>
                            <h3 class="card-title mb-0 fw-bold" id="total-sales">0</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-shopping-cart fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <div class="card-body text-white">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-subtitle mb-2 opacity-75">Completed</h6>
                            <h3 class="card-title mb-0 fw-bold" id="completed-sales">0</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-check-circle fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <div class="card-body text-white">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-subtitle mb-2 opacity-75">Pending</h6>
                            <h3 class="card-title mb-0 fw-bold" id="pending-sales">0</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-hourglass-half fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);">
                <div class="card-body text-white">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-subtitle mb-2 opacity-75">Total Nilai</h6>
                            <h3 class="card-title mb-0 fw-bold" id="total-value">Rp 0</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-money-bill-wave fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 20px;">
                <div class="card-header bg-white border-0 py-4" style="border-radius: 20px 20px 0 0;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title mb-1 fw-bold">
                                <i class="fas fa-table me-2 text-primary"></i>
                                Data Penjualan
                            </h5>
                            <p class="card-text text-muted mb-0 small">
                                Daftar semua transaksi penjualan
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="penjualans-table" class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 60px;">
                                        <i class="fas fa-hashtag"></i>
                                    </th>
                                    <th style="width: 80px;">
                                        <i class="fas fa-key me-1"></i>ID
                                    </th>
                                    <th>
                                        <i class="fas fa-receipt me-1"></i>Nomer Penjualan
                                    </th>
                                    <th>
                                        <i class="fas fa-calendar me-1"></i>Tanggal
                                    </th>
                                    <th>
                                        <i class="fas fa-money-bill me-1"></i>Total Nilai
                                    </th>
                                    <th class="text-center">
                                        <i class="fas fa-info-circle me-1"></i>Status
                                    </th>
                                    <th class="text-center" style="width: 100px;">
                                        <i class="fas fa-cogs me-1"></i>Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be loaded by DataTables -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<script>Swal.fire('Success', '{{ session('success') }}', 'success');</script>
@endif
@if(session('error'))
<script>Swal.fire('Error', '{{ session('error') }}', 'error');</script>
@endif

<script>
$(document).ready(function() {
    // Initialize DataTable
    const table = $('#penjualans-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('penjualans.index') }}',
            dataSrc: function(json) {
                updateStatistics(json);
                return json.data;
            }
        },
        columns: [
            {
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false,
                className: 'text-center fw-bold'
            },
            {
                data: 'id',
                className: 'fw-semibold'
            },
            {
                data: 'nomer_penjualan',
                render: function(data) {
                    return `<span class="badge bg-light text-dark px-3 py-2 fs-6">${data}</span>`;
                }
            },
            {
                data: 'tgl_penjualan',
                render: function(data) {
                    const date = new Date(data);
                    return `<span class="text-muted">${date.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric'
                    })}</span>`;
                }
            },
            {
                data: 'total_nilai_penjualan',
                render: function(data) {
                    return `<span class="fw-bold text-success">Rp ${parseInt(data).toLocaleString('id-ID')}</span>`;
                },
                className: 'text-end'
            },
            {
                data: 'status',
                render: function(data) {
                    const statusConfig = {
                        'completed': { class: 'success', icon: 'check-circle', text: 'Completed' },
                        'pending': { class: 'warning', icon: 'hourglass-half', text: 'Pending' }
                    };
                    const config = statusConfig[data] || statusConfig['pending'];
                    return `<span class="badge bg-${config.class} px-3 py-2">
                        <i class="fas fa-${config.icon} me-1"></i>
                        ${config.text}
                    </span>`;
                },
                className: 'text-center'
            },
            {
    data: 'action',
    orderable: false,
    searchable: false,
    className: 'text-center',
    render: function(data, type, row) {
        // Bangun URL secara dinamis
        const url = '/penjualans/' + encodeURIComponent(row.nomer_penjualan || '');
        return `
            <a href="${url}" class="btn btn-sm btn-info me-1">
                <i class="fas fa-eye"></i> View
            </a>
        `;
    }
}
        ],
        order: [[1, 'desc']],
        pageLength: 10,
        responsive: true,
        language: {
            processing: '<div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>',
            search: '<i class="fas fa-search me-2"></i>',
            lengthMenu: 'Show _MENU_ entries per page',
            info: 'Showing _START_ to _END_ of _TOTAL_ entries',
            paginate: {
                first: '<i class="fas fa-angle-double-left"></i>',
                previous: '<i class="fas fa-angle-left"></i>',
                next: '<i class="fas fa-angle-right"></i>',
                last: '<i class="fas fa-angle-double-right"></i>'
            }
        },
        drawCallback: function(settings) {
            $('#total-records').text(settings._iRecordsTotal);
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    });

    // Update current time
    function updateTime() {
        const now = new Date();
        document.getElementById('current-time').textContent = now.toLocaleTimeString('id-ID');
    }
    updateTime();
    setInterval(updateTime, 1000);

    // Page load animation
    $('.card').each(function(index) {
        $(this).css({
            'opacity': '0',
            'transform': 'translateY(20px)'
        });
        $(this).delay(index * 100).animate({
            opacity: 1
        }, 600, function() {
            $(this).css('transform', 'translateY(0)');
        });
    });
});

function updateStatistics(json) {
    $('#total-sales').text(json.recordsTotal || 0);
    let completed = 0;
    let pending = 0;
    let totalValue = 0;

    if (json.data) {
        json.data.forEach(function(item) {
            if (item.status === 'completed') completed++;
            if (item.status === 'pending') pending++;
            totalValue += parseInt(item.total_nilai_penjualan || 0);
        });
    }

    $('#completed-sales').text(completed);
    $('#pending-sales').text(pending);
    $('#total-value').text('Rp ' + totalValue.toLocaleString('id-ID'));
}
</script>

<style>
/* DataTables styling */
.dataTables_wrapper .dataTables_length select,
.dataTables_wrapper .dataTables_filter input {
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    padding: 0.5rem 0.75rem;
    transition: all 0.3s ease;
}

.dataTables_wrapper .dataTables_length select:focus,
.dataTables_wrapper .dataTables_filter input:focus {
    border-color: #4338ca;
    box-shadow: 0 0 0 0.25rem rgba(67, 56, 202, 0.15);
    outline: none;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    border: none !important;
    border-radius: 8px !important;
    margin: 0 2px !important;
    padding: 0.5rem 0.75rem !important;
    background: transparent !important;
    color: #6b7280 !important;
    transition: all 0.3s ease !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #f3f4f6 !important;
    color: #374151 !important;
    transform: translateY(-1px);
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: linear-gradient(135deg, #4338ca 0%, #7c3aed 100%) !important;
    color: white !important;
    font-weight: 600 !important;
    box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1) !important;
}

/* Table hover effect */
.table-hover tbody tr:hover {
    background-color: rgba(67, 56, 202, 0.05) !important;
    transform: scale(1.001);
    transition: all 0.2s ease;
}

/* Badge styling */
.badge {
    transition: all 0.3s ease;
    cursor: help;
}

.badge:hover {
    transform: scale(1.05);
}

/* Action button styling */
.btn-group .btn, .btn {
    transition: all 0.3s ease;
    border-radius: 8px;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Loading states */
.table-loading {
    position: relative;
    overflow: hidden;
}

.table-loading::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(67, 56, 202, 0.1), transparent);
    animation: loading-shimmer 1.5s infinite;
}

@keyframes loading-shimmer {
    0% { left: -100%; }
    100% { left: 100%; }
}

/* Statistics card hover effects */
.card:hover .card-body i {
    transform: scale(1.1) rotate(5deg);
    transition: transform 0.3s ease;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .card-body {
        padding: 1rem;
    }

    .btn-lg {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }

    .d-flex.gap-2 {
        flex-direction: column;
        gap: 0.5rem !important;
    }

    .table-responsive {
        font-size: 0.875rem;
    }
}
</style>
@endsection
