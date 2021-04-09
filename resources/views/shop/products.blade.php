<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bamboo Mobile::Shopping</title>

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
            <div class="app">
                <div class="shop-top-header" style="margin: 0;">
                    <div class="shop-search-container">
                        <div class="search-bar">
                            <form class="shop-search-form" action="/searchproducts" method="POST">
                                @csrf
                                <input type="text" placeholder="Search...">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="shop-menu-container">

                        <div class="shop-menu-element">
                            <a href="/shop/category/latest"><div class="shop-link">Latest Offers</div></a>
                        </div>
                        <div class="shop-menu-element shop-dropdown">
                            <a href="/shop/category/mobile"><div class="shop-link">Shop Mobile Phones</div></a>
                        </div>
                        <div class="shop-menu-element">
                            <a href="/shop/category/tablets"><div class="shop-link">Shop Tablets</div></a>
                        </div>
                        <div class="shop-menu-element">
                            <a href="/shop/category/accesories"><div class="shop-link">Shop Accessories</div></a>
                        </div>
                        <div class="shop-menu-element">
                            <a href="/shop/category/watches"><div class="shop-link">Shop Watches</div></a>
                        </div>
                        <div class="shop-menu-element">
                            <a href="/shop/compare/"><div class="shop-link">Compare Models</div></a>
                        </div>
                        <div class="shop-menu-element">
                            <a href="/shop/why"><div class="shop-link">Why Shop With Us</div></a>
                        </div>
                        <div class="shop-menu-element">
                            <a href="/shop/let"><div class="shop-link">Let boo do it, for you</div></a>
                        </div>
                    </div>
                    <div class="trustpilot-container">
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
                    </div>
                </div>
                <div class="let-top-container">
                    <div class="center-title-container">
                        <p> {{$title}} </p>
                    </div>
                </div>

                @if($appleData !== null && count($appleData)>0)
                    <div class="shop-devices-container apple-devices-container">
                        <div class="center-title-container">
                            <p>Shop <strong>Apple</strong></p>
                        </div>
                        <div class="devices">
                            @foreach($appleData as $appleDevice)
                            <a href="/shop/item/{{$appleDevice->id}}"><div class="shop-device">
                                <img src="{{$appleDevice->product_image}}">
                                <p>{{$appleDevice->product_name}}</p>
                            </div></a>
                        @endforeach
                        </div>

                        <div class="shop-form-container">
                            <form action="/shop/allitems" method="GET">
                                
                                <input type="hidden" name="sort" value="apple">
                                <button type="submit" class="btn btn-primary btn-blue">Shop all Apple Mobile Phones</button>
                            </form>
                        </div>
                    </div>
                @endif

                @if($samsungData !== null && count($samsungData)>0)
                    <div class="shop-devices-container samsung-devices-container">
                        <div class="center-title-container">
                            <p>Shop <strong>Samsung</strong></p>
                        </div>
                        <div class="devices">
                            @foreach($samsungData as $samsungDevice)
                            <a href="/shop/item/{{$samsungDevice->id}}"><div class="shop-device">
                                <img src="{{$samsungDevice->product_image}}">
                                <p>{{$samsungDevice->product_name}}</p>
                            </div></a>
                        @endforeach
                        </div>
                        <div class="shop-form-container">
                            <form action="/shop/allitems" method="GET">
                                
                                <input type="hidden" name="sort" value="samsung">
                                <button type="submit" class="btn btn-primary btn-blue">Shop all Samsung Mobile Phones</button>
                            </form>
                        </div>
                    </div>
                @endif

                @if($brands !== null)

                    <div class="shop-brands-container">
                        <div class="center-title-container">
                            <p>Shop <strong>Brand</strong></p>
                        </div>
                        <div class="brands-container">
                            @foreach($brands as $brand)
                            <div class="brand-container">
                                
                                
                            </div>
                            @endforeach
                        </div>
                        <div class="shop-form-container">
                            <form action="/shop/allitems" method="GET">
                               
                                <input type="hidden" name="sort" value="brands">
                                <button type="submit" class="btn btn-primary btn-blue">Shop all Brands</button>
                            </form>
                        </div>

                    </div>

                @endif

                <div class="shop-grade-container">
                    <div class="center-title-container">
                        <p>Shop by<strong>Grade</strong></p>
                    </div>
                    <div class="grades-container">
                        <div class="grade-container">
                            <p><strong>A+</strong></p>
                        </div>
                        <div class="grade-container">
                            <p><strong>A</strong></p>
                        </div>
                        <div class="grade-container">
                            <p><strong>B</strong></p>
                        </div>
                        <div class="grade-container">
                            <p><strong>C</strong></p>
                        </div>
                    </div>
                    <div class="shop-form-container">
                        <form action="/shop/allitems" method="GET">
                            <input type="hidden" name="sort" value="grades">
                            <button type="submit" class="btn btn-primary btn-blue">Shop all Grades</button>
                        </form>
                    </div>
                </div>

                <div class="assurance-container">
                    <div class="assurance-element">
                        <img src="{{asset('/customer_page_images/body/Assurance-image-1.svg')}}">
                        <p>FREE NEXT DAY NATIONWIDE DELIVERY</p>
                    </div>
                    <div class="assurance-element">
                        <img src="{{asset('/customer_page_images/body/Assurance-image-2.svg')}}">
                        <p>BAMBOO QUALITY APPROVED OVER 100 FUNCTIONAL CHECKS</p>
                    </div>
                    <div class="assurance-element">
                        <img src="{{asset('/customer_page_images/body/Assurance-image-3.svg')}}">
                        <p>NO QUIBBLE MONEY BACK</p>
                    </div>
                    <div class="assurance-element">
                        <img src="{{asset('/customer_page_images/body/Assurance-image-4.svg')}}">
                        <p>12 MONTH GUARANTEE</p>
                    </div>
                </div>

                <div class="let-footer">
                    <div class="contact-footer-image">
                        <img src="{{asset('/shop_images/letboo/035.svg')}}">
                    </div>
                    <div class="contact-footer-text">
                        <p class="service-header-1" >Save up to £300</p>
                        <p class="service-header-2">By trading in your old device when you make a purchase.</p>
                    </div>
                    <div class="contact-footer-arrow">
                        <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                    </div>
                </div>

                <div class="shop-categories-container">
                    <a href="#">
                        <div class="category-container">
                            <p class="shop-title">Shop</p>
                            <p class="category-title">Mobile Phones</p>
                            <div class="rounded-background-image" id="rounded-mobile">
                                <img src="{{asset('/shop_images/category-image-1.png')}}">
                            </div>
                        </div>
                    </a>
                    <a href="#">
                        <div class="category-container">
                            <p class="shop-title">Shop</p>
                            <p class="category-title">Tablets</p>
                            <div class="rounded-background-image" id="rounded-tablets">
                                <img src="{{asset('/shop_images/category-image-2.png')}}">
                            </div>
                        </div>
                    </a>
                    <a href="#">
                        <div class="category-container">
                            <p class="shop-title">Shop</p>
                            <p class="category-title">Watches</p>
                            <div class="rounded-background-image" id="rounded-watches">
                                <img src="{{asset('/shop_images/category-image-3.png')}}">
                            </div>
                        </div>
                    </a>
                    <a href="#">
                        <div class="category-container">
                            <p class="shop-title">Shop</p>
                            <p class="category-title">Accesories</p>
                            <div class="rounded-background-image" id="rounded-accesories">
                                <img src="{{asset('/shop_images/category-image-4.png')}}">
                            </div>
                        </div>
                    </a>
                </div>

                <div class="home-element sign-up">
        
                    <div class="center-title-container">
                        <p>Sign up to our newsletter!</p>
                    </div>
            
                    <div class="text-center-container">
                        <p>amazing offers, hints and tips and just awesome-ness</p>
                    </div>
            
                    <form action="/newslettersingup" method="POST">
                        @csrf
            
                        <div class="row w-100">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="email-input mt-0" name="first_name" type="text" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="email-input mt-0" name="last_name" type="text" placeholder="Last Name">
                                </div>
                            </div>
                        </div>
                        <div class="row w-100">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="email-input w-100" name="age_range" id="age_range">
                                        <option value="" default selected disabled>Age Range</option>
                                        <option value="16">0-16</option>
                                        <option value="24">16-24</option>
                                        <option value="48">24-48</option>
                                        <option value="62">48-62</option>
                                        <option value="62+">62+</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input class="email-input mt-0" name="email_address" type="email" placeholder="Email address">
                                </div>
                            </div>
                        </div>
            
                        <div class="terms-container">
                            <input type="checkbox" class="newsletter_checkbox mx-3" id="newsletter_terms" name="newsletter_terms">
                            <label class="newsletter_checkbox" id="newsletter_terms_label" for="newsletter_terms">
                                <p style="margin-left: 40px">In addition to receiving an instant email when you open your account with Bamboo, I agree to Bamboo sending me a regular newsletter, carrying out market research, keeping me informed with personalised news, offers, products and promotions it believes would be of interest to me through my preferred channel. </p>
                            </label>
                        </div>
            
                        <div class="form-group">
                            <div class="col-md-3 mt-3 mx-auto">
                                <input type="submit" class="btn btn-purple" value="Sign me up!">
                            </div>
                        </div>
                    </form>
            
                </div>

            </div>

            @if(session('showLogin') || $errors->all())
                <script>
                    $(window).on('load',function(){
                        $('#loginModal').modal('show');
                    });
                </script>
            @endif
            <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><img src="{{ url('/customer_page_images/body/modal-close.svg') }}"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-first-element">
                                <div class="register-elements-container">
                                    <h3>New Customers</h3>
                                    <button onclick="showRegistrationForm()" class="btn btn-primary">
                                        Sign up
                                    </button>
                                </div>

                                <div class="login-form-container">
                                    <h3>Sign in</h3>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input id="login" type="text" class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Username or Email" name="login" value="{{ old('username') ?: old('email') }}" required autofocus>
                
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
            
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-0" style="display:flex; flex-direction: row; justify-content:space-between; align-items:center;">
                                            @if (Route::has('password.request'))
                                                <a class="btn-link" style="color: #000; margin:0;" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Login') }}
                                            </button>
                                        </div>    
                                    </form>
                                </div>
                            </div>
                            <div class="modal-second-element">
                                <div class="register-form-container">
                                    @include('auth.register')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

</html>