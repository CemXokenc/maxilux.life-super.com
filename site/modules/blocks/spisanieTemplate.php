<?php if( $site_variables["system_messages"] != "" ){ ?>
  <div class="alert alert-success">
  <a class="close" data-dismiss="alert" href="#" aria-hidden="true">x</a>
  <?php echo $site_variables["system_messages"]; ?>
 </div>
<?php } ?>
<form action="" method="post">
  <div class="btn-group display-inline pull-right text-align-left hidden-tablet" style="float: left !important;margin-bottom: 20px;">
    <button type="button" class="btn btn-xs btn-default" style="padding: 1px 3px;" onclick="$(this).next().toggle();">
      <i class="fa fa-cog fa-lg"></i> Фильтр
    </button>
    <div class="dropdown-menu dropdown-menu-xs pull-right" style="padding: 15px;width: 700px;left: 0px;">
 
     <div class="row">
        <div class="col-sm-6">
          <input class="form-control" placeholder="# заказа" type="text" id="order_num" name="order_num" value="<?php echo $site_variables["session_var_spisanie_order_num"]; ?>">
        </div>
     </div>
     <div class="row">
       <div class="col-sm-6">
       <select class="form-control" id="users" name="user">
          <option  value="">Пользователь</option>
           <?php foreach($site_variables["users_db"] as $site_variables["users"]){ ?>
             <option <?php if( $site_variables["users"]["id"] == $site_variables["session_var_spisanie_user"]){ ?>selected<?php } ?> value="<?php echo $site_variables["users"]["id"]; ?>"><?php echo $site_variables["users"]["first_name"]; ?> <?php echo $site_variables["users"]["last_name"]; ?></option>
           <?php } ?>
      </select>
      </div>
     </div>
<div class="row">
       <div class="col-sm-6">
          <select s name="client" class="form-control" >
            <option value="">Выберите клиента</option>
            <?php if( count($site_variables["clients"])>0){ ?>
            <?php foreach($site_variables["clients"] as $site_variables["client"]){ ?>
            <option <?php if( $site_variables["session_var_spisanie_client"] == $site_variables["client"]["id"]){ ?>selected<?php } ?> value="<?php echo $site_variables["client"]["id"]; ?>"><?php echo $site_variables["client"]["fio"]; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
   </div>
     <div class="row">
        <div class="col-sm-6">
          Дата:<br>
          C <div id="dp-ex-3" class="input-group date" data-auto-close="true" data-date="2014-01-01" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
            <input name="data_c" class="form-control" type="text" <?php if( $site_variables["session_var_spisanie_data_c"] != ""){ ?>value="<?php echo $site_variables["session_var_spisanie_data_c"]; ?>"<?php } ?>>
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
        <div class="col-sm-6">
          <br>До <div id="dp-ex-4" class="input-group date" data-auto-close="true" data-date="2014-01-01" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
            <input name="data_do" class="form-control" type="text" <?php if( $site_variables["session_var_spisanie_data_do"] != ""){ ?>value="<?php echo $site_variables["session_var_spisanie_data_do"]; ?>"<?php } ?>>
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-2" style="width: 340px;">
          <select id="categories_1" class="form-control" name="categories_1">
            <option selected value="0">Выберите категорию</option>
            <?php foreach($site_variables["categories_1"] as $site_variables["category"]){ ?>
            <option value="<?php echo $site_variables["category"]["id"]; ?>" <?php if( $site_variables["session_var_spisanie_category_1"] == $site_variables["category"]["id"]){ ?>selected<?php } ?>><?php echo $site_variables["category"]["name"]; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-sm-2" style="width: 340px;">
          <select id="categories_2" class="form-control" name="categories_2">
            <option selected value="0">Выберите категорию</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-2" style="width: 340px;">
          <select id="categories_3" class="form-control" name="categories_3">
            <option selected value="0">Выберите категорию</option>
          </select>
        </div>
        <div class="col-sm-2" style="width: 340px;">
          <select id="categories_4" class="form-control" name="categories_4">
            <option selected value="0">Выберите категорию</option>
          </select>
        </div>
      </div>
    <select id="categories_all" name="categories" style="display:none;">
<?php foreach($site_variables["categories"] as $site_variables["item"]){ ?>
<option value="0" selected>Не выбрано</option>
 <option <?php if( $site_variables["item"]["selected"] == 1 ){ ?>selected<?php } ?> value="<?php echo $site_variables["item"]["id"]; ?>"><?php echo $site_variables["item"]["name"]; ?></option>
<?php } ?>
</select>
      <button type="submit" name="cmd" class="btn btn-default">Фильтровать</button>
    </div>
  </div>


</form>
<table class="table table-bordered">
				        <thead>
				          <tr>
				            <th>Пользователь</th>
				            <th>Клиент</th>
				            <th>Товар</th>
				            <th>Количество</th>
				            <th>Время списания</th>
				            <th>Номер заказа</th>
				          </tr>
				        </thead>       
                                    <tbody>       
				          
                                         <?php if( count($site_variables["spisanie"])>0 ){ ?>
                                          <?php if(count($site_variables["spisanie"]) > 0){ ?>
 <?php   foreach($site_variables["spisanie"] as $spisanie_item){ ?>
<tr>
				            <td><?php echo $spisanie_item["users_first_name"]; ?> <?php echo $spisanie_item["users_last_name"]; ?></td>
				            <td><?php if( $site_variables["session_var_client_view"] == 1){ ?><a href="<?php echo $spisanie_item["actions_list"]["view_client"]; ?>"><?php echo $spisanie_item["clients_fio"]; ?></a><?php }else{ ?><?php echo $spisanie_item["clients_fio"]; ?><?php } ?></td>
				            <td><?php echo $spisanie_item["products_name"]; ?></td>
				            <td><?php echo $spisanie_item["spisanie_quantity"]; ?></td>
                                            <td><?php echo $spisanie_item["spisanie_operation_date"]; ?></td>
                                            <td><?php echo $spisanie_item["spisanie_order_id"]; ?></td>
</tr> <?php   } ?>
 <?php } ?>

                                         <?php } ?>
				        </tbody>
				      </table>
 <?php if( $site_variables["spisanie_navigation"] == 1 ){ ?>  
 <div class="pagination">  
  <ul>  
   <?php if( $site_variables["spisanie_num1"] > 1){ ?><li <?php if( $site_variables["spisanie_page_num"] == 1){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["spisanie_prev_url"]; ?>" class="ext_disabled"> < </a></li><?php } ?>  
   <?php if( $site_variables["spisanie_num1"] > 0){ ?><li <?php if( $site_variables["spisanie_page_num"] == $site_variables["spisanie_num1"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["spisanie_num_1_url"]; ?>" class="ext_disabled"><?php echo $site_variables["spisanie_num1"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["spisanie_num2"] > 0){ ?><li <?php if( $site_variables["spisanie_page_num"] == $site_variables["spisanie_num2"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["spisanie_num_2_url"]; ?>" class="ext_disabled"><?php echo $site_variables["spisanie_num2"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["spisanie_num3"] > 0){ ?><li <?php if( $site_variables["spisanie_page_num"] == $site_variables["spisanie_num3"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["spisanie_num_3_url"]; ?>" class="ext_disabled"><?php echo $site_variables["spisanie_num3"]; ?></a></li><?php } ?>  
   <?php if( $site_variables["spisanie_last_num"] > 3){ ?><li class="disabled"><a href="#" class="ext_disabled">...</a></li><?php } ?> 
   <?php if( $site_variables["spisanie_last_num"] != $site_variables["spisanie_num3"]){ ?><li <?php if( $site_variables["spisanie_page_num"] == $site_variables["spisanie_last_num"]){ ?>class="active"<?php } ?>><a href="<?php echo $site_variables["spisanie_last_url"]; ?>" class="ext_disabled"><?php echo $site_variables["spisanie_last_num"]; ?></a></li><?php } ?> 
   <?php if( $site_variables["spisanie_page_num"] < $site_variables["spisanie_last_num"]){ ?><li><a href="<?php echo $site_variables["spisanie_next_url"]; ?>" class="ext_disabled"> > </a></li><?php } ?>  
  </ul> 
 </div>  
 <?php } ?>  


<script>
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
                     var categories_2 = $("#categories_2").val();
                   if(categories_2 > 0){
                    $("#categories_2").trigger("change");
                 }
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
                     var categories_3 = $("#categories_3").val();
                if(categories_3 > 0){
                    $("#categories_3").trigger("change");
                 }
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
var categories_1 = $("#categories_1").val();
if(categories_1 > 0){
  $("#categories_1").trigger("change");
}
</script>

