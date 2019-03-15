<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "napravlenie_create" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("napravlenie"));
   }

 if($this->isPost() && $do == "napravlenie_create"){
   $napravlenie_napravlenie = $this->getVariable("napravlenie_napravlenie");
   
 $napravlenie_company_id = $gl_session["session_data"]['company_id'];

   $data = array("napravlenie"=>$napravlenie_napravlenie, "company_id"=>$napravlenie_company_id, );

   $napravlenie_create_id = $this->db->insert("napravlenie",$data)->result();

   
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["napravlenie"] = "Данные успешно добавлены";
   $this->redirect($this->l("napravlenie"));
 }
 
