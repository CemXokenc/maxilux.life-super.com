<form id='block-scheta_update' method='post' enctype='multipart/form-data' />
<div class="fileupload fileupload-new" data-provides="fileupload">
  <div class="fileupload-new thumbnail" style="width: 180px; height: 180px;"><img src="<?php echo $site_variables["template_dir"]; ?>/img/scheta/<?php if( $site_variables["scheta_update_data"]["img"] > 0){ ?><?php echo $site_variables["scheta_update_data"]["id"]; ?><?php }else{ ?>no_img<?php } ?>.jpg"></div>
</div>
  <div class='form_item '>
   <label for='scheta_img'>Изображение</label>
   <input type='file' id='id_scheta_img' name='scheta_img' />
  </div>

  <div class='form_item '>
   <label for='scheta_company_id'>company_id</label>
   <input class='form-control' type='text'  id='id_scheta_company_id' name='scheta_company_id' value='<?php  echo $site_variables["scheta_update_data"]["company_id"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='scheta_amount'>Сумма</label>
   <input class='form-control' type='text'  id='id_scheta_amount' name='scheta_amount' value='<?php  echo $site_variables["scheta_update_data"]["amount"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='scheta_parent_id'>Родительская категория</label>
   <select name='scheta_parent_id' class='form-control'>
 <?php foreach($site_variables["select_scheta_update_scheta_parent_id"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["scheta_update_data"]["parent_id"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='scheta_name'>Название</label>
   <input class='form-control' type='text'  id='id_scheta_name' name='scheta_name' value='<?php  echo $site_variables["scheta_update_data"]["name"]; ?>' />
  </div>


<input type="submit" value="Сохранить изменения"> <input name="cmd" type="submit" value="Отмена"> <input type="hidden" name="do" value="scheta_update">
</form>

