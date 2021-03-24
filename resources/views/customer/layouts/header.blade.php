@include('cookieConsent::index')

<div class="header-container navbar-expand-lg navbar-light">


    <div class="left-header">

        <div class="logo-header-container">
            <a href="/" class="full-logo">
                <img src="{{asset('/customer_page_images/header/Bamboo Logo.svg')}}" width="550px" height="82px">
            </a>
            <a href="/" class="mobile-logo">
                <img src="{{asset('/images/logo_mobile.svg')}}">
            </a>
        </div>

    </div>

    <div class="right-header">
        
        <div class="hovers-header">
            @if(Auth::user())
            <div class="hover-link" id="user-hover-link">
                <a href="/userprofile"><div class="img"></div><p class="showhover" style="color: #fff">Account</p></a>
            </div>
            @else
            <div class="hover-link" id="user-hover-link">
                <a role="button" data-toggle="modal" data-target="#loginModal"><div class="img"></div><p class="showhover" style="color: #fff">Account</p></a>
            </div>
            @endif
            {{--<div class="hover-link" id="wishlist-hover-link">
                <a href="/userprofile/show/wishlist"><div class="img"></div><p class="showhover">Wishlist</p></a>
            </div>--}}
            @if(isset($recycleBasket) && $recycleBasket)
            <div class="hover-link" id="card-hover-link">
                <a href="/cart"><div class="img"></div><p class="showhover">Basket</p></a>
            </div>
            @endif
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span style="color:#000;" class="navbar-toggler-icon"></span>
            </button> --}}
        </div>

    </div>

</div>

<div class="urls-header">

    {{-- <div class="url-header-container" id="start-shopping">
        <a href="/shop">Start Shopping</a>
    </div> --}}
    <div class="url-header-container" id="start-selling">
        <a href="/sell">Start Selling</a>
    </div>
    <div class="url-header-container">
        <a href="/how">How it works</a>
    </div>
    <div class="url-header-container">
        <a href="/about">About</a>
    </div>
    {{--<div class="url-header-container">
        <a href="/setpage/news">News & Blog</a>
    </div>--}}
    <div class="url-header-container">
        <a href="/support">Support & Service</a>
    </div>
    <div class="url-header-container">
        <a href="/contact">Contact</a>
    </div>

</div>

<div class="urls-header-mobile navbar-collapse collapse" id="navbarSupportedContent">

    {{-- <div class="url-header-container" id="start-shopping">
        <a href="/shop">Start Shopping</a>
    </div> --}}
    <div class="url-header-container mobile-orange" id="start-selling">
        <a href="/sell">Start Selling</a>
    </div>
    <div class="url-header-container mobile">
        <a href="/setpage/how">How it works</a>
    </div>
    <div class="url-header-container mobile">
        <a href="/setpage/about">About</a>
    </div>
    {{--<div class="url-header-container">
        <a href="/setpage/news">News & Blog</a>
    </div>--}}
    <div class="url-header-container mobile">
        <a href="/setpage/support">Support & Service</a>
    </div>
    <div class="url-header-container mobile lastitem">
        <a href="/setpage/contact">Contact</a>
    </div>

</div>