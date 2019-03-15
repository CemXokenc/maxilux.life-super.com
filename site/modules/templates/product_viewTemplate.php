<link rel="stylesheet" href="<?php echo $site_variables["css_link"]; ?>?route=left_menu_main" type="text/css" />
<link rel="stylesheet" href="<?php echo $site_variables["css_link"]; ?>?route=product_view" type="text/css" />
<?php include(__DIR__."/../blocks/left_menu_mainTemplate.php"); ?>

<div id="content">
 <div id="content-header">
  <h1>Просмотр</h1>
 </div> <!-- #content-header -->	

 <div id="content-container">
  <a href="<?php echo $site_variables["back_url"]; ?>">назад</a><br>
  <?php include(__DIR__."/../blocks/product_viewTemplate.php"); ?>  
 </div> <!-- /#content-container -->					
</div> <!-- #content -->

