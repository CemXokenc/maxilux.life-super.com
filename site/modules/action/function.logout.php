<?php

 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 

 $css_link = $this->l("css"); 
 $this->r_v("css_link", $css_link); 
unset($gl_session["session_data"]['user_id']);
unset( $gl_session["session_data"]['user_name']);
unset($gl_session["session_data"]['first_name']);
unset($gl_session["session_data"]['last_name']);
unset($gl_session["session_data"]['user_type']);
unset($gl_session["session_data"]['company_id']);
unset($gl_session["session_data"]['torgovaya_tockka']);
unset($gl_session["session_data"]['users_create']);
unset($gl_session["session_data"]['users_update']);
unset( $gl_session["session_data"]['users_delete']);
unset($gl_session["session_data"]['users_list']);

unset($gl_session["session_data"]['torgovaya_list']);
unset($gl_session["session_data"]['torgovaya_create']);
unset($gl_session["session_data"]['torgovaya_update']);
unset($gl_session["session_data"]['torgovaya_delete']);

unset($gl_session["session_data"]['clients_list']);
unset($gl_session["session_data"]['clients_create']);
unset($gl_session["session_data"]['clients_update']);
unset($gl_session["session_data"]['clients_delete']);

unset($gl_session["session_data"]['categories_list']);
unset($gl_session["session_data"]['categories_create']);
unset($gl_session["session_data"]['categories_update']);
unset($gl_session["session_data"]['categories_delete']);
   
unset($gl_session["session_data"]['userstypes_list']);
unset($gl_session["session_data"]['userstypes_create']);
unset($gl_session["session_data"]['userstypes_update']);
unset($gl_session["session_data"]['userstypes_delete']);

unset($gl_session["session_data"]['postavshiki_list']);
unset($gl_session["session_data"]['postavshiki_create']);
unset($gl_session["session_data"]['postavshiki_update']);
unset($gl_session["session_data"]['postavshiki_delete']);

unset($gl_session["session_data"]['postuplenie_list']);
unset($gl_session["session_data"]['postuplenie_create']);
unset($gl_session["session_data"]['postuplenie_update']);
unset($gl_session["session_data"]['postuplenie_delete']);

unset($gl_session["session_data"]['napravlenie_list']);
unset($gl_session["session_data"]['napravlenie_create']);
unset($gl_session["session_data"]['napravlenie_update']);
unset($gl_session["session_data"]['napravlenie_delete']);

unset($gl_session["session_data"]['sklads_list']);
unset($gl_session["session_data"]['sklads_create']);
unset($gl_session["session_data"]['skladse_update']);
unset($gl_session["session_data"]['sklads_delete']);

unset($gl_session["session_data"]['kurc_valut_list']);
unset($gl_session["session_data"]['kurc_valut_create']);

$this->redirect($this->l("login"));

 return $this->showPage('logout');
?>