<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "napravlenie_update" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("napravlenie"));
   }
 $napravlenie_update_id = $this->getVariable("id");

 if($this->isPost() && $do == "napravlenie_update"){
   $napravlenie_napravlenie = $this->getVariable("napravlenie_napravlenie");
   
   $data = array("napravlenie"=>$napravlenie_napravlenie, );

   $this->db->where("id", $napravlenie_update_id)->update("napravlenie",$data);

   
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["napravlenie"] = "Данные успешно сохранены";
   $this->redirect($this->l("napravlenie"));
 }
 $napravlenie_update_data = $this->db->where("id", $napravlenie_update_id)->get("napravlenie")->result();
 $this->r_v("napravlenie_update_data",$napravlenie_update_data[0]);

 
