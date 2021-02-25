$('.deleteclient').on('click', function(){

    var clientid = $(this).attr('data-value');

    var c = confirm("Are you sure you want to delete client " + clientid + "?");

    if(c){
        $.ajax({
            url: "/portal/settings/clients/delete",
            type:"POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                clientid:clientid,
            },
            success:function(response){
                location.reload();
            },
        });
    }

});