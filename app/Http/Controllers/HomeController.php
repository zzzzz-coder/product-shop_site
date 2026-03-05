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

        $products = Product::join('prices','products.id','=','prices.id_product')
            ->orderBy($sort === 'name' ? 'products.name' : 'prices.price', $direction)
            ->select('products.*')
            ->paginate(10)
            ->withQueryString();

        return view('home', compact('groups','products','sort','direction'));
    }
}
