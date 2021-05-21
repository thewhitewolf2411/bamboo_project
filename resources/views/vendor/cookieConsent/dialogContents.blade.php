<div class="js-cookie-consent cookie-consent" id="cookie-container">

    <span class="cookie-consent__message">
        <p class="cookie-bold-text">Bamboo uses cookies on this site…yummy.</p>&nbsp;
        <p class="cookie-regular-text">Some of the cookies used are essential for parts of the site to work. Learn more about cookies</p>&nbsp;
        {{-- {!! trans('cookieConsent::texts.message') !!} --}}
        <a target="_blank" href="{!! trans('cookieConsent::texts.link_url') !!}"> {!! trans('cookieConsent::texts.link') !!}</a>
    </span>

    <button id="accept-cookies" class="js-cookie-consent-agree cookie-consent__agree">
        {{ trans('cookieConsent::texts.agree') }}
    </button>

</div>