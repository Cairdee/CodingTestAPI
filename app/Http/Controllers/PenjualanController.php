<?php

namespace App\Http\Controllers;

use App\Http\Requests\HeadPenjualanRequest;
use App\Http\Requests\DetailPenjualanRequest;
use App\Models\HeadPenjualan;
use App\Models\DetailPenjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = HeadPenjualan::with('details')->select('id', 'nomer_penjualan', 'tgl_penjualan', 'status');
            if ($search = $request->get('search')['value']) {
                $query->where('nomer_penjualan', 'like', "%{$search}%");
            }
            return DataTables::of($query)
                ->addIndexColumn() // Menambahkan DT_RowIndex secara otomatis
                ->addColumn('total_nilai_penjualan', function ($row) {
                    return $row->details->sum('nominal') ?? 0; // Hitung total dari detail
                })
                ->addColumn('action', function($row){
                    return '<a href="' . route('penjualans.show', $row->nomer_penjualan) . '" class="btn btn-sm btn-primary">View Details</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('penjualan.index');
    }

    public function create()
    {
        return view('penjualan.create');
    }

    public function createHead(HeadPenjualanRequest $request)
    {
        $data = $request->validated();
        $data['nomer_penjualan'] = 'PENJ-' . now()->format('YmdHis');
        $head = HeadPenjualan::create($data);
        return redirect()->route('penjualans.index')->with('success', 'Head Penjualan created successfully');
    }

    public function createDetail(DetailPenjualanRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $data = $request->validated();
            $produk = Produk::findOrFail($data['produk_id']);
            if ($produk->stok < $data['jml']) {
                return redirect()->back()->with('error', 'Stok tidak cukup');
            }
            $produk->decrement('stok', $data['jml']);
            $detail = DetailPenjualan::create($data);
            $head = HeadPenjualan::where('nomer_penjualan', $data['nomer_penjualan'])->first();
            $head->total_nilai_penjualan = $head->details->sum('nominal'); // Opsional, hapus jika tidak perlu
            $head->save();
            return redirect()->route('penjualans.index')->with('success', 'Detail Penjualan added successfully');
        });
    }

    public function show($penjualan)
{
    $head = HeadPenjualan::with('details')->where('nomer_penjualan', $penjualan)->firstOrFail();
    return view('penjualan.show', compact('head'));
}

    public function addDetailForm($nomer_penjualan)
    {
        return view('penjualan.detail', compact('nomer_penjualan'));
    }

    public function laporan(Request $request)
    {
        $penjualans = HeadPenjualan::with('details')->paginate(10);
        return view('penjualan.laporan', compact('penjualans'));
    }
}
