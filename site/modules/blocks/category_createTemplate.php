<div id="izd_category"><h3>Статусы категорий</h3><?php echo $site_variables["status_table"]; ?></div>
<div class="row">
   <div class="col-sm-2" style="width: 340px;">
      Название: <input class="form-control" type="text" id="izd_category_name" value=""></span>
    </div>

</div>
<button type="button" id="add_name_category" class="btn btn-large">Добавить</button><br><br>
<form id='block-category_create' method='post' enctype='multipart/form-data' />
  <div class='form_item '>
   <label for='categories_name'>Название</label>
   <input class='form-control' type='text'  id='id_categories_name' name='categories_name' value='<?php  echo $site_variables["category_create_data"]["name"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='categories_img'>Изображение</label>
   <input type='file' id='id_categories_img' name='categories_img' />
  </div>
  <div class='form_item '>
   <label for='categories_num'>Сортировка</label>
   <input class='form-control' type='text'  id='id_categories_num' name='categories_num' value='<?php  echo $site_variables["category_create_data"]["num"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='categories_sred_zakaz'>Средний заказ</label>
   <input class='form-control' type='text'  id='id_categories_sred_zakaz' name='categories_sred_zakaz' value='<?php  echo $site_variables["category_create_data"]["sred_zakaz"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='categories_max_zakaz'>Максимальный заказ</label>
   <input class='form-control' type='text'  id='id_categories_max_zakaz' name='categories_max_zakaz' value='<?php  echo $site_variables["category_create_data"]["max_zakaz"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='categories_min_zakaz'>Минимальный заказ</label>
   <input class='form-control' type='text'  id='id_categories_min_zakaz' name='categories_min_zakaz' value='<?php  echo $site_variables["category_create_data"]["min_zakaz"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='categories_parent_id'>Родительская категория</label>
   <select name='categories_parent_id' class='form-control'>
 <?php foreach($site_variables["select_category_create_categories_parent_id"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["category_create_data"]["parent_id"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>
  <div class='form_item '>
   <label for='categories_nacenka'>Наценка</label>
   <input class='form-control' type='text'  id='id_categories_nacenka' name='categories_nacenka' value='<?php  echo $site_variables["category_create_data"]["nacenka"]; ?>' />
  </div>
 <input type="hidden" name="do" value="category_create">
 <input type="submit" value="Сохранить изменения">
 <input name="cmd" type="submit" value="Отмена">
</form>

