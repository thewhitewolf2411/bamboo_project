<!DOCTYPE html>
<html>
<head>
<style type="text/css" media="all">

    @page{
        margin: 10mm;
        font-size: 12pt;
        width: 100%;
        text-align: center;
    }

    p{
        margin: 0  !important;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    .gray-text{
        color: gray;
    }

    .header-text-right{
        text-align: right;
    }

    .header-text-left{
        text-align: left;
    }

    .header-text-center{
        text-align: center;
    }

    .first-table td{
        padding: 0 !important;
    }

    .margin-30{
        margin-top: 30px;
    }

    .ml-0{
        margin-left: 0 !important
    }

    .second-table tr{
        padding: 0 !important;
        width: 100% !important;
    }

    .second-table td{
        padding: 0 !important;
        width: 20% !important;
    }

    .w-75{
        max-width: 75%;
        width: 75%;
    }

    .mb-0{
        margin-bottom: 0 !important;
    }

    .mb-5{
        margin-bottom: 5px !important;
    }

    .third-table{
        border: none !important;
        border-top: 1px solid #000;
        border-bottom: 1px solid #000;
    }

    .third-table tfoot{
        width: 100%;
    }

    .third-table td{
        border:none;
    }

    .third-table tfoot{
        border-top: 1px solid #000;
        border-bottom: 1px solid #000;
    }

    .bold{
        font-weight: 600;
    }

</style>
</head>

<body>
   
    <table class="first-table">
      <tr>
        <td>Bla</td>
        <td></td>
        <td><p class="header-text-right">{{Carbon\Carbon::now()->format('d/m/Y')}}</p></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td><p class="header-text-right">{{$tradeins[0]->barcode_original}}</p></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td><p class="header-text-right">{{Carbon\Carbon::parse($tradeins[0]->expiry_date)->format('d/m/Y')}}</p></td>
      </tr>
    </table>
    <table class="second-table margin-30">
        <tr>
          <td><p class="header-text-left">{{$tradeins[0]->customerName()}}<br>{{$tradeins[0]->addressLastLine()}}<br>{{$tradeins[0]->addressLine()}}</p></td>
          <td></td>
          <td></td>
          <td></td>
          <td><img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($tradeins[0]->barcode_original,'C128') }}" height="80" width="100%" /><br><p class="header-text-center">{{ $tradeins[0]->barcode_original,'C128' }}</p></td>
        </tr>
    </table>

    <div class="margin-30 w-75">

        <p class="header-text-left ml-0">Hi {{$tradeins[0]->customerFirstName()}}</p>
        <p class="header-text-left ml-0">Thank you for choosing Bamboo Mobile to SELL your device! Don’t delay in sending your device(s). It must reach us by {{Carbon\Carbon::parse($tradeins[0]->expiry_date)->format('d/m/Y')}} or the price offered to you could change.</p>

    </div>

    <p style="display: none">
        {{$price = 0}}
    </p>
    
    <table class="third-table margin-30">
        <thead>
            <tr>
                <th style="width: 40%;" class="header-text-center"></th>
                <th style="width: 20%;" class="header-text-center">Item Price</th>
                <th style="width: 20%;" class="header-text-center">Quantity</th>
                <th style="width: 20%;" class="header-text-center">Total price</th>
            </tr>

        </thead>
        <tbody>
            @foreach ($tradeins as $tradein)
                <tr class="mb-5">
                    <td style="width: 40%;"><p class="bold header-text-left mb-0">{{$tradein->getProductName()}}</p><p class="header-text-left mb-0">Network:{{$tradein->getDeviceNetwork()}}</p><p class="header-text-left mb-0">Memory:{{$tradein->getDeviceMemory()}}</p><p class="header-text-left mb-0">Grade:{{$tradein->customer_grade}}</p></td>
                    <td style="width: 20%;"><p class="header-text-center">£{{$tradein->order_price}}</p></td>
                    <td style="width: 20%;"><p class="header-text-center">1</p></td>
                    <td style="width: 20%;"><p class="header-text-center">£{{$tradein->order_price}}</p></td>
                    {{$price += $tradein->order_price}}
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <td style="width: 40%;"><span class="bold header-text-center">TOTAL </span><span>SELL value</span></td>
            <td style="width: 20%;"></td>
            <td style="width: 20%;"></td>
            <td style="width: 20%;"><p class="header-text-center">£ {{$price}}</p></td>
        </tfoot>

    </table>

    <table class="fourth-table margin-30">
        <tr>
            <td><img src="./sell_images/image-3-bw.png" width="80px" height="80px"></td>
            <td><h1>Remember to</h1>
                <ul>
                    <li>Erase all contents and factory reset your device(s)</li>
                    <li>Remove iCloud or Google accounts from your device(s)</li>
                    <li>Remove your SIM and memory card</li>
                    <li>Remove any security PIN or pattern locks</li>
                </ul>
            </td>
        </tr>
    </table>
    
    <div class="margin-30 w-75 header-text-left">
        <span class="header-text-left">Thanks </span><span class="header-text-left bold">Bamboo Mobile</span>
    </div>

</body>

</html>