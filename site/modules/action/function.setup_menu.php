<?php

 /* attach top menu */
 $menu_name = "top_menu";
 include_once(dirname(__FILE__)."/../../aac/menu.main.php"); 

 $css_link = $this->l("css"); 
 $this->r_v("css_link", $css_link); 
 include(__DIR__."/../blocks/left_menu_mainAction.php"); 

 $this->db = new active_records();

function menu_table(){
  $table = "<table class='table table-bordered'>
              <thead>
                <tr>
                  <th style='width:200px;'>Название</th>
                  <th style='width:100px;'>Ссылка</th>
                  <th style='width:100px;'>Тип</th>
                  <th>Управление</th>
                </tr>
              </thead>
            <tbody>";

  global $gl_session;
  $db = new active_records();

  $menu = array();
  $menu_data = $db->where("parent_id", 0)->where("company_id",$gl_session["session_data"]['company_id'])->get("company_menu")->result();

  for ($z = 0; $z < count($menu_data); $z++) {
    $menu[] = array(
      'id' => $menu_data[$z]['id'],
      "name" => $menu_data[$z]['name'],
      "url" => $menu_data[$z]['url'],
      "user_right" => $menu_data[$z]['user_right'],
    );
    $sub_menu_data = $db->where("parent_id", $menu_data[$z]['id'])->where("company_id",$gl_session["session_data"]['company_id'])->get("company_menu")->result();
    for ($z1 = 0; $z1 < count($sub_menu_data); $z1++) {
      $menu[] = array(
        'id' => $sub_menu_data[$z1]['id'],
        "name" => "=>".$sub_menu_data[$z1]['name'],
        "url" => $sub_menu_data[$z1]['url'],
        "user_right" => $sub_menu_data[$z1]['user_right'],
      );
    }
  }

  $a = new Actions();
  for($z=0;$z<count($menu);$z++){
    $table .= "<tr>";
    $table .= "<td>{$menu[$z]['name']}</td>";
    $table .= "<td>{$menu[$z]['url']}</td>";
    $table .= "<td>{$menu[$z]['user_right']}</td>";
    $table .= "<td><span class='label label-default link_delete' link-id='{$menu[$z]['id']}'>Удалить</span></td>";
    $table .= "</tr>";
  }

  $table .= "</tbody></table>";

  return  $table;
}

$type_post = $this->get("type");
if($this->isPost() && $type_post=="refresh_menu"){
  
  $menu_name = $this->get("menu_name");
  $link = $this->get("link");
  $parent_link = $this->get("parent_link");  
  $parent_id =  $parent_link;
  $system_l="";
  $user_right = "";
  if($parent_id > 1 ){
    $system_link = $this->db->where("id",$link)->get("system_links")->result();
    if($menu_name == ""){
       $menu_name = $system_link[0]['page_name'];   
    }
       $user_right = $system_link[0]['user_right'];
      $system_l=$system_link[0]['url'];
  }
  $data = array(
    'name' => $menu_name,
    'url' => $system_l,
    'company_id' => $gl_session["session_data"]['company_id'],
    'parent_id' => $parent_id ,
    'user_right' =>  $user_right,
  );

  $this->db->insert("company_menu",$data);

  $menu_table = menu_table();

$parent_links_db = $this->db->where("parent_id",0)->where("company_id",$gl_session["session_data"]['company_id'])->get("company_menu")->result();
$parent_links = "<option value='0'>Не выбрана</option>";
for($i=0;$i<count($parent_links_db);$i++){
  $parent_links .= "<option value='".$parent_links_db[$i]['id']."'>".$parent_links_db[$i]['name']."</option>";
}

  echo json_encode(array(
    "table" => $menu_table,
    "select_data" => $parent_links,
  ));
  exit();
}

if($this->isPost() && $type_post =="delete"){
    $link = $this->get("link_id");
    $this->db->where("id",$link )->delete('company_menu');
    $this->db->where("parent_id",$link )->delete('company_menu');
$menu_table = menu_table();

$parent_links_db = $this->db->where("parent_id",0)->where("company_id",$gl_session["session_data"]['company_id'])->get("company_menu")->result();
$parent_links = "<option value='0'>Не выбрана</option>";

for($i=0;$i<count($parent_links_db);$i++){
  $parent_links .= "<option value='".$parent_links_db[$i]['id']."'>".$parent_links_db[$i]['name']."</option>";
}


  echo json_encode(array(
    "table" => $menu_table,
    "select_data" => $parent_links,
  ));
  exit();
    exit();
}

$menu_table = menu_table();
$this->r_v("menu_table",$menu_table);

$parent_links_db = $this->db->where("parent_id",0)->where("company_id",$gl_session["session_data"]['company_id'])->get("company_menu")->result();
$parent_links = "<select id='parent_links' class='form-control'>
<option value='0'>Не выбрана</option>";
for($i=0;$i<count($parent_links_db);$i++){
  $parent_links .= "<option value='".$parent_links_db[$i]['id']."'>".$parent_links_db[$i]['name']."</option>";
}

$parent_links .= "</select>";
$this->r_v("parent_links",$parent_links);

$system_links = $this->db->get("system_links")->result();
$this->r_v("system_links",$system_links);

 return $this->showPage('setup_menu');
?>