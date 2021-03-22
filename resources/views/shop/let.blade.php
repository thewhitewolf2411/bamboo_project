<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        
        <title>Bamboo Mobile::Shopping</title>

        <link rel="icon" type="image/png" sizes="96x96" href="/customer_page_images/header/favicon-96x96.png">
        
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
                    <a href="/shop/category/latest"><div class="shop-link">Latest Offers</div></a>
                </div>
                <div class="shop-menu-element shop-dropdown">
                    <a href="/shop/category/mobile"><div class="shop-link">Shop Mobile Phones</div></a>
                </div>
                <div class="shop-menu-element">
                    <a href="/shop/category/tablets"><div class="shop-link">Shop Tablets</div></a>
                </div>
                <div class="shop-menu-element">
                    <a href="/shop/category/accesories"><div class="shop-link">Shop Accessories</div></a>
                </div>
                <div class="shop-menu-element">
                    <a href="/shop/category/watches"><div class="shop-link">Shop Watches</div></a>
                </div>
                <div class="shop-menu-element">
                    <a href="/shop/compare/"><div class="shop-link">Compare Models</div></a>
                </div>
                <div class="shop-menu-element">
                    <a href="/shop/why"><div class="shop-link">Why Shop With Us</div></a>
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
                    @csrf
                    <div class="form-question-container">
                        <div class="progress-bar">
                            <div class="progress-percentege"></div>
                        </div>

                        <div class="form-icon-container image-round" id="q-1">
                            <img src="{{asset('/shop_images/letboo/011.svg')}}">
                        </div>

                        <div class="question-container">
                            <p class="question-bold">1 - Do you listen to music on your phone?</p>
                        </div>

                        <div class="answers-container">
                            <label class="answer-label">
                                <input type="radio" name="q-1" value="0">
                                <div class="answer-content">
                                    <p>All The time</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-1" value="1">
                                <div class="answer-content">
                                    <p>I only use Spotify or similar</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-1" value="2">
                                <div class="answer-content">
                                    <p>Not at all</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-1" value="3">
                                <div class="answer-content">
                                    <p>Sometimes</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                        </div>

                        <p class="medium-text w70 mb-50">
                            Audio is an important quality in any smartphone. While not all of them include decent speakers in the device itself, the compatibility with headphones lengthens the potential for great sound. Unfortunately, many phones are ditching the headphone jack these days.
                        </p>
                    </div>
                    
                    <div class="form-question-container">
                        <div class="progress-bar">
                            <div class="progress-percentege"></div>
                        </div>

                        <div class="form-icon-container image-round" id="q-2">
                            <img src="{{asset('/shop_images/letboo/013.svg')}}">
                        </div>

                        <div class="question-container">
                            <p class="question-bold">2 – Do specs matter to you?</p>
                        </div>

                        <div class="answers-container">
                            <label class="answer-label">
                                <input type="radio" name="q-2" value="0">
                                <div class="answer-content">
                                    <p>All they way!</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-2" value="1">
                                <div class="answer-content">
                                    <p>They’re just random numbers to me</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-2" value="2">
                                <div class="answer-content">
                                    <p>I at least want passable specs</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-2" value="3">
                                <div class="answer-content">
                                    <p>They matter, but they’re not a priority</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                        </div>

                        <p class="medium-text w70 mb-50">
                            Specs are important features of any smartphone. Once the product gets closer to release, companies will release all the details on their products for the spec heads in the crowd. These numbers matter to a lot of people, but others simply don’t care.
                        </p>
                    </div>

                    <div class="form-question-container">
                        <div class="progress-bar">
                            <div class="progress-percentege"></div>
                        </div>

                        <div class="form-icon-container image-round" id="q-3">
                            <img src="{{asset('/shop_images/letboo/012.svg')}}">
                        </div>

                        <div class="question-container">
                            <p class="question-bold">3 – Does resolution matter to you?</p>
                        </div>

                        <div class="answers-container">
                            <label class="answer-label">
                                <input type="radio" name="q-3" value="0">
                                <div class="answer-content">
                                    <p>4K or nothing</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-3" value="1">
                                <div class="answer-content">
                                    <p>UHD will get the job done</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-3" value="2">
                                <div class="answer-content">
                                    <p>FHD for me</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-3" value="3">
                                <div class="answer-content">
                                    <p>At least 1080p is more than fine</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                        </div>

                        <p class="medium-text w70 mb-50">
                            When phones started out with small pixelated displays, it’s shocking to think that they’re now sporting 4K screens that could rival computers and television sets. This upscale in quality makes phones more marketable on paper at the very least.
                        </p>
                    </div>

                    <div class="form-question-container">
                        <div class="progress-bar">
                            <div class="progress-percentege"></div>
                        </div>

                        <div class="form-icon-container image-round" id="q-4">
                            <img src="{{asset('/shop_images/letboo/014.svg')}}">
                        </div>

                        <div class="question-container">
                            <p class="question-bold">4 – Do you use your phone for productivity? (Work apps, reading etc.)</p>
                        </div>

                        <div class="answers-container">
                            <label class="answer-label">
                                <input type="radio" name="q-4" value="0">
                                <div class="answer-content">
                                    <p>My phone is solely for fun</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-4" value="1">
                                <div class="answer-content">
                                    <p>My phone is a productivity machine</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-4" value="2">
                                <div class="answer-content">
                                    <p>I play games on it and work</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-4" value="3">
                                <div class="answer-content">
                                    <p>Does asking Siri random questions count?</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                        </div>

                        <p class="medium-text w70 mb-50">
                            With the advancing tech of smartphones, it’s becoming more practical to use them for productivity. Many workers and students are now plugging their smartphones into their daily lives to get things done much more efficiently.
                        </p>
                    </div>

                    <div class="form-question-container">
                        <div class="progress-bar">
                            <div class="progress-percentege"></div>
                        </div>

                        <div class="form-icon-container image-round" id="q-5">
                            <img src="{{asset('/shop_images/letboo/019.svg')}}">
                        </div>

                        <div class="question-container">
                            <p class="question-bold">5 – Do you take pictures with your phone?</p>
                        </div>

                        <div class="answers-container">
                            <label class="answer-label">
                                <input type="radio" name="q-5" value="0">
                                <div class="answer-content">
                                    <p>I take pictures of everything</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-5" value="1">
                                <div class="answer-content">
                                    <p>I take a lot of pictures and video</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-5" value="2">
                                <div class="answer-content">
                                    <p>I don’t take pictures often</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-5" value="3">
                                <div class="answer-content">
                                    <p>I didn’t realise my phone had a camera</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                        </div>

                        <p class="medium-text w70 mb-50">
                            One unsung smartphone feature that’s become more impressive with age is the camera. While they were pretty cheap when smartphones first came out, they are now impressive machines that can shoot 4K video and work similarly to a true DSLR.
                        </p>
                    </div>

                    <div class="form-question-container">
                        <div class="progress-bar">
                            <div class="progress-percentege"></div>
                        </div>

                        <div class="form-icon-container image-round" id="q-6">
                            <img src="{{asset('/shop_images/letboo/029.svg')}}">
                        </div>

                        <div class="question-container">
                            <p class="question-bold">6 – Do you like to customise your phone?</p>
                        </div>

                        <div class="answers-container">
                            <label class="answer-label">
                                <input type="radio" name="q-6" value="0">
                                <div class="answer-content">
                                    <p>Customisation is important</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-6" value="1">
                                <div class="answer-content">
                                    <p>As long as I can get a case, I am good</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-6" value="2">
                                <div class="answer-content">
                                    <p>Phone looks great, why change it</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-6" value="3">
                                <div class="answer-content">
                                    <p>Customisation isn’t important</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                        </div>

                        <p class="medium-text w70 mb-50">
                            Some phone companies have emphasised customisation over anything else. Allowing the consumer to decide the cosmetics that go into their phone is a smart choice and one that often pays off. A lot of phones also sport software that can be played with fairly easily.
                        </p>
                    </div>

                    <div class="form-question-container">
                        <div class="progress-bar">
                            <div class="progress-percentege"></div>
                        </div>

                        <div class="form-icon-container image-round" id="q-7">
                            <img src="{{asset('/shop_images/letboo/037.svg')}}">
                        </div>

                        <div class="question-container">
                            <p class="question-bold">7 – What is your budget for a smartphone?</p>
                        </div>

                        <div class="answers-container">
                            <label class="answer-label">
                                <input type="radio" name="q-7" value="0">
                                <div class="answer-content">
                                    <p>I have no budget</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-7" value="1">
                                <div class="answer-content">
                                    <p>£750-£1000</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-7" value="2">
                                <div class="answer-content">
                                    <p>£749 - £500</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-7" value="3">
                                <div class="answer-content">
                                    <p>£500 or less</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                        </div>

                        <p class="medium-text w70 mb-50">
                            With the serious amount of tech that’s placed into new smartphones, their prices severely hike up. The iPhone X sits at a handsome £1000 for the base model alone! Needless to say, there are alternative options to standard flagships, and what you get will depend on your budget.
                        </p>
                    </div>

                    <div class="form-question-container">
                        <div class="progress-bar">
                            <div class="progress-percentege"></div>
                        </div>

                        <div class="form-icon-container image-round" id="q-8">
                            <img src="{{asset('/shop_images/letboo/027.svg')}}">
                        </div>

                        <div class="question-container">
                            <p class="question-bold">8 – How big do you want your screen?</p>
                        </div>

                        <div class="answers-container">
                            <label class="answer-label">
                                <input type="radio" name="q-8" value="0">
                                <div class="answer-content">
                                    <p>As big as possible</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-8" value="1">
                                <div class="answer-content">
                                    <p>Big but not unwieldy</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-8" value="2">
                                <div class="answer-content">
                                    <p>I like more compact designs</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="radio" name="q-8" value="3">
                                <div class="answer-content">
                                    <p>It doesn’t make a difference to me</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                        </div>

                        <p class="medium-text w70 mb-50">
                            Screen size is an important aspect of any smartphone. As the technology has advanced, the screens have gotten larger. Now we have impressive 18:9 aspect ratios on your handsets. That said, that design philosophy isn’t for everyone.
                        </p>
                    </div>

                    <div class="form-question-container">
                        <div class="progress-bar">
                            <div class="progress-percentege"></div>
                        </div>

                        <div class="form-icon-container image-round" id="q-9">
                            <img src="{{asset('/shop_images/letboo/030.svg')}}">
                        </div>

                        <div class="question-container">
                            <p class="question-bold">9 – What features are important to you? Select more than one </p>
                        </div>

                        <div class="answers-container">
                            <label class="answer-label">
                                <input type="checkbox" name="q-9-1">
                                <div class="answer-content">
                                    <p>Virtual assistant (Siri, Google)</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="checkbox" name="q-9-2">
                                <div class="answer-content">
                                    <p>Headphone jack</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="checkbox" name="q-9-3">
                                <div class="answer-content">
                                    <p>Longer battery life</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                            <label class="answer-label">
                                <input type="checkbox" name="q-9-4">
                                <div class="answer-content">
                                    <p>Water resistance</p>
                                </div>
                                <img src="{{asset('/shop_images/letboo/033.svg')}}">
                            </label>
                        </div>

                        <p class="medium-text w70 mb-50">
                            Bells and whistles are neat to have, but they are seldom more useful than for a few party tricks. Some carriers like to push these unique features (like the face-tracking emojis). Few people really love them, and most people just want better products rather than cheap gimmicks.
                        </p>
                    </div>

                    <div class="form-question-container">
                        <div class="progress-bar">
                            <div class="progress-percentege"></div>
                        </div>

                        <div class="form-icon-container image-round" id="q-10">
                            <img src="{{asset('/shop_images/letboo/026.svg')}}">
                        </div>

                        <div class="question-container">
                            <p class="question-bold">10 – What is your current phone?</p>
                        </div>

                        <div class="answers-container">
                            <input type="text" placeholder="Your device" name="q-10">
                        </div>

                        <p class="medium-text w70 mb-50">
                            Odds are that you already have a phone that you’re attached to, but you’re ready for an upgrade. What you already have and are familiar with will likely determine what you end up looking for going forward. Some people just like to get the next model of their favourite brand, while others prefer changing it up.
                        </p>
                    </div>

                    <div class="form-submit-container">
                        <button type="submit" class="btn btn-primary btn-blue">Find me my new phone</button>
                    </div>

                </form>
            </div>

            <div class="let-footer">
                <div class="contact-footer-image">
                    <img src="{{asset('/shop_images/letboo/035.svg')}}">
                </div>
                <div class="contact-footer-text">
                    <p class="service-header-1" >Save up to £300</p>
                    <p class="service-header-2">By trading in your old device when you make a purchase.</p>
                </div>
                <div class="contact-footer-arrow">
                    <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
                </div>
            </div>

            <div class="home-element sign-up">
        
                <div class="center-title-container">
                    <p>Sign up to our newsletter!</p>
                </div>
        
                <div class="text-center-container">
                    <p>amazing offers, hints and tips and just awesome-ness</p>
                </div>
        
                <form action="/" method="POST">
                    @csrf
        
                    <input class="email-input" type="email" placeholder="Enter email address here">
                    <input class="email-submit" type="submit" value="Sign me up!">
        
                    <div class="terms-container">
                        <input type="checkbox" class="mx-3" id="terms" name="terms" required>
                        <label for="terms">I agree to Bamboo Mobile <a href="/terms">Terms and Conditions</a></label>
                    </div>
                </form>
        
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

            var perc = document.getElementsByClassName('progress-percentege');
            for(var i = 0; i<perc.length; i++){
                var wd = (i+1)*10;
                perc[i].style.width = wd + "%";
            }

        </script>

        <script>

            $("input[name='q-1']").click(function() {
                
                $("input[name='q-1']").next().removeClass('answer-content-active');
                $("input[name='q-1']").next().next().attr('src', '/shop_images/letboo/033.svg');

                if($(this).is(":checked")){
                    $(this).next().addClass('answer-content-active');
                    $(this).next().next().attr('src', '/shop_images/letboo/Icon-Tick-Selected-Blue.svg');
                }

            });
            $("input[name='q-2']").click(function() {
                console.log("kurcina");
                $("input[name='q-2']").next().removeClass('answer-content-active');
                $("input[name='q-2']").next().next().attr('src', '/shop_images/letboo/033.svg');

                if($(this).is(":checked")){
                    $(this).next().addClass('answer-content-active');
                    $(this).next().next().attr('src', '/shop_images/letboo/Icon-Tick-Selected-Blue.svg');
                }

            });
            $("input[name='q-3']").click(function() {
                
                $("input[name='q-3']").next().removeClass('answer-content-active');
                $("input[name='q-3']").next().next().attr('src', '/shop_images/letboo/033.svg');

                if($(this).is(":checked")){
                    $(this).next().addClass('answer-content-active');
                    $(this).next().next().attr('src', '/shop_images/letboo/Icon-Tick-Selected-Blue.svg');
                }

            });
            $("input[name='q-4']").click(function() {
                
                $("input[name='q-4']").next().removeClass('answer-content-active');
                $("input[name='q-4']").next().next().attr('src', '/shop_images/letboo/033.svg');

                if($(this).is(":checked")){
                    $(this).next().addClass('answer-content-active');
                    $(this).next().next().attr('src', '/shop_images/letboo/Icon-Tick-Selected-Blue.svg');
                }

            });
            $("input[name='q-5']").click(function() {
                
                $("input[name='q-5']").next().removeClass('answer-content-active');
                $("input[name='q-5']").next().next().attr('src', '/shop_images/letboo/033.svg');

                if($(this).is(":checked")){
                    $(this).next().addClass('answer-content-active');
                    $(this).next().next().attr('src', '/shop_images/letboo/Icon-Tick-Selected-Blue.svg');
                }

            });
            $("input[name='q-6']").click(function() {
                
                $("input[name='q-6']").next().removeClass('answer-content-active');
                $("input[name='q-6']").next().next().attr('src', '/shop_images/letboo/033.svg');

                if($(this).is(":checked")){
                    $(this).next().addClass('answer-content-active');
                    $(this).next().next().attr('src', '/shop_images/letboo/Icon-Tick-Selected-Blue.svg');
                }

            });
            $("input[name='q-7']").click(function() {
                
                $("input[name='q-7']").next().removeClass('answer-content-active');
                $("input[name='q-7']").next().next().attr('src', '/shop_images/letboo/033.svg');

                if($(this).is(":checked")){
                    $(this).next().addClass('answer-content-active');
                    $(this).next().next().attr('src', '/shop_images/letboo/Icon-Tick-Selected-Blue.svg');
                }

            });
            $("input[name='q-8']").click(function() {
                
                $("input[name='q-8']").next().removeClass('answer-content-active');
                $("input[name='q-8']").next().next().attr('src', '/shop_images/letboo/033.svg');

                if($(this).is(":checked")){
                    $(this).next().addClass('answer-content-active');
                    $(this).next().next().attr('src', '/shop_images/letboo/Icon-Tick-Selected-Blue.svg');
                }

            });
            $("input[name='q-9-1']").click(function() {

                if($(this).is(":checked")){
                    $(this).next().addClass('answer-content-active');
                    $(this).next().next().attr('src', '/shop_images/letboo/Icon-Tick-Selected-Blue.svg');
                }

            });
            $("input[name='q-9-2']").click(function() {

                if($(this).is(":checked")){
                    $(this).next().addClass('answer-content-active');
                    $(this).next().next().attr('src', '/shop_images/letboo/Icon-Tick-Selected-Blue.svg');
                }

            });
            $("input[name='q-9-3']").click(function() {

                if($(this).is(":checked")){
                    $(this).next().addClass('answer-content-active');
                    $(this).next().next().attr('src', '/shop_images/letboo/Icon-Tick-Selected-Blue.svg');
                }

            });
            $("input[name='q-9-4']").click(function() {

                if($(this).is(":checked")){
                    $(this).next().addClass('answer-content-active');
                    $(this).next().next().attr('src', '/shop_images/letboo/Icon-Tick-Selected-Blue.svg');
                }

            });
        </script>
    </body>

</html>