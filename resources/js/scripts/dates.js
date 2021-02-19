$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.deletedate').on('click', function(){

    var dateid = $(this).prop('id');
    
    var c=confirm('Are you sure you want to delete non-working date from system?');

    if(c){

        $.ajax({
            url: "/portal/settings/non-working-days/remove-non-working-days",
            type:"POST",
            data:{
                dateid:dateid,
            },
            success:function(response){
                location.reload();
            },
        });

    }

});