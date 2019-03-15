<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "category_create" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l(""));
   }

 if($this->isPost() && $do == "category_create"){
   $categories_name = $this->getVariable("categories_name");
 $categories_img = "";
 if($_FILES["categories_img"]["error"] == UPLOAD_ERR_OK) {
   $categories_img = "1";
 }
 $categories_img = "";
 if($_FILES["categories_img"]["error"] == UPLOAD_ERR_OK) {
   $categories_img = "1";
 }
   $categories_name = $this->getVariable("categories_name");
   $categories_num = $this->getVariable("categories_num");
   $categories_num = $this->getVariable("categories_num");
   $categories_sred_zakaz = $this->getVariable("categories_sred_zakaz");
   $categories_sred_zakaz = $this->getVariable("categories_sred_zakaz");
   $categories_max_zakaz = $this->getVariable("categories_max_zakaz");
   $categories_max_zakaz = $this->getVariable("categories_max_zakaz");
   $categories_min_zakaz = $this->getVariable("categories_min_zakaz");
   $categories_min_zakaz = $this->getVariable("categories_min_zakaz");
   $categories_parent_id = $this->getVariable("categories_parent_id");
   $categories_parent_id = $this->getVariable("categories_parent_id");
   $categories_nacenka = $this->getVariable("categories_nacenka");
   $categories_nacenka = $this->getVariable("categories_nacenka");
   
   $data = array("name"=>$categories_name, "company_id"=>$categories_company_id, "name"=>$categories_name, "company_id"=>$categories_company_id, "num"=>$categories_num, "num"=>$categories_num, "sred_zakaz"=>$categories_sred_zakaz, "sred_zakaz"=>$categories_sred_zakaz, "max_zakaz"=>$categories_max_zakaz, "max_zakaz"=>$categories_max_zakaz, "min_zakaz"=>$categories_min_zakaz, "min_zakaz"=>$categories_min_zakaz, "parent_id"=>$categories_parent_id, "parent_id"=>$categories_parent_id, "nacenka"=>$categories_nacenka, "nacenka"=>$categories_nacenka, );
 if($_FILES["categories_img"]["error"] == UPLOAD_ERR_OK) {
   $data["img"] = $categories_img;
 }
 if($_FILES["categories_img"]["error"] == UPLOAD_ERR_OK) {
   $data["img"] = $categories_img;
 }

   $category_create_id = $this->db->insert("categories",$data)->result();

   
 $uploads_dir     = dirname(__FILE__)."/../../templates/img/categories/";
 if($_FILES["categories_img"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["categories_img"]["tmp_name"];
   $name = $category_create_id;
   move_uploaded_file($tmp_name, "$uploads_dir/{$name}.jpg");
 }
 $uploads_dir     = dirname(__FILE__)."/../../templates/img/categories/";
 if($_FILES["categories_img"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["categories_img"]["tmp_name"];
   $name = $category_create_id;
   move_uploaded_file($tmp_name, "$uploads_dir/{$name}.jpg");
 }
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["categories"] = "Категория успешно добавлена";
   $this->redirect($this->l("categories"));
 }
$data = array(
  'company_id' => $gl_session["session_data"]['company_id'],
); 
$category_id = $this->db->insert("categories")->result();
$this->redirect($this->l("category_edit/".$category_id));   
$categories = array();
$categories[0] = "нет";
$categories_data = $this->db->where("parent_id",0)->where("company_id",$gl_session["session_data"]['company_id'])->order_by("name","asc")->get("categories")->result();
for($z=0;$z<count($categories_data);$z++){
  $categories[$categories_data[$z]['id']] = $categories_data[$z]['name']; 
  $sub_categories_data = $this->db->where("parent_id", $categories_data[$z]['id'])->order_by("name","asc")->get("categories")->result();
  for($z1=0;$z1<count($sub_categories_data);$z1++){
    $categories[$sub_categories_data[$z1]['id']] = "=>".$sub_categories_data[$z1]['name']; 

    $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("name","asc")->get("categories")->result();
    for($z2=0;$z2<count($sub_categories_data1);$z2++){
      $categories[$sub_categories_data1[$z2]['id']] = "== =>".$sub_categories_data1[$z2]['name']; 
    }
  }
}

$this->ddb('category_create_categories_parent_id',$categories);

function status_table(){

  $table = "<table class='table table-bordered'>
				        <thead>
				          <tr>
				            <th>Название</th>
                                            <th>Управление</th>
				          </tr>
				        </thead>
                                    <tbody>";
  $db = new active_records();
$category_id = arg(1);
$statuses=  $db->where("category_id",$category_id)->order_by("id","asc")->get("category_statuses")->result();
  

 if(count($statuses)>0){
  foreach($statuses as $id_cat => $name){
 
    $table .= "<tr>";


    $table .= "</tr>";
  }
 }

  $table .= "				        </tbody>
				      </table>";

  return  $table;
}

$type_post = $this->get("type");
if($this->isPost() && $type_post=="refresh"){
  $name = $this->get("name");
  $category_id = arg(1);
  $data = array(
    'name' => $name ,
    'category_id' => $category_id ,
    'company_id' => $gl_session["session_data"]['company_id'],
  );
  $this->db->insert("category_statuses",$data);


  $table = status_table();
  echo json_encode(array(
    "table" => $table,
  ));
  exit();
}

$status_table = status_table();
$this->r_v("status_table",$status_table); 
