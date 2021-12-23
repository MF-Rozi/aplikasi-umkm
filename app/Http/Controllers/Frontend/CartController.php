<?php

namespace App\Http\Controllers\Frontend;

use Alert;
use Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddToCartRequest;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $carts = Cart::session($user->id)->getContent();
        // dd($carts);
        return view('frontend.cart.index', [
        'carts' => $carts,
        'subtotal' => Cart::getSubTotal(),
        'total' => Cart::getTotal(),
        ]);
    }
    public function addToCart(AddToCartRequest $request,)
    {
        $user = Auth::user();
        // dd($user->);
        $product = Product::where('slug', $request->slug)->first();
        // dd($product->pictures()->first()->getUrl());
        $cart = Cart::session($user->id)->add([
        'id' => $request->id,
        'name' => $request->name,
        'price' => $request->price,
        'quantity' => $request->quantity,
        'attributes' => array(
            'image' => $product->pictures()->first()->getUrl(),
        ),
        'associatedModel' => $product,
        ]);
        // dd($cart);
        Alert::success('Success', $request->name.' Berhasil Di Tambahkan Ke Cart');
        return redirect(route('frontend.cart.index'));
    }
    public function updateCart(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'quantity' => 'required|numeric|min:1',
        ]);
        $product = Product::find($validated['id']);

        $cart = Cart::session(Auth::user()->id)->update($validated['id'], array(
            'quantity' => [
                'relative' => false,
                'value' => $request->quantity
            ],
        ));

        if ($cart) {
            Alert::success('Success', 'Cart Item '.$product->name.' Updated Successfully');
            return redirect(route('frontend.cart.index'));
        } else {
            Alert::error('Failed', 'Cart Failed '.$product->name.' to Update');
            return redirect(route('frontend.cart.index'));
        }
    }
    public function deleteCart(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);
        $product = Product::find($validated['id']);
        $cart = Cart::session(Auth::user()->id)->remove($validated['id']);

        if ($cart) {
            Alert::success('Success', 'Cart Item '.$product->name.' Deleted Successfully');
            return redirect(route('frontend.cart.index'));
        } else {
            Alert::error('Failed', 'Cart Item '.$product->name.'Delete Failed');
            return redirect(route('frontend.cart.index'));
        }
    }
}
