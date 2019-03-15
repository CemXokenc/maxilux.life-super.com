<?php if( $site_variables["session_var_type_cart"] == 1 && $site_variables["session_var_zayavki_list"] == 1){ ?>
	<form action="" method="post">
	  <input type="hidden" name="type" value="zayavka">
	  <button class="btn btn-success">Сформировать заявку</button>
	</form>
<?php } ?>
<?php if( $site_variables["session_var_type_cart"] == 2 && $site_variables["session_var_zakaz_list"] == 1){ ?>
<form action="" method="post">
  <input type="hidden" name="type" value="zakaz">
  <button class="btn btn-success">Сформировать заказ</button>
</form>
<?php } ?>
<br>
<form action="" method="post" id="form_filtr">
  <div class="btn-group display-inline pull-right text-align-left hidden-tablet" style="float: left !important;margin-bottom: 20px;">
    <button type="button" class="btn btn-xs btn-default" style="padding: 1px 3px;" onclick="$(this).next().toggle();">
      <i class="fa fa-cog fa-lg"></i> Фильтр
    </button>
    <div class="dropdown-menu dropdown-menu-xs pull-right" style="padding: 15px;width: 700px;left: 0px;">
      <div class="row">
        <div class="col-sm-2" style="width: 340px;">
          <input type="text" name="name_search" class="form-control" value="<?php echo $site_variables["name_search"]; ?>" placeholder="Поиск по названию товара" />
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2" style="width: 340px;">
          <select id="categories_1" class="form-control" name="categories_1">
            <option selected value="0">Выберите категорию</option>
            <?php foreach($site_variables["categories_1"] as $site_variables["category"]){ ?>
            <option value="<?php echo $site_variables["category"]["id"]; ?>" <?php if( $site_variables["session_var_shop_product_category_1"] == $site_variables["category"]["id"]){ ?>selected<?php } ?>><?php echo $site_variables["category"]["name"]; ?></option>
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
        <div class="col-sm-6">
          Цена:<br>
          C         <input name="cena_c" class="form-control" type="text" <?php if( $site_variables["session_var_products_list_cena_c"] != ""){ ?>value="<?php echo $site_variables["session_var_products_list_cena_c"]; ?>"<?php } ?>>
        </div>
        <div class="col-sm-6">
          <br>До 
            <input name="cena_do" class="form-control" type="text" <?php if( $site_variables["session_var_products_list_cena_do"] != ""){ ?>value="<?php echo $site_variables["session_var_products_list_cena_do"]; ?>"<?php } ?>>
        </div>
      </div>

<div class="row">
        <div class="col-sm-12">
          Картинки
          <select class="form-control" name="got_images">
            <option value="" <?php if( $site_variables["session_var_products_list_got_images"]  === ""){ ?>selected<?php } ?>>Все</option>
            <option value="1" <?php if( $site_variables["session_var_products_list_got_images"] == 1){ ?>selected<?php } ?>>С картинкой</option>
            <option value="0" <?php if( $site_variables["session_var_products_list_got_images"]  === 0){ ?>selected<?php } ?>>Без картинки</option>
          </select>
        </div>
      </div>
      <button type="submit" name="cmd" class="btn btn-default">Фильтровать</button>
    </div>
  </div>
  <a href="<?php echo $site_variables["cart_link"]; ?>" style="float:right;"><?php if( $site_variables["session_var_type_cart"] != 2){ ?>Корзина<?php } ?><?php if( $site_variables["session_var_type_cart"] == 2){ ?>Заявка<?php } ?>(<?php echo $site_variables["cart_count"]; ?>)</a>
  <select id="categories_all" name="categories" style="display:none;">
    <option  value="">Пустая категория</option>
    <?php foreach($site_variables["categories"] as $site_variables["item"]){ ?>
    <option <?php if( $site_variables["item"]["selected"] == 1 ){ ?>selected<?php } ?> value="<?php echo $site_variables["item"]["id"]; ?>"><?php echo $site_variables["item"]["name"]; ?></option>
    <?php } ?>
  </select>

  <select id="valuty" name="valuty" style="margin-left: 20px;">
    <option  value="">Валюта товара</option>
    <?php foreach($site_variables["valuty"] as $site_variables["item"]){ ?>
    <option <?php if( $site_variables["item"]["kod_valuty"]== $site_variables["session_var_valyta"] ){ ?>selected<?php } ?> value="<?php echo $site_variables["item"]["kod_valuty"]; ?>"><?php echo $site_variables["item"]["name"]; ?></option>
    <?php } ?>
  </select>
</form>
<br>

<div style = "font-size: 16px;">
	<span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> <a href = "<?php echo $site_variables["list_link_1"]; ?>">В виде галлереи</a>
	<span class="glyphicon glyphicon-th-list" aria-hidden="true" style = "margin-left: 50px;"></span> <a href = "<?php echo $site_variables["list_link_2"]; ?>">В виде списка</a>
</div>

<br>

<?php if( $site_variables["list_type"] == 1){ ?>
	<ul class="list-inline">
		<?php if( count($site_variables["products_list"])>0 ){ ?>
			 <?php if(count($site_variables["products_list"]) > 0){ ?>
 <?php   foreach($site_variables["products_list"] as $products_list_item){ ?>
<?php if( $site_variables["list_type"] == 1){ ?>
	<li class = "products-gallery">
		<?php if( $products_list_item["products_image"] != ""){ ?>
			<a href="<?php echo $products_list_item["actions_list"]["product_view"]; ?>">
			<img class= "preview_img" src="<?php echo $site_variables["template_dir"]; ?>/../../../files/<?php echo $products_list_item["products_image"]; ?>" alt="" />
			</a>
		<?php } ?>
		
		<div>
			<a href="<?php echo $products_list_item["actions_list"]["product_view"]; ?>"><?php echo $products_list_item["products_name"]; ?></a>
			<?php if( $site_variables["session_var_zak_price"] == 1){ ?><div class = "price">Цена: <b><?php echo $products_list_item["products_price"]; ?></b></div><?php } ?>
			<div class = "price">Розн. цена: <b><?php echo $products_list_item["products_roznichnaya_price"]; ?></b></div>
			
			<?php if( $products_list_item["products_izdelie"] == 0){ ?>
			<form action="<?php echo $products_list_item["actions_list"]["product_view"]; ?>" method="post">
				<input type="hidden" name="add_cart" value="1">
				<input type="hidden" name="price_product" value="<?php echo $products_list_item["products_roznichnaya_price"]; ?>">
				
				<span onclick="var num=$(this).next().val();num=num-1;if(num<1)num=1;$(this).next().val(num);" class="glyphicon glyphicon-minus" aria-hidden="true"></span>
				<input type="text" name="product_cnt" value="1" class="form-control input_cnt">
				<span onclick="var num=$(this).prev().val();num=parseInt(num)+1;if(num<1)num=1;$(this).prev().val(num);" class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				<br>
				<button class="btn btn-success"><?php if( $site_variables["session_var_type_cart"] != 2){ ?>В корзину<?php } ?><?php if( $site_variables["session_var_type_cart"] == 2){ ?>Добавить в заявку<?php } ?></button>
			</form>
			<?php } ?>
		</div>
		
	</li>
<?php }else{ ?>
	<tr>
		<td class="image-product">
			<?php if( $products_list_item["products_image"] != ""){ ?>
				<a href="<?php echo $products_list_item["actions_list"]["product_view"]; ?>">
				<img class= "preview_img"  src="<?php echo $site_variables["template_dir"]; ?>/../../../files/<?php echo $products_list_item["products_image"]; ?>" alt="" />
				</a>
			<?php } ?>
		</td>
		
		<td class = "product-info">
			<a href="<?php echo $products_list_item["actions_list"]["product_view"]; ?>"><?php echo $products_list_item["products_name"]; ?></a>
			<?php if( $site_variables["session_var_zak_price"] == 1){ ?><div class = "price">Цена: <b><?php echo $products_list_item["products_price"]; ?></b></div><?php } ?>
			<div class = "price">Розн. цена: <b><?php echo $products_list_item["products_roznichnaya_price"]; ?></b></div>
		</td>

		<td class = "elements-control">
			<?php if( $products_list_item["products_izdelie"] == 0){ ?>
			<form action="<?php echo $products_list_item["actions_list"]["product_view"]; ?>" method="post">
				<input type="hidden" name="add_cart" value="1">
				<input type="hidden" name="price_product" value="<?php echo $products_list_item["products_roznichnaya_price"]; ?>">
				
				<span onclick="var num=$(this).next().val();num=num-1;if(num<1)num=1;$(this).next().val(num);" class="glyphicon glyphicon-minus" aria-hidden="true"></span>
				<input type="text" name="product_cnt" value="1" class="form-control input_cnt">
				<span onclick="var num=$(this).prev().val();num=parseInt(num)+1;if(num<1)num=1;$(this).prev().val(num);" class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				<br>
				<button class="btn btn-success cart_add"><?php if( $site_variables["session_var_type_cart"] != 2){ ?>В корзину<?php } ?><?php if( $site_variables["session_var_type_cart"] == 2){ ?>Добавить в заявку<?php } ?></button>
			</form>
			<?php } ?>
		</td>
	</tr>
<?php } ?> <?php   } ?>
 <?php } ?>

		<?php } ?>
	</ul>
<?php }else{ ?>
	<table class="table table-bordered">
	  <tbody>
		  <?php if( count($site_variables["products_list"])>0 ){ ?>
			 <?php if(count($site_variables["products_list"]) > 0){ ?>
 <?php   foreach($site_variables["products_list"] as $products_list_item){ ?>
<?php if( $site_variables["list_type"] == 1){ ?>
	<li class = "products-gallery">
		<?php if( $products_list_item["products_image"] != ""){ ?>
			<a href="<?php echo $products_list_item["actions_list"]["product_view"]; ?>">
			<img class= "preview_img" src="<?php echo $site_variables["template_dir"]; ?>/../../../files/<?php echo $products_list_item["products_image"]; ?>" alt="" />
			</a>
		<?php } ?>
		
		<div>
			<a href="<?php echo $products_list_item["actions_list"]["product_view"]; ?>"><?php echo $products_list_item["products_name"]; ?></a>
			<?php if( $site_variables["session_var_zak_price"] == 1){ ?><div class = "price">Цена: <b><?php echo $products_list_item["products_price"]; ?></b></div><?php } ?>
			<div class = "price">Розн. цена: <b><?php echo $products_list_item["products_roznichnaya_price"]; ?></b></div>
			
			<?php if( $products_list_item["products_izdelie"] == 0){ ?>
			<form action="<?php echo $products_list_item["actions_list"]["product_view"]; ?>" method="post">
				<input type="hidden" name="add_cart" value="1">
				<input type="hidden" name="price_product" value="<?php echo $products_list_item["products_roznichnaya_price"]; ?>">
				
				<span onclick="var num=$(this).next().val();num=num-1;if(num<1)num=1;$(this).next().val(num);" class="glyphicon glyphicon-minus" aria-hidden="true"></span>
				<input type="text" name="product_cnt" value="1" class="form-control input_cnt">
				<span onclick="var num=$(this).prev().val();num=parseInt(num)+1;if(num<1)num=1;$(this).prev().val(num);" class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				<br>
				<button class="btn btn-success"><?php if( $site_variables["session_var_type_cart"] != 2){ ?>В корзину<?php } ?><?php if( $site_variables["session_var_type_cart"] == 2){ ?>Добавить в заявку<?php } ?></button>
			</form>
			<?php } ?>
		</div>
		
	</li>
<?php }else{ ?>
	<tr>
		<td class="image-product">
			<?php if( $products_list_item["products_image"] != ""){ ?>
				<a href="<?php echo $products_list_item["actions_list"]["product_view"]; ?>">
				<img class= "preview_img"  src="<?php echo $site_variables["template_dir"]; ?>/../../../files/<?php echo $products_list_item["products_image"]; ?>" alt="" />
				</a>
			<?php } ?>
		</td>
		
		<td class = "product-info">
			<a href="<?php echo $products_list_item["actions_list"]["product_view"]; ?>"><?php echo $products_list_item["products_name"]; ?></a>
			<?php if( $site_variables["session_var_zak_price"] == 1){ ?><div class = "price">Цена: <b><?php echo $products_list_item["products_price"]; ?></b></div><?php } ?>
			<div class = "price">Розн. цена: <b><?php echo $products_list_item["products_roznichnaya_price"]; ?></b></div>
		</td>

		<td class = "elements-control">
			<?php if( $products_list_item["products_izdelie"] == 0){ ?>
			<form action="<?php echo $products_list_item["actions_list"]["product_view"]; ?>" method="post">
				<input type="hidden" name="add_cart" value="1">
				<input type="hidden" name="price_product" value="<?php echo $products_list_item["products_roznichnaya_price"]; ?>">
				
				<span onclick="var num=$(this).next().val();num=num-1;if(num<1)num=1;$(this).next().val(num);" class="glyphicon glyphicon-minus" aria-hidden="true"></span>
				<input type="text" name="product_cnt" value="1" class="form-control input_cnt">
				<span onclick="var num=$(this).prev().val();num=parseInt(num)+1;if(num<1)num=1;$(this).prev().val(num);" class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				<br>
				<button class="btn btn-success cart_add"><?php if( $site_variables["session_var_type_cart"] != 2){ ?>В корзину<?php } ?><?php if( $site_variables["session_var_type_cart"] == 2){ ?>Добавить в заявку<?php } ?></button>
			</form>
			<?php } ?>
		</td>
	</tr>
<?php } ?> <?php   } ?>
 <?php } ?>

		  <?php } ?>
	  </tbody>
	</table>
<?php } ?>

 <?php if( $site_variables["products_list_navigation"] == 1 ){ ?>  
 <div class="pagination">  
  <ul>  
   <?php if( $site_variables["products_list_num1"] > 1){ ?><li <?php if( $site_variables["products_list_page_num"] == 1){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["products_list_prev_url"]; ?>" class="ext_disabled"> < </a></li><?php } ?>  
   <?php if( $site_variables["products_list_num1"] > 0){ ?><li <?php if( $site_variables["products_list_page_num"] == $site_variables["products_list_num1"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["products_list_num_1_url"]; ?>" class="ext_disabled"><?php echo $site_variables["products_list_num1"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["products_list_num2"] > 0){ ?><li <?php if( $site_variables["products_list_page_num"] == $site_variables["products_list_num2"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["products_list_num_2_url"]; ?>" class="ext_disabled"><?php echo $site_variables["products_list_num2"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["products_list_num3"] > 0){ ?><li <?php if( $site_variables["products_list_page_num"] == $site_variables["products_list_num3"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["products_list_num_3_url"]; ?>" class="ext_disabled"><?php echo $site_variables["products_list_num3"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["products_list_last_num"] > 3){ ?><li class="disabled"><a href="#" class="ext_disabled">...</a></li><?php } ?> 
   <?php if( $site_variables["products_list_last_num"] != $site_variables["products_list_num3"]){ ?><li <?php if( $site_variables["products_list_page_num"] == $site_variables["products_list_last_num"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["products_list_last_url"]; ?>" class="ext_disabled"><?php echo $site_variables["products_list_last_num"]; ?></a></li><?php } ?> 
   <?php if( $site_variables["products_list_page_num"] < $site_variables["products_list_last_num"]){ ?><li><a href="<?php echo $site_variables["products_list_next_url"]; ?>" class="ext_disabled"> > </a></li><?php } ?>  
  </ul> 
 </div>  
 <?php } ?>  


<script type="text/javascript">
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


</script>

