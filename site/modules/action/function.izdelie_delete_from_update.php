<?php

 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 

 $css_link = $this->l("css"); 
 $this->r_v("css_link", $css_link); 
 $this->db = new active_records();

$product_del = arg(1);
$this->db->where("id",$product_del)->delete("products");
$product_del = arg(2);
$gl_session["session_data"]['system_messages']['products_elements_update'] = "Данные успешно удалены";
$this->redirect($this->l("products_elements_update/".$product_del));

 return $this->showPage('izdelie_delete_from_update');
?>