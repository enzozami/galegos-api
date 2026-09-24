<?php

namespace Gal\Models\Product\Controllers;

use App\Http\Controllers\Controller;
use Gal\Models\Product\Actions\CreateProductAction;
use Gal\Models\Product\Actions\DestroyProductAction;
use Gal\Models\Product\Actions\ListProductsAction;
use Gal\Models\Product\DTOs\ProductDto;
use Gal\Models\Product\Product;
use Gal\Models\Product\Requests\StoreProductRequest;
use Gal\Models\Product\Requests\UpdateProductRequest;
use Gal\Models\Product\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index(Request $request, ListProductsAction $action): AnonymousResourceCollection
    {
        $products = $action->handle(
            search: $request->string('search')->toString() ?: null,
            sortBy: $request->string('sort_by')->toString() ?: null,
            descending: $request->boolean('descending', false),
            perPage: $request->integer('per_page', 20),
            onlyActive: $request->user()->isCustomer(),
        );

        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request, CreateProductAction $action): ProductResource
    {
        $product = $action->handle(ProductDto::fromRequest($request));

        return new ProductResource($product);
    }

    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, string $id)
    {
        //
    }

    public function destroy(Product $product, DestroyProductAction $action): Response
    {
        $user = auth()->user();

        $action->handle(
            user: $user,
            product: $product,
        );

        return response()->noContent();
    }
}
