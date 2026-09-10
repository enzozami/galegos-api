<?php

namespace Gal\Models\SubCategory;

use Gal\Base\Traits\HasUuidRouteKey;
use Gal\Models\Product\Product;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'status', 'category_id'])]
#[Hidden(['id', 'category_id'])]
class SubCategory extends Model
{
    protected $table = 'sub_categories';

    /** @use HasFactory<SubCategoryFactory> */
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
        return $this->hasMany(Product::class, 'sub_category_id');
    }

    protected function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
