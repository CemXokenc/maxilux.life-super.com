<?php

error_reporting(E_ERROR);

 session_start();
 include_once(dirname(__FILE__)."/kernel/cms.php");
 include_once(dirname(__FILE__)."/site/route.php");
 include_once(dirname(__FILE__)."/site/class/system_classes.php");
 include_once(dirname(__FILE__)."/mailer/mailer_PHPMailerAutoload.php");

 $gl_link = $_GET['action'];  
 if($gl_link == ""){
  $gl_link = $_GET['action'] = "login";
 }
 
 $a = new Actions();
 $c = new Controler();
 $a->register_variable("template_dir", cms_url."/site/templates/");  
 define("template_dir", cms_url."/site/templates/");

 $_GET['action'] = arg(0);
 $_GET['id']     = arg(1);
 
 $messages = get_messages($_GET['action']);
 $a->register_variable("system_messages",$messages);
 
 $c->ExecuteAction();
 $a->register_variable("site_smarty_content",$c->content);

 include_once(dirname(__FILE__)."/site/templates/".$template[$_GET['action']].".php");
?>