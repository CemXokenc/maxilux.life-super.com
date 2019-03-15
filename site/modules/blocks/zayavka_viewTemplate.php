<h4>Поставщик:</h4>
ФИО:<?php echo $site_variables["postavshiki"]["name"]; ?><br>
Email:<?php echo $site_variables["postavshiki"]["email"]; ?><br>
Телефон:<?php echo $site_variables["postavshiki"]["telephone"]; ?><br>
Город:<?php echo $site_variables["postavshiki"]["city"]; ?><br>
Улица:<?php echo $site_variables["postavshiki"]["street"]; ?><br>
Дом:<?php echo $site_variables["postavshiki"]["house"]; ?><br>
Офис:<?php echo $site_variables["postavshiki"]["office"]; ?><br>
Почтовый индекс:<?php echo $site_variables["postavshiki"]["zip_code"]; ?><br>
<h4>Заказывал:</h4>
<?php echo $site_variables["manager"]["first_name"]; ?> <?php echo $site_variables["manager"]["last_name"]; ?><br>
<?php echo $site_variables["manager"]["name"]; ?><br>
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
  </tr>
  </thead>
  <tbody>
  <?php if( count($site_variables["zayavki_products"]) > 0){ ?>
  <?php foreach($site_variables["zayavki_products"] as $site_variables["product_order"]){ ?>
  <tr>
    <td>
      <a target="__blank" href="<?php echo $site_variables["product_order"]["link_view_tovar"]; ?>"><?php echo $site_variables["product_order"]["name"]; ?></a>
    </td>
    <td><?php echo $site_variables["product_order"]["kolichestvo"]; ?></td>
    <td><?php echo $site_variables["product_order"]["price"]; ?></td>

  </tr>
  <?php } ?>
  <?php } ?>
  </tbody>
</table>
<div style="float:left;">
  <b>Номер заявки:</b><br><?php echo $site_variables["zayavka"]["nomer"]; ?><br>
  <b>Сумма заявки:</b><?php echo $site_variables["zayavka"]["summa_zakupki"]; ?><br>
  Время заявки: <?php echo $site_variables["zayavka"]["created"]; ?>
</div>

<div>
  <form action="" method="post">
    <input type="hidden" name="do" value="change_status">
    Склад<select name="sklad" <?php if( $site_variables["zayavka"]["status"] == 2){ ?>disabled<?php } ?> >
    <?php foreach($site_variables["sklads"] as $site_variables["sklad"]){ ?>
    <option <?php if( $site_variables["sklad"]["id"] == $site_variables["zayavka"]["sklad_id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["sklad"]["id"]; ?>"><?php echo $site_variables["sklad"]["name"]; ?></option>
    <?php } ?>

    </select>
    Статус <select name="status" <?php if( $site_variables["zayavka"]["status"] == 2){ ?>disabled<?php } ?>  id="orders_statuses">

    <option <?php if( $site_variables["zayavka"]["status"] == 1){ ?>selected<?php } ?> value="1">Новая заявка</option>
    <option <?php if( $site_variables["zayavka"]["status"] == 2){ ?>selected<?php } ?> value="2">Товар получен</option>
    </select>
    <?php if( $site_variables["zayavka"]["status"] != 2){ ?><button class="btn btn-success">Применить</button><?php } ?>
  </form>
</div>

