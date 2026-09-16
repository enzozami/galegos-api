<?php

namespace Gal\Models\SideDish;

use Gal\Base\Traits\HasUuidRouteKey;
use Gal\Models\Product\Product;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'status', 'product_id', 'price'])]
#[Hidden(['id', 'product_id'])]
class SideDish extends Model
{
    protected $table = 'side_dishes';

    /** @use HasFactory<SideDishFactory> */
    use HasFactory, HasUuids, HasUuidRouteKey {
        HasUuidRouteKey::uniqueIds insteadof HasUuids;
    }

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'status' => 'enum:active,inactive',
            'price' => 'decimal:2',
        ];
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_side_dish', 'side_dish_id', 'product_id');
    }
}
