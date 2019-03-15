<form id='block-products_update' method='post' enctype='multipart/form-data' />
  <div class='form_item '>
   <label for='products_name'>Наименование</label>
   <input class='form-control' type='text'  id='id_products_name' name='products_name' value='<?php  echo $site_variables["products_update_data"]["name"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='products_category_id'>Категория</label>
   <select name='products_category_id' class='form-control'>
 <?php foreach($site_variables["select_products_update_products_category_id"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["products_update_data"]["category_id"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='products_price'>Цена</label>
   <input class='form-control' type='text'  id='id_products_price' name='products_price' value='<?php  echo $site_variables["products_update_data"]["price"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='products_currency'>Валюта</label>
   <select name='products_currency' class='form-control'>
 <?php foreach($site_variables["select_products_update_products_currency"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["products_update_data"]["currency"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>

  <div class='form_item '>
   <label for='products_cnt'>Количество</label>
   <input class='form-control' type='text'  id='id_products_cnt' name='products_cnt' value='<?php  echo $site_variables["products_update_data"]["cnt"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='products_ves'>Вес</label>
   <input class='form-control' type='text'  id='id_products_ves' name='products_ves' value='<?php  echo $site_variables["products_update_data"]["ves"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='products_shirina'>Ширина</label>
   <input class='form-control' type='text'  id='id_products_shirina' name='products_shirina' value='<?php  echo $site_variables["products_update_data"]["shirina"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='products_vysota'>Высота</label>
   <input class='form-control' type='text'  id='id_products_vysota' name='products_vysota' value='<?php  echo $site_variables["products_update_data"]["vysota"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='products_glubina'>Глубина</label>
   <input class='form-control' type='text'  id='id_products_glubina' name='products_glubina' value='<?php  echo $site_variables["products_update_data"]["glubina"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='products_izmerenie'>Измерение</label>
   <input class='form-control' type='text'  id='id_products_izmerenie' name='products_izmerenie' value='<?php  echo $site_variables["products_update_data"]["izmerenie"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='products_description'>Описание</label>
   <textarea class='form-control'  id='id_products_description' name='products_description'><?php  echo $site_variables["products_update_data"]["description"]; ?></textarea>
  </div>

<div id="table_images"><?php echo $site_variables["images"]; ?></div>
<!-- The fileinput-button span is used to style the file input field as button -->
<span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Загрузить Картинки...</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]" multiple>
    </span>

<br>
<!-- The global progress bar -->
<div id="progress" class="progress">
  <div class="progress-bar progress-bar-success"></div>
</div>
<!-- The container for the uploaded files -->
<div id="files" class="files"></div>
  <div class='form_item '>
   <label for='products_min_zapas'>мин. запас</label>
   <input class='form-control' type='text'  id='id_products_min_zapas' name='products_min_zapas' value='<?php  echo $site_variables["products_update_data"]["min_zapas"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='products_sred_zapas'>ср. запас</label>
   <input class='form-control' type='text'  id='id_products_sred_zapas' name='products_sred_zapas' value='<?php  echo $site_variables["products_update_data"]["sred_zapas"]; ?>' />
  </div>

  <div class='form_item '>
   <label for='products_max_zapas'>макс. запас</label>
   <input class='form-control' type='text'  id='id_products_max_zapas' name='products_max_zapas' value='<?php  echo $site_variables["products_update_data"]["max_zapas"]; ?>' />
  </div>

 <input type="submit" value="Сохранить">
 <input name="cmd" type="submit" type="submit" value="Отменить"> <input type="hidden" name="do" value="products_update">
</form>

<link rel="stylesheet" href="<?php echo $site_variables["template_dir"]; ?>jquery-uploader/css/jquery.fileupload.css">

<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>

<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo $site_variables["template_dir"]; ?>jquery-uploader/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo $site_variables["template_dir"]; ?>jquery-uploader/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo $site_variables["template_dir"]; ?>jquery-uploader/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo $site_variables["template_dir"]; ?>jquery-uploader/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo $site_variables["template_dir"]; ?>jquery-uploader/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo $site_variables["template_dir"]; ?>jquery-uploader/js/jquery.fileupload-validate.js"></script>
<script>
  $(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '<?php echo $site_variables["main_img_domain"]; ?>upload/<?php echo $site_variables["product_id"]; ?>.html',
      uploadButton = $('<button/>')
        .addClass('btn btn-primary')
        .prop('disabled', true)
        .text('Processing...')
        .on('click', function () {
          var _this = $(this),
            data = _this.data();
          _this
            .off('click')
            .text('Abort')
            .on('click', function () {
              _this.remove();
              data.abort();
            });
          data.submit().always(function () {
            _this.remove();
          });
        });
    $('#fileupload').fileupload({
      url: url,
      dataType: 'json',
      autoUpload: false,
      acceptFileTypes: /(\.|\/)(gif|jpe?g|png)<?php echo $site_variables["dollar"]; ?>/i,
      maxFileSize: 5000000, // 5 MB
      // Enable image resizing, except for Android and Opera,
      // which actually support image resizing, but fail to
      // send Blob objects via XHR requests:
      disableImageResize: /Android(?!.*Chrome)|Opera/
        .test(window.navigator.userAgent),
      previewMaxWidth: 100,
      previewMaxHeight: 100,
      previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
          var node = $('<p/>')
            .append($('<span/>').text(file.name));
          if (!index) {
            node
              .append('<br>')
              .append(uploadButton.clone(true).data(data));
          }
          node.appendTo(data.context);
        });
      }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
          file = data.files[index],
          node = $(data.context.children()[index]);
        if (file.preview) {
          node
            .prepend('<br>')
            .prepend(file.preview);
        }
        if (file.error) {
          node
            .append('<br>')
            .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
          data.context.find('button')
            .attr("type", "button")
            .text('Загрузить')
            .prop('disabled', !!data.files.error);
        }
      }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
          'width',
          progress + '%'
        );
      }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
          if (file.url) {
            var link = $('<a>')
              .attr('target', '_blank')
              .prop('href', file.url);
            $(data.context.children()[index])
              .wrap(link);
          } else if (file.error) {
            var error = $('<span class="text-danger"/>').text(file.error);
            $(data.context.children()[index])
              .append('<br>')
              .append(error);
          }
        });
      }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index, file) {
          var error = $('<span class="text-danger"/>').text('File upload failed.');
          $(data.context.children()[index])
            .append('<br>')
            .append(error);
        });
      }).prop('disabled', !$.support.fileInput)
      .parent().addClass($.support.fileInput ? undefined : 'disabled');
  });

  $( "body" ).delegate( ".images_delete", "click", function() {
    var image_id = $(this).attr("image-id");
    $.ajax({
      dataType: 'json',
      type: "POST",
      url: "",
      data:{"type":"delete_image","image_id":image_id},
      success: function(html){
        $("#table_images").html(html.table);

      }
    });
  });

  $( "body" ).delegate( ".images_edit", "click", function() {
   var name = $(this).parent("td").prev().children(".opisanie").html();
   var name_input= "<<?php echo $site_variables["textarea"]; ?> style='width:100%;height:50px;'>"+name+"</<?php echo $site_variables["textarea"]; ?>>";
  $(this).parent("td").prev().children(".opisanie_edit").html(name_input);
  $(this).parent("td").prev().children(".opisanie").hide();
  $(this).hide();
 $(this).next().hide();
   $(this).next().next().show();
  });

  $( "body" ).delegate( ".images_save", "click", function() {
    var image_id = $(this).attr("image-id");
    var opisanie = $(this).parent("td").prev().children(".opisanie_edit").children("textarea").val();
    $.ajax({
      dataType: 'json',
      type: "POST",
      url: "",
      data:{"type":"edit_image","image_id":image_id,"opisanie":opisanie},
      success: function(html){
        $("#table_images").html(html.table);

      }
    });
  });
</script>

 <script type="text/javascript" src="<?php echo $site_variables["template_dir"]; ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  window.onload = function() {
  CKEDITOR.replace('id_products_description');
};
</script>

