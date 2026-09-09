<?php

namespace  Gal\Models\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'reset_token' => 'required|string|min:64|max:64',
        ];
    }
}
