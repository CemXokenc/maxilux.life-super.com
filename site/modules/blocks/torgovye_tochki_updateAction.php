<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "torgovye_tochki_update" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("torgovye_tochki"));
   }
 $torgovye_tochki_update_id = $this->getVariable("id");

 if($this->isPost() && $do == "torgovye_tochki_update"){
 $torgovye_tochki_img = "";
 if($_FILES["torgovye_tochki_img"]["error"] == UPLOAD_ERR_OK) {
   $torgovye_tochki_img = "1";
 }
   $torgovye_tochki_name = $this->getVariable("torgovye_tochki_name");
   $torgovye_tochki_telephone = $this->getVariable("torgovye_tochki_telephone");
   $torgovye_tochki_email = $this->getVariable("torgovye_tochki_email");
   $torgovye_tochki_city = $this->getVariable("torgovye_tochki_city");
   $torgovye_tochki_zip_code = $this->getVariable("torgovye_tochki_zip_code");
   $torgovye_tochki_street = $this->getVariable("torgovye_tochki_street");
   $torgovye_tochki_house = $this->getVariable("torgovye_tochki_house");
   $torgovye_tochki_napravlenie_id = $this->getVariable("torgovye_tochki_napravlenie_id");
   $torgovye_tochki_office = $this->getVariable("torgovye_tochki_office");
   $torgovye_tochki_skidka_id = $this->getVariable("torgovye_tochki_skidka_id");
   
   $data = array("name"=>$torgovye_tochki_name, "telephone"=>$torgovye_tochki_telephone, "email"=>$torgovye_tochki_email, "city"=>$torgovye_tochki_city, "zip_code"=>$torgovye_tochki_zip_code, "street"=>$torgovye_tochki_street, "house"=>$torgovye_tochki_house, "napravlenie_id"=>$torgovye_tochki_napravlenie_id, "office"=>$torgovye_tochki_office, "skidka_id"=>$torgovye_tochki_skidka_id, );
 if($_FILES["torgovye_tochki_img"]["error"] == UPLOAD_ERR_OK) {
   $data["img"] = $torgovye_tochki_img;
 }

   $this->db->where("id", $torgovye_tochki_update_id)->update("torgovye_tochki",$data);

   
 $uploads_dir     = dirname(__FILE__)."/../../templates/img/torgovye_tochki/";
 if($_FILES["torgovye_tochki_img"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["torgovye_tochki_img"]["tmp_name"];
   $name = $torgovye_tochki_update_id;
   move_uploaded_file($tmp_name, "$uploads_dir/{$name}.jpg");
 }
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["torgovye_tochki"] = "Данные успешно сохранены";
   $this->redirect($this->l("torgovye_tochki"));
 }
 $torgovye_tochki_update_data = $this->db->where("id", $torgovye_tochki_update_id)->get("torgovye_tochki")->result();
 $this->r_v("torgovye_tochki_update_data",$torgovye_tochki_update_data[0]);

$napravlenie= array();
$dbnapravlenie= $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("napravlenie")->result();
for($i=0;$i<count($dbnapravlenie);$i++){
   $id_napravlenie =$dbnapravlenie[$i]['id'];
   $napravlenie[$id_napravlenie] = $dbnapravlenie[$i]['napravlenie'];
}
$this->ddb('torgovye_tochki_update_torgovye_tochki_napravlenie_id',$napravlenie);

$skidki_select = array(
'0' => "Не выбрана",
);
$dbskidki = $this->db->where("torgovaya_tochka_id",0)->where("company_id",$gl_session["session_data"]['company_id'])->get("skidki")->result();
for($i=0;$i<count($dbskidki);$i++){
  if($dbskidki[$i]['percent']!=0 && $dbskidki[$i]['name']!=""){
    $id_skidki=$dbskidki[$i]['id'];
    $skidki_select[$id_skidki] = $dbskidki[$i]['name']."(".$dbskidki[$i]['percent']."%)";
  }
}

$this->ddb('torgovye_tochki_update_torgovye_tochki_skidka_id',$skidki_select); 
