<div class="sustainability-container @if($whySell) gradient @endif @if($about) gradient @endif">
    @if($whySell)
        <div class="sustainability-whysell">
            <div class="sustainability-whysell-col text">
                <p class="sustainability-large ml-0 mt-auto">Why Sell with us</p>
                <p class="sustainability-small ml-0 mt-4">
                    Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent non est id leo viverra porttitor. Vivamus iaculis nisl non hend.
                </p>
                <a href="/sell/why" class="btn btn-light ml-0 mt-4 w-25 mb-auto">Read More</a>
            </div>
            <div class="sustainability-whysell-col">
                <div class="sustainability-whysell-videowrapper">
                    <video class="sustainability-whysell-video" controls>
                        <source src="{{asset('/video/old/selling_to_bamboo.mp4')}}" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    @endif

    @if($about)
        <div class="sustainability-about-row">
            <div class="sustainability-about-col text">
                <p class="sustainability-large ml-0 mt-auto">About bamboo</p>
                <p class="sustainability-small ml-0 mt-4">
                    Bamboo Mobile’s parent company is Bamboo Distribution which is a recognised international, independent phone distributor, and recycler which has been operating for over 10 years...
                </p>
                <a href="/about" class="btn btn-light ml-0 mt-4 w-25 mb-auto">Read More</a>
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
                Sustainability is at the heart of Bamboo Mobile and everything we do. Like our parent company, Bamboo Distribution, the protection of the environment is central to our ethics and business strategy.
            </p>
            <a href="/about" class="btn btn-light ml-0 mt-4 w-25">Read More</a>
        </div>
    </div>

</div>