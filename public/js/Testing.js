function testingElementChanged(){

    var q1 = $('#fimp_or_google_lock').val();
    var q2 = $('#pin_lock').val();
    var q3 = $('#fake_missing_parts').val();
    var q4 = $('#device_fully_functional').val();
    var q5 = $('#water_damage').val();
    var q6 = $('#cosmetic_condition').val();

    var customerGrade = $('#customer_grade').val();
    var customerGradeVal;

    var options = {};
    
    switch(customerGrade){
        case 'Excellent working':
            customerGradeVal = 5;
            break;
        case 'Good working':
            customerGradeVal = 4;
            break;
        case 'Poor working':
            customerGradeVal = 3;
            break;
        case 'Damaged working':
            customerGradeVal = 2;
            break;
        case 'Faulty':
            customerGradeVal = 1;
            break;
    }

    var bamboo_grade = $('#bamboo_grade');

    if(q1 == "true" || q2 == "true"){
        if(q1 == "true"){
            $('#pin_lock').prop('disabled', true);
        }
        if(q2 == "true"){
            $('#fimp_or_google_lock').prop('disabled', true);
        }
        $('#fake_missing_parts').prop('disabled', true);
        $('#device_fully_functional').prop('disabled', true);
        $('#water_damage').prop('disabled', true);
        
        options = 
        {
            "WSI": "WSI",
            "WSD": "WSD",
            "NW": "NW",
            "PND": "PND",
            "FIMP": "FIMP"
        };

        $('#cosmetic_condition').empty(); // remove old options
            $.each(options, function(key,value) {
                $('#cosmetic_condition').append($("<option></option>")
                .attr("value", value).text(key));
            });

        bamboo_grade.val("");
    }
    else{

        if(customerGradeVal == 5){
            options = {
                "Grade A": "Grade A",
                "Grade B": "Grade B",
                "Grade C": "Grade C",
            }
            bamboo_grade.val("Grade A");
            $('#bamboo_grade_val').val("Grade A");
        }
        if(customerGradeVal == 4){
            options = {
                "Grade A": "Grade A",
                "Grade B": "Grade B",
                "Grade C": "Grade C"
            }
            bamboo_grade.val("Grade B");
            $('#bamboo_grade_val').val("Grade B");
        }
        if(customerGradeVal == 3){
            options = {
                "Grade A": "Grade A",
                "Grade B": "Grade B",
                "Grade C": "Grade C"
            }
            bamboo_grade.val("Grade C");
            $('#bamboo_grade_val').val("Grade C");
        }
        if(customerGradeVal == 2){
            options = {
                "WSI": "WSI",
                "WSD": "WSD"
            }
        }
        if(customerGradeVal == 2){
            options = {
                "WSI": "WSI",
                "WSD": "WSD",
                "NW": "NW",
                "PND": "PND",
                "FIMP": "FIMP"
            }
        }
        $('#cosmetic_condition').empty(); // remove old options
            $.each(options, function(key,value) {
                $('#cosmetic_condition').append($("<option></option>")
                .attr("value", value).text(key));
            });

        $('#fimp_or_google_lock').prop('disabled', false);
        $('#pin_lock').prop('disabled', false);
        $('#fake_missing_parts').prop('disabled', false);
        $('#device_fully_functional').prop('disabled', false);
        $('#water_damage').prop('disabled', false);
        $('#cosmetic_condition').prop('disabled', false);
    }

    if(q3 == "true" || q4=="false" || q5 == "true"){

        options = {
            "WSI": "WSI",
            "WSD": "WSD",
            "NW": "NW",
            "PND": "PND",
            "FIMP": "FIMP"
        }
        
        $('#cosmetic_condition').empty(); // remove old options
            $.each(options, function(key,value) {
                $('#cosmetic_condition').append($("<option></option>")
                .attr("value", value).text(key));
            });
    }

    //console.log(q1,q2,q3,q4,q5,q6);

}

function gradeElementChanged(){
    var q6 = $('#cosmetic_condition').val();
    $('#bamboo_grade').val(q6);
    $('#bamboo_grade_val').val(q6);
}