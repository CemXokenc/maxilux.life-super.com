<?php

 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 

 $css_link = $this->l("css"); 
 $this->r_v("css_link", $css_link); 
 $block_attr_redirect="torgovye_tochki";
 $block_attr_page="torgovye_tochki";
 $block_attr_table="torgovye_tochki";
 include(__DIR__."/../blocks/delete_itemsAction.php");  

if($gl_session["session_data"]['torgovaya_delete']!=1){
   $this->redirect($this->l("login"));   
}

 return $this->showPage('torgovye_tochki_delete');
?>