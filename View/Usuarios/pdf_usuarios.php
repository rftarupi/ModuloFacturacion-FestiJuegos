<?php

session_start();

include_once '../../Model/UsuariosModel.php';
include_once '../../Model/Usuario.php';

require ('../../Dependencias/ExportarPDF/FPDF/PDF_HTML.php');

$pdf = new PDF_HTML();
$pdf->AddPage('L', 'A4');
$pdf->SetFont('Times');

$pdf->Image('img/Titulo_X2.jpg', 3, 0, 300, 57);
$pdf->Ln(30);
$pdf->Ln(20);
$pdf->SetFillColor(2, 152, 116);
$pdf->SetFontSize(20);
$pdf->Cell(0, 9, 'REPORTE DE USUARIOS', 0, 0, 'C', 0);
$pdf->Ln(15);

$pdf->SetFontSize(9);
$pdf->SetTextColor(240, 255, 240);
$pdf->CellFitSpace(20, 6, utf8_decode('CÓDIGO'), 1, 0, 'C', 1);
$pdf->CellFitSpace(20, 6, 'TIPO', 1, 0, 'C', 1);
$pdf->CellFitSpace(25, 6, utf8_decode('CÉDULA/RUC'), 1, 0, 'C', 1);
$pdf->CellFitSpace(35, 6, 'NOMBRES', 1, 0, 'C', 1);
$pdf->CellFitSpace(35, 6, 'APELLIDOS', 1, 0, 'C', 1);
$pdf->CellFitSpace(20, 6, 'FECHA NAC.', 1, 0, 'C', 1);
$pdf->CellFitSpace(40, 6, utf8_decode('DIRECCIÓN'), 1, 0, 'C', 1);
$pdf->CellFitSpace(25, 6, utf8_decode('TELÉFONO'), 1, 0, 'C', 1);
$pdf->CellFitSpace(40, 6, utf8_decode('E-MAIL'), 1, 0, 'C', 1);
$pdf->CellFitSpace(15, 6, utf8_decode('ESTADO'), 1, 0, 'C', 1);
$pdf->Ln(6);

$bandera = false;

if (isset($_SESSION['listadoUsuarios'])) {

    $listado = unserialize($_SESSION['listadoUsuarios']);

    foreach ($listado as $usu) {

        $pdf->SetTextColor(3, 3, 3);
        $pdf->SetFillColor(229, 229, 229);

        $pdf->CellFitSpace(20, 6, $usu->getCOD_USU(), 1, 0, 'C', $bandera);
        if ($usu->getCOD_TIPO_USU() == 'TUSU-0001') {
            $pdf->CellFitSpace(20, 6, 'Administrador', 1, 0, 'C', $bandera);
        } else {
            $pdf->CellFitSpace(20, 6, 'Cajero', 1, 0, 'C', $bandera);
        }
        $pdf->CellFitSpace(25, 6, $usu->getCEDULA_USU(), 1, 0, 'C', $bandera);
        $pdf->CellFitSpace(35, 6, utf8_decode($usu->getNOMBRES_USU()), 1, 0, 'C', $bandera);
        $pdf->CellFitSpace(35, 6, utf8_decode($usu->getAPELLIDOS_USU()), 1, 0, 'C', $bandera);
        $pdf->CellFitSpace(20, 6, $usu->getFECHA_NAC_USU(), 1, 0, 'C', $bandera);
        $pdf->CellFitSpace(40, 6, utf8_decode($usu->getDIRECCION_USU()), 1, 0, 'C', $bandera);
        $pdf->CellFitSpace(25, 6, $usu->getFONO_USU(), 1, 0, 'C', $bandera);
        $pdf->CellFitSpace(40, 6, $usu->getE_MAIL_USU(), 1, 0, 'C', $bandera);
        if ($usu->getESTADO_USU() == 'A') {
            $pdf->CellFitSpace(15, 6, 'Activo', 1, 0, 'C', $bandera);
        } else {
            $pdf->CellFitSpace(15, 6, 'Inactivo', 1, 0, 'C', $bandera);
        }
        $pdf->Ln(6);

        $bandera = !$bandera;
    }
} else {
    $pdf->Cell(0, 0, 'no', 0, 0, 'L', 0);
}
$pdf->Ln(10);
$pdf->Cell(0, 9, '_______________________________________________', 0, 0, 'C', 0);$pdf->Output();
?>


