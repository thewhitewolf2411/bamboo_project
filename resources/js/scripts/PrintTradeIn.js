$('.print-one-tradein').on('click', function(){
    //Set new value for trade_pack_trade_in_id hidden input

    var barcode = $(this).attr('data-barcode');

    $('#print_trade_pack_trade_in_id').val(barcode);

    //Trigger printing
    $('#print_trade_pack_trade_in_trigger').click();
})

function printTradePackTradeInBulk(){
    //Trigger printing

    $('#number_of_bulk_prints').val();

    $('#print_trade_pack_bulk_form_trigger').click();
}

function printDeviceLabel(print_device_id){
    //Set new value for trade_pack_trade_in_id hidden input
    $('#print_device_id').val(print_device_id);

    //Trigger printing
    $('#print_device_barcode').click();
}

function setNumberOfTradePacks(number_of_trade_packs_to_print){
    $('#number_of_bulk_prints').val(number_of_trade_packs_to_print);
    $('#bulk_label_print_button').prop('disabled', false);
}

function setAsSent(trade_pack_job_trade_in_id){

    $('#set_trade_in_as_sent').val(trade_pack_job_trade_in_id);
    $('#set_trade_in_as_sent_trigger').click();

}

function selectDeviceForTesting(barcode){
    $('#searchinput').val(barcode);
    $('#select_device_for_testing_button').click();
}

function deleteTradeInDetailsFromSystem(id){
    $('#delete_trade_in_id').val(id);
    $('#delete_trade_in_button').click();
}

$('#tradein-checkallbtn').on('click', function(){

    $('.printcheckbox').prop('checked', false);

    $('.printcheckbox').slice(0, 25).prop('checked', this.checked);

});

$('.printcheckbox').on('click', function(){

    var numberOfChecked = $('.printcheckbox:checked').length;
    console.log(numberOfChecked);

    if($(this).is('checked')){
        $(this).prop('checked', false);        
    }
    else{
        if(numberOfChecked >= 25){
            $(this).prop('checked', false);
        }
    }

});

$('#print_trade_pack_bulk_form_trigger').on('click', function(){

    var selected = [];
    $('.printcheckbox:checked').each(function() {
        selected.push($(this).attr('name'));
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/portal/customer-care/trade-in/printlabelbulk",
        type:"POST",
        data:{
            selected:selected,
        },
        success:function(response){
            console.log(response);
            window.open(response, '_blank');
            location.reload();
        }
    });

});

function markOrderAsSent(trade_out_id){

    //Set new value for trade_pack_trade_in_id hidden input
    $('#mark_as_complete_trade_out_id').val(trade_out_id);

    //Trigger printing
    $('#mark_as_complete_trade_out_trigger').click();
}