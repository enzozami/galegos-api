<?php

namespace Gal\Models\OrderItem\Actions;

use Gal\Models\OrderItem\DTOs\OrderItemDto;
use Gal\Models\OrderItem\OrderItem;
use Illuminate\Support\Facades\DB;

class CreateOrdeItemAction
{
    public function handle(OrderItemDto $dto): OrderItem
    {
        return OrderItem::create([
            'order_id' => $dto->orderId,
            'product_id' => $dto->productId,
            'price_variation_id' => $dto->priceVariationId,
            'product_name' => $dto->productName,
            'quantity' => $dto->quantity,
            'size' => $dto->size,
            'unit_price' => $dto->unitPrice,
        ]);
    }
}