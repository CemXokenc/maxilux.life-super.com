<?php

 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 

 $css_link = $this->l("css"); 
 $this->r_v("css_link", $css_link); 
 include(__DIR__."/../blocks/left_menu_mainAction.php"); 
 $block_attr_table="create";
 include(__DIR__."/../blocks/product_viewAction.php"); 

$back_url = $this->l("products_list");
$this->r_v("back_url", $back_url);

 return $this->showPage('product_view');
?>