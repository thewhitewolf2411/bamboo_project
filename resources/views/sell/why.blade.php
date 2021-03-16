<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        
        
        <title>Bamboo Mobile::Recycle</title>

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
            <div class="sell-top-container">
                <div class="top-upper-elements-container">
                    <a href="/sell/shop/mobile">
                        <div class="top-element-container">
                            <p>Sell Mobile Phones</p>
                        </div>
                    </a>
                    <a href="/sell/shop/tablets">
                        <div class="top-element-container">
                            <p>Sell Tablets</p>
                        </div>
                    </a>
                    <a href="/sell/shop/watches">
                        <div class="top-element-container">
                            <p>Sell Watches</p>
                        </div>
                    </a>
                    <a href="/sell/why">
                        <div class="top-element-container">
                            <p>Why Sell With Us</p>
                        </div>
                    </a>
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
            </div>

            <div class="why-page why-title-container">
                <div class="center-title-container">
                    <p>Why Sell With Us</p>
                </div>
            </div>

            <div class="how-first-element">
                <div class="d-flex flex-row justify-content-between border-down">
        
                    <div class="p-5 d-flex flex-column justify-content-between">
                        <div class="center-title-container">
                            <p>The benefits of selling <br> With Bamboo Mobile</p>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus.</p>
                    </div>
                    <div class="p-5 d-flex flex-column justify-content-between">
                        <div class="selling-video-container">
                            <p>Selling With Us</p>
                            <a onclick="showgradingvideo()">
                                <div class="video-image-container">
                                    <div class="play-container">
                                        <i class="fa fa-play" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </a>
                            <p>Explained</p>
                        </div>
                        <p>Watch our quick video explaining just how thorough our grading system is. Trust us, you will be shocked.</p>
                    </div>
                </div>
            </div>

            <div class="selling-with-container">
                <div class="center-title-container">
                    <p>Selling with us</p>
                </div>

                <div class="selling-with-elements">
                    <div class="selling-with-element selling-with-left">
                        <div class="selling-img-container">
                            <img src="{{asset('/sell_images/why_images/image-1.svg')}}">
                        </div>
                        <div class="selling-text-container">
                            <p class="title-orange">Same day paymet</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper.</p>
                        </div>
                    </div>
                    <div class="selling-with-element selling-with-right">
                        <div class="selling-text-container">
                            <p class="title-orange">Free Postage</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper.</p>
                        </div>
                        <div class="selling-img-container">
                            <img src="{{asset('/sell_images/why_images/image-2.svg')}}">
                        </div>
                    </div>
                    <div class="selling-with-element selling-with-left">
                        <div class="selling-img-container">
                            <img src="{{asset('/sell_images/why_images/image-3.svg')}}">
                        </div>
                        <div class="selling-text-container">
                            <p class="title-orange">GDPR compliant</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper.</p>
                        </div>
                    </div>
                    <div class="selling-with-element selling-with-right">
                        <div class="selling-text-container">
                            <p class="title-orange">Data is always protected</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper.</p>
                        </div>
                        <div class="selling-img-container">
                            <img src="{{asset('/sell_images/why_images/image-4.svg')}}">
                        </div>
                    </div>
                    <div class="selling-with-element selling-with-left">
                        <div class="selling-img-container">
                            <img src="{{asset('/sell_images/why_images/image-5.svg')}}">
                        </div>
                        <div class="selling-text-container">
                            <p class="title-orange">We help to Reduce, Reuse, Recycle</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper.</p>
                        </div>
                    </div>
                    <div class="selling-with-element selling-with-right">
                        <div class="selling-text-container">
                            <p class="title-orange">Bamboo Price or your device back for free</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas erat risus, condimentum sed leo ut, elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper, ex tellus finibus odio, eget accumsan risus ligula vel risus elementum laoreet tortor. Pellentesque rhoncus, leo non efficitur ullamcorper.</p>
                        </div>
                        <div class="selling-img-container">
                            <img src="{{asset('/sell_images/why_images/image-6.svg')}}">
                        </div>
                    </div>
                </div>

                <div class="selling-btn-container">
                    <a href="" class="btn btn-orange btn-primary">
                        Start Selling
                    </a>
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

            <div class="shop-categories-container w-1000">
                <a href="#">
                    <div class="category-container smaller-a">
                        <p class="shop-title">Mobile Phones</p>
                        <div class="rounded-background-image" id="rounded-mobile">
                            <img src="{{asset('/shop_images/category-image-1.png')}}">
                        </div>
                    </div>
                </a>
                <a href="#">
                    <div class="category-container smaller-a">
                        <p class="shop-title">Tablets</p>
                        <div class="rounded-background-image" id="rounded-tablets">
                            <img src="{{asset('/shop_images/category-image-2.png')}}">
                        </div>
                    </div>
                </a>
                <a href="#">
                    <div class="category-container smaller-a">
                        <p class="shop-title">Watches</p>
                        <div class="rounded-background-image" id="rounded-watches">
                            <img src="{{asset('/shop_images/category-image-3.png')}}">
                        </div>
                    </div>
                </a>
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

        </main>
        
        <footer>@include('customer.layouts.footer')</footer>
        <script>

            function showRegistrationForm(){
                if(!document.getElementsByClassName('modal-second-element')[0].classList.contains('modal-second-element-active')){
                    document.getElementsByClassName('modal-second-element')[0].classList.add('modal-second-element-active');
                }
            }

        </script>
    </body>
</html>