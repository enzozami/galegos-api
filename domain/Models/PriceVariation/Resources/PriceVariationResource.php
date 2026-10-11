<?php

namespace Gal\Models\PriceVariation\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PriceVariationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'size' => $this->size,
            'price' => (float) $this->price,
        ];
    }
}
