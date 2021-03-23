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
    $('#salelot-action #salelot-number-value').val(selectedid);
    $('#salelot-action #device-qty').html(selectedquantity);

});

$('#payment-received-btn').on('click', function(){
    var selectedid =  $('.saleslot-active').attr('id');
    if (confirm("Do you want to mark Lot " + selectedid + " as 'Payment Recieved?")) {
        // Save it!
        $.ajax({
            type: "POST",
            url: "/portal/sales-lot/completed-sales-lot/markaspaymentrecieved",
            data: {
                lot_id: selectedid
            },
            success: function(data){
                if(data.success){
                    if(data.success === 200){
                        window.location.reload();
                    }
                }
            },
            error: function(data){
                alert(data.responseText);
            }
          });
    }
});

$('#sales-export-btn').on('click', function(){
    var selectedid =  $('.saleslot-active').attr('id');
    window.open("/portal/sales-lot/completed-sales-lot/clientsalesexport/"+selectedid);
});

$('#ism-pre-alert').on('click', function(){
    var selectedid =  $('.saleslot-active').attr('id');
    window.open("/portal/sales-lot/completed-sales-lot/ismprealert/"+selectedid);
});

$(document).ready(function(){

    $('#boxedtradeinstable tfoot td').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );    

    var boxsummarytable = $('#boxedtradeinstable').DataTable({
        "oLanguage" : {
            "sInfo" : "Showing _START_ to _END_",
         },
    });
    
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

    $('#closedboxtable tfoot td').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );    

    var closedboxtable = $('#closedboxtable').DataTable({
        "oLanguage" : {
            "sInfo" : "Showing _START_ to _END_",
         },
    });
    
    // Apply the search
    closedboxtable.columns().every( function () {
    
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    });


    $('#boxedtradeinstable_wrapper').addClass('table-visible');
    $('#closedboxtable_wrapper').addClass('table-invisible');

});
