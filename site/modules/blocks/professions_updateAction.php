<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "professions_update" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("professions"));
   }
 $professions_update_id = $this->getVariable("id");

 if($this->isPost() && $do == "professions_update"){
   $professions_name = $this->getVariable("professions_name");
   $professions_name = $this->getVariable("professions_name");
   $professions_stavka = $this->getVariable("professions_stavka");
   $professions_stavka = $this->getVariable("professions_stavka");
   $professions_bonus = $this->getVariable("professions_bonus");
   $professions_bonus = $this->getVariable("professions_bonus");
   $professions_vchas = $this->getVariable("professions_vchas");
   $professions_vchas = $this->getVariable("professions_vchas");
   $professions_sdelnaya = $this->getVariable("professions_sdelnaya");
   $professions_sdelnaya = $this->getVariable("professions_sdelnaya");
   $professions_opisanie = $this->getVariable("professions_opisanie");
   $professions_opisanie = $this->getVariable("professions_opisanie");
   
   $data = array("name"=>$professions_name, "name"=>$professions_name, "stavka"=>$professions_stavka, "stavka"=>$professions_stavka, "bonus"=>$professions_bonus, "bonus"=>$professions_bonus, "vchas"=>$professions_vchas, "vchas"=>$professions_vchas, "sdelnaya"=>$professions_sdelnaya, "sdelnaya"=>$professions_sdelnaya, "opisanie"=>$professions_opisanie, "opisanie"=>$professions_opisanie, );

   $this->db->where("id", $professions_update_id)->update("professions",$data);

   
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["professions"] = "Данные успешно сохранены";
   $this->redirect($this->l("professions"));
 }
 $professions_update_data = $this->db->where("id", $professions_update_id)->get("professions")->result();
 $this->r_v("professions_update_data",$professions_update_data[0]);

 
