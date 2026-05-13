<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $types = Type::all();

        $products = Product::where('quantity', '>', 0)
            ->when($request->type, function ($query) use ($request) {
                $query->where('type_id', $request->type);
            })
            ->get();

        return view('store.index', compact('products', 'types'));
    }
}