<!-- header -->
<div class="top-header-area" id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <!-- logo -->
                    <div class="site-logo">
                        <a href="/">
                            <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="">
                        </a>
                    </div>
                    <!-- logo -->

                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            <li class="current-list-item"><a href="{{ route('frontend.home.index') }}">Home</a>
                            </li>
                            <li><a href="{{ route('frontend.home.about') }}">About</a></li>
                            {{-- <li><a href="#">Pages</a>
                                <ul class="sub-menu">
                                    <li><a href="404.html">404 page</a></li>
                                    <li><a href="about.html">About</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="checkout.html">Check Out</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                    <li><a href="news.html">News</a></li>
                                    <li><a href="shop.html">Shop</a></li>
                                </ul>
                            </li> --}}
                            {{-- <li><a href="news.html">News</a>
                                <ul class="sub-menu">
                                    <li><a href="news.html">News</a></li>
                                    <li><a href="single-news.html">Single News</a></li>
                                </ul>
                            </li> --}}
                            <li><a href="{{ route('frontend.home.contact') }}">Contact</a></li>
                            <li><a href="{{ route('frontend.shop.index') }}">Shop</a>
                                <ul class="sub-menu">
                                    <li><a href="checkout.html">Check Out</a></li>
                                    <li><a href="single-product.html">Single Product</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                </ul>
                            </li>
                            <li>
                                <div class="header-icons">
                                    @if(!empty(Auth::user()))
                                    <a href="">{{ Auth::user()->email }}</a>
                                    <a href="">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="btn ">
                                                <i class="fas fa-sign-out-alt  white" style="color: white"></i>
                                            </button>
                                        </form>
                                    </a>
                                    @if(Auth::user()->hasRole(['admin','super-admin']))
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    @endif

                                    @else
                                    <a href="{{ route('login') }}">Login</a>
                                    @endif
                                    <a class="shopping-cart" href="{{ route('frontend.cart.index') }}"><i class="fas fa-shopping-cart"></i></a>
                                    {{-- <a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a> --}}


                                </div>
                            </li>
                        </ul>
                    </nav>
                    {{-- <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a> --}}
                    <div class="mobile-menu"></div>

                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end header -->
{{-- <!-- search area -->
<div class="search-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <span class="close-btn"><i class="fas fa-window-close"></i></span>
                <div class="search-bar">
                    <div class="search-bar-tablecell">
                        <h3>Search For:</h3>
                        <input type="text" placeholder="Keywords">
                        <button type="submit">Search <i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end search area --> --}}
