<?php 

 define("cms_url","http://maxilux.life-super.com/");

 /* Database Settings */
 define("db_host","localhost");
 define("db_name","maxilux_site");
 define("db_user","maxilux_site");
 define("db_pass","maxilux2014");

 define("default_action","login");

 $system_user_type = array();
 $system_user_type["5"] = "admin";
 $system_user_type["6"] = "worker";
 $system_user_type["12"] = "manager";

 $system_user_type_by_name = array();
 $system_user_type_by_name["admin"] = "5";
 $system_user_type_by_name["worker"] = "6";
 $system_user_type_by_name["manager"] = "12";

 function get_alternative_db_list(){
   return array();
 }
?>