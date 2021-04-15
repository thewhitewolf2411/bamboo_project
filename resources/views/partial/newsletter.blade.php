<div class="home-element sign-up">
        
    <div class="center-title-container">
        <p>Sign up to our newsletter!</p>
    </div>

    <div class="text-center-container">
        <p>amazing offers, hints and tips and just awesome-ness</p>
    </div>

    <form action="/newslettersingup" method="POST">
        @csrf

        <div class="row w-100">
            <div class="col-md-6">
                <div class="form-group">
                    <input class="email-input mt-0" name="first_name" type="text" placeholder="First Name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input class="email-input mt-0" name="last_name" type="text" placeholder="Last Name">
                </div>
            </div>
        </div>
        <div class="row w-100">
            <div class="col-md-3">
                <div class="form-group">
                    <select class="email-input w-100" name="age_range" id="age_range">
                        <option value="" default selected disabled>Age Range</option>
                        <option value="16">0-16</option>
                        <option value="24">16-24</option>
                        <option value="48">24-48</option>
                        <option value="62">48-62</option>
                        <option value="62+">62+</option>
                    </select>
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <input class="email-input mt-0" name="email_address" type="email" placeholder="Email address">
                </div>
            </div>
        </div>

        <div class="terms-container">
            <input type="checkbox" class="newsletter_checkbox mx-3" id="newsletter_terms" name="newsletter_terms">
            <label class="newsletter_checkbox" id="newsletter_terms_label" for="newsletter_terms">
                <p style="margin-left: 40px">In addition to receiving an instant email when you open your account with Bamboo, I agree to Bamboo sending me a regular newsletter, carrying out market research, keeping me informed with personalised news, offers, products and promotions it believes would be of interest to me through my preferred channel. </p>
            </label>
        </div>

        <div class="form-group">
            <div class="col-md-3 mt-3 mx-auto">
                <input type="submit" class="btn btn-purple" value="Sign me up!">
            </div>
        </div>
    </form>

</div>