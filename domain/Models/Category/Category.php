<?php

namespace Gal\Models\Category;

use Gal\Base\Traits\HasUuidRouteKey;
use Gal\Models\Product\Product;
use Gal\Models\SubCategory\SubCategory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'status'])]
#[Hidden(['id'])]
class Category extends Model
{
    protected $table = 'categories';

    /** @use HasFactory<CategoryFactory> */
    use HasFactory, HasUuids, HasUuidRouteKey {
        HasUuidRouteKey::uniqueIds insteadof HasUuids;
    }

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'status' => 'enum:active,inactive',
        ];
    }

    protected function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    protected function subCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }
}
