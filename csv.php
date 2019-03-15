<?php
header("Content-type: application/octet-stream; charset=utf-8");
session_start();

if (isset($_POST['data'])){
    $_SESSION['data'] = $_POST['data'];
    $_SESSION['name'] = $_POST['name'];
}else{
    $data = $_SESSION['data'];
    $data = str_replace(array("\r","\n"),',', $data);
    $name = $_SESSION['name'];
    $name = explode("/",$name);
    $name = explode(".",$name[4]);
    unset($_SESSION['data']);
    unset($_SESSION['name']);
    header("Content-Disposition: attachment; filename=\"$name[0]".".csv\"");
    echo $data;
}