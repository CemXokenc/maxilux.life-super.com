<?php
  $this->db = new active_records();
   
 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $cart = $this->db->select("")->get("")->result(); 

$update_cart = $this->get("do");
$valuta_change = $this->get("valuta_change");
if($valuta_change==1){
  $valyta = $this->get("valuty");
  $gl_session["session_data"]['valyta'] = $valyta;
}
if($update_cart=="skidka_refresh"){
  $client_id  = $this->get("client_id");
  $client_info = $this->db->where("id",$client_id)->get("clients")->result();
  $skidka_info = $this->db->where("id",$client_info[0]['skidka_id'])->get("skidki")->result();

  $torgovaya_tockka_info = $this->db->where("id",$gl_session["session_data"]['torgovaya_tockka'])->get("torgovye_tochki")->result();
  $office_skidka_info = $this->db->where("id",$torgovaya_tockka_info[0]['skidka_id'])->get("skidki")->result();

 $valuta_name = "";

  if($gl_session["session_data"]['valyta']=="UAH"){
     $valuta_name="грн.";
  }

   if($gl_session["session_data"]['valyta']=="USD"){
     $valuta_name="y.e.";
   }
 
     if($gl_session["session_data"]['valyta']=="EUR"){
     $valuta_name="евро";
   }

     if($gl_session["session_data"]['valyta']=="RUR"){
     $valuta_name="руб.";
     }

     if($valuta_name == ""){
        $valuta_info = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("kod_valuty",$gl_session["session_data"]['valuta'])->get("currencies")->result();
        $valuta_name=$valuta_info[0]['name'];
     }


  echo json_encode(array('skidka' =>  $skidka_info[0]['percent'],'skidka_office' =>  $office_skidka_info[0]['percent'],'valuta_name'=>$valuta_name));
  exit();
}
if(!isset($gl_session["session_data"]['cart'])){
  $this->redirect($this->l("products_list"));
  exit;
}

if($update_cart=="clear_cart"){
  unset($gl_session["session_data"]['cart']);
  $this->redirect($this->l("products_list")); 
}


if($update_cart=="return_products"){
  $this->redirect($this->l("products_list")); 
}

if($update_cart=="update_cart"){
  $products_count = $this->get("products_count");
  $gl_session["session_data"]['client_id_cart']= $this->get("client");
  if(count($products_count)>0){
    foreach($products_count as $product=>$cnt){
      $gl_session["session_data"]['cart'][$product]['qty'] = $cnt;
    }

  }

  $this->redirect($this->l("cart")); 
}

$summa_zakaza = 0;
$summa_tovarov = 0;
if(count($gl_session["session_data"]['cart'])>0){
foreach ($gl_session["session_data"]['cart'] as $id_tovar=>$tovar){
  $info = generate_review_and_price($gl_session["session_data"]['cart'], $id_tovar,0,0);
  $product = $this->db->where("id",$id_tovar)->get("products")->result();

  $rozn_total = "";
 if($gl_session["session_data"]['type_cart'] == 2){
   $rozn_total = $info['total'];
  }
   if($gl_session["session_data"]['type_cart'] == 1){
   $rozn_total = $info['rozn_total'];
  }
/*
  echo "session:".$gl_session["session_data"]['type_cart'];
  echo "rozn_total:".$rozn_total;
  print_r($info);
*/
  $gl_session["session_data"]['cart'][$tovar['id']]['summa'] = $gl_session["session_data"]['cart'][$tovar['id']]['qty'] * $rozn_total;

  $summa_zakaza += $gl_session["session_data"]['cart'][$tovar['id']]['summa'];
  $summa_tovarov += $gl_session["session_data"]['cart'][$tovar['id']]['qty'];
  $gl_session["session_data"]['cart'][$tovar['id']]['name'] = $product[0]['name'];
 
  $info = calc_price($gl_session["session_data"]['cart'][$tovar['id']]['summa'], $gl_session["session_data"]['valyta'],$gl_session["session_data"]['valyta']);

  $gl_session["session_data"]['cart'][$tovar['id']]['summa_view'] = "<div style=''>".$info['view']."</div>";

  $info = calc_price($rozn_total, $gl_session["session_data"]['valyta'],$gl_session["session_data"]['valyta']);

  $gl_session["session_data"]['cart'][$tovar['id']]['price_view'] = "<div style=''>".$info['view']."</div>";
 }
}

$info = calc_price($summa_zakaza, $gl_session["session_data"]['valyta'],$gl_session["session_data"]['valyta']);
$summa_cart =   $info['price'];
$info['view'] .= "<span id='summa_zakaza' style='display:none;'>".$info['price']."</span>";
$this->r_v("summa_zakaza",$info['view']);



if($update_cart=="zakaz"){
  $gl_session["session_data"]['client_id'] = $this->get("client");

  $gl_session["session_data"]['summa_cart'] =  $summa_cart;
  $gl_session["session_data"]['skidka_clienta'] = $this->get("skidka");
  
  $this->redirect($this->l("dostavka")); 
}

$gl_session["session_data"]['cart'][$tovar['id']]['summa'] = number_format($gl_session["session_data"]['cart'][$tovar['id']]['summa'], 2, '.', ' ');
$this->r_v("tovar_in_cart",$gl_session["session_data"]['cart']);

$this->r_v("summa_tovarov",$summa_tovarov);
$clients = array();
if($gl_session["session_data"]['type_cart'] == 1){
  $clients = $this->db->where("torgovaya_tochka_id",$gl_session["session_data"]['torgovaya_tockka'])->get("clients")->result();
}

if($gl_session["session_data"]['type_cart'] == 2){
  $clients = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("postavshiki")->result();
}

$this->r_v("clients",$clients);

$valuty = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("currencies")->result();
$this->r_v("valuty",$valuty ); 
 $this->r_v("cart",$cart); 
