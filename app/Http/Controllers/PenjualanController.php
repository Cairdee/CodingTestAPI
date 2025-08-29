<?php

namespace App\Http\Controllers;

use App\Http\Requests\HeadPenjualanRequest;
use App\Http\Requests\DetailPenjualanRequest;
use App\Models\HeadPenjualan;
use App\Models\DetailPenjualan;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function createHead(HeadPenjualanRequest $request)
    {
        $data = $request->validated();
        $data['nomer_penjualan'] = 'PENJ-' . now()->format('YmdHis');
        $head = HeadPenjualan::create($data);
        return response()->json($head, 201);
    }

    public function createDetail(DetailPenjualanRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $data = $request->validated();
            $produk = Produk::findOrFail($data['produk_id']);
            if ($produk->stok < $data['jml']) {
                return response()->json(['message' => 'Stok tidak cukup'], 400);
            }
            $produk->decrement('stok', $data['jml']);
            $detail = DetailPenjualan::create($data);
            return response()->json($detail, 201);
        });
    }

    public function show($nomer_penjualan)
    {
        $head = HeadPenjualan::with('details')->where('nomer_penjualan', $nomer_penjualan)->firstOrFail();
        return response()->json([
            'head' => $head,
            'details' => $head->details
        ]);
    }
}
