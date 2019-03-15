<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "category_edit" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("categories"));
   }
 $category_edit_id = $this->getVariable("id");

 if($this->isPost() && $do == "category_edit"){
   $categories_description = $this->getVariable("categories_description");
 $categories_img = "";
 if($_FILES["categories_img"]["error"] == UPLOAD_ERR_OK) {
   $categories_img = "1";
 }
 $categories_img = "";
 if($_FILES["categories_img"]["error"] == UPLOAD_ERR_OK) {
   $categories_img = "1";
 }
   $categories_description = $this->getVariable("categories_description");
   $categories_name = $this->getVariable("categories_name");
   $categories_name = $this->getVariable("categories_name");
   $categories_num = $this->getVariable("categories_num");
   $categories_num = $this->getVariable("categories_num");
   $categories_min_zakaz = $this->getVariable("categories_min_zakaz");
   $categories_min_zakaz = $this->getVariable("categories_min_zakaz");
   $categories_sred_zakaz = $this->getVariable("categories_sred_zakaz");
   $categories_sred_zakaz = $this->getVariable("categories_sred_zakaz");
   $categories_max_zakaz = $this->getVariable("categories_max_zakaz");
   $categories_max_zakaz = $this->getVariable("categories_max_zakaz");
   $categories_parent_id = $this->getVariable("categories_parent_id");
   $categories_parent_id = $this->getVariable("categories_parent_id");
   $categories_nacenka = $this->getVariable("categories_nacenka");
   $categories_nacenka = $this->getVariable("categories_nacenka");
   
$categories_description = $_POST['categories_description'];

   $data = array("description"=>$categories_description, "description"=>$categories_description, "name"=>$categories_name, "name"=>$categories_name, "num"=>$categories_num, "num"=>$categories_num, "min_zakaz"=>$categories_min_zakaz, "min_zakaz"=>$categories_min_zakaz, "sred_zakaz"=>$categories_sred_zakaz, "sred_zakaz"=>$categories_sred_zakaz, "max_zakaz"=>$categories_max_zakaz, "max_zakaz"=>$categories_max_zakaz, "parent_id"=>$categories_parent_id, "parent_id"=>$categories_parent_id, "nacenka"=>$categories_nacenka, "nacenka"=>$categories_nacenka, );
 if($_FILES["categories_img"]["error"] == UPLOAD_ERR_OK) {
   $data["img"] = $categories_img;
 }
 if($_FILES["categories_img"]["error"] == UPLOAD_ERR_OK) {
   $data["img"] = $categories_img;
 }

   $this->db->where("id", $category_edit_id)->update("categories",$data);

   
 $uploads_dir     = dirname(__FILE__)."/../../templates/img/categories/";
 if($_FILES["categories_img"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["categories_img"]["tmp_name"];
   $name = $category_edit_id;
   move_uploaded_file($tmp_name, "$uploads_dir/{$name}.jpg");
 }
 $uploads_dir     = dirname(__FILE__)."/../../templates/img/categories/";
 if($_FILES["categories_img"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["categories_img"]["tmp_name"];
   $name = $category_edit_id;
   move_uploaded_file($tmp_name, "$uploads_dir/{$name}.jpg");
 }
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["categories"] = "Информация успешно обновлена";
   $this->redirect($this->l("categories"));
 }
 $category_edit_data = $this->db->where("id", $category_edit_id)->get("categories")->result();
 $this->r_v("category_edit_data",$category_edit_data[0]);


$categories = array();
$category_id = arg(1);
$categories[0] = "нет";
$categories_data = $this->db->where("parent_id",0)->where("company_id",$gl_session["session_data"]['company_id'])->order_by("name","asc")->get("categories")->result();
for($z=0;$z<count($categories_data);$z++){
  if($categories_data[$z]['id'] != $category_id){
  $categories[$categories_data[$z]['id']] = $categories_data[$z]['name']; 
  $sub_categories_data = $this->db->where("parent_id", $categories_data[$z]['id'])->order_by("name","asc")->get("categories")->result();
  for($z1=0;$z1<count($sub_categories_data);$z1++){
     if($sub_categories_data[$z1]['id'] != $category_id){
       $categories[$sub_categories_data[$z1]['id']] = "=>".$sub_categories_data[$z1]['name']; 
     }

     $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("name","asc")->get("categories")->result();
     for($z2=0;$z2<count($sub_categories_data1);$z2++){
       $categories[$sub_categories_data1[$z2]['id']] = "== =>".$sub_categories_data1[$z2]['name']; 
     }
   }
  }
}

$this->ddb('category_edit_categories_parent_id',$categories);

function status_table(){

  $table = "<table class='table table-bordered'>
				        <thead>
				          <tr>
				            <th>Номер</th>
				            <th>Название</th>
                                            <th>Списание</th>
                                            <th>Профессия</th>
                                            <th>Цвет</th>
                                            <th>Управление</th>
				          </tr>
				        </thead>
                                    <tbody>";
  $db = new active_records();
$category_id = arg(1);
$statuses=  $db->where("category_id",$category_id)->order_by("nomer","asc")->get("category_statuses")->result();
$professions_db = $db->where("company_id",$gl_session["session_data"]['company_id'])->get("professions")->result();  


  for($i=0;$i<count($statuses);$i++){
$profession = "Не выбрано"; 
if($statuses[$i]['profession'] > 0){
    $profession_info = $db->where("id",$statuses[$i]['profession'])->get("professions")->result();
    $profession = $profession_info[0]['name'];
}
    $table .= "<tr>";
 $table .= "<td><span class='cat_nomer'>".$statuses[$i]['nomer']."</span><span class='cat_nomer_edit'></span></td>";
  $table .= "<td><span class='cat_name'>".$statuses[$i]['name']."</span><span class='cat_name_edit'></span></td>";
 $spisanie = "-";
$selected = "";
 if($statuses[$i]['spisanie'] == 1){
   $spisanie = "Установлен";
$selected = "selected";
 }
  $table .= "<td><span class='cat_spisanie'>".$spisanie."</span><span style='display:none;' class='cat_spisanie_edit'><select><option value='0'>Нет</option><option value='1' ".$selected." > Установить</option></select></span></td>";
  $table .= "<td><span class='cat_profession_val' style='display:none;'>".$statuses[$i]['profession']."</span><span class='cat_profession'>".$profession."</span><span class='cat_profession_edit'></span></td>";
  $table .= "<td><span class='color_name'>".$statuses[$i]['color']."</span><span class='color_name_edit'></span></td>";
    $table .= "<td><span class='label label-primary izdelie_edit' product-id='".$statuses[$i]['id']."'>Редактировать</span> <span class='label label-default izdelie_delete' product-id='".$statuses[$i]['id']."'>Удалить</span><span class='class_edit'></span></td>";

    $table .= "</tr>";
  }
 

  $table .= "				        </tbody>
				      </table>";

  return  $table;
}

$type_post = $this->get("type");

if($this->isPost() && $type_post=="update_cat"){
    $category_id = arg(1);
     $cat_name= $this->get("cat_name");
     $cat_nomer= $this->get("cat_nomer");
     $cat_spisanie= $this->get("cat_spisanie");
     $cat_profession= $this->get("cat_profession");
  $color_name = $this->get("color_name");
     $tovar_id = $this->get("tovar_id");
     if( $cat_spisanie == 1){$this->db->where("category_id",$category_id)->set("spisanie",0)->update("category_statuses");
     }
     $this->db->where("id",$tovar_id)->set("name",$cat_name)->set("color",$color_name)->set("nomer",$cat_nomer)->set("spisanie",$cat_spisanie)->set("profession",$cat_profession)->update("category_statuses");
     $table = status_table();
  echo json_encode(array(
    "table" => $table,
  ));
  exit();
}
if($this->isPost() && $type_post=="category_delete"){
  $category_id = $this->get("category_id");

  $this->db->where("id",$category_id)->delete("category_statuses");


  $table = status_table();
  echo json_encode(array(
    "table" => $table,
  ));
  exit();
}
if($this->isPost() && $type_post=="refresh"){
  $name = $this->get("name");
 $nomer = $this->get("izd_category_nomer");
 $spisanie = $this->get("izd_category_spisanie");
 $profession = $this->get("izd_category_profession");
 $color = $this->get("izd_category_color");
  $category_id = arg(1);
  $data = array(
    'name' => $name ,
    'category_id' => $category_id ,
    'nomer' => $nomer,
    'spisanie' => $spisanie,
    'company_id' => $gl_session["session_data"]['company_id'],
    'profession' => $profession,
    'color' => $color,
  );
  if( $spisanie == 1){$this->db->where("category_id",$category_id)->set("spisanie",0)->update("category_statuses");}
  $this->db->insert("category_statuses",$data);


  $table = status_table();
  echo json_encode(array(
    "table" => $table,
  ));
  exit();
}

$profession_db = $this->db->where("company_id", $gl_session["session_data"]['company_id'])->get("professions")->result();
$this->r_v("profession",$profession_db);

$status_table = status_table();
$this->r_v("status_table",$status_table); 
