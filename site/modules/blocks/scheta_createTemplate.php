<form id='block-scheta_create' method='post' enctype='multipart/form-data' />
  <div class='form_item '>
   <label for='scheta_name'>Название</label>
   <input class='form-control' type='text'  id='id_scheta_name' name='scheta_name' value='<?php  echo $site_variables["scheta_create_data"]["name"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='scheta_amount'>Сумма</label>
   <input class='form-control' type='text'  id='id_scheta_amount' name='scheta_amount' value='<?php  echo $site_variables["scheta_create_data"]["amount"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='scheta_parent_id'>Родительский счёт</label>
   <select name='scheta_parent_id' class='form-control'>
 <?php foreach($site_variables["select_scheta_create_scheta_parent_id"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["scheta_create_data"]["parent_id"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>
  <div class='form_item '>
   <label for='scheta_img'>Изображение</label>
   <input type='file' id='id_scheta_img' name='scheta_img' />
  </div>
 <input type="hidden" name="do" value="scheta_create">
 <input type="submit" value="Сохранить изменения">
 <input name="cmd" type="submit" value="Отмена">
</form>

