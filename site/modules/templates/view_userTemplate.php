<link rel="stylesheet" href="<?php echo $site_variables["css_link"]; ?>?route=left_menu_main" type="text/css" />
<link rel="stylesheet" href="<?php echo $site_variables["css_link"]; ?>?route=activity" type="text/css" />
<?php include(__DIR__."/../blocks/left_menu_mainTemplate.php"); ?>

<div id="content">
 <div id="content-header">
  <h1>Карточка пользователя</h1>
 </div> <!-- #content-header -->	

 <div id="content-container">
Имя: <?php echo $site_variables["user_info"]["first_name"]; ?><br>
Фамилия: <?php echo $site_variables["user_info"]["last_name"]; ?><br>
Тип пользователя: <?php if( $site_variables["user_info"]["user_type"] == 5){ ?>Админ<?php } ?><?php if( $site_variables["user_info"]["user_type"] == 12){ ?>Менеджер<?php } ?><?php if( $site_variables["user_info"]["user_type"] == 6){ ?>Рабочий<?php } ?><br>
Дата регистрации: <?php echo $site_variables["user_info"]["register_date"]; ?><br>
Email: <?php echo $site_variables["user_info"]["name"]; ?><br>
  <?php include(__DIR__."/../blocks/activityTemplate.php"); ?>  
 </div> <!-- /#content-container -->					
</div> <!-- #content -->

