<!DOCTYPE html>
<?php
require '../../Dependencias/printer/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\EscposImage;

session_start();
if (isset($_SESSION['USUARIO_ACTIVO'])) {
    include_once '../../Model/CabFactura.php';
    include_once '../../Model/CabFacturasModel.php';
    include_once '../../Model/Servicio.php';
    include_once '../../Model/ServiciosModel.php';
    include_once '../../Model/Cliente.php';
    include_once '../../Model/ClientesModel.php';
    include_once '../../Model/Usuario.php';
    include_once '../../Model/UsuariosModel.php';
    include_once '../../Model/FacturaDetallesModel.php';

    $nombre_impresora = "POS-80";

    $connector = new WindowsPrintConnector($nombre_impresora);
    $printer = new Printer($connector);

    $cabFacturasModel = new CabFacturasModel();
    $serviciosModel = new ServiciosModel();
    $clientesModel = new ClientesModel();
    $detallesModel = new FacturaDetallesModel();
    $NOM = $_SESSION['NOMBRE_USUARIO'];
    $TIPO = $_SESSION['TIPO_USUARIO'];
    $USUARIO_ACTIVO = unserialize($_SESSION['USUARIO_ACTIVO']);
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>NOTA DE VENTA</title>
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">				

            <!--Importación de Dependencias al proyecto-->
            <script src="../../Dependencias/js/jquery-2.1.4.js"></script>
            <script src="../../Dependencias/js/bootstrap.js"></script>
            <script src="../../Dependencias/js/getDatos.js"></script>
            <script src="../../Dependencias/js/bootstrap-table.js"></script>
            <script src = "../../Dependencias/SweetAlert/sweetalert.min.js" type="text/javascript"></script>
            <script src="../../Dependencias/js/validaciones.js"></script>
                <!--<script src="../../Dependencias/DataTables/jquery.dataTables.min.js"></script>-->

            <!--Importaciones Css-->
            <link href="../../Dependencias/css/bootstrap-table.css" rel="stylesheet" />
            <link href="../../Dependencias/css/bootstrap.css" rel="stylesheet" />
            <link href="../../Dependencias/css/bootstrap-theme.css">
            <link href="../../Dependencias/SweetAlert/sweetalert.css" rel="stylesheet" type="text/css">

            <!--<link rel="stylesheet" href="../../Dependencias/DataTables/jquery.dataTables.min.css">-->

            <style type="text/css">
                div{
                    font-family: Calibri Light;
                }
                body{
                    padding-top: 50px;
                }
            </style>

            <!--Función que permite obtener datos sin recargar pagina-->
            <script language="javascript">
                function ObtenerDatosServicio(COD_SERV) {
                    var COD_SERV = COD_SERV;
                    /// Invocamos a nuestro script PHP
                    $.ajax({
                        data: COD_SERV,
                        url: '../../controller/controller.php?opcion1=factura&opcion2=recargarDatosServicio&COD_SERV=' + COD_SERV,
                        type: 'post',
                        success: function (response) {
                            $("#TblServ").html(response);
                        }
                    });
                }
            </script>
        </head>
        <body>
            <div class="container-fluid">
                <!--CODIGO PARA LA BARRA DE SESIÓN-->
                <div class="row">
                    <nav class="navbar navbar-inverse navbar-fixed-top">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-1">
                                    <span class="sr-only">Menú</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a href="" class="navbar-brand">FACTURACIÓN</a>
                            </div>
                            <div class="collapse navbar-collapse" id="navbar-1">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href=""><span class="glyphicon glyphicon-user"></span> <?php echo $NOM; ?> </a></li>
                                    <li><a href=""><span class="glyphicon glyphicon-edit"></span> <?php echo $TIPO; ?> </a></li>
                                    <li><a href="../../Controller/controller.php?opcion1=cerrar_sesion"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesion </a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                <!--CODIGO PARA INSERTAR  UN SLIDER-->
                <div class="row">
                    <div id="carousel1" class="carousel slide" data-ride="carousel">
                        <!--Indicatodores--> 
                        <ol class="carousel-indicators">
                            <li data-target="#carousel1" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel1" data-slide-to="1"></li>
                            <li data-target="#carousel1" data-slide-to="2"></li>
                        </ol> 

                        <!--Contenedor de las imagenes--> 
                        <div class="carousel-inner" role="listbox">
                            <div class="item">
                                <img src="../../Imagenes/banner.jpg" width="100%" alt="Imagen 1">
                            </div>
                            <div class="item active">
                                <img src="../../Imagenes/banner4.jpg" width="100%" alt="Imagen 2">
                            </div>
                            <div class="item">
                                <img src="../../Imagenes/banner6.jpg" width="100%" alt="Imagen 3">
                            </div>
                        </div>
                        <!--Controls--> 
                        <a class="left carousel-control" href="#carousel1" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="right carousel-control" href="#carousel1" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Siguiente</span>
                        </a>
                    </div>
                </div>

                <!--TITULO DEL SISTEMA-->
                <div class="row text-center"><h3>MÓDULO DE FACTURACIÓN</h3></div>

                <!--MENU CON BOTONES-->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="btn-toolbar">
                            <div class="btn-group btn-group-justified">
                                <a class="btn btn-danger alert-danger" href="../Principal/inicio.php">INICIO</a>
                                <a class="btn btn-primary" href="../../View/Clientes/inicioClientes.php">CLIENTES</a>
                                <a class="btn btn-primary" href="../../View/Servicios/inicioServicios.php">SERVICIOS</a>
                                <a class="btn btn-primary" href="../../View/Facturas/inicioFacturas.php">FACTURAS</a>
                                <a class="btn btn-primary" href="../../View/Usuarios/inicioUsuarios.php">USUARIOS</a>
                                <div class="btn-group">
                                    <button class="btn btn-primary dropdown-toggle" id="dropdownReportes" aria-extended="true" type="button" data-toggle="dropdown">
                                        <label class="control-label">REPORTES<span class="caret"></span></label>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownReportes">
                                        <li><a href='reportesDiarios.php'>Reportes Diarios</a></li>
                                        <li><a href='reportesMensuales.php'>Reportes Mensuales</a></li>
                                        <li><a href='reportesAnuales.php'>Reportes Anuales</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <br>

                <!--Título de la página-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-12" style="border-bottom: 1px solid #c5c5c5">
                                <h1><span class="glyphicon glyphicon-list-alt"></span> NOTA DE VENTA </h1></div>
                        </div>
                    </div>
                </div><br>
                <?php
                $fact_nv = $cabFacturasModel->getCabFactura($_SESSION['FAC_NOTA_VENTA']);
                $cli_nv = $clientesModel->getCliente($fact_nv->getCOD_CLI());
                ?>
                <div class="row">
                    <div class="col-lg-3"> </div>
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <center><table> <tr> <td><img src="../../Imagenes/logo-FestiJuegos.PNG"></td> <td><h2><strong>FESTIJUEGOS</strong></td></tr></table></center>
                                <?php
                                $printer->setJustification(Printer::JUSTIFY_CENTER);
                                $logo = EscposImage::load("img/logo.png", false);
                                $printer->bitImage($logo);
                                $printer->text("DOCUMENTO SIN EFECTO TRIBUTARIO\nCOMPROBANTE DE PAGO");
                                $printer->feed(2);
                                ?>

                                <center><br><h4>DOCUMENTO SIN EFECTO TRIBUTARIO</h4> <br><h4>COMPROBANTE DE PAGO </h4> </p></center>
                                <br><p>
                                    <?php
                                    $fecha = $fact_nv->getFECHA_CAB_FACT();
                                    $arrayFecha = explode(" ", $fecha, 2);
                                    $nom_ap_cliente= $cli_nv->getAPELLIDOS_CLI() . " " . $cli_nv->getNOMBRES_CLI();
                                    ?>
                                <h4> &emsp;&emsp;&emsp;&emsp;RECIBO: <small> <?php echo $fact_nv->getCOD_CAB_FACT(); ?></small></h4>
                                <h4> &emsp;&emsp;&emsp;&emsp;CLIENTE: <small> <?php echo $nom_ap_cliente ?> </small></h4>
                                <h4> &emsp;&emsp;&emsp;&emsp;FECHA: <small> <?php echo $arrayFecha[0]; ?> </small></h4>
                                <h4> &emsp;&emsp;&emsp;&emsp;HORA: <small> <?php echo $arrayFecha[1]; ?> </small></h4>  
                                <h4> &emsp;&emsp;&emsp;&emsp;CAJERO: <small> <?php echo $NOM; ?> </small></h4>
                                </p><br>

                                <?php
                                $printer->setJustification(Printer::JUSTIFY_LEFT);
                                $printer->text("RECIBO: " . $fact_nv->getCOD_CAB_FACT() . "\n");
                                if(strlen($nom_ap_cliente<22)){
                                    $printer->text("CLIENTE: " . utf8_decode($nom_ap_cliente) . "\n");
                                }else{
                                    $printer->text("CLIENTE: " . utf8_decode(substr($nom_ap_cliente, 0, 22)) . "\n");
                                }
                                
                                $printer->text("FECHA: " . $arrayFecha[0] . "\n");
                                $printer->text("HORA: " . $arrayFecha[1] . "\n");
                                $printer->text("CAJERO: " . utf8_decode($NOM) . "\n");
                                ?>

                                <center><table width="80%" border="0">
                                        <thead>
                                            <tr> 
                                                <th width="46%">SERVICIO</th>
                                                <th width="18%">TIEMPO</th>
                                                <th width="18%">COSTO HORA</th>
                                                <th width="18%">TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $printer->text("================================\n");
                                            $printer->text("SERVICIO ");
                                            $printer->text("TIEMPO ");
                                            $printer->text("COSTO_HORA ");
                                            $printer->text("TOTAL\n");
                                            $printer->text("================================\n");

                                            if (isset($_SESSION['listadoDet'])) {
                                                $listado = unserialize($_SESSION['listadoDet']);
                                                $inicio = true;
                                                foreach ($listado as $Det) {
                                                    $aux = " ";
                                                    echo "<tr>";
                                                    echo "<td>" . utf8_decode($Det->getNOMBRE_SERV()) . "</td>";
                                                    echo "<td>" . $detallesModel->GetTiempoDetalle($Det->getTIEMPO_DET_FACT()) . "</td>"; //AQUI ES
                                                    echo "<td>" . '$ ' . $Det->getCOSTO_HORA_DET_FACT() . "</td>";
                                                    echo "<td>" . '$ ' . $Det->getCOSTO_TOT_DET_FACT() . "</td>";
                                                    echo "</tr>";

                                                    // Impresion del Nombre de servicio
                                                    if (strlen($Det->getNOMBRE_SERV()) == 8) {
                                                        $printer->text(utf8_decode($Det->getNOMBRE_SERV()) . " ");
                                                    } else if (strlen($Det->getNOMBRE_SERV()) < 8) {
                                                        $printer->text(utf8_decode($Det->getNOMBRE_SERV()) . " ");
                                                        for ($i = strlen($Det->getNOMBRE_SERV()); $i < 8; $i++) {
                                                            $printer->text(" ");
                                                        }
                                                    } else {
                                                        $printer->text(substr(utf8_decode($Det->getNOMBRE_SERV()), 0, 8) . " ");
                                                    }

                                                    // Impresion del tiempo de servicio
                                                    if (strlen($detallesModel->GetTiempoDetalle($Det->getTIEMPO_DET_FACT())) == 6) {
                                                        $printer->text($detallesModel->GetTiempoDetalle($Det->getTIEMPO_DET_FACT()) . " ");
                                                    } else if (strlen($detallesModel->GetTiempoDetalle($Det->getTIEMPO_DET_FACT())) < 6) {
                                                        $printer->text($detallesModel->GetTiempoDetalle($Det->getTIEMPO_DET_FACT()) . " ");
                                                        for ($i = strlen($detallesModel->GetTiempoDetalle($Det->getTIEMPO_DET_FACT())); $i < 6; $i++) {
                                                            $printer->text(" ");
                                                        }
                                                    } else {
                                                        $printer->text(substr($detallesModel->GetTiempoDetalle($Det->getTIEMPO_DET_FACT()), 0, 6) . " ");
                                                    }

                                                    // Impresión de costo por hora y total
                                                    if ($inicio) {
                                                        if (strlen($Det->getCOSTO_HORA_DET_FACT()) == 6) {
                                                            $printer->text("$" . $Det->getCOSTO_HORA_DET_FACT());
                                                        } else if (strlen($Det->getCOSTO_HORA_DET_FACT()) < 6) {
                                                            if (strlen($Det->getCOSTO_HORA_DET_FACT()) == 4) {
                                                                $printer->text("$  " . $Det->getCOSTO_HORA_DET_FACT());
                                                            } else if (strlen($Det->getCOSTO_HORA_DET_FACT()) == 5) {
                                                                $printer->text("$ " . $Det->getCOSTO_HORA_DET_FACT());
                                                            }
                                                            
                                                            for ($i = strlen($Det->getCOSTO_HORA_DET_FACT()); $i < 6; $i++) {
                                                                $printer->text(" ");
                                                            }
                                                        } else {
                                                            $printer->text(substr($Det->getCOSTO_HORA_DET_FACT(), 0, 6));
                                                        }

                                                        if (strlen($Det->getCOSTO_TOT_DET_FACT()) == 4) {
                                                            $printer->text("$  " . $Det->getCOSTO_TOT_DET_FACT() . "\n");
                                                        } else if (strlen($Det->getCOSTO_TOT_DET_FACT()) == 5) {
                                                            $printer->text("$ " . $Det->getCOSTO_TOT_DET_FACT() . "\n");
                                                        }else if (strlen($Det->getCOSTO_TOT_DET_FACT()) == 6) {
                                                            $printer->text("  $" . $Det->getCOSTO_TOT_DET_FACT() . "\n");
                                                        }
                                                    } else {
                                                        if (strlen($Det->getCOSTO_HORA_DET_FACT()) == 6) {
                                                            $printer->text(" " . $Det->getCOSTO_HORA_DET_FACT());
                                                        } else if (strlen($Det->getCOSTO_HORA_DET_FACT()) < 6) {
                                                            if (strlen($Det->getCOSTO_HORA_DET_FACT()) == 4) {
                                                                $printer->text("   " . $Det->getCOSTO_HORA_DET_FACT());
                                                            } else if (strlen($Det->getCOSTO_HORA_DET_FACT()) == 5) {
                                                                $printer->text("  " . $Det->getCOSTO_HORA_DET_FACT());
                                                            }
                                                            for ($i = strlen($Det->getCOSTO_HORA_DET_FACT()); $i < 6; $i++) {
                                                                $printer->text(" ");
                                                            }
                                                        } else {
                                                            $printer->text(substr($Det->getCOSTO_HORA_DET_FACT(), 0, 6));
                                                        }
                                                        if (strlen($Det->getCOSTO_TOT_DET_FACT()) == 4) {
                                                            $printer->text("   " . $Det->getCOSTO_TOT_DET_FACT() . "\n");
                                                        } else if (strlen($Det->getCOSTO_TOT_DET_FACT()) == 5) {
                                                            $printer->text("  " . $Det->getCOSTO_TOT_DET_FACT() . "\n");
                                                        }else if (strlen($Det->getCOSTO_TOT_DET_FACT()) == 6) {
                                                            $printer->text("   " . $Det->getCOSTO_TOT_DET_FACT() . "\n");
                                                        }
                                                    }
                                                    $inicio = false;
                                                }
                                                echo "<tr>";
                                                echo "<td></td>";
                                                echo "<td></td>";
                                                echo "<td><strong>TOTAL</strong></td>";
                                                echo "<td> $ " . $fact_nv->getCOSTO_TOT_CAB_FACT() . "</td>";
                                                echo "</tr>";

                                                $printer->setJustification(Printer::JUSTIFY_RIGHT);
                                                $printer->text("================================\n");
                                                $printer->setTextSize(2, 2);
                                                $printer->text("TOTAL: $" . $fact_nv->getCOSTO_TOT_CAB_FACT() . "\n");
                                                $printer->feed(2);
                                            } else {
                                                
                                            }
                                            ?>
                                        </tbody>
                                    </table></center>

                                <br><p>
                                    <?php
                                    $fecha = $fact_nv->getFECHA_CAB_FACT();
                                    ;
                                    $arrayFecha = explode(" ", $fecha, 2);
                                    ?>
                                <h4> &emsp;&emsp;&emsp;&emsp;TOTAL A PAGAR: <small> $ <?php echo $fact_nv->getCOSTO_TOT_CAB_FACT(); ?></small></h4>
                                <?php
                                $printer->setTextSize(1, 1);
                                $printer->setJustification(Printer::JUSTIFY_LEFT);
                                $printer->text("TOTAL A PAGAR:");
                                $printer->setJustification(Printer::JUSTIFY_RIGHT);
                                $printer->text("$ " . $fact_nv->getCOSTO_TOT_CAB_FACT() . "\n");

                                if (isset($_SESSION['billete'])) {
                                    echo "<h4> &emsp;&emsp;&emsp;&emsp;DINERO RECIBIDO: <small> $" . $_SESSION['billete'] . "</small></h4>";
                                    $printer->setJustification(Printer::JUSTIFY_LEFT);
                                    $printer->text("DINERO RECIBIDO:");
                                    $printer->setJustification(Printer::JUSTIFY_RIGHT);
                                    $printer->text("$ " . $_SESSION['billete'] . "\n");
                                }
                                ?>
                                <?php
                                if (isset($_SESSION['cambio'])) {
                                    echo "<h4> &emsp;&emsp;&emsp;&emsp;DINERO ENTREGADO: <small> $" . $_SESSION['cambio'] . "</small></h4>";
                                    $printer->text("DINERO ENTREGADO: $" . $_SESSION['cambio'] . "\n");
                                }
                                ?>
                                </p>
                                <?php
                                $printer->feed(2);
                                $printer->setJustification(Printer::JUSTIFY_CENTER);
                                $printer->text(utf8_decode("Es un placer atenderle, visite\nnuestra página para estar\nenterado de nuestros descuentos y\npromociones."));
                                $printer->feed(4);
                                $printer->close();
                                ?>
                                <br><br><p>
                                <center><h4>Es un placer atenderle, visite nuestra página para estar enterado de nuestros descuentos y promociones.</h4></center>
                                </p>
                            </div>
                        </div>
                        <?php
                        if (isset($_SESSION['cambio'])) {
                            if ($_SESSION['cambio'] != -1) {
                                echo "<script>swal({title: 'Cambio Monetario Exitoso',
                                    text: 'El cambio que debe entregar es: $ " . $_SESSION['cambio'] . "',
                                    type: 'success',
                                    confirmButtonText: 'Ok'});
                                    </script>";
                            }
                        }
                        ?>
                    </div>
                    <div class="col-lg-3"> </div>
                </div>
            </div>
        </body>
    </html>
    <?php
} else {
    header('Location: ../login.php');
}
?>