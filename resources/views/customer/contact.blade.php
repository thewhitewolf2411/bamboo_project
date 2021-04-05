@extends('customer.layouts.layout')

@section('content')

<div class="app">

    <div class="contact-page contact-title-container">
        <div class="center-title-container">
            <p>Contact us</p>
        </div>
    </div>

    <a class="back-to-home-footer mt-3" href="/">
        <p class="back-home-text"><img class="back-home-icon mr-2" src="{{asset('images/front-end-icons/black_arrow_left.svg')}}">Back to home</p>
    </a>


    <div class="contact-ways-container">
        <div class="center-title-container">
            <p>You can contact Boo’s friendly team of mobile recycling experts by a number of ways. </p>
        </div>

        <div class="ways-container">
            <div class="ways-element">
                <a onclick="showContactForm('message')">
                    <div class="contact-div" id="contact-message">
                        <div class="center-title-container">
                            <p>Send us a message</p>
                        </div>
                        <img src="{{asset('/customer_page_images/body/contact-images/image-1.svg')}}">
                    </div>
                </a>
            </div>-
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
                        <div class="center-title-container">
                            <p>Telephone</p>
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
            <span>SEND US A MESSAGE</span>
            <p>Please complete the form below and we’ll get back to you without delay.</p>

            <form id="message-form" method="post" action="/sendMessage">
                @csrf

                <div class="row w-100">
                    <div class="form-group col-md-6">
                        <label for="firstname">First Name*</label>
                        <input id="firstname" name="firstname" type="text" class="form-control" @if(Auth::user()) value="{{Auth::user()->first_name}}" @endif required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="lastname">Last Name*</label>
                        <input id="lastname" name="lastname" type="text" class="form-control"  @if(Auth::user()) value="{{Auth::user()->last_name}}" @endif required>
                    </div>
                </div>

                <div class="row w-100">
                    <div class="form-group col-md-6">
                        <label for="emailadress">Email address*</label>
                        <input id="emailadress" name="emailadress" type="email" class="form-control"  @if(Auth::user()) value="{{Auth::user()->email}}" @endif required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="telephone">Telephone</label>
                        <input id="telephone" name="telephone" type="number" class="form-control"  @if(Auth::user()) value="{{Auth::user()->contact_number}}" @endif>
                    </div>
                </div>

                <div class="row w-100">
                    <div class="form-group col-md-6">
                        <label for="ordernumber">Order number</label>
                        <input id="ordernumber" name="ordernumber" type="number" class="form-control">
                    </div>
                </div>

                <div class="form-group" style="width: 100%; height: 350px;">
                    <label for="yourmessage">Your Message*</label>
                    <textarea id="yourmessage" name="yourmessage" form="message-form" type="text" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <input type="submit" class="form-control" value="Send message" id="message-submit">
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
            <div class="telephone-header">
                <span>TELEPHONE</span>
                <p>Call the number opposite to talk to our friendly and professional team of mobile specialists.</p>
            </div>

            <div class="telephone-contact-container">
                <span>0845 582 8880</span>

                <div class="worktime-container">
                    <p style="opacity: 0.5; margin: 0;">Opening times:</p>
                    <div class="workdays-container">
                        <div class="workays">
                            <p>Monday</p>
                            <p>Tuesday</p>
                            <p>Wenesday</p>
                            <p>Thursday</p>
                            <p>Friday</p>
                            <p>Saturday</p>
                            <p>Sunday</p>
                        </div>
                        <div class="hours">
                            <p class="hours-time">8 am - 5:30pm</p>
                            <p class="hours-time">8 am - 5:30pm</p>
                            <p class="hours-time">8 am - 5:30pm</p>
                            <p class="hours-time">8 am - 5:30pm</p>
                            <p class="hours-time">8 am - 5:30pm</p>
                            <p>Closed</p>
                            <p>Closed</p>
                        </div>
                    </div>
                    <p style="opacity: 0.5; margin: 0;">Calls are charged at local rate.</p>
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

<script>

    function showContactForm(contact){

        contactbuttons = document.getElementsByClassName('ways-container')[0].getElementsByClassName('ways-element');
        contactforms = document.getElementsByClassName('contact-form-container');
        for(var i = 0; i<contactbuttons.length; i++){
            contactbuttons[i].classList.add('contact-div-hidden');
            contactforms[i].classList.remove('contact-form-container-active');
        }

        switch(contact){
            case "message":
            contactbuttons[0].classList.remove('contact-div-hidden');
            contactforms[0].classList.add('contact-form-container-active');
            break;
            //case "live":
            //contactbuttons[1].classList.remove('contact-div-hidden');
            //contactforms[1].classList.add('contact-form-container-active');
            break;
            case "telephone":
            contactbuttons[1].classList.remove('contact-div-hidden');
            contactforms[2].classList.add('contact-form-container-active');
            break;
            //case "whatsapp":
            //contactbuttons[3].classList.remove('contact-div-hidden');
            //contactforms[3].classList.add('contact-form-container-active');
            break;
        }

    }

</script>

@if(Session::has('message_success'))

<script>

    $(document).ready(function(){
        alert('Your message has been sent.');
    });
    

</script>

@endif

@endsection