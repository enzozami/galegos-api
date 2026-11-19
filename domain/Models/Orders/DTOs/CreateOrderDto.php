<?php

namespace Gal\Models\Orders\DTOs;

use Gal\Models\Orders\Enums\OrderTypeEnum;
use Illuminate\Http\Request;

final readonly class CreateOrderDto
{
    public function __construct(
        public int $addressId,
        public int $paymentMethodId,
        public ?float $changeFor,
        public OrderTypeEnum $type,
        public array $products
    ) {}

    public static function fromArray(Request $request): self
    {
        return new self(
            addressId: $request->integer('address_id'),
            paymentMethodId: $request->integer('payment_method_id'),
            changeFor: $request->filled('change_for') ? $request->float('change_for') : null,
            type: OrderTypeEnum::from($request->string('type')->toString()),
            products: array_map(fn($product) => CreateOrderProductDto::fromRequest($product), $request->input('products', []))
        );
    }
}