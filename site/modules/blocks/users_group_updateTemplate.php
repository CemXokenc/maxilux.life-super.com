<form id='block-users_group_update' method='post' enctype='multipart/form-data' />
  <div class='form_item  item-id-users_group-name'>
   <label for='users_group_name'>Имя</label>
   <input class='form-control' type='text'  id='id_users_group_name' name='users_group_name' value='<?php  echo $site_variables["users_group_update_data"]["name"]; ?>' />
  </div>
<div class="clear"></div>
<div id="select_type">
  <div class='form_item  item-id-users_group-type'>
   <label for='users_group_type'>Тип</label>
   <select name='users_group_type' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_type"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["type"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>
<div class="clear"></div>

<div id="users">
<h4>Пользователи</h4>
  <div class='form_item '>
   <label for='users_group_users_create'>Создание</label>
   <select name='users_group_users_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_users_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["users_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_users_update'>Редактирование</label>
   <select name='users_group_users_update' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_users_update"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["users_update"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_users_delete'>Удаление</label>
   <select name='users_group_users_delete' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_users_delete"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["users_delete"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_users_list'>Просмотр списка</label>
   <select name='users_group_users_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_users_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["users_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_user_view'>Просмотр</label>
   <select name='users_group_user_view' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_user_view"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["user_view"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>
<div class="clear"></div>
<div id="torg_tochki1">
<h4>Торговые точки</h4>
</div>
<div id="torg_tochki2">
  <div class='form_item '>
   <label for='users_group_torgovaya_create'>Создание</label>
   <select name='users_group_torgovaya_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_torgovaya_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["torgovaya_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>
<div id="torg_tochki3">
  <div class='form_item '>
   <label for='users_group_torgovaya_update'>Редактирование</label>
   <select name='users_group_torgovaya_update' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_torgovaya_update"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["torgovaya_update"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>
<div id="torg_tochki4">
  <div class='form_item '>
   <label for='users_group_torgovaya_delete'>Удаление</label>
   <select name='users_group_torgovaya_delete' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_torgovaya_delete"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["torgovaya_delete"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_torgovaya_list'>Просмотр списка</label>
   <select name='users_group_torgovaya_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_torgovaya_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["torgovaya_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_torgovaya_view'>Просмотр</label>
   <select name='users_group_torgovaya_view' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_torgovaya_view"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["torgovaya_view"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="type_users">
<h4>Склад</h4>
  <div class='form_item '>
   <label for='users_group_sklads_list'>Просмотр списка</label>
   <select name='users_group_sklads_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_sklads_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["sklads_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_sklads_create'>Создание</label>
   <select name='users_group_sklads_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_sklads_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["sklads_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_sklads_update'>Редактирование</label>
   <select name='users_group_sklads_update' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_sklads_update"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["sklads_update"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_sklads_delete'>Удаление</label>
   <select name='users_group_sklads_delete' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_sklads_delete"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["sklads_delete"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="type_users">
<h4>Управление складом</h4>
  <div class='form_item '>
   <label for='users_group_sklads_copy'>Копирование</label>
   <select name='users_group_sklads_copy' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_sklads_copy"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["sklads_copy"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_sklads_add_many_tovars'>Добавить много товаров</label>
   <select name='users_group_sklads_add_many_tovars' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_sklads_add_many_tovars"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["sklads_add_many_tovars"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_sklads_peremestit_tovar'>Перемещение товара</label>
   <select name='users_group_sklads_peremestit_tovar' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_sklads_peremestit_tovar"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["sklads_peremestit_tovar"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_sklads_add_izdelie'>Добавить изделие</label>
   <select name='users_group_sklads_add_izdelie' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_sklads_add_izdelie"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["sklads_add_izdelie"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="type_users">
<h4>Направления</h4>
  <div class='form_item '>
   <label for='users_group_napravlenie_create'>Создание</label>
   <select name='users_group_napravlenie_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_napravlenie_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["napravlenie_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_napravlenie_update'>Редактирование</label>
   <select name='users_group_napravlenie_update' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_napravlenie_update"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["napravlenie_update"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_napravlenie_delete'>Удаление</label>
   <select name='users_group_napravlenie_delete' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_napravlenie_delete"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["napravlenie_delete"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_napravlenie_list'>Просмотр списка</label>
   <select name='users_group_napravlenie_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_napravlenie_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["napravlenie_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="type_users">
<h4>Скидки</h4>
  <div class='form_item '>
   <label for='users_group_skidki_view'>Просмотр</label>
   <select name='users_group_skidki_view' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_skidki_view"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["skidki_view"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_skidki_update'>Редактирование</label>
   <select name='users_group_skidki_update' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_skidki_update"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["skidki_update"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="type_users">
<h4>Товары</h4>
  <div class='form_item '>
   <label for='users_group_products_create'>Создание</label>
   <select name='users_group_products_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_products_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["products_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_products_update'>Редактирование</label>
   <select name='users_group_products_update' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_products_update"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["products_update"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_products_delete'>Удаление</label>
   <select name='users_group_products_delete' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_products_delete"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["products_delete"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_products_list'>Просмотр списка</label>
   <select name='users_group_products_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_products_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["products_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="type_users">
<h4>Закупочная цена</h4>
  <div class='form_item '>
   <label for='users_group_zak_price'>Просмотр</label>
   <select name='users_group_zak_price' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_zak_price"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["zak_price"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="type_users">
<h4>Заказы</h4>
  <div class='form_item '>
   <label for='users_group_zakaz_create'>Создание</label>
   <select name='users_group_zakaz_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_zakaz_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["zakaz_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_zakaz_update'>Редактирование</label>
   <select name='users_group_zakaz_update' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_zakaz_update"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["zakaz_update"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_zakaz_list'>Просмотр списка</label>
   <select name='users_group_zakaz_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_zakaz_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["zakaz_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_zakaz_view'>Просмотр</label>
   <select name='users_group_zakaz_view' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_zakaz_view"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["zakaz_view"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_zakazy_products_list'>Просмотр списка</label>
   <select name='users_group_zakazy_products_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_zakazy_products_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["zakazy_products_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="type_users">
<h4>Заявки</h4>
  <div class='form_item '>
   <label for='users_group_zayavka_create'>Создание</label>
   <select name='users_group_zayavka_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_zayavka_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["zayavka_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_zayavki_list'>Просмотр списка</label>
   <select name='users_group_zayavki_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_zayavki_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["zayavki_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_zayavki_view'>Просмотр</label>
   <select name='users_group_zayavki_view' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_zayavki_view"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["zayavki_view"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="clients">
<h4>Клиенты</h4>
  <div class='form_item '>
   <label for='users_group_clients_create'>Создание</label>
   <select name='users_group_clients_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_clients_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["clients_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_clients_update'>Редактирование</label>
   <select name='users_group_clients_update' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_clients_update"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["clients_update"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_clients_delete'>Удаление</label>
   <select name='users_group_clients_delete' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_clients_delete"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["clients_delete"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_clients_list'>Просмотр списка</label>
   <select name='users_group_clients_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_clients_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["clients_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_client_view'>Просмотр</label>
   <select name='users_group_client_view' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_client_view"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["client_view"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="categories">
<h4>Категории</h4>
  <div class='form_item '>
   <label for='users_group_categories_create'>Создание</label>
   <select name='users_group_categories_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_categories_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["categories_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_categories_update'>Редактирование</label>
   <select name='users_group_categories_update' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_categories_update"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["categories_update"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_categories_delete'>Удаление</label>
   <select name='users_group_categories_delete' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_categories_delete"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["categories_delete"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_categories_list'>Просмотр списка</label>
   <select name='users_group_categories_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_categories_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["categories_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_category_upload_csv'>загрузка CSV</label>
   <select name='users_group_category_upload_csv' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_category_upload_csv"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["category_upload_csv"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="type_users">
<h4>Типы пользователей</h4>
  <div class='form_item '>
   <label for='users_group_userstypes_create'>Создание</label>
   <select name='users_group_userstypes_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_userstypes_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["userstypes_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_userstypes_update'>Редактирование</label>
   <select name='users_group_userstypes_update' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_userstypes_update"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["userstypes_update"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_userstypes_delete'>Удаление</label>
   <select name='users_group_userstypes_delete' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_userstypes_delete"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["userstypes_delete"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_userstypes_list'>Просмотр списка</label>
   <select name='users_group_userstypes_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_userstypes_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["userstypes_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="type_users">
<h4>Поставщики</h4>
  <div class='form_item '>
   <label for='users_group_postavshiki_create'>Создание</label>
   <select name='users_group_postavshiki_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_postavshiki_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["postavshiki_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_postavshiki_update'>Редактирование</label>
   <select name='users_group_postavshiki_update' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_postavshiki_update"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["postavshiki_update"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_postavshiki_delete'>Удаление</label>
   <select name='users_group_postavshiki_delete' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_postavshiki_delete"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["postavshiki_delete"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_postavshiki_list'>Просмотр списка</label>
   <select name='users_group_postavshiki_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_postavshiki_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["postavshiki_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="type_users">
<h4>Поступление</h4>
  <div class='form_item '>
   <label for='users_group_postuplenie_create'>Создание</label>
   <select name='users_group_postuplenie_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_postuplenie_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["postuplenie_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_postuplenie_update'>Редактирование</label>
   <select name='users_group_postuplenie_update' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_postuplenie_update"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["postuplenie_update"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_postuplenie_delete'>Удаление</label>
   <select name='users_group_postuplenie_delete' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_postuplenie_delete"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["postuplenie_delete"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_postuplenie_list'>Просмотр списка</label>
   <select name='users_group_postuplenie_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_postuplenie_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["postuplenie_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="type_users">
  <h4>Возврат</h4>
    <div class='form_item '>
   <label for='users_group_vozvrat_create'>Создание</label>
   <select name='users_group_vozvrat_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_vozvrat_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["vozvrat_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

    <div class='form_item '>
   <label for='users_group_vozvrat_update'>Редактирование</label>
   <select name='users_group_vozvrat_update' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_vozvrat_update"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["vozvrat_update"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  {el_users_group_vozvrat_delete}
    <div class='form_item '>
   <label for='users_group_vozvrat_list'>vozvrat_list</label>
   <select name='users_group_vozvrat_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_vozvrat_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["vozvrat_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="type_users">
<h4>Курс валют</h4>
  <div class='form_item '>
   <label for='users_group_kurc_valut_create'>Создание</label>
   <select name='users_group_kurc_valut_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_kurc_valut_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["kurc_valut_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_kurc_valut_list'>Просмотр списка</label>
   <select name='users_group_kurc_valut_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_kurc_valut_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["kurc_valut_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="type_users">
<h4>Справочник валют</h4>
  <div class='form_item '>
   <label for='users_group_spravochnik_valut_create'>Создание</label>
   <select name='users_group_spravochnik_valut_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_spravochnik_valut_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["spravochnik_valut_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_spravochnik_valut_update'>Редактирование</label>
   <select name='users_group_spravochnik_valut_update' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_spravochnik_valut_update"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["spravochnik_valut_update"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_spravochnik_valut_delete'>Удаление</label>
   <select name='users_group_spravochnik_valut_delete' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_spravochnik_valut_delete"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["spravochnik_valut_delete"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_spravochnik_valut_list'>Просмотр списка</label>
   <select name='users_group_spravochnik_valut_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_spravochnik_valut_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["spravochnik_valut_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="categories">
<h4>Работники</h4>
  <div class='form_item '>
   <label for='users_group_workers_list'>Просмотр списка</label>
   <select name='users_group_workers_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_workers_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["workers_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_workers_create'>Создание</label>
   <select name='users_group_workers_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_workers_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["workers_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_workers_update'>Редактирование</label>
   <select name='users_group_workers_update' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_workers_update"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["workers_update"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_workers_delete'>Удаление</label>
   <select name='users_group_workers_delete' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_workers_delete"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["workers_delete"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_workers_view'>Просмотр</label>
   <select name='users_group_workers_view' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_workers_view"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["workers_view"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="categories">
<h4>Счета</h4>
  <div class='form_item '>
   <label for='users_group_scheta_list'>Просмотр списка</label>
   <select name='users_group_scheta_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_scheta_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["scheta_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_scheta_create'>Создание</label>
   <select name='users_group_scheta_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_scheta_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["scheta_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_scheta_update'>Редактирование</label>
   <select name='users_group_scheta_update' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_scheta_update"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["scheta_update"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_scheta_delete'>Удаление</label>
   <select name='users_group_scheta_delete' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_scheta_delete"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["scheta_delete"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="categories">
<h4>Доходы</h4>
  <div class='form_item '>
   <label for='users_group_dohody_list'>Просмотр списка</label>
   <select name='users_group_dohody_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_dohody_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["dohody_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_dohody_create'>Создание</label>
   <select name='users_group_dohody_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_dohody_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["dohody_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_dohody_update'>Редактирование</label>
   <select name='users_group_dohody_update' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_dohody_update"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["dohody_update"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_dohody_delete'>Удаление</label>
   <select name='users_group_dohody_delete' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_dohody_delete"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["dohody_delete"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="categories">
<h4>Расходы</h4>
  <div class='form_item '>
   <label for='users_group_rashody_list'>Просмотр списка</label>
   <select name='users_group_rashody_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_rashody_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["rashody_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_rashody_create'>Создание</label>
   <select name='users_group_rashody_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_rashody_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["rashody_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_rashody_update'>Редактирование</label>
   <select name='users_group_rashody_update' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_rashody_update"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["rashody_update"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_rashody_delete'>Удаление</label>
   <select name='users_group_rashody_delete' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_rashody_delete"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["rashody_delete"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div id="categories">
<h4>Должности</h4>
  <div class='form_item '>
   <label for='users_group_professions_list'>Просмотр списка</label>
   <select name='users_group_professions_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_professions_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["professions_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_professions_create'>Создание</label>
   <select name='users_group_professions_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_professions_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["professions_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_professions_update'>Редактирование</label>
   <select name='users_group_professions_update' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_professions_update"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["professions_update"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_professions_delete'>Удаление</label>
   <select name='users_group_professions_delete' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_professions_delete"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["professions_delete"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div>
<h4>Статусы заказов</h4>
  <div class='form_item '>
   <label for='users_group_orders_statuses_list'>Просмотр списка</label>
   <select name='users_group_orders_statuses_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_orders_statuses_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["orders_statuses_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_orders_statuses_update'>Редактирование</label>
   <select name='users_group_orders_statuses_update' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_orders_statuses_update"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["orders_statuses_update"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_orders_statuses_delete'>Удаление</label>
   <select name='users_group_orders_statuses_delete' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_orders_statuses_delete"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["orders_statuses_delete"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_orders_statuses_create'>Создание</label>
   <select name='users_group_orders_statuses_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_orders_statuses_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["orders_statuses_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div>
<h4>Списание</h4>
  <div class='form_item '>
   <label for='users_group_spisanie_view'>Просмотр</label>
   <select name='users_group_spisanie_view' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_spisanie_view"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["spisanie_view"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div>
<h4>Заказы по продуктам</h4>
  <div class='form_item '>
   <label for='users_group_zakazy_products_list'>Просмотр списка</label>
   <select name='users_group_zakazy_products_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_zakazy_products_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["zakazy_products_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div>
<h4>Заявки</h4>
  <div class='form_item '>
   <label for='users_group_zayavka_create'>Создание</label>
   <select name='users_group_zayavka_create' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_zayavka_create"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["zayavka_create"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_zayavki_list'>Просмотр списка</label>
   <select name='users_group_zayavki_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_zayavki_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["zayavki_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='users_group_zayavki_view'>Просмотр</label>
   <select name='users_group_zayavki_view' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_zayavki_view"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["zayavki_view"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>

<div class="clear"></div>
<div>
<h4>Активность действий</h4>
  <div class='form_item '>
   <label for='users_group_activity_list'>Просмотр списка</label>
   <select name='users_group_activity_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_activity_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["activity_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>


<div class="clear"></div>
<div>
<h4>Активность работников</h4>
  <div class='form_item '>
   <label for='users_group_activity_workers_list'>Просмотр списка</label>
   <select name='users_group_activity_workers_list' class='form-control'>
 <?php foreach($site_variables["select_users_group_update_users_group_activity_workers_list"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_group_update_data"]["activity_workers_list"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

</div>


<div class="clear"></div>
 <input type="hidden" name="do" value="users_group">
 <input type="submit" value="Сохранить изменения">
 <input name="cmd" type="submit" value="Отмена"> <input type="hidden" name="do" value="users_group_update">
</form>


<script type="text/javascript">
	 $(".item-id-users_group-type").delegate("select", "change", function(){
         var type = $(".item-id-users_group-type").children("select").val();
         
      if(type==0){
            $("#users").show();
            $("#torg_tochki1").show();
            $("#torg_tochki2").show();
            $("#torg_tochki3").show();
            $("#torg_tochki4").show();
            $("#clients").show();
            $("#categories").show();
            $("#type_users").show();
         }
       if(type==1){
            $("#users").hide();
            $("#torg_tochki1").hide();
            $("#torg_tochki2").hide();
            $("#torg_tochki3").hide();
            $("#torg_tochki4").hide();
            $("#clients").hide();
            $("#categories").hide();
            $("#type_users").hide();
         }
        
       if(type==2){
            $("#users").hide();
            $("#torg_tochki1").show();
            $("#torg_tochki2").hide();
            $("#torg_tochki3").show();
            $("#torg_tochki4").hide();
            $("#clients").show();
            $("#categories").hide();
            $("#type_users").hide();
         }
     
});
</script>

