<?php if( $site_variables["view_postavshik"] != 1){ ?>
<form action="" method="post" id="form_filtr">
  <div class="btn-group display-inline pull-right text-align-left hidden-tablet" style="float: left !important;margin-bottom: 20px;">
    <button type="button" class="btn btn-xs btn-default" style="padding: 1px 3px;" onclick="$(this).next().toggle();">
      <i class="fa fa-cog fa-lg"></i> Фильтр
    </button>
    <div class="dropdown-menu dropdown-menu-xs pull-right" style="padding: 15px;width: 700px;left: 0px;">
      <div class="row">
        <div class="col-sm-6">
          <select s name="postavshik" class="form-control" >
            <option value="">Выберите поставщика</option>
            <?php if( count($site_variables["postavshiki"])>0){ ?>
            <?php foreach($site_variables["postavshiki"] as $site_variables["postavshik"]){ ?>
            <option <?php if( $site_variables["session_var_zayavki_postavshik"] == $site_variables["postavshik"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["postavshik"]["id"]; ?>"><?php echo $site_variables["postavshik"]["name"]; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
        <div class="col-sm-6">
          <select s name="status" class="form-control" >
            <option value="">Выберите статус</option>
            <option <?php if( $site_variables["session_var_zayavki_status"] == 1){ ?>selected<?php } ?> value="1">Новая заявка</option>
            <option <?php if( $site_variables["session_var_zayavki_status"] == 2){ ?>selected<?php } ?> value="2">Товар получен</option>

          </select>
        </div>
       
      </div>


      <div class="row">
        <div class="col-sm-6">
          Дата:<br>
          C <div id="dp-ex-3" class="input-group date" data-auto-close="true" data-date="2014-01-01" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
            <input name="data_c" class="form-control" type="text" <?php if( $site_variables["session_var_zayavki_data_c"] != ""){ ?>value="<?php echo $site_variables["session_var_zayavki_data_c"]; ?>"<?php } ?>>
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
        <div class="col-sm-6">
          <br>До <div id="dp-ex-4" class="input-group date" data-auto-close="true" data-date="2014-01-01" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
            <input name="data_do" class="form-control" type="text" <?php if( $site_variables["session_var_zayavki_data_do"] != ""){ ?>value="<?php echo $site_variables["session_var_zayavki_data_do"]; ?>"<?php } ?>>
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
      </div>
 
      <button type="submit" name="cmd" class="btn btn-default">Фильтровать</button>
    </div>

  </div>
<input type="hidden" name="valuta_change" value="1">
<select id="valuty" name="valuty" style="margin-left: 20px;">
 <option  value="">Валюта по умолчанию</option>
<?php foreach($site_variables["valuty"] as $site_variables["item"]){ ?>
 <option <?php if( $site_variables["item"]["kod_valuty"] == $site_variables["session_var_zayavki_valyta"] ){ ?>selected<?php } ?> value="<?php echo $site_variables["item"]["kod_valuty"]; ?>"><?php echo $site_variables["item"]["name"]; ?></option>
<?php } ?>
</select>
</form>
<?php } ?>
<table class="table table-bordered">
  <thead>
  <tr>
    <th>№</th>
    <th>Поставщик</th>
    <th>Менеджер</th>
    <th>Сумма закупки</th>
     <th>Статус</th>
     <th>Время заявки</th>
    <?php if( $site_variables["session_var_zayavki_view"] == 1){ ?><th>Управление</th><?php } ?>
  </tr>
  </thead>
  <tbody>

  <?php if( count($site_variables["zayavki_list"])>0 ){ ?>
   <?php if(count($site_variables["zayavki_list"]) > 0){ ?>
 <?php   foreach($site_variables["zayavki_list"] as $zayavki_list_item){ ?>
<tr>
  <td><?php if( $site_variables["session_var_zayavki_view"] == 1){ ?><a href="<?php echo $zayavki_list_item["actions_list"]["zayavka_view"]; ?>"><?php echo $zayavki_list_item["zayavki_nomer"]; ?></a><?php }else{ ?><?php echo $zayavki_list_item["zayavki_nomer"]; ?><?php } ?></td>
  <td><?php echo $zayavki_list_item["postavshiki_name"]; ?></td>
  <td><?php echo $zayavki_list_item["users_first_name"]; ?> <?php echo $zayavki_list_item["users_last_name"]; ?></td>
  <td><?php echo $zayavki_list_item["zayavki_summa_zakupki"]; ?></td>
  <td><?php echo $zayavki_list_item["zayavki_status"]; ?></td>
  <td><?php echo $zayavki_list_item["zayavki_created"]; ?></td>
  <?php if( $site_variables["session_var_zayavki_view"] == 1){ ?><td> <div class="btn-group display-inline pull-right text-align-left hidden-tablet">
      <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" style="padding: 1px 3px;">
        <i class="fa fa-cog fa-lg"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-xs pull-right">

        <li>
          <a href="<?php echo $zayavki_list_item["actions_list"]["zayavka_view"]; ?>"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> Просмотр</a>
        </li>
         <?php if( $zayavki_list_item["zayavki_status"] == "Новая заявка" ){ ?>
        <li>
          <a href="<?php echo $zayavki_list_item["actions_list"]["zayavka_update"]; ?>"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> Редактировать</a>
        </li>
       <?php } ?>

      </ul>
    </div></td><?php } ?>
</tr> <?php   } ?>
 <?php } ?>

  <?php } ?>
  </tbody>
</table>
 <?php if( $site_variables["zayavki_list_navigation"] == 1 ){ ?>  
 <div class="pagination">  
  <ul>  
   <?php if( $site_variables["zayavki_list_num1"] > 1){ ?><li <?php if( $site_variables["zayavki_list_page_num"] == 1){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["zayavki_list_prev_url"]; ?>" class="ext_disabled"> < </a></li><?php } ?>  
   <?php if( $site_variables["zayavki_list_num1"] > 0){ ?><li <?php if( $site_variables["zayavki_list_page_num"] == $site_variables["zayavki_list_num1"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["zayavki_list_num_1_url"]; ?>" class="ext_disabled"><?php echo $site_variables["zayavki_list_num1"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["zayavki_list_num2"] > 0){ ?><li <?php if( $site_variables["zayavki_list_page_num"] == $site_variables["zayavki_list_num2"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["zayavki_list_num_2_url"]; ?>" class="ext_disabled"><?php echo $site_variables["zayavki_list_num2"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["zayavki_list_num3"] > 0){ ?><li <?php if( $site_variables["zayavki_list_page_num"] == $site_variables["zayavki_list_num3"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["zayavki_list_num_3_url"]; ?>" class="ext_disabled"><?php echo $site_variables["zayavki_list_num3"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["zayavki_list_last_num"] > 3){ ?><li class="disabled"><a href="#" class="ext_disabled">...</a></li><?php } ?> 
   <?php if( $site_variables["zayavki_list_last_num"] != $site_variables["zayavki_list_num3"]){ ?><li <?php if( $site_variables["zayavki_list_page_num"] == $site_variables["zayavki_list_last_num"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["zayavki_list_last_url"]; ?>" class="ext_disabled"><?php echo $site_variables["zayavki_list_last_num"]; ?></a></li><?php } ?> 
   <?php if( $site_variables["zayavki_list_page_num"] < $site_variables["zayavki_list_last_num"]){ ?><li><a href="<?php echo $site_variables["zayavki_list_next_url"]; ?>" class="ext_disabled"> > </a></li><?php } ?>  
  </ul> 
 </div>  
 <?php } ?>  

<script>
$("#valuty").change(function(){
  $("#form_filtr").submit();
});
</script>

