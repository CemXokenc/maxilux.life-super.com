<link rel="stylesheet" href="<?php echo $site_variables["css_link"]; ?>?route=left_menu_main" type="text/css" />
<?php include(__DIR__."/../blocks/left_menu_mainTemplate.php"); ?>

<div id="content">
  <div id="content-header">
    <h1>Настройка Меню</h1>
  </div> <!-- #content-header -->

  <div id="content-container">
    <h3>Структура меню</h3>
    <div id="menu_category">
      <?php echo $site_variables["menu_table"]; ?>
    </div>

<div class="row">
      <div class="col-sm-2" style="width: 340px;">
        Название: <input class="form-control" type="text" id="menu_name" value="">
        Родительская категория:
        <?php echo $site_variables["parent_links"]; ?>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-2" style="width: 340px;display:none;">
        Ссылка:
        <select id="link" class="form-control">
          <?php foreach($site_variables["system_links"] as $site_variables["item"]){ ?>
          <option value="<?php echo $site_variables["item"]["id"]; ?>"><?php echo $site_variables["item"]["page_name"]; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
 <button type="button" id="add_menu" class="btn btn-large">Добавить</button>

  </div> <!-- /#content-container -->
</div> <!-- #content -->
<script type="text/javascript">
  $('#add_menu').click(function(){
    var menu_name = $('#menu_name').val();
    var link = $('#link').val();
    var parent_link= $("#parent_links").val();
    $.ajax({
      dataType: 'json',
      type: "POST",
      url: "",
      data:{"type":"refresh_menu","menu_name":menu_name,"link":link,"parent_link":parent_link},
      success: function(html){
        $("#menu_category").html(html.table);
        $("#parent_links").html(html.select_data);
        $("#parent_links").trigger("change");
      }
    });
  });
</script>


<script type="text/javascript">
 $( "body" ).delegate( ".link_delete", "click", function() {
        var link= $(this).attr("link-id");
        var status = confirm('Вы уверены что хотите удалить?');
        if(status == true){
            $.ajax({
                dataType: 'json',
                type: "POST",
                url: "",
                data:{"type":"delete","link_id":link},
                success: function(html){
                    $("#menu_category").html(html.table);
                    $("#parent_links").html(html.select_data);
                    $("#parent_links").trigger("change");
                }
            });
        }
    });

$("select", $('.col-sm-2')).change(function(){
  var parent_links = $("#parent_links").val();
  if(parent_links > 0){
      $("#link").parent("div").show();
  }else{
      $("#link").parent("div").hide();
   }

});

</script>

