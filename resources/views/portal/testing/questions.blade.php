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
    <script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			  crossorigin="anonymous"></script>

    <title>Bamboo Recycle::Receive Trade-In</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Process Trade-In #{{$tradein->barcode}}</p>
                    </div>
                </div>
                <div class="portal-search-form-container">

                    <div class="d-flex flex-column portal-search-form-container">
                       

                        @if($tradein->received == false)
                        <form action="/portal/testing/receive/settradeinstatus" method="POST" class="d-flex flex-column">

                            @csrf

                            <div class="w-100 p-3">
                                <div class="d-flex w-100">
                                    <div class="d-flex w-75 border p-3"><p class="mr-0 ml-0">Product</p></div>
                                    <div class="d-flex w-25 border p-3"><p>Received</p></div>
                                </div>
                                <div class="d-flex w-100">
                                    <div class="d-flex flex-column w-75 border p-3 align-items-baseline">
                                        <p class="mr-0 ml-0">Product: {{$product->product_name}} - ID {{$tradein->barcode}}</p><br>
                                        <p class="mr-0 ml-0">User grade: {{$tradein->product_state}}</p><br>
                                        <p class="mr-0 ml-0">User: {{$user->first_name}} {{$user->last_name}}</p><br>
                                    </div>
                                    <div class="d-flex w-25 border p-3"><input id="checkbox-received" type="checkbox" name="received"></div>
                                </div>
                                
                            </div>

                            <input type="hidden" name="tradein_id" value="{{$tradein->id}}">

                            <div class="form-group submit-buttons d-flex justify-content-between w-100 p-3">
                                <a href="/portal/testing/receive" style="margin: 0;">
                                    <div class="btn btn-primary btn-blue">
                                        <p style="color: #fff; font-size: 16px; line-height: 24px;">Back</p>
                                    </div>
                                </a>
                                <button id="receive-button" type="submit" class="btn btn-primary btn-blue check-imei" disabled>Receive Product</button>
                            </div>

                        </form>
                        @else
                        <form action="/portal/testing/receive/devicemissing" method="POST" class="d-flex flex-column">

                            @csrf

                            <div class="w-100 p-3">
                                <div class="d-flex w-100">
                                    <div class="d-flex w-50 border p-3"><p class="mr-0 ml-0">Product</p></div>
                                    <div class="d-flex w-50 border p-3"><p>Is device present?</p></div>
                                </div>
                                <div class="d-flex w-100">
                                    <div class="d-flex flex-column w-50 border p-3 align-items-baseline">
                                        <p class="mr-0 ml-0">Product: {{$product->product_name}} - ID {{$tradein->barcode}}</p><br>
                                        <p class="mr-0 ml-0">User grade: {{$tradein->product_state}}</p><br>
                                        <p class="mr-0 ml-0">User: {{$user->first_name}} {{$user->last_name}}</p><br>
                                    </div>
                                    <div class="d-flex w-25 border p-3"><label for="missing-yes">Device is present.</label><input id="missing-yes" type="radio" name="missing" value="present"></div>
                                    <div class="d-flex w-25 border p-3"><label for="missing-yes">Device is not present</label><input id="missing-no" type="radio" name="missing" value="missing"></div>
                                </div>
                                
                            </div>

                            <input type="hidden" name="tradein_id" value="{{$tradein->id}}">

                            <div class="form-group submit-buttons d-flex justify-content-between w-100 p-3">
                                <a href="/portal/testing/receive" style="margin: 0;">
                                    <div class="btn btn-primary btn-blue">
                                        <p style="color: #fff; font-size: 16px; line-height: 24px;">Back</p>
                                    </div>
                                </a>
                                <button id="receive-button" type="submit" class="btn btn-primary btn-blue check-imei">Confirm</button>
                            </div>

                        </form>
                            
                        <form action="/portal/testing/receive/devicecorrect" method="POST" class="d-flex flex-column">

                            @csrf

                            <div class="w-100 p-3">
                                <div class="d-flex w-100">
                                    <div class="d-flex w-50 border p-3"><p class="mr-0 ml-0">Product</p></div>
                                    <div class="d-flex w-50 border p-3"><p>Is device correct?</p></div>
                                </div>
                                <div class="d-flex w-100">
                                    <div class="d-flex flex-column w-50 border p-3 align-items-baseline">
                                        <p class="mr-0 ml-0">Product: {{$product->product_name}} - ID {{$tradein->barcode}}</p><br>
                                        <p class="mr-0 ml-0">User grade: {{$tradein->product_state}}</p><br>
                                        <p class="mr-0 ml-0">User: {{$user->first_name}} {{$user->last_name}}</p><br>
                                    </div>
                                    <div class="d-flex w-25 border p-3"><label for="correct-device-yes">Yes.</label><input id="correct-device-yes" type="radio" name="correct_device" value="yes"></div>
                                    <div class="d-flex w-25 border p-3"><label for="correct-device-no">No.</label><input id="correct-device-no" type="radio" name="correct_device" value="no"></div>
                                </div>
                                
                            </div>

                            <input type="hidden" name="tradein_id" value="{{$tradein->id}}">

                            <div class="form-group submit-buttons d-flex justify-content-between w-100 p-3">
                                <a href="/portal/testing/receive" style="margin: 0;">
                                    <div class="btn btn-primary btn-blue">
                                        <p style="color: #fff; font-size: 16px; line-height: 24px;">Back</p>
                                    </div>
                                </a>
                                <button id="receive-button" type="submit" class="btn btn-primary btn-blue check-imei">Confirm</button>
                            </div>

                        </form>
                        
                        <form action="/portal/testing/receive/deviceimeivisibility" method="POST" class="d-flex flex-column">

                            @csrf

                            <div class="w-100 p-3">
                                <div class="d-flex w-100">
                                    <div class="d-flex w-50 border p-3"><p class="mr-0 ml-0">Product</p></div>
                                    <div class="d-flex w-50 border p-3"><p>Is device IMEI number visible?</p></div>
                                </div>
                                <div class="d-flex w-100">
                                    <div class="d-flex flex-column w-50 border p-3 align-items-baseline">
                                        <p class="mr-0 ml-0">Product: {{$product->product_name}} - ID {{$tradein->barcode}}</p><br>
                                        <p class="mr-0 ml-0">User grade: {{$tradein->product_state}}</p><br>
                                        <p class="mr-0 ml-0">User: {{$user->first_name}} {{$user->last_name}}</p><br>
                                    </div>
                                    <div class="d-flex w-25 border p-3"><label for="visible_imei_yes">Yes.</label><input id="visible_imei_yes" type="radio" name="visible_imei" value="yes"></div>
                                    <div class="d-flex w-25 border p-3"><label for="visible_imei_no">No.</label><input id="visible_imei_no" type="radio" name="visible_imei" value="no"></div>
                                </div>
                                
                            </div>

                            <input type="hidden" name="tradein_id" value="{{$tradein->id}}">

                            <div class="form-group submit-buttons d-flex justify-content-between w-100 p-3">
                                <a href="/portal/testing/receive" style="margin: 0;">
                                    <div class="btn btn-primary btn-blue">
                                        <p style="color: #fff; font-size: 16px; line-height: 24px;">Back</p>
                                    </div>
                                </a>
                                <button id="receive-button" type="submit" class="btn btn-primary btn-blue check-imei">Confirm</button>
                            </div>

                        </form>

                        <form action="/portal/testing/receive/checkimei" method="POST" class="d-flex flex-column">

                            @csrf

                            <div class="w-100 p-3">
                                <div class="d-flex w-100">
                                    <div class="d-flex w-50 border p-3"><p class="mr-0 ml-0">Product</p></div>
                                    <div class="d-flex w-50 border p-3"><p>Please enter IMEI number</p></div>
                                </div>
                                <div class="d-flex w-100">
                                    <div class="d-flex flex-column w-50 border p-3 align-items-baseline">
                                        <p class="mr-0 ml-0">Product: {{$product->product_name}} - ID {{$tradein->barcode}}</p><br>
                                        <p class="mr-0 ml-0">User grade: {{$tradein->product_state}}</p><br>
                                        <p class="mr-0 ml-0">User: {{$user->first_name}} {{$user->last_name}}</p><br>
                                    </div>
                                    <div class="d-flex w-50 border p-3"><input id="imei_number" type="text" name="imei_number"></div>
                                </div>
                                
                            </div>

                            <input type="hidden" name="tradein_id" value="{{$tradein->id}}">

                            <div class="form-group submit-buttons d-flex justify-content-between w-100 p-3">
                                <a href="/portal/testing/receive" style="margin: 0;">
                                    <div class="btn btn-primary btn-blue">
                                        <p style="color: #fff; font-size: 16px; line-height: 24px;">Back</p>
                                    </div>
                                </a>
                                <button id="receive-button" type="submit" class="btn btn-primary btn-blue check-imei">Check IMEI</button>
                            </div>

                        </form>

                        <form action="/portal/testing/receive/checkdevicestatus" method="POST" class="d-flex flex-column">
                            @csrf
                            <div class="form-group">
                                <label for="fake_missing_parts">
                                    Does device has any fake or missing parts?
                                </label>
                                <select class="form-control" id="fake_missing_parts" name="fake_missing_parts" required>
                                    <option disabled selected value> -- select an option -- </option>
                                    <option id="fake_missing_parts_false" value="false">No</option>
                                    <option id="fake_missing_parts_true" value="true">Yes</option>
                                </select>
                            </div>

                            <script>
                                
                                $('#fake_missing_parts').change(function(){
                                    var boolval = $(this).val();
                                    if(boolval == "true"){
                                        if(document.getElementById('fake-missing-part-image').classList.contains('form-group-hidden')){
                                            document.getElementById('fake-missing-part-image').classList.remove('form-group-hidden');
                                            document.getElementById('fake_missing_part_image').required = true;
                                        }
                                    }else{
                                        document.getElementById('fake-missing-part-image').classList.add('form-group-hidden');
                                        document.getElementById('fake_missing_part_image').required = false;
                                    }

                                });

                            </script>

                            <div class="form-group form-group-hidden w-50" id="fake-missing-part-image">
                                <input type="file" id="fake_missing_part_image" name="fake_missing_part_image" accept="image/*">
                            </div>

                            <div class="form-group">
                                <label for="device_fully_functional">
                                    Is device fully functional?
                                </label>
                                <select class="form-control" id="device_fully_functional" name="device_fully_functional" required>
                                    <option disabled selected value> -- select an option -- </option>
                                    <option id="device_fully_functional_false" value="false">No</option>
                                    <option id="device_fully_functional_true" value="true">Yes</option>
                                </select>
                            </div>

                            <script>
                                
                                $('#device_fully_functional').change(function(){
                                    var boolval = $(this).val();
                                    if(boolval == "false"){
                                        if(document.getElementById('device-fully-functional-options').classList.contains('form-group-hidden')){
                                            document.getElementById('device-fully-functional-options').classList.remove('form-group-hidden');
                                            document.getElementById('device_fully_functional_reasons').required = true;
                                        }
                                    }else{
                                        document.getElementById('device-fully-functional-options').classList.add('form-group-hidden');
                                        document.getElementById('device_fully_functional_reasons').required = false;
                                    }

                                });

                            </script>

                            <div class="form-group form-group-hidden w-50" id="device-fully-functional-options">
                                <label for="device_fully_functional_reasons">Please rectify reason for device not being fully functional?</label>
                                <select class="form-control" id="device_fully_functional_reasons" name="device_fully_functional_reasons">
                                    <option disabled selected value> -- select an option -- </option>
                                    <option value="option1">option1</option>
                                    <option value="option2">option2</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="water_damage">
                                    Does device have any signs of water damage?
                                </label>
                                <select class="form-control" id="water_damage" name="water_damage" required>
                                    <option disabled selected value> -- select an option -- </option>
                                    <option id="water_damage_false" value="false">No</option>
                                    <option id="water_damage_true" value="true">Yes</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="fimp_or_google_lock">
                                    Does device has FIMP or Google Lock?
                                </label>
                                <select class="form-control" id="fimp_or_google_lock" name="fimp_or_google_lock" required>
                                    <option disabled selected value> -- select an option -- </option>
                                    <option id="fimp_or_google_lock_false" value="false">No</option>
                                    <option id="fimp_or_google_lock_true" value="true">Yes</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="pin_lock">
                                    Does device have PIN lock?
                                </label>
                                <select class="form-control" id="pin_lock" name="pin_lock" required>
                                    <option disabled selected value> -- select an option -- </option>
                                    <option id="pin_lock_false" value="false">No</option>
                                    <option id="pin_lock_true" value="true">Yes</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="device_cosmetic_connection">
                                    What is device cosmetic connection?
                                </label>
                                <textarea id="device_cosmetic_connection" name="device_cosmetic_connection" class="form-control" required></textarea>
                            </div>

                            <input type="hidden" name="tradein_id" value="{{$tradein->id}}">

                            <div class="form-group submit-buttons d-flex justify-content-between w-100 p-3">
                                <a href="/portal/testing/receive" style="margin: 0;">
                                    <div class="btn btn-primary btn-blue">
                                        <p style="color: #fff; font-size: 16px; line-height: 24px;">Back</p>
                                    </div>
                                </a>
                                <button id="receive-button" type="submit" class="btn btn-primary btn-blue check-imei">Potvrdi</button>
                            </div>

                            <div class="form-group submit-buttons d-flex justify-content-between w-100 p-3">
                                <a class="btn btn-primary btn-blue" href="/portal/testing/receive/{{$tradein->id}}/1/report">View Report</a>
                            </div>
                        </form>
                        @endif

                            
                        <div class="container d-flex flex-column">
                            <h3>Order status:</h3>
                            <div class="d-flex">
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">Order id:</p><br>
                                    <p class="text-center">{{$tradein->id}}</p>
                                </div>
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">Order code:</p><br>
                                    <p class="text-center">{{$tradein->barcode}}</p>
                                </div>
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">Product name:</p><br>
                                    <p class="text-center">{{$product->product_name}}</p>
                                </div>
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">Customer product grade:</p><br>
                                    <p class="text-center">{{$tradein->product_state}}</p>
                                </div>
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">Order received?</p><br>
                                    <p class="text-center">@if($tradein->received) Yes @else No @endif</p>
                                </div>
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">Is device missing?</p><br>
                                    <p class="text-center">@if($tradein->missing) Yes @else No @endif</p>
                                </div>
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">Is device correct?</p><br>
                                    <p class="text-center">@if($tradein->device_correct) Yes @else No @endif</p>
                                </div>
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">Is device IMEI number visible?</p><br>
                                    <p class="text-center">@if($tradein->visible_imei) Yes @else No @endif</p>
                                </div>
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">IMEI Number status</p><br>
                                    <p class="text-center">@if(!$tradein->checkmend_passed) Passed @else Failed @endif</p>
                                </div>
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">Is device marked as risk?</p><br>
                                    <p class="text-center">@if($tradein->marked_as_risk) Yes @else No @endif</p>
                                </div>
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">Is device marked for quarantine?</p><br>
                                    <p class="text-center">@if(!$tradein->marked_for_quarantine) Yes @else No @endif</p>
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">Order id:</p><br>
                                    <p class="text-center">{{$tradein->id}}</p>
                                </div>
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">Order code:</p><br>
                                    <p class="text-center">{{$tradein->barcode}}</p>
                                </div>
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">Product name:</p><br>
                                    <p class="text-center">{{$product->product_name}}</p>
                                </div>
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">Customer product grade:</p><br>
                                    <p class="text-center">{{$tradein->product_state}}</p>
                                </div>
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">Order received?</p><br>
                                    <p class="text-center">@if($tradein->received) Yes @else No @endif</p>
                                </div>
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">Is device missing?</p><br>
                                    <p class="text-center">@if($tradein->missing) Yes @else No @endif</p>
                                </div>
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">Is device correct?</p><br>
                                    <p class="text-center">@if($tradein->device_correct) Yes @else No @endif</p>
                                </div>
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">Is device IMEI number visible?</p><br>
                                    <p class="text-center">@if($tradein->visible_imei) Yes @else No @endif</p>
                                </div>
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">IMEI Number status</p><br>
                                    <p class="text-center">@if(!$tradein->checkmend_passed) Passed @else Failed @endif</p>
                                </div>
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">Is device marked as risk?</p><br>
                                    <p class="text-center">@if($tradein->marked_as_risk) Yes @else No @endif</p>
                                </div>
                                <div class="d-flex flex-column border p-1">
                                    <p class="text-center">Is device marked for quarantine?</p><br>
                                    <p class="text-center">@if(!$tradein->marked_for_quarantine) Yes @else No @endif</p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </main>

</body>
<script>

$(document).ready(function(){

    var elem = $('.portal-links-container > .portal-header-element')[4];

    elem.children[0].style.color = "#fff";
    elem.children[0].children[0].style.opacity = 1;

});

$("#checkbox-received").click(function() {
  $("#receive-button").attr("disabled", !this.checked);
});



</script>


</html>
