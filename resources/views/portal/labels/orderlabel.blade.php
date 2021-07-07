<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="charset=utf-8" />
    <style type="text/css">

        @page{
            margin: 0;
            font-size: 10pt;
            width: 100%;
            text-align: left;
        }

        @font-face {
            font-family: "Sharp Sans No1 Medium"; 
            font-style: normal;
            font-weight: 400;
            src: url({{ storage_path('fonts/sansmedium.ttf') }}) format('truetype');
        }

        @font-face {
            font-family: "Sharp Sans No1 Bold"; 
            font-style: normal;
            font-weight: 400;
            src: url({{ storage_path('fonts/SharpSansNo1-Bold.ttf') }}) format('truetype');
        }

        span, p{
            margin: 0;
            font-family: "Sharp Sans No1 Medium";
            line-height: 12px !important;
            font-size: 10pt;
        }

        .bold{
            font-family: "Sharp Sans No1 Bold" !important;
        }

        body{
            font-family: "Sharp Sans No1 Medium" ;
        }

        #user-data-1{
            position: fixed;
            top: 140pt;
            left: 67pt;
        }

        #user-data-2{
            position: fixed;
            top: 152pt;
            left: 67pt;
        }

        #user-data-3{
            position: fixed;
            top: 164pt;
            left: 67pt;
        }

        #date-data-1{
            position: fixed;
            top: 91pt;
            left: 483pt;
            text-align: right;
            width: 50pt;
            max-width: 50pt;
        }

        #date-data-2{
            position: fixed;
            top: 103pt;
            left: 483pt;
            text-align: right;
            width: 50pt;
            max-width: 50pt;
        }

        #date-data-3{
            position: fixed;
            top: 115pt;
            left: 483pt;
            text-align: right;
            width: 50pt;
            max-width: 50pt;
        }

        #barcode-data-image{
            position: fixed;
            top: 148pt;
            left: 484pt;
            width: 87pt;
            height: 62pt;
        }

        #barcode-data-text{
            position: fixed;
            text-align: center;
            top: 195pt;
            left: 470pt;
            width: 87pt;
            height: 62pt;
        }

        #hi-name{
            position: fixed;
            top: 206pt;
            left: 66pt;
        }

        #expiry-date{
            position: fixed;
            top: 242pt;
            left: 232pt;
        }

        .product-data-class{
            position: fixed;
            top: 276pt;
            left: 67pt;
        }

        #product-price-p{
            left: 237pt;
        }

        #product-quantity-p{
            left: 329pt;
        }

        #total-price-p{
            left: 424pt;
        }

        #total-order-price{
            position: fixed;
            top: 414pt;
            left: 424pt;
        }

        #total-order-data{
            position: fixed;
            top: 414pt;
            left: 67pt;
        }

        #vertical-barcode-text{
            font-size: 7pt !important;
            position: fixed;
            transform: rotate(90deg);
            width: 80pt;
            height: 15pt;
            left: 130pt;
            top: 595pt;
        }

        #vertical-barcode-image{
            position: fixed;
            transform: rotate(90deg);
            width: 80pt;
            height: 15pt;
            left: 122pt;
            top: 645pt;
        }

        #delivery-note-image{
            position: fixed;
            top: 68pt;
            left: 30pt;
            width: 27pt;
            height: 21pt;
        }

        #delivery-note-text{
            position: fixed;
            top: 70pt;
            left: 66pt;
            font-size: 18px !important;
            line-height: 21.6px !important;
        }

        #pre-date-data-1{
            position: fixed;
            top: 91pt;
            left: 349pt;
        }

        #pre-date-data-2{
            position: fixed;
            top: 103pt;
            left: 349pt;
        }

        #pre-date-data-3{
            position: fixed;
            top: 115pt;
            left: 349pt;
        }

        .black-line{
            border-bottom: 1px solid #000;
            position: fixed;
            width: 408pt;
            left: 67pt;
        }

        #black-line-1{
            top: 262pt;
        }

        #black-line-2{
            top: 414pt;
        }

        #black-line-3{
            top: 428pt;
        }

        #product-data-price-template{
            position: fixed;
            left: 237pt;
            top: 264pt;
        }

        #product-data-quantity-template{
            position: fixed;
            left: 329pt;
            top: 264pt;
        }

        #product-data-total-price-template{
            position: fixed;
            left: 424pt;
            top: 264pt;
        }

        #thank-you-note{
            position: fixed;
            top: 430pt;
            left: 67pt;
        }

    </style>
</head>

<body>

    <div id="delivery-note-image">
        <img src="{{public_path() . '/images/Group5.png'}}" width="27" height="21">
    </div>
    <div id="delivery-note-text">
        <p class="bold">Delivery Note</p>
    </div>

    <p style="display: none">
        {{$price = 0}}

        @foreach ($tradeins as $tradein)
            {{$price += $tradein->order_price}}
        @endforeach
    </p>
   
    <div id="user-data-1">

        <p>{{$tradeins[0]->customerName()}}</p>

    </div>

    <div id="user-data-2">

        <p>{{$tradeins[0]->addressLine()}}</p>

    </div>

    <div id="user-data-3">

        <p>{{$tradeins[0]->addressLastLine()}}</p>

    </div>

    <div id="pre-date-data-1">

        <p>Order Date:</p>

    </div>

    <div id="pre-date-data-2">

        <p>Trade-in ID:</p>

    </div>

    <div id="pre-date-data-3">

        <p>Order Expiry date:</p>

    </div>


    <div id="date-data-1">

        <p>{{\Carbon\Carbon::parse($tradeins[0]->created_at)->format('d/m/y')}}</p>

    </div>

    <div id="date-data-2">

        <p>{{$tradeins[0]->barcode}}</p>

    </div>

    <div id="date-data-3">

        <p>{{\Carbon\Carbon::parse($tradeins[0]->expiry_date)->format('d/m/y')}}</p>

    </div>

    <div id="barcode-data-image">
        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($tradeins[0]->barcode_original,'C128') }}" height="62" width="88" style="margin: 0" />
    </div>

    <div id="barcode-data-text">
        <p style="width:88pt; text-align: center; margin:0 auto;">{{$tradeins[0]->barcode_original}}</p>
    </div>

    <div id="hi-name">
        <p>Hi {{$tradeins[0]->customerFirstName()}}</p><br>
        <span>
            Thank you for choosing Bamboo Mobile to SELL your device! Don’t delay in sending <br> your device(s). It must reach us by 
        </span>
            <span class="bold">{{\Carbon\Carbon::parse($tradeins[0]->expiry_date)->format('d/m/y')}}</span>
        <span>
            or the price offered to you could change.
        </span>
    </div>

    <div id="black-line-1" class="black-line"></div>
    <div id="black-line-2" class="black-line"></div>
    <div id="black-line-3" class="black-line"></div>


    <div id="product-data">

        <div id="product-data-price-template" class="bold">
            <p>Item Price</p>
        </div>

        <div id="product-data-quantity-template" class="bold">
            <p>Quantity</p>
        </div>

        <div id="product-data-total-price-template" class="bold">
            <p>Total Price</p>
        </div>

        <span id="product-data-p" class="product-data-class">
        @foreach($tradeins as $tradein)

           
                <p class="bold">{{$tradein->getProductName()}}</p>
                Network:{{$tradein->getDeviceNetwork()}}<br>
                Memory:{{$tradein->getDeviceMemory()}}<br>
                Grade:{{$tradein->customer_grade}}<br><br>

        @endforeach
        </span>

        <p id="product-price-p" class="product-data-class">
        @foreach($tradeins as $tradein)
            <br><br>
            £{{$tradein->order_price}}<br><br><br><br>

        @endforeach
        </p>

        <p id="product-quantity-p" class="product-data-class">
            @foreach($tradeins as $tradein)
            <br><br>
            1<br><br><br><br>
            @endforeach
        </p>
        

        <p id="total-price-p" class="product-data-class bold">
            @foreach($tradeins as $tradein)
                <br><br>
                £{{$tradein->order_price}}<br><br><br><br>
    
            @endforeach
        </p>

        <p id="total-order-data">
            <span class="bold">
                TOTAL
            </span>
            <span>SELL VALUE</span>
        </p>

        <p id="total-order-price" class="bold">
            £{{$price}}
        </p>

        <p id="vertical-barcode-text">Trade in-ID:<br>
            {{$tradeins[0]->barcode_original}}
        </p>

        <img id="vertical-barcode-image" src="data:image/png;base64,{{ DNS1D::getBarcodePNG($tradeins[0]->barcode_original,'C128') }}" height="15" width="80" style="margin: 0" />



        <div id="thank-you-note">
            <span>
                Thanks
            </span>
            <span class="bold">Bamboo Mobile</span>
        </div>

    </div>

</body>

</html>