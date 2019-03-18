$( document ).ready(function() {

$('#view_checked_price').on('change', function(){
    if($('#view_checked_price').prop('checked')){
        $('.price_office').css({'display':'block'});
    }else{
        $('.price_office').css({'display':'none'});
    }
});

});