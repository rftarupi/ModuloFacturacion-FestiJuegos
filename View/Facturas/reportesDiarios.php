<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['USUARIO_ACTIVO'])) {
    include_once '../../Model/CabFactura.php';
    include_once '../../Model/CabFacturasModel.php';
    include_once '../../Model/Cliente.php';
    include_once '../../Model/ClientesModel.php';
    $cabFacturasModel = new CabFacturasModel();
    $clientesModel = new ClientesModel();

    $cabFacturasModel->verificarFechaFactura();
    $NOM = $_SESSION['NOMBRE_USUARIO'];
    $TIPO = $_SESSION['TIPO_USUARIO'];
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Facturas</title>
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">				

            <!--Importación de Dependencias al proyecto-->
            <script src="../../Dependencias/js/jquery-2.1.4.js"></script>
            <script src="../../Dependencias/js/bootstrap.js"></script>
            <script src="../../Dependencias/js/getDatos.js"></script>
            <script src="../../Dependencias/js/bootstrap-table.js"></script>
            <script src = "../../Dependencias/SweetAlert/sweetalert.min.js" type="text/javascript"></script>
            <script src="../../Dependencias/js/validaciones.js"></script>

            <script src="../../Dependencias/DataTables/cabFactura.js"></script>
            <script src="../../Dependencias/DataTables/jquery.dataTables.min.js"></script>

            <!--Importaciones Css-->
            <link href="../../Dependencias/css/bootstrap-table.css" rel="stylesheet" />
            <link href="../../Dependencias/css/bootstrap.css" rel="stylesheet" />
            <link href="../../Dependencias/css/bootstrap-theme.css">
            <link href="../../Dependencias/SweetAlert/sweetalert.css" rel="stylesheet" type="text/css">

            <link rel="stylesheet" href="../../Dependencias/DataTables/jquery.dataTables.min.css">

            <style type="text/css">
                div{
                    font-family: Calibri Light;
                }
                body{
                    padding-top: 50px;
                }
            </style>
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
                <div class="row text-center">
                    <h3>MÓDULO DE FACTURACIÓN</h3>
                </div>

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
                </div>

                <!--TITULO DE LA PAGINA-->
                <div class="row" id="principal">
                    <div class="col-lg-12">
                        <div class="col-lg-12" style="border-bottom: 1px solid #c5c5c5">
                            <h1><span class="glyphicon glyphicon-list-alt"></span> REPORTES DEL DÍA</h1></div>
                    </div>
                </div>

                <!--La clase col nos permite que la pagina sea responsive mediante numero de columnas
                     donde el total de columnas es 12 y
                     donde lg es en tamaño de escritorio, md medianos, sm tablets, xs celulares -->
                <br>
                <div class="row" id="filtrado">
                    <div class="col-lg-8 col-lg-offset-2">
                        <form action="../../Controller/controller.php" class="form-inline">
                            <input type="hidden" name="opcion1" value="factura" />
                            <input type="hidden" name="opcion2" value="reporteDia" />
                            <div class="form-group">
                                <label class="control-label">Fecha Inicio: </label>
                                <input type="date" class="form-control" name="fecha_inicio" value="<?php
                                date_default_timezone_set('America/Guayaquil');
                                if (isset($_SESSION['FECHA_I'])) {
                                    echo $_SESSION['FECHA_I'];
                                } else {
                                    echo date('Y-m-d');
                                }
                                ?>" min="1900-01-01" max="<?php echo date("Y-m-d") ?>" />
                            </div>
                            <div class="form-group">
                                <label class="control-label">Fecha Fin: </label>
                                <input type="date" class="form-control" name="fecha_fin" value="<?php
                                if (isset($_SESSION['FECHA_F'])) {
                                    echo $_SESSION['FECHA_F'];
                                } else {
                                    echo date('Y-m-d');
                                }
                                ?>" min="1900-01-01" max="<?php echo date("Y-m-d") ?>" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Filtrar Facturas">
                            </div>
                            <div class="form-group">
                                <a class="btn btn-danger" href='../../Controller/controller.php?opcion1=factura&opcion2=exportar_pdf&tr=diario' target='_blank' ><span class='glyphicon glyphicon glyphicon-open-file'></span> EXPORTAR A PDF</a>
                            </div>
                        </form>
                    </div>
                </div>

                <?php
                if (isset($_SESSION['ErrorBaseDatos'])) {
                    echo "<div class='alert alert-danger'>" . $_SESSION['ErrorBaseDatos'] . "</div>";
                }
                ?>

                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"><h4>Lista de Facturas</h4></div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-condensed table-condensed" id="example" cellspacing="0" width="100%">
                                            <thead>
                                                <tr> 
                                                    <th>ACCIONES</th>
                                                    <th>CÓDIGO FACTURA</th>
                                                    <th>ESTADO IMPRESIÓN</th>
                                                    <th>CLIENTE</th>
                                                    <th>FECHA FACTURA</th>
                                                    <th>TOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Verificamos si existe la variable de sesión que contiene la lista de Cabeceras de Factura
                                                if (isset($_SESSION['listadoFiltradoFacturasDiario'])) {
                                                    $listado = unserialize($_SESSION['listadoFiltradoFacturasDiario']);
                                                } else {
                                                    $listado = $cabFacturasModel->getFiltradoFacturasFecha(date("Y-m-d 00:00:00"), date("Y-m-d 23:59:59"));
                                                    $_SESSION['listadoFiltradoFacturasDiario'] = serialize($listado);
                                                }

                                                $sumaTotalReporte = 0;
                                                foreach ($listado as $cabF) {
                                                    $cliente = $clientesModel->getCliente($cabF->getCOD_CLI());
                                                    $sumaTotalReporte+=$cabF->getCOSTO_TOT_CAB_FACT();
                                                    ?>
                                                    <tr>
                                                        <td align="center"><a href="">Imprimir</a></td>
                                                        <td><?php echo $cabF->getCOD_CAB_FACT(); ?></td>
                                                        <td><?php
                                                            if ($cabF->getESTADO_IMP_FAC() == 'S') {
                                                                echo 'IMPRESO';
                                                            } else {
                                                                echo 'NO IMPRESO';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?php echo $cliente->getAPELLIDOS_CLI() . " " . $cliente->getNOMBRES_CLI(); ?></td>
                                                        <td><?php echo $cabF->getFECHA_CAB_FACT(); ?></td>
                                                        <td><?php echo $cabF->getCOSTO_TOT_CAB_FACT(); ?></td>


                                                <input type="hidden" value="<?php echo $cabF->getCOD_CAB_FACT(); ?>" id="ID_AJUSTE_PROD<?php echo $cabF->getCOD_CAB_FACT(); ?>">
                                                <input type="hidden" value="<?php echo $cabF->getCOD_CLI(); ?>" id="MOTIVO_AJUSTE_PROD<?php echo $cabF->getCOD_CAB_FACT(); ?>" >
                                                <input type="hidden" value="<?php echo $cabF->getFECHA_CAB_FACT(); ?>" id="FECHA_AJUSTE_PROD<?php echo $cabF->getCOD_CAB_FACT(); ?>" >
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-1 col-lg-offset-10">
                                            <h2>TOTAL:</h2>
                                        </div>
                                        <div class="col-lg-1">
                                            <h2>
                                                <?php
                                                echo $sumaTotalReporte;
                                                $_SESSION['totalFacturasFiltrado']=$sumaTotalReporte;
                                                ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>
    <?php
} else {
    header('Location: ../login.php');
}
?>