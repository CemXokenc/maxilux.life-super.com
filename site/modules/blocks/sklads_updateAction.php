<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "sklads_update" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("sklads"));
   }
 $sklads_update_id = $this->getVariable("id");

 if($this->isPost() && $do == "sklads_update"){
   $sklads_id = $this->getVariable("sklads_id");
   $sklads_name = $this->getVariable("sklads_name");
   $sklads_adress = $this->getVariable("sklads_adress");
   $sklads_parent_id = $this->getVariable("sklads_parent_id");
   $sklads_description = $this->getVariable("sklads_description");
   
   $data = array("name"=>$sklads_name, "adress"=>$sklads_adress, "parent_id"=>$sklads_parent_id, "description"=>$sklads_description, );

   $this->db->where("id", $sklads_update_id)->update("sklads",$data);

   
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["sklads"] = "Данные успешно сохранены";
   $this->redirect($this->l("sklads"));
 }
 $sklads_update_data = $this->db->where("id", $sklads_update_id)->get("sklads")->result();
 $this->r_v("sklads_update_data",$sklads_update_data[0]);

$sklads = array();
$sklads[0] = "нет";
$sklads_data = $this->db->where("parent_id",0)->order_by("name","asc")->get("sklads")->result();
for($z=0;$z<count($sklads_data);$z++){
  $sklads[$sklads_data[$z]['id']] = $sklads_data[$z]['name'];
  $sub_sklads_data = $this->db->where("parent_id", $sklads_data[$z]['id'])->order_by("name","asc")->get("sklads")->result();
  for($z1=0;$z1<count($sub_sklads_data);$z1++){
    $sklads[$sub_sklads_data[$z1]['id']] = "=>".$sub_sklads_data[$z1]['name'];

    $sub_sklads_data1 = $this->db->where("parent_id", $sub_sklads_data[$z1]['id'])->order_by("name","asc")->get("sklads")->result();
    for($z2=0;$z2<count($sub_sklads_data1);$z2++){
      $sklads[$sub_sklads_data1[$z2]['id']] = "== =>".$sub_sklads_data1[$z2]['name'];
    }
  }
}

$this->ddb('sklads_update_sklads_parent_id',$sklads); 
