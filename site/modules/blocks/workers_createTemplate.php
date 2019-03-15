<form id='block-workers_create' method='post' enctype='multipart/form-data' />
  <div class='form_item '>
   <label for='workers_img'>img</label>
   <input type='file' id='id_workers_img' name='workers_img' />
  </div>
  <div class='form_item '>
   <label for='workers_fio'>ФИО</label>
   <input class='form-control' type='text'  id='id_workers_fio' name='workers_fio' value='<?php  echo $site_variables["workers_create_data"]["fio"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='workers_email'>email</label>
   <input class='form-control' type='text'  id='id_workers_email' name='workers_email' value='<?php  echo $site_variables["workers_create_data"]["email"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='workers_telephone'>Телефон</label>
   <input class='form-control' type='text'  id='id_workers_telephone' name='workers_telephone' value='<?php  echo $site_variables["workers_create_data"]["telephone"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='workers_telephone1'>Телефон-2</label>
   <input class='form-control' type='text'  id='id_workers_telephone1' name='workers_telephone1' value='<?php  echo $site_variables["workers_create_data"]["telephone1"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='workers_profession_id'>Профессия</label>
   <select name='workers_profession_id' class='form-control'>
 <?php foreach($site_variables["select_workers_create_workers_profession_id"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["workers_create_data"]["profession_id"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>
 <input type="hidden" name="do" value="workers_create">
 <input type="submit" value="Сохранить изменения">
 <input name="cmd" type="submit" value="Отмена">
</form>

