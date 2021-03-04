$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){

    $('#box-in-progress-table tfoot td').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );    

    var boxinprogresstable = $('#box-in-progress-table').DataTable();

    // Apply the search
    boxinprogresstable.columns().every( function () {

        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );

    $('#boxed-devices-table tfoot td').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );    

    var boxeddevicetable = $('#boxed-devices-table').DataTable();

    // Apply the search
    boxeddevicetable.columns().every( function () {

        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );

    $('#box-summary-table tfoot td').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );    

    var boxsummarytable = $('#box-summary-table').DataTable();

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

$('#box-in-progress').on('click', function(){

    $('#boxed-devices').removeClass('btn-red');
    $('#boxes-summary').removeClass('btn-red');
    
    $(this).toggleClass('btn-red');
    if($('#box-in-progress-table-container').hasClass('box-table-hidden')){
        $('#box-in-progress-table-container').removeClass('box-table-hidden');
        $('#box-in-progress-table-container').addClass('box-table-show');
    }
    else{
        $('#box-in-progress-table-container').addClass('box-table-hidden');
        $('#box-in-progress-table-container').removeClass('box-table-show');
    }

    $('#boxed-devices-table-container').addClass('box-table-hidden');
    $('#boxed-devices-table-container').removeClass('box-table-show');

    $('#box-summary-table-container').addClass('box-table-hidden');
    $('#box-summary-table-container').removeClass('box-table-show');

});


$('#boxed-devices').on('click', function(){

    $('#box-in-progress').removeClass('btn-red');
    $('#boxes-summary').removeClass('btn-red');
    
    $(this).toggleClass('btn-red');
    if($('#boxed-devices-table-container').hasClass('box-table-hidden')){
        $('#boxed-devices-table-container').removeClass('box-table-hidden');
        $('#boxed-devices-table-container').addClass('box-table-show');
    }
    else{
        $('#boxed-devices-table-container').addClass('box-table-hidden');
        $('#boxed-devices-table-container').removeClass('box-table-show');
    }

    $('#box-in-progress-table-container').addClass('box-table-hidden');
    $('#box-in-progress-table-container').removeClass('box-table-show');

    $('#box-summary-table-container').addClass('box-table-hidden');
    $('#box-summary-table-container').removeClass('box-table-show');

});



$('#boxes-summary').on('click', function(){

    $('#boxed-devices').removeClass('btn-red');
    $('#box-in-progress').removeClass('btn-red');

    $(this).toggleClass('btn-red');
    if($('#box-summary-table-container').hasClass('box-table-hidden')){
        $('#box-summary-table-container').removeClass('box-table-hidden');
        $('#box-summary-table-container').addClass('box-table-show');
    }
    else{
        $('#box-summary-table-container').addClass('box-table-hidden');
        $('#box-summary-table-container').removeClass('box-table-show');
    }

    $('#box-in-progress-table-container').addClass('box-table-hidden');
    $('#box-in-progress-table-container').removeClass('box-table-show');

    $('#boxed-devices-table-container').addClass('box-table-hidden');
    $('#boxed-devices-table-container').removeClass('box-table-show');

});