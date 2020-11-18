function testingElementChanged(){


    var correctMemory = $('#correct_memory').val();
    var correctNetwork = $('#correct_network').val();
    var fimpOrGoogleLock = $('#fimp_or_google_lock').val();
    var pinLock = $('#pin_lock').val();
    var deviceFullyFunctional = $('#device_fully_functional').val();
    var waterDamage = $('#water_damage').val();

    var customerGradeName = $('#customer_grade').val();
    var customerGrade;

    var options = {};

    //set customer grade
    if(customerGradeName == "Excellent Working"){
        customerGrade = 5;
    }
    if(customerGradeName == "Good Working"){
        customerGrade = 4;
    }
    if(customerGradeName == "Poor Working"){
        customerGrade = 3;
    }
    if(customerGradeName == "Damaged Working"){
        customerGrade = 2;
    }
    if(customerGradeName == "Faulty"){
        customerGrade = 1;
    }


    if(correctMemory == "false"){
        console.log("here");
        $('#corrent-memory-value').removeClass('form-group-hidden');
    }
    else{
        $('#corrent-memory-value').addClass('form-group-hidden');
    }
    if(correctNetwork == "false"){
        $('#corrent-network-value').removeClass('form-group-hidden');
    }
    else{
        $('#corrent-network-value').addClass('form-group-hidden');
    }

    if(correctMemory != "false"){
        $('#fimp_or_google_lock').prop('disabled', false);
        $('#pin_lock').prop('disabled', false);
        $('#fake_missing_parts').prop('disabled', false);
        $('#device_fully_functional').prop('disabled', false);
        $('#water_damage').prop('disabled', false);

        if(fimpOrGoogleLock == "true" || pinLock == "true"){

            $('#fake_missing_parts').prop('disabled', true);
            $('#device_fully_functional').prop('disabled', true);
            $('#water_damage').prop('disabled', true);
            $('#correct_memory').prop('disabled', true);
            $('#correct_network').prop('disabled', true);

            $('#customer_grade').val("Faulty");

            options = {
                '':'',
                'WSI':'WSI',
                'WSD':'WSD',
                'NWSI':'NWSI',
                'NWSD':'NWSD',
                'Catastrophic':'Catastrophic'
            }
        }
        else{
            $('#fake_missing_parts').prop('disabled', false);
            $('#device_fully_functional').prop('disabled', false);
            $('#water_damage').prop('disabled', false);
            $('#correct_memory').prop('disabled', false);
            $('#correct_network').prop('disabled', false);
            options = {
                '':'',
                'Grade A':'Grade A',
                'Grade B+':'Grade B+',
                'Grade B':'Grade B',
                'Grade C':'Grade C',
                'WSI':'WSI',
                'WSD':'WSD',
                'NWSI':'NWSI',
                'NWSD':'NWSD',
                'Catastrophic':'Catastrophic'
            }
            if(deviceFullyFunctional == "false"){
                $('#device-fully-functional-options').removeClass('form-group-hidden');
                options = {
                    '':'',
                    'WSI':'WSI',
                    'WSD':'WSD',
                    'NWSI':'NWSI',
                    'NWSD':'NWSD',
                    'Catastrophic':'Catastrophic'
                }
            }
            else{
                $('#device-fully-functional-options').addClass('form-group-hidden');
                if(waterDamage == "true"){
                    options = {
                        '':'',
                        'WSI':'WSI',
                        'WSD':'WSD',
                        'NWSI':'NWSI',
                        'NWSD':'NWSD',
                        'Catastrophic':'Catastrophic'
                    }
                }
                else{
                    options = {
                        '':'',
                        'Grade A':'Grade A',
                        'Grade B+':'Grade B+',
                        'Grade B':'Grade B',
                        'Grade C':'Grade C',
                        'WSI':'WSI',
                        'WSD':'WSD',
                    }
                }
            }

        }

    }
    else{
        options = {
            '':'',
            'Grade A':'Grade A',
            'Grade B+':'Grade B+',
            'Grade B':'Grade B',
            'Grade C':'Grade C',
            'WSI':'WSI',
            'WSD':'WSD',
            'NWSI':'NWSI',
            'NWSD':'NWSD',
            'Catastrophic':'Catastrophic'
        }
    }

    $('#cosmetic_condition').empty(); // remove old options
    $.each(options, function(key,value) {
        $('#cosmetic_condition').append($("<option></option>")
        .attr("value", value).text(key));
    });

    $('#cosmetic_condition').prop('disabled', false);
    $('#cosmetic_condition').prop('required', true);

    /*if(correctMemory == "false" || correctNetwork == "false"){
        $('#cosmetic_condition').prop('disabled', true);
        $('#cosmetic_condition').prop('required', false);
    }
    else{
        $('#cosmetic_condition').empty(); // remove old options
        $.each(options, function(key,value) {
            $('#cosmetic_condition').append($("<option></option>")
            .attr("value", value).text(key));
        });
    
        $('#cosmetic_condition').prop('disabled', false);
        $('#cosmetic_condition').prop('required', true);
    }*/

}

function cosmeticElementChanged(){
    cosmeticGrade = $('#cosmetic_condition').val();

    $('#bamboo_grade').val(cosmeticGrade);

    var fimpOrGoogleLock = $('#fimp_or_google_lock').val();
    var pinLock = $('#pin_lock').val();
    cosmeticNumGrade = 0;

    if(fimpOrGoogleLock == "true" || pinLock == "true"){
        $('#customer_grade').val("Faulty");
    }
    else{
        if(cosmeticGrade == "Grade A"){
            $('#customer_grade').val("Excellent Working");
            $('#bamboo_final_grade').val('Excellent Working');
            cosmeticNumGrade = 5;
        }
        else if(cosmeticGrade == "Grade B+" || cosmeticGrade == "Grade B"){
            $('#customer_grade').val("Good Working");
            $('#bamboo_final_grade').val('Good Working');
            cosmeticNumGrade = 4;
        }
        else if(cosmeticGrade == "Grade C"){
            $('#customer_grade').val("Poor Working");
            $('#bamboo_final_grade').val('Poor Working');
            cosmeticNumGrade = 3;
        }
        else if(cosmeticGrade == "WSI" || cosmeticGrade == "WSD"){
            $('#customer_grade').val("Damaged Working");
            if(cosmeticGrade == "WSI"){
                $('#bamboo_final_grade').val('WSI');
            }
            if(cosmeticGrade == "WSD"){
                $('#bamboo_final_grade').val('WSD');
            }
            cosmeticNumGrade = 2;
        }
        else{
            $('#customer_grade').val("Faulty");
            $('#bamboo_final_grade').val('Faulty');
            cosmeticNumGrade = 1;
        }
    }

    $("#bamboo_customer_grade").val(cosmeticNumGrade);
    

    console.log(cosmeticGrade);
}



