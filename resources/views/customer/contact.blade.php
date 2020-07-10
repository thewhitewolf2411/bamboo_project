<div class="app">

    <div class="contact-page contact-title-container">
        <div class="center-title-container">
            <p>Contact us</p>
        </div>
    </div>


    <div class="contact-ways-container">
        <div class="center-title-container">
            <p>Ways to get in touch with us</p>
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
            </div>
            <div class="ways-element">
                <a onclick="showContactForm('live')">
                    <div class="contact-div" id="contact-live">
                        <div class="center-title-container">
                            <p>Live Chat</p>
                        </div>
                        <img src="{{asset('/customer_page_images/body/contact-images/image-2.svg')}}">
                    </div>
                </a>
            </div>
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
            <div class="ways-element">
                <a onclick="showContactForm('whatsapp')">
                    <div class="contact-div" id="contact-whatsapp">
                        <div class="center-title-container">
                            <p>WhatsApp</p>
                        </div>
                        <img src="{{asset('/customer_page_images/body/contact-images/image-4.svg')}}">
                    </div>
                </a>
            </div>



        </div>
        
    </div>

    <div class="contact-forms-container">
        <div class="contact-form-container" id="message-form-container">
            <span>SEND US A MESSAGE</span>
            <p>To contact us, please complete the form below and a member of our team will get back to you.</p>

            <form id="message-form" action="/">
                @csrf

                <div class="form-group">
                    <label for="firstname">First Name*</label>
                    <input id="firstname" name="firstname" type="text" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="lastname">Last Name*</label>
                    <input id="lastname" name="lastname" type="text" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="emailadress">Email address*</label>
                    <input id="emailadress" name="emailadress" type="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="telephone">Telephone</label>
                    <input id="telephone" name="telephone" type="number" class="form-control">
                </div>

                <div class="form-group">
                    <label for="ordernumber">Order number</label>
                    <input id="ordernumber" name="ordernumber" type="number" class="form-control">
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
            <p>To chat to a Customer Support advisor, please click on the link below</p>
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
                <p>To contact a member of the bamboo team, please use the number opposite</p>
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
    </div>

</div>

<script>

    function showContactForm(contact){
        console.log(contact);
    }

</script>