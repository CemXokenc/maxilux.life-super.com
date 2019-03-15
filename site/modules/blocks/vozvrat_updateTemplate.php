<form action="" method="post" id="vozvrat_update" enctype="multipart/form-data">
  <input type="hidden" id="redirect" name="redirect" value="">
  <input type="hidden" name="type" value="save_vozvrat">
  <table class="table table-bordered">
    <thead>
    <tr>
      <th>№</th>
      <th>Поставщик</th>
      <th>Номер наклодной</th>
      <th>Дата возврата</th>
      <th>Сумма</th>
      <th>Валюта</th>
    </tr>
    </thead>
    <tbody>

    <tr>
      <td style="width:50px;"><?php echo $site_variables["vozvrat"]["nomer"]; ?> </td>
      <td style="width:250px;"><select name="postavshik" class="form-control">
          <?php foreach($site_variables["postavshiki"] as $site_variables["postavshik"]){ ?>
          <option <?php if( $site_variables["postavshik"]["id"] == $site_variables["vozvrat"]["postavshik_id"] ){ ?>selected<?php } ?> value="<?php echo $site_variables["postavshik"]["id"]; ?>"><?php echo $site_variables["postavshik"]["name"]; ?></option>
          <?php } ?>
        </select>
      </td>
      <td><input type="text" class="form-control" name="nomer_naklodnoy" <?php if( $site_variables["vozvrat"]["nomer_naklodnoy"] != "" ){ ?>value="<?php echo $site_variables["vozvrat"]["nomer_naklodnoy"]; ?>"<?php } ?>style="width:150px;"></td>
      <td>
        <div id="dp-ex-4" class="input-group date" data-auto-close="true" data-date="<?php if( $site_variables["vozvrat"]["data_postupleniya"] > 0 ){ ?><?php echo $site_variables["vozvrat"]["data_postupleniya"]; ?><?php }else{ ?>01-02-2014<?php } ?>" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
          <input  name="data_postupleniya" value="<?php if( $site_variables["vozvrat"]["data_postupleniya"] > 0 ){ ?><?php echo $site_variables["vozvrat"]["data_postupleniya"]; ?><?php }else{ ?><?php echo $site_variables["data_postupleniya"]; ?><?php } ?>" class="form-control" type="text">
          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
      </td>
      <td style="width:150px;"><input class="form-control" type="text" name="summa" <?php if( $site_variables["vozvrat"]["summa"] > 0 ){ ?>value="<?php echo $site_variables["vozvrat"]["summa"]; ?>"<?php } ?>></td>
      <td style="width:150px;">
        <select id="valuta" name="valuta"  class="form-control">

          <?php foreach($site_variables["valuty"] as $site_variables["valuta"]){ ?>
          <option <?php if( $site_variables["valuta"]["kod_valuty"]== $site_variables["vozvrat"]["valuta"]){ ?>selected<?php } ?> value="<?php echo $site_variables["valuta"]["kod_valuty"]; ?>"><?php echo $site_variables["valuta"]["name"]; ?></option>
          <?php } ?>
        </select>
      </td>
    </tr>
    </tbody>
  </table>



  <div id="table_products"><?php echo $site_variables["table"]; ?></div>

  <div class="" style="width: 700px;">
    <h2>Добавить товар</h2>
    <hr />
    <div class="row">
      <div class="col-sm-2" style="width: 340px;">
        <select id="categories_1" class="form-control">
          <option selected value="0">Выберите категорию</option>
          <?php foreach($site_variables["categories_1"] as $site_variables["category"]){ ?>
          <option value="<?php echo $site_variables["category"]["id"]; ?>"><?php echo $site_variables["category"]["name"]; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-sm-2" style="width: 340px;">
        <select id="categories_2"  class="form-control">
          <option selected value="0">Выберите категорию</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-2" style="width: 340px;">
        <select id="categories_3"  class="form-control">
          <option selected value="0">Выберите категорию</option>
        </select>
      </div>
      <div class="col-sm-2" style="width: 340px;">
        <select id="categories_4"  class="form-control">
          <option selected value="0">Выберите категорию</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-2" style="width: 340px;">
        Склад:
        <select id="sklad" class="tovar_select form-control">
          <?php foreach($site_variables["sklads"] as $site_variables["key"]=>$site_variables["sklad"]){ ?>
          <option value="<?php echo $site_variables["key"]; ?>"><?php echo $site_variables["sklad"]; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-sm-2" style="width: 340px;">
        Товар: <select id="product" class="tovar_select form-control"></select></span>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-2" style="width: 340px;">
        Количество: <input class="form-control" type="text" id="cnt" value="">
      </div>
      <div class="col-sm-2" style="width: 340px;">
        Причина: <input class="form-control" type="text" id="prichina" value="">
      </div>
      <div class="col-sm-2" style="width: 340px;">
        Цена: <input type="text" id="price" value="" class="form-control" style="width: 100px;display: inline-block;margin-left: 10px;margin-right: 10px;"><span id="type_valuta"></span>

        Цена на складе:<span id="price_sklad"></span><br>
        <span style="display:none;">Изменить цену на складе<span id="price_na_sklade"></span> <input type="checkbox" id="change_price"></span>
      </div>
    </div>

  </div>
  <select id="categories_all" style="display:none;">
    <option selected value="0">Выберите категорию</option>
    <?php foreach($site_variables["categories"] as $site_variables["key"]=>$site_variables["category"]){ ?>
    <option value="<?php echo $site_variables["key"]; ?>"><?php echo $site_variables["category"]; ?></option>
    <?php } ?>
  </select>

  <button type="button" id="add_tovar" class="btn btn-large">Добавить товар</button><br><br>
  <button type="submit" class="btn btn-large btn-primary">Сохранить</button>
</form>
<div id="kurs_euro" style="display:none;"><?php echo $site_variables["valuta_info"]["euro"]; ?></div>
<div id="kurs_dollars" style="display:none;"><?php echo $site_variables["valuta_info"]["dollars"]; ?></div>
<script type="text/javascript">

$('#add_tovar').click(function(){
  var sklad = $('#sklad').val();
  var product = $('#product').val();
  var cnt = $('#cnt').val();
  var prichina = $('#prichina').val();
  var price = $('#price').val();
  var change_price = $("#change_price").prop("checked");
  $.ajax({
    dataType: 'json',
    type: "POST",
    url: "",
    data:{"type":"refresh","sklad":sklad,"product":product,"cnt":cnt,"prichina":prichina,"price":price,"change_price":change_price},
    success: function(html){
      $("#table_products").html(html.table);

    }
  });
});

$( "body" ).delegate( ".tovar_delete", "click", function() {
  var tovar_id = $(this).attr("product-id");
  $.ajax({
    dataType: 'json',
    type: "POST",
    url: "",
    data:{"type":"delete","tovar_id":tovar_id},
    success: function(html){
      $("#table_products").html(html.table);

    }
  });
});

$( "body" ).delegate( ".tovar_edit", "click", function() {
  var tovar_id = $(this).attr("product-id");
  var cnt_tovar =   $(this).parent("td").prev().prev().prev().children(".cnt").html();
  var cnt = "<input type='text' value='"+cnt_tovar+"'>";
  var price_tovar =   $(this).parent("td").prev().prev().children(".price").html();
  var price = "<input type='text' value='"+price_tovar+"'>";
  var btn_edit = "<span class='label label-primary tovar_save' product-id='"+tovar_id +"'>Изменить</span>"+" <span class='label label-default tovar_cancel' product-id='"+tovar_id +"'>Отменить</span>";
  $(this).parent("td").prev().prev().prev().children(".cnt_edit").html(cnt);
  $(this).parent("td").prev().prev().prev().children(".cnt").hide();
  $(this).parent("td").prev().prev().children(".price_edit").html(price);
  $(this).parent("td").prev().prev().children(".price").hide();
  $(this).parent("td").children(".class_edit").html(btn_edit);
  $(this).next().hide();
  $(this).hide();

});

$( "body" ).delegate( ".tovar_cancel", "click", function() {
  $(this).parent("span").parent("td").prev().prev().children(".price").show();
  $(this).parent("span").parent("td").prev().prev().children(".price_edit").html(" ");
  $(this).parent("span").parent("td").prev().prev().prev().children(".cnt_edit").html(" ");
  $(this).parent("span").parent("td").prev().prev().prev().children(".cnt").show();
  $(this).parent("span").prev().prev().show();
  $(this).parent("span").prev().show();
  $(this).parent("span").html(" ");
});

$( "body" ).delegate( ".tovar_save", "click", function() {
  var tovar_id = $(this).attr("product-id");
  var cnt = $(this).parent("span").parent("td").prev().prev().prev().children(".cnt_edit").children("input").val();
  var price = $(this).parent("span").parent("td").prev().prev().children(".price_edit").children("input").val();
  $.ajax({
    dataType: 'json',
    type: "POST",
    url: "",
    data:{"type":"update","tovar_id":tovar_id,"cnt":cnt,"price":price},
    success: function(html){
      $("#table_products").html(html.table);
    }
  });
});

$("#categories_all").change(function(){
  var category_id = $(this).val();

  $.ajax({
    dataType: 'json',
    type: "POST",
    url: "",
    data:{"type":"category","category_id":category_id},
    success: function(html){
      $("#product").html(html.table);

    }
  });
});

$("#product").change(function(){
  var tovar_id = $(this).val();
  var valuta = $("#valuta").val();
  $.ajax({
    dataType: 'json',
    type: "POST",
    url: "",
    data:{"type":"tovar_change","tovar_id":tovar_id,"valuta":valuta},
    success: function(html){
      $("#price").val(html.price_valuta);
      $("#price_sklad").html(html.price);
      $("#type_valuta").html(html.type_valuta);
      if(html.type_valuta != "грн"){
        var valuta_sklad = " или "+(html.price/html.kurs_valut).toFixed(2)+" "+html.type_valuta;
        $("#ili").html(valuta_sklad );
      }



    }
  });


});

$("#categories_1").change(function(){
  var category_id = $(this).val();
  $("#categories_all [value="+category_id+" ]").attr("selected", "selected");
  $("#categories_all").trigger("change");;
  $("#categories_2 [value='0']").attr("selected", "selected");
  $("#categories_3 [value='0']").attr("selected", "selected");
  $("#categories_4 [value='0']").attr("selected", "selected");
  $.ajax({
    dataType: 'json',
    type: "POST",
    url: "",
    data:{"type":"change_category","category_id":category_id},
    success: function(html){
      $("#categories_2").html(html.select);

    }
  });


});

$("#categories_2").change(function(){
  var category_id = $(this).val();
  $("#categories_all [value="+category_id+" ]").attr("selected", "selected");
  $("#categories_all").trigger("change");
  $("#categories_3 [value='0']").attr("selected", "selected");
  $("#categories_4 [value='0']").attr("selected", "selected");
  $.ajax({
    dataType: 'json',
    type: "POST",
    url: "",
    data:{"type":"change_category","category_id":category_id},
    success: function(html){
      $("#categories_3").html(html.select);

    }
  });


});

$("#categories_3").change(function(){
  var category_id = $(this).val();
  $("#categories_all [value="+category_id+" ]").attr("selected", "selected");
  $("#categories_all").trigger("change");
  $("#categories_4 [value='0']").attr("selected", "selected");
  $.ajax({
    dataType: 'json',
    type: "POST",
    url: "",
    data:{"type":"change_category","category_id":category_id},
    success: function(html){
      $("#categories_4").html(html.select);

    }
  });


});

$("#categories_4").change(function(){
  var category_id = $(this).val();
  $("#categories_all [value="+category_id+" ]").attr("selected", "selected");
  $("#categories_all").trigger("change");



});

$('#price').keyup(function(e) {
  var price = $(this).val();
  var valuta = $('#valuta').val();
  if(valuta == "evro"){
    var kurs_evro = $('#kurs_euro').html();
    price = price*kurs_evro;
  }

  if(valuta == "dollars"){
    var kurs_dollars = $('#kurs_dollars').html();
    price = price*kurs_dollars;
  }


  var price = " на "+price+" грн ";
  $("#price_na_sklade").html(price);
});

$("#price").change(function(){
  var price = $(this).val();
  var valuta = $('#valuta').val();

  var price = " на "+price;
  $("#price_na_sklade").html(price);
});

$("#valuta").change(function(){
  $("#redirect").val(1);
  $("#vozvrat_update").submit();
});
</script>

