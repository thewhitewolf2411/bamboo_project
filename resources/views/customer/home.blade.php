<div class="app">

    <div class="home-element home-title-container">
        <div class="left-container">
            <div class="title-container">
                <p>Pay less for your next mobile with bamboo</p>
            </div>
            <div class="start-buttons-container">
                <div class="url-footer-container" id="start-shopping">
                    <a href="#">Start Shopping</a>
                </div>
                <div class="url-footer-container" id="start-selling">
                    <a href="#">Start Selling</a>
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
            <div class="how-button-container active" id="shopping-btn" onclick="changeHowState('shopping')">
                <p>Shopping</p>
            </div>
            <div class="how-button-container" id="selling-btn" onclick="changeHowState('selling')">
                <p>Selling</p>
            </div>
        </div>

        <div class="shopping-content-container active">

            <div class="how-first-text-container">
                <div class="how-text-element">
                    <div class="how-text-title-container">
                        <p>1. YOU SEARCH FOR A NEW DEVICE</p>
                    </div>
                    <div class="how-text-container">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque varius euismod sollicitudin. Pellentesque convallis, diam ac vulputate suscipit, mi tortor molestie massa.</p>
                    </div>
                </div>
                <div class="how-text-element">
                    <div class="how-text-title-container">
                        <p>3. YOU HAVE A SHINY NEW DEVICE</p>
                    </div>
                    <div class="how-text-container">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque varius euismod sollicitudin. Pellentesque convallis, diam ac vulputate suscipit, mi tortor molestie massa.</p>
                    </div>
                </div>
            </div>

            <div class="how-images-container">
                <div class="back-line-container"></div>
                <div class="how-image-container">
                    <img src="{{asset('/customer_page_images/body/How-Icon-1.svg')}}">
                </div>
                <div class="how-image-container">
                    <img src="{{asset('/customer_page_images/body/How-Icon-2.svg')}}">
                </div>
                <div class="how-image-container">
                    <img src="{{asset('/customer_page_images/body/How-Icon-3.svg')}}">
                </div>
                <div class="url-footer-container" id="start-shopping">
                    <a href="#">Start Shopping</a>
                </div>
            </div>

            <div class="how-second-text-container">
                <div class="how-text-title-container">
                    <p>2. FREE NEXT DAY DELIVERY</p>
                </div>
                <div class="how-text-container">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque varius euismod sollicitudin. Pellentesque convallis, diam ac vulputate suscipit, mi tortor molestie massa.</p>
                </div>
            </div>

        </div>

        <div class="selling-content-container">
            <div class="how-second-text-container">
                <div class="how-text-element">
                    <div class="how-text-title-container">
                        <p>2. WE SEND YOU A FREE POST BOX</p>
                    </div>
                    <div class="how-text-container">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque varius euismod sollicitudin. Pellentesque convallis, diam ac vulputate suscipit, mi tortor molestie massa.</p>
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
                    <a href="#">Start Selling</a>
                </div>
            </div>

            <div class="how-first-text-container">
                <div class="how-text-element">
                    <div class="how-text-title-container">
                        <p>1. YOU SEARCH FOR A NEW DEVICE</p>
                    </div>
                    <div class="how-text-container">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque varius euismod sollicitudin. Pellentesque convallis, diam ac vulputate suscipit, mi tortor molestie massa.</p>
                    </div>
                </div>
                <div class="how-text-element">
                    <div class="how-text-title-container">
                        <p>3. GET PAID! WOOHOO!</p>
                    </div>
                    <div class="how-text-container">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque varius euismod sollicitudin. Pellentesque convallis, diam ac vulputate suscipit, mi tortor molestie massa.</p>
                    </div>
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
                <p class="about-bamboo-text">Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent non est id leo viverra porttitor. Vivamus iaculis nisl non hend.</p>
                <div class="grading-show-more-container">
                    <a href="#"><div class="grading-show-more-btn">
                        <p>Read More</p>
                    </div></a>
                </div>    
            </div>
    
            <div class="about-image-container">
                <div class="about-image">
                    <p>Space for image</p>
                </div>
            </div>
        </div>

        <div class="about-bottom-container">
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
    </div>

    <div class="home-element home-links-container">
        
        <div class="home-links-element">
            <a href="#">
                <div class="home-link-container" id="news">
                    <p>News & Blog</p>
                    <img src="{{asset('/customer_page_images/body/home-link-images/home-links-1.svg')}}">
                </div>
            </a>
        </div>

        <div class="home-links-element">
            <a href="#">
                <div class="home-link-container" id="service">
                    <p>Service & Support</p>
                    <img src="{{asset('/customer_page_images/body/home-link-images/home-links-2.svg')}}">
                </div>
            </a>
        </div>

        <div class="home-links-element">
            <a href="#">
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

        <form action="/" method="POST">
            @csrf

            <input class="email-input" type="email" placeholder="Enter email address here">
            <input class="email-submit" type="submit" value="Sign me up!">

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