<?php

namespace Gal\Models\Address;

use Gal\Models\DeliveryArea\DeliveryArea;
use Gal\Models\Order\Order;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable('street', 'number', 'complement', 'neighborhood', 'city', 'state', 'zip_code', 'delivery_area_id')]
#[Hidden('id', 'user_id', 'created_at', 'updated_at', 'delivery_area_id')]
class Address extends Model
{
    protected $table = 'addresses';

    public function casts(): array
    {
        return [
            'user_id' => 'integer',
            'delivery_area_id' => 'integer',
            'street' => 'string',
            'number' => 'string',
            'complement' => 'string|nullable',
            'neighborhood' => 'string',
            'city' => 'string',
            'state' => 'string',
            'zip_code' => 'string',
        ];
    }

    public function deliveryArea(): BelongsTo
    {
        return $this->belongsTo(DeliveryArea::class);
    }

    public function order(): HasOne {
        return $this->hasOne(Order::class);
    }
}
