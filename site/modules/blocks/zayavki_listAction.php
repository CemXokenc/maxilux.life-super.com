<?php
  $this->db = new active_records();
   
if($block_attr_type == "view_postavshik"){
  $page_navigation_url_num = 2;
  $page_navigation_url_prefix = arg(1)."/";
}
$this->db->where("zayavki.company_id",$gl_session["session_data"]['company_id']);
$this->db->where("zayavki.manager_id","users.id",1);
$this->db->where("zayavki.postavshik_id","postavshiki.id",1);
$this->db->where("zayavki.delete_status",0);

$data_c = $this->get("data_c");
$data_do= $this->get("data_do");
$postavshik = $this->get("postavshik");
$status = $this->get("status");
$valyta = $this->get("valuty");
if($this->isPost()){
  $gl_session["session_data"]['zayavki_data_c']=$data_c;
  $gl_session["session_data"]['zayavki_data_do']=$data_do;
  $gl_session["session_data"]['zayavki_postavshik']=$postavshik;
  $gl_session["session_data"]['zayavki_status']=$status;
  $gl_session["session_data"]['zayavki_valyta']=$valyta ;
}

if($block_attr_type == "view_postavshik"){
  $postavshik = arg(1);
  $this->db->where("zayavki.postavshik_id", $postavshik);
  $this->r_v("view_postavshik",1);
}

$this->db->order_by("zayavki.id","desc");
if($gl_session["session_data"]['zayavki_data_c']!= ""){
  $this->db->where("zayavki.created >=", $data_c);
}

if($gl_session["session_data"]['zayavki_data_do']!= ""){
  $this->db->where("zayavki.created <=", $data_do);
}

if($gl_session["session_data"]['zayavki_status']!= ""){
  $this->db->where("zayavki.status", $status);
}

if($gl_session["session_data"]['zayavki_postavshik']!= "" && $block_attr_type != "view_postavshik"){
  $this->db->where("zayavki.postavshik_id", $postavshik);
}




 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $zayavki_list = $this->db->select("zayavki.delete_status as zayavki_delete_status, zayavki.created as zayavki_created, zayavki.company_id as zayavki_company_id, zayavki.status as zayavki_status, zayavki.valuta as zayavki_valuta, zayavki.summa_zakupki as zayavki_summa_zakupki, zayavki.manager_id as zayavki_manager_id, zayavki.postavshik_id as zayavki_postavshik_id, zayavki.nomer as zayavki_nomer, users.last_name as users_last_name, postavshiki.id as postavshiki_id, postavshiki.name as postavshiki_name, zayavki.id as zayavki_id, users.first_name as users_first_name, users.id as users_id")->limit(100,($page_num-1)*100)->get("zayavki, users, postavshiki", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("zayavki, users, postavshiki")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"zayavka_view", "id"=>"zayavki_id", "num"=>"0", "label"=>"zayavka_view", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"zayavka_update", "id"=>"zayavki_id", "num"=>"0", "label"=>"zayavka_view", "html"=>"", "ajax"=>"0"); 
 $zayavki_list = $this->prepare_actions_list($zayavki_list,$urls_list); 

 $navigation = $this->navigation("zayavki_list","zayavki_list", $items_count, 100,$page_navigation_url_prefix, $page_navigation_url_num); 



for($i=0;$i<count($zayavki_list);$i++){
    $info = "";
 $zayavki_list[$i]['zayavki_created'] = date('d.m.Y H:i',strtotime($zayavki_list[$i]['zayavki_created']));  
  
  if($gl_session["session_data"]['zayavki_valyta']==""){
  $info = calc_price($zayavki_list[$i]['zayavki_summa_zakupki'], $zayavki_list[$i]['zayavki_valuta'],$zayavki_list[$i]['zayavki_valuta']);
  }else{
     $info = calc_price($zayavki_list[$i]['zayavki_summa_zakupki'], $zayavki_list[$i]['zayavki_valuta'],$gl_session["session_data"]['zayavki_valyta']);
    /*print_r($zayavki_list[$i]['zayavki_summa_zakupki']);
    echo "залупа1";
    print_r($zayavki_list[$i]['zayavki_valuta']);
   echo "залупа2";
    print_r($gl_session["session_data"]['zayavki_valyta']);
     exit();*/
  }
  
  $zayavki_list[$i]['zayavki_summa_zakupki'] = $info['view'];
 
    if($zayavki_list[$i]['zayavki_status']==1){
       $zayavki_list[$i]['zayavki_status']= "Новая заявка";
    }

    if($zayavki_list[$i]['zayavki_status']==2){
       $zayavki_list[$i]['zayavki_status']= "Товар получен";
    }
}

  $postavshiki= $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("postavshiki")->result();
$this->r_v("postavshiki",$postavshiki);

$valuty = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("currencies")->result();
$this->r_v("valuty",$valuty); 
 $this->r_v("zayavki_list",$zayavki_list); 
