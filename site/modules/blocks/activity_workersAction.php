<?php
  $this->db = new active_records();
   
if($block_attr_type == "view_worker"){
  $page_navigation_url_num = 2;
  $page_navigation_url_prefix = arg(1)."/";
}

if($block_attr_type == "view_worker"){
  $worker = arg(1);
  $this->db->where("workers.id", $worker);
  $this->r_v("view_worker",1);
}

$this->db->where("order_product_statused.status_id","category_statuses.id",1);
$this->db->where("order_product_statused.order_id","orders.id",1);
$this->db->where("category_statuses.company_id",$gl_session["session_data"]['company_id']);
$this->db->where("order_product_statused.profession_id","professions.id",1);
$this->db->where("order_product_statused.user_id","workers.id",1);

$worker_id= $this->get("worker_id");
$profession_id= $this->get("profession_id");
$nomer_zakaza= $this->get("nomer_zakaza");
if($this->isPost()){
  $gl_session["session_data"]['activity_workers_worker_id']=$worker_id;
  $gl_session["session_data"]['activity_workers_profession_id']=$profession_id;
  $gl_session["session_data"]['activity_workers_nomer_zakaza']=$nomer_zakaza;
}

if($gl_session["session_data"]['activity_workers_worker_id']!= ""){
  $this->db->where("workers.id", $worker_id);
}

if($gl_session["session_data"]['activity_workers_profession_id']!= ""){
  $this->db->where("professions.id", $profession_id);
}

if($gl_session["session_data"]['activity_workers_nomer_zakaza']!= ""){
  $this->db->like("orders.nomer", $nomer_zakaza);
}

 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $activity_workers = $this->db->select("order_product_statused.created as order_product_statused_created, order_product_statused.profession_id as order_product_statused_profession_id, order_product_statused.user_id as order_product_statused_user_id, order_product_statused.status_id as order_product_statused_status_id, order_product_statused.order_id as order_product_statused_order_id, order_product_statused.id as order_product_statused_id, professions.name as professions_name, professions.id as professions_id, workers.id as workers_id, workers.fio as workers_fio, category_statuses.company_id as category_statuses_company_id, category_statuses.name as category_statuses_name, orders.nomer as orders_nomer, category_statuses.id as category_statuses_id, orders.id as orders_id, professions.name as professions_name, professions.id as professions_id, category_statuses.company_id as category_statuses_company_id, category_statuses.name as category_statuses_name, category_statuses.id as category_statuses_id")->limit(100,($page_num-1)*100)->get("order_product_statused, professions, workers, category_statuses, orders", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("order_product_statused, professions, workers, category_statuses, orders")->count_all_results(); 

 $navigation = $this->navigation("activity_workers","activity_workers", $items_count, 100,$page_navigation_url_prefix, $page_navigation_url_num); 



for($i=0;$i<count($activity_workers);$i++){
  $activity_workers[$i]['order_view_url'] = $this->l("order_view/".$activity_workers[$i]['orders_nomer']);
  $activity_workers[$i]['order_product_statused_created'] = date('d.m.Y H:i',strtotime($activity_workers[$i]['order_product_statused_created']));
}

$workers_db = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("workers")->result();
$this->r_v("workers_db",$workers_db);
$professions_db = $this->db->get("professions")->result();
$this->r_v("professions_db",$professions_db); 
 $this->r_v("activity_workers",$activity_workers); 
