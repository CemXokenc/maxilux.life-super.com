<table class="table table-bordered">
  <thead>
  <tr>
    <th>Поставщик</th>
    <th>Номер наклодной</th>
    <th>Дата поступления</th>
    <th>Сумма</th>
    <th>Валюта</th>
  </tr>
  </thead>
  <tbody>

  <tr>
    <td style="width:250px;">
      <?php echo $site_variables["postavshik_db"]["name"]; ?>
    </td>
    <td><?php echo $site_variables["postuplenie_db"]["nomer_naklodnoy"]; ?></td>
    <td>
      <?php echo $site_variables["postuplenie_db"]["data_postupleniya"]; ?>
    </td>
    <td style="width:150px;"><?php echo $site_variables["postuplenie_db"]["summa"]; ?> </td>
    <td style="width:150px;">
      <?php echo $site_variables["postuplenie_db"]["valuta"]; ?>
    </td>
  </tr>
  </tbody>
</table>

<?php echo $site_variables["table"]; ?>

