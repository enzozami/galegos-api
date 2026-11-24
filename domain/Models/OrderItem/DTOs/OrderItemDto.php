<?php

namespace Gal\Models\OrderItem\DTOs;

use Illuminate\Http\Request;

final readonly class OrderItemDto
{
    public function __construct(
        public string $productUuid,
        public int $priceVariationId,
        public int $quantity,
    )
    {}

    public static function fromRequest(Request $request): self {
        return new self(
            productUuid: (string) $request->string('product_uuid')->toString(),
            priceVariationId: (int) $request->integer('price_variation_id'),
            quantity: (int) $request->integer('quantity'),
        );
    }
}
