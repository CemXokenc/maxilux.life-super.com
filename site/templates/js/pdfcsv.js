$( document ).ready(function() {

    var name = location.pathname;

    $("#pdf").click(function(){

        var data = document.getElementById("form_main").innerHTML;
        $.ajax({
            method: 'POST',
            url: '/pdf.php',
            data: {data:data,name:name},
            dataType: 'text',
            success: function(response) {
                window.open('/pdf.php');
            }
        });
    });

});