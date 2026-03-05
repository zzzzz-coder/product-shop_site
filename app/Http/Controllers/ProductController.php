<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\GroupService;

class ProductController extends Controller
{
    public function show(int $id, GroupService $service)
    {
        $product = Product::with(['price','group.parent'])->findOrFail($id);
        $breadcrumbs = $service->getBreadcrumbs($product->group);

        return view('product', [
            'product' => $product,
            'breadcrumbs' => $breadcrumbs,
            'currentGroup' => $product->group
        ]);
    }
}
