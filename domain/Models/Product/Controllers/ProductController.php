<?php

namespace Gal\Models\Product\Controllers;

use App\Http\Controllers\Controller;
use Gal\Models\Product\Actions\CreateProductAction;
use Gal\Models\Product\DTOs\ProductDto;
use Gal\Models\Product\Requests\StoreProductRequest;
use Gal\Models\Product\Requests\UpdateProductRequest;
use Gal\Models\Product\Resources\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        //
    }

    public function store(StoreProductRequest $request, CreateProductAction $action): ProductResource
    {
        $product = $action->handle(ProductDto::fromRequest($request));

        return new ProductResource($product);
    }

    public function show(string $id)
    {
        //
    }

    public function update(UpdateProductRequest $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
