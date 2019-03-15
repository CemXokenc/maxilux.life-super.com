<?php
  $this->db = new active_records();
   
 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $left_menu_main = $this->db->select("")->get("")->result(); 
$left_categories = array();

$menu_list = $this->db->where("parent_id",0)->where("company_id",$gl_session["session_data"]['company_id'])->get("company_menu")->result();
for($i=0;$i<count($menu_list);$i++){
   if($gl_session["session_data"][$menu_list[$i]['user_right']]==1){
     $left_categories[] = array("name"=>$menu_list[$i]['name'], "url"=>$this->l($menu_list[$i]['url']));
   }

   if($menu_list[$i]['user_right']==""){
     $left_categories[] = array("name"=>$menu_list[$i]['name'], "url"=>"");
   }
   $is_add = 0;
   $child_db = $this->db->where("parent_id",$menu_list[$i]['id'])->where("company_id",$gl_session["session_data"]['company_id'])->get("company_menu")->result();
   for($z=0;$z<count($child_db);$z++){
       $last_index = count($left_categories)-1;
       if($gl_session["session_data"][$child_db[$z]['user_right']]==1){
         $is_add = 1;
         $left_categories[$last_index]['child'][$z] = array("name"=>$child_db[$z]['name'], "url"=>$this->l($child_db[$z]['url']));
       }
   }
  if(count($child_db)>0){
    if($is_add == 0){
      $last_index = count($left_categories)-1;
      $left_categories[$last_index]['hidden'] = 1;
    }
  }
}
$left_categories[] = array("name"=>"Выход", "url"=>$this->l("logout"));
/*
if($gl_session["session_data"]['users_list']==1){$left_categories[] = array("name"=>"Пользователи", "url"=>$this->l("users"));}
if($gl_session["session_data"]['torgovaya_list']==1 && $gl_session["session_data"]['user_type']!=12){$left_categories[] = array("name"=>"Торговые точки", "url"=>$this->l("torgovye_tochki"));}
if($gl_session["session_data"]['sklads_list']==1){$left_categories[] = array("name"=>"Управление складами", "url"=>$this->l("sklads"));}
if($gl_session["session_data"]['napravlenie_list']==1){$left_categories[] = array("name"=>"Направления", "url"=>$this->l("napravlenie"));}
if($gl_session["session_data"]['clients_list']==1){$left_categories[] = array("name"=>"Клиенты", "url"=>$this->l("clients"));}
if($gl_session["session_data"]['skidki_view']==1){$left_categories[] = array("name"=>"Скидки", "url"=>$this->l("skidki"));}
if($gl_session["session_data"]['products_list']==1 && ($gl_session["session_data"]['user_type'] == 12 || $gl_session["session_data"]['user_type'] == 5)){$left_categories[] = array("name"=>"Товары1", "url"=>$this->l("products_list".'/1'));}
if($gl_session["session_data"]['zakaz_list']==1){$left_categories[] = array("name"=>"Список заказов", "url"=>$this->l("zakaz_list"));}
if($gl_session["session_data"]['categories_list']==1){$left_categories[] = array("name"=>"Категории", "url"=>$this->l("categories"));}
if($gl_session["session_data"]['userstypes_list']==1 && $gl_session["session_data"]['user_type']!=12){$left_categories[] = array("name"=>"Типы пользователей", "url"=>$this->l("users_group"));}
if($gl_session["session_data"]['postavshiki_list']==1){$left_categories[] = array("name"=>"Поставщики", "url"=>$this->l("postavshiki"));}
if($gl_session["session_data"]['products_list']==1){$left_categories[] = array("name"=>"Склад", "url"=>$this->l("products"));}
if($gl_session["session_data"]['postuplenie_list']==1){$left_categories[] = array("name"=>"Поступление", "url"=>$this->l("postuplenie"));}
if($gl_session["session_data"]['vozvrat_list']==1){$left_categories[] = array("name"=>"Возврат", "url"=>$this->l("vozvrat"));}
if($gl_session["session_data"]['kurc_valut_list']==1){$left_categories[] = array("name"=>"Курс валют", "url"=>$this->l("kurc_valut"));}



if($gl_session["session_data"]['spravochnik_valut_list']==1){$left_categories[] = array("name"=>"Справочник валют", "url"=>$this->l("spravochnik_valut"));}
if($gl_session["session_data"]['workers_list']==1){$left_categories[] = array("name"=>"Работники", "url"=>$this->l("workers"));}
if($gl_session["session_data"]['scheta_list']==1){$left_categories[] = array("name"=>"Счета", "url"=>$this->l("scheta"));}
if($gl_session["session_data"]['dohody_list']==1){$left_categories[] = array("name"=>"Доходы", "url"=>$this->l("dohody"));}
if($gl_session["session_data"]['rashody_list']==1){$left_categories[] = array("name"=>"Расходы", "url"=>$this->l("rashody"));}
if($gl_session["session_data"]['professions_list']==1){$left_categories[] = array("name"=>"Должности", "url"=>$this->l("professions"));}
if($gl_session["session_data"]['orders_statuses_list']==1){$left_categories[] = array("name"=>"Статусы", "url"=>$this->l("orders_statuses"));}
if($gl_session["session_data"]['spisanie_view']==1){$left_categories[] = array("name"=>"Списание", "url"=>$this->l("spisanie"));}
if($gl_session["session_data"]['zakazy_products_list']==1){$left_categories[] = array("name"=>"Заказы по продуктам", "url"=>$this->l("zakazy_products"));}
if($gl_session["session_data"]['zayavki_list']==1){$left_categories[] = array("name"=>"Заявки", "url"=>$this->l("zayavki_list"));}
if($gl_session["session_data"]['activity_list']==1){$left_categories[] = array("name"=>"Активность действий", "url"=>$this->l("activity"));}
if($gl_session["session_data"]['activity_workers_list']==1){$left_categories[] = array("name"=>"Активность работников", "url"=>$this->l("activity_workers"));}
*/


$this->r_v('left_categories',$left_categories); 
 $this->r_v("left_menu_main",$left_menu_main); 
