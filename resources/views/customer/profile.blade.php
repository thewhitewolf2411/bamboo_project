<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        {{-- <script src="{{ asset('js/Customer.js') }}"></script> --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

        
        <title>Bamboo Mobile::Profile</title>

        <link rel="icon" type="image/png" sizes="96x96" href="/customer_page_images/header/favicon-96x96.png">

        <!-- Addressian -->
        <script src="{{asset('/js/Addressian.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/easy-autocomplete.min.css">

    </head>
    <body>
        <header>@include('customer.layouts.header')</header>
        <main>
            <div class="app">
                <div class="how-page how-title-container">
                    <div class="top-text">
                        <p class="top-text-shadow">My Bamboo</p>
                    </div>
                </div>

                <div class="user-sections-container">
                    <div class="sections-row">
                        <div class="sections-menu">
                            <div class="change-page menu-item link-active" id="menu-overview">Account overview</div>
                            <div class="change-page menu-item" id="menu-notifications">Notifications</div>
                            <div class="change-page menu-item" id="menu-personal">Personal Information</div>
                            <div class="change-page menu-item" id="menu-account">Account Information</div>
                            <div class="change-page menu-item" id="menu-sales">My Sales</div>
                            <div class="change-page menu-item" id="menu-communications">Communications</div>
                            <div class="menu-item" data-toggle="modal" data-target="#logoutModal"><img class="mr-3" src="{{asset('/images/logout-black.svg')}}">Log Out</div>
                        </div>
                        <div class="section-items">
                            <div id="section-overview" class="page-sections">
                                <div class="section-item-preview">
                                    <p class="section-item-title">Notifications</p>
                                    <div class="change-page right-link-box" id="box-notifications">
                                        <p class="right-link-text">See all Notifications</p>
                                        <div class="right-link" id="right-notifications">
                                            <img class="right-link-img" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="section-item-preview">
                                    <p class="section-item-title">Personal Information</p>
                                    <div class="change-page action-button-right purple" id="right-personal">
                                    <p class="action-button-right-text">Edit details</p>
                                        <img class="pen-icon" src="{{asset('/images/pen.png')}}">
                                    </div>
                                </div>
                                <div class="section-item-preview">
                                    <p class="section-item-title">Account Information</p>
                                    <div class="change-page action-button-right purple" id="right-account">
                                        <p class="action-button-right-text">Edit details</p>
                                        <img class="pen-icon" src="{{asset('/images/pen.png')}}">
                                    </div>
                                </div>
                                <div class="section-item-preview">
                                    <p class="section-item-title">My Sales</p>
                                    <div class="change-page action-button-right orange" id="right-sales">
                                        <p class="action-button-right-text">View all Sales</p>
                                        <img class="right-link-img" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                                    </div>
                                </div>
                                <div class="section-item-preview">
                                    <p class="section-item-title">Communications</p>
                                    <div class="change-page action-button-right purple" id="right-communications">
                                        <p class="action-button-right-text">Edit details</p>
                                        <img class="pen-icon" src="{{asset('/images/pen.png')}}">
                                    </div>
                                </div>
                                <div class="section-item-preview">
                                    <p class="section-item-title">Log out</p>
                                    <a class="action-button-right green" data-toggle="modal" data-target="#logoutModal">
                                        <img class="right-link-img" src="{{asset('/images/logout.svg')}}">
                                        <p class="action-button-right-text ml-3">Logout</p>
                                    </a>
                                </div>
                            </div>

                            <div id="section-notifications" class="page-sections hidden">
                                <div class="section-item-content">
                                    <div class="section-header">
                                        <p class="section-item-title">Notifications</p>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="notifications-list">
                                        @foreach($notifications as $notification)
                                        
                                            <div class="notification-card @if($notification->status === 'alert' && $notification->resolved === false) red-border @endif">
                                                @if($notification->status === 'alert')
                                                    @if($notification->resolved === false)
                                                        <img class="notification-error-img mr-4 ml-2" src="{{asset('/customer_page_images/body/error_alert.svg')}}">
                                                    @else
                                                        <img class="notification-error-img mr-4 ml-2" src="{{asset('/customer_page_images/body/green_tick.svg')}}">
                                                    @endif
                                                @endif
                                                @if($notification->status === 'info')<img class="notification-green-img mr-4 ml-2" src="{{asset('/customer_page_images/body/green_bell.svg')}}">@endif
                                                {{$notification->content}}
                                            </div>
                                            <div class="notification-card-border"></div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div id="section-personal" class="page-sections hidden">

                                <div class="section-item-content">
                                    <div class="section-header">
                                        <p class="section-item-title">Personal Information</p>
                                        <div class="action-button-right purple" data-toggle="modal" data-target="#validationModal">
                                            <p class="action-button-right-text">Edit details</p>
                                            <img class="pen-icon" src="{{asset('/images/pen.png')}}">
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>

                                    <div class="personal-info-row">
                                        <div class="personal-info-item">
                                            <p class="info-item-label">First Name</p>
                                            <p class="info-item-val">{!!Auth::user()->first_name!!}</p>
                                        </div>
                                        <div class="personal-info-item">
                                            <p class="info-item-label">Last Name</p>
                                            <p class="info-item-val">{!!Auth::user()->last_name!!}</p>
                                        </div>
                                        <div class="personal-info-item">
                                            <p class="info-item-label">Date of Birth</p>
                                            <p class="info-item-val">{{Auth::user()->getBirthDate()}}</p>
                                        </div>
                                        <div class="personal-info-item">
                                            <p class="info-item-label">Contact Number</p>
                                            <p class="info-item-val">{!!Auth::user()->contact_number!!}</p>
                                        </div>
                                    </div>

                                    <div class="personal-info-row">
                                        <div class="personal-info-item">
                                            <p class="info-item-label">Delivery Address</p>
                                            <p class="info-item-val">{!!Auth::user()->profileDeliveryAddress()!!}</p>
                                        </div>
                                        <div class="personal-info-item">
                                            <p class="info-item-label">BIlling Address</p>
                                            <p class="info-item-val">{!!Auth::user()->profileBillingAddress()!!}</p>
                                        </div>
                                        <div class="personal-info-item">
                                            <p class="info-item-label">Current Phone</p>
                                            <p class="info-item-val">{!!Auth::user()->getCurrentPhone()!!}</p>
                                        </div>
                                        <div class="personal-info-item">
                                            <p class="info-item-label">Preffered OS</p>
                                            <p class="info-item-val">{!!Auth::user()->preffered_os!!}</p>
                                        </div>
                                    </div>

                                    <!-- validation modal-->
                                    <div class="modal fade" id="validationModal" tabindex="-1" role="dialog" aria-labelledby="validationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content padded">
                                                <div class="validation-modal-header">
                                                    <img class="close-modal-img ml-auto" src="{{asset('/customer_page_images/body/modal-close.svg')}}" data-dismiss="modal" aria-label="Close">
                                                    <h5 class="validationModal-title" id="validationModalLabel">Re-Enter your password to make changes</h5>
                                                </div>
                                                <div class="line-bottom"></div>
                                                <div class="modal-body">
                                                    <div class="verification-row">
                                                        <div class="col p-0 mr-3">
                                                            <label for="email" class="verify-label">Email address</label>
                                                            <input type="email" name="email" id="verify_email" required class="verification-input"/>
                                                        </div>

                                                        <div class="col p-0">
                                                            <label for="email" class="verify-label">Enter Password*</label>
                                                            <div class="row m-0">
                                                                <input type="password" name="password" id="verify_pass" required class="verification-input"/>
                                                                <img class="profile-pass-visibility" id="pass-visibility-toggle" onclick="togglePassVisiblility()" src="{{asset('/images/front-end-icons/pass_invisible.svg')}}">
                                                            </div>
                                                            <a href="/password/reset" class="forgotpass-link">Forgot password?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="alert alert-danger hidden" role="alert" id="verification-error">
                                                    Bad credentials.
                                                </div>
                                                <div class="modal-footer border-0 p-0 padded">
                                                <button type="button" class="btn btn-primary ml-auto w-25" onclick="verify()">Verify</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- personal info modal -->
                                    <div class="modal fade" id="personalInfoModal" tabindex="-1" role="dialog" aria-labelledby="personalInfoModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content padded">
                                                <div class="validation-modal-header">
                                                    <img class="close-modal-img ml-auto" src="{{asset('/customer_page_images/body/modal-close.svg')}}" data-dismiss="modal" aria-label="Close">
                                                    <h5 class="validationModal-title" id="personalInfoModalLabel">Personal information</h5>
                                                </div>
                                                <div class="line-bottom"></div>
                                                <div class="modal-body mt-4">

                                                    <div class="personal-info-row">
                                                        <div class="col p-0 mr-3">
                                                            <label for="firstname" class="personal-info-label">First Name</label>
                                                            <input type="text" name="first_name" id="first_name" required class="personal-info-text-input" value="{!!Auth::user()->first_name!!}"/>
                                                        </div>

                                                        <div class="col p-0 mr-3">
                                                            <label for="last_name" class="personal-info-label">Last Name</label>
                                                            <input type="text" name="last_name" id="last_name" required class="personal-info-text-input" value="{!!Auth::user()->last_name!!}"/>
                                                        </div>

                                                        <div class="col p-0 mr-3">
                                                            <label for="birth_date" class="personal-info-label">Date of Birth</label>
                                                            @include('partial.birthdate')                                                        
                                                        </div>

                                                        <div class="col p-0">
                                                            <label for="contact_number" class="personal-info-label">Contact Number</label>
                                                            <input type="text" name="contact_number" id="contact_number" required class="personal-info-text-input" value="{!!Auth::user()->contact_number!!}"/>
                                                        </div>
                                                    </div>

                                                    <div class="personal-info-row">
                                                        <div class="col p-0 mr-3">
                                                            <label for="firstname" class="personal-info-label">Delivery Address</label>
                                                            <input class="form-control js-typeahead" type="text" id="delivery_address" name="delivery_address" value="{!!Auth::user()->delivery_address!!}" placeholder="Enter postcode" required>
                                                            
                                                            <div class="enter-manually mb-2 user-select-none" onclick="toggleManualAddress('delivery')"><p>Enter Address Manually <i id="manual-delivery-arrow" class="arrow down ml-2"></i></p></div>

                                                            <div id="manual-delivery" class="hidden">
                                                                <input type="text" class="form-control mb-0" name="manual_delivery_address_details" id="delivery_house_name" placeholder="House name or number">
                                                                <input type="text" class="form-control mb-0" name="manual_delivery_address_details" id="delivery_street_name" placeholder="Street Name">
                                                                <input type="text" class="form-control mb-0" name="manual_delivery_address_details" id="delivery_town" placeholder="Town">
                                                                <input type="text" class="form-control mb-0" name="manual_delivery_address_details" id="delivery_city" placeholder="City">
                                                                <input type="text" class="form-control mb-0" name="manual_delivery_address_details" id="delivery_post_code" placeholder="Post code">
                                                                <div class="btn btn-light disabled mt-2" id="save_manual_delivery" onclick="saveAddress('delivery')">Save address</div>
                                                            </div>
                                                            <p class="personal-info-address" id="current-personal-delivery-address">
                                                                {!!str_replace(',', '<br>', Auth::user()->delivery_address)!!}
                                                            </p>
                                                        </div>

                                                        <div class="col p-0 mr-3">
                                                            <label for="last_name" class="personal-info-label">Billing Address</label>
                                                            <input class="form-control js-typeahead" type="text" id="billing_address" name="billing_address" value="{!!Auth::user()->billing_address!!}" placeholder="Enter postcode" required>

                                                            <div class="enter-manually mb-2 user-select-none" onclick="toggleManualAddress('billing')"><p>Enter Address Manually <i id="manual-billing-arrow" class="arrow down ml-2"></i></p></div>

                                                            <div id="manual-billing" class="hidden">
                                                                <input type="text" class="form-control mb-0" name="manual_billing_address_details" id="billing_house_name" placeholder="House name or number">
                                                                <input type="text" class="form-control mb-0" name="manual_billing_address_details" id="billing_street_name" placeholder="Street Name">
                                                                <input type="text" class="form-control mb-0" name="manual_billing_address_details" id="billing_town" placeholder="Town">
                                                                <input type="text" class="form-control mb-0" name="manual_billing_address_details" id="billing_city" placeholder="City">
                                                                <input type="text" class="form-control mb-0" name="manual_billing_address_details" id="billing_post_code" placeholder="Post code">
                                                                <div class="btn btn-light disabled mt-2" id="save_manual_billing" onclick="saveAddress('billing')">Save address</div>
                                                            </div>

                                                            <p class="personal-info-address" id="current-personal-billing-address">
                                                                {!!str_replace(',', '<br>', Auth::user()->billing_address)!!}
                                                            </p>
                                                        </div>

                                                        <div class="col p-0 mr-3">
                                                            <label for="current_phone" class="personal-info-label personal-info-dropdown">Current Phone</label>
                                                            <select class="form-control" id="currentPhone" name="current_phone">
                                                                @if(Auth::user()->getCurrentPhone() === null) <option value="" selected disabled>Select your device</option> @endif
                                                                @foreach($devices as $device)
                                                                    @if(Auth::user()->current_phone == $device->id)
                                                                        <option value="{{$device->id}}" selected>{{$device->product_name}}</option>
                                                                    @else
                                                                        <option value="{{$device->id}}">{{$device->product_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                              </select>                                                
                                                        </div>

                                                        <div class="col p-0">
                                                            <label for="prefferred_os" class="personal-info-label personal-info-dropdown">Prefferred OS</label>
                                                            <select class="form-control" id="prefferedOS" name="prefferred_os">
                                                                @foreach($os as $operating_system)
                                                                @if(Auth::user()->preffered_os == $operating_system)
                                                                    <option value="{{$operating_system}}" selected>{{$operating_system}}</option>
                                                                @else
                                                                    <option value="{{$operating_system}}">{{$operating_system}}</option>
                                                                @endif
                                                            @endforeach
                                                              </select>                                                                   
                                                            </div>
                                                    </div>

                                                </div>
                                                
                                                <div class="alert alert-danger hidden" role="alert" id="personal-info-error">
                                                </div>
                                                <div class="modal-footer border-0 p-0 padded mt-5">
                                                    <button type="button" class="btn btn-orange ml-auto w-25" onclick="saveChanges()">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if(Session::has('success'))
                                        <div class="alert alert-success my-5" role="alert">
                                            @foreach(Session::get('success') as $message)
                                                <li>{{$message}}</li>
                                            @endforeach
                                        </div>
                                    @endif
        
                                    @if(Session::has('error'))
                                        <div class="alert alert-danger my-5" role="alert">
                                            {{Session::get('error')}}
                                        </div>
                                    @endif

                
                                </div>

                            </div>

                            <div id="section-account" class="page-sections hidden">

                                <div class="section-item-content">
                                    <div class="section-header">
                                        <p class="section-item-title">Account Information</p>
                                        <div class="action-button-right purple" data-toggle="modal" data-target="#accountInfoModal">
                                            <p class="action-button-right-text">Edit details</p>
                                            <img class="pen-icon" src="{{asset('/images/pen.png')}}">
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="row m-0">
                                        <div class="account-info-item">
                                            <p class="account-item-label">Email</p>
                                            <p class="account-item-val">{!!Auth::user()->email!!}</p>
                                        </div>
                                    </div>
                                    <div class="row m-0">
                                        <div class="account-info-item">
                                            <p class="account-item-label">Password</p>
                                            <p class="account-item-val">********</p>
                                        </div>
                                    </div>
                                </div>


                                <!-- validation modal-->
                                <div class="modal fade" id="accountInfoModal" tabindex="-1" role="dialog" aria-labelledby="accountInfoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content padded">
                                            <div class="validation-modal-header">
                                                <img class="close-modal-img ml-auto" src="{{asset('/customer_page_images/body/modal-close.svg')}}" data-dismiss="modal" aria-label="Close">
                                                <h5 class="validationModal-title" id="accountInfoModalLabel">Account Information</h5>
                                            </div>
                                            <div class="line-bottom"></div>
                                            <div class="modal-body">
                                                <div class="account-info-row padded">
                                                    <div class="col p-0 mr-3">
                                                        <label for="email" class="verify-label">Email address</label>
                                                        <input type="email" name="email" id="acc_email" required class="verification-input"/>
                                                    </div>

                                                    <div class="col p-0">
                                                        <label for="old_pass" class="verify-label">Current Password</label>
                                                        <div class="row m-0">
                                                            <input type="password" name="old_pass" id="old_pass" required class="verification-input"/>
                                                            <img class="profile-pass-visibility old" id="old-pass-visibility-toggle" onclick="toggleOldNewPassVisibility('old')" src="{{asset('/images/front-end-icons/pass_invisible.svg')}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="account-info-row">
                                                    
                                                    <div class="col p-0 pr-3 mt-3">
                                                        <div id="newpass" class="alert alert-danger hidden" role="alert">
                                                            Email and current password required
                                                        </div>
                                                    </div>

                                                    <div class="col p-0">
                                                        <label for="new_pass" class="verify-label">New Password</label>
                                                        <div class="row m-0">
                                                            <input type="password" name="new_pass" id="new_pass" required class="verification-input"/>
                                                            <img class="profile-pass-visibility new" id="new-pass-visibility-toggle" onclick="toggleOldNewPassVisibility('new')" src="{{asset('/images/front-end-icons/pass_invisible.svg')}}">
                                                        </div>
                                                        <div id="pass-check-info" class="pass-strength hidden">
                                                            <div class="row m-0">
                                                                <div id="progress">
                                                                    <div id="bar"></div>
                                                                </div>
                                                                <div id="pass-strength" class="ml-3">Unsecure</div>
                                                            </div>
                                                            <div class="row m-0 mt-2">
                                                                <div class="row m-0 mb-2" id="pass-min-length">
                                                                    <div class="blue-dot"></div>
                                                                    <p class="pass-info-text">Your password must be at least 8 characters long.</p>
                                                                </div>
                                                                <div class="row m-0 mb-2" id="pass-number">
                                                                    <div class="blue-dot"></div>
                                                                    <p class="pass-info-text">Your password must contain a number.</p>
                                                                </div>
                                                                <div class="row m-0 mb-2" id="pass-symbol">
                                                                    <div class="blue-dot"></div>
                                                                    <p class="pass-info-text">Your password must contain a symbol.</p>
                                                                </div>
                                                                <div class="row m-0 mb-2" id="pass-uppercase">
                                                                    <div class="blue-dot"></div>
                                                                    <p class="pass-info-text">Your password must contain an uppercase letter.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="alert alert-danger hidden" role="alert" id="verification-error">
                                                Bad credentials.
                                            </div> --}}
                                            <div class="modal-footer border-0 p-0 padded mt-4">
                                                <button type="button" class="btn btn-secondary disabled ml-auto w-25" id="savepass" onclick="savePass()">Save Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="section-sales" class="page-sections hidden">
                                <div class="section-item-content">
                                    <div class="section-header">
                                        <p class="section-item-title">Notifications</p>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="notifications-list">
                                        @foreach($notifications as $notification)

                                            <div class="notification-card @if($notification->status === 'alert' && $notification->resolved === false) red-border @endif">
                                                @if($notification->status === 'alert')
                                                    @if($notification->resolved === false)
                                                        <img class="notification-error-img mr-4 ml-2" src="{{asset('/customer_page_images/body/error_alert.svg')}}">
                                                    @else
                                                        <img class="notification-error-img mr-4 ml-2" src="{{asset('/customer_page_images/body/green_tick.svg')}}">
                                                    @endif
                                                @endif
                                                @if($notification->status === 'info')<img class="notification-green-img mr-4 ml-2" src="{{asset('/customer_page_images/body/green_bell.svg')}}">@endif
                                                {{$notification->content}}
                                                <div class="notification-card-border"></div>

                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                                <div class="section-item-content mt-2">
                                    <div class="section-header">
                                        <p class="section-item-title">My sales</p>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="item-sales-col">
                                        @if($tradeins->count() < 1)
                                            <h6 class="pt-4 text-center">You have no sales.</h6>
                                        @endif
                                        @foreach($tradeins as $tradein)
                                            <div class="sale-item">

                                                <div class="col">
                                                    <p class="sale-item-label">Order #</p>
                                                    <p class="sale-item-bold">Order #{{$tradein->barcode}}</p>
                                                </div>

                                                <div class="col">
                                                    <p class="sale-item-label">Date of sale</p>
                                                    <p class="sale-item-bold">{{$tradein->created_at->toFormattedDateString()}}</p>
                                                </div>

                                                <div class="col">
                                                    <p class="sale-item-label">Device</p>
                                                    <p class="sale-item-bold">{{$tradein->getProductName($tradein->id)}}</p>
                                                </div>

                                                <div class="col">
                                                    <p class="sale-item-label">Status</p>
                                                    <p class="sale-item-bold">{{$tradein->getCustomerStatus()}}</p>
                                                </div>

                                                <div class="col">
                                                    <p class="sale-item-label">View</p>
                                                    <a href="/userprofile/{{$tradein->id}}"><img class="sale-item-link-img" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Orange.svg')}}"></a>
                                                </div>
                                                
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div id="section-communications" class="page-sections hidden">
                                <div class="section-item-content">
                                    <div class="section-header">
                                        <p class="section-item-title">Communications</p>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="row m-0 mt-3 mb-3 justify-content-between">
                                        <p class="communications-title">Newsletter subscriptions</p>
                                        <div class="action-button-right purple" onclick="saveSubscriptions()">
                                            <p class="action-button-right-text">Save Changes</p>
                                            <img class="right-link-img" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                                        </div>
                                    </div>
                                    <div class="row m-0 mt-3 mb-3 justify-content-between">
                                        <div class="newsletter-box @if(Auth::user()->sub === 0)inactive @endif" id="yes-newsletterbox" onclick="chooseNewsletter('yes')">
                                            <div class="newsletter-text row">
                                                Yes, I would love to hear about the <br>
                                                latest amazing offers, hints & tips.
                                            </div>
                                            @if(Auth::user()->sub === 1) 
                                                <img class="tick-img" id="yes-newsletter" src="/customer_page_images/body/Icon-Tick-Selected.svg">
                                            @else
                                                <img class="tick-img" id="yes-newsletter" src="/customer_page_images/body/Icon-Tick-Selected-clear.svg">
                                            @endif
                                        </div>

                                        <div class="newsletter-box @if(Auth::user()->sub === 1)inactive @endif" id="no-newsletterbox" onclick="chooseNewsletter('no')">
                                            <div class="newsletter-text row">
                                                No, I would not love to hear about the <br>
                                                latest amazing offers, hints & tips.
                                            </div>
                                            @if(Auth::user()->sub === 0) 
                                                <img class="tick-img" id="no-newsletter" src="/customer_page_images/body/Icon-Tick-Selected.svg">
                                            @else
                                                <img class="tick-img" id="no-newsletter" src="/customer_page_images/body/Icon-Tick-Selected-clear.svg">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- info message modal -->
                <div class="modal fade" id="infoMessageModal" tabindex="-1" role="dialog" aria-labelledby="infoMessageModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content padded">
                            <div class="validation-modal-header">
                                <img class="close-modal-img ml-auto" src="{{asset('/customer_page_images/body/modal-close.svg')}}" data-dismiss="modal" aria-label="Close">
                                <h5 class="validationModal-title" id="infoMessageModalLabel">Success</h5>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="modal-body">
                                <div class="account-info-row padded">
                                    Your password was changed successfully.
                                </div>
                            </div>
                            <div class="modal-footer border-0 p-0 padded mt-4">
                                <button type="button" class="btn btn-green ml-auto w-25" id="savepass" data-dismiss="modal" aria-label="Close">OK</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- logout modal -->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content padded">
                            <div class="validation-modal-header">
                                <img class="close-modal-img ml-auto" src="{{asset('/customer_page_images/body/modal-close.svg')}}" data-dismiss="modal" aria-label="Close">
                                <h5 class="validationModal-title" id="logoutModalLabel">are you sure?</h5>
                            </div>
                            <div class="line-bottom"></div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            <div class="modal-footer border-0 p-0 padded mt-4">
                                <button type="button" class="btn btn-orange w-25 m-auto" data-dismiss="modal" aria-label="Close" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Yes, log me out</button>
                                <button type="button" class="btn btn-jade w-50 m-auto" data-dismiss="modal" aria-label="Close">No, keep me signed in</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
        </main>


        @foreach($tradeins as $tradein)
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="tradein-{{$tradein->id}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    
                    <a role="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('/customer_page_images/body/modal-close.svg') }}">
                    </a>
                </div>
                <div class="modal-body">
                    <div class="p-5">
                        <div class="row pb-5">
                            <div class="col-md-9">
                                <div class="d-flex flex-column">
                                    <div class="w-100">
                                        <h5 class="modal-title">Order Details</h5>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-6">
                                            <p class="black">Order #</p>
                                            <h5 class="modal-title">Order #{{$tradein->barcode_original}}</h5>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="black">Date</p>
                                            <h5 class="modal-title">{{$tradein->created_at->toFormattedDateString()}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="d-flex flex-column">
                                    <div class="py-2"><a href="" class="btn btn-primary btn-green w-100 d-flex justify-content-between ">Download <img src="{{ asset('/customer_page_images/body/Icon-Arrow-Next-White.svg') }}"> </a></div>
                                    <div class="py-2"><a href="" class="btn btn-primary btn-purple w-100 d-flex justify-content-between">Print <img src="{{ asset('/customer_page_images/body/Icon-Arrow-Next-White.svg') }}"> </a></div>
                                    <div class="py-2"><a href="" class="btn btn-primary btn-jade w-100 d-flex justify-content-between">Email <img src="{{ asset('/customer_page_images/body/Icon-Arrow-Next-White.svg') }}"> </a></div>
                                </div>
                            </div>

                        </div>

                        <div class="row border-bottom pb-5">
                        
                            <div class="col-md-2"><img src="/storage/product_images/{{ $tradein->getProductImage($tradein->product_id) }}" width="100%"></div>
                            <div class="col-md-4">
                                <h5 class="modal-title">{{ $tradein->getProductName($tradein->product_id) }}</h5>
                                <p class="black">Network: {{ $tradein->network }}</p>
                                <p class="black">Memory: {{ $tradein->memory }}</p>
                                <p class="black">Grade: {{ $tradein->customer_grade }}</p>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <h5 class="modal-title border-bottom">Order Summary</h5>
                                <div class="d-flex">
                                    <h5 class="modal-title mt-5 mr-3">Total:</h5>
                                    <h5 class="modal-title mt-5 ml-5">£{{$tradein->order_price}}</h5>
                                </div>
                            </div>
                        
                        </div>

                        <div class="row py-3">
                        
                            <div class="col-md-4">
                                <p class="black mb-3">Delivery address</p>
                                <h5 class="modal-title">{{Auth::user()->delivery_address}}</h5>
                            </div>
                            <div class="col-md-4">
                                <p class="black mb-3">Date shipped</p>
                                <h5 class="modal-title">13th July 2020</h5>
                            </div>
                            <div class="col-md-4">
                                <p class="black mb-3">Tracking number</p>
                                <h5 class="modal-title">JF3904TI3MG9</h5>
                            </div>
                        
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-75">
                        <div class="col-md-4"><a href="" class="btn btn-primary btn-green w-100 d-flex justify-content-between ">Download <img src="{{ asset('/customer_page_images/body/Icon-Arrow-Next-White.svg') }}"> </a></div>
                        <div class="col-md-4"><a href="" class="btn btn-primary btn-purple w-100 d-flex justify-content-between">Print <img src="{{ asset('/customer_page_images/body/Icon-Arrow-Next-White.svg') }}"> </a></div>
                        <div class="col-md-4"><a href="" class="btn btn-primary btn-jade w-100 d-flex justify-content-between">Email <img src="{{ asset('/customer_page_images/body/Icon-Arrow-Next-White.svg') }}"> </a></div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        @endforeach

        @foreach($tradeouts as $tradeout)
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="tradeout-{{$tradeout->id}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order #{{$tradeout->id}}</h5>
                    <a role="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('/customer_page_images/body/modal-close.svg') }}">
                    </a>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">

                </div>
                </div>
            </div>
        </div>
        @endforeach

        <script>
        
            function showModal(id){
                $('#tradein-' + id).modal('show');
            }

            function showTradeOutModal(id){
                $('#tradeout-' + id).modal('show');
            }

        </script>
        
        <footer>@include('customer.layouts.footer', ['showGetstarted' => true])</footer>
    </body>
</html>

<script>
    (function() {
        let backtosales = window.localStorage.getItem('backtosales');
        if(backtosales){
            changeSection('menu-sales');
            window.localStorage.removeItem('backtosales');
        }
    })();

    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });

    let buttons = document.getElementsByClassName('change-page');
    for (let index = 0; index < buttons.length; index++) {
        let button = buttons[index];
        button.onclick = function() {changeSection(button.id)};
    }

    document.getElementById("old_pass").addEventListener('keyup', function(){
        checkNewPass()
    });
    document.getElementById("acc_email").addEventListener('keyup',  function(){
        checkNewPass()
    });
    document.getElementById("new_pass").addEventListener('keyup',  function(){
        checkNewPass()
    });

    let manual_delivery_inputs = document.getElementsByName('manual_delivery_address_details');
    for (let index = 0; index < manual_delivery_inputs.length; index++) {
        let elem = manual_delivery_inputs[index];
        elem.onkeyup = function() {validateManualDeliveryAddress()};
    }

    let manual_billing_inputs = document.getElementsByName('manual_billing_address_details');
    for (let index = 0; index < manual_billing_inputs.length; index++) {
        let elem = manual_billing_inputs[index];
        elem.onkeyup = function() {validateManualBillingAddress()};
    }


    function changeSection(id){
        let splitted = id.split('-');
        let selectedpage = splitted[1];

        let menuitems = document.getElementsByClassName('menu-item');
        let sections = document.getElementsByClassName('page-sections');

        for (let i = 0; i < menuitems.length; i++) {
            let menuitem = menuitems[i];

            if(menuitem.id === 'menu-'+selectedpage){
                if(!menuitem.classList.contains('link-active')){
                    menuitem.classList.add('link-active');
                }
            } else {
                if(menuitem.classList.contains('link-active')){
                    menuitem.classList.remove('link-active');
                }
            }
            
        }

        for (let j = 0; j < sections.length; j++) {
            let section = sections[j];

            if(section.id === 'section-'+selectedpage){
                if(section.classList.contains('hidden')){
                    section.classList.remove('hidden');
                }
            } else {
                if(!section.classList.contains('hidden')){
                    section.classList.add('hidden');
                }
            }
            
        }

    }


    function verify(){
        let email = document.getElementById('verify_email').value;
        let pass = document.getElementById('verify_pass').value;

        // $('#validationModal').modal('hide');
        // $('#personalInfoModal').modal('show');
        // return;

        $.ajax({
            type: "POST",
            url: 'userprofile/verify',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                email: email,
                pass: pass
            },
            success: function(data){
                if(data === "200"){
                    $('#validationModal').modal('hide');
                    $('#personalInfoModal').modal('show');
                    document.getElementById('verify_email').value = "";
                    document.getElementById('verify_pass').value = "";
                } else {
                    let error_alert = document.getElementById('verification-error');
                    if(error_alert.classList.contains('hidden')){
                        error_alert.classList.remove('hidden');
                    }
                    setTimeout(function(){
                        if(!error_alert.classList.contains('hidden')){
                            error_alert.classList.add('hidden');
                        }
                    }, 3000);
                }
            },
        });
    }


    function checkNewPass(){
        let pass = document.getElementById("new_pass").value;
        let passcheck = document.getElementById("pass-check-info");

        let current = document.getElementById("old_pass");
        let email = document.getElementById("acc_email");
        let save_btn = document.getElementById('savepass');

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

            let lengthinfo = document.getElementById("pass-min-length");
            let numberinfo = document.getElementById("pass-number");
            let symbolinfo = document.getElementById("pass-symbol");
            let upperinfo = document.getElementById("pass-uppercase");
            
            // check length
            if(pass.length < 8){
                has_ten_characters = false;
                if(lengthinfo.classList.contains('hidden')){
                    lengthinfo.classList.remove('hidden');
                }
            } else {
                has_ten_characters = true;
                if(!lengthinfo.classList.contains('hidden')){
                    lengthinfo.classList.add('hidden');
                }
            }

            // check if it has a number
            let has_number_check = pass.match(/\d+/g);
            if(Array.isArray(has_number_check)){
                has_number = true;
            } else {
                has_number = false;
            }

            if(has_number){
                if(!numberinfo.classList.contains('hidden')){
                    numberinfo.classList.add('hidden');
                }
            } else {
                if(numberinfo.classList.contains('hidden')){
                    numberinfo.classList.remove('hidden');
                }
            }

            // check for symbols
            var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
            has_symbol = format.test(pass);

            if(has_symbol){
                if(!symbolinfo.classList.contains('hidden')){
                    symbolinfo.classList.add('hidden');
                }
            } else {
                if(symbolinfo.classList.contains('hidden')){
                    symbolinfo.classList.remove('hidden');
                }
            }

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

            if(has_uppercase_letter){
                if(!upperinfo.classList.contains('hidden')){
                    upperinfo.classList.add('hidden');
                }
            } else {
                if(upperinfo.classList.contains('hidden')){
                    upperinfo.classList.remove('hidden');
                }
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

                if(current.value && email.value){
                    if(save_btn.classList.contains('btn-secondary')){
                        save_btn.classList.remove('btn-secondary');
                        if(!save_btn.classList.contains('btn-orange')){
                            save_btn.classList.add('btn-orange');
                        }
                    }
                    if(save_btn.classList.contains('disabled')){
                        save_btn.classList.remove('disabled');
                    }
                }
            } else {

                if(!save_btn.classList.contains('btn-secondary')){
                    save_btn.classList.add('btn-secondary');
                    if(save_btn.classList.contains('btn-orange')){
                        save_btn.classList.remove('btn-orange');
                    }
                }
                if(!save_btn.classList.contains('disabled')){
                    save_btn.classList.add('disabled');
                }
                

                document.getElementById("pass-strength").innerHTML = 'Unsecure';
            }

            

        } else {
            if(!passcheck.classList.contains("hidden")){
                passcheck.classList.add("hidden");
            }
        }
    }

    function savePass(){
        let email = document.getElementById("acc_email");
        let old_pass = document.getElementById("old_pass");
        let new_pass = document.getElementById("new_pass");
        let alert = document.getElementById("newpass");

        email.value = email.value.trim();
        old_pass.value = old_pass.value.trim();

        if(!email.value && !old_pass.value){
            alert.innerHTML = "Email and current password required";
            if(alert.classList.contains('hidden')){
                alert.classList.remove('hidden');
            }

            setTimeout(function(){
                if(!alert.classList.contains('hidden')){
                    alert.classList.add('hidden');
                }
            },3000);
        } else {
            let save_btn = document.getElementById('savepass');
            if(!save_btn.classList.contains('disabled')){

                $.ajax({
                    type: "POST",
                    url: 'userprofile/changepass',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        email: email.value,
                        old_pass: old_pass.value,
                        new_pass: new_pass.value
                    },
                    success: function(data, textStatus, xhr) {
                        if(xhr.status == 203){
                            alert.innerHTML = data;
                            if(alert.classList.contains('hidden')){
                                alert.classList.remove('hidden');
                            }

                            setTimeout(function(){
                                if(!alert.classList.contains('hidden')){
                                    alert.classList.add('hidden');
                                }
                            },3000);
                        } else {
                            email.value = "";
                            old_pass.value = "";
                            new_pass.value = "";
                            document.getElementById("bar").style.width = "0%";

                            document.getElementById("pass-min-length").classList.remove('hidden');
                            document.getElementById("pass-number").classList.remove('hidden');
                            document.getElementById("pass-symbol").classList.remove('hidden');
                            document.getElementById("pass-uppercase").classList.remove('hidden');
                            document.getElementById("pass-strength").innerHTML = "Unsecure";

                            $('#accountInfoModal').modal('hide');
                            $('#infoMessageModal').modal('show');
                        }
                    }

                });

            }
        }
    }

    function chooseNewsletter(option){
        let boxyes = document.getElementById('yes-newsletterbox');
        let boxno = document.getElementById('no-newsletterbox');
        switch (option) {
            case 'yes':
                document.getElementById('yes-newsletter').src = "/customer_page_images/body/Icon-Tick-Selected.svg";
                document.getElementById('no-newsletter').src = "/customer_page_images/body/Icon-Tick-Selected-clear.svg";
                if(boxyes.classList.contains('inactive')){
                    boxyes.classList.remove('inactive');
                }
                if(!boxno.classList.contains('inactive')){
                    boxno.classList.add('inactive');
                }
                break;
            case 'no':
                document.getElementById('no-newsletter').src = "/customer_page_images/body/Icon-Tick-Selected.svg";
                document.getElementById('yes-newsletter').src = "/customer_page_images/body/Icon-Tick-Selected-clear.svg";
                if(!boxyes.classList.contains('inactive')){
                    boxyes.classList.add('inactive');
                }
                if(boxno.classList.contains('inactive')){
                    boxno.classList.remove('inactive');
                }
                break;
            default:
                break;
        }
    }

    function saveSubscriptions(){
        let selected_newsletter = null;
        let yes_newsletter = document.getElementById("yes-newsletterbox");
        let no_newsletter = document.getElementById("no-newsletterbox");
        if(!yes_newsletter.classList.contains('inactive')){
            selected_newsletter = 'yes';
        } else {
            selected_newsletter = 'no';
        }

        $.ajax({
            type: "POST",
            url: 'userprofile/updatecommunications',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                newsletter: selected_newsletter,
            },
            success: function(data, textStatus, xhr) {
            }

        });
    }

    function validateManualDeliveryAddress(){
        var manual_delivery_section = document.getElementById('manual-delivery');
        var save_delivery = document.getElementById('save_manual_delivery');

        if(!manual_delivery_section.classList.contains('hidden')){
            let house_name_valid = false; 
            let street_name_valid = false; 
            let town_valid = false; 
            let city_valid = false; 
            let post_code_valid = false; 

            let housename = document.getElementById('delivery_house_name');
            let streetname = document.getElementById('delivery_street_name');
            let town = document.getElementById('delivery_town');
            let city = document.getElementById('delivery_city');
            let postcode = document.getElementById('delivery_post_code');

            if(housename.value && streetname.value && town.value && city.value && postcode.value){
                if(save_delivery.classList.contains('disabled')){
                    save_delivery.classList.remove('disabled');
                    if(!save_delivery.classList.contains('btn-green')){
                        save_delivery.classList.add('btn-green');
                    }
                }
            } else {
                if(!save_delivery.classList.contains('disabled')){
                    if(save_delivery.classList.contains('btn-green')){
                        save_delivery.classList.remove('btn-green');
                    }
                    save_delivery.classList.add('disabled');
                }
            }
        }
    }

    function validateManualBillingAddress(){
        var manual_billing_section = document.getElementById('manual-billing');
        var save_billing = document.getElementById('save_manual_billing');

        if(!manual_billing_section.classList.contains('hidden')){
            let house_name_valid = false; 
            let street_name_valid = false; 
            let town_valid = false; 
            let city_valid = false; 
            let post_code_valid = false; 

            let housename = document.getElementById('billing_house_name');
            let streetname = document.getElementById('billing_street_name');
            let town = document.getElementById('billing_town');
            let city = document.getElementById('billing_city');
            let postcode = document.getElementById('billing_post_code');

            if(housename.value && streetname.value && town.value && city.value && postcode.value){
                if(save_billing.classList.contains('disabled')){
                    save_billing.classList.remove('disabled');
                    if(!save_billing.classList.contains('btn-green')){
                        save_billing.classList.add('btn-green');
                    }
                }
            } else {
                if(!save_billing.classList.contains('disabled')){
                    if(save_billing.classList.contains('btn-green')){
                        save_billing.classList.remove('btn-green');
                    }
                    save_billing.classList.add('disabled');
                }
            }
        }
    }

    function toggleManualAddress(type){
        var manual_delivery = document.getElementById('manual-delivery');
        var arrow_delivery = document.getElementById('manual-delivery-arrow');
        var personal_delivery = document.getElementById('current-personal-delivery-address');

        var manual_billing = document.getElementById('manual-billing');
        var arrow_billing = document.getElementById('manual-billing-arrow');
        var personal_billing = document.getElementById('current-personal-billing-address');


        switch (type) {
            case 'delivery':
                if(manual_delivery.classList.contains('hidden')){
                    manual_delivery.classList.remove('hidden');
                    if(!personal_delivery.classList.contains('hidden')){
                        personal_delivery.classList.add('hidden');
                    }

                    if(arrow_delivery.classList.contains('down')){
                        arrow_delivery.classList.remove('down');
                        arrow_delivery.classList.add('up');
                    }
                    document.getElementById('delivery_address').readOnly = true;
                } else {
                    manual_delivery.classList.add('hidden');
                    if(personal_delivery.classList.contains('hidden')){
                        personal_delivery.classList.remove('hidden');
                    }

                    if(arrow_delivery.classList.contains('up')){
                        arrow_delivery.classList.remove('up');
                        arrow_delivery.classList.add('down');
                    }
                    document.getElementById('delivery_address').readOnly = false;
                }
                break;
        
            case 'billing':
                if(manual_billing.classList.contains('hidden')){
                    manual_billing.classList.remove('hidden');
                    if(!personal_billing.classList.contains('hidden')){
                        personal_billing.classList.add('hidden');
                    }

                    if(arrow_billing.classList.contains('down')){
                        arrow_billing.classList.remove('down');
                        arrow_billing.classList.add('up');
                    }
                    document.getElementById('billing_address').readOnly = true;

                } else {
                    manual_billing.classList.add('hidden');
                    if(personal_billing.classList.contains('hidden')){
                        personal_billing.classList.remove('hidden');
                    }

                    if(arrow_billing.classList.contains('up')){
                        arrow_billing.classList.remove('up');
                        arrow_billing.classList.add('down');
                    }
                    document.getElementById('billing_address').readOnly = false;
                }
                break;
        
            default:
                break;
        }
    }

    function saveAddress(type){
        switch (type) {
            case 'delivery':

                let housename_delivery = document.getElementById('delivery_house_name').value;
                let streetname_delivery = document.getElementById('delivery_street_name').value;
                let town_delivery = document.getElementById('delivery_town').value;
                let city_delivery = document.getElementById('delivery_city').value;
                let postcode_delivery = document.getElementById('delivery_post_code').value;

                let address_delivery = housename_delivery + ", " + streetname_delivery + ", " + town_delivery + ", " + city_delivery + ", " + postcode_delivery;

                document.getElementById('delivery_address').value = address_delivery;

                break;
            case 'billing':

                let housename_billing = document.getElementById('billing_house_name').value;
                let streetname_billing = document.getElementById('billing_street_name').value;
                let town_billing = document.getElementById('billing_town').value;
                let city_billing = document.getElementById('billing_city').value;
                let postcode_billing = document.getElementById('billing_post_code').value;

                let address_billing = housename_billing + ", " + streetname_billing + ", " + town_billing + ", " + city_billing + ", " + postcode_billing;

                document.getElementById('billing_address').value = address_billing;
                break;
            default:
                break;
        }
    }

    function saveChanges(){
        let firstname = document.getElementById('first_name');
        let lastname = document.getElementById('last_name');
        let birth_day = document.getElementById('birth_day');
        let birth_month = document.getElementById('birth_month');
        let birth_year = document.getElementById('birth_year');
        let contact_number = document.getElementById('contact_number');
        let delivery_address = document.getElementById('delivery_address');
        let billing_address = document.getElementById('billing_address');
        let current_phone = document.getElementById('currentPhone');
        let preffered_os = document.getElementById('prefferedOS');

        let firstnameval = firstname.value.trim();
        let lastnameval = lastname.value.trim();
        let birthdayval = birth_day.value.trim();
        let birthmonthval = birth_month.value.trim();
        let birthyearval = birth_year.value.trim();

        let contact_numberval = contact_number.value.trim();
        let billing_val = billing_address.value.trim();
        let delivery_val = delivery_address.value.trim();
        let current_phoneval = current_phone.value;
        let preffered_osval = preffered_os.value;

        $.ajax({
            type: "POST",
            url: '/userprofile/updatepersonalinfo',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                first_name: firstnameval,
                last_name: lastnameval,
                birth_day: birthdayval,
                birth_month: birthmonthval,
                birth_year: birthyearval,
                contact_number: contact_numberval,
                delivery_address: delivery_val,
                billing_address: billing_val,
                current_phone: current_phoneval,
                preffered_os: preffered_osval
            },
            success: function(data, textStatus, xhr) {
                if(data.status === 'error'){
                    // show alert error
                    let popup = document.getElementById('personal-info-error');
                    popup.innerHTML = data.msg;
                    if(popup.classList.contains('alert-success')){
                        popup.classList.remove('alert-success');
                        popup.classList.add('alert-danger');
                    }
                    if(popup.classList.contains('hidden')){
                        popup.classList.remove('hidden');
                    }
                    setTimeout(function(){
                        popup.classList.add('hidden');
                    }, 3000);
                }
                if(data.status === 'success'){
                    // show alert success
                    let popup = document.getElementById('personal-info-error');
                    popup.innerHTML = data.msg;
                    if(popup.classList.contains('alert-danger')){
                        popup.classList.remove('alert-danger');
                        popup.classList.add('alert-success');
                    }
                    if(popup.classList.contains('hidden')){
                        popup.classList.remove('hidden');
                    }
                    setTimeout(function(){
                        popup.classList.add('hidden');
                    }, 3000);
                }
            },
        });
    }

    function togglePassVisiblility(){
        let img = document.getElementById('pass-visibility-toggle');
        let input = document.getElementById('verify_pass');

        if (input.type === "password") {
            input.type = "text";
            img.src = '/images/front-end-icons/pass_visible.svg';
            img.style.bottom = '34px';
            img.style.right = '7px';
        } else {
            img.src = '/images/front-end-icons/pass_invisible.svg';
            input.type = "password";
            img.style.bottom = '31px';
            img.style.right = '5px';
        }
    }
    
    function toggleOldNewPassVisibility(field){
        var img;
        var pass;
        if(field === 'old'){
            img = document.getElementById('old-pass-visibility-toggle');
            pass = document.getElementById('old_pass');
        } else {
            img = document.getElementById('new-pass-visibility-toggle');
            pass = document.getElementById('new_pass');
        }
        
        if (pass.type === "password") {
            pass.type = "text";
            img.src = '/images/front-end-icons/pass_visible.svg';
            if(field === 'old'){
                img.style.bottom = '9px';
            } else {
                img.style.top = '39px';
            }
            img.style.right = '7px';
        } else {
            img.src = '/images/front-end-icons/pass_invisible.svg';
            pass.type = "password";
            if(field === 'old'){
                img.style.bottom = '7px';
            } else {
                img.style.top = '37px';
            }
            img.style.right = '5px';
        }
    }
</script>