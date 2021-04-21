<p class="section-item-title-regular">Thanks for your sale! Check out the details below</p>
<pre class="text-center">
{!!$tradein->getDeviceStatus()[1]!!} - [{!!$tradein->job_state!!}]
</pre>

@if(in_array($tradein->job_state, ['1', '2', '3']))                                            

    @if($tradein->notReceivedYet())

        <div class="sale-status-row justify-content-center">
            <div class="sale-status-col">
                <img class="sale-status-img" src="{{asset('/customer_page_images/body/error_alert.svg')}}">
                <p class="sale-status-text">Trade pack recieved</p>
            </div>
            <div class="sale-status-grey-line"></div>
            <div class="sale-status-col">
                <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
                <p class="sale-status-text">Awaiting response</p>
            </div>
            <div class="sale-status-grey-line"></div>
            <div class="sale-status-col">
                <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
                <p class="sale-status-text">Submitted for payment</p>
            </div>
        </div>

        <p class="sale-status-information text-center mt-4 mb-2">
            Oh no! It looks like there is something holding up your sale.<br>
            Please check processing section to help us resolve the issue and speed up your sale.
        </p>

    @else

        @if($tradein->job_state === '3')
            <div class="sale-status-row justify-content-center">
                <div class="sale-status-col">
                    <img class="sale-status-img" src="{{asset('/customer_page_images/body/Icon-Tick-Selected.svg')}}">
                    <p class="sale-status-text">Trade pack despatched</p>
                </div>
                <div class="sale-status-purple-line"></div>
                <div class="sale-status-col">
                    <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
                    <p class="sale-status-text">Awaiting receipt</p>
                </div>
                <div class="sale-status-grey-line"></div>
                <div class="sale-status-col">
                    <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
                    <p class="sale-status-text">Awaiting response</p>
                </div>
            </div>

            <p class="sale-status-information text-center mt-4 mb-2">Your order is being recieved.</p>
        @else
            <div class="sale-status-row justify-content-center">
                <div class="sale-status-col">
                    <img class="sale-status-img" src="{{asset('/customer_page_images/body/Icon-Tick-Selected.svg')}}">
                    <p class="sale-status-text">Order Placed</p>
                </div>
                <div class="sale-status-purple-line"></div>
                <div class="sale-status-col">
                    <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
                    <p class="sale-status-text">Trade Pack Despatched</p>
                </div>
                <div class="sale-status-grey-line"></div>
                <div class="sale-status-col">
                    <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
                    <p class="sale-status-text">Awaiting response</p>
                </div>
            </div>

            <p class="sale-status-information text-center mt-4 mb-2">Your order is waiting for despatch.</p>
        @endif

    @endif
    
@endif

@if($tradein->job_state === '9')

    <div class="sale-status-row justify-content-center">
        <div class="sale-status-col">
            <img class="sale-status-img" src="{{asset('/customer_page_images/body/Icon-Tick-Selected.svg')}}">
            <p class="sale-status-text">Trade Pack Received</p>
        </div>
        <div class="sale-status-purple-line"></div>
        <div class="sale-status-col">
            <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
            <p class="sale-status-text">Testing</p>
        </div>
        <div class="sale-status-grey-line"></div>
        <div class="sale-status-col">
            <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
            <p class="sale-status-text">Submitted for payment</p>
        </div>
    </div>

    <p class="sale-status-information text-center mt-4 mb-2">Your order is awaiting testing.</p>
    
@endif

@if($tradein->job_state === '10' || $tradein->job_state === '12')

    <div class="sale-status-row justify-content-center">
        <div class="sale-status-col">
            <img class="sale-status-img" src="{{asset('/customer_page_images/body/Icon-Tick-Selected.svg')}}">
            <p class="sale-status-text">Testing</p>
        </div>
        <div class="sale-status-purple-line"></div>
        <div class="sale-status-col">
            <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
            <p class="sale-status-text">Submitted for payment</p>
        </div>
        <div class="sale-status-grey-line"></div>
        <div class="sale-status-col">
            <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
            <p class="sale-status-text">Payment confirmed</p>
        </div>
    </div>

    <p class="sale-status-information text-center mt-4 mb-2">Your order is awaiting for payment.</p>
    
@endif

@if($tradein->deviceInPaymentProcess())

    @if($tradein->job_state === '25')

        <div class="sale-status-row justify-content-center">
            <div class="sale-status-col">
                <img class="sale-status-img" src="{{asset('/customer_page_images/body/Icon-Tick-Selected.svg')}}">
                <p class="sale-status-text">Trade Pack received</p>
            </div>
            <div class="sale-status-purple-line"></div>
            <div class="sale-status-col">
                <img class="sale-status-img" src="{{asset('/customer_page_images/body/Icon-Tick-Selected.svg')}}">
                <p class="sale-status-text">Submitted for payment</p>
            </div>
            <div class="sale-status-purple-line"></div>
            <div class="sale-status-col">
                <img class="sale-status-img" src="{{asset('/customer_page_images/body/Icon-Tick-Selected.svg')}}">
                <p class="sale-status-text bold">Sale complete</p>
            </div>
        </div>

    @else
    
        @if($tradein->paymentFailed())
            <div class="sale-status-row justify-content-center">
                <div class="sale-status-col">
                    <img class="sale-status-img" src="{{asset('/customer_page_images/body/Icon-Tick-Selected.svg')}}">
                    <p class="sale-status-text">Testing</p>
                </div>
                <div class="sale-status-purple-line"></div>
                <div class="sale-status-col">
                    <img class="sale-status-img" src="{{asset('/customer_page_images/body/Icon-Tick-Selected.svg')}}">
                    <p class="sale-status-text">Awaiting response</p>
                </div>
                <div class="sale-status-purple-line"></div>
                <div class="sale-status-col">
                    <img class="sale-status-img" src="{{asset('/customer_page_images/body/error_alert.svg')}}">
                    <p class="sale-status-text">Submitted for payment</p>
                </div>
            </div>
            <p class="sale-status-information text-center mt-4 mb-2">
                Oh no! It looks like there is something holding up your sale.<br>
                Please check payment section to help us resolve the issue and speed up your sale.
            </p>
        @else
            <div class="sale-status-row justify-content-center">
                <div class="sale-status-col">
                    <img class="sale-status-img" src="{{asset('/customer_page_images/body/Icon-Tick-Selected.svg')}}">
                    <p class="sale-status-text">Submitted for payment</p>
                </div>
                <div class="sale-status-purple-line"></div>
                <div class="sale-status-col">
                    <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
                    <p class="sale-status-text">Payment confirmed</p>
                </div>
                <div class="sale-status-grey-line"></div>
                <div class="sale-status-col">
                    <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
                    <p class="sale-status-text">Sale complete</p>
                </div>
            </div>

            <p class="sale-status-information text-center mt-4 mb-2">Your order is being submitted for payment.</p>
        @endif

    @endif
    
@endif

@if($tradein->stuckAtProcessing())

    {{-- blacklisted --}}
    @if($tradein->job_state === '7')
        <div class="sale-status-row justify-content-center">
            <div class="sale-status-col">
                <img class="sale-status-img" src="{{asset('/customer_page_images/body/Icon-Tick-Selected.svg')}}">
                <p class="sale-status-text">Trade pack recieved</p>
            </div>
            <div class="sale-status-purple-line"></div>
            <div class="sale-status-col">
                <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
                <p class="sale-status-text">Awaiting response</p>
            </div>
            <div class="sale-status-grey-line"></div>
            <div class="sale-status-col">
                <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
                <p class="sale-status-text">Submitted for payment</p>
            </div>
        </div>
    @else
        <div class="sale-status-row justify-content-center">
            <div class="sale-status-col">
                <img class="sale-status-img" src="{{asset('/customer_page_images/body/Icon-Tick-Selected.svg')}}">
                <p class="sale-status-text">Trade pack recieved</p>
            </div>
            <div class="sale-status-purple-line"></div>
            <div class="sale-status-col">
                <img class="sale-status-img" src="{{asset('/customer_page_images/body/error_alert.svg')}}">
                <p class="sale-status-text">Awaiting response</p>
            </div>
            <div class="sale-status-grey-line"></div>
            <div class="sale-status-col">
                <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
                <p class="sale-status-text">Submitted for payment</p>
            </div>
        </div>

        <p class="sale-status-information text-center mt-4 mb-2">
            Oh no! It looks like there is something holding up your sale.<br>
            Please check processing section to help us resolve the issue and speed up your sale.
        </p>
    @endif

@endif

@if($tradein->hasFailedTesting())
    <div class="sale-status-row justify-content-center">
        <div class="sale-status-col">
            <img class="sale-status-img" src="{{asset('/customer_page_images/body/Icon-Tick-Selected.svg')}}">
            <p class="sale-status-text">Testing</p>
        </div>
        <div class="sale-status-purple-line"></div>
        <div class="sale-status-col">
            <img class="sale-status-img" src="{{asset('/customer_page_images/body/error_alert.svg')}}">
            <p class="sale-status-text">Awaiting response</p>
        </div>
        <div class="sale-status-grey-line"></div>
        <div class="sale-status-col">
            <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
            <p class="sale-status-text">Submitted for payment</p>
        </div>
    </div>

    <p class="sale-status-information text-center mt-4 mb-2">
        Oh no! It looks like there is something holding up your sale.<br>
        Please check testing section to help us resolve the issue and speed up your sale.
    </p>
@endif

{{-- second testing --}}
@if($tradein->job_state === '14')
    <div class="sale-status-row justify-content-center">
        <div class="sale-status-col">
            <img class="sale-status-img" src="{{asset('/customer_page_images/body/Icon-Tick-Selected.svg')}}">
            <p class="sale-status-text">Trade Pack Received</p>
        </div>
        <div class="sale-status-purple-line"></div>
        <div class="sale-status-col">
            <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
            <p class="sale-status-text">Testing</p>
        </div>
        <div class="sale-status-grey-line"></div>
        <div class="sale-status-col">
            <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
            <p class="sale-status-text">Submitted for payment</p>
        </div>
    </div>

    <p class="sale-status-information text-center mt-4 mb-2">Your order is awaiting second testing.</p>
@endif

@if($tradein->deviceInReturnProcess())
    <div class="sale-status-row justify-content-center">
        <div class="sale-status-col">
            <img class="sale-status-img" src="{{asset('/customer_page_images/body/Icon-Tick-Selected.svg')}}">
            <p class="sale-status-text">Trade Pack Received</p>
        </div>
        <div class="sale-status-purple-line"></div>
        <div class="sale-status-col">
            <img class="sale-status-img" src="{{asset('/customer_page_images/body/Icon-Tick-Selected.svg')}}">
            <p class="sale-status-text">Sent to despatch</p>
        </div>
        <div class="sale-status-purple-line"></div>
        <div class="sale-status-col">
            <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
            <p class="sale-status-text">Returned to customer</p>
        </div>
    </div>

    <p class="sale-status-information text-center mt-4 mb-2">Your device is in return process.</p>
@endif