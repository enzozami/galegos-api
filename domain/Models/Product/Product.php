<?php

namespace Gal\Models\Product;

use Database\Factories\UserFactory;
use Gal\Base\Traits\HasUuidRouteKey;
use Gal\Models\Category\Category;
use Gal\Models\Category\SubCategory;
use Gal\Models\User\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'description', 'max_side_dishes', 'category_id', 'sub_category_id', 'status'])]
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

    protected function createdBy(): BelongsTo{
        return $this->belongsTo(User::class, 'created_by');
    }

    protected function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    protected function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
