<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1">

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
            <div class="sell-top-container">
                <div class="top-upper-elements-container">
                    <a href="/sell/shop/mobile">
                        <div class="top-element-container">
                            <p>Sell Mobile Phones</p>
                        </div>
                    </a>
                    <a href="/sell/shop/tablets">
                        <div class="top-element-container">
                            <p>Sell Tablets</p>
                        </div>
                    </a>
                    <a href="/sell/shop/watches">
                        <div class="top-element-container">
                            <p>Sell Watches</p>
                        </div>
                    </a>
                    <a href="/sell/why">
                        <div class="top-element-container">
                            <p>Why Sell With Us</p>
                        </div>
                    </a>
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

            <div class="sell-title-container">
                <div class="two-titles">
                    <div class="center-title-container">
                        <p>What do you want to sell?</p>
                    </div>
                    <div class="center-title-container smaller-title">
                        <p>Step 1: Use the search bar below to find your specific device or select from one of the options</p>
                    </div>
                </div>
                <div class="sell-search-container">
                    <div class="search-bar">
                        <form class="sell-search-form" action="/sell/searchproducts" method="POST">
                            @csrf
                            <input type="text" name="search_argument" placeholder="Enter your model, IMEI or Serial number">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                        <a href=""><div class="d-flex mt-50">
                            <p>How do I find the model, IMEI or Serial Number</p>
                            <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                        </div></a>
                    </div>
                </div>
            </div>

            <div class="shop-categories-container w-1000">
                <a href="#">
                    <div class="category-container smaller-a">
                        <p class="shop-title">Mobile Phones</p>
                        <div class="rounded-background-image" id="rounded-mobile">
                            <img src="{{asset('/shop_images/category-image-1.png')}}">
                        </div>
                    </div>
                </a>
                <a href="#">
                    <div class="category-container smaller-a">
                        <p class="shop-title">Tablets</p>
                        <div class="rounded-background-image" id="rounded-tablets">
                            <img src="{{asset('/shop_images/category-image-2.png')}}">
                        </div>
                    </div>
                </a>
                <a href="#">
                    <div class="category-container smaller-a">
                        <p class="shop-title">Watches</p>
                        <div class="rounded-background-image" id="rounded-watches">
                            <img src="{{asset('/shop_images/category-image-3.png')}}">
                        </div>
                    </div>
                </a>
            </div>

            <div class="selling-info-container">
                <div class="selling-info-element">
                    <img src="{{asset('/sell_images/image-1.svg')}}">
                    <p>SAME DAY PAYMENT</p>
                </div>
                <div class="selling-info-element">
                    <img src="{{asset('/sell_images/image-2.svg')}}">
                    <p>FREE POSTAGE</p>
                </div>
                <div class="selling-info-element">
                    <img src="{{asset('/sell_images/image-3.svg')}}">
                    <p>DATE IS ALWAYS PROTECTED</p>
                </div>
                <div class="selling-info-element">
                    <img src="{{asset('/sell_images/image-4.svg')}}">
                    <p>BAMBOO PRICE OR YOUR DEVICE BACK FREE</p>
                </div>
            </div>

            <div class="home-element about-container">
                <div class="about-top-container">
                    <div class="about-element-container">
                        <div class="center-title-container">
                            <p>About bamboo</p>
                        </div>
                        <p class="about-bamboo-text">Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent non est id leo viverra porttitor. Vivamus iaculis nisl non hend.</p>
                        <div class="grading-show-more-container">
                            <a href="#"><div class="grading-show-more-btn">
                                <p>Read More</p>
                            </div></a>
                        </div>    
                    </div>
            
                    <div class="about-image-container">
                        <div class="about-image">
                            <p>Space for image</p>
                        </div>
                    </div>
                </div>

                <div class="about-bottom-container">
                    <div class="about-images-container">
                        <div class="about-images" id="top-image">
                            <p>Space for image</p>
                        </div>
                        <div class="about-images" id="bottom-image">
                            <p>Space for image</p>
                        </div>
                    </div>

                    <div class="sustainability-element-container">
                        <div class="center-title-container">
                            <p>Sustainability</p>
                        </div>
                        <p class="about-bamboo-text">Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent non est id leo viverra porttitor. Vivamus iaculis nisl non hend.</p>
                        <div class="grading-show-more-container">
                            <a href="#"><div class="grading-show-more-btn">
                                <p>Read More</p>
                            </div></a>
                        </div>   
                    </div>
                </div>
            </div>

            <div class="selling-service-container">
                <div class="selling-service-container-image">
                    <img src="{{asset('/customer_page_images/body/Icon-Trust.svg')}}">
                </div>
                <div class="selling-service-container-text">
                    <p class="service-header-1" >Service & Support</p>
                    <p class="service-header-2">A lot of our queries can be found within our Service & Support section</p>
                </div>
                <div class="selling-service-container-arrow">
                    <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                </div>
            </div>

            <div class="home-element home-links-container">
        
                <div class="home-links-element">
                    <a href="#">
                        <div class="home-link-container" id="news">
                            <p>News & Blog</p>
                            <img src="{{asset('/customer_page_images/body/home-link-images/home-links-1.svg')}}">
                        </div>
                    </a>
                </div>
        
                <div class="home-links-element">
                    <a href="#">
                        <div class="home-link-container" id="service">
                            <p>Service & Support</p>
                            <img src="{{asset('/customer_page_images/body/home-link-images/home-links-2.svg')}}">
                        </div>
                    </a>
                </div>
        
                <div class="home-links-element">
                    <a href="#">
                        <div class="home-link-container" id="contact">
                            <p>Contact us</p>
                            <img src="{{asset('/customer_page_images/body/home-link-images/home-links-3.svg')}}">
                        </div>
                    </a>
                </div>
        
            </div>

            <div class="home-element sign-up">
        
                <div class="center-title-container">
                    <p>Sign up to our newsletter!</p>
                </div>
        
                <div class="text-center-container">
                    <p>amazing offers, hints and tips and just awesome-ness</p>
                </div>
        
                <form action="/" method="POST">
                    @csrf
        
                    <input class="email-input" type="email" placeholder="Enter email address here">
                    <input class="email-submit" type="submit" value="Sign me up!">
        
                </form>
        
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

        <footer>@include('customer.layouts.footer')</footer>
        <script>

            function showRegistrationForm(){
                if(!document.getElementsByClassName('modal-second-element')[0].classList.contains('modal-second-element-active')){
                    document.getElementsByClassName('modal-second-element')[0].classList.add('modal-second-element-active');
                }
            }

        </script>
    </body>
</html>