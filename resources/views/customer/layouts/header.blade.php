<div class="header-container navbar-expand-lg navbar-light">


    <div class="left-header">

        <div class="logo-header-container">
            <a href="/">
                <img src="{{asset('/customer_page_images/header/Bamboo Logo.svg')}}" width="550px" height="82px">
            </a>
        </div>

    </div>

    <div class="right-header">
        
        <div class="hovers-header">
            <div class="hover-link" id="user-hover-link">
                <a href="/setpage/account"><div class="img"></div><p class="showhover">Account</p></a>
            </div>
            {{--<div class="hover-link" id="wishlist-hover-link">
                <a href="/userprofile/show/wishlist"><div class="img"></div><p class="showhover">Wishlist</p></a>
            </div>--}}
            @if(isset($recycleBasket) && $recycleBasket)
            <div class="hover-link" id="card-hover-link">
                <a href="/cart"><div class="img"></div><p class="showhover">Basket</p></a>
            </div>
            @endif
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span style="color:#000;" class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="urls-header navbar-collapse collapse">

            {{-- <div class="url-header-container" id="start-shopping">
                <a href="/shop">Start Shopping</a>
            </div> --}}
            <div class="url-header-container" id="start-selling">
                <a href="/sell">Start Selling</a>
            </div>
            <div class="url-header-container">
                <a href="/setpage/how">How it works</a>
            </div>
            <div class="url-header-container">
                <a href="/setpage/about">About</a>
            </div>
            {{--<div class="url-header-container">
                <a href="/setpage/news">News & Blog</a>
            </div>--}}
            <div class="url-header-container">
                <a href="/setpage/support">Support & Service</a>
            </div>
            <div class="url-header-container">
                <a href="/setpage/contact">Contact</a>
            </div>
        
        </div>

    </div>



</div>

<div class="urls-header navbar-collapse collapse" id="navbarSupportedContent">

    {{-- <div class="url-header-container" id="start-shopping">
        <a href="/shop">Start Shopping</a>
    </div> --}}
    <div class="url-header-container" id="start-selling">
        <a href="/sell">Start Selling</a>
    </div>
    <div class="url-header-container">
        <a href="/setpage/how">How it works</a>
    </div>
    <div class="url-header-container">
        <a href="/setpage/about">About</a>
    </div>
    {{--<div class="url-header-container">
        <a href="/setpage/news">News & Blog</a>
    </div>--}}
    <div class="url-header-container">
        <a href="/setpage/support">Support & Service</a>
    </div>
    <div class="url-header-container">
        <a href="/setpage/contact">Contact</a>
    </div>

</div>