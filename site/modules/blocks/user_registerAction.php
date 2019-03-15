<?php
  $this->db = new active_records();

/* settings */
global $system_user_type_by_name;
define("register_user_table",'users');
define("register_user_name_column",'name');
$min_pass_len = 5; /* min count of chars in the password */
$this->register_variable("min_pass_len",$min_pass_len); 

if($this->isPost()){
  $page_action  = $this->getVariable('do');
  if($page_action == 'register'){ 
    /* get form fields data*/                       
    $email        = $this->getVariable('email');
    $pass         = $this->getVariable('pass');
    $pass_repeat  = $this->getVariable('pass_repeat');            
    $first_name   = $this->getVariable('first_name');
    $last_name    = $this->getVariable('last_name');
    $company    = $this->getVariable('company');
    $company_id = $this->db->set("name",$company)->insert("companies")->result();
     
     for($i=0;$i<10;$i++){
       $this->db->set("company_id",$company_id)->insert("skidki");
     }
    //save filled fields
    $this->register_variable("email",$email); 
    $this->register_variable("first_name",$first_name); 
    $this->register_variable("last_name",$last_name); 
            
    $error = array();           
    /* checking is this user is already registered */
    if($this->db->where(register_user_name_column, $email)->count_all_results(register_user_table) > 0){
      $error[] = 'Данный почтовый ящик <strong>'.$email.'</strong> зарегистрирован в системе.';                
    }
                        
    /* validation email address */
    $regex = '/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/'; 
    if (!preg_match($regex, $email) ){
      $error[] = 'Неверный почтовый ящик.';
    }
    
    /* checking passwords*/        
    if($pass != $pass_repeat){
      $error[] = 'Пароль и подтверждение пароля не совпадают.';
    }
            
    if(mb_strlen($pass) < $min_pass_len || mb_strlen($pass_repeat) < $min_pass_len){
      $error[] = 'Короткий пароль. Минимальня длина пароля '.$min_pass_len.' символов.';
    }
                        
    if(count($error) == 0){
      $this->register_variable("register_ok",1);
      $id = $this->db->insert(register_user_table,array(
                          register_user_name_column => $email,
                          'pass'       => md5($pass),
                          'user_type'  => $system_user_type_by_name['user'],
                          'first_name' => $first_name,
                          'last_name'  => $last_name,
                          'company_id'  => $company_id,
                          'register_date' => date("Y-m-d H:i:s"),))->result();

      $data = array();
      $data['name'] = 'Супер Админ';
      $data['hidden'] = '1';
      $data['type'] = '0';
      $data['users_create'] = '1';
      $data['users_update'] = '1';
      $data['users_delete'] = '1';
      $data['users_list'] = '1';
      $data['torgovaya_list'] = '1';
      $data['torgovaya_create'] = '1';
      $data['torgovaya_update'] = '1';
      $data['torgovaya_delete'] = '1';
      $data['clients_list'] = '1';
      $data['clients_create'] = '1';
      $data['clients_update'] = '1';
      $data['clients_delete'] = '1';
      $data['categories_list'] = '1';
      $data['categories_create'] = '1';
      $data['categories_update'] = '1';
      $data['categories_delete'] = '1';
      $data['userstypes_list'] = '1';
      $data['userstypes_create'] = '1';
      $data['userstypes_update'] = '1';
      $data['userstypes_delete'] = '1';
      $data['postavshiki_list'] = '1';
      $data['postavshiki_create'] = '1';
      $data['postavshiki_update'] = '1';
      $data['postavshiki_delete'] = '1';
      $data['products_list'] = '1';
      $data['products_create'] = '1';
      $data['products_update'] = '1';
      $data['products_delete'] = '1';
      $data['postuplenie_list'] = '1';
      $data['postuplenie_create'] = '1';
      $data['postuplenie_update'] = '1';
      $data['postuplenie_delete'] = '1';
      $data['kurc_valut_create'] = '1';
      $data['kurc_valut_list'] = '1';
      $data['napravlenie_list'] = '1';
      $data['napravlenie_create'] = '1';
      $data['napravlenie_update'] = '1';
      $data['napravlenie_delete'] = '1';
      $data['sklads_list'] = '1';
      $data['sklads_create'] = '1';
      $data['sklads_update'] = '1';
      $data['sklads_delete'] = '1';
      $data['company_id'] = $company_id;

      $data['skidki_view'] = '1';
      $data['skidki_update'] = '1';
      $data['zakaz_list'] = '1';
      $data['zakaz_view'] = '1';
      $data['client_view'] = '1';
      $data['zayavka_create'] = '1';
      $data['category_upload_csv'] = '1';
      $data['spravochnik_valut_delete'] = '1';
      $data['workers_list'] = '1';
      $data['workers_create'] = '1';
      $data['workers_update'] = '1';
      $data['view_postavshik'] = '1';
      $data['sklads_copy'] = '1';
      $data['sklads_add_many_tovars'] = '1';
      $data['sklads_peremestit_tovar'] = '1';
      $data['sklads_add_izdelie'] = '1';
      $data['postuplenie_view'] = '1';
      $data['spravochnik_valut_list'] = '1';
      $data['spravochnik_valut_create'] = '1';
      $data['spravochnik_valut_update'] = '1';
      $data['workers_delete'] = '1';
      $data['workers_view'] = '1';
      $data['scheta_list'] = '1';
      $data['scheta_create'] = '1';
      $data['scheta_update'] = '1';
      $data['scheta_delete'] = '1';
      $data['dohody_list'] = '1';
      $data['dohody_create'] = '1';
      $data['dohody_update'] = '1';
      $data['dohody_delete'] = '1';
      $data['rashody_list'] = '1';
      $data['rashody_create'] = '1';
      $data['rashody_update'] = '1';
      $data['rashody_delete'] = '1';
      $data['professions_list'] = '1';
      $data['professions_create'] = '1';
      $data['professions_update'] = '1';
      $data['professions_delete'] = '1';
      $data['orders_statuses_list'] = '1';
      $data['orders_statuses_create'] = '1';
      $data['orders_statuses_update'] = '1';
      $data['orders_statuses_delete'] = '1';
      $data['spisanie_view'] = '1';
      $data['zakazy_products_list'] = '1';
      $data['zayavki_list'] = '1';
      $data['zayavki_view'] = '1';
      $data['activity_list'] = '1';
      $data['activity_workers_list'] = '1';
      $data['user_view'] = '1';
      $data['torgovaya_view'] = '1';
      $data['zakaz_create'] = '1';
      $data['kurc_valut_list'] = '1';
      $data['vozvrat_list'] = '1';
      $data['vozvrat_create'] = '1';
      $data['vozvrat_update'] = '1';

      $this->db->insert("users_group", $data);
    }else{ 
      $this->register_variable("register_errors",$error);     
    }
  }
} 
