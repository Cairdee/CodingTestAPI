@extends('layouts.app')

@section('content')
<h1>Edit Product</h1>
<form action="{{ route('produks.update', $produk->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>SKU</label>
        <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" value="{{ old('sku', $produk->sku) }}">
        @error('sku')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" value="{{ old('nama_produk', $produk->nama_produk) }}">
        @error('nama_produk')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>HPP</label>
        <input type="number" step="0.01" name="hpp" class="form-control @error('hpp') is-invalid @enderror" value="{{ old('hpp', $produk->hpp) }}">
        @error('hpp')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok', $produk->stok) }}">
        @error('stok')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="active" {{ old('status', $produk->status) == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ old('status', $produk->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
