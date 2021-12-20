@extends('frontend.layouts.main')

@section('content')

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Fresh and Organic</p>
                    <h1>Shop</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->

<!-- products -->
<div class="product-section mt-150 mb-150">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="product-filters">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        @foreach ($categories as $category)
                        <li data-filter=".{{ $category->slug }}">{{ $category->name }}</li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>

        <div class="row product-lists">
            @foreach ($products as $product )

            <div class="col-lg-4 col-md-6 text-center {{ empty($product->categories[0]->slug) ? '' : $product->categories[0]->slug }}">
                <div class="single-product-item">
                    <div class="product-image">
                        <a href="single-product.html"></a>
                        <img src=" {{ $product->pictures()->first()->getUrl() }} " alt="{{ $product->pictures()->first()->name }}" height="200px">
                    </div>
                    <h3>{{ $product->name }}</h3>
                    <p class="product-price"> Rp {{ number_format($product->price,0,',','.') }} </p>
                    <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                </div>
            </div>
            @endforeach


        </div>

        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="pagination-wrap">
                    {{ $products->links('vendor.pagination.frontend-pagination')}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end products -->

@endsection
