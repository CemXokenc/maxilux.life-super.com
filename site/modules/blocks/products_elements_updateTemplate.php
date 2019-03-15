<?php if( $site_variables["system_messages"] != "" ){ ?>
  <div class="alert alert-success">
  <a class="close" data-dismiss="alert" href="#" aria-hidden="true">x</a>
  <?php echo $site_variables["system_messages"]; ?>
 </div>
<?php } ?>
<form action="" method="post">
<input type="hidden" name="type" value="save_postuplenie">
<div class="btn-group"  <?php if( $site_variables["products_info"]["izdelie_type"] == 1){ ?>style="display:none;"<?php } ?>>

Изделие<input id="izd_id" name="product_type" type="radio" value="0" <?php if( $site_variables["products_info"]["izdelie_type"] != 1){ ?>checked="checked"<?php } ?> >
Под-изделие<input id="podizd_id" name="product_type" type="radio" value="1" <?php if( $site_variables["products_info"]["izdelie_type"] == 1){ ?>checked="checked"<?php } ?>>

 </div>

<span id="table_izd">
<div id="izd_category"><h3>Иерархия изделия</h3><?php echo $site_variables["izdelie_table"]; ?></div>
<div class="row">
   <div class="col-sm-2" style="width: 340px;">
      Название: <input class="form-control" type="text" id="izd_category_name" value="">
      Количество: <input class="form-control" type="text" id="kolichestvo" value="">
     Номер: <input class="form-control" type="text" id="nomer" value="">
  Тип:
  <select id="type" class="form-control">
    <option value="0">Список</option>
    <option value="1">Опции</option>
    </select>
    </div>
     <div class="col-sm-2" style="width: 340px;">
    Категория:
    <select id="categories_izdelie" name="categories_izdelie" class="form-control">
    <option value="0">Не выбрано</option>
     <?php foreach($site_variables["izd_categories"] as $site_variables["item"]){ ?>
   <option value="<?php echo $site_variables["item"]["id"]; ?>"><?php echo $site_variables["item"]["name"]; ?></option>
       <?php } ?>
</select>
       Категория со склада:
       <select id="categories_izdelie_sklad" name="categories_izdelie_sklad" class="form-control">
         <option selected value="0">Выберите категорию</option>
         <?php foreach($site_variables["categories"] as $site_variables["key"]=>$site_variables["category"]){ ?>
         <option <?php if( $site_variables["products_info"]["category_id"] == $site_variables["key"]){ ?>selected<?php } ?> value="<?php echo $site_variables["key"]; ?>"><?php echo $site_variables["category"]; ?></option>
         <?php } ?>
       </select>
      
       <span id="span_statuses_izdelie_sklad" <?php if( $site_variables["products_info"]["category_id"] < 1){ ?>style="display:none;"<?php } ?>>
       Статус:
       <select id="statuses_izdelie_sklad" name="statuses_izdelie_sklad" class="form-control">
         <option selected value="0">Выберите статус</option>
       </select>
       </span>
  </div>
</div>
<span <?php if( $site_variables["products_info"]["category_id"] < 1){ ?>style="display:none;"<?php } ?> id="span_add_name_category"><button type="button" id="add_name_category" class="btn btn-large">Добавить</button><br></span><br>
</span>

  <table class="table table-bordered">
    <thead>
    <tr>
      <th>Название</th>
      <th><span id="type_head">Категория</span></th>
      <th>Цена</th>
    </tr>
    </thead>
    <tbody>

    <tr>

      <td><input type="text" class="form-control" name="name" <?php if( $site_variables["products_info"]["name"] != "" ){ ?>value="<?php echo $site_variables["products_info"]["name"]; ?>"<?php } ?>></td>
      <td>
        <select name="category_id" id="category_id" class="form-control">
          <option selected value="0">Выберите категорию</option>
          <?php foreach($site_variables["categories"] as $site_variables["key"]=>$site_variables["category"]){ ?>
          <option <?php if( $site_variables["products_info"]["category_id"] == $site_variables["key"]){ ?>selected<?php } ?> value="<?php echo $site_variables["key"]; ?>"><?php echo $site_variables["category"]; ?></option>
          <?php } ?>
        </select>
        <select id="izdelie_id" class="form-control" name="izdelie_id" style="display:none;">
          <?php foreach($site_variables["products"] as $site_variables["product"]){ ?>
          <option value="<?php echo $site_variables["product"]["id"]; ?>" <?php if( $site_variables["product"]["id"] == $site_variables["products_info"]["izdelie_id"]){ ?>selected<?php } ?>><?php echo $site_variables["product"]["name"]; ?></option>
          <?php } ?>
        </select>
        <select id="categories_izdelie_sel" name="categories_podizdelie" class="form-control">
          <?php echo $site_variables["select_izd"]; ?>
        </select>
      </td>
      <td style="width:200px;"><input class="form-control" id = "total_product_price" type="text" name="summa"></td>

    </tr>
    </tbody>
  </table>

<div class="span8">
<label for="description">Описание</label><br>
<<?php echo $site_variables["textarea"]; ?> id="id_products_description"  name="description" style="width: 500px;height: 150px;margin-bottom: 20px;"><?php echo $site_variables["products_info"]["description"]; ?></<?php echo $site_variables["textarea"]; ?>>
</div>
<div id="table_products"><?php echo $site_variables["table"]; ?></div>

<div class="" style="width: 700px;">
  <h2>Добавить элемент</h2>
  <hr />
  <div class="row">
    <div class="col-sm-2" style="width: 340px;">
      <select id="categories_1" class="form-control">
        <option selected value="0">Выберите категорию</option>
        <?php foreach($site_variables["categories_1"] as $site_variables["category"]){ ?>
        <option value="<?php echo $site_variables["category"]["id"]; ?>"><?php echo $site_variables["category"]["name"]; ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="col-sm-2" style="width: 340px;">
      <select id="categories_2"  class="form-control">
        <option selected value="0">Выберите категорию</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-2" style="width: 340px;">
      <select id="categories_3"  class="form-control">
        <option selected value="0">Выберите категорию</option>
      </select>
    </div>
    <div class="col-sm-2" style="width: 340px;">
      <select id="categories_4"  class="form-control">
        <option selected value="0">Выберите категорию</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-2" style="width: 340px;">
      Склад:
          <select id="sklad" class="tovar_select form-control">
        <?php foreach($site_variables["sklads"] as $site_variables["key"]=>$site_variables["sklad"]){ ?>
        <option value="<?php echo $site_variables["key"]; ?>"><?php echo $site_variables["sklad"]; ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="col-sm-2" style="width: 340px;">
      Товар: <select id="product" class="tovar_select form-control"></select></span>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-2" style="width: 340px;">
      Количество: <input class="form-control" type="text" id="cnt" value="">
    </div>
    <div class="col-sm-2" style="width: 340px;">
      Цена: <span id="price_sklad"></span>

      <br>

    </div>
  </div>

</div>
<select id="categories_all" style="display:none;">
  <option selected value="0">Выберите категорию</option>
  <?php foreach($site_variables["categories"] as $site_variables["key"]=>$site_variables["category"]){ ?>
  <option value="<?php echo $site_variables["key"]; ?>"><?php echo $site_variables["category"]; ?></option>
  <?php } ?>
</select>


<button type="button" id="add_tovar" class="btn btn-large">Добавить элемент</button><br><br>
<div id="table_options"><?php echo $site_variables["create_table_optn"]; ?></div>
<div class="row">
	<div class="col-sm-2" style="width: 340px;">
      Номер: <input class="form-control" type="text" id="num_opt" value="">
    </div>
   <div class="col-sm-2" style="width: 340px;">
      Название: <input class="form-control" type="text" id="name_opt" value="">
    </div>
      <div class="col-sm-2" style="width: 340px;">
      Код: <input class="form-control" type="text" id="kod_opt" value="">
    </div>
</div>
  <div class="row">
    <div class="col-sm-2" style="width: 340px;">
      Выберите тип:
      <select id="type_opt" class="form-control">
        <option selected value="0">Выберите тип</option>
        <option selected value="1">Поле</option>
        <option selected value="2">Скрытое</option>
      </select>
    </div>

    <div class="col-sm-2" style="width: 340px;">
      Формула: <input class="form-control" type="text" id="formula_opt" value="">
    </div>
  </div>
<button type="button" id="add_opt" class="btn btn-large">Добавить опцию</button><br><br>
  <div id="table_images"><?php echo $site_variables["images"]; ?></div>
  <!-- The fileinput-button span is used to style the file input field as button -->
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Загрузить Картинки...</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]" multiple>
    </span>

  <br>
  <!-- The global progress bar -->
  <div id="progress" class="progress">
    <div class="progress-bar progress-bar-success"></div>
  </div>
  <!-- The container for the uploaded files -->
  <div id="files" class="files"></div>

<button type="submit" class="btn btn-large btn-primary">Сохранить</button>
 </form>

 <script type="text/javascript" src="<?php echo $site_variables["template_dir"]; ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  window.onload = function() {
  CKEDITOR.replace('id_products_description');
};
</script>
<script type="text/javascript"> 

$( "body" ).delegate( ".plus_show", "click", function() {
  var plus_minus = $("img", $(this)).attr("status");

  if(plus_minus == "+" || plus_minus == ""){
    var category_id = $(this).attr("category_id");
    $('.content_class'+category_id).show();
    $(this).html("<img height='15' status='-' src='<?php echo $site_variables["template_dir"]; ?>/minus.jpg' />");
  }else{
    var category_id = $(this).attr("category_id");
    $('.content_class'+category_id).hide();
    $(this).html("<img  height='15' status='+' src='<?php echo $site_variables["template_dir"]; ?>/plus.jpg' />");
  }
});



$('#add_tovar').click(function(){
  var sklad = $('#sklad').val();
   var product = $('#product').val();
   var cnt = $('#cnt').val();
   if(cnt==""){
     alert("Введите количество");
     return 0;
   }
   if(product <1){
     alert("Выберите товар");
     return 0;
   }
    $.ajax({  
                dataType: 'json',
                type: "POST",
                url: "",   
                data:{"type":"refresh","sklad":sklad,"product":product,"cnt":cnt},
                success: function(html){  
                    $("#table_products").html(html.table);
                 $("#total_product_price").val($("#total_price").text().replace("(UAH)",""));
                }  
            }); 
});

$('#add_opt').click(function(){
var num_opt = $('#num_opt').val();
  var name_opt = $('#name_opt').val();
   var kod_opt = $('#kod_opt').val();
   var type_opt= $('#type_opt').val();
  var formula_opt= $('#formula_opt').val();

	if(num_opt==""){
     alert("Введите номер");
     return 0;
   }
   
   if(name_opt==""){
     alert("Введите имя");
     return 0;
   }

    $.ajax({  
                dataType: 'json',
                type: "POST",
                url: "",   
                data:{"type":"refresh_opt","name_opt":name_opt,"kod_opt":kod_opt,"type_opt":type_opt,"formula_opt":formula_opt,"num_opt":num_opt},
                success: function(html){  
                    $("#table_options").html(html.table);           
                }  
            }); 
});


$('#add_name_category').click(function(){
  var izd_category_name = $('#izd_category_name').val();
  var nomer = $('#nomer').val();
  var kolichestvo = $('#kolichestvo').val();
  var type = $('#type').val();
  var categories_izdelie = $('#categories_izdelie').val();
  var categories_izdelie_sklad = $('#categories_izdelie_sklad').val();
 var status_izdelie = $('#statuses_izdelie_sklad').val();

   if(izd_category_name==""){
     alert("Введите имя");
     return 0;
   }

    $.ajax({  
        dataType: 'json',
        type: "POST",
        url: "",
        data:{"type":"refresh_izd_category","operation_type":type,"izd_category_name":izd_category_name,"categories_izdelie":categories_izdelie,"categories_izdelie_sklad":categories_izdelie_sklad,"kolichestvo":kolichestvo,"status_izdelie":status_izdelie,"nomer":nomer},
        success: function(html){
            $("#izd_category").html(html.table);
            $("#categories_izdelie").html(html.select_data);
        }
    });
});
$( "body" ).delegate( ".tovar_delete", "click", function() {
   var tovar_id = $(this).attr("product-id"); 
     $.ajax({  
                dataType: 'json',
                type: "POST",
                url: "",   
                data:{"type":"delete","tovar_id":tovar_id},
                success: function(html){  
                    $("#table_products").html(html.table);
                    $("#total_product_price").val($("#total_price").text().replace("(UAH)",""));
                }  
            }); 
});

$( "body" ).delegate( ".options_delete", "click", function() {
   var tovar_id = $(this).attr("product-id"); 
     $.ajax({  
                dataType: 'json',
                type: "POST",
                url: "",   
                data:{"type":"delete_opt","tovar_id":tovar_id},
                success: function(html){  
                    $("#table_options").html(html.table);
                    
                }  
            }); 
});

$( "body" ).delegate( ".images_delete", "click", function() {
  var image_id = $(this).attr("image-id");
  $.ajax({
    dataType: 'json',
    type: "POST",
    url: "",
    data:{"type":"delete_image","image_id":image_id},
    success: function(html){
      $("#table_images").html(html.table);

    }
  });
});

$( "body" ).delegate( ".images_edit", "click", function() {
	
  var name = $(this).parent("td").prev().children(".opisanie").html();
  var name_input= "<<?php echo $site_variables["textarea"]; ?> style='width:100px;height:50px;'>"+name+"</<?php echo $site_variables["textarea"]; ?>>";
  $(this).parent("td").prev().children(".opisanie_edit").html(name_input);
  $(this).parent("td").prev().children(".opisanie").hide();
  
  var number = $(this).parent("td").prev().prev().prev().prev().children(".img_num").html();
  var number_input= "<input type='text' value='"+number+"'>";
  $(this).parent("td").prev().prev().prev().prev().children(".img_num_edit").html(number_input);
  $(this).parent("td").prev().prev().prev().prev().children(".img_num").hide();
  
  
  $(this).hide();
  $(this).next().hide();
  $(this).next().next().show();
});

$( "body" ).delegate( ".images_save", "click", function() {
  var image_id = $(this).attr("image-id");
  var opisanie = $(this).parent("td").prev().children(".opisanie_edit").children("textarea").val();
  var number = $(this).parent("td").prev().prev().prev().prev().children(".img_num_edit").children("input").val();
  
  $.ajax({
    dataType: 'json',
    type: "POST",
    url: "",
    data:{"type":"edit_image","image_id":image_id,"opisanie":opisanie,"number":number},
    success: function(html){
      $("#table_images").html(html.table);

    }
  });
});

$( "body" ).delegate( ".izdelie_delete", "click", function() {
  var tovar_id = $(this).attr("product-id");
  var status = confirm('Вы уверены что хотите удалить?');
  if(status == true){
    $.ajax({
      dataType: 'json',
      type: "POST",
      url: "",
      data:{"type":"izdelie_delete","tovar_id":tovar_id},
      success: function(html){
        $("#izd_category").html(html.table);
        $("#categories_izdelie").html(html.select_data);
      }
    });
  }
});

$( "body" ).delegate( ".izdelie_edit", "click", function() {
  var category_id = $("#category_id").val();
  if(category_id < 1){
   alert("Выберите категорию");
    return 0;
  }
   var tovar_id = $(this).attr("product-id"); 
   var sklad_id =   $(this).parent("td").prev().prev().prev().prev().children(".sklad_id").html();
   var select_sklads = $("#categories_izdelie_sklad").html();
   var select = "<select style='width:150px;'>"+select_sklads+"</select>";
  $(this).parent("td").prev().prev().prev().prev().children(".sklad").hide();
  $(this).parent("td").prev().prev().prev().prev().children(".sklad_edit").html(select);
  if(sklad_id > 0){
    $(this).parent("td").prev().prev().prev().prev().children(".sklad_edit").children("select").val(sklad_id);
 }else{
     $(this).parent("td").prev().prev().prev().prev().children(".sklad_edit").children("select").val(0);
  }

   var parent_id =   $(this).parent("td").prev().prev().prev().children(".parent_id ").html();
   var select_parent = $("#categories_izdelie").html();
   var select = "<select style='width:150px;'>"+select_parent+"</select>";
  $(this).parent("td").prev().prev().prev().children(".parent_category").hide();
  $(this).parent("td").prev().prev().prev().children(".parent_edit").html(select);
  if(parent_id > 0){
    $(this).parent("td").prev().prev().prev().children(".parent_edit").children("select").val(parent_id);
 }else{
     $(this).parent("td").prev().prev().prev().children(".parent_edit").children("select").val(0);
  }
   var nomer =   $(this).parent("td").prev().prev().prev().prev().prev().prev().prev().children(".nomer").html();
   var nomer_input= "<input type='text' value='"+nomer+"' style='width:30px;'>";
  $(this).parent("td").prev().prev().prev().prev().prev().prev().prev().children(".nomer_edit").html(nomer_input);
$(this).parent("td").prev().prev().prev().prev().prev().prev().prev().children(".nomer").hide();
   var name =   $(this).parent("td").prev().prev().prev().prev().prev().prev().children(".name_for_edit").html();
   var name_input= "<input type='text' value='"+name+"' style='width:180px;'>";
  $(this).parent("td").prev().prev().prev().prev().prev().prev().children(".name").hide();
   $(this).parent("td").prev().prev().prev().prev().prev().prev().children(".name_edit").html(name_input);
     var cnt =   $(this).parent("td").prev().prev().prev().prev().prev().children(".cnt").html();
  cnt = cnt.replace(/\<br>/g, "\n");
  cnt = cnt.replace(/\<br\/>/g, "\n");
  cnt = cnt.replace(/\<br \/>/g, "\n");
  var cnt_input= "<<?php echo $site_variables["textarea"]; ?> style='width:100px;height:25px;'>"+cnt+"</<?php echo $site_variables["textarea"]; ?>>";
  $(this).parent("td").prev().prev().prev().prev().prev().children(".cnt_edit").html(cnt_input);
  $(this).parent("td").prev().prev().prev().prev().prev().children(".cnt").hide();
  $(this).parent("td").prev().children(".izdelie_type").hide();
  $(this).parent("td").prev().children(".izdelie_type_edit").show();
  $(this).hide();
  $(this).next().hide();
  var btn_edit = "<span class='label label-primary izdelie_save' product-id='"+tovar_id +"'>Изменить</span>"+" <span class='label label-default izdelie_cancel' product-id='"+tovar_id +"'>Отменить</span>";
  $(this).parent("td").children(".class_edit").html(btn_edit);
  var statuses = $("#statuses_izdelie_sklad").html();
  $(this).parent("td").prev().prev().children(".status_select").html(statuses);
  $(this).parent("td").prev().prev().children(".status_select").show();
  $(this).parent("td").prev().prev().children(".status_name").hide();
  var status_id = $(this).parent("td").prev().prev().children(".status_id").html();
  $(this).parent("td").prev().prev().children(".status_select").val(status_id).change();
});




$( "body" ).delegate( ".tovar_edit", "click", function() {
  var tovar_id = $(this).attr("product-id");
  
  var cnt_tovar =   $(this).parent("td").prev().prev().prev().children(".cnt").html();
  var cnt = "<input type='text' value='"+cnt_tovar+"'>";
  $(this).parent("td").prev().prev().prev().children(".cnt_edit").html(cnt);
  $(this).parent("td").prev().prev().prev().children(".cnt").hide();

  var num_tovar =   $(this).parent("td").prev().prev().prev().prev().prev().prev().children(".tovar_number").html();
  var num = "<input type='text' value='"+num_tovar+"'>";
  $(this).parent("td").prev().prev().prev().prev().prev().prev().children(".tovar_number_edit").html(num);
  $(this).parent("td").prev().prev().prev().prev().prev().prev().children(".tovar_number").hide();

  var btn_edit = "<span class='label label-primary tovar_save' product-id='"+tovar_id +"'>Изменить</span>"+" <span class='label label-default tovar_cancel' product-id='"+tovar_id +"'>Отменить</span>";
  $(this).parent("td").children(".class_edit").html(btn_edit);
  
  $(this).next().hide();
  $(this).hide();

});

$( "body" ).delegate( ".tovar_cancel", "click", function() {
	
	$(this).parent("td").prev().prev().prev().prev().children(".opt_name").show();
	
	$(this).parent("span").parent("td").prev().prev().children(".price").show();
	$(this).parent("span").parent("td").prev().prev().children(".price_edit").html(" ");
	
	$(this).parent("span").parent("td").prev().prev().prev().children(".cnt_edit").html(" ");
	$(this).parent("span").parent("td").prev().prev().prev().children(".cnt").show();
	
	$(this).parent("span").parent("td").prev().prev().prev().prev().prev().prev().children(".tovar_number_edit").html(" ");
	$(this).parent("span").parent("td").prev().prev().prev().prev().prev().prev().children(".tovar_number").show();
	
	$(this).parent("span").prev().prev().show();
	$(this).parent("span").prev().show();
	$(this).parent("span").html(" ");
});

$( "body" ).delegate( ".tovar_save", "click", function() {
  var tovar_id = $(this).attr("product-id");
  var cnt = $(this).parent("span").parent("td").prev().prev().prev().children(".cnt_edit").children("input").val();
  var num = $(this).parent("span").parent("td").prev().prev().prev().prev().prev().prev().children(".tovar_number_edit").children("input").val();
  $.ajax({
    dataType: 'json',
    type: "POST",
    url: "",
    data:{"type":"update","tovar_id":tovar_id,"cnt":cnt,"number":num},
    success: function(html){
      $("#table_products").html(html.table);
    }
  });
});

$( "body" ).delegate( ".options_edit", "click", function() {
  var tovar_id = $(this).attr("product-id");
  
  var number =   $(this).parent("td").prev().prev().prev().prev().prev().children(".opt_num").html();
  var number_input = "<input type='text' value='"+number+"'>";
  
  var name =   $(this).parent("td").prev().prev().prev().prev().children(".opt_name").html();
  var name_input= "<input type='text' value='"+name+"'>";
  
  var opt_kod=   $(this).parent("td").prev().prev().prev().children(".opt_kod").html();
  var opt_kod_edit= "<input type='text' value='"+opt_kod+"'>";
  
  var type =   $(this).parent("td").prev().prev().children(".opt_kod").html();
  var type_edit= "<input type='text' value='"+opt_kod+"'>";
  
  var formula =   $(this).parent("td").prev().children(".opt_formula").html();
  var formula_edit= "<input type='text' value='"+formula+"'>";
  
  
  var btn_edit = "<span class='label label-primary opt_save' product-id='"+tovar_id +"'>Изменить</span>"+" <span class='label label-default opt_cancel' product-id='"+tovar_id +"'>Отменить</span>";
  
  //Номер
  $(this).parent("td").prev().prev().prev().prev().prev().children(".opt_num_edit").html(number_input);
  $(this).parent("td").prev().prev().prev().prev().prev().children(".opt_num").hide();
  //Номер
  
  //Название
  $(this).parent("td").prev().prev().prev().prev().children(".opt_name_edit").html(name_input);
  $(this).parent("td").prev().prev().prev().prev().children(".opt_name").hide();
  //Название
  
  //Код
  $(this).parent("td").prev().prev().prev().children(".opt_kod_edit").html(opt_kod_edit);
  $(this).parent("td").prev().prev().prev().children(".opt_kod").hide();
  //Код
  
  //Тип
  $(this).parent("td").prev().prev().children(".type_edit").show();
  $(this).parent("td").prev().prev().children(".type_opt").hide();
  //Тип
  
  //Формула
  $(this).parent("td").prev().children(".opt_formula").hide();
  $(this).parent("td").prev().children(".opt_formula_edit").html(formula_edit).show();
  //Формула
  
  $(this).parent("td").children(".class_edit").html(btn_edit);
  $(this).next().hide();
  $(this).hide();

});

$( "body" ).delegate( ".izdelie_cancel", "click", function() {
  $(this).parent("span").parent("td").prev().prev().prev().prev().prev().prev().prev().children(".nomer").show();
  $(this).parent("span").parent("td").prev().prev().prev().prev().prev().prev().prev().children(".nomer_edit").html(" ");
  $(this).parent("span").parent("td").prev().prev().prev().prev().prev().prev().children(".name").show();
  $(this).parent("span").parent("td").prev().prev().prev().prev().prev().prev().children(".name_edit").html(" ");
  $(this).parent("span").parent("td").prev().prev().prev().prev().prev().children(".cnt_edit").html(" ");
  $(this).parent("span").parent("td").prev().prev().prev().prev().prev().children(".cnt").show();
  $(this).parent("span").parent("td").prev().prev().prev().prev().children(".sklad_edit").html(" ");
  $(this).parent("span").parent("td").prev().prev().prev().prev().children(".sklad").show();
  $(this).parent("span").parent("td").prev().prev().prev().children(".parent_edit").html(" ");
  $(this).parent("span").parent("td").prev().prev().prev().children(".parent_category").show();
  $(this).parent("span").parent("td").prev().prev().children(".status_select").html(" ");
  $(this).parent("span").parent("td").prev().prev().children(".status_select").hide();
  $(this).parent("span").parent("td").prev().prev().children(".status_name").show();
  $(this).parent("span").parent("td").prev().children(".izdelie_type_edit").html(" ");
  $(this).parent("span").parent("td").prev().children(".izdelie_type").show();

  $(this).parent("span").prev().prev().show();
  $(this).parent("span").prev().show();
  $(this).parent("span").html(" ");
});

$( "body" ).delegate( ".opt_save", "click", function() {
	var tovar_id = $(this).attr("product-id");
	
	var opt_num = $(this).parent("span").parent("td").prev().prev().prev().prev().prev().children(".opt_num_edit").children("input").val();
	var opt_name = $(this).parent("span").parent("td").prev().prev().prev().prev().children(".opt_name_edit").children("input").val();
	var opt_kod = $(this).parent("span").parent("td").prev().prev().prev().children(".opt_kod_edit").children("input").val();
	var opt_type = $(this).parent("span").parent("td").prev().prev().children(".type_edit").val();
	var opt_formula = $(this).parent("span").parent("td").prev().children(".opt_formula_edit").children("input").val();
	
	if(opt_num ==""){
		alert("Введите номер");
		return 0;
	}
	
	if(opt_name ==""){
		alert("Введите имя");
		return 0;
	}

	
	$.ajax({
	dataType: 'json',
	type: "POST",
	url: "",
	data:{"type":"update_opt","tovar_id":tovar_id,"opt_name":opt_name,"opt_kod":opt_kod,"opt_type":opt_type,"opt_formula":opt_formula,"opt_num":opt_num},
	success: function(html){
	  $("#table_options").html(html.table);
	}
	
	});
});

$( "body" ).delegate( ".opt_cancel", "click", function() {
  $(this).parent("span").parent("td").prev().prev().children(".opt_kod").show();
  
  $(this).parent("span").parent("td").prev().prev().prev().prev().prev().children(".opt_num").show();
  $(this).parent("span").parent("td").prev().prev().prev().prev().children(".opt_name").show();
  $(this).parent("span").parent("td").prev().prev().prev().children(".opt_kod").show();
  $(this).parent("span").parent("td").prev().prev().children(".type_opt").show();
  $(this).parent("span").parent("td").prev().children(".opt_formula").show();
  

  $(this).parent("span").parent("td").prev().prev().prev().prev().prev().children(".opt_num_edit").html(" ");
  $(this).parent("span").parent("td").prev().prev().prev().prev().children(".opt_name_edit").html(" ");
  $(this).parent("span").parent("td").prev().prev().prev().children(".opt_kod_edit").html(" ");
  $(this).parent("span").parent("td").prev().prev().children(".type_edit").hide();
  $(this).parent("span").parent("td").prev().children(".opt_formula_edit").html(" ");
  
  $(this).parent("span").prev().prev().show();
  $(this).parent("span").prev().show();
  $(this).parent("span").html(" ");
});


$( "body" ).delegate( ".izdelie_save", "click", function() {
  var tovar_id = $(this).attr("product-id");
  var nomer = $(this).parent("span").parent("td").prev().prev().prev().prev().prev().prev().prev().children(".nomer_edit").children("input").val();
  var name = $(this).parent("span").parent("td").prev().prev().prev().prev().prev().prev().children(".name_edit").children("input").val();
  var cnt = $(this).parent("span").parent("td").prev().prev().prev().prev().prev().children(".cnt_edit").children("textarea").val();
  var status_id =    $(this).parent("span").parent("td").prev().prev().children(".status_select").val();
  var type_category= $(this).parent("span").parent("td").prev().children(".izdelie_type_edit").children("select").val();
  var sklad_id = $(this).parent("span").parent("td").prev().prev().prev().prev().children(".sklad_edit").children("select").val();
 var parent_id = $(this).parent("span").parent("td").prev().prev().prev().children(".parent_edit").children("select").val();
  $.ajax({
    dataType: 'json',
    type: "POST",
    url: "",
    data:{"type":"update_izdelie","tovar_id":tovar_id,"cnt":cnt,"name":name,"status_id":status_id,"type_category":type_category,"nomer":nomer,"sklad_id":sklad_id,"parent_id":parent_id},
    success: function(html){
      $("#izd_category").html(html.table);
      $("#categories_izdelie").html(html.select_data);
    }
  });
});

$("#categories_all").change(function(){
  var category_id = $(this).val();

  $.ajax({
    dataType: 'json',
    type: "POST",
    url: "",
    data:{"type":"category","category_id":category_id},
    success: function(html){
      $("#product").html(html.table);

    }
  });
});

$("#product").change(function(){
  var tovar_id = $(this).val();

  $.ajax({
    dataType: 'json',
    type: "POST",
    url: "",
    data:{"type":"tovar_change","tovar_id":tovar_id},
    success: function(html){
      $("#price").val(html.price_valuta);
	  
      $("#price_sklad").html(html.price + ' ' + html.currency);



    }
  });


});

$("#categories_1").change(function(){
  var category_id = $(this).val();
  $("#categories_all [value="+category_id+" ]").attr("selected", "selected");
  $("#categories_all").trigger("change");
  $("#categories_2 [value='0']").attr("selected", "selected");
  $("#categories_3 [value='0']").attr("selected", "selected");
  $("#categories_4 [value='0']").attr("selected", "selected");
  $.ajax({
    dataType: 'json',
    type: "POST",
    url: "",
    data:{"type":"change_category","category_id":category_id},
    success: function(html){
      $("#categories_2").html(html.select);

    }
  });


});

$("#categories_2").change(function(){
  var category_id = $(this).val();
  $("#categories_all [value="+category_id+" ]").attr("selected", "selected");
  $("#categories_all").trigger("change");
  $("#categories_3 [value='0']").attr("selected", "selected");
  $("#categories_4 [value='0']").attr("selected", "selected");
  $.ajax({
    dataType: 'json',
    type: "POST",
    url: "",
    data:{"type":"change_category","category_id":category_id},
    success: function(html){
      $("#categories_3").html(html.select);

    }
  });


});

$("#categories_3").change(function(){
  var category_id = $(this).val();
  $("#categories_all [value="+category_id+" ]").attr("selected", "selected");
  $("#categories_all").trigger("change");
  $("#categories_4 [value='0']").attr("selected", "selected");
  $.ajax({
    dataType: 'json',
    type: "POST",
    url: "",
    data:{"type":"change_category","category_id":category_id},
    success: function(html){
      $("#categories_4").html(html.select);

    }
  });


});

$("#categories_4").change(function(){
  var category_id = $(this).val();
  $("#categories_all [value="+category_id+" ]").attr("selected", "selected");
  $("#categories_all").trigger("change");



});


$("#izdelie_id").change(function(){
  var category_id = $(this).val();
  $.ajax({
    dataType: 'json',
    type: "POST",
    url: "",
    data:{"type":"change_izd_category","category_id":category_id},
    success: function(html){
      $("#categories_izdelie_sel").html(html.table);

    }
  });

});

$("#category_id").change(function(){
  var category_id = $(this).val();
  if(category_id <1){
    $("#span_add_name_category").hide();
    $("#span_statuses_izdelie_sklad").hide();
  }else{
    $("#span_add_name_category").show();
    $("#span_statuses_izdelie_sklad").show();
  }
  $.ajax({
    dataType: 'json',
    type: "POST",
    url: "",
    data:{"type":"change_main_category","category_id":category_id},
    success: function(html){
      $("#statuses_izdelie_sklad").html(html.select);
    }
  });

});

$("input[name=product_type]").change(function() {
  var button = $(this).val();

  if(button == 0){
    $('#category_id').show();
    $('#izdelie_id').hide();
    $('#table_izd').show();
    $('#categories_izdelie_sel').hide();
    $('#type_head').html("Категория");
  }
  if(button == 1){
    $('#category_id').hide();
    $('#izdelie_id').show();
    $('#table_izd').hide();
    $('#type_head').html("Изделие");
    $('#categories_izdelie_sel').show();
  }

});

var izd_id = $("#izd_id").attr("checked");
var podizd_id = $("#podizd_id").attr("checked");
if(izd_id == "checked"){
  $('#category_id').show();
  $('#izdelie_id').hide();
  $('#table_izd').show();
  $('#categories_izdelie_sel').hide();
  $('#type_head').html("Категория");
}
if(podizd_id  == "checked"){
  $('#category_id').hide();
  $('#izdelie_id').show();
  $('#table_izd').hide();
  $('#type_head').html("Изделие");
  $('#categories_izdelie_sel').show();
}
</script>

<link rel="stylesheet" href="<?php echo $site_variables["template_dir"]; ?>jquery-uploader/css/jquery.fileupload.css">

<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>

<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo $site_variables["template_dir"]; ?>jquery-uploader/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo $site_variables["template_dir"]; ?>jquery-uploader/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo $site_variables["template_dir"]; ?>jquery-uploader/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo $site_variables["template_dir"]; ?>jquery-uploader/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo $site_variables["template_dir"]; ?>jquery-uploader/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo $site_variables["template_dir"]; ?>jquery-uploader/js/jquery.fileupload-validate.js"></script>
<script>
var handler = '<?php echo $site_variables["main_img_domain"]; ?>upload/<?php echo $site_variables["product_id"]; ?>.html';
  $(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = handler,
      uploadButton = $('<button/>')
        .addClass('btn btn-primary')
        .prop('disabled', true)
        .text('Processing...')
        .on('click', function () {
          var _this = $(this),
            data = _this.data();
          _this
            .off('click')
            .text('Abort')
            .on('click', function () {
              _this.remove();
              data.abort();
            });
          data.submit().always(function () {
            _this.remove();
          });
        });
    $('#fileupload').fileupload({
      url: url,
      dataType: 'json',
      autoUpload: false,
      acceptFileTypes: /(\.|\/)(gif|jpe?g|png)<?php echo $site_variables["dollar"]; ?>/i,
      maxFileSize: 5000000, // 5 MB
      // Enable image resizing, except for Android and Opera,
      // which actually support image resizing, but fail to
      // send Blob objects via XHR requests:
      disableImageResize: /Android(?!.*Chrome)|Opera/
        .test(window.navigator.userAgent),
      previewMaxWidth: 100,
      previewMaxHeight: 100,
      previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
          var node = $('<p/>')
            .append($('<span/>').text(file.name));
          if (!index) {
            node
              .append('<br>')
              .append(uploadButton.clone(true).data(data));
          }
          node.appendTo(data.context);
        });
      }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
          file = data.files[index],
          node = $(data.context.children()[index]);
        if (file.preview) {
          node
            .prepend('<br>')
            .prepend(file.preview);
        }
        if (file.error) {
          node
            .append('<br>')
            .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
          data.context.find('button')
            .attr("type", "button")
            .text('Загрузить')
            .prop('disabled', !!data.files.error);
        }
      }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
          'width',
          progress + '%'
        );
      }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
          if (file.url) {
            var link = $('<a>')
              .attr('target', '_blank')
              .prop('href', file.url);
            $(data.context.children()[index])
              .wrap(link);
          } else if (file.error) {
            var error = $('<span class="text-danger"/>').text(file.error);
            $(data.context.children()[index])
              .append('<br>')
              .append(error);
          }
        });
      }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index, file) {
          var error = $('<span class="text-danger"/>').text('File upload failed.');
          $(data.context.children()[index])
            .append('<br>')
            .append(error);
        });
      }).prop('disabled', !$.support.fileInput)
      .parent().addClass($.support.fileInput ? undefined : 'disabled');
  });
  $("#category_id").trigger("change");

	$("#total_product_price").val($("#total_price").text().replace("(UAH)",""));

</script>

