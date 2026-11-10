<?php

namespace Gal\Models\Category\Actions;

use Gal\Models\Category\Category;
use Gal\Models\Category\DTOs\UpdateCategoryDto;

final class UpdateCategoryAction
{
    public function handle(Category $category, UpdateCategoryDto $dto): Category
    {
        $category->update($dto->toArray());

        return $category;
    }
}