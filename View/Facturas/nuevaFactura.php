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
            <title>NUEVA FACTURA</title>
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

                var bPreguntar = true;
                window.onbeforeunload = preguntarAntesDeSalir;
                function preguntarAntesDeSalir()
                {
                    if (bPreguntar)
                        return "¿Seguro que quieres salir?";
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

                <!--TITULO DEL SISTEMA-->
                <div class="row text-center" id="inicio"><h3>MÓDULO DE FACTURACIÓN</h3></div>

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

                <!--Título de la página-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-12" style="border-bottom: 1px solid #c5c5c5">
                                <h1><span class="glyphicon glyphicon-list-alt"></span> NUEVA FACTURA</h1></div>
                        </div>
                    </div>

                    <!--Cabecera ajuste-->
                    <div class="panel panel-default">
                        <div class="panel-heading">INFORMACIÓN DE LA FACTURA</div>
                        <div class="panel-body">
                            <form action="../../Controller/controller.php">
                                <?php
                                date_default_timezone_set('America/Lima');
                                setlocale(LC_TIME, 'spanish');
                                if (isset($_SESSION['ErrorBaseDatos'])) {
                                    echo "<div class='alert alert-danger'>" . $_SESSION['ErrorBaseDatos'] . "</div>";
                                }
                                ?>
                                <div class="input-group">
                                    <b>Código de Factura: </b><p><?php echo $_SESSION['COD_FACT_TEMP']; ?></p>
                                </div>

                                <div class="panel-default">
                                    <b>Fecha: </b><p><?php echo strftime("%A, %d de %B del %Y", strtotime(date('Y-m-d'))); ?></p>
                                </div>
                                <b>Cliente: </b>
                                <p>
                                    <?php
                                    if (isset($_SESSION['cliente'])) {
                                        $cl = unserialize($_SESSION['cliente']);
                                        $nombre = $cl->getAPELLIDOS_CLI() . ' ' . $cl->getNOMBRES_CLI();
                                        $cedula = $cl->getCEDULA_CLI();
                                        $direccion = $cl->getDIRECCION_CLI();
                                        $codigo = $cl->getCOD_CLI();
                                    } else {
                                        echo 'Agregue el cliente desde \'Buscar o Agregar Cliente\'';
                                    } if (isset($nombre)) {
                                        echo $nombre . '<br>';
                                    } if (isset($cedula)) {
                                        echo $cedula . '<br>';
                                    } if (isset($direccion)) {
                                        echo $direccion . '<br>';
                                    }
                                    ?>
                                </p>
                                <ul class="nav nav-pills"><li><a href="#listaCli" data-toggle="modal"><h5><span class='glyphicon glyphicon-plus'></span> Buscar o Agregar cliente</h5></a></li></ul>
                            </form>
                        </div>
                    </div>
                    <!--Fin Cabecera ajuste-->

                    <!--Detalle ajuste-->
                    <div class="panel panel-default" id="detalle">
                        <div class="panel-heading">DETALLES DE LA FACTURA</div>
                        <div class="panel-body">

                            <!--Formulario para adicionar un detalle del ajuste-->
                            <form action="../../Controller/controller.php">
                                <input type="hidden" name="opcion1" value="detalle">
                                <input type="hidden" name="opcion2" value="insertar_detalle">
                                <input type="hidden" id="COD_DET_FACT" name="COD_DET_FACT" value="<?php echo $detallesModel->generarCodDetalle(); ?>">
                                <input type="hidden" id="COD_FACT_TEMP" name="COD_FACT_TEMP" value=" <?php
                                if (isset($_SESSION['COD_FACT_TEMP'])) {
                                    echo $_SESSION['COD_FACT_TEMP'];
                                }
                                ?>">
                                       <?php
                                       if (isset($_SESSION['ErrorDetalleAjuste'])) {
                                           echo "<div class='alert alert-danger'>" . $_SESSION['ErrorDetalleAjuste'] . "</div>";
                                       }
                                       ?>
                                <div class="form-inline">
                                    <div class="form-group">
                                        <ul class="nav nav-pills">
                                            <li><label>SERVICIO:</label>
                                                <select name="COD_SERV" id="CboIDServicio" class="form-control" onchange="ObtenerDatosServicio($('#CboIDServicio').val());
                                                            return false;">
                                                    <option value="" disabled selected>Seleccione un Servicio</option>
                                                    <?php
                                                    $listaServicios = $serviciosModel->getServicios();
                                                    foreach ($listaServicios as $serv) {
                                                        echo "<option value='" . $serv->getCOD_SERV() . "'>" . $serv->getNOMBRE_SERV() . "</option>";
                                                    }
                                                    ?>
                                                </select></li>
                                            <li><a href="#listaProd" data-toggle="modal"><h5>Búsqueda inteligente de servicios</h5></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered table-condensed table-hover" id="TblServ">
                                    <thead>    
                                        <tr> 
                                            <th>SERVICIO</th>
                                            <th>COSTO</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_SESSION['servicio'])) {
                                            $servicio = unserialize($_SESSION['servicio']);
                                            echo "<tr class='success'>";
                                            echo "<input type='hidden' name='COD_SERV' value='" . $servicio->getCOD_SERV() . "'>";
                                            echo "<td>" . $servicio->getNOMBRE_SERV() . "</td>";
                                            echo "<td>" . $servicio->getCOSTO_SERV() . "</td>";
                                            echo "</tr>";
                                            unset($_SESSION['servicio']);
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <!--Funcionalidad del Tiempo de consumo del servicio-->
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="A">Tiempo de consumo del servicio</label><br>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="number" class="form-control" min="0" max="6" name="TIEMPO_HRS" maxlength="1" placeholder="Hrs." required="true" onkeypress="return SoloNumeros(event)" title="ola k ase" />
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="number" class="form-control" min="0" max="59" name="TIEMPO_MIN" maxlength="2" placeholder="Min." required="true" onkeypress="return SoloNumeros(event)" />
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="submit" onclick="bPreguntar = false;" value="Agregar" id="btnGuardar" class="btn btn-success"> 
                                    </div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <!--Fin de la Funcionalidad del Tiempo de consumo del servicio-->
                                <!--Fin del Formulario para adicionar un detalle de la factura-->
                                <br><br>

                                <!--Tabla de detalles de la factura-->  
                                <table class="table table-striped table-bordered table-condensed table-hover" data-toggle="table" data-pagination="true">
                                    <thead>
                                        <tr> 
                                            <!--<th colspan="2">ACCIONES</th>-->
                                            <th>ACCIONES</th>
                                            <th>SERVICIO</th>
                                            <th>TIEMPO</th>
                                            <th>COSTO POR HORA</th>
                                            <th>COSTO TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //verificamos si existe en sesion el listado de detalles:
                                        if (isset($_SESSION['listadoDetalles'])) {
                                            $listado = unserialize($_SESSION['listadoDetalles']);
                                            foreach ($listado as $Det) {
                                                //$serv = $serviciosModel->getServicio($Det->getCOD_SERV());
                                                echo "<tr class='success'>";
//                                                echo "<td><a href='../../controller/controller.php?opcion1=detalle&opcion2=eliminar_detalle&COD_DET_FACT=" . $Det->getCOD_DET_FACT() . "'>Eliminar</a></td>";
                                                echo "<td><a href='../../controller/controller.php?opcion1=detalle&opcion2=eliminar_detalle&COD_DET_FACT=" . $Det->getCOD_DET_FACT() . "&COSTO_TOT_DET_FACT=" . $Det->getCOSTO_TOT_DET_FACT() . "'>Eliminar</a></td>";
                                                echo "<td>" . $Det->getNOMBRE_SERV() . "</td>";
                                                echo "<td>" . $detallesModel->GetTiempoDetalle($Det->getTIEMPO_DET_FACT()) . "</td>"; //AQUI ES
                                                echo "<td>" . '$ ' . $Det->getCOSTO_HORA_DET_FACT() . "</td>";
                                                echo "<td>" . '$ ' . $Det->getCOSTO_TOT_DET_FACT() . "</td>";
                                                echo "</tr>";
                                            }
                                            echo "<tr class='success'>";
                                            echo "<td></td>";
                                            echo "<td></td>";
                                            echo "<td></td>";
                                            echo "<td><h4><strong>TOTAL</strong></h4></td>";
                                            if (isset($_SESSION['COD_FACT_TEMP'])) {
                                                echo "<td><h4><strong>$ " . $cabFacturasModel->getCabFactura($_SESSION['COD_FACT_TEMP'])->getCOSTO_TOT_CAB_FACT() . "</strong></h4></td>";
                                            } else {
                                                echo "<td></td>";
                                            }
                                            echo "</tr>";
                                        } else {
                                            echo "No se han cargado datos.";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="col-sm-3 col-sm-offset-9">
                                    <ul class="nav nav-pills">
                                        <li><a onclick="bPreguntar = false;" href="../../controller/controller.php?opcion1=factura&opcion2=finalizar_factura&COD_FACT_TEMP=<?php echo $_SESSION['COD_FACT_TEMP']; ?>" class="btn btn-success navbar-btn"><h5>FINALIZAR</h5></a></li>
                                        <li><a href="../../controller/controller.php?opcion1=factura&opcion2=cancelar_factura" class="btn btn-danger navbar-btn"><h5>CANCELAR</h5></a></li>
                                    </ul>
                                </div> 
                            </form>
                        </div>
                    </div>
                    <!--Fin Detalle ajuste-->

                    <!--Ventana emergente para Busqueda inteligente de servicios-->
                    <div class="modal fade" id="listaProd">
                        <div class="modal-dialog modal-lg">   
                            <form class="form-horizontal" action="../../Controller/controller.php">

                                <div class="modal-content">
                                    <!-- Header de la ventana -->
                                    <div class="modal-header bg-success">
                                        <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h3 class="modal-title"><span class="glyphicon glyphicon-search"></span> Búsqueda de servicios</h3>
                                    </div>

                                    <!-- Contenido de la ventana -->
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div>            
                                                    <table class="uk-table uk-table-hover uk-table-striped" id="servicio" cellspacing="0" width="100%">
                                                        <thead>    
                                                            <tr> 
                                                                <th>CÓDIGO</th>
                                                                <th>NOMBRE</th>
                                                                <th>COSTO</th>
                                                                <th>ACCIÓN</th>
                                                            </tr> 
                                                        </thead> 
                                                        <tbody>
                                                            <?php
                                                            $listaServicios = $serviciosModel->getServicios();
                                                            foreach ($listaServicios as $serv) {
                                                                echo "<tr class='success'>";
                                                                echo "<td>" . $serv->getCOD_SERV() . "</td>";
                                                                echo "<td>" . $serv->getNOMBRE_SERV() . "</td>";
                                                                echo "<td>" . $serv->getCOSTO_SERV() . "</td>";
                                                                echo "<td><center><a onclick='bPreguntar = false;' href='../../controller/controller.php?opcion1=factura&opcion2=recargarDatosServicioBusquedaInteligente&COD_SERV=" . $serv->getCOD_SERV() . "'>Agregar</a></center></td>";
                                                                echo "</tr>";
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <script src="../../Dependencias/DataTables/servicio.js"></script>
                                                    <script src="../../Dependencias/DataTables/jquery-1.12.4.js"></script>
                                                    <script src="../../Dependencias/DataTables/jquery.dataTables.min.js"></script>
                                                    <link rel="stylesheet" href="../../Dependencias/DataTables/jquery.dataTables.min.css">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Fin Ventana emergente para Busqueda inteligente de servicios-->

                    <!--Ventana emergente para Busqueda inteligente de clientes-->
                    <div class="modal fade" id="listaCli">
                        <div class="modal-dialog modal-lg">
                            <form class="form-horizontal" action="../../Controller/controller.php">

                                <div class="modal-content">
                                    <!-- Header de la ventana -->
                                    <div class="modal-header bg-success">
                                        <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h3 class="modal-title"><span class="glyphicon glyphicon-search"></span> Búsqueda de clientes</h3>
                                    </div>

                                    <!-- Contenido de la ventana -->
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div> 
                                                    <a href="#nuevoCLI" data-toggle="modal"><h5><span class="glyphicon glyphicon-plus"></span> Registrar Cliente</h5></a>
                                                    <table class="uk-table uk-table-hover uk-table-striped" id="cliente" cellspacing="0" width="100%">
                                                        <thead>    
                                                            <tr> 
                                                                <th>CÉDULA</th>
                                                                <th>NOMBRES</th>
                                                                <th>APELLIDOS</th>
                                                                <th>ACCIÓN</th>
                                                            </tr> 
                                                        </thead> 
                                                        <tbody>
                                                            <?php
                                                            $listaClientes = $clientesModel->getClientes();
                                                            foreach ($listaClientes as $cli) {
                                                                echo "<tr class='success'>";
                                                                echo "<td>" . $cli->getCEDULA_CLI() . "</td>";
                                                                echo "<td>" . $cli->getNOMBRES_CLI() . "</td>";
                                                                echo "<td>" . $cli->getAPELLIDOS_CLI() . "</td>";
                                                                echo "<td><center><a onclick='bPreguntar = false;' href='../../controller/controller.php?opcion1=factura&opcion2=recargarDatosClienteBusquedaInteligente&COD_CLI=" . $cli->getCOD_CLI() . "'>Agregar</a></center></td>";
                                                                echo "</tr>";
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <script src="../../Dependencias/DataTables/cliente.js"></script>
                                                    <script src="../../Dependencias/DataTables/jquery-1.12.4.js"></script>
                                                    <script src="../../Dependencias/DataTables/jquery.dataTables.min.js"></script>         
                                                    <link rel="stylesheet" href="../../Dependencias/DataTables/jquery.dataTables.min.css">

                                                    <!-- Ventana nuevo cliente-->
                                                    <div class="modal fade" id="nuevoCLI">
                                                        <div class="modal-dialog">
                                                            <form class="form-horizontal" action="../../Controller/controller.php">
                                                                <input type="hidden" name="opcion1" value="cliente">
                                                                <input type="hidden" name="opcion2" value="insertar_cliente_aux">
                                                                <div class="modal-content">
                                                                    <!-- Header de la ventana -->
                                                                    <div class="modal-header bg-success">
                                                                        <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <h3 class="modal-title"><span class="glyphicon glyphicon-user"></span> Nuevo Cliente </h3>
                                                                    </div>

                                                                    <!-- Contenido de la ventana -->
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <div class="col-md-3 col-md-offset-1">
                                                                                        <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Código Cliente </label>
                                                                                    </div>
                                                                                    <div class="col-md-7">
                                                                                        <?php echo $clientesModel->generarCliente(); ?>
                                                                                        <input type="hidden" name="COD_CLI" value="<?php echo $clientesModel->generarCliente() ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-md-3 col-md-offset-1">
                                                                                        <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Cédula / RUC </label>
                                                                                    </div>
                                                                                    <div class="col-md-7">
                                                                                        <input type="text" onkeypress="return SoloNumeros(event);" maxlength="13" minlength="10" class="form-control" name="CEDULA_CLI"  placeholder="Ingrese su N° de Cedula o RUC" onchange="ValidarIdentificacion(this.form.CEDULA_CLI.value, this.form.boton)" required />
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <div class="col-md-3 col-md-offset-1">
                                                                                        <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Nombres </label>
                                                                                    </div>
                                                                                    <div class="col-md-7">
                                                                                        <input onkeypress="return SoloLetras(event);" type="text" class="form-control" name="NOMBRES_CLI" placeholder="Ingrese sus Nombres" required pattern="|^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+(\s?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+)*[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$|" title="El campo no admite espacios en blanco innecesarios, ni admite espacios al inicio o final" />
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <div class="col-md-3 col-md-offset-1">
                                                                                        <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Apellidos </label>
                                                                                    </div>
                                                                                    <div class="col-md-7">
                                                                                        <input onkeypress="return SoloLetras(event);" type="text" class="form-control" name="APELLIDOS_CLI" placeholder="Ingrese sus Apellidos" required="true" required pattern="|^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+(\s?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+)*[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$|" title="El campo no admite espacios en blanco innecesarios, ni admite espacios al inicio o final" />
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <div class="col-md-3 col-md-offset-1">
                                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha de Nac. </label>
                                                                                    </div>
                                                                                    <div class="col-md-7">
                                                                                        <input type="date" class="form-control" name="FECHA_NAC_CLI" min="1900-01-01" max="<?php echo date("Y-m-d") ?>">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <div class="col-md-3 col-md-offset-1">
                                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dirección </label>
                                                                                    </div>
                                                                                    <div class="col-md-7">
                                                                                        <input type="text" class="form-control"  name="DIRECCION_CLI" placeholder="Ingrese su Dirección" maxlength="100" onKeyUp="return limitarDireccion(event, this.value, 99)" onKeyDown="return limitarDireccion(event, this.value, 99)" pattern="|^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+(\s?[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.,-º]+)*[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$|" title="Una dirección no admite caracteres especiales a excepción de punto, coma y guión medio. Ni admite espacios innecesarios" />
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <div class="col-md-3 col-md-offset-1">
                                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Teléfono </label>
                                                                                    </div>
                                                                                    <div class="col-md-7">
                                                                                        <input onkeypress="return SoloNumeros(event);" type="text" maxlength="10" class="form-control" name="FONO_CLI" placeholder="Ingrese su numero de Teléfono"/>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <div class="col-md-3 col-md-offset-1">
                                                                                        <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> E-mail </label>
                                                                                    </div>
                                                                                    <div class="col-md-7">
                                                                                        <input type="email" class="form-control" name="E_MAIL_CLI" placeholder="Ingrese su Correo" required pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_-]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,5}" title="Ingrese un e-mail válido. Ejemplo example@hotmail.com" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Footer de la ventana -->
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                                            <button id="boton" class="btn btn-success" onclick="bPreguntar = false;">Guardar Cliente</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- Fin Ventana nuevo Cliente-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Fin Ventana emergente para Busqueda inteligente de clientes-->

                </div>
            </div>
        </body>
    </html>
    <?php
} else {
    header('Location: ../login.php');
}
?>