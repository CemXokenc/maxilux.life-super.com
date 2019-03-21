<?php

$data = scandir('site/templates/img/orders/'.$_POST['order_id']);

echo json_encode($data);