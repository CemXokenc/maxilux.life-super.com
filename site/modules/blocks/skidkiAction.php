<?php
  $this->db = new active_records();

$do = $this->get("do");
if($this->isPost() && $do=="skidki_update"){
  $skidki_name = $this->get("skidki_name");
  $skidki_amount = $this->get("skidki_amount");
  $skidki_percent = $this->get("skidki_percent");
  if($gl_session["session_data"]['skidki_update']==1){
    foreach ($skidki_name as $skidka_id=>$name){
      $this->db->where("id",$skidka_id)->set("company_id",$gl_session["session_data"]['company_id'])->set("name",$skidki_name[$skidka_id])->set("amount",$skidki_amount[$skidka_id])->set("percent",$skidki_percent[$skidka_id])->update("skidki");
    }
  }
}


function new_skidki($db){
  global $gl_session;
  $torgovaya_tochka_id = 0;
  if($gl_session["session_data"]['type_group'] != 12){
    $torgovaya_tochka_id = $gl_session["session_data"]['torgovaya_tockka'];
  }
  for($z=0;$z<20;$z++){
    $data = array(
      'company_id'=>$gl_session["session_data"]['company_id'],
      'name' => '',
      'amount' => 0,
      'percent' => 0,
      'torgovaya_tochka_id' => $torgovaya_tochka_id,
    );
    $db->insert("skidki", $data);
  }
}
function get_skidki($db){
  global $gl_session;
  if($gl_session["session_data"]['user_type'] == 5){
    $db->where("torgovaya_tochka_id", 0);
  }else{
    $db->where("torgovaya_tochka_id", $gl_session["session_data"]['torgovaya_tockka']);
  }
  return $db->where("company_id",$gl_session["session_data"]['company_id'])->get("skidki")->result();
}

if($gl_session["session_data"]['torgovaya_tockka'] > 0 && $gl_session["session_data"]['user_type'] != 5){
  $torgovaya_tockka_info = $this->db->where("id",$gl_session["session_data"]['torgovaya_tockka'])->get("torgovye_tochki")->result();
  $skidka_info = $this->db->where("id",$torgovaya_tockka_info[0]['skidka_id'])->get("skidki")->result();
  $this->r_v("skidka_val",$skidka_info[0]);
  $this->r_v("skidka",count($skidka_info));
}

$skidki_db = get_skidki($this->db, $gl_session["session_data"]);
if(count($skidki_db)<1){
  new_skidki($this->db, $type_group);
  $skidki_db = get_skidki($this->db, $gl_session["session_data"]);
}

$this->r_v("skidki_db",$skidki_db); 
