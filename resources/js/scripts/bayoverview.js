$('.baydelete').on('click', function(){
    var bayname = $(this).attr('id');

    $.ajax({
        url: "/portal/warehouse-management/bay-overview/deletebay",
        type:"POST",
        data:{
            bayname:bayname,
        },
        success:function(response){
            location.reload();
        },
    });
});

$('.bayprint').on('click', function(){
    var bayname = $(this).attr('id');

    $.ajax({
        url: "/portal/warehouse-management/bay-overview/printbay",
        type:"POST",
        data:{
            bayname:bayname,
        },
        success:function(data, textStatus, xhr){
            window.open(data);
        },
        error:function(data, textStatus, xhr){
            alert('Something went wrong. Please try again.');
        },
    });
});