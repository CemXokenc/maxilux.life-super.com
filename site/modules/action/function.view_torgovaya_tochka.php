<?php

 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 

 $css_link = $this->l("css"); 
 $this->r_v("css_link", $css_link); 
 include(__DIR__."/../blocks/left_menu_mainAction.php"); 
 $block_attr_zakaz_list="view_torgovaya_tochka";
 include(__DIR__."/../blocks/zakaz_listAction.php"); 

 $this->db = new active_records();


if($gl_session["session_data"]['torgovaya_view']!=1){
   $this->redirect($this->l("login"));   
}
$torgovaya_tochka_id = arg(1);
$torgovaya_tochka_info = $this->db->where("id",$torgovaya_tochka_id)->get("torgovye_tochki")->result();
$this->r_v("torgovaya_tochka_info",$torgovaya_tochka_info[0]);

$skidka_info = $this->db->where("id",$torgovaya_tochka_info[0]['skidka_id'])->get("skidki")->result();
$this->r_v("skidka_info",$skidka_info[0]);
$this->r_v("skidka",count($skidka_info));

$napravlenie = $this->db->where("id",$torgovaya_tochka_info[0]['napravlenie_id'])->get("napravlenie")->result();
$this->r_v("napravlenie",$napravlenie[0]['napravlenie']);
$cnt_orders = $this->db->where("torgovaya_tochka_id",$torgovaya_tochka_id)->count_all_results('orders');
$this->r_v("cnt_orders",$cnt_orders);

$torgovaya_tochka_sum_zakazov = $this->db->select_sum('summa')->where("torgovaya_tochka_id",$torgovaya_tochka_id)->get('orders')->result();
$amount_orders = number_format($torgovaya_tochka_sum_zakazov[0]['summa'],2,".",",");
$this->r_v("amount_orders",$amount_orders);

$back_url = $this->l("torgovye_tochki");
$this->r_v("back_url", $back_url);

 return $this->showPage('view_torgovaya_tochka');
?>