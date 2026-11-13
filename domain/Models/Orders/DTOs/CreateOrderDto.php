<?php

namespace Gal\Models\Orders\DTOs;

use Gal\Models\Orders\Enums\OrderTypeEnum;
use Illuminate\Http\Request;

final readonly class CreateOrderDto
{
    public function __construct(
        public int $addressId,
        public int $paymentMethodId,
        public float $deliveryFee,
        public float $totalPrice,
        public ?float $changeFor,
        public OrderTypeEnum $type,
    ) {}

    public static function fromArray(Request $request): self
    {
        return new self(
            addressId: $request->integer('address_id'),
            paymentMethodId: $request->integer('payment_method_id'),
            deliveryFee: $request->float('delivery_fee'),
            totalPrice: $request->float('total_price'),
            changeFor: $request->filled('change_for') ? $request->float('change_for') : null,
            type: OrderTypeEnum::from($request->string('type')->toString())
        );
    }

    public function toArray(): array
    {
        return [
            'address_id' => $this->addressId,
            'payment_method_id' => $this->paymentMethodId,
            'delivery_fee' => $this->deliveryFee,
            'total_price' => $this->totalPrice,
            'change_for' => $this->changeFor,
            'type' => $this->type
        ];
    }
}
