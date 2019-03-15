<div id="izd_category"><h3>Статусы категорий</h3><?php echo $site_variables["status_table"]; ?></div>
<div class="row">
   <div class="col-sm-2" style="width: 340px;">
      Название: <input class="form-control" type="text" id="izd_category_name" value=""></span>
         Списание: <select class="form-control" id="izd_category_spisanie"><option value="0">Нет</option><option value="1">Установить</option></select>

    </div>
       <div class="col-sm-2" style="width: 340px;">
      Номер: <input class="form-control" type="text" id="izd_category_nomer" value=""></span>
             Профессия: <select class="form-control" id="izd_category_profession"><option value="0">Нет</option>
 <?php foreach($site_variables["profession"] as $site_variables["profes"]){ ?>
            <option value="<?php echo $site_variables["profes"]["id"]; ?>"><?php echo $site_variables["profes"]["name"]; ?></option>
            <?php } ?> 

</select>

    </div>
</div>
<div class="row">
   <div class="col-sm-2" style="width: 340px;">
      Цвет: <input class="form-control" type="text" id="izd_category_color" value=""></span>
    </div>
    </div>
<button type="button" id="add_name_category" class="btn btn-large">Добавить</button><br><br>
<form id='block-category_edit' method='post' enctype='multipart/form-data' />
<div class="fileupload fileupload-new" data-provides="fileupload">
  <div class="fileupload-new thumbnail" style="width: 180px; height: 180px;"><img src="<?php echo $site_variables["template_dir"]; ?>/img/categories/<?php if( $site_variables["category_edit_data"]["img"] > 0){ ?><?php echo $site_variables["category_edit_data"]["id"]; ?><?php }else{ ?>no_img<?php } ?>.jpg"></div>
</div>
  <div class='form_item '>
   <label for='categories_img'>Изображение</label>
   <input type='file' id='id_categories_img' name='categories_img' />
  </div>

  <div class='form_item '>
   <label for='categories_name'>Название</label>
   <input class='form-control' type='text'  id='id_categories_name' name='categories_name' value='<?php  echo $site_variables["category_edit_data"]["name"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='categories_description'>Описание</label>
   <textarea class='form-control'  id='id_categories_description' name='categories_description'><?php  echo $site_variables["category_edit_data"]["description"]; ?></textarea>
  </div>

  <div class='form_item '>
   <label for='categories_num'>Сортировка</label>
   <input class='form-control' type='text'  id='id_categories_num' name='categories_num' value='<?php  echo $site_variables["category_edit_data"]["num"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='categories_min_zakaz'>Минимальный заказ</label>
   <input class='form-control' type='text'  id='id_categories_min_zakaz' name='categories_min_zakaz' value='<?php  echo $site_variables["category_edit_data"]["min_zakaz"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='categories_sred_zakaz'>Средний заказ</label>
   <input class='form-control' type='text'  id='id_categories_sred_zakaz' name='categories_sred_zakaz' value='<?php  echo $site_variables["category_edit_data"]["sred_zakaz"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='categories_max_zakaz'>Максимальный заказ</label>
   <input class='form-control' type='text'  id='id_categories_max_zakaz' name='categories_max_zakaz' value='<?php  echo $site_variables["category_edit_data"]["max_zakaz"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='categories_parent_id'>Родительская категория</label>
   <select name='categories_parent_id' class='form-control'>
 <?php foreach($site_variables["select_category_edit_categories_parent_id"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["category_edit_data"]["parent_id"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='categories_nacenka'>Наценка</label>
   <input class='form-control' type='text'  id='id_categories_nacenka' name='categories_nacenka' value='<?php  echo $site_variables["category_edit_data"]["nacenka"]; ?>' />
  </div>


<input type="submit" value="Сохранить изменения"> <input name="cmd" type="submit" value="Отмена">

 <script type="text/javascript" src="<?php echo $site_variables["template_dir"]; ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  window.onload = function() {
  CKEDITOR.replace('id_categories_description');
};
</script> <input type="hidden" name="do" value="category_edit">
</form>
<script type="text/javascript"> 
$('#add_name_category').click(function(){
  var izd_category_name = $('#izd_category_name').val();
  var izd_category_nomer = $('#izd_category_nomer').val();
  var izd_category_spisanie = $('#izd_category_spisanie').val();
  var izd_category_profession= $('#izd_category_profession').val();
  var izd_category_color= $('#izd_category_color').val();

   if(izd_category_name==""){
     alert("Введите имя");
     return 0;
   }

   if(izd_category_nomer==""){
     alert("Введите порядковый номер категории");
     return 0;
   }

    $.ajax({  
        dataType: 'json',
        type: "POST",
        url: "",
        data:{"type":"refresh","name":izd_category_name,"izd_category_nomer":izd_category_nomer,"izd_category_spisanie":izd_category_spisanie,"izd_category_profession":izd_category_profession,"izd_category_color":izd_category_color},
        success: function(html){
            $("#izd_category").html(html.table);
        }
    });
});

$( "body" ).delegate( ".izdelie_delete", "click", function() {
   var status = confirm('Вы уверены что хотите удалить?');
   if(status == true){
     var category_id = $(this).attr("product-id");
     $.ajax({
       dataType: 'json',
       type: "POST",
       url: "",
       data:{"type":"category_delete","category_id":category_id},
       success: function(html){
         $("#izd_category").html(html.table);
       }
     });
   }
});

$( "body" ).delegate( ".izdelie_edit", "click", function() {
   var tovar_id = $(this).attr("product-id"); 
   var name =   $(this).parent("td").prev().prev().prev().prev().children(".cat_name").html();
   var name_input= "<input type='text' value='"+name+"'>";   
   var color =   $(this).parent("td").prev().children(".color_name").html();
   var color_input= "<input type='text' value='"+color+"'>";   

  var izd_profession_select= $('#izd_category_profession').html();
izd_profession_select = '<select>'+izd_profession_select+'<select>';
   $(this).parent("td").prev().prev().children(".cat_profession").hide();
   $(this).parent("td").prev().prev().children(".cat_profession_edit").show();
   $(this).parent("td").prev().prev().children(".cat_profession_edit").html(izd_profession_select);
   var izd_profession_val =  $(this).parent("td").prev().prev().children(".cat_profession_val").html();
$(this).parent("td").prev().prev().children(".cat_profession_edit").children("select").val(izd_profession_val);

   var btn_edit = "<span class='label label-primary opt_save' product-id='"+tovar_id +"'>Изменить</span>"+" <span class='label label-default opt_cancel' product-id='"+tovar_id +"'>Отменить</span>";
   $(this).parent("td").prev().prev().prev().prev().children(".cat_name_edit").html(name_input);
   $(this).parent("td").prev().prev().prev().prev().children(".cat_name").hide();
   $(this).parent("td").prev().children(".color_name_edit").html(color_input);
   $(this).parent("td").prev().children(".color_name").hide();
   var nomer=   $(this).parent("td").prev().prev().prev().prev().prev().children(".cat_nomer").html();
  var nomer_input= "<input type='text' value='"+nomer+"'>";   
   $(this).parent("td").prev().prev().prev().prev().prev().children(".cat_nomer_edit").html(nomer_input);
   $(this).parent("td").prev().prev().prev().prev().prev().children(".cat_nomer").hide();
     $(this).parent("td").prev().prev().prev().children(".cat_spisanie_edit").show();
   $(this).parent("td").prev().prev().prev().children(".cat_spisanie").hide();
   $(this).parent("td").children(".class_edit").html(btn_edit);
   $(this).next().hide();
   $(this).hide();
});
$( "body" ).delegate( ".opt_cancel", "click", function() {
  $(this).parent("span").parent("td").prev().children(".color_name_edit").html(" ");
   $(this).parent("span").parent("td").prev().children(".color_name").show();
  $(this).parent("span").parent("td").prev().prev().prev().prev().children(".cat_name_edit").html(" ");
   $(this).parent("span").parent("td").prev().prev().prev().prev().children(".cat_name").show();
  $(this).parent("span").parent("td").prev().prev().prev().prev().prev().children(".cat_nomer_edit").html(" ");
   $(this).parent("span").parent("td").prev().prev().prev().prev().prev().children(".cat_nomer").show();
   $(this).parent("span").parent("td").prev().prev().prev().children(".cat_spisanie").show();
     $(this).parent("span").parent("td").prev().prev().prev().children(".cat_spisanie_edit").hide();
   $(this).parent("span").parent("td").prev().prev().children(".cat_profession").show();
     $(this).parent("span").parent("td").prev().prev().children(".cat_profession_edit").hide();
   $(this).parent("span").prev().prev().show();
   $(this).parent("span").prev().show();
    $(this).parent("span").html(" ");
});

$( "body" ).delegate( ".opt_save", "click", function() {
   var tovar_id = $(this).attr("product-id"); 
   var color_name = $(this).parent("span").parent("td").prev().children(".color_name_edit").children("input").val();
   var cat_name= $(this).parent("span").parent("td").prev().prev().prev().prev().children(".cat_name_edit").children("input").val();
    var cat_nomer= $(this).parent("span").parent("td").prev().prev().prev().prev().prev().children(".cat_nomer_edit").children("input").val();
    var cat_spisanie= $(this).parent("span").parent("td").prev().prev().prev().children(".cat_spisanie_edit").children("select").val();
    var cat_profession= $(this).parent("span").parent("td").prev().prev().children(".cat_profession_edit").children("select").val();
  if(cat_name==""){
     alert("Введите имя");
     return 0;
   }
    if(cat_nomer==""){
     alert("Введите порядковый номер");
     return 0;
   }
     $.ajax({  
                dataType: 'json',
                type: "POST",
                url: "",   
                data:{"type":"update_cat","tovar_id":tovar_id ,"cat_name":cat_name,"cat_nomer":cat_nomer,"cat_spisanie":cat_spisanie,"cat_profession":cat_profession,"color_name":color_name},
                success: function(html){  
                    $("#izd_category").html(html.table);
                }  
            }); 
});
</script>

