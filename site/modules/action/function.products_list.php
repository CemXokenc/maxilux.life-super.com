<?php

 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 

 $css_link = $this->l("css"); 
 $this->r_v("css_link", $css_link); 
 include(__DIR__."/../blocks/left_menu_mainAction.php"); 
 include(__DIR__."/../blocks/products_listAction.php");  


/*
if($gl_session["session_data"]['products_list']!=1){
   $this->redirect($this->l("login"));   
}

if($gl_session["session_data"]['zakaz_create']!=1 && $gl_session["session_data"]['zayavka_create']!=1){
   $this->redirect($this->l("login"));   
}
*/
/*
if($gl_session["session_data"]['zakaz_list']!=1 && $gl_session["session_data"]['zayavki_list'] != 1){
  $this->redirect($this->l("login"));
  exit;
}
*/

 return $this->showPage('products_list');
?>