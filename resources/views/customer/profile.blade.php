<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/Customer.js') }}"></script>
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
                            <div class="menu-item"><img class="mr-3" src="{{asset('/images/logout-black.svg')}}">Log Out</div>
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
                                    <a class="action-button-right green" href="#">
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
                                            <div class="notification-card @if($notification['state'] === 'alert') red-border @endif">
                                                {{$notification['text']}}
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
                                            <p class="info-item-val">19/02/87</p>
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
                                                            <input type="password" name="password" id="verify_pass" required class="verification-input"/>
                                                            <a href="#" class="forgotpass-link">Forgot password?</a>
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
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content padded">
                                                <div class="validation-modal-header">
                                                    <img class="close-modal-img ml-auto" src="{{asset('/customer_page_images/body/modal-close.svg')}}" data-dismiss="modal" aria-label="Close">
                                                    <h5 class="validationModal-title" id="personalInfoModalLabel">Personal information</h5>
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
                                                            <input type="password" name="password" id="verify_pass" required class="verification-input"/>
                                                            <a href="#" class="forgotpass-link">Forgot password?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="alert alert-danger hidden" role="alert" id="verification-error">
                                                    Bad credentials.
                                                </div> --}}
                                                <div class="modal-footer border-0 p-0 padded">
                                                <button type="button" class="btn btn-primary ml-auto w-25" onclick="verify()">Verify</button>
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



                                    {{-- <input type="hidden" name="user" value="{{Auth::user()->id}}">
                                    <div class="element-three-top">
                                        <div class="profile-element-container p-1">
                                            <label for="name" class="profile-small">First Name</label>
                                            <input id="input-name" name="name" type="text" class="form-control" value="{{$userdata->first_name}}" disabled required></input>
                                        </div>
                                        <div class="profile-element-container p-1">
                                            <label for="lastname" class="profile-small">Last Name</label>
                                            <input id="input-lastname" name="lastname" type="text" class="form-control" value="{{$userdata->last_name}}" disabled required></input>
                                        </div>
                                    </div>
                                    <div class="element-three-bottom ">
                                        <div class="profile-element-container p-1">
                                            <label for="delivery_address" class="profile-small">Delivery address</label>
                                            <textarea id="delivery_address" name="delivery_address" type="text" class="form-control" value="{{$userdata->delivery_address}}" disabled required>{{$userdata->delivery_address}}</textarea>
                                        </div>
                                        <div class="profile-element-container p-1">
                                            <label for="billing_address" class="profile-small">Billing address</label>
                                            <textarea id="billing_address" name="billing_address" type="text" class="form-control" value="{{$userdata->billing_address}}" disabled required>{{$userdata->billing_address}}</textarea>
                                        </div>
                                        <div class="profile-element-container p-1">
                                            <label for="contact-number" class="profile-small">Contact number</label>
                                            <input id="contact-number" name="contact_number" type="number" class="form-control" value="{{$userdata->contact_number}}" disabled required></input>
                                        </div>
                                    </div> --}}
                
                                </div>

                                {{-- <form id="change-name" action="/userprofile/changename"  method="POST">
                                    @csrf
                                </form> --}}
                            </div>

                            <div id="section-account" class="page-sections hidden">
                                <div class="element-three-top-container">
                                    <h3>ACCOUNT INFORMATION</h3>
                                    <button type="button" class="btn btn-primary" style="background: #A375BC;" onclick="changename()">Edit</button>
                                </div>
                                <div class="element-three-top">
                                    <div class="profile-element-container p-1">
                                        <label for="email" class="profile-small">Email Address</label>
                                        <input id="input-email" name="email" type="email" class="form-control" value="{{$userdata->email}}" disabled required></input>
                                    </div>
                                    <div class="profile-element-container p-1">
                                        <label for="password" class="profile-small">Password</label>
                                        <input id="input-password" name="password" type="password" class="form-control" value="{{$userdata->password}}" disabled required></input>
                                    </div>
                                    
                                </div>
                            </div>

                            <div id="section-sales" class="page-sections hidden">
                                Sales
                            </div>

                            <div id="section-communications" class="page-sections hidden">
                                <div class="element-three-top-container">
                                    <h3>Newsletter subscription</h3>
                                </div>
                                <div class="element-three-bottom">
    
                                    <div class="newsletter-subscription">
                                        
                                        <label class="news-label">
                                            <input id="radio-checked-yes" type="radio" name="sub" value="true" disabled @if($userdata->sub == 1) checked="checked" @endif>
                                
                                            <div class="news-label-content">
                                                <p><b>Yes,</b> I would love to hear about the latest amazing offers, hints & tips</p>
                                                <div class="news-label-selected-container">
                                                    <img id="select-image-yes" src="{{asset('/customer_page_images/body/Icon-Tick-Selected-clear.svg')}}" width="48px" height="48px">
                                                    <p id="select-text-yes">Select</p>
                                                </div>
                                            </div>
                                
                                        </label>
                                
                                        <label class="news-label">
                                            <input id="radio-checked-no" type="radio" name="sub" value="false" disabled @if($userdata->sub == 0) checked="checked" @endif>
                                
                                            <div class="news-label-content">
                                                <p><b>No,</b>  I do not want to hear about the latest amazing offers, hints & tips</p>
                                                <div class="news-label-selected-container">
                                                    <img id="select-image-no" src="{{asset('/customer_page_images/body/Icon-Tick-Selected-clear.svg')}}" width="48px" height="48px">
                                                    <p id="select-text-no">Select</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    <button id="update-sub-submit" type="submit" class="btn btn-primary btn-hidden mt-3" style="background: #A375BC;" disabled>Update</button>
    
                                    <script>
                                            $('input[type=radio][name=sub]').change(function() {
                                                if (this.value == 'true') {
                                                    $('#select-image-yes').attr('src', '/customer_page_images/body/Icon-Tick-Selected.svg');
                                                    $('#select-text-yes').text('Selected');
                                                    $('#select-image-no').attr('src', '/customer_page_images/body/Icon-Tick-Selected-clear.svg');
                                                    $('#select-text-no').text('Select');
                                                }
                                                else if (this.value == 'false') {
                                                    $('#select-image-yes').attr('src', '/customer_page_images/body/Icon-Tick-Selected-clear.svg');
                                                    $('#select-text-yes').text('Select');
                                                    $('#select-image-no').attr('src', '/customer_page_images/body/Icon-Tick-Selected.svg');
                                                    $('#select-text-no').text('Selected');
                                                }
                                            });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="profile-container">

                    <div class="profile-element profile-element-one">
                        <div class="name-container">
                            <span><i class="fa fa-user-o" aria-hidden="true"></i>
                            <h3>Hello {{$userdata->first_name}}</h3></span>
                        </div>
                        <div class="logout-container">
                            <a href='/logout' class="btn btn-primary" style="background: #A3D147; color: #000; border:1px solid #A3D147">Not {{$userdata->first_name}}? <strong>Log out</strong></a>
                        </div>
                    </div>

                    <div class="profile-element profile-element-two">
                        <div class="profile-element-two-left">
                            <div class="bamboo-icon-container">
                                <img src="{{ asset('/customer_page_images/body/Bamboo-icon.svg') }}">
                            </div>
                            <div class="profile-element-two-content">
                                <div class="profile-element-two-text">
                                    <h4>BAMBOO CREDITS</h4>
                                    <p>Woohoo! You have done your part in saving the world by trading in your old devices. You can use you bamboo credits against any order within our shop.</p>
                                </div>
                                <div class="profile-element-two-btns">
                                    <!-- <div class="url-footer-container" id="start-shopping">
                                        <a href="/shop">Start Shopping</a>
                                    </div> -->
                                    <div class="url-footer-container" id="start-selling">
                                        <a href="/sell">Start Selling</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-element-two-right">
                            <div class="profile-element-two-right-balance">
                                <p><strong>£{{$userdata->bamboo_credit}}</strong></p>
                            </div>
                            <p style="margin: 0;">Cleared balance</p>
                        </div>
                    </div>

                    <div class="profile-element profile-element-four">
                    
                        <div class="profile-element-two-text py-3">
                            <h4>ORDER HISTORY</h4>
                        </div>

                        <div class="profile-element-two-text py-3">
                            <h4 style="color: #23AAF7;">Shopping</h4>
                        </div>

                        <div class="customer-orders customer-buying py-3">
                            <div class="d-flex order-row order-row-border-black">
                                <div class="w-25 p-2">
                                    <p class="profile-small">Order #</p>
                                </div>
                                <div class="w-50 p-2">
                                    <p class="profile-small">Date</p>
                                </div>
                                <div class="w-25 p-2">

                                </div>
                                <div class="w-25 p-2">
                                    <p class="profile-small">View more</p>
                                </div>
                            </div>

                            @foreach($tradeouts as $tradeout)
                            <div class="d-flex order-row order-row-border-black">
                                <div class="w-25 p-2">
                                    <p class="profile-large">Order #{{$tradeout->id}}</p>
                                </div>
                                <div class="w-50 p-2">
                                    <p class="profile-large">{{$tradeout->created_at->toFormattedDateString()}}</p>
                                </div>
                                <div class="w-25 p-2">
                                    <a href="">
                                        <div class="btn btn-danger">
                                            <p class="profile-large" style="color: #fff;">Cancel Order</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="w-25 p-2">
                                    <button type="button" class="btn btn-primary btn-blue profile-large" style="color: #fff;" onclick="showTradeOutModal({{$tradeout->id}})">
                                        View details
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="profile-element-two-text py-3">
                            <h4 style="color: #F28E33;">Selling</h4>
                        </div>

                        <div class="customer-orders customer-selling py-3">
                            <div class="d-flex order-row order-row-border-black">
                                <div class="w-25 p-2">
                                    <p class="profile-small">Order #</p>
                                </div>
                                <div class="w-50 p-2">
                                    <p class="profile-small">Date</p>
                                </div>
                                <div class="w-25 p-2">

                                </div>
                                <div class="w-25 p-2">
                                    <p class="profile-small">View more</p>
                                </div>
                            </div>

                            @foreach($tradeins as $tradein)
                            <div class="d-flex order-row">
                                <div class="w-25 p-2">
                                    <p class="profile-large">Order #{{$tradein->barcode}}</p>
                                </div>
                                <div class="w-50 p-2">
                                    <p class="profile-large">{{$tradein->created_at->toFormattedDateString()}}</p>
                                </div>
                                <div class="w-25 p-2">
                                    @if($tradein->job_state <= 2 )
                                    <a href="/userprofile/deleteorder/{{$tradein->barcode}}">
                                        <div class="btn btn-danger">
                                            <p class="profile-large" style="color: #fff;">Cancel Order</p>
                                        </div>
                                    </a>
                                    @endif
                                </div>
                                <div class="w-25 p-2">
                                    <button type="button" class="btn btn-primary btn-orange profile-large" style="color: #fff;" onclick="showModal({{$tradein->id}})">
                                        View details
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="profile-element profile-element-four border-0">
                    
                            <div class="profile-element-two-text py-3">
                                <h4>PAYMENT</h4>
                            </div>
                
                            <div class="customer-orders customer-buying py-3">

                                @if($userdata->hasPaymentDetails())
                                    <div class="row justify-content-start">
                                        <div class="col">
                                            <p class="m-0">Name on account</p>
                                            <p style="font-size: 20px;">{!!$userdata->accountName()!!}</p>
                                        </div>
                                        <div class="col">
                                            <p class="m-0">Account number</p>
                                            <p style="font-size: 20px;">{!!$userdata->accountNumber()!!}</p>
                                        </div>
                                        <div class="col">
                                            <p class="m-0">Sort Code</p>
                                            <p style="font-size: 20px;">{!!$userdata->sortCode()!!}</p>
                                        </div>

                                        <button type="button" class="btn btn-purple" style="color: white;" data-toggle="modal" data-target="#accountDetils">
                                            Re-enter details
                                        </button>
                                    </div>
                                @else
                                    <div class="row justify-content-sm-around">
                                        <div class="p-1">No payment information added. Please add your payment details.</div>

                                        <button type="button" class="btn btn-purple" style="color: white;" data-toggle="modal" data-target="#accountDetils">
                                            Enter details
                                        </button>
                                    </div>
                                @endif

                                @if(Session::has('account_fails'))
                                    <div class="row justify-content-center">
                                        <div class="alert alert-danger my-5" role="alert">
                                            @foreach(Session::get('account_fails') as $message)
                                                <li>{{$message}}</li>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if(Session::has('account_success'))
                                    <div class="row justify-content-center">
                                        <div class="alert alert-success my-5" role="alert">
                                            {!!Session::get('account_success')!!}
                                        </div>
                                    </div>
                                @endif
                
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="accountDetils" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered " role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">PAYMENT DETAILS</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" style="color: black;">&times;</span>
                                            </button>
                                        </div>
                                        <form id="accountdetails" method="POST" action="/userprofile/accountdetails">
                                            @csrf
                                            <div class="modal-body p-4">
                                                    <div class="col w-50 m-auto">
                                                        <label for="account_name" style="font-size: 16px;">Name on Account</label>
                                                        <input type="text" name="account_name" class="form-control" required aria-label="Amount (to the nearest dollar)">
                                                    </div>
                                                    <div class="col w-50 m-auto">
                                                        <label for="account_name" style="font-size: 16px;">Account number</label>
                                                        <input type="number" name="account_number" class="form-control" required aria-label="Amount (to the nearest dollar)">
                                                    </div>
                                                    <div class="col w-50 m-auto">
                                                        <label for="account_name" style="font-size: 16px;">Sort code</label>
                                                        <div class="row m-0 justify-content-start">
                                                            <input type="number" name="sort_code_1" required class="form-control text-center" style="width: 60px;" aria-label="Amount (to the nearest dollar)">
                                                            <p class="m-3">&mdash;</p>
                                                            <input type="number" name="sort_code_2" required class="form-control text-center" style="width: 60px;" aria-label="Amount (to the nearest dollar)">
                                                            <p class="m-3">&mdash;</p>
                                                            <input type="number" name="sort_code_3" required class="form-control text-center" style="width: 60px;" aria-label="Amount (to the nearest dollar)">
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" style="color: white;" class="btn btn-purple">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
            
                
                
                        </div>



                    </div>


                </div> --}}


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
                                <p class="black">Grade: {{ $tradein->product_state }}</p>
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
        
        <footer>@include('customer.layouts.footer')</footer>
    </body>
</html>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let buttons = document.getElementsByClassName('change-page');
    for (let index = 0; index < buttons.length; index++) {
        let button = buttons[index];
        button.onclick = function() {changeSection(button.id)};
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
        console.log(email);
        console.log(pass);

        $.ajax({
            type: "POST",
            url: 'userprofile/verify',
            data: {
                email: email,
                pass: pass
            },
            success: function(data){
                if(data === "200"){
                    $('#validationModal').modal('hide');
                    $('#personalInfoModal').modal('show');
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
</script>