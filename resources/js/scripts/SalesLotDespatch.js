const { each } = require("jquery");

$('.tagfordespatch').on('change', function(){

    if($('.tagfordespatch:checked').length>0){
        $('#despatchpickingsaleslot').prop('disabled', false);
    }
    else{
        $('#despatchpickingsaleslot').prop('disabled', true);
    }
});

$('.saleslotpicking').on('click', function(){

    if($(this).hasClass('saleslot-active')){
        $(this).removeClass('saleslot-active');
    }
    else{
        $('.saleslotpicking').each(function(){
            $(this).stop(false, false);
            $(this).removeClass('saleslot-active');
        });
        $(this).toggleClass('saleslot-active');
    }

    if($(this).hasClass('saleslot-active')){
        $('#starttopicklot').prop('disabled', false);
    }
    else{
        $('#starttopicklot').prop('disabled', true);
    }

    if ($(this).hasClass('saleslot-active')) {
        $('#printpicknote').prop('disabled', false);
    } else {
        $('#starttopicklot').prop('disabled', true);
    }
});

$('#starttopicklot').on('click', function(){

    var status = $('.saleslot-active').data('status');
    var id = $('.saleslot-active').prop('id');

    if(status === 2 || status === 6){
        window.open('/portal/warehouse-management/picking-despatch/pick-lot/' + id, '_self');
    }
    else{
        alert("This lot cannot be picked yet.");
    }

});

$('#despatchpickingsaleslot').on('click', function(){


    var c = confirm("Are you sure you want to mark " + $('.tagfordespatch:checked').length + " sales lots as despatched?");

    if(c){

        var salesLotIds = [];

        $('.tagfordespatch:checked').each(function(){

            var salelotid = $(this).data('value');

            salesLotIds.push(salelotid);

        });

        $.ajax({
            url: "/portal/warehouse-management/picking-despatch/pick-lot/despatch-picking",
            type:"POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                salesLotIds:salesLotIds,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){
                location.reload();
            },
        });
    }

});


$('#printpicknote').on('click', function(){
    var id = $('.saleslot-active').prop('id');
    window.open('/portal/warehouse-management/picking-despatch/print-pick-note/' + id, '_blank');
});

$(document).ready(function(){

    $('#pick-sales-lot-boxes tfoot td').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );    

    var quarantineTable = $('#pick-sales-lot-boxes').DataTable({
        "oLanguage" : {
            "sInfo" : "Showing _START_ to _END_",
         },
         "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
         "pageLength":-1,
    });

    quarantineTable.columns().every( function () {
    
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    });

    $('#pick-sales-lot-devices tfoot td').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );    

    var quarantineTable = $('#pick-sales-lot-devices').DataTable({
        "oLanguage" : {
            "sInfo" : "Showing _START_ to _END_",
         },
         "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
         "pageLength":-1,
    });

    quarantineTable.columns().every( function () {
    
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    });
});