basePrices = null;
network = null;
grade = null;

networkName = null;
memoryValue = null;

HAS_NETWORKS = true;

document.addEventListener("DOMContentLoaded", function(e) {
    let memory_available = document.getElementsByClassName('device-memory');
    if(memory_available.length === 1){
        // preselect it
        memory_available[0].childNodes[0].click();
    }

    let network_available = document.getElementsByClassName('device-network');
    if(network_available.length === 1){
        // preselect it
        network_available[0].click();
    }

    // frontend validation
    document.getElementById('addToCart').addEventListener('click', function(e){
        e.preventDefault();
        let errorNetwork = document.getElementById('please-select-network');
        let errorMemory = document.getElementById('please-select-memory');
        let errorGrade = document.getElementById('please-select-grade');

        let isValid = true;
        if(!network){
            isValid = false;
            errorNetwork.classList.remove('invisible');
            setTimeout(function(){
                errorNetwork.classList.add('invisible');
            }, 3000);
        }
        if(!memoryValue){
            isValid = false;
            errorMemory.classList.remove('invisible');
            setTimeout(function(){
                errorMemory.classList.add('invisible');
            }, 3000);
        }
        if(!grade){
            isValid = false;
            errorGrade.classList.remove('invisible');
            setTimeout(function(){
                errorGrade.classList.add('invisible');
            }, 3000);
        }

        if(isValid){
           document.getElementById('selldeviceform').submit();
        }
        
    });
});



function networkChanged(element){

    var label = $("label[for='" + $(element).attr('id') + "']");

    var networks =  $('.network-container');
    
    for(var i = 0; i<networks.length; i++){
        networks[i].classList.add('network-container-disabled');
    }
    label.removeClass('network-container-disabled');

    network = element.value;

    networkName = label.attr("id");
    
    $('#selected-network').html(networkName);

    getPrice();

}

function gradeChanged(element, no_networks = false){
    if(no_networks){
        HAS_NETWORKS = false;
    }
    var label = $("label[for='" + $(element).attr('id') + "']");

    var grades = $('.elem-grade-container');

    for(var i = 0; i<grades.length; i++){
        grades[i].classList.add('elem-grade-container-deselected');
    }
    label.removeClass('elem-grade-container-deselected');

    grade = element.value;
    $('#selected-grade').html($('#grade-'+grade+'-text').html());

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

    $('#selected-gb').html(memoryValue);

    getPrice();
}

function getPrice(){

    // handle negative val samsung galaxy a10 test feed 02 32gb faulty

    var basePrice = 0;
    
    if(!HAS_NETWORKS){

        if(basePrices != null && grade != null){
        
            basePrice = Object.values(basePrices)[grade-1];
    
            $('#product-price').text('£' + basePrice);
    
            //console.log(grade);
    
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
            $('#price').val(basePrice);
    
            //$("#addToCart").prop('disabled', false);
        }
        else{
            //$("#addToCart").prop('disabled', true);
        }

    } else {
        if(basePrices != null && grade != null && network != null){
        
            basePrice = Object.values(basePrices)[grade-1] - network;
            // basePrice = Math.round((basePrice + Number.EPSILON) * 100) / 100
    
            $('#product-price').text('£' + basePrice);
    
            //console.log(grade);
    
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
    
    
            //$("#addToCart").prop('disabled', false);
        }
        else{
            //$("#addToCart").prop('disabled', true);
        }
    }
        
}