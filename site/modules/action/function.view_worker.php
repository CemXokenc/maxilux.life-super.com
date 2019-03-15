<?php

 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 

 $css_link = $this->l("css"); 
 $this->r_v("css_link", $css_link); 
 include(__DIR__."/../blocks/left_menu_mainAction.php"); 
 $block_attr_type="view_worker";
 include(__DIR__."/../blocks/activity_workersAction.php"); 

 $this->db = new active_records();

if($gl_session["session_data"]['workers_view']!=1){
   $this->redirect($this->l("login"));   
}
$worker_id = arg(1);
$worker_info = $this->db->where("id",$worker_id)->get("workers")->result();
$this->r_v("worker_info",$worker_info[0]);
$profession = $this->db->where("id",$worker_info[0]['profession_id'])->get("professions")->result();
$this->r_v("profession",$profession[0]['name']);

 return $this->showPage('view_worker');
?>