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
                    Bamboo Mobile is a recognised international, independent mobile phone distributor, and recycler which has been operating for over 10 years by a management team of industry professionals.<br>
                    Adding value to products, Bamboo purchased all types of mobile handsets which then customises, with a multitude of services ranging from refurbishing, language flashing, and reworking to prepare for distribution.<br>
                    A professional work ethic and dedicated management team with over 50 years combined experience in the mobile industry, has seen the company become an established entity and trusted partner in the marketplace.<br>
                    Working with High Street Retailers, Authorised Distributors and Repairers, Insurance Companies, Independent Retails and Exporters, Bamboo assist their key partners and add value throughout the supply chain, delivering product solutions to individuals and companies.
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
                Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent non est id leo viverra porttitor. Vivamus iaculis nisl non hend.
            </p>
            <a href="#" class="btn btn-light ml-0 mt-4 w-25">Read More</a>
        </div>
    </div>

</div>