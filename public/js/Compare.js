function selectCompareProduct1(product){
    var productId = product.value;

    token = document.querySelector('meta[name="csrf_token"]').content;

    /*var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/getproductdata", true);
    xhttp.setRequestHeader('Content-Type','application/json; charset=UTF-8');

    var data = xhttp.send("_token=" + token + "&productid=" + productId); 

    console.log(data);*/

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });
     jQuery.ajax({
        url: "/getproductdata",
        method: 'post',
        data: {
            productid: productId,
        },
        success: function(result){

            $('#device-1-price-range').text(result["Pricerange"]);
            $('#device-1-dimensions').text(result["Dimensions"]);
            $('#device-1-weight').text(result["Weight"]);
            $('#device-1-operating-system').text(result["OS"]);
            $('#device-1-battery').text(result["Battery"]);
            $('#device-1-camera').text(result["Camera1"] + result["Camera2"]);
            $('#device-1-processor').text(result["Processor"]);
            $('#device-1-screen-size').text(result["ScreenSize"]);
            $('#device-1-connectivity').text(result["Connectivity"]);
            $('#device-1-signal').text(result["Signal"]);
            $('#device-1-sim-size').text(result["SimSize"]);
            $('#device-1-memory-slots').text(result["MemoryCardSlots"]);


    }});
}

function selectCompareProduct2(product){
    var productId = product.value;

    token = document.querySelector('meta[name="csrf_token"]').content;

    /*var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/getproductdata", true);
    xhttp.setRequestHeader('Content-Type','application/json; charset=UTF-8');

    var data = xhttp.send("_token=" + token + "&productid=" + productId); 

    console.log(data);*/

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });
     jQuery.ajax({
        url: "/getproductdata",
        method: 'post',
        data: {
            productid: productId,
        },
        success: function(result){
           
            $('#device-2-price-range').text(result["Pricerange"]);
            $('#device-2-dimensions').text(result["Dimensions"]);
            $('#device-2-weight').text(result["Weight"]);
            $('#device-2-operating-system').text(result["OS"]);
            $('#device-2-battery').text(result["Battery"]);
            $('#device-2-camera').text(result["Camera1"] + result["Camera2"]);
            $('#device-2-processor').text(result["Processor"]);
            $('#device-2-screen-size').text(result["ScreenSize"]);
            $('#device-2-connectivity').text(result["Connectivity"]);
            $('#device-2-signal').text(result["Signal"]);
            $('#device-2-sim-size').text(result["SimSize"]);
            $('#device-2-memory-slots').text(result["MemoryCardSlots"]);


    }});
}

function selectCompareProduct3(product){
    var productId = product.value;

    token = document.querySelector('meta[name="csrf_token"]').content;

    /*var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/getproductdata", true);
    xhttp.setRequestHeader('Content-Type','application/json; charset=UTF-8');

    var data = xhttp.send("_token=" + token + "&productid=" + productId); 

    console.log(data);*/

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });
     jQuery.ajax({
        url: "/getproductdata",
        method: 'post',
        data: {
            productid: productId,
        },
        success: function(result){

            $('#device-3-price-range').text(result["Pricerange"]);
            $('#device-3-dimensions').text(result["Dimensions"]);
            $('#device-3-weight').text(result["Weight"]);
            $('#device-3-operating-system').text(result["OS"]);
            $('#device-3-battery').text(result["Battery"]);
            $('#device-3-camera').text(result["Camera1"] + result["Camera2"]);
            $('#device-3-processor').text(result["Processor"]);
            $('#device-3-screen-size').text(result["ScreenSize"]);
            $('#device-3-connectivity').text(result["Connectivity"]);
            $('#device-3-signal').text(result["Signal"]);
            $('#device-3-sim-size').text(result["SimSize"]);
            $('#device-3-memory-slots').text(result["MemoryCardSlots"]);


    }});
}

function selectCompareProduct4(product){
    var productId = product.value;

    token = document.querySelector('meta[name="csrf_token"]').content;

    /*var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/getproductdata", true);
    xhttp.setRequestHeader('Content-Type','application/json; charset=UTF-8');

    var data = xhttp.send("_token=" + token + "&productid=" + productId); 

    console.log(data);*/

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });
     jQuery.ajax({
        url: "/getproductdata",
        method: 'post',
        data: {
            productid: productId,
        },
        success: function(result){
           
            $('#device-4-price-range').text(result["Pricerange"]);
            $('#device-4-dimensions').text(result["Dimensions"]);
            $('#device-4-weight').text(result["Weight"]);
            $('#device-4-operating-system').text(result["OS"]);
            $('#device-4-battery').text(result["Battery"]);
            $('#device-4-camera').text(result["Camera1"] + result["Camera2"]);
            $('#device-4-processor').text(result["Processor"]);
            $('#device-4-screen-size').text(result["ScreenSize"]);
            $('#device-4-connectivity').text(result["Connectivity"]);
            $('#device-4-signal').text(result["Signal"]);
            $('#device-4-sim-size').text(result["SimSize"]);
            $('#device-4-memory-slots').text(result["MemoryCardSlots"]);


    }});
}