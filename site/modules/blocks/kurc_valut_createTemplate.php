<h3>Текущий курс валют в банке aval.ua</h3>
<hr>
<form id = "form1" class="form-inline" role="form" action = "" method="post">
    <input type="hidden" name="do" value="save">
	<div class="form-group"> 
		<div class="input-group">
		  <span class="input-group-addon">Доллар</span>
		  <input type="text" class="form-control" name="dollar" name="dollar" value = "<?php echo $site_variables["dollars"]; ?>" style="width: 70px; margin-right:10px;">
		</div>
	</div>
	<div class="form-group">
		<div class="input-group">
		  <span class="input-group-addon">Евро</span>
		  <input type="text" class="form-control" name="euro" value = "<?php echo $site_variables["evro"]; ?>" style="width: 70px; margin-right:10px;">
		</div>
	</div>
	<div class="form-group">
		<div class="input-group">
		  <span class="input-group-addon">Рубль</span>
		  <input type="text" class="form-control" name="rub" value = "<?php echo $site_variables["rubli"]; ?>" style="width: 70px; margin-right:10px;">
		</div>
	</div>
</form>
<hr>

<form action = "" method="post">  
	<button type="button" name="do" value="save" class="btn btn-large btn-primary" onclick = "$('#form1').submit();">Сохранить курс</button>
	<button type="submit" name="do" value="cancel" class="btn btn-large">Отменить</button>
</form>

