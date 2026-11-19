<?php

namespace Gal\Models\Orders\DTOs;

use Illuminate\Http\Request;

final readonly class CreateOrderProductDto
{
    public function __construct(
        public string $productUuid,
        public int $priceVariationId,
        public int $quantity,
    ) {}

    public static function fromRequest(Request $request): self{
        return new self(
            productUuid: $request->string('product_uuid')->toString(),
            priceVariationId: $request->integer('price_variation_id'),
            quantity: $request->integer('quantity')
        );
    }
}