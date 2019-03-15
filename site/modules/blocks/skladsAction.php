<?php
  $this->db = new active_records();
   
$this->db->where("parent_id",0)->where("company_id",$gl_session["session_data"]['company_id']);

 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $sklads = $this->db->select("sklads.company_id as sklads_company_id, sklads.parent_id as sklads_parent_id, sklads.id as sklads_id, sklads.adress as sklads_adress, sklads.name as sklads_name, sklads.description as sklads_description")->limit(100,($page_num-1)*100)->get("sklads", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("sklads")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"sklads_update", "id"=>"sklads_id", "num"=>"0", "label"=>"редактировать", "html"=>"", "ajax"=>"0"); 
 $urls_list[] = array("action"=>"sklads_delete", "id"=>"sklads_id", "num"=>"0", "label"=>"удалить", "html"=>"", "ajax"=>"0"); 
 $sklads = $this->prepare_actions_list($sklads,$urls_list); 

   $this->r_v("sklads_create_link", $this->l("sklads_create"));

 $navigation = $this->navigation("sklads","sklads", $items_count, 100,$page_navigation_url_prefix, $page_navigation_url_num); 



$old_sklads = $sklads;

$sklads = array();
for($z=0;$z<count($old_sklads);$z++){
  $sklads[] = $old_sklads[$z];
  $sub_sklads_data = $this->db->where("parent_id", $old_sklads[$z]['sklads_id'])->order_by("name","asc")->get("sklads")->result();
  for($z1=0;$z1<count($sub_sklads_data);$z1++){
    $sklads[count($sklads)]['sklads_id'] = $sub_sklads_data[$z1]['id'];
    $num = count($sklads)-1;
    $sklads[$num]['sklads_name'] = "=>".$sub_sklads_data[$z1]['name'];
    $sklads[$num]['sklads_adress'] = $sub_sklads_data[$z1]['adress'];
    $sklads[$num]['sklads_description'] = $sub_sklads_data[$z1]['description'];




    $sub_sklads_data1 = $this->db->where("parent_id", $sub_sklads_data[$z1]['id'])->order_by("name","asc")->get("sklads")->result();
    for($z2=0;$z2<count($sub_sklads_data1);$z2++){
      $sklads[count($sklads)]['sklads_id'] = $sub_sklads_data1[$z2]['id'];

      $num = count($sklads)-1;
      $sklads[$num]['sklads_name'] = "== =>".$sub_sklads_data1[$z2]['name'];
      $sklads[$num]['sklads_adress'] = $sub_sklads_data1[$z2]['adress'];
      $sklads[$num]['sklads_description'] = $sub_sklads_data1[$z2]['description'];



      $sub_sklads_data2 = $this->db->where("parent_id", $sub_sklads_data1[$z2]['id'])->order_by("name","asc")->get("sklads")->result();
      for($z3=0;$z3<count($sub_sklads_data2);$z3++){
        $sklads[count($sklads)]['sklads_id'] = $sub_sklads_data2[$z3]['id'];
        $num = count($sklads)-1;
        $sklads[$num]['sklads_name'] = "== == =>".$sub_sklads_data2[$z3]['name'];
        $sklads[$num]['sklads_adress'] = $sub_sklads_data2[$z3]['adress'];
        $sklads[$num]['sklads_description'] = $sub_sklads_data2[$z3]['description'];
      }
    }
  }
}



$sklads = $this->prepare_actions_list($sklads, $urls_list); 
 $this->r_v("sklads",$sklads); 
