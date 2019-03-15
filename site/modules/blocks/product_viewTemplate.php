<?php if( $site_variables["session_var_user_type"] == 5){ ?>
<a href="<?php echo $site_variables["tovar_update"]; ?>">Редактировать</a>
<a href="<?php echo $site_variables["tovar_delete"]; ?>">Удалить</a>
<?php } ?>
<form action="" method="post" id="form_filtr">
<input type="hidden" name="valuta_change" value="1">
<select id="valuty" name="valuty" style="margin-left: 20px;">
 <option  value="">Валюта товара</option>
<?php foreach($site_variables["valuty"] as $site_variables["item"]){ ?>
 <option <?php if( $site_variables["item"]["kod_valuty"]== $site_variables["session_var_valyta"] ){ ?>selected<?php } ?> value="<?php echo $site_variables["item"]["kod_valuty"]; ?>"><?php echo $site_variables["item"]["name"]; ?></option>
<?php } ?>
</select>
</form>
<a href="<?php echo $site_variables["cart_link"]; ?>" style="float:right;"><?php if( $site_variables["session_var_type_cart"] != 2){ ?>Корзина<?php } ?><?php if( $site_variables["session_var_type_cart"] == 2){ ?>Заявка<?php } ?>(<?php echo $site_variables["cart_count"]; ?>)</a>
<?php echo $site_variables["status"]; ?>
<form id = "global_form" action="" method="post">
<div>
  <h3><?php echo $site_variables["product_info"]["name"]; ?></h3>
  <br>
  <!--
  <div class="image_bar">
    <div class="sp-wrap">
      <?php foreach($site_variables["images"] as $site_variables["item"]){ ?>
      <a href="http://maxilux.life-super.com/maxilux/product_view/<?php echo $site_variables["product_id"]; ?>.html"><img src="http://projects.life-super.com/maxilux/files/<?php echo $site_variables["product_id"]; ?>/<?php echo $site_variables["item"]["name"]; ?>" alt=""></a>
      <?php } ?>
    </div>
    <script type="text/javascript" src="http://kthornbloom.com/smoothproducts/js/smoothproducts.min.js"></script>
    <script type="text/javascript">
      /* wait for images to load */
      $(window).load( function() {
        $('.sp-wrap').smoothproducts();
      });
    </script>
  </div>
  //-->
  <div class="image_line">
    <?php foreach($site_variables["images"] as $site_variables["item"]){ ?>
    <a class="fancybox" rel="gallery1" target="_blank" href = "<?php echo $site_variables["template_dir"]; ?>/../../../files/<?php echo $site_variables["product_id"]; ?>/<?php echo $site_variables["item"]["name"]; ?>" title="<?php echo $site_variables["item"]["opisanie"]; ?>">
		<img width="80" src="<?php echo $site_variables["template_dir"]; ?>/../../../files/<?php echo $site_variables["product_id"]; ?>/<?php echo $site_variables["item"]["name"]; ?>" alt="" />
    </a>
    <?php } ?>
  </div>

  <!-- Add mousewheel plugin (this is optional) -->
  <script type="text/javascript" src="<?php echo $site_variables["template_dir"]; ?>/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

  <!-- Add fancyBox -->
  <link rel="stylesheet" href="<?php echo $site_variables["template_dir"]; ?>/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
  <script type="text/javascript" src="<?php echo $site_variables["template_dir"]; ?>/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

  <!-- Optionally add helpers - button, thumbnail and/or media -->
  <link rel="stylesheet" href="<?php echo $site_variables["template_dir"]; ?>/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
  <script type="text/javascript" src="<?php echo $site_variables["template_dir"]; ?>/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
  <script type="text/javascript" src="<?php echo $site_variables["template_dir"]; ?>/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

  <link rel="stylesheet" href="<?php echo $site_variables["template_dir"]; ?>/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
  <script type="text/javascript" src="<?php echo $site_variables["template_dir"]; ?>/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
  <script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox({
			prevEffect	: 'none',
			nextEffect	: 'none',
			helpers	: {
				title	: {
					type: 'outside'
				},
				thumbs	: {
					width	: 50,
					height	: 50
				}
			}
		});
	});
  </script>



  <div class="b-product_main-info-panel">
    <div><span class="product_state">В наличии</span> <span style="margin-left:5px;">Код:<?php echo $site_variables["product_info"]["id"]; ?></span></div>
    <div class="b-dotted-panel">
      <?php if( $site_variables["session_var_zak_price"] == 1){ ?>
      <div class="b-dotted-panel__holder">

                <span class="b-product__price-text">
                        Цена:
                </span>

        <div class="b-dotted-panel__frame">

                    <span class="b-product__price Price1">
                        <span class=""><?php echo $site_variables["product_info"]["view_price"]; ?></span>
                    </span>
        </div>
      </div>
      <?php } ?>

        <div class="b-dotted-panel__holder">

                <span class="b-product__price-text">
                        Розничная цена:
                </span>

        <div class="b-dotted-panel__frame">

                    <span class="b-product__price Price2">
                        <span class=""><?php echo $site_variables["product_info"]["view_roznica"]; ?></span>
                    </span>
        </div>
      </div>
    </div>

    <?php if( $site_variables["only_review"] != 1){ ?>
    <?php echo $site_variables["html_option"]; ?>

    <?php if(  count($site_variables["categories_data"]) > 0){ ?>
    <?php foreach($site_variables["categories_data"] as $site_variables["category"]){ ?>
    <div style="margin-bottom: 15px;">
      <b><?php echo $site_variables["category"]["name"]; ?>:</b><span class="price_tov"></span><br>
      <?php if( !empty($site_variables["category"]["products"])){ ?>
      <select class="products" name="product[]" style = "width: 300px;">
        <option value="0">Выберите</option>
        <?php foreach($site_variables["category"]["products"] as $site_variables["option"]){ ?>

        <option price="<?php echo $site_variables["option"]["price"]; ?>" value="<?php echo $site_variables["option"]["id"]; ?>"><?php echo $site_variables["option"]["name"]; ?></option>
        <?php } ?>
      </select>
      <div id="izdelia_categories_<?php echo $site_variables["category"]["id"]; ?>"></div>
      <?php } ?>
      <?php if( !empty($site_variables["category"]["options"])){ ?>
      <?php if( $site_variables["category"]["type"] == 0){ ?>
      <select class="category" item_id="<?php echo $site_variables["category"]["id"]; ?>" name="category[]" style = "width: 300px;">
        <option value="0">Выберите категорию</option>
        <?php foreach($site_variables["category"]["options"] as $site_variables["option"]){ ?>
        <option <?php if( isset($site_variables["cart_tovar"]["category"])){ ?><?php foreach($site_variables["cart_tovar"]["category"] as $site_variables["option2"]){ ?> <?php if( $site_variables["option2"] == $site_variables["option"]["id"]){ ?>selected<?php } ?><?php } ?><?php } ?> value="<?php echo $site_variables["option"]["id"]; ?>"><?php echo $site_variables["option"]["name"]; ?></option>
        <?php } ?>
      </select>
      <div id="izdelia_categories_<?php echo $site_variables["category"]["id"]; ?>"></div>
      <?php }else{ ?>
        <?php foreach($site_variables["category"]["options"] as $site_variables["option"]){ ?>
      <br><?php echo $site_variables["option"]["name"]; ?><br>
        <select class="category" item_id="<?php echo $site_variables["category"]["id"]; ?>" name="category[]" style = "width: 300px;">
          <option value="0">Выберите категорию</option>
          <?php foreach($site_variables["option"]["cat"] as $site_variables["o"]){ ?>
          <option <?php if( isset($site_variables["cart_tovar"]["category"])){ ?><?php foreach($site_variables["cart_tovar"]["category"] as $site_variables["option2"]){ ?> <?php if( $site_variables["option2"] == $site_variables["o"]["id"]){ ?>selected<?php } ?><?php } ?><?php } ?> value="<?php echo $site_variables["o"]["id"]; ?>"><?php echo $site_variables["o"]["name"]; ?></option>
          <?php } ?>
        </select>
        <div id="izdelia_categories_<?php echo $site_variables["category"]["id"]; ?>"></div>
        <?php } ?>
      <?php } ?>

      <script type="text/javascript">

        function perebor(){
			<?php if(($site_variables["block_attr"] != 'create')){ ?>
			  $(".category").each(function(indx){
				var cat_attr = $(this).attr("changed");
				var cat_id = $(this).val();
				
				if(cat_id != '0' && cat_attr!=1){
				  $(this).trigger("change");
				  $(this).attr("changed",1);
				}
			  });

			  $(".products").each(function(indx){
				var cat_attr = $(this).attr("changed");
				var cat_id = $(this).val();
				if(cat_id != '0' && cat_attr!=1){
				  $(this).trigger("change");
				  $(this).attr("changed",1);
				}
			  });

			  $(".category_izdelia").each(function(indx){
				var cat_attr = $(this).attr("changed");
				var cat_id = $(this).val();
				if(cat_id != '0' && cat_attr!=1){
				  $(this).trigger("change");
				  $(this).attr("changed",1);
				}
			  });
			<?php } ?>
		}

	var prev_category = -1;
        $("body").delegate(".category", "change", function() {
          var category_id = $(this).val();
          var _this = this;
          
          
          if(prev_category == category_id) return;
          
          prev_category = category_id;
          console.log(category_id);

          $.ajax({
            dataType: 'json',
            type: "POST",
            url: "",
            data:{"do":"get_category","category_id":category_id},
            success: function(html){
              if(html.data != ""){
				//alert("Прайс: <?php echo $site_variables["product_info"]["price"]; ?>");
			    //$(".Price1").text(html.price);
                $(_this).next().css("margin-top","15px").css("margin-bottom","20px").html(html.data);
                perebor();
              }else{
                $(_this).next().css("margin-top","0px").css("margin-bottom","0px").html(html.data);
              }
            }
          });

        });
      </script>
      <?php } ?>
      <?php if( !empty($site_variables["category"]["izdeliya"])){ ?>
      <br><b>Выберите изделие:<br>
      <select class="category_izdelia" name="izdelie[]" style = "width: 300px;">
        <option value="0">Выберите изделие</option>
        <?php foreach($site_variables["category"]["izdeliya"] as $site_variables["izdeliya"]){ ?>
        <option <?php foreach($site_variables["cart_tovar"]["izdelie"] as $site_variables["option2"]){ ?> <?php if( $site_variables["option2"] == $site_variables["izdeliya"]["id"]){ ?>selected<?php } ?><?php } ?> value="<?php echo $site_variables["izdeliya"]["id"]; ?>"><?php echo $site_variables["izdeliya"]["name"]; ?></option>
        <?php } ?>
      </select>
      <div id="izdelia_options_<?php echo $site_variables["category"]["id"]; ?>"></div>
      <script type="text/javascript">
        $("body").delegate(".category_izdelia", "change", function() {
          var izd_id = $(this).val();
          var _this = this;

          $.ajax({
            dataType: 'json',
            type: "POST",
            url: "",
            data:{"do":"get_izdelie_options","izd_id":izd_id},
            success: function(html){
              if(html.data != ""){
                $(_this).next().css("margin-top","15px").css("margin-bottom","20px").html(html.data);
                perebor();
              }else{
                $(_this).next().css("margin-top","0px").css("margin-bottom","0px").html(html.data);
              }
            }
          });
        });

      </script>
      <?php } ?>
    </div>
    <?php } ?>
    <?php } ?>
    <div><button class="btn btn-success"><?php if( $site_variables["type_action"] == "edit_cart"){ ?>Обновить <?php if( $site_variables["session_var_type_cart"] == 1){ ?>корзину<?php } ?><?php if( $site_variables["session_var_type_cart"] == 2){ ?>заявку<?php } ?><?php }else{ ?>Добавить в <?php if( $site_variables["session_var_type_cart"] == 1){ ?>корзину<?php } ?><?php if( $site_variables["session_var_type_cart"] == 2){ ?>заявку<?php } ?><?php } ?></button>
      <input type="text" name="product_cnt" value="1" class="input_cnt">шт
    </div>
	
	<div style = "padding-top: 15px;">
<?php if((count($site_variables["options_db"]))){ ?>
		<button class="btn btn-success" type = "button" id="get_total_price_val">Показать стоимость</button><br>
		<h4 id = "total_price_val"></h4>
  <?php } ?>
	</div>
    <?php } ?>
  </div>
  <input type="hidden" name="add_cart" value="1">
  <input type="hidden" name="price_product" value="<?php echo $site_variables["product_info"]["price"]; ?>">
</div>
<div style="clear:both;"></div>

<?php if( $site_variables["product_info"]["description"] !=""){ ?>
<h3>Описание</h3>
<div class="info_product"><?php echo $site_variables["product_info"]["description"]; ?>
</div>
<?php } ?>
<?php if( $site_variables["product_info"]["shirina"] !=0 && $site_variables["product_info"]["vysota"] !="" && $site_variables["product_info"]["glubina"] !="" && $site_variables["product_info"]["ves"] !=""){ ?>
<h3>Характеристики</h3>
<div class="info_product">
  <table style="width: 200px;">
    <tr>
      <td style="width: 49px;">Ширина</td>
      <td><div><div style="border-bottom: 1px solid #ccc;position: relative;top: 6px;"></div></div></td>
      <td style="width: 50px;"><?php echo $site_variables["product_info"]["shirina"]; ?> <?php if( $site_variables["product_info"]["izmerenie"] == 0){ ?>cм<?php } ?><?php if( $site_variables["product_info"]["izmerenie"] == 1){ ?>мм<?php } ?></td>
    </tr>
  </table>

  <table style="width: 200px;">
    <tr>
      <td style="width: 44px;">Высота</td>
      <td><div><div style="border-bottom: 1px solid #ccc;position: relative;top: 6px;"></div></div></td>
      <td style="width: 50px;"><?php echo $site_variables["product_info"]["vysota"]; ?> <?php if( $site_variables["product_info"]["izmerenie"] == 0){ ?>cм<?php } ?><?php if( $site_variables["product_info"]["izmerenie"] == 1){ ?>мм<?php } ?></td>
    </tr>
  </table>

  <table style="width: 200px;">
    <tr>
      <td style="width: 49px;">Глубина</td>
      <td><div><div style="border-bottom: 1px solid #ccc;position: relative;top: 6px;"></div></div></td>
      <td style="width: 50px;"><?php echo $site_variables["product_info"]["glubina"]; ?> <?php if( $site_variables["product_info"]["izmerenie"] == 0){ ?>cм<?php } ?><?php if( $site_variables["product_info"]["izmerenie"] == 1){ ?>мм<?php } ?></td>
    </tr>
  </table>

  <table style="width: 200px;">
    <tr>
      <td style="width: 21px;">Вес</td>
      <td><div><div style="border-bottom: 1px solid #ccc;position: relative;top: 6px;"></div></div></td>
      <td style="width: 50px;"><?php echo $site_variables["product_info"]["ves"]; ?> г</td>
    </tr>
  </table>
  <?php } ?>

  <script type="text/javascript">
	$("#valuty").change(function(){
	  $("#form_filtr").submit();
	});

    $("body").delegate(".products", "change", function() {
      var id_product = $(this).val();
      var _this = this;
      $.ajax({
        dataType: 'json',
        type: "POST",
        url: "",
        data:{"do":"get_price","id_product":id_product },
        success: function(html){
          $(_this).prev().prev().html(html.view_price);
          perebor();
        }
      });
    });

    perebor();

  </script>
</form>

<?php if( $site_variables["product_info_html"] != ""){ ?>
 

 <h1>Описание изделия</h1>

 

<?php echo $site_variables["product_info_html"]; ?>
<?php } ?>

<script type="text/javascript">
$("#get_total_price_val").click(function(){
	_this = this;
	$(_this).html("<i class='fa fa-refresh fa-spin'></i>").attr("disabled",true);
	$.ajax({
        type: "POST",
        url: "",
        data:$("#global_form").serialize()+"&do=get_total_price",
        success: function(result){
          $("#total_price_val").html("Общая стоимость: <b>"+result+"</b>");
		  $(_this).html("Показать стоимость").attr("disabled",false);
        }
      });
});
</script>

