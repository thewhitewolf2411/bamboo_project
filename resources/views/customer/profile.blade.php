<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

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
                                        <a href="#">Start Shopping</a>
                                    </div>
                                    <div class="url-footer-container" id="start-selling">
                                        <a href="#">Start Selling</a>
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

                    <div class="profile-element profile-element-three">
                        <div class="profile-element-three-left">
                            <div class="element-three-top-container">
                                <h3>PERSONAL INFORMATION</h3>
                                <button class="btn btn-primary" style="background: #A375BC;">Edit</button>
                            </div>
                            <div class="element-three-top">
                                <div class="profile-element-container">
                                    <p class="profile-small">First Name</p>
                                    <p class="profile-large">{{$userdata->first_name}}</p>
                                </div>
                                <div class="profile-element-container">
                                    <p class="profile-small">Last Name</p>
                                    <p class="profile-large">{{$userdata->last_name}}</p>
                                </div>
                            </div>
                            <div class="element-three-bottom">
                                <div class="profile-element-container">
                                    <p class="profile-small">Delivery address</p>
                                    <p class="profile-large">{{$userdata->delivery_address}}</p>
                                </div>
                                <div class="profile-element-container">
                                    <p class="profile-small">Billing addreses</p>
                                    <p class="profile-large">{{$userdata->billing_address}}</p>
                                </div>
                                <div class="profile-element-container">
                                    <p class="profile-small">Contact number</p>
                                    <p class="profile-large">{{$userdata->contact_number}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="profile-element-three-right">
                            <div class="element-three-top-container">
                                <h3>ACCOUNT INFORMATION</h3>
                                <button class="btn btn-primary" style="background: #A375BC;">Edit</button>
                            </div>
                            <div class="element-three-top">
                                <div class="profile-element-container">
                                    <p class="profile-small">Email address</p>
                                    <p class="profile-large">{{$userdata->email}}</p>
                                </div>
                                <div class="profile-element-container">
                                    <p class="profile-small">Password</p>
                                    <input type="password" class="profile-large" value="{{$userdata->password}}" disabled></input>
                                </div>
                            </div>
                            <div class="element-three-top-container">
                                <h3>Newsletter subscription</h3>
                                <button class="btn btn-primary" style="background: #A375BC;">Save</button>
                            </div>
                            <div class="element-three-bottom">
                                <div class="newsletter-subscription">
                                    <label class="news-label">
                                        <input id="radio-checked-yes" type="radio" name="sub" value="true" checked="checked">
                            
                                        <div class="news-label-content">
                                            <p><b>Yes,</b> I would love to hear about the latest amazing offers, hints & tips</p>
                                            <div class="news-label-selected-container">
                                                <img id="select-image-yes" src="{{asset('/customer_page_images/body/Icon-Tick-Selected.svg')}}" width="48px" height="48px">
                                                <p id="select-text-yes">Selected</p>
                                            </div>
                                        </div>
                            
                                      </label>
                            
                                      <label class="news-label">
                                        <input id="radio-checked-no" type="radio" name="sub" value="false">
                            
                                        <div class="news-label-content">
                                            <p><b>No,</b>  I do not want to hear about the latest amazing offers, hints & tips</p>
                                            <div class="news-label-selected-container">
                                                <img id="select-image-no" src="{{asset('/customer_page_images/body/Icon-Tick-Selected-clear.svg')}}" width="48px" height="48px">
                                                <p id="select-text-no">Select</p>
                                            </div>
                                        </div>
                                      </label>
                                </div>
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
        </main>
        <footer>@include('customer.layouts.footer')</footer>
    </body>
</html>