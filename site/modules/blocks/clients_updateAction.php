<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "clients_update" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("clients"));
   }
 $clients_update_id = $this->getVariable("id");

 if($this->isPost() && $do == "clients_update"){
   $clients_telephone2 = $this->getVariable("clients_telephone2");
   $clients_telephone1 = $this->getVariable("clients_telephone1");
   $clients_fio = $this->getVariable("clients_fio");
   $clients_email = $this->getVariable("clients_email");
   $clients_telephone = $this->getVariable("clients_telephone");
   $clients_torgovaya_tochka_id = $this->getVariable("clients_torgovaya_tochka_id");
   $clients_skidka_id = $this->getVariable("clients_skidka_id");
 $clients_img = "";
 if($_FILES["clients_img"]["error"] == UPLOAD_ERR_OK) {
   $clients_img = "1";
 }
   
   $data = array("telephone2"=>$clients_telephone2, "telephone1"=>$clients_telephone1, "fio"=>$clients_fio, "email"=>$clients_email, "telephone"=>$clients_telephone, "torgovaya_tochka_id"=>$clients_torgovaya_tochka_id, "skidka_id"=>$clients_skidka_id, );
 if($_FILES["clients_img"]["error"] == UPLOAD_ERR_OK) {
   $data["img"] = $clients_img;
 }

   $this->db->where("id", $clients_update_id)->update("clients",$data);

   
 $uploads_dir     = dirname(__FILE__)."/../../templates/img/clients/";
 if($_FILES["clients_img"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["clients_img"]["tmp_name"];
   $name = $clients_update_id;
   move_uploaded_file($tmp_name, "$uploads_dir/{$name}.jpg");
 }
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["clients"] = "Данные о клиенте успешно обновлены";
   $this->redirect($this->l("clients"));
 }
 $clients_update_data = $this->db->where("id", $clients_update_id)->get("clients")->result();
 $this->r_v("clients_update_data",$clients_update_data[0]);

$torg_tochki= array();
$dbtorg_tochki = $this->db->get("torgovye_tochki")->result();
for($i=0;$i<count($dbtorg_tochki);$i++){
   $id_torg_tochki =$dbtorg_tochki[$i]['id'];
   $torg_tochki[$id_torg_tochki] = $dbtorg_tochki[$i]['name'];
}

$this->ddb('clients_update_clients_torgovaya_tochka_id',$torg_tochki);

$skidki_select = array(
'0' => "Не выбрана",
);
$dbskidki = $this->db->where("torgovaya_tochka_id",$gl_session["session_data"]['torgovaya_tockka'])->where("company_id",$gl_session["session_data"]['company_id'])->get("skidki")->result();
$this->db->where("torgovaya_tochka_id", $gl_session["session_data"]['torgovaya_tockka']);
for($i=0;$i<count($dbskidki);$i++){
   if($dbskidki[$i]['percent']!=0 && $dbskidki[$i]['name']!=""){ 
     $id_skidki=$dbskidki[$i]['id'];
     $skidki_select[$id_skidki] = $dbskidki[$i]['name']."(".$dbskidki[$i]['percent']."%)";
   }
}

$this->ddb('clients_update_clients_skidka_id',$skidki_select); 
