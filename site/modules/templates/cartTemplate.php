<link rel="stylesheet" href="<?php echo $site_variables["css_link"]; ?>?route=left_menu_main" type="text/css" />
<link rel="stylesheet" href="<?php echo $site_variables["css_link"]; ?>?route=cart" type="text/css" />
<?php include(__DIR__."/../blocks/left_menu_mainTemplate.php"); ?>

<div id="content">
 <div id="content-header">
  <h1><?php if( $site_variables["session_var_type_cart"] != 2){ ?>Корзина<?php } ?><?php if( $site_variables["session_var_type_cart"] == 2){ ?>Заявка<?php } ?></h1>
 </div> <!-- #content-header -->	
  <?php include(__DIR__."/../blocks/cartTemplate.php"); ?>   
 <div id="content-container">

 </div> <!-- /#content-container -->					
</div> <!-- #content -->

