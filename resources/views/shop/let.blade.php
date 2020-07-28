<!DOCTYPE html>
<html>
    <head>
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
            <div class="shop-menu-container">

                <div class="shop-menu-element">
                    <a href="#"><div class="shop-link">Latest Offers</div></a>
                </div>
                <div class="shop-menu-element shop-dropdown">
                    <a href="#"><div class="shop-link">Shop Mobile Phones</div></a>
                </div>
                <div class="shop-menu-element">
                    <a href="#"><div class="shop-link">Shop Tablets</div></a>
                </div>
                <div class="shop-menu-element">
                    <a href="#"><div class="shop-link">Shop Accessories</div></a>
                </div>
                <div class="shop-menu-element">
                    <a href="#"><div class="shop-link">Shop Watches</div></a>
                </div>
                <div class="shop-menu-element">
                    <a href="#"><div class="shop-link">Compare Models</div></a>
                </div>
                <div class="shop-menu-element">
                    <a href="#"><div class="shop-link">Why Shop With Us</div></a>
                </div>
                <div class="shop-menu-element">
                    <a href="/shop/let"><div class="shop-link">Let boo do it, for you</div></a>
                </div>
            </div>
            <div class="trustpilot-container">
                <div class="trustpilot-element">
                    <img src="{{asset('/customer_page_images/body/trustpilot.png')}}">
                </div>
                <div class="trustpilot-element">
                    <p>Over 65,000 reviews</p>
                </div>
                <div class="trustpilot-element">
                    <div class="green-box">
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="green-box">
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="green-box">
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="green-box">
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="green-box">
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                </div>
            </div>

            <div class="let-top-container">
                <div class="center-title-container">
                    <p>Let Boo do it for you</p>
                </div>
            </div>

            <div class="let-form-container">
                <div class="center-title-container w50">
                    <p>A few questions to help find the best phone for you</p>
                </div>

                <p class="medium-text w70">With so many smartphones to choose from, it can be a challenge to decide which one to get. So let us help with a few simple questions to get the right phone for you.</p>
            
                <form action="/shop/choosephone" method="POST">

                    <div class="form-question-container">
                        <div class="progress-bar">
                            <div class="progress-percentege"></div>
                        </div>

                        <div class="form-icon-container image-round" id="sound-image">
                            <img src="">
                        </div>

                        <div class="question-container">
                            <p>1 - Do you listen to music on your phone?</p>
                        </div>

                        <div class="answers-container">
                            <label class="news-label">
                                <input type="radio" name="music-1">
                                <div class="news-label-content">
                                    <p>All The time</p>
                                    <div class="news-label-selected-container">
                                        <img id="select-image-yes" src="{{asset('/customer_page_images/body/Icon-Tick-Selected.svg')}}" width="48px" height="48px">
                                    </div>
                                </div>                    
                            </label>
                            
                        </div>

                        <p class="medium-text w70">
                            Audio is an important quality in any smartphone. While not all of them include decent speakers in the device itself, the compatibility with headphones lengthens the potential for great sound. Unfortunately, many phones are ditching the headphone jack these days.
                        </p>
                    </div>
                    

                </form>
            </div>

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


        <footer>@include('customer.layouts.footer')</footer>
        <script>

            function showRegistrationForm(){
                if(!document.getElementsByClassName('modal-second-element')[0].classList.contains('modal-second-element-active')){
                    document.getElementsByClassName('modal-second-element')[0].classList.add('modal-second-element-active');
                }
            }

            var perc = document.getElementsByClassName('progress-percentege');
            for(var i = 0; i<perc.length; i++){
                var wd = (i+1)*10;
                perc[i].style.width = wd + "%";
            }

        </script>
    </body>

</html>