<form id='block-dohody_create' method='post' enctype='multipart/form-data' />
  <div class='form_item '>
   <label for='dohody_rashody_img'>Изображение</label>
   <input type='file' id='id_dohody_rashody_img' name='dohody_rashody_img' />
  </div>
  <div class='form_item '>
   <label for='dohody_rashody_name'>Название</label>
   <input class='form-control' type='text'  id='id_dohody_rashody_name' name='dohody_rashody_name' value='<?php  echo $site_variables["dohody_create_data"]["name"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='dohody_rashody_parent_id'>Родительский доход</label>
   <select name='dohody_rashody_parent_id' class='form-control'>
 <?php foreach($site_variables["select_dohody_create_dohody_rashody_parent_id"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["dohody_create_data"]["parent_id"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>
 <input type="hidden" name="do" value="dohody_create">
 <input type="submit" value="Сохранить изменения">
 <input name="cmd" type="submit" value="Отмена">
</form>

