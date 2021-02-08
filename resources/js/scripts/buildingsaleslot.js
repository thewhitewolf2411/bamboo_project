const { isEmpty } = require("lodash");

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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
});

$('#addtolot').on('click', function(){


    var checkedboxes = $('.box-click:checkbox:checked');
    var checkedtradeins = $('.tradein-click:checkbox:checked');
    var checkedboxesid = [];
    var checkedtradeinsid = [];

    if(checkedtradeins.length + checkedboxes.length >= 1){
        $('#removefromlot').css("opacity", 1);
        $('#buildalot').prop("disabled", false);
    }

    for(var i=0; i<checkedtradeins.length; i++){
        checkedtradeinsid.push(checkedtradeins[i].id);
    }

    for(var i=0; i<checkedboxes.length; i++){
        checkedboxesid.push(checkedboxes[i].id);
    }

    console.log(checkedboxesid);

    for(var i=0; i<checkedboxesid.length; i++){

        $('#box-' + checkedboxesid[i]).find('td:last-child').remove();

        $('#selected-boxes').append('<tr id="'+ checkedboxesid[i] +'">' + $('#box-' + checkedboxesid[i]).html() + '</tr>');
        
        $('.' + checkedboxesid[i]).parent().remove();
        $('#box-' + checkedboxesid[i]).remove();

    }

    for(var i=0; i<checkedtradeinsid.length; i++){

        $('#tradein-' + checkedtradeinsid[i]).find('td:last-child').remove();

        $('#selected-tradeins').append('<tr id="'+ checkedtradeinsid[i] +'">' + $('#tradein-' + checkedtradeinsid[i]).html() + '</tr>');
        $('#tradein-' + checkedtradeinsid[i]).remove();

    }

});

$('.clickable').on('click', function(){
    var k=0;
    var chckbox = $('.clickable');

    for(var i=0; i<chckbox.length; i++){
        if(chckbox[i].checked){
            k++;
        }
    }

    if(k>0){
        $('#addtolot').css("opacity", 1);
    }
    else{
        $('#addtolot').css("opacity", 0.65);
    }

});

$('#removefromlot').on('click', function(){

    location.reload(true);

});

$('#buildalot').on('click', function(){

    if(confirm("Are you sure that you want to build a lot with selected tradeins/boxes?")){
        var checkedtradeins = $('#selected-tradeins tr');
        var checkedtradeinsid = [];

        for(var i=0; i<checkedtradeins.length; i++){
            if(!isEmpty(checkedtradeins[i].id)){
                checkedtradeinsid.push(checkedtradeins[i].id);
            }
        }


        var checkedboxes = $('#selected-boxes tr');
        var checkedboxesid = [];

        for(var i=0; i<checkedboxes.length; i++){
            if(!isEmpty(checkedboxes[i].id)){
                checkedboxesid.push(checkedboxes[i].id);
            }
        }

        $.ajax({
            url: "/portal/sales-lot/building-sales-lot/build-lot",
            type:"POST",
            data:{
                checkedtradeinsid:checkedtradeinsid,
                checkedboxesid:checkedboxesid,
            },
            success:function(response){
                location.reload(true);
            },
        });
    }

    

});