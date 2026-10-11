<?php

namespace Gal\Models\Product\Actions;

use Gal\Models\Product\Product;
use Illuminate\Pagination\LengthAwarePaginator;


final class ListProductsAction
{
    private const array SORTABLE = ['name', 'category', 'price', 'size', 'days', 'created_at'];

    private const array SORTABLE_RELATIONS = [
        'name' => 'products.name',
        'created_at' => 'products.created_at',
        'category' => 'categories.name',
        'price' => 'price_variations.price',
        'size' => 'price_variations.size',
        'days' => 'days_of_week.name',
    ];


    public function handle(
        ?string $search = null,
        ?string $sortBy = null,
        bool $descending = false,
        int $perPage = 20,
        bool $onlyActive = true
    ): LengthAwarePaginator {
        $sortBy = in_array($sortBy, self::SORTABLE, true) ? $sortBy : 'category';
        $direction = $descending ? 'desc' : 'asc';
        $sortColumn = self::SORTABLE_RELATIONS[$sortBy];

        $query = Product::query()
            ->with(['createdBy', 'category', 'priceVariations', 'daysOfWeek', 'sideDishes', 'subCategory'])
            ->when($onlyActive, fn($query) => $query->where('products.status', 'active'))
            ->when(
                $search,
                fn($query) => $query->where(function ($query) use ($search) {
                    $query->where('products.name', 'like', "%{$search}%")
                        ->orWhereHas('category', fn($query) => $query->where('categories.name', 'like', "%{$search}%"));
                })
            )
            ->when(
                $sortBy === 'category',
                fn($query) => $query->join('categories', 'products.category_id', '=', 'categories.id')
            )
            ->when(
                $sortBy === 'price',
                fn($query) => $query->join('price_variations', 'products.id', '=', 'price_variations.product_id')
            )
            ->when(
                $sortBy === 'days',
                fn($query) => $query->join('days_of_week', 'products.day_of_week_id', '=', 'days_of_week.id')
            )
            ->when(
                $sortBy === 'size',
                fn($query) => $query->join('price_variations', 'products.id', '=', 'price_variations.product_id')
            )
            ->orderBy($sortColumn, $direction)
            ->select('products.*');

        return $query->paginate($perPage);
    }
}
