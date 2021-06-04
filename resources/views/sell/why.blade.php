@extends('customer.layouts.layout')

@section('content')

    <main class="selling-margin">
        @include('customer.layouts.sellinglinks')

        <div class="page-header-container whysell">
            <p class="page-header-text">Why Sell With Us</p>
        </div>

        <div class="whysell-page-container">

            <div class="d-flex flex-row justify-content-around border-down">

                <div class="whysell-main-text d-flex flex-column">
                    <p class="whysell-page-title">The benefits of Selling <br> with Bamboo Mobile</p>
                    <p class="whysell-page-description">Not only at Bamboo Mobile do we offer best prices for your devices, free postage, same day payment and data wipe guarantee, together we can help cut down tech waste and be part of the circular economy. Start now, find out how much your device is worth today.</p>
                </div>
                <div class="d-flex flex-column justify-content-between">

                    <div class="main-whysell-video-container text-center ml-auto mr-auto">
                        <div class="mainWhySellVideoToggle" data-toggle="modal" data-target="#mainWhySellVideoModal">
                            <p class="whysell-video-text mb-5">Selling With Us</p>
                            <img src="{{asset('/video/play_video.svg')}}">
                            <p class="whysell-video-text mt-5">Explained</p>
                        </div>
                    </div>

                    <div class="modal fade noscroll" id="mainWhySellVideoModal" tabindex="-1" role="dialog" aria-labelledby="mainWhySellVideoLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            {{-- <h5 class="modal-title howitworks text-center" id="mainWhySellVideoLabel">Selling With Us</h5> --}}
                            <div class="modal-content howitworksvideo">
                                {{-- <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div> --}}
                                <div class="modal-body">
                                <video id="whyvideoid" width="100%" controls>
                                    <source src="{{ asset('/video/Bamboo_Selling_Web_140521.mp4') }}" type="video/mp4">
                                    Your browser does not support HTML video.
                                </video>
                                </div>
                                <img class="dismiss-howitworks" src="{{asset('images/front-end-icons/close_modal_orange.svg')}}" data-dismiss="modal">
                                {{-- <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <p class="whysell-page-description bottom">Watch our quick video explaining the benefits you'll receive when selling your next device with Bamboo Mobile</p>
                </div>
            </div>

            <div class="selling-with-container">
                <p class="selling-with-section-title">Selling with us</p>

                <div class="selling-with-elements">
                    <div class="selling-with-element selling-with-left">
                        <div class="selling-img-container">
                            <img src="{{asset('/sell_images/why_images/image-1.svg')}}">
                        </div>
                        <div class="selling-text-column">
                            <p class="selling-section-title-orange">Same day payment</p>
                            <p class="selling-section-text-description">As soon as we receive your device, we'll carry out all the testing required and issue payment directly into your bank account the same day we receive it*. The sooner you send in your device, the sooner you'll get paid!
                                *Subject to our testing terms and conditions.</p>
                        </div>
                    </div>
                    <div class="selling-with-element selling-with-right">
                        <div class="selling-text-column">
                            <p class="selling-section-title-orange">Free Postage</p>
                            <p class="selling-section-text-description">We offer a Freepost service with Royal Mail which allows you to post up to 2 devices free of charge. It covers up to £100.00 and you will be able to track your delivery via <a class="bold" style="font-size: inherit;color: orange;" href="https://www.royalmail.com" target="_blank">www.royalmail.com</a>. If you have more than 2 devices to sell, feel free to place several orders of 2 devices per order.</p>
                        </div>
                        <div class="selling-img-container">
                            <img src="{{asset('/sell_images/why_images/image-2.svg')}}">
                        </div>
                    </div>
                    <div class="selling-with-element selling-with-left">
                        <div class="selling-img-container">
                            <img src="{{asset('/sell_images/why_images/image-3.svg')}}">
                        </div>
                        <div class="selling-text-column">
                            <p class="selling-section-title-orange">GDPR compliant</p>
                            <p class="selling-section-text-description">Bamboo understands how important it is to protect personal data from getting into the wrong hands. We are fully GDPR (General Data Protection Regulation) compliant. We ensure that the way in which we store, process, remove and destroy any data is fully compliant against the regulation put in place across UK. Your data is in safe hands.</p>
                        </div>
                    </div>
                    <div class="selling-with-element selling-with-right">
                        <div class="selling-text-column">
                            <p class="selling-section-title-orange">Data is always protected</p>
                            {{-- <p class="selling-section-text-description">As our lives has become more dependent on our mobile devices, more personal data, pictures, and bank details are stored on our devices. At bamboo mobile we will ensure that every device processed will have all data removed or destroyed</p> --}}
                            <p class="selling-section-text-description">As our lives have become more dependent on our mobile devices, with more personal data, pictures, and bank details being stored, here at Bamboo Mobile we will make sure that every device processed will have all data destroyed.</p>
                        </div>
                        <div class="selling-img-container">
                            <img src="{{asset('/sell_images/why_images/image-4.svg')}}">
                        </div>
                    </div>
                    <div class="selling-with-element selling-with-left">
                        <div class="selling-img-container">
                            <img src="{{asset('/sell_images/why_images/image-5.svg')}}">
                        </div>
                        <div class="selling-text-column">
                            <p class="selling-section-title-orange">We help to Reduce, Reuse, Recycle!</p>
                            <p class="selling-section-text-description">We are committed to helping the environment and together we can help minimise tech waste with 3R's - Reduce, Reuse, Recycle! Be part of the circular economy revolution.</p>
                        </div>
                    </div>
                    <div class="selling-with-element selling-with-right">
                        <div class="selling-text-column">
                            <p class="selling-section-title-orange">Bamboo Price or your device back for free</p>
                            <p class="selling-section-text-description">We at bamboo mobile understand that used devices will come in all kinds of conditions - so we have a simple guide that will help describe the condition of your device so we can offer you the best possible price. We are so confident of our grading that if you are unhappy with the price offered, we will send your device back to you for FREE - what have you got to lose!</p>
                        </div>
                        <div class="selling-img-container">
                            <img src="{{asset('/sell_images/why_images/image-6.svg')}}">
                        </div>
                    </div>
                </div>

                {{-- <div class="selling-btn-container">
                    <a href="/sell" class="btn btn-orange btn-primary">
                        Start Selling
                    </a>
                </div> --}}
                <a href="/sell" class="btn start-selling howitworks mt-5 mb-5"><p>Start Selling</p></a>
            </div>
        
        </div>

        @include('partial.sustainability', ['whySell' => false, 'about' => false])

        <div class="sell-categories-container pt-5">

            <div class="single-sell-category" id="mobile-category">
                <p class="sell-about-category-subtitle">Sell</p>
                <p class="sell-category-title">Mobile Phones</p>
    
                <div class="sell-category-wrapper" id="sell-mobile-phones">
                    <div class="sell-category-device-background" id="rounded-mobile"></div>
                    <img class="sell-category-device-image mobile" src="{{asset('/images/devices/phones.png')}}">
    
                    <img class="device-shadow mobile" src="{{asset('/images/device_shadow.svg')}}">
                </div>
    
            </div>
    
            <div class="single-sell-category" id="tablets-category">
                <p class="sell-about-category-subtitle">Sell</p>
                <p class="sell-category-title">Tablets</p>
    
                <div class="sell-category-wrapper" id="sell-tablets">
                    <div class="sell-category-device-background" id="rounded-tablets"></div>
                    <img class="sell-category-device-image tablet" src="{{asset('/images/devices/tablets.png')}}">
    
                    <img class="device-shadow" src="{{asset('/images/device_shadow.svg')}}">
                </div>
    
            </div>
    
            <div class="single-sell-category" id="watches-category">
                <p class="sell-about-category-subtitle">Sell</p>
                <p class="sell-category-title">Watches</p>
    
                <div class="sell-category-wrapper" id="sell-watches">
                    <div class="sell-category-device-background" id="rounded-watches"></div>
                    <img class="sell-category-device-image watch" src="{{asset('/images/devices/watches.png')}}">
                    
                    <img class="device-shadow" src="{{asset('/images/device_shadow.svg')}}">
                </div>
    
            </div>
    
        </div>

        @include('partial.newsletter')

        @include('customer.layouts.footer', ['showGetstarted' => true])

    </main>

    <script src="{{asset('/js/SellingPage.js')}}"></script>

@endsection