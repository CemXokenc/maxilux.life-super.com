<form id='block-workers_update' method='post' enctype='multipart/form-data' />
<div class="fileupload fileupload-new" data-provides="fileupload">
  <div class="fileupload-new thumbnail" style="width: 180px; height: 180px;"><img src="<?php echo $site_variables["template_dir"]; ?>/img/worker/<?php if( $site_variables["workers_update_data"]["img"] > 0){ ?><?php echo $site_variables["workers_update_data"]["id"]; ?><?php }else{ ?>no_img<?php } ?>.jpg"></div>
</div>
  <div class='form_item '>id_workers_img
   <label for='workers_img'>Изображение</label>
   <input type='file' id='' name='workers_img' />
  </div>

  <div class='form_item '>
   <label for='workers_fio'>ФИО</label>
   <input class='form-control' type='text'  id='id_workers_fio' name='workers_fio' value='<?php  echo $site_variables["workers_update_data"]["fio"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='workers_email'>email</label>
   <input class='form-control' type='text'  id='id_workers_email' name='workers_email' value='<?php  echo $site_variables["workers_update_data"]["email"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='workers_telephone'>Телефон</label>
   <input class='form-control' type='text'  id='id_workers_telephone' name='workers_telephone' value='<?php  echo $site_variables["workers_update_data"]["telephone"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='workers_telephone1'>Телефон</label>
   <input class='form-control' type='text'  id='id_workers_telephone1' name='workers_telephone1' value='<?php  echo $site_variables["workers_update_data"]["telephone1"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='workers_profession_id'>Должность</label>
   <select name='workers_profession_id' class='form-control'>
 <?php foreach($site_variables["select_workers_update_workers_profession_id"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["workers_update_data"]["profession_id"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='workers_stavka'>Ставка</label>
   <input class='form-control' type='text'  id='id_workers_stavka' name='workers_stavka' value='<?php  echo $site_variables["workers_update_data"]["stavka"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='workers_bonus'>Бонус</label>
   <input class='form-control' type='text'  id='id_workers_bonus' name='workers_bonus' value='<?php  echo $site_variables["workers_update_data"]["bonus"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='workers_vchas'>В час</label>
   <input class='form-control' type='text'  id='id_workers_vchas' name='workers_vchas' value='<?php  echo $site_variables["workers_update_data"]["vchas"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='workers_sdelnaya'>Сдельная(%)</label>
   <input class='form-control' type='text'  id='id_workers_sdelnaya' name='workers_sdelnaya' value='<?php  echo $site_variables["workers_update_data"]["sdelnaya"]; ?>' />
  </div>

<input type="submit" value="Сохранить изменения"> <input name="cmd" type="submit" value="Отмена"> <input type="hidden" name="do" value="workers_update">
</form>

