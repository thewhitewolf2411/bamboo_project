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

        <div class="contact-forms-container">
            <div class="contact-form-container" id="message">

            </div>
            <div class="contact-form-container" id="live">
                
            </div>
            <div class="contact-form-container" id="telephone">
                
            </div>
            <div class="contact-form-container" id="whatsapp">
                
            </div>
        </div>

        
    </div>

</div>