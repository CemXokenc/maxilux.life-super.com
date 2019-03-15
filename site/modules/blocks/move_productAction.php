<?php
  $this->db = new active_records();
$type_post = $this->get("type");
if($this->isPost() && $type_post=="move_tovar"){
  $sklad_1 = $this->get("sklad_1");
  $sklad_2 = $this->get("sklad_2");
  $cnt = $this->get("cnt");
  $tovar_id = $this->get("tovar_id");
  $ostatok = $this->db->where("tovar_id",$tovar_id)->where("sklad_id",$sklad_2)->get("products_ostatki")->result();   //проверяем есть ли товар на втором складе
  if(count($ostatok)>0){
         $this->db->where("tovar_id",$tovar_id)->where("sklad_id",$sklad_2)->set('kolichesctvo +',$cnt)->update("products_ostatki");
         $this->db->where("tovar_id",$tovar_id)->where("sklad_id",$sklad_1)->set('kolichesctvo -',$cnt)->update("products_ostatki");
  }
  else{
    $data = array(
    'tovar_id' => $tovar_id,
    'sklad_id' => $sklad_2,
    'kolichesctvo' => $cnt,
    );
         $this->db->insert("products_ostatki",$data);
         $this->db->where("tovar_id",$tovar_id)->where("sklad_id",$sklad_1)->set('kolichesctvo -',$cnt)->update("products_ostatki");
   }
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
  $sklad_1 = $this->get("sklad_1");
  $sklad_2 = $this->get("sklad_2");
  $sklad1_arr = $this->db->where('tovar_id',$tovar_id)->where('sklad_id',$sklad_1)->get("products_ostatki")->result();
  $sklad2_arr = $this->db->where('tovar_id',$tovar_id)->where('sklad_id',$sklad_2)->get("products_ostatki")->result();
  if(count($sklad1_arr)<1){$sklad1_arr[0]['kolichesctvo']=0;}
  if(count($sklad2_arr)<1){$sklad2_arr[0]['kolichesctvo']=0;}
  echo json_encode(array(
    "sklad_1_cnt" => $sklad1_arr[0]['kolichesctvo'],
    "sklad_2_cnt" => $sklad2_arr[0]['kolichesctvo'],
  ));
  exit();
}

if($this->isPost() && $type_post=="sklad"){
  $tovar_id = $this->get("tovar_id");
  $sklad = $this->get("sklad");
  $sklad_arr = $this->db->where('tovar_id',$tovar_id)->where('sklad_id',$sklad)->get("products_ostatki")->result();
  if(count($sklad_arr)<1){$sklad_arr[0]['kolichesctvo']=0;}
  echo json_encode(array(
    "sklad_cnt" => $sklad_arr[0]['kolichesctvo'],
  ));
  exit();
}

$categories = array();
$categories_data = $this->db->where("parent_id",0)->where("company_id",$gl_session["session_data"]['company_id'])->order_by("name","asc")->get("categories")->result();
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
