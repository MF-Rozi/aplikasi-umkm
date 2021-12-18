<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::latest()->paginate(10);
        return view('backend.product.index', [
            'title' => 'Product Table',
            'products' => $product,
        ]);
    }
    public function productListDataTable(Request $request)
    {
        // if ($request->ajax()) {
            $data = Product::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (Product $product) {
                    $btn = '<a href="'.route('admin.product.show', ['slug' => $product->slug])
                    .'" class="detail btn btn-info btn-sm">detail</a> <a href="'.route('admin.product.edit', ['slug' => $product->slug]).'" class="edit btn btn-warning btn-sm">Edit</a> <a href="#" class="delete btn btn-danger btn-sm" data-id="'.$product->slug.'">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        // }
    }
    public function store(ProductCreateRequest $request)
    {
        $newProduct = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'code' => $request->code
        ]);
        // dd($newProduct->id);
        return redirect(route('admin.product.picture.create', [$newProduct->id]));
    }
    public function create()
    {
        return view('backend.product.create', [
            'title' => 'Create Product',
        ]);
    }
    public function show($slug)
    {

        $product = Product::where('slug', $slug)->firstOrFail();

        return view('backend.product.show', [
            'title' => 'Product Detail',
            'productDetail' => $product,
        ]);
    }
    public function update(ProductUpdateRequest $request)
    {
        dd($request);
    }
    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('backend.product.edit', [
            'title' => 'Product Detail',
            'productDetail' => $product,

        ]);
    }
    public function delete($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
    }
}
