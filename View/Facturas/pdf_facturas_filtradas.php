<?php

session_start();

include_once '../../Model/CabFacturasModel.php';
include_once '../../Model/CabFactura.php';
include_once '../../Model/Cliente.php';
include_once '../../Model/ClientesModel.php';

require('../../Dependencias/ExportarPDF/FPDF/mc_table.php');

$clientesModel=new ClientesModel();

$pdf = new PDF_MC_Table();
$pdf->SetWidths(array(35, 80, 45, 30));
$pdf->AddPage('P', 'A4');
$pdf->SetFont('Times');
$pdf->SetFontSize(11);

//Fecha del Sistema
date_default_timezone_set('America/Guayaquil');
$pdf->Cell(10,0,utf8_decode('Fecha y Hora del Reporte: ').date('d-M-Y H:i'));
$pdf->Image('img/cab_pdf_fac.jpg', 5, 20, 0, 57);
$pdf->Ln(70);
$pdf->SetTextColor(240, 255, 240); //Letra color blanco

$pdf->HeaderRow(array(utf8_decode('CÓDIGO'), 'CLIENTE', 'FECHA FACTURA', 'TOTAL'));

if (isset($_SESSION['ListadoImprimirFiltrado'])) {
    $listado = unserialize($_SESSION['ListadoImprimirFiltrado']);
    $pdf->SetTextColor(0,0,0);
    foreach ($listado as $fact) {
//        if($fact->getESTADO_IMP_FAC()=="N"){
//            $estado="NO IMPRESO";
//        }else{
//            $estado="IMPRESO";
//        }
        
        $cliente=$clientesModel->getCliente($fact->getCOD_CLI());
        $pdf->Row(array($fact->getCOD_CAB_FACT(), $cliente->getAPELLIDOS_CLI()." ".$cliente->getNOMBRES_CLI(),
            $fact->getFECHA_CAB_FACT(), $fact->getCOSTO_TOT_CAB_FACT()));
    }
    $pdf->Ln(10);
    $pdf->SetFontSize(15);
    $pdf->Cell(10,0,"TOTAL: $ ".$_SESSION['totalFacturasFiltrado']);
} else {
    $pdf->Cell(0, 0, 'no', 0, 0, 'L', 0);
}
$pdf->Ln(10);
$pdf->Output();
?>


