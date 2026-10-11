<?php

namespace Gal\Models\Product\Actions;

use Gal\Models\Product\Product;
use Gal\Models\User\User;
use Illuminate\Auth\Access\AuthorizationException;

final class DestroyProductAction
{
    public function handle(User $user, Product $product): void
    {
        if (! $user->isAdmin()) {
            throw new AuthorizationException('Only admins can delete products.');
        }

        $product->delete();
    }
}
