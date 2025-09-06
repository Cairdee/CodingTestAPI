@extends('layouts.app')

@section('page-title', 'Create Head Penjualan')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('penjualans.index') }}" class="text-decoration-none">
                            <i class="fas fa-shopping-cart me-1"></i>Penjualan
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Create Head Penjualan</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-gradient shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px;">
                <div class="card-body text-white py-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="card-title mb-2 fw-bold">
                                <i class="fas fa-plus-circle me-3"></i>
                                Create Head Penjualan
                            </h1>
                            <p class="card-text mb-0 opacity-75">
                                Buat transaksi penjualan baru dengan data yang akurat
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

    <!-- Form Section -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <div class="card shadow-lg border-0" style="border-radius: 25px;">
                <!-- Form Header -->
                <div class="card-header bg-white border-0 text-center py-4" style="border-radius: 25px 25px 0 0;">
                    <div class="form-icon mx-auto mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-file-invoice-dollar fa-2x text-white"></i>
                    </div>
                    <h4 class="card-title mb-1 fw-bold text-dark">Form Penjualan</h4>
                    <p class="card-text text-muted small mb-0">Isi data penjualan dengan lengkap dan benar</p>
                </div>

                <!-- Form Body -->
                <div class="card-body p-4">
                    <form action="{{ route('penjualans.createHead') }}" method="POST" id="penjualanForm">
                        @csrf

                        <!-- Tanggal Penjualan -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                Tanggal Penjualan
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text border-0 bg-light">
                                    <i class="fas fa-calendar text-muted"></i>
                                </span>
                                <input type="date"
                                       name="tgl_penjualan"
                                       class="form-control border-0 bg-light @error('tgl_penjualan') is-invalid @enderror"
                                       value="{{ old('tgl_penjualan', date('Y-m-d')) }}"
                                       max="{{ date('Y-m-d') }}"
                                       required
                                       style="border-radius: 0 15px 15px 0;">
                            </div>
                            @error('tgl_penjualan')
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted mt-1">
                                <i class="fas fa-info-circle me-1"></i>
                                Pilih tanggal transaksi penjualan
                            </small>
                        </div>

                        <!-- Status -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-info-circle me-2 text-primary"></i>
                                Status Penjualan
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text border-0 bg-light">
                                    <i class="fas fa-flag text-muted"></i>
                                </span>
                                <select name="status"
                                        class="form-control border-0 bg-light @error('status') is-invalid @enderror"
                                        required
                                        style="border-radius: 0 15px 15px 0;">
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>
                                        <i class="fas fa-check-circle"></i> Completed
                                    </option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>
                                        <i class="fas fa-hourglass-half"></i> Pending
                                    </option>
                                </select>
                            </div>
                            @error('status')
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted mt-1">
                                <i class="fas fa-info-circle me-1"></i>
                                Status menentukan apakah transaksi sudah selesai atau masih dalam proses
                            </small>
                        </div>

                        <!-- Preview Section -->
                        <div class="alert alert-light border-0 shadow-sm mb-4" style="border-radius: 15px; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);">
                            <h6 class="alert-heading mb-3">
                                <i class="fas fa-eye me-2 text-info"></i>
                                Preview Data
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar text-primary me-2"></i>
                                        <small class="text-muted">Tanggal:</small>
                                        <span class="ms-2 fw-semibold" id="preview-date">-</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-flag text-success me-2"></i>
                                        <small class="text-muted">Status:</small>
                                        <span class="ms-2 fw-semibold" id="preview-status">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 justify-content-between align-items-center">
                            <a href="{{ route('penjualans.index') }}"
                               class="btn btn-light btn-lg px-4 py-3 border-2"
                               style="border-radius: 15px; border-color: #e2e8f0;">
                                <i class="fas fa-arrow-left me-2"></i>
                                Kembali
                            </a>

                            <div class="d-flex gap-2">
                                <button type="button"
                                        class="btn btn-outline-secondary btn-lg px-4 py-3"
                                        onclick="resetForm()"
                                        style="border-radius: 15px;">
                                    <i class="fas fa-undo me-2"></i>
                                    Reset
                                </button>

                                <button type="submit"
                                        class="btn btn-primary btn-lg px-4 py-3 shadow-sm"
                                        style="border-radius: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;"
                                        id="submitBtn">
                                    <i class="fas fa-save me-2"></i>
                                    Simpan Data
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Form Footer -->
                <div class="card-footer bg-light border-0 text-center py-3" style="border-radius: 0 0 25px 25px;">
                    <small class="text-muted">
                        <i class="fas fa-shield-alt me-1"></i>
                        Data Anda akan disimpan dengan aman
                    </small>
                </div>
            </div>
        </div>

        <!-- Info Panel -->
        <div class="col-lg-4 col-xl-4">
            <div class="sticky-top" style="top: 2rem;">
                <!-- Tips Card -->
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                    <div class="card-header bg-primary text-white border-0" style="border-radius: 20px 20px 0 0; background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-lightbulb me-2"></i>
                            Tips Pengisian
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="bg-success bg-opacity-10 rounded-circle p-2">
                                    <i class="fas fa-calendar text-success"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-1">Tanggal Penjualan</h6>
                                <small class="text-muted">Pastikan tanggal sesuai dengan waktu transaksi yang sebenarnya</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0 me-3">
                                <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                                    <i class="fas fa-flag text-warning"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-1">Status Penjualan</h6>
                                <small class="text-muted">Completed untuk transaksi selesai, Pending untuk yang masih diproses</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                    <div class="card-header bg-info text-white border-0" style="border-radius: 20px 20px 0 0; background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%) !important;">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-chart-pie me-2"></i>
                            Statistik Hari Ini
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3 text-center">
                            <div class="col-6">
                                <div class="p-3 rounded" style="background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);">
                                    <h4 class="text-primary mb-1" id="today-sales">0</h4>
                                    <small class="text-muted">Penjualan</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 rounded" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);">
                                    <h4 class="text-success mb-1" id="today-value">Rp 0</h4>
                                    <small class="text-muted">Total Nilai</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Update current time
    function updateTime() {
        const now = new Date();
        document.getElementById('current-time').textContent = now.toLocaleTimeString('id-ID');
    }
    updateTime();
    setInterval(updateTime, 1000);

    // Real-time preview update
    function updatePreview() {
        const tanggal = $('input[name="tgl_penjualan"]').val();
        const status = $('select[name="status"]').val();

        // Update tanggal preview
        if (tanggal) {
            const date = new Date(tanggal);
            $('#preview-date').text(date.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            }));
        } else {
            $('#preview-date').text('-');
        }

        // Update status preview
        if (status) {
            const statusText = status.charAt(0).toUpperCase() + status.slice(1);
            const statusClass = status === 'completed' ? 'text-success' : 'text-warning';
            $('#preview-status').html(`<span class="${statusClass}">${statusText}</span>`);
        } else {
            $('#preview-status').text('-');
        }
    }

    // Bind events for real-time preview
    $('input[name="tgl_penjualan"], select[name="status"]').on('change input', updatePreview);

    // Initial preview update
    updatePreview();

    // Form validation
    $('#penjualanForm').on('submit', function(e) {
        const submitBtn = $('#submitBtn');
        const originalText = submitBtn.html();

        // Disable button and show loading
        submitBtn.prop('disabled', true);
        submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...');

        // Basic validation
        let isValid = true;
        const tanggal = $('input[name="tgl_penjualan"]').val();
        const status = $('select[name="status"]').val();

        if (!tanggal) {
            isValid = false;
            showValidationError('Tanggal penjualan harus diisi');
        }

        if (!status) {
            isValid = false;
            showValidationError('Status penjualan harus dipilih');
        }

        if (!isValid) {
            e.preventDefault();
            submitBtn.prop('disabled', false);
            submitBtn.html(originalText);
            return false;
        }

        // Show success message (will be overridden by server response)
        setTimeout(() => {
            if (!window.location.href.includes('error')) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Data sedang disimpan...',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        }, 100);
    });

    // Load today's statistics (you can implement this with AJAX)
    loadTodayStats();
});

function resetForm() {
    Swal.fire({
        title: 'Reset Form?',
        text: 'Semua data yang telah diisi akan dihapus',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Reset',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('penjualanForm').reset();
            $('input[name="tgl_penjualan"]').val('{{ date('Y-m-d') }}');
            updatePreview();

            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Form berhasil direset',
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
}

function showValidationError(message) {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'error',
        title: message,
        showConfirmButton: false,
        timer: 3000
    });
}

function loadTodayStats() {
    // You can implement AJAX call to get today's statistics
    // For now, we'll use placeholder data
    $('#today-sales').text('12');
    $('#today-value').text('Rp 2.450.000');

    // Example AJAX implementation:
    /*
    $.ajax({
        url: '/api/today-stats',
        method: 'GET',
        success: function(data) {
            $('#today-sales').text(data.sales_count);
            $('#today-value').text('Rp ' + data.total_value.toLocaleString('id-ID'));
        }
    });
    */
}

// Add floating animation to form elements
$(document).ready(function() {
    $('.form-group').each(function(index) {
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
/* Enhanced form styling */
.form-control:focus {
    box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.15);
    border-color: #667eea;
}

.input-group-text {
    border-radius: 15px 0 0 15px;
    width: 45px;
    justify-content: center;
}

.btn:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
}

.btn:active {
    transform: translateY(0);
}

.card:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
}

/* Custom scrollbar for sticky sidebar */
.sticky-top {
    transition: all 0.3s ease;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .sticky-top {
        position: relative !important;
        top: auto !important;
    }

    .col-lg-4 {
        margin-top: 2rem;
    }

    .d-flex.gap-3 {
        flex-direction: column;
        gap: 1rem !important;
    }

    .justify-content-between {
        justify-content: center !important;
    }
}

/* Animation keyframes */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-slide-up {
    animation: slideInUp 0.6s ease-out;
}

/* Custom select styling */
select.form-control {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
}

/* Loading states */
.btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.form-control.loading {
    background-image: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
    background-size: 200% 100%;
    animation: loading-shimmer 1.5s infinite;
}

@keyframes loading-shimmer {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
}
</style>
@endsection
