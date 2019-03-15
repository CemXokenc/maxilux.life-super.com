<?php if( $site_variables["session_var_activity_list"] == 1){ ?>
<?php if( $site_variables["system_messages"] != "" ){ ?>
  <div class="alert alert-success">
  <a class="close" data-dismiss="alert" href="#" aria-hidden="true">x</a>
  <?php echo $site_variables["system_messages"]; ?>
 </div>
<?php } ?>
<?php if( $site_variables["type_page"] != 1){ ?>
<form action="" method="post">
  <div class="btn-group display-inline pull-right text-align-left hidden-tablet" style="float: left !important;margin-bottom: 20px;">
    <button type="button" class="btn btn-xs btn-default" style="padding: 1px 3px;" onclick="$(this).next().toggle();">
      <i class="fa fa-cog fa-lg"></i> Фильтр
    </button>
    <div class="dropdown-menu dropdown-menu-xs pull-right" style="padding: 15px;width: 700px;left: 0px;">


    
      <div class="row">
        <div class="col-sm-6">
          <select name="manager" class="form-control" >
            <option value="">Выберите менеджера</option>
            <?php if( count($site_variables["managers"])>0){ ?>
            <?php foreach($site_variables["managers"] as $site_variables["manager"]){ ?>
            <option <?php if( $site_variables["session_var_zakaz_manager"] == $site_variables["manager"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["manager"]["id"]; ?>"><?php echo $site_variables["manager"]["first_name"]; ?> <?php echo $site_variables["manager"]["last_name"]; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>

      </div>
      <div class="row">
        <div class="col-sm-6">
          Дата:<br>
          C <div id="dp-ex-3" class="input-group date" data-auto-close="true" data-date="2014-01-01" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
            <input name="data_c" class="form-control" type="text" <?php if( $site_variables["session_var_zakaz_data_c"] != ""){ ?>value="<?php echo $site_variables["session_var_zakaz_data_c"]; ?>"<?php } ?>>
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
        <div class="col-sm-6">
          <br>До <div id="dp-ex-4" class="input-group date" data-auto-close="true" data-date="2014-01-01" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
            <input name="data_do" class="form-control" type="text" <?php if( $site_variables["session_var_zakaz_data_do"] != ""){ ?>value="<?php echo $site_variables["session_var_zakaz_data_do"]; ?>"<?php } ?>>
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <input class="form-control" placeholder="# заказа" type="text" id="order_num" name="order_num" value="<?php echo $site_variables["session_var_order_num"]; ?>">
        </div>
        <div class="col-sm-6">
          <select name="operaciya_id" class="form-control" >
            <option value="">Выберите операцию</option>
            <?php foreach($site_variables["operacii"] as $site_variables["operaciya"]){ ?>
            <option <?php if( $site_variables["session_var_operaciya_id"] == $site_variables["operaciya"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["operaciya"]["id"]; ?>"><?php echo $site_variables["operaciya"]["name"]; ?></option>
            <?php } ?>
          </select>
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
				            <th>Пользователь</th>
				            <th>Операция</th>
				            <th>Время операции</th>
				          </tr>
				        </thead>       
                                    <tbody>       
				          
                                         <?php if( count($site_variables["activity"])>0 ){ ?>
                                          <?php if(count($site_variables["activity"]) > 0){ ?>
 <?php   foreach($site_variables["activity"] as $activity_item){ ?>
<tr>
				            <td><?php if( $site_variables["session_var_user_view"] == 1){ ?><a href="<?php echo $activity_item["actions_list"]["view_user"]; ?>"><?php echo $activity_item["users_first_name"]; ?> <?php echo $activity_item["users_last_name"]; ?><br><?php echo $activity_item["users_name"]; ?></a><?php }else{ ?><?php echo $activity_item["users_first_name"]; ?> <?php echo $activity_item["users_last_name"]; ?><br><?php echo $activity_item["users_name"]; ?><?php } ?></td>
				            <td><?php echo $activity_item["operacii_name"]; ?></td>
                                            <td><?php echo $activity_item["activity_created"]; ?></td>
</tr> <?php   } ?>
 <?php } ?>

                                         <?php } ?>
				        </tbody>
				      </table>
 <?php if( $site_variables["activity_navigation"] == 1 ){ ?>  
 <div class="pagination">  
  <ul>  
   <?php if( $site_variables["activity_num1"] > 1){ ?><li <?php if( $site_variables["activity_page_num"] == 1){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["activity_prev_url"]; ?>" class="ext_disabled"> < </a></li><?php } ?>  
   <?php if( $site_variables["activity_num1"] > 0){ ?><li <?php if( $site_variables["activity_page_num"] == $site_variables["activity_num1"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["activity_num_1_url"]; ?>" class="ext_disabled"><?php echo $site_variables["activity_num1"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["activity_num2"] > 0){ ?><li <?php if( $site_variables["activity_page_num"] == $site_variables["activity_num2"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["activity_num_2_url"]; ?>" class="ext_disabled"><?php echo $site_variables["activity_num2"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["activity_num3"] > 0){ ?><li <?php if( $site_variables["activity_page_num"] == $site_variables["activity_num3"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["activity_num_3_url"]; ?>" class="ext_disabled"><?php echo $site_variables["activity_num3"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["activity_last_num"] > 3){ ?><li class="disabled"><a href="#" class="ext_disabled">...</a></li><?php } ?> 
   <?php if( $site_variables["activity_last_num"] != $site_variables["activity_num3"]){ ?><li <?php if( $site_variables["activity_page_num"] == $site_variables["activity_last_num"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["activity_last_url"]; ?>" class="ext_disabled"><?php echo $site_variables["activity_last_num"]; ?></a></li><?php } ?> 
   <?php if( $site_variables["activity_page_num"] < $site_variables["activity_last_num"]){ ?><li><a href="<?php echo $site_variables["activity_next_url"]; ?>" class="ext_disabled"> > </a></li><?php } ?>  
  </ul> 
 </div>  
 <?php } ?>  

<?php } ?>

