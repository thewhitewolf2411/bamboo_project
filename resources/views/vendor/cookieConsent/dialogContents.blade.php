<div class="js-cookie-consent cookie-consent" id="cookie-container">

    <span class="cookie-consent__message">
        {!! trans('cookieConsent::texts.message') !!}
        <a target="_blank" href="{!! trans('cookieConsent::texts.link_url') !!}"> {!! trans('cookieConsent::texts.link') !!}</a>
    </span>

    <button id="accept-cookies" class="js-cookie-consent-agree cookie-consent__agree">
        {{ trans('cookieConsent::texts.agree') }}
    </button>

</div>