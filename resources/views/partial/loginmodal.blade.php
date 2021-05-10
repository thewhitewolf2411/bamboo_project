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