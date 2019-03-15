<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "users_create" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("users"));
   }

 if($this->isPost() && $do == "users_create"){
 $users_img = "";
 if($_FILES["users_img"]["error"] == UPLOAD_ERR_OK) {
   $users_img = "1";
 }
 $users_img = "";
 if($_FILES["users_img"]["error"] == UPLOAD_ERR_OK) {
   $users_img = "1";
 }
   $users_name = $this->getVariable("users_name");
   $users_name = $this->getVariable("users_name");
   $users_first_name = $this->getVariable("users_first_name");
   $users_first_name = $this->getVariable("users_first_name");
   $users_last_name = $this->getVariable("users_last_name");
   $users_last_name = $this->getVariable("users_last_name");
   $users_pass = $this->getVariable("users_pass");
   $users_pass = $this->getVariable("users_pass");
   $users_user_type = $this->getVariable("users_user_type");
   $users_user_type = $this->getVariable("users_user_type");
   $users_type_group = $this->getVariable("users_type_group");
   $users_type_group = $this->getVariable("users_type_group");
   $users_office_id = $this->getVariable("users_office_id");
   $users_office_id = $this->getVariable("users_office_id");
   

$users_pass = md5($users_pass);


   $data = array("name"=>$users_name, "name"=>$users_name, "first_name"=>$users_first_name, "first_name"=>$users_first_name, "last_name"=>$users_last_name, "last_name"=>$users_last_name, "pass"=>$users_pass, "pass"=>$users_pass, "user_type"=>$users_user_type, "user_type"=>$users_user_type, "register_date"=>$users_register_date, "register_date"=>$users_register_date, "type_group"=>$users_type_group, "type_group"=>$users_type_group, "office_id"=>$users_office_id, "office_id"=>$users_office_id, );
 if($_FILES["users_img"]["error"] == UPLOAD_ERR_OK) {
   $data["img"] = $users_img;
 }
 if($_FILES["users_img"]["error"] == UPLOAD_ERR_OK) {
   $data["img"] = $users_img;
 }

   $users_create_id = $this->db->insert("users",$data)->result();

   
 $uploads_dir     = dirname(__FILE__)."/../../templates/img/users/";
 if($_FILES["users_img"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["users_img"]["tmp_name"];
   $name = $users_create_id;
   move_uploaded_file($tmp_name, "$uploads_dir/{$name}.jpg");
 }
 $uploads_dir     = dirname(__FILE__)."/../../templates/img/users/";
 if($_FILES["users_img"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["users_img"]["tmp_name"];
   $name = $users_create_id;
   move_uploaded_file($tmp_name, "$uploads_dir/{$name}.jpg");
 }
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["users"] = "Пользователь успешно добавлен";
   $this->redirect($this->l("users"));
 }

$change_type = $this->get('change_type');
if($this->isPost() && $change_type==1){
  $type_group = $this->get('type_group');
  $groups = array();
  $select = "";
     if($type_group==5){$groups = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("type",0)->get("users_group")->result();}
     if($type_group ==6){$groups = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("type",1)->get("users_group")->result();}
     if($type_group ==12){$groups = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("type",2)->get("users_group")->result();}
     for($i=0;$i<count($groups);$i++){
         $select .= "<option value=".$groups[$i]['id'].">".$groups[$i]['name']."</option>";
     }
        echo json_encode(array('select' => $select));
        exit();
}
global $system_user_type;
$this->ddb('users_create_users_user_type',$system_user_type);

$groups_type = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("users_group")->result();
$type_array = array();
for($i=0; $i< count($groups_type);$i++){
    $id_type =  $groups_type[$i]['id'];
    $type_array[$id_type] = $groups_type[$i]['name'];
}
$this->ddb('users_create_users_type_group', $type_array);

$torgovye_tochki_db = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("torgovye_tochki")->result();
$torgovye_tochki= array();
for($i=0; $i< count($torgovye_tochki_db);$i++){
    $id_torgovye_tochki =  $torgovye_tochki_db[$i]['id'];
    $torgovye_tochki[$id_torgovye_tochki] = $torgovye_tochki_db[$i]['name'];
}
$this->ddb('users_create_users_office_id', $torgovye_tochki); 
