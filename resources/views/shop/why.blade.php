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
            <div class="app">
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
                        <a href="/shop/category/compare"><div class="shop-link">Compare Models</div></a>
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
                <div class="let-top-container">
                    <div class="center-title-container">
                        <p>Why Shop With Us</p>
                    </div>
                </div>

                <div class="how-first-element">
                    <div class="d-flex flex-row justify-content-between border-down">
            
                        <div class="p-5 d-flex flex-column justify-content-between">
                            <div class="center-title-container">
                                <p>The benefits of shopping <br> With Bamboo Mobile</p>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus.</p>
                        </div>
                        <div class="p-5 d-flex flex-column justify-content-between">
                            <div class="shopping-video-container">
                                <p>Shopping With Us</p>
                                <a onclick="showgradingvideo()">
                                    <div class="video-image-container">
                                        <div class="play-container">
                                            <i class="fa fa-play" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </a>
                                <p>Explained</p>
                            </div>
                            <p>Watch our quick video explaining just how thorough our grading system is. Trust us, you will be shocked.</p>
                        </div>
                    </div>
                </div>

                <div class="selling-with-container">
                    <div class="center-title-container">
                        <p class="title-blue">Shopping with us</p>
                    </div>
    
                    <div class="selling-with-elements">
                        <div class="selling-with-element selling-with-right">
                            <div class="selling-text-container">
                                <p class="title-blue">Free Next Day Nationwide Delivery</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper.</p>
                            </div>
                            <div class="selling-img-container">
                                <img src="{{asset('/shop_images/why_images/image-1.svg')}}">
                            </div>
                        </div>
                        <div class="selling-with-element selling-with-left">
                            <div class="selling-img-container">
                                <img src="{{asset('/shop_images/why_images/image-2.svg')}}">
                            </div>
                            <div class="selling-text-container">
                                <p class="title-blue">Free Postage</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper.</p>
                            </div>
                        </div>
                        <div class="selling-with-element selling-with-right">
                            <div class="selling-text-container">
                                <p class="title-blue">GDPR compliant</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper.</p>
                            </div>
                            <div class="selling-img-container">
                                <img src="{{asset('/shop_images/why_images/image-3.svg')}}">
                            </div>
                        </div>
                        <div class="selling-with-element selling-with-left">
                            <div class="selling-img-container">
                                <img src="{{asset('/shop_images/why_images/image-4.svg')}}">
                            </div>
                            <div class="selling-text-container">
                                <p class="title-blue">Data is always protected</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper.</p>
                            </div>
                        </div>
                        <div class="selling-with-element selling-with-right">
                            <div class="selling-text-container">
                                <p class="title-blue">We help to Reduce, Reuse, Recycle</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper.</p>
                            </div>
                            <div class="selling-img-container">
                                <img src="{{asset('/shop_images/why_images/image-5.svg')}}">
                            </div>
                        </div>
                        <div class="selling-with-element selling-with-left">
                            <div class="selling-img-container">
                                <img src="{{asset('/shop_images/why_images/image-6.svg')}}">
                            </div>
                            <div class="selling-text-container">
                                <p class="title-blue">Bamboo Price or your device back for free</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper.</p>
                            </div>
                        </div>
                    </div>
    
                    <div class="selling-btn-container">
                        <a href="" class="btn btn-blue btn-primary">
                            Start Shopping
                        </a>
                    </div>
                </div>

                <div class="home-element grading-container">
                    <div class="center-title-container">
                        <p>Grading System Explained</p>
                    </div>
                    <div class="center-grading-elements">
                        <div class="grading-text-container">
                            <p>Watch our quick video explaining just how thorough our grading system is.<br>Trust us, you will be shocked.</p>
                        </div>
                        <div class="grading-video-container">
                            <a onclick="showgradingvideo()">
                                <div class="video-image-container">
                                    <div class="play-container">
                                        <i class="fa fa-play" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
            
                        <div class="grading-show-more-container">
            
                            <a href="#"><div class="grading-show-more-btn">
            
                                <p>Show More</p>
            
                            </div></a>
                        </div>
                    </div>
                </div>
    
                <div class="about-sustainability">
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
    
                <div class="shop-categories-container w-1000">
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
            
                    <form action="/" method="POST">
                        @csrf
            
                        <input class="email-input" type="email" placeholder="Enter email address here">
                        <input class="email-submit" type="submit" value="Sign me up!">
            
                    </form>
            
                </div>

            </div>
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