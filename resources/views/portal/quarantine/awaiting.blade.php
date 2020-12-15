<!DOCTYPE html>

<html>

<head>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

   <!-- Sortable -->
   <script src="{{ asset('js/Sort.js') }}"></script>

    <title>Bamboo Recycle::Quarantine Management</title>
    <script src="{{ asset('js/Quarantine.js') }}"></script>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Quarantine Management</p>
                    </div>
                </div>

                <div class="portal-table-container">

                    @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('error')}}
                    </div>
                    @endif
                    <table class="portal-table sortable" id="categories-table">
                        <tr>
                            <td><div class="table-element">Trade-in ID</div></td>
                            <td><div class="table-element">Trade-in Barcode number</div></td>
                            <td><div class="table-element">Product</div></td>
                            <td><div class="table-element">Quarantine reasons</div></td>
                            <td><div class="table-element">Device location</div></td>
                            <td><div class="table-element">Options</div></td>
                        </tr>
                        @foreach($tradeins as $tradein)
                        <tr>
                            <td><div class="table-element">{{$tradein->barcode_original}}</div></td>
                            <td><div class="table-element">{{$tradein->barcode}}</div></td>
                            <td><div class="table-element">{{$tradein->getProductName($tradein->product_id)}}</div></td>
                            <td><div class="table-element">
                                <ul>
                                    @if($tradein->device_correct !== null && !$tradein->device_correct)<li>Device was not correct</li>@endif
                                    @if($tradein->checkmend_passed !== null && !$tradein->checkmend_passed)<li>Phonecheck failed</li>@endif
                                    @if($tradein->older_than_14_days !== null && $tradein->older_than_14_days)<li>Order was expired after 14 days</li>@endif
                                    @if($tradein->device_missing)<li>Device is missing from order</li>@endif
                                    @if($tradein->bamboo_grade !== null && $tradein->product_state !== $tradein->bamboo_grade) <li>Device grade was downgraded</li> @endif
                                    @if($tradein->fimp !== null && $tradein->fimp) <li>Device has FIMP or Google lock</li> @endif
                                    @if($tradein->pinlocked !== null && $tradein->pinlocked) <li>Device was pin locked</li> @endif
                                    @if($tradein->device_correct !== null && ($tradein->product_id !== $tradein->device_correct)) <li> Incorrect device received. This device is {{$tradein->getProductName($tradein->device_correct)}} .</li> @endif
                                </ul>
                            </div></td>
                            <td><div class="table-element"><p>Device is in a tray <a href="/portal/trays/tray/?tray_id_scan={{$tradein->getTrayid($tradein->id)}}">{{$tradein->getTrayName($tradein->id)}}</a></p></div></td>
                            <td><div class="table-element">

                                <a title="Return device to testing" href="/totesting/{{$tradein->id}}">
                                    <i class="fa fa-times" style="color:black !important;"></i>
                                </a>

                                <a href="/portal/trays/tray/printlabel/{{$tradein->barcode}}">
                                    <i class="fa fa-print"></i>
                                </a>

                                <a href="/portal/customer-care/trade-in/{{$tradein->barcode}}" title="View tradein details">
                                    <i class="fa fa-search"></i>
                                </a>

                                <a href="javascript:void(0)" onclick = sendToReturn({{$tradein->barcode}}) title="Mark device to return to customer">
                                    <i class="fa fa-times" style="color:red !important;"></i>
                                </a>

                                <form id="send_to_retest_form_{{$tradein->id}}" class="form-hidden" method="post" action="/portal/quarantine/markdevicetoretest">
                                    @csrf

                                    <input type="hidden" name="tradein_id" value="{{$tradein->id}}">
                                    <input type="submit" id="send_to_retest_button_{{$tradein->id}}">
                                </form>

                                <form id="send_to_return_form_{{$tradein->id}}" class="form-hidden" method="post" action="/portal/quarantine/markdevicetoreturn">
                                    @csrf

                                    <input type="hidden" name="tradein_id" value="{{$tradein->id}}">
                                    <input type="submit" id="send_to_return_button_{{$tradein->id}}">
                                </form>

                            </div></td>
                        </tr>
                        @endforeach
                    </table>
                </div>

            </div>

        </div>
    </main>

</body>
<script>

$(document).ready(function(){

    var elem = $('.portal-links-container > .portal-header-element')[3];
    
    console.log(elem.children[0]);

    elem.children[0].style.color = "#fff";
    elem.children[0].children[0].style.opacity = 1;

});

</script>


</html>
