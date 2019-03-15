<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "workers_create" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("workers"));
   }

 if($this->isPost() && $do == "workers_create"){
 $workers_img = "";
 if($_FILES["workers_img"]["error"] == UPLOAD_ERR_OK) {
   $workers_img = "1";
 }
   $workers_fio = $this->getVariable("workers_fio");
   $workers_email = $this->getVariable("workers_email");
   $workers_telephone = $this->getVariable("workers_telephone");
   $workers_telephone1 = $this->getVariable("workers_telephone1");
   $workers_profession_id = $this->getVariable("workers_profession_id");
   
 $workers_company_id = $gl_session["session_data"]['company_id'];

   $data = array("company_id"=>$workers_company_id, "fio"=>$workers_fio, "email"=>$workers_email, "telephone"=>$workers_telephone, "telephone1"=>$workers_telephone1, "profession_id"=>$workers_profession_id, );
 if($_FILES["workers_img"]["error"] == UPLOAD_ERR_OK) {
   $data["img"] = $workers_img;
 }

   $workers_create_id = $this->db->insert("workers",$data)->result();

   
 $uploads_dir     = dirname(__FILE__)."/../../templates/img/worker/";
 if($_FILES["workers_img"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["workers_img"]["tmp_name"];
   $name = $workers_create_id;
   move_uploaded_file($tmp_name, "$uploads_dir/{$name}.jpg");
 }
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["workers"] = "Данные успешно добавлены";
   $this->redirect($this->l("workers"));
 }


$torg_tochki= array();
$dbtorg_tochki = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("torgovye_tochki")->result();
for($i=0;$i<count($dbtorg_tochki);$i++){
   $id_torg_tochki =$dbtorg_tochki[$i]['id'];
   $torg_tochki[$id_torg_tochki] = $dbtorg_tochki[$i]['name'];
}

$this->ddb('workers_create_workers_torgovaya_tochka_id',$torg_tochki);

$professions = array();
$professions_db = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("professions")->result();
for($i=0;$i<count($professions_db);$i++){
   $id_profession =$professions_db[$i]['id'];
   $professions[$id_profession] = $professions_db[$i]['name'];
}

$this->ddb('workers_create_workers_profession_id',$professions); 
