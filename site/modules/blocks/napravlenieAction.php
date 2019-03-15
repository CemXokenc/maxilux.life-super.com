<?php
  $this->db = new active_records();
   
$this->db->where("napravlenie.company_id",$gl_session["session_data"]['company_id']);

 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $napravlenie = $this->db->select("napravlenie.company_id as napravlenie_company_id, napravlenie.id as napravlenie_id, napravlenie.napravlenie as napravlenie_napravlenie")->limit(100,($page_num-1)*100)->get("napravlenie", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("napravlenie")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"napravlenie_update", "id"=>"napravlenie_id", "num"=>"0", "label"=>"редактировать", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"napravlenie_delete", "id"=>"napravlenie_id", "num"=>"0", "label"=>"удалить", "html"=>"", "ajax"=>"0"); 
 $napravlenie = $this->prepare_actions_list($napravlenie,$urls_list); 

   $this->r_v("napravlenie_create_link", $this->l("napravlenie_create"));

 $navigation = $this->navigation("napravlenie","napravlenie", $items_count, 100,$page_navigation_url_prefix, $page_navigation_url_num); 

 
 $this->r_v("napravlenie",$napravlenie); 
