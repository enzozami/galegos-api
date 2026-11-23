<?php

namespace Gal\Models\DeliveryArea;

use Gal\Models\Address\Address;
use Gal\Models\DeliveryArea\Enums\DeliveryAreaStatusEnum;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['delivery_fee', 'status', 'neighborhood', 'street'])]
#[Hidden(['id', 'created_at', 'updated_at'])]
class DeliveryArea extends Model
{
    protected $table = 'delivery_areas';

    public function casts(): array {
        return [
            'delivery_fee' => 'decimal:2',
            'status' => DeliveryAreaStatusEnum::class,
            'neighborhood' => 'string',
            'street' => 'string',
        ];
    }

    public function address(): HasOne 
    {
        return $this->hasOne(Address::class);
    }
}