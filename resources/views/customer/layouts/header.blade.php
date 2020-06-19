<div class="header-container">

    <div class="top-header-container">
        <div class="left-header-container">
            <div class="header-logo-container">

                <a href="/"><img src="{{asset('/customer_page_images/header/site_logo.jpg')}}" /></a>

            </div>
        </div>
        <div class="right-header-container">
            <div class="login-links-container">
                <label> My Account: &nbsp </label>
                @if(!Auth::user())
                    <a href="{{ route('login') }}">Login &nbsp | &nbsp</a>
                    <a href="{{ route('register') }}">Register</a>
                @else
                    <a href="{{ url('/') }}"> Home &nbsp | &nbsp</a>
                    <a href="{{ url('/logout') }}"> Logout &nbsp | &nbsp</a>
                    @if(Auth::user()->type_of_user==1)
                        <a href="{{ url('/portal') }}"> Portal </a>
                    @endif
                    @if(Auth::user()->type_of_user==2)
                        <a href="{{ url('/admin') }}"> Admin</a>
                    @endif
                    @if(Auth::user()->type_of_user==3)
                        <a href="{{ url('/admin') }}"> Admin &nbsp | &nbsp</a>
                        <a href="{{ url('/portal') }}"> Portal </a>
                    @endif
                @endif
                <div class="social-media-links">
                    <a class="social-link-image" href="https://www.facebook.com/BambooRecycle"><img src="{{asset('/customer_page_images/header/facebook.png')}}"/></a>
                    <a class="social-link-image" href="https://twitter.com/BambooRecycle"><img src="{{asset('/customer_page_images/header/twitter.png')}}"/></a>
                </div>
            </div>
            <div class="cart-header-container">
                <div class="basket-container">
                    <img src="{{asset('/customer_page_images/header/basket_icon.png')}}" />
                    <label>My Basket:</label>
                </div>
                <div class="basket-content-container">
                    <p>Your basket is empty.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="navigation-header-container">
        <div class="navigation-container">
            <div class="navigation-element-container"><a @if((session("page") && session('page')=="home") || (!session("page") && Request::path() == '/')) class="navigation-element-selected" @endif id="home" class="navigation-element" href="{{route('setpage', ['parameter' => 'home'])}}">Home</a></div>
            <div class="navigation-element-container"><a @if(session("page") && session('page')=="about") class="navigation-element-selected" @endif id="about" class="navigation-element" href="{{route('setpage', ['parameter' => 'about'])}}">About us</a></div>
            <div class="navigation-element-container"><a @if(session("page") && session('page')=="how") class="navigation-element-selected" @endif id="how" class="navigation-element" href="{{route('setpage', ['parameter' => 'how'])}}">How it works</a></div>
            <div class="navigation-element-container"><a @if((session("page") && session('page')=="sell")  || (Route::current()->getName() == "customerproducts") ) class="navigation-element-selected" @endif id="sell" class="navigation-element" href="{{route('setpage', ['parameter' => 'sell'])}}">Sell my mobile</a></div>
            <div class="navigation-element-container"><a @if(session("page") && session('page')=="faqs") class="navigation-element-selected" @endif id="faqs" class="navigation-element" href="{{route('setpage', ['parameter' => 'faqs'])}}">Faqs</a></div>
            <div class="navigation-element-container"><a @if(session("page") && session('page')=="support") class="navigation-element-selected" @endif id="support" class="navigation-element" href="{{route('setpage', ['parameter' => 'support'])}}">Support</a></div>
            <div class="navigation-element-container"><a @if(session("page") && session('page')=="contact") class="navigation-element-selected" @endif id="contact" class="navigation-element" href="{{route('setpage', ['parameter' => 'contact'])}}">Contact us</a></div>
        </div>
    </div>
</div>

