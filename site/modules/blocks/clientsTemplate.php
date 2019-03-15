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
           <input type="text" name="name" class="form-control" value="<?php echo $site_variables["name_user"]; ?>" placeholder="Поиск по ФИО пользователя" />
         </div>
         <div class="col-sm-2" style="width: 340px;">
           <input type="text" name="email" class="form-control" value="<?php echo $site_variables["email_user"]; ?>" placeholder="Поиск по Емеилу пользователя" />
         </div>
       </div>

       <div class="row">
         <div class="col-sm-2" style="width: 340px;">
           <input type="text" class="form-control" name="telephone" value="<?php echo $site_variables["telephone_user"]; ?>" placeholder="Поиск по телефону пользователя"/>
         </div>
         <div class="col-sm-2" style="width: 340px;">
         <?php if( $site_variables["session_var_user_type"] != "12" ){ ?>
           <select s name="torg_tchk" class="form-control" >
             <option selected value="0">Выберите Торговую точку</option>
             <?php if( count($site_variables["torg_tochki"])>0){ ?>
             <?php foreach($site_variables["torg_tochki"] as $site_variables["torg_tochka"]){ ?>
             <option <?php if( $site_variables["torg_tochka_user"] == $site_variables["torg_tochka"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["torg_tochka"]["id"]; ?>"><?php echo $site_variables["torg_tochka"]["name"]; ?></option>
             <?php } ?>
             <?php } ?>
           </select>
         <?php } ?>
         </div>
       </div>

       <div class="row">
         <div class="col-sm-6">
          <select name="skidka" class="form-control" >
            <option value="">Выберите скидку</option>
            <?php foreach($site_variables["skidki_db"] as $site_variables["skidka"]){ ?>
             <?php if( $site_variables["skidka"]["name"] != ""){ ?><option <?php if( $site_variables["session_var_client_skidka"] == $site_variables["skidka"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["skidka"]["id"]; ?>"><?php echo $site_variables["skidka"]["name"]; ?></option><?php } ?>
            <?php } ?>
          </select>
        </div>
        </div>


       <div class="row">
         <div class="col-sm-2" style="width: 340px;">
           <select name="order_by_column">
             <option value="">Сортировать по</option>
             <option value="fio">ФИО</option>
             <option value="email">Емеил</option>
             <option value="telephone">Телефон 1</option>
             <option value="telephone1">Телефон 2</option>
             <option value="telephone2">Телефон 3</option>
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
				            <th>ФИО</th>
                                            <th>E-mail</th>
                                            <th>Телефон</th>
                                            <th>Телефон1</th>
                                            <th>Телефон2</th>
                                            <th>Сумма заказов</th>
                                            <?php if( $site_variables["session_var_clients_delete"] == 1 || $site_variables["session_var_clients_update"] == 1){ ?><th style="width:23px;"> </th><?php } ?>
				          </tr>
				        </thead>       
                                    <tbody>       
				          
                                         <?php if( count($site_variables["clients"])>0 ){ ?>
                                          <?php if(count($site_variables["clients"]) > 0){ ?>
 <?php   foreach($site_variables["clients"] as $clients_item){ ?>
<tr>
  <td>
    <a href="<?php if( $site_variables["session_var_client_view"] == 1){ ?><?php echo $clients_item["actions_list"]["view_client"]; ?><?php } ?>">
      <img width="80" src="<?php echo $site_variables["template_dir"]; ?>/img/clients/<?php if( $clients_item["clients_img"] > 0){ ?><?php echo $clients_item["clients_id"]; ?><?php }else{ ?>no_img<?php } ?>.jpg">
    </a>
  </td>
  <td><?php if( $site_variables["session_var_client_view"]){ ?><a href="<?php echo $clients_item["actions_list"]["view_client"]; ?>"><?php echo $clients_item["clients_fio"]; ?></a><?php }else{ ?><?php echo $clients_item["clients_fio"]; ?><?php } ?></td>
  <td><?php echo $clients_item["clients_email"]; ?></td>
  <td><?php echo $clients_item["clients_telephone"]; ?></td>
  <td><?php echo $clients_item["clients_telephone1"]; ?></td>
  <td><?php echo $clients_item["clients_telephone2"]; ?></td>
  <td><?php echo $clients_item["clients_sum_zakazov"]; ?></td>
  <?php if( $site_variables["session_var_clients_delete"] == 1 || $site_variables["session_var_clients_update"] == 1){ ?>
  <td>
    <div class="btn-group display-inline pull-right text-align-left hidden-tablet">
      <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" style="padding: 1px 3px;">
        <i class="fa fa-cog fa-lg"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-xs pull-right">
        <?php if( $site_variables["session_var_client_view"] == 1){ ?>
        <li>
          <a href="<?php echo $clients_item["actions_list"]["view_client"]; ?>"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> Просмотр</a>
        </li>
     <?php } ?>
        <?php if( $site_variables["session_var_clients_update"] == 1){ ?>
        <li>
          <a href="<?php echo $clients_item["actions_list"]["clients_update"]; ?>"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> Редактировать</a>
        </li>
        <?php } ?>
        <?php if( $site_variables["session_var_clients_delete"] == 1){ ?>
        <li>
          <a onclick="return confirm('Вы уверены что хотите удалить клиента <?php echo $clients_item["clients_fio"]; ?>?');" href="<?php echo $clients_item["actions_list"]["clients_delete"]; ?>"><i class="fa fa-times fa-lg fa-fw txt-color-red"></i> Удалить</a>
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
 <?php if( $site_variables["clients_navigation"] == 1 ){ ?>  
 <div class="pagination">  
  <ul>  
   <?php if( $site_variables["clients_num1"] > 1){ ?><li <?php if( $site_variables["clients_page_num"] == 1){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["clients_prev_url"]; ?>" class="ext_disabled"> < </a></li><?php } ?>  
   <?php if( $site_variables["clients_num1"] > 0){ ?><li <?php if( $site_variables["clients_page_num"] == $site_variables["clients_num1"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["clients_num_1_url"]; ?>" class="ext_disabled"><?php echo $site_variables["clients_num1"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["clients_num2"] > 0){ ?><li <?php if( $site_variables["clients_page_num"] == $site_variables["clients_num2"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["clients_num_2_url"]; ?>" class="ext_disabled"><?php echo $site_variables["clients_num2"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["clients_num3"] > 0){ ?><li <?php if( $site_variables["clients_page_num"] == $site_variables["clients_num3"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["clients_num_3_url"]; ?>" class="ext_disabled"><?php echo $site_variables["clients_num3"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["clients_last_num"] > 3){ ?><li class="disabled"><a href="#" class="ext_disabled">...</a></li><?php } ?> 
   <?php if( $site_variables["clients_last_num"] != $site_variables["clients_num3"]){ ?><li <?php if( $site_variables["clients_page_num"] == $site_variables["clients_last_num"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["clients_last_url"]; ?>" class="ext_disabled"><?php echo $site_variables["clients_last_num"]; ?></a></li><?php } ?> 
   <?php if( $site_variables["clients_page_num"] < $site_variables["clients_last_num"]){ ?><li><a href="<?php echo $site_variables["clients_next_url"]; ?>" class="ext_disabled"> > </a></li><?php } ?>  
  </ul> 
 </div>  
 <?php } ?>  


     <?php if( $site_variables["clients_create_link"] != "" && $site_variables["session_var_clients_create"] == 1){ ?>
      <form action = "<?php echo $site_variables["clients_create_link"]; ?>" method="post">  
      <button type="submit" class="btn btn-large btn-primary">Добавить нового клиента</button>
      </form>
     <?php } ?>

