<form id='block-professions_create' method='post' enctype='multipart/form-data' />
  <div class='form_item '>
   <label for='professions_name'>Название</label>
   <input class='form-control' type='text'  id='id_professions_name' name='professions_name' value='<?php  echo $site_variables["professions_create_data"]["name"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='professions_sdelnaya'>Сдельная(%)</label>
   <input class='form-control' type='text'  id='id_professions_sdelnaya' name='professions_sdelnaya' value='<?php  echo $site_variables["professions_create_data"]["sdelnaya"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='professions_stavka'>Ставка</label>
   <input class='form-control' type='text'  id='id_professions_stavka' name='professions_stavka' value='<?php  echo $site_variables["professions_create_data"]["stavka"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='professions_bonus'>Бонус</label>
   <input class='form-control' type='text'  id='id_professions_bonus' name='professions_bonus' value='<?php  echo $site_variables["professions_create_data"]["bonus"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='professions_vchas'>В час</label>
   <input class='form-control' type='text'  id='id_professions_vchas' name='professions_vchas' value='<?php  echo $site_variables["professions_create_data"]["vchas"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='professions_opisanie'>Описание</label>
   <textarea class='form-control'  id='id_professions_opisanie' name='professions_opisanie'><?php  echo $site_variables["professions_create_data"]["opisanie"]; ?></textarea>
  </div>
 <input type="hidden" name="do" value="professions_create">
 <input type="submit" value="Сохранить изменения">
 <input name="cmd" type="submit" value="Отмена">
</form>

