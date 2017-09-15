<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['USUARIO_ACTIVO'])) {
    require_once '../../Model/InicioModel.php';
    $NOM = $_SESSION['NOMBRE_USUARIO'];
    $TIPO = $_SESSION['TIPO_USUARIO'];
    $inicio = new Inicio();
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Inicio Módulo facturación Festi-Juegos</title>
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">				
            <script src="../../Dependencias/js/jquery-2.1.4.js"></script>
            <script src="../../Dependencias/js/bootstrap.js"></script>
            <script src="../../Dependencias/js/bootstrap-table.js"></script>
            <script src="../../Dependencias/js/getDatos.js"></script>
            <link href="../../Dependencias/css/bootstrap.css" rel="stylesheet">
            <link href="../../Dependencias/css/bootstrap-table.css" rel="stylesheet">
            <link rel="../../stylesheet" href="Dependencias/css/bootstrap-theme.css">
            <script src="../../Dependencias/js/validaciones.js"></script>
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
                                        <li><a href="../../View/Reportes/ReportesMovimientosProducto.php">Reportes</a></li>
                                        <li><a href="../../View/Reportes/ReporteBodegueros.php">Reportes</a></li>
                                        <li><a href="../../View/Reportes/ReporteProductos.php">Reportes</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br><br>
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Tablero General</h4></div>
                    <table class="table">
                        <?php
                        date_default_timezone_set('America/Lima');
                        setlocale(LC_TIME, 'spanish');
                        echo '<tr>';
                        $totMens = $inicio->getTotMens(date('Y-m-1'),date('Y-m-1',strtotime('+1 month')));
                        if ($totMens == 0){
                            $totMens = '0.00';
                        }
                        echo '<td><center><h1><b>$'. $totMens .'</b></h1>Total de Ventas del mes de '. strftime('%B', strtotime(date('Y-m-d'))) .'</center></td>';
                        $totFact = $inicio->getTotFact(date('Y-m-1'),date('Y-m-1',strtotime('+1 month')));
                        echo '<td><center><h1><b>'. $totFact .'</b></h1>Total de Facturas del mes de '. strftime('%B', strtotime(date('Y-m-d'))) .'</center></td>
                        </tr>
                        <tr>';
                        $numServ = $inicio->getNumServicios();
                        echo '<td><center><h1><b>'. $numServ .'</b></h1>Servicios en Total</center></td>';
                        $numCli = $inicio->getNumClientes();
                        echo '<td><center><h1><b>'. $numCli .'</b></h1>Clientes en Total</center></td>
                        </tr>';
                        ?>
                    </table>
                </div>
            </div>
        </body>
    </html>
    <?php
} else {
    header('Location: ../login.php');
}
?>