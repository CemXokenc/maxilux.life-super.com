<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "scheta_update" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("scheta"));
   }
 $scheta_update_id = $this->getVariable("id");

 if($this->isPost() && $do == "scheta_update"){
   $scheta_parent_id = $this->getVariable("scheta_parent_id");
   $scheta_name = $this->getVariable("scheta_name");
   $scheta_amount = $this->getVariable("scheta_amount");
 $scheta_img = "";
 if($_FILES["scheta_img"]["error"] == UPLOAD_ERR_OK) {
   $scheta_img = "1";
 }
   
 $cheta_company_id = $gl_session["session_data"]['company_id'];

   $data = array("parent_id"=>$scheta_parent_id, "name"=>$scheta_name, "company_id"=>$scheta_company_id, "amount"=>$scheta_amount, );
 if($_FILES["scheta_img"]["error"] == UPLOAD_ERR_OK) {
   $data["img"] = $scheta_img;
 }

   $this->db->where("id", $scheta_update_id)->update("scheta",$data);

   
 $uploads_dir     = dirname(__FILE__)."/../../templates/img/scheta/";
 if($_FILES["scheta_img"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["scheta_img"]["tmp_name"];
   $name = $scheta_update_id;
   move_uploaded_file($tmp_name, "$uploads_dir/{$name}.jpg");
 }
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["scheta"] = "Счёт успешно изменён";
   $this->redirect($this->l("scheta"));
 }
 $scheta_update_data = $this->db->where("id", $scheta_update_id)->get("scheta")->result();
 $this->r_v("scheta_update_data",$scheta_update_data[0]);


$categories = array();
$category_id = arg(1);
$categories[0] = "нет";
$categories_data = $this->db->where("parent_id",0)->where("company_id",$gl_session["session_data"]['company_id'])->order_by("name","asc")->get("scheta")->result();
for($z=0;$z<count($categories_data);$z++){
  if($categories_data[$z]['id'] != $category_id){
  $categories[$categories_data[$z]['id']] = $categories_data[$z]['name']; 
  $sub_categories_data = $this->db->where("parent_id", $categories_data[$z]['id'])->order_by("name","asc")->get("scheta")->result();
  for($z1=0;$z1<count($sub_categories_data);$z1++){
     if($sub_categories_data[$z1]['id'] != $category_id){
       $categories[$sub_categories_data[$z1]['id']] = "=>".$sub_categories_data[$z1]['name']; 
     }

     $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("name","asc")->get("scheta")->result();
     for($z2=0;$z2<count($sub_categories_data1);$z2++){
       $categories[$sub_categories_data1[$z2]['id']] = "== =>".$sub_categories_data1[$z2]['name']; 
     }
   }
  }
}

$this->ddb('scheta_update_scheta_parent_id',$categories); 
