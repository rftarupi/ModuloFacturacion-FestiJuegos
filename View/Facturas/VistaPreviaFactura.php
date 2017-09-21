<!DOCTYPE html>
<?php
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
                                        <li><a href="../../View/Reportes/ReportesMovimientosProducto.php">Reportes</a></li>
                                        <li><a href="../../View/Reportes/ReporteBodegueros.php">Reportes</a></li>
                                        <li><a href="../../View/Reportes/ReporteProductos.php">Reportes</a></li>
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
                </div>
                
                <br><br><center>PÁGINA EN CONTRUCCIÓN</center>
                <?php 
                $fact_nv= $cabFacturasModel->getCabFactura($_SESSION['FAC_NOTA_VENTA']);
                $cli_nv= $clientesModel->getCliente($fact_nv->getCOD_CLI());
                ?>
                 <div class="row">
                <div class="col-lg-3"> </div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <center><p class="lead"><h2><strong>FESTIJUEGOS</strong></h2><br>
                                <h4>DOCUMENTO SIN EFECTO TRIBUTARIO</h4> <br><h4>COMPROBANTE DE PAGO </h4> </p></center>
                            <br><center><p>
                                <h4>FACTURA: <small> <?php echo $fact_nv->getCOD_CAB_FACT(); ?></small></h4><br>
                                <h4> CLIENTE: <small> <?php echo $cli_nv->getAPELLIDOS_CLI()." ".$cli_nv->getNOMBRES_CLI(); ?> </small></h4>
                            </p></center><br><br>
                            
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
                                        if (isset($_SESSION['listadoDet'])) {
                                            $listado = unserialize($_SESSION['listadoDet']);
                                            foreach ($listado as $Det) {
                                                echo "<tr>";
                                                echo "<td>" . $Det->getNOMBRE_SERV() . "</td>";
                                                echo "<td>" . $detallesModel->GetTiempoDetalle($Det->getTIEMPO_DET_FACT()) . "</td>"; //AQUI ES
                                                echo "<td>" . '$ ' . $Det->getCOSTO_HORA_DET_FACT() . "</td>";
                                                echo "<td>" . '$ ' . $Det->getCOSTO_TOT_DET_FACT() . "</td>";
                                                echo "</tr>";
                                            }
                                            echo "<tr>";
                                            echo "<td><h4><strong>TOTAL A PAGAR: ".$fact_nv->getCOSTO_TOT_CAB_FACT()." </strong></h4></td>";
                                            echo "<td></td>";
                                            echo "<td></td>";
                                            echo "<td></td>";
                                            echo "</tr>";
                                        } else {
                                           
                                        }
                                        ?>
                                </tbody>
                                </table></center>

                            <br><br><p>
                            <center><h4>Es un placer atenderle, visite nuestra página para estar enterado de nuestros descuentos y promociones.</h4></center>
                            </p>
                        </div>
                    </div>
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