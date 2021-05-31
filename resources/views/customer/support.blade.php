@extends('customer.layouts.layout')

@section('content')

<div class="app">
    {{-- <div class="how-page support-title-container">
        <div class="center-title-container">
            <p class="large-page-title">Service & Support</p>
        </div>
    </div> --}}
    <div class="page-header-container servicesupport">
        <p class="page-header-text">Service & Support</p>
    </div>

    @if(Session::get('_previous') !== null)
    <a class="back-to-home-footer mt-3" href="{{Session::get('_previous')['url']}}">
    @else
    <a class="back-to-home-footer mt-3" href="/">
    @endif
        <p class="back-home-text support"><img class="back-home-icon mr-2" src="{{asset('images/front-end-icons/black_arrow_left.svg')}}">Back</p>
    </a>

    @include('partial.supportsearch')

    <div class="support-titles-container">
        <div class="support-row">
            {{-- <a href="">
                <div class="btn btn-primary btn-blue btn-font-white">
                    <p>Buying a device</p>
                </div>
            </a> --}}
            <a href="/support/selling" class="support-btn orange ml-auto mr-auto mt-2 mb-2 w-100">
                <p class="support-btn-text">Selling a device</p>
            </a>
        </div>

        <div class="support-row">
            <a class="support-btn purple ml-auto mr-auto mt-2 mb-2 w-100">
                <p class="support-btn-text">Tech</p>
            </a>
        </div>

        <div class="support-row justify-content-center">
            <a class="support-btn green mt-2 mb-2 mr-2">
                <p class="support-btn-text">Delivery</p>
            </a>
            <a class="support-btn green mt-2 mb-2 mr-2">
                <p class="support-btn-text">Your Order</p>
            </a>
            <a class="support-btn green mt-2 mb-2 mr-2">
                <p class="support-btn-text">Your Account</p>
            </a>
            <a class="support-btn green mt-2 mb-2">
                <p class="support-btn-text">General Questions</p>
            </a>
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

    @include('customer.layouts.footer', ['showGetstarted' => false])

</div>

@endsection