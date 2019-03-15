<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "orders_statuses_update" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("orders_statuses"));
   }
 $select_orders_statuses_update_orders_statuses_set_default["0"] = "Нет";
 $select_orders_statuses_update_orders_statuses_set_default["1"] = "Да";
 $this->r_v("select_orders_statuses_update_orders_statuses_set_default", $select_orders_statuses_update_orders_statuses_set_default);
 $select_orders_statuses_update_orders_statuses_spisanie["0"] = "Нет";
 $select_orders_statuses_update_orders_statuses_spisanie["1"] = "Да";
 $this->r_v("select_orders_statuses_update_orders_statuses_spisanie", $select_orders_statuses_update_orders_statuses_spisanie);
 $orders_statuses_update_id = $this->getVariable("id");

 if($this->isPost() && $do == "orders_statuses_update"){
   $orders_statuses_order_num = $this->getVariable("orders_statuses_order_num");
   $orders_statuses_name = $this->getVariable("orders_statuses_name");
   $orders_statuses_set_default = $this->getVariable("orders_statuses_set_default");
   $orders_statuses_spisanie = $this->getVariable("orders_statuses_spisanie");
   $orders_statuses_color = $this->getVariable("orders_statuses_color");
   
$set_d = $this->get("orders_statuses_set_default");
if($this->isPost() && $set_d ==1){

   $this->db->where("company_id",$gl_session["session_data"]['company_id'])->set("set_default",0)->update("orders_statuses");
}

$set_spisanie = $this->get("orders_statuses_spisanie");
if($this->isPost() && $set_spisanie==1){

   $this->db->where("company_id",$gl_session["session_data"]['company_id'])->set("spisanie",0)->update("orders_statuses");
}

   $data = array("order_num"=>$orders_statuses_order_num, "name"=>$orders_statuses_name, "company_id"=>$orders_statuses_company_id, "set_default"=>$orders_statuses_set_default, "spisanie"=>$orders_statuses_spisanie, "color"=>$orders_statuses_color, );

   $this->db->where("id", $orders_statuses_update_id)->update("orders_statuses",$data);

   
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["orders_statuses"] = "Данные успешно сохранены";
   $this->redirect($this->l("orders_statuses"));
 }
 $orders_statuses_update_data = $this->db->where("id", $orders_statuses_update_id)->get("orders_statuses")->result();
 $this->r_v("orders_statuses_update_data",$orders_statuses_update_data[0]);

 
