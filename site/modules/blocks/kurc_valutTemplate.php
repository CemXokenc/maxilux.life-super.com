<form action="" method="post">
  <div class="btn-group display-inline pull-right text-align-left hidden-tablet" style="float: left !important;margin-bottom: 20px;">
    <button type="button" class="btn btn-xs btn-default" style="padding: 1px 3px;" onclick="$(this).next().toggle();">
      <i class="fa fa-cog fa-lg"></i> Фильтр
    </button>
    <div class="dropdown-menu dropdown-menu-xs pull-right" style="padding: 15px;width: 700px;left: 0px;">

 <div class="row">
         <div class="col-sm-6">
         <select id="valuty" name="valuty" style="margin-left: 20px;">
        <option  value="">Валюта товара</option>
       <?php foreach($site_variables["valuty"] as $site_variables["item"]){ ?>
      <option <?php if( $site_variables["item"]["kod_valuty"]== $site_variables["session_var_kurc_valut_valyta"]){ ?>selected<?php } ?> value="<?php echo $site_variables["item"]["kod_valuty"]; ?>"><?php echo $site_variables["item"]["name"]; ?></option>
      <?php } ?>
     </select>
        </div>
 </div>
    
	
	 <div class="row">
        <div class="col-sm-6">
          Дата:<br>
          C <div id="dp-ex-3" class="input-group date" data-auto-close="true" data-date="2014-01-01" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
            <input name="data_c" class="form-control" type="text" <?php if( $site_variables["session_var_kurc_valut_data_c"] != ""){ ?>value="<?php echo $site_variables["session_var_kurc_valut_data_c"]; ?>"<?php } ?>>
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
        <div class="col-sm-6">
          <br>До <div id="dp-ex-4" class="input-group date" data-auto-close="true" data-date="2014-01-01" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
            <input name="data_do" class="form-control" type="text" <?php if( $site_variables["session_var_kurc_valut_data_do"] != ""){ ?>value="<?php echo $site_variables["session_var_kurc_valut_data_do"]; ?>"<?php } ?>>
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
      </div>


 
      <button type="submit" name="cmd" class="btn btn-default">Фильтровать</button>
    </div>

  </div>
</form>
<div class="clear"></div>
<table class="table table-bordered">
				        <thead>
				          <tr>
				            <th>Дата</th>
                                            <th>Валюта</th>
                                            <th>Курс</th>
				        </thead>       
                                    <tbody>       
				          
                                         <?php if( count($site_variables["kurc_valut"])>0 ){ ?>
                                          <?php if(count($site_variables["kurc_valut"]) > 0){ ?>
 <?php   foreach($site_variables["kurc_valut"] as $kurc_valut_item){ ?>
<tr>
	                                   <td><?php echo $kurc_valut_item["kurc_valut_currency_date"]; ?></td>
                                             <td><?php echo $kurc_valut_item["kurc_valut_valuta"]; ?></td>
                                            <td><?php echo $kurc_valut_item["kurc_valut_rate"]; ?></td>
                                           
				          </tr> <?php   } ?>
 <?php } ?>

                                         <?php } ?>
				        </tbody>
				      </table>
 <?php if( $site_variables["kurc_valut_navigation"] == 1 ){ ?>  
 <div class="pagination">  
  <ul>  
   <?php if( $site_variables["kurc_valut_num1"] > 1){ ?><li <?php if( $site_variables["kurc_valut_page_num"] == 1){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["kurc_valut_prev_url"]; ?>" class="ext_disabled"> < </a></li><?php } ?>  
   <?php if( $site_variables["kurc_valut_num1"] > 0){ ?><li <?php if( $site_variables["kurc_valut_page_num"] == $site_variables["kurc_valut_num1"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["kurc_valut_num_1_url"]; ?>" class="ext_disabled"><?php echo $site_variables["kurc_valut_num1"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["kurc_valut_num2"] > 0){ ?><li <?php if( $site_variables["kurc_valut_page_num"] == $site_variables["kurc_valut_num2"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["kurc_valut_num_2_url"]; ?>" class="ext_disabled"><?php echo $site_variables["kurc_valut_num2"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["kurc_valut_num3"] > 0){ ?><li <?php if( $site_variables["kurc_valut_page_num"] == $site_variables["kurc_valut_num3"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["kurc_valut_num_3_url"]; ?>" class="ext_disabled"><?php echo $site_variables["kurc_valut_num3"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["kurc_valut_last_num"] > 3){ ?><li class="disabled"><a href="#" class="ext_disabled">...</a></li><?php } ?> 
   <?php if( $site_variables["kurc_valut_last_num"] != $site_variables["kurc_valut_num3"]){ ?><li <?php if( $site_variables["kurc_valut_page_num"] == $site_variables["kurc_valut_last_num"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["kurc_valut_last_url"]; ?>" class="ext_disabled"><?php echo $site_variables["kurc_valut_last_num"]; ?></a></li><?php } ?> 
   <?php if( $site_variables["kurc_valut_page_num"] < $site_variables["kurc_valut_last_num"]){ ?><li><a href="<?php echo $site_variables["kurc_valut_next_url"]; ?>" class="ext_disabled"> > </a></li><?php } ?>  
  </ul> 
 </div>  
 <?php } ?>  

<?php if( $site_variables["session_var_kurc_valut_create"] == 1){ ?>
      <form action = "<?php echo $site_variables["kurc_valut_create_link"]; ?>" method="post" style = "margin-bottom: 20px;">  
      <button type="submit" class="btn btn-large btn-primary">Текущий курс валют</button>
      </form>
     <?php } ?>
<div class="clear"></div>
<?php echo $site_variables["graph_code"]; ?>

