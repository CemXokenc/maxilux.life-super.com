<?php
  $this->db = new active_records();
   
 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $zayavka_view = $this->db->select("")->get("")->result(); 
$zayavka_id = arg(1);
$status_id = $this->get("status");
$do = $this->get("do");
if($this->isPost() && $do == "change_status" && $status_id != 1){
   $sklad_id = $this->get("sklad");
 $this->db->where("id",$zayavka_id)->set("status",$status_id)->set("sklad_id",$sklad_id)->update("zayavki");
$zayavka = $this->db->where("id",$zayavka_id)->get("zayavki")->result();
    $nomer_db = $this->db->order_by("id","desc")->where("company_id",$gl_session["session_data"]['company_id'])->limit(1)->get("postuplenie")->result();
  $nomer = $nomer_db[0]['nomer'] + 1;
  $id = $this->db->set("nomer", $nomer)->insert("postuplenie")->result();
 $data_postuplenie = array(
    'postavshik_id' => $zayavka[0]['postavshik_id'],
    'summa' => $zayavka[0]['summa_zakupki'],
    'valuta' => $zayavka[0]['valuta'],
   'data_postupleniya' => date('Y-m-d H:i:s'),
   'company_id' => $gl_session["session_data"]['company_id'],
   'nomer' =>  $nomer ,
   'user_id' =>  $gl_session["session_data"]['user_id'],
   );
  $postuplenie_id  = $this->db->insert("postuplenie", $data_postuplenie)->result();
  $products_zayavka = $this->db->where("zayavka_id",$zayavka_id)->get("zayavki_products")->result();
  for($i=0;$i<count($products_zayavka);$i++){
   $data_product = array(
    'postuplenie_id' =>  $postuplenie_id,
    'tovar_id' =>  $products_zayavka[$i]['product_id'],
    'kolichestvo' =>  $products_zayavka[$i]['kolichestvo'],
    'price' =>  $products_zayavka[$i]['price'],
    'sklad_id' =>   $sklad_id,
    'valuta' => $zayavka[0]['valuta'],
   );
   $this->db->insert("postuplenie_tovarov", $data_product);
  }
  

   $statuses = array();
     $data_operaciya = array(
     'company_id' => $gl_session["session_data"]['company_id'],
     'operation' => 6,
     'order_id' => $zayavka_id,
     'created' => date('Y-m-d H:i:s') ,
     'user_id' => $gl_session["session_data"]['user_id'],
     'details' => $status_id,
   );
    $this->db->insert("activity",$data_operaciya);

    $this->redirect($this->l("postuplenie_update/".$postuplenie_id));
}

$zayavka = $this->db->where("id",$zayavka_id)->get("zayavki")->result();
$products= $this->db->select("zayavki_products.*, products.*, zayavki_products.id as op_id,zayavki_products.price as price,products.id as id_main")->where("zayavki_products.product_id","products.id",1)->where("zayavki_products.zayavka_id",$zayavka_id)->get("zayavki_products,products")->result();
$statuses = array();
if(count($products)>0){
  foreach ($products as $id_pr=>$product){
    
    $info = calc_price($products[$id_pr]['price'], $zayavka[0]['valuta'],$zayavka[0]['valuta']);
    $products[$id_pr]['price'] = $info['view'];

    $products[$id_pr]['link_view_tovar'] = $this->l("product_view/{$product['id_main']}/1");
  }
}
$postavshiki= $this->db->where("id",$zayavka[0]['postavshik_id'])->get("postavshiki")->result();
$manager= $this->db->where("id",$zayavka[0]['manager_id'])->get("users")->result();
$sklads= $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("sklads")->result();
$this->r_v("sklads",$sklads);
$this->r_v("postavshiki",$postavshiki[0]);
$this->r_v("manager",$manager[0]);
$this->r_v("zayavki_products",$products);
$this->r_v("zayavka",$zayavka[0]); 
 $this->r_v("zayavka_view",$zayavka_view); 
