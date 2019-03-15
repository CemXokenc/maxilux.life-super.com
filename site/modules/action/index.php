<?php
 class pagesAction extends Actions{
   function groupsAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.groups.php");
   }
   function loginAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.login.php");
   }
   function homeAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.home.php");
   }
   function dillerAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.diller.php");
   }
   function registerAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.register.php");
   }
   function torgovye_tochki_createAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.torgovye_tochki_create.php");
   }
   function torgovye_tochki_updateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.torgovye_tochki_update.php");
   }
   function torgovye_tochki_deleteAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.torgovye_tochki_delete.php");
   }
   function torgovye_tochkiAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.torgovye_tochki.php");
   }
   function users_deleteAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.users_delete.php");
   }
   function usersAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.users.php");
   }
   function users_createAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.users_create.php");
   }
   function users_updateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.users_update.php");
   }
   function logoutAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.logout.php");
   }
   function clients_createAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.clients_create.php");
   }
   function clients_updateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.clients_update.php");
   }
   function clients_deleteAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.clients_delete.php");
   }
   function clientsAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.clients.php");
   }
   function category_createAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.category_create.php");
   }
   function categoriesAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.categories.php");
   }
   function category_editAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.category_edit.php");
   }
   function category_deleteAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.category_delete.php");
   }
   function users_group_createAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.users_group_create.php");
   }
   function users_group_updateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.users_group_update.php");
   }
   function users_group_deleteAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.users_group_delete.php");
   }
   function users_groupAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.users_group.php");
   }
   function postavshiki_createAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.postavshiki_create.php");
   }
   function postavshiki_updateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.postavshiki_update.php");
   }
   function postavshiki_deleteAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.postavshiki_delete.php");
   }
   function postavshikiAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.postavshiki.php");
   }
   function edit_cartAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.edit_cart.php");
   }
   function orders_statuses_createAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.orders_statuses_create.php");
   }
   function orders_statuses_updateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.orders_statuses_update.php");
   }
   function orders_statuses_deleteAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.orders_statuses_delete.php");
   }
   function products_updateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.products_update.php");
   }
   function products_deleteAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.products_delete.php");
   }
   function productsAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.products.php");
   }
   function create_productsAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.create_products.php");
   }
   function products_createAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.products_create.php");
   }
   function postuplenie_createAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.postuplenie_create.php");
   }
   function postuplenie_updateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.postuplenie_update.php");
   }
   function postuplenie_deleteAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.postuplenie_delete.php");
   }
   function postuplenieAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.postuplenie.php");
   }
   function kurc_valutAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.kurc_valut.php");
   }
   function kurc_valut_createAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.kurc_valut_create.php");
   }
   function napravlenie_createAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.napravlenie_create.php");
   }
   function napravlenie_updateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.napravlenie_update.php");
   }
   function napravlenie_deleteAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.napravlenie_delete.php");
   }
   function napravlenieAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.napravlenie.php");
   }
   function sklads_createAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.sklads_create.php");
   }
   function sklads_updateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.sklads_update.php");
   }
   function sklads_deleteAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.sklads_delete.php");
   }
   function skladsAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.sklads.php");
   }
   function history_userAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.history_user.php");
   }
   function move_productAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.move_product.php");
   }
   function products_listAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.products_list.php");
   }
   function product_viewAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.product_view.php");
   }
   function cartAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.cart.php");
   }
   function zakaz_listAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.zakaz_list.php");
   }
   function sessionAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.session.php");
   }
   function order_viewAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.order_view.php");
   }
   function products_elements_createAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.products_elements_create.php");
   }
   function products_elements_updateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.products_elements_update.php");
   }
   function izdelie_delete_from_updateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.izdelie_delete_from_update.php");
   }
   function delete_cartAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.delete_cart.php");
   }
   function orders_statusesAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.orders_statuses.php");
   }
   function setup_menuAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.setup_menu.php");
   }
   function view_tovarAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.view_tovar.php");
   }
   function zayavki_listAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.zayavki_list.php");
   }
   function activity_workersAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.activity_workers.php");
   }
   function dostavkaAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.dostavka.php");
   }
   function view_clientAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.view_client.php");
   }
   function preview_productsAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.preview_products.php");
   }
   function uploadAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.upload.php");
   }
   function skidkiAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.skidki.php");
   }
   function spravochnik_valut_createAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.spravochnik_valut_create.php");
   }
   function zakazy_productsAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.zakazy_products.php");
   }
   function activityAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.activity.php");
   }
   function postuplenie_viewAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.postuplenie_view.php");
   }
   function spisanieAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.spisanie.php");
   }
   function workers_createAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.workers_create.php");
   }
   function workers_updateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.workers_update.php");
   }
   function workers_deleteAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.workers_delete.php");
   }
   function workersAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.workers.php");
   }
   function professions_createAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.professions_create.php");
   }
   function professions_updateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.professions_update.php");
   }
   function professions_deleteAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.professions_delete.php");
   }
   function professionsAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.professions.php");
   }
   function spravochnik_valut_updateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.spravochnik_valut_update.php");
   }
   function spravochnik_valut_deleteAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.spravochnik_valut_delete.php");
   }
   function spravochnik_valutAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.spravochnik_valut.php");
   }
   function dohodyAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.dohody.php");
   }
   function dohody_createAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.dohody_create.php");
   }
   function dohody_updateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.dohody_update.php");
   }
   function rashodyAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.rashody.php");
   }
   function rashody_createAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.rashody_create.php");
   }
   function rashody_updateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.rashody_update.php");
   }
   function schetaAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.scheta.php");
   }
   function scheta_createAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.scheta_create.php");
   }
   function scheta_updateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.scheta_update.php");
   }
   function scheta_deleteAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.scheta_delete.php");
   }
   function dohody_deleteAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.dohody_delete.php");
   }
   function rashody_deleteAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.rashody_delete.php");
   }
   function zayavka_viewAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.zayavka_view.php");
   }
   function view_userAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.view_user.php");
   }
   function view_postavshikAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.view_postavshik.php");
   }
   function view_workerAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.view_worker.php");
   }
   function view_torgovaya_tochkaAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.view_torgovaya_tochka.php");
   }
   function activateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.activate.php");
   }
   function category_uploadAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.category_upload.php");
   }
   function vozvrat_createAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.vozvrat_create.php");
   }
   function vozvrat_updateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.vozvrat_update.php");
   }
   function vozvrat_deleteAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.vozvrat_delete.php");
   }
   function vozvratAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.vozvrat.php");
   }
   function zayavka_updateAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.zayavka_update.php");
   }
   function testAction(){
     global $gl_session;
     include_once(dirname(__FILE__)."/function.test.php");
   }
   function cssAction(){
     $route = $_GET["route"];
     $route = str_replace("/", "_", $route);
     $route = str_replace("@", "_", $route);
     function compress($buffer){
       $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
       $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);

       return $buffer;
     }
     header("Content-type: text/css");
     ob_start("compress");
     global $site_variables;
     include(__DIR__."/../blocks/{$route}Css.php");
     ob_end_flush();
     exit;
   }
   function login_redirect(){
     global $gl_session;
     if(!isset($gl_session["session_data"]["user_type"])){
       $this->redirect($this->l("home"));
     }
   }
   function check_rights($action){
     global $gl_session;
     $result = false;
     $r["5"] = array('groups'=>1, );
     $r["6"] = array();
     $r["12"] = array();
     if(isset($r[$gl_session["session_data"]["user_type"]][$action])){
       $result = true;
     }
     return $result;
   }
 }
?>