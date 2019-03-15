<?php
  $this->db = new active_records();
   
$type_post = $this->get("type");
if ($this->isPost() && $type_post == "zayavka" && $gl_session["session_data"]['zayavka_create'] == 1) {
  $gl_session["session_data"]['type_cart'] = 2;
}

if ($this->isPost() && $type_post == "zakaz" && $gl_session["session_data"]['zakaz_list'] == 1) {
  $gl_session["session_data"]['type_cart'] = 1;
}

if(arg(1) != '')
{
$page_navigation_url_num = 2;
$page_navigation_url_prefix = arg(1)."/";
}
$search_by_categories = $gl_session["session_data"]['shop_product_categories'];
$type_post = $this->get("type");
$name_search = $this->get("name_search");
$valyta = $this->get("valuty");
$cena_c = $this->get("cena_c");
$cena_do= $this->get("cena_do");
$got_images = $this->get("got_images");
if ($this->isPost() && $type_post != "change_category") {
  $search_by_categories = $this->get("categories");
  $gl_session["session_data"]['shop_product_categories'] = $search_by_categories;
  $gl_session["session_data"]['shop_product_category_1'] =  $this->get("categories_1");
  $gl_session["session_data"]['shop_product_category_2'] =  $this->get("categories_2");
  $gl_session["session_data"]['shop_product_category_3'] =  $this->get("categories_3");
  $gl_session["session_data"]['shop_product_category_4'] =  $this->get("categories_4");
  $gl_session["session_data"]['valyta'] =  $valyta;
  $gl_session["session_data"]['products_list_cena_c'] =  $cena_c;
  $gl_session["session_data"]['products_list_cena_do'] =  $cena_do;
  $gl_session["session_data"]['products_list_got_images'] =  $got_images;
}

if($gl_session["session_data"]['products_list_got_images']!=""){
  $this->db->where("got_images", $gl_session["session_data"]['products_list_got_images']);
}

if ($search_by_categories != "") {
  $search = $search_by_categories.generate_categories_list($search_by_categories);
  $this->db->where_in("category_id", $search);
}

if($gl_session["session_data"]['products_list_cena_c']!= ""){
  $this->db->where("price >=", $gl_session["session_data"]['products_list_cena_c']);
}

if($gl_session["session_data"]['products_list_cena_do']!= ""){
  $this->db->where("price  <=", $gl_session["session_data"]['products_list_cena_do']);
}

if ($name_search  != "") {

  $this->db->like("name", $name_search);
}
$this->db->where("izdelie_type", 0)->where("company_id", $gl_session["session_data"]['company_id']);

$this->db->where("name <>","")->order_by("category_id", "asc")->order_by("name", "asc");

$this->db->where("hidden",0);

 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $products_list = $this->db->select("products.got_images as products_got_images, products.zakazano as products_zakazano, products.currency as products_currency, products.izdelie_type as products_izdelie_type, products.roznichnaya_price as products_roznichnaya_price, products.izdelie as products_izdelie, products.name as products_name, products.cnt as products_cnt, products.category_id as products_category_id, products.id as products_id, products.price as products_price")->limit(100,($page_num-1)*100)->get("products", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("products")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"product_view", "id"=>"products_id", "num"=>"0", "label"=>"Просмотреть", "html"=>"", "ajax"=>"0"); 
 $products_list = $this->prepare_actions_list($products_list,$urls_list); 

 $navigation = $this->navigation("products_list","products_list", $items_count, 100,$page_navigation_url_prefix, $page_navigation_url_num); 





if($gl_session["session_data"]['valyta']==""){
  $gl_session["session_data"]['valyta'] ="UAH";
}

for($z=0;$z<count($products_list);$z++){

  $info = calc_price($products_list[$z]['products_price'], $products_list[$z]['products_currency'],$gl_session["session_data"]['valyta']);
  $price_tovar =  $products_list[$z]['products_price']; //помещаем исходную цену в переменную для подсчёта розничной ниже
  $products_list[$z]['products_price'] = "<div>".$info['view']."</div>";

  $category_1 = $this->db->where("id",$products_list[$z]['products_category_id'])->get("categories")->result();
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
  /*$price_t = $price_tovar+$price_tovar*$nacenka/100;*/
  $info_2 = calc_price($price_tovar+$price_tovar*$nacenka/100, $products_list[$z]['products_currency'],$gl_session["session_data"]['valyta']);

  $products_list[$z]['products_roznichnaya_price'] = "<div>".$info_2['view']."</div>";

  if($gl_session["session_data"]['type_cart'] == 2){
    $kupit = $products_list[$z]['products_cnt'] - $products_list[$z]['products_zakazano'];
    if($kupit < 0) {$kupit*=-1;$kupit = "<span style='color:red;'>куп.:".$kupit."</span>";}
    else{$kupit="";}

    $products_list[$z]['products_roznichnaya_price'] = "кол.:".$products_list[$z]['products_cnt']." зак.:".$products_list[$z]['products_zakazano'].$kupit;
  }
  $images =  $this->db->where("product_id",$products_list[$z]['products_id'])->get("products_files")->result();
  if(count($images) > 0){
    $products_list[$z]['products_image'] = "{$products_list[$z]['products_id']}/{$images[0]['name']}";
  }
}

$categories = array();
$categories_data = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id", 0)->order_by("name", "asc")->get("categories")->result();

for ($z = 0; $z < count($categories_data); $z++) {
  $selected = 0;
  if ($gl_session["session_data"]['shop_product_categories_list'][$categories_data[$z]['id']] == 1) $selected = 1;
  $categories[$categories_data[$z]['id']] = array(
    'id' => $categories_data[$z]['id'],
    "name" => $categories_data[$z]['name'],
    'selected' => $selected
  );
  $sub_categories_data = $this->db->where("parent_id", $categories_data[$z]['id'])->order_by("name", "asc")->get("categories")->result();
  for ($z1 = 0; $z1 < count($sub_categories_data); $z1++) {
    $selected = 0;
    if ($gl_session["session_data"]['shop_product_categories_list'][$sub_categories_data[$z1]['id']] == 1) $selected = 1;
    $categories[$sub_categories_data[$z1]['id']] = array(
      'id' => $sub_categories_data[$z1]['id'],
      "name" => "=>" . $sub_categories_data[$z1]['name'],
      'selected' => $selected
    );
    $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("name", "asc")->get("categories")->result();
    for ($z2 = 0; $z2 < count($sub_categories_data1); $z2++) {
      $selected = 0;
      if ($gl_session["session_data"]['shop_product_categories_list'][$sub_categories_data1[$z2]['id']] == 1) $selected = 1;
      $categories[$sub_categories_data1[$z2]['id']] = array(
        'id' => $sub_categories_data1[$z2]['id'],
        "name" => "== =>" . $sub_categories_data1[$z2]['name'],
        'selected' => $selected
      );
      $sub_categories_data2 = $this->db->where("parent_id", $sub_categories_data1[$z2]['id'])->order_by("name", "asc")->get("categories")->result();
      for ($z3 = 0; $z3 < count($sub_categories_data2); $z3++) {
        $selected = 0;
        if ($gl_session["session_data"]['shop_product_categories_list'][$sub_categories_data2[$z3]['id']] == 1) $selected = 1;
        $categories[$sub_categories_data2[$z3]['id']] = array(
          'id' => $sub_categories_data2[$z3]['id'],
          "name" => "== == =>" . $sub_categories_data2[$z3]['name'],
          'selected' => $selected
        );
      }
    }
  }
}



if ($this->isPost() && $type_post == "change_category") {
  $category_id = $this->get("category_id");
  $category_ = $this->db->where("parent_id", $category_id)->get('categories')->result();
  $select = "<option value='0'>Выберите тип категории</option>";
  if (is_array($category_) && $category_id != 0) {
    for ($i = 0; $i < count($category_); $i++) {
     $selected = "";
      if($category_[$i]['id'] == $gl_session["session_data"]['shop_product_category_2'] || $category_[$i]['id'] == $gl_session["session_data"]['shop_product_category_3']  || $category_[$i]['id'] == $gl_session["session_data"]['shop_product_category_4'] ){
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

$categories_data = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id", 0)->order_by("name", "asc")->get("categories")->result();
$this->r_v("categories_1", $categories_data);
$this->r_v("categories", $categories);
$cart = $this->l("cart");
$this->r_v("cart_link",$cart);
$this->r_v("cart_count",count($gl_session["session_data"]['cart']));
$valuty = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("currencies")->result();
$this->r_v("valuty",$valuty );
if(arg(2) == '')
{
	$this->r_v("list_link_1", $this->l("products_list".'/1'));
	$this->r_v("list_link_2", $this->l("products_list".'/2'));
}
else
{
	$this->r_v("list_link_1", $this->l("products_list".'/1/'.arg(2)));
	$this->r_v("list_link_2", $this->l("products_list".'/2/'.arg(2)));
}
$this->r_v("list_type", arg(1)); 
 $this->r_v("products_list",$products_list); 
