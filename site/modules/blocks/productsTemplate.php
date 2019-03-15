<form action="" method="post" id="form_filtr" style = "display: inline-block;">
  <div class="btn-group display-inline pull-right text-align-left hidden-tablet" style="float: left !important;margin-bottom: 20px;">
    <button type="button" class="btn btn-xs btn-default" style="padding: 1px 3px;" onclick="$(this).next().toggle();">
      <i class="fa fa-cog fa-lg"></i> Фильтр
    </button>
    <div class="dropdown-menu dropdown-menu-xs pull-right" style="padding: 15px;width: 700px;left: 0px;">
      <div class="row">
        <div class="col-sm-2" style="width: 340px;">
          <select id="categories_1" class="form-control" name="categories_1">
            <option selected value="0">Выберите категорию</option>
            <?php foreach($site_variables["categories_1"] as $site_variables["category"]){ ?>
            <option value="<?php echo $site_variables["category"]["id"]; ?>" <?php if( $site_variables["session_var_product_category_1"] == $site_variables["category"]["id"]){ ?>selected<?php } ?>><?php echo $site_variables["category"]["name"]; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-sm-2" style="width: 340px;">
          <select id="categories_2" class="form-control" name="categories_2">
            <option selected value="0">Выберите категорию</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-2" style="width: 340px;">
          <select id="categories_3" class="form-control" name="categories_3">
            <option selected value="0">Выберите категорию</option>
          </select>
        </div>
        <div class="col-sm-2" style="width: 340px;">
          <select id="categories_4" class="form-control" name="categories_4">
            <option selected value="0">Выберите категорию</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-2" style="width: 340px;">
          <select id="sklad" name="sklad" class="form-control">
            <?php foreach($site_variables["sklads_info"] as $site_variables["item"]){ ?>
            <option <?php if( $site_variables["item"]["selected"] == 1 ){ ?>selected<?php } ?> value="<?php echo $site_variables["item"]["id"]; ?>"><?php echo $site_variables["item"]["name"]; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-sm-2" style="width: 340px;">
          <input type="text" name="product_name" placeholder="Введите название" value="<?php echo $site_variables["session_var_product_name"]; ?>" />
        </div>
      </div>

      <div class="row">
        <div class="col-sm-2" style="width: 340px;">
          <select name="order_by_column" style="width: 150px;">
            <option value="">Сортировать по</option>
            <option value="name">Название</option>
          </select>
          <select name="order_as" style="width: 120px;">
            <option value="asc">Возрастание</option>
            <option value="desc">Убывание</option>
          </select>
        </div>
        <div class="col-sm-2" style="width: 340px;">
          <input value="1" type="checkbox" name="product_type_tovar" <?php if( $site_variables["session_var_product_type_tovar"] == "1"){ ?>checked<?php } ?>><label>Товар</label><div class="clear"></div>
          <input value="2" type="checkbox" name="product_type_izdelie" <?php if( $site_variables["session_var_product_type_izdelie"] == "2"){ ?>checked<?php } ?>><label>Изделие</label><div class="clear"></div>
          <input value="3" type="checkbox" name="product_type_konstrukciya" <?php if( $site_variables["session_var_product_type_konstrukciya"] == "3"){ ?>checked<?php } ?>><label>Конструкция</label><div class="clear"></div>
		  <input value="4" type="checkbox" name="product_type_needtobuy" <?php if( $site_variables["session_var_product_type_needtobuy"] == "4"){ ?>checked<?php } ?>><label>Нужно купить</label><div class="clear"></div>
        </div>
      </div>

      <button type="submit" name="cmd" class="btn btn-default">Фильтровать</button>
    </div>
  </div>

<select id="categories_all" name="categories" style="display:none;">
<?php foreach($site_variables["categories"] as $site_variables["item"]){ ?>
<option value="0" selected>Не выбрано</option>
 <option <?php if( $site_variables["item"]["selected"] == 1 ){ ?>selected<?php } ?> value="<?php echo $site_variables["item"]["id"]; ?>"><?php echo $site_variables["item"]["name"]; ?></option>
<?php } ?>
</select>


<input type="hidden" name="valuta_change" value="1">
<select id="valuty" name="valuty" style="margin-left: 20px;">
 <option  value="">Валюта товара</option>
<?php foreach($site_variables["valuty"] as $site_variables["item"]){ ?>
 <option <?php if( $site_variables["item"]["kod_valuty"]== $site_variables["session_var_valyta"] ){ ?>selected<?php } ?> value="<?php echo $site_variables["item"]["kod_valuty"]; ?>"><?php echo $site_variables["item"]["name"]; ?></option>
<?php } ?>
</select>
</form>
<form id="view_removed_form" action="" method="post" style="display: inline-block;">
	<button type="submit" name="reset_filter" value = "1" class="reset_filter btn btn-info">Сбросить фильтр</button>
	<input id="view_removed" name="view_checked" style="margin-left: 20px;" <?php echo $site_variables["area_checked"]; ?> onchange="$('#view_removed_form').submit();" value="1" type="checkbox">
	<label for="view_removed" style = "background-color: #F5E4E7;">Вывести удаленные?</label>
	<input type="hidden" name="filter2" value="1">
</form>

<table class="table table-bordered">
				        <thead>
				          <tr>
                            <th>Картинка</th>
				            <th>Название</th>
                            <?php if( $site_variables["session_var_zak_price"] == 1){ ?><th>Цена</th><?php } ?>
                            <th>Розница</th>
                                            <th>Количество</th>
                                            <?php if( $site_variables["session_var_products_delete"] == 1 || $site_variables["session_var_products_update"] == 1){ ?><th style="width:23px;"> </th><?php } ?>
				          </tr>
				        </thead>       
                                    <tbody>       
				          
                                         <?php if( count($site_variables["products"])>0 ){ ?>
                                          <?php if(count($site_variables["products"]) > 0){ ?>
 <?php   foreach($site_variables["products"] as $products_item){ ?>
<tr <?php if( ($products_item["products_hidden"] == 1)){ ?> style = "background-color: #F5E4E7;"<?php } ?>>
  <td>
  <?php if( $products_item["products_image"] != ""){ ?>
  <a href="<?php echo $products_item["products_preview_url"]; ?>">
    <img width="80" src="<?php echo $site_variables["template_dir"]; ?>/../../../files/<?php echo $products_item["products_image"]; ?>" alt="" />
  </a>
  <?php } ?>
  </td>
  <td><a href="<?php echo $products_item["products_preview_url"]; ?>"><?php echo $products_item["products_name"]; ?></a></td>
  <td><?php echo $products_item["products_price"]; ?></td>
  <?php if( $site_variables["session_var_zak_price"] == 1){ ?>
  <td><?php echo $products_item["products_selling_price"]; ?></td>
  <?php } ?>
  <td <?php if( $products_item["products_cnt"] < $products_item["products_min_zapas"] && $products_item["products_min_zapas"] !=0){ ?>style="background-color:red;"<?php } ?><?php if( $products_item["products_cnt"]>$products_item["products_min_zapas"] && $products_item["products_cnt"]<$products_item["products_sred_zapas"] && $products_item["products_sred_zapas"] !=0){ ?>style="background-color:yellow;"<?php } ?>>
  <?php echo $products_item["products_cnt"]; ?>
  </td>
  
  <?php if( $site_variables["session_var_products_delete"] == 1 || $site_variables["session_var_products_update"] == 1){ ?>
  <td>
    <div class="btn-group display-inline pull-right text-align-left hidden-tablet">
      <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" style="padding: 1px 3px;">
        <i class="fa fa-cog fa-lg"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-xs pull-right">
         <li>
          <form action="" method="post">  
           <button type="submit" class="btn btn-large btn-primary" style="
			padding: 6px 12px 6px 8px;"><i class="fa fa-files-o fa-lg fa-fw txt-color-red"></i> Создать копию</button>
            <input type="hidden" name="copy_izdelie" value="<?php echo $products_item["products_id"]; ?>">
          </form>
        </li>
        <?php if( $site_variables["session_var_products_update"] == 1){ ?>
        <li>
          <a href="<?php echo $products_item["actions_list"]["products_update"]; ?>"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> Редактировать</a>
        </li>
        <?php } ?>
        <?php if( $site_variables["session_var_products_delete"] == 1){ ?>
        <li>
		<?php if( ($products_item["products_hidden"] == 0)){ ?> <a href="#" item_id = "<?php echo $products_item["products_id"]; ?>" class = "item_hide" ><i class="fa fa-times fa-lg fa-fw txt-color-red"></i> Удалить</a> 
		<?php }else{ ?> <a href="#" item_id = "<?php echo $products_item["products_id"]; ?>" class = "item_hide restore"><i class="fa fa-reply fa-lg fa-fw txt-color-red"></i> Восстановить</a>
		<?php } ?>
         
        </li>
        <?php } ?>
      </ul>
    </div>
  </td>
  <?php } ?> <?php   } ?>
 <?php } ?>

                                         <?php } ?>
				        </tbody>
				      </table>
 <?php if( $site_variables["products_navigation"] == 1 ){ ?>  
 <div class="pagination">  
  <ul>  
   <?php if( $site_variables["products_num1"] > 1){ ?><li <?php if( $site_variables["products_page_num"] == 1){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["products_prev_url"]; ?>" class="ext_disabled"> < </a></li><?php } ?>  
   <?php if( $site_variables["products_num1"] > 0){ ?><li <?php if( $site_variables["products_page_num"] == $site_variables["products_num1"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["products_num_1_url"]; ?>" class="ext_disabled"><?php echo $site_variables["products_num1"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["products_num2"] > 0){ ?><li <?php if( $site_variables["products_page_num"] == $site_variables["products_num2"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["products_num_2_url"]; ?>" class="ext_disabled"><?php echo $site_variables["products_num2"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["products_num3"] > 0){ ?><li <?php if( $site_variables["products_page_num"] == $site_variables["products_num3"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["products_num_3_url"]; ?>" class="ext_disabled"><?php echo $site_variables["products_num3"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["products_last_num"] > 3){ ?><li class="disabled"><a href="#" class="ext_disabled">...</a></li><?php } ?> 
   <?php if( $site_variables["products_last_num"] != $site_variables["products_num3"]){ ?><li <?php if( $site_variables["products_page_num"] == $site_variables["products_last_num"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["products_last_url"]; ?>" class="ext_disabled"><?php echo $site_variables["products_last_num"]; ?></a></li><?php } ?> 
   <?php if( $site_variables["products_page_num"] < $site_variables["products_last_num"]){ ?><li><a href="<?php echo $site_variables["products_next_url"]; ?>" class="ext_disabled"> > </a></li><?php } ?>  
  </ul> 
 </div>  
 <?php } ?>  


     <?php if( $site_variables["products_create_link"] != "" && $site_variables["session_var_products_create"] == 1){ ?>
      <form action = "<?php echo $site_variables["products_create_link"]; ?>" method="post">  
      <button type="submit" class="btn btn-large btn-primary">Добавить новый товар</button>
      </form>
     <?php } ?>

<?php if( $site_variables["session_var_products_create"] == 1){ ?>
      <form action = "<?php echo $site_variables["create_products_link"]; ?>" method="post">  
      <button type="submit" class="btn btn-large btn-primary">Добавить несколько товаров</button>
      </form>
     <?php } ?>
     <form action = "<?php echo $site_variables["move_product_link"]; ?>" method="post">  
      <button type="submit" class="btn btn-large btn-primary">Переместить товар</button>
      </form>

        <form action = "<?php echo $site_variables["create_elements_link"]; ?>" method="post">  
      <button type="submit" class="btn btn-large btn-primary">Добавить изделие</button>
      </form>
<script>
$("#categories_1").change(function(){
  var category_id = $(this).val();
  $("#categories_all [value="+category_id+" ]").attr("selected", "selected"); 
  $("#categories_all").trigger("change");;
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
                     var categories_2 = $("#categories_2").val();
                   if(categories_2 > 0){
                    $("#categories_2").trigger("change");
                 }
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
                     var categories_3 = $("#categories_3").val();
                if(categories_3 > 0){
                    $("#categories_3").trigger("change");
                 }
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
var categories_1 = $("#categories_1").val();
if(categories_1 > 0){
  $("#categories_1").trigger("change");
}

$("#valuty").change(function(){
  $("#form_filtr").submit();
});

$(".item_hide").click(function(){
	_this = this;
	if($(this).hasClass('restore')) act = 0;
	else act = 1;
	
	var id = $(this).attr("item_id");
	if(act == 0 || confirm('Вы уверены что хотите удалить продукт?'))
	{
		$.ajax({
			type: "POST",
			url: "",
			data: {"do":"hide_item","id":id, "type":act},
			success: function(html_page){
				if(act == 1)
				{
					if($('#view_removed').prop('checked'))
					{
						$(_this).html($(_this).html().replace("Удалить","Восстановить")).addClass("restore");
					}
					else
						$(_this).closest("tr").remove();
				}
				else $(_this).html($(_this).html().replace("Восстановить","Удалить")).removeClass("restore");
				
			}
		});	
	}
});
</script>

