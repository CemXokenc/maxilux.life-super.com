<?php
  $this->db = new active_records();
   $do = $this->get("do");
   $cmd = $this->get("cmd");
   $cancel_cmd = $this->get("cancel_cmd");
   if($do == "postavshiki_update" && (!empty($cancel_cmd) || $cmd == "Отмена" || $cmd == "Cancel")){
     $this->redirect($this->l("postavshiki"));
   }
 $postavshiki_update_id = $this->getVariable("id");

 if($this->isPost() && $do == "postavshiki_update"){
   $postavshiki_zip_code = $this->getVariable("postavshiki_zip_code");
 $postavshiki_img = "";
 if($_FILES["postavshiki_img"]["error"] == UPLOAD_ERR_OK) {
   $postavshiki_img = "1";
 }
   $postavshiki_debet = $this->getVariable("postavshiki_debet");
   $postavshiki_office = $this->getVariable("postavshiki_office");
   $postavshiki_house = $this->getVariable("postavshiki_house");
   $postavshiki_telephone = $this->getVariable("postavshiki_telephone");
   $postavshiki_street = $this->getVariable("postavshiki_street");
   $postavshiki_city = $this->getVariable("postavshiki_city");
   $postavshiki_email = $this->getVariable("postavshiki_email");
   $postavshiki_name = $this->getVariable("postavshiki_name");
   $postavshiki_credit = $this->getVariable("postavshiki_credit");
   
   $data = array("zip_code"=>$postavshiki_zip_code, "debet"=>$postavshiki_debet, "office"=>$postavshiki_office, "house"=>$postavshiki_house, "telephone"=>$postavshiki_telephone, "street"=>$postavshiki_street, "city"=>$postavshiki_city, "email"=>$postavshiki_email, "name"=>$postavshiki_name, "credit"=>$postavshiki_credit, );
 if($_FILES["postavshiki_img"]["error"] == UPLOAD_ERR_OK) {
   $data["img"] = $postavshiki_img;
 }

   $this->db->where("id", $postavshiki_update_id)->update("postavshiki",$data);

   
 $uploads_dir     = dirname(__FILE__)."/../../templates/img/postavshiki/";
 if($_FILES["postavshiki_img"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["postavshiki_img"]["tmp_name"];
   $name = $postavshiki_update_id;
   move_uploaded_file($tmp_name, "$uploads_dir/{$name}.jpg");
 }
   global $gl_session;
   $gl_session["session_data"]["system_messages"]["postavshiki"] = "Данные успешно обновлены";
   $this->redirect($this->l("postavshiki"));
 }
 $postavshiki_update_data = $this->db->where("id", $postavshiki_update_id)->get("postavshiki")->result();
 $this->r_v("postavshiki_update_data",$postavshiki_update_data[0]);

$postavshik_id = arg(1);
function create_table($postavshik_id){
  $table = "<table class='table table-bordered'>
             <thead>
              <tr>
                <th>Документ</th>
                <th style='width:150px;'>Управление</th>
              </tr>
             </thead>
            <tbody>";

  $db = new active_records();
  $relation_documents =  $db->where("postavshik_id",$postavshik_id)->get("relation_documents")->result();
  for($i=0;$i<count($relation_documents);$i++){
    $table .= "<tr>";
        $table .= "<td><a href='".$relation_documents[$i]['url']."' target='_blank'>".$relation_documents[$i]['url']."</a></td>";
    $table .= "<td><span class='label label-default relation_documents_delete' document-id='".$relation_documents[$i]['id']."'>Удалить</span></td>";
    $table .= "</tr>";
  }

  $table .= "</tbody></table>";
  return  $table;
}

$do = $this->get("do");
if($this->isPost() && $do=="refresh"){
  $document_url = $this->get("document_url");


  $data = array(
    'url' => $document_url ,
    'postavshik_id' => $postavshik_id,
    'company_id' => $gl_session["session_data"]['company_id'],
  );
  $this->db->insert("relation_documents",$data);

  $table = create_table($postavshik_id);
  echo json_encode(array(
    "table" => $table,
  ));
  exit();
}

if($this->isPost() && $do =="documents_delete"){
  $relation_documents_id = $this->get("document_id");
  $this->db->where("id",$relation_documents_id)->delete('relation_documents');
  $table = create_table($postavshik_id);
  echo json_encode(array(
    "table" => $table,
  ));
  exit();
}
$table = create_table($postavshik_id);
$this->r_v("table",$table); 
