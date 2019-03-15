<?php

 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 

 $css_link = $this->l("css"); 
 $this->r_v("css_link", $css_link); 
$cars = array( 
"company" => array("bmw","opel"),
"model" => array("x5","corsa"),
"speed" => array(120,140),
"doors" => array(5,5),
"year" => array(2006,2007),
);


$cars[] = array( 
"company" => "ferrari",
"model" => "ferrari",
"speed" => 210,
"doors" => 2,
"year" => 2013,
);

print_r($cars);
exit();

 return $this->showPage('test');
?>