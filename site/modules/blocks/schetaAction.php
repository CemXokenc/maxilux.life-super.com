<?php
  $this->db = new active_records();
   
$this->db->where("parent_id",0)->where("company_id",$gl_session["session_data"]['company_id']);






 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $scheta = $this->db->select("scheta.name as scheta_name, scheta.id as scheta_id, scheta.company_id as scheta_company_id, scheta.amount as scheta_amount, scheta.parent_id as scheta_parent_id")->limit(100,($page_num-1)*100)->get("scheta", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("scheta")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"scheta_update", "id"=>"scheta_id", "num"=>"0", "label"=>"scheta_update", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"scheta_delete", "id"=>"scheta_id", "num"=>"0", "label"=>"scheta_delete", "html"=>"", "ajax"=>"0"); 
 $scheta = $this->prepare_actions_list($scheta,$urls_list); 

   $this->r_v("scheta_create_link", $this->l("scheta_create"));

 $navigation = $this->navigation("scheta","scheta", $items_count, 100,$page_navigation_url_prefix, $page_navigation_url_num); 





$old_categories = $scheta;
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


  $sub_categories_data = $this->db->where("parent_id", $old_categories[$z]['scheta_id'])->order_by("name","asc")->get("scheta")->result();
  for($z1=0;$z1<count($sub_categories_data);$z1++){

    $num = count($categories_all);
    $categories_all[$num]['scheta_id'] = $sub_categories_data[$z1]['id'];
    $categories_all[$num]['scheta_name'] = "=>".$sub_categories_data[$z1]['name'];
    $categories_all[$num]['scheta_amount'] = "=>".$sub_categories_data[$z1]['amount'];



    
    $sub_categories_data1 = $this->db->where("parent_id", $sub_categories_data[$z1]['id'])->order_by("name","asc")->get("scheta")->result();
    for($z2=0;$z2<count($sub_categories_data1);$z2++){


      $num = count($categories_all);
      $categories_all[$num]['scheta_amount'] = "== =>".$sub_categories_data1[$z2]['amount'];
      $categories_all[$num]['scheta_name'] = "== =>".$sub_categories_data1[$z2]['name'];
      $categories_all[$num]['scheta_id'] = $sub_categories_data1[$z2]['id'];     

      $sub_categories_data2 = $this->db->where("parent_id", $sub_categories_data1[$z2]['id'])->order_by("name","asc")->get("scheta")->result();
      for($z3=0;$z3<count($sub_categories_data2);$z3++){
        $num = count($categories_all);
        $categories_all[$num]['scheta_id'] = $sub_categories_data2[$z3]['id'];
        $categories_all[$num]['scheta_name'] = "== == =>".$sub_categories_data2[$z3]['name'];
         $categories_all[$num]['scheta_amount'] = "== == =>".$sub_categories_data2[$z3]['amount'];  
      }
    }
  }
}


$scheta = $this->prepare_actions_list($categories_all, $urls_list); 
 $this->r_v("scheta",$scheta); 
