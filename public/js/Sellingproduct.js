function addNewMemoryPoint(){
    if(!$('#newMemoryRow').hasClass('newMemoryRowActive')){
        $('#newMemoryRow').addClass('newMemoryRowActive');
        $('#newMemoryRow :input').prop('required', true);
        $('#newMemoryRowButton').addClass('newMemoryRowButtonDisable')
    }
}

function cancelNewMemoryPoint(){
    if($('#newMemoryRow').hasClass('newMemoryRowActive')){
        $('#newMemoryRow').removeClass('newMemoryRowActive');
        $('#newMemoryRow :input').prop('required', false);
        $('#newMemoryRowButton').removeClass('newMemoryRowButtonDisable');
    }
}

function addNewMemoryPoint(){
    
}