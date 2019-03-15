<form id='block-sklads_update' method='post' enctype='multipart/form-data' />
  <div class='form_item '>
   <label for='sklads_id'>id</label>
   <input class='form-control' type='text'  id='id_sklads_id' name='sklads_id' value='<?php  echo $site_variables["sklads_update_data"]["id"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='sklads_name'>Название</label>
   <input class='form-control' type='text'  id='id_sklads_name' name='sklads_name' value='<?php  echo $site_variables["sklads_update_data"]["name"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='sklads_adress'>Адрес</label>
   <input class='form-control' type='text'  id='id_sklads_adress' name='sklads_adress' value='<?php  echo $site_variables["sklads_update_data"]["adress"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='sklads_parent_id'>Родительский склад</label>
   <select name='sklads_parent_id' class='form-control'>
 <?php foreach($site_variables["select_sklads_update_sklads_parent_id"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["sklads_update_data"]["parent_id"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>
  <div class='form_item '>
   <label for='sklads_description'>Описание</label>
   <textarea class='form-control'  id='id_sklads_description' name='sklads_description'><?php  echo $site_variables["sklads_update_data"]["description"]; ?></textarea>
  </div>
 <input type="hidden" name="do" value="sklads_update">
 <input type="submit" value="Сохранить изменения">
 <input name="cmd" type="submit" value="Отмена">
</form>

