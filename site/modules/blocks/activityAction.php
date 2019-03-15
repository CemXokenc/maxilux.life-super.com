<?php
  $this->db = new active_records();
   
if($block_attr_type == "view_user"){
  $page_navigation_url_num = 2;
  $page_navigation_url_prefix = arg(1)."/";
}

$this->db->where("activity.company_id",$gl_session["session_data"]['company_id']);
$this->db->where("activity.user_id","users.id",1);
$this->db->where("activity.operation","operacii.id",1);
$this->db->order_by("activity.id","desc");

$data_c = $this->get("data_c");
$data_do= $this->get("data_do");
$nomer_zakaza= $this->get("order_num");
$operaciya_id = $this->get("operaciya_id");
$manager= $this->get("manager");
if($this->isPost()){

  $gl_session["session_data"]['zakaz_data_c']=$data_c;
  $gl_session["session_data"]['zakaz_data_do']=$data_do;
  $gl_session["session_data"]['nomer_zakaza']=$nomer_zakaza;
  $gl_session["session_data"]['operaciya_id']=$operaciya_id ;
  $gl_session["session_data"]['manager']=$manager;
}
if($gl_session["session_data"]['zakaz_data_c']!= ""){
  $this->db->where("activity.created >=", $data_c);
}

if($gl_session["session_data"]['zakaz_data_do']!= ""){
  $this->db->where("activity.created <=", $data_do);
}

if($gl_session["session_data"]['nomer_zakaza']!= ""){
  $this->db->where("activity.order_id", $nomer_zakaza );
}
if($gl_session["session_data"]['operaciya_id']!= ""){
  $this->db->where("activity.operation", $operaciya_id);
}
if($gl_session["session_data"]['manager']!= ""){
  $this->db->where("activity.user_id",$manager);
}

if($block_attr_type == "view_user"){
$manager = arg(1);
$this->db->where("activity.user_id",$manager);
$this->r_v("type_page",1);
}


$type_page = arg(0);
if($type_page=="order_view"){
$order_id= arg(1);
$this->db->where("activity.order_id",$order_id);
}
//$this->db->print_query();


 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $activity = $this->db->select("operacii.name as operacii_name, operacii.id as operacii_id, activity.order_id as activity_order_id, activity.details as activity_details, activity.created as activity_created, activity.user_id as activity_user_id, activity.operation as activity_operation, activity.company_id as activity_company_id, activity.id as activity_id, users.first_name as users_first_name, users.last_name as users_last_name, users.id as users_id, users.name as users_name")->limit(100,($page_num-1)*100)->get("operacii, activity, users", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("operacii, activity, users")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"view_user", "id"=>"users_id", "num"=>"0", "label"=>"view_user", "html"=>"", "ajax"=>"0"); 
 $activity = $this->prepare_actions_list($activity,$urls_list); 

 $navigation = $this->navigation("order_view","activity", $items_count, 100,$page_navigation_url_prefix, $page_navigation_url_num); 

/*
if($gl_session["session_data"]['activity_list'] != 1){
  $this->redirect($this->l("login"));
}
*/



for($i=0;$i<count($activity);$i++){

$activity[$i]['activity_created'] = date('d.m.Y H:i',strtotime($activity[$i]['activity_created']));  
 $activity[$i]['activity_operation'] .= "Проба";
  if($activity[$i]['activity_operation']==1){
     $order = $this->db->where("id",$activity[$i]['activity_details'])->get("orders")->result();
     $order_link = $this->l("order_view/".$order[0]['id']);
     $activity[$i]['operacii_name'] .= "<br><a href='".$order_link."'>№".$order[0]['nomer']."</a>";
  }
   if($activity[$i]['activity_operation']==2){
     $order = $this->db->where("id",$activity[$i]['activity_order_id'])->get("orders")->result();
     $order_link = $this->l("order_view/".$order[0]['id']);
     $operaciya_db = unserialize($activity[$i]['activity_details']);
     $status_s = $this->db->where("id",$operaciya_db[0])->get("orders_statuses")->result();
     $order_link = $this->l("order_view/".$order[0]['id']);
    $status_na = $this->db->where("id",$operaciya_db[1])->get("orders_statuses")->result();
     $status_s[0]['name'] = '"'.$status_s[0]['name'].'"';
     $status_na[0]['name'] = '"'.$status_na[0]['name'].'"';
     $activity[$i]['operacii_name'] .= " <a href='".$order_link."'>№".$order[0]['nomer']."</a>"."<br>С ".$status_s[0]['name']."<br>на ".$status_na[0]['name'];
  }

      if($activity[$i]['activity_operation']==3){
     $client = $this->db->where("id",$activity[$i]['activity_details'])->get("clients")->result();
     $client_link= $this->l("order_view/".$client[0]['id']);
     $activity[$i]['operacii_name'] .= " ".$client[0]['fio'];
     }

    if($activity[$i]['activity_operation']==4){

     $order_link = $this->l("postuplenie_view/".$activity[$i]['activity_details']);
     $product = $this->db->where("id",$operaciya_db[1])->get("products")->result();
     $activity[$i]['operacii_name'] = " <a href='".$order_link."'>".$activity[$i]['operacii_name']."</a><br>";
     }

     if($activity[$i]['activity_operation']==5){

       $order_link = $this->l("zayavka_view/".$activity[$i]['activity_order_id']);
       $zayavka = $this->db->where("id",$activity[$i]['activity_order_id'])->get("zayavki")->result();
      $activity[$i]['operacii_name'] .= "<br><a href='".$order_link."'>№".$zayavka[0]['nomer']."</a>";
     }
     
       if($activity[$i]['activity_operation']==6){

       $order_link = $this->l("zayavka_view/".$activity[$i]['activity_order_id']);
       $zayavka = $this->db->where("id",$activity[$i]['activity_order_id'])->get("zayavki")->result();
        $name_status = "Новый заказ";
       if($activity[$i]['activity_details']==2){
              $name_status = "Товар получен";
       }
         $activity[$i]['operacii_name'] .= "<br><a href='".$order_link."'>№".$zayavka[0]['nomer']."</a> на ".'"'.$name_status.'"';
     }
}

$managers = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("user_type",12)->get("users")->result();
$this->r_v("managers", $managers);
$operacii = $this->db->get("operacii")->result();
$this->r_v("operacii",$operacii); 
 $this->r_v("activity",$activity); 
