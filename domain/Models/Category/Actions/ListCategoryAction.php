<?php

namespace Gal\Models\Category\Actions;

use Gal\Models\Category\Category;
use Gal\Models\Category\Enums\CategoryStatusEnum;
use Illuminate\Database\Eloquent\Collection;

final class ListCategoryAction
{
    public function handle(bool $onlyActive): Collection
    {
        return Category::query()
            ->when($onlyActive, fn($query) => $query->where('status', CategoryStatusEnum::ACTIVE))
            ->orderBy('name', 'asc')
            ->get();
    }
}