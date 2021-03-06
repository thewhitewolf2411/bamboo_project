@extends('customer.layouts.layout')

@section('content')

<div class="app">

    <div class="home-element home-title-container" id="main-home-image">
        <div class="left-container" id="home-left-container">
            <div class="title-container" id="regular-title">
                <p class="heading-1">Pay less for your next mobile with bamboo</p>
            </div>
            <div class="offer-texts-container hidden" id="offers-texts">
                {{-- <p class="offer-top-bold">LATEST RECYCLE OFFER</p>
                <p class="offer-device-bold" id="offer-device"></p>
                <p class="offer-title-bold" id="offer-title"></p>
                <p class="offer-description-bold" id="offer-description"></p> --}}
                {{-- <a class="btn btn-light w-25 mt-2 mb-2" id="offer-link">Sell now</a> --}}
                {{-- <p class="offer-misc-small mt-5" id="offer-misc"></p> --}}
            </div>
            <div class="start-buttons-container" id="startbuttons">
                {{-- <div class="url-footer-container" id="start-shopping">
                    <a href="#">Start Shopping</a>
                </div> --}}
                <div class="url-footer-container ml-0 image-button" id="start-selling">
                    <a href="/sell">Start Selling</a>
                </div>
            </div>
        </div>
        <div class="right-container">
            <div class="sponsors-image-container">

            </div>
        </div>
    </div>

    <div class="home-element how-container">
        <div class="text-center">
            <p class="large-bold-text">Sounds great, but, <br>how does it actually work?</p>
        </div>

        <div class="how-buttons-container mt-5">
            {{-- <div class="how-button-container active" id="selling-btn" onclick="changeHowState('selling')"> --}}
            {{-- <div class="how-button-container active" id="selling-btn">
                <p class="semilarge-bold-text" style="cursor: default;">Selling</p>
            </div> --}}
            <div class="homepage-type-column">
                <div class="homepage-type-title">Selling</div>
                <div class="homepage-type-border orange"></div>
            </div>
        </div>

        <div class="selling-content-container active">
            {{-- <div class="how-second-text-container">
                <div class="how-text-element">
                    <div class="how-text-title-container">
                        <p class="how-title-text bebas-neue">2. FREE DELIVERY OPTIONS</p>
                    </div>
                    <div class="how-text-container">
                        <p class="regular-text">Once you have completed your sales order, you simply request a FREE Trade Pack or print your own labels to send in your device.</p>
                    </div>
                </div>
            </div> --}}

            <div class="homepage-types-text-wrapper">
            
                <div class="homepage-type-text-container second-step">
                    <p class="homepage-type-text-title">2. FREE DELIVERY OPTIONS</p>
                    <p class="homepage-type-text-desc">Once you have completed your sales order, you simply request a FREE Trade Pack or print your own labels to send in your device.</p>
                </div>

            </div>


            
            <div class="homepage-types-images-wrapper">

                <div class="hor-line-homepage"></div>

                <img class="homepage-type-step-image" src="{{asset('/customer_page_images/body/How-Icon-4.svg')}}">
                <img class="homepage-type-step-image larger" src="{{ asset('/customer_page_images/body/final_free_trade_pack.svg') }}">
                <img class="homepage-type-step-image last" src="{{asset('/customer_page_images/body/How-Icon-6.svg')}}">

                <a href="/sell" class="btn start-selling howitworks mt-4"><p>Start Selling</p></a>

            </div>

            <div class="homepage-types-text-wrapper"></div>

            <div class="homepage-types-text-wrapper">
                {{-- <div class="how-text-element">
                    <div class="how-text-title-container">
                        <!-- <p class="regular-bold-text">1. REGISTER YOUR DEVICE TO SELL</p> -->
                        <p class="how-title-text bebas-neue">1. YOU SEARCH FOR YOUR DEVICE</p>
                    </div>
                    <div class="how-text-container">
                        <p  class="regular-text">Find your old device and see how much it’s worth. Choose your preferred payment option with all your details.</p>
                    </div>
                </div> --}}

                {{-- <div class="how-text-element last-element">
                    <div class="how-text-title-container">
                        <p class="how-title-text bebas-neue">3. FAST SAME DAY PAYMENT</p>
                    </div>
                    <div class="how-text-container">
                        <p class="regular-text">When we receive your device, we will check  it against your order. If it is all correct, payment will be made on the same day we receive it. Woohoo!</p>
                    </div>
                </div> --}}

                <div class="homepage-type-text-container first-step">
                    <p class="homepage-type-text-title">1. YOU SEARCH FOR YOUR DEVICE</p>
                    <p class="homepage-type-text-desc">Find your old device and see how much it’s worth. Choose your preferred payment option with all your details.</p>
                </div>

                <div class="homepage-type-text-container third-step">
                    <p class="homepage-type-text-title">3. FAST SAME DAY PAYMENT</p>
                    <p class="homepage-type-text-desc">When we receive your device, we will check  it against your order. If it is all correct, payment will be made on the same day we receive it. Woohoo!</p>
                </div>

                
            </div>
        </div>

        <div class="selling-content-container-mobile active">
            <div class="how-first-text-container">
                <div class="how-text-element">
                    <div class="how-text-title-container">
                        <p class="how-title-text bebas-neue">1. REGISTER YOUR DEVICE TO SELL</p>
                    </div>
                    <div class="how-text-container">
                        <p class="regular-text">Find your old device and how much it's worth. Choose your preferred payment option with all your details.</p>
                    </div>
                </div>
                <div class="how-text-element">
                    <div class="how-text-title-container">
                        <p class="how-title-text bebas-neue">2. FREE DELIVERY OPTIONS</p>
                    </div>
                    <div class="how-text-container">
                        <p class="regular-text">Once you have completed your sales order, you simply request for a free sales pack or print your own labels to send in your device.</p>
                    </div>
                </div>
                <div class="how-text-element">
                    <div class="how-text-title-container">
                        <p class="how-title-text bebas-neue">3. FAST SAME DAY PAYMENT</p>
                    </div>
                    <div class="how-text-container">
                        <p class="regular-text">When we receive your device, we will check  it against your order. If it is all correct, payment will be made on the same day of receipt. Woohoo!</p>
                    </div>
                </div>
            </div>
            <div class="how-images-container">
                <div class="back-line-container"></div>
                <div class="how-image-container first">
                    <img src="{{asset('/customer_page_images/body/How-Icon-4.svg')}}">
                </div>
                <div class="how-image-container second">
                    <img src="{{asset('/customer_page_images/body/final_free_trade_pack.svg')}}">
                </div>
                <div class="how-image-container third">
                    <img src="{{asset('/customer_page_images/body/How-Icon-6.svg')}}">
                </div>
            </div>
        </div>
        <a href="/sell" class="btn start-selling howitworks mt-4 mobile"><p>Start Selling</p></a>
    </div>

    {{-- <div class="home-element grading-container">
        <div class="center-title-container">
            <p>Grading System Explained</p>
        </div>
        <div class="center-grading-elements">
            <div class="grading-text-container">
                <p>Watch our quick video explaining just how thorough our grading system is.<br>Trust us, you will be shocked.</p>
            </div>
            <div class="grading-video-container">
                <a onclick="showgradingvideo()">
                    <div class="video-image-container">
                        <div class="play-container">
                            <i class="fa fa-play" aria-hidden="true"></i>
                        </div>
                    </div>
                </a>
            </div>

            <div class="grading-show-more-container">

                <a href="#"><div class="grading-show-more-btn">

                    <p>Show More</p>

                </div></a>
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

            <div class="assurance-container">
                <div class="assurance-element">
                    <img src="{{asset('/customer_page_images/body/Assurance-image-1.svg')}}">
                    <p>FREE NEXT DAY NATIONWIDE DELIVERY</p>
                </div>
                <div class="assurance-element">
                    <img src="{{asset('/customer_page_images/body/Assurance-image-2.svg')}}">
                    <p>BAMBOO QUALITY APPROVED OVER 100 FUNCTIONAL CHECKS</p>
                </div>
                <div class="assurance-element">
                    <img src="{{asset('/customer_page_images/body/Assurance-image-3.svg')}}">
                    <p>NO QUIBBLE MONEY BACK</p>
                </div>
                <div class="assurance-element">
                    <img src="{{asset('/customer_page_images/body/Assurance-image-4.svg')}}">
                    <p>12 MONTH GUARANTEE</p>
                </div>
            </div>
        </div>
    </div> --}}
    @include('partial.paymentpostagebanner')

    @if($popular->count() > 0)
        <div class="home-element popular-devices">
            <div class="text-center mb-5">
                <p class="large-bold-text">Popular devices</p>
            </div>

            <div class="popular-devices-container">
                @foreach($popular as $device)
                
                    {{-- <a href="{{route('showSellItem', ['parameter' => $device->id])}}"> --}}

                        <a class="popular-product" href="{{route('showSellItem', ['parameter' => $device->id])}}">
                            <div class="popular-product-wrapper">
                                <div class="popular-product-image-container">
                                    @if($device->product_image === 'default_image')
                                        <img src="{{asset('/images/placeholder_phone_image.png')}}">
                                    @else
                                        <img src="{{$device->getImage()}}">
                                        {{-- <img src="{{asset('/storage/product_images').'/'.$device->product_image}}"> --}}
                                    @endif
                                </div>
                                <div class="popular-product-name-model mt-4">
                                    <p class="popular-product-brand">{!!$device->getBrand()!!}</p>
                                    <p class="popular-product-name">{{$device->product_name}}</p>
                                </div>
                            </div>
                            {{-- <div class="go-to-selldevice mt-4">
                                <img class="next-icon-results" src="{{asset('/images/front-end-icons/purple_arrow_next.svg')}}">
                            </div> --}}
                        </a>

                    {{-- </a> --}}

                @endforeach
            </div>

        </div>
    @endif

    @include('partial.sustainability', ['whySell' => false, 'about' => true])

    {{-- <div class="home-element about-container">
        <div class="about-top-container">
            <div class="about-element-container">
                <div class="center-title-container">
                    <p>About bamboo</p>
                </div>
                <p class="about-bamboo-text">Bamboo Mobile is a recognised international, independent mobile phone distributor, and recycler which has been operating for over 10 years by a management team of industry professionals.<br>
                    Adding value to products, Bamboo purchased all types of mobile handsets which then customises, with a multitude of services ranging from refurbishing, language flashing, and reworking to prepare for distribution.<br>
                    A professional work ethic and dedicated management team with over 50 years combined experience in the mobile industry, has seen the company become an established entity and trusted partner in the marketplace.<br>
                    Working with High Street Retailers, Authorised Distributors and Repairers, Insurance Companies, Independent Retails and Exporters, Bamboo assist their key partners and add value throughout the supply chain, delivering product solutions to individuals and companies.</p>
                <div class="grading-show-more-container">
                    <a href="/about"><div class="grading-show-more-btn">
                        <p>Read More</p>
                    </div></a>
                </div>    
            </div>
    
            <div class="about-image-container">
                <div class="about-image">
                    <img src="{{asset('/images/bamboo-laughing.gif')}}">
                </div>
            </div>
        </div>

        <div class="about-bottom-container">
            <div class="about-images-container">
                <div class="about-images" id="top-image">
                    <img src="{{asset('/images/ss-img-1.svg')}}">
                </div>
                <div class="about-images" id="bottom-image">
                    <img src="{{asset('/images/ss-img-2.svg')}}">
                </div>
            </div>

            <div class="sustainability-element-container">
                <div class="center-title-container">
                    <p>Sustainability</p>
                </div>
                <p class="about-bamboo-text">Buy from us <br>
                Sustainability is at the heart of Bamboo Mobile and everything we do. Like our parent company, Bamboo Distribution, the protection of the environment is central to our ethics and business strategy. 
                Put simply, the recycling of mobile phones devices helps save the environment, as it curbs mining processes. Through the recycling of phones devices , the minerals required to make mobile phone that are becoming increasingly sparse don’t need to be dug up. Vital minerals can be preserved to ensure no water or air pollution. 
                As well as reconditioning salvaged phones to an exceptionally high standard for resale, our sustainable business processes involve processing parts, accessories, and boxes. Consequently, Bamboo Mobile is truly committed to reducing the stress on the environment in every element of the buying and selling of mobile phones, phone accessories and the packaging they are supplied in. 
                Sell to us and you can sleep well at night knowing you are encouraging sustainability and protecting the environment. Buy from us and you can enjoy a shiny new mobile, recycled to an exceptionally high standard that costs a snippet of the price of a new phone – not to mention saving Planet Earth in the process. 
                Oh, we almost forgot… your stunning new device will come with a 12-month warranty – you can’t say fairer than that! 
                </p>
                <div class="grading-show-more-container">
                    <a href="/about"><div class="grading-show-more-btn">
                        <p>Read More</p>
                    </div></a>
                </div>   
            </div>
        </div>
    </div> --}}

    @include('partial.newscontactsupport')

    {{-- <div class="home-element home-links-container">
        
        <div class="home-links-element">
            <a href="/news">
                <div class="home-link-container" id="news">
                    <p>News & Blog</p>
                    <img src="{{asset('/customer_page_images/body/home-link-images/home-links-1.svg')}}">
                </div>
            </a>
        </div>

        <div class="home-links-element">
            <a href="/support">
                <div class="home-link-container" id="service">
                    <p>Service & Support</p>
                    <img src="{{asset('/customer_page_images/body/home-link-images/home-links-2.svg')}}">
                </div>
            </a>
        </div>

        <div class="home-links-element">
            <a href="/contact">
                <div class="home-link-container" id="contact">
                    <p>Contact us</p>
                    <img src="{{asset('/customer_page_images/body/home-link-images/home-links-3.svg')}}">
                </div>
            </a>
        </div>

    </div> --}}

    @include('partial.newsletter')
    {{-- <div class="home-element sign-up">
        
        <div class="center-title-container">
            <p>Sign up to our newsletter!</p>
        </div>

        <div class="text-center-container">
            <p>amazing offers, hints and tips and just awesome-ness</p>
        </div>

        <form action="/newslettersingup" method="POST">
            @csrf

            <div class="row w-100">
                <div class="col-md-6">
                    <div class="form-group">
                        <input class="email-input mt-0" name="first_name" type="text" placeholder="First Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input class="email-input mt-0" name="last_name" type="text" placeholder="Last Name">
                    </div>
                </div>
            </div>
            <div class="row w-100">
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="email-input w-100" name="age_range" id="age_range">
                            <option value="" default selected disabled>Age Range</option>
                            <option value="16">0-16</option>
                            <option value="24">16-24</option>
                            <option value="48">24-48</option>
                            <option value="62">48-62</option>
                            <option value="62+">62+</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <input class="email-input mt-0" name="email_address" type="email" placeholder="Email address">
                    </div>
                </div>
            </div>

            <div class="terms-container">
                <input type="checkbox" class="newsletter_checkbox mx-3" id="newsletter_terms" name="newsletter_terms">
                <label class="newsletter_checkbox" id="newsletter_terms_label" for="newsletter_terms">
                    <p style="margin-left: 40px">In addition to receiving an instant email when you open your account with Bamboo, I agree to Bamboo sending me a regular newsletter, carrying out market research, keeping me informed with personalised news, offers, products and promotions it believes would be of interest to me through my preferred channel. </p>
                </label>
            </div>

            <div class="form-group">
                <div class="col-md-3 mt-3 mx-auto">
                    <input type="submit" class="btn btn-purple" value="Sign me up!">
                </div>
            </div>
        </form>

    </div> --}}

    {{-- <footer> --}}
        @include('customer.layouts.footer', ['showGetstarted' => true])
    {{-- </footer> --}}

    {{-- {{dd(App\Helpers\RecycleOffers::check())}} --}}

    <script src="{{asset('/js/isMobile.js')}}"></script>

    <script>
         (function() {
            let offerbanner = JSON.parse('{!!App\Helpers\RecycleOffers::check()!!}');
            if(offerbanner){
                const isMobile = checkIsMobile();
                const userAgent = navigator.userAgent.toLowerCase();
                const isTablet = /(ipad|tablet|(android(?!.*mobile))|(windows(?!.*phone)(.*touch))|kindle|playbook|silk|(puffin(?!.*(IP|AP|WP))))/.test(userAgent);
                
                document.getElementById('home-left-container').classList.add('w-50');
                document.getElementById('offers-texts').classList.remove('hidden');
                document.getElementById('regular-title').classList.add('hidden');
                document.getElementById('startbuttons').classList.add('hidden');

                if(isTablet){
                    document.getElementById("main-home-image").style.backgroundImage = "url('"+offerbanner.tablet+"')";
                    document.getElementById("main-home-image").style.padding = '30px 150px'; 
                    document.getElementById("main-home-image").style.backgroundPosition = '0 0'; 
                    document.getElementById("main-home-image").onclick = function(){
                        window.location = "{!!App\Helpers\RecycleOffers::getLink()!!}";
                    }
                    console.log(offerbanner);
                    return;
                }

                if(isMobile){
                    document.getElementById("main-home-image").style.backgroundImage = "url('"+offerbanner.mobile+"')";
                    document.getElementById("main-home-image").style.padding = '30px 150px'; 
                    document.getElementById("main-home-image").style.backgroundPosition = '0 0'; 
                    document.getElementById("main-home-image").onclick = function(){
                        window.location = "{!!App\Helpers\RecycleOffers::getLink()!!}";
                    }
                    return;
                }

                document.getElementById("main-home-image").style.backgroundImage = "url('"+offerbanner.desktop+"')";
                document.getElementById("main-home-image").style.padding = '30px 150px'; 
                document.getElementById("main-home-image").onclick = function(){
                    window.location = "{!!App\Helpers\RecycleOffers::getLink()!!}";
                }
                document.getElementById("main-home-image").classList.add('cursor-pointer');
                
            }

        })();

        function changeHowState(btn){
            var shoppingBtn = document.getElementsByClassName('how-button-container')[0];
            var sellingBtn  = document.getElementsByClassName('how-button-container')[1];

            if(btn=='shopping'){
                if(shoppingBtn.classList.contains('active')){
                    return 0;
                }
                else{
                    sellingBtn.classList.remove('active');
                    shoppingBtn.classList.add('active');
                    document.getElementsByClassName('selling-content-container')[0].classList.remove('active');
                    document.getElementsByClassName('shopping-content-container')[0].classList.add('active');
                }
            }
            else if(btn=='selling'){
                if(sellingBtn.classList.contains('active')){
                    return 0;
                }
                else{
                    sellingBtn.classList.add('active');
                    shoppingBtn.classList.remove('active');
                    document.getElementsByClassName('selling-content-container')[0].classList.add('active');
                    document.getElementsByClassName('shopping-content-container')[0].classList.remove('active');
                }
            }

        }


    </script>
</div>

@endsection