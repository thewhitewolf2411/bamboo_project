$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.saleslots').on('click', function(){

    $('.saleslots').each(function(){

        $(this).removeClass('saleslot-active');

    });

    $(this).addClass('saleslot-active');

    var saleslotid = $(this).prop('id');

    $('#saleslotidform').val(saleslotid);

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

            $('#changelotstatedata').empty();
            $('#changelotstatedata').append('<div class="form-group"><select name="changestate" class="form-control"><option value="" selected default disabled>Change state of Sale lot</option><option value="1">Sales Lot Under Offer</option><option value="2">Sales Lot Sold</option><option value="4">Sales Lot Sold - Payment Received</option><option value="5">Sales Lot Despached</option> </select></div><div><input type="submit" class="btn btn-primary btn-blue" value="Change state"></div>');
        },
    });


    $('#salelot-action').modal('show');

});