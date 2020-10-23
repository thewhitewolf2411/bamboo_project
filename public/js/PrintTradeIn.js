function printTradePackTradeIn(trade_pack_job_trade_in_id){

    //Set new value for trade_pack_trade_in_id hidden input
    $('#print_trade_pack_trade_in_id').val(trade_pack_job_trade_in_id);

    //Trigger printing
    $('#print_trade_pack_trade_in_trigger').click();
}

function printTradePackTradeInBulk(){
    //Trigger printing

    $('#number_of_bulk_prints').val();

    $('#print_trade_pack_bulk_form_trigger').click();
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

function enablebtn(){
    var k=0;
    var chckbox = $('.printcheckbox');

    for(var i=0; i<chckbox.length; i++){
        if(chckbox[i].checked){
            k++;
        }
    }

    if(k>0){
        $('#print_trade_pack_bulk_form_trigger').prop("disabled", false);
    }

    else{
        $('#print_trade_pack_bulk_form_trigger').prop("disabled", true);
    }
}

function checkall(chkallbtn){

    var chckbox = $('.printcheckbox');
 
    if(chkallbtn.checked){
        for(var i=0; i<chckbox.length; i++){
            chckbox[i].checked = true;
            $('#print_trade_pack_bulk_form_trigger').prop("disabled", false);
        }
    }
    else{
        for(var i=0; i<chckbox.length; i++){
            chckbox[i].checked = false;
            $('#print_trade_pack_bulk_form_trigger').prop("disabled", true);
        }
    }

}