<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "professions_create" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("professions"));
   }

 if($this->isPost() && $do == "professions_create"){
   $professions_name = $this->getVariable("professions_name");
   $professions_sdelnaya = $this->getVariable("professions_sdelnaya");
   $professions_name = $this->getVariable("professions_name");
   $professions_sdelnaya = $this->getVariable("professions_sdelnaya");
   $professions_stavka = $this->getVariable("professions_stavka");
   $professions_stavka = $this->getVariable("professions_stavka");
   $professions_bonus = $this->getVariable("professions_bonus");
   $professions_bonus = $this->getVariable("professions_bonus");
   $professions_vchas = $this->getVariable("professions_vchas");
   $professions_vchas = $this->getVariable("professions_vchas");
   $professions_opisanie = $this->getVariable("professions_opisanie");
   $professions_opisanie = $this->getVariable("professions_opisanie");
   
   $data = array("name"=>$professions_name, "company_id"=>$professions_company_id, "sdelnaya"=>$professions_sdelnaya, "name"=>$professions_name, "company_id"=>$professions_company_id, "sdelnaya"=>$professions_sdelnaya, "stavka"=>$professions_stavka, "stavka"=>$professions_stavka, "bonus"=>$professions_bonus, "bonus"=>$professions_bonus, "vchas"=>$professions_vchas, "vchas"=>$professions_vchas, "opisanie"=>$professions_opisanie, "opisanie"=>$professions_opisanie, );

   $professions_create_id = $this->db->insert("professions",$data)->result();

   
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["professions"] = "Данные успешно добавлены";
   $this->redirect($this->l("professions"));
 }
$professions_company_id = $gl_session["session_data"]['company_id']; 
