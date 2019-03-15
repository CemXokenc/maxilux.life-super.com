<?php
  $this->db = new active_records();
   
$this->db->where("parent_id",0)->where("company_id",$gl_session["session_data"]['company_id']);
if($block_attr_page=="dohody"){
$this->db->where("operation_type", 0);
}

if($block_attr_page=="rashody"){
$this->db->where("operation_type", 1);
}






 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $dohody = $this->db->select("dohody_rashody.name as dohody_rashody_name, dohody_rashody.parent_id as dohody_rashody_parent_id, dohody_rashody.operation_type as dohody_rashody_operation_type, dohody_rashody.company_id as dohody_rashody_company_id, dohody_rashody.id as dohody_rashody_id")->limit(100,($page_num-1)*100)->get("dohody_rashody", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("dohody_rashody")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"dohody_delete", "id"=>"dohody_rashody_id", "num"=>"0", "label"=>"dohody_delete", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"dohody_update", "id"=>"dohody_rashody_id", "num"=>"0", "label"=>"dohody_update", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"rashody_update", "id"=>"dohody_rashody_id", "num"=>"0", "label"=>"rashody_update", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"rashody_delete", "id"=>"dohody_rashody_id", "num"=>"0", "label"=>"rashody_delete", "html"=>"", "ajax"=>"0"); 
 $dohody = $this->prepare_actions_list($dohody,$urls_list); 

   $this->r_v("dohody_create_link", $this->l("dohody_create"));

 $navigation = $this->navigation("dohody","dohody", $items_count, 100,$page_navigation_url_prefix, $page_navigation_url_num); 





$old_categories = $dohody;
$categories_all = array();
$category_id = arg(1);
$operation_type = "";

if($block_attr_page=="dohody"){
  $operation_type = 0;
}
if($block_attr_page=="rashody"){
  $operation_type = 1;
}



for($z=0;$z<count($old_categories);$z++){
 
  $categories_all[] = $old_categories[$z];

  if($gl_session["session_data"]['dohody_rashody_category_2'] > 0){
    $this->db->where("id",$gl_session["session_data"]['dohody_category_2']);
  }

  $sub_categories_data = $this->db->where("parent_id", $old_categories[$z]['dohody_rashody_id'])->where("operation_type", $operation_type)->order_by("name","asc")->get("dohody_rashody")->result();
  for($z1=0;$z1<count($sub_categories_data);$z1++){

    $num = count($categories_all);
    $categories_all[$num]['dohody_rashody_id'] = $sub_categories_data[$z1]['id'];
    $categories_all[$num]['dohody_rashody_name'] = "=>".$sub_categories_data[$z1]['name'];



    if($gl_session["session_data"]['dohody_rashody_category_3'] > 0){
      $this->db->where("id",$gl_session["session_data"]['dohody_category_3']);
    }
    
    $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->where("operation_type", $operation_type)->order_by("name","asc")->get("dohody_rashody")->result();
    for($z2=0;$z2<count($sub_categories_data1);$z2++){


      $num = count($categories_all);
      $categories_all[$num]['dohody_rashody_name'] = "== =>".$sub_categories_data1[$z2]['name'];
      $categories_all[$num]['dohody_rashody_id'] = $sub_categories_data1[$z2]['id'];     
      if($gl_session["session_data"]['dohody_rashody_category_4'] > 0){
        $this->db->where("id",$gl_session["session_data"]['dohody_category_4']);
      }
      $sub_categories_data2 = $this->db->where("parent_id", $sub_categories_data1[$z2]['id'])->where("operation_type", $operation_type)->order_by("name","asc")->get("dohody_rashody")->result();
      for($z3=0;$z3<count($sub_categories_data2);$z3++){
        $num = count($categories_all);
        $categories_all[$num]['dohody_rashody_id'] = $sub_categories_data2[$z3]['id'];
        $categories_all[$num]['dohody_rashody_name'] = "== == =>".$sub_categories_data2[$z3]['name'];
     
      }
    }
  }
}


$dohody = $this->prepare_actions_list($categories_all, $urls_list);



if($block_attr_page=="rashody"){
  $create_l = $this->l("rashody_create");
}
if($block_attr_page=="dohody"){
  $create_l = $this->l("dohody_create");
}
$this->r_v("create_l", $create_l );
$this->r_v("type_page", $block_attr_page); 
 $this->r_v("dohody",$dohody); 
