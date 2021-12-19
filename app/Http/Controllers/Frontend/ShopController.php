<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(12);
        $categories = Category::all();

        return view('frontend.shop.index', [
            'products' => $products,
            'categories' => $categories,

        ]);
    }
}
