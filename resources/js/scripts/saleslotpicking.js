const { get } = require("jquery");

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
        
    if($('#saleslotboxes-content-table .selecteddevicesforremoval:checked').length > 0){
        $('.modal #removefromlot').prop('disabled', false);
    }
    else{
        $('.modal #removefromlot').prop('disabled', true);
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
    });

    $.ajax({
        url: "/portal/sales-lot/building-sales-lot/build-lot",
        type:"POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
            selectedTradeIns:selectedTradeIns,
            selectedBoxes:selectedBoxes,
        },
        success:function(response){
            console.log(response);
            handleShownData(response);
            window.addEventListener("beforeunload", function(e){
                e.preventDefault();
            });
        },
    });
});

function handleShownData(data){
    console.log(data);
    if(data.boxes){
        for(const [key, item] of Object.entries(data.boxes)){
            $('#closedboxtable tbody tr#'+item.id).hide();  
            if(item.number_of_devices !== 0){
                $('#closedboxtable tbody').append('<tr id="' + item.id + '"> <td><div class="table-element"> ' + item.tray_name + ' </div></td><td><div class="table-element">' + item.tray_grade + '</div></td> <td><div class="table-element">' + item.tray_network + '</div></td><td><div class="table-element"> ' + item.number_of_devices + ' / ' + item.max_number_of_devices + '</div></td> <td><div class="table-element">Calculating</div></td> <td><div class="table-element"><input type="checkbox" class="box-sales-lot" data-value="' + item.id + '"></div></td> </tr>');
            }          
        }
    }

    if(data.tradeins){
        for(const [key, item] of Object.entries(data.tradeins)){
            $('#boxedtradeinstable tbody tr#'+item.id).hide();      
        }
    }
}


$('#saleslotboxes').on('click','.saleslotbox' ,function(){

    var boxid = $(this).attr('data-value');
    $('.appended-tradeins').remove();

    $.ajax({
        url: "/portal/sales-lot/building-sales-lot/build-lot/getboxdata",
        type:"POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
            boxid:boxid,
        },
        success:function(response){
            for(var i=0; i<response.length; i++){
                $('#saleslotboxes-content-table').append('<tr class="appended-tradeins" id="' + response[i].id + '"><td><div class="table-element">' + response[i].barcode + '</div></td><td><div class="table-element">' + response[i].box_location + '</div></td><td><div class="table-element">' + response[i].customer_grade + '</div></td><td><div class="table-element">' + response[i].bamboo_grade + '</div></td><td><div class="table-element">' + response[i].product_name + '</div></td><td><div class="table-element">' + response[i].correct_memory + '</div></td><td><div class="table-element">' + response[i].correct_network + '</div></td><td><div class="table-element">Colour</div></td><td><div class="table-element">£' + response[i].bamboo_price + '</div></td><td><div class="table-element"><input type="checkbox" class="selecteddevicesforremoval"></div></td></tr>');
            }
            
        },
    });

    $('#saleslotboxes-content .modal-header').empty();
    $('#saleslotboxes-content .modal-header').append($(this).attr('data-value'));
    $('#saleslotboxes-content .modal-header').append($(this).attr('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><img src="{{ url(' + "/customer_page_images/body/modal-close.svg" + ') }}"></span></button>'));
    
    $('#saleslotboxes-content').modal('show');

});


$('.modal #removefromlot').on('click', function(){

    var selectedTradeIns = [];

    $('#saleslotboxes-content-table .selecteddevicesforremoval:checked').each(function() {
        selectedTradeIns.push($(this).parent().parent().parent().attr('id'));
    });

    $.ajax({
        url: "/portal/sales-lot/building-sales-lot/build-lot/getboxdata/remove",
        type:"POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
            selectedTradeIns:selectedTradeIns,
        },
        success:function(response){
            var i = 0;
            $('#saleslotboxes-content-table .selecteddevicesforremoval:checked').each(function(){

                $('#boxedtradeinstable').append('<tr id="' + response[i].id + '"><td><div class="table-element">' + response[i].barcode + '</div></td><td><div class="table-element">' + response[i].box_location + '</div></td><td><div class="table-element">' + response[i].customer_grade + '</div></td><td><div class="table-element">' + response[i].bamboo_grade + '</div></td><td><div class="table-element">' + response[i].product_name + '</div></td><td><div class="table-element">' + response[i].correct_memory + '</div></td><td><div class="table-element">' + response[i].correct_network + '</div></td><td><div class="table-element">Colour</div></td><td><div class="table-element">£' + response[i].bamboo_price + '</div></td><td><div class="table-element"><input type="checkbox" class="tradein-sales-lot"></div></td></tr>')

                $(this).parent().parent().parent().remove();
                i++;
            })            
        },
    });
});


$('#completelot').on('click', function(){

    var c = confirm('Are you sure you want to build a lot using selected items?');

    if(c){
        $.ajax({
            url: "/portal/sales-lot/building-sales-lot/create-lot",
            type:"POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){
                location.reload();
            },
        });
    }

});