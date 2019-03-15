<table style="width: 100%; max-width: 100%;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
	<tr>
		<td rowspan="2" style = "width: 20%;">
			<b>Номер заказа:</b><br><?php echo $site_variables["order"]["nomer"]; ?><br>
			<b>Торговая точка:</b><br><?php echo $site_variables["order"]["torg_tochka_name"]; ?><br>
			<b>Сумма заказа:</b><?php echo $site_variables["order"]["summa"]; ?>
			<b>Скидка:</b><?php echo $site_variables["order"]["skidka"]; ?>
			<b>Оплата:</b><?php echo $site_variables["order"]["oplata"]; ?>
		</td>
		<td><h4>Клиент</h4></td>
		<td><h4>Адрес доставки</h4></td>
		<td><h4>Оформил</h4></td>
	</tr>
	<tr>
		<td style = "vertical-align: top; width: 30%;">
			<b>ФИО:</b> <a href="<?php echo $site_variables["client_db"]["info_url"]; ?>"><?php echo $site_variables["client_db"]["fio"]; ?></a><br>
			<b>Email:</b> <?php echo $site_variables["client_db"]["email"]; ?><br>
			<b>Телефоны:</b> <?php echo $site_variables["client_db"]["telephone"]; ?>,<?php echo $site_variables["client_db"]["telephone1"]; ?>,<?php echo $site_variables["client_db"]["telephone2"]; ?>
		</td>
		<td style = "vertical-align: top; width: 30%;">
			<b>ФИО:</b> <?php echo $site_variables["order"]["fio"]; ?><br>
			<b>E-mail:</b> <?php echo $site_variables["order"]["email"]; ?><br>
			<b>Город:</b> <?php echo $site_variables["order"]["city"]; ?><br>
			<b>Почтовый индекс:</b> <?php echo $site_variables["order"]["city"]; ?><br>
			<b>Адрес:</b> <?php echo $site_variables["order"]["zip_code"]; ?><br>
			<b>Телефон:</b> <?php echo $site_variables["order"]["adress"]; ?>
		</td>
		<td style = "vertical-align: top; width: 20%;">
			<b><?php echo $site_variables["manager_db"]["first_name"]; ?> <?php echo $site_variables["manager_db"]["last_name"]; ?></b><br>
			<?php echo $site_variables["manager_db"]["name"]; ?><br>
			<b>Время заказа:</b> <?php echo $site_variables["order"]["order_date"]; ?>
		</td>
	</tr>
  </tbody>
</table>

<br>

<div class="alert alert-success" id="status_msg" style="display:none;">
  <a class="close" data-dismiss="alert" href="#" aria-hidden="true">x</a>
  Статус успешно обновлен
</div>

<table class="table table-bordered">
  <thead>
  <tr>
    <th>Название товара</th>
    <th>Количество</th>
    <th>Цена</th>
    <th>Сумма</th>
    <th>Скидка</th>
    <th>Оплачено</th>
    <?php if( $site_variables["session_var_zakaz_update"] == "1"){ ?>
    <th >Статус</th>
    <?php } ?>
  </tr>
  </thead>
  <tbody>
  <?php foreach($site_variables["order_products"] as $site_variables["product_order"]){ ?>
  <tr>
    <td>
      <?php if( $site_variables["product_order"]["link_view_tovar"] != ""){ ?>
      <a target="__blank" href="<?php echo $site_variables["product_order"]["link_view_tovar"]; ?>"><?php echo $site_variables["product_order"]["name"]; ?></a>
      <?php }else{ ?><?php echo $site_variables["product_order"]["name"]; ?>
      <?php } ?>
      <?php if( $site_variables["session_var_zakaz_update"] == "1"){ ?>
      <?php if( $site_variables["product_order"]["edit_product_url"] != "" && $site_variables["product_order"]["category_status"] == 0){ ?><br/><a href="<?php echo $site_variables["product_order"]["edit_product_url"]; ?>">редактировать</a><?php } ?>
      <?php } ?>
    </td>
    <td><?php echo $site_variables["product_order"]["kolichestvo"]; ?></td>
    <td><?php echo $site_variables["product_order"]["price"]; ?></td>
    <td><?php echo $site_variables["product_order"]["amount"]; ?></td>
    <td>
      Клиент: <?php echo $site_variables["product_order"]["price_skidka"]; ?><br>
      Офис: <?php echo $site_variables["product_order"]["price_ofice_skidka"]; ?>
    </td>
    <td>
      Клиент: <?php echo $site_variables["product_order"]["price_total"]; ?><br>
      Офис: <?php echo $site_variables["product_order"]["price_office_total"]; ?>
    </td>
    <?php if( $site_variables["session_var_zakaz_update"] == "1"){ ?>
    <td class="status_td">
      <?php if( $site_variables["product_order"]["moved_at_sklad"] == 1){ ?>
      перенесен на склад
      <?php }else{ ?>
      <div class="perenesti_na_sklad"><?php echo $site_variables["product_order"]["perenesti_na_sklad"]; ?></div>
      <?php if( count($site_variables["product_order"]["statuses"]) > 0){ ?>
      <select class="orders_statuses">
        <?php foreach($site_variables["product_order"]["statuses"] as $site_variables["product_status"]){ ?>
        <option <?php if( $site_variables["product_order"]["category_status"] == $site_variables["product_status"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["product_status"]["id"]; ?>"><?php echo $site_variables["product_status"]["name"]; ?></option>
        <?php } ?>
      </select>
      <?php } ?>
      <?php if( count($site_variables["product_order"]["statuses"]) > 0){ ?>
      <button class="btn btn-success product_status" product_id="<?php echo $site_variables["product_order"]["id"]; ?>">Применить</button>
      <?php } ?>
      <br>
       <span class="workers_list" style="display:none;"><select>
           <option value="0">Не выбрано</option></select>
      </span>
      <?php } ?>
    </td>
    <?php } ?>
  </tr>
  <?php } ?>
  </tbody>
</table>
<?php if( $site_variables["session_var_zakaz_update"] == "1"){ ?>
<div>
  Статус <select id="orders_statuses">
    <?php foreach($site_variables["stateses"] as $site_variables["status"]){ ?>
    <option <?php if( $site_variables["order"]["default_status"] == $site_variables["status"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["status"]["id"]; ?>"><?php echo $site_variables["status"]["name"]; ?></option>
    <?php } ?>
  </select>
  <button class="btn btn-success" id="btn_update">Применить</button>
</div>
<?php } ?>
<script type="text/javascript">

  $("#btn_update").click(function(){
    var status_id = $("#orders_statuses").val();
    $("#status_msg").hide();
    $.ajax({
      dataType: 'json',
      type: "POST",
      url: "",
      data:{"do":"status_update","status_id":status_id},
      success: function(html){
        if(html.status == 1){
          $("#status_msg").show();
          $("#orders_statuses").html(html.select_db);
        }
        if(html.error == 1){
          alert('Нельзя повторно выбирать статус');
        }
      }
    });
  });

  $(".product_status").click(function(){
    var product_id = $(this).attr("product_id");
    var product_cnt = $(this).parent("td").prev().prev().prev().prev().prev().html();
    var worker_id = $(this).parent("td").children(".workers_list").children("select").val();
    var select_id =  $(this).prev().val();
    var _select   = $(this).prev();

    $("#status_msg").hide();

    $.ajax({
      dataType: 'json',
      type: "POST",
      url: "",
      data:{"do":"status_product_update","product_id":product_id,"select_id":select_id,"product_cnt":product_cnt,"worker_id":worker_id  },
      success: function(html){
        if(html.status == 1){
          $("#status_msg").show();
          _select.html(html.select_data);
          _select.parent("td").children(".workers_list").hide();
          _select.parent("td").children(".perenesti_na_sklad").html(html.perenesti_na_sklad);
        }
        if(html.error == 1){
          alert('Нельзя повторно выбрать статус');
        }
      }
    });
  });


  $("select", $('.status_td')).change(function(){
    var status_id = $(this).val();
    var _this = $(this);
    $.ajax({
      dataType: 'json',
      type: "POST",
      url: "",
      data:{"do":"download_users","status_id":status_id},
      success: function(html){
        _this.parent("td").children(".workers_list").html(html.workers_list);
        _this.parent("td").children(".workers_list").show();
      }
    });
  });

</script>

