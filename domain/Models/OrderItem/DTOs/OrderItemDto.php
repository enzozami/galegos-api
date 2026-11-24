<?php

namespace Gal\Models\OrderItem\DTOs;

use Illuminate\Http\Request;

final readonly class OrderItemDto
{
    public function __construct(
        public int $orderId,
        public int $productId,
        public int $priceVariationId,
        public int $quantity,
        public string $productName,
        public string $size,
        public float $unitPrice,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            orderId: (int) $request->integer('order_id'),
            productId: (int) $request->integer('product_id'),
            priceVariationId: (int) $request->integer('price_variation_id'),
            quantity: (int) $request->integer('quantity'),
            productName: (string) $request->string('product_name'),
            size: (string) $request->string('size'),
            unitPrice: (float) $request->float('unit_price'),
        );
    }
}