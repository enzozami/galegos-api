<?php

namespace Gal\Models\Orders;

final class ListOrdersAction
{

    private const array SORTABLE = [];

    public function handle(bool $descending, int $perPage, string $sortBy, string $search): void
    {
        Order::query()
            ->with(['addressess', 'paymentMethod', 'orderItems'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when($sortBy, function ($query, $sortBy) use ($descending) {
                $direction = $descending ? 'desc' : 'asc';
                $query->orderBy($sortBy, $direction);
            })
            ->paginate($perPage);
    }
}
