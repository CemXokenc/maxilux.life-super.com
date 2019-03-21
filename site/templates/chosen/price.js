function PopUpShow(){
    $(".edit_button_popup").show();
}
function PopUpHide(){
    $(".edit_button_popup").hide();
}
function history(){

    var edit_form_popup_order = $('#edit_form_popup_order').val();
    var arr = '', i = 1;
    $.ajax({
        type:'POST',
        url:'/edit_statuses.php',
        dataType:'json',
        data:{
            'order': edit_form_popup_order
        },
        success:function(res){
            while(typeof(res[i]) != "undefined" && res[i] !== null){
                arr += res[i]['author'] + ' - ' + res[i]['date'] + '<br>';
                i++;
            }
            $('#history').html(arr);
        }
    });

}

function files(){

    var order_id = $('#edit_form_popup_order').val();
    var res = '';
    $.ajax({
        url: '/images.php',
        data: {'order_id': order_id},
        dataType: 'json',
        type: 'post',
        success: function (data) {
            var i = 2;
            var l = data.length;
            var path = '';
            var ext = '';
            for(i;i<l;i++){
                ext = data[i].split('.');
                path = '/site/templates/img/orders/' + order_id + '/' + data[i];
                if ((ext[1] == 'jpg') || (ext[1] == 'png') || (ext[1] == 'bmp')){
                    res += "<a target='_blank' href='" + path + "'><img style='width:180px;height:180px;' src='" + path + "'></a>";
                }else{
                    res += "<a target='_blank' href='" + path + "'>" + data[i] + "</a>";
                }
            }
            $('#order_files').html(res);
        }
    });

}

$(document).ready(function () {

    PopUpHide();
    history();
    files();
    $('#edit_button_close').hide();

    $('#view_checked_price').on('change', function () {
        if ($('#view_checked_price').prop('checked')) {
            $('.price_office').css({'display': 'block'});
        } else {
            $('.price_office').css({'display': 'none'});
        }
    });

    $('#edit_button').click(function(){
        PopUpShow();
        $('#edit_button_close').show();
        $('#edit_button').hide();
    });

    $('#edit_button_close').click(function(){
        PopUpHide();
        $('#edit_button_close').hide();
        $('#edit_button').show();
    });

    $('#edit_form_popup_submit').click(function(){
        var edit_form_popup_id = $('#edit_form_popup_id').val(),
            edit_form_popup_order = $('#edit_form_popup_order').val(),
            edit_form_popup_user = $('#edit_form_popup_user').val(),
            edit_form_popup_name = $('#edit_form_popup_name').val(),
            edit_form_popup_email = $('#edit_form_popup_email').val(),
            edit_form_popup_telephone = $('#edit_form_popup_telephone').val(),
            edit_form_popup_telephone1 = $('#edit_form_popup_telephone1').val(),
            edit_form_popup_telephone2 = $('#edit_form_popup_telephone2').val(),
            edit_form_popup_dostavka_name = $('#edit_form_popup_dostavka_name').val(),
            edit_form_popup_dostavka_email = $('#edit_form_popup_dostavka_email').val(),
            edit_form_popup_dostavka_city = $('#edit_form_popup_dostavka_city').val(),
            edit_form_popup_dostavka_index = $('#edit_form_popup_dostavka_index').val(),
            edit_form_popup_dostavka_adress = $('#edit_form_popup_dostavka_adress').val(),
            edit_form_popup_dostavka_telephone = $('#edit_form_popup_dostavka_telephone').val();
        $.ajax({
            type:'POST',
            url:'/edit.php',
            data:{
                'id': edit_form_popup_id,
                'user': edit_form_popup_user,
                'order': edit_form_popup_order,
                'name': edit_form_popup_name,
                'email': edit_form_popup_email,
                'telephone': edit_form_popup_telephone,
                'telephone1': edit_form_popup_telephone1,
                'telephone2': edit_form_popup_telephone2,
                'dostavka_name': edit_form_popup_dostavka_name,
                'dostavka_email': edit_form_popup_dostavka_email,
                'dostavka_city': edit_form_popup_dostavka_city,
                'dostavka_index': edit_form_popup_dostavka_index,
                'dostavka_adress': edit_form_popup_dostavka_adress,
                'dostavka_telephone': edit_form_popup_dostavka_telephone
            },
            success:function(){
                $('#form_name').html(edit_form_popup_name);
                $('#form_email').html(edit_form_popup_email);
                $('#form_telephone').html(edit_form_popup_telephone + ',' + edit_form_popup_telephone1 + ',' + edit_form_popup_telephone2);
                $('#form_dostavka_name').html(edit_form_popup_dostavka_name);
                $('#form_dostavka_email').html(edit_form_popup_dostavka_email);
                $('#form_dostavka_city').html(edit_form_popup_dostavka_city);
                $('#form_dostavka_index').html(edit_form_popup_dostavka_index);
                $('#form_dostavka_adress').html(edit_form_popup_dostavka_adress);
                $('#form_dostavka_telephone').html(edit_form_popup_dostavka_telephone);
                PopUpHide();
                history();
            }
        });
    });

    $('#download').on('click', function(){

        var file_data = $('#file_download').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
            url: '/download.php',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (data) {
                console.log(data);
                files();
            }
        });

    });

});