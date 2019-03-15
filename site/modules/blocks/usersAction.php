<?php
  $this->db = new active_records();
   
if($gl_session["session_data"]['user_type'] == 12 || $gl_session["session_data"]['user_type'] == 6){
   $this->db->where("office_id",$gl_session["session_data"]['torgovaya_tockka']);
}
$this->db->where("company_id",$gl_session["session_data"]['company_id']);

 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $users = $this->db->select("users.img as users_img, users.company_id as users_company_id, users.last_login as users_last_login, users.last_name as users_last_name, users.first_name as users_first_name, users.user_type as users_user_type, users.company_id as users_company_id, users.id as users_id, users.img as users_img, users.name as users_name, users.last_login as users_last_login, users.last_name as users_last_name, users.first_name as users_first_name, users.user_type as users_user_type, users.id as users_id, users.name as users_name")->limit(100,($page_num-1)*100)->get("users", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("users")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"users_update", "id"=>"users_id", "num"=>"0", "label"=>"редактировать", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"users_delete", "id"=>"users_id", "num"=>"0", "label"=>"удалить", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"view_user", "id"=>"users_id", "num"=>"0", "label"=>"view_user", "html"=>"", "ajax"=>"0"); 
 $users = $this->prepare_actions_list($users,$urls_list); 

   $this->r_v("users_create_link", $this->l("users_create"));

 $navigation = $this->navigation("users","users", $items_count, 100,$page_navigation_url_prefix, $page_navigation_url_num); 



for($z=0;$z<count($users);$z++){
  $users_sum_zakazov = $this->db->select_sum('summa')->where("manager_id", $users[$z]['users_id'])->get('orders')->result();
  $users[$z]['users_sum_zakazov'] = number_format($users_sum_zakazov[0]['summa'],2,".",",");
} 
 $this->r_v("users",$users); 
