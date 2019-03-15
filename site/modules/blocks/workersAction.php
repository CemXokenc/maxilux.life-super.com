<?php
  $this->db = new active_records();
   
if($gl_session["session_data"]['user_type'] == 12 || $gl_session["session_data"]['user_type'] == 6){
   $this->db->where("workers.torgovaya_tochka_id",$gl_session["session_data"]['torgovaya_tockka']);
}
$this->db->where("workers.company_id",$gl_session["session_data"]['company_id']);
$this->db->where("professions.id","workers.profession_id",1);
$fio= $this->get("fio");
$profession = $this->get("profession");


if($this->isPost()){
 $gl_session["session_data"]['workers_profession']=$profession ;
  $gl_session["session_data"]['workers_fio']=$fio;
}

if( $gl_session["session_data"]['workers_profession']!= 0){
  $this->db->where("workers.profession_id", $profession);
}

if( $gl_session["session_data"]['workers_fio']!= ""){
  $this->db->like("workers.fio", $fio);
}

 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $workers = $this->db->select("professions.id as professions_id, professions.name as professions_name, workers.img as workers_img, workers.vchas as workers_vchas, workers.sdelnaya as workers_sdelnaya, workers.bonus as workers_bonus, workers.stavka as workers_stavka, workers.profession_id as workers_profession_id, workers.company_id as workers_company_id, workers.torgovaya_tochka_id as workers_torgovaya_tochka_id, workers.telephone1 as workers_telephone1, workers.telephone as workers_telephone, workers.email as workers_email, workers.fio as workers_fio, workers.ofice_id as workers_ofice_id, workers.id as workers_id, professions.id as professions_id, professions.name as professions_name")->limit(100,($page_num-1)*100)->get("professions, workers", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("professions, workers")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"workers_update", "id"=>"workers_id", "num"=>"0", "label"=>"редактировать", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"workers_delete", "id"=>"workers_id", "num"=>"0", "label"=>"удалить", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"view_worker", "id"=>"workers_id", "num"=>"0", "label"=>"view_worker", "html"=>"", "ajax"=>"0"); 
 $workers = $this->prepare_actions_list($workers,$urls_list); 

   $this->r_v("workers_create_link", $this->l("workers_create"));

 $navigation = $this->navigation("workers","workers", $items_count, 100,$page_navigation_url_prefix, $page_navigation_url_num); 



for($z=0;$z<count($workers);$z++){
    $current_profession = $this->db->where("id",$workers[$z]['workers_profession_id'])->get("professions")->result();
    if($workers[$z]['workers_stavka']==0){
        $workers[$z]['workers_stavka'] = $current_profession[0]['stavka'];
    }

    if($workers[$z]['workers_bonus']==0){
        $workers[$z]['workers_bonus'] = $current_profession[0]['bonus'];
    }

    if($workers[$z]['workers_vchas']==0){
        $workers[$z]['workers_vchas'] = $current_profession[0]['vchas'];
    }

    if($workers[$z]['workers_sdelnaya']==0){
        $workers[$z]['workers_sdelnaya'] = $current_profession[0]['sdelnaya'];
    }
}
$professions = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("professions")->result();
$this->r_v("professions", $professions); 
 $this->r_v("workers",$workers); 
