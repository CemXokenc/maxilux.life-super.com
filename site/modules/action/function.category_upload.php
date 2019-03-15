<?php

 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 

 $css_link = $this->l("css"); 
 $this->r_v("css_link", $css_link); 
 include(__DIR__."/../blocks/left_menu_mainAction.php"); 

 $this->db = new active_records();

if($gl_session["session_data"]['category_upload_csv']!=1){
   $this->redirect($this->l("login"));   
}

$category_id = arg(1);

if($this->isPost()){
  if($this->isPost() && $_FILES["csv_file"]["error"] == 0){
    $row = 0;
    if (($handle = fopen($_FILES['csv_file']['tmp_name'], "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        if($data['0'] != ""){
          $row++;
          $product_data = array(
            'name' => $data['0'],
            'description' => $data['1'],
            'price' => $data['2'],
            'currency' => $data['3'],
            'company_id' => $gl_session["session_data"]['company_id'],
            'category_id'=>$category_id,
          );

          $this->db->insert("products", $product_data);
        }
      }
      $this->r_v("success","Загружено успешно: {$row} продуктов");
      fclose($handle);
    }
  }
}

 return $this->showPage('category_upload');
?>