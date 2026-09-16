<?php

namespace Gal\Models\DayOfWeek\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DayOfWeekResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
