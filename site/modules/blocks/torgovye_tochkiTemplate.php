<?php if( $site_variables["system_messages"] != "" ){ ?>
<div class="alert alert-success">
  <a class="close" data-dismiss="alert" href="#" aria-hidden="true">x</a>
  <?php echo $site_variables["system_messages"]; ?>
</div>
<?php } ?>
<form action="" method="post">
  <div class="btn-group display-inline pull-right text-align-left hidden-tablet" style="float: left !important;margin-bottom: 20px;">
    <button type="button" class="btn btn-xs btn-default" style="padding: 1px 3px;" onclick="$(this).next().toggle();">
      <i class="fa fa-cog fa-lg"></i> Поиск
    </button>
    <div class="dropdown-menu dropdown-menu-xs pull-right" style="padding: 15px;width: 700px;left: 0px;">
      <div class="row">
        <div class="col-sm-2" style="width: 340px;">
          <input type="text" name="name" class="form-control" value="<?php echo $site_variables["name_torg_tochka"]; ?>" placeholder="Поиск по названию торговой точки" />
        </div>
        <div class="col-sm-2" style="width: 340px;">
          <input type="text" name="city" class="form-control" value="<?php echo $site_variables["city_torg_tochka"]; ?>" placeholder="Поиск по городу торговой точки" />
        </div>
      </div>

      <div class="row">
        <div class="col-sm-2" style="width: 340px;">
          <input type="text" name="street" class="form-control" value="<?php echo $site_variables["street_torg_tochka"]; ?>" placeholder="Поиск по улице торговой точки" />
        </div>
        <div class="col-sm-2" style="width: 340px;">
          <input type="text" name="emeil" class="form-control" value="<?php echo $site_variables["emeil_torg_tochka"]; ?>" placeholder="Поиск по Емеилу торговой точки" />
        </div>
      </div>

      <div class="row">
        <div class="col-sm-2" style="width: 340px;">
          <select name="napravlenie" class="form-control">
            <option value="0">Поиск по направлению</option>
            <?php foreach($site_variables["napravlenie_db"] as $site_variables["napravleni"]){ ?>
            <option <?php if( $site_variables["napravleni"]["id"] == $site_variables["napravlenie"]){ ?><?php } ?> value="<?php echo $site_variables["napravleni"]["id"]; ?>"><?php echo $site_variables["napravleni"]["napravlenie"]; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>

      <button type="submit" name="cmd" class="btn btn-default">Искать</button>
    </div>
  </div>
</form>
<table class="table table-bordered">
  <thead>
  <tr>
    <th></th>
    <th>Название</th>
    <th>Телефон</th>
    <th>Емеил</th>
    <th>Сумма Заказов</th>
    <?php if( $site_variables["session_var_torgovaya_delete"] == 1 || $site_variables["session_var_torgovaya_update"] == 1){ ?><th style="width:23px;"> </th><?php } ?>
  </tr>
  </thead>
  <tbody>

  <?php if( count($site_variables["torgovye_tochki"])>0 ){ ?>
   <?php if(count($site_variables["torgovye_tochki"]) > 0){ ?>
 <?php   foreach($site_variables["torgovye_tochki"] as $torgovye_tochki_item){ ?>
<tr>
  <td>
    <a href="<?php if( $site_variables["session_var_torgovaya_view"] == 1){ ?><?php echo $torgovye_tochki_item["actions_list"]["view_torgovaya_tochka"]; ?><?php } ?>">
      <img width="80" src="<?php echo $site_variables["template_dir"]; ?>/img/torgovye_tochki/<?php if( $torgovye_tochki_item["torgovye_tochki_img"] > 0){ ?><?php echo $torgovye_tochki_item["torgovye_tochki_id"]; ?><?php }else{ ?>no_img<?php } ?>.jpg">
    </a>
  </td>
  <td><?php if( $site_variables["session_var_torgovaya_view"] == 1){ ?><a href="<?php echo $torgovye_tochki_item["actions_list"]["view_torgovaya_tochka"]; ?>"><?php echo $torgovye_tochki_item["torgovye_tochki_name"]; ?></a><?php }else{ ?><?php echo $torgovye_tochki_item["torgovye_tochki_name"]; ?><?php } ?><br>
    <i><?php echo $torgovye_tochki_item["torgovye_tochki_zip_code"]; ?> г.<?php echo $torgovye_tochki_item["torgovye_tochki_city"]; ?>, ул.<?php echo $torgovye_tochki_item["torgovye_tochki_street"]; ?>,д.<?php echo $torgovye_tochki_item["torgovye_tochki_house"]; ?>, <?php if( $torgovye_tochki_item["torgovye_tochki_office"] != ""){ ?>офис<?php echo $torgovye_tochki_item["torgovye_tochki_office"]; ?><?php } ?></i>
  </td>
  <td><?php echo $torgovye_tochki_item["torgovye_tochki_telephone"]; ?></td>
  <td><?php echo $torgovye_tochki_item["torgovye_tochki_email"]; ?></td>
  <td><?php echo $torgovye_tochki_item["torgovye_tochki_sum_zakazov"]; ?></td>
  <?php if( $site_variables["session_var_torgovaya_delete"] == 1 || $site_variables["session_var_torgovaya_update"] == 1){ ?>
  <td>
    <div class="btn-group display-inline pull-right text-align-left hidden-tablet">
      <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" style="padding: 1px 3px;">
        <i class="fa fa-cog fa-lg"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-xs pull-right">
        <?php if( $site_variables["session_var_torgovaya_view"] == 1){ ?>
        <li>
          <a href="<?php echo $torgovye_tochki_item["actions_list"]["view_torgovaya_tochka"]; ?>"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> Просмотр</a>
        </li>
      <?php } ?>
        <?php if( $site_variables["session_var_torgovaya_update"] == 1){ ?>
        <li>
          <a href="<?php echo $torgovye_tochki_item["actions_list"]["torgovye_tochki_update"]; ?>"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> Редактировать</a>
        </li>
        <?php } ?>
        <?php if( $site_variables["session_var_torgovaya_delete"] == 1){ ?>
        <li>
          <a onclick="return confirm('Вы уверены что хотите удалить торговую точку <?php echo $torgovye_tochki_item["torgovye_tochki_name"]; ?>?');" href="<?php echo $torgovye_tochki_item["actions_list"]["torgovye_tochki_delete"]; ?>"><i class="fa fa-times fa-lg fa-fw txt-color-red"></i> Удалить</a>
        </li>
        <?php } ?>
      </ul>
    </div>
  </td>
  <?php } ?> <?php   } ?>
 <?php } ?>

  <?php } ?>
  </tbody>
</table>
 <?php if( $site_variables["torgovye_tochki_navigation"] == 1 ){ ?>  
 <div class="pagination">  
  <ul>  
   <?php if( $site_variables["torgovye_tochki_num1"] > 1){ ?><li <?php if( $site_variables["torgovye_tochki_page_num"] == 1){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["torgovye_tochki_prev_url"]; ?>" class="ext_disabled"> < </a></li><?php } ?>  
   <?php if( $site_variables["torgovye_tochki_num1"] > 0){ ?><li <?php if( $site_variables["torgovye_tochki_page_num"] == $site_variables["torgovye_tochki_num1"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["torgovye_tochki_num_1_url"]; ?>" class="ext_disabled"><?php echo $site_variables["torgovye_tochki_num1"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["torgovye_tochki_num2"] > 0){ ?><li <?php if( $site_variables["torgovye_tochki_page_num"] == $site_variables["torgovye_tochki_num2"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["torgovye_tochki_num_2_url"]; ?>" class="ext_disabled"><?php echo $site_variables["torgovye_tochki_num2"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["torgovye_tochki_num3"] > 0){ ?><li <?php if( $site_variables["torgovye_tochki_page_num"] == $site_variables["torgovye_tochki_num3"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["torgovye_tochki_num_3_url"]; ?>" class="ext_disabled"><?php echo $site_variables["torgovye_tochki_num3"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["torgovye_tochki_last_num"] > 3){ ?><li class="disabled"><a href="#" class="ext_disabled">...</a></li><?php } ?> 
   <?php if( $site_variables["torgovye_tochki_last_num"] != $site_variables["torgovye_tochki_num3"]){ ?><li <?php if( $site_variables["torgovye_tochki_page_num"] == $site_variables["torgovye_tochki_last_num"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["torgovye_tochki_last_url"]; ?>" class="ext_disabled"><?php echo $site_variables["torgovye_tochki_last_num"]; ?></a></li><?php } ?> 
   <?php if( $site_variables["torgovye_tochki_page_num"] < $site_variables["torgovye_tochki_last_num"]){ ?><li><a href="<?php echo $site_variables["torgovye_tochki_next_url"]; ?>" class="ext_disabled"> > </a></li><?php } ?>  
  </ul> 
 </div>  
 <?php } ?>  


<?php if( $site_variables["torgovye_tochki_create_link"] != "" && $site_variables["session_var_torgovaya_create"] == 1){ ?>
<form action = "<?php echo $site_variables["torgovye_tochki_create_link"]; ?>" method="post">
  <button type="submit" class="btn btn-large btn-primary">Добавить новую торговую точку</button>
</form>
<?php } ?>

