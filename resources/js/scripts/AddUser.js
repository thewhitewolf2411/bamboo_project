$('#recycle').on('change', function(){

    if($(this).is(':checked')){
        $('#trade_pack_despatch').prop('checked', true);
        $('#awaiting_receipt').prop('checked', true);
        $('#receiving').prop('checked', true);
        $('#device_testing').prop('checked', true);
        $('#trolley_managment').prop('checked', true);
        $('#trays_managment').prop('checked', true);
        $('#quarantine_managment').prop('checked', true);
        $('#warehouse_management').prop('checked', true);
        $('#sales_lots').prop('checked', true);
        $('#despatch').prop('checked', true);
    }
    else{
        $('#trade_pack_despatch').prop('checked', false);
        $('#awaiting_receipt').prop('checked', false);
        $('#receiving').prop('checked', false);
        $('#device_testing').prop('checked', false);
        $('#trolley_managment').prop('checked', false);
        $('#trays_managment').prop('checked', false);
        $('#quarantine_managment').prop('checked', false);
        $('#warehouse_management').prop('checked', false);
        $('#sales_lots').prop('checked', false);
        $('#despatch').prop('checked', false);
    }

});

$('#customer_care').on('change', function(){

    if($(this).is(':checked')){
        $('#order_management').prop('checked', true);
        $('#create_order').prop('checked', true);
        $('#customer_accounts').prop('checked', true);
        $('#messages').prop('checked', true);
    }
    else{
        $('#order_management').prop('checked', false);
        $('#create_order').prop('checked', false);
        $('#customer_accounts').prop('checked', false);
        $('#messages').prop('checked', false);
    }

});

$('#administration').on('change', function(){

    if($(this).is(':checked')){
        $('#salvage_models').prop('checked', true);
        $('#sales_models').prop('checked', true);
        $('#feeds').prop('checked', true);
        $('#users').prop('checked', true);
        $('#reports').prop('checked', true);
        $('#cms').prop('checked', true);
        $('#categories').prop('checked', true);
        $('#settings').prop('checked', true);
        $('#recycle_offers').prop('checked', false);
    }
    else{
        $('#salvage_models').prop('checked', false);
        $('#sales_models').prop('checked', false);
        $('#feeds').prop('checked', false);
        $('#users').prop('checked', false);
        $('#reports').prop('checked', false);
        $('#cms').prop('checked', false);
        $('#categories').prop('checked', false);
        $('#settings').prop('checked', false);
        $('#recycle_offers').prop('checked', false);
    }

});

$('#payments').on('change', function(){

    if($(this).is(':checked')){
        $('#awaiting_payments').prop('checked', true);
        $('#submit_payments').prop('checked', true);
        $('#payment_confirmations').prop('checked', true);
        $('#failed_payments').prop('checked', true);
    }
    else{
        $('#awaiting_payments').prop('checked', false);
        $('#submit_payments').prop('checked', false);
        $('#payment_confirmations').prop('checked', false);
        $('#failed_payments').prop('checked', false);
    }

});