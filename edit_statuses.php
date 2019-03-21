<?php

require_once ('config.php');
$db = mysqli_connect(db_host, db_user, db_pass, db_name);

$sql = mysqli_query($db, "SELECT * FROM order_edit WHERE id_order = ".$_POST['order']." ORDER BY id DESC");

$data = array();
$i = 1;
foreach ($sql as $value){
    $data[$i]['author'] = $value['author'];
    $data[$i]['date'] = $value['date'];
    $i++;
}

echo json_encode($data);

mysqli_close($db);