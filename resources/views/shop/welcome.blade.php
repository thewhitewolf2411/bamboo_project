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
                <div class="shop-top-header">
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
                            <a href="/shop/category/compare"><div class="shop-link">Compare Models</div></a>
                        </div>
                        <div class="shop-menu-element">
                            <a href="/shop/why"><div class="shop-link">Why Shop With Us</div></a>
                        </div>
                        <div class="shop-menu-element">
                            <a href="/shop/let"><div class="shop-link">Let boo do it, for you</div></a>
                        </div>
                    </div>
                    <div class="shop-header-background">
                        <div class="latest-offer-container">
                            <div class="latest-offer-scroller">
                                @foreach($latestProducts as $latestProduct)
                                <div class="latest-product-container">
                                    <p>LATEST OFFER</p>
                                    <p class="latest-product-big">{{$latestProduct->product_name}}</p>
                                    <p>from only £{{$latestProduct->base_price}}</p>
                                    <a href="/shop/item/{{$latestProduct->id}}" class="btn btn-primary btn-white">Shop now</a>
                                </div>
                                @endforeach
                            </div>
                            <div class="circles-container">
                                <a onclick="">
                                    <div class="circle-container">
                                    
                                    </div>
                                </a>
                                <a onclick="">
                                    <div class="circle-container">
                                    
                                    </div>
                                </a>
                                <a onclick="">
                                    <div class="circle-container">
                                    
                                    </div>
                                </a>
                            </div>
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
                <div class="shop-by-category">
                    <div class="center-title-container">
                        <p>Shop by category</p>
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
                    <div class="shop-spilt">
                        <div class="shop-split-image">
                            <img src="{{asset('/shop_images/shop_split_image.png')}}">
                        </div>
                        <div class="shop-split-text">
                            <div class="shop-split-text-container">
                                <p class="shop-title">Spoilt for choice?</p>
                                <p class="category-title">Use our handy comparison tool <br> to find the best option for you.</p>
                            </div>
                            <div class="shop-split-arrow">
                                <img src="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shop-popular-brands">
                    <div class="center-title-container">
                        <p>Popular brands</p>
                    </div>
                    <div class="brands-container">
                        <div class="brand-container">
                            <img src="{{asset('/shop_images/brands/Image 13.png')}}">
                        </div>
                        <div class="brand-container">
                            <img id="img-smaller" src="{{asset('/shop_images/brands/Image 14.png')}}"">
                        </div>
                        <div class="brand-container">
                            <img src="{{asset('/shop_images/brands/Image 15.png')}}"">
                        </div>
                        <div class="brand-container">
                            <img src="{{asset('/shop_images/brands/Image 16.png')}}"">
                        </div>
                        <div class="brand-container">
                            <img src="{{asset('/shop_images/brands/Image 17.png')}}"">
                        </div>
                        <div class="brand-container">
                            <img src="{{asset('/shop_images/brands/Image 18.png')}}"">
                        </div>
                        <div class="brand-container">
                            <img src="{{asset('/shop_images/brands/Image 19.png')}}"">
                        </div>
                        <div class="brand-container">
                            <img src="{{asset('/shop_images/brands/Image 20.png')}}"">
                        </div>
                    </div>
                    <div class="d-flex" style="margin-bottom: 150px;">
                        <a href="#" class="category-title">Shop all Brands
                            <img src="">
                        </a>
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

                </div>
                <div class="home-element popular-devices">
                    <div class="center-title-container">
                        <p>Popular devices</p>
                    </div>
            
                    <div class="devices-container">
                        <div class="device-container">
                            <img src="{{asset('/customer_page_images/body/mobile-images/Image 3.png')}}">
                            <div class="category-text">
                                <p class="category-title">Apple</p>
                                <p class="model-title">iPhone X</p>
                            </div>
                        </div>
                        <div class="device-container">
                            <img src="{{asset('/customer_page_images/body/mobile-images/Image 4.png')}}">
                            <div class="category-text">
                                <p class="category-title">Apple</p>
                                <p class="model-title">iPad Pro 11 inch 2020</p>
                            </div>
                        </div>
                        <div class="device-container">
                            <img src="{{asset('/customer_page_images/body/mobile-images/Image 5.png')}}">
                            <div class="category-text">
                                <p class="category-title">Samsung</p>
                                <p class="model-title">Galaxy A10</p>
                            </div>
                        </div>
                        <div class="device-container">
                            <img src="{{asset('/customer_page_images/body/mobile-images/Image 6.png')}}">
                            <div class="category-text">
                                <p class="category-title">Apple</p>
                                <p class="model-title">Watch Series 5 44mm</p>
                            </div>
                        </div>
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

            $('document').ready(function(){
                var slideElements = $('.latest-product-container');
                var circles = $('.circle-container');
                for(var i=0; i<slideElements.length; i++){
                    if(i == 0){
                        slideElements[i].classList.add('latest-product-active');
                        circles[i].classList.add('circle-container-active');
                        break;
                    }
                }
            });

            var k = 0;

            setInterval(() => {
                k++;
                console.log(k);
                if(k == 3){k = 0;}

                var slideElements = $('.latest-product-container');
                var circles = $('.circle-container');

                for(var i = 0; i<3; i++){
                    slideElements[i].classList.remove('latest-product-active');
                    circles[i].classList.remove('circle-container-active');
                }

                slideElements[k].classList.add('latest-product-active');
                circles[k].classList.add('circle-container-active');
                
            }, 10000);

        </script>
    </body>

</html>