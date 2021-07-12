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
            line-height: 12pt !important;
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
            top: 135.05pt;
            left: 67.07pt;
        }

        #user-data-2{
            position: fixed;
            top: 147.05pt;
            left: 67.07pt;
        }

        #user-data-3{
            position: fixed;
            top: 159.05pt;
            left: 67.07pt;
        }

        #date-data-1{
            position: fixed;
            top: 87.46pt;
            left: 483.53pt;
            text-align: left;
            width: 50pt;
            max-width: 50pt;
        }

        #date-data-2{
            position: fixed;
            top: 99.46pt;
            left: 487.26pt;
            text-align: left;
            width: 50pt;
            max-width: 50pt;
        }

        #date-data-3{
            position: fixed;
            top: 111.46pt;
            left: 483.53pt;
            text-align: left;
            width: 50pt;
            max-width: 50pt;
        }

        #barcode-data-image{
            position: fixed;
            top: 148pt;
            left: 491.23pt;
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
            top: 202pt;
            left: 66pt;
        }

        #thank-you{
            position: fixed;
            left: 66pt;
            top:226.58pt;
        }

        #expiry-date{
            position: fixed;
            top: 238.58pt;
            left: 232pt;
        }

        #reach-us{
            position: fixed;
            top: 238.58pt;
            left: 66pt;
        }

        #price-change{
            position: fixed;
            top: 238.58pt;
            left: 277pt;
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
            top: 387.48pt;
            left: 424.12pt;
        }

        #total-order-data{
            position: fixed;
            top: 387.48pt;
            left: 67.12pt;
        }

        #vertical-barcode-text{
            font-size: 7pt !important;
            line-height: 7pt !important;
            position: fixed;
            height: 14pt;
            width: 40pt;
            left: 114.148pt;
            top: 642.066pt;

            transform: rotate(90deg);
            transform-origin: center;
        }

        #vertical-barcode-image{
            position: fixed;
            height: 14pt;
            width: 60pt;
            left: 90.148pt;
            top: 707.419pt;

            transform: rotate(90deg);
            transform-origin: center;
        }

        #delivery-note-image{
            position: fixed;
            top: 68pt;
            left: 30pt;
            width: 26.6pt;
            height: 20.52pt;
        }

        #delivery-note-image img{
            width: 26.6pt;
            height: 20.52pt;
        }

        #delivery-note-text{
            position: fixed;
            top: 73.28pt;
            left: 66.04pt;
            font-size: 18pt !important;
            line-height: 21.6pt !important;
        }

        #pre-date-data-1{
            position: fixed;
            top: 89pt;
            left: 349pt;
        }

        #pre-date-data-2{
            position: fixed;
            top: 100pt;
            left: 349pt;
        }

        #pre-date-data-3{
            position: fixed;
            top: 112pt;
            left: 349pt;
        }

        .black-line{
            border-bottom: 1pt solid #000;
            position: fixed;
            width: 407pt;
            left: 67pt;
        }

        #black-line-1{
            top: 261pt;
        }

        #black-line-2{
            top: 389.72pt;
        }

        #black-line-3{
            top: 406.62pt;
        }

        #product-data-price-template{
            position: fixed;
            left: 237.2pt;
            top: 261.48pt;
        }

        #product-data-quantity-template{
            position: fixed;
            left: 329.12pt;
            top: 261.48pt;
        }

        #product-data-total-price-template{
            position: fixed;
            left: 424.12pt;
            top: 261.48pt;
        }

        #thank-you-note{
            position: fixed;
            top: 407.89pt;
            left: 67pt;
        }

        #product-1-name{
            position: fixed;
            top: 272.48pt;
            left: 67.12pt;
        }

        #product-1-network{
            position: fixed;
            top: 284.48pt;
            left: 67.12pt;
        }

        #product-1-memory{
            position: fixed;
            top: 296.48pt;
            left: 67.12pt;
        }

        #product-1-grade{
            position: fixed;
            top: 308.48pt;
            left: 67.12pt;
        }

        #product-1-price{
            position: fixed;
            top: 296.48pt;
            left: 237.2pt;
        }

        #product-1-quantity{
            position: fixed;
            top: 296.48pt;
            left: 329.12pt;
        }

        #product-1-total-price{
            position: fixed;
            top: 296.48pt;
            left: 424.12pt;
        }

        #product-2-name{
            position: fixed;
            top: 327.48pt;
            left: 67.12pt;
        }

        #product-2-network{
            position: fixed;
            top: 342.48pt;
            left: 67.12pt;
        }

        #product-2-memory{
            position: fixed;
            top: 354.48pt;
            left: 67.12pt;
        }

        #product-2-grade{
            position: fixed;
            top: 366.48pt;
            left: 67.12pt;
        }

        #product-2-price{
            position: fixed;
            top: 354.48pt;
            left: 237.2pt;
        }

        #product-2-quantity{
            position: fixed;
            top: 354.48pt;
            left: 329.12pt;
        }

        #product-2-total-price{
            position: fixed;
            top: 354.48pt;
            left: 424.12pt;
        }

        #hi-name-print-your-own{
            position: fixed;
            top: 245.499pt;
            left: 66pt;
        }

        #thank-you-print-your-own{
            position: fixed;
            left: 66pt;
            top:270.079pt;
        }

        #reach-us-print-your-own{
            position: fixed;
            top: 282.079pt;
            left: 66pt;
        }

        #expiry-date-print-your-own{
            position: fixed;
            top: 282.079pt;
            left: 232pt;
        }

        #price-change-print-your-own{
            position: fixed;
            top: 282.079pt;
            left: 277pt;
        }

        #black-line-1-print-your-own{
            top: 322.837pt;
        }

        #black-line-2-print-your-own{
            top: 452.534pt;
        }

        #black-line-3-print-your-own{
            top: 469.434pt;
        }

        #product-data-price-template-print-your-own{
            position: fixed;
            left: 237.2pt;
            top: 324.294pt;
        }

        #product-data-quantity-template-print-your-own{
            position: fixed;
            left: 329.12pt;
            top: 324.294pt;
        }

        #product-data-total-price-template-print-your-own{
            position: fixed;
            left: 424.12pt;
            top: 324.294pt;
        }

        #product-1-name-print-your-own{
            position: fixed;
            top: 335.294+pt;
            left: 67.12pt;
        }

        #product-1-network-print-your-own{
            position: fixed;
            top: 347.294pt;
            left: 67.12pt;
        }

        #product-1-memory-print-your-own{
            position: fixed;
            top: 359.294pt;
            left: 67.12pt;
        }

        #product-1-grade-print-your-own{
            position: fixed;
            top: 371.294pt;
            left: 67.12pt;
        }

        #product-1-price-print-your-own{
            position: fixed;
            top: 359.294pt;
            left: 237.2pt;
        }

        #product-1-quantity-print-your-own{
            position: fixed;
            top: 359.294pt;
            left: 329.12pt;
        }

        #product-1-total-price-print-your-own{
            position: fixed;
            top: 359.294pt;
            left: 424.12pt;
        }

        #product-2-name-print-your-own{
            position: fixed;
            top: 390.294pt;
            left: 67.12pt;
        }

        #product-2-network-print-your-own{
            position: fixed;
            top: 405.294pt;
            left: 67.12pt;
        }

        #product-2-memory-print-your-own{
            position: fixed;
            top: 417.294pt;
            left: 67.12pt;
        }

        #product-2-grade-print-your-own{
            position: fixed;
            top: 429.294pt;
            left: 67.12pt;
        }

        #product-2-price-print-your-own{
            position: fixed;
            top: 417.294pt;
            left: 237.2pt;
        }

        #product-2-quantity-print-your-own{
            position: fixed;
            top: 417.294pt;
            left: 329.12pt;
        }

        #product-2-total-price-print-your-own{
            position: fixed;
            top: 417.294pt;
            left: 424.12pt;
        }
        
        #total-order-data-print-your-own{
            position: fixed;
            top: 450.294pt;
            left: 67.12pt;
        }

        #total-order-price-print-your-own{
            position: fixed;
            top: 450.294pt;
            left: 424.12pt;
        }

        #thank-you-note-print-your-own{
            position: fixed;
            top: 589.573pt;
            left: 67pt;
        }

        #bamboo-mobile-logo{
            width: 179.65pt;
            height: 27.27pt;
            position: fixed;
            top: 25.3pt;
            left: 31.18pt;
        }

        #bamboo-mobile-logo img{
            width: 100%;
            height: 100%;
        }

        #bamboo-mobile-telephone{
            position: fixed;
            left: 439.8pt;
            top: 18.271pt;
        }

        #bamboo-mobile-email{
            position: fixed;
            left: 406.95pt;
            top: 30.271pt;
        }

        #bamboo-mobile-web{
            position: fixed;
            left: 471.23pt;
            top: 42.271pt;
        }

        #bamboo-smiling-thing{
            width: 71.08pt;
            height: 71.08pt;
            position: fixed;
            top: 324.21pt;
            left: 492.66pt;

        }

        #bamboo-smiling-thing img{
            width: 100%;
            height: 100%;
        }

        .green{
            color: #7BC232;
        }

        #remember-to-image-container{
            width: 35.47pt;
            height: 35.47pt;
            position: fixed;
            top: 489.46pt;
            left: 67.12pt;
        }

        #remember-to-image-container img{
            width: 100%;
            height: 100%;
        }

        #remember-to{
            position: fixed;
            top: 483.395pt;
            left: 114.54pt;
            font-size: 18pt !important;
            line-height: 21.6pt !important;
        }

        #remember-to-list{
            position: fixed;
            top: 514.331pt;
            left: 95.292pt;
            line-height: 8pt;
        }

        #queen-thing-image-container{
            width: 27.45pt;
            height: 44.83pt;
            position: fixed;
            top: 789.41pt;
            left: 65.98pt;
        }

        #queen-thing-image-container img{
            width: 100%;
            height: 100%;
        }

        #queen-thing-text-1{
            position: fixed;
            left: 102.49pt;
            top: 792.311pt;
            font-size: 6.5pt;
        }

        #queen-thing-text-2{
            position: fixed;
            left: 102.49pt;
            top: 800.111pt;
            font-size: 6.5pt;
        }

        #queen-thing-text-3{
            position: fixed;
            left: 102.49pt;
            top: 807.911pt;
            font-size: 6.5pt;
        }

    </style>
</head>

@if(isset($printyourown) && $printyourown)

    <body>

        <div id="bamboo-mobile-logo">
            <img src="{{public_path() . '/images/Group 26.png'}}">
        </div>

        <div id="bamboo-mobile-contact">
            <p id="bamboo-mobile-telephone">Telephone: 0345 582 0511</p>
            <p id="bamboo-mobile-email">Email: info@bamboomobile.co.uk</p>
            <p id="bamboo-mobile-web" class="green bold">bamboomobile.co.uk</p>
        </div>

        <div id="delivery-note-image">
            <img src="{{public_path() . '/images/Group5.png'}}" width="26.6pt" height="20.52pt">
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
            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($tradeins[0]->barcode_original,'C128') }}" height="64.471pt" width="90.588pt" style="margin: 0" />
        </div>

        <div id="hi-name-container-print-your-own">
            <p id="hi-name-print-your-own">Hi {{$tradeins[0]->customerFirstName()}}</p>
    
            <p id="thank-you-print-your-own">Thank you for choosing Bamboo Mobile to SELL your device! Don’t delay in sending</p>
            <p id="reach-us-print-your-own">your device(s). It must reach us by </p>
            <p id="expiry-date-print-your-own" class="bold">{{\Carbon\Carbon::parse($tradeins[0]->expiry_date)->format('d/m/y')}}</p>
            <p id="price-change-print-your-own">or the price offered to you could change.</p>
    
        </div>

        <div id="black-line-1-print-your-own" class="black-line"></div>
        <div id="black-line-2-print-your-own" class="black-line"></div>
        <div id="black-line-3-print-your-own" class="black-line"></div>

        <div id="product-data-print-your-own">

            <div id="product-data-price-template-print-your-own" class="bold">
                <p>Item Price</p>
            </div>
    
            <div id="product-data-quantity-template-print-your-own" class="bold">
                <p>Quantity</p>
            </div>
    
            <div id="product-data-total-price-template-print-your-own" class="bold">
                <p>Total Price</p>
            </div>
    
    
            @if(isset($tradeins[0]))
    
                <p id="product-1-name-print-your-own" class="bold">{{$tradeins[0]->getProductName()}}</p>
                <p id="product-1-network-print-your-own">Network:{{$tradeins[0]->getDeviceNetwork()}}</p>
                <p id="product-1-memory-print-your-own">Memory:{{$tradeins[0]->getDeviceMemory()}}</p>
                <p id="product-1-grade-print-your-own">Grade:{{$tradeins[0]->customer_grade}}</p>
    
                <p id="product-1-price-print-your-own">£{{$tradeins[0]->order_price}}</p>
    
                <p id="product-1-quantity-print-your-own">1</p>
    
                <p id="product-1-total-price-print-your-own" class="bold">£{{$tradeins[0]->order_price}}</p>
    
            @endif
    
            @if(isset($tradeins[1]))
    
                <p id="product-2-name-print-your-own" class="bold">{{$tradeins[1]->getProductName()}}</p>
                <p id="product-2-network-print-your-own">Network:{{$tradeins[1]->getDeviceNetwork()}}</p>
                <p id="product-2-memory-print-your-own">Memory:{{$tradeins[1]->getDeviceMemory()}}</p>
                <p id="product-2-grade-print-your-own">Grade:{{$tradeins[1]->customer_grade}}</p>
    
                <p id="product-2-price-print-your-own">£{{$tradeins[1]->order_price}}</p>
    
                <p id="product-2-quantity-print-your-own">1</p>
    
                <p id="product-2-total-price-print-your-own" class="bold">£{{$tradeins[1]->order_price}}</p>
    
            @endif
    
            <p id="total-order-data-print-your-own">
                <span class="bold">
                    TOTAL
                </span>
                <span>SELL VALUE</span>
            </p>
    
            <p id="total-order-price-print-your-own" class="bold">
                £{{$price}}
            </p> 

            <div id="bamboo-smiling-thing">
                <img src="{{public_path() . '/images/Group 24.png'}}">
            </div>

            <div id="remember-to-container">

                <div id="remember-to-image-container">
                    <img src="{{public_path() . '/images/Group 2.png'}}">
                </div>
                
                <p id="remember-to" class="bold">Remember to</p>

                <ul id="remember-to-list">
                    <li>Erase all contents and factory reset your device(s)</li>
                    <li>Remove iCloud or Google accounts from your device(s)</li>
                    <li>Remove your SIM and memory card</li>
                    <li>Remove any security PIN or pattern locks</li>
                </ul>

            </div>
    
            <div id="thank-you-note-print-your-own">
                <span>
                    Thanks
                </span>
                <span class="bold">Bamboo Mobile</span>
            </div>
    
        </div>

        <div id="queen-thing">
            <div id="queen-thing-image-container">
                <img src="{{public_path() . '/images/queens_gold_logo.png'}}">
            </div>

            <p id="queen-thing-text-1">
                Bamboo Mobile is operated by Bamboo Distribution Ltd, a company registered in England and Wales, whose registered 
            </p>
            <p id="queen-thing-text-2">
                office is at: Unit 5, IO Centre, Lea Road, Waltham Abbey, Hertfordshire, EN9 1AS. Company registration number: 6932822.  
            </p>
            <p id="queen-thing-text-3">
                VAT registration number: 978 0799 49 
            </p>
        </div>
    </body>

@else

<body>

    <div id="delivery-note-image">
        <img src="{{public_path() . '/images/Group5.png'}}" width="26.6pt" height="20.52pt">
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
        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($tradeins[0]->barcode_original,'C128') }}" height="64.471pt" width="90.588pt" style="margin: 0" />
    </div>

    <div id="barcode-data-text">
        <p style="width:88pt; text-align: center; margin:0 auto;">{{$tradeins[0]->barcode_original}}</p>
    </div>

    <div id="hi-name-container">
        <p id="hi-name">Hi {{$tradeins[0]->customerFirstName()}}</p>

        <p id="thank-you">Thank you for choosing Bamboo Mobile to SELL your device! Don’t delay in sending</p>
        <p id="reach-us">your device(s). It must reach us by </p>
        <p id="expiry-date" class="bold">{{\Carbon\Carbon::parse($tradeins[0]->expiry_date)->format('d/m/y')}}</p>
        <p id="price-change">or the price offered to you could change.</p>

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


        @if(isset($tradeins[0]))

            <p id="product-1-name" class="bold">{{$tradeins[0]->getProductName()}}</p>
            <p id="product-1-network">Network:{{$tradeins[0]->getDeviceNetwork()}}</p>
            <p id="product-1-memory">Memory:{{$tradeins[0]->getDeviceMemory()}}</p>
            <p id="product-1-grade">Grade:{{$tradeins[0]->customer_grade}}</p>

            <p id="product-1-price">£{{$tradeins[0]->order_price}}</p>

            <p id="product-1-quantity">1</p>

            <p id="product-1-total-price" class="bold">£{{$tradeins[0]->order_price}}</p>

        @endif

        @if(isset($tradeins[1]))

            <p id="product-2-name" class="bold">{{$tradeins[1]->getProductName()}}</p>
            <p id="product-2-network">Network:{{$tradeins[1]->getDeviceNetwork()}}</p>
            <p id="product-2-memory">Memory:{{$tradeins[1]->getDeviceMemory()}}</p>
            <p id="product-2-grade">Grade:{{$tradeins[1]->customer_grade}}</p>

            <p id="product-2-price">£{{$tradeins[1]->order_price}}</p>

            <p id="product-2-quantity">1</p>

            <p id="product-2-total-price" class="bold">£{{$tradeins[1]->order_price}}</p>

        @endif

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

@endif

</html>