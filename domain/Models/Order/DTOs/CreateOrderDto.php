<?php

namespace Gal\Models\Order\DTOs;

use Gal\Models\Order\Enums\OrderTypeEnum;
use Illuminate\Http\Request;

final readonly class CreateOrderDto
{
    public function __construct(
        public ?int $addressId,
        public int $paymentMethodId,
        public ?float $changeFor,
        public OrderTypeEnum $type,
        public array $products
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            addressId: $request->integer('address_id'),
            paymentMethodId: $request->integer('payment_method_id'),
            changeFor: $request->filled('change_for') ? $request->float('change_for') : null,
            type: OrderTypeEnum::from($request->string('type')->toString()),
            products: array_map(),
        );
    }
}