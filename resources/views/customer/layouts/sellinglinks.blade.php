<div class="header-selling-links" id="selling-subheader-links">
    <div class="top-upper-elements-container">

        <div class="top-element-container" id="sellmobilephones-header-link">
            <a href="/sell/shop/mobile/all" class="sell-links-item">
                <p id="sell-mobile-text">Sell Mobile Phones</p>
                <span id="selling-icon-dropdown-mobile" class="down"></span>
            </a>
        </div>

        <div class="top-element-container" id="selltablets-header-link">
            <a href="/sell/shop/tablets/all" class="sell-links-item">
                <p id="sell-tablets-text">Sell Tablets</p>
                <span id="selling-icon-dropdown-tablets" class="down"></span>
            </a>

            {{-- <div class="selllinks-sublink" id="selltablets-header-hover">
                <div class="top-element-container">
                    <a href="/sell/devices/tablets/1" class="sell-links-sublink-item">
                        <p>Apple Tablets</p>
                        <img src="{{asset('/images/front-end-icons/black_arrow_next.svg')}}" width="25px">
                    </a>
                </div>
                <div class="top-element-container">
                    <a href="/sell/devices/tablets/2" class="sell-links-sublink-item">
                        <p>Samsung Tablets</p>
                        <img src="{{asset('/images/front-end-icons/black_arrow_next.svg')}}" width="25px">
                    </a>
                </div>
                <div class="top-element-container">
                    <a href="/sell/devices/tablets/10" class="sell-links-sublink-item">
                        <p>Sony Tablets</p>
                        <img src="{{asset('/images/front-end-icons/black_arrow_next.svg')}}" width="25px">
                    </a>
                </div>
            </div> --}}
        </div>

        <div class="top-element-container" id="sellwatches-header-link">
            <a href="/sell/shop/watches/all" class="sell-links-item">
                <p id="sell-watches-text">Sell Watches</p>
                <span id="selling-icon-dropdown-watches" class="down"></span>
            </a>

            {{-- <div class="selllinks-sublink" id="sellwatches-header-hover">
                <div class="top-element-container">
                    <a href="/sell/devices/watches/1" class="sell-links-sublink-item">
                        <p>Apple Watches</p>
                        <img src="{{asset('/images/front-end-icons/black_arrow_next.svg')}}" width="25px">
                    </a>
                </div>
                <div class="top-element-container">
                    <a href="/sell/devices/watches/2" class="sell-links-sublink-item">
                        <p>Samsung Watches</p>
                        <img src="{{asset('/images/front-end-icons/black_arrow_next.svg')}}" width="25px">
                    </a>
                </div>
            </div> --}}
        </div>

        <div class="top-element-container" id="whysellwithus-header-link">
            <a href="/sell/why" class="sell-links-item">
                <p>Why Sell With Us</p>
            </a>
        </div>

    </div>

    {{-- <div class="trustpilot-container">
        <div class="trustpilot-element">
            <img src="{{asset('/customer_page_images/body/trustpilot.png')}}">
        </div>
        <div class="trustpilot-element">
            <p>Over 65,000 reviews</p>
        </div>
        <div class="trustpilot-element">
            <div class="green-box">
                <i class="fa fa-star" aria-hidden="true"></i>
            </div>
            <div class="green-box">
                <i class="fa fa-star" aria-hidden="true"></i>
            </div>
            <div class="green-box">
                <i class="fa fa-star" aria-hidden="true"></i>
            </div>
            <div class="green-box">
                <i class="fa fa-star" aria-hidden="true"></i>
            </div>
            <div class="green-box">
                <i class="fa fa-star" aria-hidden="true"></i>
            </div>
        </div>
    </div> --}}
</div>


{{-- {!!dd(App\Helpers\MenuHelper::getMobileBrands())!!} --}}


<div id="sellmobilephones-header-hover" class="not-visible">
    {{-- <a href="/sell/devices/mobile/1" class="sell-links-sublink-item">
        <p>Apple Devices</p>
        <img src="{{asset('/images/front-end-icons/black_arrow_next.svg')}}" width="25px">
    </a>
    <a href="/sell/devices/mobile/2" class="sell-links-sublink-item">
        <p>Samsung Devices</p>
        <img src="{{asset('/images/front-end-icons/black_arrow_next.svg')}}" width="25px">
    </a>
    <a href="/sell/devices/mobile/3" class="sell-links-sublink-item">
        <p>Huawei Devices</p>
        <img src="{{asset('/images/front-end-icons/black_arrow_next.svg')}}" width="25px">
    </a> --}}
    <div class="mobile-phones-submenu">

        <div class="mobile-phones-submenu-column">
            <a class="mobile-phone-submenu-title" href="/sell/devices/mobile/1">
                <p>Apple iPhone</p> 
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </a>

            @foreach(App\Helpers\MenuHelper::getApplePhones() as $apple_phone)
                <a class="mobile-phone-submenu-item" href="/sell/sellitem/{{$apple_phone->id}}">
                    <p>{{$apple_phone->product_name}}</p>
                    <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                </a>
            @endforeach

        </div>

        <div class="mobile-phones-submenu-column">
            <a class="mobile-phone-submenu-title" href="/sell/devices/mobile/2">
                <p>Samsung Galaxy</p> 
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </a>

            @foreach(App\Helpers\MenuHelper::getSamsungPhones() as $samsung_phone)
                <a class="mobile-phone-submenu-item" href="/sell/sellitem/{{$samsung_phone->id}}">
                    <p>{{$samsung_phone->product_name}}</p>
                    <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                </a>
            @endforeach
            
        </div>

        <div class="mobile-phones-submenu-column">
            <div class="mobile-phone-submenu-title">
                <p>Sell by Brand</p> 
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>

            @foreach(App\Helpers\MenuHelper::getMobileBrands() as $brand)
                <a class="mobile-phone-submenu-item" href="/sell/devices/mobile/{{$brand->id}}">
                    <p>Sell all {{$brand->brand_name}} Phones</p>
                    <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                </a>
            @endforeach
        </div>

        <a class="whysell-banner-container" href="/sell/why">
            <p class="title">WHY SELL WITH US?</p>
            <p class="text">Read more about the benefits of shopping with bamboo.</p>

            <img class="whysell-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
        </a>

    </div>
</div>

<div id="selltablets-header-hover" class="not-visible">

    <div class="tablets-submenu">

        <div class="mobile-phones-submenu-column">
            <div class="mobile-phone-submenu-title">
                <p>Apple IPad</p> 
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>

            <div class="mobile-phone-submenu-item">
                <p>iPhone 11</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 11 Pro</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 11 Pro Max</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone XR</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone XS Max</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone XS</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone X</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 8 Plus</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 8</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 7 Plus</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 7</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 6S Plus</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 6S</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
        </div>

        <div class="mobile-phones-submenu-column">
            <div class="mobile-phone-submenu-title">
                <p>Samsung Galaxy Tab</p> 
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>

            <div class="mobile-phone-submenu-item">
                <p>iPhone 11</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 11 Pro</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 11 Pro Max</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone XR</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone XS Max</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone XS</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone X</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 8 Plus</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 8</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 7 Plus</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 7</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 6S Plus</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 6S</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
        </div>

        <div class="mobile-phones-submenu-column">
            <div class="mobile-phone-submenu-title">
                <p>Sell by Brand</p> 
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>

            <div class="mobile-phone-submenu-item">
                <p>iPhone 11</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 11 Pro</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 11 Pro Max</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone XR</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone XS Max</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone XS</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone X</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 8 Plus</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 8</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 7 Plus</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 7</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 6S Plus</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 6S</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
        </div>

        <a class="whysell-banner-container" href="/sell/why">
            <p class="title">WHY SELL WITH US?</p>
            <p class="text">Read more about the benefits of shopping with bamboo.</p>

            <img class="whysell-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
        </a>

    </div>
</div>

<div id="sellwatches-header-hover" class="not-visible">

    <div class="watches-submenu">

        <div class="mobile-phones-submenu-column">
            <div class="mobile-phone-submenu-title">
                <p>Apple Watches</p> 
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>

            <div class="mobile-phone-submenu-item">
                <p>iPhone 11</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 11 Pro</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 11 Pro Max</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone XR</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone XS Max</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone XS</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone X</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 8 Plus</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 8</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 7 Plus</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 7</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 6S Plus</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 6S</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
        </div>

        <div class="mobile-phones-submenu-column">
            <div class="mobile-phone-submenu-title">
                <p>Samsung Watches</p> 
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>

            <div class="mobile-phone-submenu-item">
                <p>iPhone 11</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 11 Pro</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 11 Pro Max</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone XR</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone XS Max</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone XS</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone X</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 8 Plus</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 8</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 7 Plus</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 7</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 6S Plus</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 6S</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
        </div>

        <div class="mobile-phones-submenu-column">
            <div class="mobile-phone-submenu-title">
                <p>Sell by Brand</p> 
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>

            <div class="mobile-phone-submenu-item">
                <p>iPhone 11</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 11 Pro</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 11 Pro Max</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone XR</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone XS Max</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone XS</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone X</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 8 Plus</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 8</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 7 Plus</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 7</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 6S Plus</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="mobile-phone-submenu-item">
                <p>iPhone 6S</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
        </div>

        <a class="whysell-banner-container" href="/sell/why">
            <p class="title">WHY SELL WITH US?</p>
            <p class="text">Read more about the benefits of shopping with bamboo.</p>

            <img class="whysell-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
        </a>

    </div>
</div>