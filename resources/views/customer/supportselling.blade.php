@extends('customer.layouts.layout')

@section('content')

<div class="app container">

    <div class="support-search-element">
        <div class="center-title-container font-orange bold">
            <p>Selling a device</p>
        </div>
    </div>

    <div class="support-faq">
        <div class="faq-left">

            <div class="faq-question">
                <a onclick="showAnswer(1)">
                    <div class="faq-question-text">
                        <p>How do I SELL to Bamboo Mobile?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Add@2x.png')}}">
                    </div>
                </a>
            </div>
            <div class="faq-question">
                <a onclick="showAnswer(2)">
                    <div class="faq-question-text">
                        <p>What devices can I sell to Bamboo Mobile?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Add@2x.png')}}">
                    </div>
                </a>
            </div>
            <div class="faq-question">
                <a onclick="showAnswer(3)">
                    <div class="faq-question-text">
                        <p>How do I find out what my tech/device is worth?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Add@2x.png')}}">
                    </div>
                </a>
            </div>
            <div class="faq-question">
                <a onclick="showAnswer(4)">
                    <div class="faq-question-text">
                        <p>When do I get paid?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Add@2x.png')}}">
                    </div>
                </a>
            </div>
            <div class="faq-question">
                <a onclick="showAnswer(5)">
                    <div class="faq-question-text">
                        <p>How long do I have to send in my device?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Add@2x.png')}}">
                    </div>
                </a>
            </div> 
        </div>
        <div class="faq-right">
            <div class="faq-question">
                <a onclick="showAnswer(6)">
                    <div class="faq-question-text">
                        <p>Is my personal data safe?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Add@2x.png')}}">
                    </div>
                </a>
            </div>
            <div class="faq-question">
                <a onclick="showAnswer(7)">
                    <div class="faq-question-text">
                        <p>What do I need to include with my device?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Add@2x.png')}}">
                    </div>
                </a>
            </div>
            <div class="faq-question">
                <a onclick="showAnswer(8)">
                    <div class="faq-question-text">
                        <p>How How about if my mobile device is locked to a UK network?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Add@2x.png')}}">
                    </div>
                </a>
            </div>
            <div class="faq-question">
                <a onclick="showAnswer(9)">
                    <div class="faq-question-text">
                        <p>What do I do wih iCloud or Google locked?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Add@2x.png')}}">
                    </div>
                </a>
            </div>
            <div class="faq-question">
                <a onclick="showAnswer(10)">
                    <div class="faq-question-text">
                        <p>Any other questions?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Add@2x.png')}}">
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="support-faq-answers">
        <div class="border-top answer" id="question-1">
            <div class="support-title font-orange bold">
                <p>How do I SELL to Bamboo Mobile?</p>
            </div>
            <div class="p-5">
                <p>
                    It couldn’t be simpler! Find your mobile device, receive a quote, send to Bamboo mobile for free and wait for your cash! On the small occasion when your device received is not in the stated condition, we will send you a new quote. If you are not happy with the quote we can send the device back to you free of charge.
                </p>
            </div>
        </div>
        
        <div class="border-top answer" id="question-2">
            <div class="support-title font-orange bold">
                <p>What devices can I sell to Bamboo Mobile?</p>
            </div>
            <div class="p-5">
                <p>
                    You can sell any mobile device from Apple to ZTE, both mobile phones and tablets. If your mobile device has no value, we are happy to help recycle the tech for free.
                </p>
            </div>
        </div>

        <div class="border-top answer" id="question-3">
            <div class="support-title font-orange bold">
                <p>How do I find out what my tech/device is worth?</p>
            </div>
            <div class="p-5">
                <p>
                    We ask a few questions about the condition of your device. Then with our pricing algorithm a quote for your device is generated.  Price offered is based on the accurate description of condition and functionality which we’ll confirm once we’ve received, tested and inspected your device. If the quote is lower after inspection, you still have the choice not to sell to us, and we will send it back to you free of charge. <a href="/sell">Start Here</a>
                </p>
            </div>
        </div>

        <div class="border-top answer" id="question-4">
            <div class="support-title font-orange bold">
                <p>When do I get paid?</p>
            </div>
            <div class="p-5">
                <p>
                    Oh yes, the best part!  Once we have received your device and it has passed all the tests / inspections, we promise we pay you on the same day!! 
                </p>
            </div>
        </div>

        <div class="border-top answer" id="question-5">
            <div class="support-title font-orange bold">
                <p>How long do I have to send in my device?</p>
            </div>
            <div class="p-5">
                <p>
                    The estimated trade-in value is valid for 14 days, and we encourage you to send the device to us within this timeframe to ensure getting this value. If you require additional time, please contact our support team at <a href="mailto:info@bamboomobile.co.uk"> info@bamboomobile.co.uk</a>
                </p>
            </div>
        </div>

        <div class="border-top answer" id="question-6">
            <div class="support-title font-orange bold">
                <p>Is my personal data safe?</p>
            </div>
            <div class="p-5">
                <p>
                    Absolutely! We will delete data on all devices using accredited software - PhoneCheck
                </p>
            </div>
        </div>

        <div class="border-top answer" id="question-7">
            <div class="support-title font-orange bold">
                <p>What do I need to include with my device?</p>
            </div>
            <div class="p-5">
                <p>
                    To keep things easy and simple, we only need your mobile device – no accessories required but we are happy to help recycle these if you send them in.
                </p>
            </div>
        </div>

        <div class="border-top answer" id="question-8">
            <div class="support-title font-orange bold">
                <p>How about if my mobile device is locked to a UK network?</p>
            </div>
            <div class="p-5">
                <p>
                    We accept Network locked devices – but if you can request the network to unlock it you may get more cash!
                </p>
            </div>
        </div>

        <div class="border-top answer" id="question-9">
            <div class="support-title font-orange bold">
                <p>What do I do with iCloud or Google locked?</p>
            </div>
            <div class="p-5">
                <p>
                    It would be best if you can remove your device from your iCloud or Google account before sending the device to us. This is really quick and easy to do, please click for a simple guide <a href="">here</a>
                </p>
            </div>
        </div>

        <div class="border-top answer" id="question-10">
            <div class="support-title font-orange bold">
                <p>Any Other Questions?</p>
            </div>
            <div class="p-5">
                <p>
                    You can contact us through email, chat or telephone – don’t be shy give us a try!
                </p>
            </div>
        </div>
    </div>

    <div class="supprt-titles-container">
        <div class="row-height-140 support-top-row pc-15-50">
            {{-- <a href="">
                <div class="btn btn-primary btn-blue btn-font-white">
                    <p>Buying a device</p>
                </div>
            </a> --}}
            <a href="/support/selling">
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
</div>

<script src="{{asset('js/Customer.js')}}"></script>
@endsection