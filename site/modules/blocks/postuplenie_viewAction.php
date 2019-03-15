<?php
  $this->db = new active_records();

function create_table($postuplenie_id){
  $table = "<table class='table table-bordered'>
				        <thead>
				          <tr>
				            <th>Склад</th>
				            <th>Название</th>
				            <th>Количество</th>
                                            <th>Цена</th>
                                            <th>Общая сумма</th>
				          </tr>
				        </thead>
                                    <tbody>";
  $db = new active_records();

  $postuplenie_db = $db->where("id",$postuplenie_id)->get("postuplenie")->result();

  $products_postuplenia =  $db->where("postuplenie_id",$postuplenie_id)->select("sklads.name as sklad_name, postuplenie_tovarov.kolichestvo as kolichestvo, postuplenie_tovarov.price as price, products.name as tovar_name, products.id as tovar_id,postuplenie_tovarov.id as id")->where("products.id","postuplenie_tovarov.tovar_id",1)->where("sklads.id","postuplenie_tovarov.sklad_id",1)->get("postuplenie_tovarov,products,sklads")->result();
  $tovary =  $db->get("products")->result();
  $tovary_cnt = 0;
  $tovary_price = 0;
  for($i=0;$i<count($products_postuplenia);$i++){
    $tovary_cnt += $products_postuplenia[$i]['kolichestvo'];
    $tovary_price += $products_postuplenia[$i]['kolichestvo']*$products_postuplenia[$i]['price'];

    $a = new Actions();
    $url = $a->l("view_tovar/".$products_postuplenia[$i]['tovar_id']);

    $info = calc_price($products_postuplenia[$i]['price'], $postuplenie_db[0]['valuta'], $postuplenie_db[0]['valuta']);
    $price = $info['view'];

    $info = calc_price($products_postuplenia[$i]['kolichestvo']*$products_postuplenia[$i]['price'], $postuplenie_db[0]['valuta'], $postuplenie_db[0]['valuta']);
    $total_price = $info['view'];

    $table .= "<tr>";
    $table .= "<td>".$products_postuplenia[$i]['sklad_name']."</td>";
    $table .= "<td><a target='__blank' href='{$url}'>".$products_postuplenia[$i]['tovar_name']."</a></td>";
    $table .= "<td><span class='cnt'>".$products_postuplenia[$i]['kolichestvo']."</span><span class='cnt_edit'></span></td>";
    $table .= "<td><span class='price'>".$price."</span><span class='price_edit'></td>";
    $table .= "<td><span class='summa'>".$total_price."</span><span class='price_edit'></td>";
    $table .= "</tr>";
  }

  $info = calc_price($tovary_price, $postuplenie_db[0]['valuta'], $postuplenie_db[0]['valuta']);
  $tovary_price = $info['view'];

  $table .= "<tr><td><strong>Итого</strong></td><td>-</td><td><strong>".$tovary_cnt."</strong></td><td><strong>-</strong></td><td><strong>".$tovary_price."</strong></td></tr>";

  $table .= "				        </tbody>
				      </table>";
  return  $table;
}

  $postuplenie_id = arg(1);
  $table = create_table($postuplenie_id);
  $this->r_v("table",$table);


$postuplenie_db = $this->db->where("id",$postuplenie_id)->get("postuplenie")->result();
$postuplenie_db[0]['data_postupleniya'] = date('d.m.Y',strtotime($postuplenie_db[0]['data_postupleniya']));

$info = calc_price($postuplenie_db[0]['summa'], $postuplenie_db[0]['valuta'], $postuplenie_db[0]['valuta']);
$postuplenie_db[0]['summa'] = $info['view'];

$this->r_v("postuplenie_db",$postuplenie_db[0]);

$postavshik_db = $this->db->where("id",$postuplenie_db[0]['postavshik_id'])->get("postavshiki")->result();
$this->r_v("postavshik_db",$postavshik_db[0] ); 
