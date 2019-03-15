<form action="" method="post">
  <div class="btn-group display-inline pull-right text-align-left hidden-tablet" style="float: left !important;margin-bottom: 20px;">
    <button type="button" class="btn btn-xs btn-default" style="padding: 1px 3px;" onclick="$(this).next().toggle();">
      <i class="fa fa-cog fa-lg"></i> Фильтр
    </button>
    <div class="dropdown-menu dropdown-menu-xs pull-right" style="padding: 15px;width: 700px;left: 0px;">


      <div class="row">

        <div class="col-sm-2" style="width: 340px;">
          Поиск по должности
          <select  name="profession" class="form-control" >
            <option value="0">Выберите должность</option>
            <?php if( count($site_variables["professions"])>0){ ?>
            <?php foreach($site_variables["professions"] as $site_variables["profession"]){ ?>
            <option <?php if( $site_variables["session_var_workers_profession"] == $site_variables["profession"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["profession"]["id"]; ?>"><?php echo $site_variables["profession"]["name"]; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
       <div class="col-sm-2" style="width: 340px;">
           <br>
           <input type="text" name="fio" class="form-control" value="<?php echo $site_variables["session_var_workers_name_worker"]; ?>" placeholder="Поиск по ФИО работника" />
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
				            <th>ФИО</th>
                                            <th>Контакты</th>
                                            <th>Должность</th>
                                            <th>Ставка</th>
                                            <th>Бонус</th>
                                            <th>В час</th>
                                            <th>Сдельная</th>
                                            <?php if( $site_variables["session_var_workers_create"] == 1 || $site_variables["session_var_workers_update"] == 1){ ?> <th style="width:23px;"> </th><?php } ?>
				          </tr>
				        </thead>       
                                    <tbody>       
				          
                                         <?php if( count($site_variables["workers"])>0 ){ ?>
                                          <?php if(count($site_variables["workers"]) > 0){ ?>
 <?php   foreach($site_variables["workers"] as $workers_item){ ?>
<tr>
  <td>
    <a href="<?php if( $site_variables["session_var_workers_view"] == 1){ ?><?php echo $workers_item["actions_list"]["view_worker"]; ?><?php } ?>">
      <img width="80" src="<?php echo $site_variables["template_dir"]; ?>/img/worker/<?php if( $workers_item["workers_img"] > 0){ ?><?php echo $workers_item["workers_id"]; ?><?php }else{ ?>no_img<?php } ?>.jpg">
    </a>
  </td>
  <td><?php if( $site_variables["session_var_workers_view"] == 1){ ?><a href="<?php echo $workers_item["actions_list"]["view_worker"]; ?>"><?php echo $workers_item["workers_fio"]; ?></a><?php }else{ ?><?php echo $workers_item["workers_fio"]; ?><?php } ?></td>
  <td><?php echo $workers_item["workers_email"]; ?><br><?php echo $workers_item["workers_telephone"]; ?>,<?php echo $workers_item["workers_telephone1"]; ?></td>
  <td><?php echo $workers_item["professions_name"]; ?></td>
  <td><?php echo $workers_item["workers_stavka"]; ?></td>
  <td><?php echo $workers_item["workers_bonus"]; ?></td>
  <td><?php echo $workers_item["workers_vchas"]; ?></td>
  <td><?php echo $workers_item["workers_sdelnaya"]; ?></td>
<?php if( $site_variables["session_var_workers_create"] == 1 || $site_variables["session_var_workers_update"] == 1){ ?> 
  <td>
    <div class="btn-group display-inline pull-right text-align-left hidden-tablet">
      <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" style="padding: 1px 3px;">
        <i class="fa fa-cog fa-lg"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-xs pull-right">
<?php if( $site_variables["session_var_workers_view"] == 1){ ?> 
        <li>
          <a href="<?php echo $workers_item["actions_list"]["view_worker"]; ?>"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> Просмотр</a>
        </li>
<?php } ?>
<?php if( $site_variables["session_var_workers_update"] == 1){ ?> 
        <li>
          <a href="<?php echo $workers_item["actions_list"]["workers_update"]; ?>"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> Редактировать</a>
        </li>
<?php } ?>
<?php if( $site_variables["session_var_workers_delete"] == 1){ ?> 
        <li>
          <a onclick="return confirm('Вы уверены что хотите удалить работника <?php echo $workers_item["workers_fio"]; ?>?');" href="<?php echo $workers_item["actions_list"]["workers_delete"]; ?>"><i class="fa fa-times fa-lg fa-fw txt-color-red"></i> Удалить</a>
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
 <?php if( $site_variables["workers_navigation"] == 1 ){ ?>  
 <div class="pagination">  
  <ul>  
   <?php if( $site_variables["workers_num1"] > 1){ ?><li <?php if( $site_variables["workers_page_num"] == 1){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["workers_prev_url"]; ?>" class="ext_disabled"> < </a></li><?php } ?>  
   <?php if( $site_variables["workers_num1"] > 0){ ?><li <?php if( $site_variables["workers_page_num"] == $site_variables["workers_num1"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["workers_num_1_url"]; ?>" class="ext_disabled"><?php echo $site_variables["workers_num1"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["workers_num2"] > 0){ ?><li <?php if( $site_variables["workers_page_num"] == $site_variables["workers_num2"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["workers_num_2_url"]; ?>" class="ext_disabled"><?php echo $site_variables["workers_num2"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["workers_num3"] > 0){ ?><li <?php if( $site_variables["workers_page_num"] == $site_variables["workers_num3"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["workers_num_3_url"]; ?>" class="ext_disabled"><?php echo $site_variables["workers_num3"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["workers_last_num"] > 3){ ?><li class="disabled"><a href="#" class="ext_disabled">...</a></li><?php } ?> 
   <?php if( $site_variables["workers_last_num"] != $site_variables["workers_num3"]){ ?><li <?php if( $site_variables["workers_page_num"] == $site_variables["workers_last_num"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["workers_last_url"]; ?>" class="ext_disabled"><?php echo $site_variables["workers_last_num"]; ?></a></li><?php } ?> 
   <?php if( $site_variables["workers_page_num"] < $site_variables["workers_last_num"]){ ?><li><a href="<?php echo $site_variables["workers_next_url"]; ?>" class="ext_disabled"> > </a></li><?php } ?>  
  </ul> 
 </div>  
 <?php } ?>  


     <?php if( $site_variables["workers_create_link"] != "" && $site_variables["session_var_workers_create"] == 1){ ?>
      <form action = "<?php echo $site_variables["workers_create_link"]; ?>" method="post">  
      <button type="submit" class="btn btn-large btn-primary">Добавить нового работника</button>
      </form>
     <?php } ?>

