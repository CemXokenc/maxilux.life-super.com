<?php
  $this->db = new active_records();
   
$this->db->where("company_id",$gl_session["session_data"]['company_id']);
$this->db->where("delete_status",0);

$name = $this->get("name");
$city = $this->get("city");
$street = $this->get("street");
$emeil = $this->get("emeil");

if($this->isPost() && $name != ""){
   $this->r_v("name_torg_tochka",$name);
   $this->db->like("name",$name);
}

if($this->isPost() && $city != ""){
   $this->r_v("city_torg_tochka",$city);
   $this->db->like("city",$city);
}

if($this->isPost() && $street != ""){
   $this->r_v("street_torg_tochka",$street);
   $this->db->like("street",$street);
}

if($this->isPost() && $emeil != ""){
   $this->r_v("emeil_torg_tochka",$emeil);
   $this->db->like("email",$emeil);
}

$order_as = $this->get("order_as");
$order_by_column = $this->get("order_by_column");

if($this->isPost()){
  $gl_session["session_data"]['postavchik_order_by_column'] = $order_by_column;
  $gl_session["session_data"]['postavchik_order_as'] = $order_as;
}

if($gl_session["session_data"]['postavchik_order_by_column'] != ""  && $gl_session["session_data"]['postavchik_order_as'] != ""){
  $this->db->order_by($gl_session["session_data"]['postavchik_order_by_column'], $gl_session["session_data"]['postavchik_order_as']);
}

 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $postavshiki = $this->db->select("postavshiki.delete_status as postavshiki_delete_status, postavshiki.company_id as postavshiki_company_id, postavshiki.img as postavshiki_img, postavshiki.credit as postavshiki_credit, postavshiki.zip_code as postavshiki_zip_code, postavshiki.debet as postavshiki_debet, postavshiki.office as postavshiki_office, postavshiki.house as postavshiki_house, postavshiki.email as postavshiki_email, postavshiki.street as postavshiki_street, postavshiki.city as postavshiki_city, postavshiki.telephone as postavshiki_telephone, postavshiki.name as postavshiki_name, postavshiki.id as postavshiki_id")->limit(100,($page_num-1)*100)->get("postavshiki", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("postavshiki")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"postavshiki_update", "id"=>"postavshiki_id", "num"=>"0", "label"=>"редактировать", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"postavshiki_delete", "id"=>"postavshiki_id", "num"=>"0", "label"=>"удалить", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"view_postavshik", "id"=>"postavshiki_id", "num"=>"0", "label"=>"view_postavshik", "html"=>"", "ajax"=>"0"); 
 $postavshiki = $this->prepare_actions_list($postavshiki,$urls_list); 

   $this->r_v("postavshiki_create_link", $this->l("postavshiki_create"));

 $navigation = $this->navigation("postavshiki","postavshiki", $items_count, 100,$page_navigation_url_prefix, $page_navigation_url_num); 

 
 $this->r_v("postavshiki",$postavshiki); 
