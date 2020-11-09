basePrices = null;
network = null;
grade = null;

networkName = null;
memoryValue = null;

function networkChanged(element){

    var label = $("label[for='" + $(element).attr('id') + "']");

    var networks =  $('.network-container');
    
    for(var i = 0; i<networks.length; i++){
        networks[i].classList.add('network-container-disabled');
    }
    label.removeClass('network-container-disabled');

    network = element.value;

    networkName = label.attr("id");

    getPrice();

}

function gradeChanged(element){
    var label = $("label[for='" + $(element).attr('id') + "']");

    var grades = $('.elem-grade-container');

    for(var i = 0; i<grades.length; i++){
        grades[i].classList.add('elem-grade-container-deselected');
    }
    label.removeClass('elem-grade-container-deselected');

    grade = element.value;

    getPrice();
}

function memoryChanged(element){
    var label = $("label[for='" + $(element).attr('id') + "']");

    var grades = $('.memory-container');

    for(var i = 0; i<grades.length; i++){
        grades[i].classList.add('memory-container-deselected');
    }
    label.removeClass('memory-container-deselected');

    basePrices = JSON.parse(element.value);
    memoryValue = label.attr("id");

    getPrice();
}

function getPrice(){

    var basePrice = 0;
    if(basePrices != null && grade != null && network != null){
        
        basePrice = Object.values(basePrices)[grade-1] - network;

        $('#product-price').text('£' + basePrice);

        console.log(grade);

        if(grade == 1){
            $('#grade').val('Excellent Working');
        }
        if(grade == 2){
            $('#grade').val('Good Working');
        }
        if(grade == 3){
            $('#grade').val('Poor Working');
        }
        if(grade == 4){
            $('#grade').val('Damaged Working');
        }
        if(grade == 5){
            $('#grade').val('Faulty');
        }

        $('#memory').val(memoryValue);
        $('#network').val(networkName);
        $('#price').val(basePrice);


        $("#addToCart").prop('disabled', false);
    }
    else{
        $("#addToCart").prop('disabled', true);
    }
        
}