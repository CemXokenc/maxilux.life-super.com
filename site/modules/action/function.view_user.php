<?php

 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 

 $css_link = $this->l("css"); 
 $this->r_v("css_link", $css_link); 
 include(__DIR__."/../blocks/left_menu_mainAction.php"); 
 $block_attr_type="view_user";
 include(__DIR__."/../blocks/activityAction.php"); 

 $this->db = new active_records();

if($gl_session["session_data"]['client_view']!=1){
   $this->redirect($this->l("login"));   
}
$user_id = arg(1);
$user_info = $this->db->where("id",$user_id)->get("users")->result();
$this->r_v("user_info",$user_info[0]);

$back_url = $this->l("users");
$this->r_v("back_url", $back_url);

 return $this->showPage('view_user');
?>