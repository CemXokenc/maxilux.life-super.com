<?php
  $this->db = new active_records();
if($block_attr_table=="torgovye_tochki" || $block_attr_table=="clients" || $block_attr_table=="orders" || $block_attr_table=="postavshiki"  || $block_attr_table=="postuplenie" || $block_attr_table=="zayavki"){
  $item_id = arg(1);
  $this->db->where("id",$item_id )->set("delete_status",1)->update($block_attr_table);
  $this->redirect($this->l($block_attr_redirect));
}
$this->delete_item_hide($block_attr_table);
if(!empty($block_attr_page)){
$gl_session["session_data"]['system_messages'][$block_attr_page] = "Данные успешно удалены";
}
$this->redirect($this->l($block_attr_redirect)); 
