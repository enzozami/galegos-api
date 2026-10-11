<?php

namespace Gal\Models\DayOfWeek;

use Gal\Models\Product\Product;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['id', 'name'])]
#[Hidden(['id'])]
class DayOfWeek extends Model
{
    protected $table = 'days_of_week';

    public $timestamps = false;

    protected function casts(): array
    {
        return [];
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_days_of_week', 'day_of_week_id', 'product_id');
    }
}
