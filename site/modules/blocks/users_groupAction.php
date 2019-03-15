<?php
  $this->db = new active_records();
   
$this->db->where("hidden", 0);

 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $users_group = $this->db->select("users_group.type as users_group_type, users_group.name as users_group_name, users_group.id as users_group_id")->get("users_group")->result(); 

 $urls_list = array(); 
 $urls_list[] = array("action"=>"users_group_update", "id"=>"users_group_id", "num"=>"0", "label"=>"редактировать", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"users_group_delete", "id"=>"users_group_id", "num"=>"0", "label"=>"удалить", "html"=>"", "ajax"=>"0"); 
 $users_group = $this->prepare_actions_list($users_group,$urls_list); 

   $this->r_v("users_group_create_link", $this->l("users_group_create"));


for($i=0; $i < count($users_group); $i++){
    switch($users_group[$i]['users_group_type']){
    case 0 : $users_group[$i]['users_group_type'] = "Администратор";break;
    case 1 : $users_group[$i]['users_group_type'] = "Рабочий";break;
    case 2 : $users_group[$i]['users_group_type'] = "Менеджер";break;
    }
} 
 $this->r_v("users_group",$users_group); 
