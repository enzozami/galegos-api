<?php

namespace Gal\Models\SideDish\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SideDishResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'price' => (float) $this->price,
            'status' => $this->status,
        ];
    }
}
