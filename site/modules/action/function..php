<?php

 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 


 /* the left_menu_main section */ 
 $this->db = new active_records();
   
 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $left_menu_main = $this->db->select("")->get("")->result(); 
$left_categories = array();


  $left_categories[] = array("name"=>"Пользователи", "url"=>$this->l("users"));
  $left_categories[] = array("name"=>"Торговые точки", "url"=>$this->l("torgovye_tochki"));
  $left_categories[] = array("name"=>"Клиенты", "url"=>$this->l("clients"));
  $left_categories[] = array("name"=>"Выход", "url"=>$this->l("logout"));

                                                                                                                              
  
$this->r_v('left_categories',$left_categories); 
 $this->r_v("left_menu_main",$left_menu_main); 

 /* the category_create section */ 
 $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   if($do == "category_create" && $cmd == "Отмена"){
     $this->redirect($this->l("categories"));
   }

 if($this->isPost()){
   
   $data = array();

   $category_create_id = $this->db->insert("",$data)->result();

   
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["categories"] = "Категория успешно добавлена";
   $this->redirect($this->l("categories"));
 }
$categories = array();
$categories[0] = "нет";
$categories_data = $this->db->where("parent_id",0)->order_by("name","asc")->get("categories")->result();
for($z=0;$z<count($categories_data);$z++){
  $categories[$categories_data[$z]['id']] = $categories_data[$z]['name']; 
  $sub_categories_data = $this->db->where("parent_id", $categories_data[$z]['id'])->order_by("name","asc")->get("categories")->result();
  for($z1=0;$z1<count($sub_categories_data);$z1++){
    $categories[$sub_categories_data[$z1]['id']] = "=>".$sub_categories_data[$z1]['name']; 
  }
}

$this->ddb('category_create_categories_parent_id',$categories); 



 return $this->showPage('');
?>