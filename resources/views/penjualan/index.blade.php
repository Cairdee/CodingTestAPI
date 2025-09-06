@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h1>Manage Penjualan</h1>
        <a href="{{ route('penjualans.create') }}" class="btn btn-light">Create Head Penjualan</a>
    </div>
    <div class="card-body">
        <table id="penjualans-table" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nomer Penjualan</th>
                    <th>Tanggal</th>
                    <th>Total Nilai</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
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
    $('#penjualans-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('penjualans.index') }}',
        columns: [
            { data: 'DT_RowIndex', orderable: false },
            { data: 'id' },
            { data: 'nomer_penjualan' },
            { data: 'tgl_penjualan' },
            { data: 'total_nilai_penjualan' },
            { data: 'status' },
            { data: 'action', orderable: false, searchable: false }
        ]
    });
});
</script>
@endsection
