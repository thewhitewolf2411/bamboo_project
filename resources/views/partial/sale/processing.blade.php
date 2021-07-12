
{{-- processing section status --}}
@if(!empty(App\Services\ProfileService::getProcessingStatus($tradein)))
    <div class="emoji-info-row pt-5 pb-4 pl-4 pt-4">
        <div class="emoji-col">
            <img class="emoji-img" src="{{asset(App\Services\ProfileService::getProcessingStatus($tradein)['emoji'])}}">
            <p class="emoji-text">{!!App\Services\ProfileService::getProcessingStatus($tradein)['emoji_text']!!}</p>
        </div>
        <p class="emoji-info-text">
            {!!App\Services\ProfileService::getProcessingStatus($tradein)['description']!!}
        </p>
    </div>
@endif

{{-- processing section error statuses --}}
@if(App\Services\ProfileService::getProcessingError($tradein))

    @if(App\Services\ProfileService::getProcessingError($tradein) === "PEM1")
        <div class="process-error-item">
            <div class="col">
                <p class="process-error-item-label">Issue</p>
                <p class="process-error-item-bold">Device not received after 7 days.</p>
            </div>
            <div class="col">
                <p class="process-error-item-label">Action required</p>
                <p class="process-error-item-bold">
                    Please send your device
                </p>
            </div>
            <div class="col">
                <p class="process-error-item-label">Notes</p>
                If we do not receive your device before 14 days. Yor will receive a new offer.
            </div>
            <div class="col">
                <a href="#" class="btn btn-purple process-action-btn">
                    <p>Request a new pack</p>
                    <img class="process-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
                <a href="#" class="btn btn-purple process-action-btn">
                    <p>Re-Print Label</p>
                    <img class="process-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
            </div>
        </div>
    @endif

    @if(App\Services\ProfileService::getProcessingError($tradein) === "PEM2")
        <div class="process-error-item">
            <div class="col">
                <p class="process-error-item-label">Issue</p>
                <p class="process-error-item-bold">Device not received after 10 days.</p>
            </div>
            <div class="col">
                <p class="process-error-item-label">Action required</p>
                <p class="process-error-item-bold">
                    Please send your device.
                </p>
            </div>
            <div class="col">
                <p class="process-error-item-label">Notes</p>
                If we do not receive your device before 14 days. Yor will receive a new offer.
            </div>
            <div class="col">
                <a href="#" class="btn btn-purple process-action-btn">
                    <p>Request a new pack</p>
                    <img class="process-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
                <a href="#" class="btn btn-purple process-action-btn">
                    <p>Re-Print Label</p>
                    <img class="process-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
            </div>
        </div>
    @endif

    @if(App\Services\ProfileService::getProcessingError($tradein) === "PEM3")
        <div class="process-error-item">
            <div class="col">
                <p class="process-error-item-label">Issue</p>
                <p class="process-error-item-bold">Device not received after 14 days.</p>
            </div>
            <div class="col">
                <p class="process-error-item-label">Action required</p>
                <p class="process-error-item-bold">
                    Your order to SELL has
                    expired. Please resubmit a
                    new SELL order.
                </p>
            </div>
            <div class="col">
                <p class="process-error-item-label">Notes</p>
                <p class="process-error-item-bold">
                    Device not received after 14 days.<br>
                    New SELL order required.
                </p>
            </div>
            <div class="col">
                <a href="/sell" class="btn btn-orange process-action-btn">
                    <p>Submit new SELL order</p>
                    <img class="process-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
            </div>
        </div>
    @endif

    @if(App\Services\ProfileService::getProcessingError($tradein) === "PEM4")
        <div class="process-error-item">
            <div class="col-2">
                <p class="process-error-item-label">Issue</p>
                <p class="process-error-item-bold">Trade pack received after 14 days.</p>
            </div>
            <div class="col-5">
                <p class="process-error-item-label">Action required</p>
                <p class="process-error-item-bold">
                    You have a new offer
                    for your device.
                </p>
            </div>
            <div class="col">
                <p class="process-error-item-label">New Offer</p>
                <p class="process-new-offer-price">£{!!$tradein->bamboo_price!!}</p>
            </div>
            <div class="col">
                <a href="{{route('acceptFaultyOffer', ['id' => $tradein->id])}}" class="btn btn-orange process-action-btn">
                    <p>Accept Offer</p>
                    <img class="process-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
                <a href="{{route('returnDevice', ['id' => $tradein->id])}}" class="btn btn-jade process-action-btn">
                    <p>Return my device</p>
                    <img class="process-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
            </div>
        </div>
    @endif

    @if(App\Services\ProfileService::getProcessingError($tradein) === "PEM5")
        <div class="process-error-item">
            <div class="col-2">
                <p class="process-error-item-label">Issue</p>
                <p class="process-error-item-bold">No IMEI number</p>
            </div>
            <div class="col-5">
                <p class="process-error-item-label">Action required</p>
                <p class="process-error-item-bold">
                    You have a new offer
                    for your device.
                </p>
            </div>
            <div class="col">
                <p class="process-error-item-label">New Offer</p>
                <p class="process-new-offer-price">£{!!$tradein->bamboo_price!!}</p>
            </div>
            <div class="col">
                <a href="{{route('acceptFaultyOffer', ['id' => $tradein->id])}}" class="btn btn-orange process-action-btn">
                    <p>Accept Offer</p>
                    <img class="process-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
                <a href="{{route('returnDevice', ['id' => $tradein->id])}}" class="btn btn-jade process-action-btn">
                    <p>Return my device</p>
                    <img class="process-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
            </div>
        </div>
    @endif

    @if(App\Services\ProfileService::getProcessingError($tradein) === "PEM6")
        <div class="process-error-item">
            <div class="col-2">
                <p class="process-error-item-label">Issue</p>
                <p class="process-error-item-bold">This device has been reported as stolen.</p>
            </div>
            <div class="col-5">
                <p class="process-error-item-label">Action required</p>
                <p class="process-error-item-bold">
                    Please get in touch.
                </p>
            </div>
            <div class="col">
                <p class="process-error-item-label">Notes</p>
                <p class="process-error-item-bold">
                    Device will be destroyed if we do not hear from you in 28 days.
                </p>
            </div>

            {{-- grey out / disable button after 28 days passed --}}
            <div class="col">
                <a href="/contact" class="btn btn-blue process-action-btn">
                    <p>Get in touch</p>
                    <img class="process-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
            </div>
        </div>
    @endif

    @if(App\Services\ProfileService::getProcessingError($tradein) === "PEM7")
        <div class="process-error-item">
            <div class="col">
                <p class="process-error-item-label">Issue</p>
                <p class="process-error-item-bold">No device in packaging.</p>
            </div>
            <div class="col">
                <p class="process-error-item-label">Action required</p>
                <p class="process-error-item-bold">
                    We can claim on your
                    behalf if you used
                    bamboo mobile
                    Freepost service
                    <br>
                    <br>
                    or
                    <br>
                    <br>
                    We will send your
                    packaging back to you.
                    You will need to contact
                    the courier you used to
                    make a claim.
                </p>
            </div>
            <div class="col">
                <p class="process-error-item-label">Image</p>
                <img class="processing-missing-image" src="{!!$tradein->getMissingImage()!!}">
            </div>
        </div>
    @endif

    @if(App\Services\ProfileService::getProcessingError($tradein) === "PEM-B")
        <div class="process-error-item">
            <div class="col-5">
                <p class="process-error-item-label">Issue</p>
                <p class="process-error-item-bold">{!!$tradein->getBlacklistedIssue()!!}</p>
            </div>
            <div class="col">
                <p class="process-error-item-label">Action required</p>
                <p class="process-error-item-bold">{!!$tradein->getBlacklistedActionInfo()!!}</p>
            </div>
            <div class="col">
                <a href="/contact" target="_blank" class="btn btn-blue process-action-btn">
                    <p>Get in touch</p>
                    <img class="process-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
            </div>
        </div>
    @endif

@endif

