<?php

namespace Gal\Models\Product\Actions;

use Illuminate\Support\Facades\DB;
use Gal\Models\Category\Category;
use Gal\Models\DayOfWeek\DayOfWeek;
use Gal\Models\Product\DTOs\ProductDto;
use Gal\Models\Product\Product;

final class UpdateProductAction
{
    public function handle(Product $product, ProductDto $dto): Product
    {
        DB::transaction(function () use ($product, $dto) {

            $category = Category::where('uuid', $dto->categoryUuid)->firstOrFail();
            $subCategory = $dto->subCategoryUuid ? Category::where('uuid', $dto->subCategoryUuid)->firstOrFail() : null;

            $product->update([
                'name' => $dto->name,
                'description' => $dto->description,
                'max_side_dishes' => $dto->maxSideDishes,
                'category_id' => $category->id,
                'sub_category_id' => $subCategory?->id,
            ]);

            foreach ($dto->priceVariations as $priceVariation) {
                $product->priceVariations()->updateOrCreate(
                    ['size' => $priceVariation['size']],
                    ['price' => $priceVariation['price']]
                );
            }

            $sizes = array_column($dto->priceVariations, 'size');
            $product->priceVariations()->whereNotIn('size', $sizes)->delete();

            $product->sideDishes()->sync($dto->sideDishes);

            $dayIds = DayOfWeek::whereIn('id', $dto->daysOfWeek)->pluck('id')->toArray();
            $product->daysOfWeek()->sync($dayIds);

            $product->load(['category', 'subCategory', 'priceVariations', 'sideDishes', 'daysOfWeek', 'createdBy']);
        });
        return $product;
    }
}