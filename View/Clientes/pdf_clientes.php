<?php

session_start();

include_once '../../Model/ClientesModel.php';
include_once '../../Model/Cliente.php';

require('../../Dependencias/ExportarPDF/FPDF/mc_table.php');

$pdf = new PDF_MC_Table();
$pdf->SetWidths(array(20, 29, 37, 37, 25, 51, 26, 45));
$pdf->AddPage('L', 'A4');
$pdf->SetFont('Times');
$pdf->SetFontSize(11);

//Fecha del Sistema
date_default_timezone_set('America/Guayaquil');
$pdf->Cell(10,0,utf8_decode('Fecha y Hora del Reporte: ').date('d-M-Y H:i'));
$pdf->Image('img/clientes.jpg', 0, 20, 300, 57);
$pdf->Ln(70);
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


