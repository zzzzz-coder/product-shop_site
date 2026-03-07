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

        $perPage = $request->get('per_page', 6);

        if (!in_array($perPage, [6,12,18])) {
            $perPage = 6;
        }

        $query = $sortService->apply($query, $sort, $direction);

        $products = $query->paginate($perPage)->withQueryString();

        return view('catalog.index', [
            'products' => $products,
            'sort' => $sort,
            'direction' => $direction,
            'currentGroup' => null,
            'perPage' => $perPage
        ]);
    }
}