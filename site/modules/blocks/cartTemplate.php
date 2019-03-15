<?php if( count($site_variables["tovar_in_cart"])>0){ ?>

<form action="" method="post" id="form_filtr">
  <input type="hidden" name="valuta_change" value="1">
<span class="class_margin">
 Изменить валюту:
<select id="valuty" name="valuty" style="margin-left: 20px;" class="chosen-select">
  <?php if( count($site_variables["valuty"]) > 0){ ?>
  <?php foreach($site_variables["valuty"] as $site_variables["item"]){ ?>
  <option <?php if( $site_variables["item"]["kod_valuty"]== $site_variables["session_var_valyta"] ){ ?>selected<?php } ?> value="<?php echo $site_variables["item"]["kod_valuty"]; ?>"><?php echo $site_variables["item"]["name"]; ?></option>
  <?php } ?>
  <?php } ?>
</select>
</form>
</span>
<form action="" method="post">
<span class="class_margin">Выберите <?php if( $site_variables["session_var_type_cart"] == 2){ ?>поставщика<?php }else{ ?>клиента<?php } ?>:
<select id="client_id" name="client" class="chosen-select">

  <option value="0">Не выбран</option>
  <?php if( count($site_variables["clients"]) > 0){ ?>
  <?php foreach($site_variables["clients"] as $site_variables["client"]){ ?>
  <option <?php if( $site_variables["client"]["id"] == $site_variables["session_var_client_id_cart"]){ ?>selected<?php } ?> value="<?php echo $site_variables["client"]["id"]; ?>"><?php echo $site_variables["client_id"]; ?><?php if( $site_variables["session_var_type_cart"] == 2){ ?><?php echo $site_variables["client"]["name"]; ?><?php }else{ ?><?php echo $site_variables["client"]["fio"]; ?><?php } ?></option>
  <?php } ?>
  <?php } ?>
</select>
</span>
  <table class="paginate sortable full" align="center" cellpadding="10" cellspacing="1" style="border: 1px solid #cbcbcb;width: 640px;margin-left: 40px;">
    <thead>
    <tr>
      <th width="40%" style="border-bottom:1px solid #cbcbcb;padding-left:20px;" align="left">Товар</th>
      <th width="15%" style="border-bottom:1px solid #cbcbcb;" align="left">Цена товара</th>
      <th width="15%" style="border-bottom:1px solid #cbcbcb;" align="left">Количество</th>
      <th width="20%" style="border-bottom:1px solid #cbcbcb;" align="left">Сумма</th>
      <th width="10%" style="border-bottom:1px solid #cbcbcb;" align="left"></th>
    </tr>
    </thead>
    <tbody style="display: table-row-group;">
    <?php if( count($site_variables["tovar_in_cart"]) > 0){ ?>
    <?php foreach($site_variables["tovar_in_cart"] as $site_variables["tovar"]){ ?>
    <tr>
      <td align="left" style="border-bottom:1px solid #cbcbcb;padding-left:20px;"><a target="__blank" href="<?php echo $site_variables["tovar"]["link_view_tovar"]; ?>"><?php echo $site_variables["tovar"]["name"]; ?></a></td>
      <td align="left" style="border-bottom:1px solid #cbcbcb;"> <?php echo $site_variables["tovar"]["price_view"]; ?></td>
      <td align="left" style="border-bottom:1px solid #cbcbcb;"> <input type="text" style="width:25px;" class="qnt_tovar" name="products_count[<?php echo $site_variables["tovar"]["id"]; ?>]" value="<?php echo $site_variables["tovar"]["qty"]; ?>"></td>
      <td align="left" style="border-bottom:1px solid #cbcbcb;"> <?php echo $site_variables["tovar"]["summa_view"]; ?></td>
      <td align="left" style="border-bottom:1px solid #cbcbcb;">  <div class="btn-group display-inline pull-right text-align-left hidden-tablet">
          <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" style="padding: 1px 3px;">
            <i class="fa fa-cog fa-lg"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-xs pull-right">
            <li>
              <a href="<?php echo $site_variables["tovar"]["link_edit"]; ?>"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> Редактировать</a>
            </li>
            <li>
              <a onclick="return confirm('Вы уверены что хотите удалить товар <?php echo $site_variables["tovar"]["name"]; ?> из корзины?');" href="<?php echo $site_variables["tovar"]["link_delete_cart"]; ?>"><i class="fa fa-times fa-lg fa-fw txt-color-red"></i> Удалить</a>
            </li>
          </ul>
        </div>
      </td>
    </tr>
    <?php } ?>
    <?php } ?>
    <tr>
      <td align="left" style="border-bottom:1px solid #cbcbcb;padding-left:20px;"><strong>Общая сумма</strong></td>
      <td align="left" style="border-bottom:1px solid #cbcbcb;">-</td>
      <td align="left" style="border-bottom:1px solid #cbcbcb;"><strong><?php echo $site_variables["summa_tovarov"]; ?></strong></td></span>
      <td id="summa_td" align="left" style="border-bottom:1px solid #cbcbcb;">
        <span class="summa_zakaza"><?php echo $site_variables["summa_zakaza"]; ?></span>
    <span id="skidka" style="display:none;">
      <br>Скидка Клиента:<span id="skidka_summa"></span>
      <br>Скидка Офиса:<span id="office_skidka_summa"></span>
      <br>Доход Офиса:<span id="office_doxod_summa"></span>
    </span>
    <span id="k_oplate"><br>К оплате:<span id="k_oplate_summa"><?php echo $site_variables["summa_zakaza"]; ?></span></span>
      </td>
      <td> </td>
    </tr>
    </tbody>
  </table>
  <p class="class_margin">
    <button  style="display:none;" type="submit"  id="update_cart" name="do" value="update_cart">Обновить</button>
    <button name="do" value="clear_cart">Очистить</button>
    <button  name="do" id="zakaz" value="zakaz">Оформить <?php if( $site_variables["session_var_type_cart"] == 2){ ?>заявку<?php }else{ ?>заказ<?php } ?></button>
    <input type="hidden" id="skidka_hidden" name="skidka" value="0">
    <button  name="do" id="zakaz" value="return_products">Вернуться к товарам</button>
  </p>
</form>
<?php }else{ ?>
<form action="" method="post">
  <h3>Вы не выбрали ни одного товара<h3>
      <p style="margin-left:40px;margin-top:20px;">
        <button  name="do" id="zakaz" value="return_products">Вернуться к товарам</button>
</form>
</p>
<?php } ?>

<script type="text/javascript">
  $(".qnt_tovar").keyup(function() {
    $('#zakaz').hide();
    $('#update_cart').show();
  })

  <?php if( $site_variables["session_var_type_cart"] != 2){ ?>
  $('#client_id').change(function(){
    var client_id = $(this).val();
    $.ajax({
      dataType: 'json',
      type: "POST",
      url: "",
      data:{"do":"skidka_refresh","client_id":client_id},
      success: function(html){
        var skidka_summa = 0;
        if(html.skidka > 0){
          var summa = $("#summa_zakaza").html();
          summa  = parseFloat(summa);

          skidka_summa = "<br>"+((html.skidka*summa)/100).toFixed(2)+html.valuta_name;
          $("#skidka_summa").html(skidka_summa);
          $("#k_oplate_summa").html((summa - (html.skidka*summa)/100).toFixed(2));
        }
        if(html.skidka_office > 0){
          var summa = $("#summa_zakaza").html();
          summa  = parseFloat(summa);

          var office_skidka_summa = "<br>"+((html.skidka_office*summa)/100).toFixed(2)+html.valuta_name;
          $("#office_skidka_summa").html(office_skidka_summa);

          var office = (html.skidka_office*summa)/100;
          var client = (html.skidka*summa)/100;
          $("#office_doxod_summa").html((office-client).toFixed(2)+html.valuta_name);

          $("#skidka").show();
          $("#skidka_hidden").val(((html.skidka*summa)/100).toFixed(2));
        }else{
          $("#skidka_summa").html("");
          $("#skidka").hide();
          $("#skidka_hidden").val(0);
        }
      }
    });
  });
  <?php } ?>

  var client_id = $("#client_id").val();
  if(client_id > 0){
    $("#client_id").trigger("change");
  }

  $("#valuty").change(function(){
    $("#form_filtr").submit();
  });
</script>

