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
                        <p>Check IMEI</p>
                    </div>
                </div>
                <div class="portal-search-form-container">
                    
                    <div class="d-flex portal-search-form-container">

                        <form>
                            <label for="checkimei">Check IMEI:</label>
                            <input id="trade_in_product_id" type="hidden" name="" value="">
                            <input id="checkimei" type="number" name="checkimei" class="form-control" autofocus required>
                            <button id="check-imei" type="submit" class="btn btn-primary btn-blue check-imei">Check</button>
                        </form>

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

$("#check-imei").click(function(event){
    console.log("karina");
    //var trade_in_product_id = $('#trade_in_product_id').val();
    var trade_in_product_id = 1;

//IMEI
var imei = $('#checkimei').val();

//AJAX call
$.ajax({
    url: "v2.bamboorecycle.com/admin/testing/testing/imei-check-ajax.html?trade-in-product-id=" + trade_in_product_id + "&imei=" + encodeURIComponent(imei),
})
.done(function(get_imei_result) {

    console.log(get_imei_result);    //Eval result
    var imei_result = eval( "(" + get_imei_result + ")" );

    //If success
    if(imei_result.result == true)
    {
        //alert('checkIMEI function - TODO in next Phases of the project');
        //imei_result.checkmend = new Object(); //TODO temp
        //imei_result.checkmend.status = 'stolen'; //TODO temp

        //If checkmend 'stolen' status is get
        if(imei_result.checkmend.status == 'stolen') //TODO might be different status name
        {
            //Remove modal attributes from 'Quarantine' button
            $('#quarantine_button').removeAttr("data-toggle");
            $('#quarantine_button').removeAttr("data-target");
            $('#quarantine_button').removeAttr("data-original-title");

            //Add new onclick attribute
            $('#quarantine_button').attr("onclick", "setAsStolen();");

            //Disable 'Next' button
            $('button[value=Next]').toggleClass('disabled', true);

            //Set success message
            setMessage('warning', 'IMEI CheckMEND check for current Trade-In Product has found that this device is stolen.');
        }
        else
        {
            //Set success message
            setMessage('success', 'IMEI CheckMEND check for current Trade-In Product has been successful.');

            //Set 'Quarantine' button to modal
            setQuarantineButtonToModal();

            //Enable 'Next' button
            $('button[value=Next]').toggleClass('disabled', false);
            $('button[value=Next]').prop('disabled', false);
        }
    }
    //If no success
    else
    {
        //Set error message
        setAndShowMessage('error', imei_result.error_message);
    }
    });
  });

</script>


</html>
