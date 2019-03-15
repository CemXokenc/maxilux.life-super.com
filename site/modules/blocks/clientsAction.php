<?php
  $this->db = new active_records();
   
if($gl_session["session_data"]['user_type'] == 12 || $gl_session["session_data"]['user_type'] == 6){
   $this->db->where("clients.torgovaya_tochka_id",$gl_session["session_data"]['torgovaya_tockka']);
}
$this->db->where("clients.delete_status",0);
$this->db->where("company_id",$gl_session["session_data"]['company_id']);
$name = $this->get("name");
$email = $this->get("email");
$telephone = $this->get("telephone");
$torg_tochka = $this->get("torg_tchk");
$skidka = $this->get("skidka");
$order_as = $this->get("order_as");
$order_by_column = $this->get("order_by_column");

if($this->isPost()){
  $gl_session["session_data"]['client_name'] = $name;
  $gl_session["session_data"]['client_email'] = $email;
  $gl_session["session_data"]['client_telephone'] = $telephone;
  $gl_session["session_data"]['client_order_by_column'] = $order_by_column;
  $gl_session["session_data"]['client_order_as'] = $order_as;
  $gl_session["session_data"]['client_skidka'] = $skidka ;
}

if($gl_session["session_data"]['client_skidka']!= ""){
  $this->db->where("clients.skidka_id", $skidka);
}

if($this->isPost() && $name != ""){
   $this->r_v("name_user",$name);
   $this->db->like("fio",$name);
}

if($gl_session["session_data"]['user_type'] == 12){
   
   $this->r_v("torg_tochka_user",$gl_session["session_data"]['torgovaya_tockka']);
   $this->db->where("torgovaya_tochka_id",$gl_session["session_data"]['torgovaya_tockka']);
}

/*
if($this->isPost() && $name != ""){
   $this->r_v("name_user",$name);
   $this->db->like("fio",$name);
}

if($this->isPost() && $order_by_column != "" && $order_as != ""){
  $this->r_v("order_as", $order_as);
  $this->r_v("order_by_column", $order_by_column);
  $this->db->order_by($order_by_column,$order_as);
}

if($this->isPost() && $email != ""){
   $this->r_v("email_user",$email );
   $this->db->like("email",$email);
}

if($this->isPost() && $telephone != ""){
   $this->r_v("telephone_user",$telephone );
   $this->db->like("telephone",$telephone );
}
*/

if($this->isPost() && $torg_tochka != "" && $torg_tochka != "0" && $gl_session["session_data"]['user_type'] != 12){
   $this->r_v("torg_tochka_user",$torg_tochka );
   $this->db->where("torgovaya_tochka_id",$torg_tochka );
}

if($gl_session["session_data"]['client_name'] != ""){
  $this->r_v("telephone_user",$gl_session["session_data"]['client_name']);
  $this->db->like("telephone",$gl_session["session_data"]['client_name']);
}
if($gl_session["session_data"]['client_email'] != ""){
  $this->r_v("telephone_user",$gl_session["session_data"]['client_email']);
  $this->db->like("telephone",$gl_session["session_data"]['client_email']);
}
if($gl_session["session_data"]['client_telephone'] != ""){
  $this->r_v("telephone_user",$gl_session["session_data"]['client_telephone']);
  $this->db->like("telephone",$gl_session["session_data"]['client_telephone']);
}
if($gl_session["session_data"]['client_order_by_column'] != ""  && $gl_session["session_data"]['client_order_as'] != ""){
  $this->db->order_by($gl_session["session_data"]['client_order_by_column'], $gl_session["session_data"]['client_order_as']);
}

 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $clients = $this->db->select("clients.img as clients_img, clients.delete_status as clients_delete_status, clients.telephone2 as clients_telephone2, clients.telephone1 as clients_telephone1, clients.sum_zakazov as clients_sum_zakazov, clients.torgovaya_tochka_id as clients_torgovaya_tochka_id, clients.id as clients_id, clients.telephone as clients_telephone, clients.email as clients_email, clients.fio as clients_fio")->limit(100,($page_num-1)*100)->get("clients", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("clients")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"clients_update", "id"=>"clients_id", "num"=>"0", "label"=>"редактировать", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"clients_delete", "id"=>"clients_id", "num"=>"0", "label"=>"удалить", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"view_client", "id"=>"clients_id", "num"=>"0", "label"=>"view_client", "html"=>"", "ajax"=>"0"); 
 $clients = $this->prepare_actions_list($clients,$urls_list); 

   $this->r_v("clients_create_link", $this->l("clients_create"));

 $navigation = $this->navigation("clients","clients", $items_count, 100,$page_navigation_url_prefix, $page_navigation_url_num); 



for($z=0;$z<count($clients);$z++){
  $clients_sum_zakazov = $this->db->select_sum('summa')->where("client_id", $clients[$z]['clients_id'])->get('orders')->result();
  $clients[$z]['clients_sum_zakazov'] = number_format($clients_sum_zakazov[0]['summa'],2,".",",");
}

$torg_tochki = $this->db->get("torgovye_tochki")->result();
 $this->r_v("torg_tochki", $torg_tochki);

$skidki_db= $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("skidki")->result();
$this->r_v("skidki_db", $skidki_db); 
 $this->r_v("clients",$clients); 
