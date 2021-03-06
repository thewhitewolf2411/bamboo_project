basePrices = null;
network = null;
grade = null;

networkName = null;
memoryValue = null;

HAS_NETWORKS = true;

document.addEventListener("DOMContentLoaded", function(e) {
    let memory_available = document.getElementsByClassName('device-memory');
    if(memory_available.length === 1){
        // preselect it if not N/A
        memory_available[0].childNodes[0].click();
    } else {
        // preselect lowest memory size
        if(memory_available.length > 1){
            memory_available[0].childNodes[0].click();
        }
    }

    let network_available = document.getElementsByClassName('device-network');
    if(network_available.length === 1){
        // preselect it
        network_available[0].click();
    } else {
        // preselect unlocked
        if(network_available.length > 1){
            network_available[0].click();
        }
    }

    let grades_available = document.getElementsByName('grade');
    if(grades_available.length >= 1){
        grades_available[0].click();
    }

    // frontend validation
    document.getElementById('addToCart').addEventListener('click', function(e){
        e.preventDefault();
        let errorNetwork = document.getElementById('please-select-network');
        let errorMemory = document.getElementById('please-select-memory');
        let errorGrade = document.getElementById('please-select-grade');
        let basketEmail = document.getElementById('basket_email');
        let errorEmail = document.getElementById('please-enter-email');

        let isValid = true;
        let availableNetworks = document.getElementsByName('network');

        if(availableNetworks.length > 1){
            if(!network){
                isValid = false;
                errorNetwork.classList.remove('invisible');
                setTimeout(function(){
                    errorNetwork.classList.add('invisible');
                }, 3000);
            }
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
        if(basketEmail){
            if(!basketEmail.value){
                isValid = false;
                errorEmail.classList.remove('invisible');
                setTimeout(function(){
                    errorEmail.classList.add('invisible');
                }, 3000);
            }
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
        networks[i].classList.remove('network-container-selected');

        if(networks[i].id === label.attr("id")){
            let img = networks[i].childNodes[0];
            img.src = '/networks/'+label.attr("id")+'-selected.png';
        } else {
            let img = networks[i].childNodes[0];
            img.src = '/networks/'+networks[i].id+'.png';
        }
    }
    label.removeClass('network-container-disabled');
    label.addClass('network-container-selected');

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
        grades[i].classList.remove('elem-grade-container-selected');
    }
    label.removeClass('elem-grade-container-deselected');
    label.addClass('elem-grade-container-selected');

    grade = element.value;
    $('#selected-grade').html($('#grade-'+grade+'-text').html());

    getPrice();
}

function memoryChanged(element){
    var label = $("label[for='" + $(element).attr('id') + "']");

    var grades = $('.memory-container');

    for(var i = 0; i<grades.length; i++){
        grades[i].classList.add('memory-container-deselected');
        grades[i].classList.remove('memory-container-selected');
    }
    label.removeClass('memory-container-deselected');
    label.addClass('memory-container-selected');

    basePrices = JSON.parse(element.value);
    memoryValue = label.attr("id");

    if(memoryValue === 'N/A'){
        document.getElementById('N/A').style.cursor = 'default';
        $('#selected-gb').html("This device has no memory.");
    } else {
        $('#selected-gb').html(memoryValue);
    }

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