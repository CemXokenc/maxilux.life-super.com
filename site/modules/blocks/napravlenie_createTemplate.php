<form id='block-napravlenie_create' method='post' enctype='multipart/form-data' />
  <div class='form_item '>
   <label for='napravlenie_napravlenie'>Направление</label>
   <input class='form-control' type='text'  id='id_napravlenie_napravlenie' name='napravlenie_napravlenie' value='<?php  echo $site_variables["napravlenie_create_data"]["napravlenie"]; ?>' />
  </div>
 <input type="hidden" name="do" value="napravlenie_create">
 <input type="submit" value="Сохранить изменения">
 <input name="cmd" type="submit" value="Отмена">
</form>

