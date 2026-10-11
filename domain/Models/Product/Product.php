<?php

namespace Gal\Models\Product;

use Gal\Base\Traits\HasUuidRouteKey;
use Gal\Models\Category\Category;
use Gal\Models\DayOfWeek\DayOfWeek;
use Gal\Models\OrderItem\OrderItem;
use Gal\Models\PriceVariation\PriceVariation;
use Gal\Models\SideDish\SideDish;
use Gal\Models\SubCategory\SubCategory;
use Gal\Models\User\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'description', 'max_side_dishes', 'category_id', 'sub_category_id', 'status', 'created_by'])]
#[Hidden(['id', 'category_id', 'sub_category_id', 'created_by'])]
class Product extends Model
{
    protected $table = 'products';

    /** @use HasFactory<ProductFactory> */
    use HasFactory, HasUuids, HasUuidRouteKey {
        HasUuidRouteKey::uniqueIds insteadof HasUuids;
    }

    protected function casts(): array
    {
        return [
            'max_side_dishes' => 'integer',
        ];
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function sideDishes(): BelongsToMany
    {
        return $this->belongsToMany(SideDish::class, 'product_side_dish', 'product_id', 'side_dish_id');
    }

    public function priceVariations(): HasMany
    {
        return $this->hasMany(PriceVariation::class, 'product_id');
    }

    public function daysOfWeek(): BelongsToMany
    {
        return $this->belongsToMany(DayOfWeek::class, 'product_days_of_week', 'product_id', 'day_of_week_id');
    }
}
