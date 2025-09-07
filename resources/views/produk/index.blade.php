@extends('layouts.app')

@section('page-title', 'Manage Products')

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
                                <i class="fas fa-boxes me-3"></i>
                                Product Management
                            </h1>
                            <p class="card-text mb-0 opacity-75">
                                Kelola inventori dan data produk dengan mudah
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="d-flex flex-column align-items-md-end">
                                <div class="mb-2">
                                    <i class="fas fa-warehouse me-2"></i>
                                    <span>Inventory System</span>
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

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body text-dark">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-subtitle mb-2 opacity-75">Total Products</h6>
                            <h3 class="card-title mb-0 fw-bold" id="total-products">0</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-box fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <div class="card-body text-dark">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-subtitle mb-2 opacity-75">Active Products</h6>
                            <h3 class="card-title mb-0 fw-bold" id="active-products">0</h3>
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
                <div class="card-body text-dark">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-subtitle mb-2 opacity-75">Low Stock</h6>
                            <h3 class="card-title mb-0 fw-bold" id="low-stock">0</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-exclamation-triangle fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);">
                <div class="card-body text-dark">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-subtitle mb-2 opacity-75">Total Value</h6>
                            <h3 class="card-title mb-0 fw-bold" id="total-inventory-value">Rp 0</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-money-bill-wave fa-2x opacity-75"></i>
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
                            <a href="{{ route('produks.create') }}" class="btn btn-primary btn-lg shadow-sm">
                                <i class="fas fa-plus-circle me-2"></i>
                                Add New Product
                            </a>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="showInactiveProducts">
                                <label class="form-check-label" for="showInactiveProducts">
                                    Show Inactive
                                </label>
                            </div>
                            <span class="badge bg-light text-dark px-3 py-2 fs-6">
                                <i class="fas fa-database me-2"></i>
                                Records: <span id="total-records">-</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-header bg-light border-0" style="border-radius: 15px 15px 0 0;">
                    <h6 class="mb-0">
                        <i class="fas fa-filter me-2"></i>
                        Advanced Filters
                        <button class="btn btn-sm btn-outline-secondary ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </h6>
                </div>
                <div class="collapse" id="filterCollapse">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label small fw-semibold">Status</label>
                                <select class="form-select" id="filter-status">
                                    <option value="">All Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-semibold">Stock Range</label>
                                <select class="form-select" id="filter-stock">
                                    <option value="">All Stock</option>
                                    <option value="low">Low Stock (< 10)</option>
                                    <option value="medium">Medium Stock (10-50)</option>
                                    <option value="high">High Stock (> 50)</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-semibold">Price Range</label>
                                <select class="form-select" id="filter-price">
                                    <option value="">All Prices</option>
                                    <option value="0-50000">< Rp 50,000</option>
                                    <option value="50000-200000">Rp 50,000 - 200,000</option>
                                    <option value="200000-999999999">> Rp 200,000</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-semibold">Actions</label>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary flex-fill" onclick="applyFilters()">
                                        <i class="fas fa-search me-1"></i> Apply
                                    </button>
                                    <button class="btn btn-outline-secondary" onclick="clearFilters()">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 20px;">
                <div class="card-header bg-white border-0 py-4" style="border-radius: 20px 20px 0 0;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title mb-1 fw-bold">
                                <i class="fas fa-table me-2 text-primary"></i>
                                Product Catalog
                            </h5>
                            <p class="card-text text-muted mb-0 small">
                                Comprehensive list of all products in inventory
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="produks-table" class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAll">
                                        </div>
                                    </th>
                                    <th style="width: 80px;">
                                        <i class="fas fa-key me-1"></i>ID
                                    </th>
                                    <th>
                                        <i class="fas fa-barcode me-1"></i>SKU
                                    </th>
                                    <th>
                                        <i class="fas fa-box me-1"></i>Product Name
                                    </th>
                                    <th class="text-end">
                                        <i class="fas fa-dollar-sign me-1"></i>HPP
                                    </th>
                                    <th class="text-center">
                                        <i class="fas fa-cubes me-1"></i>Stock
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

<script>
$(document).ready(function() {
    // Initialize DataTable
    const table = $('#produks-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('produks.index') }}',
            data: function(d) {
                d.status_filter = $('#filter-status').val();
                d.stock_filter = $('#filter-stock').val();
                d.price_filter = $('#filter-price').val();
                d.show_inactive = $('#showInactiveProducts').is(':checked');
            },
            dataSrc: function(json) {
                updateStatistics(json);
                return json.data;
            }
        },
        columns: [
            {
                data: 'id',
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: function(data) {
                    return `<div class="form-check">
                        <input class="form-check-input row-checkbox" type="checkbox" value="${data}">
                    </div>`;
                }
            },
            { data: 'id', className: 'fw-semibold' },
            {
                data: 'sku',
                render: function(data) {
                    return `<span class="badge bg-light text-dark px-3 py-2 fs-6 font-monospace">${data || '-'}</span>`;
                }
            },
            {
                data: 'nama_produk',
                render: function(data, type, row) {
                    return `<div class="d-flex align-items-center">
                        <div class="product-avatar me-3">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-2">
                                <i class="fas fa-box text-primary"></i>
                            </div>
                        </div>
                        <div>
                            <div class="fw-semibold">${data || '-'}</div>
                            <small class="text-muted">ID: ${row.id || '-'}</small>
                        </div>
                    </div>`;
                }
            },
            {
                data: 'hpp',
                render: function(data) {
                    return `<span class="fw-bold text-success">Rp ${parseFloat(data || 0).toLocaleString('id-ID')}</span>`;
                },
                className: 'text-end'
            },
            {
                data: 'stok',
                render: function(data) {
                    let badgeClass = 'success';
                    let icon = 'check-circle';
                    const stock = parseInt(data) || 0;

                    if (stock < 10) {
                        badgeClass = 'danger';
                        icon = 'exclamation-triangle';
                    } else if (stock < 50) {
                        badgeClass = 'warning';
                        icon = 'exclamation-circle';
                    }

                    return `<span class="badge bg-${badgeClass} px-3 py-2">
                        <i class="fas fa-${icon} me-1"></i>
                        ${stock}
                    </span>`;
                },
                className: 'text-center'
            },
            {
                data: 'status',
                render: function(data) {
                    const statusConfig = {
                        'active': { class: 'success', icon: 'check-circle', text: 'Active' },
                        'inactive': { class: 'secondary', icon: 'pause-circle', text: 'Inactive' }
                    };
                    const config = statusConfig[data] || statusConfig['inactive'];
                    return `<span class="badge bg-${config.class} px-3 py-2">
                        <i class="fas fa-${config.icon} me-1"></i>
                        ${config.text}
                    </span>`;
                },
                className: 'text-center'
            },
            {
                data: 'id',
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: function(data) {
                    const editUrl = `/produks/${data}/edit`;
                    const destroyUrl = `/produks/${data}`;
                    return `
                        <div class="btn-group" role="group">
                            <a href="${editUrl}" class="btn btn-sm btn-outline-primary" title="Edit Product">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="${destroyUrl}" method="POST" class="d-inline" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Product" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
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

            // Update select all checkbox
            const totalCheckboxes = $('.row-checkbox').length;
            const checkedCheckboxes = $('.row-checkbox:checked').length;

            $('#selectAll').prop('indeterminate', checkedCheckboxes > 0 && checkedCheckboxes < totalCheckboxes);
            $('#selectAll').prop('checked', checkedCheckboxes === totalCheckboxes && totalCheckboxes > 0);
        }
    });

    // Update current time
    function updateTime() {
        const now = new Date();
        document.getElementById('current-time').textContent = now.toLocaleTimeString('id-ID');
    }
    updateTime();
    setInterval(updateTime, 1000);

    // Select all functionality
    $('#selectAll').on('change', function() {
        $('.row-checkbox').prop('checked', $(this).is(':checked'));
    });

    // Individual checkbox change
    $(document).on('change', '.row-checkbox', function() {
        const totalCheckboxes = $('.row-checkbox').length;
        const checkedCheckboxes = $('.row-checkbox:checked').length;

        $('#selectAll').prop('indeterminate', checkedCheckboxes > 0 && checkedCheckboxes < totalCheckboxes);
        $('#selectAll').prop('checked', checkedCheckboxes === totalCheckboxes && totalCheckboxes > 0);
    });

    // Filter functionality
    $('#showInactiveProducts').on('change', function() {
        table.ajax.reload();
    });

    // Animation on page load
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
    $('#total-products').text(json.recordsTotal || 0);

    let activeProducts = 0;
    let lowStock = 0;
    let totalValue = 0;

    if (json.data) {
        json.data.forEach(function(item) {
            if (item.status === 'active') activeProducts++;
            if (parseInt(item.stok) < 10) lowStock++;
            totalValue += parseFloat(item.hpp || 0) * parseInt(item.stok || 0);
        });
    }

    $('#active-products').text(activeProducts);
    $('#low-stock').text(lowStock);
    $('#total-inventory-value').text('Rp ' + totalValue.toLocaleString('id-ID'));
}

function applyFilters() {
    $('#produks-table').DataTable().ajax.reload();

    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'info',
        title: 'Filters applied!',
        showConfirmButton: false,
        timer: 1500
    });
}

function clearFilters() {
    $('#filter-status, #filter-stock, #filter-price').val('');
    $('#showInactiveProducts').prop('checked', false);
    $('#produks-table').DataTable().ajax.reload();

    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'info',
        title: 'Filters cleared!',
        showConfirmButton: false,
        timer: 1500
    });
}
</script>

<style>
/* Product avatar styling */
.product-avatar {
    width: 40px;
    height: 40px;
}

/* Enhanced table styling */
.table thead th {
    font-weight: 600;
    font-size: 0.9rem;
    color: #374151;
    background-color: #f8fafc !important;
}

.table tbody tr:hover {
    background-color: rgba(102, 126, 234, 0.05) !important;
    transform: scale(1.001);
    transition: all 0.2s ease;
}

/* Filter section styling */
.collapse {
    transition: all 0.3s ease;
}

/* Custom checkbox styling */
.form-check-input:checked {
    background-color: #4338ca;
    border-color: #4338ca;
}

.form-check-input:focus {
    border-color: #4338ca;
    box-shadow: 0 0 0 0.25rem rgba(67, 56, 202, 0.25);
}

/* Badge animations */
.badge {
    transition: all 0.3s ease;
    cursor: help;
}

.badge:hover {
    transform: scale(1.05);
}

/* Action button improvements */
.btn-group .btn {
    transition: all 0.3s ease;
    border-radius: 8px;
    margin: 0 1px;
}

.btn-group .btn:hover {
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

/* Enhanced form styling */
.form-select:focus,
.form-control:focus {
    border-color: #4338ca;
    box-shadow: 0 0 0 0.25rem rgba(67, 56, 202, 0.15);
}

/* Responsive improvements */
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

    .product-avatar {
        width: 35px !important;
        height: 35px !important;
    }
}

/* DataTables custom styling */
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: linear-gradient(135deg, #4338ca 0%, #7c3aed 100%) !important;
    color: white !important;
    border-radius: 8px !important;
    border: none !important;
    box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1) !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #f3f4f6 !important;
    color: #374151 !important;
    border: none !important;
    border-radius: 8px !important;
    transform: translateY(-1px);
}

.dataTables_wrapper .dataTables_length select,
.dataTables_wrapper .dataTables_filter input {
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    transition: all 0.3s ease;
}
</style>
@endsection
