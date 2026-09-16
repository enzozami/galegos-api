<?php

namespace Gal\Models\PriceVariation;

use Gal\Base\Traits\HasUuidRouteKey;
use Gal\Models\PriceVariation\Enums\SizeEnum;
use Gal\Models\Product\Product;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['product_id', 'size', 'price'])]
#[Hidden(['id', 'product_id'])]
class PriceVariation extends Model
{
    protected $table = 'price_variations';

    /** @use HasFactory<PriceVariationFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'size' => SizeEnum::class,
            'price' => 'decimal:2',
        ];
    }

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
