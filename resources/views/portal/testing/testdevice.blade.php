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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset('js/Testing.js') }}"></script>


    <title>Bamboo Recycle::Test Device</title>
</head>

<body class="portal-body">

    <header>@include('portal.layouts.header')</header>

    <main class="portal-main">
        <div class="app">
            <div class="portal-app-container">
                <div class="portal-title-container">
                    <div class="portal-title">
                        <p>Test Device</p>
                    </div>
                </div>

                <div class="portal-table-container">

                    <table class="portal-table" id="categories-table">
                        <tr>
                            <td><div class="table-element">Trade-in ID</div></td>
                            <td><div class="table-element">Trade-in barcode number</div></td>
                            <td><div class="table-element">Date Placed</div></td>
                            <td><div class="table-element">Product</div></td>
                            <td><div class="table-element">Product Memory</div></td>
                            <td><div class="table-element">Product Network</div></td>
                            <td><div class="table-element">Product IMEI number</div></td>
                            <td><div class="table-element">Customer Grade</div></td>
                        </tr>
                        <tr>
                            <td><div class="table-element">{{$tradein->barcode_original}}</div></td>
                            <td><div class="table-element">{{$tradein->barcode}}</div></td>
                            <td><div class="table-element">{{$tradein->created_at}}</div></td>
                            <td><div class="table-element">{{$tradein->getProductName($tradein->product_id)}}</div></td>
                            <td><div class="table-element">{{$tradein->memory}}</div></td>
                            <td><div class="table-element">{{$tradein->network}}</div></td>
                            <td><div class="table-element">{{$tradein->imei_number}}</div></td>
                            <td><div class="table-element">{{$tradein->product_state}}</div></td>
                        </tr>

                    </table>


                </div>

                <div class="portal-search-form-container">
                    <form action="/portal/testing/receive/checkdevicestatus" method="POST" class="d-flex flex-column">
                        @csrf


                        <div class="form-group">
                            <label for="correct_memory">
                                Is memory size correct?
                            </label>
                            <select class="form-control" id="correct_memory" name="correct_memory" onchange="testingElementChanged()" required>
                                <option disabled selected value> -- select an option -- </option>
                                <option id="correct_memory_false" value="false">No</option>
                                <option id="correct_memory_true" value="true">Yes</option>
                            </select>
                        </div>

                        <div class="form-group form-group-hidden" id="corrent-memory-value">
                            <label for="correct_memory_value">
                                Enter correct memory:
                            </label>
                            <input type="text" class="form-control w-50" name="correct-memory-value">
                        </div>

                        <div class="form-group">
                            <label for="correct_network">
                                Is network correct?
                            </label>
                            <select class="form-control" id="correct_network" name="correct_network" onchange="testingElementChanged()" required>
                                <option disabled selected value> -- select an option -- </option>
                                <option id="correct_network_false" value="false">No</option>
                                <option id="correct_network_true" value="true">Yes</option>
                            </select>
                        </div>

                        <div class="form-group form-group-hidden" id="corrent-network-value">
                            <label for="correct_network_value">
                                Enter correct network:
                            </label>
                            <input type="text" class="form-control w-50" name="correct-network-value">
                        </div>

                        <div class="form-group">
                            <label for="fimp_or_google_lock">
                                Does device have FMIP or Google Lock?
                            </label>
                            <select class="form-control" id="fimp_or_google_lock" name="fimp_or_google_lock" onchange="testingElementChanged()" required>
                                <option disabled selected value> -- select an option -- </option>
                                <option id="fimp_or_google_lock_false" value="false">No</option>
                                <option id="fimp_or_google_lock_true" value="true">Yes</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="pin_lock">
                                Does device have PIN lock?
                            </label>
                            <select class="form-control" id="pin_lock" name="pin_lock" onchange="testingElementChanged()" required>
                                <option disabled selected value> -- select an option -- </option>
                                <option id="pin_lock_false" value="false">No</option>
                                <option id="pin_lock_true" value="true">Yes</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="device_fully_functional">
                                Is device fully functional?
                            </label>
                            <select class="form-control" id="device_fully_functional" name="device_fully_functional" onchange="testingElementChanged()" required>
                                <option disabled selected value> -- select an option -- </option>
                                <option id="device_fully_functional_false" value="false">No</option>
                                <option id="device_fully_functional_true" value="true">Yes</option>
                            </select>
                        </div>


                        <div class="form-group form-group-hidden w-50" id="device-fully-functional-options">
                            <label id="multiselect" for="device_fully_functional_reasons">Please rectify reason for device not being fully functional?</label>
                            <select multiple="" class="form-control" id="device_fully_functional_reasons" name="device_fully_functional_reasons">
                                <option disabled selected value> -- select an option -- </option>
                                <option value="1">Audio Tests</option>
                                <option value="2">Front Microphone</option>
                                <option value="3">Headset Test</option>
                                <option value="4">Loud Speaker Test</option>
                                <option value="5">Microphone Playback Tests</option>
                                <option value="5">Buttons Test</option>
                                <option value="6">Camera test</option>
                                <option value="7">Sensor Test</option>
                                <option value="8">Glass Condition</option>
                                <option value="9">Vibration</option>
                                <option value="10">Original colour</option>
                                <option value="11">Battery health</option>
                                <option value="12">NFC</option>
                                <option value="13">No Power</option>
                                <option value="14">Fake or missing parts</option>
                            </select>

                        </div>
                        

                        <div class="form-group">
                            <label for="water_damage">
                                Does device have any signs of water damage?
                            </label>
                            <select class="form-control" id="water_damage" name="water_damage" onchange="testingElementChanged()" required>
                                <option disabled selected value> -- select an option -- </option>
                                <option id="water_damage_false" value="false">No</option>
                                <option id="water_damage_true" value="true">Yes</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cosmetic_condition">
                                What is the device cosmetic condition?
                            </label>
                            <select class="form-control" id="cosmetic_condition" name="cosmetic_condition" onchange="gradeElementChanged()" disabled required>

                            </select>
                        </div>

                        <div class="form-group d-flex">

                            <div class="form-group w-50">
                                <label for="customer_grade">Customer Grade:</label>
                                <input type="text" id="customer_grade" name="customer_grade" value="{{$tradein->product_state}}" disabled>
                            </div>
                            <div class="form-group w-50">
                                <label for="bamboo_grade">Bamboo Grade:</label>
                                <input type="text" class="form-control" id="bamboo_grade" name="bamboo_grade" style="padding:12px; height:50px; margin-top:6px; margin-bottom:16px; " disabled></input>
                            </div>
                            <input type="hidden" class="form-control" id="bamboo_grade_val" name="bamboo_grade" style="padding:12px; height:50px; margin-top:6px; margin-bottom:16px; "></input>
                        </div>

                        <div class="form-group submit-buttons d-flex justify-content-between w-100 p-3">
                            <a href="/portal/testing/receive" style="margin: 0;">
                                <div class="btn btn-primary btn-blue">
                                    <p style="color: #fff; font-size: 16px; line-height: 24px;">Back</p>
                                </div>
                            </a>
                            <input type="hidden" id="tradein_id" name="tradein_id" value="{{$tradein->id}}">
                            <button id="receive-button" type="submit" class="btn btn-primary btn-blue check-imei">Submit testing</button>
                        </div>
                        
                    </form>
                </div>

            </div>
        </div>
    </main>

<script>
$(document).ready(function() {
$('.mdb-select').materialSelect();
});

</script>
</body>

</html>
