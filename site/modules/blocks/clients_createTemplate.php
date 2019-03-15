<form id='block-clients_create' method='post' enctype='multipart/form-data' />
  <div class='form_item '>
   <label for='clients_fio'>ФИО</label>
   <input class='form-control' type='text'  id='id_clients_fio' name='clients_fio' value='<?php  echo $site_variables["clients_create_data"]["fio"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='clients_email'>Емеил</label>
   <input class='form-control' type='text'  id='id_clients_email' name='clients_email' value='<?php  echo $site_variables["clients_create_data"]["email"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='clients_telephone'>Телефон</label>
   <input class='form-control' type='text'  id='id_clients_telephone' name='clients_telephone' value='<?php  echo $site_variables["clients_create_data"]["telephone"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='clients_telephone1'>Телефон1</label>
   <input class='form-control' type='text'  id='id_clients_telephone1' name='clients_telephone1' value='<?php  echo $site_variables["clients_create_data"]["telephone1"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='clients_telephone2'>Телефон2</label>
   <input class='form-control' type='text'  id='id_clients_telephone2' name='clients_telephone2' value='<?php  echo $site_variables["clients_create_data"]["telephone2"]; ?>' />
  </div>
  <div class='form_item  item-id-clients-torgovaya_tochka_id'>
   <label for='clients_torgovaya_tochka_id'>Торговая точка</label>
   <select name='clients_torgovaya_tochka_id' class='form-control'>
 <?php foreach($site_variables["select_clients_create_clients_torgovaya_tochka_id"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["clients_create_data"]["torgovaya_tochka_id"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>
  <div class='form_item '>
   <label for='clients_skidka_id'>Скидка</label>
   <select name='clients_skidka_id' class='form-control'>
 <?php foreach($site_variables["select_clients_create_clients_skidka_id"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["clients_create_data"]["skidka_id"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>
  <div class='form_item '>
   <label for='clients_img'>Изображение</label>
   <input type='file' id='id_clients_img' name='clients_img' />
  </div>
 <input type="hidden" name="do" value="clients_create">
 <input type="submit" value="Сохранить изменения">
 <input name="cmd" type="submit" value="Отмена">
</form>
<?php if( $site_variables["session_var_user_type"] == 12){ ?>
<script type="text/javascript">
$(".item-id-clients-torgovaya_tochka_id").hide(); 
$(".item-id-clients-torgovaya_tochka_id").children('select').html('<option selected value="<?php echo $site_variables["session_var_torgovaya_tockka"]; ?>"></select>'); 
</script> 
<?php } ?>

