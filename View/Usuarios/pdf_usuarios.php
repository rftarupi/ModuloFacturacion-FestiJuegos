<?php

session_start();

include_once '../../Model/UsuariosModel.php';
include_once '../../Model/Usuario.php';

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

$pdf->HeaderRow(array(utf8_decode('CÓDIGO'), 'TIPO', utf8_decode('CÉDULA/RUC'), 'NOMBRES', 'APELLIDOS', 'FECHA NAC.',
    utf8_decode('DIRECCIÓN'), utf8_decode('TELÉFONO'), 'E-MAIL', 'ESTADO'));

if (isset($_SESSION['listadoUsuarios'])) {

    $listado = unserialize($_SESSION['listadoUsuarios']);
    $pdf->SetTextColor(0,0,0);
    foreach ($listado as $usu) {

        if ($usu->getCOD_TIPO_USU() == 'TUSU-0001') {
            $tipo = 'Administrador';
        } else {
            $tipo = 'Cajero';
        }

        if ($usu->getESTADO_USU() == 'A') {
            $estado = 'Activo';
        } else {
            $estado = 'Inactivo';
        }

        $pdf->Row(array($usu->getCOD_USU(), $tipo, $usu->getCEDULA_USU(), utf8_decode($usu->getNOMBRES_USU()),
            utf8_decode($usu->getAPELLIDOS_USU()), $usu->getFECHA_NAC_USU(), utf8_decode($usu->getDIRECCION_USU()),
            $usu->getFONO_USU(), $usu->getE_MAIL_USU(), $estado));
    }
} else {
    $pdf->Cell(0, 0, 'no', 0, 0, 'L', 0);
}
$pdf->Ln(10);
$pdf->Output();
?>


