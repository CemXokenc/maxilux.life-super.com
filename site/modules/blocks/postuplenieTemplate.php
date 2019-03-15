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
           <option <?php if( $site_variables["session_var_postuplenie_postavshik"] == $site_variables["postavshik"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["postavshik"]["id"]; ?>"><?php echo $site_variables["postavshik"]["name"]; ?></option>
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
           <input type="text" name="nomer_nakladnoy" class="form-control" value="<?php echo $site_variables["session_var_postuplenie_nomer_nakladnoy"]; ?>" placeholder="Поиск по номеру накладной" />
         </div>
         <div class="col-sm-2" style="width: 340px;">
           <input type="text" name="nomer_postupleniya" class="form-control" value="<?php echo $site_variables["session_var_postuplenie_nomer_postupleniya"]; ?>" placeholder="Поиск по номеру поступления" />
         </div>
      </div>
      <div class="row">
        <div class="col-sm-2" style="width: 340px;">
          Дата:<br>
          C <div id="dp-ex-3" class="input-group date" data-auto-close="true" data-date="<?php if( $site_variables["session_var_postuplenie_data_c"] != ""){ ?><?php echo $site_variables["session_var_postuplenie_data_c"]; ?><?php }else{ ?>01-01-2014<?php } ?>" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
            <input name="data_c" value="<?php echo $site_variables["session_var_postuplenie_data_c"]; ?>" class="form-control" type="text">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
          До <div id="dp-ex-4" class="input-group date" data-auto-close="true" data-date="<?php if( $site_variables["session_var_postuplenie_data_do"] != ""){ ?><?php echo $site_variables["session_var_postuplenie_data_do"]; ?><?php }else{ ?>01-05-2014<?php } ?>" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
            <input name="data_do" class="form-control" type="text" value="<?php echo $site_variables["session_var_postuplenie_data_do"]; ?>">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-2" style="width: 340px;">
          <select name="order_by_column">
            <option value="">Сортировать по</option>
            <option <?php if( $site_variables["session_var_postuplenie_order_by_column"] == "postavshiki.name"){ ?>selected<?php } ?> value="postavshiki.name">Поставщик</option>
            <option <?php if( $site_variables["session_var_postuplenie_order_by_column"] == "postuplenie.nomer"){ ?>selected<?php } ?> value="postuplenie.nomer">Номер</option>
            <option <?php if( $site_variables["session_var_postuplenie_order_by_column"] == "postuplenie.nomer_naklodnoy"){ ?>selected<?php } ?> value="postuplenie.nomer_naklodnoy">Номер Накладной</option>
            <option <?php if( $site_variables["session_var_postuplenie_order_by_column"] == "postuplenie.data_postupleniya"){ ?>selected<?php } ?> value="postuplenie.data_postupleniya">Дата Поступления</option>
          </select>
          <select name="order_as">
            <option <?php if( $site_variables["session_var_postuplenie_order_as"] == "asc"){ ?>selected<?php } ?>value="asc">Возрастание</option>
            <option<?php if( $site_variables["session_var_postuplenie_order_as"] == "desc"){ ?>selected<?php } ?> value="desc">Убывание</option>
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
				            <th>Дата поступления</th>
                                            <th>Сумма</th>
                                            <th>Сумма товаров</th>
				            <?php if( $site_variables["session_var_postuplenie_delete"] == 1 || $site_variables["session_var_postuplenie_update"] == 1){ ?><th style="width:23px;"> </th><?php } ?>
				          </tr>
				        </thead>       
                                    <tbody>       
				          
                                         <?php if( count($site_variables["postuplenie"])>0 ){ ?>
                                          <?php if(count($site_variables["postuplenie"]) > 0){ ?>
 <?php   foreach($site_variables["postuplenie"] as $postuplenie_item){ ?>
<tr>
  <td><?php if( $site_variables["session_var_postuplenie_view"] == 1){ ?><a href="<?php echo $postuplenie_item["actions_list"]["postuplenie_view"]; ?>"><?php echo $postuplenie_item["postuplenie_nomer"]; ?></a><?php }else{ ?><?php echo $postuplenie_item["postuplenie_nomer"]; ?><?php } ?><br>
  <td><?php echo $postuplenie_item["postavshiki_name"]; ?><br>
    <i><?php echo $postuplenie_item["postavshiki_zip_code"]; ?> г.<?php echo $postuplenie_item["postavshiki_city"]; ?>, ул.<?php echo $postuplenie_item["postavshiki_street"]; ?>,д.<?php echo $postuplenie_item["postavshiki_house"]; ?>, <?php if( $postuplenie_item["postavshiki_office"] != ""){ ?>офис<?php echo $postuplenie_item["postavshiki_office"]; ?><?php } ?></i>
  </td>
  <td><?php echo $postuplenie_item["users_first_name"]; ?> <?php echo $postuplenie_item["users_last_name"]; ?></td>
  <td><?php echo $postuplenie_item["postuplenie_nomer_naklodnoy"]; ?></td>
  <td><?php echo $postuplenie_item["postuplenie_data_postupleniya"]; ?></td>
  <td><?php echo $postuplenie_item["postuplenie_summa"]; ?></td>
  <td><?php echo $postuplenie_item["postuplenie_summa_tovarov"]; ?></td>
  <?php if( $site_variables["session_var_postuplenie_delete"] == 1 || $site_variables["session_var_postuplenie_update"] == 1){ ?>
  <td>
    <div class="btn-group display-inline pull-right text-align-left hidden-tablet">
      <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" style="padding: 1px 3px;">
        <i class="fa fa-cog fa-lg"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-xs pull-right">
        <?php if( $site_variables["session_var_postuplenie_update"] == 1){ ?>
        <li>
          <a href="<?php echo $postuplenie_item["actions_list"]["postuplenie_update"]; ?>"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> Редактировать</a>
        </li>
        <?php } ?>
        <?php if( $site_variables["session_var_postuplenie_delete"] == 1){ ?>
        <li>
          <a href="<?php echo $postuplenie_item["actions_list"]["postuplenie_delete"]; ?>"><i class="fa fa-times fa-lg fa-fw txt-color-red"></i> Удалить</a>
        </li>
        <?php } ?>
        <li>
          <a onclick="return confirm('Вы уверены что хотите удалить поступление № <?php echo $postuplenie_item["postuplenie_nomer"]; ?>?');" href="<?php echo $postuplenie_item["actions_list"]["postuplenie_view"]; ?>"><i class="fa fa-file fa-lg fa-fw txt-color-greenLigh"></i> Просмотр</a>
        </li>
      </ul>
    </div>
  </td>
  <?php } ?> <?php   } ?>
 <?php } ?>

                                         <?php } ?>
				        </tbody>
				      </table>

   <?php if( $site_variables["postuplenie_create_link"] != "" && $site_variables["session_var_postuplenie_create"] == 1){ ?>
      <form action = "<?php echo $site_variables["postuplenie_create_link"]; ?>" method="post">  
      <button type="submit" class="btn btn-large btn-primary">Добавить новые поступления</button>
      </form>
     <?php } ?>

