/*$('#sellmobilephones-header-hover').hide();
$('#selltablets-header-hover').hide();
$('#sellwatches-header-hover').hide();
$('#whysellwithus-header-hover').hide();*/


$(document).ready(function(){

    /*if($('sellmobilephones-header-hover')){
        $('#sellmobilephones-header-hover').hide();
    }
    if($('selltablets-header-hover')){
        $('#selltablets-header-hover').hide();
    }
    if($('sellwatches-header-hover')){
        $('#sellwatches-header-hover').hide();
    }
    if($('whysellwithus-header-hover')){
        $('#whysellwithus-header-hover').hide();
    }*/

    if($('#sellmobilephones-header-link')){
        $('#sellmobilephones-header-link').on('click', function(){
    
            window.open('/sell/shop/mobile/all', '_self');
    
        });

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
        $('#selltablets-header-link').on('click', function(){
    
            window.open('/sell/shop/tablets/all', '_self');
    
        });

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
        $('#sellwatches-header-link').on('click', function(){

            window.open('/sell/shop/watches/all', '_self');
    
        });

        $('#sellwatches-header-link, #sellwatches-header-hover').hover(
            function(){
                $('#sellwatches-header-hover').show();
            },
            function(){
                $('#sellwatches-header-hover').hide();
            }
        );
    }

    if($('#whysellwithus-header-link')){
        $('#whysellwithus-header-link').on('click', function(){
            
            window.open('/sell/why', '_self');
    
        });

    }

});

