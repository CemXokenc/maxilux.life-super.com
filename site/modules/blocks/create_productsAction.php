<?php
  $this->db = new active_records();
if($this->isPost()){
    $name = $this->getVariable("name");
    $categories = $this->getVariable("categories");
    $price= $this->getVariable("price");
    $cnt = $this->getVariable("cnt");

   for($i=0;$i<count($name);$i++){
  if($name[$i] != ""){   
    $data = array(
         'name' => $name[$i],
         'category_id' => $categories[$i],
         'price' => $price[$i],
         'cnt' => $cnt[$i],
         'company_id' => $gl_session["session_data"]['company_id'],
      );
  
   $this->db->insert("products",$data);
    }   
   }
    $this->redirect($this->l("products"));
}



$categories = array();
$categories_data = $this->db->where("parent_id",0)->order_by("name","asc")->get("categories")->result();
for($z=0;$z<count($categories_data);$z++){
  $selected = 0;
  if($gl_session["session_data"]['product_categories_list'][$categories_data[$z]['id']] == 1) $selected = 1;

  $categories[$categories_data[$z]['id']] = array('id'=>$categories_data[$z]['id'],"name"=>$categories_data[$z]['name'],'selected'=>$selected); 
  $sub_categories_data = $this->db->where("parent_id", $categories_data[$z]['id'])->order_by("name","asc")->get("categories")->result();
  for($z1=0;$z1<count($sub_categories_data);$z1++){
    $selected = 0;
    if($gl_session["session_data"]['product_categories_list'][$sub_categories_data[$z1]['id']] == 1) $selected = 1;
    $categories[$sub_categories_data[$z1]['id']] = array('id'=>$sub_categories_data[$z1]['id'],"name"=>"=>".$sub_categories_data[$z1]['name'],'selected'=>$selected); 

    $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("name","asc")->get("categories")->result();
    for($z2=0;$z2<count($sub_categories_data1);$z2++){
       $selected = 0;
       if($gl_session["session_data"]['product_categories_list'][$sub_categories_data1[$z2]['id']] == 1) $selected = 1;
      $categories[$sub_categories_data1[$z2]['id']] = array('id'=>$sub_categories_data1[$z2]['id'],"name"=>"== =>".$sub_categories_data1[$z2]['name'],'selected'=>$selected); 

      $sub_categories_data2 = $this->db->where("parent_id", $sub_categories_data1[$z2]['id'])->order_by("name","asc")->get("categories")->result();
      for($z3=0;$z3<count($sub_categories_data2);$z3++){
       $selected = 0;
       if($gl_session["session_data"]['product_categories_list'][$sub_categories_data2[$z3]['id']] == 1) $selected = 1;

        $categories[$sub_categories_data2[$z3]['id']] = array('id'=>$sub_categories_data2[$z3]['id'],"name"=>"== == =>".$sub_categories_data2[$z3]['name'],'selected'=>$selected); 
      }
    }
  }
}

$this->r_v("categories", $categories); 
