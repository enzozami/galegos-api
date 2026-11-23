<?php

namespace Gal\Models\Orders\Actions;

use Gal\Models\Address\Address;
use Gal\Models\Orders\DTOs\CreateOrderDto;
use Gal\Models\Orders\Order;
use Gal\Models\PriceVariation\PriceVariation;
use Illuminate\Support\Facades\DB;

final class CreateOrderAction
{
    public function handle(CreateOrderDto $dto) {
        DB::transaction(function () use ($dto) {
            
        });
    }
}