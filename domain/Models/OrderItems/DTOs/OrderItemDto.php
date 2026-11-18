<?php

namespace Gal\Models\OrderItems\DTOs;

use Gal\Models\Orders\Order;
use Illuminate\Http\Request;

final readonly class OrderItemDto
{
    public function __construct(
        public int $orderId,
        public int $productId,
        public int $priceVariationId,
        public int $quantity,
        public float $unitPrice,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            orderId: Order::idFromUuid($request->input('order_uuid'))->id,
            productId: $request->input('product_id'),
            priceVariationId: $request->input('price_variation_id'),
            quantity: $request->input('quantity'),
            unitPrice: $request->input('unit_price'),
        );
    }

    public function toArray(): array
    {
        return [
            'order_id' => $this->orderId,
            'product_id' => $this->productId,
            'price_variation_id' => $this->priceVariationId,
            'quantity' => $this->quantity,
            'unit_price' => $this->unitPrice,
        ];
    }
}
