<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::latest()->paginate(3);

        return view('frontend.home.index', [
            'products' => $product,
        ]);
    }
    public function about()
    {
        return view('frontend.home.about');
    }

    public function contact()
    {
        return view('frontend.home.contact');
    }
    public function notFound()
    {
        return view('frontend.home.404');
    }
}
