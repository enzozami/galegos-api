<?php

namespace Gal\Models\OrderItem;

use Gal\Models\Order\Order;
use Gal\Models\Product\Product;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['product_id', 'price_variation_id', 'quantity', 'unit_price', 'product_name', 'size'])]
#[Hidden(['id', 'order_id', 'created_at', 'updated_at', 'order_id', 'product_id', 'price_variation_id'])]
class OrderItem extends Model
{
    protected $table = 'order_items';

    public function casts(): array
    {
        return [
            'order_id' => 'integer',
            'product_id' => 'integer',
            'price_variation_id' => 'integer',
            'quantity' => 'integer',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}