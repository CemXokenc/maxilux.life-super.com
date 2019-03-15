<form id='block-spravochnik_valut_create' method='post' enctype='multipart/form-data' />
  <div class='form_item '>
   <label for='currencies_name'>Название</label>
   <input class='form-control' type='text'  id='id_currencies_name' name='currencies_name' value='<?php  echo $site_variables["spravochnik_valut_create_data"]["name"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='currencies_kod_valuty'>код</label>
   <input class='form-control' type='text'  id='id_currencies_kod_valuty' name='currencies_kod_valuty' value='<?php  echo $site_variables["spravochnik_valut_create_data"]["kod_valuty"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='currencies_rate'>коэфициент</label>
   <input class='form-control' type='text'  id='id_currencies_rate' name='currencies_rate' value='<?php  echo $site_variables["spravochnik_valut_create_data"]["rate"]; ?>' />
  </div>
 <input type="hidden" name="do" value="spravochnik_valut_create">
 <input type="submit" value="Сохранить изменения">
 <input name="cmd" type="submit" value="Отмена">
</form>

