<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductSortService;
class CatalogController extends Controller
{
    public function index(Request $request, ProductSortService $sortService)
    {
        $query = Product::with('price');

        $sort = $request->get('sort');
        $direction = $request->get('direction');

        $query = $sortService->apply($query, $sort, $direction);

        $products = $query->paginate(20);

        return view('catalog.index', [
            'products' => $products,
            'sort' => $sort,
            'direction' => $direction,
            'currentGroup' => null
        ]);
    }
}