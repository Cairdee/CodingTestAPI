<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $table = 'detail_penjualan';  
    protected $fillable = ['nomer_penjualan', 'produk_id', 'jml', 'nominal'];
}
