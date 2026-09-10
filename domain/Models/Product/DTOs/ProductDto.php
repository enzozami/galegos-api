<?php

namespace Gal\Models\Product\DTOs;

use Illuminate\Http\Request;

final readonly class ProductDto
{
    public function __construct(
        public string $name,
        public string $description,
        public int $max_side_dishes,
        public int $category_id,
        public int $sub_category_id,
    ){}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->string('name')->toString(),
            description: $request->string('description')->toString(),
            max_side_dishes: $request->integer('max_side_dishes')->toInt(),
            category_id: $request->integer('category_id')->toInt(),
            sub_category_id: $request->integer('sub_category_id')->toInt(),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'max_side_dishes' => $this->max_side_dishes,
            'category_id' => $this->category_id,
            'sub_category_id' => $this->sub_category_id,
        ];
    }
}
