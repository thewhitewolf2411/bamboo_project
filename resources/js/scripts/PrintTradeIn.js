$('.print-one-tradein').on('click', function(){
    //Set new value for trade_pack_trade_in_id hidden input

    var barcode = $(this).attr('data-barcode');

    $('#print_trade_pack_trade_in_id').val(barcode);

    //Trigger printing
    $('#print_trade_pack_trade_in_trigger').click();
})

window.printTradePackTradeInBulk = function(){
    //Trigger printing

    $('#number_of_bulk_prints').val();

    $('#print_trade_pack_bulk_form_trigger').click();
}

window.printDeviceLabel = function(print_device_id){
    //Set new value for trade_pack_trade_in_id hidden input
    $('#print_device_id').val(print_device_id);

    //Trigger printing
    $('#print_device_barcode').click();
}

window.printTradePackTradeIn = function(tradein_id){
    $('#print_trade_pack_trade_in_id').val(tradein_id);

    $('#print_trade_pack_trade_in_trigger').click();
}

window.printDeviceLabelOrderManagemet = function(print_device_id){

    $.ajax({
        url: "/portal/customer-care/printdevicelabel",
        type:"POST",
        data:{
            print_device_id:print_device_id,
            ajax:true,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            $(document).ready(function(){
                $('#tradein-iframe').attr('src', '/' + response + '.pdf');
                $('#label-trade-in-modal').modal('show');
            });
        },
        error:function(response){
            console.log(response);
        }
    });
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

window.deleteTradeInDetailsFromSystem = function(id){
    $('#delete_trade_in_id').val(id);
    $('#delete_trade_in_button').click();
}

$('#tradein-checkallbtn').on('click', function(){

    $('.printcheckbox').prop('checked', false);

    $('.printcheckbox').slice(0, 50).prop('checked', this.checked);

});

$('.printcheckbox').on('click', function(){

    var numberOfChecked = $('.printcheckbox:checked').length;

    if($(this).is('checked')){
        $(this).prop('checked', false);        
    }
    else{
        if(numberOfChecked >= 50){
            $(this).prop('checked', false);
        }
    }

});

$('#print_trade_pack_bulk_form_trigger').on('click', function(){

    var selected = [];
    $('.printcheckbox:checked').each(function() {
        selected.push($(this).attr('name'));
    });

    /*$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });*/

    $.ajax({
        url: "/portal/customer-care/trade-in/printlabelbulk",
        type:"POST",
        data:{
            selected:selected,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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

$(document).ready(function(){
    if($('#trade-pack-table')){

        $('#trade-pack-table tfoot td:not(:last-child)').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );    
    
        var tradepacktable = $('#trade-pack-table').DataTable({
            "oLanguage" : {
                "sInfo" : "Showing _START_ to _END_",
             },
        });
    
        // Apply the search
        tradepacktable.columns().every( function () {
    
            var that = this;
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );

    }

    if($('#trade-in-table')){

        $('#trade-in-table tfoot td:not(:last-child)').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );    
    
        $('#trade-in-table tfoot td:last-child').each( function () {
            $(this).html( '' );
        } );    

        var tradeintable = $('#trade-in-table').DataTable({
            "oLanguage" : {
                "sInfo" : "Showing _START_ to _END_",
             },
        });
    
        // Apply the search
        tradeintable.columns().every( function () {
    
            var that = this;
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );

    }

    if($('#order-management-table')){
        $('#order-management-table tfoot td:not(:last-child)').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );    
    
        $('#order-management-table tfoot td:last-child').each( function () {
            $(this).html( '' );
        } );    
        $('#order-management-table tfoot td:nth-child(12)').each( function () {
            $(this).html( '' );
        } ); 
        $('#order-management-table tfoot td:nth-child(13)').each( function () {
            $(this).html( '' );
        } ); 

        var ordermanagementtable = $('#order-management-table').DataTable({
            "oLanguage" : {
                "sInfo" : "Showing _START_ to _END_",
             },
             "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
             "pageLength": -1
        });
    
        // Apply the search
        ordermanagementtable.columns().every( function () {
    
            var that = this;
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    }
});


