<?php

$url = $_SERVER['HTTP_REFERER'];
$url = explode('/', $url);
$url = explode('.', $url[4]);

$path = 'site/templates/img/orders/'. $url[0];

if (!file_exists($path)) {
    mkdir($path,0777, true);
}

move_uploaded_file($_FILES['file']['tmp_name'], $path . '/' . $_FILES['file']['name']);