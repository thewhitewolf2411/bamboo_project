<!DOCTYPE html>
<html>

    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KC33JWC');</script>
        <!-- End Google Tag Manager -->

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bamboo Mobile</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/png" sizes="96x96" href="/customer_page_images/header/favicon-96x96.png">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <script src="{{ asset('js/app.js') }}" defer></script>

    </head>
    <body>
        {{-- {!!dd(App\Helpers\Dates::getYears())!!} --}}
        <header>@include('customer.layouts.header')</header>
        <main>

            @yield('content')

        </main>

        <div class="modal fade noscrolly" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <button onclick="showRegistrationForm()" class="btn btn-primary" id="registerBtn">
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
                                    @if(Session::has('error'))
                                        <div class="alert alert-danger" role="alert">
                                            <strong>{{ Session::get('error') }}</strong>
                                        </div>
                                    @endif
                                    <div class="form-group mb-0" style="display:flex; flex-direction: row; justify-content:space-between; align-items:center;">
                                        @if(Route::has('password.request'))
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

        @if(Session::has('regerror'))
        <script>
            $('#loginModal').modal('show');
            if(!document.getElementsByClassName('modal-second-element')[0].classList.contains('modal-second-element-active')){
                document.getElementsByClassName('modal-second-element')[0].classList.add('modal-second-element-active');
            }
        </script>
        @endif

        @if(session('showLogin') || $errors->all())
            <script>
                $(window).on('load',function(){
                    $('#loginModal').modal('show');
                });
            </script>
        @endif
        <script>
            function showRegistrationForm(){
                if(!document.getElementsByClassName('modal-second-element')[0].classList.contains('modal-second-element-active')){
                    document.getElementsByClassName('modal-second-element')[0].classList.add('modal-second-element-active');
                }
            }
            document.getElementById('registerBtn').addEventListener('click', function(){
                document.getElementById('loginModal').classList.remove('noscrolly');
            })
        </script>

    </body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KC33JWC"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</html>