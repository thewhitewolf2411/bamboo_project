<div class="app">

    <div class="about-page about-title-container">
        <div class="center-title-container">
            <p>About</p>
        </div>
    </div>

    <div class="about-first-element">
        <div class="center-title-container">
            <p>About us</p>
        </div>
        <p>Bamboo Mobile is a recognised international, independent mobile phone distributor, and recycler which has been operating for over 10 years by a management team of industry professionals.
            Adding value to products, Bamboo purchased all types of mobile handsets which then customises, with a multitude of services ranging from refurbishing, language flashing, and reworking to prepare for distribution.
            A professional work ethic and dedicated management team with over 50 years combined experience in the mobile industry, has seen the company become an established entity and trusted partner in the marketplace.
            Working with High Street Retailers, Authorised Distributors and Repairers, Insurance Companies, Independent Retails and Exporters, Bamboo assist their key partners and add value throughout the supply chain, delivering product solutions to individuals and companies.</p>
    </div>

    <div class="about-elements">
        <div class="about-element">
            <div class="about-element-text">
                <p class="left-title-text">About 1</p>
                <p>So, who are we? We are the daughter company of Bamboo Distribution, a global leader in the recovery, refurbishment, and recycling of consumer electronic devices. Being the mobile phone specialist business of Bamboo Distribution, We share our parent company’s commitment to do the right thing by the planet, as well as our customers. Not only do we preserve the same devotion to make the ‘3Rs’ of recycling – reducing, reusing and recycling – accessible to mobile-loving customers, but we are backed by Bamboo Distribution’s huge amount of experience in the recycling of consumer electronic devices – It’s a win-win for everyone. </p>
                <a href="/setpage/how">
                    <div class="btn btn-primary btn-green btn-font-white">
                        <p>How it works</p>
                    </div>
                </a>
            </div>
            <div class="about-image-container" id="first-about-image">
                <div class="about-rounded-image" id="first-round-image"></div>
            </div>
        </div>
        {{-- <div class="about-element">
            <div class="about-element-text">
                <p class="left-title-text">About 2</p>
                <p>Our dedicated and friendly management team purchase handle all types of mobile handsets devices. We then work our magic on the devices to prepare them for the market – offering top-quality recycled mobiles devices for incredible value for money. </p>
                <a href="">
                    <div class="btn btn-primary btn-blue btn-font-white">
                        <p>Buying a device</p>
                    </div>
                </a>
            </div>
            <div class="about-image-container" id="second-about-image">
                <div class="about-rounded-image" id="second-round-image"></div>
            </div>
        </div> --}}
        <div class="about-element">
            <div class="about-element-text">
                <p class="left-title-text">Sell to us</p>
                <p>At Bamboo Distribution we are always buying any quantity of mobile phones and electronic products in any condition. If getting good value, quick payment and great service is important to you please contact us today! We look forward to hearing from you.
</p>
                <a href="/sell">
                    <div class="btn btn-primary btn-orange btn-font-white">
                        <p>Start selling</p>
                    </div>
                </a>
            </div>
            <div class="about-image-container" id="third-about-image">
                <div class="about-rounded-image" id="third-round-image"></div>
            </div>
        </div>
    </div>

    <div class="about-sustainability">
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
            <p class="about-bamboo-text">Sustainability is at the heart of Bamboo Mobile and everything we do. Like our parent company, Bamboo Distribution, the protection of the environment is central to our ethics and business strategy. </p>
            <div class="grading-show-more-container">
                <a href="#"><div class="grading-show-more-btn">
                    <p>Read More</p>
                </div></a>
            </div>   
        </div>
    </div>

    <div class="shop-by-category">

        <div class="shop-categories-container">
            <a href="/sell/shop/mobile/all">
                <div class="category-container">
                    <p class="shop-title">Sell</p>
                    <p class="category-title">Mobile Phones</p>
                    <div class="rounded-background-image" id="rounded-mobile">
                        <img src="{{asset('/shop_images/category-image-1.png')}}">
                    </div>
                </div>
            </a>
            <a href="/sell/shop/tablets/all">
                <div class="category-container">
                    <p class="shop-title">Sell</p>
                    <p class="category-title">Tablets</p>
                    <div class="rounded-background-image" id="rounded-tablets">
                        <img src="{{asset('/shop_images/category-image-2.png')}}">
                    </div>
                </div>
            </a>
            <a href="/sell/shop/watches/all">
                <div class="category-container">
                    <p class="shop-title">Sell</p>
                    <p class="category-title">Watches</p>
                    <div class="rounded-background-image" id="rounded-watches">
                        <img src="{{asset('/shop_images/category-image-3.png')}}">
                    </div>
                </div>
            </a>
            {{-- <a href="#">
                <div class="category-container">
                    <p class="shop-title">Shop</p>
                    <p class="category-title">Mobile Phones</p>
                    <div class="rounded-background-image" id="rounded-accesories">
                        <img src="{{asset('/shop_images/category-image-4.png')}}">
                    </div>
                </div>
            </a> --}}
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

</div>