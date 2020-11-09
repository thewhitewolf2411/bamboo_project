function testingElementChanged(){


    var correctMemory = $('#correct_memory').val();
    var correctNetwork = $('#correct_network').val();
    var fimpOrGoogleLock = $('#fimp_or_google_lock').val();
    var pinLock = $('#pin_lock').val();
    var fakeOrMissingParts = $('#fake_missing_parts').val();
    var deviceFullyFunctional = $('#device_fully_functional').val();
    var waterDamage = $('#water_damage').val();

    var customerGradeName = $('#customer_grade').val();
    var customerGrade;

    var options = {};

    //console.log(correctMemory, correctNetwork, fimpOrGoogleLock, pinLock, fakeOrMissingParts, deviceFullyFunctional, waterDamage, customerGradeName);

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


    if(correctMemory == "false" || correctNetwork == "false"){
        $('#fimp_or_google_lock').prop('disabled', true);
        $('#pin_lock').prop('disabled', true);
        $('#fake_missing_parts').prop('disabled', true);
        $('#device_fully_functional').prop('disabled', true);
        $('#water_damage').prop('disabled', true);
    }
    else{
        $('#fimp_or_google_lock').prop('disabled', false);
        $('#pin_lock').prop('disabled', false);
        $('#fake_missing_parts').prop('disabled', false);
        $('#device_fully_functional').prop('disabled', false);
        $('#water_damage').prop('disabled', false);

        if(fimpOrGoogleLock == "true" || pinLock == "true"){
            $('#fake_missing_parts').prop('disabled', true);
            $('#device_fully_functional').prop('disabled', true);
            $('#water_damage').prop('disabled', true);
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
            options = {
                '':'',
                'Grade A':'Grade A',
                'Grade B+':'Grade B+',
                'Grade C':'Grade C',
                'WSI':'WSI',
                'WSD':'WSD',
                'NWSI':'NWSI',
                'NWSD':'NWSD',
                'Catastrophic':'Catastrophic'
            }
            if(deviceFullyFunctional == "false"){
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
                if(fakeOrMissingParts == "true" ||  waterDamage == "true"){
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
                        'Grade C':'Grade C',
                        'WSI':'WSI',
                        'WSD':'WSD',
                    }
                }
            }

        }

    }

    if(correctMemory == "false" || correctNetwork == "false"){
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
    }



}


