$('#changetoviewtradeins').on('click', function(){
    if(!($('#boxedtradeinstable').hasClass('table-visible'))){
        $('#boxedtradeinstable').addClass('table-visible');
        $('#closedboxtable').addClass('table-invisible');

        $('#boxedtradeinstable').removeClass('table-invisible');
        $('#closedboxtable').removeClass('table-visible');

        $('#changetoviewtradeins div').removeClass('btn-primary-nonactive');
        $('#changetoviewtradeins div').addClass('btn-primary-active');

        $('#changetoviewboxes div').addClass('btn-primary-nonactive');
        $('#changetoviewboxes div').removeClass('btn-primary-active');
    }
});

$('#changetoviewboxes').on('click', function(){
    if(!($('#closedboxtable').hasClass('table-visible'))){
        $('#closedboxtable').addClass('table-visible');
        $('#boxedtradeinstable').addClass('table-invisible');

        $('#closedboxtable').removeClass('table-invisible');
        $('#boxedtradeinstable').removeClass('table-visible');

        $('#changetoviewboxes div').removeClass('btn-primary-nonactive');
        $('#changetoviewboxes div').addClass('btn-primary-active');

        $('#changetoviewtradeins div').addClass('btn-primary-nonactive');
        $('#changetoviewtradeins div').removeClass('btn-primary-active');
    }
})