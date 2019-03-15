<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "postavshiki_create" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("postavshiki"));
   }

 if($this->isPost() && $do == "postavshiki_create"){
   $postavshiki_name = $this->getVariable("postavshiki_name");
 $postavshiki_img = "";
 if($_FILES["postavshiki_img"]["error"] == UPLOAD_ERR_OK) {
   $postavshiki_img = "1";
 }
   $postavshiki_telephone = $this->getVariable("postavshiki_telephone");
   $postavshiki_email = $this->getVariable("postavshiki_email");
   $postavshiki_city = $this->getVariable("postavshiki_city");
   $postavshiki_zip_code = $this->getVariable("postavshiki_zip_code");
   $postavshiki_street = $this->getVariable("postavshiki_street");
   $postavshiki_house = $this->getVariable("postavshiki_house");
   $postavshiki_office = $this->getVariable("postavshiki_office");
   $postavshiki_debet = $this->getVariable("postavshiki_debet");
   $postavshiki_credit = $this->getVariable("postavshiki_credit");
   
 $postavshiki_company_id = $gl_session["session_data"]['company_id'];

   $data = array("name"=>$postavshiki_name, "company_id"=>$postavshiki_company_id, "telephone"=>$postavshiki_telephone, "email"=>$postavshiki_email, "city"=>$postavshiki_city, "zip_code"=>$postavshiki_zip_code, "street"=>$postavshiki_street, "house"=>$postavshiki_house, "office"=>$postavshiki_office, "debet"=>$postavshiki_debet, "credit"=>$postavshiki_credit, );
 if($_FILES["postavshiki_img"]["error"] == UPLOAD_ERR_OK) {
   $data["img"] = $postavshiki_img;
 }

   $postavshiki_create_id = $this->db->insert("postavshiki",$data)->result();

   
 $uploads_dir     = dirname(__FILE__)."/../../templates/img/postavshiki/";
 if($_FILES["postavshiki_img"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["postavshiki_img"]["tmp_name"];
   $name = $postavshiki_create_id;
   move_uploaded_file($tmp_name, "$uploads_dir/{$name}.jpg");
 }
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["postavshiki"] = "Новый поставщик успешно создан";
   $this->redirect($this->l("postavshiki"));
 }
 
