<div class="header-container">


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
                @if(Auth::User())
                <a href="/setpage/account"><i class="fa fa-user-o" aria-hidden="true"></i><p class="showhover">Account</p></a>
                @else
                <a data-toggle="modal" data-target="#loginModal"><i class="fa fa-user-o" aria-hidden="true"></i><p class="showhover">Account</p></a>
                @endif
            </div>
            <div class="hover-link" id="wishlist-hover-link">
                @if(Auth::User())
                <a href="/setpage/wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i><p class="showhover">Wishlist</p></a>
                @else
                <a data-toggle="modal" data-target="#loginModal"><i class="fa fa-heart-o" aria-hidden="true"></i><p class="showhover">Wishlist</p></a>
                @endif
            </div>
            <div class="hover-link" id="card-hover-link">
                <a href="/cart"><i class="fa fa-keyboard-o" aria-hidden="true"></i><p class="showhover">Basket</p></a>
            </div>
        </div>
        <div class="urls-header">

            <div class="url-header-container" id="start-shopping">
                <a href="/shop">Start Shopping</a>
            </div>
            <div class="url-header-container" id="start-selling">
                <a href="/sell">Start Selling</a>
            </div>
            <div class="url-header-container">
                <a href="/setpage/how">How it works</a>
            </div>
            <div class="url-header-container">
                <a href="/setpage/about">About</a>
            </div>
            <div class="url-header-container">
                <a href="/setpage/news">News & Blog</a>
            </div>
            <div class="url-header-container">
                <a href="/setpage/support">Support & Service</a>
            </div>
            <div class="url-header-container">
                <a href="/setpage/contact">Contact</a>
            </div>

        </div>

    </div>



</div>
