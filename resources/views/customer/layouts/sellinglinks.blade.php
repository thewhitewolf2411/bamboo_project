{{-- {!!dd(App\Helpers\MenuHelper::urlMatchesMobile())!!} --}}

<div class="header-selling-links" id="selling-subheader-links">
    <div class="top-upper-elements-container">

        <div class="top-element-container @if(App\Helpers\MenuHelper::urlMatchesMobile())on-page @endif" id="sellmobilephones-header-link">
            <a href="/sell/shop/mobile/all" class="sell-links-item">
                <p id="sell-mobile-text">Sell Mobile Phones</p>
                <span id="selling-icon-dropdown-mobile" class="down"></span>
            </a>
        </div>

        <div class="top-element-container @if(App\Helpers\MenuHelper::urlMatchesTablets())on-page @endif" id="selltablets-header-link">
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

        <div class="top-element-container @if(App\Helpers\MenuHelper::urlMatchesWatches())on-page @endif" id="sellwatches-header-link">
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

        <div class="top-element-container @if(request()->path() === 'sell/why')on-page @endif" id="whysellwithus-header-link">
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


<div id="sellmobilephones-header-hover" class="not-visible">
    
    <div class="mobile-phones-submenu">

        <div class="mobile-phones-submenu-column">
            <a class="mobile-phone-submenu-title" href="/sell/devices/mobile/1">
                <p>Apple iPhone</p> 
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </a>

            @foreach(App\Helpers\MenuHelper::getApplePhones() as $apple_phone)
                <a class="mobile-phone-submenu-item custom-tooltip" href="/sell/sellitem/{{$apple_phone->id}}">
                    <p>{{App\Helpers\MenuHelper::formatDeviceName($apple_phone->product_name)}}</p>
                    <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                    <span class="tooltiptext"><p>{{$apple_phone->product_name}}</p></span>
                </a>
            @endforeach

        </div>

        <div class="mobile-phones-submenu-column">
            <a class="mobile-phone-submenu-title" href="/sell/devices/mobile/2">
                <p>Samsung Galaxy</p> 
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </a>

            @foreach(App\Helpers\MenuHelper::getSamsungPhones() as $samsung_phone)
                <a class="mobile-phone-submenu-item custom-tooltip" href="/sell/sellitem/{{$samsung_phone->id}}">
                    <p>{{App\Helpers\MenuHelper::formatDeviceName($samsung_phone->product_name)}}</p>
                    <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                    <span class="tooltiptext"><p>{{$samsung_phone->product_name}}</p></span>
                </a>
            @endforeach
            
        </div>

        <div class="mobile-phones-submenu-column">
            <div class="mobile-phone-submenu-title cursor-pointer" id="sellmobilebybrand">
                <p>Sell by Brand</p> 
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>

            @foreach(App\Helpers\MenuHelper::getMobileBrands() as $brand)
                <a class="mobile-phone-submenu-item" href="/sell/devices/mobile/{{$brand->id}}">
                    <p>Sell all {{$brand->brand_name}} Phones</p>
                    <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                </a>
            @endforeach
            <a class="mobile-phone-submenu-item" href="/sell">
                <p>See more</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </a>
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
            <a class="mobile-phone-submenu-title" href="/sell/devices/tablets/1">
                <p>Apple IPad</p> 
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </a>

            @foreach(App\Helpers\MenuHelper::getAppleTablets() as $apple_tablet)
                <a class="mobile-phone-submenu-item custom-tooltip" href="/sell/sellitem/{{$apple_tablet->id}}">
                    <p>{{App\Helpers\MenuHelper::formatDeviceName($apple_tablet->product_name)}}</p>
                    <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                    <span class="tooltiptext"><p>{{$apple_tablet->product_name}}</p></span>
                </a>
            @endforeach
        </div>

        <div class="mobile-phones-submenu-column">
            <a class="mobile-phone-submenu-title" href="/sell/devices/tablets/2">
                <p>Samsung Galaxy Tab</p> 
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </a>

            @foreach(App\Helpers\MenuHelper::getSamsungTablets() as $samsung_tablet)
                <a class="mobile-phone-submenu-item custom-tooltip" href="/sell/sellitem/{{$samsung_tablet->id}}">
                    <p>{{App\Helpers\MenuHelper::formatDeviceName($samsung_tablet->product_name)}}</p>
                    <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                    <span class="tooltiptext"><p>{{$samsung_tablet->product_name}}</p></span>
                </a>
            @endforeach

        </div>

        <div class="mobile-phones-submenu-column">
            <div class="mobile-phone-submenu-title cursor-pointer" id="selltabletsbybrand">
                <p>Sell by Brand</p> 
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>

            @foreach(App\Helpers\MenuHelper::getTabletBrands() as $tablet_brands)
                <a class="mobile-phone-submenu-item" href="/sell/devices/tablets/{{$tablet_brands->id}}">
                    <p>Sell all {{$tablet_brands->brand_name}} Tablets</p>
                    <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                </a>
            @endforeach
            <a class="mobile-phone-submenu-item" href="/sell">
                <p>See more</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </a>
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
            <a class="mobile-phone-submenu-title" href="/sell/devices/watches/1">
                <p>Apple Watches</p> 
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </a>

            @foreach(App\Helpers\MenuHelper::getAppleWatches() as $apple_watch)
                <a class="mobile-phone-submenu-item custom-tooltip" href="/sell/sellitem/{{$apple_watch->id}}">
                    <p>{{App\Helpers\MenuHelper::formatDeviceName($apple_watch->product_name)}}</p>
                    <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                    <span class="tooltiptext"><p>{{$apple_watch->product_name}}</p></span>
                </a>
            @endforeach
        </div>

        <div class="mobile-phones-submenu-column">
            <a class="mobile-phone-submenu-title" href="/sell/devices/watches/2">
                <p>Samsung Watches</p> 
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </a>

            @foreach(App\Helpers\MenuHelper::getSamsungWatches() as $samsung_watch)
                <a class="mobile-phone-submenu-item custom-tooltip" href="/sell/sellitem/{{$samsung_watch->id}}">
                    <p>{{App\Helpers\MenuHelper::formatDeviceName($samsung_watch->product_name)}}</p>
                    <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                    <span class="tooltiptext"><p>{{$samsung_watch->product_name}}</p></span>
                </a>
            @endforeach
        </div>

        <div class="mobile-phones-submenu-column">
            <div class="mobile-phone-submenu-title cursor-pointer" id="sellwatchesbybrand">
                <p>Sell by Brand</p> 
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>

            @foreach(App\Helpers\MenuHelper::getWatchesBrands() as $watch_brand)
                <a class="mobile-phone-submenu-item" href="/sell/devices/watches/{{$watch_brand->id}}">
                    <p>Sell all {{$watch_brand->brand_name}} Watches</p>
                    <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                </a>
            @endforeach
            <a class="mobile-phone-submenu-item" href="/sell">
                <p>See more</p>
                <img class="mobile-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </a>
        </div>

        <a class="whysell-banner-container" href="/sell/why">
            <p class="title">WHY SELL WITH US?</p>
            <p class="text">Read more about the benefits of shopping with bamboo.</p>

            <img class="whysell-submenu-icon" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
        </a>

    </div>
</div>





<div class="mobile-header-selling-links @if(App\Helpers\MenuHelper::isInSelling())withoutstartsell @endif">
    <div class="mobile-top-element-container @if(App\Helpers\MenuHelper::urlMatchesMobile())on-page @endif" id="mobile-phones-dropdown">
        <div class="mobile-sell-links-item">
            <p>Sell Mobile Phones</p>
            <span id="dropdown-mobile-icon" class="down"></span>
        </div>
    </div>
    <div class="mobile-top-element-container @if(App\Helpers\MenuHelper::urlMatchesMobile())on-page @endif" id="mobile-tablets-dropdown">
        <div class="mobile-sell-links-item">
            <p>Sell Tablets</p>
            <span id="dropdown-tablets-icon" class="down"></span>
        </div>
    </div>
    <div class="mobile-top-element-container @if(App\Helpers\MenuHelper::urlMatchesMobile())on-page @endif" id="mobile-watches-dropdown">
        <div class="mobile-sell-links-item">
            <p>Sell Watches</p>
            <span id="dropdown-watches-icon" class="down"></span>
        </div>
    </div>
    <div class="mobile-top-element-container @if(App\Helpers\MenuHelper::urlMatchesMobile())on-page @endif">
        <a class="mobile-sell-links-item" href="/sell/why">
            <p>Why Sell With Us</p>
        </a>
    </div>
</div>

<div id="mobile-phones-mobile-dropdown" class="not-visible @if(App\Helpers\MenuHelper::isInSelling())withoutstartsell @endif">

    <div class="white-wrapper">

        <div class="dropdown-column">

            <div class="mobile-dropdown-toggle" id="toggleApplePhones" data-toggle="collapse" href="#collapseAppleMobilePhones" role="button" aria-expanded="false" aria-controls="collapseMobilePhones">
                <p>Apple iPhone</p> 
                <img class="mobile-menu-image" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="dropdown-phones-list collapse" id="collapseAppleMobilePhones">
                @foreach(App\Helpers\MenuHelper::getApplePhones() as $apple_phone)
                    <a href="/sell/sellitem/{{$apple_phone->id}}">
                        <p>{{$apple_phone->product_name}}</p>
                        <img src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                    </a>
                    <div class="hr-dropdown"></div>
                @endforeach
                <a href="/sell/devices/mobile/1">
                    <p>Show all iPhones</p>
                    <img src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                </a>
            </div>

            <div class="hr-dropdown"></div>

            <div class="mobile-dropdown-toggle" id="toggleSamsungPhones" data-toggle="collapse" href="#collapseSamsungMobilePhones" role="button" aria-expanded="false" aria-controls="collapseSamsungMobilePhones">
                <p>Samsung Galaxy</p> 
                <img class="mobile-menu-image" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="dropdown-phones-list collapse" id="collapseSamsungMobilePhones">
                @foreach(App\Helpers\MenuHelper::getSamsungPhones() as $samsung_phone)
                    <a href="/sell/sellitem/{{$samsung_phone->id}}">
                        <p>{{$samsung_phone->product_name}}</p>
                        <img src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                    </a>
                    <div class="hr-dropdown"></div>
                @endforeach
                <a href="/sell/devices/mobile/2">
                    <p>Show all Samsung Galaxy phones</p>
                    <img src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                </a>
            </div>
            <div class="hr-dropdown"></div>


            <div class="mobile-dropdown-toggle" id="toggleMobileBrands" data-toggle="collapse" href="#collapseMobileBrands" role="button" aria-expanded="false" aria-controls="collapseMobileBrands">
                <p>Sell By Brand</p> 
                <img class="mobile-menu-image" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>

            <div class="dropdown-phones-list collapse" id="collapseMobileBrands">
                @foreach(App\Helpers\MenuHelper::getMobileBrands() as $brand)
                    <a href="/sell/devices/mobile/{{$brand->id}}">
                        <p>{{$brand->brand_name}}</p>
                        <img src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                    </a>
                    <div class="hr-dropdown"></div>
                @endforeach
            </div> 

        </div>

        </div>
    </div>

</div>

<div id="tablets-mobile-dropdown" class="not-visible @if(App\Helpers\MenuHelper::isInSelling())withoutstartsell @endif">
    <div class="white-wrapper">

        <div class="dropdown-column">

            <div class="mobile-dropdown-toggle" id="toggleAppleTablets" data-toggle="collapse" href="#collapseAppleTablets" role="button" aria-expanded="false" aria-controls="collapseAppleTablets">
                <p>Apple iPad</p> 
                <img class="mobile-menu-image" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="dropdown-phones-list collapse" id="collapseAppleTablets">
                @foreach(App\Helpers\MenuHelper::getAppleTablets() as $apple_tablet)
                    <a href="/sell/sellitem/{{$apple_tablet->id}}">
                        <p>{{$apple_tablet->product_name}}</p>
                        <img src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                    </a>
                    <div class="hr-dropdown"></div>
                @endforeach
                <a href="/sell/devices/tablets/1">
                    <p>Show all Apple Tablets</p>
                    <img src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                </a>
            </div>

            <div class="hr-dropdown"></div>

            <div class="mobile-dropdown-toggle" id="toggleSamsungTablets" data-toggle="collapse" href="#collapseSamsungTablets" role="button" aria-expanded="false" aria-controls="collapseSamsungTablets">
                <p>Samsung Galaxy Tab</p> 
                <img class="mobile-menu-image" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="dropdown-phones-list collapse" id="collapseSamsungTablets">
                @foreach(App\Helpers\MenuHelper::getSamsungTablets() as $samsung_tablet)
                    <a href="/sell/sellitem/{{$samsung_tablet->id}}">
                        <p>{{$samsung_tablet->product_name}}</p>
                        <img src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                    </a>
                    <div class="hr-dropdown"></div>
                @endforeach
                <a href="/sell/devices/tablets/2">
                    <p>Show all Samsung Galaxy Tablets</p>
                    <img src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                </a>
            </div>
            <div class="hr-dropdown"></div>


            <div class="mobile-dropdown-toggle" id="toggleTabletBrands" data-toggle="collapse" href="#collapseTabletBrands" role="button" aria-expanded="false" aria-controls="collapseTabletBrands">
                <p>Sell By Brand</p> 
                <img class="mobile-menu-image" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>

            <div class="dropdown-phones-list collapse" id="collapseTabletBrands">
                @foreach(App\Helpers\MenuHelper::getTabletBrands() as $tablet_brand)
                    <a href="/sell/devices/tablets/{{$tablet_brand->id}}">
                        <p>{{$tablet_brand->brand_name}}</p>
                        <img src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                    </a>
                    <div class="hr-dropdown"></div>
                @endforeach
            </div> 

        </div>

        </div>
    </div>
</div>

<div id="watches-mobile-dropdown" class="not-visible @if(App\Helpers\MenuHelper::isInSelling())withoutstartsell @endif">
    <div class="white-wrapper">

        <div class="dropdown-column">

            <div class="mobile-dropdown-toggle" id="toggleAppleWatches" data-toggle="collapse" href="#collapseAppleWatches" role="button" aria-expanded="false" aria-controls="collapseAppleWatches">
                <p>Apple Watches</p> 
                <img class="mobile-menu-image" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="dropdown-phones-list collapse" id="collapseAppleWatches">
                @foreach(App\Helpers\MenuHelper::getAppleWatches() as $apple_watches)
                    <a href="/sell/sellitem/{{$apple_watches->id}}">
                        <p>{{$apple_watches->product_name}}</p>
                        <img src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                    </a>
                    <div class="hr-dropdown"></div>
                @endforeach
                <a href="/sell/devices/watches/1">
                    <p>Show all Apple Watches</p>
                    <img src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                </a>
            </div>

            <div class="hr-dropdown"></div>

            <div class="mobile-dropdown-toggle" id="toggleSamsungWatches" data-toggle="collapse" href="#collapseSamsungWatches" role="button" aria-expanded="false" aria-controls="collapseSamsungWatches">
                <p>Samsung Galaxy Watch</p> 
                <img class="mobile-menu-image" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="dropdown-phones-list collapse" id="collapseSamsungWatches">
                @foreach(App\Helpers\MenuHelper::getSamsungWatches() as $samsung_watch)
                    <a href="/sell/sellitem/{{$samsung_watch->id}}">
                        <p>{{$samsung_watch->product_name}}</p>
                        <img src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                    </a>
                    <div class="hr-dropdown"></div>
                @endforeach
                <a href="/sell/devices/watches/2">
                    <p>Show all Samsung Galaxy Watches</p>
                    <img src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                </a>
            </div>
            <div class="hr-dropdown"></div>


            <div class="mobile-dropdown-toggle" id="toggleWatchesBrands" data-toggle="collapse" href="#collapseWatchesBrands" role="button" aria-expanded="false" aria-controls="collapseWatchesBrands">
                <p>Sell By Brand</p> 
                <img class="mobile-menu-image" src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
            <div class="dropdown-phones-list collapse" id="collapseWatchesBrands">
                @foreach(App\Helpers\MenuHelper::getWatchesBrands() as $watch_brand)
                    <a href="/sell/devices/watches/{{$watch_brand->id}}">
                        <p>{{$watch_brand->brand_name}}</p>
                        <img src="{{asset('customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                    </a>
                    <div class="hr-dropdown"></div>
                @endforeach
            </div> 

        </div>

        </div>
    </div>
</div>








<script type="application/javascript">

    window.addEventListener('DOMContentLoaded', function(){

        let cookie_bar_visible = document.getElementById('cookie-container');
        if(cookie_bar_visible){
            document.getElementById('selling-subheader-links').classList.add('margin-with-cookiebar');
        }

        document.getElementById('mobile-phones-dropdown').addEventListener('click', function(){
            let mobile_dropdown =  document.getElementById("mobile-phones-mobile-dropdown");
            let tablets_dropdown = document.getElementById("tablets-mobile-dropdown");
            let watches_dropdown = document.getElementById("watches-mobile-dropdown");
            tablets_dropdown.classList.add('not-visible');
            watches_dropdown.classList.add('not-visible');

            if(mobile_dropdown.classList.contains('not-visible')){
                document.body.style = "overflow-y: hidden";
                mobile_dropdown.classList.remove('not-visible');
            } else {
                document.body.style = "overflow-y: initial";
                mobile_dropdown.classList.add('not-visible');
            }
        });

        document.getElementById('mobile-tablets-dropdown').addEventListener('click', function(){
            let mobile_dropdown =  document.getElementById("mobile-phones-mobile-dropdown");
            let tablets_dropdown = document.getElementById("tablets-mobile-dropdown");
            let watches_dropdown = document.getElementById("watches-mobile-dropdown");
            mobile_dropdown.classList.add('not-visible');
            watches_dropdown.classList.add('not-visible');

            if(tablets_dropdown.classList.contains('not-visible')){
                document.body.style = "overflow-y: hidden";
                tablets_dropdown.classList.remove('not-visible');
            } else {
                document.body.style = "overflow-y: initial";
                tablets_dropdown.classList.add('not-visible');
            }
        });

        document.getElementById('mobile-watches-dropdown').addEventListener('click', function(){
            let mobile_dropdown =  document.getElementById("mobile-phones-mobile-dropdown");
            let tablets_dropdown = document.getElementById("tablets-mobile-dropdown");
            let watches_dropdown = document.getElementById("watches-mobile-dropdown");
            mobile_dropdown.classList.add('not-visible');
            tablets_dropdown.classList.add('not-visible');

            if(watches_dropdown.classList.contains('not-visible')){
                document.body.style = "overflow-y: hidden";
                watches_dropdown.classList.remove('not-visible');
            } else {
                document.body.style = "overflow-y: initial";
                watches_dropdown.classList.add('not-visible');
            }
        });


        document.getElementById('sellmobilebybrand').addEventListener('click', function(){
            localStorage.setItem('preselectedSellCategory', 'mobile');
            window.location = '/sell';
        });

        document.getElementById('selltabletsbybrand').addEventListener('click', function(){
            localStorage.setItem('preselectedSellCategory', 'tablets');
            window.location = '/sell';
        });

        document.getElementById('sellwatchesbybrand').addEventListener('click', function(){
            localStorage.setItem('preselectedSellCategory', 'watches');
            window.location = '/sell';
        });

        // close submenus if they are out of focus
        document.body.addEventListener('mouseover', function(event){
            let mobile_sell_hovermenu = document.getElementById('sellmobilephones-header-hover');
            let tablets_sell_hovermenu = document.getElementById('selltablets-header-hover');
            let watches_sell_hovermenu = document.getElementById('sellwatches-header-hover');
            if(!mobile_sell_hovermenu.classList.contains('not-visible')){
                if(event.target.id && event.target.id === "sellmobilephones-header-hover"){
                    mobile_sell_hovermenu.classList.add('not-visible');
                }
            }
            if(!tablets_sell_hovermenu.classList.contains('not-visible')){
                if(event.target.id && event.target.id === "selltablets-header-hover"){
                    tablets_sell_hovermenu.classList.add('not-visible');
                }
            }
            if(!watches_sell_hovermenu.classList.contains('not-visible')){
                if(event.target.id && event.target.id === "sellwatches-header-hover"){
                    watches_sell_hovermenu.classList.add('not-visible');
                }
            }
        });


        // close on out-click
        // mobile dropdown
        document.getElementById('mobile-phones-mobile-dropdown').addEventListener('click', function(e){
            if(e.target.id == 'mobile-phones-mobile-dropdown'){
                if(!document.getElementById('mobile-phones-mobile-dropdown').classList.contains('not-visible')){
                    document.getElementById('mobile-phones-mobile-dropdown').classList.add('not-visible');
                    document.body.style = "";
                }
            }
        });
        // tablets dropdown
        document.getElementById('tablets-mobile-dropdown').addEventListener('click', function(e){
            if(e.target.id == 'tablets-mobile-dropdown'){
                if(!document.getElementById('tablets-mobile-dropdown').classList.contains('not-visible')){
                    document.getElementById('tablets-mobile-dropdown').classList.add('not-visible');
                    document.body.style = "";
                }
            }
        });
        // watches dropdown
        document.getElementById('watches-mobile-dropdown').addEventListener('click', function(e){
            if(e.target.id == 'watches-mobile-dropdown'){
                if(!document.getElementById('watches-mobile-dropdown').classList.contains('not-visible')){
                    document.getElementById('watches-mobile-dropdown').classList.add('not-visible');
                    document.body.style = "";
                }
            }
        });



        // mobile dropdowns
        // mobile phones - apple
        $('#collapseAppleMobilePhones').on('hidden.bs.collapse', function () {
            $('#toggleApplePhones').removeClass('open');
        });
        $('#collapseAppleMobilePhones').on('hide.bs.collapse', function () {
            let children = document.getElementById('toggleApplePhones').childNodes;
            let img = children[3];
            img.classList.remove('rotated');
        });
        $('#collapseAppleMobilePhones').on('shown.bs.collapse', function () {
            $('#toggleApplePhones').addClass('open');
        });
        $('#collapseAppleMobilePhones').on('show.bs.collapse', function () {
            let children = document.getElementById('toggleApplePhones').childNodes;
            let img = children[3];
            img.classList.add('rotated');
        });

        // mobile phones - samsung
        $('#collapseSamsungMobilePhones').on('hidden.bs.collapse', function () {
            $('#toggleSamsungPhones').removeClass('open')
        });
        $('#collapseSamsungMobilePhones').on('hide.bs.collapse', function () {
            let children = document.getElementById('toggleSamsungPhones').childNodes;
            let img = children[3];
            img.classList.remove('rotated');
        });
        $('#collapseSamsungMobilePhones').on('shown.bs.collapse', function () {
            $('#toggleSamsungPhones').addClass('open')
        });
        $('#collapseSamsungMobilePhones').on('show.bs.collapse', function () {
            let children = document.getElementById('toggleSamsungPhones').childNodes;
            let img = children[3];
            img.classList.add('rotated');
        });

        // mobile phones - brands
        $('#collapseMobileBrands').on('hidden.bs.collapse', function () {
            $('#toggleMobileBrands').removeClass('open');
        });
        $('#collapseMobileBrands').on('hide.bs.collapse', function () {
            let children = document.getElementById('toggleMobileBrands').childNodes;
            let img = children[3];
            img.classList.remove('rotated');
        });
        $('#collapseMobileBrands').on('shown.bs.collapse', function () {
            $('#toggleMobileBrands').addClass('open');
        });
        $('#collapseMobileBrands').on('show.bs.collapse', function () {
            let children = document.getElementById('toggleMobileBrands').childNodes;
            let img = children[3];
            img.classList.add('rotated');
        });



        // tablet dropdowns
        // apple tablets
        $('#collapseAppleTablets').on('hidden.bs.collapse', function () {
            $('#toggleAppleTablets').removeClass('open')
        });
        $('#collapseAppleTablets').on('hide.bs.collapse', function () {
            let children = document.getElementById('toggleAppleTablets').childNodes;
            let img = children[3];
            img.classList.remove('rotated');
        });
        $('#collapseAppleTablets').on('shown.bs.collapse', function () {
            $('#toggleAppleTablets').addClass('open')
        });
        $('#collapseAppleTablets').on('show.bs.collapse', function () {
            let children = document.getElementById('toggleAppleTablets').childNodes;
            let img = children[3];
            img.classList.add('rotated');
        });

        // samsung tablets
        $('#collapseSamsungTablets').on('hidden.bs.collapse', function () {
            $('#toggleSamsungTablets').removeClass('open')
        });
        $('#collapseSamsungTablets').on('hide.bs.collapse', function () {
            let children = document.getElementById('toggleSamsungTablets').childNodes;
            let img = children[3];
            img.classList.remove('rotated');
        });
        $('#collapseSamsungTablets').on('shown.bs.collapse', function () {
            $('#toggleSamsungTablets').addClass('open')
        });
        $('#collapseSamsungTablets').on('show.bs.collapse', function () {
            let children = document.getElementById('toggleSamsungTablets').childNodes;
            let img = children[3];
            img.classList.add('rotated');
        });

        // tablet brands
        $('#collapseTabletBrands').on('hidden.bs.collapse', function () {
            $('#toggleTabletBrands').removeClass('open');
        });
        $('#collapseTabletBrands').on('hide.bs.collapse', function () {
            let children = document.getElementById('toggleTabletBrands').childNodes;
            let img = children[3];
            img.classList.remove('rotated');
        });
        $('#collapseTabletBrands').on('shown.bs.collapse', function () {
            $('#toggleTabletBrands').addClass('open');
        });
        $('#collapseTabletBrands').on('show.bs.collapse', function () {
            let children = document.getElementById('toggleTabletBrands').childNodes;
            let img = children[3];
            img.classList.add('rotated');
        });

        // watches dropdowns
        // apple watches
        $('#collapseAppleWatches').on('hidden.bs.collapse', function () {
            $('#toggleAppleWatches').removeClass('open')
        });
        $('#collapseAppleWatches').on('hide.bs.collapse', function () {
            let children = document.getElementById('toggleAppleWatches').childNodes;
            let img = children[3];
            img.classList.remove('rotated');
        });
        $('#collapseAppleWatches').on('shown.bs.collapse', function () {
            $('#toggleAppleWatches').addClass('open')
        });
        $('#collapseAppleWatches').on('show.bs.collapse', function () {
            let children = document.getElementById('toggleAppleWatches').childNodes;
            let img = children[3];
            img.classList.add('rotated');
        });

        // samsung watches
        $('#collapseSamsungWatches').on('hidden.bs.collapse', function () {
            $('#toggleSamsungWatches').removeClass('open')
        });
        $('#collapseSamsungWatches').on('hide.bs.collapse', function () {
            let children = document.getElementById('toggleSamsungWatches').childNodes;
            let img = children[3];
            img.classList.remove('rotated');
        });
        $('#collapseSamsungWatches').on('shown.bs.collapse', function () {
            $('#toggleSamsungWatches').addClass('open')
        });
        $('#collapseSamsungWatches').on('show.bs.collapse', function () {
            let children = document.getElementById('toggleSamsungWatches').childNodes;
            let img = children[3];
            img.classList.add('rotated');
        });

        // watches brands
        $('#collapseWatchesBrands').on('hidden.bs.collapse', function () {
            $('#toggleWatchesBrands').removeClass('open');
        });
        $('#collapseWatchesBrands').on('hide.bs.collapse', function () {
            let children = document.getElementById('toggleWatchesBrands').childNodes;
            let img = children[3];
            img.classList.remove('rotated');
        });
        $('#collapseWatchesBrands').on('shown.bs.collapse', function () {
            $('#toggleWatchesBrands').addClass('open');
        });
        $('#collapseWatchesBrands').on('show.bs.collapse', function () {
            let children = document.getElementById('toggleWatchesBrands').childNodes;
            let img = children[3];
            img.classList.add('rotated');
        });
    });

</script>