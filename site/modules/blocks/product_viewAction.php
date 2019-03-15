<?php
  $this->db = new active_records();
$product_id = arg(1);

$this->r_v("block_attr",$block_attr_table);

if(arg(2) == "2"){
  $info = $this->db->where("id",$product_id)->get("order_products")->result();
  $session_data = $info[0]['session_data'];
  $session_data = unserialize($session_data);

  $product_id = $info[0]['product_id'];
  if($info[0]['old_product_id'] > 0){
    $product_id = $info[0]['old_product_id'];
  }
  $session_data = $session_data['cart'];

  //print_r($session_data);

  $gl_session["session_data"]['cart'][$product_id] = $session_data[$product_id];

  //print_r($session_data['cart'][$product_id]);
  //$session_data['product_prices'] = unserialize($info[0]['product_prices']);
}

//print_r($gl_session["session_data"]);
//exit;

$valyta = $this->get("valuty");
$valuta_change = $this->get("valuta_change");
if($this->isPost() && $valuta_change=="1") {
  $valyta = $this->get("valuty");
  $gl_session["session_data"]['valyta'] =  $valyta;
}

if($gl_session["session_data"]['valyta'] ==""){
  $gl_session["session_data"]['valyta'] = "UAH";
}

$images =  $this->db->where("product_id",$product_id)->order_by("number")->get("products_files")->result();
$this->r_v("images", $images);
$this->r_v("product_id", $product_id);

$only_review = arg(2);
$this->r_v("only_review", $only_review);

$do = $this->get("do");
if($this->isPost() && $do=="get_izdelie_options"){
  $izd_id = $this->get("izd_id");

  $data = "";
  $options = $this->db->where("products_id",$izd_id)->order_by("number")->get("products_options")->result();
  for($z=0;$z<count($options);$z++){
   
    $type = "text";
    if($options[$z]['products_type'] == 2){$type = "hidden";}
    $value = "value='".$gl_session["session_data"]['cart'][$product_id]['option'][$options[$z]['kod']]."'";
    if($options[$z]['products_type'] == 2){$value = "";}
    $data .= '<div style="margin-bottom: 15px;">'
      .' <b>'.$options[$z]['name'].':</b><br>'
      .' <input name="'.$options[$z]['kod'].']" type="'.$type.'"'.$value.'>'
      .'</div>';
  }
  echo json_encode(array(
    "data" => $data
  ));
  exit();
}

if($this->isPost() && $do=="get_price"){
  $id_product = $this->get("id_product");
  $cur_tovar = $this->db->where("id",$id_product)->get("products")->result();


 
  $category_1 = $this->db->where("id",$cur_tovar[0]['category_id'])->get("categories")->result();
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

  $price=  calc_price( $cur_tovar[0]['price']+ $cur_tovar[0]['price']*$nacenka/100, $cur_tovar[0]['currency'],$gl_session["session_data"]['valyta']);


  $view_price = "Цена: ".$price['view'];

  $images =  $this->db->where("product_id",$id_product)->order_by("number")->get("products_files")->result();
  $image_preview = "";
  if(count($images)>0){
    $image_preview = "<a target='__blank' href='".main_img_domain."product_view/{$id_product}.html'><img width='40' src='".images_path."{$id_product}/{$images[0]['name']}'></a>";
  }
  echo json_encode(
    array(
      "price" =>  $price['price'],
      "view_price" =>$view_price.$image_preview
    )
  );
  exit();

}

if($this->isPost() && $do=="get_category"){
  $category_id = $this->get("category_id");
  if($category_id < 1){
    echo json_encode(array(
      "data" => ""
    ));
    exit();
  }

  $data = "";
  $categories_info = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("id", $category_id)->order_by("nomer","asc")->get("izdelie_categories")->result();
  if($categories_info[0]['categories_izdelie_sklad'] > 0){
    $products = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("category_id", $categories_info[0]['categories_izdelie_sklad'])->order_by("id", "asc")->get("products")->result();

    $data .= '<b>'.$categories_info[0]['name'].':</b><span class="price_tov"></span><br>'
      .'<select class="products" name="product['.$categories_info[0]['id'].'][]">'
      .' <option value="0">Выберите продукт</option>';


    for($z1=0;$z1<count($products);$z1++){
      /*$product_id = arg(1);*/
      $selected = "";
      if($gl_session["session_data"]['cart'][$product_id]['product'][$categories_info[0]['id']][0] == $products[$z1]['id']){
        $selected = "selected";
      }
     $products[$z1]['price'] = calc_price( $products[$z1]['price'], $products[$z1]['currency'],$gl_session["session_data"]['valyta']);
      $data .= ' <option '.$selected.' price="'.$products[$z1]['price'].'" value="'.$products[$z1]['id'].'">'.$products[$z1]['name'].'</option>';
    }

    $data .= '</select>';
  }


  $izdeliya = $this->db->where("izdelie_categories_id",$categories_info[0]['id'])->get("products")->result();

  if(count($izdeliya) > 0){
    $data .= '<br><b>Выберите Изделие:</b><br>'
      .'<select class="category_izdelia" name="izdelie[]">'
      .' <option value="0">Выберите изделие</option>';

   

    /*$product_id = arg(1);*/

    for($z1=0;$z1<count($izdeliya);$z1++){

      $selected = "";
      for($z2=0;$z2<count($gl_session["session_data"]['cart'][$product_id]['izdelie']);$z2++){
        if($gl_session["session_data"]['cart'][$product_id]['izdelie'][$z2] == $izdeliya[$z1]['id']){
          $selected = "selected";
        }
      }

      $data .= ' <option '.$selected.'  value="'.$izdeliya[$z1]['id'].'">'.$izdeliya[$z1]['name'].'</option>';
    }

    $data .= '</select>';
  }


  $categories_data = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->order_by("nomer","asc")->where("parent_id", $category_id)->get("izdelie_categories")->result();
  if(count($categories_data) > 0){
    /*$product_id = arg(1);*/
    if($categories_info[0]['type'] == 0){
      $data .= '<br><b>'.$categories_info[0]['name'].':</b><br>'
        .'<select class="category" name="category[]">'
        .' <option value="0">Выберите категорию</option>';
      for($z=0;$z<count($categories_data);$z++){
        $selected = "";
        for($z2=0;$z2<count($gl_session["session_data"]['cart'][$product_id]['category']);$z2++){
          if($gl_session["session_data"]['cart'][$product_id]['category'][$z2] == $categories_data[$z]['id']){
            $selected = "selected";
          }
        }
        $data .= ' <option '.$selected.' value="'.$categories_data[$z]['id'].'">'.$categories_data[$z]['name'].'</option>';
      }
      $data .= '</select><div></div>';
    }else{
      for($z=0;$z<count($categories_data);$z++){
        $categories_data1[$z]['cat'] = $this->db->where("parent_id",$categories_data[$z]['id'])->order_by("nomer","asc")->get("izdelie_categories")->result();

        $data .= '<br><b>'.$categories_data[$z]['name'].':</b><br>';
        $data .= '<select class="category" name="category[]">'
          .' <option value="0">Выберите категорию</option>';

          for($z1=0;$z1<count($categories_data1[$z]['cat']);$z1++){

        $selected = "";
        for($z2=0;$z2<count($gl_session["session_data"]['cart'][$product_id]['category']);$z2++){
          if($gl_session["session_data"]['cart'][$product_id]['category'][$z2] == $categories_data1[$z]['cat'][$z1]['id']){
            $selected = "selected";
          }
        }
          $data .= ' <option '.$selected.' value="'.$categories_data1[$z]['cat'][$z1]['id'].'">'.$categories_data1[$z]['cat'][$z1]['name'].'</option>';
        }
        $data .= '</select><div></div>';
      }
    }
  }

  echo json_encode(array(
    "data" => $data,
	"new_price" => $new_price
  ));
  exit();
}

if($this->isPost() && $do=="get_total_price"){
	$product_cnt = $this->get("product_cnt");
	$price_product = $this->get("price_product");
	$price_product = str_replace(' ','',$price_product);
	$category = $this->get("category");
	$izdelie = $this->get("izdelie");
	$product= $this->get("product");
	$option= $this->get("option");

	$cart_ses[$product_id] = array('id'=>$product_id, 'qty'=>$product_cnt , 'price'=> $price_product,'category'=> $category,'izdelie'=> $izdelie,'product'=> $product,'link_edit'=> $link_edit,'link_delete_cart'=> $link_delete_cart, 'link_view_tovar'=>$link_view_tovar,'option'=>$option,'valuta'=>$gl_session["session_data"]['valyta']);

	$info = generate_review_and_price($cart_ses, $product_id,0,0);

	if($gl_session["session_data"]['type_cart'] == 2){
		$rozn_total = $info['total'];
	}
	if($gl_session["session_data"]['type_cart'] == 1){
		$rozn_total = $info['rozn_total'];
	}
	
	echo ($product_cnt * $rozn_total);
	system_stop();
}

/*$product_id = arg(1);*/
$product_db = $this->db->where("id",$product_id)->get("products")->result();
$info = calc_price($product_db[0]['price'], $product_db[0]['currency'],$gl_session["session_data"]['valyta']);

$category_1 = $this->db->where("id",$product_db[0]['category_id'])->get("categories")->result();
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
  $info_2 = calc_price($product_db[0]['price'] +$product_db[0]['price']*$nacenka/100, $product_db[0]['currency'],$gl_session["session_data"]['valyta']);

$product_db[0]['view_price'] = "<div style='margin-left: 110px;'>".$info['view']."</div>";
$product_db[0]['view_roznica'] = "<div style='margin-left: 110px;'>".$info_2['view']."</div>";
$product_db[0]['price'] = $info_2['price'];

if($product_db[0]['session_data'] != ""){
  $session_data = $product_db[0]['session_data'];
  $session_data = unserialize($session_data);

  $session_data = $session_data['cart'];
  $main_tovar_id = $product_db[0]['old_product_id'];
  $info = generate_review_and_price($session_data, $main_tovar_id,0,0);

  $this->r_v("product_info_html",$info['html_page']);
}


//Вставка YouTube
if(preg_match_all("~{youtube}(.*){/youtube}~",$product_db[0]['description'],$preg))
{
	for($i = 0; $i < count($preg[1]); $i++)
	{
		$replace = "<iframe width='420' height='315' src='//www.youtube.com/embed/".$preg[1]["$i"]."' frameborder='0' allowfullscreen></iframe>";
		$product_db[0]['description'] = str_replace($preg[0]["$i"], $replace, $product_db[0]['description']);
	}	
}
//Вставка YouTube

$this->r_v("product_info",$product_db[0]);
$add_cart = $this->get("add_cart");
if($add_cart == 1){
  $product_cnt = $this->get("product_cnt");
  $price_product = $this->get("price_product");
  $price_product = str_replace(' ','',$price_product);
  $category = $this->get("category");
  $izdelie = $this->get("izdelie");
  $product= $this->get("product");
  $option= $this->get("option");
  $link_edit = $this->l("edit_cart/".$product_id);
  $link_delete_cart = $this->l("delete_cart/".$product_id);
  $link_view_tovar = $this->l("view_tovar/".$product_id);
  //echo "<script>alert($price_product);</script>";
  $gl_session["session_data"]['cart'][$product_id] = array('id'=>$product_id, 'qty'=>$product_cnt , 'price'=> $price_product,'category'=> $category,'izdelie'=> $izdelie,'product'=> $product,'link_edit'=> $link_edit,'link_delete_cart'=> $link_delete_cart, 'link_view_tovar'=>$link_view_tovar,'option'=>$option,'valuta'=>$gl_session["session_data"]['valyta']);
	
  if(arg(2) == "2"){
  
    $info = $this->db->where("id",arg(1))->get("order_products")->result();

    $session_data = $info[0]['session_data'];
    $session_data = unserialize($session_data);

    $product_id = $info[0]['product_id'];
    if($info[0]['old_product_id'] > 0){
      $product_id = $info[0]['old_product_id'];
    }
    $session_data['cart'][$product_id] = $gl_session["session_data"]['cart'][$product_id];
    $session_data = serialize($session_data);

    $this->db->where("id",arg(1))->set("session_data", $session_data)->update("order_products");

    $order_id = $info[0]['order_id'];
    $order_details = $this->db->where("id", $order_id)->get("orders")->result();

    /*re calc product price*/
    $product = $this->db->where("id",$product_id)->get("products")->result();
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

    $client_info = $this->db->where("id",$order_details[0]['client_id'])->get("clients")->result();
    $skidka_info = $this->db->where("id",$client_info[0]['skidka_id'])->get("skidki")->result();

    $torgovaya_tockka_info = $this->db->where("id",$order_details[0]['torgovaya_tochka_id'])->get("torgovye_tochki")->result();
    $office_skidka_info = $this->db->where("id",$torgovaya_tockka_info[0]['skidka_id'])->get("skidki")->result();

    $data_product = array();
    if($product[0]['izdelie']==1){

      $info = generate_review_and_price($gl_session["session_data"]['cart'], $product_id,0,0);
      $rozn_total = $info['rozn_total'];

      $data_product = array(
        'order_id' => $order_id,
        'kolichestvo' => 1,
        'price' => $rozn_total,
        'price_skidka' => $rozn_total * $skidka_info[0]['percent'] / 100,
        'price_ofice_skidka' => $rozn_total * $office_skidka_info[0]['percent'] / 100,
        'price_total' =>$rozn_total - $rozn_total * $skidka_info[0]['percent'] / 100,
        'product_id' => $product_id,
        'session_data' => serialize($gl_session["session_data"]),
        'product_prices' => serialize($info['product_prices']),
      );
      /*for($z=0;$z<$gl_session["session_data"]['cart'][$product_id]['qty'];$z++){*/
      $this->db->where("id",arg(1))->update("order_products",$data_product);

    }
    if($product[0]['izdelie']!=1){
      $info = generate_review_and_price($gl_session["session_data"]['cart'], $product_id,0,0);

      $data_product = array(
        'order_id' => $order_id,
        'kolichestvo' => $gl_session["session_data"]['cart'][$tovar['id']]['qty'],
        'price' => $price_current['price'],
        'price_skidka' => $price_current['price'] * $skidka_info[0]['percent'] / 100,
        'price_ofice_skidka' => $price_current['price'] * $office_skidka_info[0]['percent'] / 100,
        'price_total' => $price_current['price'] - $gl_session["session_data"]['cart'][$product_id]['qty'] * $price_current['price'] * $skidka_info[0]['percent'] / 100,
        'product_id' => $product_id,
        'session_data' => $product[0]['session_data'],
        'old_product_id' => $product[0]['old_product_id'],
        'product_prices' => serialize($info['product_prices']),
      );
      $this->db->where("id",arg(1))->update("order_products",$data_product);
    }


   /*re calc order price*/
   $order_products = $this->db->where("order_id", $order_id)->get("order_products")->result();
   $amount = 0;
   $skidka_client = 0;
   $skidka_office = 0;
   for($m=0;$m<count($order_products);$m++){
     $amount += $order_products[$m]['price'];
     $skidka_client += $order_products[$m]['price_skidka'];
     $skidka_office += $order_products[$m]['price_ofice_skidka'];
   }

  $this->db->where("id", $order_id)->update("orders", array("summa"=>$amount, "skidka_amount"=>$skidka_client, "skidka_office_amount"=>$skidka_office));



    $this->redirect($this->l("order_view/{$order_id}"));
    exit;
  }

  if($gl_session["session_data"]['type_cart'] != 2){
    $this->r_v("status","<h2>Товар успешно добавлен в корзину</h2>");
  }

  if($gl_session["session_data"]['type_cart'] == 2){
    $this->r_v("status","<h2>Товар успешно добавлен в заявку</h2>");
  }
  $this->redirect($this->l("products_list"));
}


$this->r_v("cart_count",count($gl_session["session_data"]['cart']));
$cart = $this->l("cart");
$this->r_v("cart_link",$cart);
$this->r_v("rand_num",rand());
$izdelie_id = $product_id;
$categories_data = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id", 0)->where("izdelie_id",$izdelie_id)->order_by("nomer","asc")->get("izdelie_categories")->result();

for($i=0;$i<count($categories_data);$i++){
  $categories_data[$i]['options'] = $this->db->where("parent_id",$categories_data[$i]['id'])->order_by("nomer","asc")->get("izdelie_categories")->result();
  for($i1=0;$i1<count($categories_data[$i]['options']);$i1++){
    $categories_data[$i]['options'][$i1]['cat'] = $this->db->where("parent_id",$categories_data[$i]['options'][$i1]['id'])->order_by("nomer","asc")->get("izdelie_categories")->result();
  }
  $categories_data[$i]['izdeliya'] = $this->db->where("izdelie_categories_id",$categories_data[$i]['id'])->get("products")->result();
  if($categories_data[$i]['categories_izdelie_sklad'] > 0){
    $category_id = $categories_data[$i]['categories_izdelie_sklad'];
    $category_list = generate_categories_list($category_id);
    if(!empty($category_list)) $category_list = ", ".$category_list;
    $category_list = $category_id.$category_list;

    $categories_data[$i]['products'] = $this->db->where_in("category_id",$categories_data[$i]['categories_izdelie_sklad'])->get("products")->result();
  }
}

$this->r_v("categories_data", $categories_data);
$options_db = $this->db->where("products_id",$izdelie_id)->order_by("number")->get("products_options")->result();
$this->r_v("options_db", $options_db);
$this->r_v("type_action",$block_attr_do);
/*$product_id = arg(1);*/
$this->r_v("cart_tovar",$gl_session["session_data"]['cart'][$product_id]);
$this->r_v("cnt_category",count($gl_session["session_data"]['cart'][$product_id]['category']));
$this->r_v("cnt_izdelie",count($gl_session["session_data"]['cart'][$product_id]['izdelie']));
$this->r_v("cnt_product",count($gl_session["session_data"]['cart'][$product_id]['product']));

$html_option = "";
if(count($options_db)>0){
  foreach($options_db as $opt=>$option){
    $value = 'value="'.$gl_session["session_data"]['cart'][$product_id]['option'][$option['kod']].'"';

    $type = "text";
    if($option['products_type'] == 2){
      $type = "hidden";
      $value = "";
    }

    $html_option.= '<div style="margin-bottom: 15px;">
     <b>'.$option['name'].'</b><br>
     <input name="option['.$option['kod'].']" type="'.$type.'" '.$value.'>
   </div>';
  }
}
$this->r_v("html_option",$html_option);


$valuty = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("currencies")->result();
$this->r_v("valuty",$valuty );
$tovar_update = $this->l("products_update/".$product_id);
$this->r_v("tovar_update",$tovar_update);
$tovar_delete = $this->l("products_delete/".$product_id);
$this->r_v("tovar_delete",$tovar_delete); 
