<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'price');
        $direction = $request->get('direction', 'asc');

        $groups = Group::where('id_parent', 0)->get();

        $perPage = $request->get('per_page', 6);

        if (!in_array($perPage, [6,12,18])) {
            $perPage = 6;
        }

        $products = Product::join('prices','products.id','=','prices.id_product')
            ->orderBy($sort === 'name' ? 'products.name' : 'prices.price', $direction)
            ->select('products.*')
            ->paginate($perPage)
            ->withQueryString();

        return view('home', compact('groups','products','sort','direction'));
    }
}
