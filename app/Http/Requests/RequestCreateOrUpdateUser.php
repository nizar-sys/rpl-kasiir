<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCreateOrUpdateUser extends FormRequest
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
        // regex ignore space 
        $rules = [
            'username' => 'required|regex:/^[a-zA-Z0-9_]+$/',
            'role' => 'required',
        ];
        if($this->isMethod('post')){
            $rules['username'] .= '|unique:users';
            $rules['password'] = 'required|min:6';
            $rules['password_confirmation'] = 'required|same:password';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah digunakan',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'role.required' => 'Role harus diisi',
            'password_confirmation.required' => 'Konfirmasi password harus diisi',
            'password_confirmation.same' => 'Konfirmasi password tidak sesuai',
            'username.regex' => 'Username hanya boleh berisi huruf, angka dan garis bawah (_)',
        ];
    }
}
