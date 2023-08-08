$(document).ready(()=>{
    $.ajax({
        url: './function/homeFunction/homeFunction.php',
        type: 'GET',
        data: {
            action: 'getCount'
        },
        dataType: 'json',
        success:function(response){
            $('#count').append(`${response[0]}`);
        }
    });
})