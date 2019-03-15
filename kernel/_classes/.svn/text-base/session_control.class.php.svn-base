<?php
 if(!defined('app_key')) define('app_key','abook');
 
 $gl_session = array();
 class manage_sessions{
   public $url_session = 0;
   function userdata($var_name){
     global $gl_session;
     if(isset($gl_session['session_data'][$var_name]))
       return $gl_session['session_data'][$var_name];
     
     return false;
   }
   
   function set_userdata($data = array()){
     global $gl_session;
     foreach($data as $key=>$val){
       $gl_session['session_data'][$key] = $val;
     }
   }
   
   function sess_destroy(){
     global $gl_session;
     foreach($gl_session['session_data'] as $key=>$val){
       unset($gl_session['session_data'][$key]);
     }
     
     unset($_SESSION[app_key]['data']);
   }
   
   function save_session(){
     global $gl_session;
     $id = "";
     if(isset($gl_session['session_data'])){
       $id = base64_encode(serialize($gl_session['session_data']));
     }

     if(!isset($gl_session['session_data']['system_key']) 
       || empty($gl_session['session_data']['system_key'])){
       $gl_session['session_data']['system_key'] = rand();
     }
     
     $_SESSION[app_key]['data'] = base64_encode(serialize($gl_session['session_data']));
     
     return rand(); 
   }
   
   function load_session($id){
     $info = array();
     if(isset($_SESSION[app_key]['data'])){
       $info = unserialize(base64_decode($_SESSION[app_key]['data']));
     }
     
     $this->set_userdata($info);
   }

   public function session_update($session_id){
     global $gl_session;
     $session_data = "";
     if(isset($gl_session['session_data'])){
       $session_data = base64_encode(serialize($gl_session['session_data']));
     }

     $_SESSION[app_key]['data'] = $session_data;

     return true;
   }

 }
?>