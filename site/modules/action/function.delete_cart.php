<?php

 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 

 $css_link = $this->l("css"); 
 $this->r_v("css_link", $css_link); 
$tovar_id = arg(1);

unset($gl_session["session_data"]['cart'][$tovar_id]);
if(count($gl_session["session_data"]['cart'])<1) unset($gl_session["session_data"]['cart']);

$this->redirect($this->l("cart"));

 return $this->showPage('delete_cart');
?>