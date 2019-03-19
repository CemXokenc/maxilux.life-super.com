<?php

require_once ('config.php');
$db = mysqli_connect(db_host, db_user, db_pass, db_name);

$dostavka_name = $_POST['dostavka_name'];
$dostavka_email = $_POST['dostavka_email'];
$dostavka_city = $_POST['dostavka_city'];
$dostavka_index = $_POST['dostavka_index'];
$dostavka_adress = $_POST['dostavka_adress'];

$data = array("telephone2"=>$_POST['telephone2'],
    "telephone1"=>$_POST['telephone1'],
    "fio"=>$_POST['name'],
    "email"=>$_POST['email'],
    "telephone"=>$_POST['telephone']);

$sql = mysqli_query($db, "UPDATE clients SET fio = '".$_POST['name']."', email = '".$_POST['email']."',
 telephone = '".$_POST['telephone']."', telephone1 = '".$_POST['telephone1']."', telephone2 = '".$_POST['telephone2']."' 
 WHERE id = ". $_POST['id']);