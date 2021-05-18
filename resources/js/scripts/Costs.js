$('.misccost-select').on('change', function(){
    var numberOfChecked = $('.misccost-select:checked').length;

    if(numberOfChecked > 0){
        $('#deletemisccost').prop('disabled', false);
    }
    else{
        $('#deletemisccost').prop('disabled', true);
    }
});

$('#deletemisccost').on('click', function(){

    var selected = [];
    $('.misccost-select:checked').each(function() {
        selected.push($(this).data('value'));
    });

    var c = confirm('Are you sure you want to delete selected Miscellaneous costs?');

    if(c){
        $.ajax({
            url: "/portal/settings/costs/delete",
            type:"POST",
            data:{
                selected:selected,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){
                location.reload();
            }
        });
    }

});