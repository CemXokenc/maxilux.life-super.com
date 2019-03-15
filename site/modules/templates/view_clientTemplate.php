<link rel="stylesheet" href="<?php echo $site_variables["css_link"]; ?>?route=left_menu_main" type="text/css" />
<link rel="stylesheet" href="<?php echo $site_variables["css_link"]; ?>?route=zakaz_list" type="text/css" />
<?php include(__DIR__."/../blocks/left_menu_mainTemplate.php"); ?>

<div id="content">
 <div id="content-header">
  <h1>Карточка клиента</h1>
 </div> <!-- #content-header -->	

 <div id="content-container">
Имя: <?php echo $site_variables["client_info"]["fio"]; ?><br>
Телефоны: <?php echo $site_variables["client_info"]["telephone1"]; ?>,<?php echo $site_variables["client_info"]["telephone2"]; ?><br>
Email: <?php echo $site_variables["client_info"]["email"]; ?><br>
Скидка: <?php if( $site_variables["skidka"] > 0){ ?><?php echo $site_variables["skidka_info"]["name"]; ?>(<?php echo $site_variables["skidka_info"]["percent"]; ?>%)<?php }else{ ?>Отсутствует<?php } ?><br>
Заказов:<?php echo $site_variables["cnt_orders"]; ?><br>
Сумма Заказов:<?php echo $site_variables["amount_orders"]; ?><br>
  <?php include(__DIR__."/../blocks/zakaz_listTemplate.php"); ?>  
 </div> <!-- /#content-container -->					
</div> <!-- #content -->

