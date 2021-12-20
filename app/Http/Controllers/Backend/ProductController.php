<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
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
        // dd($data);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function (Product $product) {
                $btn = '<a href="' . route('admin.product.show', ['slug' => $product->slug])
                    . '" class="detail btn btn-info btn-sm">detail</a> <a href="' . route('admin.product.edit', ['slug' => $product->slug]) . '" class="edit btn btn-warning btn-sm">Edit</a> <button class="delete btn btn-danger btn-sm" data-route="' . route('admin.product.delete', ['slug' => $product->slug]) . '">Delete</button>';

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
                $newProduct->categories()->attach($request->category);


        foreach ($request->input('productPicture', []) as $key => $value) {
            $newProduct->addMedia(storage_path('tmp/uploads/' . $value))
                ->withResponsiveImages()
                ->toMediaCollection('picture', 'public');
        }
        alert()->success('Product Created', 'Product is created successfully');
        return redirect(route('admin.product.index'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('backend.product.create', [
            'title' => 'Create Product',
            'categories' => $categories,
        ]);
    }
    public function show($slug)
    {

        $product = Product::where('slug', $slug)->firstOrFail();

        return view('backend.product.show', [
            'title' => 'Product Detail',
            'productDetail' => $product,
            'pictures' => $product->getMedia('picture'),
        ]);
    }
    public function update(ProductUpdateRequest $request, $slug)
    {

        $product = Product::where('slug', $slug)->firstOrFail();

        $envPath = env('PRODUCT_UPLOAD_PATH');
        $newPath = strtr($envPath, ['{slug}' => $product->slug]);


        $product->update($request->all());
        $product->categories()->sync($request->category);


        if (count($product->pictures()) > 0) {
            foreach ($product->pictures() as $media) {
                if (!in_array($media->file_name, $request->input('productPicture', []))) {
                    $media->delete();
                }
            }
        }

        $media = $product->pictures()->pluck('file_name')->toArray();

        foreach ($request->input('productPicture', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $product->addMedia(storage_path('tmp/uploads/' . $file))->withResponsiveImages()->toMediaCollection('picture', 'public');
            }
        }

        alert()->success('Update Success', 'Product is updated successfully');
        return redirect()->route('admin.product.index');
    }
    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        return view('backend.product.edit', [
            'title' => 'Product Detail',
            'productDetail' => $product,
            'categories' => $categories,


        ]);
    }
    public function delete($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $product->delete();

        alert()->success('Deleted', 'Product deleted successfully.');
        return redirect()->route('admin.product.index');
    }

    public function uploadPicture(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);
        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}
