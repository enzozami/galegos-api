<?php

namespace Gal\Models\Orders\Actions;

use Gal\Models\Orders\DTOs\CreateOrderDto;
use Gal\Models\Orders\Order;
use Gal\Models\PriceVariation\PriceVariation;
use Illuminate\Support\Facades\DB;

final class CreateOrderAction
{
    public function handle(CreateOrderDto $dto) {
        DB::transaction(function () use ($dto) {
            $priceVariations = PriceVariation::whereIn('id', array_map(fn($product) => $product->priceVariationId, $dto->products));

            $total = $priceVariations->sum(function ($priceVariation) use ($dto){
                $product = collect($dto->products)->firstWhere('priceVariationId', $priceVariation->id);
                return $priceVariation->price * $product->quantity;
            });
        });
    }
}