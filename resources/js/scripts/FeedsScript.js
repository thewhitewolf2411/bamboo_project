$('.feed-container').on('click', function(){

    feedid = $(this).data('value');

    $.ajax({
        url: "/portal/feeds/summary/getLogs",
        type:"GET",
        data:{
            feedid:feedid,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            for(var i = 0; i<response.length; i++){
                
                $('#feed-logs-table tbody').append('<tr><th>' + response[i].id + '</th><th>' + response[i].error_log + '</th><th>' + response[i].created_at + '</th></tr>');
            }
        }
    });



    $('#view-feeds-log').modal('show');

});

$('#view-feeds-log').on('hide.bs.modal', function(){

    $('#feed-logs-table tbody').empty();

});

