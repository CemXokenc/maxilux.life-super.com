<?php
  $this->db = new active_records();
   
  $this->db->where("company_id",$gl_session["session_data"]['company_id']);
  $this->db->order_by("id","desc");

 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $spravochnik_valut = $this->db->select("currencies.rate as currencies_rate, currencies.company_id as currencies_company_id, currencies.kod_valuty as currencies_kod_valuty, currencies.name as currencies_name, currencies.id as currencies_id")->limit(100,($page_num-1)*100)->get("currencies", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("currencies")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"spravochnik_valut_update", "id"=>"currencies_id", "num"=>"0", "label"=>"spravochnik_valut_update", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"spravochnik_valut_delete", "id"=>"currencies_id", "num"=>"0", "label"=>"spravochnik_valut_delete", "html"=>"", "ajax"=>"0"); 
 $spravochnik_valut = $this->prepare_actions_list($spravochnik_valut,$urls_list); 

   $this->r_v("spravochnik_valut_create_link", $this->l("spravochnik_valut_create"));

 $navigation = $this->navigation("spravochnik_valut","spravochnik_valut", $items_count, 100,$page_navigation_url_prefix, $page_navigation_url_num); 

 
 $this->r_v("spravochnik_valut",$spravochnik_valut); 
