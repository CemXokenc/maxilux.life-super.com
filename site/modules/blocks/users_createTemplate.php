<form id='block-users_create' method='post' enctype='multipart/form-data' />
  <div class='form_item '>
   <label for='users_img'>Изображение</label>
   <input type='file' id='id_users_img' name='users_img' />
  </div>
  <div class='form_item '>
   <label for='users_name'>Никнейм</label>
   <input class='form-control' type='text'  id='id_users_name' name='users_name' value='<?php  echo $site_variables["users_create_data"]["name"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='users_first_name'>Имя</label>
   <input class='form-control' type='text'  id='id_users_first_name' name='users_first_name' value='<?php  echo $site_variables["users_create_data"]["first_name"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='users_last_name'>Фамилия</label>
   <input class='form-control' type='text'  id='id_users_last_name' name='users_last_name' value='<?php  echo $site_variables["users_create_data"]["last_name"]; ?>' />
  </div>
  <div class='form_item '>
   <label for='users_pass'>Пароль</label>
   <input class='form-control' type='text'  id='id_users_pass' name='users_pass' value='<?php  echo $site_variables["users_create_data"]["pass"]; ?>' />
  </div>
  <div class='form_item  item-id-users-user_type'>
   <label for='users_user_type'>Тип</label>
   <select name='users_user_type' class='form-control'>
 <?php foreach($site_variables["select_users_create_users_user_type"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_create_data"]["user_type"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>
  <div class='form_item  item-id-users-type_group'>
   <label for='users_type_group'>Тип группы</label>
   <select name='users_type_group' class='form-control'>
 <?php foreach($site_variables["select_users_create_users_type_group"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_create_data"]["type_group"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>
  <div class='form_item  item-id-users-office_id'>
   <label for='users_office_id'>Офис</label>
   <select name='users_office_id' class='form-control'>
 <?php foreach($site_variables["select_users_create_users_office_id"] as $site_variables["key"]=>$site_variables["item"]){ ?>
 <option value='<?php echo $site_variables["key"] ?>' <?php if($site_variables["key"] == $site_variables["users_create_data"]["office_id"]){echo "selected";} ?>><?php echo $site_variables["item"] ?></option>
 <?php } ?>
</select>

  </div>
 <input type="hidden" name="do" value="users_create">
 <input type="submit" value="Сохранить изменения">
 <input name="cmd" type="submit" value="Отмена">
</form>

<script>
$("select", $('.item-id-users-user_type')).change(function(){
  var type_group = $(this).val();
  if(type_group == 12){
    $(".item-id-users-office_id").show();
  }
  else{
     $(".item-id-users-office_id").hide();
  }
$.ajax({  
                dataType: 'json',
                type: "POST",
                url: "",   
                data:{"change_type":"1","type_group":type_group},
                success: function(html){  
                    $(".item-id-users-type_group").children("select").html(html.select);
                }  
            }); 
});
  var type_group = $("select", $('.item-id-users-user_type')).val();
  if(type_group != 12){
     $(".item-id-users-office_id").hide();
  }
</script>

