<?php if( $site_variables["system_messages"] != "" ){ ?>
<div class="alert alert-success">
  <a class="close" data-dismiss="alert" href="#" aria-hidden="true">x</a>
  <?php echo $site_variables["system_messages"]; ?>
</div>
<?php } ?>
<form action="" method="post">
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
          <select name="order_by_column">
            <option value="">Сортировать по</option>
            <option value="categories_name">Название</option>
          </select>
          <select name="order_as">
            <option value="asc">Возрастание</option>
            <option value="desc">Убывание</option>
          </select>
        </div>
        <div class="col-sm-2" style="width: 340px;">

        </div>
      </div>

      <button type="submit" name="cmd" class="btn btn-default">Фильтровать</button>
    </div>
  </div>

  <select id="categories_all" name="categories" style="display:none;">
    <option value="0" selected>Не выбрано</option>
    <?php foreach($site_variables["categories_main_all"] as $site_variables["item"]){ ?>
    <option <?php if( $site_variables["item"]["selected"] == 1 ){ ?>selected<?php } ?> value="<?php echo $site_variables["item"]["id"]; ?>"><?php echo $site_variables["item"]["name"]; ?></option>
    <?php } ?>
  </select>
</form>



<table class="table table-bordered">
  <thead>
  <tr>
    <th>Наименование</th>
    <th>Наценка</th>
    <th>Минимальный заказ</th>
    <th>Средний заказ заказ</th>
    <th>Максимальный заказ</th>
    <th>Сумма Заказов</th>
    <?php if( $site_variables["session_var_categories_delete"] == 1 || $site_variables["session_var_categories_update"] == 1){ ?><th style="width:23px;"> </th><?php } ?>
  </tr>
  </thead>
  <tbody>

  <?php if( count($site_variables["categories"])>0 ){ ?>
   <?php if(count($site_variables["categories"]) > 0){ ?>
 <?php   foreach($site_variables["categories"] as $categories_item){ ?>
<tr>
  <td><?php echo $categories_item["categories_name"]; ?></td>
  <td><?php echo $categories_item["categories_nacenka"]; ?></td>
  <td><?php echo $categories_item["categories_min_zakaz"]; ?></td>
  <td><?php echo $categories_item["categories_sred_zakaz"]; ?></td>
  <td><?php echo $categories_item["categories_max_zakaz"]; ?></td>
  <td><?php echo $categories_item["categories_sum_zakazov"]; ?></td>
  <?php if( $site_variables["session_var_categories_delete"] == 1 || $site_variables["session_var_categories_update"] == 1){ ?>
  <td>
    <div class="btn-group display-inline pull-right text-align-left hidden-tablet">
      <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" style="padding: 1px 3px;">
        <i class="fa fa-cog fa-lg"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-xs pull-right">
        <?php if( $site_variables["session_var_categories_update"] == 1){ ?>
        <li>
          <a href="<?php echo $categories_item["actions_list"]["category_edit"]; ?>"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> Редактировать</a>
        </li>
        <?php } ?>
        <?php if( $site_variables["session_var_category_upload_csv"] == 1){ ?>
        <li>
          <a href="<?php echo $categories_item["actions_list"]["category_upload"]; ?>"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> Загрузить CSV</a>
        </li>
        <?php } ?>
        <?php if( $site_variables["session_var_categories_delete"] == 1){ ?>
        <li>
          <a onclick="return confirm('Вы уверены что хотите удалить категорию <?php echo $categories_item["categories_name"]; ?>?');" href="<?php echo $categories_item["actions_list"]["category_delete"]; ?>"><i class="fa fa-times fa-lg fa-fw txt-color-red"></i> Удалить</a>
        </li>
        <?php } ?>
      </ul>
    </div>
  </td>
  <?php } ?>
</tr> <?php   } ?>
 <?php } ?>

  <?php } ?>
  </tbody>
</table>
 <?php if( $site_variables["categories_navigation"] == 1 ){ ?>  
 <div class="pagination">  
  <ul>  
   <?php if( $site_variables["categories_num1"] > 1){ ?><li <?php if( $site_variables["categories_page_num"] == 1){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["categories_prev_url"]; ?>" class="ext_disabled"> < </a></li><?php } ?>  
   <?php if( $site_variables["categories_num1"] > 0){ ?><li <?php if( $site_variables["categories_page_num"] == $site_variables["categories_num1"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["categories_num_1_url"]; ?>" class="ext_disabled"><?php echo $site_variables["categories_num1"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["categories_num2"] > 0){ ?><li <?php if( $site_variables["categories_page_num"] == $site_variables["categories_num2"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["categories_num_2_url"]; ?>" class="ext_disabled"><?php echo $site_variables["categories_num2"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["categories_num3"] > 0){ ?><li <?php if( $site_variables["categories_page_num"] == $site_variables["categories_num3"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["categories_num_3_url"]; ?>" class="ext_disabled"><?php echo $site_variables["categories_num3"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["categories_last_num"] > 3){ ?><li class="disabled"><a href="#" class="ext_disabled">...</a></li><?php } ?> 
   <?php if( $site_variables["categories_last_num"] != $site_variables["categories_num3"]){ ?><li <?php if( $site_variables["categories_page_num"] == $site_variables["categories_last_num"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["categories_last_url"]; ?>" class="ext_disabled"><?php echo $site_variables["categories_last_num"]; ?></a></li><?php } ?> 
   <?php if( $site_variables["categories_page_num"] < $site_variables["categories_last_num"]){ ?><li><a href="<?php echo $site_variables["categories_next_url"]; ?>" class="ext_disabled"> > </a></li><?php } ?>  
  </ul> 
 </div>  
 <?php } ?>  



<?php if( $site_variables["categories_create_link"] != "" && $site_variables["session_var_categories_create"] == 1){ ?>
<form action="<?php echo $site_variables["categories_create_link"]; ?>" method="post">
  <button type="submit" class="btn btn-large btn-primary">Создать новую категорию</button>
</form>
<?php } ?>

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
</script>

