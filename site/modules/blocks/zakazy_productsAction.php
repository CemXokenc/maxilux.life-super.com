<?php
  $this->db = new active_records();
   
$this->db->where("orders.delete_status",0);

if($gl_session["session_data"]['user_type'] == 12 || $gl_session["session_data"]['user_type'] == 6){
   $this->db->where("orders.torgovaya_tochka_id",$gl_session["session_data"]['torgovaya_tockka']);
}

$type_post = $this->get("type");

if ($this->isPost()/* && $type_post != "change_category"*/) {
  $gl_session["session_data"]['z_product_categories'] = $this->get("categories");
  $gl_session["session_data"]['z_product_category_1'] = $this->get("categories_1");
  $gl_session["session_data"]['z_product_category_2'] = $this->get("categories_2");
  $gl_session["session_data"]['z_product_category_3'] = $this->get("categories_3");
  $gl_session["session_data"]['z_product_category_4'] = $this->get("categories_4");
}
$search_by_categories = $gl_session["session_data"]['z_product_categories'];


if ($search_by_categories != "") {
  $search = $search_by_categories.generate_categories_list($search_by_categories);
  $this->db->where_in("products.category_id", $search);
}


$this->db->where("products.id", "order_products.product_id",1);
/*$this->db->where("category_statuses.id", "order_products.category_status",1);*/
$this->db->where("orders.id", "order_products.order_id",1);
$this->db->where("orders.client_id", "clients.id",1);
$this->db->where("products.company_id",$gl_session["session_data"]['company_id']);
$this->db->order_by("order_products.id","desc");
$data_c = $this->get("data_c");
$data_do= $this->get("data_do");
$torg_tochka = $this->get("torg_tchk");
$client = $this->get("client");
$manager= $this->get("manager");
$order_num = $this->get("order_num");
$order_statuses = $this->get("order_statuses");
$tovar_name = $this->get("tovar_name");
$skidka = $this->get("skidka");
if($this->isPost()){
  $gl_session["session_data"]['zakazy_products_client']=$client;
  $gl_session["session_data"]['zakazy_products_torg_tochka']=$torg_tochka;
  $gl_session["session_data"]['zakazy_products_manager']=$manager;
  $gl_session["session_data"]['zakazy_products_data_c']=$data_c;
  $gl_session["session_data"]['zakazy_products_data_do']=$data_do;
  $gl_session["session_data"]['zakazy_products_order_num']=$order_num;
  $gl_session["session_data"]['zakazy_products_order_statuses']=$order_statuses;
  $gl_session["session_data"]['zakazy_products_tovar_name']=$tovar_name;
  $gl_session["session_data"]['zakazy_products_skidka']=$skidka;
}

if($gl_session["session_data"]['zakazy_products_skidka']!= ""){
  $this->db->where("clients.skidka_id", $skidka);
}

if($gl_session["session_data"]['zakazy_products_tovar_name']!= ""){
  $this->db->like("products.name", $tovar_name);
}

if($gl_session["session_data"]['zakazy_products_data_c']!= ""){
  $this->db->where("orders.order_date >=", $data_c);
}

if($gl_session["session_data"]['zakazy_products_order_num']!= ""){
  $this->db->where("orders.nomer", $order_num);
}

if($gl_session["session_data"]['zakazy_products_order_statuses']!= ""){
  $this->db->where("orders.default_status", $order_statuses);
}

if($gl_session["session_data"]['zakazy_products_data_do']!= ""){
  $this->db->where("orders.order_date <=", $data_do);
}

if($gl_session["session_data"]['zakazy_products_torg_tochka'] != "" && $gl_session["session_data"]['zakazy_products_torg_tochka'] != "0"){
   $this->db->where("orders.torgovaya_tochka_id",$gl_session["session_data"]['zakazy_products_torg_tochka'] );
}

if($gl_session["session_data"]['zakazy_products_client'] != "" && $gl_session["session_data"]['zakazy_products_client']!= "0"){
 
   $this->db->where("orders.client_id",$gl_session["session_data"]['zakazy_products_client']);
}


if($gl_session["session_data"]['zakazy_products_manager']!= "" && $gl_session["session_data"]['zakazy_products_manager']!= "0"){
   $this->db->where("orders.manager_id",$gl_session["session_data"]['zakazy_products_manager']);
}

/*$this->db->print_query();*/

 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $zakazy_products = $this->db->select("products.name as products_name, products.id as products_id, clients.fio as clients_fio, clients.id as clients_id, orders.delete_status as orders_delete_status, orders.default_status as orders_default_status, orders.manager_id as orders_manager_id, orders.company_id as orders_company_id, orders.nomer as orders_nomer, orders.torgovaya_tochka_id as orders_torgovaya_tochka_id, orders.order_date as orders_order_date, orders.client_id as orders_client_id, orders.id as orders_id, order_products.session_data as order_products_session_data, order_products.category_status as order_products_category_status, order_products.product_id as order_products_product_id, order_products.kolichestvo as order_products_kolichestvo, order_products.order_id as order_products_order_id, order_products.id as order_products_id")->limit(20,($page_num-1)*20)->get("products, clients, orders, order_products", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("products, clients, orders, order_products")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"order_view", "id"=>"orders_id", "num"=>"0", "label"=>"order_view", "html"=>"", "ajax"=>"0"); 
 $zakazy_products = $this->prepare_actions_list($zakazy_products,$urls_list); 

 $navigation = $this->navigation("zakazy_products","zakazy_products", $items_count, 20,$page_navigation_url_prefix, $page_navigation_url_num); 



$torg_tochki = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("torgovye_tochki")->result();
$this->r_v("torg_tochki", $torg_tochki);
if($gl_session["session_data"]['user_type']!="12"){$clients = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("clients")->result();
  $this->r_v("clients", $clients);
}
if($gl_session["session_data"]['user_type']=="12"){$clients = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("torgovaya_tochka_id",$gl_session["session_data"]['torgovaya_tockka'])->get("clients")->result();
  $this->r_v("clients", $clients);
}

$managers = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("user_type",12)->get("users")->result();
$this->r_v("managers", $managers);

$order_statuses = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("orders_statuses")->result();
$this->r_v("order_statuses", $order_statuses);

$categories = array();
$categories_data = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id", 0)->order_by("name", "asc")->get("categories")->result();

for ($z = 0; $z < count($categories_data); $z++) {
  $selected = 0;
  if ($gl_session["session_data"]['z_product_categories_list'][$categories_data[$z]['id']] == 1) $selected = 1;
  $categories[$categories_data[$z]['id']] = array(
    'id' => $categories_data[$z]['id'],
    "name" => $categories_data[$z]['name'],
    'selected' => $selected
  );
  $sub_categories_data = $this->db->where("parent_id", $categories_data[$z]['id'])->order_by("name", "asc")->get("categories")->result();
  for ($z1 = 0; $z1 < count($sub_categories_data); $z1++) {
    $selected = 0;
    if ($gl_session["session_data"]['z_product_categories_list'][$sub_categories_data[$z1]['id']] == 1) $selected = 1;
    $categories[$sub_categories_data[$z1]['id']] = array(
      'id' => $sub_categories_data[$z1]['id'],
      "name" => "=>" . $sub_categories_data[$z1]['name'],
      'selected' => $selected
    );
    $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("name", "asc")->get("categories")->result();
    for ($z2 = 0; $z2 < count($sub_categories_data1); $z2++) {
      $selected = 0;
      if ($gl_session["session_data"]['z_product_categories_list'][$sub_categories_data1[$z2]['id']] == 1) $selected = 1;
      $categories[$sub_categories_data1[$z2]['id']] = array(
        'id' => $sub_categories_data1[$z2]['id'],
        "name" => "== =>" . $sub_categories_data1[$z2]['name'],
        'selected' => $selected
      );
      $sub_categories_data2 = $this->db->where("parent_id", $sub_categories_data1[$z2]['id'])->order_by("name", "asc")->get("categories")->result();
      for ($z3 = 0; $z3 < count($sub_categories_data2); $z3++) {
        $selected = 0;
        if ($gl_session["session_data"]['z_product_categories_list'][$sub_categories_data2[$z3]['id']] == 1) $selected = 1;
        $categories[$sub_categories_data2[$z3]['id']] = array(
          'id' => $sub_categories_data2[$z3]['id'],
          "name" => "== == =>" . $sub_categories_data2[$z3]['name'],
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
      if($category_[$i]['id'] == $gl_session["session_data"]['z_product_category_2'] || $category_[$i]['id'] == $gl_session["session_data"]['z_product_category_3']  || $category_[$i]['id'] == $gl_session["session_data"]['z_product_category_4'] ){
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

for($z=0;$z<count($zakazy_products);$z++){
     /*Получаем имя статуса. Если 0, то статус не выбран*/
     if($zakazy_products[$z]['order_products_category_status']>0){
         $status_db = $this->db->where("id",$zakazy_products[$z]['order_products_category_status'])->get("category_statuses")->result();
        $zakazy_products[$z]['order_products_category_status'] = $status_db[0]['name'];
     }else{
           $zakazy_products[$z]['order_products_category_status'] = "Не выбран";
       }
    
     $zakazy_products[$z]['orders_order_date']  = date('d.m.Y H:i',strtotime($zakazy_products[$z]['orders_order_date']));
      if($zakazy_products[$z]['order_products_session_data']==""){
            $view_link = $this->l("view_tovar/".$zakazy_products[$z]['order_products_id']."/2/".$zakazy_products[$z]['orders_nomer'] );
      }else
      {
          $view_link = $this->l("view_tovar/".$zakazy_products[$z]['order_products_id']."/1/".$zakazy_products[$z]['orders_nomer'] );
      }
       
      $zakazy_products[$z]['products_name'] = "<a target='__blank' href='".$view_link."'>".$zakazy_products[$z]['products_name']."</a>";
}

$skidki_db= $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("skidki")->result();
$this->r_v("skidki_db", $skidki_db); 
 $this->r_v("zakazy_products",$zakazy_products); 
