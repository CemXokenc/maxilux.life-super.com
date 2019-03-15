<form method="post" enctype="multipart/form-data">
  <?php if( !isset($site_variables["skidka_val"]) || $site_variables["skidka_val"]["percent"] > 0 ){ ?>
  <input type="hidden" id="skidka" value="<?php echo $site_variables["skidka_val"]["percent"]; ?>">
  <?php if( $site_variables["skidka"] > 0){ ?>Ваша Скидка: <?php echo $site_variables["skidka_val"]["name"]; ?>(<?php echo $site_variables["skidka_val"]["percent"]; ?>%)<?php } ?><br>
  <table class="table table-bordered">
    <thead>
    <tr>
      <th>Название</th>
      <th>Сумма</th>
      <th>Скидка</th>

    </tr>
    </thead>
    <tbody>

    <?php foreach($site_variables["skidki_db"] as $site_variables["skidka"]){ ?>
    <tr><td><input class="form-control" type="text" name="skidki_name[<?php echo $site_variables["skidka"]["id"]; ?>]" value="<?php echo $site_variables["skidka"]["name"]; ?>"></td><td><input class="form-control" type="text" name="skidki_amount[<?php echo $site_variables["skidka"]["id"]; ?>]" value="<?php if( $site_variables["skidka"]["amount"] != 0){ ?><?php echo $site_variables["skidka"]["amount"]; ?><?php } ?>"></td><td><input class="form-control" onchange="if($(this).val() > <?php echo $site_variables["skidka_val"]["percent"]; ?>){alert('Скидка клиента недолжна быть больше скидки компании');$(this).val(0);$(this).focus();}" type="text" name="skidki_percent[<?php echo $site_variables["skidka"]["id"]; ?>]" value="<?php if( $site_variables["skidka"]["percent"] != 0){ ?><?php echo $site_variables["skidka"]["percent"]; ?><?php } ?>"></td></tr>
    <?php } ?>
    </tbody>
  </table>
  <?php if( $site_variables["session_var_skidki_update"] == 1){ ?>
  <input type="hidden" name="do" value="skidki_update">
  <input type="submit" value="Сохранить изменения">
  <?php } ?>
  <?php }else{ ?>
   У вашего офиса отсутствует диллерская скидка
  <?php } ?>
</form>

