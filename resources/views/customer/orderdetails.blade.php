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

                            <div class="back-to-sales-mobile">
                                <div class="sales-item"><img class="go-left-img" src="{{asset('/customer_page_images/body/go-left.svg')}}">My Sales</div>
                            </div>

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

                                        @include('partial.sale.status', ['tradein' => $tradein])

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
                                        @include('partial.customer.notifications', ['notifications' => $notifications])
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

                                        @include('partial.sale.processing', ['tradein' => $tradein])

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

                                        @include('partial.sale.testing', ['tradein' => $tradein])

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