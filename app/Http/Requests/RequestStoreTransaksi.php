<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreTransaksi extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'nama_pelanggan' => 'required',
            'menu_id' => 'required',
            'jumlah' => 'required',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'nama_pelanggan.required' => 'Pelanggan tidak boleh kosong',
            'menu_id.required' => 'Menu tidak boleh kosong',
            'jumlah.required' => 'Jumlah tidak boleh kosong',
        ];
    }
}
