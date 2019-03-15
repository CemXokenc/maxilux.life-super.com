<div id="table_products">
<?php echo $site_variables["table_products"]; ?>
</div>
<form id='block-zayavka_update' method='post' enctype='multipart/form-data' />
  <div class='form_item '>
   <label for='zayavki_summa_zakupki'>Сумма закупки</label>
   <input class='form-control' type='text'  id='id_zayavki_summa_zakupki' name='zayavki_summa_zakupki' value='<?php  echo $site_variables["zayavka_update_data"]["summa_zakupki"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='zayavki_valuta'>Валюта</label>
   <select name='zayavki_valuta' class='form-control'>
 <?php foreach($site_variables["select_zayavka_update_zayavki_valuta"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["zayavka_update_data"]["valuta"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='zayavki_manager_id'>Менеджер</label>
   <select name='zayavki_manager_id' class='form-control'>
 <?php foreach($site_variables["select_zayavka_update_zayavki_manager_id"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["zayavka_update_data"]["manager_id"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='zayavki_postavshik_id'>Поставщик</label>
   <select name='zayavki_postavshik_id' class='form-control'>
 <?php foreach($site_variables["select_zayavka_update_zayavki_postavshik_id"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["zayavka_update_data"]["postavshik_id"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='zayavki_sklad_id'>Склад</label>
   <select name='zayavki_sklad_id' class='form-control'>
 <?php foreach($site_variables["select_zayavka_update_zayavki_sklad_id"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["zayavka_update_data"]["sklad_id"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='zayavki_status'>Статус</label>
   <select name='zayavki_status' class='form-control'>
 <?php foreach($site_variables["select_zayavka_update_zayavki_status"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["zayavka_update_data"]["status"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

<input type="hidden" name="do" value="zayavka_update">
<input type="submit" value="Сохранить изменения">
<input name="cmd" type="submit" value="Отмена"> <input type="hidden" name="do" value="zayavka_update">
</form>

<script type="text/javascript">
$( "body" ).delegate( ".product_delete", "click", function() {
   var product_id = $(this).attr("product-id"); 
     $.ajax({  
                dataType: 'json',
                type: "POST",
                url: "",   
                data:{"do":"delete","product_id":product_id},
                success: function(html){  
                    $("#table_products").html(html.table);
                    
                }  
            }); 
});
</script>

