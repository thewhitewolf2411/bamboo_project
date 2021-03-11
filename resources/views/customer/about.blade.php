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
        <p>Hello and welcome to Bamboo Mobile – aka ‘Boo’. In a nutshell, Bamboo Mobile offers a smart way for you to buy Shop and sell mobile phones and/or devices. With the help of Bamboo Mobile, you can trade in and trade up your mobile, quickly, safely, and simply – not to mention for a great price!</p>
    </div>

    <div class="about-elements">
        <div class="about-element">
            <div class="about-element-text">
                <p class="left-title-text">About 1</p>
                <p>So, who are we? We are the daughter company of Bamboo Distribution, a global leader in the recovery, refurbishment, and recycling of consumer electronic devices. Being the mobile phone specialist business of Bamboo Distribution, We share our parent company’s commitment to do the right thing by the planet, as well as our customers. Not only do we preserve the same devotion to make the ‘3Rs’ of recycling – reducing, reusing and recycling – accessible to mobile-loving customers, but we are backed by Bamboo Distribution’s huge amount of experience in the recycling of consumer electronic devices – It’s a win-win for everyone. </p>
                <a href="">
                    <div class="btn btn-primary btn-green btn-font-white">
                        <p>Buying a device</p>
                    </div>
                </a>
            </div>
            <div class="about-image-container" id="first-about-image">
                <div class="about-rounded-image" id="first-round-image"></div>
            </div>
        </div>
        <div class="about-element">
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
        </div>
        <div class="about-element">
            <div class="about-element-text">
                <p class="left-title-text">About 3</p>
                <p>If you love phones Tech and love value, you’ll love collaborating with Bamboo Mobile! 
Reach out to our friendly team of mobile phone recycling experts to chat about how we can provide you with the best value for mobile phones and devices, while helping save the environment at the same time. 
</p>
                <a href="">
                    <div class="btn btn-primary btn-orange btn-font-white">
                        <p>Buying a device</p>
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
            <a href="#">
                <div class="category-container">
                    <p class="shop-title">Shop</p>
                    <p class="category-title">Mobile Phones</p>
                    <div class="rounded-background-image" id="rounded-mobile">
                        <img src="{{asset('/shop_images/category-image-1.png')}}">
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="category-container">
                    <p class="shop-title">Shop</p>
                    <p class="category-title">Mobile Phones</p>
                    <div class="rounded-background-image" id="rounded-tablets">
                        <img src="{{asset('/shop_images/category-image-2.png')}}">
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="category-container">
                    <p class="shop-title">Shop</p>
                    <p class="category-title">Mobile Phones</p>
                    <div class="rounded-background-image" id="rounded-watches">
                        <img src="{{asset('/shop_images/category-image-3.png')}}">
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="category-container">
                    <p class="shop-title">Shop</p>
                    <p class="category-title">Mobile Phones</p>
                    <div class="rounded-background-image" id="rounded-accesories">
                        <img src="{{asset('/shop_images/category-image-4.png')}}">
                    </div>
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

        <form action="/" method="POST">
            @csrf

            <input class="email-input" type="email" placeholder="Enter email address here">
            <input class="email-submit" type="submit" value="Sign me up!">

        </form>

    </div>

</div>