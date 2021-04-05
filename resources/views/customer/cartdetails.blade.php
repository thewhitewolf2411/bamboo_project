<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

                
        <title>Bamboo Mobile</title>

        <link rel="icon" type="image/png" sizes="96x96" href="/customer_page_images/header/favicon-96x96.png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">        

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


        <script src="https://try.access.worldpay.com/access-checkout/v1/checkout.js"></script>
        <script src="{{ asset('/js/Payment.js')}} "></script>
        <script src="https://cdn.worldpay.com/v1/worldpay.js"></script>

        <script src="{{asset('/js/Addressian.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/easy-autocomplete.min.css">

    </head>
    <body>
        <header>@include('customer.layouts.header')</header>
        <main>
            <div class="shop-top-header" style="margin: 0;">
                <div class="center-title-container">
                    <div class="let-top-container">
                        <div class="center-title-container">
                            <p> Your details </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart-breadcrumbs p-3 ml-5">
                <p class="black-cart-info-text m-0 mr-2">Basket</p>
                <img class="mr-2 ml-2" src="{{asset('/images/front-end-icons/arrow_right_black.svg')}}">
                <p class="black-cart-info-text m-0 ml-2 mr-2">Your details</p>
                <img class="mr-2 ml-2" src="{{asset('/images/front-end-icons/arrow_right_black.svg')}}">
                <p class="grey-cart-info-text m-0 ml-2">Confirmation</p>
            </div>

            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
            @endif


                @if(Session::has('barcode'))

                    <script>
                        $.ajax({
                            url: "/cart/printtradein",
                            method:"POST",
                            data:{
                                _token: "{!! csrf_token() !!}",
                                user:{!! Auth::User() !!},
                                tradein:{!! Session::get('tradein') !!},
                                
                            },
                            success:function(response){
                                console.log(response['code'], response.code);
                                if(response['code'] == 200){
                                    $('#tradein-iframe').attr('src', '/' + response['filename']);
                                    $('#label-trade-in-modal').modal('show');
                                }
                            },
                        });
                    </script>

                @endif

                @if(Auth::user())
                    <div class="d-flex p-5 ml-5 cartdetails-container">

                        <div class="d-flex flex-column w-75 cartdetails-type">
                            <h3>Your details</h3>

                            <div class="trade-pack-type w-75 cartdetails-type-subcontainer">
                                <div class="col m-0 p-4">
                                    <p class="title-trade-pack-type-large">How would you like to send your device?</p>
                                    <p class="title-trade-pack-type">Please select how you would like to send your device(s) to us</p>

                                    <div class="select-pack-type mt-4">

                                        <div class="order-label-print-type m-2" id="bamboo-print-selected" onclick="selectType('bamboo')">
                                            <div class="col p-0">
                                                <img class="order-label-print-svg" src="{{asset('/customer_page_images/body/free_bamboo_trade_pack.svg')}}">
                                                <p class="order-label-print-text">FREE bamboo <br>Trade Pack</p>
                                                <img class="order-label-select-svg" id="bamboo-print-selected-tick" src="{{asset('/customer_page_images/body/orange_deselected.svg')}}">
                                            </div>
                                        </div>

                                        <div class="order-label-print-type m-2" id="own-print-selected" onclick="selectType('own')">
                                            <div class="col p-0">
                                                <img class="order-label-print-svg" src="{{asset('/customer_page_images/body/free_print_own_label.svg')}}">
                                                <p class="order-label-print-text">FREE print your <br>own label</p>
                                                <img class="order-label-select-svg" id="own-print-selected-tick" src="{{asset('/customer_page_images/body/orange_deselected.svg')}}">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                
                            </div>

                        </div>

                        <div class="d-flex flex-column w-25 pb-3 ml-2 cartdetails-summary">
                            <div class="order-summary-cart flex-column">
                                <p class="order-summary-bold w-100">Order Summary</p>

                                @if($hasTradeOut)
                                <p style="display: flex; align-items: center;">Price to pay: £{{$fullprice}}</p>
                                @endif
                                
                                @if($hasTradeIn)
                                    <div class="summary-cart">
                                        <p class="summary-cart-text">Subtotal</p>
                                        <p class="summary-cart-text">£{{$sellPrice}}</p>
                                    </div>
                                    <div class="summary-cart">
                                        <p class="summary-cart-text-bold">TOTAL</p>
                                        <p class="summary-cart-text-bold">£{{$sellPrice}}</p>
                                    </div>
                                    {{-- <select class="form-control my-3" onchange="changelabelstatus(this)">
                                        <option value="1" selected>Make an order without printing label</option>
                                        <option value="2">Print and send trade label yourself</option>
                                    </select> --}}
                                @endif   
                            </div>

                            @if($hasTradeIn)
                                <div class="form-container">

                                    <form action="/cart/sell" method="POST">
                                        @csrf
                            
                                        <input type="hidden" id="label_status" name="label_status" value="1">

                                        <button type="submit" id="submit-sell" disabled class="btn btn-orange w-100 mt-2">Sell my device</button>
                    
                                    </form>
                    
                                    <script>
                                        function changelabelstatus(value){
                                            document.getElementById('label_status').value = value.value;
                                        }
                                    </script>

                                </div>
                            @endif

                        </div>

                    </div>
                @else
                    <div class="d-flex p-5 ml-5 cartdetails-container" id="complete-registration">


                        <div class="d-flex flex-column pb-3 ml-2 create-account-container w-75">
                            <h2>Your details</h2>
                            <div class="create-account-yourdetails mr-5 p-4">
                                <p class="create-title mb-4">Create an account</p>

                                <form method="POST" action="{{route('completeRegistration')}}">
                                    @csrf

                                    <div class="row m-0">
                                        <div class="col-4 p-0 m-0 mr-5">
                                            <label for="first_name">First Name*</label>
                                            <input class="form-control" type="text" name="first_name" required>
                                        </div>
                                        <div class="col-4 p-0 m-0">
                                            <label for="last_name">Last Name*</label>
                                            <input class="form-control" type="text" name="last_name" required>
                                        </div>
                                    </div>
                                    <div class="row m-0">
                                        <div class="col-4 p-0 mb-4">
                                            <label>Date of Birth</label>
                                            @include('partial.birthdate')
                                        </div>
                                    </div>
                                    <div class="row m-0">
                                        <div class="col-4 p-0 m-0">
                                            <label for="first_name">Email address*</label>
                                            <input class="form-control" type="text" name="email" value="{!!Session::get('session_email')!!}" required>
                                        </div>
                                    </div>
                                    <div class="row m-0">
                                        <div class="form-group col-8 p-0 m-0">
                                            <label for="delivery_address">Delivery Address</label>
                                            <input class="form-control js-typeahead" type="text" id="delivery_address" name="delivery_address" placeholder="Example delivery address" required>
                                        </div>
                                    </div>
                                    <div class="row m-0">
                                        <div class="form-group col-8 p-0 m-0">
                                            <label for="billing_address">Billing Address</label>
                                            <input class="form-control js-typeahead" type="text" id="billing_address" name="billing_address" placeholder="Example billing address" required>
                                        </div>
                                    </div>
                                    <div class="row m-0">
                                        <div class="col-4 m-0 p-0 mr-5">
                                            <label for="first_name" class="mb-2">Current phone</label>
                                            <select class="selectpicker form-control" data-show-subtext="true" data-live-search="true" name="current-phone">
                                                <option value="" selected disabled>Your current phone</option>
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}">{{$product->product_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4 m-0 p-0">
                                            <label for="last_name" class="mb-2">Preffered OS</label>
                                            <select class="selectpicker form-control" name="preferred-os">
                                                <option value="" selected disabled>Preferred Operating System (OS)</option>
                                                <option>iOS</option>
                                                <option>Android</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row m-0 mt-2">
                                        <div class="col-12 m-0 p-0">
                                            <label for="password" class="verify-label">Select password*</label>
                                            <div class="row m-0 password-input">
                                                <input type="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,50}$" class="form-control" name="password" id="password" required class="verification-input" required/>
                                                <img class="toggle-pass-visibility" id="pass-visibility-toggle" onclick="togglePassVisibility()" src="{{asset('/images/front-end-icons/pass_invisible.svg')}}">
                                            </div>
                                            <div class="pass-info-requirements mb-2">
                                                Your password needs to be at least 8 characters long, contain an uppercase letter, a number and a symbol.
                                            </div>
                                            <div id="pass-check-info" class="pass-strength mt-0 mb-4">
                                                <div class="row m-0 ml-1">
                                                    <div id="progress">
                                                        <div id="bar"></div>
                                                    </div>
                                                    <div id="pass-strength" class="ml-3">Unsecure</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-0 newsletter-singup-row">
                                        <input type="checkbox" name="sub" id="newsletter-sub" class="hidden">
                                        <img class="newsletter-tick-black" id="newsletter-subscribe-check" onclick="toggleNewsletterSub()" src="{{asset('/images/front-end-icons/black_circle.svg')}}">
                                        <p class="newsletter-terms-text">
                                            In addition to receiving an instant email when you open your account with Bamboo, I agree to Bamboo sending 
                                            me a regular newsletter, carrying out market research, keeping me informed with personalised news, offers, 
                                            products and promotions it believes would be of interest to me through my preferred channel. 
                                        </p>
                                    </div>

                                    <div class="row">
                                        <button type="submit" class="btn btn-green ml-auto mr-auto mt-4">Sign me up!</button>
                                    </div>

                                    @if(Session::has('regerror'))
                                        <div class="alert alert-danger w-50 m-auto text-center" role="alert">
                                            {!!Session::get('regerror')!!}
                                        </div>
                                    @endif

                                </form>
                            </div>
                        </div>


                        <div class="d-flex flex-column w-25 pb-3 ml-2 cartdetails-summary">

                            <div class="order-summary-cart flex-column">
                                <p class="order-summary-bold w-100">Order Summary</p>

                                @if($hasTradeOut)
                                <p style="display: flex; align-items: center;">Price to pay: £{{$fullprice}}</p>
                                @endif
                                
                                @if($hasTradeIn)
                                    <div class="summary-cart">
                                        <p class="summary-cart-text">Subtotal</p>
                                        <p class="summary-cart-text">£{{$sellPrice}}</p>
                                    </div>
                                    <div class="summary-cart">
                                        <p class="summary-cart-text-bold">TOTAL</p>
                                        <p class="summary-cart-text-bold">£{{$sellPrice}}</p>
                                    </div>
                                    {{-- <select class="form-control my-3" onchange="changelabelstatus(this)">
                                        <option value="1" selected>Make an order without printing label</option>
                                        <option value="2">Print and send trade label yourself</option>
                                    </select> --}}
                                @endif   
                            </div>

                            @if($hasTradeIn)
                                <div class="form-container">

                                    <form action="/cart/sell" method="POST">
                                        @csrf
                            
                                        <input type="hidden" id="label_status" name="label_status" value="1">

                                        <button type="submit" id="submit-sell" disabled class="btn btn-orange w-100 mt-2">Sell my device</button>
                    
                                    </form>
                    
                                    <script>
                                        function changelabelstatus(value){
                                            document.getElementById('label_status').value = value.value;
                                        }
                                    </script>

                                </div>
                            @endif

                        </div>
                    </div>
                @endif

                

            {{-- @if(session('showLogin') || $errors->all())
                <script>
                    $(window).on('load',function(){
                        $('#loginModal').modal('show');
                    });
                </script>
            @endif --}}

 
        {{-- <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        </div> --}}

        <div id="label-trade-in-modal" class="modal fade" tabindex="-1" role="dialog" style="padding-right: 17px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Trade pack label</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="tradein-iframe"></iframe>
                </div>
                </div>
            </div>
		</div>

        
        {{-- <div class="modal fade" tabindex="-1" role="dialog" id="payment-container">
            <section class="modal-dialog" role="document">
                <section class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Payment details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <section class="modal-body">
                        <section class="container">
                            <section class="card">
                            <form action="/cart/buy" id="paymentForm" method="post">
                                <span id="paymentErrors"></span>
                                @csrf

                                <input type="hidden" name="price" value="{{$fullprice}}">
                                <div class="form-row">
                                    <label>Name on Card</label>
                                    <input data-worldpay="name" name="name" type="text" value="{{Auth::user()->first_name}} {{Auth::user()->last_name}}" />
                                </div>
                                <div class="form-row">
                                    <label>Card Number</label>
                                    <input data-worldpay="number" name="card_number" size="20" type="number" />
                                </div>
                                <div class="form-row">
                                    <label>Expiration (MM/YYYY)</label> 
                                    <input data-worldpay="exp-month" name="exp_month" size="2" type="number" /> 
                                    <label> / </label>
                                    <input data-worldpay="exp-year" name="exp_year" size="4" type="number" />
                                </div>
                                <div class="form-row">
                                    <label>CVC</label>
                                    <input data-worldpay="cvc" size="4" type="text" />
                                </div>
                                <input type="submit" value="Place Order" />
                            </form>
                            </section>
                        </section>
                    </section>

                </section>
            </section>
        </div> --}}
        

        </main>


        @if(session('showLogin'))
            <script>
                $(window).on('load',function(){
                    $('#loginModal').modal('show');
                });
            </script>
        @endif
        <footer>@include('customer.layouts.footer', ['showGetstarted' => false])</footer>    
    </body>

    <script>

        function toggleNewsletterSub(){
            let checkbox = document.getElementById('newsletter-sub');
            let img = document.getElementById('newsletter-subscribe-check');
            if(!img.classList.contains('ticked')){
                img.classList.add('ticked');
                img.src = "/images/front-end-icons/black_tick_selected.svg";
                checkbox.checked = true;
            } else {
                img.classList.remove('ticked');
                img.src = "/images/front-end-icons/black_circle.svg";
                checkbox.checked = false;
            }
        }

        function selectType(type){
            let owndiv = document.getElementById('own-print-selected');
            let owntick = document.getElementById('own-print-selected-tick');
            let bamboodiv = document.getElementById('bamboo-print-selected');
            let bambootick = document.getElementById('bamboo-print-selected-tick');
            let ordertype = document.getElementById('label_status');

            if(type === 'own'){
                owndiv.classList.add('selected');
                bamboodiv.classList.remove('selected');
                owntick.src = '/customer_page_images/body/orange_selected.svg';
                bambootick.src = '/customer_page_images/body/orange_deselected.svg';
                ordertype.value = 2;
            }
            if(type === 'bamboo'){
                bamboodiv.classList.add('selected');
                owndiv.classList.remove('selected');
                owntick.src = '/customer_page_images/body/orange_deselected.svg';
                bambootick.src = '/customer_page_images/body/orange_selected.svg';
                ordertype.value = 1;
            }
            document.getElementById('submit-sell').disabled = false;
        }

        document.getElementById("password").addEventListener('keyup',  function(){
            checkNewPass()
        });

        function checkNewPass(){
            let pass = document.getElementById("password").value;
            let passcheck = document.getElementById("pass-check-info");

            pass = pass.trim();

            if(pass !== ""){
                // show pass info
                if(passcheck.classList.contains("hidden")){
                    passcheck.classList.remove("hidden");
                }
                // analyze pass

                let has_number = false;
                let has_symbol = false;
                let has_uppercase_letter = false;
                let has_ten_characters = false;
                
                // check length
                if(pass.length < 8){
                    has_ten_characters = false;
                } else {
                    has_ten_characters = true;
                }

                // check if it has a number
                let has_number_check = pass.match(/\d+/g);
                if(Array.isArray(has_number_check)){
                    has_number = true;
                } else {
                    has_number = false;
                }

                // check for symbols
                var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
                has_symbol = format.test(pass);

                // check for uppercase
                let countUpperCase = 0;
                let i = 0;
                while (i <= pass.length) {
                    const character = pass.charAt(i);
                    if (character === character.toUpperCase() && character !== character.toLowerCase()) {
                        countUpperCase++;
                    }
                    i++;
                }
                if(countUpperCase > 0){
                    has_uppercase_letter = true;
                }

                // bar percentage
                let percentage = '10%';

                if(has_ten_characters){
                    percentage = '25%';
                }
                if(has_number){
                    percentage = '50%';
                }
                if(has_symbol){
                    percentage = '75%';
                }
                if(has_uppercase_letter){
                    percentage = '100%';
                }

                let passqualityobj = {
                    has_ten_characters: has_ten_characters,
                    has_number: has_number,
                    has_symbol: has_symbol,
                    has_uppercase_letter: has_uppercase_letter
                };

                let pass_quality = 0;
                for (const [key, value] of Object.entries(passqualityobj)) {
                    if(value === true){
                        pass_quality++;
                    }
                }

                percentage = Math.round(pass_quality * 2.5) + "0%";

                // set bar percentage
                document.getElementById("bar").style.width = percentage;

                // pass text strength
                if(has_ten_characters && has_number && has_symbol && has_uppercase_letter){
                    document.getElementById("pass-strength").innerHTML = 'Fair';

                    // if(current.value && email.value){
                    //     if(save_btn.classList.contains('btn-secondary')){
                    //         save_btn.classList.remove('btn-secondary');
                    //         if(!save_btn.classList.contains('btn-orange')){
                    //             save_btn.classList.add('btn-orange');
                    //         }
                    //     }
                    //     if(save_btn.classList.contains('disabled')){
                    //         save_btn.classList.remove('disabled');
                    //     }
                    // }
                } else {

                    // if(!save_btn.classList.contains('btn-secondary')){
                    //     save_btn.classList.add('btn-secondary');
                    //     if(save_btn.classList.contains('btn-orange')){
                    //         save_btn.classList.remove('btn-orange');
                    //     }
                    // }
                    // if(!save_btn.classList.contains('disabled')){
                    //     save_btn.classList.add('disabled');
                    // }
                    

                    document.getElementById("pass-strength").innerHTML = 'Unsecure';
                }

                

            } else {
                if(!passcheck.classList.contains("hidden")){
                    passcheck.classList.add("hidden");
                }
            }
        }

        function togglePassVisibility(){

            var img = document.getElementById('pass-visibility-toggle');
            var pass = document.getElementById('password');
            
            if (pass.type === "password") {
                pass.type = "text";
                img.src = '/images/front-end-icons/pass_visible.svg';
                img.style.right = '7px';
            } else {
                img.src = '/images/front-end-icons/pass_invisible.svg';
                pass.type = "password";
                img.style.right = '5px';
            }
        }

        // var rand = Math.floor(10000000 + Math.random() * 900000);
        // document.getElementById('order_code').value = rand;

    </script>
</html>