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

    <div class="shop-form">
        <p class="shop-form-title">Let Boo notify you</p>
        <p class="shop-form-desc">Sign up below and we will notify you when the shop goes live</p>

        <div class="shop-form-column inputs">

            <div class="shop-form-row centered">
                <input class="shop-form-input first-name" type="text" name="first_name" placeholder="First Name">
                <input class="shop-form-input last-name" type="text" name="last_name" placeholder="Last Name">
            </div>

            <div class="shop-form-row centered">
                <select class="shop-form-input age-range" name="age_range">
                    <option value="" default selected disabled>Age Range</option>
                    <option value="18-24">18-24</option>
                    <option value="25-40">25-40</option>
                    <option value="41-65">41-65</option>
                    <option value="65+">65+</option>
                </select>
                <input class="shop-form-input email" type="text" name="email" placeholder="Email address">
            </div>

            <div class="shop-form-terms">
                <input type="checkbox" id="shop_notify_terms" name="shop_notify_terms">
                <img id="shop-notify-terms-toggle" src="{{asset('/images/front-end-icons/black_circle.svg')}}">
                <p class="shop-notify-terms-text text-left">
                    In addition to receiving an instant email when you open your account with Bamboo, 
                    I agree to Bamboo sending me a regular newsletter, carrying out market research, 
                    keeping me informed with personalised news, offers, products and promotions it 
                    believes would be of interest to me through my preferred channel.
                </p>
            </div>

            <div class="btn submit-shop-form"><p>Notify me</p></div>
        </div>
    </div>

    @include('partial.deliveryqualitybanner')

    <div class="sellwait-banner" id="swapShopBanner">
        <a class="sellwait-row center" href="/sell">
            <img class="shop-coins" src="{{asset('/images/shop_coins.png')}}">

            <div class="sellwait-column text">
                <p class="sellwait-title" id="shopbanner-title">Sell whilst you wait?</p>
                <p class="sellwait-desc" id="shopbanner-description">Why don’t you SELL your old device whilst you wait.</p>
            </div>
            <img class="shopbanner-arrow-right" id="shopbanner-arrow-icon" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-Black.svg')}}">
        </a>
    </div>

    @include('customer.layouts.footer', ['showGetstarted' => true])

<script type="application/javascript">

    document.getElementById('shop-notify-terms-toggle').addEventListener('click', function(){
        let img = this;
        let current_img = img.src;

        if(img.classList.contains('selected')){
            img.src = '/images/front-end-icons/black_circle.svg';
            img.classList.remove('selected');
        } else {
            img.src = 'images/front-end-icons/black_tick_selected.svg';
            img.classList.add('selected');
        }

    });

    document.getElementById('swapShopBanner').addEventListener('mouseover', function(e){
        let title = document.getElementById('shopbanner-title');
        let desc = document.getElementById('shopbanner-description');
        let arrow = document.getElementById('shopbanner-arrow-icon');

        if(!arrow.classList.contains('zoomed')){
            arrow.classList.add('zoomed');
        }
        title.innerHTML = 'Save up to £300';
        desc.innerHTML = 'By trading in your old device when you make a purchase.';
    });

    document.getElementById('swapShopBanner').addEventListener('mouseout', function(){
        let title = document.getElementById('shopbanner-title');
        let desc = document.getElementById('shopbanner-description');
        let arrow = document.getElementById('shopbanner-arrow-icon');

        if(arrow.classList.contains('zoomed')){
            arrow.classList.remove('zoomed');
        }
        title.innerHTML = 'Sell whilst you wait?';
        desc.innerHTML = 'Why don’t you SELL your old device whilst you wait.';
    });

</script>
@endsection