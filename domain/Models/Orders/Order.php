<?php

namespace Gal\Models\Orders;

use Gal\Base\Traits\HasUuidRouteKey;
use Gal\Models\Orders\Enums\OrderStatusEnum;
use Gal\Models\Orders\Enums\OrderTypeEnum;
use Gal\Models\User\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['address_id', 'payment_method_id', 'delivery_fee', 'total_price', 'change_for', 'type', 'status'])]
#[Hidden(['id', 'user_id', 'created_at', 'updated_at', 'address_id', 'payment_method_id'])]
class Order extends Model
{
    protected $table = 'orders';

    use HasUuids, HasUuidRouteKey {
        HasUuidRouteKey::uniqueIds insteadof HasUuids;
    }

    public function casts(): array
    {
        return [
            'delivery_fee' => 'decimal:2',
            'total_price' => 'decimal:2',
            'change_for' => 'decimal:2|nullable',
            'type' => OrderTypeEnum::class,
            'status' => OrderStatusEnum::class,
        ];
    }

    public function isNew(): bool
    {
        return $this->status === OrderStatusEnum::NEW;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}