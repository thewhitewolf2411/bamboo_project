<!DOCTYPE html>
<html>

    <head>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KC33JWC');</script>
        <!-- End Google Tag Manager -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Bamboo Mobile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="96x96" href="/customer_page_images/header/favicon-96x96.png">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    </head>
    <body>
        <header>@include('customer.layouts.header')</header>
        <main>

            <div class="page-header-container sitemap">
                <p class="page-header-text">Sitemap</p>
            </div>

            <div class="sitemap-container">
                @if(Session::get('_previous') !== null)
                    <a class="back-to-home-footer padded mt-3" href="{{Session::get('_previous')['url']}}">
                @else
                    <a class="back-to-home-footer padded mt-3" href="/">
                @endif
                    <img class="back-home-icon mr-2" src="{{asset('images/front-end-icons/black_arrow_left.svg')}}">
                    <p class="back-home-text">Back</p>
                </a>

                <div class="row m-0 map-row mt-5">
                    <div class="map-col">
                        <p class="sitemap-title">How it works</p>
                        {{-- <a class="sitemap-text" href="/how">Shopping</a> --}}
                        <a class="sitemap-text" href="/sell">Selling</a>
                    </div>
                    <div class="map-col">
                        <p class="sitemap-title">About Us</p>
                        <a class="sitemap-text" href="/how">How it works</a>
                    </div>
                    <div class="map-col">
                        <p class="sitemap-title">News & Blog</p>
                        <a class="sitemap-text" href="/news">News & Blog</a>
                    </div>
                    <div class="map-col">
                        <p class="sitemap-title">Service & Support</p>
                        <a class="sitemap-text" href="/support/selling">Selling a device</a>
                        {{-- <a class="sitemap-text" href="/support">Tech</a>
                        <a class="sitemap-text" href="/support">Delivery</a>
                        <a class="sitemap-text" href="/support">Your Order</a>
                        <a class="sitemap-text" href="/support">Your Account</a>
                        <a class="sitemap-text" href="/support">General Questions</a> --}}
                    </div>
                    <div class="map-col">
                        <p class="sitemap-title">Contact Us</p>
                        <a class="sitemap-text" href="/contact/message">Message Us</a>
                        <a class="sitemap-text" href="/contact/call">Call Us</a>
                    </div>
                    <div class="map-col">
                        <p class="sitemap-title">My Bamboo</p>
                    </div>
                    {{-- <div class="map-col">
                        <p class="sitemap-title">Responsibilities</p>
                        <a class="sitemap-text" href="/environment">Environment</a>
                    </div> --}}
                    <div class="map-col">
                        <p class="sitemap-title">Legal</p>
                        <a class="sitemap-text" href="/privacy">Privacy Policy</a>
                        <a class="sitemap-text" href="/terms">Terms & Conditions</a>
                        <a class="sitemap-text" href="/map">Site map</a>
                        <a class="sitemap-text" href="/cookies">Cookies</a>
                        <a class="sitemap-text" href="/slavery">Modern Slavery Statement</a>
                        <a class="sitemap-text" href="https://www.bamboodistribution.com/">Corporate Site</a>
                    </div>
                </div>

                {{-- <div class="row m-0 border-top my-5">
                    <p class="sitemap-section-title ml-1 mt-4">Shopping</p>
                </div>

                <div class="row m-0 map-row">

                    <div class="map-col">
                        <p class="sitemap-title">Latest Offers</p>
                    </div>
                    <div class="map-col">
                        <p class="sitemap-title">Shop Mobile Phones</p>
                        <a class="sitemap-text">Shop All Mobile Phones</a>
                        <p class="sitemap-text">By Grade</p>
                        <p class="sitemap-text">Apple iPhone</p>
                        <p class="sitemap-text">Samsung Galaxy</p>
                    </div>
                    <div class="map-col">
                        <p class="sitemap-title">Shop Tablets</p>
                        <p class="sitemap-text">Shop All Tablets</p>
                        <p class="sitemap-text">By Grade</p>
                        <p class="sitemap-text">Apple iPhone</p>
                        <p class="sitemap-text">Samsung Galaxy</p>
                    </div>
                    <div class="map-col">
                        <p class="sitemap-title">Shop Watches</p>
                        <p class="sitemap-text">Shop All Watches</p>
                        <p class="sitemap-text">By Grade</p>
                        <p class="sitemap-text">Apple iPhone</p>
                        <p class="sitemap-text">Samsung Galaxy</p>
                    </div>
                    <div class="map-col">
                        <p class="sitemap-title">Compare Models</p>
                    </div>
                    <div class="map-col">
                        <p class="sitemap-title">Why Shop With Us</p>
                    </div>
                    <div class="map-col">
                        <p class="sitemap-title">Let Boo do it, for you</p>
                    </div>
                </div> --}}

                <div class="row m-0 border-top my-5">
                    <p class="sitemap-section-title ml-1 mt-4">Selling</p>
                </div>

                <div class="row m-0 map-row">

                    <div class="map-col">
                        <p class="sitemap-title">Sell Mobile Phones</p>
                        <a class="sitemap-text" href="/sell/shop/mobile/all">Search All</a>
                        @foreach($phones as $phone)
                            @if(isset($phone->id))
                                <a class="sitemap-text" href="/sell/sellitem/{{$phone->id}}">{{$phone->product_name}}</a>
                            @endif
                        @endforeach
                        {{-- <a class="sitemap-text" href="#">Apple iPhone</a>
                        <a class="sitemap-text" href="#">Samsung Galaxy</a> --}}
                    </div>
                    <div class="map-col">
                        <p class="sitemap-title">Sell Tablets</p>
                        <a class="sitemap-text" href="/sell/shop/tablets/all">Search All</a>
                        @foreach($tablets as $tablet)
                            @if(isset($tablet->id))
                                <a class="sitemap-text" href="/sell/sellitem/{{$tablet->id}}">{{$tablet->product_name}}</a>
                            @endif
                        @endforeach
                        {{-- <a class="sitemap-text" href="#">Apple iPhone</a>
                        <a class="sitemap-text" href="#">Samsung Galaxy</a> --}}
                    </div>
                    <div class="map-col">
                        <p class="sitemap-title">Sell Watches</p>
                        <a class="sitemap-text" href="/sell/shop/watches/all">Search All</a>
                        @foreach($watches as $watch)
                            @if(isset($watch->id))
                                <a class="sitemap-text" href="/sell/sellitem/{{$watch->id}}">{{$watch->product_name}}</a>
                            @endif
                        @endforeach
                        {{-- <a class="sitemap-text" href="#">Apple iPhone</a>
                        <a class="sitemap-text" href="#">Samsung Galaxy</a> --}}
                    </div>
                    <div class="map-col">
                        <p class="sitemap-title">Why Sell With Us</p>
                        <a class="sitemap-text" href="/sell/why">Benefits of Selling with Bamboo</a>
                    </div>
                </div>

                <div class="row m-0 border-top my-5">
                    <p class="sitemap-section-title ml-1 mt-4"></p>
                </div>

            </div>

            @include('partial.loginmodal')

        </main>
        <footer>@include('customer.layouts.footer', ['showGetstarted' => true])</footer>

        <script>

            function showRegistrationForm(){
                if(!document.getElementsByClassName('modal-second-element')[0].classList.contains('modal-second-element-active')){
                    document.getElementsByClassName('modal-second-element')[0].classList.add('modal-second-element-active');
                }
            }

        </script>

    </body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KC33JWC"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</html>