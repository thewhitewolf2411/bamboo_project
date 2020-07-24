<div class="app">
    <div class="how-page support-title-container">
        <div class="center-title-container">
            <p>Support & Service</p>
        </div>
    </div>

    <div class="support-search-element">
        <div class="center-title-container">
            <p>How can we help?</p>
        </div>

        <div class="support-search-help">
            <p>USE THE SEARCH BAR BELOW OR SELECT FROM ONE OF THE OPTIONS BELOW</p>
        </div>

        <div class="search-bar">
            <form class="support-search-form" action="/searchsupport" method="POST">
                @csrf
                <input type="text" placeholder="Search...">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>

    </div>

    <div class="supprt-titles-container">
        <div class="row-height-140 support-top-row pc-15-50">
            <a href="">
                <div class="btn btn-primary btn-blue btn-font-white">
                    <p>Buying a device</p>
                </div>
            </a>
            <a href="">
                <div class="btn btn-primary btn-orange btn-font-white">
                    <p>Selling a device</p>
                </div>
            </a>
        </div>

        <div class="row-height-140 support-middle-row pc-15-50">
            <a href="">
                <div class="btn btn-primary btn-purple btn-font-white">
                    <p>Tech</p>
                </div>
            </a>
        </div>

        <div class="row-height-140 support-bottom-row pc-15-50">
            <a href="">
                <div class="btn btn-primary btn-green btn-font-white">
                    <p>Delivery</p>
                </div>
            </a>
            <a href="">
                <div class="btn btn-primary btn-green btn-font-white">
                    <p>Your Order</p>
                </div>
            </a>
            <a href="">
                <div class="btn btn-primary btn-green btn-font-white">
                    <p>Your Account</p>
                </div>
            </a>
            <a href="">
                <div class="btn btn-primary btn-green btn-font-white">
                    <p>General Questions</p>
                </div>
            </a>
        </div>

    </div>

    <div class="support-faq">
        <div class="faq-left">
            <div class="faq-title">
                <p>MOST FREQUENTLY ASKED QUESTIONS</p>
            </div>

            <div class="faq-question">
                <a href="">
                    <div class="faq-question-text">
                        <p>When will I receive my item?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Purple.svg')}}">
                    </div>
                </a>
            </div>
            <div class="faq-question">
                <a href="">
                    <div class="faq-question-text">
                        <p>Are all of your devices covered by a warranty?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Purple.svg')}}">
                    </div>
                </a>
            </div>
            <div class="faq-question">
                <a href="">
                    <div class="faq-question-text">
                        <p>How should I return a device?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Purple.svg')}}">
                    </div>
                </a>
            </div>
            <div class="faq-question">
                <a href="">
                    <div class="faq-question-text">
                        <p>What does "Grade A" mean?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Purple.svg')}}">
                    </div>
                </a>
            </div>
            <div class="faq-question">
                <a href="">
                    <div class="faq-question-text">
                        <p>What do you do with my phone?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Purple.svg')}}">
                    </div>
                </a>
            </div> 
        </div>
        <div class="faq-right">
            <div class="faq-title">
                <p>POPULAR HOW TO...ARTICLES</p>
            </div>
            <div class="faq-question">
                <a href="">
                    <div class="faq-question-text">
                        <p>How do I find the model of my phone?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Green.svg')}}">
                    </div>
                </a>
            </div>
            <div class="faq-question">
                <a href="">
                    <div class="faq-question-text">
                        <p>How do I find the make of my phone?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Green.svg')}}">
                    </div>
                </a>
            </div>
            <div class="faq-question">
                <a href="">
                    <div class="faq-question-text">
                        <p>How should I return a device?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Green.svg')}}">
                    </div>
                </a>
            </div>
            <div class="faq-question">
                <a href="">
                    <div class="faq-question-text">
                        <p>What does "Grade A" mean?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Green.svg')}}">
                    </div>
                </a>
            </div>
            <div class="faq-question">
                <a href="">
                    <div class="faq-question-text">
                        <p>What do you do with my phone?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Green.svg')}}">
                    </div>
                </a>
            </div>
        </div>
    </div>


</div>