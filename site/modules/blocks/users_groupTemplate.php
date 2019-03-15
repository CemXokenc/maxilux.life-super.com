<?php if( $site_variables["system_messages"] != "" ){ ?>
  <div class="alert alert-success">
  <a class="close" data-dismiss="alert" href="#" aria-hidden="true">x</a>
  <?php echo $site_variables["system_messages"]; ?>
 </div>
<?php } ?>

<table class="table table-bordered">
				        <thead>
				          <tr>
				            <th>Название</th>
                                            <th>Тип</th>
                                            <?php if( $site_variables["session_var_userstypes_delete"] == 1 || $site_variables["session_var_userstypes_update"] == 1){ ?><th style="width:23px;"> </th><?php } ?>
				          </tr>
				        </thead>       
                                    <tbody>       
				          
                                         <?php if( count($site_variables["users_group"])>0 ){ ?>
                                          <?php if(count($site_variables["users_group"]) > 0){ ?>
 <?php   foreach($site_variables["users_group"] as $users_group_item){ ?>
<tr>
	                                   <td><?php echo $users_group_item["users_group_name"]; ?></td>
                                           <td><?php echo $users_group_item["users_group_type"]; ?></td>
			     <?php if( $site_variables["session_var_userstypes_delete"] == 1 || $site_variables["session_var_userstypes_update"] == 1){ ?>
                  <td>
                      <div class="btn-group display-inline pull-right text-align-left hidden-tablet">
                          <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" style="padding: 1px 3px;">
                              <i class="fa fa-cog fa-lg"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-xs pull-right">
                              <?php if( $site_variables["session_var_userstypes_update"] == 1){ ?>
                              <li>
                                  <a href="<?php echo $users_group_item["actions_list"]["users_group_update"]; ?>"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> Редактировать</a>
                              </li>
                              <?php } ?>
                              <?php if( $site_variables["session_var_userstypes_delete"] == 1){ ?>
                              <li>
                                  <a onclick="return confirm('Вы уверены что хотите удалить тип <?php echo $users_group_item["users_group_name"]; ?>?');" href="<?php echo $users_group_item["actions_list"]["users_group_delete"]; ?>"><i class="fa fa-times fa-lg fa-fw txt-color-red"></i> Удалить</a>
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
 <?php if( $site_variables["users_group_navigation"] == 1 ){ ?>  
 <div class="pagination">  
  <ul>  
   <?php if( $site_variables["users_group_num1"] > 1){ ?><li <?php if( $site_variables["users_group_page_num"] == 1){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["users_group_prev_url"]; ?>" class="ext_disabled"> < </a></li><?php } ?>  
   <?php if( $site_variables["users_group_num1"] > 0){ ?><li <?php if( $site_variables["users_group_page_num"] == $site_variables["users_group_num1"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["users_group_num_1_url"]; ?>" class="ext_disabled"><?php echo $site_variables["users_group_num1"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["users_group_num2"] > 0){ ?><li <?php if( $site_variables["users_group_page_num"] == $site_variables["users_group_num2"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["users_group_num_2_url"]; ?>" class="ext_disabled"><?php echo $site_variables["users_group_num2"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["users_group_num3"] > 0){ ?><li <?php if( $site_variables["users_group_page_num"] == $site_variables["users_group_num3"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["users_group_num_3_url"]; ?>" class="ext_disabled"><?php echo $site_variables["users_group_num3"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["users_group_last_num"] > 3){ ?><li class="disabled"><a href="#" class="ext_disabled">...</a></li><?php } ?> 
   <?php if( $site_variables["users_group_last_num"] != $site_variables["users_group_num3"]){ ?><li <?php if( $site_variables["users_group_page_num"] == $site_variables["users_group_last_num"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["users_group_last_url"]; ?>" class="ext_disabled"><?php echo $site_variables["users_group_last_num"]; ?></a></li><?php } ?> 
   <?php if( $site_variables["users_group_page_num"] < $site_variables["users_group_last_num"]){ ?><li><a href="<?php echo $site_variables["users_group_next_url"]; ?>" class="ext_disabled"> > </a></li><?php } ?>  
  </ul> 
 </div>  
 <?php } ?>  


     <?php if( $site_variables["users_group_create_link"] != "" && $site_variables["session_var_userstypes_create"] == 1){ ?>
      <form action = "<?php echo $site_variables["users_group_create_link"]; ?>" method="post">  
      <button type="submit" class="btn btn-large btn-primary">Добавить нового типа пользователя</button>
      </form>
     <?php } ?>

