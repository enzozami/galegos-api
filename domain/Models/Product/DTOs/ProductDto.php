<?php

namespace Gal\Models\Product\DTOs;

use Illuminate\Http\Request;

final readonly class ProductDto
{
    public function __construct(
        public string $name,
        public ?string $description,
        public int $maxSideDishes,
        public string $categoryUuid,
        public ?string $subCategoryUuid,
        public array $priceVariations,
        public array $sideDishes,
        public array $daysOfWeek,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->string('name')->toString(),
            description: $request->filled('description') ? $request->string('description')->toString() : null,
            maxSideDishes: $request->integer('max_side_dishes'),
            categoryUuid: $request->string('category_uuid')->toString(),
            subCategoryUuid: $request->filled('sub_category_uuid') ? $request->string('sub_category_uuid')->toString() : null,
            priceVariations: $request->array('price_variations'),
            sideDishes: $request->array('side_dishes'),
            daysOfWeek: $request->array('days_of_week'),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'max_side_dishes' => $this->daysOfWeek,
        ];
    }
}
