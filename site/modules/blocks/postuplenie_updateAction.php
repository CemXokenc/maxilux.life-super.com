<?php
  $this->db = new active_records();
$postuplenie_id = arg(1);
function create_table_documents($postuplenie_id){
    $table = "<table class='table table-bordered'>
             <thead>
              <tr>
                <th>Документ</th>
                <th style='width:150px;'>Управление</th>
              </tr>
             </thead>
            <tbody>";

    $db = new active_records();
    $relation_documents =  $db->where("postuplenie_id",$postuplenie_id)->get("postuplenie_documents")->result();
    for($i=0;$i<count($relation_documents);$i++){
        $table .= "<tr>";
        $table .= "<td><a href='".$relation_documents[$i]['url']."' target='_blank'>".$relation_documents[$i]['url']."</a></td>";
        $table .= "<td><span class='label label-default relation_documents_delete' document-id='".$relation_documents[$i]['id']."'>Удалить</span></td>";
        $table .= "</tr>";
    }

    $table .= "</tbody></table>";
    return  $table;
}

$do = $this->get("do");
if($this->isPost() && $do=="documents_refresh"){
    $document_url = $this->get("document_url");


    $data = array(
        'url' => $document_url ,
        'postuplenie_id' => $postuplenie_id,
        'company_id' => $gl_session["session_data"]['company_id'],
    );
    $this->db->insert("postuplenie_documents",$data);

    $table = create_table_documents($postuplenie_id);
    echo json_encode(array(
        "table" => $table,
    ));
    exit();
}

if($this->isPost() && $do =="documents_delete"){
    $relation_documents_id = $this->get("document_id");
    $this->db->where("id",$relation_documents_id)->delete('postuplenie_documents');
    $table = create_table_documents($postuplenie_id);
    echo json_encode(array(
        "table" => $table,
    ));
    exit();
}
$table_documents = create_table_documents($postuplenie_id);
$this->r_v("table_documents",$table_documents);


$data_postupleniya = date("d-m-Y");
$this->r_v("data_postupleniya", $data_postupleniya);

function create_table($postuplenie_id){
  $db = new active_records();
  $postuplenie = $db->where("id", $postuplenie_id)->get("postuplenie")->result();
  $table = "<table class='table table-bordered'>
            <thead>
              <tr>
                <th>Склад</th>
                <th>Название</th>
                <th>Количество</th>
                                <th>Цена</th>
                                <th>Общая сумма</th>
                                <th>Управление</th>
              </tr>
            </thead>
            <tbody>";

  $products_postuplenia =  $db->where("postuplenie_id",$postuplenie_id)->select("sklads.name as sklad_name, postuplenie_tovarov.kolichestvo as kolichestvo, postuplenie_tovarov.price as price, products.name as tovar_name,postuplenie_tovarov.id as id, postuplenie_tovarov.valuta as valuta")->where("products.id","postuplenie_tovarov.tovar_id",1)->where("sklads.id","postuplenie_tovarov.sklad_id",1)->get("postuplenie_tovarov,products,sklads")->result();
  //print_r($products_postuplenia[$i]);
  $tovary =  $db->get("products")->result();
  $tovary_cnt = 0;
  $tovary_price = 0;
  for($i=0;$i<count($products_postuplenia);$i++){
    $tovary_cnt += $products_postuplenia[$i]['kolichestvo'];
    $tovary_price += $products_postuplenia[$i]['kolichestvo']*$products_postuplenia[$i]['price'];

    //echo $products_postuplenia[$i]['price']." - ".$products_postuplenia[$i]['valuta']." - ".$postuplenie[0]['valuta'];
    //exit;

    $info = calc_price($products_postuplenia[$i]['price'], $products_postuplenia[$i]['valuta'], $postuplenie[0]['valuta']);
    $price = $info['view'];

    $info = calc_price($products_postuplenia[$i]['kolichestvo']*$products_postuplenia[$i]['price'], $products_postuplenia[$i]['valuta'], $postuplenie[0]['valuta']);
    $total_price = $info['view'];

    $table .= "<tr>";
    $table .= "<td>".$products_postuplenia[$i]['sklad_name']."</td>";
    $table .= "<td>".$products_postuplenia[$i]['tovar_name']."</td>";
    $table .= "<td><span class='cnt'>".$products_postuplenia[$i]['kolichestvo']."</span><span class='cnt_edit'></span></td>";
    $table .= "<td><span class='price'>".$price."</span><span class='price_edit'></td>";
    $table .= "<td><span class='summa'>".$total_price."</span><span class='price_edit'></td>";
    $table .= "<td><span class='label label-primary tovar_edit' product-id='".$products_postuplenia[$i]['id']."'>Редактировать</span> <span class='label label-default tovar_delete' product-id='".$products_postuplenia[$i]['id']."'>Удалить</span><span class='class_edit'></span></td>";

    $table .= "</tr>";
  }

  $info = calc_price($tovary_price, $postuplenie[0]['valuta'],$postuplenie[0]['valuta']);
  $total_amount = $info['view'];

  $table .= "<tr><td><strong>Итого</strong></td><td>-</td><td><strong>".$tovary_cnt."</strong></td><td><strong>-</strong></td><td><input type='hidden' name='summa_tovarov' value='".$tovary_price."'><strong>".$total_amount."</strong></td><td><strong>-</strong></td></tr>";

  $table .= "				        </tbody>
				      </table>";
  return  $table;
}



if($block_attr_table=="create"){
  $nomer_db = $this->db->order_by("id","desc")->where("company_id",$gl_session["session_data"]['company_id'])->limit(1)->get("postuplenie")->result();
  $nomer = $nomer_db[0]['nomer'] + 1;
  $id = $this->db->set("company_id",$gl_session["session_data"]['company_id'])->set("nomer", $nomer)->insert("postuplenie")->result();
  $this->redirect($this->l("postuplenie_update/".$id));
}
$type_post = $this->get("type");
if($this->isPost() && $type_post=="refresh"){
  $sklad_id = $this->get("sklad");
  $product_id = $this->get("product");
  $cnt = $this->get("cnt");
  $price = $this->get("price");
  $change_price = $this->get("change_price");

  if($change_price == "true"){
    $change_price = 1;
  }
  else{
    $change_price = 0;
  }


  $postuplenie = $this->db->where("id", $postuplenie_id)->get("postuplenie")->result();

  $data = array(
    'postuplenie_id' => $postuplenie_id,
    'sklad_id' => $sklad_id,
    'tovar_id' => $product_id,
    'kolichestvo' => $cnt,
    'price' => $price,
    'change_price' => $change_price,
    'valuta' => $postuplenie[0]['valuta'],
  );
  $this->db->insert("postuplenie_tovarov",$data);

  $table = create_table($postuplenie_id);
  echo json_encode(array(
    "table" => $table,
  ));
  exit();
}

if($this->isPost() && $type_post=="delete"){
  $postuplenie_id = arg(1);
  $tovar_id = $this->get("tovar_id");
  $this->db->where("id",$tovar_id)->delete('postuplenie_tovarov');
  $table = create_table($postuplenie_id);

  echo json_encode(array(
    "table" => $table,
  ));
  exit();
}

if($this->isPost() && $type_post=="change_category"){
  $category_id = $this->get("category_id");
  $category_ = $this->db->where("parent_id",$category_id)->get('categories')->result();
  $select = "<option value='0'>Выберите тип категории</option>";
  if(is_array($category_) && $category_id!=0){
    for($i=0;$i<count($category_);$i++){
      $select .="<option value='".$category_[$i]['id']."'>".$category_[$i]['name']."</option>";
    }

  }


  echo json_encode(array(
    "select" => $select,
  ));
  exit();
}
if($this->isPost() && $type_post=="update"){
  $postuplenie_id = arg(1);
  $tovar_id = $this->get("tovar_id");
  $cnt= $this->get("cnt");
  $price = $this->get("price");
  $data = array(
    'kolichestvo' =>  $cnt,
    'price' =>  $price,
  );
  $this->db->where("id",$tovar_id)->update('postuplenie_tovarov',$data);
  $table = create_table($postuplenie_id);

  echo json_encode(array(
    "table" => $table,
  ));
  exit();
}

if($this->isPost() && $type_post=="category"){
  $category_id = $this->get("category_id");
  $categories_list = $category_id.generate_categories_list($category_id);

  $products = $this->db->where_in("category_id", $categories_list)->get("products")->result();
  $select = "<option selected value='0'>Выберите товар</option>";
  for($i=0;$i<count($products);$i++){
    $select .= "<option value='".$products[$i]['id']."'>".$products[$i]['name']."</option>";
  }
  echo json_encode(array(
    "table" => $select,
  ));
  exit();
}

if($this->isPost() && $type_post=="tovar_change"){
  $tovar_id = $this->get("tovar_id");

  $postuplenie_id = arg(1);
  $tovar = $this->db->where("id",  $tovar_id)->get("products")->result();
  $postuplenie = $this->db->where("id", $postuplenie_id)->get("postuplenie")->result();

  $info = calc_price($tovar[0]['price'], $tovar[0]['currency'], $postuplenie[0]['valuta']);
  $price = $info['view'];
  $price_valuta = $info['price'];

  echo json_encode(array(
    "price" => $price,
    "price_valuta" => $price_valuta,
    "type_valuta" =>$postuplenie[0]['valuta'],
  ));
  exit();
}

if($this->isPost() && $type_post == "save_postuplenie"){
  $postavshik = $this->getVariable("postavshik");
  $data_postupleniya = $this->getVariable("data_postupleniya");
  $summa= $this->getVariable("summa");
  $valuta = $this->getVariable("valuta");
  $summa_tovarov = $this->getVariable("summa_tovarov");
  $nomer_naklodnoy = $this->getVariable("nomer_naklodnoy");

  $data_info = explode("-",$data_postupleniya);
  $data = array(
    'postavshik_id' => $postavshik,
    'nomer_naklodnoy' => $nomer_naklodnoy,
    'data_postupleniya' => $data_info[2]."-".$data_info[1]."-".$data_info[0],
    'summa' => $summa,
    'valuta' => $valuta,
    'summa_tovarov' => $summa_tovarov ,
    'user_id' => $gl_session["session_data"]['user_id'],
  );

  $postuplenie_id = arg(1);
  $data_operaciya = array(
    'company_id' => $gl_session["session_data"]['company_id'],
    'operation' => 4,
    'created' => date('Y-m-d H:i:s') ,
    'user_id' => $gl_session["session_data"]['user_id'],
    'details' => $postuplenie_id,
  );
  $this->db->insert("activity",$data_operaciya);
  if($block_attr_table=="update"){
    $postuplenie_id = arg(1);
    $this->db->where("id",$postuplenie_id)->update("postuplenie",$data);

    $postuplenie_id = arg(1);
    $valuta = $this->get("valuta");


    $products = $this->db->where("postuplenie_id",$postuplenie_id)->get("postuplenie_tovarov")->result();

    for($i=0;$i<count($products);$i++){
      $tovar = $this->db->where("id",$products[$i]['tovar_id'])->get("products")->result();

      if($products[$i]['change_price']){

        $price_db = calc_price($products[$i]['price'],$valuta,$tovar[0]['currency']);

        $price = $price_db['price'];




        $this->db->where("id",$products[$i]['tovar_id'])->set("price",$price)->update("products");
      }
      $this->db->where("id",$products[$i]['tovar_id'])
        ->set("cnt +",$products[$i]['kolichestvo'])
        ->update("products");

      $data = array(
        'old_price' => $tovar[0]['price'],
        'old_count' => $tovar[0]['cnt'],
      );
      $this->db->where("id",$products[$i]['tovar_id'])->update("products", $data);

      $old_count = 0;
      $ostatki_info = $this->db->where("tovar_id",$products[$i]['tovar_id'])->get("products_ostatki")->result();
      if(count($ostatki_info)>0){
        $old_count = $ostatki_info[0]['kolichesctvo'];
        $this->db->where("tovar_id",$products[$i]['tovar_id'])->delete("products_ostatki");
      }
      $data = array(
        'tovar_id' => $products[$i]['tovar_id'],
        'sklad_id' => $products[$i]['sklad_id'],
        'kolichesctvo' => $products[$i]['kolichestvo'] + $old_count,
      );
      $this->db->insert("products_ostatki",$data);
      /*$this->db->where("id",$products[$i]['id'])->set("old_price",$tovar[0]['price'])->set("change_price",0)->update("postuplenie_tovarov");*/
    }

  }

  $redirect = $this->getVariable("redirect");
  if($redirect == 1){
    $this->redirect($this->l("postuplenie_update/{$postuplenie_id}"));
  }
  $this->redirect($this->l("postuplenie"));
}


$postavshiki = $this->db->get("postavshiki")->result();
$this->r_v("postavshiki",$postavshiki);
$products= $this->db->get("products")->result();
$this->r_v("products",$products);

if($block_attr_table=="update"){
  $postuplenie_id = arg(1);
  $table = create_table($postuplenie_id);
  $this->r_v("table",$table);
  $postuplenie = $this->db->where("id","$postuplenie_id")->get("postuplenie")->result();

  $info = explode(" ", $postuplenie[0]['data_postupleniya']);
  $info = explode("-", $info[0]);
  $postuplenie[0]['data_postupleniya'] = $info[2]."-".$info[1]."-".$info[0];
  $this->r_v("postuplenie",$postuplenie[0]);
}



$categories = array();
$categories_data = $this->db->where("parent_id",0)->order_by("name","asc")->get("categories")->result();
$this->r_v("categories_1",$categories_data);
for($z=0;$z<count($categories_data);$z++){
  $categories[$categories_data[$z]['id']] = $categories_data[$z]['name'];
  $sub_categories_data = $this->db->where("parent_id", $categories_data[$z]['id'])->order_by("name","asc")->get("categories")->result();
  for($z1=0;$z1<count($sub_categories_data);$z1++){
    $categories[$sub_categories_data[$z1]['id']] = "=>".$sub_categories_data[$z1]['name'];

    $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("name","asc")->get("categories")->result();
    for($z2=0;$z2<count($sub_categories_data1);$z2++){
      $categories[$sub_categories_data1[$z2]['id']] = "== =>".$sub_categories_data1[$z2]['name'];

      $sub_categories_data2 = $this->db->where("parent_id", $sub_categories_data1[$z2]['id'])->order_by("name","asc")->get("categories")->result();
      for($z3=0;$z3<count($sub_categories_data2);$z3++){
        $categories[$sub_categories_data2[$z3]['id']] = "== == =>".$sub_categories_data2[$z3]['name'];
      }
    }
  }
}
$this->r_v("categories",$categories);

$sklads = array();
$sklads_data = $this->db->where("parent_id",0)->order_by("name","asc")->get("sklads")->result();
for($z=0;$z<count($sklads_data);$z++){
  $sklads[$sklads_data[$z]['id']] = $sklads_data[$z]['name'];
  $sub_sklads_data = $this->db->where("parent_id", $sklads_data[$z]['id'])->order_by("name","asc")->get("sklads")->result();
  for($z1=0;$z1<count($sub_sklads_data);$z1++){
    $sklads[$sub_sklads_data[$z1]['id']] = "=>".$sub_sklads_data[$z1]['name'];

    $sub_sklads_data1 = $this->db->where("parent_id", $sub_sklads_data[$z1]['id'])->order_by("name","asc")->get("sklads")->result();
    for($z2=0;$z2<count($sub_sklads_data1);$z2++){
      $sklads[$sub_sklads_data1[$z2]['id']] = "== =>".$sub_sklads_data1[$z2]['name'];

      $sub_sklads_data2 = $this->db->where("parent_id", $sub_sklads_data1[$z2]['id'])->order_by("name","asc")->get("sklads")->result();
      for($z3=0;$z3<count($sub_sklads_data2);$z3++){
        $sklads[$sub_sklads_data2[$z3]['id']] = "== == =>".$sub_sklads_data2[$z3]['name'];
      }
    }
  }
}
$this->r_v("sklads",$sklads);

$valuta_info = $this->db->order_by("id", "desc")->limit(1)->get("kurc_valut")->result();
$this->r_v("valuta_info",$valuta_info[0]);

$valuty = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("currencies")->result();
$this->r_v("valuty",$valuty ); 
