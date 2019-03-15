<?php
  $this->db = new active_records();
   
  $this->db->where("company_id",$gl_session["session_data"]['company_id']);
  $this->db->order_by("id","desc");

 $data_c = $this->get("data_c");
$data_do= $this->get("data_do");
$valuta = $this->get("valuty");
if($this->isPost()){
  $gl_session["session_data"]['kurc_valut_valuta']=$valuta;
  $gl_session["session_data"]['kurc_valut_data_c']=$data_c;
  $gl_session["session_data"]['kurc_valut_data_do']=$data_do;

}

if($gl_session["session_data"]['kurc_valut_valuta']!= ""){
  $this->db->where("kurc_valut.valuta", $gl_session["session_data"]['kurc_valut_valuta']);
}

if($gl_session["session_data"]['kurc_valut_data_c']!= ""){
  $this->db->where("kurc_valut.currency_date >=", $gl_session["session_data"]['kurc_valut_data_c']);
}

if($gl_session["session_data"]['kurc_valut_data_do']!= ""){
  $this->db->where("kurc_valut.currency_date <=", $gl_session["session_data"]['kurc_valut_data_do']);
}


 $page_num = arg(1); 
 if(isset($page_navigation_url_num)) $page_num = arg($page_navigation_url_num); 
 if($page_num == 0) $page_num = 1; 

 $kurc_valut = $this->db->select("kurc_valut.company_id as kurc_valut_company_id, kurc_valut.rate as kurc_valut_rate, kurc_valut.valuta as kurc_valut_valuta, kurc_valut.currency_date as kurc_valut_currency_date")->limit(20,($page_num-1)*20)->get("kurc_valut", "", "", false)->result(); 
 $items_count = $this->db->select("*")->from("kurc_valut")->count_all_results(); 

   $this->r_v("kurc_valut_create_link", $this->l("kurc_valut_create"));

 $navigation = $this->navigation("kurc_valut","kurc_valut", $items_count, 20,$page_navigation_url_prefix, $page_navigation_url_num); 


for($z=0;$z<count($kurc_valut);$z++){
 $kurc_valut[$z]['kurc_valut_currency_date'] = date('d,m,Y H:i',strtotime($kurc_valut[$z]['kurc_valut_currency_date']));  
}

$valuty = $this->db->where("company_id",$gl_session["session_data"]['company_id'])->get("currencies")->result();
$this->r_v("valuty",$valuty );

$db = new active_records();
if(isset($gl_session["session_data"]['kurc_valut_valuta']) && $gl_session["session_data"]['kurc_valut_valuta'] != ""){
  $db->where("kod_valuty", $gl_session["session_data"]['kurc_valut_valuta']);
}
$valuty_list = $db->where("company_id",$gl_session["session_data"]['company_id'])->get("currencies")->result();
$graphics = array();
for($z=0;$z<count($valuty_list);$z++){
  $db->where("valuta", $valuty_list[$z]['kod_valuty']);
  if($gl_session["session_data"]['kurc_valut_data_c']!= ""){$this->db->where("kurc_valut.currency_date >=", $gl_session["session_data"]['kurc_valut_data_c']);}
  if($gl_session["session_data"]['kurc_valut_data_do']!= ""){$this->db->where("kurc_valut.currency_date <=", $gl_session["session_data"]['kurc_valut_data_do']);}

  $k_valut = $db->limit(20)->get("kurc_valut")->result();
  for($x=0;$x<count($k_valut);$x++){
    if($graphics[$valuty_list[$z]['kod_valuty']]['rate'] != ""){
      $graphics[$valuty_list[$z]['kod_valuty']]['rate'] .= ", ";
      $graphics[$valuty_list[$z]['kod_valuty']]['dates'] .= ", ";
    }
    $koef = 1;
    if($valuty_list[$z]['kod_valuty'] == "RUR") $koef = 100;

    $graphics[$valuty_list[$z]['kod_valuty']]['rate']  .= $k_valut[$x]['rate']*$koef;
    $graphics[$valuty_list[$z]['kod_valuty']]['dates'] .= "'".$k_valut[$x]['currency_date']."'";
  }
}

$graph_code = "<script src='".template_dir."RGraph/libraries/RGraph.common.core.js' ></script>";
$graph_code .= "<script src='".template_dir."RGraph/libraries/RGraph.bar.js' ></script>";
$graph_code .= "<script src='".template_dir."RGraph/libraries/RGraph.bipolar.js' ></script>";
$graph_code .= "<script src='".template_dir."RGraph/libraries/RGraph.hbar.js' ></script>";
$graph_code .= "<script src='".template_dir."RGraph/libraries/RGraph.line.js' ></script>";
$graph_code .= "<script src='".template_dir."RGraph/libraries/RGraph.pie.js' ></script>";

foreach($graphics as $key=>$val){
  $graph_code .= "<div>
                    <h1>{$key}</h1>
                    <canvas id='cvs_{*$key*}' width='800' height='250'>[No canvas support]</canvas>
                    <script>
                      var line = new RGraph.Line('cvs_{*$key*}', [{$val['rate']}])
                      .set('spline', true)
                      .set('numxticks', 11)
                      .set('numyticks', 5)
                      .set('background.grid.autofit.numvlines', 11)
                      .set('colors', ['red'])
                      .set('linewidth', 5)
                      .set('gutter.left', 40)
                      .set('gutter.right', 15)
                      .set('labels',[{$val['dates']}])
                      .set('shadow',true)
                      .set('shadow.color','#aaa')
                      .set('shadow.blur',5)
                      .set('tickmarks',null)
                      .draw();
                    </script>
                  </div>
                  <div class='clear:both;'></div>";
}

$this->r_v("graph_code", $graph_code); 
 $this->r_v("kurc_valut",$kurc_valut); 
