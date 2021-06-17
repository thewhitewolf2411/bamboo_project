$(document).ready(function(){

    if(document.getElementById('pick-sales-lot-devices')){
        $('#pick-sales-lot-devices tfoot td').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );    
    
        var pickdevicestable = $('#pick-sales-lot-devices').DataTable({
            "oLanguage" : {
                "sInfo" : "Showing _START_ to _END_",
             },
             "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
             "pageLength":-1,
        });
    
        // Apply the search
        pickdevicestable.columns().every( function () {
    
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

    $('#completepickingsaleslot').on('click', function(){

        var salelotid = $('#buildsaleslot_salelot').val();

        $.ajax({
            url: "/portal/warehouse-management/picking-despatch/pick-lot/complete-picking",
            type:"POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                salelotid:salelotid
            },
            success:function(response){
    
                window.location.href = '/portal/warehouse-management/picking-despatch';
            }
        });

    });

});