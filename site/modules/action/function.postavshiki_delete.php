<?php

 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 

 $css_link = $this->l("css"); 
 $this->r_v("css_link", $css_link); 
 $block_attr_redirect="postavshiki";
 $block_attr_page="postavshiki";
 $block_attr_table="postavshiki";
 include(__DIR__."/../blocks/delete_itemsAction.php"); 

if($gl_session["session_data"]['postavshiki_delete']!=1){
   $this->redirect($this->l("login"));   
}

 return $this->showPage('postavshiki_delete');
?>