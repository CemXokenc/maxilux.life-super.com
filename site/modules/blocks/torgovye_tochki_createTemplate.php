<form id='block-torgovye_tochki_create' method='post' enctype='multipart/form-data' />
  <div class='form_item '>
   <label for='torgovye_tochki_img'>Изображение</label>
   <input type='file' id='id_torgovye_tochki_img' name='torgovye_tochki_img' />
  </div>
  <div class='form_item  item-id-torgovye_tochki-name'>
   <label for='torgovye_tochki_name'>Название торговой точки</label>
   <input class='form-control' type='text'  id='id_torgovye_tochki_name' name='torgovye_tochki_name' value='<?php  echo $site_variables["torgovye_tochki_create_data"]["name"]; ?>' />
  </div>
  <div class='form_item  item-id-torgovye_tochki-telephone'>
   <label for='torgovye_tochki_telephone'>Телефон</label>
   <input class='form-control' type='text'  id='id_torgovye_tochki_telephone' name='torgovye_tochki_telephone' value='<?php  echo $site_variables["torgovye_tochki_create_data"]["telephone"]; ?>' />
  </div>
  <div class='form_item  item-id-torgovye_tochki-email'>
   <label for='torgovye_tochki_email'>Емеил</label>
   <input class='form-control' type='text'  id='id_torgovye_tochki_email' name='torgovye_tochki_email' value='<?php  echo $site_variables["torgovye_tochki_create_data"]["email"]; ?>' />
  </div>
  <div class='form_item  item-id-torgovye_tochki-city'>
   <label for='torgovye_tochki_city'>Город</label>
   <input class='form-control' type='text'  id='id_torgovye_tochki_city' name='torgovye_tochki_city' value='<?php  echo $site_variables["torgovye_tochki_create_data"]["city"]; ?>' />
  </div>
  <div class='form_item  item-id-torgovye_tochki-zip_code'>
   <label for='torgovye_tochki_zip_code'>Почтовый индекс</label>
   <input class='form-control' type='text'  id='id_torgovye_tochki_zip_code' name='torgovye_tochki_zip_code' value='<?php  echo $site_variables["torgovye_tochki_create_data"]["zip_code"]; ?>' />
  </div>
  <div class='form_item  item-id-torgovye_tochki-street'>
   <label for='torgovye_tochki_street'>Улица</label>
   <input class='form-control' type='text'  id='id_torgovye_tochki_street' name='torgovye_tochki_street' value='<?php  echo $site_variables["torgovye_tochki_create_data"]["street"]; ?>' />
  </div>
  <div class='form_item  item-id-torgovye_tochki-house'>
   <label for='torgovye_tochki_house'>Дом</label>
   <input class='form-control' type='text'  id='id_torgovye_tochki_house' name='torgovye_tochki_house' value='<?php  echo $site_variables["torgovye_tochki_create_data"]["house"]; ?>' />
  </div>
  <div class='form_item  item-id-torgovye_tochki-office'>
   <label for='torgovye_tochki_office'>Офис</label>
   <input class='form-control' type='text'  id='id_torgovye_tochki_office' name='torgovye_tochki_office' value='<?php  echo $site_variables["torgovye_tochki_create_data"]["office"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='torgovye_tochki_napravlenie_id'>Направление</label>
   <select name='torgovye_tochki_napravlenie_id' class='form-control'>
 <?php foreach($site_variables["select_torgovye_tochki_create_torgovye_tochki_napravlenie_id"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["torgovye_tochki_create_data"]["napravlenie_id"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>
  <div class='form_item '>
   <label for='torgovye_tochki_skidka_id'>Скидка</label>
   <select name='torgovye_tochki_skidka_id' class='form-control'>
 <?php foreach($site_variables["select_torgovye_tochki_create_torgovye_tochki_skidka_id"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["torgovye_tochki_create_data"]["skidka_id"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>
 <input type="hidden" name="do" value="torgovye_tochki_create">
 <input type="submit" value="Сохранить изменения">
 <input name="cmd" type="submit" value="Отмена">
</form>

