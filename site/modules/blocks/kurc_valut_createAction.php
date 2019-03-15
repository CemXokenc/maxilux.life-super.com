<?php
  $this->db = new active_records();
if($this->isPost()){
   $do = $this->getVariable("do");
	if($do == "save")
	{
		$dollar = $this->get("dollar");
		$evro = $this->get("euro");
		$rubli = $this->get("rub");

		echo $dollar,'-', $evro,'-', $rubli;

		$this->db->set("currency_date",date('o-m-d H:i'))->set("company_id",$gl_session["session_data"]['company_id'])->set("valuta","USD")->set("rate",$dollar)->insert('kurc_valut');
		$this->db->set("currency_date",date('o-m-d H:i'))->set("company_id",$gl_session["session_data"]['company_id'])->set("valuta","EUR")->set("rate",$evro)->insert('kurc_valut');
		$this->db->set("currency_date",date('o-m-d H:i'))->set("company_id",$gl_session["session_data"]['company_id'])->set("valuta","RUR")->set("rate",$rubli)->insert('kurc_valut');
		$this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("kod_valuty","USD")->set("rate",$dollar)->update('currencies');
		$this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("kod_valuty","EUR")->set("rate",$evro)->update('currencies');
		$this->db->where("company_id",$gl_session["session_data"]['company_id'])->where("kod_valuty","RUR")->set("rate",$rubli)->update('currencies');
	}

   $this->redirect($this->l("kurc_valut"));  
}
/*
$html = file_get_html("http://aval.ua");
echo $html;

$currency_row = $html->find('.right-currency-block-rba',0)->find('tr');

$dollars = $currency_row[1]->find('.right',1)->plaintext;
$evro = $currency_row[2]->find('.right',1)->plaintext;
$rubli  = $currency_row[3]->find('.right',1)->plaintext;

$dollars = str_replace(",",".",$dollars);
$evro = str_replace(",",".",$evro);
$rubli = str_replace(",",".",$rubli);

echo $dollars;
exit;

$products_list = $this->db->where("old_product_id >",0)->get("products")->result();
for($i=0;$i<count($products_list);$i++){
  if($products_list[$i]['session_data'] != ""){
    $session_data = $products_list[$i]['session_data'];
    $session_data = unserialize($session_data);

    $session_data = $session_data['cart'];
    $main_tovar_id = $products_list[$i]['old_product_id'];
    $info = generate_review_and_price($session_data, $main_tovar_id,0,0);

    $this->db->where("id", $products_list[$i]['id'])->update("products", array("selling_price"=>$info['rozn_total'], "price"=>$info['total']));
  }
}
*/
$this->r_v("dollars", $dollars);
$this->r_v("evro", $evro);
$this->r_v("rubli", $rubli); 
