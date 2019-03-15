<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "products_create" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("products"));
   }
 $select_products_create_products_izmerenie["0"] = "см";
 $select_products_create_products_izmerenie["1"] = "мм";
 $this->r_v("select_products_create_products_izmerenie", $select_products_create_products_izmerenie);

 if($this->isPost() && $do == "products_create"){
   $products_name = $this->getVariable("products_name");
   $products_category_id = $this->getVariable("products_category_id");
   $products_valuta = $this->getVariable("products_valuta");
   $products_currency = $this->getVariable("products_currency");
   $products_price = $this->getVariable("products_price");
   $products_cnt = $this->getVariable("products_cnt");
   $products_ves = $this->getVariable("products_ves");
   $products_shirina = $this->getVariable("products_shirina");
   $products_vysota = $this->getVariable("products_vysota");
   $products_glubina = $this->getVariable("products_glubina");
   $products_izmerenie = $this->getVariable("products_izmerenie");
   $products_description = $this->getVariable("products_description");
 $products_avatar = "";
 if($_FILES["products_avatar"]["error"] == UPLOAD_ERR_OK) {
   $products_avatar = "1";
 }
   $products_min_zapas = $this->getVariable("products_min_zapas");
   $products_sred_zapas = $this->getVariable("products_sred_zapas");
   $products_max_zapas = $this->getVariable("products_max_zapas");
   
$this->db->where("company_id",$gl_session["session_data"]['company_id']);
$products_description = $_POST['products_description'];

   $data = array("company_id"=>$products_company_id, "name"=>$products_name, "category_id"=>$products_category_id, "valuta"=>$products_valuta, "currency"=>$products_currency, "price"=>$products_price, "cnt"=>$products_cnt, "ves"=>$products_ves, "shirina"=>$products_shirina, "vysota"=>$products_vysota, "glubina"=>$products_glubina, "izmerenie"=>$products_izmerenie, "description"=>$products_description, "min_zapas"=>$products_min_zapas, "sred_zapas"=>$products_sred_zapas, "max_zapas"=>$products_max_zapas, );
 if($_FILES["products_avatar"]["error"] == UPLOAD_ERR_OK) {
   $data["avatar"] = $products_avatar;
 }

   $products_create_id = $this->db->insert("products",$data)->result();

   
 $uploads_dir     = dirname(__FILE__)."/../../templates/images/products/";
 if($_FILES["products_avatar"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["products_avatar"]["tmp_name"];
   $name = $products_create_id;
   move_uploaded_file($tmp_name, "$uploads_dir/{$name}.jpg");
 }
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["products"] = "Данные успешно сохранены";
   $this->redirect($this->l("products"));
 }



$product_id = $this->db->insert("products",array("company_id"=>$gl_session["session_data"]['company_id']))->result();
$this->redirect($this->l("products_update/".$product_id));
exit;

$categories = array();
$categories[0] = "нет";
$categories_data = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id",0)->order_by("name","asc")->get("categories")->result();
for($z=0;$z<count($categories_data);$z++){
  $categories[$categories_data[$z]['id']] = $categories_data[$z]['name']; 
  $sub_categories_data = $this->db->where("parent_id", $categories_data[$z]['id'])->order_by("name","asc")->get("categories")->result();
  for($z1=0;$z1<count($sub_categories_data);$z1++){
    $categories[$sub_categories_data[$z1]['id']] = "=>".$sub_categories_data[$z1]['name']; 

    $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("name","asc")->get("categories")->result();
    for($z2=0;$z2<count($sub_categories_data1);$z2++){
      $categories[$sub_categories_data1[$z2]['id']] = "== =>".$sub_categories_data1[$z2]['name']; 

      $sub_categories_data2 = $this->db->where("parent_id", $sub_categories_data1[$z2]['id'])->order_by("name","asc")->get("categories")->result();
       for($z3=0;$z3<count($sub_categories_data2);$z3++){
         $categories[$sub_categories_data2[$z3]['id']] = "== =>".$sub_categories_data2[$z3]['name']; 
       }
    }
  }
}

$this->ddb('products_create_products_category_id',$categories); 
