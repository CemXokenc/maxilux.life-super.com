<form id='block-postavshiki_update' method='post' enctype='multipart/form-data' />
  <div class='form_item  item-id-postavshiki-zip_code'>
   <label for='postavshiki_zip_code'>Почтовый индекс</label>
   <input class='form-control' type='text'  id='id_postavshiki_zip_code' name='postavshiki_zip_code' value='<?php  echo $site_variables["postavshiki_update_data"]["zip_code"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='postavshiki_img'>Изображение</label>
   <input type='file' id='id_postavshiki_img' name='postavshiki_img' />
  </div>
  <div class='form_item  item-id-postavshiki-debet'>
   <label for='postavshiki_debet'>Дебет</label>
   <input class='form-control' type='text'  id='id_postavshiki_debet' name='postavshiki_debet' value='<?php  echo $site_variables["postavshiki_update_data"]["debet"]; ?>' />
  </div>
  <div class='form_item  item-id-postavshiki-office'>
   <label for='postavshiki_office'>Офис</label>
   <input class='form-control' type='text'  id='id_postavshiki_office' name='postavshiki_office' value='<?php  echo $site_variables["postavshiki_update_data"]["office"]; ?>' />
  </div>
  <div class='form_item  item-id-postavshiki-house'>
   <label for='postavshiki_house'>Дом</label>
   <input class='form-control' type='text'  id='id_postavshiki_house' name='postavshiki_house' value='<?php  echo $site_variables["postavshiki_update_data"]["house"]; ?>' />
  </div>
  <div class='form_item  item-id-postavshiki-telephone'>
   <label for='postavshiki_telephone'>Телефон</label>
   <input class='form-control' type='text'  id='id_postavshiki_telephone' name='postavshiki_telephone' value='<?php  echo $site_variables["postavshiki_update_data"]["telephone"]; ?>' />
  </div>
  <div class='form_item  item-id-postavshiki-street'>
   <label for='postavshiki_street'>Улица</label>
   <input class='form-control' type='text'  id='id_postavshiki_street' name='postavshiki_street' value='<?php  echo $site_variables["postavshiki_update_data"]["street"]; ?>' />
  </div>
  <div class='form_item  item-id-postavshiki-city'>
   <label for='postavshiki_city'>Город</label>
   <input class='form-control' type='text'  id='id_postavshiki_city' name='postavshiki_city' value='<?php  echo $site_variables["postavshiki_update_data"]["city"]; ?>' />
  </div>
  <div class='form_item  item-id-postavshiki-email'>
   <label for='postavshiki_email'>Емеил</label>
   <input class='form-control' type='text'  id='id_postavshiki_email' name='postavshiki_email' value='<?php  echo $site_variables["postavshiki_update_data"]["email"]; ?>' />
  </div>
  <div class='form_item  item-id-postavshiki-name'>
   <label for='postavshiki_name'>Название</label>
   <input class='form-control' type='text'  id='id_postavshiki_name' name='postavshiki_name' value='<?php  echo $site_variables["postavshiki_update_data"]["name"]; ?>' />
  </div>
  <div class='form_item  item-id-postavshiki-credit'>
   <label for='postavshiki_credit'>Кредит</label>
   <input class='form-control' type='text'  id='id_postavshiki_credit' name='postavshiki_credit' value='<?php  echo $site_variables["postavshiki_update_data"]["credit"]; ?>' />
  </div>
 <input type="hidden" name="do" value="postavshiki_update">
 <input type="submit" value="Сохранить изменения">
 <input name="cmd" type="submit" value="Отмена">
</form>
<h2>Связанные документы</h2>
<span id="table_documents">
    <?php echo $site_variables["table"]; ?>
</span>
  <div class="row">
  Ссылка на документ: <input class="form-control" type="text" id="document_url" value="">
    
  </div>

<button type="button" id="add_document" class="btn btn-large">Добавить документ</button><br><br>


<script type="text/javascript"> 
$('#add_document').click(function(){
  var document_url= $('#document_url').val();

   if(document_url==""){
     alert("Ссылка не может быть пустой");
     return 0;
   }

    $.ajax({  
                dataType: 'json',
                type: "POST",
                url: "",   
                data:{"do":"refresh","document_url":document_url},
                success: function(html){  
                    $("#table_documents").html(html.table);
                    $("#document_url").val("");
              
                }  
            }); 
});

$( "body" ).delegate( ".relation_documents_delete", "click", function() {
  var document_id = $(this).attr("document-id");
  var status = confirm('Вы уверены что хотите удалить?');
  if(status == true){
    $.ajax({
      dataType: 'json',
      type: "POST",
      url: "",
      data:{"do":"documents_delete","document_id":document_id},
      success: function(html){
        $("#table_documents").html(html.table);
      }
    });
  }
});
</script>

