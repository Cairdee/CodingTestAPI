<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdukRequest;
use App\Models\Produk;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Produk::query();
            if ($search = $request->get('search')['value']) {
                $query->where('nama_produk', 'like', "%{$search}%")
                      ->orWhere('sku', 'like', "%{$search}%");
            }
            if ($status = $request->get('status')) {
                $query->where('status', $status);
            }
            $data = $query->select('id', 'sku', 'nama_produk', 'hpp', 'stok', 'status');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $deleteForm = '<form action="' . route('produks.destroy', $row->id) . '" method="POST" class="d-inline" style="display:inline;">'
                                . csrf_field()
                                . method_field('DELETE')
                                . '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>'
                                . '</form>';
                    return '<a href="' . route('produks.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a> '
                           . $deleteForm;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('produk.index');
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(ProdukRequest $request)
    {
        $produk = Produk::create($request->validated());
        return redirect()->route('produks.index')->with('success', 'Produk created successfully');
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.show', compact('produk'));
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(ProdukRequest $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->update($request->validated());
        return redirect()->route('produks.index')->with('success', 'Produk updated successfully');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->route('produks.index')->with('success', 'Produk deleted successfully');
    }
}
