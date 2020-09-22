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

