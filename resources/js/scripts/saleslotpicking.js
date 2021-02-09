$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
    $('#pick-sales-lot-boxes').show();
    $('#pick-sales-lot-devices').hide();

    $('#showscanboxdiv').find('div').removeClass('btn-blue');
    $('#showscanboxdiv').find('div').addClass('btn-warning');

    $('#showscandevicediv').find('div').removeClass('btn-warning');
    $('#showscandevicediv').find('div').addClass('btn-blue');

    var boxesCount = $('#pick-sales-lot-boxes tr').length - 1;
    var devicesCount = $('#pick-sales-lot-devices tr').length - 1;

    var pickedBoxesCount = $('#pick-sales-lot-boxes tr.box-picked').length;
    var pickedDevicesCount = $('#pick-sales-lot-devices tr.device-picked').length;

    var remainingBoxesCount = boxesCount - pickedBoxesCount;
    var remainingDevicesCount = devicesCount - pickedDevicesCount;

    $('#remaining').text(remainingBoxesCount + ' boxes and ' + remainingDevicesCount + ' devices.');
    $('#picked').text(pickedBoxesCount + ' boxes and ' + pickedDevicesCount + ' devices.');

    if(remainingDevicesCount + remainingBoxesCount === 0){
        $('#cancelpickingsaleslot').prop('disabled', true);
        $('#completepickingsaleslot').prop('disabled', false);
        $('#suspendpickingsaleslot').prop('disabled', true);
    }
    else{
        $('#cancelpickingsaleslot').prop('disabled', false);
        $('#completepickingsaleslot').prop('disabled', true);
        $('#suspendpickingsaleslot').prop('disabled', false);
    }

});

$('.saleslotpicking').on('click', function(){

    var saleslotid = this.id;

    $('#startpicklot').prop('href', '/portal/warehouse-management/picking-despatch/pick-lot/' + saleslotid);

    $('#printpicknote').attr('data-value', saleslotid);

    $.ajax({
        url: "/portal/sales-lot/completed-sales-lots/get-saleslot-content",
        type:"GET",
        data:{
            saleslotid:saleslotid,
        },
        success:function(response){
            $('#sales-lot-boxes td').each(function(){
                $(this).remove();
            });

            $('#sales-lot-devices td').each(function(){
                $(this).remove();
            });

            for(var i=0; i<response.boxes.length; i++){
                $('#sales-lot-boxes').append('<tr> <td> ' + response.boxes[i].tray_name + '</td><td>' + response.boxes[i].trolley_id + '</td><td>' + response.boxes[i].number_of_devices + '</td> </tr>')
            }

            for(var i=0; i<response.devices.length; i++){
                $('#sales-lot-devices').append('<tr> <td> ' + response.devices[i].barcode + '</td><td>' + response.devices[i].product_name + '</td><td>' + response.devices[i].imei_number + '</td><td>' + response.devices[i].box_location + '</td><td>' + response.devices[i].bay_location + '</td></tr>')
            }
        },
    });


    $('#salelot-picking').modal('show');

});

$('#printpicknote').on('click', function(){

    var saleslotid = $(this).attr('data-value');

    $.ajax({
        url: "/portal/warehouse-management/picking-despatch/print-pick-note",
        type:"POST",
        data:{
            saleslotid:saleslotid,
        },
        success:function(response){
            window.open(response, "_blank");
        },
    });

});

$('#showscanboxdiv').on('click', function(){

    $('#buildsaleslot-scanboxdiv').removeClass('buildsaleslot-hidden');
    $('#buildsaleslot-scanboxdiv').addClass('buildsaleslot-active');

    $('#buildsaleslot-scandevicediv').removeClass('buildsaleslot-active');
    $('#buildsaleslot-scandevicediv').addClass('buildsaleslot-hidden');

    $('#pick-sales-lot-boxes').show();
    $('#pick-sales-lot-devices').hide();
    $('#buildssaleslot-scanboxinput').show();
    $('#buildssaleslot-scandeviceinput').hide();
    $('#buildssaleslot-scanboxinput').focus();

    $(this).find('div').removeClass('btn-blue');
    $(this).find('div').addClass('btn-warning');

    $('#showscandevicediv').find('div').removeClass('btn-warning');
    $('#showscandevicediv').find('div').addClass('btn-blue');

});

$('#showscandevicediv').on('click', function(){

    $('#buildsaleslot-scandevicediv').removeClass('buildsaleslot-hidden');
    $('#buildsaleslot-scandevicediv').addClass('buildsaleslot-active');

    $('#buildsaleslot-scanboxdiv').removeClass('buildsaleslot-active');
    $('#buildsaleslot-scanboxdiv').addClass('buildsaleslot-hidden');

    $('#pick-sales-lot-boxes').hide();
    $('#pick-sales-lot-devices').show();
    $('#buildssaleslot-scanboxinput').hide();
    $('#buildssaleslot-scandeviceinput').show();
    $('#buildssaleslot-scandeviceinput').focus();

    $(this).find('div').removeClass('btn-blue');
    $(this).find('div').addClass('btn-warning');

    $('#showscanboxdiv').find('div').removeClass('btn-warning');
    $('#showscanboxdiv').find('div').addClass('btn-blue');

});


$('#buildssaleslot-scanboxinput').on('input', function(){

    var boxname = $(this).val();
    var saleslotid = $('#buildsaleslot-salelot').val();

    $.ajax({
        url: "/portal/warehouse-management/picking-despatch/pick-lot/checkboxstatus",
        type:"POST",
        data:{
            boxname:boxname,
            saleslotid:saleslotid,
        },
        success:function(data, textStatus, xhr){
            $('#buildssaleslot-scanboxsubmit').prop('disabled', false);
        },
        error:function(data, textStatus, xhr){
            $('#buildssaleslot-scanboxsubmit').prop('disabled', true);
        },
    });

});


$('#buildssaleslot-scandeviceinput').on('input', function(){

    var devicebarcode = $(this).val();
    var saleslotid = $('#buildsaleslot-salelot').val();

    $.ajax({
        url: "/portal/warehouse-management/picking-despatch/pick-lot/checkdevicestatus",
        type:"POST",
        data:{
            devicebarcode:devicebarcode,
            saleslotid:saleslotid,
        },
        success:function(data, textStatus, xhr){
            $('#buildssaleslot-scandevicesubmit').prop('disabled', false);
        },
        error:function(data, textStatus, xhr){
            $('#buildssaleslot-scandevicesubmit').prop('disabled', true);
        },
    });

});