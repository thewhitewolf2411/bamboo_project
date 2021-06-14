<div class="newsletter-container">
        
    <div class="text-center">
        <p class="newsletter-large-text">Sign up to our newsletter!</p>
    </div>

    <div class="text-center" id="newsletter-description">
        <p class="newsletter-small-text">amazing offers, hints and tips and just awesome-ness</p>
    </div>

    <div class="sign-up-form" id="newsletter-signup-form">

        <div class="newsletter-row full-width-newsletter justify-content-center">
            <div class="newsletter-column newsletter-name-input newsletter-mr">
                <div class="form-group m-0">
                    <input class="email-input mt-0" name="first_name" type="text" placeholder="First Name">
                </div>
            </div>
            <div class="newsletter-column newsletter-name-input">
                <div class="form-group m-0">
                    <input class="email-input mt-0" name="last_name" type="text" placeholder="Last Name">
                </div>
            </div>
        </div>
        <div class="newsletter-row full-width-newsletter justify-content-center">
            <div class="newsletter-column age-range-newsletter newsletter-mr">
                <div class="form-group">
                    <select class="email-input w-100" name="age_range" id="age_range">
                        <option value="" default selected disabled>Age Range</option>
                        <option value="18-24">18-24</option>
                        <option value="25-40">25-40</option>
                        <option value="41-65">41-65</option>
                        <option value="65+">65+</option>
                    </select>
                </div>
            </div>
            <div class="newsletter-column full-width-newsletter email-newsletter">
                <div class="form-group">
                    <input class="email-input mt-0" name="email_address" type="email" id="newsletter_email" required placeholder="Email address">
                </div>
            </div>
        </div>

        <div class="newsletter-terms-container">
            <input type="checkbox" id="newsletter_terms" name="newsletter_terms">
            <img id="newsletter-terms-toggle" src="{{asset('/images/front-end-icons/black_circle.svg')}}">
            <p class="newsletter-terms-text text-left">
                In addition to receiving an instant email when you open your account with Bamboo, 
                I agree to Bamboo sending me a regular newsletter, carrying out market research, 
                keeping me informed with personalised news, offers, products and promotions it believes 
                would be of interest to me through my preferred channel. 
            </p>
        </div>

        <div class="form-group" id="newsletter-section-scrollinto">
            <div class="text-center mt-3 mx-auto">
                <div class="btn newsletter-signupbtn" onclick="signUpNewsletter()"><p>Sign me up!</p></div>
            </div>
        </div>

    </div>

    <div id="newsletter-signup-success" class="invisible">
        <img src="{{asset('/customer_page_images/body/emoji_winking.svg')}}">
        <p>Woo hoo! You are all signed up</p>
    </div>

</div>

<script>
    document.getElementById('newsletter-terms-toggle').addEventListener('click', function(){
        let img = this;
        let current_img = img.src;

        if(img.classList.contains('selected')){
            img.src = '/images/front-end-icons/black_circle.svg';
            img.classList.remove('selected');
        } else {
            img.src = 'images/front-end-icons/black_tick_selected.svg';
            img.classList.add('selected');
        }

    })
    function signUpNewsletter(){
        let email = document.getElementById('newsletter_email').value;
        if(email){
            $.ajax({
                type: "POST",
                url: '/newslettersingup',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    email_address: email,
                },
                success: function(data, textStatus, jqXHR){
                    if(data === "200"){
                        document.getElementById('newsletter-description').classList.add('hidden');
                        document.getElementById('newsletter-signup-form').classList.add('hidden');
                        document.getElementById('newsletter-signup-success').classList.remove('invisible');
                    }
                },
            });
        }
    }
</script>

