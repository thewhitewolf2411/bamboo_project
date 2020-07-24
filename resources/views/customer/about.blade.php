<div class="app">

    <div class="about-page about-title-container">
        <div class="center-title-container">
            <p>About</p>
        </div>
    </div>

    <div class="about-first-element">
        <div class="center-title-container">
            <p>About sub-heading</p>
        </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus.</p>
    </div>

    <div class="about-elements">
        <div class="about-element">
            <div class="about-element-text">
                <p class="left-title-text">About 1</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper,</p>
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
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper,</p>
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
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper,</p>
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
                <p>Space for image</p>
            </div>
            <div class="about-images" id="bottom-image">
                <p>Space for image</p>
            </div>
        </div>

        <div class="sustainability-element-container">
            <div class="center-title-container">
                <p>Sustainability</p>
            </div>
            <p class="about-bamboo-text">Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent non est id leo viverra porttitor. Vivamus iaculis nisl non hend.</p>
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