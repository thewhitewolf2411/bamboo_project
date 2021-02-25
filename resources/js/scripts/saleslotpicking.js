$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('change', function(){

    if(($('#boxedtradeinstable .tradein-sales-lot:checked').length + $('#closedboxtable .box-sales-lot:checked').length) > 0){
        $('#addtolot').prop('disabled', false);
    }
    else{
        $('#addtolot').prop('disabled', true);
    }

    if($('#saleslotboxes tr').length > 1){
        $('#completelot').prop('disabled', false);
    }
    else{
        $('#completelot').prop('disabled', true);
    }

});

$('#addtolot').on('click', function(){

    var tradeins = $('.tradein-sales-lot:checked');
    var boxes = $('.box-sales-lot:checked');

    var selectedTradeIns = [];
    var selectedBoxes = [];

    $('.tradein-sales-lot:checked').each(function() {
        selectedTradeIns.push($(this).attr('data-value'));
    });

    $('.box-sales-lot:checked').each(function() {
        selectedBoxes.push($(this).attr('data-value'));
        $('#saleslotboxes').append($('#closedboxtable #' + $(this).attr('data-value') ));
        $('#addtolot').prop('disabled', true);
        $('#closedboxtable #' + $(this).attr('data-value') ).remove();
    });

    //console.log(selectedBoxes, selectedTradeIns);


    
});