<?php

namespace Gal\Models\Category\Controllers;

use App\Http\Controllers\Controller;
use Gal\Models\Category\Actions\CreateCategoryAction;
use Gal\Models\Category\Actions\DestroyCategoryAction;
use Gal\Models\Category\Actions\ListCategoryAction;
use Gal\Models\Category\Actions\UpdateCategoryAction;
use Gal\Models\Category\Category;
use Gal\Models\Category\DTOs\CreateCategoryDto;
use Gal\Models\Category\DTOs\UpdateCategoryDto;
use Gal\Models\Category\Requests\StoreCategoryRequest;
use Gal\Models\Category\Requests\UpdateCategoryRequest;
use Gal\Models\Category\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function index(ListCategoryAction $action, Request $request): AnonymousResourceCollection
    {
        Gate::authorize('viewAny', Category::class);
        
        $categories = $action->handle(
            !$request->user()->isAdmin(),
        );

        return CategoryResource::collection($categories);
    }

    public function store(StoreCategoryRequest $request, CreateCategoryAction $action): CategoryResource
    {
        $category = $action->handle(CreateCategoryDto::fromRequest($request));

        return new CategoryResource($category);
    }

    public function show(Category $category): CategoryResource
    {
        Gate::authorize('view', $category);
        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, Category $category, UpdateCategoryAction $action): CategoryResource
    {
        $category = $action->handle($category, UpdateCategoryDto::fromRequest($request));

        return new CategoryResource($category);
    }


    public function destroy(Category $category, DestroyCategoryAction $action): Response
    {
        Gate::authorize('delete', $category);
        $action->handle($category);

        return response()->noContent();
    }
}