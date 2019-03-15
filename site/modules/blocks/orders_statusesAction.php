<?php
  $this->db = new active_records();
   
$this->db->where("company_id",$gl_session["session_data"]['company_id'])->order_by("order_num", "asc");

 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $orders_statuses = $this->db->select("orders_statuses.color as orders_statuses_color, orders_statuses.spisanie as orders_statuses_spisanie, orders_statuses.order_num as orders_statuses_order_num, orders_statuses.set_default as orders_statuses_set_default, orders_statuses.name as orders_statuses_name, orders_statuses.company_id as orders_statuses_company_id, orders_statuses.id as orders_statuses_id")->limit(20,($page_num-1)*20)->get("orders_statuses", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("orders_statuses")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"orders_statuses_update", "id"=>"orders_statuses_id", "num"=>"0", "label"=>"редактировать", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"orders_statuses_delete", "id"=>"orders_statuses_id", "num"=>"0", "label"=>"удалить", "html"=>"", "ajax"=>"0"); 
 $orders_statuses = $this->prepare_actions_list($orders_statuses,$urls_list); 

   $this->r_v("orders_statuses_create_link", $this->l("orders_statuses_create"));

 $navigation = $this->navigation("orders_statuses","orders_statuses", $items_count, 20,$page_navigation_url_prefix, $page_navigation_url_num); 

 
 $this->r_v("orders_statuses",$orders_statuses); 
