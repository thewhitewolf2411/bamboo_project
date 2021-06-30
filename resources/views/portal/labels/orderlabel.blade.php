<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="charset=utf-8" />
    <style type="text/css">

        @page{
            margin: 10mm;
            font-size: 10px;
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
            line-height: 10px !important;
        }

        .bold{
            font-family: "Sharp Sans No1 Bold" !important;
        }

        body{
            width: 541px;
            height: 727px;
            font-family: "Sharp Sans No1 Medium" ;
        }

        #user-data{
            position: absolute;
            top: 140px;
            left: 67px;
        }

        #date-data{
            position: absolute;
            top: 91px;
            left: 483px;
            text-align: right;
        }

        #barcode-data{
            position: absolute;
            top: 148px;
            left: 484px;
            widows: 87px;
            height: 62px;
        }

        #hi-name{
            position: absolute;
            top: 206px;
            left: 66px;
        }

        #expiry-date{
            position: absolute;
            top: 242px;
            left: 232px;
        }

        .product-data-class{
            position: absolute;
            top: 276px;
            left: 67px;
        }

        #product-price-p{
            left: 237px;
        }

        #product-quantity-p{
            left: 329px;
        }

        #total-price-p{
            left: 424px;
        }

        #total-order-price{
            position: absolute;
            top: 414px;
            left: 424px;
        }

        #total-order-data{
            position: absolute;
            top: 414px;
            left: 67px;
        }

        #vertical-barcode{
            position: absolute;
            transform: rotate(90deg);
            left: 130px;
            bottom: 150px;
            width: 60px;
            height: 146px;
        }

        #delivery-note-image{
            position: absolute;
            top: 68px;
            left: 30px;
            width: 27px;
            height: 21px;
        }

        #delivery-note-text{
            position: absolute;
            top: 68px;
            left: 66px;
            font-size: 18px;
        }

        #pre-date-data{
            position: absolute;
            top: 91px;
            left: 349px;
        }

        .black-line{
            border-bottom: 1px solid #000;
            position: absolute;
            width: 408px;
            left: 67px;
        }

        #black-line-1{
            top: 262px;
        }

        #black-line-2{
            top: 414px;
        }

        #black-line-3{
            top: 428px;
        }

        #product-data-price-template{
            position: absolute;
            left: 237px;
            top: 264px;
        }

        #product-data-quantity-template{
            position: absolute;
            left: 329px;
            top: 264px;
        }

        #product-data-total-price-template{
            position: absolute;
            left: 424px;
            top: 264px;
        }

        #thank-you-note{
            position: absolute;
            top: 430px;
            left: 67px;
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
   
    <div id="user-data">

        <p>{{$tradeins[0]->customerName()}}<br>{{$tradeins[0]->addressLine()}}<br>{{$tradeins[0]->addressLastLine()}}</p>

    </div>

    <div id="pre-date-data" class="bold">

        <p>Order Date:<br>Trade-in ID:<br>Order Expiry date:</p>

    </div>


    <div id="date-data">

        <p>{{\Carbon\Carbon::parse($tradeins[0]->created_at)->format('d/m/y')}}<br>{{$tradeins[0]->barcode}}<br>{{\Carbon\Carbon::parse($tradeins[0]->expiry_date)->format('d/m/y')}}</p>

    </div>

    <div id="barcode-data">

        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($tradeins[0]->barcode_original,'C128') }}" height="62" width="88" style="margin: 0" />
        <p style="width:88px; text-align: center; margin:0 auto;">{{$tradeins[0]->barcode_original}}</p>

    </div>

    <div id="hi-name">
        <p>Hi {{$tradeins[0]->customerFirstName()}}</p><br>
        <p>Thank you for choosing Bamboo Mobile to SELL your device! Don’t delay in sending <br> your device(s). It must reach us by {{\Carbon\Carbon::parse($tradeins[0]->expiry_date)->format('d/m/y')}}  or the price offered to you could change.</p>
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

        <p id="product-data-p" class="product-data-class">
        @foreach($tradeins as $tradein)

           
                {{$tradein->getProductName()}}<br>
                Network:{{$tradein->getDeviceNetwork()}}<br>
                Memory:{{$tradein->getDeviceMemory()}}<br>
                Grade:{{$tradein->customer_grade}}<br><br>

        @endforeach
        </p>

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
        

        <p id="total-price-p" class="product-data-class">
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

        <p id="total-order-price">
            £{{$price}}
        </p>

        <div id="vertical-barcode">
            <p>Trade in-ID:
                {{$tradeins[0]->barcode_original}}
            </p>
            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($tradeins[0]->barcode_original,'C128') }}" height="15" width="150" style="margin: 0" />
        </div>

        <div id="thank-you-note">
            <span>
                Thanks
            </span>
            <span class="bold">Bamboo Mobile</span>
        </div>

    </div>

</body>

</html>