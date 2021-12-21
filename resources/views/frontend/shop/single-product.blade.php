<?php
    use App\Models\Product;
?>
@extends('frontend.layouts.main')

@section('content')
<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>See more Details</p>
                    <h1>{{ $productDetail->name }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->

<!-- single product -->
<div class="single-product mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="single-product-img">
                    <img src="{{ $productDetail->pictures()->first()->getUrl() }}" alt="">
                </div>
            </div>
            <div class="col-md-7">
                <div class="single-product-content">
                    <h3>{{ $productDetail->name }}</h3>
                    <p class="single-product-pricing">Rp {{ number_format($productDetail->price,0,',','.') }}</p>
                    <p>Stock: {{ $productDetail->stock }}</p>
                    <div class="single-product-form">
                        <form action="index.html">
                            <input type="number" placeholder="0">
                        </form>
                        <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                        <p>
                            Category:
                            @foreach ($productDetail->categories as $productCategory)
                            {{ $productCategory->name }}
                            @endforeach
                        </p>
                    </div>
                    <h4>Share:</h4>
                    <ul class="product-share">
                        <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href=""><i class="fab fa-twitter"></i></a></li>
                        <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                        <li><a href=""><i class="fab fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end single product -->

<!-- more products -->
<div class="more-products mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">Related</span> Products</h3>
                    <p>Lihat Product yang Berhubungan dan lainnya</p>
                </div>
            </div>
        </div>
        <div class="row">
            @if(count($category->products)<=1) <?php $products = Product::all()  ?> @foreach ($products as $product) <div class="col-lg-4 col-md-6 text-center">
                <div class="single-product-item">
                    <div class="product-image">
                        <a href="{{ route('frontend.shop.single-product',['slug'=> $product->slug]) }}"><img src=" {{ $product->pictures()->first()->getUrl() }} " alt="{{ $product->pictures()->first()->name }}" height="200px"></a>

                    </div>
                    <h3>{{ $product->name }}</h3>
                    <p class="product-price"> Rp {{ number_format($product->price,0,',','.') }} </p>
                    <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                </div>
        </div>
        @endforeach

        @else

        @foreach ($category->products as $productCategory)
        @if($productCategory->name == $productDetail->name)

        @else
        <div class="col-lg-4 col-md-6 text-center">
            <div class="single-product-item">
                <div class="product-image">
                    <a href="{{ route('frontend.shop.single-product',['slug'=> $productCategory->slug]) }}"><img src=" {{ $productCategory->pictures()->first()->getUrl() }} " alt="{{ $productCategory->pictures()->first()->name }}" height="200px"></a>

                </div>
                <h3>{{ $productCategory->name }}</h3>
                <p class="product-price"> Rp {{ number_format($productCategory->price,0,',','.') }} </p>
                <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
            </div>
        </div>
        @endif

        @endforeach
        @endif


    </div>
</div>
</div>
<!-- end more products -->
@endsection
