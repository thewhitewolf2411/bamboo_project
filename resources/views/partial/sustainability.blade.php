<div class="sustainability-container @if($whySell) gradient @endif @if($about) gradient @endif">
    @if($whySell)
        <div class="sustainability-whysell">
            <div class="sustainability-whysell-col text">
                <p class="sustainability-large ml-0 mt-auto">Why Sell with us</p>
                <p class="sustainability-small ml-0 mt-4">
                    Selling with us is quick, easy and simple with same day payment straight into your bank account. We even pay for the postage. So why wait, find out how much your device is worth today.
                </p>
                <a href="/about" class="btn btn-light ml-0 mt-4 w-25 mb-auto">Read More</a>
            </div>
            <div class="sustainability-whysell-col whysellwithus">
                <div class="whysell-video-container text-center">
                    <div class="whySellVideoToggle" data-toggle="modal" data-target="#whySellVideoModal">
                        <p class="mb-4">Selling with us</p>
                        <img src="{{asset('/video/play_video.svg')}}">
                        <p class="mt-4">Explained</p>
                    </div>
                </div>

                <div class="modal fade noscroll" id="whySellVideoModal" tabindex="-1" role="dialog" aria-labelledby="whySellVideoLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <h5 class="modal-title howitworks text-center" id="whySellVideoLabel">Selling with us</h5>
                        <div class="modal-content howitworksvideo">
                            {{-- <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div> --}}
                            <div class="modal-body">
                            <video id="whyvideoid" width="100%" controls>
                                <source src="{{ asset('/video/old/Bamboo Selling v4.mp4') }}" type="video/mp4">
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
                {{-- <div class="sustainability-whysell-videowrapper">
                    <video class="sustainability-whysell-video" controls>
                        <source src="{{asset('/video/old/selling_to_bamboo.mp4')}}" type="video/mp4">
                    </video>
                </div> --}}
            </div>
        </div>

        <div class="start-selling-whysell mt-5">
            <a href="/sell" class="btn btn-orange">Start Selling</a>
        </div>
    @endif

    @if($about)
        <div class="sustainability-about-row">
            <div class="sustainability-about-col text">
                <p class="sustainability-large ml-0 mt-auto">About bamboo</p>
                <p class="sustainability-small ml-0 mt-4">
                    Bamboo Mobile’s parent company is Bamboo Distribution which is a recognised international, independent phone distributor, and recycler which has been operating for over 10 years...
                </p>
                <a href="/about" class="btn btn-light ml-0 mt-4 w-25 mb-auto black-border-hover">Read More</a>
            </div>
            <div class="sustainability-about-col">
                <img class="laughing-gif" src="{{asset('/images/bamboo-laughing.gif')}}">
            </div>
        </div>

    @endif

    <div class="sustainability-row">
        <div class="sustainability-images-overlay">
            <img class="sustainability-img one" src="{{asset('images/ss-img-1.svg')}}">
            <img class="sustainability-img two" src="{{asset('images/ss-img-2.svg')}}">
        </div>
        <div class="text-buttons-sustainability">
            <p class="sustainability-large ml-0">Sustainability</p>
            <p class="sustainability-small ml-0 mt-4">
                Sustainability is at the heart of Bamboo Mobile and everything we do. Like our parent company, Bamboo Distribution, the protection of the environment is central to our ethics and business strategy
            </p>
            <a href="/about" class="btn btn-light ml-0 mt-4 w-25 black-border-hover">Read More</a>
        </div>
    </div>

</div>