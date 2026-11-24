<?php

namespace Gal\Models\Order\Controllers;

use App\Http\Controllers\Controller;
use Gal\Models\Order\Actions\CreateOrderAction;
use Gal\Models\Order\Requests\StoreOrderRequest;

class OrderController extends Controller
{
    public function index() {}
    public function store(StoreOrderRequest $request, CreateOrderAction $action) {}
    public function show() {}
    public function update() {}
    public function destroy() {}
}
