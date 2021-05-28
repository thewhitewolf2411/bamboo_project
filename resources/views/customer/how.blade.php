@extends('customer.layouts.layout')

@section('content')

<div class="app">
    <div class="page-header-container howitworks">
        <p class="page-header-text">How it works</p>
    </div>

    @if(Session::get('_previous') !== null)
        <a class="back-to-home-footer mt-3" href="{{Session::get('_previous')['url']}}">
    @else
        <a class="back-to-home-footer mt-3" href="/">
    @endif
        <p class="back-home-text"><img class="back-home-icon mr-2" src="{{asset('images/front-end-icons/black_arrow_left.svg')}}">Back</p>
    </a>

    <div class="howitworks-container how-row justify-content-center howitworks-top-element">

        <div class="howitworks-container how-column howitworks-col-text">
            <p class="howitworks-title">Sell easily <br> with just a few clicks</p>
            <p class="howitworks-description">
                We pride ourselves in offering a smart simple way to shop and sell mobile devices. With Boo, all it takes is just a few clicks to buy and sell the devices of your choice. 
                In just a few simple steps you can either trade in or trade up your mobile tech for unbeatable prices, while doing your bit for the environment.   
                Watch our quick video that explains how our meticulous grading system works. We guarantee you’ll be pleasantly surprised at just how thorough and exhaustive our grading system is. 
            </p>
        </div>

        <div class="howitworks-video-container" data-toggle="modal" data-target="#howVideoModal">
            <img src="{{asset('/video/play_video.svg')}}">
        </div>

        <div class="modal fade" id="howVideoModal" tabindex="-1" role="dialog" aria-labelledby="howVideoLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <h5 class="modal-title howitworks text-center" id="howVideoLabel">How it works</h5>
                <div class="modal-content howitworksvideo">
                    <div class="modal-body">
                    <video id="howvideoid" width="100%" controls autoplay muted>
                        <source src="{{ asset('/video/Bamboo_Selling_Web_140521.mp4') }}" type="video/mp4">
                        Your browser does not support HTML video.
                    </video>
                    </div>
                    <img class="dismiss-howitworks" src="{{asset('images/front-end-icons/close_modal_orange.svg')}}" data-dismiss="modal">
              </div>
            </div>
        </div>

    </div>

    <div class="howitworks-toggle-sections">
        <div class="howitworks-toggle-element selling w-100 justify-content-center">
            <p>Selling with us</p>
            <img class="mt-2 ml-4 rotate-90-deg" src="{{ asset('/customer_page_images/body/Group 938.svg') }}">
        </div>
    </div>
    <div class="howitworks-selling-sections">
        <div class="howitworks-container how-row justify-content-center selling-section-item">
            <div class="howitworks-container how-column text-description">
                <p class="howitworks-selling-title">1. Search for a new device</p>
                <p class="howitworks-selling-desc">
                    Search your old device and find out how much its worth. If you are happy with the price , simply register the device, provide us with your details and we’ll get the ball rolling.
                </p>
            </div>
            <img class="howitworks-selling-image" src="{{ asset('/customer_page_images/body/hearts.svg') }}">
        </div>

        <div class="howitworks-container how-row justify-content-center selling-section-item">
            <div class="howitworks-container how-column text-description">
                <p class="howitworks-selling-title">2. Free Next Day Delivery</p>
                <p class="howitworks-selling-desc">
                    Once your sales order is completed, simply request for a free sales pack. Alternatively, you can print your own labels to send us your device.
                </p>
            </div>
            <img class="howitworks-selling-image post-pack" src="{{ asset('/customer_page_images/body/final_free_trade_pack.svg') }}">
        </div>

        <div class="howitworks-container how-row justify-content-center selling-section-item">
            <div class="howitworks-container how-column text-description">
                <p class="howitworks-selling-title">3. You have a shiny new phone to play with</p>
                <p class="howitworks-selling-desc">
                   With Boo you won’t be left waiting for your payment. Once we receive your device, our team will check it against your order. If everything is correct, we’ll issue the payment that very same day! It’s that Simple!
                </p>
            </div>
            <img class="howitworks-selling-image" src="{{ asset('/customer_page_images/body/get_paid.svg') }}">
        </div>

        <div class="howitworks-container how-row justify-content-center selling-section-item">
            <a href="/sell" class="btn start-selling howitworks"><p>Start Selling</p></a>
        </div>

    </div>

    <!--<div class="toggle-elements">
        <div class="toggle-elements-btn">
            {{-- <div class="toggle-element-btn shopping-toggle active">
                <a onclick="changeToggleElement('shopping')">
                    <p style="color: #23AAF7;" class="active m-0" id="toggle-element-btn-shopping">Shopping with us</p>
                    <img id="shopping-image" class="ml-3" src="{{ asset('/customer_page_images/body/Group 1087.svg') }}">
                </a>
            </div> --}}

            {{-- <div class="toggle-element-btn selling-toggle" style="width: 100% !important">
                <a onclick="changeToggleElement('selling')" class="active" style="cursor: default;">
                    <p style="color: #F28E33" class="m-0" id="toggle-element-btn-selling">Selling with us</p>
                    <img id="selling-image" class="ml-3 rotate" src="{{ asset('/customer_page_images/body/Group 938.svg') }}">
                </a>
            </div> --}}
        </div>
        {{-- <div class="toggle-element shopping-toggle active">

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

        </div> --}}
        <div class="toggle-element selling-toggle active">

            <div class="shopping-element container">
                <div class="shopping-element-text">
                    <p class="left-title-text">1. Search for a new device</p>
                    <p class="how-text-desc sharp-sans-medium">
                        {{-- Search for your old device and find out how much it’s worth. If you’re happy with the price, simply register the mobile and provide us with your preferred payment option and with your details.  --}}
                        Search your old device and find out how much its worth. If you are happy with the price , simply register the device, provide us with your details and we’ll get the ball rolling.
                    </p>
                </div>
                <div class="shopping-element-image">
                    <img class="how-image" src="{{ asset('/customer_page_images/body/hearts.svg') }}">
                </div>
            </div>

            <div class="shopping-element container">
                <div class="shopping-element-text">
                    <p class="left-title-text">2. Free Next Day Delivery</p>
                    <p class="how-text-desc sharp-sans-medium">Once your sales order is completed, simply request for a free sales pack. Alternatively, you can print your own labels to send us your device.</p>
                </div>
                <div class="shopping-element-image">
                    {{-- <img class="how-image" src="{{ asset('/customer_page_images/body/free_post_pack.svg') }}"> --}}
                    <img class="how-image" src="{{ asset('/customer_page_images/body/revised_trade_pack.png') }}">
                </div>
            </div>

            <div class="shopping-element container">
                <div class="shopping-element-text">
                    <p class="left-title-text">3. You have a shiny new phone to play with</p>
                    <p class="how-text-desc sharp-sans-medium">With Boo you won’t be left waiting for your payment. Once we receive your device, our team will check it against your order. If everything is correct, we’ll issue the payment that very same day! It’s that Simple!</p>
                </div>
                <div class="shopping-element-image">
                    <img class="how-image" src="{{ asset('/customer_page_images/body/get_paid.svg') }}">
                </div>
            </div>

            <div class="url-footer-container mb-5 btn black-border-hover" id="start-selling">
                <a href="/sell">Start Selling</a>
            </div>

        </div>
    </div>-->

    

    @include('partial.sustainability', ['whySell' => false, 'about' => false])

    @include('partial.newscontactsupport')

    @include('partial.newsletter')

    @include('customer.layouts.footer', ['showGetstarted' => false, 'sellingurl'=>true])

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

@endsection