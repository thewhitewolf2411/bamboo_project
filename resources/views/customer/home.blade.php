@extends('customer.layouts.layout')

@section('content')

<div class="app">

    <div class="home-element home-title-container">
        <div class="left-container">
            <div class="title-container">
                <p>Pay less for your next mobile with bamboo</p>
            </div>
            <div class="start-buttons-container">
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
        <div class="center-title-container">
            <p>Sounds great, but, <br> how does it actually work?</p>
        </div>

        <div class="how-buttons-container">
            <div class="how-button-container active" id="selling-btn" onclick="changeHowState('selling')">
                <p>Selling</p>
            </div>
        </div>

        <div class="selling-content-container active">
            <div class="how-second-text-container">
                <div class="how-text-element">
                    <div class="how-text-title-container">
                        <p>2. FREE DELIVERY OPTIONS</p>
                    </div>
                    <div class="how-text-container">
                        <p>Once you have completed your sales order, you simply request for a free sales pack or print your own labels to send in your device.</p>
                    </div>
                </div>
            </div>

            <div class="how-images-container">
                <div class="back-line-container"></div>
                <div class="how-image-container">
                    <img src="{{asset('/customer_page_images/body/How-Icon-4.svg')}}">
                </div>
                <div class="how-image-container">
                    <img src="{{asset('/customer_page_images/body/How-Icon-5.svg')}}">
                </div>
                <div class="how-image-container">
                    <img src="{{asset('/customer_page_images/body/How-Icon-6.svg')}}">
                </div>
                <div class="url-footer-container" id="start-selling">
                    <a href="/sell">Start Selling</a>
                </div>
            </div>

            <div class="how-first-text-container">
                <div class="how-text-element">
                    <div class="how-text-title-container">
                        <p>1. REGISTER YOUR DEVICE TO SELL</p>
                    </div>
                    <div class="how-text-container">
                        <p>Find your old device and how much it's worth. Choose your preferred payment option with all your details.</p>
                    </div>
                </div>
                <div class="how-text-element">
                    <div class="how-text-title-container">
                        <p>3. FAST SAME DAY PAYMENT</p>
                    </div>
                    <div class="how-text-container">
                        <p>When we receive your device, we will check  it against your order. If it is all correct, payment will be made on the same day of receipt. Woohoo!</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="selling-content-container-mobile active">
            <div class="how-first-text-container">
                <div class="how-text-element">
                    <div class="how-text-title-container">
                        <p>1. REGISTER YOUR DEVICE TO SELL</p>
                    </div>
                    <div class="how-text-container">
                        <p>Find your old device and how much it's worth. Choose your preferred payment option with all your details.</p>
                    </div>
                </div>
                <div class="how-text-element">
                    <div class="how-text-title-container">
                        <p>2. FREE DELIVERY OPTIONS</p>
                    </div>
                    <div class="how-text-container">
                        <p>Once you have completed your sales order, you simply request for a free sales pack or print your own labels to send in your device.</p>
                    </div>
                </div>
                <div class="how-text-element">
                    <div class="how-text-title-container">
                        <p>3. FAST SAME DAY PAYMENT</p>
                    </div>
                    <div class="how-text-container">
                        <p>When we receive your device, we will check  it against your order. If it is all correct, payment will be made on the same day of receipt. Woohoo!</p>
                    </div>
                </div>
            </div>
            <div class="how-images-container">
                <div class="back-line-container"></div>
                <div class="how-image-container">
                    <img src="{{asset('/customer_page_images/body/How-Icon-4.svg')}}">
                </div>
                <div class="how-image-container">
                    <img src="{{asset('/customer_page_images/body/How-Icon-5.svg')}}">
                </div>
                <div class="how-image-container">
                    <img src="{{asset('/customer_page_images/body/How-Icon-6.svg')}}">
                </div>
                <div class="url-footer-container" id="start-selling">
                    <a href="/sell">Start Selling</a>
                </div>
            </div>
        </div>
    </div>

    <div class="home-element grading-container">
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
    </div>

    <div class="home-element popular-devices">
        <div class="center-title-container">
            <p>Popular devices</p>
        </div>

        <div class="devices-container">
            <div class="device-container">
                <img src="{{asset('/customer_page_images/body/mobile-images/Image 3.png')}}">
                <div class="category-text">
                    <p class="category-title">Apple</p>
                    <p class="model-title">iPhone X</p>
                </div>
            </div>
            <div class="device-container">
                <img src="{{asset('/customer_page_images/body/mobile-images/Image 4.png')}}">
                <div class="category-text">
                    <p class="category-title">Apple</p>
                    <p class="model-title">iPad Pro 11 inch 2020</p>
                </div>
            </div>
            <div class="device-container">
                <img src="{{asset('/customer_page_images/body/mobile-images/Image 5.png')}}">
                <div class="category-text">
                    <p class="category-title">Samsung</p>
                    <p class="model-title">Galaxy A10</p>
                </div>
            </div>
            <div class="device-container">
                <img src="{{asset('/customer_page_images/body/mobile-images/Image 6.png')}}">
                <div class="category-text">
                    <p class="category-title">Apple</p>
                    <p class="model-title">Watch Series 5 44mm</p>
                </div>
            </div>
        </div>
    </div>

    <div class="home-element about-container">
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
    </div>

    <div class="home-element home-links-container">
        
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

    </div>

    <div class="home-element sign-up">
        
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
                            <option value="16" default selected>0-16</option>
                            <option value="24" default selected>16-24</option>
                            <option value="48" default selected>24-48</option>
                            <option value="62" default selected>48-62</option>
                            <option value="62+" default selected>62+</option>
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
                <input type="checkbox" class="mx-3" id="newsletter_terms" name="newsletter_terms" required>
                <label for="terms">In addition to receiving an instant email when you open your account with Bamboo, I agree to Bamboo sending me a regular newsletter, carrying out market research, keeping me informed with personalised news, offers, products and promotions it believes would be of interest to me through my preferred channel. </label>
            </div>
        </form>

    </div>

    <script>
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

        function showgradingvideo(){
            console.log('Play video');
        }
    </script>
</div>

@endsection