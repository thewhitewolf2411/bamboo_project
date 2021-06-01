/*$('#sellmobilephones-header-hover').hide();
$('#selltablets-header-hover').hide();
$('#sellwatches-header-hover').hide();
$('#whysellwithus-header-hover').hide();*/


window.addEventListener('DOMContentLoaded', () => {

    if($('#sellmobilephones-header-link')){

        $('#sellmobilephones-header-link, #sellmobilephones-header-hover').hover(
            function(){
                //$('#sellmobilephones-header-hover').show();
                $('#sellmobilephones-header-link').addClass('white-bg');
                $('#selling-icon-dropdown-mobile').removeClass('down');
                $('#selling-icon-dropdown-mobile').addClass('up');
                $('#sellmobilephones-header-hover').removeClass('not-visible');
                $('#sell-mobile-text').addClass('orange');
            }, 
            function(){
                //$('#sellmobilephones-header-hover').hide();
                $('#selling-icon-dropdown-mobile').addClass('down');
                $('#selling-icon-dropdown-mobile').removeClass('up');
                $('#sellmobilephones-header-hover').addClass('not-visible');
                $('#sellmobilephones-header-link').removeClass('white-bg');
                $('#sell-mobile-text').removeClass('orange');

            }
        );
    }

    if($('#selltablets-header-link')){
        $('#selltablets-header-link, #selltablets-header-hover').hover(
            function(){
                // $('#selltablets-header-hover').show();
                $('#selling-icon-dropdown-tablets').removeClass('down');
                $('#selling-icon-dropdown-tablets').addClass('up');
                $('#selltablets-header-hover').removeClass('not-visible');
                $('#selltablets-header-link').addClass('white-bg');
                $('#sell-tablets-text').addClass('orange');
            },
            function(){
                // $('#selltablets-header-hover').hide();\
                $('#selling-icon-dropdown-tablets').addClass('down');
                $('#selling-icon-dropdown-tablets').removeClass('up');
                $('#selltablets-header-hover').addClass('not-visible');
                $('#selltablets-header-link').removeClass('white-bg');
                $('#sell-tablets-text').removeClass('orange');
            }
        );
    }

    if($('#sellwatches-header-link')){
        $('#sellwatches-header-link, #sellwatches-header-hover').hover(
            function(){
                // $('#sellwatches-header-hover').show();
                $('#selling-icon-dropdown-watches').removeClass('down');
                $('#selling-icon-dropdown-watches').addClass('up');
                $('#sellwatches-header-hover').removeClass('not-visible');
                $('#sellwatches-header-link').addClass('white-bg');
                $('#sell-watches-text').addClass('orange');
            },
            function(){
                // $('#sellwatches-header-hover').hide();
                $('#selling-icon-dropdown-watches').addClass('down');
                $('#selling-icon-dropdown-watches').removeClass('up');
                $('#sellwatches-header-hover').addClass('not-visible');
                $('#sellwatches-header-link').removeClass('white-bg');
                $('#sell-watches-text').removeClass('orange');
            }
        );
    }


});

