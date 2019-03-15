<?php
  $this->db = new active_records();
   
$products_company_id = $gl_session["session_data"]['company_id'];
$search_by_categories = $gl_session["session_data"]['product_categories'];
$type_post = $this->get("type");
$this->db->where("izdelie_type",0);

if($this->get("filter2") == 1) 
{
	if($this->get("view_checked") == 1) 
		$gl_session["session_data"]['view_checked'] = 1;
	else
		$gl_session["session_data"]['view_checked'] = 0;
}

if($gl_session["session_data"]['view_checked'] == 1)
	$this->r_v("area_checked","checked");
else $this->db->where("hidden",0);

if ($this->isPost() && $type_post != "change_category") {
  $search_by_categories = $this->get("categories");
  $gl_session["session_data"]['product_categories'] = $search_by_categories;
}

if($gl_session["session_data"]['products_cena_do']!= ""){
  $this->db->where("price  <=", $gl_session["session_data"]['products_cena_do']);
}

if ($search_by_categories != "") {
  $search = $search_by_categories.generate_categories_list($search_by_categories);
  $this->db->where_in("category_id", $search);
}

if ($this->isPost() && $type_post != "change_category") {
  $search_by_categories = $this->get("categories");
  $gl_session["session_data"]['product_categories'] = $search_by_categories;
  $gl_session["session_data"]['product_category_1'] =  $this->get("categories_1");
  $gl_session["session_data"]['product_category_2'] =  $this->get("categories_2");
  $gl_session["session_data"]['product_category_3'] =  $this->get("categories_3");
  $gl_session["session_data"]['product_category_4'] =  $this->get("categories_4");
}

$this->db->where("company_id", $gl_session["session_data"]['company_id']);

$order_as = $this->get("order_as");
$order_by_column = $this->get("order_by_column");

if($this->isPost()){

	if($this->get("reset_filter") == '1')
	{
		$gl_session["session_data"]['products_order_by_column'] = "";
		$gl_session["session_data"]['products_order_as'] = "";
	}
	else
	{
		$gl_session["session_data"]['products_order_by_column'] = $order_by_column;
		$gl_session["session_data"]['products_order_as'] = $order_as;
	}

	$product_type_tovar        = $this->get("product_type_tovar");
	$product_type_izdelie      = $this->get("product_type_izdelie");
	$product_type_konstrukciya = $this->get("product_type_konstrukciya");
	$product_type_needtobuy 	 = $this->get("product_type_needtobuy");

	$gl_session["session_data"]['product_type_tovar']        = $product_type_tovar;
	$gl_session["session_data"]['product_type_izdelie']      = $product_type_izdelie;
	$gl_session["session_data"]['product_type_konstrukciya'] = $product_type_konstrukciya;
	$gl_session["session_data"]['product_type_needtobuy'] 	 = $product_type_needtobuy;
 
}

if($gl_session["session_data"]['product_type_tovar'] != "" || $gl_session["session_data"]['product_type_izdelie'] != "" || $gl_session["session_data"]['product_type_konstrukciya'] != ""){
  $statuses = array();
  if($gl_session["session_data"]['product_type_tovar'] != ""){
    $statuses[] = 0;
  }
  if($gl_session["session_data"]['product_type_izdelie'] != ""){
    $statuses[] = 2;
  }
  if($gl_session["session_data"]['product_type_konstrukciya'] != ""){
    $statuses[] = 1;
  }
  $this->db->where_in("izdelie", $statuses);
}

if($gl_session["session_data"]['products_order_by_column'] != ""  && $gl_session["session_data"]['products_order_as'] != ""){
  $this->db->order_by($gl_session["session_data"]['products_order_by_column'], $gl_session["session_data"]['products_order_as']);
}

$product_name = $this->get("product_name");
if($this->isPost() && $type_post != "change_category"){
  $gl_session["session_data"]['product_name'] = $product_name;
}

if($gl_session["session_data"]['product_name'] != ""){
  $this->db->like("products.name", $gl_session["session_data"]['product_name']);
}


 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $products = $this->db->select("products.hidden as products_hidden, products.zakazano as products_zakazano, products.currency as products_currency, products.company_id as products_company_id, products.name as products_name, products.sred_zapas as products_sred_zapas, products.max_zapas as products_max_zapas, products.min_zapas as products_min_zapas, products.category_id as products_category_id, products.cnt as products_cnt, products.id as products_id, products.price as products_price, products.selling_price as products_selling_price")->limit(100,($page_num-1)*100)->get("products", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("products")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"products_update", "id"=>"products_id", "num"=>"0", "label"=>"редактировать", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"products_delete", "id"=>"products_id", "num"=>"0", "label"=>"удалить", "html"=>"", "ajax"=>"0"); 
 $products = $this->prepare_actions_list($products,$urls_list); 

   $this->r_v("products_create_link", $this->l("products_create"));

 $navigation = $this->navigation("products","products", $items_count, 100,$page_navigation_url_prefix, $page_navigation_url_num); 

if($this->isPost() && $_POST['do'] == 'hide_item')
{
	$this->db->where("id",$_POST['id'])->update("products", array("hidden" => $_POST['type']));
	system_stop();
}

$copy_izdelie = $this->get("copy_izdelie");
if($copy_izdelie>0)
{
	$cur_product = $this->db->where("id",$copy_izdelie)->get("products")->result();

	unset($cur_product[0]['id']);
	
	for($i=0;$i<40;$i++)
		unset($cur_product[0][$i]);
	
	$cur_product[0]['name'] = "Копия ".$cur_product[0]['name'];
	$cur_product[0]['izdelie_id'] = 0;
	$new_product_id = $this->db->insert("products",$cur_product[0])->result();
	if($cur_product[0]['izdelie']==1)
	{
		function copy_izdelie($company_id, $izdelie_id, $parent_id, $copy_izdelie, $copy_parent_id)
		{
			$db = new active_records();
			$izdelie_categories_db = $db->where("izdelie_id",$izdelie_id)->where("parent_id", $parent_id)->order_by("id", "asc")->get("izdelie_categories")->result();//получаем категории изделия и ниже заносим правильные значения

			$data_main = array();
			for($z=0;$z<count($izdelie_categories_db);$z++)
			{
				$data_main[$z] = array(
				'izdelie_id' => $copy_izdelie,
				'company_id' =>  $company_id,
				'categories_izdelie_sklad' =>  $izdelie_categories_db[$z]['categories_izdelie_sklad'],
				'parent_id' =>  $copy_parent_id,
				'kolichestvo' =>  $izdelie_categories_db[$z]['kolichestvo'],
				'type' =>  $izdelie_categories_db[$z]['type'],
				'status_id' =>  $izdelie_categories_db[$z]['status_id'],
				'name' =>  $izdelie_categories_db[$z]['name'],
				);

				$new_copy_parent_id = $db->insert("izdelie_categories",$data_main[$z])->result();
				copy_izdelie($company_id, $izdelie_id, $izdelie_categories_db[$z]['id'], $copy_izdelie, $new_copy_parent_id);
			}
		}
		copy_izdelie($gl_session["session_data"]['company_id'], $copy_izdelie, 0, $new_product_id, 0);

		$izdelie_categories_db = $this->db->where("products_id",$copy_izdelie)->get("products_options")->result();//получаем опции и ниже заносим правильные значения

		$data_main = array();
		for($z=0;$z<count($izdelie_categories_db);$z++)
		{
			$data_main[$z] = array(
			'products_id' => $new_product_id,
			'name' =>  $izdelie_categories_db[$z]['name'],
			'products_type' =>  $izdelie_categories_db[$z]['products_type'],
			'kod' =>  $izdelie_categories_db[$z]['kod'],
			'formula' =>  $izdelie_categories_db[$z]['formula'],
			);


			$this->db->insert("products_options",$data_main[$z])->result();
		}

		$izdelie_categories_db = $this->db->where("products_id",$copy_izdelie)->get("products_elements")->result();//получаем элементы и ниже заносим правильные значения

		$data_main = array();
		for($z=0;$z<count($izdelie_categories_db);$z++)
		{
			$data_main[$z] = array(
			'products_id' => $new_product_id,
			'kolichestvo' =>  $izdelie_categories_db[$z]['kolichestvo'],
			'tovar_id' =>  $izdelie_categories_db[$z]['tovar_id'],
			'sklad_id' =>  $izdelie_categories_db[$z]['sklad_id'],
			'company_id' =>  $gl_session["session_data"]['company_id'],
			);

			$this->db->insert("products_elements",$data_main[$z])->result();
		}

		$this->redirect($this->l("products_elements_update/".$new_product_id));
		exit;
	}
	else
	{
		$this->redirect($this->l("products_update/".$new_product_id));
		exit;
	}

}



$valuta_change = $this->get("valuta_change");
if($valuta_change==1 && $this->isPost()){
  $valyta = $this->get("valuty");
  $gl_session["session_data"]['valyta'] = $valyta;
}

if($valyta ==""){
  $gl_session["session_data"]['valyta'] = "UAH";
}

for($z=0;$z<count($products);$z++){
  $products_price = $products[$z]['products_price'];
  /*$info = calc_price($products_price, "UAH");
  $products[$z]['products_price'] = $info['view'];*/

  $category_1 = $this->db->where("id",$products[$z]['products_category_id'])->get("categories")->result();
  $nacenka = $category_1[0]['nacenka'];
  if($category_1[0]['nacenka']=="" || $category_1[0]['nacenka']==0){
    $category_2 = $this->db->where("id",$category_1[0]['parent_id'])->get("categories")->result();
    $nacenka = $category_2[0]['nacenka'];

    if($category_2[0]['nacenka']=="" || $category_2[0]['nacenka']==0){
      $category_3 = $this->db->where("id",$category_2[0]['parent_id'])->get("categories")->result();
      $nacenka = $category_3[0]['nacenka'];
      if($category_3[0]['nacenka']=="" || $category_3[0]['nacenka']==0){
        $category_4 = $this->db->where("id",$category_3[0]['parent_id'])->get("categories")->result();
        $nacenka = $category_4[0]['nacenka'];
        if($category_4[0]['nacenka']=="" || $category_4[0]['nacenka']==0){
          $nacenka = 1;
        }
      }
    }
  }

  $products[$z]['products_selling_price'] = $products[$z]['products_price'] + $products[$z]['products_price'] * $nacenka/100;
  $info = calc_price($products[$z]['products_selling_price'], $products[$z]['products_currency'],$gl_session["session_data"]['valyta']);
  $products[$z]['products_selling_price'] = $info['view'];

  $info = calc_price($products[$z]['products_price'], $products[$z]['products_currency'],$gl_session["session_data"]['valyta']);
  $products[$z]['products_price'] = $info['view'];

  $products[$z]['products_preview_url'] = $this->l("product_view/".$products[$z]['products_id']."/1");

  $kupit = $products[$z]['products_cnt'] - $products[$z]['products_zakazano'];
  if($kupit < 0) {$kupit*=-1; $products[$z]['products_needtobuy'] = $kupit; $kupit = "<span style='color:red;'>куп.:".$kupit."</span>";}
  else{$kupit="";$products[$z]['products_needtobuy'] = 0;}

  $products[$z]['products_cnt'] = "кол.:".$products[$z]['products_cnt']." зак.:".$products[$z]['products_zakazano'].$kupit;

  $images =  $this->db->where("product_id",$products[$z]['products_id'])->order_by('number')->get("products_files")->result();
  if(count($images) > 0){
    $products[$z]['products_image'] = "{$products[$z]['products_id']}/{$images[0]['name']}";
  }
}

	function compare ($v1, $v2) 
	{
		if ($v1["products_needtobuy"] == $v2["products_needtobuy"]) return 0;
		return ($v1["products_needtobuy"] > $v2["products_needtobuy"])? -1: 1;
	}
	if($gl_session["session_data"]['product_type_needtobuy'] != "")
	{
		usort($products, "compare"); 
	}
$categories = array();
$categories_data = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id", 0)->order_by("name", "asc")->get("categories")->result();

for ($z = 0; $z < count($categories_data); $z++) {
  $selected = 0;
  if ($gl_session["session_data"]['product_categories_list'][$categories_data[$z]['id']] == 1) $selected = 1;
  $categories[$categories_data[$z]['id']] = array(
    'id' => $categories_data[$z]['id'],
    "name" => $categories_data[$z]['name'],
    'selected' => $selected
  );
  $sub_categories_data = $this->db->where("parent_id", $categories_data[$z]['id'])->order_by("name", "asc")->get("categories")->result();
  for ($z1 = 0; $z1 < count($sub_categories_data); $z1++) {
    $selected = 0;
    if ($gl_session["session_data"]['product_categories_list'][$sub_categories_data[$z1]['id']] == 1) $selected = 1;
    $categories[$sub_categories_data[$z1]['id']] = array(
      'id' => $sub_categories_data[$z1]['id'],
      "name" => "=>" . $sub_categories_data[$z1]['name'],
      'selected' => $selected
    );
    $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("name", "asc")->get("categories")->result();
    for ($z2 = 0; $z2 < count($sub_categories_data1); $z2++) {
      $selected = 0;
      if ($gl_session["session_data"]['product_categories_list'][$sub_categories_data1[$z2]['id']] == 1) $selected = 1;
      $categories[$sub_categories_data1[$z2]['id']] = array(
        'id' => $sub_categories_data1[$z2]['id'],
        "name" => "== =>" . $sub_categories_data1[$z2]['name'],
        'selected' => $selected
      );
      $sub_categories_data2 = $this->db->where("parent_id", $sub_categories_data1[$z2]['id'])->order_by("name", "asc")->get("categories")->result();
      for ($z3 = 0; $z3 < count($sub_categories_data2); $z3++) {
        $selected = 0;
        if ($gl_session["session_data"]['product_categories_list'][$sub_categories_data2[$z3]['id']] == 1) $selected = 1;
        $categories[$sub_categories_data2[$z3]['id']] = array(
          'id' => $sub_categories_data2[$z3]['id'],
          "name" => "== == =>" . $sub_categories_data2[$z3]['name'],
          'selected' => $selected
        );
      }
    }
  }
}

$sklads_info = array();
$sklads_data = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id", 0)->order_by("name", "asc")->get("sklads")->result();

for ($z = 0; $z < count($sklads_data); $z++) {
  $selected = 0;
  if ($gl_session["session_data"]['sklads'][$sklads_data[$z]['id']] == 1) $selected = 1;
  $sklads_info[$sklads_data[$z]['id']] = array(
    'id' => $sklads_data[$z]['id'],
    "name" => $sklads_data[$z]['name'],
    'selected' => $selected
  );
  $sub_sklads_data = $this->db->where("parent_id", $sklads_data[$z]['id'])->order_by("name", "asc")->get("sklads")->result();
  for ($z1 = 0; $z1 < count($sub_sklads_data); $z1++) {
    $selected = 0;
    if ($gl_session["session_data"]['sklads'] == $sub_sklads_data[$z1]['id']) $selected = 1;
    $sklads_info[$sub_sklads_data[$z1]['id']] = array(
      'id' => $sub_sklads_data[$z1]['id'],
      "name" => "=>" . $sub_sklads_data[$z1]['name'],
      'selected' => $selected
    );
    $sub_sklads_data1 = $this->db->where("parent_id", $sub_sklads_data[$z1]['id'])->order_by("name", "asc")->get("sklads")->result();
    for ($z2 = 0; $z2 < count($sub_sklads_data1); $z2++) {
      $selected = 0;
      if ($gl_session["session_data"]['sklads'] == $sub_sklads_data1[$z2]['id']) $selected = 1;
      $sklads_info[$sub_sklads_data1[$z2]['id']] = array(
        'id' => $sub_sklads_data1[$z2]['id'],
        "name" => "== =>" . $sub_sklads_data1[$z2]['name'],
        'selected' => $selected
      );
      $sub_sklads_data2 = $this->db->where("parent_id", $sub_sklads_data1[$z2]['id'])->order_by("name", "asc")->get("sklads")->result();
      for ($z3 = 0; $z3 < count($sub_sklads_data2); $z3++) {
        $selected = 0;
        if ($gl_session["session_data"]['sklads'] == $sub_sklads_data2[$z3]['id']) $selected = 1;
        $sklads_info[$sub_sklads_data2[$z3]['id']] = array(
          'id' => $sub_sklads_data2[$z3]['id'],
          "name" => "== == =>" . $sub_sklads_data2[$z3]['name'],
          'selected' => $selected
        );
      }
    }
  }
}

$type_post = $this->get("type");

if ($this->isPost() && $type_post == "change_category") {
  $category_id = $this->get("category_id");
  $category_ = $this->db->where("parent_id", $category_id)->get('categories')->result();
  $select = "<option value='0'>Выберите тип категории</option>";
  if (is_array($category_) && $category_id != 0) {
    for ($i = 0; $i < count($category_); $i++) {
      $selected = "";
      if($category_[$i]['id'] == $gl_session["session_data"]['product_category_2'] || $category_[$i]['id'] == $gl_session["session_data"]['product_category_3']  || $category_[$i]['id'] == $gl_session["session_data"]['product_category_4'] ){
        $selected = "selected";
      }
      $select.= "<option ".$selected." value='" . $category_[$i]['id'] ."' >" . $category_[$i]['name']."</option>";
    }
  }

  echo json_encode(array(
    "select" => $select,
  ));
  exit();
}

$search_by_sklad = $gl_session["session_data"]['sklads'];

if ($this->isPost()) {
  $search_by_sklad = $this->get("sklad");
  $gl_session["session_data"]['sklads'] = $search_by_sklad;
}

if ($search_by_sklad != "") {
  for($z=0;$z<count($products);$z++){
    $info = $this->db->where("tovar_id",$products[$z]['products_id'])->where_in("sklad_id",$search_by_sklad.generate_sklads_list($search_by_sklad))->get("products_ostatki")->result();
    $num = 0;
    for($m=0;$m<count($info);$m++){
      $num += $info[$m]['kolichesctvo'];
    }
    /*$products[$z]['products_cnt'] = $num;*/
  }
}

$categories_data = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id", 0)->order_by("name", "asc")->get("categories")->result();
$this->r_v("categories_1", $categories_data);
$this->r_v("categories", $categories);
$this->r_v("sklads_info", $sklads_info);
$create_products_link = $this->l("create_products");
$this->r_v("create_products_link", $create_products_link);
$move_product_link = $this->l("move_product");
$this->r_v("move_product_link", $move_product_link);
$create_elements_link = $this->l("products_elements_create");
$this->r_v("create_elements_link", $create_elements_link );

$valuty = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("currencies")->result();
$this->r_v("valuty",$valuty ); 
 $this->r_v("products",$products); 
