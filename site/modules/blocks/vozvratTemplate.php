<form action="" method="post">
  <div class="btn-group display-inline pull-right text-align-left hidden-tablet" style="float: left !important;margin-bottom: 20px;">
    <button type="button" class="btn btn-xs btn-default" style="padding: 1px 3px;" onclick="$(this).next().toggle();">
      <i class="fa fa-cog fa-lg"></i> Фильтр
    </button>
    <div class="dropdown-menu dropdown-menu-xs pull-right" style="padding: 15px;width: 700px;left: 0px;">
      <div class="row">
        <div class="col-sm-2" style="width: 340px;">
          Поставщик:
          <select  class="form-control" name="postavshik" style="width:150px;" >
            <option value="0">Не фильтровать</option>
            <?php foreach($site_variables["postavshiki"] as $site_variables["postavshik"]){ ?>
            <option <?php if( $site_variables["session_var_vozvrat_postavshik"] == $site_variables["postavshik"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["postavshik"]["id"]; ?>"><?php echo $site_variables["postavshik"]["name"]; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-sm-2" style="width: 340px;">
          <br>
          <input type="text" name="name_postavshik" class="form-control" value="" placeholder="Поиск по ФИО клиента" />
        </div>
      </div>

      <div class="row">
        <div class="col-sm-2" style="width: 340px;">
          <input type="text" name="nomer_nakladnoy" class="form-control" value="<?php echo $site_variables["session_var_vozvrat_nomer_nakladnoy"]; ?>" placeholder="Поиск по номеру накладной" />
        </div>
        <div class="col-sm-2" style="width: 340px;">
          <input type="text" name="nomer_postupleniya" class="form-control" value="<?php echo $site_variables["session_var_vozvrat_nomer_postupleniya"]; ?>" placeholder="Поиск по номеру поступления" />
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2" style="width: 340px;">
          Дата:<br>
          C <div id="dp-ex-3" class="input-group date" data-auto-close="true" data-date="<?php if( $site_variables["session_var_vozvrat_data_c"] != ""){ ?><?php echo $site_variables["session_var_vozvrat_data_c"]; ?><?php }else{ ?>01-01-2014<?php } ?>" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
          <input name="data_c" value="<?php echo $site_variables["session_var_vozvrat_data_c"]; ?>" class="form-control" type="text">
          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
        До <div id="dp-ex-4" class="input-group date" data-auto-close="true" data-date="<?php if( $site_variables["session_var_vozvrat_data_do"] != ""){ ?><?php echo $site_variables["session_var_vozvrat_data_do"]; ?><?php }else{ ?>01-05-2014<?php } ?>" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
        <input name="data_do" class="form-control" type="text" value="<?php echo $site_variables["session_var_vozvrat_data_do"]; ?>">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-2" style="width: 340px;">
      <select name="order_by_column">
        <option value="">Сортировать по</option>
        <option <?php if( $site_variables["session_var_vozvrat_order_by_column"] == "postavshiki.name"){ ?>selected<?php } ?> value="postavshiki.name">Поставщик</option>
        <option <?php if( $site_variables["session_var_vozvrat_order_by_column"] == "vozvrat.nomer"){ ?>selected<?php } ?> value="vozvrat.nomer">Номер</option>
        <option <?php if( $site_variables["session_var_vozvrat_order_by_column"] == "vozvrat.nomer_naklodnoy"){ ?>selected<?php } ?> value="vozvrat.nomer_naklodnoy">Номер Накладной</option>
        <option <?php if( $site_variables["session_var_vozvrat_order_by_column"] == "vozvrat.data_postupleniya"){ ?>selected<?php } ?> value="vozvrat.data_postupleniya">Дата Поступления</option>
      </select>
      <select name="order_as">
        <option <?php if( $site_variables["session_var_vozvrat_order_as"] == "asc"){ ?>selected<?php } ?>value="asc">Возрастание</option>
        <option<?php if( $site_variables["session_var_vozvrat_order_as"] == "desc"){ ?>selected<?php } ?> value="desc">Убывание</option>
      </select>
    </div>
    <div class="col-sm-2" style="width: 340px;">

    </div>
  </div>

  <button type="submit" name="cmd" class="btn btn-default">Фильтровать</button>
  </div>
  </div>
</form>
<table class="table table-bordered">
  <thead>
  <tr>
    <th>Номер</th>
    <th>Поставщик</th>
    <th>Добавил</th>
    <th>Номер наклодной</th>
    <th>Дата возврата</th>
    <th>Сумма</th>
    <th>Сумма товаров</th>
    <?php if( $site_variables["session_var_vozvrat_delete"] == 1 || $site_variables["session_var_vozvrat_update"] == 1){ ?><th style="width:23px;"> </th><?php } ?>
  </tr>
  </thead>
  <tbody>

  <?php if( count($site_variables["vozvrat"])>0 ){ ?>
   <?php if(count($site_variables["vozvrat"]) > 0){ ?>
 <?php   foreach($site_variables["vozvrat"] as $vozvrat_item){ ?>
<tr>
  <td><?php if( $site_variables["session_var_vozvrat_view"] == 1){ ?><a href="{el_vozvrat_view_url}"><?php echo $vozvrat_item["vozvrat_nomer"]; ?></a><?php }else{ ?><?php echo $vozvrat_item["vozvrat_nomer"]; ?><?php } ?><br>
  <td><?php echo $vozvrat_item["postavshiki_name"]; ?><br>
    <i><?php echo $vozvrat_item["postavshiki_zip_code"]; ?> г.<?php echo $vozvrat_item["postavshiki_city"]; ?>, ул.<?php echo $vozvrat_item["postavshiki_street"]; ?>,д.<?php echo $vozvrat_item["postavshiki_house"]; ?>, <?php if( $vozvrat_item["postavshiki_office"] != ""){ ?>офис<?php echo $vozvrat_item["postavshiki_office"]; ?><?php } ?></i>
  </td>
  <td><?php echo $vozvrat_item["users_first_name"]; ?> <?php echo $vozvrat_item["users_last_name"]; ?></td>
  <td><?php echo $vozvrat_item["vozvrat_nomer_naklodnoy"]; ?></td>
  <td><?php echo $vozvrat_item["vozvrat_data_postupleniya"]; ?></td>
  <td><?php echo $vozvrat_item["vozvrat_summa"]; ?></td>
  <td><?php echo $vozvrat_item["vozvrat_summa_tovarov"]; ?></td>
  <?php if( $site_variables["session_var_vozvrat_delete"] == 1 || $site_variables["session_var_vozvrat_update"] == 1){ ?>
  <td>
    <div class="btn-group display-inline pull-right text-align-left hidden-tablet">
      <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" style="padding: 1px 3px;">
        <i class="fa fa-cog fa-lg"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-xs pull-right">
        <?php if( $site_variables["session_var_vozvrat_update"] == 1){ ?>
        <li>
          <a href="<?php echo $vozvrat_item["actions_list"]["vozvrat_update"]; ?>"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> Редактировать</a>
        </li>
        <?php } ?>
        <?php if( $site_variables["session_var_vozvrat_delete"] == 1){ ?>
        <li>
          <a onclick="return confirm('Вы уверены что хотите удалить возврат № <?php echo $vozvrat_item["vozvrat_nomer"]; ?>?');" href="<?php echo $vozvrat_item["actions_list"]["vozvrat_delete"]; ?>"><i class="fa fa-times fa-lg fa-fw txt-color-red"></i> Удалить</a>
        </li>
        <?php } ?>
        <!--
        <li>
          <a href="{el_vozvrat_view_url}"><i class="fa fa-file fa-lg fa-fw txt-color-greenLigh"></i> Просмотр</a>
        </li>
        //-->
      </ul>
    </div>
  </td>
  <?php } ?> <?php   } ?>
 <?php } ?>

  <?php } ?>
  </tbody>
</table>
 <?php if( $site_variables["vozvrat_navigation"] == 1 ){ ?>  
 <div class="pagination">  
  <ul>  
   <?php if( $site_variables["vozvrat_num1"] > 1){ ?><li <?php if( $site_variables["vozvrat_page_num"] == 1){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["vozvrat_prev_url"]; ?>" class="ext_disabled"> < </a></li><?php } ?>  
   <?php if( $site_variables["vozvrat_num1"] > 0){ ?><li <?php if( $site_variables["vozvrat_page_num"] == $site_variables["vozvrat_num1"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["vozvrat_num_1_url"]; ?>" class="ext_disabled"><?php echo $site_variables["vozvrat_num1"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["vozvrat_num2"] > 0){ ?><li <?php if( $site_variables["vozvrat_page_num"] == $site_variables["vozvrat_num2"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["vozvrat_num_2_url"]; ?>" class="ext_disabled"><?php echo $site_variables["vozvrat_num2"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["vozvrat_num3"] > 0){ ?><li <?php if( $site_variables["vozvrat_page_num"] == $site_variables["vozvrat_num3"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["vozvrat_num_3_url"]; ?>" class="ext_disabled"><?php echo $site_variables["vozvrat_num3"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["vozvrat_last_num"] > 3){ ?><li class="disabled"><a href="#" class="ext_disabled">...</a></li><?php } ?> 
   <?php if( $site_variables["vozvrat_last_num"] != $site_variables["vozvrat_num3"]){ ?><li <?php if( $site_variables["vozvrat_page_num"] == $site_variables["vozvrat_last_num"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["vozvrat_last_url"]; ?>" class="ext_disabled"><?php echo $site_variables["vozvrat_last_num"]; ?></a></li><?php } ?> 
   <?php if( $site_variables["vozvrat_page_num"] < $site_variables["vozvrat_last_num"]){ ?><li><a href="<?php echo $site_variables["vozvrat_next_url"]; ?>" class="ext_disabled"> > </a></li><?php } ?>  
  </ul> 
 </div>  
 <?php } ?>  

<?php if( $site_variables["vozvrat_create_link"] != "" && $site_variables["session_var_vozvrat_create"] == 1){ ?>
<form action = "<?php echo $site_variables["vozvrat_create_link"]; ?>" method="post">
  <button type="submit" class="btn btn-large btn-primary">Добавить возврат</button>
</form>
<?php } ?>

