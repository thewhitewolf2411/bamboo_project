@include('cookieConsent::index')

<div id="header" class="header-container navbar-expand-lg navbar-light">


    <div class="left-header">

        <div class="logo-header-container" id="full-logo-container">
            <a href="/" class="full-logo" id="full-logo-img">
                <img id="full-bamboo-logo" src="{{asset('/customer_page_images/header/Bamboo Logo.svg')}}" width="550px" height="82px">
            </a>
            <a href="/" class="mobile-logo invisible" id="mobile-logo-img">
                <img id="mobile-bamboo-logo" src="{{asset('/customer_page_images/body/emoji_emotionless.svg')}}">
            </a>
        </div>

    </div>

    <div class="right-header">
        
        <div class="hovers-header">
            @if(Auth::user())
            <div class="hover-link" id="user-hover-link">
                <a href="/userprofile"><div class="img"></div><p class="showhover" style="color: #fff">Account</p></a>
                @if(App\Helpers\NotificationHelper::count() !== null)
                    <div class="notifications-count">
                        <img src="{{asset('/images/front-end-icons/notification_count.svg')}}">
                        <p>{!!App\Helpers\NotificationHelper::count()!!}</p>
                    </div>
                @endif
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
                @if(App\Helpers\CartHelper::cartItems() !== null)
                    @if(App\Helpers\CartHelper::cartItems() > 0)
                        <div class="basket-items-count">
                            <img src="{{asset('/images/front-end-icons/basket_count.svg')}}">
                            <p>{!!App\Helpers\CartHelper::cartItems()!!}</p>
                        </div>
                    @endif
                @endif
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

<div class="urls-header" id="header-urls">

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
    <div class="url-header-container">
        <a href="/news">News & Blog</a>
    </div>
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
        <a href="/how">How it works</a>
    </div>
    <div class="url-header-container mobile">
        <a href="about">About</a>
    </div>
    <div class="url-header-container">
        <a href="/news">News & Blog</a>
    </div>
    <div class="url-header-container mobile">
        <a href="/support">Support & Service</a>
    </div>
    <div class="url-header-container mobile lastitem">
        <a href="/contact">Contact</a>
    </div>

</div>

<script type="application/javascript" defer src="{{ asset('js/header.js') }}"></script>
