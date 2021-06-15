$(document).ready(function(){

    if(document.getElementById('edit_lot_id')){

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

        fetchSaleLotData($('#edit_lot_id').val());
    }

});


function fetchSaleLotData(sale_lot_id){
    

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

    $.ajax({
        url: "/portal/sales-lot/building-sales-lot/build-lot/getSaleLotTradeins",
        type:"GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
            sale_lot_id:sale_lot_id
        },
        success:function(response){

            setSaleLotTradeins(response);
        }
    });

}

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
            boxes[i].number_of_devices - boxes[i].added_qty,
            boxes[i].number_of_devices,
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
}

function setSaleLotTradeins(tradeins){

    var addedTradeinTable = $('#added-tradeins-building-lot').DataTable();

    //

    for(var i=0; i<tradeins.length; i++){
        var row = '<input class="added_tradeins" type="checkbox" id="tradein_' + tradeins[i].id + '" data-id="' + tradeins[i].id + '">';

        addedTradeinTable.row.add([
            tradeins[i].tray_name,
            tradeins[i].bamboo_grade,
            tradeins[i].product_name,
            tradeins[i].correct_memory,
            '£' + tradeins[i].device_cost,
            row
            ]).node().id = tradeins[i].id;
    }
    
    addedTradeinTable.draw(false);

    hideLoader();
}

function hideLoader(){
    $('#sales-lot-loader').addClass('invisible');
    $('#sales-lot-content').removeClass('hidden');
}


$('#editlot').on('click', function(){

    var addedTradeins = [];
    var edit_lot_id = $('#edit_lot_id').val();

    $('#added-tradeins-building-lot tbody tr').each(function(){
        addedTradeins.push($(this).prop('id'));
    });

    $.ajax({
        url: "/portal/sales-lot/building-sales-lot/edit-lot",
        type:"POST",
        data:{
            addedTradeins:addedTradeins,
            edit_lot_id:edit_lot_id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            if(response){
                alert("Lot has been Edited");
                window.open('/portal/sales-lot/completed-sales-lots/', '_self');
            }
        }
    });


});