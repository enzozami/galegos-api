<?php

namespace Gal\Models\Product\Actions;

use Gal\Models\Product\DTOs\ProductDto;
use Gal\Models\Product\Product;

final class CreateProductAction
{
    public function handle(ProductDto $dto): Product
    {
        return Product::create([
            ...$dto->toArray(),
            'created_by' => auth()->id(),
        ]);
    }
}
