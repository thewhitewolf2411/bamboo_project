@extends('customer.layouts.layout')

@section('content')

<div class="app">

    <div class="contact-page contact-title-container">
        <div class="center-title-container">
            <p class="large-page-title">Contact us</p>
        </div>
    </div>

    @if(Session::get('_previous') !== null)
    <a class="back-to-home-footer mt-3" href="{{Session::get('_previous')['url']}}">
    @else
    <a class="back-to-home-footer mt-3" href="/">
    @endif
        <p class="back-home-text support"><img class="back-home-icon mr-2" src="{{asset('images/front-end-icons/black_arrow_left.svg')}}">Back</p>
    </a>


    <div class="contact-ways-container">
        <div class="text-center">
            {{-- <p>You can contact Boo’s friendly team of mobile recycling experts by a number of ways. </p> --}}
            <p class="customer-sections-title center mb-5">Ways to get in touch with us</p>
        </div>

        <div class="ways-container">
            <div class="ways-element">
                <a onclick="showContactForm('message')">
                    <div class="contact-div" id="contact-message">
                        <div class="contact-text">
                            Send us a message
                        </div>
                        <img src="{{asset('/customer_page_images/body/contact-images/image-1.svg')}}">
                    </div>
                </a>
            </div>
            {{--<div class="ways-element">
                <a onclick="showContactForm('live')">
                    <div class="contact-div" id="contact-live">
                        <div class="center-title-container">
                            <p>Live Chat</p>
                        </div>
                        <img src="{{asset('/customer_page_images/body/contact-images/image-2.svg')}}">
                    </div>
                </a>
            </div>--}}
            <div class="ways-element">
                <a onclick="showContactForm('telephone')">
                    <div class="contact-div" id="contact-telephone">
                        <div class="contact-text">
                            Telephone
                        </div>
                        <img src="{{asset('/customer_page_images/body/contact-images/image-3.svg')}}">
                    </div>
                </a>
            </div>
            {{--<div class="ways-element">
                <a onclick="showContactForm('whatsapp')">
                    <div class="contact-div" id="contact-whatsapp">
                        <div class="center-title-container">
                            <p>WhatsApp</p>
                        </div>
                        <img src="{{asset('/customer_page_images/body/contact-images/image-4.svg')}}">
                    </div>
                </a>
            </div>--}}
        </div>
        
    </div>

    <div class="contact-forms-container">

        <div class="contact-form-container" id="message-form-container">
            <p class="contact-form-header">SEND US A MESSAGE</span>
            <p class="contact-form-desc">To contact us, please complete the form below and a member of our team will get back to you.</p>

            <form id="message-form" method="post" action="/sendMessage">
                @csrf

                <div class="contact-form-message-row">
                    <div class="contact-form-title-wrapper">
                        <label class="contact-message-label mt-auto mb-auto" for="title">Title</label>
                        <select class="form-control" name="title">
                            <option value="Mr.">Mr.</option>
                            <option value="Ms.">Ms.</option>
                        </select>
                    </div>
                </div>

                <div class="contact-form-message-row">
                    <div class="contact-form-message-column">
                        <label class="contact-message-label" for="firstname">First Name*</label>
                        <input id="firstname" name="firstname" type="text" class="form-control contact-message-input" @if(Auth::user()) value="{{Auth::user()->first_name}}" @endif required>
                    </div>

                    <div class="contact-form-message-column">
                        <label class="contact-message-label" for="lastname">Last Name*</label>
                        <input id="lastname" name="lastname" type="text" class="form-control contact-message-input"  @if(Auth::user()) value="{{Auth::user()->last_name}}" @endif required>
                    </div>
                </div>

                <div class="contact-form-message-row">
                    <div class="contact-form-message-column">
                        <label class="contact-message-label" for="email_address">Email address*</label>
                        <input id="email_address" name="email_address" type="email" class="form-control contact-message-input"  @if(Auth::user()) value="{{Auth::user()->email}}" @endif required>
                    </div>

                    <div class="contact-form-message-column">
                        <label class="contact-message-label" for="telephone">Contact Number</label>
                        <input id="telephone" name="telephone" type="number" class="form-control contact-message-input"  @if(Auth::user()) value="{{Auth::user()->contact_number}}" @endif>
                    </div>
                </div>

                <div class="contact-form-message-row">
                    <div class="contact-form-message-column">
                        <label class="contact-message-label" for="title" style="margin-bottom: 0.375rem;">Date of Birth</label>
                        {{-- <input id="title" name="title" type="text" class="form-control"> --}}
                        @include('partial.birthdate', ['required' => false])
                    </div>

                    <div class="contact-form-message-column">
                        <label class="contact-message-label" for="order_number">Order Number</label>
                        <input id="order_number" name="order_number" type="text" class="form-control contact-message-input">
                    </div>
                </div>

                <div class="form-group" style="width: 100%; height: 350px;">
                    <label class="contact-message-label mb-1" for="yourmessage">Your Message*</label>
                    <textarea id="yourmessage" name="yourmessage" form="message-form" type="text" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-jade" id="message-submit">Send Message</button>
                </div>
            </form>
        </div>

        <div class="contact-form-container" id="live-form-container">
            <span>LIVE CHAT</span>
            <p>To chat with a Boo customer support advisor, please click on the link below.</p>
            <div class="ways-element">
                <div class="contact-div" id="contact-live">
                    <div class="center-title-container">
                        <p>Live Chat</p>
                    </div>
                    <img src="{{asset('/customer_page_images/body/contact-images/image-2.svg')}}">
                </div>
            </div>
        </div>

        <div class="contact-form-container" id="telephone-form-container">
            <div class="telephone-header mb-4">
                <p class="contact-form-header">TELEPHONE</p>
                {{-- <p class="contact-form-desc">Call the number opposite to talk to our friendly and professional team of mobile specialists.</p> --}}
                <p class="contact-form-desc telephone">To contact a member of the bamboo team, please use the number opposite</p>
            </div>
 
            <div class="telephone-contact-container">
                <span>0345 582 0511</span>

                <div class="worktime-container">
                    <p style="opacity: 0.5; margin: 0;" class="worktime-text mt-4">Opening times:</p>
                    <div class="workdays-container mt-2">
                        <div class="workays">
                            <p class="worktime-text">Monday</p>
                            <p class="worktime-text">Tuesday</p>
                            <p class="worktime-text">Wenesday</p>
                            <p class="worktime-text">Thursday</p>
                            <p class="worktime-text">Friday</p>
                            <p class="worktime-text">Saturday</p>
                            <p class="worktime-text">Sunday</p>
                        </div>
                        <div class="hours">
                            <p class="worktime-text hours-time">9 am – 5.30pm</p>
                            <p class="worktime-text hours-time">9 am – 5.30pm</p>
                            <p class="worktime-text hours-time">9 am – 5.30pm</p>
                            <p class="worktime-text hours-time">9 am – 5.30pm</p>
                            <p class="worktime-text hours-time">9 am – 5.30pm</p>
                            <p class="worktime-text">Closed</p>
                            <p class="worktime-text">Closed</p>
                        </div>
                    </div>
                    <p style="opacity: 0.5; margin: 0;" class="worktime-text mt-2">Calls are charged at local rate.</p>
                    <p class="worktime-text mt-2" style="max-width: 480px;">Please note calls are recorded for monitoring and are used for ongoing training purposes</p>
                </div>
            </div>
        </div>

        <div class="contact-form-container" id="whatsapp-form-container">
            <span>WHATSAPP</span>
            <p>Click the button below to chat to the Bamboo Mobile team directly via WhatsApp.</p>
            <a href="">
                <div class="ways-element">
                    <div class="contact-div contact-flex-row" id="contact-whatsapp">
                        <div class="center-title-container">
                            <p>Launch WhatsApp</p>
                        </div>
                        <img src="{{asset('/customer_page_images/body/contact-images/image-4.svg')}}">
                    </div>
                </div>
            </a>
        </div>
    </div>

    <a href="/support">
        <div class="contact-footer">
            
            <div class="contact-footer-image">
                <img src="{{asset('/customer_page_images/body/Icon-Trust.svg')}}">
            </div>
            <div class="contact-footer-text">
                <p class="service-header-1" >Service & Support</p>
                <p class="service-header-2">A lot of our queries can be found within our Service & Support section</p>
            </div>
            <div class="contact-footer-arrow">
                <img src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
            </div>
        </div>
    </a>

</div>

@include('customer.layouts.footer', ['showGetstarted' => true, 'getStartedColor' => '#A3D147'])


@if(Session::has('message_success'))

<script>

    alert('Your message has been sent.');

</script>

@endif

@endsection