<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- jQuery -->
        <script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			  crossorigin="anonymous"></script>

        
        <title>Bamboo Mobile</title>

        <link rel="icon" type="image/png" sizes="96x96" href="/customer_page_images/header/favicon-96x96.png">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

        <script src="https://try.access.worldpay.com/access-checkout/v1/checkout.js"></script>
        <script src="{{ asset('/js/Payment.js')}} "></script>
        <script src="https://cdn.worldpay.com/v1/worldpay.js"></script>
    </head>
    <body>
        <header>@include('customer.layouts.header')</header>
        <main>
            <div class="shop-top-header" style="margin: 0;">
                <div class="center-title-container">
                    <div class="let-top-container">
                        <div class="center-title-container">
                            <p> Confirmation </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart-breadcrumbs p-3 ml-5">
                <p class="black-cart-info-text m-0 mr-2">Basket</p>
                <img class="mr-2 ml-2" src="{{asset('/images/front-end-icons/arrow_right_black.svg')}}">
                <p class="black-cart-info-text m-0 ml-2 mr-2">Your details</p>
                <img class="mr-2 ml-2" src="{{asset('/images/front-end-icons/arrow_right_black.svg')}}">
                <p class="black-cart-info-text m-0 ml-2">Confirmation</p>
            </div>
                
                <div class="confirmation-info-col">
                    <img class="confirmation-woohoo-img" src="{{asset('/customer_page_images/body/emoji_winking.svg')}}">
                    <p class="confirmation-info-text-bold-large mt-2 mb-2 pl-2 pr-2 text-center">Wohoo! Your device is sold</p>
                    <p class="confirmation-info-text-bold-smaller mb-2 pl-2 pr-2 text-center">Thanks for your sale! Your order number is {!!$tradein->barcode!!}</p>
                    <p class="confirmation-info-text-smaller mt-2 pl-2 pr-2 text-center padded">
                        An email order confirmation has been sent which will include all the order details.
                    </p>
                    <p class="confirmation-info-text-smaller mb-4 padded">
                        Check out your Sale Status to see regular up-to-date notifications around your sale.
                    </p>

                    <div class="confirmation-grey mt-4">
                        <p class="confirmation-info-text-bold-medium-large mt-4 mb-5">What happens next?</p>
                        <div class="confirmation-info-row">
                            @if(!$tradein->trade_pack_send_by_customer)
                                <div class="single-box-confirmation mb-5">
                                    <img class="confirmation-info-img" src="{{asset('/customer_page_images/body/free_bamboo_trade_pack.svg')}}">
                                    <p class="confirmation-info-text-bold-smaller mt-4 ml-0">Hold tight! Your Free Trade Pack is on its way to you</p>
                                    <p class="confirmation-info-text mt-2">
                                        Thank you for selling your device with us and ordering a Free Trade Pack – this will be posted via 1st Class post via Royal Mail.<br>
                                        [Please can the icon change for this to reflect a Free Postage label and a postal bag instead of a box. Also change the ‘FREE post pack’ to ‘FREE Trade Pack’]
                                    </p>
                                </div>
                            @else
                                <div class="single-box-confirmation mb-5">
                                    <img class="confirmation-info-img" src="{{asset('/customer_page_images/body/free_print_own_label.svg')}}">
                                    <p class="confirmation-info-text-bold-smaller mt-4 ml-0">Print your postage label and send your device to us</p>
                                    <p class="confirmation-info-text mt-2">
                                        Please click on the link below to create and print off a FREE postage label to affix to your securely packed device with the delivery note.<br>
                                        Packing and Posting Instructions are also available here.
                                    </p>
                                    <!-- labels and delivery notes popup -->
                                    @include('partial.labeldeliverynotes', ['tradein' => $tradein, 'btn_text' => 'Print Your Own Trade Pack & Label'])
                                    {{-- <a class="btn btn-purple mt-4 ml-0" onclick="printPostageLabel()">Print Postage Label <img class="ml-2" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}"></a> --}}

                                </div>
                            @endif
                            <div class="single-box-confirmation mb-5">
                                <img class="confirmation-info-img" src="{{asset('/customer_page_images/body/Icon-Trust.svg')}}">
                                <p class="confirmation-info-text-bold-smaller mt-4 ml-0">Verification process</p>
                                <p class="confirmation-info-text mt-2">
                                    You can check the status of your SELL order at any time using ‘My Bamboo’ section. Click below to take your straight there.
                                </p>
                                <a class="btn btn-orange mt-4 ml-0" href="/userprofile/{{$tradein->id}}" style="color: white;">Check Sale Status <img class="ml-2" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}"></a>
                            </div>
                            <div class="single-box-confirmation mb-5">
                                <img class="confirmation-info-img" src="{{asset('/customer_page_images/body/How-Icon-6.svg')}}">
                                <p class="confirmation-info-text-bold-smaller mt-4 ml-0">Get Paid! Woohoo!</p>
                                <p class="confirmation-info-text mt-2">
                                    Heres the best bit!! Once your device has tested successfully we promise to pay you directly into your bank account on the same day!!<br>
                                    *Mon-Fri, excluding public holidays. Same day payment does not apply to orders received after 2pm 
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="confirmation-speed-up mt-4">
                        <div class="row m-0">
                            <p class="confirmation-info-text-bold-smaller mt-4 mb-3 ml-0">How to speed up your sale:</p>
                        </div>
                        <div class="border-gray"></div>
                        <div class="row m-0">
                            <p class="confirmation-info-text-bold-small ml-0 mt-3 mb-3">Remove any locks from the device. This is typically a Pattern or a PIN number</p>
                            <a class="btn btn-purple mt-auto mb-auto mr-0">How do I remove? <img class="ml-3" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}"></a>
                        </div>
                        <div class="border-gray"></div>
                        <div class="row m-0">
                            <p class="confirmation-info-text-bold-small ml-0 mt-3 mb-3">Remove Find my iPhone and Google Activation</p>
                            <a class="btn btn-purple mt-auto mb-auto mr-0">How do I remove? <img class="ml-3" src="{{asset('/customer_page_images/body/Icon-Arrow-Next-White-Rotated.svg')}}"></a>
                        </div>
                        <div class="border-gray"></div>
                    </div>
                </div>



        <div id="label-trade-in-modal" class="modal fade" tabindex="-1" role="dialog" style="padding-right: 17px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Trade pack label</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="tradein-iframe"></iframe>
                </div>
                </div>
            </div>
		</div>
        

        </main>

    </body>
    <script>

        var rand = Math.floor(10000000 + Math.random() * 900000);
        document.getElementById('order_code').value = rand;


        function printPostageLabel(){
            $.ajax({
                url: "/cart/printtradein",
                method:"POST",
                data:{
                    _token: "{!! csrf_token() !!}",
                    user:{!! Auth::User() !!},
                    tradein:{!! $tradein !!},
                    
                },
                success:function(response){
                    console.log(response['code'], response.code);
                    if(response['code'] == 200){
                        $('#tradein-iframe').attr('src', '/' + response['filename']);
                        $('#label-trade-in-modal').modal('show');
                    }
                },
            });
        }

    </script>
</html>

<script>
    let partnersimg = document.getElementsByClassName('widget_list_portrait');
    for(let p = 0; p < partnersimg.length; p++){
        var a = partnersimg[p];

        switch (a.href) {
            case 'http://pricesagranice.purplematrixhosting.co.uk/author/josh-nikolaus/':
                a.href = 'https://www.direkt-portal.com/';
                a.target = '_black';
                break;

            case 'http://pricesagranice.purplematrixhosting.co.uk/author/goyette-amira/':
                a.href = 'https://www.micromreza.com/';
                a.target = '_black';
                break;
        
            case 'http://pricesagranice.purplematrixhosting.co.uk/author/dayana-wiza/':
                a.href = 'https://radio-feral.ba/';
                a.target = '_blank';
                break;

            case 'http://pricesagranice.purplematrixhosting.co.uk/author/vidal56/':
                a.href = 'https://radioosvit.com/';
                a.target = '_blank';
                break;

            case 'http://pricesagranice.purplematrixhosting.co.uk/author/haylee-mitchell/':
                a.href = 'https://www.trendradio.ba/';
                a.target = '_blank';
                break;
                
            default:
                break;
        }
        
    }

    let partnerstext = document.getElementsByClassName('widget_list_author');
    for(let t = 0; t < partnerstext.length; t++){
        var b = partnerstext[t];

        switch (b.href) {
            case 'http://pricesagranice.purplematrixhosting.co.uk/author/josh-nikolaus/':
                b.href = 'https://www.direkt-portal.com/';
                b.target = '_black';
                break;

            case 'http://pricesagranice.purplematrixhosting.co.uk/author/goyette-amira/':
                b.href = 'https://www.micromreza.com/';
                b.target = '_black';
                break;
        
            case 'http://pricesagranice.purplematrixhosting.co.uk/author/dayana-wiza/':
                b.href = 'https://radio-feral.ba/';
                b.target = '_blank';
                break;

            case 'http://pricesagranice.purplematrixhosting.co.uk/author/vidal56/':
                b.href = 'https://radioosvit.com/';
                b.target = '_blank';
                break;

            case 'http://pricesagranice.purplematrixhosting.co.uk/author/haylee-mitchell/':
                b.href = 'https://www.trendradio.ba/';
                b.target = '_blank';
                break;
                
            default:
                break;
        }
        
    }


</script>