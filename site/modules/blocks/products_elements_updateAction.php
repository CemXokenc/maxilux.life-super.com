<?php
  $this->db = new active_records();

$this->r_v("textarea","textarea");

$this->r_v("dollar", "$");
$this->r_v("product_id", arg(1));

function create_images($products_id){
  $table = "<table class='table table-bordered'>
             <thead>
              <tr>
				<th style='width:50px;'>№</th>
                <th style='width:150px;'>Картинка</th>
                <th style='width:200px;'>Название</th>
                <th>Описание</th>
                <th style='width:150px;'>Управление</th>
              </tr>
             </thead>
            <tbody>";

  $db = new active_records();
  $images =  $db->where("product_id",$products_id)->order_by("number")->get("products_files")->result();
  for($i=0;$i<count($images);$i++){
    $table .= "<tr>";
	 $table .= "<td><span class='img_num'>".$images[$i]['number']."</span><span class='img_num_edit'></span></td>";
    $table .= "<td><img src='".images_path.arg(1)."/".$images[$i]['name']."' width='100' height='100'></td>";
    $table .= "<td>".$images[$i]['name']."</td>";
    $table .= "<td><span class='opisanie'>".$images[$i]['opisanie']."</span><span class='opisanie_edit'></span></td>";
    $table .= "<td><span class='label label-primary images_edit' image-id='".$images[$i]['id']."'>Редактировать</span><span class='label label-default images_delete' image-id='".$images[$i]['id']."'>Удалить</span><span style='display:none;' class='label label-primary images_save' image-id='".$images[$i]['id']."'>Сохранить</span></td>";
    $table .= "</tr>";
  }
  $table .= "</tbody></table>";
  return  $table;
}

function create_table($products_id){
  $table = "<table class='table table-bordered'>
				        <thead>
				          <tr>
						    <th>№</th>
				            <th>Склад</th>
				            <th>Название</th>
				            <th>Количество</th>
                                            <th>Цена</th>
                                            <th>Общая сумма</th>
                                            <th>Управление</th>
				          </tr>
				        </thead>
                                    <tbody>";
  $db = new active_records();
  $product =  $db->where("products_elements.products_id",$products_id)->
  select("sklads.name as sklad_name, products_elements.kolichestvo as kolichestvo, products.price as price, products.name as tovar_name,products_elements.id as id, products.currency as currency,products_elements.number as number")->
  where("products.id","products_elements.tovar_id",1)->
  where("sklads.id","products_elements.sklad_id",1)->
  order_by("products_elements.number")->
  get("products_elements,products,sklads")->result();

  $tovary = $db->get("products")->result();
  
  
  $tovary_cnt = 0;
  $tovary_price = 0;
  for($i=0;$i<count($product);$i++){
  
	if($product[$i]['currency'] != 'UAH')
	{
		$valuta =  $db->select('rate')->where("valuta",$product[$i]['currency'])->order_by("id","desc")->limit(1)->get("kurc_valut")->result();
		
		$product[$i]['price'] *= $valuta[0][0];
		
		//echo 'valuta = '.$valuta[0][0];
	}
    $tovary_cnt += $product[$i]['kolichestvo'];
    $tovary_price += $product[$i]['kolichestvo']*$product[$i]['price'];
    $table .= "<tr>";
	$table .= "<td><span class='tovar_number'>".$product[$i]['number']."</span><span class='tovar_number_edit'></span></td>";
    $table .= "<td>".$product[$i]['sklad_name']."</td>";
    $table .= "<td>".$product[$i]['tovar_name']."</td>";
    $table .= "<td><span class='cnt'>".$product[$i]['kolichestvo']."</span><span class='cnt_edit'></span></td>";
    $table .= "<td><span class='price'>".$product[$i]['price']."</span></td>";
    $table .= "<td><span class='summa'>".$product[$i]['kolichestvo']*$product[$i]['price']."</span></td>";
    $table .= "<td><span class='label label-primary tovar_edit' product-id='".$product[$i]['id']."'>Редактировать</span> <span class='label label-default tovar_delete' product-id='".$product[$i]['id']."'>Удалить</span><span class='class_edit'> </span></td>";

    $table .= "</tr>";
  }

  $table .= "<tr><td><strong>Итого</strong></td><td>-</td><td>-</td><td><strong>".$tovary_cnt."</strong></td><td><strong>-</strong></td><td><strong id='total_price'>".$tovary_price."(UAH)</strong></td><td><strong>-</strong></td></tr>";

  $table .= "				        </tbody>
				      </table>";

  return  $table;
}

function create_table_optn($products_id){
  $table = "<table class='table table-bordered'>
				        <thead>
				          <tr>
							<th>№</th>
				            <th>Название</th>
				            <th>Код</th>
							<th>Тип</th>
							<th>Формула</th>
							<th>Управление</th>
				          </tr>
				        </thead>
                                    <tbody>";
  $db = new active_records();
  $product =  $db->where("products_id",$products_id)->order_by("number")->get("products_options")->result();
 for($i=0;$i<count($product);$i++){
 $table .= "<tr>";
	$table .= "<td><span class='opt_num'>".$product[$i]['number']."</span><span class='opt_num_edit'></span></td>";
    $table .= "<td><span class='opt_name'>".$product[$i]['name']."</span><span class='opt_name_edit'></span></td>";
    $table .= "<td><span class='opt_kod'>".$product[$i]['kod']."</span><span class='opt_kod_edit'></span></td>";
    $table .= "<td><span class='type_opt'>";
	
	if($product[$i]['products_type'] == 1)
		$table .= "Поле";
	else if($product[$i]['products_type'] == 2)
		$table .= "Скрытое";
	else $table .= "Не выбрано";
	  
      //Формирование селекта, пока ставлю 1, потому что пока что только "поле" есть
	$table .= "</span><select class='type_edit form-control' style='display:none;'>";

	$table .= "<option value='0'";
	if($product[$i]['products_type'] == 0) $table .= "selected";
	$table .= ">Не выбрано</option>";
	
	$table .= "<option value='1'";
	if($product[$i]['products_type'] == 1) $table .= "selected";
	$table .= ">Поле</option>";
	
	$table .= "<option value='2'";
	if($product[$i]['products_type'] == 2) $table .= "selected";
	$table .= ">Скрытое</option>";
	 
    $table .= "</select>";
    $table .= "</td>";
	
	$table .= "<td><span class='opt_formula'>".$product[$i]['formula']."</span><span class='opt_formula_edit' style='display:none;'></span></td>";
   
       $table .= "<td><span class='label label-primary options_edit' product-id='".$product[$i]['id']."'>Редактировать</span> <span class='label label-default options_delete' product-id='".$product[$i]['id']."'>Удалить</span><span class='class_edit'></span></td>";
  
    $table .= "</tr>";
  }

 


  $table .= "				        </tbody>
				      </table>";
  return  $table;
}

function izdelie_table($products_id){
  $table = "<table class='table table-bordered'>
				        <thead>
				          <tr>
				            <th style='width:30px;'>Номер</th>
				            <th style='width:200px;'>Название</th>
				            <th style='width:50px;'>Количество</th>
				            <th>Категория на складе</th>
				            <th>Родительская категория</th>
				            <th>Статус</th>
				            <th>Тип</th>
                                            <th>Управление</th>
				          </tr>
				        </thead>
                                    <tbody>";
  $db = new active_records();

  $product =  $db->where("izdelie_id",$products_id)->get("izdelie_categories")->result();
  
$izdelie_id = arg(1);
$categories = array();
$categories_data = $db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id", 0)->where("izdelie_id",$izdelie_id)->order_by("nomer", "asc")->get("izdelie_categories")->result();

for ($z = 0; $z < count($categories_data); $z++) {
  $info = $db->where("id",$categories_data[$z]['categories_izdelie_sklad'])->get("categories")->result();
  $categories[$categories_data[$z]['id']] = array(
    'id' => $categories_data[$z]['id'],
    "parent_name" => "",
    "parent_id" => $categories_data[$z]['parent_id'],
    "nomer" => $categories_data[$z]['nomer'],
    "name" => $categories_data[$z]['name'],
    "main_name" => $categories_data[$z]['name'],
    "sklad" => isset($info[0]['name'])?$info[0]['name']:'',
    "sklad_id" => $info[0]['id'],
    "kolichestvo" => $categories_data[$z]['kolichestvo'],
    "type" => $categories_data[$z]['type'],
    "status_id" => $categories_data[$z]['status_id'],
  );
  $sub_categories_data = $db->where("parent_id", $categories_data[$z]['id'])->order_by("nomer", "asc")->get("izdelie_categories")->result();
  for ($z1 = 0; $z1 < count($sub_categories_data); $z1++) {
    $info = $db->where("id",$sub_categories_data[$z1]['categories_izdelie_sklad'])->get("categories")->result();
    $categories[$sub_categories_data[$z1]['id']] = array(
      'id' => $sub_categories_data[$z1]['id'],
      "parent_name" => $categories_data[$z]['name'],
      "parent_id" =>  $sub_categories_data[$z1]['parent_id'],
      "nomer" =>  $sub_categories_data[$z1]['nomer'],
      "name" => "=>" . $sub_categories_data[$z1]['name'],
      "main_name" => $sub_categories_data[$z1]['name'],
      "sklad" => isset($info[0]['name'])?$info[0]['name']:'',
      "sklad_id" => $info[0]['id'],
      "kolichestvo" => $sub_categories_data[$z1]['kolichestvo'],
      "type" => $sub_categories_data[$z1]['type'],
      "status_id" => $sub_categories_data[$z1]['status_id'],
    );
    if($z1 == 0){
        $categories[$categories_data[$z]['id']]['name'] = "<span class='plus_show' category_id='".$categories[$categories_data[$z]['id']]['id']."'><img height='15' status='+' src='".main_img_domain."/site/templates/plus.jpg' /></span>".$categories[$categories_data[$z]['id']]['name'];
    }
        $categories[$sub_categories_data[$z1]['id']]['classes'] = "content_class".$categories[$categories_data[$z]['id']]['id'];

    $sub_categories_data1 = $db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("nomer", "asc")->get("izdelie_categories")->result();
    for ($z2 = 0; $z2 < count($sub_categories_data1); $z2++) {
      $info = $db->where("id",$sub_categories_data1[$z2]['categories_izdelie_sklad'])->get("categories")->result();
      $categories[$sub_categories_data1[$z2]['id']] = array(
        'id' => $sub_categories_data1[$z2]['id'],
        "parent_id" => $sub_categories_data1[$z2]['parent_id'],
         "parent_name" => $sub_categories_data[$z1]['name'],
        "nomer" => $sub_categories_data1[$z2]['nomer'],
        "name" => "== =>" . $sub_categories_data1[$z2]['name'],
        "main_name" => $sub_categories_data1[$z2]['name'],
        "sklad" => isset($info[0]['name'])?$info[0]['name']:'',
        "sklad_id" => $info[0]['id'],
        "kolichestvo" => $sub_categories_data1[$z2]['kolichestvo'],
        "type" => $sub_categories_data1[$z2]['type'],
        "status_id" => $sub_categories_data1[$z2]['status_id'],
      );
       $categories[$sub_categories_data1[$z2]['id']]['classes'] = "content_class".$categories[$sub_categories_data[$z1]['id']]['id'];
     if($z2 == 0){
        $categories[$sub_categories_data[$z1]['id']]['name'] =  "<span class='plus_show' category_id='".$categories[$sub_categories_data[$z1]['id']]['id']."'><img height='15' status='+' src='".main_img_domain."/site/templates/plus.jpg' /></span>".$categories[$sub_categories_data[$z1]['id']]['name'];

    }



      $sub_categories_data2 = $db->where("parent_id", $sub_categories_data1[$z2]['id'])->order_by("nomer", "asc")->get("izdelie_categories")->result();
      for ($z3 = 0; $z3 < count($sub_categories_data2); $z3++) {
        $info = $db->where("id",$sub_categories_data2[$z3]['categories_izdelie_sklad'])->get("categories")->result();
        $categories[$sub_categories_data2[$z3]['id']] = array(
          'id' => $sub_categories_data2[$z3]['id'],
          "parent_id" => $sub_categories_data2[$z3]['parent_id'],
          "parent_name" => $sub_categories_data1[$z2]['name'],
          "nomer" => $sub_categories_data2[$z3]['nomer'],
          "name" => "== == =>" . $sub_categories_data2[$z3]['name'],
          "main_name" => $sub_categories_data2[$z3]['name'],
          "sklad" => isset($info[0]['name'])?$info[0]['name']:'',
          "sklad_id" => $info[0]['id'],
          "kolichestvo" =>  $sub_categories_data2[$z3]['kolichestvo'],
          "type" => $sub_categories_data2[$z3]['type'],
          "status_id" => $sub_categories_data2[$z3]['status_id'],
        );
          $categories[$sub_categories_data2[$z3]['id']]['classes'] = "content_class".$categories[$sub_categories_data1[$z2]['id']]['id'];

    if($z3 == 0){
        $categories[$sub_categories_data1[$z2]['id']]['name'] =  "<span class='plus_show' category_id='". $categories[$sub_categories_data1[$z2]['id']]['id']."'><img height='15' status='+' src='".main_img_domain."/site/templates/plus.jpg' /></span>". $categories[$sub_categories_data1[$z2]['id']]['name'];

    }



      }
    }
  }
}


$a = new Actions();
$curr_izd = arg(1);
  foreach($categories as $id_cat => $name){
   $prod_list_db = $db->where("izdelie_categories_id",$name['id'])->get("products")->result();
 
   $prod_list = "";
   $status =  $db->where("id",$name['status_id'])->get("category_statuses")->result();
   if(count($prod_list_db)>0){
      foreach($prod_list_db as $prod_list_db_ => $list_db){
           $prod_list .= "<br>".$list_db['name']."<a href='".$a->l("products_elements_update/".$list_db['id'])."'>Редактировать</a>"."<a href='".$a->l("izdelie_delete_from_update/".$list_db['id']."/".$curr_izd)."'>удалить</a>";
     }
   }
   if($name['span_start']==1){
       $table .= "<span class='hide_show_content'>";
   }
      

    $table .= "<tr class='".$name['classes']."'";
   if($name['classes']!=""){
       $table.= " style='display:none;' ";
    }
   $table.= ">";
 $table .= "<td><span class='nomer'>".$name['nomer']."</span><span class='nomer_edit'></span></td>";
    $table .= "<td><span class='name'>".$name['name'].$prod_list."</span><span class='name_edit'></span><span class='name_for_edit' style='display:none;'>".$name['main_name']."</span></td>";
   $table .= "<td><span class='cnt'>".$name['kolichestvo']."</span><span class='cnt_edit'></span></td>";
    $table .= "<td><span class='sklad'>".$name['sklad']."</span><span class='sklad_edit'></span><span class='sklad_id' style='display:none;'>".$name['sklad_id']."</span></td>";
  $table .= "<td><span class='parent_category'>".$name['parent_name']."</span><span class='parent_edit'></span><span class='parent_id' style='display:none;'>".$name['parent_id']."</span></td>";
  $table .= "<td><span class='status_id' style='display:none;'>".$status[0]['id']."</span><span class='status_name'>".$status[0]['name'].$name['span_start']."(".$name['span_end'].")"."</span><select class='status_select' style='display:none;'></span></td>";
    $type = "Список";
     $select = "<select class='form-control'><option value='0' selected>Список</option><option value='1'>Опции</option></select>"; 
    if($name['type'] == 1){ $type = "Опции";
    $select = "<select class='form-control'><option value='0'>Список</option><option value='1' selected>Опции</option></select>"; 
     }
 
    $table .= "<td><span class='izdelie_type'>".$type."</span><span class='izdelie_type_edit' style='display:none;'>".$select."</span></td>";
    $table .= "<td><span class='label label-primary izdelie_edit' product-id='".$id_cat."'>Редактировать</span> <span class='label label-default izdelie_delete' product-id='".$id_cat."'>Удалить</span><span class='class_edit'></span></td>";

    $table .= "</tr>";
       if($name['span_end']==1){
       $table .= "</span>";
   }
  }
 

  $table .= "				        </tbody>
				      </table>";
  return  $table;
}

$izdelie_id = arg(1);
$categories = array();
$categories_data = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id", 0)->where("izdelie_id",$izdelie_id)->order_by("name", "asc")->get("izdelie_categories")->result();

for ($z = 0; $z < count($categories_data); $z++) {

  $categories[$categories_data[$z]['id']] = array(
    'id' => $categories_data[$z]['id'],
    "name" => $categories_data[$z]['name'],
  );
  $sub_categories_data = $this->db->where("parent_id", $categories_data[$z]['id'])->order_by("name", "asc")->get("izdelie_categories")->result();
  for ($z1 = 0; $z1 < count($sub_categories_data); $z1++) {

    $categories[$sub_categories_data[$z1]['id']] = array(
      'id' => $sub_categories_data[$z1]['id'],
      "name" => "=>" . $sub_categories_data[$z1]['name'],
    );
    $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("name", "asc")->get("izdelie_categories")->result();
    for ($z2 = 0; $z2 < count($sub_categories_data1); $z2++) {

      $categories[$sub_categories_data1[$z2]['id']] = array(
        'id' => $sub_categories_data1[$z2]['id'],
        "name" => "== =>" . $sub_categories_data1[$z2]['name'],
      );
      $sub_categories_data2 = $this->db->where("parent_id", $sub_categories_data1[$z2]['id'])->order_by("name", "asc")->get("izdelie_categories")->result();
      for ($z3 = 0; $z3 < count($sub_categories_data2); $z3++) {
        $categories[$sub_categories_data2[$z3]['id']] = array(
          'id' => $sub_categories_data2[$z3]['id'],
          "name" => "== == =>" . $sub_categories_data2[$z3]['name'],
        );
      }
    }
  }
}

$this->r_v("izd_categories",$categories);
if($block_attr_table=="create"){
 
  $id = $this->db->set("izdelie",1)->set('company_id',-1)->insert("products")->result();
  $this->redirect($this->l("products_elements_update/".$id));
}
$type_post = $this->get("type");
if($this->isPost() && $type_post=="refresh"){
  $sklad_id = $this->get("sklad");
  $product_id = $this->get("product");
  $cnt = $this->get("cnt");


  $products_id = arg(1);
  $data = array(
    'products_id' => $products_id,
    'sklad_id' => $sklad_id,
    'tovar_id' => $product_id,
    'kolichestvo' => $cnt,
    'company_id' => $gl_session["session_data"]['company_id'],
    /*'izdelie' => 1,*/
  );
  $this->db->insert("products_elements",$data);
  /*echo mysql_error();*/

  $table = create_table($products_id);
  echo json_encode(array(
    "table" => $table,
  ));
  exit();
}

if($this->isPost() && $type_post=="change_main_category"){
  $category_id = $this->get("category_id");
  $category_db = $this->db->where("category_id",$category_id)->get('category_statuses')->result();
 if(count($category_db)<1){
    $category_1 = $this->db->where("id",$category_id)->get("categories")->result();
    $category_db = $this->db->where("category_id",$category_1[0]['parent_id'])->get('category_statuses')->result();
     if(count($category_db)<1){
       $category_2 = $this->db->where("id",$category_1[0]['parent_id'])->get("categories")->result();
       $category_db = $this->db->where("category_id",$category_2[0]['parent_id'])->get('category_statuses')->result();
       if(count($category_db)<1){
         $category_3 = $this->db->where("id",$category_2[0]['parent_id'])->get("categories")->result();
         $category_db = $this->db->where("category_id",$category_3[0]['parent_id'])->get('category_statuses')->result();
       }
     }
 }
 
  $select = "<option value='0'>Выберите статус</option>";
 for($i=0;$i<count($category_db);$i++){
   $select .= "<option value='".$category_db[$i]['id']."'>".$category_db[$i]['name']."</option>";
 }
  echo json_encode(array(
    "select" => $select,
  ));
  exit();
}

if($this->isPost() && $type_post=="refresh_opt"){
	$num_opt = $this->get("num_opt");
	$name_opt = $this->get("name_opt");
	$kod_opt= $this->get("kod_opt");
	$type_opt = $this->get("type_opt");
	$formula = $this->get("formula_opt");


  $products_id = arg(1);
  $data = array(
    'name' => $name_opt,
    'products_type' => $type_opt,
    'kod' => $kod_opt,
    'products_id' => $products_id,
    'formula' => $formula,
	'number' => $num_opt
  );
  $this->db->insert("products_options",$data);


  $table = create_table_optn($products_id);
  echo json_encode(array(
    "table" => $table,
  ));
  exit();
}

if($this->isPost() && $type_post=="refresh_izd_category"){
  $type = $this->get("operation_type");
  $name = $this->get("izd_category_name");
  $nomer = $this->get("nomer");
  $categories_izdelie = $this->get("categories_izdelie");
  $categories_izdelie_sklad = $this->get("categories_izdelie_sklad");
   $status_izdelie = $this->get("status_izdelie");
  $products_id = arg(1);
  $kolichestvo = $this->get("kolichestvo");
  if($kolichestvo == ""){
    $kolichestvo = 1;
  }
  $data = array(
    'nomer' => $nomer,
    'name' => $name,
    'izdelie_id' => $products_id,
    'company_id' => $gl_session["session_data"]['company_id'],
    'parent_id' => $categories_izdelie,
    'categories_izdelie_sklad' => $categories_izdelie_sklad,
    'kolichestvo' => $kolichestvo,
    'type' => $type,
    'status_id' => $status_izdelie,
  );
  $this->db->insert("izdelie_categories",$data);

  $table_1 = izdelie_table($products_id);
  
 $categories = array();
$categories_data = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id", 0)->where("izdelie_id",$products_id)->order_by("name", "asc")->get("izdelie_categories")->result();

for ($z = 0; $z < count($categories_data); $z++) {

  $categories[$categories_data[$z]['id']] = array(
    'id' => $categories_data[$z]['id'],
    "name" => $categories_data[$z]['name'],
  );
  $sub_categories_data = $this->db->where("parent_id", $categories_data[$z]['id'])->order_by("name", "asc")->get("izdelie_categories")->result();
  for ($z1 = 0; $z1 < count($sub_categories_data); $z1++) {

    $categories[$sub_categories_data[$z1]['id']] = array(
      'id' => $sub_categories_data[$z1]['id'],
      "name" => "=>" . $sub_categories_data[$z1]['name'],
    );
    $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("name", "asc")->get("izdelie_categories")->result();
    for ($z2 = 0; $z2 < count($sub_categories_data1); $z2++) {

      $categories[$sub_categories_data1[$z2]['id']] = array(
        'id' => $sub_categories_data1[$z2]['id'],
        "name" => "== =>" . $sub_categories_data1[$z2]['name'],
      );
      $sub_categories_data2 = $this->db->where("parent_id", $sub_categories_data1[$z2]['id'])->order_by("name", "asc")->get("izdelie_categories")->result();
      for ($z3 = 0; $z3 < count($sub_categories_data2); $z3++) {
        $categories[$sub_categories_data2[$z3]['id']] = array(
          'id' => $sub_categories_data2[$z3]['id'],
          "name" => "== == =>" . $sub_categories_data2[$z3]['name'],
        );
      }
    }
  }
}
$select_data = "<option value='0'>Не выбрано</option>";
    
       if(count($categories)>0){
      foreach($categories as $id => $name){
        $select_data.="<option value='".$id."'>".$name['name']."</option>";
       }
    }
    
  echo json_encode(array(
    "table" => $table_1,
    "select_data" => $select_data,
  ));
  exit();
}
if($this->isPost() && $type_post=="delete"){
  $products_id = arg(1);
  $tovar_id = $this->get("tovar_id");
  $this->db->where("id",$tovar_id)->delete('products_elements');
  $table = create_table($products_id);
 $products_files_db =  $this->db->where("product_id",$products_id)->count_all_results("products_files");
  if($products_files_db < 1){
       $this->db->where("id",$products_id)->set("got_images",1)->update("products");
  }
  echo json_encode(array(
    "table" => $table,
  ));
  exit();
}

if($this->isPost() && $type_post=="delete_opt"){
  $products_id = arg(1);
  $tovar_id = $this->get("tovar_id");
  $this->db->where("id",$tovar_id)->delete('products_options');
  $table = create_table_optn($products_id);

  echo json_encode(array(
    "table" => $table,
  ));
  exit();
}

if($this->isPost() && $type_post=="delete_image"){
  $products_id = arg(1);
  $image_id = $this->get("image_id");
  $this->db->where("id",$image_id)->delete('products_files');
  $table = create_images($products_id);

  echo json_encode(array(
    "table" => $table,
  ));
  exit();
}

if($this->isPost() && $type_post=="edit_image"){
  $products_id = arg(1);
  $image_id = $this->get("image_id");
  $opisanie = $this->get("opisanie");
  $number = $this->get("number");
  $this->db->where("id",$image_id)->set("opisanie",$opisanie)->set("number",$number)->update('products_files');
  $table = create_images($products_id);

  echo json_encode(array(
    "table" => $table,
  ));
  exit();
}

if($this->isPost() && $type_post=="update_izdelie"){
  $tovar_id = $this->get("tovar_id");
  $cnt = $this->get("cnt");
  $nomer = $this->get("nomer");
  $parent_id = $this->get("parent_id");
  $name = $this->get("name");
  $status_id = $this->get("status_id");
  $sklad_id = $this->get("sklad_id");
  $type_category = $this->get("type_category");
  $data_1 = array(
   "kolichestvo" => $cnt,
   "parent_id" => $parent_id,
   "categories_izdelie_sklad" => $sklad_id,
   "type" => $type_category,  
   "nomer" => $nomer,  
   "name" => $name, 
   "status_id" => $status_id,
  ); 
  $this->db->where("id",$tovar_id)->update("izdelie_categories",$data_1);
  $products_id = arg(1);
 $table = izdelie_table($products_id);

  $categories = array();
$categories_data = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id", 0)->where("izdelie_id",$products_id)->order_by("name", "asc")->get("izdelie_categories")->result();

for ($z = 0; $z < count($categories_data); $z++) {

  $categories[$categories_data[$z]['id']] = array(
    'id' => $categories_data[$z]['id'],
    "name" => $categories_data[$z]['name'],
  );
  $sub_categories_data = $this->db->where("parent_id", $categories_data[$z]['id'])->order_by("name", "asc")->get("izdelie_categories")->result();
  for ($z1 = 0; $z1 < count($sub_categories_data); $z1++) {

    $categories[$sub_categories_data[$z1]['id']] = array(
      'id' => $sub_categories_data[$z1]['id'],
      "name" => "=>" . $sub_categories_data[$z1]['name'],
    );
    $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("name", "asc")->get("izdelie_categories")->result();
    for ($z2 = 0; $z2 < count($sub_categories_data1); $z2++) {

      $categories[$sub_categories_data1[$z2]['id']] = array(
        'id' => $sub_categories_data1[$z2]['id'],
        "name" => "== =>" . $sub_categories_data1[$z2]['name'],
      );
      $sub_categories_data2 = $this->db->where("parent_id", $sub_categories_data1[$z2]['id'])->order_by("name", "asc")->get("izdelie_categories")->result();
      for ($z3 = 0; $z3 < count($sub_categories_data2); $z3++) {
        $categories[$sub_categories_data2[$z3]['id']] = array(
          'id' => $sub_categories_data2[$z3]['id'],
          "name" => "== == =>" . $sub_categories_data2[$z3]['name'],
        );
      }
    }
  }
}
$select_data = "<option value='0'>Не выбрано</option>";
    
       if(count($categories)>0){
      foreach($categories as $id => $name){
        $select_data.="<option value='".$id."'>".$name['name']."</option>";
       }
    }
  
  echo json_encode(array(
    "table" => $table,
    "select_data" => $select_data,
  ));
  exit();
}

if($this->isPost() && $type_post=="izdelie_delete"){
  $products_id = arg(1);
  $tovar_id = $this->get("tovar_id");
  $this->db->where("id",$tovar_id)->delete('izdelie_categories');
  $table = izdelie_table($products_id);

  $categories = array();
$categories_data = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id", 0)->where("izdelie_id",$products_id)->order_by("name", "asc")->get("izdelie_categories")->result();

for ($z = 0; $z < count($categories_data); $z++) {

  $categories[$categories_data[$z]['id']] = array(
    'id' => $categories_data[$z]['id'],
    "name" => $categories_data[$z]['name'],
  );
  $sub_categories_data = $this->db->where("parent_id", $categories_data[$z]['id'])->order_by("name", "asc")->get("izdelie_categories")->result();
  for ($z1 = 0; $z1 < count($sub_categories_data); $z1++) {

    $categories[$sub_categories_data[$z1]['id']] = array(
      'id' => $sub_categories_data[$z1]['id'],
      "name" => "=>" . $sub_categories_data[$z1]['name'],
    );
    $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("name", "asc")->get("izdelie_categories")->result();
    for ($z2 = 0; $z2 < count($sub_categories_data1); $z2++) {

      $categories[$sub_categories_data1[$z2]['id']] = array(
        'id' => $sub_categories_data1[$z2]['id'],
        "name" => "== =>" . $sub_categories_data1[$z2]['name'],
      );
      $sub_categories_data2 = $this->db->where("parent_id", $sub_categories_data1[$z2]['id'])->order_by("name", "asc")->get("izdelie_categories")->result();
      for ($z3 = 0; $z3 < count($sub_categories_data2); $z3++) {
        $categories[$sub_categories_data2[$z3]['id']] = array(
          'id' => $sub_categories_data2[$z3]['id'],
          "name" => "== == =>" . $sub_categories_data2[$z3]['name'],
        );
      }
    }
  }
}
$select_data = "<option value='0'>Не выбрано</option>";
    
       if(count($categories)>0){
      foreach($categories as $id => $name){
        $select_data.="<option value='".$id."'>".$name['name']."</option>";
       }
    }

  echo json_encode(array(
    "table" => $table,
    "select_data" => $select_data,
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
  $products_id = arg(1);
  $tovar_id = $this->get("tovar_id");
  $tovar_num= $this->get("number");
  $cnt= $this->get("cnt");
  $data = array(
    'kolichestvo' =>  $cnt,
	'number' =>  $tovar_num
  );
  $this->db->where("id",$tovar_id)->update('products_elements',$data);
  $table = create_table($products_id);

  echo json_encode(array(
    "table" => $table,
  ));
  exit();
}

if($this->isPost() && $type_post=="update_opt"){
  $products_id = arg(1);
  $tovar_id = $this->get("tovar_id");
  $opt_kod = $this->get("opt_kod");
  $opt_name = $this->get("opt_name");
  $opt_formula = $this->get("opt_formula");
  $opt_type = $this->get("opt_type");
  $opt_num = $this->get("opt_num");
  $data = array(
    'name' 				=>  $opt_name,
    'kod' 				=>  $opt_kod,
	'products_type' 	=>  $opt_type,
	'formula' 			=>  $opt_formula,
	'number' 			=>  $opt_num,
  );
  $this->db->where("id",$tovar_id)->update('products_options',$data);
  $table = create_table_optn($products_id);

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


if($this->isPost() && $type_post=="change_izd_category"){

 $tovar_id = $this->get("category_id");
 $categories = array();
$categories_data = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id", 0)->where("izdelie_id",$tovar_id)->order_by("name", "asc")->get("izdelie_categories")->result();

for ($z = 0; $z < count($categories_data); $z++) {

  $categories[$categories_data[$z]['id']] = array(
    'id' => $categories_data[$z]['id'],
    "name" => $categories_data[$z]['name'],
  );
  $sub_categories_data = $this->db->where("parent_id", $categories_data[$z]['id'])->order_by("name", "asc")->get("izdelie_categories")->result();
  for ($z1 = 0; $z1 < count($sub_categories_data); $z1++) {

    $categories[$sub_categories_data[$z1]['id']] = array(
      'id' => $sub_categories_data[$z1]['id'],
      "name" => "=>" . $sub_categories_data[$z1]['name'],
    );
    $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("name", "asc")->get("izdelie_categories")->result();
    for ($z2 = 0; $z2 < count($sub_categories_data1); $z2++) {

      $categories[$sub_categories_data1[$z2]['id']] = array(
        'id' => $sub_categories_data1[$z2]['id'],
        "name" => "== =>" . $sub_categories_data1[$z2]['name'],
      );
      $sub_categories_data2 = $this->db->where("parent_id", $sub_categories_data1[$z2]['id'])->order_by("name", "asc")->get("izdelie_categories")->result();
      for ($z3 = 0; $z3 < count($sub_categories_data2); $z3++) {
        $categories[$sub_categories_data2[$z3]['id']] = array(
          'id' => $sub_categories_data2[$z3]['id'],
          "name" => "== == =>" . $sub_categories_data2[$z3]['name'],
        );
      }
    }
  }
}
 $select_izd = "";
  foreach($categories as $id_cat => $name){
   
    $select_izd .=  "<option value='".$name['id']."'>".$name['name']."</option>";
  }
 echo json_encode(array(
    "table" => $select_izd,
  ));
  exit();
}
if($this->isPost() && $type_post=="tovar_change"){
  $tovar_id = $this->get("tovar_id");
  $tovar = $this->db->where("id",  $tovar_id)->get("products")->result();

  $price_valuta = $tovar[0]['price'];

  echo json_encode(array(
    "price" 	=> $tovar[0]['price'],
	"currency" 	=> $tovar[0]['currency']
  ));
  exit();
}

if($this->isPost() && $type_post == "save_postuplenie"){
  $products_id = arg(1);
  $name= $this->getVariable("name");
   $description = $_POST['description'];
  $summa= $this->getVariable("summa");
 $product_type = $this->getVariable("product_type");
 $categories_podizdelie = 0;
 $category_id = 0;
 $izdelie_id = $this->getVariable("izdelie_id");
 if( $product_type==1){$categories_podizdelie = $this->getVariable("categories_podizdelie");$izdelie_id= $this->getVariable("izdelie_id");}
 if( $product_type==0){ $category_id= $this->getVariable("category_id");}
  $data = array(
    'name' => $name,
    'category_id' => $category_id,
    'price' => $summa,
    'description' => $description,
    'company_id' => $gl_session["session_data"]['company_id'],
    'izdelie_type' => $product_type,
    'izdelie_categories_id' => $categories_podizdelie,
    'izdelie_id' => $izdelie_id,
  );
 
  
  $this->db->where("id",$products_id)->update("products",$data);
  $this->redirect($this->l("products"));
}





  $products_id = arg(1);
  $table = create_table($products_id);
  $this->r_v("table",$table);

  $images = create_images($products_id);
  $this->r_v("images",$images);

$create_table_optn = create_table_optn($products_id);
  $this->r_v("create_table_optn",$create_table_optn);
  $izdelie_table = izdelie_table($products_id);
  $this->r_v("izdelie_table",$izdelie_table);
  $products_info = $this->db->where("id",$products_id)->get("products")->result();
  $this->r_v("products_info",$products_info[0]);




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

$products = $this->db->where("izdelie_type", 0)->where("company_id",$gl_session["session_data"]['company_id'])->get("products")->result();
$this->r_v("products",$products);



$tovar_id = $this->get("category_id");
 $categories = array();
$categories_data = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("parent_id", 0)->where("izdelie_id",$products_info[0]['izdelie_id'])->order_by("name", "asc")->get("izdelie_categories")->result();

for ($z = 0; $z < count($categories_data); $z++) {

  $categories[$categories_data[$z]['id']] = array(
    'id' => $categories_data[$z]['id'],
    "name" => $categories_data[$z]['name'],
  );
  $sub_categories_data = $this->db->where("parent_id", $categories_data[$z]['id'])->order_by("name", "asc")->get("izdelie_categories")->result();
  for ($z1 = 0; $z1 < count($sub_categories_data); $z1++) {

    $categories[$sub_categories_data[$z1]['id']] = array(
      'id' => $sub_categories_data[$z1]['id'],
      "name" => "=>" . $sub_categories_data[$z1]['name'],
    );
    $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("name", "asc")->get("izdelie_categories")->result();
    for ($z2 = 0; $z2 < count($sub_categories_data1); $z2++) {

      $categories[$sub_categories_data1[$z2]['id']] = array(
        'id' => $sub_categories_data1[$z2]['id'],
        "name" => "== =>" . $sub_categories_data1[$z2]['name'],
      );
      $sub_categories_data2 = $this->db->where("parent_id", $sub_categories_data1[$z2]['id'])->order_by("name", "asc")->get("izdelie_categories")->result();
      for ($z3 = 0; $z3 < count($sub_categories_data2); $z3++) {
        $categories[$sub_categories_data2[$z3]['id']] = array(
          'id' => $sub_categories_data2[$z3]['id'],
          "name" => "== == =>" . $sub_categories_data2[$z3]['name'],
        );
      }
    }
  }
}
 $select_izd = "";


  foreach($categories as $id_cat => $name){
    $selected = 0;
    if($name['id']==$products_info[0]['izdelie_categories_id']){$selected = "selected";}
    $select_izd .=  "<option ".$selected." value='".$name['id']."'>".$name['name']."</option>";
  }

$this->r_v("select_izd",$select_izd );
$this->r_v("textarea","textarea"); 
