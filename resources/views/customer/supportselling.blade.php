@extends('customer.layouts.layout')

@section('content')

<div class="app">

    <div class="page-header-container servicesupport">
        {{-- <p class="page-header-text">Service & Support</p> --}}
        <p class="page-header-text">Frequently Asked Questions</p>
    </div>
    
    @if(Session::get('_previous') !== null)
        <a class="back-to-home-footer padded mt-3 pt-2" href="{{Session::get('_previous')['url']}}">
    @else
        <a class="back-to-home-footer padded mt-3 pt-2" href="/">
    @endif
        <img class="back-home-icon mr-2" src="{{asset('images/front-end-icons/black_arrow_left.svg')}}">
        <p class="back-home-text">Back</p>
    </a>

    <div class="support-search-element height-100">
        {{-- <div class="center-title-container font-orange bold"> --}}
        <p class="title-supportselling">Selling a device</p>
        {{-- </div> --}}
    </div>

    {{-- <div class="support-faq">
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
    </div> --}}

    {{-- <div class="support-faq">

        <div class="faq-left">

            <div class="faq-question">
                <a onclick="showAnswer(1)">
                    <div class="faq-question-text">
                        <p>How does it work?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Add@2x.png')}}">
                    </div>
                </a>
            </div>
            <div class="faq-question">
                <a onclick="showAnswer(2)">
                    <div class="faq-question-text">
                        <p>How do I find out how much my phone is worth?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Add@2x.png')}}">
                    </div>
                </a>
            </div>
            <div class="faq-question">
                <a onclick="showAnswer(3)">
                    <div class="faq-question-text">
                        <p>What sort of handsets can I sell?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Add@2x.png')}}">
                    </div>
                </a>
            </div>
            <div class="faq-question">
                <a onclick="showAnswer(4)">
                    <div class="faq-question-text">
                        <p>How do I find out what model my handset is?</p>
                    </div>
                    <div class="faq-question-icon">
                        <img src="{{asset('/customer_page_images/body/Icon-Add@2x.png')}}">
                    </div>
                </a>
            </div>
            <div class="faq-question">
                <a onclick="showAnswer(5)">
                    <div class="faq-question-text">
                        <p>What is an IMEI number?</p>
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

    </div> --}}

    {{-- <hr>

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
    </div>--}}

    <div class="support-questions-row" id="faq-questions">
        <div class="support-questions-column margin-right">
            @foreach($second_faq as $question)
                <div class="support-question">
                    <p class="support-question-title">{!!$question->question!!}</p>
                    <img class="support-question-toggle-icon" src="{{asset('/customer_page_images/body/Icon-Add@2x.png')}}" onclick="toggleCollapse({!!$question->id!!})">
                </div>
            @endforeach
        </div>

        <div class="support-questions-column">
            @foreach($first_faq as $question)
                <div class="support-question">
                    <p class="support-question-title">{!!$question->question!!}</p>
                    <img class="support-question-toggle-icon" src="{{asset('/customer_page_images/body/Icon-Add@2x.png')}}" onclick="toggleCollapse({!!$question->id!!})">
                </div>
            @endforeach
        </div>
    </div>
    
    <div id="support-question-answers-container">
        @foreach($faq as $question_answer)
            <div class="support-question-answers">
                <div class="support-question-answers-title" id="collapse{!!$question_answer->id!!}" onclick="toggleCollapse({!!$question_answer->id!!})">
                    <button class="btn btn-link collapsed toggle-collapse-answer pl-0" data-toggle="collapse" data-target="#{!!$question_answer->id!!}" aria-expanded="false" aria-controls="collapse{!!$question_answer->id!!}">
                        {!!$question_answer->question!!}
                    </button>

                    <img class="support-question-toggle-icon" src="{{asset('/customer_page_images/body/Icon-Add@2x.png')}}" onclick="toggleCollapse({!!$question_answer->id!!})">
                </div>
                <div id="{!!$question_answer->id!!}" class="collapse" aria-labelledby="heading{!!$question_answer->id!!}" data-parent="#support-question-answers-container">
                    <div class="card-body answer">
                        @if($question_answer->answer === 'googleInstructions' || $question_answer->answer === 'appleInstructions')
                            @include('partial.faq.instructionsmodal', ['type' => $question_answer->answer])
                        @else
                            <p class="answer-text">{!!$question_answer->answer!!}</p>
                        @endif
                        {{-- @if($question_answer->link)<a class="btn mt-4 btn-{!!$question_answer->link_color!!}" href="{!!$question_answer->link!!}">{!!$question_answer->link_text!!}</a>@endif --}}
                    </div>
                </div>
            </div>
            <div class="answer-separate"></div>
        @endforeach
    </div>

    {{-- @include('partial.supportsearch') --}}

    {{-- <div class="support-titles-container">
        <div class="support-row">
            <!--<a href="">
                <div class="btn btn-primary btn-blue btn-font-white">
                    <p>Buying a device</p>
                </div>
            </a>-->
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

    </div> --}}

    <button onclick="goToTop()" id="topScroll" title="Go to top"><p>Return to top</p><i class="fa fa-arrow-up"></i></button>

</div>

    @include('customer.layouts.footer', ['showGetstarted' => false])
    
<script>
    (function() {
        var question_prev = '{!!$question_id!!}';
        if(question_prev){
            setTimeout(() => {
                toggleCollapse(question_prev);
            }, 500);
        }
    })()
    function toggleCollapse(id){
        $('.collapse').collapse('hide');
        setTimeout(function(){
            $('#'+id).collapse('show');  
            $([document.documentElement, document.body]).animate({
                scrollTop: $('#' + id).offset().top - 300
            }, 500);
        }, 500);
        
    }

    

    mybutton = document.getElementById("topScroll");
    window.addEventListener('scroll', function() { scroll() });

    function scroll() {
        var scrollTop = document.documentElement.scrollTop?
                document.documentElement.scrollTop:document.body.scrollTop;

        if (scrollTop > 1100 && scrollTop < 3112) {
            mybutton.classList.add('visible');
        } else {
            mybutton.classList.remove('visible');
        }
    }

    function goToTop() {
        $('html, body').animate({
            scrollTop: $('#faq-questions').offset().top - 170
        }, 800);
    }
</script>    
<script src="{{asset('js/Customer.js')}}"></script>
@endsection