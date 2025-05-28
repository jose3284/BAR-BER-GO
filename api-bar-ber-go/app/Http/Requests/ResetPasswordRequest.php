<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Correo' => 'required|email',
            'token' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ];
    }
}
