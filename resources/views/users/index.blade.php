@extends('layouts.app')

@section('page-title', 'Manage Users')

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
                                <i class="fas fa-users me-3"></i>
                                User Management
                            </h1>
                            <p class="card-text mb-0 opacity-75">
                                Kelola akun pengguna dan hak akses sistem dengan mudah
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="d-flex flex-column align-items-md-end">
                                <div class="mb-2">
                                    <i class="fas fa-shield-alt me-2"></i>
                                    <span>Security Center</span>
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
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body text-white">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-subtitle mb-2 opacity-75">Total Users</h6>
                            <h3 class="card-title mb-0 fw-bold" id="total-users">0</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-users fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <div class="card-body text-white">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-subtitle mb-2 opacity-75">Active Users</h6>
                            <h3 class="card-title mb-0 fw-bold" id="active-users">0</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-user-check fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <div class="card-body text-white">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-subtitle mb-2 opacity-75">Online Now</h6>
                            <h3 class="card-title mb-0 fw-bold" id="online-users">0</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-circle fa-2x opacity-75"></i>
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
                            <a href="{{ route('users.create') }}" class="btn btn-primary btn-lg shadow-sm">
                                <i class="fas fa-user-plus me-2"></i>
                                Add New User
                            </a>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="showInactiveUsers">
                                <label class="form-check-label" for="showInactiveUsers">
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
                        User Filters
                        <button class="btn btn-sm btn-outline-secondary ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#userFilterCollapse">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </h6>
                </div>
                <div class="collapse" id="userFilterCollapse">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label small fw-semibold">Status</label>
                                <select class="form-select" id="filter-status">
                                    <option value="">All Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-semibold">Last Login</label>
                                <select class="form-select" id="filter-login">
                                    <option value="">Any Time</option>
                                    <option value="today">Today</option>
                                    <option value="week">This Week</option>
                                    <option value="month">This Month</option>
                                    <option value="never">Never</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-semibold">Actions</label>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary flex-fill" onclick="applyUserFilters()">
                                        <i class="fas fa-search me-1"></i> Apply
                                    </button>
                                    <button class="btn btn-outline-secondary" onclick="clearUserFilters()">
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
                                User Directory
                            </h5>
                            <p class="card-text text-muted mb-0 small">
                                Complete list of all registered users and their account status
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="users-table" class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAllUsers">
                                        </div>
                                    </th>
                                    <th style="width: 80px;">
                                        <i class="fas fa-key me-1"></i>ID
                                    </th>
                                    <th>
                                        <i class="fas fa-user me-1"></i>User Info
                                    </th>
                                    <th>
                                        <i class="fas fa-envelope me-1"></i>Email
                                    </th>
                                    <th class="text-center">
                                        <i class="fas fa-info-circle me-1"></i>Status
                                    </th>
                                    <th class="text-center">
                                        <i class="fas fa-sign-in-alt me-1"></i>Last Login
                                    </th>
                                    <th class="text-center" style="width: 150px;">
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
    const table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('users.index') }}',
            data: function(d) {
                d.status_filter = $('#filter-status').val();
                d.login_filter = $('#filter-login').val();
                d.show_inactive = $('#showInactiveUsers').is(':checked');
            },
            dataSrc: function(json) {
                updateUserStatistics(json);
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
                        <input class="form-check-input user-checkbox" type="checkbox" value="${data}">
                    </div>`;
                }
            },
            {
                data: 'id',
                className: 'fw-semibold'
            },
            {
                data: 'username',
                render: function(data, type, row) {
                    const avatar = generateUserAvatar(data);
                    const statusDot = row.status === 'active' ? 'bg-success' : 'bg-secondary';
                    return `<div class="d-flex align-items-center">
                        <div class="position-relative me-3">
                            <div class="user-avatar bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                <span class="fw-bold text-primary">${avatar}</span>
                            </div>
                            <span class="position-absolute bottom-0 end-0 p-1 ${statusDot} rounded-circle" style="width: 12px; height: 12px;"></span>
                        </div>
                        <div>
                            <div class="fw-semibold">${data}</div>
                            <small class="text-muted">ID: ${row.id}</small>
                        </div>
                    </div>`;
                }
            },
            {
                data: 'email',
                render: function(data) {
                    return `<a href="mailto:${data}" class="text-decoration-none text-primary">
                        <i class="fas fa-envelope me-2"></i>${data}
                    </a>`;
                }
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
                data: 'last_login',
                render: function(data) {
                    if (!data || data === 'Never') {
                        return `<span class="badge bg-light text-dark px-3 py-2">
                            <i class="fas fa-times me-1"></i>Never
                        </span>`;
                    }

                    const loginDate = new Date(data);
                    const now = new Date();
                    const diffTime = Math.abs(now - loginDate);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                    let badgeClass = 'success';
                    let timeText = '';

                    if (diffDays === 0) {
                        badgeClass = 'success';
                        timeText = 'Today';
                    } else if (diffDays <= 7) {
                        badgeClass = 'warning';
                        timeText = `${diffDays}d ago`;
                    } else {
                        badgeClass = 'secondary';
                        timeText = loginDate.toLocaleDateString('id-ID');
                    }

                    return `<span class="badge bg-${badgeClass} px-3 py-2" title="${loginDate.toLocaleString('id-ID')}">
                        <i class="fas fa-clock me-1"></i>${timeText}
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
                    return `<div class="btn-group" role="group">
                        <button class="btn btn-sm btn-outline-primary" onclick="editUser(${row.id})" title="Edit User">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-info" onclick="viewUser(${row.id})" title="View Details">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger" onclick="deleteUser(${row.id})" title="Delete User">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>`;
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
            const totalCheckboxes = $('.user-checkbox').length;
            const checkedCheckboxes = $('.user-checkbox:checked').length;

            $('#selectAllUsers').prop('indeterminate', checkedCheckboxes > 0 && checkedCheckboxes < totalCheckboxes);
            $('#selectAllUsers').prop('checked', checkedCheckboxes === totalCheckboxes && totalCheckboxes > 0);
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
    $('#selectAllUsers').on('change', function() {
        $('.user-checkbox').prop('checked', $(this).is(':checked'));
    });

    // Individual checkbox change
    $(document).on('change', '.user-checkbox', function() {
        const totalCheckboxes = $('.user-checkbox').length;
        const checkedCheckboxes = $('.user-checkbox:checked').length;

        $('#selectAllUsers').prop('indeterminate', checkedCheckboxes > 0 && checkedCheckboxes < totalCheckboxes);
        $('#selectAllUsers').prop('checked', checkedCheckboxes === totalCheckboxes && totalCheckboxes > 0);
    });

    // Filter functionality
    $('#showInactiveUsers').on('change', function() {
        table.ajax.reload();
    });
});

function generateUserAvatar(username) {
    return username.charAt(0).toUpperCase() + (username.charAt(1) || '').toUpperCase();
}

function updateUserStatistics(json) {
    $('#total-users').text(json.recordsTotal || 0);

    // Calculate statistics from current data
    let activeUsers = 0;
    let onlineUsers = 0;

    if (json.data) {
        json.data.forEach(function(item) {
            if (item.status === 'active') activeUsers++;
            if (item.last_login) {
                const loginDate = new Date(item.last_login);
                const now = new Date();
                const diffTime = Math.abs(now - loginDate);
                const diffMinutes = Math.ceil(diffTime / (1000 * 60));
                if (diffMinutes < 30) onlineUsers++; // Consider online if logged in within 30 minutes
            }
        });
    }

    $('#active-users').text(activeUsers);
    $('#online-users').text(onlineUsers);
}

function applyUserFilters() {
    $('#users-table').DataTable().ajax.reload();

    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'info',
        title: 'User filters applied!',
        showConfirmButton: false,
        timer: 1500
    });
}

function clearUserFilters() {
    $('#filter-status, #filter-login').val('');
    $('#showInactiveUsers').prop('checked', false);
    $('#users-table').DataTable().ajax.reload();

    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'info',
        title: 'Filters cleared!',
        showConfirmButton: false,
        timer: 1500
    });
}

function editUser(userId) {
    window.location.href = `{{ url('/users') }}/${userId}/edit`;
}

function viewUser(userId) {
    window.location.href = `{{ url('/users') }}/${userId}`;
}

function deleteUser(userId) {
    Swal.fire({
        title: 'Delete User?',
        text: 'This action cannot be undone. The user will be permanently removed from the system.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-trash me-1"></i> Yes, delete',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Here you would send DELETE request
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'User deleted successfully!',
                showConfirmButton: false,
                timer: 2000
            });

            $('#users-table').DataTable().ajax.reload();
        }
    });
}

// Animation on page load
$(document).ready(function() {
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
</script>

<style>
/* User avatar styling */
.user-avatar {
    font-size: 14px;
    font-weight: 600;
}

/* Status dot animation */
.position-absolute.rounded-circle {
    animation: pulse-dot 2s infinite;
}

@keyframes pulse-dot {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
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

/* Badge hover effects */
.badge {
    transition: all 0.3s ease;
    cursor: help;
}

.badge:hover {
    transform: scale(1.05);
}

/* Button group styling */
.btn-group .btn {
    transition: all 0.3s ease;
    border-radius: 8px;
    margin: 0 1px;
}

.btn-group .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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

/* Filter section styling */
.collapse {
    transition: all 0.3s ease;
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

    .user-avatar {
        width: 35px !important;
        height: 35px !important;
        font-size: 12px !important;
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

/* Email link styling */
a[href^="mailto:"]:hover {
    text-decoration: underline !important;
    transform: translateX(2px);
    transition: all 0.3s ease;
}
</style>
@endsection
