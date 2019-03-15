<link rel="stylesheet" href="<?php echo $site_variables["css_link"]; ?>?route=left_menu_main" type="text/css" />
<link rel="stylesheet" href="<?php echo $site_variables["css_link"]; ?>?route=activity_workers" type="text/css" />
<?php include(__DIR__."/../blocks/left_menu_mainTemplate.php"); ?>

<div id="content">
 <div id="content-header">
  <h1>Карточка работника</h1>
 </div> <!-- #content-header -->	

 <div id="content-container">
ФИО: <?php echo $site_variables["worker_info"]["fio"]; ?><br>
Телефоны: <?php echo $site_variables["worker_info"]["telephone"]; ?> <?php echo $site_variables["worker_info"]["telephone1"]; ?><br>
Email: <?php echo $site_variables["worker_info"]["email"]; ?><br>
Должность:<?php echo $site_variables["profession"]; ?><br>
Ставка:<?php echo $site_variables["worker_info"]["stavka"]; ?><br>
Бонус:<?php echo $site_variables["worker_info"]["bonus"]; ?><br>
В час:<?php echo $site_variables["worker_info"]["vchas"]; ?><br>
Сдельная:<?php echo $site_variables["worker_info"]["sdelnaya"]; ?><br>

  <?php include(__DIR__."/../blocks/activity_workersTemplate.php"); ?>  
 </div> <!-- /#content-container -->					
</div> <!-- #content -->

