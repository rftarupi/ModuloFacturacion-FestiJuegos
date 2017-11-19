<?php
require 'printer/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;


$nombre_impresora = "POS-80";
 
$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);

$printer->text("FESTIJUEGOS\nEmpresa");
$printer->feed(2);
$printer->close();
