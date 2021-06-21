$(document).ready(function(){

    if(!document.getElementById('edit_lot_id')){
        if(document.getElementById('boxed-tradeins')){

            $.ajax({
                url: "/portal/sales-lot/building-sales-lot/build-lot/getTradeins",
                type:"GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(response){
        
                    setBoxedTradeinsDataTable(response);
                }
            });
    
        }
    
        if(document.getElementById('bayed-boxes')){
    
            $.ajax({
                url: "/portal/sales-lot/building-sales-lot/build-lot/getBoxes",
                type:"GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(response){
        
                    setBayedBoxesDataTable(response);
                }
            });
    
        }
    
        if(document.getElementById('added-tradeins-building-lot')){
            $('#added-tradeins-building-lot tfoot td').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );    
    
            var addedtradeinstable = $('#added-tradeins-building-lot').DataTable({
                "oLanguage" : {
                    "sInfo" : "Showing _START_ to _END_",
                 },
                 "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                 "pageLength":-1,
                 "ordering": false,
                 paging: false,
                 info: false
            });
    
            addedtradeinstable.columns().every( function () {
            
                var that = this;
                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            });
        }
    
        $('input:checkbox').change(function(){
            //Check and uncheck all left side tradeins
            if($(this).prop('id') === 'select_all_tradeins_building_lot'){
                $('.boxed_tradeins').each(function(){
                    $(this).prop('checked', $('#select_all_tradeins_building_lot').prop('checked'));
                });
            }
            //Check and uncheck all left side boxes
            if($(this).prop('id') === 'select_all_boxes_building_lot'){
                $('.bayed_boxes').each(function(){
                    $(this).prop('checked', $('#select_all_boxes_building_lot').prop('checked'));
                });
            }
            //Check and uncheck all right side tradeins
            if($(this).prop('id') === 'select_all_added_tradeins_building_lot'){
                $('.added_tradeins').each(function(){
                    $(this).prop('checked', $('#select_all_added_tradeins_building_lot').prop('checked'));
                });
            }
    
        });
    }

});


$(document).on('change', function(){

    var numberOfCheckedLeft = $('.bayed_boxes:checked').length + $('.boxed_tradeins:checked').length;

    if(numberOfCheckedLeft > 0){
        $('#addtolot').prop('disabled', false);
    }
    else{
        $('#addtolot').prop('disabled', true);
    }

    var numberOfCheckedRight = $('.added_tradeins:checked').length;

    if(numberOfCheckedRight > 0){
        $('#removefromlot').prop('disabled', false);
    }
    else{
        $('#removefromlot').prop('disabled', true);
    }

});

$('#changetoviewboxes').on('change', function(){

    if($(this).attr('checked', true)){
        $('#boxed-tradeins_wrapper').hide();
        $('#bayed-boxes_wrapper').show();

        $('.boxed_tradeins').each(function(){
            $(this).prop('checked', false);
        });

        $('#select_all_tradeins_building_lot').prop('checked', false);
    }

});

$('#changetoviewtradeins').on('change', function(){

    if($(this).attr('checked', true)){
        $('#boxed-tradeins_wrapper').show();
        $('#bayed-boxes_wrapper').hide();

        $('.bayed_boxes').each(function(){
            $(this).prop('checked', false);
        });
    
        $('#select_all_boxes_building_lot').prop('checked', false);
    }


});

$('#addtolot').on('click', function(){

    var addedTradeins = [];
    var addedBoxes = [];

    $('.bayed_boxes:checked').each(function(){
        addedBoxes.push($(this).data('id'));
    });

    $('.boxed_tradeins:checked').each(function(){
        addedTradeins.push($(this).data('id'));
    });

    $.ajax({
        url: "/portal/sales-lot/building-sales-lot/build-lot",
        type:"POST",
        data:{
            addedTradeins:addedTradeins,
            addedBoxes:addedBoxes
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){

            hideLeftTradeins(response[1]);
            handleLeftBoxes(response[0]);
            handleRightButtons();
        }
    });



    $(this).prop('disabled', true);

});

$('#removefromlot').on('click', function(){

    var removedTradeins = [];
    $('.added_tradeins:checked').each(function(){
        removedTradeins.push($(this).data('id'));
    });

    $.ajax({
        url: "/portal/sales-lot/building-sales-lot/remove-from-lot",
        type:"POST",
        data:{
            removedTradeins:removedTradeins,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            handleRemoveDevices(response[0], response[1], response[2]);
        }
    });


    handleRightButtons();

});

$('#completelot').on('click', function(){

    var addedTradeins = [];

    $('#added-tradeins-building-lot tbody tr').each(function(){
        addedTradeins.push($(this).prop('id'));
    });

    $.ajax({
        url: "/portal/sales-lot/building-sales-lot/create-lot",
        type:"POST",
        data:{
            addedTradeins:addedTradeins,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            if(response){
                location.reload();
            }
        }
    });


});

$('#exportxls').on('click', function(){

    var addedTradeins = [];

    $('#added-tradeins-building-lot tbody tr').each(function(){
        addedTradeins.push($(this).prop('id'));
    });

    $.ajax({
        url: "/portal/sales-lot/building-sales-lot/build-lot/generate-xls",
        type:"POST",
        data:{
            addedTradeins:addedTradeins,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            window.open(response.url, '_blank');
        }
    });
});

function setBayedBoxesDataTable(boxes){
    $('#bayed-boxes tfoot td').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );    

    var bayedBoxesTable = $('#bayed-boxes').DataTable({
        "oLanguage" : {
            "sInfo" : "Showing _START_ to _END_",
         },
         "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
         "pageLength":-1,
         "ordering": false,
         paging: false,
         info: false
    });

    for(var i=0; i<boxes.length; i++){

        var row = '<input class="bayed_boxes" type="checkbox" id="box_"' + boxes[i].id + '" data-id="' + boxes[i].id + '">';
        bayedBoxesTable.row.add([
            boxes[i].tray_name,
            boxes[i].tray_grade,
            boxes[i].tray_network,
            boxes[i].number_of_devices - (boxes[i].number_of_devices - boxes[i].added_qty),
            //boxes[i].number_of_devices,
            '£' + boxes[i].total_cost,
            row,
        ]).node().id = boxes[i].id;
        
        bayedBoxesTable.draw(false);
    }

    bayedBoxesTable.columns().every( function () {
    
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    });

    $('#bayed-boxes_wrapper').hide();
}

function setBoxedTradeinsDataTable(tradeins){


    $('#boxed-tradeins tfoot td').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );    

    var boxedTradeinTable = $('#boxed-tradeins').DataTable({
        "oLanguage" : {
            "sInfo" : "Showing _START_ to _END_",
         },
         "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
         "pageLength":-1,
         "ordering": false,
         paging: false,
         info: false
    });

    for(var i=0; i<tradeins.length; i++){

        var row = '<input class="boxed_tradeins" type="checkbox" id="tradein_"' + tradeins[i].id + '" data-id="' + tradeins[i].id + '">';
        boxedTradeinTable.row.add([
            tradeins[i].barcode,
            tradeins[i].tray_name,
            tradeins[i].customer_grade,
            tradeins[i].bamboo_grade,
            tradeins[i].product_name,
            tradeins[i].device_memory,
            tradeins[i].device_network,
            tradeins[i].device_colour,
            '£' + tradeins[i].device_cost,
            row,
        ]).node().id = tradeins[i].id;
        
        boxedTradeinTable.draw(false);
    }

    boxedTradeinTable.columns().every( function () {
    
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    });

    hideLoader();
}

function hideLeftTradeins(ids){

    var boxedTradeinTable = $('#boxed-tradeins').DataTable();

    var rowdata;

    for(var i = 0; i<ids.length; i++){

        rowdata = boxedTradeinTable.row('#' + ids[i]).data();

        if(rowdata && showRightTradeins(rowdata, ids[i])){
            boxedTradeinTable.row('#' + ids[i]).remove().draw(false);
        }

    }

    $('#select_all_tradeins_building_lot').prop('checked', false);
}

function showRightTradeins(data, id){

    var addedTradeinTable = $('#added-tradeins-building-lot').DataTable();

    var row = '<input class="added_tradeins" type="checkbox" id="tradein_' + id + '" data-id="' + id + '">';

    addedTradeinTable.row.add([
       data[1],
       data[3],
       data[4],
       data[5],
       data[8],
       row
    ]).node().id = id;
    
    addedTradeinTable.draw(false);

    return true;
}

function handleLeftBoxes(boxes){
    var boxids = Object.keys(boxes);
    var number_of_devices = Object.values(boxes);

    var bayedBoxesTable = $('#bayed-boxes').DataTable();

    var rowdata;

    for(var i = 0; i<boxids.length; i++){

        rowdata = bayedBoxesTable.row('#' + boxids[i]).data();

        rowdata[3] -= number_of_devices[i];

        if(rowdata[3] == 0){
            bayedBoxesTable.row('#' + boxids[i]).remove().draw(false);
        }
        else{
            bayedBoxesTable.row('#' + boxids[i]).data(rowdata).draw(false);
        }
    }

}

function handleRightButtons(){
    var addedTradeinTable = $('#added-tradeins-building-lot').DataTable();

    if(! addedTradeinTable.data().count()){
        $('#completelot').prop('disabled', true);
        $('#exportxls').prop('disabled', true);
    }
    else{
        $('#completelot').prop('disabled', false);
        $('#exportxls').prop('disabled', false);
    }

    getTotalQty();
    getTotalCost();
}

function handleRemoveDevices(boxes_ids, tradein_ids, boxes){
    var boxids = Object.keys(boxes_ids);
    var number_of_devices = Object.values(boxes_ids);

    var boxedTradeinTable = $('#boxed-tradeins').DataTable();
    var addedTradeinTable = $('#added-tradeins-building-lot').DataTable();
    var bayedBoxesTable = $('#bayed-boxes').DataTable();

    for(var i = 0; i<tradein_ids.length; i++){

        var row = '<input class="boxed_tradeins" type="checkbox" id="tradein_"' + tradein_ids[i].id + '" data-id="' + tradein_ids[i].id + '">';
        boxedTradeinTable.row.add([
            tradein_ids[i].barcode,
            tradein_ids[i].tray_name,
            tradein_ids[i].customer_grade,
            tradein_ids[i].bamboo_grade,
            tradein_ids[i].product_name,
            tradein_ids[i].device_memory,
            tradein_ids[i].device_network,
            tradein_ids[i].device_colour,
            '£' + tradein_ids[i].device_cost,
            row,
        ]).node().id = tradein_ids[i].id;

        boxedTradeinTable.draw(false);

        addedTradeinTable.row('#' + tradein_ids[i].id).remove().draw(false);
    }

    for(var i=0; i<boxes.length; i++){

        if(bayedBoxesTable.row('#' + boxes[i].id).length > 0){
            rowdata = bayedBoxesTable.row('#' + boxes[i].id).data();
    
            rowdata[3] -= number_of_devices[i];

            bayedBoxesTable.row('#' + boxes[i].id).data(rowdata).draw(false);
            
        }
        else{
            var row = '<input class="bayed_boxes" type="checkbox" id="box_"' + boxes[i].id + '" data-id="' + boxes[i].id + '">';
            bayedBoxesTable.row.add([
                boxes[i].tray_name,
                boxes[i].tray_grade,
                boxes[i].tray_network,
                boxes[i].number_of_devices - number_of_devices[i],
                boxes[i].number_of_devices,
                '£' + boxes[i].total_cost,
                row,
            ]).node().id = boxes[i].id;
            
            bayedBoxesTable.draw(false);
        }
    }

    $('#removefromlot').prop('disabled', true);
    handleRightButtons();

}

function getTotalQty(){
    var table = $('#added-tradeins-building-lot').DataTable();

    $('#total_qty').html(table.data().count() / 6);
}

function getTotalCost(){
    var table = $('#added-tradeins-building-lot').DataTable();

    $('#total_cost').html( '£' + table.column(4).data().sum());
}

function hideLoader(){
    $('#sales-lot-loader').addClass('invisible');
    $('#sales-lot-content').removeClass('hidden');
}