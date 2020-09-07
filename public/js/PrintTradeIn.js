function printTradePackTradeIn(trade_pack_job_trade_in_id){

    //Set new value for trade_pack_trade_in_id hidden input
    $('#print_trade_pack_trade_in_id').val(trade_pack_job_trade_in_id);

    //Trigger printing
    $('#print_trade_pack_trade_in_trigger').click();
}