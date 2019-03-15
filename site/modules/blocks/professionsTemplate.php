<table class="table table-bordered">
				        <thead>
				          <tr>
				            <th>Название должности</th>
				            <th>Ставка</th>
				            <th>Бонус</th>
				            <th>В час</th>
				            <th>Сдельная</th>
<?php if( $site_variables["session_var_professions_delete"] == 1 || $site_variables["session_var_professions_update"] == 1){ ?><th style="width:23px;"> </th><?php } ?>
				          </tr>
				        </thead>       
                                    <tbody>       
				          
                                         <?php if( count($site_variables["professions"])>0 ){ ?>
                                          <?php if(count($site_variables["professions"]) > 0){ ?>
 <?php   foreach($site_variables["professions"] as $professions_item){ ?>
<tr>

                                            <td><?php echo $professions_item["professions_name"]; ?></td>
                                            <td><?php if( $professions_item["professions_stavka"] != 0){ ?><?php echo $professions_item["professions_stavka"]; ?><?php }else{ ?>Отсутствует<?php } ?></td>
                                            <td><?php if( $professions_item["professions_bonus"] != 0){ ?><?php echo $professions_item["professions_bonus"]; ?><?php }else{ ?>Отсутствует<?php } ?></td>
                                            <td><?php if( $professions_item["professions_vchas"] != 0){ ?><?php echo $professions_item["professions_vchas"]; ?><?php }else{ ?>Отсутствует<?php } ?></td>
                                            <td><?php if( $professions_item["professions_sdelnaya"] != 0){ ?><?php echo $professions_item["professions_sdelnaya"]; ?><?php }else{ ?>Отсутствует<?php } ?></td>                        
<?php if( $site_variables["session_var_professions_delete"] == 1 || $site_variables["session_var_professions_update"] == 1){ ?>                            <td>
                                <div class="btn-group display-inline pull-right text-align-left hidden-tablet">
                                    <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" style="padding: 1px 3px;">
                                        <i class="fa fa-cog fa-lg"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-xs pull-right">
<?php if( $site_variables["session_var_professions_update"] == 1){ ?>   
                                        <li>
                                            <a href="<?php echo $professions_item["actions_list"]["professions_update"]; ?>"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> Редактировать</a>
                                        </li>
<?php } ?>  
<?php if( $site_variables["session_var_professions_delete"] == 1){ ?>                                      
                                        <li>
                                            <a onclick="return confirm('Вы уверены что хотите удалить должность <?php echo $professions_item["professions_name"]; ?>?');" href="<?php echo $professions_item["actions_list"]["professions_delete"]; ?>"><i class="fa fa-times fa-lg fa-fw txt-color-red"></i> Удалить</a>
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
 <?php if( $site_variables["professions_navigation"] == 1 ){ ?>  
 <div class="pagination">  
  <ul>  
   <?php if( $site_variables["professions_num1"] > 1){ ?><li <?php if( $site_variables["professions_page_num"] == 1){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["professions_prev_url"]; ?>" class="ext_disabled"> < </a></li><?php } ?>  
   <?php if( $site_variables["professions_num1"] > 0){ ?><li <?php if( $site_variables["professions_page_num"] == $site_variables["professions_num1"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["professions_num_1_url"]; ?>" class="ext_disabled"><?php echo $site_variables["professions_num1"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["professions_num2"] > 0){ ?><li <?php if( $site_variables["professions_page_num"] == $site_variables["professions_num2"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["professions_num_2_url"]; ?>" class="ext_disabled"><?php echo $site_variables["professions_num2"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["professions_num3"] > 0){ ?><li <?php if( $site_variables["professions_page_num"] == $site_variables["professions_num3"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["professions_num_3_url"]; ?>" class="ext_disabled"><?php echo $site_variables["professions_num3"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["professions_last_num"] > 3){ ?><li class="disabled"><a href="#" class="ext_disabled">...</a></li><?php } ?> 
   <?php if( $site_variables["professions_last_num"] != $site_variables["professions_num3"]){ ?><li <?php if( $site_variables["professions_page_num"] == $site_variables["professions_last_num"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["professions_last_url"]; ?>" class="ext_disabled"><?php echo $site_variables["professions_last_num"]; ?></a></li><?php } ?> 
   <?php if( $site_variables["professions_page_num"] < $site_variables["professions_last_num"]){ ?><li><a href="<?php echo $site_variables["professions_next_url"]; ?>" class="ext_disabled"> > </a></li><?php } ?>  
  </ul> 
 </div>  
 <?php } ?>  


     <?php if( $site_variables["professions_create_link"] != "" && $site_variables["session_var_professions_create"] == 1){ ?>
      <form action = "<?php echo $site_variables["professions_create_link"]; ?>" method="post">  
      <button type="submit" class="btn btn-large btn-primary">Добавить новую должность</button>
      </form>
     <?php } ?>

