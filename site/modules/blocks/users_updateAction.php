<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "users_update" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("users"));
   }
 $users_update_id = $this->getVariable("id");

 if($this->isPost() && $do == "users_update"){
   $users_type_group = $this->getVariable("users_type_group");
   $users_pass = $this->getVariable("users_pass");
   $users_name = $this->getVariable("users_name");
   $users_first_name = $this->getVariable("users_first_name");
   $users_last_name = $this->getVariable("users_last_name");
   $users_user_type = $this->getVariable("users_user_type");
   $users_office_id = $this->getVariable("users_office_id");
 $users_img = "";
 if($_FILES["users_img"]["error"] == UPLOAD_ERR_OK) {
   $users_img = "1";
 }
   
	$users_pass = md5($users_pass);

   $data = array("type_group"=>$users_type_group, "pass"=>$users_pass, "name"=>$users_name, "first_name"=>$users_first_name, "last_name"=>$users_last_name, "user_type"=>$users_user_type, "office_id"=>$users_office_id, );
 if($_FILES["users_img"]["error"] == UPLOAD_ERR_OK) {
   $data["img"] = $users_img;
 }

   $this->db->where("id", $users_update_id)->update("users",$data);

   
 $uploads_dir     = dirname(__FILE__)."/../../templates/img/users/";
 if($_FILES["users_img"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["users_img"]["tmp_name"];
   $name = $users_update_id;
   move_uploaded_file($tmp_name, "$uploads_dir/{$name}.jpg");
 }
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["users"] = "Данные о пользователе успешно обновлены";
   $this->redirect($this->l("users"));
 }
 $users_update_data = $this->db->where("id", $users_update_id)->get("users")->result();
 $this->r_v("users_update_data",$users_update_data[0]);


$change_type = $this->get('change_type');
if($this->isPost() && $change_type==1){
  $groups = array();
  $select = "";
     if($_POST['type_group']==5){$groups = $this->db->where("type",0)->get("users_group")->result();}
     if($_POST['type_group']==6){$groups = $this->db->where("type",1)->get("users_group")->result();}
     if($_POST['type_group']==12){$groups = $this->db->where("type",2)->get("users_group")->result();}
     for($i=0;$i<count($groups);$i++){
         $select .= "<option value=".$groups[$i]['id'].">".$groups[$i]['name']."</option>";
     }
        echo json_encode(array('select' => $select));
        exit();
}
global $system_user_type;
$this->ddb('users_update_users_user_type',$system_user_type);

$groups_type = $this->db->get("users_group")->result();
$type_array = array();
for($i=0; $i< count($groups_type);$i++){
    $id_type =  $groups_type[$i]['id'];
    $type_array[$id_type] = $groups_type[$i]['name'];
}
$this->ddb('users_update_users_type_group', $type_array);

$torgovye_tochki_db = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("torgovye_tochki")->result();
$torgovye_tochki= array();
for($i=0; $i< count($torgovye_tochki_db);$i++){
    $id_torgovye_tochki =  $torgovye_tochki_db[$i]['id'];
    $torgovye_tochki[$id_torgovye_tochki] = $torgovye_tochki_db[$i]['name'];
}
$this->ddb('users_update_users_office_id', $torgovye_tochki); 
