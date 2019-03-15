<?php
  $this->db = new active_records();
   
 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $view_tovar = $this->db->select("")->get("")->result(); 
$main_tovar_id = arg(1);

$session_data = $gl_session["session_data"]['cart'];
if(arg(2) == "1"){
  $info = $this->db->where("id",arg(1))->get("order_products")->result();
  $session_data = $info[0]['session_data'];
  $session_data = unserialize($session_data);

  $main_tovar_id = $info[0]['product_id'];
  if($info[0]['old_product_id'] > 0){
    $main_tovar_id = $info[0]['old_product_id'];
  }
  $session_data = $session_data['cart'];
  $session_data['product_prices'] = unserialize($info[0]['product_prices']); 
}else{
  $info = $this->db->where("id", $main_tovar_id)->get("products")->result();
  if($info[0]['session_data'] != ""){
    $session_data = $info[0]['session_data'];
    $session_data = unserialize($session_data);

    $session_data = $session_data['cart'];
    $main_tovar_id = $info[0]['old_product_id'];
  }
}
 $info2 = $this->db->select("name")->where("id",$main_tovar_id)->get("products")->result();
 $prod_name = $info2[0]['name'];
$info = generate_review_and_price($session_data, $main_tovar_id, $prod_name,arg(3));
$this->r_v("html_page",$info['html_page']); 
 $this->r_v("view_tovar",$view_tovar); 
