$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.saleslots').on('click', function(){

    $('.saleslots').each(function(){

        $(this).removeClass('saleslot-active');

    });

    $(this).addClass('saleslot-active');

    $('#saleslot-option-buttons button').prop('disabled', false);

});


$('#view-sales-lot-btn').on('click', function(){

    var selectedid =  $('.saleslot-active').attr('id');

    window.open('/portal/sales-lot/completed-sales-lot/view-lot/' + selectedid, '_self');

});

$('#sell-lot-btn').on('click', function(){

    $('#salelot-action').modal('show');

    var selectedid =  $('.saleslot-active').attr('id');
    var selectedquantity = $('.saleslot-active td:nth-child(3) > div:nth-child(1)').html();
    //console.log(selectedquantity);

    $('#salelot-action #salelot-number').html(selectedid);
    $('#salelot-action #device-qty').html(selectedquantity);

});

$(document).ready(function(){

    $('#boxedtradeinstable tfoot td').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );    

    var boxsummarytable = $('#boxedtradeinstable').DataTable();
    
    // Apply the search
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

});
