<link rel="stylesheet" href="<?php echo $site_variables["css_link"]; ?>?route=left_menu_main" type="text/css" />
<link rel="stylesheet" href="<?php echo $site_variables["css_link"]; ?>?route=zakaz_list" type="text/css" />
<?php include(__DIR__."/../blocks/left_menu_mainTemplate.php"); ?>

<div id="content">
 <div id="content-header">
  <h1>Карточка торговой точки</h1>
 </div> <!-- #content-header -->	

 <div id="content-container">
Название: <?php echo $site_variables["torgovaya_tochka_info"]["name"]; ?><br>
Телефон: <?php echo $site_variables["torgovaya_tochka_info"]["telephone"]; ?><br>
Email: <?php echo $site_variables["torgovaya_tochka_info"]["email"]; ?><br>
Город:<?php echo $site_variables["torgovaya_tochka_info"]["city"]; ?><br>
Улица:<?php echo $site_variables["torgovaya_tochka_info"]["street"]; ?><br>
Дом:<?php echo $site_variables["torgovaya_tochka_info"]["house"]; ?><br>
Офис:<?php echo $site_variables["torgovaya_tochka_info"]["office"]; ?><br>
Почтовый индекс:<?php echo $site_variables["torgovaya_tochka_info"]["zip_code"]; ?><br>
Направление:<?php echo $site_variables["napravlenie"]; ?><br>
Скидка: <?php if( $site_variables["skidka"] > 0){ ?><?php echo $site_variables["skidka_info"]["name"]; ?>(<?php echo $site_variables["skidka_info"]["percent"]; ?>%)<?php }else{ ?>Отсутствует<?php } ?><br>
Заказов:<?php echo $site_variables["cnt_orders"]; ?><br>
Сумма Заказов:<?php echo $site_variables["amount_orders"]; ?><br>
  <?php include(__DIR__."/../blocks/zakaz_listTemplate.php"); ?>  
 </div> <!-- /#content-container -->					
</div> <!-- #content -->

