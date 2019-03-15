<?php

 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 

 $css_link = $this->l("css"); 
 $this->r_v("css_link", $css_link); 
 include(__DIR__."/../blocks/left_menu_mainAction.php"); 
 $block_attr_type="view_postavshik";
 include(__DIR__."/../blocks/zayavki_listAction.php"); 

 $this->db = new active_records();

if($gl_session["session_data"]['view_postavshik']!=1){
   $this->redirect($this->l("login"));   
}
$postavshik_id = arg(1);
$postavshik_info = $this->db->where("id",$postavshik_id)->get("postavshiki")->result();
$this->r_v("postavshik_info",$postavshik_info[0]);
$cnt_orders = $this->db->where("postavshik_id",$postavshik_id)->count_all_results('zayavki');
$this->r_v("cnt_orders",$cnt_orders);

 return $this->showPage('view_postavshik');
?>