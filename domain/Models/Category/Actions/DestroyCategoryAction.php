<?php

namespace Gal\Models\Category\Actions;

use Gal\Models\Category\Category;

final class DestroyCategoryAction
{
    public function handle(Category $category): void
    {
        if ($category->products()->exists()) {
            abort(409, 'Não é possível excluir uma categoria que possui produtos associados.');
        }
        if($category->subCategories()->exists()) {
            abort(409, 'Não é possível excluir uma categoria que possui subcategorias associadas.');
        }

        $category->delete();
    }
}