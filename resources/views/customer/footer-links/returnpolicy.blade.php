<!DOCTYPE html>
<html>

    <head>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KC33JWC');</script>
        <!-- End Google Tag Manager -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Bamboo Mobile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="96x96" href="/customer_page_images/header/favicon-96x96.png">

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
                <div class="slavery-title-container">
                    <div class="center-title-container">
                        <p>Recycle Policy</p>
                    </div>
                </div>
                @if(Session::get('_previous') !== null)
                    <a class="back-to-home-footer padded mt-3" href="{{Session::get('_previous')['url']}}">
                @else
                    <a class="back-to-home-footer padded mt-3" href="/">
                @endif
                    <img class="back-home-icon mr-2" src="{{asset('images/front-end-icons/black_arrow_left.svg')}}">
                    <p class="back-home-text">Back</p>
                </a>

                <div class="container footer-legal">

                    <div class="col-md-12">

                        <ul class="footer-text-small">
                            <li>If a phone/device fails to meet our terms and conditions, we will offer you an adjusted price. If you choose to decline our new offer within 7 days of the adjusted price offer, we are happy to return the phone to you. </li>
                            <br>
                            <li>The phone/device will be returned to you by our chosen courier company at no additional cost.  Please note that we may not be able to return with the packaging or accessories received with your phone/device in the case of a rejected offer. </li>
                            <br>
                            <li>The phone/device will be return to the address details provided by you when registering the sell order. It is your sole responsibility to ensure that the address details you provided is correct and accurate and you agree we accept no responsibility or liability for any loss that may incur due to phone/device returned by us to an incorrect address provided by you.</li>
                            <br>
                            <li>You will be notified by us via email once the phone/device has been despatched. </li>
                            <br> 
                            <li>If your phone/device is not delivered when expected by our courier, you must notify us within 14 days of the despatch date. If you fail to notify us with 14 days, we are not liable for any loss or damage incurred as a result of non-delivery.</li>
                        </ul>
                    </div>

                    {{-- <div class="col-md-12">
                        <div class="slavery-title-container-large">
                            <p>OUR POLICIES ON SLAVERY AND HUMAN TRAFFICKING </p>
                        </div>
                        <p>
                            The phone/device will be returned to you by our chosen courier company at no additional cost.  Please note that we may not be able to return with the packaging or accessories received with your phone/device in the case of a rejected offer. 

                        </p>
                    </div>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p>1. Recruitment policy</p>
                        </div>
                        <p>
                            We operate a robust recruitment policy, including conducting eligibility to work in the UK checks for all directly employed staff, and agencies on approved frameworks are audited to provide assurance that pre-employment clearance has been obtained for agency staff, to safeguard against human trafficking or individuals being forced to work against their will. 
                        </p>
                    </div>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p>2. Equal Opportunities</p>
                        </div>
                        <p>
                            We have a range of controls to protect staff from poor treatment and/or exploitation, which comply with all respective laws and regulations. These include provision of fair pay rates, fair terms and conditions of employment, and access to training and development opportunities. 
                        </p>
                    </div>


                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p>3. Whistle blowing policy</p>
                        </div>
                        <p>
                            We operate a whistle blowing policy so that all employees know that they can raise concerns about how colleagues or people receiving our services are being treated, or about practices within our business or supply chain, without fear of reprisals. 
                        </p>
                    </div>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p>4. Supply chain</p>
                        </div>
                        <p>
                            Our approach to supply chain includes: 
                        </p>
                        <ul>
                            <li>Ensuring that our suppliers are carefully selected </li>
                            <li>Where a supplier has not met or has not been able to demonstrate that it has met our standards, we will immediately cease to trade with that supplier   </li>
                        </ul>
                    </div>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p>5. Training </p>
                        </div>
                        <p>
                            All relevant employees are given training to understand modern slavery and our policies and procedures to combat it
                        </p>
                    </div>

                    <div class="col-md-12">
                        <div class="slavery-title-container-large">
                            <p>RISK ASSESSMENT AND DUE DILIGENCE </p>
                        </div>
                        <p>
                            We identify suppliers where there is a high risk of modern slavery occurring and increase the level of investigation accordingly. We will not trade with a business which does not meet our standards.  
                        </p>
                        <div class="slavery-title-container-large">
                            <p>MEASURING EFFECTIVENESS </p>
                        </div>
                        <p>
                            We will understand the effectiveness of the steps that we are taking to ensure that slavery is not taking place within our business or supply chain if: 
                        </p>
                        <ul>
                            <li>We receive no reports from our staff, the public, or law enforcement agencies to indicate that modern slavery practices have been identified </li>
                            <li>We monitor the completion of our modern slavery training</li>
                            <li>We audit compliance with our procedures </li>
                        </ul>

                        <p>This statement was approved by the board on 10 December 2018</p>
                    </div>

                    <div class="col-md-12">

                        <p>Paula Hansson</p>
                        <p>Company Security</p>

                    </div> --}}

                </div>

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
        </main>
        <footer>@include('customer.layouts.footer', ['showGetstarted' => true])</footer>

        <script>

            function showRegistrationForm(){
                if(!document.getElementsByClassName('modal-second-element')[0].classList.contains('modal-second-element-active')){
                    document.getElementsByClassName('modal-second-element')[0].classList.add('modal-second-element-active');
                }
            }

        </script>

    </body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KC33JWC"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</html>