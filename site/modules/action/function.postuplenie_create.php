<?php

 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 

 $css_link = $this->l("css"); 
 $this->r_v("css_link", $css_link); 
 include(__DIR__."/../blocks/left_menu_mainAction.php"); 
 $block_attr_table="create";
 include(__DIR__."/../blocks/postuplenie_updateAction.php");  

if($gl_session["session_data"]['postuplenie_create']!=1){
   $this->redirect($this->l("login"));   
}

 return $this->showPage('postuplenie_create');
?>