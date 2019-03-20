<?php

require_once ('config.php');
$db = mysqli_connect(db_host, db_user, db_pass, db_name);

$sql = mysqli_query($db,"UPDATE clients SET
fio = '".$_POST['name']."', 
email = '".$_POST['email']."', 
telephone = '".$_POST['telephone']."', 
telephone1 = '".$_POST['telephone1']."', 
telephone2 = '".$_POST['telephone2']."' 
WHERE id = ". $_POST['id']);

$sql = mysqli_query($db,"UPDATE orders SET 
fio = '".$_POST['dostavka_name']."', 
email = '".$_POST['dostavka_email']."', 
city = '".$_POST['dostavka_city']."', 
telephone = '".$_POST['dostavka_telephone']."', 
zip_code = '".$_POST['dostavka_index']."', 
adress = '".$_POST['dostavka_adress']."' 
WHERE id = ". $_POST['order']);