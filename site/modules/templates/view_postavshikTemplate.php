<link rel="stylesheet" href="<?php echo $site_variables["css_link"]; ?>?route=left_menu_main" type="text/css" />
<link rel="stylesheet" href="<?php echo $site_variables["css_link"]; ?>?route=zayavki_list" type="text/css" />
<?php include(__DIR__."/../blocks/left_menu_mainTemplate.php"); ?>

<div id="content">
 <div id="content-header">
  <h1>Карточка пользователя</h1>
 </div> <!-- #content-header -->	

 <div id="content-container">
Имя: <?php echo $site_variables["postavshik_info"]["name"]; ?><br>
Телефон: <?php echo $site_variables["postavshik_info"]["telephone"]; ?><br>
Email: <?php echo $site_variables["postavshik_info"]["email"]; ?><br>
Город:<?php echo $site_variables["postavshik_info"]["city"]; ?><br>
Улица:<?php echo $site_variables["postavshik_info"]["street"]; ?><br>
Дом:<?php echo $site_variables["postavshik_info"]["house"]; ?><br>
Офис:<?php echo $site_variables["postavshik_info"]["office"]; ?><br>
Почтовый индекс:<?php echo $site_variables["postavshik_info"]["zip_code"]; ?><br>
Дебет:<?php echo $site_variables["postavshik_info"]["debet"]; ?><br>
Кредит:<?php echo $site_variables["postavshik_info"]["credit"]; ?><br>
Заявок:<?php echo $site_variables["cnt_orders"]; ?><br>
  <?php include(__DIR__."/../blocks/zayavki_listTemplate.php"); ?>  
 </div> <!-- /#content-container -->					
</div> <!-- #content -->

