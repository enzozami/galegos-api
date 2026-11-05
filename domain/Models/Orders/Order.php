<?php

namespace Gal\Models\Orders;

use Gal\Base\Traits\HasUuidRouteKey;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['address_id', 'payment_method_id', 'delivery_fee', 'total_price', 'change_for', 'type', 'status'])]
#[Hidden(['id', 'user_id', 'created_at', 'updated_at'])]
class Order extends Model
{
    protected $table = 'orders';

    use HasUuids, HasUuidRouteKey {
        HasUuidRouteKey::uniqueIds insteadof HasUuids;
    }
}
