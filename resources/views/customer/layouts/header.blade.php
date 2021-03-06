@include('cookieConsent::index')

<div id="header" class="header-container navbar-expand-lg navbar-light">


    <div class="left-header">

        <div class="logo-header-container" id="full-logo-container">
            <a href="/" class="full-logo" id="full-logo-img">
                <img id="full-bamboo-logo" src="{{asset('/customer_page_images/header/Bamboo Logo.svg')}}" width="536px" height="81px">
            </a>
            <a href="/" class="mobile-logo invisible" id="mobile-logo-img">
                <img id="mobile-bamboo-logo" src="{{asset('/customer_page_images/body/emoji_emotionless.svg')}}">
                {{-- <img id="mobile-bamboo-logo" src="{{asset('/customer_page_images/header/Bamboo Logo.svg')}}"> --}}
            </a>
        </div>

    </div>

    <div class="right-header">
        
        <div class="hovers-header">
            @if(Auth::user())
            <div class="hover-link" id="user-hover-link">
                <a href="/userprofile"><div class="img"></div><p class="showhover" style="color: #fff">Account</p></a>
                @if(App\Helpers\NotificationHelper::count() !== null)
                    <div class="notifications-count account">
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
            <button id="navbar-mobile" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" id="navbar-mobile-icon"></span>
            </button>
            {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span style="color:#000;" class="navbar-toggler-icon"></span>
            </button> --}}
        </div>

    </div>

</div>

@if(!App\Helpers\MenuHelper::isInSelling())
    <div class="sell-submenu">
        <a href="/shop" class="shopping">
            <p>Shop</p>
            <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
        </a>
        <a href="/sell" class="selling">
            <p>Sell</p>
            <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
        </a>
    </div>
@endif

<div class="urls-header" id="header-urls">

    {{-- <div class="url-header-container" id="start-shopping">
        <a href="/shop">Start Shopping</a>
    </div> --}}
    <a href="/shop" class="btn start-shopping-button-header mr-2" @if(str_contains(Request::path(), 'sell')) style="opacity: 0.5;" @endif>
        <p id="start-shopping-button-text">Start Shopping</p> 
        {{-- <img id="start-selling-button-img-down" class="invisible" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White.svg')}}"> --}}
    </a>
    {{-- <div class="url-header-container" id="start-selling"> --}}
    <a href="/sell" class="btn start-selling-button-header"  @if(Request::path() === 'shop') style="opacity: 0.5;" @endif>
        <p id="start-selling-button-text">Start Selling</p> 
        {{-- <img id="start-selling-button-img-down" class="invisible" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White.svg')}}"> --}}
    </a>
    {{-- </div> --}}
    <div class="url-header-container how @if(request()->path() === 'how') onpage @endif">
        <a href="/how" class="header-url-link @if(request()->path() === 'how') bolded @endif">How it Works</a>
    </div>
    <div class="url-header-container about @if(request()->path() === 'about') onpage @endif">
        <a href="/about" class="header-url-link @if(request()->path() === 'about') bolded @endif">About</a>
    </div>
    <div class="url-header-container news @if(str_contains(request()->path(), 'news')) onpage @endif">
        <a href="/news" class="header-url-link  @if(str_contains(request()->path(), 'news')) bolded @endif">News & Blog</a>
    </div>
    <div class="url-header-container faq @if(request()->path() === 'support/selling') onpage @endif">
        <a href="/support" class="header-url-link @if(request()->path() === 'support/selling') bolded @endif">FAQ’s</a>
    </div>
    <div class="url-header-container contact mr-0 @if(request()->path() === 'contact') onpage @endif">
        <a href="/contact" class="header-url-link @if(request()->path() === 'contact') bolded @endif">Contact Us</a>
    </div>

</div>

<div class="urls-header-mobile navbar-collapse collapse @if(App\Helpers\MenuHelper::isInSelling())withoutstartsell @endif" id="navbarSupportedContent">
    <div class="mobile-menu-wrapper">
        {{-- <div class="url-header-container" id="start-shopping">
            <a href="/shop">Start Shopping</a>
        </div> --}}
        <div class="url-header-container mobile mobile-orange" id="start-shopping">
            <a href="/shop" class="mobilemenu-bold white">Start Shopping</a>
            <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White.svg')}}">
        </div>
        <div class="url-header-container mobile mobile-orange" id="start-selling">
            <a href="/sell" class="mobilemenu-bold white">Start Selling</a>
            <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White.svg')}}">
        </div>
        <div class="url-header-container mobile">
            <a href="/how" class="mobilemenu-medium">How it Works</a>
        </div>
        <div class="url-header-container mobile">
            <a href="/about" class="mobilemenu-medium">About</a>
        </div>
        <div class="url-header-container mobile">
            <a href="/news" class="mobilemenu-medium">News & Blog</a>
        </div>
        <div class="url-header-container mobile">
            {{-- <a href="/support" class="mobilemenu-medium">Service & Support</a> --}}
            <a href="/support" class="mobilemenu-medium">FAQ’s</a>
        </div>
        <div class="url-header-container mobile lastitem">
            <a href="/contact" class="mobilemenu-medium">Contact Us</a>
        </div>
    </div>
</div>

<script type="application/javascript" defer src="{{ asset('js/header.js') }}"></script>
