<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetailPenjualanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nomer_penjualan' => 'required|exists:head_penjualan,nomer_penjualan',
            'produk_id' => 'required|exists:produk,id',
            'jml' => 'required|integer|min:1',
            'nominal' => 'required|numeric|min:0',
        ];
    }
}
