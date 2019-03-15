<?php

 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 

print_r($gl_session["session_data"]);
exit();

 return $this->showPage('sessiom');
?>