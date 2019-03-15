<?php

 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 

 $css_link = $this->l("css"); 
 $this->r_v("css_link", $css_link); 
 include(__DIR__."/../blocks/left_menu_mainAction.php"); 
 $block_attr_zakaz_list="view_client";
 include(__DIR__."/../blocks/zakaz_listAction.php"); 

 $this->db = new active_records();

if($gl_session["session_data"]['client_view']!=1){
   $this->redirect($this->l("login"));   
}
$client_id = arg(1);
$client_info = $this->db->where("id",$client_id)->get("clients")->result();
$this->r_v("client_info",$client_info[0]);
$skidka_info = $this->db->where("id",$client_info[0]['skidka_id'])->get("skidki")->result();
$this->r_v("skidka_info",$skidka_info[0]);
$this->r_v("skidka",count($skidka_info));
$cnt_orders = $this->db->where("client_id",$client_id)->count_all_results('orders');
$this->r_v("cnt_orders",$cnt_orders);

$clients_sum_zakazov = $this->db->select_sum('summa')->where("client_id", $client_id)->get('orders')->result();
$amount_orders = number_format($clients_sum_zakazov[0]['summa'],2,".",",");
$this->r_v("amount_orders",$amount_orders);

$back_url = $this->l("clients");
$this->r_v("back_url", $back_url);

 return $this->showPage('view_client');
?>