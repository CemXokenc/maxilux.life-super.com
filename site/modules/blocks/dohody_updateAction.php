<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "dohody_update" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("dohody"));
   }
 $dohody_update_id = $this->getVariable("id");

 if($this->isPost() && $do == "dohody_update"){
 $dohody_rashody_img = "";
 if($_FILES["dohody_rashody_img"]["error"] == UPLOAD_ERR_OK) {
   $dohody_rashody_img = "1";
 }
   $dohody_rashody_name = $this->getVariable("dohody_rashody_name");
   $dohody_rashody_parent_id = $this->getVariable("dohody_rashody_parent_id");
   
   $data = array("operation_type"=>$dohody_rashody_operation_type, "company_id"=>$dohody_rashody_company_id, "name"=>$dohody_rashody_name, "parent_id"=>$dohody_rashody_parent_id, );
 if($_FILES["dohody_rashody_img"]["error"] == UPLOAD_ERR_OK) {
   $data["img"] = $dohody_rashody_img;
 }

   $this->db->where("id", $dohody_update_id)->update("dohody_rashody",$data);

   
 $uploads_dir     = dirname(__FILE__)."/../../templates/img/dohody_rashody/";
 if($_FILES["dohody_rashody_img"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["dohody_rashody_img"]["tmp_name"];
   $name = $dohody_update_id;
   move_uploaded_file($tmp_name, "$uploads_dir/{$name}.jpg");
 }
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["dohody"] = "Категория дохода успешно изменена";
   $this->redirect($this->l("dohody"));
 }
 $dohody_update_data = $this->db->where("id", $dohody_update_id)->get("dohody_rashody")->result();
 $this->r_v("dohody_update_data",$dohody_update_data[0]);

$categories = array();
$categories[0] = "нет";
$current_dohod = arg(1);
$categories_data = $this->db->where("parent_id",0)->where("operation_type",0)->where("company_id",$gl_session["session_data"]['company_id'])->order_by("name","asc")->get("dohody_rashody")->result();
for($z=0;$z<count($categories_data);$z++){
  if($categories_data[$z]['id']!=$current_dohod){
  $categories[$categories_data[$z]['id']] = $categories_data[$z]['name']; 
  }
  $sub_categories_data = $this->db->where("parent_id", $categories_data[$z]['id'])->where("operation_type",0)->order_by("name","asc")->get("dohody_rashody")->result();
  for($z1=0;$z1<count($sub_categories_data);$z1++){
   if($sub_categories_data[$z1]['id']!=$current_dohod){
      $categories[$sub_categories_data[$z1]['id']] = "=>".$sub_categories_data[$z1]['name']; 
   }
    $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->where("operation_type",0)->order_by("name","asc")->get("dohody_rashody")->result();
    for($z2=0;$z2<count($sub_categories_data1);$z2++){
       if($sub_categories_data1[$z2]['id']!=$current_dohod){
        $categories[$sub_categories_data1[$z2]['id']] = "== =>".$sub_categories_data1[$z2]['name']; 
      }
    }
  }
}

$this->ddb('dohody_update_dohody_rashody_parent_id',$categories); 
