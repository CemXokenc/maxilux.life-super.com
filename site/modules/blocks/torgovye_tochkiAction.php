<?php
  $this->db = new active_records();
   
$this->db->where("company_id",$gl_session["session_data"]['company_id']);
$this->db->where("delete_status",0);
$name = $this->get("name");
$city = $this->get("city");
$street = $this->get("street");
$emeil = $this->get("emeil");
$napravlenie = $this->get("napravlenie");

if($this->isPost() && $name != ""){
   $this->r_v("name_torg_tochka",$name);
   $this->db->like("name",$name);
}

if($this->isPost() && $city != ""){
   $this->r_v("city_torg_tochka",$city);
   $this->db->like("city",$city);
}

if($this->isPost() && $street != ""){
   $this->r_v("street_torg_tochka",$street);
   $this->db->like("street",$street);
}

if($this->isPost() && $emeil != ""){
   $this->r_v("emeil_torg_tochka",$emeil);
   $this->db->like("email",$emeil);
}

if($this->isPost() && $napravlenie!= "0"){
   $this->r_v("napravlenie",$napravlenie);
   $this->db->like("napravlenie_id",$napravlenie);
}

 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $torgovye_tochki = $this->db->select("torgovye_tochki.city as torgovye_tochki_city, torgovye_tochki.zip_code as torgovye_tochki_zip_code, torgovye_tochki.delete_status as torgovye_tochki_delete_status, torgovye_tochki.img as torgovye_tochki_img, torgovye_tochki.company_id as torgovye_tochki_company_id, torgovye_tochki.name as torgovye_tochki_name, torgovye_tochki.office as torgovye_tochki_office, torgovye_tochki.house as torgovye_tochki_house, torgovye_tochki.street as torgovye_tochki_street, torgovye_tochki.email as torgovye_tochki_email, torgovye_tochki.telephone as torgovye_tochki_telephone, torgovye_tochki.id as torgovye_tochki_id")->limit(100,($page_num-1)*100)->get("torgovye_tochki", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("torgovye_tochki")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"torgovye_tochki_update", "id"=>"torgovye_tochki_id", "num"=>"0", "label"=>"редактировать", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"torgovye_tochki_delete", "id"=>"torgovye_tochki_id", "num"=>"0", "label"=>"удалить", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"view_torgovaya_tochka", "id"=>"torgovye_tochki_id", "num"=>"0", "label"=>"view_torgovaya_tochka", "html"=>"", "ajax"=>"0"); 
 $torgovye_tochki = $this->prepare_actions_list($torgovye_tochki,$urls_list); 

   $this->r_v("torgovye_tochki_create_link", $this->l("torgovye_tochki_create"));

 $navigation = $this->navigation("torgovye_tochki","torgovye_tochki", $items_count, 100,$page_navigation_url_prefix, $page_navigation_url_num); 



for($z=0;$z<count($torgovye_tochki);$z++){
  $torgovye_tochki_sum_zakazov = $this->db->select_sum('summa')->where("torgovaya_tochka_id", $torgovye_tochki[$z]['torgovye_tochki_id'])->get('orders')->result();
  $torgovye_tochki[$z]['torgovye_tochki_sum_zakazov'] = number_format($torgovye_tochki_sum_zakazov[0]['summa'],2,".",",");
}

$napravlenie_db = $this->db->get("napravlenie")->result();
$this->r_v("napravlenie_db",$napravlenie_db); 
 $this->r_v("torgovye_tochki",$torgovye_tochki); 
