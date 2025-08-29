<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdukRequest;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::query();
        if ($search = $request->query('search')) {
            $query->where('nama_produk', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
        }
        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }
        return $query->paginate($request->query('per_page', 10));
    }

    public function store(ProdukRequest $request)
    {
        $produk = Produk::create($request->validated());
        return response()->json($produk, 201);
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return response()->json($produk);
    }

    public function update(ProdukRequest $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->update($request->validated());
        return response()->json($produk);
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return response()->json(['message' => 'Produk deleted']);
    }
}
