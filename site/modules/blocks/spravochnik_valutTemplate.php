<table class="table table-bordered">
				        <thead>
				          <tr>
				            <th>Название валюты</th>
                                            <th>Код валюты</th>
                                            <th>Курс валюты</th>
                                            <th></th>
				        </thead>       
                                    <tbody>       
				          
                                         <?php if( count($site_variables["spravochnik_valut"])>0 ){ ?>
                                          <?php if(count($site_variables["spravochnik_valut"]) > 0){ ?>
 <?php   foreach($site_variables["spravochnik_valut"] as $spravochnik_valut_item){ ?>
<tr>
	                                   <td><?php echo $spravochnik_valut_item["currencies_name"]; ?></td>
                                             <td><?php echo $spravochnik_valut_item["currencies_kod_valuty"]; ?></td>
                                            <td><?php echo $spravochnik_valut_item["currencies_rate"]; ?></td>              
<td>
                                <div class="btn-group display-inline pull-right text-align-left hidden-tablet">
                                    <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" style="padding: 1px 3px;">
                                        <i class="fa fa-cog fa-lg"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-xs pull-right">

                                        <li>
                                            <a href="<?php echo $spravochnik_valut_item["actions_list"]["spravochnik_valut_update"]; ?>"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> Редактировать</a>
                                        </li>


                                        <li>
                                            <a onclick="return confirm('Вы уверены что хотите удалить этот курс?');" href="<?php echo $spravochnik_valut_item["actions_list"]["spravochnik_valut_delete"]; ?>"><i class="fa fa-times fa-lg fa-fw txt-color-red"></i> Удалить</a>
                                        </li>
        
       
                                    </ul>
                                </div>
                            </td>                   
  </tr> <?php   } ?>
 <?php } ?>

                                         <?php } ?>
				        </tbody>
				      </table>
 <?php if( $site_variables["spravochnik_valut_navigation"] == 1 ){ ?>  
 <div class="pagination">  
  <ul>  
   <?php if( $site_variables["spravochnik_valut_num1"] > 1){ ?><li <?php if( $site_variables["spravochnik_valut_page_num"] == 1){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["spravochnik_valut_prev_url"]; ?>" class="ext_disabled"> < </a></li><?php } ?>  
   <?php if( $site_variables["spravochnik_valut_num1"] > 0){ ?><li <?php if( $site_variables["spravochnik_valut_page_num"] == $site_variables["spravochnik_valut_num1"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["spravochnik_valut_num_1_url"]; ?>" class="ext_disabled"><?php echo $site_variables["spravochnik_valut_num1"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["spravochnik_valut_num2"] > 0){ ?><li <?php if( $site_variables["spravochnik_valut_page_num"] == $site_variables["spravochnik_valut_num2"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["spravochnik_valut_num_2_url"]; ?>" class="ext_disabled"><?php echo $site_variables["spravochnik_valut_num2"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["spravochnik_valut_num3"] > 0){ ?><li <?php if( $site_variables["spravochnik_valut_page_num"] == $site_variables["spravochnik_valut_num3"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["spravochnik_valut_num_3_url"]; ?>" class="ext_disabled"><?php echo $site_variables["spravochnik_valut_num3"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["spravochnik_valut_last_num"] > 3){ ?><li class="disabled"><a href="#" class="ext_disabled">...</a></li><?php } ?> 
   <?php if( $site_variables["spravochnik_valut_last_num"] != $site_variables["spravochnik_valut_num3"]){ ?><li <?php if( $site_variables["spravochnik_valut_page_num"] == $site_variables["spravochnik_valut_last_num"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["spravochnik_valut_last_url"]; ?>" class="ext_disabled"><?php echo $site_variables["spravochnik_valut_last_num"]; ?></a></li><?php } ?> 
   <?php if( $site_variables["spravochnik_valut_page_num"] < $site_variables["spravochnik_valut_last_num"]){ ?><li><a href="<?php echo $site_variables["spravochnik_valut_next_url"]; ?>" class="ext_disabled"> > </a></li><?php } ?>  
  </ul> 
 </div>  
 <?php } ?>  


      <form action = "<?php echo $site_variables["spravochnik_valut_create_link"]; ?>" method="post">  
      <button type="submit" class="btn btn-large btn-primary">Добавить валюту</button>
      </form>

