@extends('customer.layouts.layout')

@section('content')

<div class="app">

    {{-- <div class="about-page about-title-container">
        <div class="center-title-container">
            <p class="large-page-title">About</p>
        </div>
    </div> --}}

    <div class="page-header-container about">
        <p class="page-header-text">About</p>
    </div>

    @if(Session::get('_previous') !== null)
        <a class="back-to-home-footer padded mt-3" href="{{Session::get('_previous')['url']}}">
    @else
        <a class="back-to-home-footer padded mt-3" href="/">
    @endif
        <p class="back-home-text"><img class="back-home-icon mr-2" alt="Back" src="{{asset('images/front-end-icons/black_arrow_left.svg')}}">Back</p>
    </a>

    <div class="about-intro-panel">

        <img class="about-intro-image" alt="Bamboo Laughing" src="{{asset('/images/bamboo-laughing.gif')}}">

        <div class="about-intro-column">
            <p class="about-intro-title">ABOUT BAMBOO</p>

            <p class="about-intro-subtitle">Hello and welcome to Bamboo Mobile - aka 'Boo'</p>

            <p class="about-intro-text">
                Hello and welcome to Bamboo Mobile – aka ‘Boo’. In a nutshell, Bamboo Mobile offers a smart way for you to Shop and sell mobile 
                phones and/or devices. With the help of Bamboo Mobile, you can trade in and trade up your mobile, quickly, safely, 
                and simply – not to mention for a great price! <br><br>
                So, who are we? We are the daughter company of Bamboo Distribution, a global leader in the recovery, 
                refurbishment, and recycling of consumer electronic devices. 
                We share our parent company’s commitment to do the right thing by the planet, as well as our customers. 
            </p>

            <div class="collapse" id="collapseReadmore">
                <br><br>
                <p class="about-rest-text">
                    Not only do we preserve the same devotion to the ‘3Rs’ of recycling – reducing, reusing and recycling – 
                    accessible to mobile-loving customers, but we are backed by Bamboo Distribution’s huge amount of experience 
                    in the recycling of consumer electronic devices – It’s a win-win for everyone. <br><br>
                    Our dedicated and friendly
                    management team handle all types of mobile devices. We then work our magic on the devices to prepare them 
                    for the market – offering top-quality recycled devices for incredible value for money. 
                    If you love Tech and love value, you’ll love collaborating with Bamboo Mobile! Reach out to 
                    our friendly team of mobile phone recycling experts to chat about how we can provide you 
                    with the best value for mobile phones and devices, while helping save the environment at the same time.
                </p>
            </div>

            <br><br>

            <div class="toggle-about-more" id="buttonAboutToggle" data-toggle="collapse" href="#collapseReadmore" role="button" aria-expanded="false" aria-controls="collapseReadmore">
                Read more
            </div>
        </div>
    </div>

    <div class="about-section-elements">

        <div class="about-section-column grey padded">

            <p class="about-section-main-text">SOMETHING ABOUT BAMBOO DISTRIBUTION</p>

            <div class="about-something-row">
                @if(App\Eloquent\Site\SiteImage::where('page', 'about')->first() !== null)
                    <img class="about-main-image" src="{{App\Eloquent\Site\SiteImage::where('page', 'about')->first()->getURL()}}">
                @else
                    <img class="about-main-image" src="{{asset('/images/about_main_image.png')}}">
                @endif

                <div class="about-section-column margin-left">
                    <p class="about-bamboo-text-title margin-something">
                        Bamboo Distribution is an international leader in the recovery, refurbishment and recycling of consumer electronic devices.
                    </p>

                    <p class="about-bamboo-text-desc">
                        With global operations offering recovery, processing, sales and distribution we provide our partners 
                        the very best value and quality of service end to end, always delivered with care and integrity.
                        <br><br>
                        Bamboo Distribution has been operating for over 10 years by a management team of industry professionals
                         with over 50 years combined experience in the mobile industry has seen the company become an 
                         established entity and trusted partner in the marketplace. 
                        <br><br>
                        Working with High Street Retailers, Authorised Distributors and Repairers, Insurance Companies, 
                        Independent Retails and Exporters, Bamboo assist their key partners and add value throughout 
                        the supply chain, delivering product solutions to individuals and companies.
                    </p>
                </div>
            </div>

           
        </div>

        <div class="about-section-row-sustainability padded margin-top">

            <div class="about-section-column sustainability">

                <p class="about-section-main-text">SUSTAINABILITY</p>

                <p class="about-bamboo-text-title margin-something">
                    Sustainability is at the heart of Bamboo Mobile and everything we do.
                </p>

                <p class="about-bamboo-text-desc">
                    Like our parent company, Bamboo Distribution, the protection of the environment is central 
                    to our ethics and business strategy. Put simply, the recycling of mobile devices helps save the environment, as it curbs mining processes. 
                    <br><br>
                    Through the recycling of devices, the minerals required to make mobile phone that are 
                    becoming increasingly sparse don’t need to be dug up. Vital minerals can be preserved 
                    to ensure no water or air pollution.
                    <br><br>
                    As well as reconditioning salvaged phones to an exceptionally high standard for resale, 
                    our sustainable business processes involve processing parts, accessories, and boxes. 
                    Consequently, Bamboo Mobile is truly committed to reducing the stress on the environment 
                    in every element of the buying and selling of mobile phones, phone accessories and the 
                    packaging they are supplied in.
                    <br><br>
                    Sell to us knowing you are encouraging sustainability and protecting the environment. 
                    Buy from us and you can enjoy a shiny new mobile, recycled to an exceptionally 
                    high standard that costs a snippet of the price of a new phone – not to mention 
                    saving Planet Earth in the process. Oh, we almost forgot… your stunning new device 
                    will come with a 12-month warranty – you can’t say fairer than that!
                </p>
            </div>

            <div class="about-section-images">
                <img class="image-1" alt="Sustainability 1" src="{{asset('images/ss-img-1.svg')}}">
                <img class="image-2" alt="Sustainability 2" src="{{asset('images/ss-img-2.svg')}}">
            </div>
        </div>

    </div>

    <div class="about-hr"></div>

    {{-- <div class="about-main-section">
        <p class="about-main-title">Bamboo Mobile is a recognised international, independent mobile phone distributor, and recycler which has been operating for over 10 years by a management team of industry professionals.</p>
        <div class="about-main-row">

            <p class="about-main-description">
                Adding value to products, Bamboo purchased all types of mobile handsets which then customises, 
                with a multitude of services ranging from refurbishing, language flashing, and reworking 
                to prepare for distribution. <br><br>
                A professional work ethic and dedicated management team 
                with over 50 years combined experience in the mobile industry, has seen the company 
                become an established entity and trusted partner in the marketplace. <br><br>
                Working with High Street Retailers, Authorised Distributors and Repairers, Insurance Companies, 
                Independent Retails and Exporters, Bamboo assist their key partners and add value 
                throughout the supply chain, delivering product solutions to individuals and companies.
            </p>
        </div>
    </div>

    <div class="about-section-elements">
        <div class="about-section-row grey">
            <div class="about-section-column">
                <p class="about-section-title">About Bamboo</p>
                <p class="about-section-description">
                    Hello and welcome to Bamboo Mobile – aka ‘Boo’. In a nutshell, Bamboo Mobile offers a smart way for you to Shop and sell mobile phones and/or devices. With the help of Bamboo Mobile, you can trade in and trade up your mobile, quickly, safely, and simply – not to mention for a great price!
                        So, who are we? We are the daughter company of Bamboo Distribution, a global leader in the recovery, refurbishment, and recycling of consumer electronic devices. We share our parent company’s commitment to do the right thing by the planet, as well as our customers. Not only do we preserve the same devotion to the ‘3Rs’ of recycling – reducing, reusing and recycling – accessible to mobile-loving customers, but we are backed by Bamboo Distribution’s huge amount of experience in the recycling of consumer electronic devices – It’s a win-win for everyone. 
                        Our dedicated and friendly management team handle all types of mobile devices. We then work our magic on the devices to prepare them for the market – offering top-quality recycled devices for incredible value for money. 
                        If you love Tech and love value, you’ll love collaborating with Bamboo Mobile! 
                        Reach out to our friendly team of mobile phone recycling experts to chat about how we can provide you with the best value for mobile phones and devices, while helping save the environment at the same time.
                </p>
            </div>
            <img class="about-section-image" alt="Bamboo Laughing" src="{{asset('/images/bamboo-laughing.gif')}}">
        </div>

        <div class="about-section-row">
            <div class="about-section-column">
                <p class="about-section-title">Sustainability</p>
                <p class="about-section-description">
                    Sustainability is at the heart of Bamboo Mobile and everything we do. Like our parent company, Bamboo Distribution, the protection of the environment is central to our ethics and business strategy. 
                    Put simply, the recycling of mobile devices helps save the environment, as it curbs mining processes. Through the recycling of devices, the minerals required to make mobile phone that are becoming increasingly sparse don’t need to be dug up. Vital minerals can be preserved to ensure no water or air pollution. 
                    As well as reconditioning salvaged phones to an exceptionally high standard for resale, our sustainable business processes involve processing parts, accessories, and boxes. Consequently, Bamboo Mobile is truly committed to reducing the stress on the environment in every element of the buying and selling of mobile phones, phone accessories and the packaging they are supplied in. 
                    Sell to us knowing you are encouraging sustainability and protecting the environment. Buy from us and you can enjoy a shiny new mobile, recycled to an exceptionally high standard that costs a snippet of the price of a new phone – not to mention saving Planet Earth in the process. 
                    Oh, we almost forgot… your stunning new device will come with a 12-month warranty – you can’t say fairer than that!
                </p>
            </div>
            <div class="about-section-images">
                <img class="image-1" alt="Sustainability 1" src="{{asset('images/ss-img-1.svg')}}">
                <img class="image-2" alt="Sustainability 2" src="{{asset('images/ss-img-2.svg')}}">
            </div>
        </div>

    </div> --}}


    <div class="sell-categories-container pt-5">

        <div class="single-sell-category about" id="mobile-category">
            <p class="sell-about-category-subtitle">Sell</p>
            <p class="sell-category-title">Mobile Phones</p>

            <div class="sell-category-wrapper" id="sell-mobile-phones">
                <div class="sell-category-device-background" id="rounded-mobile"></div>
                <img class="sell-category-device-image about mobile" alt="Mobile phone" src="{{asset('/images/devices/phones.png')}}">

                <img class="device-shadow mobile" alt="Shadow" src="{{asset('/images/device_shadow.svg')}}">
            </div>

        </div>

        <div class="single-sell-category about" id="tablets-category">
            <p class="sell-about-category-subtitle">Sell</p>
            <p class="sell-category-title">Tablets</p>

            <div class="sell-category-wrapper" id="sell-tablets">
                <div class="sell-category-device-background" id="rounded-tablets"></div>
                <img class="sell-category-device-image about tablet" alt="Tablet" src="{{asset('/images/devices/tablets.png')}}">

                <img class="device-shadow" alt="Shadow" src="{{asset('/images/device_shadow.svg')}}">
            </div>

        </div>

        <div class="single-sell-category about" id="watches-category">
            <p class="sell-about-category-subtitle">Sell</p>
            <p class="sell-category-title">Watches</p>

            <div class="sell-category-wrapper" id="sell-watches">
                <div class="sell-category-device-background" id="rounded-watches"></div>
                <img class="sell-category-device-image about watch" alt="Watch" src="{{asset('/images/devices/watches.png')}}">
                
                <img class="device-shadow" alt="Shadow" src="{{asset('/images/device_shadow.svg')}}">
            </div>

        </div>

    </div>

    @include('partial.newsletter')

    @include('customer.layouts.footer', ['showGetstarted' => false])

</div>
<script type="application/javascript">
    window.addEventListener('DOMContentLoaded', (event) => {
        $('#collapseReadmore').on('hidden.bs.collapse', function () {
            $('#buttonAboutToggle').html("Read more");
        });
        $('#collapseReadmore').on('shown.bs.collapse', function () {
            $('#buttonAboutToggle').html("Read less");
        });
    });

</script>
@endsection