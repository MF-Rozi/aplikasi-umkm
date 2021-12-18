<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductPictureCreateRequest;
use App\Models\Product;
use App\Models\ProductPicture;
use Illuminate\Http\Request;

class ProductPictureController extends Controller
{
    public function create($id)
    {
        // dd($id);
        $product = Product::find($id);
        return view('backend.product-pictures.create', [
            'title' => 'Product Picture Insert',
            'id' => $id,
            'product' => $product,
        ]);
    }
    public function store(ProductPictureCreateRequest $request)
    {
        $product = Product::find($request->product_id);
        $picture = $request->file('product_picture');
        $store = $picture->store('images/product/'.$product->slug);
        dd($picture);
        $newProductPicture = ProductPicture::create([
            'product_id' => $product->id,
            'file_name' => $picture->filename,
        ]);
    }
}
