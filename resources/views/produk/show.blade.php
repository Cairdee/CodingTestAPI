@extends('layouts.app')

@section('content')
<h1>Product Details</h1>
<p>SKU: {{ $produk->sku }}</p>
<p>Nama Produk: {{ $produk->nama_produk }}</p>
<p>HPP: {{ $produk->hpp }}</p>
<p>Stok: {{ $produk->stok }}</p>
<p>Status: {{ $produk->status }}</p>
<a href="{{ route('produk.index') }}" class="btn btn-primary">Back</a>
@endsection
