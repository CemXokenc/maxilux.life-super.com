<link rel="stylesheet" href="<?php echo $site_variables["css_link"]; ?>?route=left_menu_main" type="text/css" />
<link rel="stylesheet" href="<?php echo $site_variables["css_link"]; ?>?route=vozvrat_update" type="text/css" />
<?php include(__DIR__."/../blocks/left_menu_mainTemplate.php"); ?>

<div id="content">
  <div id="content-header">
    <h1>Управление возвратами</h1>
  </div> <!-- #content-header -->

  <div id="content-container">
    <?php include(__DIR__."/../blocks/vozvrat_updateTemplate.php"); ?>
  </div> <!-- /#content-container -->
</div> <!-- #content -->

