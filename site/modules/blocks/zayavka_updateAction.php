<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "zayavka_update" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("zayavki_list"));
   }
 $zayavka_update_id = $this->getVariable("id");

 if($this->isPost() && $do == "zayavka_update"){
   $zayavki_sklad_id = $this->getVariable("zayavki_sklad_id");
   $zayavki_status = $this->getVariable("zayavki_status");
   $zayavki_valuta = $this->getVariable("zayavki_valuta");
   $zayavki_summa_zakupki = $this->getVariable("zayavki_summa_zakupki");
   $zayavki_postavshik_id = $this->getVariable("zayavki_postavshik_id");
   $zayavki_manager_id = $this->getVariable("zayavki_manager_id");
   
   $data = array("sklad_id"=>$zayavki_sklad_id, "status"=>$zayavki_status, "valuta"=>$zayavki_valuta, "summa_zakupki"=>$zayavki_summa_zakupki, "postavshik_id"=>$zayavki_postavshik_id, "manager_id"=>$zayavki_manager_id, );

   $this->db->where("id", $zayavka_update_id)->update("zayavki",$data);

   
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["zayavki_list"] = "Заявка успешно изменена";
   $this->redirect($this->l("zayavki_list"));
 }
 $zayavka_update_data = $this->db->where("id", $zayavka_update_id)->get("zayavki")->result();
 $this->r_v("zayavka_update_data",$zayavka_update_data[0]);

$do = $this->get("do");
if($this->isPost() && $do=="delete"){

  $product_id = $this->get("product_id");
  $this->db->where("id",$product_id)->delete('zayavki_products');

}
$managers= array();
$dbmanagers = $this->db->where("user_type",12)->where("company_id",$gl_session["session_data"]['company_id'])->get("users")->result();
for($i=0;$i<count($dbmanagers);$i++){
   $id_managers =$dbmanagers[$i]['id'];
   $managers[$id_managers] = "{$dbmanagers[$i]['first_name']} {$dbmanagers[$i]['last_name']}";
}
$this->ddb('zayavka_update_zayavki_manager_id',$managers);

$postavshiki = array();
$dbpostavshiki = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("postavshiki")->result();
for($i=0;$i<count($dbpostavshiki);$i++){
   $id_postavshik =$dbpostavshiki[$i]['id'];
   $postavshiki[$id_postavshik] = $dbpostavshiki[$i]['name'];
}
$this->ddb('zayavka_update_zayavki_postavshik_id',$postavshiki);

$kurc_valut = array();
$dbkurc_valut = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("kurc_valut")->result();
for($i=0;$i<count($dbkurc_valut);$i++){
   $kurc_valut[$dbkurc_valut[$i]['valuta']] = $dbkurc_valut[$i]['valuta'];
}
$this->ddb('zayavka_update_zayavki_valuta',$kurc_valut );

$sklads = array();
$dbsklads  = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("sklads ")->result();
for($i=0;$i<count($dbsklads );$i++){
   $sklads [$dbsklads [$i]['id']] = $dbsklads [$i]['name'];
}
$this->ddb('zayavka_update_zayavki_sklad_id',$sklads);
$this->ddb('zayavka_update_zayavki_status',array("1"=>"Новая заявка","2" =>"Товар получен"));

$zayavka_id = arg(1);
$zayavka = $this->db->where("id",$zayavka_id)->get("zayavki")->result();
$products= $this->db->select("zayavki_products.*, products.*, zayavki_products.id as op_id,zayavki_products.price as price,products.id as id_main,zayavki_products.id as id")->where("zayavki_products.product_id","products.id",1)->where("zayavki_products.zayavka_id",$zayavka_id)->get("zayavki_products,products")->result();
$statuses = array();
if(count($products)>0){
  foreach ($products as $id_pr=>$product){
    
    $info = calc_price($products[$id_pr]['price'], $zayavka[0]['valuta'],$zayavka[0]['valuta']);
    $products[$id_pr]['price'] = $info['view'];
    
    $products[$id_pr]['link_view_tovar'] = $this->l("product_view/{$product['id_main']}/1");
  }
}
$table = '<table class="table table-bordered">
  <thead>
  <tr>
    <th>Название товара</th>
    <th>Количество</th>
    <th>Цена</th>
    <th>Управление</th>
  </tr>
  </thead>
  <tbody>';

for($i=0;$i<count($products);$i++){
$table .= "<tr>
    <td>
      <a target='__blank' href='{$products[$i]['link_view_tovar']}'>{$products[$i]['name']}</a>
    </td>
    <td>{$products[$i]['kolichestvo']}</td>
    <td>{$products[$i]['price']}</td>
    <td><span class='label label-primary product_edit' product-id='{$products[$i]['id']}'>Редактировать</span> <span class='label label-default product_delete' product-id='{$products[$i]['id']}'>Удалить</span><span class='class_edit'></span></td></tr>";
$table .= '  </tbody>
</table>';
}
if($this->isPost() && $do=="delete"){

  echo json_encode(array(
    "table" => $table,
  ));
  exit();
}
$this->r_v("table_products",$table); 
