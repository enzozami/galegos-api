<?php

namespace Gal\Models\Order\Actions;

use Gal\Models\Address\Address;
use Gal\Models\Order\DTOs\CreateOrderDto;
use Gal\Models\Order\Order;
use Gal\Models\PriceVariation\PriceVariation;
use Illuminate\Support\Facades\DB;

final class CreateOrderAction
{
    public function handle(CreateOrderDto $dto) {
        DB::transaction(function () use ($dto) {

        });
    }
}
