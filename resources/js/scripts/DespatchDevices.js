$(document).ready(function(){

    if($('#despatch-devices-table')){

        $('#despatch-devices-table tfoot td').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );    
    
        var despatchTable = $('#despatch-devices-table').DataTable({
            "oLanguage" : {
                "sInfo" : "Showing _START_ to _END_",
             },
             "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
             "pageLength":100,
        });
    
        despatchTable.columns().every( function () {
        
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

});