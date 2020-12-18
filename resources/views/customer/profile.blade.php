<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/Customer.js') }}"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

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
                    <div class="center-title-container">
                        <p>My Account</p>
                    </div>
                </div>

                <div class="profile-container">

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
                                    <div class="url-footer-container" id="start-shopping">
                                        <a href="/shop">Start Shopping</a>
                                    </div>
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
                    <form id="change-name" action="/userprofile/changename"  method="POST">
                    @csrf
                    <div class="profile-element profile-element-three">
                        <div class="profile-element-three-left">
                            <div class="element-three-top-container">
                                <h3>PERSONAL INFORMATION</h3>
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
                            <input type="hidden" name="user" value="{{Auth::user()->id}}">
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
                            </div>

                        </div>
                        <div class="profile-element-three-right">
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
                                    <div class="d-flex">
                                        <input id="showpassword" type="checkbox" onclick="showPassword()" style="display:none; width:auto; margin:0;"><label id="showPasswordLabel" style="display:none; margin-left:1rem" for="showpassword">Show password</label>
                                    </div>
                                </div>
                                
                            </div>
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
                                    <p class="text-secondary">Order #{{$tradeout->id}}</p>
                                </div>
                                <div class="w-50 p-2">
                                    <p class="text-secondary">{{$tradeout->created_at->format('d/m/Y')}}</p>
                                </div>
                                <div class="w-25 p-2">
                                    <a href="">
                                        <div class="btn btn-danger">
                                            <p class="profile-large" style="color: #fff;">Cancel Order</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="w-25 p-2">
                                    <a onclick="">
                                        <div class="btn btn-primary btn-orange">
                                            <p class="profile-large" style="color: #fff;">View details</p>
                                        </div>
                                    </a>
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
                                    <p class="profile-large">{{$tradein->created_at->format('d/m/Y')}}</p>
                                </div>
                                <div class="w-25 p-2">
                                    @if($tradein->job_state == null )
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


                    </div>
                </div>
            </div>
        </main>


        @foreach($tradeins as $tradein)
        <div class="modal" tabindex="-1" role="dialog" aria-hidden="true" id="tradein-{{$tradein->id}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order #{{$tradein->barcode}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
        @endforeach

        @foreach($tradeouts as $tradeout)
        <div class="modal fade" tabindex="-1" role="dialog" id="{{$tradeout->barcode}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
        @endforeach


        <script>
        
        function showPassword(){
            var x = document.getElementById("input-password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function showModal(id){
            $('#tradein-' + id).modal('show');
        }

        </script>
        <footer>@include('customer.layouts.footer')</footer>
    </body>
</html>