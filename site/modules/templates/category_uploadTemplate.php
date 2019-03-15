<link rel="stylesheet" href="<?php echo $site_variables["css_link"]; ?>?route=left_menu_main" type="text/css" />
<?php include(__DIR__."/../blocks/left_menu_mainTemplate.php"); ?>

<div id="content">
  <div id="content-header">
    <h1>Редактирование категории склада</h1>
  </div> <!-- #content-header -->

  <div id="content-container">
    <div class="row">
      <div class="col-md-12">
        <div>
        <?php echo $site_variables["success"]; ?>
        </div>
        <form method="post" enctype="multipart/form-data">
          <div class="form_item">
            <label>Загрузить CSV файл</label>
            <input type="file" name="csv_file">
          </div>
          <input type="submit" name="cmd" value="Загрузить" />
        </form>
      </div>
    </div>
  </div> <!-- /#content-container -->
</div> <!-- #content -->

