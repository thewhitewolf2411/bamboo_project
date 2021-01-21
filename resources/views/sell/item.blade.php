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

        <script src="{{asset('js/Price.js')}}"></script>
    </head>

    <body>
        <header>@include('customer.layouts.header')</header>
        <main>


            <div class="single-product-container">

                <div class="product-image-container">
                    <img src="{{asset('/storage/product_images').'/'.$product->product_image}}">
                </div>
                <div class="product-data">
                    <div class="product-selected product-name-container">
                        <p class="product-title">{{$product->product_name}}</p>
                    </div>

                    @if(!$networks->isEmpty())
                        <div class="product-selected product-network-container" id="product-network-container">
                            <p>Select Network:</p>

                            <div class="d-flex">
                            @foreach($networks as $network)
                                <div><label class="network-container mr-3" id="{{$network->getNetWorkName($network->network_id)}}" for="network-{{$network->id}}"><img src="{{$network->getNetWorkImage($network->network_id)}}"></label></div>
                            @endforeach
                            </div>

                            <div class="d-flex">
                            @foreach($networks as $network)
                                <input id="network-{{$network->id}}" name="network" value="{{$network->knockoff_price}}" onchange="networkChanged(this)" type="radio">
                            @endforeach
                            </div>
                        </div>
                    @endif
                        
                    <div class="product-selected product-memory-container">
                        <p>Select Memory:</p>

                        <div class="d-flex">
                        @foreach($productInformation as $info)
                            <div><label class="memory-container mr-3" id="{{$info->memory}}" for="info-{{$info->id}}">{{$info->memory}}</label></div>
                        @endforeach
                        </div>

                        <div class="d-flex">
                        @foreach($productInformation as $info)
                            <input id="info-{{$info->id}}" name="info" value='{ "price1": {{$info->excellent_working}}, "price2": {{$info->good_working}}, "price3": {{$info->poor_working}}, "price4": {{$info->damaged_working}}, "price5": {{$info->faulty}}}' type="radio" onchange="memoryChanged(this)">
                        @endforeach
                        </div>
                    </div>

                    <div class="product-selected product-grade-container">
                        <p>Select Grade:</p>

                        <div class="">
                            <div class="d-flex">
                                <label class="elem-grade-container ml-0 mr-2" for="grade-1">Excellent Working</label>
                                <label class="elem-grade-container ml-0 mr-2" for="grade-2">Good Working</label>
                                <label class="elem-grade-container ml-0 mr-2" for="grade-3">Poor Working</label>
                                <label class="elem-grade-container ml-0 mr-2" for="grade-4">Damaged Working</label>
                                <label class="elem-grade-container ml-0 mr-2" for="grade-5">Faulty</label>
                                <a role="button" class="my-auto" data-toggle="modal" data-target="#gradesModal"><label class="ml-0 mr-3 my-auto"><img src="{{asset('/customer_page_images/body/Icon-Information.png')}}" class="mx-3">What do these grades mean?</label></a>
                            </div>
                        </div>
                    
                        <div class="d-flex">
                            <input id="grade-1" name="grade" type="radio" value="1" onchange="gradeChanged(this @if($networks->isEmpty()), true @endif) ">
                            <input id="grade-2" name="grade" type="radio" value="2" onchange="gradeChanged(this @if($networks->isEmpty()), true @endif) ">
                            <input id="grade-3" name="grade" type="radio" value="3" onchange="gradeChanged(this @if($networks->isEmpty()), true @endif) ">
                            <input id="grade-4" name="grade" type="radio" value="4" onchange="gradeChanged(this @if($networks->isEmpty()), true @endif) ">
                            <input id="grade-5" name="grade" type="radio" value="5" onchange="gradeChanged(this @if($networks->isEmpty()), true @endif) ">
                        </div>
                    </div>

                    <div class="d-flex">
                    
                        <div class="d-flex flex-column">
                            <p>Do you have a smartphone to trade in? You could save up to £320*</p>
                            <a href="" class="my-auto mx-0"><label class="ml-0 mr-3 my-auto"><img src="{{asset('/customer_page_images/body/Icon-Information.png')}}" class="mr-3">How does this work?</label></a>
                        </div>
                    
                    </div>


                    <div class="">
                    
                        <a href="" class="border-bottom">Reset filters</a>

                    </div>

                    <div class="product-selected product-price-container">
                        <p id="product-price">

                        </p>
                    </div>


                    @if(Auth::user())
                    <div class="add-to-container">
                        <form action="/sell/shop/item/addtocart" method="POST">
                            <div class="add-to-cart-container">
                                @csrf
                                <input type="hidden" name="productid" value="{{$product->id}}">
                                <input type="hidden" name="grade" id="grade"></input>
                                <input type="hidden" name="network" id="network"></input>
                                <input type="hidden" name="memory" id="memory"></input>
                                <input type="hidden" name="price" id="price"></input>
                                <input type="hidden" name="type" value="tradein"></input>
                                <button id="addToCart" type="submit" class="btn btn-primary btn-orange" disabled>Add to cart</button>
                            </div>
                        </form>

                        @if(Session::has('productaddedtocart'))
                            <p>Product was added to the cart. </p>
                        @endif
                    </div>
                    @else
                    <div class="add-to-container">
                        <div class="add-to-cart-container">
                            <button type="submit" class="btn btn-primary btn-orange" onclick="showModal()">Add to cart</button>
                        </div>
                    </div>
                    @endif
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

            <div class="modal fade" id="gradesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><img src="{{ url('/customer_page_images/body/modal-close.svg') }}"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-between p-3" style="color: white !important;">
                                <div class="col-md-2"><h3>Excellent working</h3><ul><li>Handset/Device is fully functional, working and complete</li><li>Very Minor wear and tear is acceptable </li><li>No physical damage (i.e. cracks, chips to device or screen or bent chassis)</li><li>Must not have any Water Damage</li><li>Touch / Face ID must be working</li><li>No FMIP, iCloud lock, Google locks or Pin / Password Locks</li><li>No Blocked, Stolen or fake items </li></ul></div>
                                <div class="col-md-2"><h3>Good working</h3><ul><li>Handset/Device is fully functional, working and complete</li><li>Minor wear and tear is acceptable  </li><li>No physical damage (i.e. cracks, chips to device or screen or bent chassis)</li><li>Must not have any Water Damage</li><li>Touch / Face ID must be working</li><li>No FMIP, iCloud lock, Google locks or Pin / Password Locks</li><li>No Blocked, Stolen or fake items </li></ul></div>
                                <div class="col-md-2"><h3>Poor working</h3><ul><li>Handset/Device is fully functional, working and complete</li><li>Mid / Heavy wear and tear is acceptable  </li><li>No physical damage (i.e. cracks, chips to device or screen or bent chassis)</li><li>Must not have any Water Damage</li><li>Touch / Face ID must be working</li><li>No FMIP, iCloud lock, Google locks or Pin / Password Locks</li><li>No Blocked, Stolen or fake items </li></ul></div>
                                <div class="col-md-2"><h3>Damaged working</h3><ul><li>Handset/Device is fully functional, working and complete</li><li>Mid / Heavy wear and tear is acceptable (i.e. heavy scratches or small dents)  </li><li>Only physical damage acceptable are cracked or chipped digitiser or glass back</li><li>Touch / Face ID must be working</li><li>No FMIP, iCloud lock, Google locks or Pin / Password Locks</li><li>No Blocked, Stolen or fake items </li></ul></div>
                                <div class="col-md-2"><h3>Faulty</h3><ul><li>Handset/Device is NOT fully functional</li><li>Heavy wear and tear is acceptable (i.e. heavy scratches or small dents) </li><li>All components must be intact and device cannot be snapped into pieces</li><li>Significant physical damage / Water damage</li><li>Dust under screens or cameras</li><li>Touch / Face ID does not work</li><li>Software faulty </li><li>No FMIP, iCloud lock, Google locks or Pin / Password Locks </li><li>No Blocked, Stolen or fake items </li></ul></div>
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

        function showModal(){
            $('#loginModal').modal('show');
        }

    </script>
    </body>
</html>