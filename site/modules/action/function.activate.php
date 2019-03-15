<?php

 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 

 $css_link = $this->l("css"); 
 $this->r_v("css_link", $css_link); 
 $this->db = new active_records();

$user_id = arg(1);
$user_id = mysql_escape_string($user_id);

$info = $this->db->where("md5(id)","'{$user_id}'",1)->get("users")->result();
if($info[0]['activated'] == 0){
  $this->db->where("md5(id)","'{$user_id}'",1)->set("activated",1)->update("users");
  $this->db->redirect($this->l("login/activated"));
  exit;
}
$this->db->redirect($this->l("home"));
exit;

 return $this->showPage('activate');
?>