<?php

namespace Gal\Models\OrderItems;

use Gal\Models\Orders\Order;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['order_id', 'product_id', 'price_variation_id', 'quantity', 'unit_price'])]
#[Hidden(['id', 'created_at', 'updated_at', 'order_id', 'product_id', 'price_variation_id'])]
class OrderItem extends Model
{
    protected $table = 'order_items';

    public function casts(): array
    {
        return [];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
