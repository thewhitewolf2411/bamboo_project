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

        @if($type == null)
            <p>Your Cart is empty</p>
        @endif

        @if($type=='tradein')
            <form action="/cart/sell" method="post">
                @csrf

                @foreach($sellingProducts as $item)
                    <div class="d-flex">
                        <div>{{$item->product_name}}</div>
                        <div>{{$item->product_memory}}</div>
                        <div>{{$item->product_colour}}</div>
                        <div>{{$item->product_network}}</div>
                        <input type="hidden" name="product_{{$item->id}}_id" value="{{$item->id}}">
                    </div>
                    @foreach($cart->items as $cartItem)
                        @if($cartItem['item'] == $item->id)
                            @if($cartItem['state'] == $item->product_grade_1)
                            <div class="d-flex flex-column">
                                <div>State : {{$item->product_grade_1}}</div>
                                <div>Our price : {{$item->product_selling_price_1}}</div>
                                <input type="hidden" name="product_{{$item->id}}_state" value="{{$item->product_grade_1}}">
                            </div>
                            @elseif($cartItem['state'] == $item->product_grade_2)
                            <div class="d-flex flex-column">
                                <div>State : {{$item->product_grade_2}}</div>
                                <div>Our price : {{$item->product_selling_price_2}}</div>
                                <input type="hidden" name="product_{{$item->id}}_state" value="{{$item->product_grade_2}}">
                            </div>
                            @elseif($cartItem['state'] == $item->product_grade_3)
                            <div class="d-flex flex-column">
                                <div>State : {{$item->product_grade_3}}</div>
                                <div>Our price : {{$item->product_selling_price_3}}</div>
                                <input type="hidden" name="product_{{$item->id}}_state" value="{{$item->product_grade_3}}">
                            </div>
                            @endif
                        @endif
                    @endforeach

                @endforeach

                <input type="hidden" name="order_code" id="order_code" value="">

                <button class="btn btn-primary btn-blue" type="submit">Potvrdi</div>

            </form>
        @endif


        </main>
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

@if(session('showLogin'))
    <script>
        $(window).on('load',function(){
            $('#loginModal').modal('show');
        });
    </script>
@endif
        <footer>@include('customer.layouts.footer')</footer>    
    </body>
    <script>

        var rand = Math.floor(10000000 + Math.random() * 900000);
        document.getElementById('order_code').value = rand;

    </script>
</html>