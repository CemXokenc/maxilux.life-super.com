<?php if( $site_variables["view_worker"] != 1){ ?>
<form action="" method="post">
  <div class="btn-group display-inline pull-right text-align-left hidden-tablet" style="float: left !important;margin-bottom: 20px;">
    <button type="button" class="btn btn-xs btn-default" style="padding: 1px 3px;" onclick="$(this).next().toggle();">
      <i class="fa fa-cog fa-lg"></i> Фильтр
    </button>
    <div class="dropdown-menu dropdown-menu-xs pull-right" style="padding: 15px;width: 700px;left: 0px;">


      <div class="row">
  
        <div class="col-sm-6">
          <select s name="profession_id" class="form-control" >
            <option value="">Выберите должность</option>
            <?php if( count($site_variables["professions_db"])>0){ ?>
            <?php foreach($site_variables["professions_db"] as $site_variables["profession"]){ ?>
            <option <?php if( $site_variables["session_var_activity_workers_profession_id"] == $site_variables["profession"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["profession"]["id"]; ?>"><?php echo $site_variables["profession"]["name"]; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>



      </div>
      <div class="row">
        <div class="col-sm-6">
          <select s name="worker_id" class="form-control" >
            <option value="">Выберите работника</option>
            <?php if( count($site_variables["workers_db"])>0){ ?>
            <?php foreach($site_variables["workers_db"] as $site_variables["worker"]){ ?>
            <option <?php if( $site_variables["session_var_zakaz_manager"] == $site_variables["worker"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["worker"]["id"]; ?>"><?php echo $site_variables["worker"]["fio"]; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
      </div>
      
      <div class="row">
       
         <div class="col-sm-2" style="width: 340px;">
           <input type="text" name="nomer_zakaza" class="form-control" value="<?php echo $site_variables["session_var_activity_workers_nomer_zakaza"]; ?>" placeholder="Поиск по номеру заказа" />
         </div>
      </div>

      <button type="submit" name="cmd" class="btn btn-default">Фильтровать</button>
    </div>

  </div>
</form>
<?php } ?>
<table class="table table-bordered">
				        <thead>
				          <tr>
				            <th>Номер заказа</th>
				            <th>Работник</th>
				            <th>Должность</th>
				            <th>Операция</th>
				            <th>Время операции</th>
				          </tr>
				        </thead>       
                                    <tbody>       
				          
                                         <?php if( count($site_variables["activity_workers"]) > 0){ ?>
                                          <?php if(count($site_variables["activity_workers"]) > 0){ ?>
 <?php   foreach($site_variables["activity_workers"] as $activity_workers_item){ ?>
<tr>
  <td><a href="<?php echo $activity_workers_item["order_view_url"]; ?>"><?php echo $activity_workers_item["orders_nomer"]; ?></a></td>
  <td><?php echo $activity_workers_item["workers_fio"]; ?></td>
  <td><?php echo $activity_workers_item["professions_name"]; ?></td>
  <td><?php echo $activity_workers_item["category_statuses_name"]; ?></td>
  <td><?php echo $activity_workers_item["order_product_statused_created"]; ?></td>
</tr> <?php   } ?>
 <?php } ?>

                                         <?php } ?>
				        </tbody>
				      </table>
 <?php if( $site_variables["activity_workers_navigation"] == 1 ){ ?>  
 <div class="pagination">  
  <ul>  
   <?php if( $site_variables["activity_workers_num1"] > 1){ ?><li <?php if( $site_variables["activity_workers_page_num"] == 1){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["activity_workers_prev_url"]; ?>" class="ext_disabled"> < </a></li><?php } ?>  
   <?php if( $site_variables["activity_workers_num1"] > 0){ ?><li <?php if( $site_variables["activity_workers_page_num"] == $site_variables["activity_workers_num1"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["activity_workers_num_1_url"]; ?>" class="ext_disabled"><?php echo $site_variables["activity_workers_num1"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["activity_workers_num2"] > 0){ ?><li <?php if( $site_variables["activity_workers_page_num"] == $site_variables["activity_workers_num2"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["activity_workers_num_2_url"]; ?>" class="ext_disabled"><?php echo $site_variables["activity_workers_num2"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["activity_workers_num3"] > 0){ ?><li <?php if( $site_variables["activity_workers_page_num"] == $site_variables["activity_workers_num3"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["activity_workers_num_3_url"]; ?>" class="ext_disabled"><?php echo $site_variables["activity_workers_num3"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["activity_workers_last_num"] > 3){ ?><li class="disabled"><a href="#" class="ext_disabled">...</a></li><?php } ?> 
   <?php if( $site_variables["activity_workers_last_num"] != $site_variables["activity_workers_num3"]){ ?><li <?php if( $site_variables["activity_workers_page_num"] == $site_variables["activity_workers_last_num"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["activity_workers_last_url"]; ?>" class="ext_disabled"><?php echo $site_variables["activity_workers_last_num"]; ?></a></li><?php } ?> 
   <?php if( $site_variables["activity_workers_page_num"] < $site_variables["activity_workers_last_num"]){ ?><li><a href="<?php echo $site_variables["activity_workers_next_url"]; ?>" class="ext_disabled"> > </a></li><?php } ?>  
  </ul> 
 </div>  
 <?php } ?>  


