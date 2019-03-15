<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "clients_create" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("clients"));
   }

 if($this->isPost() && $do == "clients_create"){
   $clients_fio = $this->getVariable("clients_fio");
   $clients_email = $this->getVariable("clients_email");
   $clients_telephone = $this->getVariable("clients_telephone");
   $clients_telephone1 = $this->getVariable("clients_telephone1");
   $clients_telephone2 = $this->getVariable("clients_telephone2");
   $clients_torgovaya_tochka_id = $this->getVariable("clients_torgovaya_tochka_id");
   $clients_skidka_id = $this->getVariable("clients_skidka_id");
 $clients_img = "";
 if($_FILES["clients_img"]["error"] == UPLOAD_ERR_OK) {
   $clients_img = "1";
 }
   
 $clients_company_id = $gl_session["session_data"]['company_id'];

   $data = array("fio"=>$clients_fio, "email"=>$clients_email, "telephone"=>$clients_telephone, "telephone1"=>$clients_telephone1, "telephone2"=>$clients_telephone2, "company_id"=>$clients_company_id, "torgovaya_tochka_id"=>$clients_torgovaya_tochka_id, "skidka_id"=>$clients_skidka_id, );
 if($_FILES["clients_img"]["error"] == UPLOAD_ERR_OK) {
   $data["img"] = $clients_img;
 }

   $clients_create_id = $this->db->insert("clients",$data)->result();

   
 $data_operaciya = array(
     'company_id' => $gl_session["session_data"]['company_id'],
     'operation' => 3,
     'created' => date('Y-m-d H:i:s') ,
     'user_id' => $gl_session["session_data"]['user_id'],
     'details' => $clients_create_id,
   );
    $this->db->insert("activity",$data_operaciya);

 $uploads_dir     = dirname(__FILE__)."/../../templates/img/clients/";
 if($_FILES["clients_img"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["clients_img"]["tmp_name"];
   $name = $clients_create_id;
   move_uploaded_file($tmp_name, "$uploads_dir/{$name}.jpg");
 }
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["clients"] = "Клиент успешно добавлен";
   $this->redirect($this->l("clients"));
 }


$torg_tochki= array();
$dbtorg_tochki = $this->db->get("torgovye_tochki")->result();
for($i=0;$i<count($dbtorg_tochki);$i++){
   $id_torg_tochki =$dbtorg_tochki[$i]['id'];
   $torg_tochki[$id_torg_tochki] = $dbtorg_tochki[$i]['name'];
}

$this->ddb('clients_create_clients_torgovaya_tochka_id',$torg_tochki);

$skidki_select = array(
'0' => "Не выбрана",
);
$this->db->where("torgovaya_tochka_id", $gl_session["session_data"]['torgovaya_tockka']);
$dbskidki = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("skidki")->result();
for($i=0;$i<count($dbskidki);$i++){
   if($dbskidki[$i]['percent']!=0 && $dbskidki[$i]['name']!=""){ 
     $id_skidki=$dbskidki[$i]['id'];
     $skidki_select[$id_skidki] = $dbskidki[$i]['name']."(".$dbskidki[$i]['percent']."%)";
   }
}

$this->ddb('clients_create_clients_skidka_id',$skidki_select);

 
