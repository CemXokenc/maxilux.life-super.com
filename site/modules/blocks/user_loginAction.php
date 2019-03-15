<?php
  $this->db = new active_records();
//указываем куда переходить после входа в зависимости от типа пользователя
global $system_user_type_by_name;
$redirect = array(
  $system_user_type_by_name['admin'] => 'users',
  $system_user_type_by_name['manager'] => 'users',
  $system_user_type_by_name['worker'] => 'users',
);

$min_pass_len = 5;
$this->r_v("min_pass_len",$min_pass_len);

if($this->isPost()){
  $page_action  = $this->getVariable('do');
  if($page_action == 'login'){
    $name = $this->getVariable('user');
    $pass = $this->getVariable('pass');

    $res = $this->db->where('name',$name)->where('pass',md5($pass))->get('users')->result();
    $type_group = $this->db->where('id',$res[0]['type_group'])->get("users_group")->result();
    if(count($res)>0){
     
      $gl_session["session_data"]['torgovaya_tockka'] = $res[0]['office_id'];

      $gl_session["session_data"]['user_id'] = $res[0]['id'];
      $gl_session["session_data"]['user_name'] = $res[0]['name'];
      $gl_session["session_data"]['first_name'] = $res[0]['first_name'];
      $gl_session["session_data"]['last_name'] = $res[0]['last_name'];
      $gl_session["session_data"]['user_type'] = intval($res[0]['user_type']);
      $gl_session["session_data"]['company_id'] = $res[0]['company_id'];
      $gl_session["session_data"]['type_cart'] = 1;
      $gl_session["session_data"]['type_group'] = $res[0]['type_group'];

      $gl_session["session_data"]['zak_price'] = $type_group[0]['zak_price'];
      $gl_session["session_data"]['users_create'] = $type_group[0]['users_create'];
      $gl_session["session_data"]['users_update'] = $type_group[0]['users_update'];
      $gl_session["session_data"]['users_delete'] = $type_group[0]['users_delete'];
      $gl_session["session_data"]['users_list'] = $type_group[0]['users_list'];

      $gl_session["session_data"]['torgovaya_list'] = $type_group[0]['torgovaya_list'];
      $gl_session["session_data"]['torgovaya_create'] = $type_group[0]['torgovaya_create'];
      $gl_session["session_data"]['torgovaya_update'] = $type_group[0]['torgovaya_update'];
      $gl_session["session_data"]['torgovaya_delete'] = $type_group[0]['torgovaya_delete'];

      $gl_session["session_data"]['clients_list'] = $type_group[0]['clients_list'];
      $gl_session["session_data"]['clients_create'] = $type_group[0]['clients_create'];
      $gl_session["session_data"]['clients_update'] = $type_group[0]['clients_update'];
      $gl_session["session_data"]['clients_delete'] = $type_group[0]['clients_delete'];

      $gl_session["session_data"]['categories_list'] = $type_group[0]['categories_list'];
      $gl_session["session_data"]['categories_create'] = $type_group[0]['categories_create'];
      $gl_session["session_data"]['categories_update'] = $type_group[0]['categories_update'];
      $gl_session["session_data"]['categories_delete'] = $type_group[0]['categories_delete'];

      $gl_session["session_data"]['userstypes_list'] = $type_group[0]['userstypes_list'];
      $gl_session["session_data"]['userstypes_create'] = $type_group[0]['userstypes_create'];
      $gl_session["session_data"]['userstypes_update'] = $type_group[0]['userstypes_update'];
      $gl_session["session_data"]['userstypes_delete'] = $type_group[0]['userstypes_delete'];

      $gl_session["session_data"]['postavshiki_list'] = $type_group[0]['postavshiki_list'];
      $gl_session["session_data"]['postavshiki_create'] = $type_group[0]['postavshiki_create'];
      $gl_session["session_data"]['postavshiki_update'] = $type_group[0]['postavshiki_update'];
      $gl_session["session_data"]['postavshiki_delete'] = $type_group[0]['postavshiki_delete'];

      $gl_session["session_data"]['products_list'] = $type_group[0]['products_list'];
      $gl_session["session_data"]['products_create'] = $type_group[0]['products_create'];
      $gl_session["session_data"]['products_update'] = $type_group[0]['products_update'];
      $gl_session["session_data"]['products_delete'] = $type_group[0]['products_delete'];

      $gl_session["session_data"]['postuplenie_list'] = $type_group[0]['postuplenie_list'];
      $gl_session["session_data"]['postuplenie_create'] = $type_group[0]['postuplenie_create'];
      $gl_session["session_data"]['postuplenie_update'] = $type_group[0]['postuplenie_update'];
      $gl_session["session_data"]['postuplenie_delete'] = $type_group[0]['postuplenie_delete'];

      $gl_session["session_data"]['napravlenie_list'] = $type_group[0]['napravlenie_list'];
      $gl_session["session_data"]['napravlenie_create'] = $type_group[0]['napravlenie_create'];
      $gl_session["session_data"]['napravlenie_update'] = $type_group[0]['napravlenie_update'];
      $gl_session["session_data"]['napravlenie_delete'] = $type_group[0]['napravlenie_delete'];

      $gl_session["session_data"]['sklads_list'] = $type_group[0]['sklads_list'];
      $gl_session["session_data"]['sklads_create'] = $type_group[0]['sklads_create'];
      $gl_session["session_data"]['sklads_update'] = $type_group[0]['sklads_update'];
      $gl_session["session_data"]['sklads_delete'] = $type_group[0]['sklads_delete'];

      $gl_session["session_data"]['kurc_valut_list'] = $type_group[0]['kurc_valut_list'];
      $gl_session["session_data"]['kurc_valut_create'] = $type_group[0]['kurc_valut_create'];

  $gl_session["session_data"]['skidki_view'] = $type_group[0]['skidki_view'];
      $gl_session["session_data"]['skidki_update'] = $type_group[0]['skidki_update'];
      $gl_session["session_data"]['zakaz_list'] = $type_group[0]['zakaz_list'];
      $gl_session["session_data"]['zakaz_view'] = $type_group[0]['zakaz_view'];
     $gl_session["session_data"]['client_view'] = $type_group[0]['client_view'];
      $gl_session["session_data"]['zayavka_create'] = $type_group[0]['zayavka_create'];
      $gl_session["session_data"]['category_upload_csv'] = $type_group[0]['category_upload_csv'];
      $gl_session["session_data"]['spravochnik_valut_delete'] = $type_group[0]['spravochnik_valut_delete'];
     $gl_session["session_data"]['workers_list'] = $type_group[0]['workers_list'];
      $gl_session["session_data"]['workers_create'] = $type_group[0]['workers_create'];
      $gl_session["session_data"]['workers_update'] = $type_group[0]['workers_update'];
      $gl_session["session_data"]['view_postavshik'] = $type_group[0]['view_postavshik'];
      $gl_session["session_data"]['sklads_copy'] = $type_group[0]['sklads_copy'];
      $gl_session["session_data"]['sklads_add_many_tovars'] = $type_group[0]['sklads_add_many_tovars'];
      $gl_session["session_data"]['sklads_peremestit_tovar'] = $type_group[0]['sklads_peremestit_tovar'];
      $gl_session["session_data"]['sklads_add_izdelie'] = $type_group[0]['sklads_add_izdelie'];
      $gl_session["session_data"]['postuplenie_view'] = $type_group[0]['postuplenie_view'];
      $gl_session["session_data"]['spravochnik_valut_list'] = $type_group[0]['spravochnik_valut_list'];
      $gl_session["session_data"]['spravochnik_valut_create'] = $type_group[0]['spravochnik_valut_create'];
      $gl_session["session_data"]['spravochnik_valut_update'] = $type_group[0]['spravochnik_valut_update'];
      $gl_session["session_data"]['workers_delete'] = $type_group[0]['workers_delete'];
      $gl_session["session_data"]['workers_view'] = $type_group[0]['workers_view'];
      $gl_session["session_data"]['scheta_list'] = $type_group[0]['scheta_list'];
      $gl_session["session_data"]['scheta_create'] = $type_group[0]['scheta_create'];
      $gl_session["session_data"]['scheta_update'] = $type_group[0]['scheta_update'];
      $gl_session["session_data"]['scheta_delete'] = $type_group[0]['scheta_delete'];
      $gl_session["session_data"]['dohody_list'] = $type_group[0]['dohody_list'];
      $gl_session["session_data"]['dohody_create'] = $type_group[0]['dohody_create'];
      $gl_session["session_data"]['dohody_update'] = $type_group[0]['dohody_update'];
      $gl_session["session_data"]['dohody_delete'] = $type_group[0]['dohody_delete'];
      $gl_session["session_data"]['rashody_list'] = $type_group[0]['rashody_list'];
      $gl_session["session_data"]['rashody_create'] = $type_group[0]['rashody_create'];
      $gl_session["session_data"]['rashody_update'] = $type_group[0]['rashody_update'];
      $gl_session["session_data"]['rashody_delete'] = $type_group[0]['rashody_delete'];
      $gl_session["session_data"]['professions_list'] = $type_group[0]['professions_list'];
      $gl_session["session_data"]['professions_create'] = $type_group[0]['professions_create'];
      $gl_session["session_data"]['professions_update'] = $type_group[0]['professions_update'];
      $gl_session["session_data"]['professions_delete'] = $type_group[0]['professions_delete'];
      $gl_session["session_data"]['orders_statuses_list'] = $type_group[0]['orders_statuses_list'];
      $gl_session["session_data"]['orders_statuses_create'] = $type_group[0]['orders_statuses_create'];
      $gl_session["session_data"]['orders_statuses_update'] = $type_group[0]['orders_statuses_update'];
      $gl_session["session_data"]['orders_statuses_delete'] = $type_group[0]['orders_statuses_delete'];
      $gl_session["session_data"]['spisanie_view'] = $type_group[0]['spisanie_view'];
      $gl_session["session_data"]['zakazy_products_list'] = $type_group[0]['zakazy_products_list'];
      $gl_session["session_data"]['zayavki_list'] = $type_group[0]['zayavki_list'];
      $gl_session["session_data"]['zayavki_view'] = $type_group[0]['zayavki_view'];
      $gl_session["session_data"]['activity_list'] = $type_group[0]['activity_list'];
      $gl_session["session_data"]['activity_workers_list'] = $type_group[0]['activity_workers_list'];
      $gl_session["session_data"]['user_view'] = $type_group[0]['user_view'];
      $gl_session["session_data"]['torgovaya_view'] = $type_group[0]['torgovaya_view'];
      $gl_session["session_data"]['zakaz_create'] = $type_group[0]['zakaz_create'];
      $gl_session["session_data"]['zakaz_update'] = $type_group[0]['zakaz_update'];
      $gl_session["session_data"]['kurc_valut_list'] = $type_group[0]['kurc_valut_list'];

      $gl_session["session_data"]['vozvrat_list']   = $type_group[0]['vozvrat_list'];
      $gl_session["session_data"]['vozvrat_create'] = $type_group[0]['vozvrat_create'];
      $gl_session["session_data"]['vozvrat_update'] = $type_group[0]['vozvrat_update'];


      //записываем когда он зашел
      $this->db->where('name',$name)->where('pass',md5($pass))->update('users',array('last_login'=>date("Y-m-d H:i:s")));

/*$redirect[$gl_session["session_data"]['user_type']]*/
      $this->redirect($this->l("products_list"));
    }else{
      $this->register_variable("login_error","error");
    }
  }
} 
