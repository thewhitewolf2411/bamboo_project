/*$('#sellmobilephones-header-hover').hide();
$('#selltablets-header-hover').hide();
$('#sellwatches-header-hover').hide();
$('#whysellwithus-header-hover').hide();*/


$(function() {

    if($('#sellmobilephones-header-link')){

        $('#sellmobilephones-header-link, #sellmobilephones-header-hover').hover(
            function(){
                $('#sellmobilephones-header-hover').show();
            }, 
            function(){
                $('#sellmobilephones-header-hover').hide();
            }
        );
    }

    if($('#selltablets-header-link')){
        $('#selltablets-header-link, #selltablets-header-hover').hover(
            function(){
                $('#selltablets-header-hover').show();
            },
            function(){
                $('#selltablets-header-hover').hide();
            }
        );
    }

    if($('#sellwatches-header-link')){
        $('#sellwatches-header-link, #sellwatches-header-hover').hover(
            function(){
                $('#sellwatches-header-hover').show();
            },
            function(){
                $('#sellwatches-header-hover').hide();
            }
        );
    }


});

