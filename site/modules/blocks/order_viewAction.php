<?php
  $this->db = new active_records();
$order_id = arg(1);

$client_db = $this->db->where("orders.id",$order_id)->where("orders.client_id","clients.id",1)->select("clients.id as id,clients.fio as fio,clients.email as email,clients.telephone1 as telephone1,clients.telephone as telephone,clients.telephone2 as telephone2")->get("orders,clients")->result();
$manager_db = $this->db->where("orders.id",$order_id)->where("orders.manager_id","users.id",1)->select("users.first_name as first_name,users.last_name as last_name")->get("orders,users")->result();
$client_db[0]['info_url'] = $this->l("view_client/".$client_db[0]['id']);

$this->r_v("client_db",$client_db[0]);
$this->r_v("manager_db",$manager_db[0]);

function perenesti_na_sklad($product_id){
  $categories = array();
  $db = new active_records();
  $categories_data = $db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id", 0)->order_by("name", "asc")->get("categories")->result();

  for ($z = 0; $z < count($categories_data); $z++) {
    $categories[$categories_data[$z]['id']] = array(
      'id' => $categories_data[$z]['id'],
      "name" => $categories_data[$z]['name'],
    );
    $sub_categories_data = $db->where("parent_id", $categories_data[$z]['id'])->order_by("name", "asc")->get("categories")->result();
    for ($z1 = 0; $z1 < count($sub_categories_data); $z1++) {
      $categories[$sub_categories_data[$z1]['id']] = array(
        'id' => $sub_categories_data[$z1]['id'],
        "name" => "=>" . $sub_categories_data[$z1]['name'],
      );
      $sub_categories_data1 = $db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("name", "asc")->get("categories")->result();
      for ($z2 = 0; $z2 < count($sub_categories_data1); $z2++) {
        $categories[$sub_categories_data1[$z2]['id']] = array(
          'id' => $sub_categories_data1[$z2]['id'],
          "name" => "== =>" . $sub_categories_data1[$z2]['name'],
        );
        $sub_categories_data2 = $db->where("parent_id", $sub_categories_data1[$z2]['id'])->order_by("name", "asc")->get("categories")->result();
        for ($z3 = 0; $z3 < count($sub_categories_data2); $z3++) {
          $categories[$sub_categories_data2[$z3]['id']] = array(
            'id' => $sub_categories_data2[$z3]['id'],
            "name" => "== == =>" . $sub_categories_data2[$z3]['name'],
          );
        }
      }
    }
  }

    $categories_list  = "<select name='categories'>";
    $categories_list  .= "<option value='0' selected>Не выбрано</option>";
    foreach($categories as $key=>$val){
      $categories_list  .= "<option value='{$val['id']}'>{$val['name']}</option>";
    }

    $categories_list .= "</select>";

  $sklads_info = array();
  $sklads_data = $db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id", 0)->order_by("name", "asc")->get("sklads")->result();

  for ($z = 0; $z < count($sklads_data); $z++) {
    $sklads_info[$sklads_data[$z]['id']] = array(
      'id' => $sklads_data[$z]['id'],
      "name" => $sklads_data[$z]['name'],
    );
    $sub_sklads_data = $db->where("parent_id", $sklads_data[$z]['id'])->order_by("name", "asc")->get("sklads")->result();
    for ($z1 = 0; $z1 < count($sub_sklads_data); $z1++) {
      $sklads_info[$sub_sklads_data[$z1]['id']] = array(
        'id' => $sub_sklads_data[$z1]['id'],
        "name" => "=>" . $sub_sklads_data[$z1]['name'],
      );
      $sub_sklads_data1 = $db->where("parent_id", $sub_sklads_data[$z1]['id'])->order_by("name", "asc")->get("sklads")->result();
      for ($z2 = 0; $z2 < count($sub_sklads_data1); $z2++) {
        $sklads_info[$sub_sklads_data1[$z2]['id']] = array(
          'id' => $sub_sklads_data1[$z2]['id'],
          "name" => "== =>" . $sub_sklads_data1[$z2]['name'],
        );
        $sub_sklads_data2 = $db->where("parent_id", $sub_sklads_data1[$z2]['id'])->order_by("name", "asc")->get("sklads")->result();
        for ($z3 = 0; $z3 < count($sub_sklads_data2); $z3++) {
          $sklads_info[$sub_sklads_data2[$z3]['id']] = array(
            'id' => $sub_sklads_data2[$z3]['id'],
            "name" => "== == =>" . $sub_sklads_data2[$z3]['name'],
          );
        }
      }
    }
  }

    $sklad = "<select name='sklad_id' class='form-control'>";
    foreach($sklads_info as $key=>$val){
      $sklad .= "<option value='{$val['id']}'>{$val['name']}</option>";
    }
    $sklad .= "</select>";

    $perenesti_na_sklad = "<form action='' method='post'>" .
      "<input type='hidden' name='do' value='perenesti_na_sklad' />".
      "<input type='hidden' name='product_id' value='{$product_id}' />" .
      "{$categories_list}" .
      "{$sklad}".
      "<input type='submit' value='Перенести на склад' />".
      "</form>";
    return $perenesti_na_sklad;
  }

  $do = $this->get("do");

if($this->isPost() && $do == "perenesti_na_sklad"){
  $product_id = $this->get("product_id");
  $categories = $this->get("categories");
  $sklad_id   = $this->get("sklad_id");

  $this->db->set("moved_at_sklad", 1)->where("id", $product_id)->update("order_products");
  $product_info = $this->db->select("products.*, order_products.session_data as s_d")->where("order_products.id", $product_id)->where("order_products.product_id", "products.id", 1)->get("products, order_products")->result();

  $is_exists = $this->db->where("session_data", $product_info[0]['s_d'])->where("izdelie","0")->where("category_id", $categories)->where("name",$product_info[0]['name'])->get("products")->result();

  if(count($is_exists) > 0){
    $info = $this->db->where("sklad_id", $sklad_id)->where("tovar_id", $is_exists[0]['id'])->get("products_ostatki")->result();
    if(count($info) > 0){
      $this->db->where("id", $is_exists[0]['id'])->set("kolichestvo +", 1)->update("products_ostatki");
    }else{
      $data = array();
      $data['tovar_id'] = $is_exists[0]['id'];
      $data['sklad_id'] = $sklad_id;
      $data['kolichesctvo'] = 1;
      $ostatki = $this->db->insert("products_ostatki", $data)->result();
    }
  }else{
    $data = array();
    $data['name'] = $product_info[0]['name'];
    $data['category_id'] = $categories;
    $data['session_data'] = $product_info[0]['s_d'];
    $data['old_product_id'] = $product_info[0]['id'];

    $tovar_id = $this->db->insert("products", $data)->result();

    $data = array();
    $data['tovar_id'] = $tovar_id;
    $data['sklad_id'] = $sklad_id;
    $data['kolichesctvo'] = 1;
    $ostatki = $this->db->insert("products_ostatki", $data)->result();
  }
}

if($this->isPost() && $do == "status_update"){
    $status_id = $this->get("status_id");
    $old_status = $this->db->where("id",$order_id)->get("orders")->result();
   
   if($old_status[0]['default_status']==$status_id){
         echo json_encode(array('error' => 1));
         exit();
    }
    $this->db->where("id",$order_id)->set("default_status",$status_id)->update("orders");
    $order= $this->db->where("id",$order_id)->get("orders")->result();
    $cat_stateses = $this->db->order_by("order_num", "asc")->where("company_id",$gl_session["session_data"]['company_id'])->get("orders_statuses")->result();
    $statuses_db[0] = $old_status[0]['default_status'];
    $statuses_db[1] =  $status_id;
    $details_db = serialize($statuses_db);
   $statuses = array();
     $data_operaciya = array(
     'company_id' => $gl_session["session_data"]['company_id'],
     'operation' => 2,
     'order_id' => $order_id,
     'created' => date('Y-m-d H:i:s') ,
     'user_id' => $gl_session["session_data"]['user_id'],
     'details' => $details_db,
   );
    $this->db->insert("activity",$data_operaciya);

     $select_db = "";
     if(count($cat_stateses)>0){
         foreach($cat_stateses as $db_id=>$status_db){

          if($status_db['id'] == $order[0]['default_status']){
             $select_db .= "<option selected value='".$status_db['id']."'>".$status_db['name']."</option>";
            if($db_id+1<count($cat_stateses)){
             $select_db .= "<option value='".$cat_stateses[$db_id+1]['id']."'>".$cat_stateses[$db_id+1]['name']."</option>";
            }
          }
   }
}
    echo json_encode(array('status' => 1,'select_db' =>$select_db));
    exit();
}

if($this->isPost() && $do == "download_users"){

  $status_id = $this->get("status_id");
  $workers_db = $this->db->where("category_statuses.id",$status_id)->where("category_statuses.profession","workers.profession_id",1)->where("workers.company_id",$gl_session["session_data"]['company_id'])->order_by("category_statuses.nomer","asc")->select("workers.id as id,workers.fio as fio")->get("category_statuses,workers")->result();

  $worker_list = "<select>";
 $worker_list .= "<option value='0'>Не выбран</option>";
  for($i=0;$i<count($workers_db);$i++){
    $worker_list .= "<option value='".$workers_db[$i]['id']."'> ".$workers_db[$i]['fio']."</option>"; 
  }
 $worker_list .= "</select>";
  echo json_encode(array('workers_list' =>$worker_list));
    exit();
}

if($this->isPost() && $do == "status_product_update"){
  
  $product_id= $this->get("product_id");
  $select_id= $this->get("select_id");
  $worker_id = $this->get("worker_id");
  $worker_info = $this->db->where("id",$worker_id)->get("workers")->result();
  $order_db = $this->db->where("order_id",$order_id)->where("product_id",$product_id)->get("order_products")->result();
  if($order_db[0]['category_status']==$select_id){
     echo json_encode(array('error' => 1));
     exit();
  }
  $this->db->set("profession_id",$worker_info[0]['profession_id'])->set("created",date('Y-m-d H:i:s') )->set("order_id",$order_id)->set("product_id",$product_id)->set("status_id",$select_id)->set("user_id",$worker_id)->insert("order_product_statused");

  $this->db->where("order_id",$order_id)->where("product_id",$product_id)->set("category_status",$select_id)->update("order_products");

   $status = $this->db->where("id",$select_id)->get("category_statuses")->result();
   $product_info = $this->db->where("order_id",$order_id)->where('product_id',$product_id)->get("order_products")->result();
   if($status[0]['spisanie']==1){


      $product_cnt = $this->get("product_cnt");

      $data = array(
         'company_id' => $gl_session["session_data"]['company_id'],
         'product_id' => $product_id,
         'quantity' => $product_cnt,
         'operation_date' => date('Y-m-d H:i:s'),
         'user_id' => $gl_session["session_data"]['user_id'],
         'order_id' => $order_id,
         'price' => $product_info[0]['price'],
      );
     $this->db->insert("spisanie",$data);

     $session_data = unserialize($order_db[0]['session_data']);
     generate_review_and_price($session_data['cart'], $product_id ,2,$order_id);

     $this->db->where("id",$product_id)->set('cnt -', $product_cnt)->update("products");
   }
    //конец списания товара

  $select_data = "";

  $product = $this->db->where("id",$product_id)->get("products")->result();
  $category = $this->db->where("id",$product[0]['category_id'])->get("categories")->result();
  $cat_statuses = $this->db->where("category_id",$category[0]['id'])->order_by("nomer","asc")->get("category_statuses")->result();
  if(count($cat_statuses)<1){
    $cat_statuses = $this->db->where("category_id",$category[0]['parent_id'])->order_by("nomer","asc")->get("category_statuses")->result();
    $category = $this->db->where("id",$category[0]['parent_id'])->get("categories")->result();
    if(count($cat_statuses)<1){
      $cat_statuses = $this->db->where("category_id",$category[0]['parent_id'])->order_by("nomer","asc")->get("category_statuses")->result();
      $category = $this->db->where("id",$category[0]['parent_id'])->get("categories")->result();
      if(count($cat_statuses)<1){
        $cat_statuses = $this->db->where("category_id",$category[0]['parent_id'])->order_by("nomer","asc")->get("category_statuses")->result();
      }
    }
  }

  $statuses = array();

  $perenesti_na_sklad = "";
  if(count($cat_statuses)>0){
    if($select_id == 0){
      $select_data .= "<option value='0'>Выберите статус</option>";
      $select_data .= "<option value='".$cat_statuses[0]['id']."'>".$cat_statuses[0]['name']."</option>";

    }else{
      for($z=0;$z<count($cat_statuses);$z++){
        if($cat_statuses[$z]['id'] == $select_id){
          $select_data .= "<option selected value='".$cat_statuses[$z]['id']."'>".$cat_statuses[$z]['name']."</option>";
  
          if($z+1<count($cat_statuses)){
            $select_data .= "<option value='".$cat_statuses[$z+1]['id']."'>".$cat_statuses[$z+1]['name']."</option>";
          }else{
            $perenesti_na_sklad = perenesti_na_sklad($product_id);
          }
        }
      }
    }
  }

 

  echo json_encode(array('status' => 1,'select_data' => $select_data, 'perenesti_na_sklad'=>$perenesti_na_sklad));
  exit();
}

$order= $this->db->where("id",$order_id)->get("orders")->result();
$products= $this->db->select("order_products.*, products.*, order_products.id as op_id,order_products.price as price")->where("order_products.product_id","products.id",1)->where("order_products.order_id",$order_id)->get("order_products,products")->result();
$statuses = array();
if(count($products)>0){
  foreach ($products as $id_pr=>$product){
    $category = $this->db->where("id",$product['category_id'])->get("categories")->result();
    $cat_statuses = $this->db->where("category_id",$category[0]['id'])->order_by("nomer","asc")->get("category_statuses")->result();
    if(count($cat_statuses)<1){
      $cat_statuses = $this->db->where("category_id",$category[0]['parent_id'])->order_by("nomer","asc")->get("category_statuses")->result();
      $category = $this->db->where("id",$category[0]['parent_id'])->get("categories")->result();
      if(count($cat_statuses)<1){
        $cat_statuses = $this->db->where("category_id",$category[0]['parent_id'])->order_by("nomer","asc")->get("category_statuses")->result();
        $category = $this->db->where("id",$category[0]['parent_id'])->get("categories")->result();
        if(count($cat_statuses)<1){
          $cat_statuses = $this->db->where("category_id",$category[0]['parent_id'])->order_by("nomer","asc")->get("category_statuses")->result();
        }
      }
    }
    /* prepare status list */
    $perenesti_na_sklad = "";
    $statuses = array();
    if(count($cat_statuses)>0){
      if($products[$id_pr]['category_status'] == 0){
        $statuses[0] = array("id"=>0,"name"=>"Выберите статус");
        $statuses[1] = array("id"=>$cat_statuses[0]['id'], "name"=>$cat_statuses[0]['name']);
      }else{
        for($z=0;$z<count($cat_statuses);$z++){
          if($cat_statuses[$z]['id'] == $products[$id_pr]['category_status']){
            $statuses[0] = array("id"=>$cat_statuses[$z]['id'], "name"=>$cat_statuses[$z]['name']);
            if($z+1<count($cat_statuses)){
              $statuses[1] = array("id"=>$cat_statuses[$z+1]['id'], "name"=>$cat_statuses[$z+1]['name']);
            }else{
              $perenesti_na_sklad = perenesti_na_sklad($products[$id_pr]['op_id']);
            }
          }
        }
      }
    }
    $products[$id_pr]['statuses'] = $statuses;//$cat_statuses;

    $products[$id_pr]['amount'] = $products[$id_pr]['price'] * $products[$id_pr]['kolichestvo'];
    $products[$id_pr]['price_skidka'] = $products[$id_pr]['price_skidka'] * $products[$id_pr]['kolichestvo'];
    $products[$id_pr]['price_ofice_skidka'] = $products[$id_pr]['price_ofice_skidka'] * $products[$id_pr]['kolichestvo'];

    $products[$id_pr]['price_total'] = $products[$id_pr]['amount'] - $products[$id_pr]['price_skidka'];
    $products[$id_pr]['price_office_total'] = $products[$id_pr]['amount'] - $products[$id_pr]['price_ofice_skidka'];

    $info = calc_price($products[$id_pr]['price'], $order[0]['valuta'],$order[0]['valuta']);
    $products[$id_pr]['price'] = $info['view'];

    $info = calc_price($products[$id_pr]['amount'], $order[0]['valuta'],$order[0]['valuta']);
    $products[$id_pr]['amount'] = $info['view'];

    $info = calc_price($products[$id_pr]['price_skidka'], $order[0]['valuta'],$order[0]['valuta']);
    $products[$id_pr]['price_skidka'] = $info['view'];

    $info = calc_price($products[$id_pr]['price_ofice_skidka'], $order[0]['valuta'],$order[0]['valuta']);
    $products[$id_pr]['price_ofice_skidka'] = $info['view'];

    $info = calc_price($products[$id_pr]['price_total'], $order[0]['valuta'],$order[0]['valuta']);
    $products[$id_pr]['price_total'] = $info['view'];

    $info = calc_price($products[$id_pr]['price_office_total'], $order[0]['valuta'],$order[0]['valuta']);
    $products[$id_pr]['price_office_total'] = $info['view'];

    //if($product[$id_pr]['session_data'] != ""){
    $products[$id_pr]['link_view_tovar'] = $this->l("view_tovar/".$product['op_id']."/1/".$order_id);
    $products[$id_pr]['edit_product_url'] = $this->l("edit_cart/".$product['op_id']."/2");
    //}

    $products[$id_pr]['perenesti_na_sklad'] = $perenesti_na_sklad;
  }
}
$this->r_v("order_products",$products);

$this->r_v("cat_statuses",$statuses);

$order_oplata = calc_price($order[0]['summa']-$order[0]['skidka_amount'], $order[0]['valuta'],$order[0]['valuta']);
$skidka = calc_price($order[0]['skidka_amount'], $order[0]['valuta'],$order[0]['valuta']);
$order[0]['skidka'] = "<div>".$skidka['view']."</div>";
$order[0]['oplata'] = "<div>".$order_oplata['view']."</div>";
$info = calc_price($order[0]['summa'], $order[0]['valuta'],$order[0]['valuta']);
$order[0]['summa'] = "<div>".$info['view']."</div>";
$order[0]['order_date'] = date('d.m.Y H:i',strtotime($order[0]['order_date']));  
$torg_tochka = $this->db->where("id",$order[0]['torgovaya_tochka_id'])->get(" torgovye_tochki")->result();
$order[0]['torg_tochka_name'] = $torg_tochka[0]['name'];
$this->r_v("order",$order[0]);
$cat_stateses = $this->db->order_by("order_num", "asc")->where("company_id",$gl_session["session_data"]['company_id'])->get("orders_statuses")->result();
$statuses = array();

if(count($cat_stateses)>0){
foreach($cat_stateses as $db_id=>$status_db){

          if($status_db['id'] == $order[0]['default_status']){
            $statuses[0] = array("id"=>$status_db['id'], "name"=>$status_db['name']);
            if($db_id+1<count($cat_stateses)){
              $statuses[1] = array("id"=>$cat_stateses[$db_id+1]['id'], "name"=>$cat_stateses[$db_id+1]['name']);
            }
          }
   }
}
$this->r_v("stateses",$statuses); 
