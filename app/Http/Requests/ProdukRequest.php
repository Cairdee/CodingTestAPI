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
        $rules = [
            'sku' => 'required|string',
            'nama_produk' => 'required|string',
            'hpp' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'nullable|in:active,inactive',
        ];

        // Tambahkan aturan unique hanya untuk create, dan tambahkan pengecualian ID untuk update
        if ($this->isMethod('post')) {
            $rules['sku'] .= '|unique:produk,sku';
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['sku'] .= '|unique:produk,sku,' . $this->route('produk') . ',id';
        }

        return $rules;
    }
}
