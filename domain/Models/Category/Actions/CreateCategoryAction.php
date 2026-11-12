<?php

namespace Gal\Models\Category\Actions;

use Gal\Models\Category\Category;
use Gal\Models\Category\DTOs\CreateCategoryDto;

final class CreateCategoryAction
{
    public function handle(CreateCategoryDto $dto): Category
    {
        return Category::create($dto->toArray());
    }
}