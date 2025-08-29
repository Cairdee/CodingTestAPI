<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdukRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'sku' => 'required|string|unique:produk,sku',
            'nama_produk' => 'required|string',
            'hpp' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'nullable|in:active,inactive',
        ];
    }
}
