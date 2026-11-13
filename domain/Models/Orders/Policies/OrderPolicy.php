<?php

namespace Gal\Models\Orders\Policies;

use Gal\Models\Orders\Order;
use Gal\Models\User\User;

class OrderPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Order $order): bool
    {
        return $user->isAdmin() || $order->isNew();
    }

    public function delete(User $user, Order $order): bool
    {
        return $user->isAdmin() || $order->isNew();
    }
}