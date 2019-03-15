<form action="" method="post" id="id_form">
<input type="hidden" name="type" value="move_tovar" method="post">
<div class="" style="width: 700px;">
  <h2>Переместить товар</h2>
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
    <br>
     <div class="col-sm-2" style="width: 340px;">
      Товар: <select id="product" class="tovar_select form-control" name="tovar_id">
                  <option value="0"></option>
                  </select></span>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-2" style="width: 340px;">
      Со склада:
      <select id="sklad_1" class="tovar_select form-control" name="sklad_1">
        <?php foreach($site_variables["sklads"] as $site_variables["key"]=>$site_variables["sklad"]){ ?>
        <option value="<?php echo $site_variables["key"]; ?>"><?php echo $site_variables["sklad"]; ?></option>
        <?php } ?>
      </select>
       <span style="display:none;width: 340px;">Сейчас на складе:<span id="cnt_sklad_1"></span></span>
    </div>
     <div class="col-sm-2" style="width: 340px;">
      На склад:
      <select id="sklad_2" class="tovar_select form-control" name="sklad_2">
        <?php foreach($site_variables["sklads"] as $site_variables["key"]=>$site_variables["sklad"]){ ?>
        <option value="<?php echo $site_variables["key"]; ?>"><?php echo $site_variables["sklad"]; ?></option>
        <?php } ?>
      </select>
       <span style="display:none;width: 340px;">Сейчас на складе:<span id="cnt_sklad_2"></span></span>
    </div>
 <select id="categories_all" style="display:none;">          /*      скрытый select    */
  <option selected value="0">Выберите категорию</option>
  <?php foreach($site_variables["categories"] as $site_variables["key"]=>$site_variables["category"]){ ?>
  <option value="<?php echo $site_variables["key"]; ?>"><?php echo $site_variables["category"]; ?></option>
  <?php } ?>
  </select>
  </div>
 <div class="row">
   <div class="col-sm-2" style="width: 340px;">
      Количество: <input class="form-control" type="text" id="cnt" name="cnt" value="">
    </div>
</div>
</div>
<button type="button" id="btn_submit" class="btn btn-large btn-primary">Переместить</button>
 </form>

<script type="text/javascript">
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
        var sklad_1 = $('#sklad_1').val();
        var sklad_2 = $('#sklad_2').val();
        $.ajax({
            dataType: 'json',
            type: "POST",
            url: "",
            data:{"type":"tovar_change","tovar_id":tovar_id,"sklad_1":sklad_1,"sklad_2":sklad_2},
            success: function(html){
                 $('#cnt_sklad_1').parent("span").show();
                 $('#cnt_sklad_2').parent("span").show();
                 $('#cnt_sklad_1').html(html.sklad_1_cnt);
                 $('#cnt_sklad_2').html(html.sklad_2_cnt);
            }

    });

 });
 
  $("#sklad_1").change(function(){
        var tovar_id = $("#product").val();
        var sklad_1 = $(this).val();
        $.ajax({
            dataType: 'json',
            type: "POST",
            url: "",
            data:{"type":"sklad","tovar_id":tovar_id,"sklad":sklad_1},
            success: function(html){
                 $('#cnt_sklad_1').parent("span").show();
                 $('#cnt_sklad_1').html(html.sklad_cnt);
            }

    });

 });

  $("#sklad_2").change(function(){
  var tovar_id = $("#product").val();
  if(tovar_id>0){
        var tovar_id = $("#product").val();
        var sklad_2 = $(this).val();
        $.ajax({
            dataType: 'json',
            type: "POST",
            url: "",
            data:{"type":"sklad","tovar_id":tovar_id,"sklad":sklad_2},
            success: function(html){
                 $('#cnt_sklad_2').parent("span").show();
                 $('#cnt_sklad_2').html(html.sklad_cnt);
            }

    });
  }
  else{
     alert("Выберите товар");
  }
 });


$("#btn_submit").click(function () {
      var cnt = $('#cnt').val();
      var count_sklad = $('#cnt_sklad_1').html();
      var tovar = $("#product").val();
      if(tovar==0){
          alert("Не выбран товар");
          return 0;
      }
     cnt = parseInt(cnt, 10);
     if(isNaN(cnt) || cnt <1 || cnt>count_sklad){
       alert("Введите корректное значение");
       return 0;
     }
     $("#id_form").submit();
    });
</script>

