<?php

session_start();

include_once '../../Model/ServiciosModel.php';
include_once '../../Model/Servicio.php';

require('../../Dependencias/ExportarPDF/FPDF/mc_table.php');

$pdf = new PDF_MC_Table();
$pdf->SetWidths(array(50, 50, 50, 40));
$pdf->AddPage('P', 'A4');
$pdf->SetFont('Times');
$pdf->SetFontSize(11);

//Fecha del Sistema
date_default_timezone_set('America/Guayaquil');
$pdf->Cell(10,0,utf8_decode('Fecha y Hora del Reporte: ').date('d-M-Y H:i'));
$pdf->Image('img/cabecera_pdf.jpg', 5, 20, 0, 57);
$pdf->Ln(70);
$pdf->SetTextColor(240, 255, 240); //Letra color blanco

$pdf->HeaderRow(array(utf8_decode('CÓDIGO'), 'NOMBRE', utf8_decode('DESCRIPCIÓN'), 'COSTO'));

if (isset($_SESSION['listadoServicios'])) {
    $listado = unserialize($_SESSION['listadoServicios']);
    $pdf->SetTextColor(0,0,0);
    foreach ($listado as $serv) {
        $pdf->Row(array($serv->getCOD_SERV(), utf8_decode($serv->getNOMBRE_SERV()),
            utf8_decode($serv->getDESCRIPCION_SERV()), $serv->getCOSTO_SERV()));
    }
} else {
    $pdf->Cell(0, 0, 'no', 0, 0, 'L', 0);
}
$pdf->Ln(10);
$pdf->Output();
?>


