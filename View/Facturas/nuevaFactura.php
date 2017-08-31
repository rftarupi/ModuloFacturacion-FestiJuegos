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
    $ajustesModel = new AjustesModel();
    $productosModel = new ProductosModel();
    $NOM = $_SESSION['NOMBRE_USUARIO'];
    $TIPO = $_SESSION['TIPO_USUARIO'];
    $USUARIO_ACTIVO = unserialize($_SESSION['USUARIO_ACTIVO']);
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>NUEVO AJUSTE</title>
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">				

            <!--Importación de Dependencias al proyecto-->
            <script src="../../Dependencias/js/jquery-2.1.4.js"></script>
            <script src="../../Dependencias/js/bootstrap.js"></script>
            <script src="../../Dependencias/js/getDatos.js"></script>
            <script src="../../Dependencias/js/bootstrap-table.js"></script>
            <script src = "../../Dependencias/SweetAlert/sweetalert.min.js" type="text/javascript"></script>
            <script src="../../Dependencias/js/validaciones.js"></script>

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

            <!--Función que permite obtener datos sin recargar pagina-->
            <script language="javascript">
                function ObtenerDatosProducto(ID_PROD) {
                    var ID_PROD = ID_PROD;
                    /// Invocamos a nuestro script PHP
                    $.ajax({
                        data: ID_PROD,
                        url: <?php $_SERVER['DOCUMENT_ROOT'] ?>.'/Controller/controller.php?opcion1=ajuste&opcion2=recargarDatosProducto&ID_PROD=' + ID_PROD,
                                type: 'post',
                        success: function (response) {
                            $("#TblProd").html(response);
                        }
                    });
                }
            </script>

            <script LANGUAGE="JavaScript">
                function ErrorStock(msjError)
                {
                    alert(msjError);
                }
            </script>
            <script LANGUAGE="JavaScript">
                function r(id)

                {
                    alert(id);
    <?php $a = "id" ?>
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

                                <a href="" class="navbar-brand">MÓDULO DE INVENTARIO</a>
                            </div>
                            <div class="collapse navbar-collapse" id="navbar-1">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href=""><span class="glyphicon glyphicon-user"></span> <?php echo $NOM; ?> </a></li>
                                    <li><a href=""><span class="glyphicon glyphicon-edit"></span> <?php echo $TIPO; ?> </a></li>
                                    <li><a href="../../Controller/controller.php?opcion1=cerrar_sesion"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión </a></li>
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
                                <img src="../../View/Imagenes/banner4.jpg" width="100%" alt="Imagen 1">
                            </div>
                            <div class="item active">
                                <img src="../../View/Imagenes/banner9.jpg" width="100%" alt="Imagen 2">
                            </div>
                            <div class="item">
                                <img src="../../View/Imagenes/banner3.png" width="100%" alt="Imagen 3">
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
                    <h3>SISTEMA DE MÓDULO DE INVENTARIO</h3>
                </div>

                <!--MENU CON BOTONES-->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="btn-toolbar">
                            <div class="btn-group btn-group-justified">
                                <a class="btn btn-danger alert-danger  " href="../Principal/iniciop.php">INICIO</a>
                                <a class="btn btn-primary" href="../../View/Ajustes/inicioAjuste.php">AJUSTES</a>
                                <a class="btn btn-primary" href="../../View/Producto/inicioProductos.php">PRODUCTOS</a>
                                <a class="btn btn-primary" href="../../View/Usuario/inicioUsuarios.php">USUARIOS</a>
                                <div class="btn-group">
                                    <button class="btn btn-primary dropdown-toggle" id="dropdownReportes" aria-extended="true" type="button" data-toggle="dropdown">
                                        <label class="control-label">Reportes <span class="caret"></span></label>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownReportes">
                                        <li><a href="../Reportes/ReportesMovimientosProducto.php">Reportes de Movimientos</a></li>
                                        <li><a href="../Reportes/ReporteBodegueros.php">Reportes de Bodegueros</a></li>
                                        <li><a href="../Reportes/ReporteProductos.php">Reportes de Productos</a></li>
                                        <li><a href="../Reportes/ReportesFacturacion.php">Web Service de Ventas</a></li>
                                        <li><a href="../Reportes/ReportesCompras.php">Web Service de Compras</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Título de la página-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-12" style="border-bottom: 1px solid #c5c5c5">
                                <h1><span class="glyphicon glyphicon-cog"></span> NUEVO AJUSTE DE PRODUCTOS</h1></div>
                        </div>
                    </div>

                    <!--Detalle ajuste-->
                    <div class="panel panel-default" id="detalles_ajuste">
                        <div class="panel-heading">DETALLES DEL AJUSTE</div>
                        <div class="panel-body">

                            <!--Formulario para adicionar un detalle del ajuste-->
                            <form action="../../Controller/controller.php">
                                <input type="hidden" name="opcion1" value="ajuste">
                                <input type="hidden" name="opcion2" value="insertar_detalle_ajuste">
                                <input type="hidden" name="aux" value="nuevo">
                                <input type="hidden" name="ID_USU" value="<?php echo $USUARIO_ACTIVO->getID_USU(); ?>">
                                <div class="form-inline">
                                    <div class="form-group">
                                        <ul class="nav nav-pills">
                                            <li><label>PRODUCTO:</label>
                                                <select name="ID_PROD" id="CboIDProducto" class="form-control" onchange=" r($('#CboIDProducto').val())">
                                                    <option value="" disabled selected>Seleccione un Producto</option>
                                                    <?php
                                                    $listaProductos = $productosModel->getProductos();
                                                    foreach ($listaProductos as $prod) {
                                                        echo "<option value='" . $prod->getID_PROD() . "'>" . "Producto: " . $prod->getNOMBRE_PROD() . " Stock: " . $prod->getSTOCK_PROD() . "</option>";
                                                    }
                                                    ?>
                                                </select></li>
                                            <!--echo "<a href='../../controller/controller.php?opcion1=ajuste&opcion2=recargarDatosProductoBusquedaInteligente&ID_PROD=" . $a . "'>Ver información del producto</a>" ?>-->
                                            <!--<li><a href="#listaProd" data-toggle="modal">Búsqueda inteligente</a></li>-->
                                        </ul>
                                    </div>
                                </div>
                                <br><br>
    <!--                                <table class="table table-striped table-bordered table-condensed table-hover" id="TblProd">
                                    <thead>    
                                        <tr> 
                                            <th>PRODUCTO</th>
                                            <th>PRECIO</th>
                                            <th>GRAVA IVA</th>
                                            <th>STOCK</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                <?php
                                if (isset($_SESSION['producto'])) {
                                    $producto = unserialize($_SESSION['producto']);
                                    echo "<tr class='success'>";
                                    echo "<input type='hidden' name='ID_PROD' value='" . $producto->getID_PROD() . "'>";
                                    echo "<td>" . $producto->getNOMBRE_PROD() . "</td>";
                                    echo "<td>" . $producto->getPVP_PROD() . "</td>";
                                    if ($producto->getGRAVA_IVA_PROD() == "S")
                                        echo "<td>SI</td>";
                                    else
                                        echo "<td>NO</td>";

                                    echo "<td>" . $producto->getSTOCK_PROD() . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                                    </tbody>
                                </table>-->


                                <!--Mensaje de error en caso de stock no valido-->
                                <?php
                                if (isset($_SESSION['ErrorStock'])) {
                                    echo "<script language='javascript'> window.addEventListener('load', ErrorStock('" . $_SESSION['ErrorStock'] . "'), false); </script>";
                                    unset($_SESSION['ErrorStock']);
                                }
                                ?>

                                <!--Ingreso o salida y nuevo stock-->
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="A">Tipo de Movimiento</label><br>
                                        <label class="radio-inline"><input type="radio" name="optradio" value="I" checked>INGRESO</label>
                                        <label class="radio-inline"><input type="radio" name="optradio" value="S">SALIDA</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <br><input type="text" class="form-control" name="cantidad" size="150" maxlength="1000" minlength="1" placeholder="Ingrese cantidad" required onkeypress="return SoloNumeros(event)" />
                                    </div>
                                    <div class="col-sm-2">
                                        <br><input type="submit" value="Agregar" id="btnGuardar" class="btn btn-success"> 
                                    </div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <!--Fin de Ingreso o salida y nuevo stock-->
                                <!--Fin del Formulario para adicionar un detalle del ajuste-->
                                <br><br>

                                <!--Tabla de detalles del ajuste-->  
                                <table class="table table-striped table-bordered table-condensed table-hover" data-toggle="table" data-pagination="true">
                                    <thead>
                                        <tr> 
                                            <!--<th colspan="2">ACCIONES</th>-->
                                            <th>ACCIONES</th>
                                            <th>CÓDIGO DETALLE</th>
                                            <th>PRODUCTO</th>
                                            <th>CANTIDAD</th>
                                            <th>TIPO MOVIMIENTO</th>
                                            <th>PRECIO</th>
                                            <th>GRAVA IVA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //verificamos si existe en sesion el listado de clientes:
                                        if (isset($_SESSION['listaAjusteDet'])) {
                                            $listado = unserialize($_SESSION['listaAjusteDet']);
                                            foreach ($listado as $ajusteDet) {
                                                $prod = $productosModel->getProducto($ajusteDet->getID_PROD());
                                                echo "<tr class='success'>";
                                                echo "<td><a href='../../Controller/controller.php?opcion1=ajuste&opcion2=eliminar_detalle&ID_DETALLE_AJUSTE_PROD=" . $ajusteDet->getID_DETALLE_AJUSTE_PROD() . "&aux=nuevo'>Eliminar</a></td>";
                                                echo "<td>" . $ajusteDet->getID_DETALLE_AJUSTE_PROD() . "</td>";
                                                echo "<td>" . $ajusteDet->getNOMBRE_PROD() . "</td>";
                                                echo "<td>" . $ajusteDet->getCAMBIO_STOCK_PROD() . "</td>";
                                                if ($ajusteDet->getTIPOMOV_DETAJUSTE_PROD() == "I") {
                                                    echo "<td>INGRESO</td>";
                                                } else {
                                                    echo "<td>SALIDA</td>";
                                                }
                                                echo "<td>" . $ajusteDet->getPVP_PROD() . "</td>";
                                                if ($prod->getGRAVA_IVA_PROD() == "S") {
                                                    echo "<td>SI</td>";
                                                } else {
                                                    echo "<td>NO</td>";
                                                }
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "No se han cargado datos.";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </form>
                            <!--Fin de la Tabla de detalles del ajuste-->
                        </div>
                    </div>
                    <!--Fin Detalle ajuste-->

                    <!--Cabecera ajuste-->
                    <div class="panel panel-default">
                        <div class="panel-heading">INFORMACIÓN DEL AJUSTE</div>
                        <div class="panel-body">
                            <form action="../../Controller/controller.php">
                                <input type="hidden" name="opcion1" value="ajuste">
                                <input type="hidden" name="opcion2" value="insertar_ajuste_detalles"> 
                                <div class="input-group">
                                    <span class="input-group-addon">Código </span>
                                    <input type="text" class="form-control" disabled value="<?php echo $ajustesModel->generarCodigoAjuste(); ?>">
                                    <input type="hidden" class="form-control" name="ID_AJUSTE_PROD" value="<?php echo $ajustesModel->generarCodigoAjuste(); ?>">
                                </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon">Motivo </span>
                                    <input type="text" class="form-control" name="MOTIVO_AJUSTE_PROD" size="150" maxlength="150" placeholder="Ingrese el motivo del ajuste" required pattern="|^[a-zA-Z0-9]+(\s*[a-zA-Z0-9]*)*[a-zA-Z0-9]+$|" >
                                </div><br>
                                <?php
                                if (isset($_SESSION['ErrorDetalleAjuste'])) {
                                    echo "<div class='alert alert-danger'>" . $_SESSION['ErrorDetalleAjuste'] . "</div>";
                                }
                                ?>
                                <div class="form-group">
                                    <input type="submit" value="GUARDAR AJUSTE" id="btnGuardar" class="btn btn-success"> 
                                    <a href="../../Controller/controller.php?opcion1=ajuste&opcion2=cancelar_ajuste" id="btnGuardar" class="btn btn-danger">CANCELAR</a>
                                </div> 
                            </form>
                        </div>
                    </div>
                    <!--Fin Cabecera ajuste-->


                    <!--Ventana emergente para Busqueda inteligente de productos-->
                    <div class="modal fade" id="listaProd">
                        <div class="modal-dialog modal-lg">
                            <!--<form class="form-horizontal" action="#ventanasEmergentes">-->
                            <form class="form-horizontal" action="../../Controller/controller.php">

                                <div class="modal-content">
                                    <!-- Header de la ventana -->
                                    <div class="modal-header bg-success">
                                        <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h3 class="modal-title"><span class="glyphicon glyphicon-search"></span> Búsqueda de productos</h3>
                                    </div>

                                    <!-- Contenido de la ventana -->
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div>            
                                                    <table class="uk-table uk-table-hover uk-table-striped" id="example" cellspacing="0" width="100%">
                                                        <thead>    
                                                            <tr> 
                                                                <th>ID PRODUCTO</th>
                                                                <th>NOMBRE</th>
                                                                <th>STOCK</th>
                                                                <th>ACCIÓN</th>
                                                            </tr> 
                                                        </thead> 
                                                        <tbody>
                                                            <?php
                                                            foreach ($listaProductos as $prod) {
                                                                echo "<tr class='success'>";
                                                                echo "<td>" . $prod->getID_PROD() . "</td>";
                                                                echo "<td>" . $prod->getNOMBRE_PROD() . "</td>";
                                                                echo "<td>" . $prod->getSTOCK_PROD() . "</td>";
                                                                echo "<td><center><a href='../../controller/controller.php?opcion1=ajuste&opcion2=recargarDatosProductoBusquedaInteligente&ID_PROD=" . $prod->getID_PROD() . "'>Agregar</a></center></td>";
                                                                echo "</tr>";
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>

                                                    <script src="../../Bootstrap/DataTables/main.js"></script>
                                                    <script src="../../Bootstrap/DataTables/jquery-1.12.4.js"></script>
                                                    <script src="../../Bootstrap/DataTables/jquery.dataTables.min.js"></script>
                                                    <!--<script src="https://cdn.datatables.net/1.10.15/js/dataTables.uikit.min.js"></script>--> 
                                                    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.24.3/css/uikit.min.css">-->
                                                    <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.uikit.min.css">-->
                                                    <link rel="stylesheet" href="../../Bootstrap/DataTables/jquery.dataTables.min.css">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
