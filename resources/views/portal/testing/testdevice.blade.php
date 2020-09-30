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
                <div class="portal-search-form-container">
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
                        <form action="/portal/testing/receive/checkimei" method="POST" class="d-flex flex-column">

                        <script>
                            
                            $('#fake_missing_parts').change(function(){
                                var boolval = $(this).val();
                                if(boolval == "true"){
                                    if(document.getElementById('fake-missing-part-image').classList.contains('form-group-hidden')){
                                        document.getElementById('fake-missing-part-image').classList.remove('form-group-hidden');
                                        document.getElementById('fake_missing_part_image').required = true;

                                        $('#customer_grade').val("Faulty");
                                        $('#bamboo_grade').prop('disabled', false);

                                        var newOptions = {
                                            "WSI":"WSI",
                                            "WSD":"WSD",
                                            "NWSI":"NWSI",
                                            "NWSD":"NWSD",
                                            "PND":"PND",
                                            "CATASTROHIC":"CATASTROHIC"
                                        }

                                        $('#bamboo_grade').empty();
                                        $.each(newOptions, function(key, value){
                                            $('#bamboo_grade').append($("<option></option>")
                                            .attr("value", value).text(key));
                                        });


                                    }
                                }else{
                                    document.getElementById('fake-missing-part-image').classList.add('form-group-hidden');
                                    document.getElementById('fake_missing_part_image').required = false;

                                    $('#customer_grade').val("{!! $tradein->product_state !!}");
                                    $('#bamboo_grade').prop('disabled', true);
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

                                        $('#customer_grade').val("Faulty");
                                        $('#bamboo_grade').prop('disabled', false);

                                        var newOptions = {
                                            "WSI":"WSI",
                                            "WSD":"WSD",
                                            "NWSI":"NWSI",
                                            "NWSD":"NWSD",
                                            "PND":"PND",
                                            "CATASTROHIC":"CATASTROHIC"
                                        }

                                        $('#bamboo_grade').empty();
                                        $.each(newOptions, function(key, value){
                                            $('#bamboo_grade').append($("<option></option>")
                                            .attr("value", value).text(key));
                                        });
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
                                <option value="1">Audio Tests</option>
                                <option value="2">Front Microphone</option>
                                <option value="1">Headset Test</option>
                                <option value="2">Loud Speaker Test</option>
                                <option value="1">Microphone Playback Tests</option>
                                <option value="2">Buttons Test</option>
                                <option value="1">Camera test</option>
                                <option value="2">Sensor Test</option>
                                <option value="1">Glass Condition</option>
                                <option value="2">Vibration</option>
                                <option value="2">Original colour</option>
                                <option value="2">ESN</option>
                                <option value="2">OEM Parts</option>
                                <option value="2">Battery health</option>
                                <option value="2">NFC</option>
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
                            <label for="cosmetic_condition">
                                What is the device cosmetic condition?
                            </label>
                            <select class="form-control" id="cosmetic_condition" name="cosmetic_condition" required>
                                <option disabled selected value> -- select an option -- </option>
                                <option value="Grade A">Grade A</option>
                                <option value="Grade B">Grade B</option>
                                <option value="Grade C">Grade C</option>
                                <option value="WSI - WSD">WSI - WSD</option>
                                <option value="WSI - WSD - NW - PND - FMIP">WSI - WSD - NW - PND - FMIP</option>
                            </select>
                        </div>

                        
                        <div class="form-group d-flex">

                            <div class="form-group w-50">
                                <label for="customer_grade">Customer Grade</label>
                                <input type="text" id="customer_grade" name="customer_grade" value="{{$tradein->product_state}}" disabled>
                            </div>
                            <div class="form-group w-50">
                                <label for="bamboo_grade">Bamboo Grade:</label>
                                <select class="form-control" id="bamboo_grade" name="bamboo_grade" style="padding:12px; height:50px; margin-top:6px; margin-bottom:16px; " disabled>
                                    <option disabled selected value> -- select an option -- </option>
                                    <option value="Grade A">Grade A</option>
                                    <option value="Grade B">Grade B</option>
                                    <option value="Grade C">Grade C</option>
                                    <option value="WSI - WSD">WSI - WSD</option>
                                    <option value="WSI - WSD - NW - PND - FMIP">WSI - WSD - NW - PND - FMIP</option>
                                </select>
                            </div>

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

</body>
<script>

$(document).ready(function(){

    var elem = $('.portal-links-container > .portal-header-element')[4];
    
    console.log(elem.children[0]);

    elem.children[0].style.color = "#fff";
    elem.children[0].children[0].style.opacity = 1;

});



</script>


</html>
