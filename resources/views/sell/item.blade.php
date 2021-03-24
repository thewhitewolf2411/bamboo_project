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
            <div class="col text-center sell-item">
                <a class="back-results-sell sell-item-back  ml-5" href="/sell">
                    <img class="back-icon-results" src="{{asset('/images/front-end-icons/black_arrow_left.svg')}}">
                    <p class="results-back selling">Back to Search</p>
                </a>
            </div>

            <div class="single-product-container">
                {{-- {!!dd($product)!!} --}}
                <div class="product-image-container">
                    @if($product->product_image === 'default_image')
                        <img src="{{asset('/images/placeholder_phone_image.png')}}">
                    @else
                        <img src="{{asset('/storage/product_images').'/'.$product->product_image}}">
                    @endif
                </div>
                <div class="product-data">
                    <div class="product-selected product-name-container">
                        <p class="product-title">{{$product->product_name}}</p>
                    </div>

                    @if(!$networks->isEmpty())
                        <div class="product-selected product-network-container" id="product-network-container">
                            <div class="row m-0">
                                <p class="select-shopping-option-title m-0 mb-1">Select Network:</p>
                                <div id="selected-network"></div>
                            </div>

                            <div class="d-flex">
                            @foreach($networks as $network)
                                <div><label class="network-container mr-3" id="{{$network->getNetWorkName($network->network_id)}}" for="network-{{$network->id}}"><img src="{{$network->getNetWorkImage($network->network_id)}}"></label></div>
                            @endforeach
                            </div>

                            <div class="d-flex">
                            @foreach($networks as $network)
                                <input class="device-network" id="network-{{$network->id}}" name="network" value="{{$network->knockoff_price}}" onchange="networkChanged(this)" type="radio">
                            @endforeach
                            </div>
                        </div>
                    @endif
                    
                    @if(!$productInformation->isEmpty())
                        <div class="product-selected product-memory-container">
                            <div class="row m-0">
                                <p class="select-shopping-option-title m-0 mb-1">Select Memory:</p>
                                <div id="selected-gb"></div>
                            </div>

                            <div class="d-flex">
                            @foreach($productInformation as $info)
                                <div id="memory-box-{{$info->memory}}" class="device-memory"><label class="memory-container mr-3" id="{{$info->memory}}" for="info-{{$info->id}}">{{$info->memory}}</label></div>
                            @endforeach
                            </div>

                            <div class="d-flex">
                            @foreach($productInformation as $info)
                                <input id="info-{{$info->id}}" name="info" value='{ "price1": {{$info->excellent_working}}, "price2": {{$info->good_working}}, "price3": {{$info->poor_working}}, "price4": {{$info->damaged_working}}, "price5": {{$info->faulty}}}' type="radio" onchange="memoryChanged(this)">
                            @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="product-selected product-grade-container selling-item-grades-container">
                        <div class="row m-0">
                            <p class="select-shopping-option-title m-0 mb-1">Select Grade:</p>
                            <div id="selected-grade"></div>
                        </div>

                        <div class="">
                            <div class="d-flex grade-options-container" id="grades-text">
                                <label class="elem-grade-container ml-0 mr-2" id="grade-1-text" for="grade-1">Excellent Working</label>
                                <label class="elem-grade-container ml-0 mr-2" id="grade-2-text" for="grade-2">Good Working</label>
                                <label class="elem-grade-container ml-0 mr-2" id="grade-3-text" for="grade-3">Poor Working</label>
                                <label class="elem-grade-container ml-0 mr-2" id="grade-4-text" for="grade-4">Damaged Working</label>
                                <label class="elem-grade-container ml-0 mr-2" id="grade-5-text" for="grade-5">Faulty</label>
                            </div>
                            <div class="row m-0 mt-2">
                                <a role="button" class="my-auto ml-0" data-toggle="modal" data-target="#gradesModal"><label class="d-flex ml-0 mr-3 my-auto"><img class="grades-info-img" src="{{asset('/customer_page_images/body/Icon-Information.png')}}" class="mx-3"><p class="pt-2">What do these grades mean?</p></label></a>
                            </div>
                        </div>
                    
                        <div class="d-flex selling-item-grades-container">
                            <input id="grade-1" name="grade" type="radio" value="1" onchange="gradeChanged(this @if($networks->isEmpty()), true @endif) ">
                            <input id="grade-2" name="grade" type="radio" value="2" onchange="gradeChanged(this @if($networks->isEmpty()), true @endif) ">
                            <input id="grade-3" name="grade" type="radio" value="3" onchange="gradeChanged(this @if($networks->isEmpty()), true @endif) ">
                            <input id="grade-4" name="grade" type="radio" value="4" onchange="gradeChanged(this @if($networks->isEmpty()), true @endif) ">
                            <input id="grade-5" name="grade" type="radio" value="5" onchange="gradeChanged(this @if($networks->isEmpty()), true @endif) ">
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="d-flex flex-column mb-1">
                            <p>You don't need to send your charger, accessories or the original box!</p>
                        </div>
                    </div>

                    @if(str_contains(strtolower($product->product_name), 'samsung galaxy note'))
                        <div class="d-flex flex-column mb-2 samsung-note-alert">
                            Please remember to include your stylus with the Note
                        </div>
                    @endif

                    {{-- <div class="d-flex">
                        <div class="d-flex flex-column">
                            <p>Do you have a smartphone to trade in? You could save up to £320*</p>
                            <a href="" class="my-auto mx-0"><label class="ml-0 mr-3 my-auto"><img src="{{asset('/customer_page_images/body/Icon-Information.png')}}" class="mr-3">How does this work?</label></a>
                        </div>
                    </div> --}}


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
                                <button id="addToCart" type="submit" class="btn btn-primary btn-orange" disabled>Sell my device</button>
                            </div>
                        </form>

                        @if(Session::has('productaddedtocart'))
                            <p>Product has been added to basket. </p>
                        @endif
                    </div>
                    @else
                    <div class="add-to-container">
                        <div class="add-to-cart-container">
                            <button type="submit" class="btn btn-primary btn-orange" onclick="showModal()">Sell my device</button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
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
            </div> --}}
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
        
                    <div class="terms-container">
                        <input type="checkbox" class="mx-3" id="terms" name="terms" required>
                        <label for="terms">I agree to Bamboo Mobile <a href="/terms">Terms and Conditions</a></label>
                    </div>
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
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header grades border-0">
                            <p class="grades-info-header-text">Select condition</p>
                            <div class="close-grades-box">
                                <button type="button" class="close close-grades-modal-button" data-dismiss="modal" aria-label="Close">
                                    {{-- <span aria-hidden="true"> --}}
                                        <img class="close-grades-img" src="{{ url('/images/front-end-icons/close_modal_orange.svg') }}">
                                    {{-- </span> --}}
                                </button>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="grades-toggle-items">
                                <div class="toggle-grade-section selected-grade mr-2 ml-1" id="toggle-excellent">Excellent working</div>
                                <div class="toggle-grade-section ml-2 mr-2" id="toggle-good">Good working</div>
                                <div class="toggle-grade-section ml-2 mr-2" id="toggle-poor">Poor working</div>
                                <div class="toggle-grade-section ml-2 mr-2" id="toggle-damaged">Damaged working</div>
                                <div class="toggle-grade-section ml-2 mr-1" id="toggle-faulty">Faulty</div>
                            </div>

                            <div class="grades-descriptions">
                                <div class="grade-section-description ml-1 mr-1 mb-1 selected-grade-desc" id="excellent-description">
                                    <div class="grade-desc-column">
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Handset/Device is fully functional, working and complete</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Minor wear and tear is acceptable </p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No physical damage (i.e. cracks, chips to device or screen or bent chassis)</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Must not have any Water Damage</p>
                                    </div>
                                    <div class="grade-desc-column">
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Touch / Face ID must be working</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No FMIP, iCloud lock, Google locks or Pin / Password Locks</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Knox disabled</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Blocked, Stolen or fake items </p>
                                    </div>
                                </div>

                                <div class="grade-section-description ml-1 mr-1 mb-1 selected-grade-desc hidden" id="good-description">
                                    <div class="grade-desc-column">
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Handset/Device is fully functional, working and complete</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Very Minor wear and tear is acceptable</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No physical damage (i.e. cracks, chips to device or screen or bent chassis)</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Must not have any Water Damage</p>
                                    </div>
                                    <div class="grade-desc-column">
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Touch / Face ID must be working</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No FMIP, iCloud lock, Google locks or Pin / Password Locks</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Knox disabled</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Blocked, Stolen or fake items </p>
                                    </div>
                                </div>

                                <div class="grade-section-description ml-1 mr-1 mb-1 selected-grade-desc hidden" id="poor-description">
                                    <div class="grade-desc-column">
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Handset/Device is fully functional, working and complete</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Mid / Heavy wear and tear is acceptable  </p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No physical damage (i.e. cracks, chips to device or screen or bent chassis)</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Must not have any Water Damage</p>
                                    </div>
                                    <div class="grade-desc-column">
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Touch / Face ID must be working</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No FMIP, iCloud lock, Google locks or Pin / Password Locks</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Knox disabled</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Blocked, Stolen or fake items </p>
                                    </div>
                                </div>

                                <div class="grade-section-description ml-1 mr-1 mb-1 selected-grade-desc hidden" id="damaged-description">
                                    <div class="grade-desc-column">
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Handset/Device is fully functional, working and complete</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Mid / Heavy wear and tear is acceptable (i.e. heavy scratches or small dents) </p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Only physical damage acceptable are cracked or chipped digitiser or glass back</p>
                                    </div>
                                    <div class="grade-desc-column">
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Touch / Face ID must be working</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No FMIP, iCloud lock, Google locks or Pin / Password Locks</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Knox disabled</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Blocked, Stolen or fake items </p>
                                    </div>
                                </div>

                                <div class="grade-section-description ml-1 mr-1 mb-1 selected-grade-desc hidden" id="faulty-description">
                                    <div class="grade-desc-column">
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Handset/Device is NOT fully functional</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Heavy wear and tear is acceptable (i.e. heavy scratches or small dents) </p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">All components must be intact and device cannot be snapped into pieces</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Significant physical damage / Water damage</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Dust under screens or cameras</p>
                                    </div>
                                    <div class="grade-desc-column">
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Touch / Face ID must be working</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No FMIP, iCloud lock, Google locks or Pin / Password Locks</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">Software faulty </p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Knox disabled</p>
                                        <p class="grade-desc-item"><img class="grade-desc-tick" src="{{ url('/images/front-end-icons/black_tick_selected.svg') }}">No Blocked, Stolen or fake items </p>
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

        function showModal(){
            $('#loginModal').modal('show');
        }


        let buttons = document.getElementsByClassName('toggle-grade-section');
        for (let index = 0; index < buttons.length; index++) {
            let button = buttons[index];
            button.onclick = function() {changeGradeSection(button.id)};
        }

        function changeGradeSection(id){
            let btn = document.getElementById(id);
            let splitted = id.split('-');
            let section = splitted[1];
            let section_container = document.getElementById(section+'-description')
            if(btn.classList.contains('selected-grade')){
                
            } else {
                $('.toggle-grade-section').removeClass('selected-grade');
                $('.grade-section-description').addClass('hidden');

                btn.classList.add('selected-grade');
                section_container.classList.remove('hidden');
            }
        }

    </script>
    </body>
</html>