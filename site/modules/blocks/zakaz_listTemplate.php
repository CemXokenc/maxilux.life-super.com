<?php if( $site_variables["view_client"] != 1){ ?>
<form action="" method="post" id="form_filtr" style="display: inline-block; margin-right: 20px;">
  <div class="btn-group display-inline pull-right text-align-left hidden-tablet" style="float: left !important;margin-bottom: 20px;">
    <button type="button" class="btn btn-xs btn-default" style="padding: 1px 3px;" onclick="$(this).next().toggle();">
      <i class="fa fa-cog fa-lg"></i> Фильтр
    </button>
    <div class="dropdown-menu dropdown-menu-xs pull-right" style="padding: 15px;width: 700px;left: 0px;">


      <div class="row">
        <?php if( $site_variables["session_var_user_type"] == "5" ){ ?>
        <div class="col-sm-6">
          <select s name="torg_tchk" class="form-control" >
            <option value="0">Выберите Торговую точку</option>
            <?php if( count($site_variables["torg_tochki"])>0){ ?>
            <?php foreach($site_variables["torg_tochki"] as $site_variables["torg_tochka"]){ ?>
            <?php if( $site_variables["torg_tochka"]["name"] != ""){ ?><option <?php if( $site_variables["session_var_zakaz_torg_tochka"] == $site_variables["torg_tochka"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["torg_tochka"]["id"]; ?>"><?php echo $site_variables["torg_tochka"]["name"]; ?></option><?php } ?>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
        <?php } ?>
        <div class="col-sm-6">
          <select s name="client" class="form-control" >
            <option value="0">Выберите клиента</option>
            <?php if( count($site_variables["clients"])>0){ ?>
            <?php foreach($site_variables["clients"] as $site_variables["client"]){ ?>
            <option <?php if( $site_variables["session_var_zakaz_client"] == $site_variables["client"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["client"]["id"]; ?>"><?php echo $site_variables["client"]["fio"]; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
         <div class="col-sm-2" style="width: 340px;">
           <input type="text" name="name_client" class="form-control" value="<?php echo $site_variables["session_var_zakaz_client_name"]; ?>" placeholder="Поиск по ФИО клиента" />
         </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <select s name="manager" class="form-control" >
            <option value="0">Выберите менеджера</option>
            <?php if( count($site_variables["managers"])>0){ ?>
            <?php foreach($site_variables["managers"] as $site_variables["manager"]){ ?>
            <option <?php if( $site_variables["session_var_zakaz_manager"] == $site_variables["manager"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["manager"]["id"]; ?>"><?php echo $site_variables["manager"]["first_name"]; ?> <?php echo $site_variables["manager"]["last_name"]; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>

 <div class="row">
         <div class="col-sm-6">
          <select name="skidka" class="form-control" >
            <option value="">Выберите скидку</option>
            <?php foreach($site_variables["skidki_db"] as $site_variables["skidka"]){ ?>
            <?php if( $site_variables["skidka"]["name"] != ""){ ?><option <?php if( $site_variables["session_var_zakaz_skidka"] == $site_variables["skidka"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["skidka"]["id"]; ?>"><?php echo $site_variables["skidka"]["name"]; ?></option><?php } ?>
            <?php } ?>
          </select>
        </div>
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
          <input class="form-control" placeholder="# заказа" type="text" id="order_num" name="order_num" value="<?php echo $site_variables["session_var_zakaz_order_num"]; ?>">
        </div>
        <div class="col-sm-6">
          <select name="order_statuses" class="form-control" >
            <option value="">Выберите статус</option>
            <?php foreach($site_variables["order_statuses"] as $site_variables["status"]){ ?>
            <option <?php if( $site_variables["session_var_zakaz_order_statuses"] == $site_variables["status"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["status"]["id"]; ?>"><?php echo $site_variables["status"]["name"]; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2" style="width: 340px;">
          <select name="order_by_column">
            <option value="">Сортировать по</option>
            <option value="fio">ФИО</option>
            <option value="order_date">Дата Заказа</option>
            <option value="summa">Сумма Заказа</option>
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
<input type="hidden" name="valuta_change" value="1">
<input type="hidden" name="do" value="filter">
<select id="valuty" name="valuty" style="margin-left: 20px;">
 <option  value="">Валюта по умолчанию</option>
<?php foreach($site_variables["valuty"] as $site_variables["item"]){ ?>
 <option <?php if( $site_variables["item"]["kod_valuty"]== $site_variables["session_var_zakaz_valyta"] ){ ?>selected<?php } ?> value="<?php echo $site_variables["item"]["kod_valuty"]; ?>"><?php echo $site_variables["item"]["name"]; ?></option>
<?php } ?>
</select>
</form>

<form id = "view_removed" method="post" style="display: inline-block;">
	<button type="submit" name="reset_filter" value = "1" class="reset_filter btn btn-info">Сбросить фильтр</button>
	<input name="view_checked" style="margin-left: 20px;" <?php echo $site_variables["area_checked"]; ?> onchange="$('#view_removed').submit();" value="1" type="checkbox">
	<label for="view_removed">Вывести удаленные?</label>

	<input type="hidden" name="do" value = "filter2">
</form>

<form id="view_removed_form" action="" method="post" >
	<input id = "sort_by" type="hidden" name="sort_by">
	<input id = "sort_type" type="hidden" name="sort_type">
	
	<input id = "form_do" type="hidden" name="do">
</form>

<?php }else{ ?>
<br><br>
<?php } ?>

<table class="table table-bordered">
  <thead>
  <tr>
    <th><a class = "table_sorter <?php if(($site_variables["active_sort_id"] == 'id')){ ?>active <?php echo $site_variables["active_sort"]; ?><?php } ?>" href = "#">№</a></th>
    <th><a class = "table_sorter <?php if(($site_variables["active_sort_id"] == 'fio')){ ?>active <?php echo $site_variables["active_sort"]; ?><?php } ?>" href = "#">ФИО</a></th>
    <th><a class = "table_sorter <?php if(($site_variables["active_sort_id"] == 'order_date')){ ?>active <?php echo $site_variables["active_sort"]; ?><?php } ?>" href = "#">Время заказа</a></th>
    <th><a class = "table_sorter <?php if(($site_variables["active_sort_id"] == 'summa')){ ?>active <?php echo $site_variables["active_sort"]; ?><?php } ?>" href = "#">Сумма заказа</a></th>
	<th><a class = "table_sorter <?php if(($site_variables["active_sort_id"] == 'skidka_amount')){ ?>active <?php echo $site_variables["active_sort"]; ?><?php } ?>" href = "#">Скидка</a></th>
	<th><a class = "table_sorter <?php if(($site_variables["active_sort_id"] == 'summa_f')){ ?>active <?php echo $site_variables["active_sort"]; ?><?php } ?>" href = "#">К оплате</a></th>
    <th><a class = "table_sorter <?php if(($site_variables["active_sort_id"] == 'default_status')){ ?>active <?php echo $site_variables["active_sort"]; ?><?php } ?>" href = "#">Статус</a></th>
    <th><a class = "table_sorter <?php if(($site_variables["active_sort_id"] == 'torgovaya_tochka_id')){ ?>active <?php echo $site_variables["active_sort"]; ?><?php } ?>" href = "#">Торговая точка</a></th>
	<th>Комментарии</th>
    <?php if( $site_variables["session_var_zakaz_view"] == 1){ ?><th>Просмотр</th><?php } ?>
  </tr>
  </thead>
  <tbody>

  <?php if( count($site_variables["zakaz_list"])>0 ){ ?>
   <?php if(count($site_variables["zakaz_list"]) > 0){ ?>
 <?php   foreach($site_variables["zakaz_list"] as $zakaz_list_item){ ?>
<tr>
  <td><?php if( $site_variables["session_var_zakaz_view"] == 1){ ?><a href="<?php echo $zakaz_list_item["actions_list"]["order_view"]; ?>"><?php echo $zakaz_list_item["orders_nomer"]; ?></a><?php }else{ ?><?php echo $zakaz_list_item["orders_nomer"]; ?><?php } ?></td>
  <td><?php if( $site_variables["session_var_client_view"] == 1){ ?><a href="<?php echo $zakaz_list_item["client_info_url"]; ?>"><?php echo $zakaz_list_item["clients_fio"]; ?></a><?php }else{ ?><?php echo $zakaz_list_item["clients_fio"]; ?><?php } ?></td>
  <td><?php echo $zakaz_list_item["orders_order_date"]; ?></td>
  <td><?php echo $zakaz_list_item["orders_summa"]; ?></td>
  <td>
    Клиент: <?php echo $zakaz_list_item["orders_skidka_amount"]; ?><br>
    Офис: <?php echo $zakaz_list_item["orders_skidka_office_amount"]; ?>
  </td>
  <td><?php echo $zakaz_list_item["orders_itogo"]; ?></td>
  <td style = "background-color: <?php echo $zakaz_list_item["orders_statuses_color"]; ?>;"><?php echo $zakaz_list_item["orders_statuses_name"]; ?></td>
  <td><?php echo $zakaz_list_item["torgovye_tochki_name"]; ?></td>
  <td style="padding: 0;display: inline-block;position: relative"><?php echo $zakaz_list_item["comment"]; ?></td>
  <?php if( $site_variables["session_var_zakaz_view"] == 1){ ?><td>
<a href="<?php echo $zakaz_list_item["actions_list"]["order_view"]; ?>">Просмотр<a/><br>
<?php if( ($zakaz_list_item["orders_hidden"] == 1)){ ?> <a href="#" class = "item_hide restore" >Восстановить<a/> <?php }else{ ?> <a href="#" class = "item_hide">Удалить<a/><?php } ?>
</td><?php } ?>
</tr> <?php   } ?>
 <?php } ?>

  <?php } ?>
  </tbody>
</table>
 <?php if( $site_variables["zakaz_list_navigation"] == 1 ){ ?>  
 <div class="pagination">  
  <ul>  
   <?php if( $site_variables["zakaz_list_num1"] > 1){ ?><li <?php if( $site_variables["zakaz_list_page_num"] == 1){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["zakaz_list_prev_url"]; ?>" class="ext_disabled"> < </a></li><?php } ?>  
   <?php if( $site_variables["zakaz_list_num1"] > 0){ ?><li <?php if( $site_variables["zakaz_list_page_num"] == $site_variables["zakaz_list_num1"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["zakaz_list_num_1_url"]; ?>" class="ext_disabled"><?php echo $site_variables["zakaz_list_num1"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["zakaz_list_num2"] > 0){ ?><li <?php if( $site_variables["zakaz_list_page_num"] == $site_variables["zakaz_list_num2"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["zakaz_list_num_2_url"]; ?>" class="ext_disabled"><?php echo $site_variables["zakaz_list_num2"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["zakaz_list_num3"] > 0){ ?><li <?php if( $site_variables["zakaz_list_page_num"] == $site_variables["zakaz_list_num3"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["zakaz_list_num_3_url"]; ?>" class="ext_disabled"><?php echo $site_variables["zakaz_list_num3"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["zakaz_list_last_num"] > 3){ ?><li class="disabled"><a href="#" class="ext_disabled">...</a></li><?php } ?> 
   <?php if( $site_variables["zakaz_list_last_num"] != $site_variables["zakaz_list_num3"]){ ?><li <?php if( $site_variables["zakaz_list_page_num"] == $site_variables["zakaz_list_last_num"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["zakaz_list_last_url"]; ?>" class="ext_disabled"><?php echo $site_variables["zakaz_list_last_num"]; ?></a></li><?php } ?> 
   <?php if( $site_variables["zakaz_list_page_num"] < $site_variables["zakaz_list_last_num"]){ ?><li><a href="<?php echo $site_variables["zakaz_list_next_url"]; ?>" class="ext_disabled"> > </a></li><?php } ?>  
  </ul> 
 </div>  
 <?php } ?>  


<script src="<?php echo $site_variables["template_dir"]; ?>js/plugins/Zakaz_list/template.core.js"></script>
<script src="<?php echo $site_variables["template_dir"]; ?>js/plugins/Zakaz_list/templates.js"></script>
<script src="<?php echo $site_variables["template_dir"]; ?>js/plugins/Zakaz_list/app.js"></script>
<script>
    function initCommentsLabels() {
        var labels = '' +
            '<div class="comment_label_element" label_id="1" color="#FA8E8E" style="background-color: #FA8E8E;width:12%;"></div><div class="comment_label_element" label_id="2" color="#DAFCCA" style="background-color: #DAFCCA;width:12%;"></div><div class="comment_label_element" label_id="3" color="#FCF9CA" style="background-color: #FCF9CA;width:12%;"></div><div class="comment_label_element" label_id="4" color="#ffffff" style="background-color: #ffffff;width:12%;"></div><div class="comment_label_element" label_id="5" color="#A1BBF7" style="background-color: #A1BBF7;width:12%;"></div><div class="comment_label_element" label_id="6" color="#F7A1F6" style="background-color: #F7A1F6;width:12%;"></div><div class="comment_label_element" label_id="7" color="#FCCA88" style="background-color: #FCCA88;width:12%;"></div><div class="comment_label_element" label_id="8" color="#A7EFFA" style="background-color: #A7EFFA;width:12%;"></div>';
        $('.labels_block').append(labels);
    }
</script>

<script>
$("#valuty").change(function(){
  $("#form_filtr").submit();
});

$(".table_sorter").click(function(){
	_this = this;
	
	switch($(this).text())
	{
		case '№': 				sort = 'id'; break;
		case 'ФИО': 			sort = 'fio';break;
		case 'Время заказа': 	sort = 'order_date';break;
		case 'Сумма заказа': 	sort = 'summa';break;
		case 'Скидка': 			sort = 'skidka_amount';break;
		case 'К оплате': 		sort = 'summa';break;
		case 'Статус': 			sort = 'default_status';break;
		case 'Торговая точка': 	sort = 'torgovaya_tochka_id';break;
	}
	$("#sort_by").val(sort); 
	
	if($(this).hasClass('down'))
		$("#sort_type").val("asc");
	else  $("#sort_type").val("desc");
	
	$('#form_do').val("sort");
	
	$('#view_removed_form').submit();
});

$(".item_hide").click(function(){
	_this = this;
	if($(this).hasClass('restore')) act = 0;
	else act = 1;
	
	var id = $(this).parent('td').parent('tr').children('td:first').children('a').text();
	$.ajax({
		type: "POST",
		url: "",
		data: {"do":"hide_item","id":id, "type":act},
		success: function(html_page){
			if(act == 1)
			{
				if($('#view_removed').prop('checked'))
					$(_this).text("Восстановить").addClass("restore");
				else
					$(_this).parent().parent().remove();
			}
			else $(_this).text("Удалить").removeClass("restore");
			
		}
	});	
});
</script>

