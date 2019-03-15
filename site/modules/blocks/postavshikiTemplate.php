<?php if( $site_variables["system_messages"] != "" ){ ?>
  <div class="alert alert-success">
  <a class="close" data-dismiss="alert" href="#" aria-hidden="true">x</a>
  <?php echo $site_variables["system_messages"]; ?>
 </div>
<?php } ?>
 <form action="" method="post">
   <div class="btn-group display-inline pull-right text-align-left hidden-tablet" style="float: left !important;margin-bottom: 20px;">
     <button type="button" class="btn btn-xs btn-default" style="padding: 1px 3px;" onclick="$(this).next().toggle();">
       <i class="fa fa-cog fa-lg"></i> Фильтр
     </button>
     <div class="dropdown-menu dropdown-menu-xs pull-right" style="padding: 15px;width: 700px;left: 0px;">
       <div class="row">
         <div class="col-sm-2" style="width: 340px;">
           <input type="text" class="form-control" name="name" value="<?php echo $site_variables["name_torg_tochka"]; ?>" placeholder="Поиск по именованию поставщика" />
         </div>
         <div class="col-sm-2" style="width: 340px;">
           <input type="text" class="form-control" name="city" value="<?php echo $site_variables["city_torg_tochka"]; ?>" placeholder="Поиск по городу поставщика" />
         </div>
       </div>

       <div class="row">
         <div class="col-sm-2" style="width: 340px;">
           <input type="text" class="form-control" name="street" value="<?php echo $site_variables["street_torg_tochka"]; ?>" placeholder="Поиск по улице поставщика" />
         </div>
         <div class="col-sm-2" style="width: 340px;">
           <input type="text" class="form-control" name="emeil" value="<?php echo $site_variables["emeil_torg_tochka"]; ?>" placeholder="Поиск по Емеилу поставщика" />
         </div>
       </div>

       <div class="row">
         <div class="col-sm-2" style="width: 340px;">
           <select name="order_by_column">
             <option value="">Сортировать по</option>
             <option value="name">Поставщик</option>
           </select>
           <select name="order_as">
             <option value="asc">Возрастание</option>
             <option value="desc">Убывание</option>
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
                            <th>Картинка</th>
				            <th>Название</th>
				            <th>Телефон</th>
                                            <th>Емеил</th>
				            <th>Дебет</th>
                                            <th>Кредит</th>
				            <?php if( $site_variables["session_var_postavshiki_delete"] == 1 || $site_variables["session_var_postavshiki_update"] == 1){ ?><th style="width:23px;"> </th><?php } ?>
				          </tr>
				        </thead>       
                                    <tbody>       
				          
                                         <?php if( count($site_variables["postavshiki"])>0 ){ ?>
                                          <?php if(count($site_variables["postavshiki"]) > 0){ ?>
 <?php   foreach($site_variables["postavshiki"] as $postavshiki_item){ ?>
<tr>
  <td>
    <a href="<?php if( $site_variables["session_var_view_postavshik"] == 1){ ?><?php echo $postavshiki_item["actions_list"]["view_postavshik"]; ?><?php } ?>">
      <img width="80" src="<?php echo $site_variables["template_dir"]; ?>/img/postavshiki/<?php if( $postavshiki_item["postavshiki_img"] > 0){ ?><?php echo $postavshiki_item["postavshiki_id"]; ?><?php }else{ ?>no_img<?php } ?>.jpg">
    </a>
  </td>
  <td><?php if( $site_variables["session_var_view_postavshik"] == 1){ ?><a href="<?php echo $postavshiki_item["actions_list"]["view_postavshik"]; ?>"><?php echo $postavshiki_item["postavshiki_name"]; ?></a><?php }else{ ?><?php echo $postavshiki_item["postavshiki_name"]; ?><?php } ?><br>
    <i><?php echo $postavshiki_item["postavshiki_zip_code"]; ?> г.<?php echo $postavshiki_item["postavshiki_city"]; ?>, ул.<?php echo $postavshiki_item["postavshiki_street"]; ?>,д.<?php echo $postavshiki_item["postavshiki_house"]; ?>, <?php if( $postavshiki_item["postavshiki_office"] != ""){ ?>офис<?php echo $postavshiki_item["postavshiki_office"]; ?><?php } ?></i>
  </td>
  <td><?php echo $postavshiki_item["postavshiki_telephone"]; ?></td>
  <td><?php echo $postavshiki_item["postavshiki_email"]; ?></td>
  <td><?php echo $postavshiki_item["postavshiki_debet"]; ?></td>
  <td><?php echo $postavshiki_item["postavshiki_credit"]; ?></td>
  <?php if( $site_variables["session_var_postavshiki_delete"] == 1 || $site_variables["session_var_postavshiki_update"] == 1){ ?>
  <td>
    <div class="btn-group display-inline pull-right text-align-left hidden-tablet">
      <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" style="padding: 1px 3px;">
        <i class="fa fa-cog fa-lg"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-xs pull-right">
        <?php if( $site_variables["session_var_view_postavshik"] == 1){ ?>
        <li>
          <a href="<?php echo $postavshiki_item["actions_list"]["view_postavshik"]; ?>"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> Просмотр</a>
        </li>
        <?php } ?>
        <?php if( $site_variables["session_var_postavshiki_update"] == 1){ ?>
        <li>
          <a href="<?php echo $postavshiki_item["actions_list"]["postavshiki_update"]; ?>"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> Редактировать</a>
        </li>
        <?php } ?>
        <?php if( $site_variables["session_var_postavshiki_delete"] == 1){ ?>
        <li>
          <a onclick="return confirm('Вы уверены что хотите удалить поставщика <?php echo $postavshiki_item["postavshiki_name"]; ?>?');" href="<?php echo $postavshiki_item["actions_list"]["postavshiki_delete"]; ?>"><i class="fa fa-times fa-lg fa-fw txt-color-red"></i> Удалить</a>
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
 <?php if( $site_variables["postavshiki_navigation"] == 1 ){ ?>  
 <div class="pagination">  
  <ul>  
   <?php if( $site_variables["postavshiki_num1"] > 1){ ?><li <?php if( $site_variables["postavshiki_page_num"] == 1){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["postavshiki_prev_url"]; ?>" class="ext_disabled"> < </a></li><?php } ?>  
   <?php if( $site_variables["postavshiki_num1"] > 0){ ?><li <?php if( $site_variables["postavshiki_page_num"] == $site_variables["postavshiki_num1"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["postavshiki_num_1_url"]; ?>" class="ext_disabled"><?php echo $site_variables["postavshiki_num1"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["postavshiki_num2"] > 0){ ?><li <?php if( $site_variables["postavshiki_page_num"] == $site_variables["postavshiki_num2"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["postavshiki_num_2_url"]; ?>" class="ext_disabled"><?php echo $site_variables["postavshiki_num2"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["postavshiki_num3"] > 0){ ?><li <?php if( $site_variables["postavshiki_page_num"] == $site_variables["postavshiki_num3"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["postavshiki_num_3_url"]; ?>" class="ext_disabled"><?php echo $site_variables["postavshiki_num3"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["postavshiki_last_num"] > 3){ ?><li class="disabled"><a href="#" class="ext_disabled">...</a></li><?php } ?> 
   <?php if( $site_variables["postavshiki_last_num"] != $site_variables["postavshiki_num3"]){ ?><li <?php if( $site_variables["postavshiki_page_num"] == $site_variables["postavshiki_last_num"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["postavshiki_last_url"]; ?>" class="ext_disabled"><?php echo $site_variables["postavshiki_last_num"]; ?></a></li><?php } ?> 
   <?php if( $site_variables["postavshiki_page_num"] < $site_variables["postavshiki_last_num"]){ ?><li><a href="<?php echo $site_variables["postavshiki_next_url"]; ?>" class="ext_disabled"> > </a></li><?php } ?>  
  </ul> 
 </div>  
 <?php } ?>  


     <?php if( $site_variables["postavshiki_create_link"] != "" && $site_variables["session_var_postavshiki_create"] == 1){ ?>
      <form action = "<?php echo $site_variables["postavshiki_create_link"]; ?>" method="post">  
      <button type="submit" class="btn btn-large btn-primary">Добавить нового поставщика</button>
      </form>
     <?php } ?>

