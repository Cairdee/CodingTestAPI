@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h1>Laporan Penjualan</h1>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nomer Penjualan</th>
                    <th>Tanggal</th>
                    <th>Total Nilai</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualans as $penjualan)
                <tr>
                    <td>{{ $penjualan->nomer_penjualan }}</td>
                    <td>{{ $penjualan->tgl_penjualan }}</td>
                    <td>{{ $penjualan->total_nilai_penjualan }}</td>
                    <td>{{ $penjualan->status }}</td>
                    <td><a href="{{ route('penjualans.show', $penjualan->nomer_penjualan) }}" class="btn btn-primary btn-sm">View</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $penjualans->links() }}
    </div>
</div>
@endsection
