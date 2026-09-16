<?php

namespace Gal\Models\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'max_side_dishes' => ['required', 'integer', 'min:0'],

            'category_uuid' => ['required', 'string', 'exists:categories,uuid'],
            'sub_category_uuid' => ['nullable', 'string', 'exists:sub_categories,uuid'],

            'price_variations' => ['required', 'array', 'min:1'],
            'price_variations.*.size' => ['required', Rule::in(['small', 'medium', 'unique'])],
            'price_variations.*.price' => ['required', 'numeric', 'min:0'],

            'side_dishes' => ['nullable', 'array'],
            'side_dishes.*' => ['exists:side_dishes,uuid'],

            'days_of_week' => ['required', 'array', 'min:1'],
            'days_of_week.*' => ['required', 'exists:days_of_week,id'],
        ];
    }
}
