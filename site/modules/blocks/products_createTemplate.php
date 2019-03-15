<form id='block-products_create' method='post' enctype='multipart/form-data' />
  <div class='form_item '>
   <label for='products_name'>Название</label>
   <input class='form-control' type='text'  id='id_products_name' name='products_name' value='<?php  echo $site_variables["products_create_data"]["name"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='products_category_id'>Категория</label>
   <select name='products_category_id' class='form-control'>
 <?php foreach($site_variables["select_products_create_products_category_id"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["products_create_data"]["category_id"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>
  <div class='form_item '>
   <label for='products_valuta'>valuta</label>
   <select name='products_valuta' class='form-control'>
 <?php foreach($site_variables["select_products_create_products_valuta"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["products_create_data"]["valuta"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>
  <div class='form_item '>
   <label for='products_currency'>currency</label>
   <select name='products_currency' class='form-control'>
 <?php foreach($site_variables["select_products_create_products_currency"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["products_create_data"]["currency"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>
  <div class='form_item '>
   <label for='products_price'>Цена</label>
   <input class='form-control' type='text'  id='id_products_price' name='products_price' value='<?php  echo $site_variables["products_create_data"]["price"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='products_cnt'>Количество</label>
   <input class='form-control' type='text'  id='id_products_cnt' name='products_cnt' value='<?php  echo $site_variables["products_create_data"]["cnt"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='products_ves'>Вес</label>
   <input class='form-control' type='text'  id='id_products_ves' name='products_ves' value='<?php  echo $site_variables["products_create_data"]["ves"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='products_shirina'>Ширина</label>
   <input class='form-control' type='text'  id='id_products_shirina' name='products_shirina' value='<?php  echo $site_variables["products_create_data"]["shirina"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='products_vysota'>Высота</label>
   <input class='form-control' type='text'  id='id_products_vysota' name='products_vysota' value='<?php  echo $site_variables["products_create_data"]["vysota"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='products_glubina'>Глубина</label>
   <input class='form-control' type='text'  id='id_products_glubina' name='products_glubina' value='<?php  echo $site_variables["products_create_data"]["glubina"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='products_izmerenie'>Измерение</label>
   <select name='products_izmerenie' class='form-control'>
 <?php foreach($site_variables["select_products_create_products_izmerenie"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["products_create_data"]["izmerenie"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>
  <div class='form_item '>
   <label for='products_description'>Описание</label>
   <textarea class='form-control'  id='id_products_description' name='products_description'><?php  echo $site_variables["products_create_data"]["description"]; ?></textarea>
  </div>
  <div class='form_item '>
   <label for='products_avatar'>Картинка</label>
   <input type='file' id='id_products_avatar' name='products_avatar' />
  </div>
  <div class='form_item '>
   <label for='products_min_zapas'>мин. запас</label>
   <input class='form-control' type='text'  id='id_products_min_zapas' name='products_min_zapas' value='<?php  echo $site_variables["products_create_data"]["min_zapas"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='products_sred_zapas'>ср. запас</label>
   <input class='form-control' type='text'  id='id_products_sred_zapas' name='products_sred_zapas' value='<?php  echo $site_variables["products_create_data"]["sred_zapas"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='products_max_zapas'>Макс. запас</label>
   <input class='form-control' type='text'  id='id_products_max_zapas' name='products_max_zapas' value='<?php  echo $site_variables["products_create_data"]["max_zapas"]; ?>' />
  </div>
 <input type="hidden" name="do" value="products_create">
 <input type="submit" value="Сохранить изменения">
 <input name="cmd" type="submit" value="Отмена">
</form>
 <script type="text/javascript" src="<?php echo $site_variables["template_dir"]; ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  window.onload = function() {
  CKEDITOR.replace('id_products_description');
};
</script>

