<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "rashody_create" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("rashody"));
   }

 if($this->isPost() && $do == "rashody_create"){
   $dohody_rashody_name = $this->getVariable("dohody_rashody_name");
 $dohody_rashody_img = "";
 if($_FILES["dohody_rashody_img"]["error"] == UPLOAD_ERR_OK) {
   $dohody_rashody_img = "1";
 }
   $dohody_rashody_parent_id = $this->getVariable("dohody_rashody_parent_id");
   
 $dohody_rashody_operation_type = 1;

   $data = array("operation_type"=>$dohody_rashody_operation_type, "company_id"=>$dohody_rashody_company_id, "name"=>$dohody_rashody_name, "parent_id"=>$dohody_rashody_parent_id, );
 if($_FILES["dohody_rashody_img"]["error"] == UPLOAD_ERR_OK) {
   $data["img"] = $dohody_rashody_img;
 }

   $rashody_create_id = $this->db->insert("dohody_rashody",$data)->result();

   
 $uploads_dir     = dirname(__FILE__)."/../../templates/img/dohody_rashody/";
 if($_FILES["dohody_rashody_img"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["dohody_rashody_img"]["tmp_name"];
   $name = $rashody_create_id;
   move_uploaded_file($tmp_name, "$uploads_dir/{$name}.jpg");
 }
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["rashody"] = "Категория успешно добавлена";
   $this->redirect($this->l("rashody"));
 }


$categories = array();
$categories[0] = "нет";
$categories_data = $this->db->where("parent_id",0)->where("operation_type",1)->where("company_id",$gl_session["session_data"]['company_id'])->order_by("name","asc")->get("dohody_rashody")->result();
for($z=0;$z<count($categories_data);$z++){
  $categories[$categories_data[$z]['id']] = $categories_data[$z]['name']; 
  $sub_categories_data = $this->db->where("parent_id", $categories_data[$z]['id'])->where("operation_type",1)->order_by("name","asc")->get("dohody_rashody")->result();
  for($z1=0;$z1<count($sub_categories_data);$z1++){
    $categories[$sub_categories_data[$z1]['id']] = "=>".$sub_categories_data[$z1]['name']; 

    $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->where("operation_type",1)->order_by("name","asc")->get("dohody_rashody")->result();
    for($z2=0;$z2<count($sub_categories_data1);$z2++){
      $categories[$sub_categories_data1[$z2]['id']] = "== =>".$sub_categories_data1[$z2]['name']; 
    }
  }
}

$this->ddb('rashody_create_dohody_rashody_parent_id',$categories); 
