<?php
  $this->db = new active_records();
   
$this->db->where("postavshiki.id","postuplenie.postavshik_id",1);
$this->db->where("users.id","postuplenie.user_id",1);
$this->db->where("postavshiki.delete_status",0);
$postavshik = $this->get("postavshik");
$name_postavshik = $this->get("name_postavshik");
$data_c = $this->get("data_c");
$data_do= $this->get("data_do");
$nomer_nakladnoy = $this->get("nomer_nakladnoy");
$nomer_postupleniya = $this->get("nomer_postupleniya");
$order_as = $this->get("order_as");
$order_by_column = $this->get("order_by_column");

if($this->isPost()){
  $gl_session["session_data"]['postuplenie_order_by_column'] = $order_by_column;
  $gl_session["session_data"]['postuplenie_order_as'] = $order_as;
  $gl_session["session_data"]['postuplenie_postavshik'] = $postavshik ;
  $gl_session["session_data"]['postuplenie_name_postavshik'] = $name_postavshik ;
  $gl_session["session_data"]['postuplenie_data_c'] = $data_c;
  $gl_session["session_data"]['postuplenie_data_do'] = $data_do;
  $gl_session["session_data"]['postuplenie_nomer_nakladnoy'] = $nomer_nakladnoy;
  $gl_session["session_data"]['postuplenie_nomer_postupleniya'] = $nomer_postupleniya ;
}
if($this->isPost() && $gl_session["session_data"]['postuplenie_nomer_nakladnoy']!= ""){
      $this->db->where("postuplenie.nomer_naklodnoy", $nomer_nakladnoy );
}

if($this->isPost() &&  $gl_session["session_data"]['postuplenie_nomer_postupleniya'] != ""){
      $this->db->where("postuplenie.nomer", $nomer_postupleniya );
}

if($this->isPost() && $gl_session["session_data"]['postuplenie_postavshik'] != 0){
      $this->db->where("postavshiki.id", $postavshik);
}
if($this->isPost() && $gl_session["session_data"]['postuplenie_name_postavshik'] != ""){
      $this->db->like("postavshiki.name", $name_postavshik );
}

if($this->isPost() && $gl_session["session_data"]['postuplenie_data_c'] != ""){
      $this->db->where("postuplenie.data_postupleniya >", $data_c);
}

if($this->isPost() && $gl_session["session_data"]['postuplenie_data_do'] != ""){
      $this->db->where("postuplenie.data_postupleniya <", $data_do);
}



if($gl_session["session_data"]['postuplenie_order_by_column'] != ""  && $gl_session["session_data"]['postuplenie_order_as'] != ""){
  $this->db->order_by($gl_session["session_data"]['postuplenie_order_by_column'], $gl_session["session_data"]['postuplenie_order_as']);
}else{
  $this->db->order_by("postuplenie.nomer","desc");
}

$this->db->where("postuplenie.company_id",$gl_session["session_data"]['company_id']);

 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $postuplenie = $this->db->select("postuplenie.user_id as postuplenie_user_id, postuplenie.delete_status as postuplenie_delete_status, postuplenie.summa_tovarov as postuplenie_summa_tovarov, postuplenie.company_id as postuplenie_company_id, postuplenie.nomer as postuplenie_nomer, postuplenie.nomer_naklodnoy as postuplenie_nomer_naklodnoy, postuplenie.data_postupleniya as postuplenie_data_postupleniya, postuplenie.summa as postuplenie_summa, postuplenie.postavshik_id as postuplenie_postavshik_id, postuplenie.id as postuplenie_id, postavshiki.company_id as postavshiki_company_id, postavshiki.zip_code as postavshiki_zip_code, postavshiki.street as postavshiki_street, postavshiki.office as postavshiki_office, postavshiki.house as postavshiki_house, postavshiki.city as postavshiki_city, postavshiki.email as postavshiki_email, postavshiki.telephone as postavshiki_telephone, postavshiki.name as postavshiki_name, users.id as users_id, users.first_name as users_first_name, users.last_name as users_last_name, postavshiki.id as postavshiki_id, users.last_name as users_last_name, users.first_name as users_first_name, users.id as users_id")->get("postuplenie, postavshiki, users")->result(); 

 $urls_list = array(); 
 $urls_list[] = array("action"=>"postuplenie_update", "id"=>"postuplenie_id", "num"=>"0", "label"=>"редактировать", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"postuplenie_delete", "id"=>"postuplenie_id", "num"=>"0", "label"=>"удалить", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"postuplenie_view", "id"=>"postuplenie_id", "num"=>"0", "label"=>"postuplenie_view", "html"=>"", "ajax"=>"0"); 
 $postuplenie = $this->prepare_actions_list($postuplenie,$urls_list); 

   $this->r_v("postuplenie_create_link", $this->l("postuplenie_create"));



for($z=0;$z<count($postuplenie);$z++){

 $postuplenie[$z]['postuplenie_data_postupleniya'] = date('d.m.Y',strtotime($postuplenie[$z]['postuplenie_data_postupleniya']));  
}

$postavshiki = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("postavshiki")->result();
$this->r_v("postavshiki",$postavshiki); 
 $this->r_v("postuplenie",$postuplenie); 
