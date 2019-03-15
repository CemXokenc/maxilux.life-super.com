<?php

 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 

 $css_link = $this->l("css"); 
 $this->r_v("css_link", $css_link); 
 include(__DIR__."/../blocks/left_menu_mainAction.php"); 
 include(__DIR__."/../blocks/move_productAction.php");  

if($gl_session["session_data"]['sklads_peremestit_tovar']!=1){
   $this->redirect($this->l("login"));   
}

 return $this->showPage('move_product');
?>