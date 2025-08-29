<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadPenjualan extends Model
{
    protected $table = 'head_penjualan';
    protected $fillable = ['nomer_penjualan', 'tgl_penjualan', 'status'];

    public function details()
    {
        return $this->hasMany(DetailPenjualan::class, 'nomer_penjualan', 'nomer_penjualan');
    }
}
