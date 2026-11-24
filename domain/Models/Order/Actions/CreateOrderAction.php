<?php

namespace Gal\Models\Order\Actions;

use Gal\Models\Address\Address;
use Gal\Models\Order\DTOs\CreateOrderDto;
use Gal\Models\Order\Order;
use Gal\Models\PriceVariation\PriceVariation;
use Illuminate\Support\Facades\DB;

final class CreateOrderAction
{
    public function handle(CreateOrderDto $dto): Order
    {
        return DB::transaction(function () use ($dto) {
            $order = new Order();
            $order->payment_method_id = $dto->paymentMethodId;
            $order->type = $dto->type->value;
            $order->save();

            if ($dto->type === 'delivery') {
                $address = Address::findOrFail($dto->addressId);
                $order->address()->associate($address);
            }

            return $order;
        });
    }
}