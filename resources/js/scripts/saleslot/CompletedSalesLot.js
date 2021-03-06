
$(document).ready(function(){

    if(document.getElementById('completed-sales-lots-table')){
        $('#completed-sales-lots-table tfoot td').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );    
    
        var completedSalesLotTable = $('#completed-sales-lots-table').DataTable({
            "oLanguage" : {
                "sInfo" : "Showing _START_ to _END_",
             },
             "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
             "pageLength":-1,
             "ordering": false,
             paging: false,
             info: false
        });

        completedSalesLotTable.columns().every( function () {
    
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

    if(document.getElementById('saleslot-table')){
        $('#saleslot-table tfoot td').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );    
        
        var boxsummarytable = $('#saleslot-table').DataTable({
            "oLanguage" : {
                "sInfo" : "Showing _START_ of _END_",
             },
             "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
             "pageLength":-1,
        });
        
        
        boxsummarytable.columns().every( function () {
            
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

    if(document.getElementById('salelotcontent')){
        $('#salelotcontent tfoot td').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } ); 
        
        var salelotcontenttable = $('#salelotcontent').DataTable();
        
        
        /*salelotcontenttable.columns().every( function () {
            
            var that = this;
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        });*/
    }

});

$('.saleslots').on('click', function(){

    $('.saleslots').each(function(){
        $(this).removeClass('saleslot-active');
    })

    $(this).addClass('saleslot-active');

    switch($(this).data('status')){
        case 1:
            $('#view-sales-lot-btn').prop('disabled', false);
            $('#edit-lot-btn').prop('disabled', false);
            $('#sell-lot-btn').prop('disabled', false);
            break;
        case 2:
            $('#view-sales-lot-btn').prop('disabled', false);
            $('#edit-lot-btn').prop('disabled', true);
            $('#sell-lot-btn').prop('disabled', true);
            $('#payment-received-btn').prop('disabled', false);
            break;
        case 3:
            $('#view-sales-lot-btn').prop('disabled', false);
            $('#edit-lot-btn').prop('disabled', true);
            $('#sell-lot-btn').prop('disabled', true);
            $('#payment-received-btn').prop('disabled', false);
        case 4:

        case 5:
    }

    $('#sales-export-btn').prop('disabled', false);
    $('#ism-pre-alert').prop('disabled', false);

});

$('#view-sales-lot-btn').on('click', function () {

    var selectedid = $('.saleslot-active').attr('id');

    window.open('/portal/sales-lot/completed-sales-lot/view-lot/' + selectedid, '_self');

});

$('#edit-lot-btn').on('click', function(){

    var selectedid = $('.saleslot-active').attr('id');

    window.open('/portal/sales-lot/building-sales-lot/' + selectedid, '_self');

});

$('#sell-lot-btn').on('click', function () {

    $('#salelot-action').modal('show');

    var selectedid = $('.saleslot-active').attr('id');
    var selectedquantity = $('.saleslot-active td:nth-child(3) > div:nth-child(1)').html();
    //console.log(selectedquantity);

    $('#salelot-action #salelot-number').html(selectedid);
    $('#salelot-action #salelot-number-value').val(selectedid);
    $('#salelot-action #device-qty').html(selectedquantity);

});

$('#payment-received-btn').on('click', function () {
    var selectedid = $('.saleslot-active').attr('id');
    if (confirm("Do you want to mark Lot " + selectedid + " as 'Payment Recieved?")) {
        // Save it!
        $.ajax({
            type: "POST",
            url: "/portal/sales-lot/completed-sales-lot/markaspaymentrecieved",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                lot_id: selectedid
            },
            success: function (data) {
                if (data.success) {
                    if (data.success === 200) {
                        window.location.reload();
                    }
                }
                location.reload();
            },
            error: function (data) {
                alert(data.responseText);
            }
        });
    }
});

$('#sales-export-btn').on('click', function () {
    var selectedid = $('.saleslot-active').attr('id');
    window.open("/portal/sales-lot/completed-sales-lot/clientsalesexport/" + selectedid);
});

$('#ism-pre-alert').on('click', function () {
    var selectedid = $('.saleslot-active').attr('id');
    window.open("/portal/sales-lot/completed-sales-lot/ismprealert/" + selectedid);
});

$('#export-xls-data').on('click', function(){
    var selectedid = $('.saleslot-active').attr('id');
    window.open("/portal/sales-lot/completed-sales-lot/exportxls/" + selectedid);
});



//picking despatch
$('.salelotlist_picking').on('click', function(){

    if($(this).hasClass('salelotlist_picking_active')){
        $(this).removeClass('salelotlist_picking_active');
    }
    else{
        $('.salelotlist_picking').each(function(){
            $(this).stop(false, false);
            $(this).removeClass('salelotlist_picking_active');
        });
        $(this).toggleClass('salelotlist_picking_active');
    }

    if($(this).hasClass('salelotlist_picking_active')){
        $('#starttopicklot').prop('disabled', false);
    }
    else{
        $('#starttopicklot').prop('disabled', true);
    }

    if ($(this).hasClass('salelotlist_picking_active')) {
        $('#printpicknote').prop('disabled', false);
    } else {
        $('#starttopicklot').prop('disabled', true);
    }

    if ($(this).hasClass('salelotlist_picking_active')) {
        if($(this).data('status') === 4){
            $('#despatchpickingsaleslot').prop('disabled', false);
        }
        else{
            $('#despatchpickingsaleslot').prop('disabled', true);
        }
        
    } else {
        $('#despatchpickingsaleslot').prop('disabled', true);
    }

    let id = $(this).prop('id');
    fetchSaleLotData(id);

});

$('#starttopicklot').on('click', function(){

    var status = $('.salelotlist_picking_active').data('status');
    var id = $('.salelotlist_picking_active').prop('id');

    var picked = $('.salelotlist_picking_active').data('picked');

    if(status === 2 || status === 4 || status === 6){
        if(picked === 1){
            alert("This was picked.");
        }
        else{
            window.open('/portal/warehouse-management/picking-despatch/pick-lot/' + id, '_self');
        }
        
    }
    else{
        alert("This lot cannot be picked.");
    }

});

$('#printpicknote').on('click', function(){
    var id = $('.salelotlist_picking_active').prop('id');
    window.open('/portal/warehouse-management/picking-despatch/print-pick-note/' + id, '_blank');
});

$('#despatchpickingsaleslot').on('click', function(){

    salesLotId = $('.salelotlist_picking_active').prop('id');
    $('#buildsaleslot_salelot').val(salesLotId);
    /*
    $.ajax({
        url: "/portal/warehouse-management/picking-despatch/pick-lot/despatch-picking",
        type:"POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
            salesLotId:salesLotId,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            location.reload();
        },
    });*/
});


function fetchSaleLotData(id){
    $.ajax({
        url: "/portal/warehouse-management/picking-despatch/getsalelotdata/" + id,
        type:"GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){

            var test = $('#salelotcontent').DataTable();

            test.destroy();

            var salelotcontent = $('#salelotcontent').DataTable({
                "oLanguage" : {
                    "sInfo" : "Showing _START_ of _END_",
                 },
                 "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                 "pageLength":-1,
            });

            $('#salelotcontent tfoot td').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );    

            salelotcontent.columns().every( function () {
    
                var that = this;
                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            });

            salelotcontent.clear().draw(true);

            for(var i = 0; i < response.length; i++){
                salelotcontent.row.add(response[i]).draw(true);
            }

        },
        error:function(response){
            alert('Something went wrong. Please try again.');
        }
    });
}