<?php
session_start();

require __DIR__.'/vendor/autoload.php';
use Dompdf\Dompdf;

if (isset($_POST['data'])){
    $_SESSION['data'] = $_POST['data'];
    $_SESSION['name'] = $_POST['name'];
}else{
    $html = "<html><head><style>body {font-family: DejaVu Sans}</style><body>".$_SESSION['data']."</body></head></html>";
    $name = $_SESSION['name'];
    $name = explode(".",$name);
    unset($_SESSION['data']);
    unset($_SESSION['name']);
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->render();
    $dompdf->stream($name[0].".pdf");
}