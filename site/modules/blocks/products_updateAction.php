<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "products_update" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("products"));
   }
 $products_update_id = $this->getVariable("id");

 if($this->isPost() && $do == "products_update"){
   $products_izdelie = $this->getVariable("products_izdelie");
   $products_currency = $this->getVariable("products_currency");
 $products_avatar = "";
 if($_FILES["products_avatar"]["error"] == UPLOAD_ERR_OK) {
   $products_avatar = "1";
 }
   $products_name = $this->getVariable("products_name");
   $products_category_id = $this->getVariable("products_category_id");
   $products_id = $this->getVariable("products_id");
   $products_selling_price = $this->getVariable("products_selling_price");
   $products_price = $this->getVariable("products_price");
   $products_cnt = $this->getVariable("products_cnt");
   $products_ves = $this->getVariable("products_ves");
   $products_shirina = $this->getVariable("products_shirina");
   $products_vysota = $this->getVariable("products_vysota");
   $products_glubina = $this->getVariable("products_glubina");
   $products_izmerenie = $this->getVariable("products_izmerenie");
   $products_description = $this->getVariable("products_description");
   $products_min_zapas = $this->getVariable("products_min_zapas");
   $products_sred_zapas = $this->getVariable("products_sred_zapas");
   $products_max_zapas = $this->getVariable("products_max_zapas");
   
$this->r_v("textarea","textarea");
$products_description = $_POST['products_description'];
$products_description = stripslashes($products_description);

   $data = array("izdelie"=>$products_izdelie, "currency"=>$products_currency, "company_id"=>$products_company_id, "name"=>$products_name, "category_id"=>$products_category_id, "selling_price"=>$products_selling_price, "price"=>$products_price, "cnt"=>$products_cnt, "ves"=>$products_ves, "shirina"=>$products_shirina, "vysota"=>$products_vysota, "glubina"=>$products_glubina, "izmerenie"=>$products_izmerenie, "description"=>$products_description, "min_zapas"=>$products_min_zapas, "sred_zapas"=>$products_sred_zapas, "max_zapas"=>$products_max_zapas, );
 if($_FILES["products_avatar"]["error"] == UPLOAD_ERR_OK) {
   $data["avatar"] = $products_avatar;
 }

   $this->db->where("id", $products_update_id)->update("products",$data);

   
	$products_list = $this->db->select('products_id')->where('tovar_id',arg(1))->get('products_elements')->result();
	foreach($products_list as $item)
	{
		$product =  $this->db->where("products_elements.products_id",$item[0])->
		select("sklads.name as sklad_name, products_elements.kolichestvo as kolichestvo, products.price as price, products.name as tovar_name,products_elements.id as id, products.currency as currency,products_elements.number as number")->
		where("products.id","products_elements.tovar_id",1)->
		where("sklads.id","products_elements.sklad_id",1)->
		order_by("products_elements.number")->
		get("products_elements,products,sklads")->result();

		$tovary_cnt = 0;
		$tovary_price = 0;
		for($i=0;$i<count($product);$i++)
		{
			if($product[$i]['currency'] != 'UAH')
			{
				$valuta =  $this->db->select('rate')->where("valuta",$product[$i]['currency'])->order_by("id","desc")->limit(1)->get("kurc_valut")->result();
				
				$product[$i]['price'] *= $valuta[0][0];
			}
			
			$tovary_cnt += $product[$i]['kolichestvo'];
			$tovary_price += $product[$i]['kolichestvo']*$product[$i]['price'];
	
		}

		$this->db->where("id",$item[0])->update("products",array('price' => $tovary_price));
		
	}


 $uploads_dir     = dirname(__FILE__)."/../../templates/images/products/";
 if($_FILES["products_avatar"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["products_avatar"]["tmp_name"];
   $name = $products_update_id;
   move_uploaded_file($tmp_name, "$uploads_dir/{$name}.jpg");
 }
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["products"] = "Товар успешно обновлен";
   $this->redirect($this->l("products"));
 }
 $products_update_data = $this->db->where("id", $products_update_id)->get("products")->result();
 $this->r_v("products_update_data",$products_update_data[0]);


$products_id = arg(1);
$this->r_v("product_id", $products_id);
$this->r_v("dollar", '$');

$currencies_data = $this->db->where("company_id", $gl_session["session_data"]['company_id'])->get("currencies")->result();
for($z=0;$z<count($currencies_data);$z++){
  $currencies_list[$currencies_data[$z]['kod_valuty']] = $currencies_data[$z]['name'];
}
$this->ddb('products_update_products_currency',$currencies_list);

function create_images($products_id){
  $table = "<table class='table table-bordered'>
				        <thead>
				          <tr>
				            <th style='width:150px;'>Картинка</th>
				            <th style='width:200px;'>Название</th>
				            <th>Описание</th>
                            <th style='width:150px;'>Управление</th>
				          </tr>
				        </thead>
                                    <tbody>";
  $db = new active_records();
  $images =  $db->where("product_id",$products_id)->get("products_files")->result();
  for($i=0;$i<count($images);$i++){
    $table .= "<tr>";
    $table .= "<td><img src='".images_path.arg(1)."/".$images[$i]['name']."' width='100' height='100'></td>";
    $table .= "<td>".$images[$i]['name']."</td>";
    $table .= "<td><span class='opisanie'>".$images[$i]['opisanie']."</span><span class='opisanie_edit'></span></td>";
    $table .= "<td><span class='label label-primary images_edit' image-id='".$images[$i]['id']."'>Редактировать</span><span class='label label-default images_delete' image-id='".$images[$i]['id']."'>Удалить</span><span style='display:none;' class='label label-primary images_save' image-id='".$images[$i]['id']."'>Сохранить</span></td>";
    $table .= "</tr>";
  }
  $table .= "</tbody></table>";
  return  $table;
}

$type_post = $this->get("type");

if($this->isPost() && $type_post=="delete_image"){
  $products_id = arg(1);
  $image_id = $this->get("image_id");
  $this->db->where("id",$image_id)->delete('products_files');
  $products_files_db =  $this->db->where("product_id",$products_id)->count_all_results("products_files");
  if($products_files_db < 1){
       $this->db->where("id",$products_id)->set("got_images",1)->update("products");
  }
  $table = create_images($products_id);

  echo json_encode(array(
    "table" => $table,
  ));
  exit();
}

if($this->isPost() && $type_post=="edit_image"){
  $products_id = arg(1);
  $image_id = $this->get("image_id");
  $opisanie = $this->get("opisanie");
  $this->db->where("id",$image_id)->set("opisanie",$opisanie)->update('products_files');
  $table = create_images($products_id);

  echo json_encode(array(
    "table" => $table,
  ));
  exit();
}

if($products_update_data[0]['izdelie'] == 1){
  $this->redirect($this->l("products_elements_update/".$products_update_data[0]['id']));   
}

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


$this->ddb('products_update_products_category_id',$categories);
$this->r_v("rand_num",rand());
 $products_id = arg(1);
  $images = create_images($products_id);
  $this->r_v("images",$images);
  
//$query_test = $this->db->select("products_id")->where("tovar_id",$products_id)->get()result();
//print_r($query_test);
//exit();
 
