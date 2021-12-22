@extends('frontend.layouts.main')

@section('content')
<!-- breadcrumb-section -->
<div class="breadcrumb-section about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Kedai Kopi Qyat</p>
                    <h1>Cart</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->

<!-- cart -->

<div class="cart-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <h4>Alamat Pengiriman: {{ Auth::user()->profile->full_adress }}</h4>
            <div class="col-lg-8 col-md-12">

                <div class="cart-table-wrap">

                    <table class="cart-table">
                        <thead class="cart-table-head">
                            <tr class="table-head-row">
                                <th class="product-remove"></th>
                                <th class="product-image">Product Image</th>
                                <th class="product-name">Name</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                            <tr class="table-body-row">

                                <td class="product-remove">
                                    <form action="{{ route('frontend.cart.delete') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $cart->id }}" name="id">
                                        <button class="btn btn-outline-white" type="submit"><i class="far fa-window-close"></i></button>
                                    </form>
                                </td>
                                <td class="product-image"><img src="{{ $cart->attributes['image'] }}" alt=""></td>
                                <td class="product-name">{{ $cart->name }}</td>
                                <td class="product-price">{{ rupiah($cart->price) }}</td>
                                <form method="POST" action="{{ route('frontend.cart.update') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $cart->id }}" name="id">
                                    <td class="product-quantity"><input type="number" placeholder="1" value="{{ $cart->quantity }}" name="quantity"></td>
                                    <td><button type="submit" class="boxed-btn btn-border-orange">Update</button></td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="total-section">
                    <table class="total-table">
                        <thead class="total-table-head">
                            <tr class="table-total-row">
                                <th>Total</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="total-data">
                                <td><strong>Subtotal: </strong></td>
                                <td>Rp{{ $subtotal }}</td>
                            </tr>
                            {{-- <tr class="total-data">
                                <td><strong>Shipping: </strong></td>
                                <td>$45</td>
                            </tr> --}}
                            <tr class="total-data">
                                <td><strong>Total: </strong></td>
                                <td>Rp{{ $total }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="cart-buttons">
                        <form action="{{ route('frontend.payment.create') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn boxed-btn black">Check Out</button>
                        </form>

                    </div>
                </div>

                {{-- <div class="coupon-section">
                    <h3>Apply Coupon</h3>
                    <div class="coupon-form-wrap">
                        <form action="index.html">
                            <p><input type="text" placeholder="Coupon"></p>
                            <p><input type="submit" value="Apply"></p>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<!-- end cart -->
@endsection
