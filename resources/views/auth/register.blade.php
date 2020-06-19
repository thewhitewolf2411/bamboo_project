<div class="container">

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="col-md-6">
            <input type="text" class="form-control" name="first_name" required placeholder="First name" >
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="surename" required placeholder="Surename" >
        </div>
        <div class="col-md-6">
            <input type="email" class="form-control" name="email" required placeholder="Email" >
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="company_name" placeholder="Company name">
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="address" required placeholder="Address" >
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="city" required placeholder="City" >
        </div>
        <div class="col-md-6">
            <input type="number" class="form-control" name="phone_number" required placeholder="Phone number" >
        </div>
        <div class="col-md-6">
            <input type="password" class="form-control" name="password" required placeholder="Password" >
        </div>
        <div class="col-md-6">
            <input type="password" class="form-control" name="password_confirm" required placeholder="Confrim Password" >
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form>

</div>