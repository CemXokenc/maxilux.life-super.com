<?php
 if(!defined('errors')) define('errors',false);
 define('cms_dir',dirname(__FILE__));

 include_once(dirname(__FILE__)."/../config.php");
 include_once(dirname(__FILE__)."/db-connect.php");
 include_once(dirname(__FILE__)."/_classes/session_control.class.php");
 include_once(dirname(__FILE__)."/_classes/simple_html_dom.php");
 
 $site_variables  = array();
 $get_var_trigger = array();
 
 $get_var_trigger['strip_tags_local_exceptions'] = array();
 
 /*
    enable_br, enable_strip_tags:
    0 - disabled
    1 - enabled
 */
 $get_var_trigger['enable_br'] = 1;
 $get_var_trigger['br_exceptions'] = array();

 $get_var_trigger['enable_strip_tags'] = 1;
 $get_var_trigger['strip_tags_exceptions'] = array();

 $get_var_trigger['enable_strip_slash'] = 1;
 $get_var_trigger['strip_slash_exceptions'] = array();

 class Actions{
   public $ms = '';
   function __construct(){
   	 $this->ms = new manage_sessions();
   }
   function extract($vars){
     foreach($vars as $key=>$val){
       $this->r_v($key, $val);
     }
   }
   function navigation($action_name, $name, $items_count, $count,$page_navigation_url_prefix, $page_navigation_url_num){
     $navigation = array();
     $navigation["{$name}_navigation"] = 1;
     if($items_count < $count){
       $navigation["{$name}_navigation"] = 0;
     }
                     
     $last_num = intval($items_count/$count + ($items_count%$count>0?1:0));
     if($last_num < 1) $last_num = 1;
                           
     $page_num = arg(1);
     if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num);
                                 
     $page_num = empty($page_num) ? 1 : $page_num;
     $navigation["{$name}_page_num"] = $page_num;
                                   
     $page_num_p = "";
     if($page_num > 1) $page_num_p = $page_num - 1;
                                             
     $page_num_n = $page_num + 1;
                                    
     $prev_url = $this->l("{$action_name}/{$page_navigation_url_prefix}{$page_num_p}");
     $next_url = $this->l("{$action_name}/{$page_navigation_url_prefix}{$page_num_n}"); 
     $last_url = $this->l("{$action_name}/{$page_navigation_url_prefix}{$last_num}"); 
                                                         
     $num1 = $page_num; 
     $num2 = $page_num + 1; 
     $num3 = $page_num + 2; 
     if($num1 + 2 > $last_num){
       $num1 = $last_num - 3; 
       $num2 = $last_num - 2; 
       $num3 = $last_num - 1; 
     } 
                                                                                       
     $num_1_url = $this->l("{$action_name}/{$page_navigation_url_prefix}{$num1}");
     $num_2_url = $this->l("{$action_name}/{$page_navigation_url_prefix}{$num2}");
     $num_3_url = $this->l("{$action_name}/{$page_navigation_url_prefix}{$num3}");
                                                                                                     
     $navigation["{$name}_num1"]      = $num1;
     $navigation["{$name}_num2"]      = $num2;
     $navigation["{$name}_num3"]      = $num3;
     $navigation["{$name}_last_num"]  = $last_num; 
     $navigation["{$name}_num_1_url"] = $num_1_url; 
     $navigation["{$name}_num_2_url"] = $num_2_url; 
     $navigation["{$name}_num_3_url"] = $num_3_url; 
     $navigation["{$name}_prev_url"]  = $prev_url;  
     $navigation["{$name}_next_url"]  = $next_url;  
     $navigation["{$name}_last_url"]  = $last_url;  
     
     
     
     foreach($navigation as $key=>$val){
       $this->r_v($key, $val);
     }
     
     /*$this->r_v("{$name}_num2"      , $num2);
     $this->r_v("{$name}_num3"      , $num3);
     $this->r_v("{$name}_last_num"  , $last_num); 
     $this->r_v("{$name}_num_1_url" , $num_1_url); 
     $this->r_v("{$name}_num_2_url" , $num_2_url); 
     $this->r_v("{$name}_num_3_url" , $num_3_url); 
     $this->r_v("{$name}_prev_url"  , $prev_url);  
     $this->r_v("{$name}_next_url"  , $next_url);  
     $this->r_v("{$name}_last_url"  , $last_url);*/       
         
     return;
     /*return $navigation;*/
   } 

   function checkPage($pageName, $type = 'templates'){
   	 if(!file_exists(cms_dir.'/../site/modules/'.$type.'/'.$pageName.'Template.php')) return false;

   	 return true;
   }
   function showPage($pageName){
     global $menu_path;
     global $site_variables;
     global $gl_session;
     
     if(isset($gl_session['session_data'])){
      foreach($gl_session['session_data'] as $key=>$val){
        $this->register_variable('session_var_'.$key, $val);
      }
     }

   	 if($this->checkPage($pageName)){
   	   include_once(cms_dir.'/../site/modules/templates/'.$pageName.'Template.php');
   	 }else{
   	   $this->redirect($this->generate_customize_url("page404"));
   	 }
   }
   function generate_customize_url_trigger($url){
     for($z=0;$z<count($gcu_trigger);$z++){
       $url = str_replace("/".$gcu_trigger[$z][0]."/","/".$gcu_trigger[$z][1]."/",$url);
     }
     
     return $url;
   }

   function getVariable_trigger($data){
     global $get_var_trigger;
     
     /*($get_var_trigger['strip_tags_local_exceptions'] == $data)*/
     
     $module = $_GET['module'];
     $action = $_GET['action'];

     if($get_var_trigger['enable_strip_tags'] == 1){
       $trigger_strip_tags = true;
       for($z=0;$z<count($get_var_trigger['strip_tags_exceptions']);$z++){
         if($get_var_trigger['strip_tags_exceptions'][$z] == $module."-".$action){
           $trigger_strip_tags = false;
         }
       }
       if($trigger_strip_tags) $data = strip_tags($data);
     }

     if($get_var_trigger['enable_strip_slash'] == 1){
       $trigger_strip_slash = true;
       for($z=0;$z<count($get_var_trigger['strip_slash_exceptions']);$z++){
         if($get_var_trigger['strip_slash_exceptions'][$z] == $module."-".$action){
           $trigger_strip_slash = false;
         }
       }

       if($trigger_strip_slash) $data =  stripslashes($data);
     }

     if($get_var_trigger['enable_br'] == 1){
       $trigger_br = true;
       for($z=0;$z<count($get_var_trigger['br_exceptions']);$z++){
         if($get_var_trigger['br_exceptions'][$z] == $module."-".$action){
           $trigger_br = false;
         }
       }
       if($trigger_br) $data = str_replace("\n","<br />",$data);
     }

     return $data;
   }
   function get($name){
     return $this->getVariable($name);
   }
   
   function getVariable($name){
   	 if($name == "session"){
           if(!isset($_GET['session'])){
             if(isset($_COOKIE['session'])) return $_COOKIE['session'];
           }
   	 }

   	 if(isset($_GET["{$name}"]) && $name == "id"){
       $id = $_GET['id'];
       if(isset($_GET['id_other'])) $id = $_GET['id_other'];

   	   return trim($id);
   	 }

   	 if($name == "lang"){
   	   if(isset($_POST['lang'])) return $_POST['lang'];
   	   if(isset($_GET['lang'])) return $_GET['lang'];
    	 }

   	 if(isset($_GET["{$name}"])){
   	   if(is_array($_GET["{$name}"])) return $_GET["{$name}"];

   	   $name = trim($_GET["{$name}"]);
   	   $name = $this->getVariable_trigger($name);

   	   return $name;
   	 }
   	 if(isset($_POST["{$name}"])){
   	    if(is_array($_POST["{$name}"])) return $_POST["{$name}"];

   	    $data = trim($_POST["{$name}"]);
   	    
   	    global $get_var_trigger;
   	    for($z=0;$z<count($get_var_trigger['strip_tags_local_exceptions']);$z++){
   	      if($get_var_trigger['strip_tags_local_exceptions'][$z] == $name){return stripslashes($data);}
   	    }
            
            $name = $this->getVariable_trigger($data);

   	    return $name;
   	 }
   	 return '';
   }

   function redirect($url){
   	 header("Location:".$url);
   	 system_stop();
   }
   function l($page,$id="",$title=""){
     return $this->generate_customize_url($page,$id,$title);
   }
   function generate_customize_url($page,$id="",$title=""){
      $title = str_replace('\'','',$title);
      $title = str_replace('"','',$title);
      $title = str_replace("%",'',$title);

      $session_id = $this->getVariable('session');
      if(empty($session_id)){
        $session_id = $this->ms->save_session();
      }
      setcookie ("session", $session_id);

   	 if(!empty($title)){
       if(empty($id)) $id = 0;
   	   $id = "/".$id."/".$title;
   	 }else{
   	   if($id == "0") $id = "";
   	   if(!empty($id)) $id = "/".$id;
   	 }

     $url = "";
 	 $main_url = cms_url;

     $a = new Actions();
     $lang = $this->getVariable('lang');
     if(!empty($lang)) $main_url .= "lang-".$lang."/";

     $url = $main_url.$page.$id.".html";
     $url = $this->generate_customize_url_trigger($url);
     
     return $url;
   }
   function r_v($name,$val){
     $this->register_variable($name,$val);
   }
   function register_variable($name,$val){
     global $site_variables;
     $site_variables[$name] = $val;
   }

   function IsPOST(){
   	 if(isset($_POST) && count($_POST)>0) return TRUE;
   	 else return FALSE;
   }
   
   function delete_item($table_name, $column_name = 'id'){
     $id = $this->getVariable('id');
     $this->db = new active_records();
     $this->db->where($column_name,$id)->delete($table_name);
   }

   function prepare_actions_list($data, $actions){
     //$actions_num = array();
     //for($z=0;$z<count($actions);$z++){
     //  $actions_num[$actions[$z]];
     //}
     
     //print_r($actions);
     //print_r($data);
     //exit;
     
     for($x=0;$x<count($data);$x++){ 
       $data[$x]['actions'] = "";
       for($z=0;$z<count($actions);$z++){
         $label = $actions[$z]['label'];
         if(!empty($actions[$z]['html'])) $label = $actions[$z]['html'];
         
         $sub_url = "/";
         $id_column_name = $actions[$z]['id'];
         $info = explode("/", $id_column_name);
         for($m=0;$m<count($info);$m++){
           if($sub_url != "/") $sub_url .= "/";
           
           if($actions[$z]['num'] == $m){
             $sub_url .= $data[$x][$info[$actions[$z]['num']]];
           }else{
             if(substr($info[$m],0,4) == "var_" && isset($data[$x][substr($info[$m],4)])){
               $sub_url .= $data[$x][substr($info[$m],4)];
             }else{
               $sub_url .= $info[$m];             
             }
           }          
           
         }
         if(!empty($data[$x]['actions'])) $data[$x]['actions'] .= " | ";
         $data[$x]['actions'] .= "<a href='".$this->l($actions[$z]['action'].$sub_url)."'>".$label."</a>";
         
         $data[$x]['actions_list'][$actions[$z]['action']] = $this->l($actions[$z]['action'].$sub_url);         
       }
     }
     return $data;
   }
 
   function role_by_id($data, $column_name){
     global $system_user_type;
     
     for($x=0;$x<count($data);$x++){ 
       $data[$x][$column_name] = $system_user_type[$data[$x][$column_name]];
     }
   
     return $data;
   }
   
   function enable_actions_for_owner($data, $column_name, $action_list){
     global $gl_session;
     
     for($x=0;$x<count($data);$x++){ 
       if($data[$x][$column_name] != $gl_session["session_data"]["user_id"]){
         for($z=0;$z<count($action_list);$z++){
           $data[$x]["action_list"][$action_list[$z]] = "";
         }
       }
     }
   
     return $data;
   }

   function ddb($column_name,$data){
     $this->r_v("select_".$column_name,$data);
   }
   
 }
 class Controler{
   public $content='';
   public $ms = '';
   function __construct(){
     if(isset($_GET['post_var']) && !empty($_GET['post_var'])){
       $post = unserialize(base64_decode($_GET['post_var']));
       if(is_array($post)){
         foreach($post as $k=>$v){
           $_POST[$k] = $v;
         }
       }
     }

   	 $this->ms = new manage_sessions();

   	 $a = new Actions();
   	 $session_id = $a->getVariable('session');
   	 $result = $this->ms->load_session($session_id);

   	 $lang = $this->ms->userdata("lang");
     if($lang === false) $this->ms->set_userdata(array('lang'=>lang));

     $lang = $a->getVariable("lang");
     if(!empty($lang)) $this->ms->set_userdata(array('lang'=>$lang));

   	 if(empty($session_id) || $result === false){
   	   $action = $a->getVariable('action');
   	   $id     = $a->getVariable('id');
   	   $last_part = $a->getVariable('last_part');

   	   setcookie ("session", "", time() - 3600);

       $post_var = "";
       if(count($_POST)>0){
         $post_var = "&post_var=".base64_encode(serialize($_POST));
       }
        $q_string = "";
        if($_SERVER['QUERY_STRING'] != ""){
          $q_string = "?".$_SERVER['QUERY_STRING'];
        }

  	   $url = $a->generate_customize_url($action!==''?$action:default_action,$id===0?'':$id,$last_part).$post_var.$q_string;
   	   $a->redirect($url);
   	 }
   }

   function ExecuteAction(){
   	 $this->content = '';
	 if(file_exists(cms_dir.'/../site/modules/action/index.php')){
 	     include_once(cms_dir.'/../site/modules/action/index.php');
 	     $class_name = 'pagesAction';
 	     if(class_exists($class_name)){
           $m = new $class_name();
           $method_name = $_GET['action'].'Action';
           if(method_exists($m,$method_name)){
             ob_start();
           	 $m->$method_name();
           	 $this->content = ob_get_contents();
             ob_end_clean();
           }else{
           	 if($_GET['action'] != "page404"){
           	   $a = new Actions();
               $a->redirect($a->generate_customize_url("page404"));
             }else{
               echo "<h1 style='color:red;'>( Page not found )</h1>";exit;
             }
           }
         }
     }else{
       echo "<h1 style='color:red;'>( System Error )</h1>";exit;
     }

     update_session();
   }
 }
 
                               
 function update_session(){
   $ms = new manage_sessions();
   $a = new Actions();
   $session_id = $a->getVariable('session');
   $ms->session_update($session_id);
 }
 function system_stop(){
   update_session();
   exit;
 }
 
 function arg($num){
   global $gl_link;
   $data = explode("/", $gl_link);
   
   if(isset($data[$num])) return $data[$num];
   
   return '';
 }
 
 function get_messages($action){
   global $gl_session;
   
   if(isset($gl_session['session_data']['system_messages'][$action])){
     $data = $gl_session['session_data']['system_messages'][$action]; 
     unset($gl_session['session_data']['system_messages'][$action]);
     return $data;
   }
 }
?>