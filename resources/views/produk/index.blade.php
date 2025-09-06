@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h1>Manage Products</h1>
        <a href="{{ route('produks.create') }}" class="btn btn-light">Add Product</a>
    </div>
    <div class="card-body">
        <table id="produks-table" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>SKU</th>
                    <th>Nama Produk</th>
                    <th>HPP</th>
                    <th>Stok</th>
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
    $('#produks-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('produks.index') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'sku', name: 'sku' },
            { data: 'nama_produk', name: 'nama_produk' },
            { data: 'hpp', name: 'hpp' },
            { data: 'stok', name: 'stok' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});
</script>
@endsection
