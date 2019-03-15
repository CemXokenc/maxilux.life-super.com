<div class="row">
 <div clas="col-md-12">
 <div style="width:500px;padding-left:70px;">
<form action="" method="post">
<div class="form_item">
   <label for="fio">ФИО</label>
   <input class="form-control" type="text" name="fio" value="<?php echo $site_variables["client_info"]["fio"]; ?>">
</div>

<div class="form_item">
   <label for="telephone">Телефон</label>
   <input class="form-control" type="text" name="telephone" value="<?php echo $site_variables["client_info"]["telephone"]; ?>">
</div>

<div class="form_item">
   <label for="email">E-mail</label>
   <input class="form-control" type="text" name="email" value="<?php echo $site_variables["client_info"]["email"]; ?>">
</div>


<div class="form_item">
   <label for="city">Город</label>
   <input class="form-control" type="text" name="city" value="<?php echo $site_variables["client_info"]["city"]; ?>">
</div>

<div class="form_item">
   <label for="city">Почтовый индекс</label>
   <input class="form-control" type="text" name="zip_code" value="<?php echo $site_variables["client_info"]["zip_code"]; ?>">
</div>

<div class="form_item">
   <label for="city">Адрес</label>
   <input class="form-control" type="text" name="adress" value="<?php echo $site_variables["client_info"]["adress"]; ?>">
</div>

<button  name="do" id="zakaz" value="zakaz">Оформить заказ</button>
</form>
</div>
</div>
</div>

