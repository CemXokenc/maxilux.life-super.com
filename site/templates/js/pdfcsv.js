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

    $("#csv").click(function(){

        var data = $('table').table2CSV({delivery:'value'});
        $.ajax({
            method: 'POST',
            url: '/csv.php',
            data: {data:data,name:name},
            dataType: 'text',
            success: function(response) {
                window.open('/csv.php');
            }
        });
    });

});