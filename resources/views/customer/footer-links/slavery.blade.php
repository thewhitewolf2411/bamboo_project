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

        <meta name="viewport" content="width=device-width, initial-scale=1">

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
                        <p>Modern Slavery</p>
                    </div>
                </div>
                <a class="back-to-home-footer mt-3" href="/">
                    <p class="back-home-text"><img class="back-home-icon mr-2" src="{{asset('images/front-end-icons/black_arrow_left.svg')}}">Back to home</p>
                </a>

                <div class="container footer-legal">

                    <div class="col-md-12">
                        <div class="slavery-title-container-large">
                            <p class="text-left footer-text-title">INTRODUCTION</p>
                        </div>
                    </div>
                    <br>

                    <div class="col-md-12">
                        <p class="footer-text-small">
                            This statement is published in accordance with the Modern Slavery Act 2015 and sets out the steps that Bamboo Distribution Ltd has taken, and is continuing to take, to make sure that modern slavery or human trafficking is not taking place within our business or supply chain. <br>

                            Modern slavery encompasses slavery, servitude, human trafficking and forced labour. Bamboo has a zero-tolerance approach to any form of modern slavery. We are committed to acting ethically and with integrity and transparency in all business dealings and to putting effective systems and controls in place to safeguard against any form of 
                            modern slavery taking place within the business or our supply chain. 
                        </p>
                    </div>
                    <br>

                    <div class="col-md-12">
                        <div class="slavery-title-container-large">
                            <p class="text-left footer-text-title">OUR POLICIES ON SLAVERY AND HUMAN TRAFFICKING </p>
                        </div>
                        <p class="footer-text-small">
                            Our internal policies replicate our commitment to acting ethically and with integrity in all our business relationships. We operate a number of internal policies to ensure that we are conducting business in an ethical and transparent manner.  These include: 
                        </p>
                    </div>
                    <br>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p class="text-left footer-text-title">1. Recruitment policy</p>
                        </div>
                        <p class="footer-text-small">
                            We operate a robust recruitment policy, including conducting eligibility to work in the UK checks for all directly employed staff, and agencies on approved frameworks are audited to provide assurance that pre-employment clearance has been obtained for agency staff, to safeguard against human trafficking or individuals being forced to work against their will. 
                        </p>
                    </div>
                    <br>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p class="text-left footer-text-title">2. Equal Opportunities</p>
                        </div>
                        <p class="footer-text-small">
                            We have a range of controls to protect staff from poor treatment and/or exploitation, which comply with all respective laws and regulations. These include provision of fair pay rates, fair terms and conditions of employment, and access to training and development opportunities. 
                        </p>
                    </div>
                    <br>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p class="text-left footer-text-title">3. Whistle blowing policy</p>
                        </div>
                        <p class="footer-text-small">
                            We operate a whistle blowing policy so that all employees know that they can raise concerns about how colleagues or people receiving our services are being treated, or about practices within our business or supply chain, without fear of reprisals. 
                        </p>
                    </div>
                    <br>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p class="text-left footer-text-title">4. Supply chain</p>
                        </div>
                        <p class="footer-text-small">
                            Our approach to supply chain includes: 
                        </p>
                        <ul class="footer-text-small">
                            <li>Ensuring that our suppliers are carefully selected </li>
                            <li>Where a supplier has not met or has not been able to demonstrate that it has met our standards, we will immediately cease to trade with that supplier   </li>
                        </ul>
                    </div>
                    <br>

                    <div class="col-md-12">
                        <div class="slavery-title-container-small">
                            <p class="text-left footer-text-title">5. Training </p>
                        </div>
                        <p class="footer-text-small">
                            All relevant employees are given training to understand modern slavery and our policies and procedures to combat it
                        </p>
                    </div>
                    <br>

                    <div class="col-md-12">
                        <div class="slavery-title-container-large">
                            <p class="text-left footer-text-title">RISK ASSESSMENT AND DUE DILIGENCE </p>
                        </div>
                        <p class="footer-text-small">
                            We identify suppliers where there is a high risk of modern slavery occurring and increase the level of investigation accordingly. We will not trade with a business which does not meet our standards.  
                        </p>
                        <div class="slavery-title-container-large">
                            <p class="text-left footer-text-title">MEASURING EFFECTIVENESS </p>
                        </div>
                        <p class="footer-text-small">
                            We will understand the effectiveness of the steps that we are taking to ensure that slavery is not taking place within our business or supply chain if: 
                        </p>
                        <ul class="footer-text-small">
                            <li>We receive no reports from our staff, the public, or law enforcement agencies to indicate that modern slavery practices have been identified </li>
                            <li>We monitor the completion of our modern slavery training</li>
                            <li>We audit compliance with our procedures </li>
                        </ul>

                        <p class="footer-text-small">This statement was approved by the board on 10 December 2018</p>
                    </div>
                    <br>

                    <div class="col-md-12">

                        <p>Paula Hansson</p>
                        <p>Company Security</p>

                    </div>

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