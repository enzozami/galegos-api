<?php

namespace Gal\Models\Order\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'address_id'                            => ['required', 'integer', 'exists:addresses,id'],
            'payment_method_id'                     => ['required', 'integer', 'exists:payment_methods,id'],
            'change_for'                            => ['nullable', 'numeric', 'min:0'],
            'type'                                  => ['required', 'string', Rule::in(['delivery', 'pickup'])],

            'products'                              => ['required', 'array', 'min:1'],
            'products.*.product_uuid'               => ['required', 'uuid', 'exists:products,uuid'],
            'products.*.price_variation_id'         => ['required', 'integer', 'exists:price_variations,id'],
            'products.*.quantity'                   => ['required', 'integer', 'min:1'],
        ];
    }
}
