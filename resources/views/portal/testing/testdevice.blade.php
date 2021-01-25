<!DOCTYPE html>

<html>

<head>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    
    <script src="{{ asset('js/Testing.js') }}"></script>

   <!-- Sortable -->
   <script src="{{ asset('js/Sort.js') }}"></script>


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

                    <table class="portal-table sortable" id="categories-table">
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
                            <td><div class="table-element">{{$tradein->customer_memory}}</div></td>
                            <td><div class="table-element">{{$tradein->customer_network}}</div></td>
                            <td><div class="table-element">{{$tradein->imei_number}}</div></td>
                            <td><div class="table-element">{{$tradein->customer_grade}}</div></td>
                        </tr>

                    </table>


                </div>

                <div class="portal-search-form-container">
                    <form action="/portal/testing/receive/checkdevicestatus" method="POST" class="d-flex flex-column">
                        @csrf

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
                            <label for="device_correct">
                                Is device correct?
                            </label>
                            <select class="form-control" id="device_correct" name="device_correct" onchange="testingElementChanged()" required>
                                <option disabled selected value> -- select an option -- </option>
                                <option id="device_correct_false" value="false">No</option>
                                <option id="device_correct_true" value="true">Yes</option>
                            </select>
                        </div>

                        <div class="form-group form-group-hidden" id="select_correct_device_container">
                            <select class="form-control" id="select_correct_device" data-show-subtext="true" data-live-search="true" name="select_correct_device">
                                <option value="" selected disabled style="color:#000 !important"> -- Select correct device -- </option>
                                @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->product_name}}</option>
                                @endforeach
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

                        <div class="form-group form-group-hidden w-100" id="device-fully-functional-options">
                            <label id="multiselect">Please rectify reason for device not being fully functional?</label>

                            <div class="d-flex flex-wrap my-3" id="device-fully-functional-options-2">
                                <div class="col-md-1 d-flex flex-column align-items-center justify-content-between">
                                <label for="audio_tests">Audio tests</label>
                                <input type="checkbox" class="single-checkbox" name="audio_tests" id="audio_tests" value="true">
                                </div>
                                <div class="col-md-1 d-flex flex-column align-items-center justify-content-between">
                                <label for="front_microphone">Front Microphone</label>
                                <input type="checkbox" class="single-checkbox" name="front_microphone" id="front_microphone" value="true">
                                </div>
                                <div class="col-md-1 d-flex flex-column align-items-center justify-content-between">
                                <label for="headset_test">Headset Test</label>
                                <input type="checkbox" class="single-checkbox" name="headset_test" id="headset_test" value="true">
                                </div>
                                <div class="col-md-1 d-flex flex-column align-items-center justify-content-between">
                                <label for="loud_speaker_test">Loud Speaker Test</label>
                                <input type="checkbox" class="single-checkbox" name="loud_speaker_test" id="loud_speaker_test" value="true">
                                </div>
                                <div class="col-md-1 d-flex flex-column align-items-center justify-content-between">
                                <label for="microphone_playback_test">Microphone Playback Tests</label>
                                <input type="checkbox" class="single-checkbox" name="microphone_playback_test" id="microphone_playback_test" value="true">
                                </div>
                                <div class="col-md-1 d-flex flex-column align-items-center justify-content-between">
                                <label for="buttons_test">Buttons Test</label>
                                <input type="checkbox" class="single-checkbox" name="buttons_test" id="buttons_test" value="true">
                                </div>
                                <div class="col-md-1 d-flex flex-column align-items-center justify-content-between">
                                <label for="camera_test">Camera test</label>
                                <input type="checkbox" class="single-checkbox" name="camera_test" id="camera_test" value="true">
                                </div>
                                <div class="col-md-1 d-flex flex-column align-items-center justify-content-between">
                                <label for="sensor_test">Sensor Test</label>
                                <input type="checkbox" class="single-checkbox" name="sensor_test" #### id="sensor_test" value="true">
                                </div>
                                <div class="col-md-1 d-flex flex-column align-items-center justify-content-between">
                                <label for="glass_condition">Glass Condition</label>
                                <input type="checkbox" class="single-checkbox" name="glass_condition" id="glass_condition" value="true">
                                </div>
                                <div class="col-md-1 d-flex flex-column align-items-center justify-content-between">
                                <label for="vibration">Vibration</label>
                                <input type="checkbox" class="single-checkbox" name="vibration" id="vibration" value="true">
                                </div>
                                <div class="col-md-1 d-flex flex-column align-items-center justify-content-between">
                                <label for="original_colour">Original colour</label>
                                <input type="checkbox" class="single-checkbox" name="original_colour" id="original_colour" value="true">
                                </div>
                                <div class="col-md-1 d-flex flex-column align-items-center justify-content-between">
                                <label for="battery_health">Battery health</label>
                                <input type="checkbox" class="single-checkbox" name="battery_health" id="battery_health" value="true">
                                </div>
                                <div class="col-md-1 d-flex flex-column align-items-center justify-content-between">
                                <label for="nfc">NFC</label>
                                <input type="checkbox" class="single-checkbox" name="nfc" id="nfc" value="true">
                                </div>
                                <div class="col-md-1 d-flex flex-column align-items-center justify-content-between">
                                <label for="no_power">No Power</label>
                                <input type="checkbox" class="single-checkbox" name="no_power" id="no_power" value="true">
                                </div>
                                <div class="col-md-1 d-flex flex-column align-items-center justify-content-between">
                                <label for="fake_missing_parts">Fake or missing parts</label>
                                <input type="checkbox" class="single-checkbox" name="fake_missing_parts" id="fake_missing_parts" value="true">
                                </div>
                            </div>

                        </div>

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
                                Select correct memory:
                            </label>
                            <select class="form-control" id="correct_memory_value" name="correct_memory_value" onchange="testingElementChanged()" required>
                                @foreach($productinformation as $productinfo)
                                <option value="{{$productinfo->memory}}">{{$productinfo->memory}}</option>
                                @endforeach
                            </select>
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
                                Select correct network:
                            </label>
                            <select class="form-control" id="correct_network_value" name="correct_network_value" onchange="testingElementChanged()" required>
                                @foreach($networks as $network)
                                <option value="{{$network->network_name}}">{{$network->network_name}}</option>
                                @endforeach
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
                            <select class="form-control" id="cosmetic_condition" name="cosmetic_condition" onchange="cosmeticElementChanged()" disabled required>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="device_color">
                                What is the device color?
                            </label>
                            <select class="form-control" id="device_color" name="device_color">
                                @foreach($productColors as $color)
                                    <option value="{{$color->color_value}}">{{$color->color_value}}</option>
                                @endforeach
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
                        </div>

                        <div class="form-group submit-buttons d-flex justify-content-between w-100 p-3">
                            <a href="/portal/testing/receive" style="margin: 0;">
                                <div class="btn btn-primary btn-blue">
                                    <p style="color: #fff; font-size: 16px; line-height: 24px;">Back</p>
                                </div>
                            </a>
                            <input type="hidden" id="tradein_id" name="tradein_id" value="{{$tradein->id}}">
                            <input type="hidden" id="old_customer_grade" name="old_customer_grade" value="{{$tradein->product_state}}">
                            <input type="hidden" id="bamboo_customer_grade" name="bamboo_customer_grade" value="">
                            <input type="hidden" id="bamboo_final_grade" name="bamboo_final_grade" value="">
                            <button id="receive-button" type="submit" class="btn btn-primary btn-blue check-imei">Submit testing</button>
                        </div>
                        
                    </form>
                </div>

            </div>
        </div>
    </main>

<script>

</script>
</body>

</html>
