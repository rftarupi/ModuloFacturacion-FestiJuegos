<?php

session_start();

include_once '../../Model/ClientesModel.php';
include_once '../../Model/Cliente.php';

require('../../Dependencias/ExportarPDF/FPDF/mc_table.php');

$pdf = new PDF_MC_Table();
$pdf->SetWidths(array(23, 25, 30, 30, 30, 25, 30, 23, 35, 20));
srand(microtime() * 1000000);
$pdf->AddPage('L', 'A4');


$pdf->Image('img/Titulo_X2.jpg', 0, 10, 300, 57);
$pdf->Ln(60);

$pdf->SetFont('Times');
$pdf->SetFontSize(11);
$pdf->SetTextColor(240, 255, 240); //Letra color blanco

$pdf->HeaderRow(array(utf8_decode('CÓDIGO'),utf8_decode('CÉDULA/RUC'), 'NOMBRES', 'APELLIDOS', 'FECHA NAC.',
    utf8_decode('DIRECCIÓN'), utf8_decode('TELÉFONO'), 'E-MAIL'));

if (isset($_SESSION['listadoClientes'])) {

    $listado = unserialize($_SESSION['listadoClientes']);
    $pdf->SetTextColor(0,0,0);
    foreach ($listado as $cli) {

        $pdf->Row(array($cli->getCOD_CLI(), $cli->getCEDULA_CLI(), utf8_decode($cli->getNOMBRES_CLI()),
            utf8_decode($cli->getAPELLIDOS_CLI()), $cli->getFECHA_NAC_CLI(), utf8_decode($cli->getDIRECCION_CLI()),
            $cli->getFONO_CLI(), $cli->getE_MAIL_CLI()));
    }
} else {
    $pdf->Cell(0, 0, 'no', 0, 0, 'L', 0);
}
$pdf->Ln(10);
$pdf->Output();
?>


