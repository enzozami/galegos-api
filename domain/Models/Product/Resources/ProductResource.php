<?php

namespace Gal\Models\Product\Resources;

use Gal\Models\Category\Resources\CategoryResource;
use Gal\Models\DayOfWeek\Resources\DayOfWeekResource;
use Gal\Models\PriceVariation\Resources\PriceVariationResource;
use Gal\Models\SideDish\Resources\SideDishResource;
use Gal\Models\SubCategory\Resources\SubCategoryResource;
use Gal\Models\User\Resource\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'description' => $this->description,
            'max_side_dishes' => (int) $this->max_side_dishes,
            'category' => new CategoryResource($this->whenLoaded('category'))->resolve(),
            'sub_category' => $this->subCategory ? (SubCategoryResource::make($this->whenLoaded('subCategory'))->resolve()) : null,
            'price_variations' => PriceVariationResource::collection($this->whenLoaded('priceVariations'))->resolve(),
            'side_dishes' =>  SideDishResource::collection($this->whenLoaded('sideDishes'))->resolve(),
            'days_of_week' => DayOfWeekResource::collection($this->whenLoaded('daysOfWeek'))->resolve(),
            'created_by' => new UserResource($this->whenLoaded('createdBy'))->resolve(),
        ];
    }
}
