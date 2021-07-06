
{{-- testing section status --}}
<div class="emoji-info-row pt-5 pb-4 pl-4 pt-4">
    <div class="emoji-col">
        <img class="emoji-img" src="{{asset(App\Services\ProfileService::getTestingStatus($tradein)['emoji'])}}">
        <p class="emoji-text">{!!App\Services\ProfileService::getTestingStatus($tradein)['emoji_text']!!}</p>
    </div>
    <p class="emoji-info-text">
        {!!App\Services\ProfileService::getTestingStatus($tradein)['description']!!}
    </p>
</div>
{{dd(App\Services\ProfileService::getTestingError($tradein))}}

{{-- testing section error statuses --}}
@if(App\Services\ProfileService::getTestingError($tradein))

    {{-- pin locked --}}
    @if(App\Services\ProfileService::getTestingError($tradein) === "PEM8")
        <div class="testing-error-item">
            <div class="col">
                <p class="testing-error-item-label">Issue</p>
                <p class="testing-error-item-bold">Pattern/PIN number not provided</p>
            </div>
            <div class="col">
                <p class="testing-error-item-label">Action required</p>
                <p class="testing-error-item-bold">Enter Pattern / PIN, accept faulty offer or request your device back.</p>
            </div>
            <div class="col">
                <p class="testing-error-item-label">Pattern/PIN number</p>
                <p class="testing-error-item-bold">-</p>
            </div>
            <div class="col">
                <p class="testing-error-item-label">Faulty Offer</p>
                <p class="testing-new-offer-price">£{!!$tradein->bamboo_price!!}</p>
            </div>
            <div class="col">
                <div class="btn btn-green testing-action-btn" data-toggle="modal" data-target="#pinModal">
                    <p>Enter Pattern/PIN</p>
                    <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </div>
                <div class="modal fade" id="pinModal" tabindex="-1" role="dialog" aria-labelledby="pinPatternModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document"> 
                        
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="col">
                                    <div class="row">
                                        <div id="select-lock-back" class="hidden">
                                            <img class="back-locks-img" src="{{asset('customer_page_images/body/go-left.svg')}}"> 
                                            <p>Back</p>
                                        </div>
                                        <img class="close-modal-img ml-auto" src="{{asset('/customer_page_images/body/modal-close.svg')}}" data-dismiss="modal" aria-label="Close">
                                    </div>
                                    <h5 class="modal-title mr-auto ml-0" id="pinPatternModalLabel">SELECT YOUR OPTION</h5>
                                    </div>
                                </div>
                                <div class="modal-body">

                                    <div id="select-lock-option">
                                        <div id="select-pattern-lock">
                                            <img class="pattern-lock-img" src="{{asset('/customer_page_images/body/pattern_lock.svg')}}">
                                            <p>Enter Pattern</p>
                                        </div>
                                        <p class="or-center">or</p>
                                        <div id="select-pin-lock">
                                            <img class="pin-lock-img" src="{{asset('/customer_page_images/body/pin_lock.svg')}}">
                                            <p>Enter PIN</p>
                                        </div>
                                    </div>

                                    <div id="pattern-lock" class="hidden">
                                        <form method="POST" action="{{route('addDevicePattern', ['tradein'=>$tradein->id])}}">
                                            @csrf
                                            <div class="row mx-3 mt-2">
                                                <div class="col patern-sequence-info">
                                                    <img class="pattern-sequence-img" src="{{asset('/customer_page_images/body/pattern_instructions.svg')}}">
                                                    <p class="pattern-text-description">Example: Z-Shape pattern lock has a number sequence of 1-2-3-5-7-8-9</p>
                                                </div>
                                                <div class="col mt-auto mb-auto">
                                                    <p>Pattern Sequence:</p>
                                                    <input type="text" class="form-group" name="pattern">
                                                    <div class="row">
                                                        <button type="submit" class="btn btn-primary ml-auto mr-auto">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div id="pin-lock" class="hidden">
                                        <form method="POST" action="{{route('addDevicePIN', ['tradein'=>$tradein->id])}}">
                                            @csrf
                                            <div class="col">
                                                <div class="row mx-3 mt-2 w-25 ml-auto mr-auto">
                                                    <p>PIN Code:</p>
                                                    <input type="number" class="form-group" placeholder="0000" name="pin">
                                                </div>
                                                <div class="row">
                                                    <button type="submit" class="btn btn-primary ml-auto mr-auto">Save changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                
                            </div>
                    </div>
                </div>
                <a href="{{route('acceptFaultyOffer', ['id' => $tradein->id])}}" class="btn btn-orange process-action-btn">
                    <p>Accept Faulty Offer</p>
                    <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
                <a href="{{route('returnDevice', ['id' => $tradein->id])}}" class="btn btn-jade process-action-btn">
                    <p>Return my Device</p>
                    <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a> 
            </div>

        </div>
    @endif

    {{-- FMIP locked --}}
    @if(App\Services\ProfileService::getTestingError($tradein) === "PEM9")
        <div class="testing-error-item">
            <div class="col">
                <p class="testing-error-item-label">Issue</p>
                <p class="testing-error-item-bold">Find My iPhone stil active</p>
            </div>
                <div class="col">
                    <p class="testing-error-item-label">Action required</p>
                    <p class="testing-error-item-bold">Remove the Find My iPhone function, accept faulty offer or request your device back.</p>
                </div>
            <div class="col">
                <p class="testing-error-item-label">Faulty Offer</p>
                <p class="testing-new-offer-price">£{!!$tradein->bamboo_price!!}</p>
            </div>
            <div class="col">
                <a href="{{route('retestDevice', ['id' => $tradein->id])}}" class="btn btn-green testing-action-btn">
                    <p>I have removed</p>
                    <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
                <a href="#" class="btn btn-purple testing-action-btn">
                    <p>How do I remove?</p>
                    <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
                <a href="{{route('acceptFaultyOffer', ['id' => $tradein->id])}}" class="btn btn-orange testing-action-btn">
                    <p>Accept Faulty Offer</p>
                    <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
                <a href="{{route('returnDevice', ['id' => $tradein->id])}}" class="btn btn-jade testing-action-btn">
                    <p>Return my Device</p>
                    <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
            </div>
        </div>
    @endif

    {{-- google lock --}}
    @if(App\Services\ProfileService::getTestingError($tradein) === "PEM10")
        <div class="testing-error-item">
            <div class="col">
                <p class="testing-error-item-label">Issue</p>
                <p class="testing-error-item-bold">Google Activation Lock still active</p>
            </div>
            <div class="col">
                <p class="testing-error-item-label">Action required</p>
                <p class="testing-error-item-bold">Remove Google Activation Lock function, accept faulty offer or request your device back.</p>
            </div>
            <div class="col">
                <p class="testing-error-item-label">Faulty Offer</p>
                <p class="testing-new-offer-price">£{!!$tradein->bamboo_price!!}</p>
            </div>
            <div class="col">
                <a href="{{route('retestDevice', ['id' => $tradein->id])}}" class="btn btn-green testing-action-btn">
                    <p>I have removed</p>
                    <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
                <a href="#" class="btn btn-purple testing-action-btn">
                    <p>How do I do that?</p>
                    <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
                <a href="{{route('acceptFaultyOffer', ['id' => $tradein->id])}}" class="btn btn-orange testing-action-btn">
                    <p>Accept Faulty Offer</p>
                    <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
                <a href="{{route('returnDevice', ['id' => $tradein->id])}}" class="btn btn-jade testing-action-btn">
                    <p>Return my Device</p>
                    <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
            </div>
        </div>
    @endif

    {{-- testing faults --}}
    @if(App\Services\ProfileService::getTestingError($tradein) === "PEM11")
        <div class="testing-error-item">
            <div class="col">
                <p class="testing-error-item-label">Issue</p>
                <p class="testing-error-item-bold">Device does not meet the following requirements: </p>
            </div>
            <div class="col">
                <p class="testing-error-item-label">Faults</p>
                <p class="testing-error-item-bold">{!!$tradein->getTestingFaults()!!}</p>
            </div>
            <div class="col">
                <p class="testing-error-item-label">New Offer</p>
                <p class="testing-new-offer-price">£{!!$tradein->bamboo_price!!}</p>
            </div>
            <div class="col">
                <a href="{{route('acceptFaultyOffer', ['id' => $tradein->id])}}" class="btn btn-orange process-action-btn">
                    <p>Accept Offer</p>
                    <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
                <a href="{{route('returnDevice', ['id' => $tradein->id])}}" class="btn btn-jade process-action-btn">
                    <p>Return my Device</p>
                    <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                </a>
            </div>
        </div>
    @endif

@endif
