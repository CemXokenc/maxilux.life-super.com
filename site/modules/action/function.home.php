<?php

 /* check is user already login if no redirect to the home page */
 $this->login_redirect();

 /* check is user allowed to open this page if user is not at the allowed list redirect to home page */
 $rights = $this->check_rights("home");

 if(!$rights) $this->redirect($this->l(default_action));
 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 

 $css_link = $this->l("css"); 
 $this->r_v("css_link", $css_link); 


 return $this->showPage('home');
?>