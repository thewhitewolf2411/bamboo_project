<div class="app">
    <div class="how-page how-title-container">
        <div class="center-title-container">
            <p>How it works</p>
        </div>
    </div>

    <div class="how-first-element">
        <div class="d-flex flex-row justify-content-between">

            <div class="p-5 d-flex flex-column justify-content-between">
                <div class="center-title-container">
                    <p>Buy and sell easily <br> with just a few clicks</p>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus.</p>
            </div>
            <div class="p-5 d-flex flex-column justify-content-between">
                <div class="grading-video-container">
                    <a onclick="showgradingvideo()">
                        <div class="video-image-container">
                            <div class="play-container">
                                <i class="fa fa-play" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <p>Watch our quick video explaining just how thorough our grading system is. Trust us, you will be shocked.</p>
            </div>
        </div>
    </div>

    <div class="toggle-elements">
        <div class="toggle-elements-btn">
            <div class="toggle-element-btn shopping-toggle active">
                <a onclick="changeToggleElement('shopping')">
                    <p style="color: #23AAF7;" class="active" id="toggle-element-btn-shopping">Shopping with us</p>
                    <img src="">
                </a>
            </div>
            <div class="toggle-element-btn selling-toggle">
                <a onclick="changeToggleElement('selling')">
                    <p style="color: #FCC44C;" id="toggle-element-btn-selling">Selling with us</p>
                    <img src="">
                </a>
            </div>
        </div>
        <div class="toggle-element shopping-toggle active">

            <div class="shopping-element">
                <div class="shopping-element-image">
                    <img src="{{ asset('/customer_page_images/body/How-Icon-1.svg') }}">
                </div>
                <div class="shopping-element-text">
                    <p class="left-title-text">1. Search for a new device</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper,</p>
                </div>
            </div>
            <div class="shopping-element">
                <div class="shopping-element-image">
                    <img src="{{ asset('/customer_page_images/body/How-Icon-2.svg') }}">
                </div>
                <div class="shopping-element-text">
                    <p class="left-title-text">2. Free Next Day Delivery</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper,</p>
                </div>
            </div>
            <div class="shopping-element">
                <div class="shopping-element-image">
                    <img src="{{ asset('/customer_page_images/body/How-Icon-3.svg') }}">
                </div>
                <div class="shopping-element-text">
                    <p class="left-title-text">3. You have a shiny new phone to play with</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper,</p>
                </div>
            </div>

            <div class="url-footer-container" id="start-shopping">
                <a href="#">Start Shopping</a>
            </div>

        </div>
        <div class="toggle-element selling-toggle">

            <div class="shopping-element">
                <div class="shopping-element-text">
                    <p class="left-title-text">1. Search for a new device</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper,</p>
                </div>
                <div class="shopping-element-image">
                    <img src="{{ asset('/customer_page_images/body/How-Icon-4.svg') }}">
                </div>
            </div>

            <div class="shopping-element">
                <div class="shopping-element-text">
                    <p class="left-title-text">2. Free Next Day Delivery</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper,</p>
                </div>
                <div class="shopping-element-image">
                    <img src="{{ asset('/customer_page_images/body/How-Icon-5.svg') }}">
                </div>
            </div>

            <div class="shopping-element">
                <div class="shopping-element-text">
                    <p class="left-title-text">3. You have a shiny new phone to play with</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper,</p>
                </div>
                <div class="shopping-element-image">
                    <img src="{{ asset('/customer_page_images/body/How-Icon-6.svg') }}">
                </div>
            </div>

            <div class="url-footer-container" id="start-selling">
                <a href="#">Start Selling</a>
            </div>

        </div>
    </div>

    <div class="how-sustainability">
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

    function showgradingvideo(){
        console.log('Play video');
    }

    function changeToggleElement(elementclicked){
        console.log(elementclicked);

        if(elementclicked == 'shopping'){
            var shoppingelements = document.getElementsByClassName('shopping-toggle');
            var sellingelements = document.getElementsByClassName('selling-toggle');

            for(var i=0; i<shoppingelements.length; i++){
                if(shoppingelements[i].classList.contains('active')){
                    //do nothing
                }
                else{
                    sellingelements[i].classList.remove('active');
                    shoppingelements[i].classList.add('active');
                    document.getElementById('toggle-element-btn-selling').classList.remove('active');
                    document.getElementById('toggle-element-btn-shopping').classList.add('active');
                }

            }
        }

        if(elementclicked == 'selling'){
            var shoppingelements = document.getElementsByClassName('shopping-toggle');
            var sellingelements = document.getElementsByClassName('selling-toggle');

            for(var i=0; i<shoppingelements.length; i++){
                if(sellingelements[i].classList.contains('active')){
                    //do nothing
                }
                else{
                    sellingelements[i].classList.add('active');
                    shoppingelements[i].classList.remove('active');
                    document.getElementById('toggle-element-btn-selling').classList.add('active');
                    document.getElementById('toggle-element-btn-shopping').classList.remove('active');
                }

            }
        }
    }

    </script>

</div>