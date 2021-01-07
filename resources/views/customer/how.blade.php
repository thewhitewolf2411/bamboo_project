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
                    <p>Shop and sell easily <br> with just a few clicks</p>
                </div>
                <p>We pride ourselves in offering a smart simple way to shop and sell mobile devices. With Boo, all it takes is just a few clicks to buy and sell the devices of your choice. In just several a few simple steps you can either trade in or trade up your mobile tech for unbeatable prices, while doing your bit for the environment.   
Watch our quick video that explains how our meticulous grading system works. We guarantee you’ll be pleasantly surprised at just how thorough and exhaustive our grading system is. 
</p>
            </div>
            <div class="p-5 d-flex flex-wrap flex-column justify-content-between align-items-center mx-auto">
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
                    <p style="color: #23AAF7;" class="active m-0" id="toggle-element-btn-shopping">Shopping with us</p>
                    <img id="shopping-image" class="ml-3" src="{{ asset('/customer_page_images/body/Group 1087.svg') }}">
                </a>
            </div>
            <div class="toggle-element-btn selling-toggle">
                <a onclick="changeToggleElement('selling')">
                    <p style="color: #FCC44C;" class="m-0" id="toggle-element-btn-selling">Selling with us</p>
                    <img id="selling-image" class="ml-3" src="{{ asset('/customer_page_images/body/Group 938.svg') }}">
                </a>
            </div>
        </div>
        <div class="toggle-element shopping-toggle active">

            <div class="shopping-element container">
                <div class="shopping-element-image">
                    <img src="{{ asset('/customer_page_images/body/How-Icon-1.svg') }}">
                </div>
                <div class="shopping-element-text">
                    <p class="left-title-text">1. Search for a new device</p>
                    <p>Take your time and have fun selecting a device that ticks all the boxes, that’s for the right price, and is the quality you’re looking for.</p>
                </div>
            </div>
            <div class="shopping-element container">
                <div class="shopping-element-image">
                    <img src="{{ asset('/customer_page_images/body/How-Icon-2.svg') }}">
                </div>
                <div class="shopping-element-text">
                    <p class="left-title-text">2. Free Next Day Delivery</p>
                    <p>Rather than twiddling your thumbs and struggling on with your old device, have your shiny new phone in your hands with our free, next day delivery straight to your door.</p>
                </div>
            </div>
            <div class="shopping-element container">
                <div class="shopping-element-image">
                    <img src="{{ asset('/customer_page_images/body/How-Icon-3.svg') }}">
                </div>
                <div class="shopping-element-text">
                    <p class="left-title-text">3. You have a shiny new phone to play with</p>
                    <p>With your sparkly new phone in your lap the same day, you can set about getting to know your device. As all our gadgets come with a 12-month warranty, you’ll have peace of mind that in the unlikely event that your device develops a fault, it is guaranteed for the next 12 months.</p>
                </div>
            </div>

            <div class="url-footer-container mb-5" id="start-shopping">
                <a href="#">Start Shopping</a>
            </div>

        </div>
        <div class="toggle-element selling-toggle">

            <div class="shopping-element container">
                <div class="shopping-element-text">
                    <p class="left-title-text">1. Search for a new device</p>
                    <p>Search for your old device and find out how much it’s worth. If you’re happy with the price, simply register the mobile and provide us with your preferred payment option and with your details. </p>
                </div>
                <div class="shopping-element-image">
                    <img src="{{ asset('/customer_page_images/body/How-Icon-4.svg') }}">
                </div>
            </div>

            <div class="shopping-element container">
                <div class="shopping-element-text">
                    <p class="left-title-text">2. Free Next Day Delivery</p>
                    <p>Once your sales order is completed, simply request for a free sales pack. Alternatively, you can print your own labels to send us your device</p>
                </div>
                <div class="shopping-element-image">
                    <img src="{{ asset('/customer_page_images/body/How-Icon-5.svg') }}">
                </div>
            </div>

            <div class="shopping-element container">
                <div class="shopping-element-text">
                    <p class="left-title-text">3. You have a shiny new phone to play with</p>
                    <p>With Boo you won’t be left waiting for your payment. Once we receive your device, our team will check it against your order. If everything is correct, we’ll issue the payment that very same day! It’s that Simple!</p>
                </div>
                <div class="shopping-element-image">
                    <img src="{{ asset('/customer_page_images/body/How-Icon-6.svg') }}">
                </div>
            </div>

            <div class="url-footer-container mb-5" id="start-selling">
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
                <p class="about-bamboo-text">Sustainability is at the heart of Bamboo Mobile and everything we do. Like our parent company, Bamboo Distribution, the protection of the environment is central to our ethics and business strategy. </p>
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
        $('#howvideomodal').modal('show');
    }

    function changeToggleElement(elementclicked){

        if(elementclicked == 'shopping'){
            var shoppingelements = document.getElementsByClassName('shopping-toggle');
            var sellingelements = document.getElementsByClassName('selling-toggle');

            var shoppingImage = document.getElementById('shopping-image');
            var sellingImage = document.getElementById('selling-image');

            for(var i=0; i<shoppingelements.length; i++){
                if(shoppingelements[i].classList.contains('active')){
                    //do nothing
                }
                else{
                    sellingelements[i].classList.remove('active');
                    shoppingelements[i].classList.add('active');
                    document.getElementById('toggle-element-btn-selling').classList.remove('active');
                    document.getElementById('toggle-element-btn-shopping').classList.add('active');

                    shoppingImage.classList.add('rotate');
                    shoppingImage.classList.remove('unrotate');
                    sellingImage.classList.remove('rotate');
                    sellingImage.classList.add('unrotate');


                }

            }
        }

        if(elementclicked == 'selling'){
            var shoppingelements = document.getElementsByClassName('shopping-toggle');
            var sellingelements = document.getElementsByClassName('selling-toggle');

            var shoppingImage = document.getElementById('shopping-image');
            var sellingImage = document.getElementById('selling-image');

            for(var i=0; i<shoppingelements.length; i++){
                if(sellingelements[i].classList.contains('active')){
                    //do nothing
                }
                else{
                    sellingelements[i].classList.add('active');
                    shoppingelements[i].classList.remove('active');
                    document.getElementById('toggle-element-btn-selling').classList.add('active');
                    document.getElementById('toggle-element-btn-shopping').classList.remove('active');

                    shoppingImage.classList.remove('rotate');
                    shoppingImage.classList.add('unrotate');
                    sellingImage.classList.add('rotate');
                    sellingImage.classList.remove('unrotate');
                }

            }
        }
    }

    </script>

</div>


<div class="modal fade" id="howvideomodal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">How To With Boo </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <video id="howvideoid" width="100%" controls>
                    <source src="{{ asset('/video/Bamboo How To With Boo v1.mp4') }}" type="video/mp4">
                    Your browser does not support HTML video.
                </video>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<script>
    $('#howvideomodal').on('hidden.bs.modal', function () {
        $('#howvideoid').trigger('pause'); 
    });
</script>