@extends('customer.layouts.layout')

@section('content')      
    <div class="shop-intro-container">
        <div class="intro-container-content">
            <div class="text-column">
                <p class="shop-intro-small">
                    Quick, safe & simple
                </p>
                <p class="shop-intro-large">
                    The smart way to shop mobile phones and devices
                </p>
            </div>
            <img class="coming-soon" src={{asset('images/coming_soon.png')}}>
        </div>
    </div>

    <div class="shop-form" id="shop-form">
        <p class="shop-form-title">Let Boo notify you</p>
        <p class="shop-form-desc">Sign up below and we will notify you when the shop goes live</p>

        <div class="shop-form-column inputs">

            <div class="shop-form-row centered">
                <input class="shop-form-input first-name" type="text" name="first_name" id="notify_first_name" placeholder="First Name">
                <input class="shop-form-input last-name" type="text" name="last_name" id="notify_last_name" placeholder="Last Name">
            </div>

            <div class="shop-form-row centered">
                <select class="shop-form-input age-range" name="age_range" id="notify_age">
                    <option value="" default selected disabled>Age Range</option>
                    <option value="18-24">18-24</option>
                    <option value="25-40">25-40</option>
                    <option value="41-65">41-65</option>
                    <option value="65+">65+</option>
                </select>
                <input class="shop-form-input email" type="text" name="email" id="notify_email" placeholder="Email address">
            </div>

            <div class="shop-form-terms">
                <input type="checkbox" id="shop_notify_terms" name="shop_notify_terms">
                <img id="shop-notify-terms-toggle" src="{{asset('/images/front-end-icons/black_circle.svg')}}">
                <p class="shop-notify-terms-text text-left">
                    Yes, I would also like to sign up for a regular email newsletter, with offers products and promotions" then on a line underneath this, 
                    please place the wording “You can unsubscribe from receiving this newsletter at anytime by sending an email to info@bamboomobile.co.uk 
                    with “STOP” in the heading.
                </p>
            </div>

            <div class="btn submit-shop-form disabled" id="submitnotify"><p>Notify me</p></div>
        </div>
    </div>

    <div id="shopform-thankyou" class="not-visible">
        <p class="shopform-thankyou-large">Thank you</p>
        <img src="{{asset("/customer_page_images/body/emoji_winking.svg")}}">
        <p class="shopform-thankyou-small">We’ll be in touch once our SHOP goes live</p>
    </div>

    @include('partial.deliveryqualitybanner')

    <div class="sellwait-banner" id="swapShopBanner">
        <a class="sellwait-row center" href="/sell">
            <img class="shop-coins" src="{{asset('/images/shop_coins.png')}}">

            <div class="sellwait-column text">
                <p class="sellwait-title">Sell whilst you wait?</p>
                <p class="sellwait-desc">Why don’t you SELL your old device whilst you wait.</p>
            </div>
            <img class="shopbanner-arrow-right" id="shopbanner-arrow-icon" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
        </a>
    </div>

    @include('customer.layouts.footer', ['showGetstarted' => true])

<script type="application/javascript">

    document.getElementById('shop-notify-terms-toggle').addEventListener('click', function(){
        let img = this;
        let current_img = img.src;
        let terms = document.getElementById('shop_notify_terms');

        if(img.classList.contains('selected')){
            img.src = '/images/front-end-icons/black_circle.svg';
            img.classList.remove('selected');
            terms.checked = false;
        } else {
            img.src = 'images/front-end-icons/black_tick_selected.svg';
            img.classList.add('selected');
            terms.checked = true;
        }
        check();
    });

    document.getElementById('swapShopBanner').addEventListener('mouseover', function(e){
        let arrow = document.getElementById('shopbanner-arrow-icon');
        if(!arrow.classList.contains('zoomed')){
            arrow.classList.add('zoomed');
        }
    });

    document.getElementById('swapShopBanner').addEventListener('mouseout', function(){
        let arrow = document.getElementById('shopbanner-arrow-icon');
        if(arrow.classList.contains('zoomed')){
            arrow.classList.remove('zoomed');
        }
    });


    document.getElementById('notify_email').addEventListener('keyup', function(){
        check()
    });

    document.getElementById('notify_age').addEventListener('change', function(){
        check()
    });

    function check(){
        let email = document.getElementById('notify_email');
        let age_range = document.getElementById('notify_age');
        //let terms = document.getElementById('shop_notify_terms');

        //if(email.value && age_range.value && terms.checked){
        if(email.value && age_range.value){
            if(validateEmail(email.value)){
                document.getElementById('submitnotify').classList.remove('disabled');
                return true;
            }
            document.getElementById('submitnotify').classList.add('disabled');
            return false;
        } else {
            document.getElementById('submitnotify').classList.add('disabled');
            return false;
        }
    }

    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    document.getElementById("submitnotify").addEventListener('click', function(){
        let pass = check();
        if(pass){
            // subscribe
            $.ajax({
                type: "POST",
                url: '/shopsignup',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    email_address: document.getElementById('notify_email').value,
                },
                success: function(data, textStatus, jqXHR){
                    if(jqXHR.status === 200){
                        document.getElementById('shop-form').classList.add('not-visible');
                        document.getElementById('shopform-thankyou').classList.remove('not-visible');
                    }
                },
            });
        }
    });

</script>
@endsection