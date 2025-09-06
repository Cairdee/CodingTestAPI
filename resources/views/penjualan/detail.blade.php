@extends('layouts.app')

@section('content')
<h1>Add Detail Penjualan</h1>
<form action="{{ route('detail-penjualans.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nomer Penjualan</label>
        <input type="text" name="nomer_penjualan" class="form-control" value="{{ old('nomer_penjualan') }}">
    </div>
    <div class="form-group">
        <label>Produk ID</label>
        <input type="number" name="produk_id" class="form-control" value="{{ old('produk_id') }}">
    </div>
    <div class="form-group">
        <label>Jumlah</label>
        <input type="number" name="jml" class="form-control" value="{{ old('jml') }}">
    </div>
    <div class="form-group">
        <label>Nominal</label>
        <input type="number" name="nominal" class="form-control" value="{{ old('nominal') }}">
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
