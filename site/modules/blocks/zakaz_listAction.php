<?php
  $this->db = new active_records();
   

if($this->isPost())
{
	if($_POST['do'] == 'hide_item')
	{
		$this->db->where("id",$_POST['id'])->update("orders", array("hidden" => $_POST['type']));
		system_stop();
	}
	
	if($_POST['action'] == 'save_order_comment')
	{
		$order_id = $this->get("order_id");
		$label_id = $this->get("label_id");
		//$label_color = $this->get("label_color");
		$text = $this->get("text");
		
		if($order_id == '' || $label_id == '')
		{
			echo 'Ошибка! Необходимо выбрать цвет комментария!';
			system_stop();
		}
		
		$data = array( 
		"order_id" => $order_id,
		"label_id" => $label_id,
		"comment" => strip_tags($text)
		);

		$results = $this->db->where("order_id",$order_id)->count_all_results("order_comment");
		
		if($results > 0)
			$this->db->where("order_id",$order_id)->update("order_comment",$data);
		else $this->db->insert("order_comment",$data);
		
		echo 1;
		system_stop();
	}
	
	if($_POST['reset_filter'] == '1')
	{
		$gl_session["session_data"]['order_order_by_column'] = "";
		$gl_session["session_data"]['order_order_as'] = "";
		$this->db->where("hidden",0);
	}
	else
	{	
		if($_POST['do'] == 'sort' || $_POST['do'] == 'filter')
		{
			if(isset($_POST['sort_by']))
			{
				$gl_session["session_data"]['order_order_by_column'] = "orders.".$_POST['sort_by'];
				$gl_session["session_data"]['order_order_as'] = $_POST['sort_type'];
			}
			else
			{
				$order_as = $this->get("order_as");
				$order_by_column = $this->get("order_by_column");

				$gl_session["session_data"]['order_order_by_column'] = $order_by_column;
				$gl_session["session_data"]['order_order_as'] = $order_as;
			}
		}
	}
}


$this->db->where("orders.delete_status",0);
if($gl_session["session_data"]['user_type'] == 12 || $gl_session["session_data"]['user_type'] == 6){
   $this->db->where("orders.torgovaya_tochka_id",$gl_session["session_data"]['torgovaya_tockka']);
}

$this->db->where("orders.torgovaya_tochka_id", "torgovye_tochki.id",1);
if($block_attr_zakaz_list == "view_client"){
  $client_id=arg(1);
  $this->db->where("orders.client_id",$client_id);
  $this->r_v("view_client", "1");
}

if($block_attr_zakaz_list == "view_torgovaya_tochka"){
  $torg_tochka=arg(1);
  $this->db->where("orders.torgovaya_tochka_id",$torg_tochka);
  $this->r_v("view_client", "1");//чтобы не отображался фильтр
}
if($block_attr_zakaz_list == "view_client"){
  $gl_session["session_data"]['zakaz_client']=arg(1);
}

if($block_attr_zakaz_list == "view_client" || $block_attr_zakaz_list == "view_torgovaya_tochka"){
  $page_navigation_url_num = 2;
  $page_navigation_url_prefix = arg(1)."/";
}

if($this->isPost())
{
	
	if($_POST['do'] == 'filter2')
	{
		if($_POST['view_checked'] == '1') 
			$gl_session["session_data"]['view_checked'] = 1;
		else $gl_session["session_data"]['view_checked'] = 0;
	}
	else
	{
		$data_c = $this->get("data_c");
		$data_do= $this->get("data_do");
		$torg_tochka = $this->get("torg_tchk");
		$client = $this->get("client");
		$manager= $this->get("manager");
		$order_num = $this->get("order_num");
		$order_statuses = $this->get("order_statuses");
		$client_name = $this->get("name_client");
		$skidka = $this->get("skidka");
		$valyta = $this->get("valuty");
		 
		$gl_session["session_data"]['zakaz_client_name']=$client_name;
		$gl_session["session_data"]['zakaz_client']=$client;
		$gl_session["session_data"]['zakaz_torg_tochka']=$torg_tochka;
		$gl_session["session_data"]['zakaz_manager']=$manager;
		$gl_session["session_data"]['zakaz_data_c']=$data_c;
		$gl_session["session_data"]['zakaz_data_do']=$data_do;
		$gl_session["session_data"]['zakaz_skidka']=$skidka ;
		$gl_session["session_data"]['zakaz_order_num']=$order_num;
		$gl_session["session_data"]['zakaz_order_statuses']=$order_statuses;
		$gl_session["session_data"]['zakaz_valyta']=$valyta ;
	}
}

if($gl_session["session_data"]['view_checked'] == 1)
	$this->r_v("area_checked","checked");
else $this->db->where("hidden",0);

if($gl_session["session_data"]['zakaz_skidka']!= ""){
  $this->db->where("clients.skidka_id", $gl_session["session_data"]['zakaz_skidka']);
}

if( $gl_session["session_data"]['zakaz_client_name']!= ""){
  $this->db->like("clients.fio", $gl_session["session_data"]['zakaz_client_name']);
}

if($gl_session["session_data"]['zakaz_data_c']!= ""){
  $this->db->where("orders.order_date >=", $gl_session["session_data"]['zakaz_data_c']);
}
if($gl_session["session_data"]['zakaz_order_num']!= ""){
  $this->db->where("orders.nomer", $gl_session["session_data"]['zakaz_order_num']);
}

if($gl_session["session_data"]['zakaz_order_statuses']!= ""){
  $this->db->where("orders.default_status", $gl_session["session_data"]['zakaz_order_statuses']);
}


if($gl_session["session_data"]['zakaz_data_do']!= ""){
  $this->db->where("orders.order_date <=", $gl_session["session_data"]['zakaz_data_do']);
}

$this->db->where("orders.default_status","orders_statuses.id",1);
$this->db->where("orders.client_id","clients.id",1);


if($gl_session["session_data"]['user_type'] == 12){
  $this->db->where("orders.torgovaya_tochka_id",$gl_session["session_data"]['torgovaya_tockka']);
}

if($gl_session["session_data"]['zakaz_torg_tochka'] != "" && $gl_session["session_data"]['zakaz_torg_tochka'] != "0" && $gl_session["session_data"]['user_type'] == 5 &&$block_attr_zakaz_list != "view_torgovaya_tochka"){

   $this->db->where("orders.torgovaya_tochka_id",$gl_session["session_data"]['zakaz_torg_tochka'] );
}

if($gl_session["session_data"]['zakaz_client'] != "" && $gl_session["session_data"]['zakaz_client']!= "0" && $block_attr_zakaz_list != "view_client"){
   $this->db->where("orders.client_id",$gl_session["session_data"]['zakaz_client']);
}


if($gl_session["session_data"]['zakaz_manager']!= "" && $gl_session["session_data"]['zakaz_manager']!= "0"){
   $this->db->where("orders.manager_id",$gl_session["session_data"]['zakaz_manager']);
}

if($gl_session["session_data"]['order_order_by_column'] != ""  && $gl_session["session_data"]['order_order_as'] != "")
{
	$fav_coll = $gl_session["session_data"]['order_order_by_column'];
	
	$fav_coll = str_replace("orders.", "", $fav_coll);
	
	$this->r_v("active_sort_id",$fav_coll);
	
	if($gl_session["session_data"]['order_order_as'] == 'desc')
		$active_sort = "down";
	else $active_sort = "up";
	
	$this->r_v("active_sort",$active_sort);
	
	$this->db->order_by($gl_session["session_data"]['order_order_by_column'], $gl_session["session_data"]['order_order_as']);
}
else 
{
	$this->db->order_by("orders.id","desc");
	$this->r_v("active_sort_id","id");
	$this->r_v("active_sort","down");
}


 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $zakaz_list = $this->db->select("orders_statuses.name as orders_statuses_name, orders_statuses.color as orders_statuses_color, orders_statuses.id as orders_statuses_id, clients.id as clients_id, clients.fio as clients_fio, torgovye_tochki.name as torgovye_tochki_name, torgovye_tochki.id as torgovye_tochki_id, orders.hidden as orders_hidden, orders.delete_status as orders_delete_status, orders.skidka_office_amount as orders_skidka_office_amount, orders.valuta as orders_valuta, orders.email as orders_email, orders.fio as orders_fio, orders.skidka_amount as orders_skidka_amount, orders.default_status as orders_default_status, orders.manager_id as orders_manager_id, orders.company_id as orders_company_id, orders.nomer as orders_nomer, orders.torgovaya_tochka_id as orders_torgovaya_tochka_id, orders.client_id as orders_client_id, orders.summa as orders_summa, orders.order_date as orders_order_date, orders.id as orders_id")->limit(20,($page_num-1)*20)->get("orders_statuses, clients, torgovye_tochki, orders", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("orders_statuses, clients, torgovye_tochki, orders")->count_all_results(); 


 $urls_list = array(); 
 $urls_list[] = array("action"=>"order_view", "id"=>"orders_id", "num"=>"0", "label"=>"order_view", "html"=>"", "ajax"=>"0"); 
 $zakaz_list = $this->prepare_actions_list($zakaz_list,$urls_list); 

 $navigation = $this->navigation("zakaz_list","zakaz_list", $items_count, 20,$page_navigation_url_prefix, $page_navigation_url_num); 



for($z=0;$z<count($zakaz_list);$z++){

 $zakaz_list[$z]['orders_order_date'] = date('d.m.Y H:i',strtotime($zakaz_list[$z]['orders_order_date']));

  /*client amount*/
  $orders_summa =  $zakaz_list[$z]['orders_summa']-$zakaz_list[$z]['orders_skidka_amount'];
  $info_client = calc_price( $orders_summa, $zakaz_list[$z]['orders_valuta'],$zakaz_list[$z]['orders_valuta']);

  /*office amount*/
  $orders_summa =  $zakaz_list[$z]['orders_summa']-$zakaz_list[$z]['orders_skidka_office_amount'];
  $info_office = calc_price( $orders_summa, $zakaz_list[$z]['orders_valuta'],$zakaz_list[$z]['orders_valuta']);

  $zakaz_list[$z]['orders_itogo'] = $info_client['view']."<br>".$info_office['view'];

  if($gl_session["session_data"]['zakaz_valyta']==""){
    $info = calc_price($zakaz_list[$z]['orders_summa'], $zakaz_list[$z]['orders_valuta'],$zakaz_list[$z]['orders_valuta']);
  }else{
    $info = calc_price($zakaz_list[$z]['orders_summa'], $zakaz_list[$z]['orders_valuta'],$gl_session["session_data"]['zakaz_valyta']);
  }
  $zakaz_list[$z]['orders_summa'] = $info['view'];


  $zakaz_list[$z]['client_info_url'] = $this->l("view_client/".$zakaz_list[$z]['clients_id']);
  $info = calc_price($zakaz_list[$z]['orders_skidka_amount'], $zakaz_list[$z]['orders_valuta'],$zakaz_list[$z]['orders_valuta']);
  $zakaz_list[$z]['orders_skidka_amount'] = $info['view'];
  
  $commnent = $this->db->
  select("label_id,comment,color,name")->
  where('order_comment.order_id',$zakaz_list[$z]['orders_nomer'])->
  where('order_comment.label_id','order_comment_label.id',1)->
  get('order_comment,order_comment_label')->result();
  
  if(count($commnent)) $zakaz_list[$z]['comment'] = '<div class="order_comment_item" order_id="'.$zakaz_list[$z]['orders_nomer'].'" style="background-color:'.$commnent[0]['color'].';" 
  alt="'.$commnent[0]['name'].'" label_id="'.$commnent[0]['label_id'].'">'.$commnent[0]['comment'].'</div>';
  else $zakaz_list[$z]['comment'] = '<div class="order_comment_item" order_id="'.$zakaz_list[$z]['orders_nomer'].'"></div>';

}

$torg_tochki = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("torgovye_tochki")->result();
$this->r_v("torg_tochki", $torg_tochki);
if($gl_session["session_data"]['user_type']!="12"){$clients = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("clients")->result();
  $this->r_v("clients", $clients);
}
if($gl_session["session_data"]['user_type']=="12"){$clients = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("torgovaya_tochka_id",$gl_session["session_data"]['torgovaya_tockka'])->get("clients")->result();
  $this->r_v("clients", $clients);
}

$managers = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("user_type",12)->get("users")->result();
$this->r_v("managers", $managers);

$order_statuses = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("orders_statuses")->result();
$this->r_v("order_statuses", $order_statuses);

$skidki_db= $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("skidki")->result();
$this->r_v("skidki_db", $skidki_db);

$valuty = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("currencies")->result();
$this->r_v("valuty",$valuty ); 
 $this->r_v("zakaz_list",$zakaz_list); 
