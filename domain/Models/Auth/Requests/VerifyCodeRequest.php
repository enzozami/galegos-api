<?php

namespace  Gal\Models\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyCodeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'code' => 'required|string|min:6|max:6',
        ];
    }
}
