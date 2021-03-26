<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        
        
        <title>Bamboo Mobile::Recycle</title>

        <link rel="icon" type="image/png" sizes="96x96" href="/customer_page_images/header/favicon-96x96.png">
        
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

        <script src="{{ asset('js/Shop.js') }}"></script>
    </head>

    <body>
        <header>@include('customer.layouts.header')</header>
        <main>
            @include('customer.layouts.sellinglinks')
            {{-- <div class="assurance-container">
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
            </div> --}}
            <div class="col text-center mt-5">
                <a class="back-results-sell ml-5" href="/sell">
                    <img class="back-icon-results" src="{{asset('/images/front-end-icons/black_arrow_left.svg')}}">
                    <p class="results-back">Back</p>
                </a>

                @if($category === 'mobile')
                    <p class="results-upper mb-3">{!!$brandname!!} {!!$category!!} phones</p>
                @else
                    <p class="results-upper mb-3">{!!$brandname!!} {!!$category!!}</p>
                @endif

            </div>

            <div class="d-flex p-5">
                

                {{-- <div class="sidebar w-25">

                    <div class="sidebar-element d-flex">
                        <p>View:</p>
                        <select id="number_select" class="form-control w-50" >
                            <option value="&number=24">24 items</option>
                            <option value="&number=36">36 items</option>
                            <option value="&number=48">48 items</option>
                            <option value="&number=60">60 items</option>
                        </select>

                    </div>

                    <div class="sidebar-element d-flex">
                        <p>Category:</p>
                        <p>@if($category=='mobile') Mobile Phones @elseif($category=='tablets') Tablets @elseif($category=='watches') Smartwatches @endif</p>
                    </div>

                    <div class="sidebar-element d-flex" >
                        <p>View:</p>
                        <select id="brand_select" class="form-control w-50">
                            @foreach($brands as $brand)
                                <option value="&brand={{$brand->id}}">{{$brand->brand_name}}</option>
                            @endforeach
                        </select>

                    </div>

                </div> --}}

                <div class="products d-flex flex-wrap w-100">
                    @foreach($products as $product)

                        <a href="{{route('showSellItem', ['parameter' => $product->id])}}">

                            <div class="product">
                                <div class="selling-product-image-container">
                                    @if($product->product_image === 'default_image')
                                        <img src="{{asset('/images/placeholder_phone_image.png')}}">
                                    @else
                                        <img src="{{asset('/storage/product_images').'/'.$product->product_image}}">
                                    @endif
                                </div>
                                <div class="product-data-container">
                                    <h5>{{$product->product_name}}</h5>
                                </div>
                                <div class="go-to-selldevice mt-4">
                                    <img class="next-icon-results" src="{{asset('/images/front-end-icons/purple_arrow_next.svg')}}">
                                </div>

                            </div>

                        </a>

                    @endforeach
                </div>

            </div>

            <div class="pages d-flex justify-content-end w-100 p-5">
                <div class="d-flex">
                    @foreach($pages as $page)
                        <div class="d-flex px-3">
                            <a href="?page={{$page}}">
                                @if($currentpage == $page)
                                <div class="page-number-active">
                                    {{$page}}
                                </div>
                                @else
                                <div class="page-number">
                                    {{$page}}
                                </div>
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>                
            </div>

            <form id="search-parameters" method="GET" action="/sell/shop/mobile">

                <input type="hidden" name="page" value="{{$currentpage}}">
                <input type="hidden" name="number">
    
            </form>


            {{-- <div class="let-footer">
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
            </div> --}}

            {{-- <div class="shop-by-category">
                <div class="center-title-container">
                    <p>Shop by category</p>
                </div>
                <div class="shop-categories-container">
                    <a href="/sell/shop/mobile">
                        <div class="category-container">
                            <p class="shop-title">Shop</p>
                            <p class="category-title">Mobile Phones</p>
                            <div class="rounded-background-image" id="rounded-mobile">
                                <img src="{{asset('/shop_images/category-image-1.png')}}">
                            </div>
                        </div>
                    </a>
                    <a href="/sell/shop/tablets">
                        <div class="category-container">
                            <p class="shop-title">Shop</p>
                            <p class="category-title">Tablets</p>
                            <div class="rounded-background-image" id="rounded-tablets">
                                <img src="{{asset('/shop_images/category-image-2.png')}}">
                            </div>
                        </div>
                    </a>
                    <a href="/sell/shop/watches">
                        <div class="category-container">
                            <p class="shop-title">Shop</p>
                            <p class="category-title">Watches</p>
                            <div class="rounded-background-image" id="rounded-watches">
                                <img src="{{asset('/shop_images/category-image-3.png')}}">
                            </div>
                        </div>
                    </a>

                </div>
            </div> --}}

            {{-- <div class="home-element sign-up">
        
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
        
                    <div class="terms-container">
                        <input type="checkbox" class="mx-3" id="terms" name="terms" required>
                        <label for="terms">I agree to Bamboo Mobile <a href="/terms">Terms and Conditions</a></label>
                    </div>
                </form>
        
            </div> --}}

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

        {{-- <footer>@include('customer.layouts.footer', ['showGetstarted' => true])</footer> --}}

        <script>

            function showRegistrationForm(){
                if(!document.getElementsByClassName('modal-second-element')[0].classList.contains('modal-second-element-active')){
                    document.getElementsByClassName('modal-second-element')[0].classList.add('modal-second-element-active');
                }
            }

            $(window).on('load', function(){
                if(window.location.href.indexOf('number') > -1){
                    var param = 'number';
                    var url = window.location.href;
                    var tempArray = url.split("?");
                    var baseURL = tempArray[1];
                    var additionalURL = tempArray[1];
                    var temp = "";
                    if (additionalURL) {
                        tempArray = additionalURL.split("&");
                        for (var i=0; i<tempArray.length; i++){
                            if(tempArray[i].split('=')[0] == param){
                                $("#number_select").val(tempArray[i].split('=')[1]);
                            }
                        }
                    }
                }

                if(window.location.href.indexOf('brand') > -1){
                    var param = 'brand';
                    var url = window.location.href;
                    var tempArray = url.split("?");
                    var baseURL = tempArray[1];
                    var additionalURL = tempArray[1];
                    var temp = "";
                    if (additionalURL) {
                        tempArray = additionalURL.split("&");
                        for (var i=0; i<tempArray.length; i++){
                            if(tempArray[i].split('=')[0] == param){
                                $("#brand_select").val(tempArray[i].split('=')[1]);
                            }
                        }
                    }
                }
            });



        </script>
    </body>
</html>