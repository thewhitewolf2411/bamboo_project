<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        {{-- <script src="{{ asset('js/Customer.js') }}"></script> --}}

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- jQuery -->

        
        <title>Bamboo Mobile</title>

        <link rel="icon" type="image/png" sizes="96x96" href="/customer_page_images/header/favicon-96x96.png">

        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="crossorigin="anonymous"></script>        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    </head>
    <body>
        <header>@include('customer.layouts.header')</header>
        <main>
            <div class="app">
                <div class="how-page how-title-container">
                    <div class="top-text">
                        <p class="top-text-shadow">My Bamboo</p>
                    </div>
                </div>

                <div class="user-sections-container" id="sale-item-container">
                    <div class="sections-row">
                        <div class="sections-menu">
                            <div class="change-sales-page sales-item link-active" id="sales-my"><img class="go-left-img" src="{{asset('/customer_page_images/body/go-left.svg')}}">My Sales</div>
                            <div class="change-sales-page sales-item" id="sales-status">Sale status</div>
                            <div class="change-sales-page sales-item" id="sales-notifications">Notifications</div>
                            <div class="change-sales-page sales-item" id="sales-details">Sale details</div>
                            <div class="change-sales-page sales-item" id="sales-delivery">Delivery details</div>
                            <div class="change-sales-page sales-item" id="sales-processing">Processing</div>
                            <div class="change-sales-page sales-item" id="sales-testing">Testing</div>
                            <div class="change-sales-page sales-item" id="sales-payment">Payment</div>
                            @if(!$tradein->hasDeviceBeenReceived())
                                <div class="sales-item" id="sales-payment" data-toggle="modal" data-target="#cancelSaleModal">Cancel my Sale</div>
                            @endif
                        </div>
                        <div class="section-items">

                            <div id="section-sale-status" class="sale-item-sections mb-2">
                                <div class="section-item-content">
                                    <div class="section-header">
                                        <p class="section-item-title">Sale Status</p>
                                        <button class="notbtn" data-toggle="collapse" data-toggle="collapse" data-target="#collapseSaleStatus" aria-expanded="false" aria-controls="collapseSaleStatus">
                                            <p id="sale-status-collapse-text" class="collapse-title">Expand</p>
                                            <img id="sale-status-collapse" class="collapse-up-img" src="{{asset('/customer_page_images/body/collapse-down.svg')}}">
                                        </button>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="collapse" id="collapseSaleStatus">
                                        <p class="section-item-title-regular">Thanks for your sale! Check out the details below</p>

                                        @if($tradein->job_state === '1' || $tradein->job_state === '2' || $tradein->job_state === '3')                                            

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

                                                {{-- <div class="sale-status-row justify-content-center">
                                                    <div class="sale-status-col">
                                                        <img class="sale-status-img" src="{{asset('/customer_page_images/body/Icon-Tick-Selected.svg')}}">
                                                        <p class="sale-status-text">Trade Pack Despatched</p>
                                                    </div>
                                                    <div class="sale-status-purple-line"></div>
                                                    <div class="sale-status-col">
                                                        <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
                                                        <p class="sale-status-text">Receiving</p>
                                                    </div>
                                                    <div class="sale-status-grey-line"></div>
                                                    <div class="sale-status-col">
                                                        <img class="sale-status-img" src="{{asset('/customer_page_images/body/grey_circle.png')}}">
                                                        <p class="sale-status-text">Testing</p>
                                                    </div>
                                                </div>

                                                <p class="sale-status-information text-center mt-4 mb-2">Your order is being recieved.</p> --}}

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

                                        @if(Session::has('success'))
                                            <div class="alert alert-success text-center" role="alert">
                                                {!!Session::get('success')!!}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <div id="section-sale-notifications" class="sale-item-sections mb-2">
                                <div class="section-item-content">
                                    <div class="section-header">
                                        <p class="section-item-title">Notifications</p>
                                        <button class="notbtn" data-toggle="collapse" data-toggle="collapse" data-target="#collapseNotifications" aria-expanded="false" aria-controls="collapseNotifications">
                                            <p id="notifications-collapse-text" class="collapse-title">Expand</p>
                                            <img id="notifications-collapse" class="collapse-up-img" src="{{asset('/customer_page_images/body/collapse-down.svg')}}">
                                        </button>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="collapse" id="collapseNotifications">
                                        <div class="notifications-list">
                                            {{-- {!!dd($notifications)!!} --}}
                                            @foreach($notifications as $notification)
                                                <div class="notification-card @if($notification->status === 'alert' && $notification->resolved === false) red-border @endif">
                                                    @if($notification->status === 'alert')
                                                        @if($notification->resolved === false)
                                                            <img class="notification-error-img mr-4 ml-2" src="{{asset('/customer_page_images/body/error_alert.svg')}}">
                                                        @else
                                                            <img class="notification-error-img mr-4 ml-2" src="{{asset('/customer_page_images/body/green_tick.svg')}}">
                                                        @endif
                                                    @endif
                                                    @if($notification->status === 'info')<img class="notification-green-img mr-4 ml-2" src="{{asset('/customer_page_images/body/green_bell.svg')}}">@endif
                                                    {{$notification->content}}
                                                </div>
                                                <div class="notification-card-border"></div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="section-sale-details" class="sale-item-sections mb-2">
                                <div class="section-item-content">
                                    <div class="section-header">
                                        <p class="section-item-title">Sale details</p>
                                        <button class="notbtn" data-toggle="collapse" data-toggle="collapse" data-target="#collapseSaleDetails" aria-expanded="false" aria-controls="collapseSaleDetails">
                                            <p id="sale-detail-text" class="collapse-title">Expand</p>
                                            <img id="sale-details-collapse" class="collapse-up-img" src="{{asset('/customer_page_images/body/collapse-down.svg')}}">
                                        </button>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="collapse" id="collapseSaleDetails">
                                        <div class="row m-0 justify-content-between">
                                            <div class="sale-detail-col">
                                                <div class="sale-row-1">
                                                    <div class="col sale-detail-infobox m-0">
                                                        <p class="sale-item-label">Order #</p>
                                                        <p class="sale-item-val">Order #{!!$tradein->barcode!!}</p>
                                                    </div>
                                                    <div class="col sale-detail-infobox m-0">
                                                        <p class="sale-item-label">Date of sale</p>
                                                        <p class="sale-item-val">{!!$tradein->created_at->toFormattedDateString()!!}</p>
                                                    </div>
                                                    <div class="col sale-detail-infobox m-0">
                                                        <p class="sale-item-label">Device</p>
                                                        <p class="sale-item-val">{!!$tradein->getProductName($tradein->id)!!}</p>
                                                    </div>
                                                </div>
                                                <div class="sale-row-2">
                                                    <div class="col sale-detail-infobox m-0">
                                                        <p class="sale-item-label">Memory</p>
                                                        <p class="sale-item-val">{!!$tradein->getDeviceMemory()!!}</p>
                                                    </div>
                                                    <div class="col sale-detail-infobox m-0">
                                                        <p class="sale-item-label">Network</p>
                                                        <p class="sale-item-val">{!!$tradein->getDeviceNetwork()!!}</p>
                                                    </div>
                                                    <div class="col sale-detail-infobox m-0">
                                                        <p class="sale-item-label">Colour</p>
                                                        <p class="sale-item-val">{!!$tradein->getDeviceColour()!!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sale-detail-col">
                                                <!-- labels and delivery notes popup -->
                                                @include('partial.labeldeliverynotes', ['tradein' => $tradein, 'btn_text' => 'Reprint Trade Pack & Label'])

                                                <a class="btn-purple sale-detail-btn" href="#"><p>Email me a copy</p> <img class="sale-detail-btn-img" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}"></a>
                                                <a class="btn-blue sale-detail-btn" href="/contact" target="_blank"><p>Get in touch</p> <img class="sale-detail-btn-img" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}"></a>
                                                @if(!$tradein->hasDeviceBeenReceived())
                                                    <a class="btn-primary sale-detail-btn" href="/userprofile/deleteorder/{{$tradein->barcode}}"><p>Cancel Sale</p> <img class="sale-detail-btn-img" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}"></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="section-delivery-details" class="sale-item-sections mb-2">
                                <div class="section-item-content">
                                    <div class="section-header">
                                        <p class="section-item-title">Delivery details</p>
                                        <button class="notbtn" data-toggle="collapse" data-toggle="collapse" data-target="#collapseDeliveryDetails" aria-expanded="false" aria-controls="collapseDeliveryDetails">
                                            <p id="delivery-detail-text" class="collapse-title">Expand</p>
                                            <img id="delivery-details-collapse" class="collapse-up-img" src="{{asset('/customer_page_images/body/collapse-down.svg')}}">
                                        </button>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="collapse" id="collapseDeliveryDetails">
                                        <div class="row p-4">

                                            @if($tradein->trade_pack_send_by_customer === 0)
                                                <div class="label-print-type selected m-2">
                                                    <div class="col p-0">
                                                        <img class="label-print-svg" src="{{asset('/customer_page_images/body/free_bamboo_trade_pack.svg')}}">
                                                        <p class="label-print-text">FREE bamboo <br>Trade Pack</p>
                                                        <img class="label-select-svg" id="bamboo-print-selected" src="{{asset('/customer_page_images/body/orange_selected.svg')}}">
                                                    </div>

                                                    <div class="btn-purple sale-detail-btn auto-width mt-4" id="call-print-bamboo" onclick="print('{{$tradein->id}}')"><p>Re-Print Label</p> <img class="sale-detail-btn-img" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}"></div>
                                                </div>
                                            @endif

                                            @if($tradein->trade_pack_send_by_customer === 1)
                                                <div class="label-print-type selected m-2">
                                                    <div class="col p-0">
                                                        <img class="label-print-svg" src="{{asset('/customer_page_images/body/free_print_own_label.svg')}}">
                                                        <p class="label-print-text">FREE print your <br>own label</p>
                                                        <img class="label-select-svg" id="own-print-selected" src="{{asset('/customer_page_images/body/orange_selected.svg')}}">
                                                    </div>

                                                    <div class="btn-purple sale-detail-btn auto-width mt-4" onclick="print('{{$tradein->id}}')" id="call-print-own" ><p>Re-Print Label</p> <img class="sale-detail-btn-img" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}"></div>
                                                </div>
                                            @endif

                                            <div id="label-trade-in-modal" class="modal fade" tabindex="-1" role="dialog" style="padding-right: 17px;">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Trade pack label</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span style="color: black;" aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <iframe id="tradein-iframe"></iframe>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <p class="delivery-info-dates-label">Date Posted</p>
                                                <p class="delivery-info-dates-bold">{!!$tradein->created_at->format('d M, Y')!!}</p>
                                                <br>
                                                <p class="delivery-info-dates-label">Date Received</p>
                                                <p class="delivery-info-dates-bold">{!!$tradein->getReceivedDate()!!}</p>
                                            </div>
                                            <div class="col">
                                                {{-- <p class="delivery-info-dates-label">Enter Tracking Number</p> --}}
                                                <p class="delivery-info-dates-bold"></p>
                                                <a class="btn-purple delivery-detail-btn mt-4" id="call-print-own" href="#"><p>Edit Tracking Number</p> <img class="sale-detail-btn-img" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}"></a>
                                                <a class="btn-green delivery-detail-btn mt-1" id="call-print-own" href="#"><p>Track Parcel</p> <img class="sale-detail-btn-img" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="section-processing" class="sale-item-sections mb-2">
                                <div class="section-item-content">
                                    <div class="section-header">
                                        <p class="section-item-title">Processing</p>
                                        <button class="notbtn" data-toggle="collapse" data-toggle="collapse" data-target="#collapseProcessingDetails" aria-expanded="false" aria-controls="collapseProcessingDetails">
                                            <p id="processing-detail-text" class="collapse-title">Expand</p>
                                            <img id="processing-details-collapse" class="collapse-up-img" src="{{asset('/customer_page_images/body/collapse-down.svg')}}">
                                        </button>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="collapse" id="collapseProcessingDetails">

                                        @if($tradein->deviceInPaymentProcess())

                                            @if($tradein->job_state === '25')
                                                <div class="emoji-info-row pt-5 pb-4 pl-4 pt-4">
                                                    <div class="emoji-col">
                                                        <img class="emoji-img" src="{{asset('/customer_page_images/body/emoji_winking.svg')}}">
                                                        <p class="emoji-text">Woohoo!</p>
                                                    </div>
                                                    <p class="emoji-info-text">
                                                        We have received your device and it is currently being
                                                        processed with our trusty team of bamboo’ers.
                                                    </p>
                                                </div>
                                            @endif

                                        @else

                                            @if($tradein->job_state === '10')
                                                <div class="emoji-info-row pt-5 pb-4 pl-4 pt-4">
                                                    <div class="emoji-col">
                                                        <img class="emoji-img" src="{{asset('/customer_page_images/body/emoji_laughing.svg')}}">
                                                        <p class="emoji-text">Woohoo!</p>
                                                    </div>
                                                    <p class="emoji-info-text">
                                                        We have received your device and it is currently being
                                                        processed with our trusty team of bamboo’ers.
                                                    </p>
                                                </div>
                                            @endif

                                            @if($tradein->stuckAtProcessing())

                                                {{-- waiting blacklisted reason --}}
                                                @if($tradein->job_state === '7')
                                                    <div class="emoji-info-row pt-5 pb-4 pl-4 pt-4">
                                                        <div class="emoji-col">
                                                            <img class="emoji-img" src="{{asset('/customer_page_images/body/emoji_winking.svg')}}">
                                                            <p class="emoji-text">Woohoo!</p>
                                                        </div>
                                                        <p class="emoji-info-text">
                                                            We have received your device and it is currently being
                                                            processed with our trusty team of bamboo’ers.
                                                        </p>
                                                    </div>

                                                @else

                                                    {{-- blacklisted info --}}
                                                    <div class="emoji-info-row pt-5 pb-4 pl-4 pt-4">
                                                        <div class="emoji-col">
                                                            <img class="emoji-img" src="{{asset('/customer_page_images/body/emoji_confused.svg')}}">
                                                            <p class="emoji-text">Uh-oh!</p>
                                                        </div>
                                                        <p class="emoji-info-text">
                                                            There is an issue whilst trying to process your order.
                                                            <br>
                                                            <br>
                                                            See below for details.
                                                        </p>
                                                    </div>

                                                    @if($tradein->isBlacklisted())
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

                                                {{-- no imei --}}
                                                @if($tradein->job_state === '6')
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
                                            
                                                {{-- missing device --}}
                                                @if($tradein->job_state === '4')
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

                                            @endif

                                            @if(!$tradein->stuckAtProcessing())
                                            
                                                <div class="emoji-info-row pt-5 pb-4 pl-4 pt-4">
                                                    <div class="emoji-col">
                                                        <img class="emoji-img" src="{{asset('/customer_page_images/body/emoji_winking.svg')}}">
                                                        <p class="emoji-text">Hang tight</p>
                                                    </div>
                                                    <p class="emoji-info-text">
                                                        We have received your device and it is currently being
                                                        processed with our trusty team of bamboo’ers.
                                                    </p>
                                                </div>

                                            @endif

                                            @if($tradein->notReceivedYet())

                                                @if($tradein->notReceivedAfterSevenDays())
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

                                                @if($tradein->notReceivedAfterTenDays())
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

                                                @if($tradein->notReceivedAfterFourteenDays())
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
                                                            <a href="#" class="btn btn-orange process-action-btn">
                                                                <p>Submit new SELL order</p>
                                                                <img class="process-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif

                                            @endif

                                        @endif

                                    </div>
                                </div>
                            </div>

                            <div id="section-testing" class="sale-item-sections mb-2">
                                <div class="section-item-content">
                                    <div class="section-header">
                                        <p class="section-item-title">Testing</p>
                                        <button class="notbtn" data-toggle="collapse" data-toggle="collapse" data-target="#collapseTesting" aria-expanded="false" aria-controls="collapseTesting">
                                            <p id="testing-detail-text" class="collapse-title">Expand</p>
                                            <img id="testing-details-collapse" class="collapse-up-img" src="{{asset('/customer_page_images/body/collapse-down.svg')}}">
                                        </button>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="collapse" id="collapseTesting">

                                        @if(!$tradein->isInTesting())

                                            @if($tradein->deviceInPaymentProcess())

                                                @if($tradein->job_state === '25')
                                                    <div class="emoji-info-row pt-5 pb-4 pl-4 pt-4">
                                                        <div class="emoji-col">
                                                            <img class="emoji-img" src="{{asset('/customer_page_images/body/emoji_winking.svg')}}">
                                                            <p class="emoji-text">Woohoo!</p>
                                                        </div>
                                                        <p class="emoji-info-text">
                                                            Your device passed our checks with flying colours.
                                                            Your payment will now be submitted.
                                                        </p>
                                                    </div>
                                                @endif

                                            @else

                                                <div class="emoji-info-row pt-5 pb-4 pl-4 pt-4">
                                                    <div class="emoji-col">
                                                        <img class="emoji-img" src="{{asset('/customer_page_images/body/emoji_winking.svg')}}">
                                                        <p class="emoji-text">Hang tight</p>
                                                    </div>
                                                    <p class="emoji-info-text">
                                                        Your order is awaiting testing.
                                                    </p>
                                                </div>

                                            @endif


                                        @else

                                            @if($tradein->hasFailedTesting())
                                                <div class="emoji-info-row pt-5 pb-4 pl-4 pt-4">
                                                    <div class="emoji-col">
                                                        <img class="emoji-img" src="{{asset('/customer_page_images/body/emoji_sad.svg')}}">
                                                        <p class="emoji-text">Booo!</p>
                                                    </div>
                                                    <p class="emoji-info-text">
                                                        Unfortunately, your device didn’t pass our tests, but
                                                        fear not, you have a new offer waiting for you.
                                                    </p>
                                                </div>

                                                {{-- {!!dd($tradein)!!} --}}
                                                {{-- device network incorrect --}}
                                                @if($tradein->job_state === '15g')
                                                    <div class="testing-error-item">
                                                        <div class="col">
                                                            <p class="testing-error-item-label">Condition</p>
                                                            <p class="testing-error-item-bold">Device does not meet the following requirements: </p>
                                                            <br>
                                                            <p class="testing-error-item-bold">Incorrect network</p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="testing-error-item-label">Action required</p>
                                                            <p class="testing-error-item-bold">Accept new offer or request device back.</p>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="testing-error-item-label">New Offer</p>
                                                            <p class="testing-new-offer-price">£{!!$tradein->bamboo_price!!}</p>
                                                        </div>
                                                        <div class="col">
                                                            <a href="{{route("acceptFaultyOffer", ['id' => $tradein->id])}}" class="btn btn-orange testing-action-btn">
                                                                <p>Accept Offer</p>
                                                                <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                                                            </a>
                                                            <a href="{{route("returnDevice", ['id' => $tradein->id])}}" class="btn btn-jade testing-action-btn">
                                                                <p>Return my Device</p>
                                                                <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- pin/fmip/google locked --}}
                                                @if($tradein->lockedFaults() !== null)
                                                    <div class="testing-error-item">
                                                        <div class="col">
                                                            <p class="testing-error-item-label">Issue</p>
                                                            <p class="testing-error-item-bold">{!!$tradein->lockedFaults()!!}</p>
                                                        </div>
                                                        @if($tradein->isPinLocked())
                                                            <div class="col">
                                                                <p class="testing-error-item-label">Action required</p>
                                                                <p class="testing-error-item-bold">Enter Pattern / PIN, accept faulty offer or request your device back.</p>
                                                            </div>
                                                        @elseif($tradein->isFimpLocked())
                                                            <div class="col">
                                                                <p class="testing-error-item-label">Action required</p>
                                                                <p class="testing-error-item-bold">Remove the Find My iPhone function, accept faulty offer or request your device back.</p>
                                                            </div>
                                                        @elseif($tradein->isGoogleLocked())
                                                            <div class="col">
                                                                <p class="testing-error-item-label">Action required</p>
                                                                <p class="testing-error-item-bold">Remove Google Activation Lock function, accept faulty offer or request your device back.</p>
                                                            </div>
                                                        @endif
                                                        <div class="col"></div>
                                                        <div class="col">
                                                            <p class="testing-error-item-label">New Offer</p>
                                                            <p class="testing-new-offer-price">£{!!$tradein->bamboo_price!!}</p>
                                                        </div>
                                                        <div class="col">


                                                            @if($tradein->isPinLocked())
                                                                <div class="btn btn-green testing-action-btn m-auto" data-toggle="modal" data-target="#pinModal">
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
                                                                <a href="#" class="btn btn-orange testing-action-btn mt-1">
                                                                    <p>Accept Faulty Offer</p>
                                                                    <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                                                                </a>
                                                                <a href="#" class="btn btn-jade testing-action-btn">
                                                                    <p>Return my Device</p>
                                                                    <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                                                                </a>

                                                            @elseif($tradein->isFimpLocked())
                                                            
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
                                                            @elseif($tradein->isGoogleLocked())
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
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- todo these pls --}}
                                                @if($tradein->wrongDevice() || $tradein->wrongMemory() || $tradein->wrongNetwork())
                                                    <div class="testing-error-item">
                                                        <div class="col">
                                                            <p class="testing-error-item-label">Condition</p>
                                                            <p class="testing-error-item-bold">Device does not meet the following requirements: </p>
                                                            <br>
                                                            <p class="testing-error-item-bold">{!!$tradein->getBambooStatus()!!}</p>
                                                        </div>
                                                        <div class="col"></div>
                                                        {{-- <div class="col">
                                                            <p class="testing-error-item-label">New Offer</p>
                                                            <p class="testing-new-offer-price">£ 100</p>
                                                        </div> --}}
                                                        <div class="col">
                                                            <a href="#" class="btn btn-orange testing-action-btn">
                                                                <p>Accept Offer</p>
                                                                <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                                                            </a>
                                                            <a href="#" class="btn btn-jade testing-action-btn">
                                                                <p>Return my Device</p>
                                                                <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @else
                                                    @if($tradein->getTestingFaults() !== null)
                                                        <div class="testing-error-item">
                                                            <div class="col">
                                                                <p class="testing-error-item-label">Issue</p>
                                                                <p class="testing-error-item-bold">{!!$tradein->getTestingFaults()!!}</p>
                                                            </div>
                                                            <div class="col">
                                                                <p class="testing-error-item-label">Action required</p>
                                                                <p class="testing-error-item-bold">Accept faulty offer or request device back</p>
                                                            </div>
                                                            <div class="col"></div>
                                                            <div class="col">
                                                                <p class="testing-error-item-label">New Offer</p>
                                                                <p class="testing-new-offer-price">£ 100</p>
                                                            </div>
                                                            <div class="col">
                                                                <a href="#" class="btn btn-orange testing-action-btn">
                                                                    <p>Accept Offer</p>
                                                                    <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                                                                </a>
                                                                <a href="#" class="btn btn-jade testing-action-btn">
                                                                    <p>Return my Device</p>
                                                                    <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @else
                                                        {{-- @if($tradein->isDowngraded())
                                                            <div class="testing-error-item">
                                                                <div class="col">
                                                                    <p class="testing-error-item-label">Issue</p>
                                                                    <p class="testing-error-item-bold">Device grade downgraded</p>
                                                                </div>
                                                                <div class="col">
                                                                    <p class="testing-error-item-label">Action required</p>
                                                                    <p class="testing-error-item-bold">Accept new offer or request device back</p>
                                                                </div>
                                                                <div class="col"></div>
                                                                <div class="col">
                                                                    <p class="testing-error-item-label">New Offer</p>
                                                                    <p class="testing-new-offer-price">£ 100</p>
                                                                </div>
                                                                <div class="col">
                                                                    <a href="#" class="btn btn-orange testing-action-btn">
                                                                        <p>Accept Offer</p>
                                                                        <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                                                                    </a>
                                                                    <a href="#" class="btn btn-jade testing-action-btn">
                                                                        <p>Return my Device</p>
                                                                        <img class="testing-action-img" src="{{asset('customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @else
                                                            
                                                        @endif --}}
                                                    @endif
                                                @endif
                                            @endif

                                        @endif

                                        @if($tradein->job_state === '9')
                                            <div class="emoji-info-row pt-5 pb-4 pl-4 pt-4">
                                                <div class="emoji-col">
                                                    <img class="emoji-img" src="{{asset('/customer_page_images/body/emoji_winking.svg')}}">
                                                    <p class="emoji-text">Hang tight</p>
                                                </div>
                                                <p class="emoji-info-text">
                                                    Your device is awaiting testing.
                                                </p>
                                            </div>
                                        @endif

                                        @if($tradein->job_state === '10')
                                            <div class="emoji-info-row pt-5 pb-4 pl-4 pt-4">
                                                <div class="emoji-col">
                                                    <img class="emoji-img" src="{{asset('/customer_page_images/body/emoji_laughing.svg')}}">
                                                    <p class="emoji-text">Woohoo!</p>
                                                </div>
                                                <p class="emoji-info-text">
                                                    Your device passed our checks with flying colours.<br>
                                                    Your payment will now be submitted.
                                                </p>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <div id="section-payment" class="sale-item-sections mb-xl-5">
                                <div class="section-item-content">
                                    <div class="section-header">
                                        <p class="section-item-title">Payment</p>
                                        <button class="notbtn" data-toggle="collapse" data-toggle="collapse" data-target="#collapsePayment" aria-expanded="false" aria-controls="collapsePayment">
                                            <p id="payment-detail-text" class="collapse-title">Expand</p>
                                            <img id="payment-details-collapse" class="collapse-up-img" src="{{asset('/customer_page_images/body/collapse-down.svg')}}">
                                        </button>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="collapse" id="collapsePayment">
                                        <div class="customer-orders customer-buying py-3">

                                            @if($tradein->paymentFailed())
                                                <div class="emoji-info-row pt-5 pb-4 pl-4 pt-4">
                                                    <div class="emoji-col">
                                                        <img class="emoji-img" src="{{asset('/customer_page_images/body/emoji_confused.svg')}}">
                                                        <p class="emoji-text">Uh-oh!</p>
                                                    </div>
                                                    <p class="emoji-info-text">
                                                        We have encountered an issue whilst trying to submit your
                                                        payment. Please ensure your payment details are correct.
                                                    </p>
                                                </div>
                                            @endif

                                            @if($tradein->job_state === '25')
                                                <div class="emoji-info-row pt-5 pb-4 pl-4 pt-4">
                                                    <div class="emoji-col">
                                                        <img class="emoji-img" src="{{asset('/customer_page_images/body/emoji_winking.svg')}}">
                                                        <p class="emoji-text">Woohoo!</p>
                                                    </div>
                                                    <p class="emoji-info-text">
                                                        Your device passed our checks with flying colours.
                                                        Your payment will now be submitted.
                                                    </p>
                                                </div>
                                            @endif
    
                                            @if(Auth::user()->hasPaymentDetails())
                                                <div class="row justify-content-center">
                                                    <div class="col-3">
                                                        <p class="m-0">Name on account</p>
                                                        <p style="font-size: 20px;">{!!Auth::user()->accountName()!!}</p>
                                                    </div>
                                                    <div class="col-2">
                                                        <p class="m-0">Account number</p>
                                                        <p style="font-size: 20px;">{!!Auth::user()->accountNumber()!!}</p>
                                                    </div>
                                                    <div class="col-2">
                                                        <p class="m-0">Sort Code</p>
                                                        <p style="font-size: 20px;">{!!Auth::user()->sortCode()!!}</p>
                                                    </div>

                                                    <div class="col-2">
                                                        <p class="payment-price-label">Agreed Price</p>
                                                        <p class="payment-agreed-price">£{!!$tradein->bamboo_price!!}</p>
                                                    </div>
            
                                                    <button type="button" class="btn btn-purple payment-details-btn" style="color: white;" data-toggle="modal" data-target="#accountDetils">
                                                        Re-enter details <img class="payment-pen-icon" src="{{asset('/images/pen.png')}}">
                                                    </button>
                                                </div>
                                            @else
                                                <div class="row justify-content-sm-around">
                                                    <div class="p-1">No payment information added. Please add your payment details.</div>
            
                                                    <button type="button" class="btn btn-purple" style="color: white;" data-toggle="modal" data-target="#accountDetils">
                                                        Enter details
                                                    </button>
                                                </div>
                                            @endif
            
                                            @if(Session::has('account_fails'))
                                                <div class="row justify-content-center">
                                                    <div class="alert alert-danger my-5" role="alert">
                                                        @foreach(Session::get('account_fails') as $message)
                                                            <li>{{$message}}</li>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
            
                                            @if(Session::has('account_success'))
                                                <div class="row justify-content-center">
                                                    <div class="alert alert-success my-5" role="alert">
                                                        {!!Session::get('account_success')!!}
                                                    </div>
                                                </div>
                                            @endif
                            
                                        </div>
            
                                        <!-- Modal -->
                                        <div class="modal fade" id="accountDetils" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered " role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">PAYMENT DETAILS</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true" style="color: black;">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form id="accountdetails" method="POST" action="/userprofile/accountdetails">
                                                        @csrf
                                                        <div class="modal-body p-4">
                                                                <div class="col w-50 m-auto">
                                                                    <label for="account_name" style="font-size: 16px;">Name on Account</label>
                                                                    <input type="text" name="account_name" class="form-control" required aria-label="Amount (to the nearest dollar)">
                                                                </div>
                                                                <div class="col w-50 m-auto">
                                                                    <label for="account_name" style="font-size: 16px;">Account number</label>
                                                                    <input type="number" name="account_number" class="form-control" required aria-label="Amount (to the nearest dollar)">
                                                                </div>
                                                                <div class="col w-50 m-auto">
                                                                    <label for="account_name" style="font-size: 16px;">Sort code</label>
                                                                    <div class="row m-0 justify-content-start">
                                                                        <input type="number" name="sort_code_1" required class="form-control text-center" style="width: 60px;" aria-label="Amount (to the nearest dollar)">
                                                                        <p class="m-3">&mdash;</p>
                                                                        <input type="number" name="sort_code_2" required class="form-control text-center" style="width: 60px;" aria-label="Amount (to the nearest dollar)">
                                                                        <p class="m-3">&mdash;</p>
                                                                        <input type="number" name="sort_code_3" required class="form-control text-center" style="width: 60px;" aria-label="Amount (to the nearest dollar)">
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" style="color: white;" class="btn btn-purple">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>


                <div class="modal fade" id="cancelSaleModal" tabindex="-1" role="dialog" aria-labelledby="cancelSaleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content padded">
                            <div class="validation-modal-header">
                                <img class="close-modal-img ml-auto" src="{{asset('/customer_page_images/body/modal-close.svg')}}" data-dismiss="modal" aria-label="Close">
                                <h5 class="validationModal-title" id="cancelSaleModalLabel">Are you sure?</h5>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="pt-4 pb-2 text-center">
                                This will cancel your order!
                            </div>
                            <div class="modal-footer border-0 p-0 padded mt-4">
                                <a class="btn btn-danger w-25 m-auto" href="/userprofile/deleteorder/{{$tradein->barcode}}">Yes</a>
                                <button type="button" class="btn btn-light w-25 m-auto" data-dismiss="modal" aria-label="Close">No</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
        <footer>@include('customer.layouts.footer', ['showGetstarted' => true])</footer>
    </body>
</html>

<script>

    let payment_updated = "{!!Session::has('account_success')!!}";
    let payment_failed =  "{!!Session::has('account_fails')!!}";
    let notification_resolved = "{!!Session::has('success')!!}"
    if(payment_failed || payment_updated){
        changeSection('section-payment');
        $('#collapsePayment').collapse('show');
    }

    if(notification_resolved){
        changeSection('section-sale-status');
        $('#collapseSaleStatus').collapse('show');
    }

    let buttons = document.getElementsByClassName('change-sales-page');
    for (let index = 0; index < buttons.length; index++) {
        let button = buttons[index];
        button.onclick = function() {changeSection(button.id)};
    }


    $('#collapseSaleStatus').on('hide.bs.collapse', function () {
        document.getElementById("sale-status-collapse-text").innerHTML = "Expand";
        document.getElementById("sale-status-collapse").src = '/customer_page_images/body/collapse-down.svg';
    })
    $('#collapseSaleStatus').on('show.bs.collapse', function () {
        document.getElementById("sale-status-collapse-text").innerHTML = "Collapse";
        document.getElementById("sale-status-collapse").src = '/customer_page_images/body/collapse-up.svg';
    })

    $('#collapseNotifications').on('hide.bs.collapse', function () {
        document.getElementById("notifications-collapse-text").innerHTML = "Expand";
        document.getElementById("notifications-collapse").src = '/customer_page_images/body/collapse-down.svg';
    })
    $('#collapseNotifications').on('show.bs.collapse', function () {
        document.getElementById("notifications-collapse-text").innerHTML = "Collapse";
        document.getElementById("notifications-collapse").src = '/customer_page_images/body/collapse-up.svg';
    })

    $('#collapseSaleDetails').on('hide.bs.collapse', function () {
        document.getElementById("sale-detail-text").innerHTML = "Expand";
        document.getElementById("sale-details-collapse").src = '/customer_page_images/body/collapse-down.svg';
    })
    $('#collapseSaleDetails').on('show.bs.collapse', function () {
        document.getElementById("sale-detail-text").innerHTML = "Collapse";
        document.getElementById("sale-details-collapse").src = '/customer_page_images/body/collapse-up.svg';
    })

    $('#collapseDeliveryDetails').on('hide.bs.collapse', function () {
        document.getElementById("delivery-detail-text").innerHTML = "Expand";
        document.getElementById("delivery-details-collapse").src = '/customer_page_images/body/collapse-down.svg';
    })
    $('#collapseDeliveryDetails').on('show.bs.collapse', function () {
        document.getElementById("delivery-detail-text").innerHTML = "Collapse";
        document.getElementById("delivery-details-collapse").src = '/customer_page_images/body/collapse-up.svg';
    })

    $('#collapseProcessingDetails').on('hide.bs.collapse', function () {
        document.getElementById("processing-detail-text").innerHTML = "Expand";
        document.getElementById("processing-details-collapse").src = '/customer_page_images/body/collapse-down.svg';
    })
    $('#collapseProcessingDetails').on('show.bs.collapse', function () {
        document.getElementById("processing-detail-text").innerHTML = "Collapse";
        document.getElementById("processing-details-collapse").src = '/customer_page_images/body/collapse-up.svg';
    })

    $('#collapseTesting').on('hide.bs.collapse', function () {
        document.getElementById("testing-detail-text").innerHTML = "Expand";
        document.getElementById("testing-details-collapse").src = '/customer_page_images/body/collapse-down.svg';
    })
    $('#collapseTesting').on('show.bs.collapse', function () {
        document.getElementById("testing-detail-text").innerHTML = "Collapse";
        document.getElementById("testing-details-collapse").src = '/customer_page_images/body/collapse-up.svg';
    })

    $('#collapsePayment').on('hide.bs.collapse', function () {
        document.getElementById("payment-detail-text").innerHTML = "Expand";
        document.getElementById("payment-details-collapse").src = '/customer_page_images/body/collapse-down.svg';
    })
    $('#collapsePayment').on('show.bs.collapse', function () {
        document.getElementById("payment-detail-text").innerHTML = "Collapse";
        document.getElementById("payment-details-collapse").src = '/customer_page_images/body/collapse-up.svg';
    })


    $('#select-pattern-lock').on('click', function () {
        $('#select-lock-option').addClass('hidden');
        $('#pinPatternModalLabel').html('ENTER PATTERN SEQUENCE');
        $('#pattern-lock').removeClass('hidden');
        $('#select-lock-back').removeClass('hidden');
    })

    $('#select-pin-lock').on('click', function () {
        $('#select-lock-option').addClass('hidden');
        $('#pinPatternModalLabel').html('ENTER PATTERN SEQUENCE');
        $('#pin-lock').removeClass('hidden');
        $('#select-lock-back').removeClass('hidden');
    })

    $('#select-lock-back').on('click', function () {
        $('#select-lock-option').removeClass('hidden');
        $('#pinPatternModalLabel').html('SELECT YOUR OPTION');
        $('#pin-lock').addClass('hidden');
        $('#pattern-lock').addClass('hidden');
    })


    function changeSection(id){
        if(id === 'sales-my'){
            window.localStorage.setItem('backtosales', true);
            window.location.href =  window.location.href.substring(0, window.location.href.length-1);
        }
        const element = document.getElementById(id);
        const offset = -120;
        const bodyRect = document.getElementById('sale-item-container').getBoundingClientRect().top;
        const elementRect = element.getBoundingClientRect().bottom;
        const elementPosition = elementRect - bodyRect;
        const offsetPosition = elementPosition - offset;

        window.scrollTo({
        top: offsetPosition,
        behavior: 'smooth'
        });

        switch (id) {
            case 'sales-status':
                $('#collapseSaleStatus').collapse('show');
                break;
            case 'sales-notifications':
                $('#collapseNotifications').collapse('show');
                break;
            case 'sales-details':
                $('#collapseSaleDetails').collapse('show');
                break;
            case 'sales-delivery':
                $('#collapseDeliveryDetails').collapse('show');
                break;
            case 'sales-processing':
                $('#collapseProcessingDetails').collapse('show');
                break;
            case 'sales-testing':
                $('#collapseTesting').collapse('show');
                break;
            case 'sales-payment':
                $('#collapsePayment').collapse('show');
                break;
            default:
                break;
        }
    }
    
    function print(id){
        $.ajax({
            url: "/userprofile/printlabel/",
            method:"POST",
                data:{
                    _token: "{!! csrf_token() !!}",
                    tradein: id,  
                },
            success:function(response){
                //console.log(response['code'], response.code);
                if(response['code'] == 200){
                    $('#tradein-iframe').attr('src', '/' + response['filename']);
                    $('#label-trade-in-modal').modal('show');
                }
            },
            // error:function(response){
            //     alert(response.responseText);
            // }
        });
    }

</script>