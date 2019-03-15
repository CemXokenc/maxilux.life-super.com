<form id='block-rashody_update' method='post' enctype='multipart/form-data' />
<div class="fileupload fileupload-new" data-provides="fileupload">
  <div class="fileupload-new thumbnail" style="width: 180px; height: 180px;"><img src="<?php echo $site_variables["template_dir"]; ?>/img/dohody_rashody/<?php if( $site_variables["rashody_update_data"]["img"] > 0){ ?><?php echo $site_variables["rashody_update_data"]["id"]; ?><?php }else{ ?>no_img<?php } ?>.jpg"></div>
</div>
  <div class='form_item '>
   <label for='dohody_rashody_img'>Изображения</label>
   <input type='file' id='id_dohody_rashody_img' name='dohody_rashody_img' />
  </div>

  <div class='form_item '>
   <label for='dohody_rashody_name'>Название</label>
   <input class='form-control' type='text'  id='id_dohody_rashody_name' name='dohody_rashody_name' value='<?php  echo $site_variables["rashody_update_data"]["name"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='dohody_rashody_parent_id'>Родительская категория</label>
   <select name='dohody_rashody_parent_id' class='form-control'>
 <?php foreach($site_variables["select_rashody_update_dohody_rashody_parent_id"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["rashody_update_data"]["parent_id"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>


<input type="submit" value="Сохранить изменения"> <input name="cmd" type="submit" value="Отмена"> <input type="hidden" name="do" value="rashody_update">
</form>

