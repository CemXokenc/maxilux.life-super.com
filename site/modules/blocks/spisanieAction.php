<?php
  $this->db = new active_records();
   

$this->db->order_by("spisanie.id","desc");
$this->db->where("spisanie.product_id","products.id",1);
$this->db->where("spisanie.user_id","users.id",1);
$this->db->where("spisanie.order_id","orders.id",1);
$this->db->where("clients.id","orders.client_id",1);
$search_by_categories = $gl_session["session_data"]['product_categories'];
$type_post = $this->get("type");
if ($this->isPost() && $type_post != "change_category") {
  $search_by_categories = $this->get("categories");
  $gl_session["session_data"]['spisanie_categories'] = $search_by_categories;
}

if ($search_by_categories != "") {
  $search = $search_by_categories.generate_categories_list($search_by_categories);
  $this->db->where_in("products.category_id", $search);
}

if ($this->isPost() && $type_post != "change_category") {
  $search_by_categories = $this->get("categories");
  $gl_session["session_data"]['spisanie_categories'] = $search_by_categories;
  $gl_session["session_data"]['spisanie_category_1'] =  $this->get("categories_1");
  $gl_session["session_data"]['spisanie_category_2'] =  $this->get("categories_2");
  $gl_session["session_data"]['spisanie_category_3'] =  $this->get("categories_3");
  $gl_session["session_data"]['spisanie_category_4'] =  $this->get("categories_4");
}

$search_by_categories = $gl_session["session_data"]['spisanie_categories'];

$order_num = $this->get("order_num");
$data_c= $this->get("data_c");
$data_do = $this->get("data_do");
$user = $this->get("user");
$client = $this->get("client");
if($this->isPost()){
  $gl_session["session_data"]['spisanie_order_num']=$order_num ;
  $gl_session["session_data"]['spisanie_data_c']=$data_c;
  $gl_session["session_data"]['spisanie_data_do']=$data_do ;
  $gl_session["session_data"]['spisanie_user']=$user;
  $gl_session["session_data"]['spisanie_client']=$client;
}

$this->db->where("spisanie.company_id",$gl_session["session_data"]['company_id']);
if($gl_session["session_data"]['spisanie_order_num']!=""){
    $this->db->where("orders.nomer",$order_num);
}

if($gl_session["session_data"]['spisanie_client']!=""){
    $this->db->where("orders.client_id",$client);
}

if($gl_session["session_data"]['spisanie_user']!= ""){
  $this->db->where("spisanie.user_id", $user);
}

if($gl_session["session_data"]['spisanie_data_c']!= ""){
  $this->db->where("spisanie.operation_date >=", $data_c);
}

if($gl_session["session_data"]['spisanie_data_do']!= ""){
  $this->db->where("spisanie.operation_date <=", $data_do);
}



 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $spisanie = $this->db->select("spisanie.order_id as spisanie_order_id, spisanie.sklad_id as spisanie_sklad_id, spisanie.user_id as spisanie_user_id, clients.id as clients_id, products.id as products_id, products.category_id as products_category_id, products.name as products_name, spisanie.id as spisanie_id, spisanie.company_id as spisanie_company_id, spisanie.product_id as spisanie_product_id, spisanie.quantity as spisanie_quantity, spisanie.price as spisanie_price, spisanie.operation_date as spisanie_operation_date, clients.fio as clients_fio, orders.nomer as orders_nomer, orders.id as orders_id, orders.client_id as orders_client_id, users.last_name as users_last_name, users.first_name as users_first_name, users.id as users_id, users.last_name as users_last_name, users.first_name as users_first_name, users.id as users_id")->limit(20,($page_num-1)*20)->get("spisanie, clients, products, orders, users", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("spisanie, clients, products, orders, users")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"view_client", "id"=>"clients_id", "num"=>"0", "label"=>"view_client", "html"=>"", "ajax"=>"0"); 
 $spisanie = $this->prepare_actions_list($spisanie,$urls_list); 

 $navigation = $this->navigation("spisanie","spisanie", $items_count, 20,$page_navigation_url_prefix, $page_navigation_url_num); 



$type_post = $this->get("type");

if ($this->isPost() && $type_post == "change_category") {
  $category_id = $this->get("category_id");
  $category_ = $this->db->where("parent_id", $category_id)->get('categories')->result();
  $select = "<option value='0'>Выберите тип категории</option>";
  if (is_array($category_) && $category_id != 0) {
    for ($i = 0; $i < count($category_); $i++) {
      $selected = "";
      if($category_[$i]['id'] == $gl_session["session_data"]['spisanie_category_2'] || $category_[$i]['id'] == $gl_session["session_data"]['spisanie_category_3']  || $category_[$i]['id'] == $gl_session["session_data"]['spisanie_category_4'] ){
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


$categories = array();
$categories_data = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id", 0)->order_by("name", "asc")->get("categories")->result();

for ($z = 0; $z < count($categories_data); $z++) {
  $selected = 0;
  if ($gl_session["session_data"]['spisanie_categories_list'][$categories_data[$z]['id']] == 1) $selected = 1;
  $categories[$categories_data[$z]['id']] = array(
    'id' => $categories_data[$z]['id'],
    "name" => $categories_data[$z]['name'],
    'selected' => $selected
  );
  $sub_categories_data = $this->db->where("parent_id", $categories_data[$z]['id'])->order_by("name", "asc")->get("categories")->result();
  for ($z1 = 0; $z1 < count($sub_categories_data); $z1++) {
    $selected = 0;
    if ($gl_session["session_data"]['spisanie_categories_list'][$sub_categories_data[$z1]['id']] == 1) $selected = 1;
    $categories[$sub_categories_data[$z1]['id']] = array(
      'id' => $sub_categories_data[$z1]['id'],
      "name" => "=>" . $sub_categories_data[$z1]['name'],
      'selected' => $selected
    );
    $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("name", "asc")->get("categories")->result();
    for ($z2 = 0; $z2 < count($sub_categories_data1); $z2++) {
      $selected = 0;
      if ($gl_session["session_data"]['spisanie_categories_list'][$sub_categories_data1[$z2]['id']] == 1) $selected = 1;
      $categories[$sub_categories_data1[$z2]['id']] = array(
        'id' => $sub_categories_data1[$z2]['id'],
        "name" => "== =>" . $sub_categories_data1[$z2]['name'],
        'selected' => $selected
      );
      $sub_categories_data2 = $this->db->where("parent_id", $sub_categories_data1[$z2]['id'])->order_by("name", "asc")->get("categories")->result();
      for ($z3 = 0; $z3 < count($sub_categories_data2); $z3++) {
        $selected = 0;
        if ($gl_session["session_data"]['spisanie_categories_list'][$sub_categories_data2[$z3]['id']] == 1) $selected = 1;
        $categories[$sub_categories_data2[$z3]['id']] = array(
          'id' => $sub_categories_data2[$z3]['id'],
          "name" => "== == =>" . $sub_categories_data2[$z3]['name'],
          'selected' => $selected
        );
      }
    }
  }
}

$categories_data = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id", 0)->order_by("name", "asc")->get("categories")->result();
$this->r_v("categories_1", $categories_data);
$this->r_v("categories", $categories);
$users_db = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("users")->result();
$this->r_v("users_db",$users_db);
$clients = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("clients")->result();
  $this->r_v("clients", $clients);

for($z=0;$z<count($spisanie);$z++){

  $spisanie[$z]['spisanie_operation_date'] = date('d.m.Y H:i',strtotime($spisanie[$z]['spisanie_operation_date']));  

} 
 $this->r_v("spisanie",$spisanie); 
