@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h1>Informasi Penjualan: {{ $head->nomer_penjualan }}</h1>
    </div>
    <div class="card-body">
        <p><strong>Tanggal:</strong> {{ $head->tgl_penjualan }}</p>
        <p><strong>Total Nilai:</strong> {{ $head->total_nilai_penjualan }}</p>
        <p><strong>Status:</strong> {{ $head->status }}</p>

        <h2 class="mt-4">Detail Penjualan</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produk ID</th>
                    <th>Jumlah</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($head->details as $detail)
                <tr>
                    <td>{{ $detail->produk_id }}</td>
                    <td>{{ $detail->jml }}</td>
                    <td>{{ $detail->nominal }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
