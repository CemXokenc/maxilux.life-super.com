<?php
  $this->db = new active_records();
   
$this->db->where("postavshiki.id","vozvrat.postavshik_id",1);
$this->db->where("users.id","vozvrat.user_id",1);
$postavshik = $this->get("postavshik");
$name_postavshik = $this->get("name_postavshik");
$data_c = $this->get("data_c");
$data_do= $this->get("data_do");
$nomer_nakladnoy = $this->get("nomer_nakladnoy");
$nomer_postupleniya = $this->get("nomer_postupleniya");
$order_as = $this->get("order_as");
$order_by_column = $this->get("order_by_column");

if($this->isPost()){
  $gl_session["session_data"]['vozvrat_order_by_column'] = $order_by_column;
  $gl_session["session_data"]['vozvrat_order_as'] = $order_as;
  $gl_session["session_data"]['vozvrat_postavshik'] = $postavshik ;
  $gl_session["session_data"]['vozvrat_name_postavshik'] = $name_postavshik ;
  $gl_session["session_data"]['vozvrat_data_c'] = $data_c;
  $gl_session["session_data"]['vozvrat_data_do'] = $data_do;
  $gl_session["session_data"]['vozvrat_nomer_nakladnoy'] = $nomer_nakladnoy;
  $gl_session["session_data"]['vozvrat_nomer_postupleniya'] = $nomer_postupleniya ;
}
if($this->isPost() && $gl_session["session_data"]['vozvrat_nomer_nakladnoy']!= ""){
  $this->db->where("vozvrat.nomer_naklodnoy", $nomer_nakladnoy );
}

if($this->isPost() &&  $gl_session["session_data"]['vozvrat_nomer_postupleniya'] != ""){
  $this->db->where("vozvrat.nomer", $nomer_postupleniya );
}

if($this->isPost() && $gl_session["session_data"]['vozvrat_postavshik'] != 0){
  $this->db->where("postavshiki.id", $postavshik);
}
if($this->isPost() && $gl_session["session_data"]['vozvrat_name_postavshik'] != ""){
  $this->db->like("postavshiki.name", $name_postavshik );
}

if($this->isPost() && $gl_session["session_data"]['vozvrat_data_c'] != ""){
  $this->db->where("vozvrat.data_postupleniya >", $data_c);
}

if($this->isPost() && $gl_session["session_data"]['vozvrat_data_do'] != ""){
  $this->db->where("vozvrat.data_postupleniya <", $data_do);
}



if($gl_session["session_data"]['vozvrat_order_by_column'] != ""  && $gl_session["session_data"]['postuplenie_order_as'] != ""){
  $this->db->order_by($gl_session["session_data"]['vozvrat_order_by_column'], $gl_session["session_data"]['postuplenie_order_as']);
}else{
  $this->db->order_by("vozvrat.nomer","desc");
}

$this->db->where("vozvrat.company_id",$gl_session["session_data"]['company_id']);

 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $vozvrat = $this->db->select("vozvrat.nomer as vozvrat_nomer, vozvrat.img as vozvrat_img, vozvrat.summa_tovarov as vozvrat_summa_tovarov, vozvrat.user_id as vozvrat_user_id, vozvrat.company_id as vozvrat_company_id, vozvrat.nomer_naklodnoy as vozvrat_nomer_naklodnoy, vozvrat.valuta as vozvrat_valuta, vozvrat.id as vozvrat_id, postavshiki.company_id as postavshiki_company_id, postavshiki.zip_code as postavshiki_zip_code, vozvrat.data_postupleniya as vozvrat_data_postupleniya, vozvrat.postavshik_id as vozvrat_postavshik_id, vozvrat.summa as vozvrat_summa, postavshiki.office as postavshiki_office, postavshiki.house as postavshiki_house, postavshiki.street as postavshiki_street, postavshiki.city as postavshiki_city, postavshiki.email as postavshiki_email, postavshiki.telephone as postavshiki_telephone, postavshiki.name as postavshiki_name, postavshiki.id as postavshiki_id, users.last_name as users_last_name, users.first_name as users_first_name, users.id as users_id, users.last_name as users_last_name, users.first_name as users_first_name, users.id as users_id")->limit(100,($page_num-1)*100)->get("vozvrat, postavshiki, users", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("vozvrat, postavshiki, users")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"vozvrat_update", "id"=>"vozvrat_id", "num"=>"0", "label"=>"редактировать", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"vozvrat_delete", "id"=>"vozvrat_id", "num"=>"0", "label"=>"удалить", "html"=>"", "ajax"=>"0"); 
 $vozvrat = $this->prepare_actions_list($vozvrat,$urls_list); 

   $this->r_v("vozvrat_create_link", $this->l("vozvrat_create"));

 $navigation = $this->navigation("vozvrat","vozvrat", $items_count, 100,$page_navigation_url_prefix, $page_navigation_url_num); 



for($z=0;$z<count($vozvrat);$z++){

  $vozvrat[$z]['vozvrat_data_postupleniya'] = date('d.m.Y',strtotime($vozvrat[$z]['vozvrat_data_postupleniya']));
}

$postavshiki = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("postavshiki")->result();
$this->r_v("postavshiki",$postavshiki); 
 $this->r_v("vozvrat",$vozvrat); 
