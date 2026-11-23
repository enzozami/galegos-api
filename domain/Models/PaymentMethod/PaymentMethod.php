<?php

namespace Gal\Models\PaymentMethod;

use Gal\Models\Orders\Order;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['name', 'slug', 'status'])]
#[Hidden(['created_at', 'updated_at'])]
class PaymentMethod extends Model
{
    protected $table = 'payment_methods';

    public function casts(): array
    {
        return [];
    }

    public function orders(): HasOne
    {
        return $this->hasOne(Order::class, 'payment_method_id');
    }
}