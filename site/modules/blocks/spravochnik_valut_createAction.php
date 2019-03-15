<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "spravochnik_valut_create" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("spravochnik_valut"));
   }

  $id = $this->getVariable("id");
  $spravochnik_valut_create_data = $this->db->print_query()->where("id", $id)->get("spravochnik_valut")->result();
  
  print_r($spravochnik_valut_create_data);
  exit;
  
  $this->r_v("spravochnik_valut_create_data",$spravochnik_valut_create_data[0]);
  

 if($this->isPost() && $do == "spravochnik_valut_create"){
   $currencies_name = $this->getVariable("currencies_name");
   $currencies_kod_valuty = $this->getVariable("currencies_kod_valuty");
   $currencies_rate = $this->getVariable("currencies_rate");
   
   $data = array("company_id"=>$currencies_company_id, "name"=>$currencies_name, "kod_valuty"=>$currencies_kod_valuty, "rate"=>$currencies_rate, );

   $spravochnik_valut_create_id = $this->db->insert("currencies",$data)->result();

   
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["spravochnik_valut"] = "Данные успешно добавлены";
   $this->redirect($this->l("spravochnik_valut"));
 }
 
 if($this->isPost() && $do == "spravochnik_valut_update"){
   $id = $this->getVariable("id");
   $currencies_name = $this->getVariable("currencies_name");
   $currencies_kod_valuty = $this->getVariable("currencies_kod_valuty");
   $currencies_rate = $this->getVariable("currencies_rate");
   
   $data = array("company_id"=>$currencies_company_id, "name"=>$currencies_name, "kod_valuty"=>$currencies_kod_valuty, "rate"=>$currencies_rate, );

   $this->db->where("id", $id)->print_query()->update("currencies",$data)->result();

   
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["spravochnik_valut"] = "Данные успешно добавлены";
   $this->redirect($this->l("spravochnik_valut"));
 }
 
