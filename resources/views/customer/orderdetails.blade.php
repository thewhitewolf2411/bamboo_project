<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        {{-- <script src="{{ asset('js/Customer.js') }}"></script> --}}
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
                            <div class="change-sales-page sales-item" id="sales-notifications">
                                Notifications
                                @if(App\Helpers\NotificationHelper::count() !== null) 
                                    <div class="notifications-count menu">
                                        <img src="{{asset('/images/front-end-icons/notification_count.svg')}}">
                                        <p>{!!App\Helpers\NotificationHelper::count()!!}</p>
                                    </div>
                                @endif
                            </div>
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
                                <div class="sales-item" id="back-to-sales-mobile"><img class="go-left-img" src="{{asset('/customer_page_images/body/go-left.svg')}}">My Sales</div>
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
                                        @if(App\Helpers\NotificationHelper::count() !== null) 
                                            <div class="notifications-count positioned collapse-header">
                                                <img src="{{asset('/images/front-end-icons/notification_count.svg')}}">
                                                <p>{!!App\Helpers\NotificationHelper::count()!!}</p>
                                            </div>
                                        @endif
                                        <p class="section-item-title @if(App\Helpers\NotificationHelper::count() !== null)mr-auto @endif">Notifications</p>
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
                                        @include('partial.sale.details', ['tradein' => $tradein])
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
                                        @include('partial.sale.delivery', ['tradein' => $tradein])
                                    </div>
                                </div>
                            </div>

                            <div id="section-processing" class="sale-item-sections mb-2">
                                <div class="section-item-content">
                                    <div class="section-header">
                                        @if(App\Helpers\NotificationHelper::hasProcessingAlerts())
                                            <img class="sale-details-alert" src="{{asset('/customer_page_images/body/error_alert.svg')}}">
                                        @endif
                                        <p class="section-item-title @if(App\Helpers\NotificationHelper::hasProcessingAlerts()) mr-auto @endif">Processing</p>
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
                                        @if(App\Helpers\NotificationHelper::hasTestingAlerts())
                                            <img class="sale-details-alert" src="{{asset('/customer_page_images/body/error_alert.svg')}}">
                                        @endif
                                        <p class="section-item-title @if(App\Helpers\NotificationHelper::hasTestingAlerts()) mr-auto @endif">Testing</p>
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
                                        @if(App\Helpers\NotificationHelper::hasPaymentAlerts())
                                            <img class="sale-details-alert" src="{{asset('/customer_page_images/body/error_alert.svg')}}">
                                        @endif
                                        <p class="section-item-title @if(App\Helpers\NotificationHelper::hasPaymentAlerts()) mr-auto @endif">Payment</p>
                                        <button class="notbtn" data-toggle="collapse" data-toggle="collapse" data-target="#collapsePayment" aria-expanded="false" aria-controls="collapsePayment">
                                            <p id="payment-detail-text" class="collapse-title">Expand</p>
                                            <img id="payment-details-collapse" class="collapse-up-img" src="{{asset('/customer_page_images/body/collapse-down.svg')}}">
                                        </button>
                                    </div>
                                    <div class="line-bottom"></div>
                                    <div class="collapse" id="collapsePayment">
                                        @include('partial.sale.payment', ['tradein' => $tradein])
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- cancel sale modal --}}
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

    document.getElementById('back-to-sales-mobile').addEventListener('click', function(){
        window.localStorage.setItem('backtosales', true);
        window.location.href =  window.location.href.substring(0, window.location.href.length-1);
    });


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

</script>