<?php
  $this->db = new active_records();
   
$this->db->where("company_id",$gl_session["session_data"]['company_id']);

 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $professions = $this->db->select("professions.company_id as professions_company_id, professions.sdelnaya as professions_sdelnaya, professions.vchas as professions_vchas, professions.stavka as professions_stavka, professions.bonus as professions_bonus, professions.name as professions_name, professions.id as professions_id, professions.company_id as professions_company_id, professions.sdelnaya as professions_sdelnaya, professions.vchas as professions_vchas, professions.stavka as professions_stavka, professions.bonus as professions_bonus, professions.name as professions_name, professions.id as professions_id")->limit(20,($page_num-1)*20)->get("professions", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("professions")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"professions_update", "id"=>"professions_id", "num"=>"0", "label"=>"редактировать", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"professions_delete", "id"=>"professions_id", "num"=>"0", "label"=>"удалить", "html"=>"", "ajax"=>"0"); 
 $professions = $this->prepare_actions_list($professions,$urls_list); 

   $this->r_v("professions_create_link", $this->l("professions_create"));

 $navigation = $this->navigation("professions","professions", $items_count, 20,$page_navigation_url_prefix, $page_navigation_url_num); 

 
 $this->r_v("professions",$professions); 
