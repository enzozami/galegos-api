<?php

namespace Gal\Models\Product\Actions;


use Gal\Models\Category\Category;
use Gal\Models\DayOfWeek\DayOfWeek;
use Gal\Models\Product\DTOs\ProductDto;
use Gal\Models\Product\Product;
use Gal\Models\SubCategory\SubCategory;
use Illuminate\Support\Facades\DB;

final class CreateProductAction
{
    public function handle(ProductDto $dto): Product
    {
        return DB::transaction(function () use ($dto) {
            $category = Category::where('uuid', $dto->categoryUuid)->firstOrFail();

            $subCategory =  $dto->subCategoryUuid !== null
                ? SubCategory::where('uuid', $dto->subCategoryUuid)->firstOrFail()
                : null;

            $product =  Product::create([
                'name' => $dto->name,
                'description' => $dto->description,
                'max_side_dishes' => $dto->maxSideDishes,
                'category_id' => $category->id,
                'sub_category_id' => $subCategory?->id,
                'created_by' => auth()->id(),
            ]);

            foreach ($dto->priceVariations as $priceVariation) {
                $product->priceVariations()->create([
                    'size' => $priceVariation['size'],
                    'price' => $priceVariation['price']
                ]);
            }

            $product->sideDishes()->attach($dto->sideDishes);

            $dayIds = DayOfWeek::whereIn('id', $dto->daysOfWeek)->pluck('id')->toArray();
            $product->daysOfWeek()->attach($dayIds);

            $product->load(['category', 'subCategory', 'priceVariations', 'sideDishes', 'daysOfWeek', 'createdBy']);

            return $product;
        });
    }
}
