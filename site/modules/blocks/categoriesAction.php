<?php
  $this->db = new active_records();
   
$this->db->where("parent_id",0)->where("company_id",$gl_session["session_data"]['company_id']);
$search_by_categories = $gl_session["session_data"]['product_categories'];
$type_post = $this->get("type");




if ($this->isPost() && $type_post != "change_category") {
  $search_by_categories = $this->get("categories");
  $gl_session["session_data"]['product_categories'] = $search_by_categories;
  $gl_session["session_data"]['product_category_1'] =  $this->get("categories_1");
  $gl_session["session_data"]['product_category_2'] =  $this->get("categories_2");
  $gl_session["session_data"]['product_category_3'] =  $this->get("categories_3");
  $gl_session["session_data"]['product_category_4'] =  $this->get("categories_4");
}

if ($gl_session["session_data"]['product_category_1'] != "" && $gl_session["session_data"]['product_category_1'] != "0"){
  $this->db->where_in("id", $gl_session["session_data"]['product_category_1']);
}

$order_as = $this->get("order_as");
$order_by_column = $this->get("order_by_column");

if($this->isPost()){
  $gl_session["session_data"]['category_order_by_column'] = $order_by_column;
  $gl_session["session_data"]['category_order_as'] = $order_as;
}

if($gl_session["session_data"]['category_order_by_column'] != ""  && $gl_session["session_data"]['category_order_as'] != ""){
  $this->db->order_by($gl_session["session_data"]['category_order_by_column'], $gl_session["session_data"]['category_order_as']);
}

 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $categories = $this->db->select("categories.nacenka as categories_nacenka, categories.name as categories_name, categories.id as categories_id, categories.nacenka as categories_nacenka, categories.name as categories_name, categories.id as categories_id, categories.min_zakaz as categories_min_zakaz, categories.min_zakaz as categories_min_zakaz, categories.sred_zakaz as categories_sred_zakaz, categories.sred_zakaz as categories_sred_zakaz, categories.max_zakaz as categories_max_zakaz, categories.max_zakaz as categories_max_zakaz")->limit(100,($page_num-1)*100)->get("categories", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("categories")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"category_edit", "id"=>"categories_id", "num"=>"0", "label"=>"edit", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"category_delete", "id"=>"categories_id", "num"=>"0", "label"=>"delete", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"category_upload", "id"=>"categories_id", "num"=>"0", "label"=>"upload", "html"=>"", "ajax"=>"0"); 
 $categories = $this->prepare_actions_list($categories,$urls_list); 

   $this->r_v("categories_create_link", $this->l("category_create"));

 $navigation = $this->navigation("categories","categories", $items_count, 100,$page_navigation_url_prefix, $page_navigation_url_num); 




$old_categories = $categories;
$categories_all = array();
$category_id = arg(1);

for($z=0;$z<count($old_categories);$z++){
  $categories_all[] = $old_categories[$z];

  if($gl_session["session_data"]['product_category_2'] > 0){
    $this->db->where("id",$gl_session["session_data"]['product_category_2']);
  }

  $sub_categories_data = $this->db->where("parent_id", $old_categories[$z]['categories_id'])->order_by("name","asc")->get("categories")->result();
  for($z1=0;$z1<count($sub_categories_data);$z1++){
    $num = count($categories_all);
    $categories_all[$num]['categories_id'] = $sub_categories_data[$z1]['id'];

    $category_db = $sub_categories_data[$z1];
    $category_db_min = $sub_categories_data[$z1];
    $category_db_sred = $sub_categories_data[$z1];
    $category_db_max = $sub_categories_data[$z1];
    $cat_status = 0;            //статус для определения свою или родительскую наценку подгружать. Для заказов аналогично
    $cat_status_min = 0;
    $cat_status_sred = 0;
    $cat_status_max = 0;
    if($category_db['nacenka']=="0" || $category_db['nacenka']==""){
      $cat_status = 1;
      $category_db = $this->db->where("id",$category_db['parent_id'])->get("categories")->result();
    }

    if($category_db_min['min_zakaz']=="0" || $category_db_min['min_zakaz']==""){
      $cat_status_min = 1;
      $category_db_min = $this->db->where("id",$category_db_min['parent_id'])->get("categories")->result();
    }

    if($category_db_sred['sred_zakaz']=="0" || $category_db_sred['sred_zakaz']==""){
      $cat_status_sred = 1;
      $category_db_sred = $this->db->where("id",$category_db_sred['parent_id'])->get("categories")->result();
    }

    if($category_db_max['max_zakaz']=="0" || $category_db_max['max_zakaz']==""){
      $cat_status_max = 1;
      $category_db_max = $this->db->where("id",$category_db_max['parent_id'])->get("categories")->result();
    }
    $categories_all[$num]['categories_name'] = "=>".$sub_categories_data[$z1]['name'];
    $categories_all[$num]['categories_sred_zakaz'] = $sub_categories_data[$z1]['sred_zakaz'];
    $categories_all[$num]['categories_max_zakaz'] = $sub_categories_data[$z1]['max_zakaz'];

    if($cat_status_max == 0){
      $categories_all[$num]['categories_max_zakaz'] = $category_db_max['max_zakaz'];
    }
    if($cat_status_max == 1){
      $categories_all[$num]['categories_max_zakaz'] = $category_db_max[0]['max_zakaz'];
    }

    if($cat_status_sred == 0){
      $categories_all[$num]['categories_sred_zakaz'] = $category_db_sred['sred_zakaz'];
    }
    if($cat_status_sred == 1){
      $categories_all[$num]['categories_sred_zakaz'] = $category_db_sred[0]['sred_zakaz'];
    }
    if($cat_status_min == 0){
      $categories_all[$num]['categories_min_zakaz'] = $category_db_min['min_zakaz'];
    }
    if($cat_status_min == 1){
      $categories_all[$num]['categories_min_zakaz'] = $category_db_min[0]['min_zakaz'];
    }
    if($cat_status == 0){
      $categories_all[$num]['categories_nacenka'] = $category_db['nacenka'];
    }
    if($cat_status == 1){
      $categories_all[$num]['categories_nacenka'] = $category_db[0]['nacenka'];
    }

    if($gl_session["session_data"]['product_category_3'] > 0){
      $this->db->where("id",$gl_session["session_data"]['product_category_3']);
    }
    $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("name","asc")->get("categories")->result();
    for($z2=0;$z2<count($sub_categories_data1);$z2++){
      $num = count($categories_all);
      $categories_all[$num]['categories_id'] = $sub_categories_data1[$z2]['id'];


      $category_db = $sub_categories_data1[$z2];
      $category_db_min = $sub_categories_data1[$z2];
      $category_db_sred = $sub_categories_data1[$z2];
      $category_db_max = $sub_categories_data1[$z2];
      $cat_status = 0;            //статус для определения свою или родительскую наценку подгружать. Для заказов аналогично
      $cat_status_min = 0;
      $cat_status_sred = 0;
      $cat_status_max = 0;

      if($category_db_min['min_zakaz']=="0" || $category_db_min['min_zakaz']==""){
        $cat_status_min = 1;
        $category_db_min = $this->db->where("id",$category_db_min['parent_id'])->get("categories")->result();
        if($category_db_min[0]['min_zakaz']=="0" || $category_db_min[0]['min_zakaz']==""){
          $category_db_min = $this->db->where("id",$category_db_min[0]['parent_id'])->get("categories")->result();
        }
      }

      if($category_db_sred['sred_zakaz']=="0" || $category_db_sred['sred_zakaz']==""){
        $cat_status_sred = 1;
        $category_db_sred = $this->db->where("id",$category_db_sred['parent_id'])->get("categories")->result();
        if($category_db_sred[0]['sred_zakaz']=="0" || $category_db_sred[0]['sred_zakaz']==""){
          $category_db_sred = $this->db->where("id",$category_db_sred[0]['parent_id'])->get("categories")->result();
        }
      }

      if($category_db_max['max_zakaz']=="0" || $category_db_max['max_zakaz']==""){
        $cat_status_max = 1;
        $category_db_max = $this->db->where("id",$category_db_max['parent_id'])->get("categories")->result();
        if($category_db_max[0]['max_zakaz']=="0" || $category_db_max[0]['max_zakaz']==""){
          $category_db_max = $this->db->where("id",$category_db_max[0]['parent_id'])->get("categories")->result();
        }
      }

      if($category_db['nacenka']=="0" || $category_db['nacenka']=="" ){
        $cat_status = 1;
        $category_db = $this->db->where("id",$category_db['parent_id'])->get("categories")->result();
        if($category_db[0]['nacenka']=="0" || $category_db[0]['nacenka']==""){
          $category_db = $this->db->where("id",$category_db[0]['parent_id'])->get("categories")->result();
        }
      }

      $categories_all[$num]['categories_name'] = "== =>".$sub_categories_data1[$z2]['name'];
      if($cat_status_max == 0){
        $categories_all[$num]['categories_max_zakaz'] = $category_db_max['max_zakaz'];
      }
      if($cat_status_max == 1){
        $categories_all[$num]['categories_max_zakaz'] = $category_db_max[0]['max_zakaz'];
      }

      if($cat_status_sred == 0){
        $categories_all[$num]['categories_sred_zakaz'] = $category_db_sred['sred_zakaz'];
      }
      if($cat_status_sred == 1){
        $categories_all[$num]['categories_sred_zakaz'] = $category_db_sred[0]['sred_zakaz'];
      }
      if($cat_status_min == 0){
        $categories_all[$num]['categories_min_zakaz'] = $category_db_min['min_zakaz'];
      }
      if($cat_status_min == 1){
        $categories_all[$num]['categories_min_zakaz'] = $category_db_min[0]['min_zakaz'];
      }
      if($cat_status == 0){
        $categories_all[$num]['categories_nacenka'] = $category_db['nacenka'];
      }
      if($cat_status == 1){
        $categories_all[$num]['categories_nacenka'] = $category_db[0]['nacenka'];
      }
      if($gl_session["session_data"]['product_category_4'] > 0){
        $this->db->where("id",$gl_session["session_data"]['product_category_4']);
      }
      $sub_categories_data2 = $this->db->where("parent_id", $sub_categories_data1[$z2]['id'])->order_by("name","asc")->get("categories")->result();
      for($z3=0;$z3<count($sub_categories_data2);$z3++){
        $num = count($categories_all);
        $categories_all[$num]['categories_id'] = $sub_categories_data2[$z3]['id'];
        $category_db = $sub_categories_data2[$z3];
        $category_db_min = $sub_categories_data2[$z3];
        $category_db_sred = $sub_categories_data2[$z3];
        $category_db_max = $sub_categories_data2[$z3];
        $cat_status = 0;            //статус для определения свою или родительскую наценку подгружать. Для заказов аналогично
        $cat_status_min = 0;
        $cat_status_sred = 0;
        $cat_status_max = 0;

        if($category_db_min['min_zakaz']=="0" || $category_db_min['min_zakaz']==""){
          $cat_status_min = 1;
          $category_db_min = $this->db->where("id",$category_db_min['parent_id'])->get("categories")->result();
          if($category_db_min[0]['min_zakaz']=="0" || $category_db_min[0]['min_zakaz']==""){
            $category_db_min = $this->db->where("id",$category_db_min[0]['parent_id'])->get("categories")->result();
            if($category_db_min[0]['min_zakaz']=="0" || $category_db_min[0]['min_zakaz']==""){
              $category_db_min = $this->db->where("id",$category_db_min[0]['parent_id'])->get("categories")->result();
            }
          }
        }

        if($category_db_sred['sred_zakaz']=="0" || $category_db_sred['sred_zakaz']==""){
          $cat_status_sred = 1;
          $category_db_sred = $this->db->where("id",$category_db_sred['parent_id'])->get("categories")->result();
          if($category_db_sred[0]['sred_zakaz']=="0" || $category_db_sred[0]['sred_zakaz']==""){
            $category_db_sred = $this->db->where("id",$category_db_sred[0]['parent_id'])->get("categories")->result();
            if($category_db_sred[0]['sred_zakaz']=="0" || $category_db_sred[0]['sred_zakaz']==""){
              $category_db_sred = $this->db->where("id",$category_db_sred[0]['parent_id'])->get("categories")->result();
            }
          }
        }

        if($category_db_max['max_zakaz']=="0" || $category_db_max['max_zakaz']==""){
          $cat_status_max = 1;
          $category_db_max = $this->db->where("id",$category_db_max['parent_id'])->get("categories")->result();
          if($category_db_max[0]['max_zakaz']=="0" || $category_db_max[0]['max_zakaz']==""){
            $category_db_max = $this->db->where("id",$category_db_max[0]['parent_id'])->get("categories")->result();
            if($category_db_max[0]['max_zakaz']=="0" || $category_db_max[0]['max_zakaz']==""){
              $category_db_max = $this->db->where("id",$category_db_max[0]['parent_id'])->get("categories")->result();
            }
          }
        }

        if($category_db['nacenka']=="0" || $category_db['nacenka']==""){
          $cat_status = 1;
          $category_db = $this->db->where("id",$category_db['parent_id'])->get("categories")->result();
          if($category_db[0]['nacenka']=="0" || $category_db[0]['nacenka']==""){
            $category_db = $this->db->where("id",$category_db[0]['parent_id'])->get("categories")->result();
            if($category_db[0]['nacenka']=="0" || $category_db[0]['nacenka']==""){
              $category_db = $this->db->where("id",$category_db[0]['parent_id'])->get("categories")->result();
            }
          }
        }
        $categories_all[$num]['categories_name'] = "== == =>".$sub_categories_data2[$z3]['name'];
        if($cat_status_max == 0){
          $categories_all[$num]['categories_max_zakaz'] = $category_db_max['max_zakaz'];
        }
        if($cat_status_max == 1){
          $categories_all[$num]['categories_max_zakaz'] = $category_db_max[0]['max_zakaz'];
        }

        if($cat_status_sred == 0){
          $categories_all[$num]['categories_sred_zakaz'] = $category_db_sred['sred_zakaz'];
        }
        if($cat_status_sred == 1){
          $categories_all[$num]['categories_sred_zakaz'] = $category_db_sred[0]['sred_zakaz'];
        }
        if($cat_status_min == 0){
          $categories_all[$num]['categories_min_zakaz'] = $category_db_min['min_zakaz'];
        }
        if($cat_status_min == 1){
          $categories_all[$num]['categories_min_zakaz'] = $category_db_min[0]['min_zakaz'];
        }

        if($cat_status == 0){
          $categories_all[$num]['categories_nacenka'] = $category_db['nacenka'];
        }
        if($cat_status == 1){
          $categories_all[$num]['categories_nacenka'] = $category_db[0]['nacenka'];
        }
      }
    }
  }
}

$categories = $this->prepare_actions_list($categories_all, $urls_list);

for($z=0;$z<count($categories);$z++){
  $categories_sum_zakazov = $this->db->select_sum('order_products.price', 'summa')->where("categories.id", $categories[$z]['categories_id'])->where("categories.id", "products.category_id", 1)->where("products.id", "order_products.product_id", 1)->get('order_products, products, categories')->result();
  $categories[$z]['categories_sum_zakazov'] = number_format($categories_sum_zakazov[0]['summa'],2,".",",");
}

$type_post = $this->get("type");

if ($this->isPost() && $type_post == "change_category") {
  $category_id = $this->get("category_id");
  $category_ = $this->db->where("parent_id", $category_id)->get('categories')->result();
  $select = "<option value='0'>Выберите тип категории</option>";
  if (is_array($category_) && $category_id != 0) {
    for ($i = 0; $i < count($category_); $i++) {
      $selected = "";
      if($category_[$i]['id'] == $gl_session["session_data"]['product_category_2'] || $category_[$i]['id'] == $gl_session["session_data"]['product_category_3']  || $category_[$i]['id'] == $gl_session["session_data"]['product_category_4'] ){
         $selected = "selected";
     }
      $select.= "<option ".$selected." value='" . $category_[$i]['id'] ."' >" . $category_[$i]['name']."</option>";
    }
  }

  echo json_encode(array(
    "select" => $select,
  ));
  exit();
}

$categories_1 = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id", 0)->order_by("name", "asc")->get("categories")->result();
$this->r_v("categories_1", $categories_1);

$categories_main_all = array();
$categories_data = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id", 0)->order_by("name", "asc")->get("categories")->result();

for ($z = 0; $z < count($categories_data); $z++) {
  $selected = 0;
  if ($gl_session["session_data"]['product_categories_list'][$categories_data[$z]['id']] == 1) $selected = 1;
  $categories_main_all[$categories_data[$z]['id']] = array(
    'id' => $categories_data[$z]['id'],
    "name" => $categories_data[$z]['name'],
    'selected' => $selected
  );
  $sub_categories_data = $this->db->where("parent_id", $categories_data[$z]['id'])->order_by("name", "asc")->get("categories")->result();
  for ($z1 = 0; $z1 < count($sub_categories_data); $z1++) {
    $selected = 0;
    if ($gl_session["session_data"]['product_categories_list'][$sub_categories_data[$z1]['id']] == 1) $selected = 1;
    $categories_main_all[$sub_categories_data[$z1]['id']] = array(
      'id' => $sub_categories_data[$z1]['id'],
      "name" => "=>" . $sub_categories_data[$z1]['name'],
      'selected' => $selected
    );
    $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("name", "asc")->get("categories")->result();
    for ($z2 = 0; $z2 < count($sub_categories_data1); $z2++) {
      $selected = 0;
      if ($gl_session["session_data"]['product_categories_list'][$sub_categories_data1[$z2]['id']] == 1) $selected = 1;
      $categories_main_all[$sub_categories_data1[$z2]['id']] = array(
        'id' => $sub_categories_data1[$z2]['id'],
        "name" => "== =>" . $sub_categories_data1[$z2]['name'],
        'selected' => $selected
      );
      $sub_categories_data2 = $this->db->where("parent_id", $sub_categories_data1[$z2]['id'])->order_by("name", "asc")->get("categories")->result();
      for ($z3 = 0; $z3 < count($sub_categories_data2); $z3++) {
        $selected = 0;
        if ($gl_session["session_data"]['product_categories_list'][$sub_categories_data2[$z3]['id']] == 1) $selected = 1;
        $categories_main_all[$sub_categories_data2[$z3]['id']] = array(
          'id' => $sub_categories_data2[$z3]['id'],
          "name" => "== == =>" . $sub_categories_data2[$z3]['name'],
          'selected' => $selected
        );
      }
    }
  }
}

$this->r_v("categories_main_all", $categories_main_all); 
 $this->r_v("categories",$categories); 
