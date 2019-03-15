<form id='block-orders_statuses_update' method='post' enctype='multipart/form-data' />
  <div class='form_item '>
   <label for='orders_statuses_order_num'>Порядковый номер</label>
   <input class='form-control' type='text'  id='id_orders_statuses_order_num' name='orders_statuses_order_num' value='<?php  echo $site_variables["orders_statuses_update_data"]["order_num"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='orders_statuses_name'>Название</label>
   <input class='form-control' type='text'  id='id_orders_statuses_name' name='orders_statuses_name' value='<?php  echo $site_variables["orders_statuses_update_data"]["name"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='orders_statuses_set_default'>По умолчанию</label>
   <select name='orders_statuses_set_default' class='form-control'>
 <?php foreach($site_variables["select_orders_statuses_update_orders_statuses_set_default"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["orders_statuses_update_data"]["set_default"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>
  <div class='form_item '>
   <label for='orders_statuses_spisanie'>Списание товаров</label>
   <select name='orders_statuses_spisanie' class='form-control'>
 <?php foreach($site_variables["select_orders_statuses_update_orders_statuses_spisanie"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["orders_statuses_update_data"]["spisanie"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>
  <div class='form_item '>
   <label for='orders_statuses_color'>Цвет</label>
   <input class='form-control' type='text'  id='id_orders_statuses_color' name='orders_statuses_color' value='<?php  echo $site_variables["orders_statuses_update_data"]["color"]; ?>' />
  </div>
 <input type="hidden" name="do" value="orders_statuses_update">
 <input type="submit" value="Сохранить изменения">
 <input name="cmd" type="submit" value="Отмена">
</form>

