<?php

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf(); 
// unidgine type : http;

$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->Output();`