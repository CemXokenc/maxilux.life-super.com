<form action="" method="post">
  <div class="btn-group display-inline pull-right text-align-left hidden-tablet" style="float: left !important;margin-bottom: 20px;">
    <button type="button" class="btn btn-xs btn-default" style="padding: 1px 3px;" onclick="$(this).next().toggle();">
      <i class="fa fa-cog fa-lg"></i> Фильтр
    </button>
    <div class="dropdown-menu dropdown-menu-xs pull-right" style="padding: 15px;width: 700px;left: 0px;">

    
      <div class="row">
        <?php if( $site_variables["session_var_user_type"] == "5" ){ ?>
        <div class="col-sm-6">
          <select s name="torg_tchk" class="form-control" >
            <option value="0">Выберите Торговую точку</option>
            <?php if( count($site_variables["torg_tochki"])>0){ ?>
            <?php foreach($site_variables["torg_tochki"] as $site_variables["torg_tochka"]){ ?>
            <option <?php if( $site_variables["session_var_zakaz_torg_tochka"] == $site_variables["torg_tochka"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["torg_tochka"]["id"]; ?>"><?php echo $site_variables["torg_tochka"]["name"]; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
        <?php } ?>
        <div class="col-sm-6">
          <select s name="client" class="form-control" >
            <option value="0">Выберите клиента</option>
            <?php if( count($site_variables["clients"])>0){ ?>
            <?php foreach($site_variables["clients"] as $site_variables["client"]){ ?>
            <option <?php if( $site_variables["session_var_zakaz_client"] == $site_variables["client"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["client"]["id"]; ?>"><?php echo $site_variables["client"]["fio"]; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
      
       </div>
	  
      <div class="row">
        <div class="col-sm-6">
          <select s name="manager" class="form-control" >
            <option value="0">Выберите менеджера</option>
            <?php if( count($site_variables["managers"])>0){ ?>
            <?php foreach($site_variables["managers"] as $site_variables["manager"]){ ?>
            <option <?php if( $site_variables["session_var_zakaz_manager"] == $site_variables["manager"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["manager"]["id"]; ?>"><?php echo $site_variables["manager"]["first_name"]; ?> <?php echo $site_variables["manager"]["last_name"]; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>

         <div class="col-sm-6">
          <select name="skidka" class="form-control" >
            <option value="">Выберите скидку клиента</option>
            <?php foreach($site_variables["skidki_db"] as $site_variables["skidka"]){ ?>
            <?php if( $site_variables["skidka"]["name"] != ""){ ?><option <?php if( $site_variables["session_var_zakazy_products_skidka"] == $site_variables["skidka"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["skidka"]["id"]; ?>"><?php echo $site_variables["skidka"]["name"]; ?></option><?php } ?>
            <?php } ?>
          </select>
        </div>
      </div>
    <div class="row">
        <div class="col-sm-2" style="width: 340px;">
           <input type="text" name="tovar_name" class="form-control" value="<?php echo $site_variables["session_var_zakazy_products_tovar_name"]; ?>" placeholder="Поиск по названию товара" />
         </div>
    </div>
      <div class="row">
        <div class="col-sm-6">
          Дата:<br>
          C <div id="dp-ex-3" class="input-group date" data-auto-close="true" data-date="2014-01-01" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
            <input name="data_c" class="form-control" type="text" <?php if( $site_variables["session_var_zakaz_data_c"] != ""){ ?>value="<?php echo $site_variables["session_var_zakaz_data_c"]; ?>"<?php } ?>>
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
        <div class="col-sm-6">
          <br>До <div id="dp-ex-4" class="input-group date" data-auto-close="true" data-date="2014-01-01" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
            <input name="data_do" class="form-control" type="text" <?php if( $site_variables["session_var_zakaz_data_do"] != ""){ ?>value="<?php echo $site_variables["session_var_zakaz_data_do"]; ?>"<?php } ?>>
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <input class="form-control" placeholder="# заказа" type="text" id="order_num" name="order_num" value="<?php echo $site_variables["session_var_order_num"]; ?>">
        </div>
        <div class="col-sm-6">
          <select name="order_statuses" class="form-control" >
            <option value="">Выберите статус</option>
            <?php foreach($site_variables["order_statuses"] as $site_variables["status"]){ ?>
            <option <?php if( $site_variables["session_var_order_statuses"] == $site_variables["status"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["status"]["id"]; ?>"><?php echo $site_variables["status"]["name"]; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
	  
      <button type="submit" name="cmd" class="btn btn-default">Фильтровать</button>
    </div>
  </div>
  <div class="btn-group display-inline pull-right text-align-left hidden-tablet" style="float: left !important;margin-bottom: 20px;margin-left: 20px;">
    <button type="button" class="btn btn-xs btn-default" style="padding: 1px 3px;" onclick="$(this).next().toggle();">
      <i class="fa fa-cog fa-lg"></i> Фильтровать по категориям
    </button>
    <div class="dropdown-menu dropdown-menu-xs pull-right" style="padding: 15px;width: 700px;left: 0px;">

      <div class="row">
        <div class="col-sm-6">
          <select id="categories_1" class="form-control" name="categories_1">
            <option selected value="0">Выберите категорию</option>
            <?php foreach($site_variables["categories_1"] as $site_variables["category"]){ ?>
            <option value="<?php echo $site_variables["category"]["id"]; ?>" <?php if( $site_variables["session_var_product_category_1"] == $site_variables["category"]["id"]){ ?>selected<?php } ?>><?php echo $site_variables["category"]["name"]; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-sm-6">
          <select id="categories_2" class="form-control" name="categories_2">
            <option selected value="0">Выберите категорию</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <select id="categories_3" class="form-control" name="categories_3">
            <option selected value="0">Выберите категорию</option>
          </select>
        </div>
        <div class="col-sm-6">
          <select id="categories_4" class="form-control" name="categories_4">
            <option selected value="0">Выберите категорию</option>
          </select>
        </div>
      </div>
      <button type="submit" name="cmd" class="btn btn-default">Фильтровать</button>
    </div>
  </div>
  
  <select id="categories_all" name="categories" style="display:none;">
    <option value="">select item</option>
    <?php foreach($site_variables["categories"] as $site_variables["item"]){ ?>
    <option <?php if( $site_variables["item"]["selected"] == 1 ){ ?>selected<?php } ?> value="<?php echo $site_variables["item"]["id"]; ?>"><?php echo $site_variables["item"]["name"]; ?></option>
    <?php } ?>
  </select>
</form>
<table class="table table-bordered">
				        <thead>
				          <tr>
				            <th>Номер заказа</th>
				            <th>Название товара</th>
				            <th>Время заказа</th>
				            <th>Количество</th>
				            <th>Статус</th>
				           <?php if( $site_variables["session_var_zakaz_view"] == 1){ ?><th>Просмотр</th><?php } ?>

				          </tr>
				        </thead>       
                                    <tbody>       
				          
                                         <?php if( count($site_variables["zakazy_products"])>0 ){ ?>
                                          <?php if(count($site_variables["zakazy_products"]) > 0){ ?>
 <?php   foreach($site_variables["zakazy_products"] as $zakazy_products_item){ ?>
<tr>
  <td><?php if( $site_variables["session_var_zakaz_view"] == 1){ ?><a href="<?php echo $zakazy_products_item["actions_list"]["order_view"]; ?>"><?php echo $zakazy_products_item["orders_nomer"]; ?></a><?php }else{ ?><?php echo $zakazy_products_item["orders_nomer"]; ?><?php } ?></td>
  <td><?php echo $zakazy_products_item["products_name"]; ?></td>
  <td><?php echo $zakazy_products_item["orders_order_date"]; ?></td>
  <td><?php echo $zakazy_products_item["order_products_kolichestvo"]; ?></td>
  <td><?php echo $zakazy_products_item["order_products_category_status"]; ?></td>
  <?php if( $site_variables["session_var_zakaz_view"] == 1){ ?><td><a href="<?php echo $zakazy_products_item["actions_list"]["order_view"]; ?>">Просмотр</a></td><?php } ?>
</tr> <?php   } ?>
 <?php } ?>

                                         <?php } ?>
				        </tbody>
				      </table>
 <?php if( $site_variables["zakazy_products_navigation"] == 1 ){ ?>  
 <div class="pagination">  
  <ul>  
   <?php if( $site_variables["zakazy_products_num1"] > 1){ ?><li <?php if( $site_variables["zakazy_products_page_num"] == 1){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["zakazy_products_prev_url"]; ?>" class="ext_disabled"> < </a></li><?php } ?>  
   <?php if( $site_variables["zakazy_products_num1"] > 0){ ?><li <?php if( $site_variables["zakazy_products_page_num"] == $site_variables["zakazy_products_num1"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["zakazy_products_num_1_url"]; ?>" class="ext_disabled"><?php echo $site_variables["zakazy_products_num1"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["zakazy_products_num2"] > 0){ ?><li <?php if( $site_variables["zakazy_products_page_num"] == $site_variables["zakazy_products_num2"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["zakazy_products_num_2_url"]; ?>" class="ext_disabled"><?php echo $site_variables["zakazy_products_num2"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["zakazy_products_num3"] > 0){ ?><li <?php if( $site_variables["zakazy_products_page_num"] == $site_variables["zakazy_products_num3"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["zakazy_products_num_3_url"]; ?>" class="ext_disabled"><?php echo $site_variables["zakazy_products_num3"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["zakazy_products_last_num"] > 3){ ?><li class="disabled"><a href="#" class="ext_disabled">...</a></li><?php } ?> 
   <?php if( $site_variables["zakazy_products_last_num"] != $site_variables["zakazy_products_num3"]){ ?><li <?php if( $site_variables["zakazy_products_page_num"] == $site_variables["zakazy_products_last_num"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["zakazy_products_last_url"]; ?>" class="ext_disabled"><?php echo $site_variables["zakazy_products_last_num"]; ?></a></li><?php } ?> 
   <?php if( $site_variables["zakazy_products_page_num"] < $site_variables["zakazy_products_last_num"]){ ?><li><a href="<?php echo $site_variables["zakazy_products_next_url"]; ?>" class="ext_disabled"> > </a></li><?php } ?>  
  </ul> 
 </div>  
 <?php } ?>  


<script type="text/javascript">
  $("#categories_1").change(function(){
    var category_id = $(this).val();
   $("#categories_all").val(category_id);
    $("#categories_all").trigger("change");

   $("#categories_2").val("");
 $("#categories_3").val("");
 $("#categories_4").val("");

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
  $("#categories_all").val(category_id);

    $("#categories_all").trigger("change");
    $("#categories_3").val("");
    $("#categories_4").val("");
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
    $("#categories_all").val(category_id);
    $("#categories_all").trigger("change");
    $("#categories_4").val("");
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
</script>

