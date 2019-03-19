function PopUpShow(){
    $(".edit_button_popup").show();
}
function PopUpHide(){
    $(".edit_button_popup").hide();
}
$(document).ready(function () {

    PopUpHide();

    $('#view_checked_price').on('change', function () {
        if ($('#view_checked_price').prop('checked')) {
            $('.price_office').css({'display': 'block'});
        } else {
            $('.price_office').css({'display': 'none'});
        }
    });

    $('#edit_button').click(function(){
        PopUpShow();
    });

    $('#edit_form_popup_submit').click(function(){
        var edit_form_popup_id = $('#edit_form_popup_id').val(),
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
            }
        });
    });

});