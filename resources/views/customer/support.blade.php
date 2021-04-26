@extends('customer.layouts.layout')

@section('content')

<div class="app">
    <div class="how-page support-title-container">
        <div class="center-title-container">
            <p class="large-page-title">Support & Service</p>
        </div>
    </div>

    @if(Session::get('_previous') !== null)
    <a class="back-to-home-footer mt-3" href="{{Session::get('_previous')['url']}}">
    @else
    <a class="back-to-home-footer mt-3" href="/">
    @endif
        <p class="back-home-text support"><img class="back-home-icon mr-2" src="{{asset('images/front-end-icons/black_arrow_left.svg')}}">Back to previous page</p>
    </a>

    <div class="support-search-element">
        <div class="text-center">
            <p class="support-subtitle">How can we help?</p>
        </div>

        <div class="text-center">
            <p class="support-subtitle-info bebas-neue">USE THE SEARCH BAR BELOW OR SELECT FROM ONE OF THE OPTIONS BELOW</p>
        </div>

        {{-- <div class="search-bar">
            <form class="support-search-form" action="/searchsupport" method="POST">
                @csrf
                <input class="support-search" type="text" placeholder="Search...">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div> --}}
        <form class="support-search-form" action="/searchsupport" method="POST">
            <div class="search-wrapper-support">
                <input class="support-search" type="text" placeholder="Ask a question...">
                <div class="support-search-btn">
                    <img src="{{asset('images/front-end-icons/search_icon.svg')}}">
                </div>
            </div>
        </form>

    </div>

    <div class="supprt-titles-container">
        <div class="row-height-140 support-top-row pc-15-50">
            {{-- <a href="">
                <div class="btn btn-primary btn-blue btn-font-white">
                    <p>Buying a device</p>
                </div>
            </a> --}}
            <a href="/support/selling">
                <div class="support-btn orange">
                    <p class="support-btn-text">Selling a device</p>
                </div>
            </a>
        </div>

        <div class="row-height-140 support-middle-row pc-15-50">
            <a href="">
                <div class="support-btn purple">
                    <p class="support-btn-text">Tech</p>
                </div>
            </a>
        </div>

        <div class="row-height-140 support-bottom-row pc-15-50">
            <a href="">
                <div class="support-btn green">
                    <p class="support-btn-text">Delivery</p>
                </div>
            </a>
            <a href="">
                <div class="support-btn green">
                    <p class="support-btn-text">Your Order</p>
                </div>
            </a>
            <a href="">
                <div class="support-btn green">
                    <p class="support-btn-text">Your Account</p>
                </div>
            </a>
            <a href="">
                <div class="support-btn green">
                    <p class="support-btn-text">General Questions</p>
                </div>
            </a>
        </div>

    </div>

    <div class="support-faq">
        <div class="faq-left">
            <div class="faq-title">
                <p class="bebas-neue">MOST FREQUENTLY ASKED QUESTIONS</p>
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
                <p class="bebas-neue">POPULAR HOW TO...ARTICLES</p>
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

@endsection