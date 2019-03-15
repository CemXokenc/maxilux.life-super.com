<?php
  $this->db = new active_records();
   
 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $dostavka = $this->db->select("")->get("")->result(); 


$do = $this->get("do");
if($gl_session["session_data"]['type_cart']==2){
  $do="zakaz";
}
if($do=="zakaz"){

  $nomer = $this->db->order_by("id","desc")->where("company_id",$gl_session["session_data"]['company_id'])->limit(1)->get("orders")->result();

  if($gl_session["session_data"]['type_cart']==2){
    $nomer = $this->db->order_by("id","desc")->where("company_id",$gl_session["session_data"]['company_id'])->limit(1)->get("zayavki")->result();
  }
  $nomer_order = $nomer[0]['nomer'] + 1;

  $default_status_db = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("set_default",1)->get("orders_statuses")->result();
  $fio = $this->get("fio");
  $telephone = $this->get("telephone");
  $email = $this->get("email");
  $zip_code = $this->get("zip_code");
  $adress = $this->get("adress");
  $city = $this->get("city");
//пересчитываем корзину
  $summa_zakaza = 0;
  $summa_tovarov = 0;

  foreach ($gl_session["session_data"]['cart'] as $id_tovar=>$tovar){
    $zakaz_val = 1;
    if($gl_session["session_data"]['type_cart']==2){
      $zakaz_val = 0;
    }
    $info = generate_review_and_price($gl_session["session_data"]['cart'], $id_tovar, $zakaz_val,0);
    $product = $this->db->where("id",$id_tovar)->get("products")->result();

    $rozn_total = "";
    if($gl_session["session_data"]['type_cart'] == 2){
      $rozn_total = $info['total'];
    }
    if($gl_session["session_data"]['type_cart'] != 2){
      $rozn_total = $info['rozn_total'];
    }

    $gl_session["session_data"]['cart'][$tovar['id']]['summa'] = $gl_session["session_data"]['cart'][$tovar['id']]['qty'] * $rozn_total;

    $summa_zakaza += $gl_session["session_data"]['cart'][$tovar['id']]['summa'];
    $summa_tovarov += $gl_session["session_data"]['cart'][$tovar['id']]['qty'];

  }

  $data_order = array();
  $order_id = 0;
  if($gl_session["session_data"]['type_cart'] != 2){

    $client_info = $this->db->where("id",$gl_session["session_data"]['client_id'])->get("clients")->result();
    $skidka_info = $this->db->where("id",$client_info[0]['skidka_id'])->get("skidki")->result();

    $torgovaya_tockka_info = $this->db->where("id",$gl_session["session_data"]['torgovaya_tockka'])->get("torgovye_tochki")->result();
    $office_skidka_info = $this->db->where("id",$torgovaya_tockka_info[0]['skidka_id'])->get("skidki")->result();


    $data_order = array(
      'fio' => $fio,
      'telephone' => $telephone,
      'zip_code' => $zip_code ,
      'adress' => $adress,
      'email' => $email,
      'city' => $city ,
      'order_date' => date('Y-m-d H:i:s') ,
      'summa' =>  $summa_zakaza,
      'torgovaya_tochka_id' => $gl_session["session_data"]['torgovaya_tockka'],
      'client_id' => $gl_session["session_data"]['client_id'],
      'nomer' => $nomer_order,
      'company_id' => $gl_session["session_data"]['company_id'],
      'manager_id' => $gl_session["session_data"]['user_id'],
      'default_status' => $default_status_db[0]['id'],
      'skidka_amount' => $summa_zakaza * $skidka_info[0]['percent'] / 100,
      'skidka_office_amount' => $summa_zakaza * $office_skidka_info[0]['percent'] / 100,
      'valuta' => $gl_session["session_data"]['valyta'],
    );
    $order_id = $this->db->insert("orders",$data_order)->result();
    $data_operaciya = array(
      'company_id' => $gl_session["session_data"]['company_id'],
      'operation' => 1,
      'created' => date('Y-m-d H:i:s') ,
      'user_id' => $gl_session["session_data"]['user_id'],
      'details' => $order_id,
    );
    $this->db->insert("activity",$data_operaciya);
  }

  if($gl_session["session_data"]['type_cart'] == 2){
    $data_order = array(
      'postavshik_id' => $gl_session["session_data"]['client_id'],
      'nomer' => $nomer_order,
      'manager_id' => $gl_session["session_data"]['user_id'],
      'summa_zakupki' =>  $summa_zakaza,
      'valuta' => $gl_session["session_data"]['valyta'],
      'status' => 1,
      'created' => date('Y-m-d H:i:s') ,
      'company_id' => $gl_session["session_data"]['company_id'],
    );
    $order_id = $this->db->insert("zayavki",$data_order)->result();

    $data_operaciya = array(
      'company_id' => $gl_session["session_data"]['company_id'],
      'operation' => 5,
      'created' => date('Y-m-d H:i:s') ,
      'user_id' => $gl_session["session_data"]['user_id'],
      'order_id' => $order_id,
    );
    $this->db->insert("activity",$data_operaciya);
  }
  foreach ($gl_session["session_data"]['cart'] as $id_tovar=>$tovar){
    $product = $this->db->where("id",$id_tovar)->get("products")->result();

    $nacenka = 1;
    if($gl_session["session_data"]['type_cart']!=2){
      $category_1 = $this->db->where("id",$product[0]['category_id'])->get("categories")->result();
      $nacenka = $category_1[0]['nacenka'];
      if($category_1[0]['nacenka']=="" || $category_1[0]['nacenka']==0){
        $category_2 = $this->db->where("id",$category_1[0]['parent_id'])->get("categories")->result();
        $nacenka = $category_2[0]['nacenka'];

        if($category_2[0]['nacenka']=="" || $category_2[0]['nacenka']==0){
          $category_3 = $this->db->where("id",$category_2[0]['parent_id'])->get("categories")->result();
          $nacenka = $category_3[0]['nacenka'];
          if($category_3[0]['nacenka']=="" || $category_3[0]['nacenka']==0){
            $category_4 = $this->db->where("id",$category_3[0]['parent_id'])->get("categories")->result();
            $nacenka = $category_4[0]['nacenka'];
            if($category_4[0]['nacenka']=="" || $category_4[0]['nacenka']==0){
              $nacenka = 1;
            }
          }
        }
      }

      $price_current = calc_price($product[0]['price'] + $product[0]['price']*$nacenka/100,$product[0]['currency'],$gl_session["session_data"]['valyta']);
      if($gl_session["session_data"]['type_cart'] == 2){
        $price_current = calc_price($product[0]['price'],$product[0]['currency'],$gl_session["session_data"]['valyta']);
      }

      $client_info = $this->db->where("id",$gl_session["session_data"]['client_id'])->get("clients")->result();
      $skidka_info = $this->db->where("id",$client_info[0]['skidka_id'])->get("skidki")->result();

      $torgovaya_tockka_info = $this->db->where("id",$gl_session["session_data"]['torgovaya_tockka'])->get("torgovye_tochki")->result();
      $office_skidka_info = $this->db->where("id",$torgovaya_tockka_info[0]['skidka_id'])->get("skidki")->result();

      $data_product = array();
      if($product[0]['izdelie']==1){

        $info = generate_review_and_price($gl_session["session_data"]['cart'], $id_tovar,0,0);
        $rozn_total = $info['rozn_total'];

        $data_product = array(
          'order_id' => $order_id,
          'kolichestvo' => 1,
          'price' => $rozn_total,
          'price_skidka' => $rozn_total * $skidka_info[0]['percent'] / 100,
          'price_ofice_skidka' => $rozn_total * $office_skidka_info[0]['percent'] / 100,
          'price_total' =>$rozn_total - $rozn_total * $skidka_info[0]['percent'] / 100,
          'product_id' => $id_tovar,
          'session_data' => serialize($gl_session["session_data"]),
          'product_prices' => serialize($info['product_prices']),
        );
        for($z=0;$z<$gl_session["session_data"]['cart'][$tovar['id']]['qty'];$z++){
          $this->db->insert("order_products",$data_product)->result();
        }
      }
      if($product[0]['izdelie']!=1){
        $info = generate_review_and_price($gl_session["session_data"]['cart'], $id_tovar,0,0);

        $data_product = array(
          'order_id' => $order_id,
          'kolichestvo' => $gl_session["session_data"]['cart'][$tovar['id']]['qty'],
          'price' => $price_current['price'],
          'price_skidka' => $price_current['price'] * $skidka_info[0]['percent'] / 100,
          'price_ofice_skidka' => $price_current['price'] * $office_skidka_info[0]['percent'] / 100,
          'price_total' => $price_current['price'] - $gl_session["session_data"]['cart'][$tovar['id']]['qty'] * $price_current['price'] * $skidka_info[0]['percent'] / 100,
          'product_id' => $id_tovar,
          'session_data' => $product[0]['session_data'],
          'old_product_id' => $product[0]['old_product_id'],
          'product_prices' => serialize($info['product_prices']),
        );
        $this->db->insert("order_products",$data_product)->result();
      }
    }

    if($gl_session["session_data"]['type_cart'] == 2){

      $info = generate_review_and_price($gl_session["session_data"]['cart'], $id_tovar,0,0);
      $rozn_total = $info['total'];

      $data_product = array(
        'zayavka_id' => $order_id,
        'kolichestvo' => $gl_session["session_data"]['cart'][$tovar['id']]['qty'],
        'price' => $rozn_total,
        'product_id' => $id_tovar,
      );

      $this->db->insert("zayavki_products",$data_product)->result();
    }
  }
  unset($gl_session["session_data"]['cart']);
  unset($gl_session["session_data"]['client_id_cart']);
  if($gl_session["session_data"]['type_cart'] == 2){
    $this->redirect($this->l("zayavka_view/{$order_id}"));
  }

  if($gl_session["session_data"]['type_cart'] != 2){
    $this->redirect($this->l("zakaz_list"));
  }
}

$client_info = $this->db->where("id",$gl_session["session_data"]['client_id'])->get("clients")->result();
$this->r_v("client_info",$client_info[0]); 
 $this->r_v("dostavka",$dostavka); 
