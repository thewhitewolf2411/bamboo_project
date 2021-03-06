@extends('customer.layouts.layout')

@section('content')

    {{-- <div class="shop-top-header" style="margin: 0;">
        <div class="center-title-container">
            <div class="let-top-container">
                <div class="center-title-container">
                    <p> Your details </p>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="page-header-container yourdetails">
        <p class="page-header-text">Your details</p>
    </div>

    <div class="cart-breadcrumbs yourdetails ml-5 p-5 pb-0">
        <p class="black-cart-info-text m-0 mr-2">Basket</p>
        <img class="mr-2 ml-2" src="{{asset('/images/front-end-icons/arrow_right_black.svg')}}">
        <p class="black-cart-info-text m-0 ml-2 mr-2">Your details</p>
        <img class="mr-2 ml-2" src="{{asset('/images/front-end-icons/arrow_right_black.svg')}}">
        <p class="grey-cart-info-text m-0 ml-2">Confirmation</p>
    </div>

    @if(Session::has('success'))
        <div class="alert alert-success w-75 ml-auto mr-auto mb-4 text-center" role="alert">
            {{Session::get('success')}}
        </div>
    @endif

    @if(Auth::user())
        <form action="/cart/sell" method="POST">
            @csrf

            <div class="d-flex cartdetails-container">

                <div class="d-flex flex-column cartdetails-type">
                    <p class="welcome-basket-details">Your details</p>

                    <div class="welcome-user-container mb-4">
                        <p class="welcome-bold">Woohoo! You're all signed in</p>
                        <div class="cartdetails-user-info-row">
                            <img class="welcome-img" src="{{asset('/customer_page_images/body/emoji_laughing.svg')}}">
                            <p class="welcome-small">Welcome back, {!!Auth::user()->first_name!!}</p>
                        </div>
                    </div>

                    <div class="cartdetails-summary-mobile">
                        <p class="order-summary-bold w-100">Sell Order Summary</p>

                        @if($hasTradeOut)
                            <p style="display: flex; align-items: center;">Price to pay: £{{$fullprice}}</p>
                        @endif
                        
                        @if($hasTradeIn)
                            @foreach($cart as $cart_item)
                                <div class="summary-cart-order-info">
                                    <p class="summary-cart-device">{{$cart_item->getProductName($cart_item->id)}}</p>
                                    <p class="summary-cart-order-details">Network: {{$cart_item->network}}</p>
                                    <p class="summary-cart-order-details">Memory: {{$cart_item->memory}}</p>
                                    <p class="summary-cart-order-details">Grade: {{$cart_item->grade}}</p>
                                </div>
                            @endforeach
                            <div class="summary-cart">
                                <p class="summary-cart-details-text">Subtotal</p>
                                <p class="summary-cart-details-text">£{{$sellPrice}}</p>
                            </div>
                            <div class="summary-cart promotional invisible" id="promotional-info">
                                <p class="summary-cart-details-text m-0" id="promo-info">Promotional code</p>
                                <p class="summary-cart-text-bold" id="promo-percentage"></p>
                            </div>
                            <div class="summary-cart">
                                <p class="summary-cart-text-bold-total">TOTAL</p>
                                <p class="summary-cart-text-bold-total" id="total-sell-price">£{{$sellPrice}}</p>
                            </div>
                        @endif
                    </div>

                    <div class="trade-pack-type cartdetails-type-subcontainer">
                        <div class="col m-0 p-4">
                            <p class="title-trade-pack-type-large">How would you like to send your device?</p>
                            <p class="title-trade-pack-type">Please select how you would like to send your device(s) to us</p>

                            <div class="select-pack-type mt-4">

                                <div class="order-label-wrapper">
                                    <div class="order-label-print-type m-2" id="bamboo-print-selected" onclick="selectType('bamboo')">
                                        <div class="col p-0">
                                            {{-- <img class="order-label-print-svg" src="{{asset('/customer_page_images/body/free_bamboo_trade_pack.svg')}}"> --}}
                                            <img class="order-label-print-svg" src="{{asset('customer_page_images/body/final_free_trade_pack.svg')}}">
                                            <p class="order-label-print-text">FREE Bamboo <br>Trade Pack</p>
                                        </div>
                                    </div>
                                    <img class="order-label-select-svg" id="bamboo-print-selected-tick" src="{{asset('/customer_page_images/body/orange_deselected.svg')}}">
                                </div>

                                <div class="order-label-wrapper">
                                    <div class="order-label-print-type m-2" id="own-print-selected" onclick="selectType('own')">
                                        <div class="col p-0">
                                            <img class="order-label-print-svg" src="{{asset('/customer_page_images/body/free_print_own_label.svg')}}">
                                            <p class="order-label-print-text">FREE print your <br>own label</p>
                                        </div>
                                    </div>
                                    <img class="order-label-select-svg" id="own-print-selected-tick" src="{{asset('/customer_page_images/body/orange_deselected.svg')}}">
                                </div>

                                <p class="title-trade-pack-type pack-instructions">Instructions on how to print your label at home will be given on the next page</p>
                                
                            </div>
                        </div>

                        <div class="delivery-details-basket collapse" id="delivery-details-basket-collapsable">
                            <h3>Delivery details</h3>
                            <p>We’ll send you a free-postage envelope for your device, complete with instructions</p>
                            <br>
                            <div class="delivery-address-lookup">
                                <input class="form-control js-typeahead lookup-delivery-basket" type="text" id="delivery_address" name="delivery_address" value="{!!Auth::user()->delivery_address!!}" placeholder="Enter post code">
                                <div class="search-button-basket-delivery"><img src="{{asset('/images/front-end-icons/search_icon.svg')}}"></div>
                                <div class="enter-manually-basket" id="manual-delivery-basket-toggle">Enter address manually</div>
                            </div>
                            <div class="delivery-address-container collapse" id="manual_delivery_address_basket">
                                <input class="form-control" type="text" name="house_name" id="house_name" placeholder="House name/number">
                                <input class="form-control" type="text" name="street_name" id="street_name" placeholder="Street name">
                                <input class="form-control" type="text" name="town" id="town" placeholder="Town">
                                <input class="form-control" type="text" name="country" id="country" placeholder="Country">
                                <input class="form-control mb-2" type="text" name="post_code" id="post_code" placeholder="Post Code">

                                <div class="alert alert-danger text-center invisible" id="manual_address_error"><p>Please complete all fields in order to save address.</p></div>
                                <div class="btn btn-primary d-block mb-4 mt-2" id="saveManualAddress">Save</div>
                            </div>
                        </div>

                        
                    </div>

                    @if(!Auth::user()->hasPaymentDetails())
                        <div class="bank-account-details mb-4 mt-4">
                            <p class="bank-details-large">Bank account details</p>
                            <p class="bank-details-small mt-2">Please provide banking details for payment transfer</p>

                            <div class="col p-0 mt-4">
                                <label for="account_name">Name on account</label>
                                <input class="form-control small-input bankdetails-name" name="account_name" required>
                            </div>
                            <div class="col p-0">
                                <label for="account_name">Account number</label>
                                <input class="form-control small-input bankdetails-number" name="account_number" required>
                            </div>
                            <div class="col p-0">
                                <label>Sort code</label>
                                <div class="row bankdetails-strict-row m-0">
                                    <input class="form-control text-center width-60px bankdetails-sortcode" type="number" name="sort_code_1" required>
                                    <p class="m-3 bold">-</p>
                                    <input class="form-control text-center width-60px bankdetails-sortcode" type="number" name="sort_code_2" required>
                                    <p class="m-3 bold">-</p>
                                    <input class="form-control text-center width-60px bankdetails-sortcode" type="number" name="sort_code_3" required>
                                </div>
                            </div>
                            @if(Session::has('bank_details_error'))
                                <div class="alert alert-danger my-5" role="alert">
                                    @foreach(Session::get('bank_details_error') as $message)
                                        <li>{{$message}}</li>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        
                    @endif

                    <div class="row w-75 selling-disclaimer-cart">
                        <div class="col-9">
                            <p class="newsletter-small-sell">
                                I agree to Bamboo sending me a regular newsletter, carrying out market research, keeping 
                                me informed with personalised news, offers, products and promotions it believes would be 
                                of interest to me through my preferred channel. 
                            </p>
                        </div>
                        <div class="col">
                            <div class="row"><input type="checkbox" class="checkbox-input" name="email_newsletter">Email</div>
                            <div class="row"><input type="checkbox" class="checkbox-input" name="sms_newsletter">SMS / Text Message</div>
                            <div class="row"><input type="checkbox" class="checkbox-input" name="telephone_newsletter">Telephone</div>
                            <div class="row"><input type="checkbox" class="checkbox-input" name="post_newsletter">Post</div>
                        </div>
                    </div>

                </div>

                <div class="d-flex flex-column pb-3 cartdetails-summary">
                    <div class="order-summary-cart flex-column">
                        <p class="order-summary-bold w-100">Sell Order Summary</p>

                        @if($hasTradeOut)
                        <p style="display: flex; align-items: center;">Price to pay: £{{$fullprice}}</p>
                        @endif
                        
                        @if($hasTradeIn)
                            @foreach($cart as $cart_item)
                                <div class="summary-cart-order-info">
                                    <p class="summary-cart-device">{{$cart_item->getProductName($cart_item->id)}}</p>
                                    <p class="summary-cart-order-details">Network: {{$cart_item->network}}</p>
                                    <p class="summary-cart-order-details">Memory: {{$cart_item->memory}}</p>
                                    <p class="summary-cart-order-details">Grade: {{$cart_item->grade}}</p>
                                </div>
                            @endforeach
                            <div class="summary-cart">
                                <p class="summary-cart-details-text">Subtotal</p>
                                <p class="summary-cart-details-text">£{{$sellPrice}}</p>
                            </div>
                            <div class="summary-cart promotional invisible" id="promotional-info">
                                <p class="summary-cart-details-text m-0" id="promo-info">Promotional code</p>
                                <p class="summary-cart-text-bold" id="promo-percentage"></p>
                            </div>
                            <div class="summary-cart">
                                <p class="summary-cart-text-bold-total">TOTAL</p>
                                <p class="summary-cart-text-bold-total" id="total-sell-price">£{{$sellPrice}}</p>
                            </div>
                            {{-- <select class="form-control my-3" onchange="changelabelstatus(this)">
                                <option value="1" selected>Make an order without printing label</option>
                                <option value="2">Print and send trade label yourself</option>
                            </select> --}}

                            
                        @endif   
                    </div>

                    @if($hasTradeIn)
                        <div class="selling-disclaimer-cart-mobile">
                            <p class="newsletter-small-sell">
                                I agree to Bamboo sending me a regular newsletter, carrying out market research, keeping 
                                me informed with personalised news, offers, products and promotions it believes would be 
                                of interest to me through my preferred channel. 
                            </p>
                            <div class="disclaimer-checkboxes-row">
                                <div class="disclaimer-input">
                                    <label for="email_newsletter">Email</label>
                                    <input type="checkbox" class="checkbox-input" name="email_newsletter">
                                </div>
                                <div class="disclaimer-input">
                                    <label for="sms_newsletter">SMS / Text Message</label>
                                    <input type="checkbox" class="checkbox-input" name="sms_newsletter">
                                </div>
                                <div class="disclaimer-input">
                                    <label for="telephone_newsletter">Telephone</label>
                                    <input type="checkbox" class="checkbox-input" name="telephone_newsletter">
                                </div>
                                <div class="disclaimer-input">
                                    <label for="post_newsletter">Post</label>
                                    <input type="checkbox" class="checkbox-input" name="post_newsletter">
                                </div>
                            </div>
                        </div>
                    @endif


                    @if($hasTradeIn)
                        <div class="form-container">


                    
                                <input type="hidden" id="label_status" name="label_status" value="1">

                                <button type="submit" id="submit-sell" disabled class="btn start-selling cart-final mt-4"><p>Sell my device</p></button>
            
                            <script>
                                function changelabelstatus(value){
                                    document.getElementById('label_status').value = value.value;
                                }
                            </script>

                        </div>

                        @include('partial.promocode')
                    @endif

                </div>

            </div>

        </form>
        
    @else
        <div class="d-flex p-5 ml-5 cartdetails-container" id="complete-registration">


            <div class="d-flex flex-column pb-3 ml-2 create-account-container w-75">
                <p class="welcome-basket-details">Your details</p>
                <div class="create-account-yourdetails mr-5">
                    <p class="create-title">Create an account</p>

                    <form class="complete-registration-form" method="POST" action="{{route('completeRegistration')}}">
                        @csrf

                        <div class="row m-0">
                            <div class="col-4 p-0 m-0 mr-5">
                                <label for="first_name" class="basket-signup-label">First Name*</label>
                                <input class="form-control" type="text" name="first_name" required>
                            </div>
                            <div class="col-4 p-0 m-0">
                                <label for="last_name" class="basket-signup-label">Last Name*</label>
                                <input class="form-control" type="text" name="last_name" required>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-4 p-0">
                                <label class="basket-signup-label">Date of Birth</label>
                                @include('partial.birthdate', ['required' => false])                                                        
                            </div>
                        </div>
                        <div class="row m-0 mt-2">
                            <div class="col-4 m-0 p-0 mr-5">
                                <label for="first_name" class="mb-2 basket-signup-label">Current phone</label>
                                <select class="selectpicker form-control" data-show-subtext="true" data-live-search="true" name="current-phone">
                                    <option value="" selected disabled>Your current phone</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4 m-0 p-0">
                                <label for="last_name" class="mb-2 basket-signup-label">Preffered OS</label>
                                <select class="selectpicker form-control" name="preferred-os">
                                    <option value="" selected disabled>Preferred Operating System (OS)</option>
                                    <option>iOS</option>
                                    <option>Android</option>
                                    <option>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="row m-0 mt-4">
                            <div class="col-4 p-0 m-0">
                                <label for="first_name" class="basket-signup-label">Email address*</label>
                                <div class="d-flex flex-row">
                                    <input class="form-control" type="text" name="email" id="email_basket" onkeydown="validateEmail()" value="{!!Session::get('abandoned_email')!!}" required>
                                    <img id="valid-email-icon" src="{{asset('/customer_page_images/body/orange_selected.svg')}}" class="valid-field-confirmation">
                                </div>
                            </div>
                        </div>
                        <div class="row m-0 mt-2">
                            <div class="form-group col-8 p-0 m-0">
                                <label for="delivery_address" class="basket-signup-label">Delivery Address</label>
                                <input class="form-control js-typeahead" type="text" id="delivery_address" name="delivery_address" placeholder="Example delivery address" required>
                            </div>
                        </div>
                        <div class="row m-0 mt-2">
                            <div class="form-group col-8 p-0 m-0">
                                <label for="billing_address" class="basket-signup-label">Billing Address</label>
                                <input class="form-control js-typeahead" type="text" id="billing_address" name="billing_address" placeholder="Example billing address" required>
                            </div>
                        </div>
                        <div class="row m-0 mt-2">
                            <div class="col-12 m-0 p-0">
                                <label for="password_card" class="verify-label basket-signup-label">Select password*</label>
                                <div class="row m-0 password-input basket">
                                    <input type="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,50}$" class="form-control" name="password" id="password_card" required class="verification-input" required/>
                                    <img class="toggle-pass-visibility" id="pass-visibility-toggle" onclick="togglePassCardVisibility()" src="{{asset('/images/front-end-icons/pass_invisible.svg')}}">
                                    <img id="valid-password-icon" src="{{asset('/customer_page_images/body/orange_selected.svg')}}" class="valid-field-confirmation hidden">
                                </div>
                                <div class="pass-info-requirements mb-2">
                                    Your password needs to be at least 8 characters long, contain an uppercase letter, a number and a symbol.
                                </div>
                                <div id="pass-check-info-card" class="pass-strength mt-0 mb-4">
                                    <div class="row m-0 ml-1">
                                        <div id="progress">
                                            <div id="bar-card"></div>
                                        </div>
                                        <div id="pass-strength-card" class="ml-3">Unsecure</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0 newsletter-singup-row">
                            <input type="checkbox" name="sub" id="newsletter-sub" class="hidden">
                            <img class="newsletter-tick-black mt-auto mb-auto" id="newsletter-subscribe-check" onclick="toggleNewsletterSub()" src="{{asset('/images/front-end-icons/black_circle.svg')}}">
                            <p class="newsletter-terms-text ml-0">
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
                        @foreach($cart as $cart_item)
                            <div class="summary-cart-order-info">
                                <p class="summary-cart-device">{{$cart_item->getProductName($cart_item->id)}}</p>
                                <p class="summary-cart-order-details">Network: {{$cart_item->network}}</p>
                                <p class="summary-cart-order-details">Memory: {{$cart_item->memory}}</p>
                                <p class="summary-cart-order-details">Grade: {{$cart_item->grade}}</p>
                            </div>
                        @endforeach 
                        <div class="summary-cart">
                            <p class="summary-cart-text-total">Subtotal</p>
                            <p class="summary-cart-text-total">£{{$sellPrice}}</p>
                        </div>
                        <div class="summary-cart promotional invisible" id="promotional-info">
                            <p class="summary-cart-details-text m-0" id="promo-info">Promotional code</p>
                            <p class="summary-cart-text-bold" id="promo-percentage"></p>
                        </div>
                        <div class="summary-cart">
                            <p class="summary-cart-text-bold-total">TOTAL</p>
                            <p class="summary-cart-text-bold-total" id="total-sell-price">£{{$sellPrice}}</p>
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

                            <button type="submit" id="submit-sell" disabled class="btn start-selling cart-final w-100 mt-2"><p>Sell my device</p></button>
        
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


    @if(session('showLogin'))
        <script>
            $(window).on('load',function(){
                $('#loginModal').modal('show');
            });
        </script>
    @endif

    @include('customer.layouts.footer', ['showGetstarted' => false])

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

                // hide delivery details
                if($('#delivery-details-basket-collapsable').hasClass('show')){
                    $('#delivery-details-basket-collapsable').collapse('hide');
                    $('#delivery_address').attr('required', false)
                }
            }
            if(type === 'bamboo'){
                bamboodiv.classList.add('selected');
                owndiv.classList.remove('selected');
                owntick.src = '/customer_page_images/body/orange_deselected.svg';
                bambootick.src = '/customer_page_images/body/orange_selected.svg';
                ordertype.value = 1;

                // show delivery details
                $('#delivery-details-basket-collapsable').collapse('show');
                $('#delivery_address').attr('required', true);
            }
            document.getElementById('submit-sell').disabled = false;
        }

        if('{!!Auth::user()!!}'){
            document.getElementById('manual-delivery-basket-toggle').addEventListener('click', function(){
                // let manual_container = document.getElementById('manual_delivery_address_basket');
                if($('#manual_delivery_address_basket').hasClass('show')){
                    $('#manual_delivery_address_basket').collapse('hide');
                    $('#delivery_address').attr('readonly', false);
                    $('#house_name').attr('required', false);
                    $('#street_name').attr('required', false);
                    $('#town').attr('required', false);
                    $('#country').attr('required', false);
                    $('#post_code').attr('required', false);
                } else {
                    $('#manual_delivery_address_basket').collapse('show');
                    $('#delivery_address').attr('readonly', true);
                    $('#house_name').attr('required', true);
                    $('#street_name').attr('required', true);
                    $('#town').attr('required', true);
                    $('#country').attr('required', true);
                    $('#post_code').attr('required', true);
                }
            })
        }        

        document.getElementById('saveManualAddress').addEventListener('click', function(){
            let housename = document.getElementById('house_name').value;
            let streetname = document.getElementById('street_name').value;
            let town = document.getElementById('town').value;
            let country = document.getElementById('country').value;
            let postcode = document.getElementById('post_code').value;
            if(housename && streetname && town && country && postcode){
                address_delivery = housename + ", " + streetname + ", " + town + ", " + country + ", " + postcode;
                document.getElementById('delivery_address').value = address_delivery;
            } else {
                document.getElementById('manual_address_error').classList.remove('invisible');
                setTimeout(() => {
                    document.getElementById('manual_address_error').classList.add('invisible');
                }, 3000);
            }
            
        });

        function validateEmail() {
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            let email = document.getElementById('email_basket').value;
            let isValid = re.test(String(email).toLowerCase());
            if(isValid){
                document.getElementById('valid-email-icon').classList.remove('hidden');
            } else {
                document.getElementById('valid-email-icon').classList.add('hidden');
            }
        }
        // var rand = Math.floor(10000000 + Math.random() * 900000);
        // document.getElementById('order_code').value = rand;

    </script>
@endsection