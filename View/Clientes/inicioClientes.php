<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
    // Inicio de sesión e inclusión de rutas para acceder a los datos
    session_start();

    // Verificamos si existe inicio de sesión
    if (isset($_SESSION['USUARIO_ACTIVO'])) {
        include_once '../../Model/Usuario.php';
        include_once '../../Model/Cliente.php';
        include_once '../../Model/ClientesModel.php';

        // Deserializamos el cliente en sesión
        $usuarioSesion = unserialize($_SESSION['USUARIO_ACTIVO']);

        // Creamos la variable para el llamado de los métodos de la tabla Cliente
        $clientesModel = new ClientesModel();

        $NOM = $_SESSION['NOMBRE_USUARIO'];
        $TIPO = $_SESSION['TIPO_USUARIO'];
        ?>
        <head>
            <meta charset="UTF-8">
            <title>Clientes</title>
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">				
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

            <!--Importaciones Js-->
            <script src="../../Dependencias/js/jquery-2.1.4.js"></script>
            <script src="../../Dependencias/js/bootstrap.js"></script>
            <script src="../../Dependencias/js/getDatos.js"></script>
            <script src="../../Dependencias/js/bootstrap-table.js"></script>
            <script src = "../../Dependencias/SweetAlert/sweetalert.min.js" type="text/javascript"></script>
            <script src="../../Dependencias/js/validaciones.js"></script>

            <script src="../../Dependencias/DataTables/cliente.js"></script>
            <script src="../../Dependencias/DataTables/jquery.dataTables.min.js"></script>

            <!--Importaciones Css-->
            <link href="../../Dependencias/css/bootstrap-table.css" rel="stylesheet">
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

            <script>
                // Funcion para limitar el numero de caracteres de un textarea o input
                // Tiene que recibir el evento, valor y número máximo de caracteres
                function limitarDireccion(e, contenido, caracteres)
                {
                    // obtenemos la tecla pulsada
                    var unicode = e.keyCode ? e.keyCode : e.charCode;

                    // Permitimos las siguientes teclas:
                    // 8 backspace
                    // 46 suprimir
                    // 13 enter
                    // 9 tabulador
                    // 37 izquierda
                    // 39 derecha
                    // 38 subir
                    // 40 bajar
                    if (unicode == 8 || unicode == 46 || unicode == 13 || unicode == 9 || unicode == 37 || unicode == 39 || unicode == 38 || unicode == 40)
                        return true;

                    // Si ha superado el limite de caracteres devolvemos false
                    if (contenido.length >= caracteres) {
                        swal({title: "Error!",
                            text: "No se puede superar los 100 caracteres en la Dirección",
                            type: "error",
                            confirmButtonText: "Ok"});
                        return false;
                    }
                    return true;
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

                <!--TITULO DE LA PAGINA-->
                <div class="row" id="principal">
                    <div class="col-lg-12">
                        <div class="col-lg-12" style="border-bottom: 1px solid #c5c5c5">
                            <h1><span class="glyphicon glyphicon-user"></span> CLIENTES</h1></div>
                    </div>
                </div>

                <!--La clase col nos permite que la pagina sea responsive mediante numero de columnas
                     donde el total de columnas es 12 y
                     donde lg es en tamaño de escritorio, md medianos, sm tablets, xs celulares -->

                <div class="row">
                    <div class="col-md-12" style="padding-top: 5px">
                        <!--La class nav nav-pills nos permite hacer menús-->
                        <ul class="nav nav-pills">
                            <li role = 'presentation'><a href = '#nuevoCLI' data-toggle = 'modal'><h4>NUEVO CLIENTE</h4></a></li>
                        </ul>
                    </div>
                </div>
                <br>

                <?php
                if (isset($_SESSION['ErrorBaseDatos'])) {
                    echo "<div class='alert alert-danger'><strong><span class='glyphicon glyphicon-remove-sign'></span> ERROR:</strong> El Cliente que intenta ingresar ya existe en la Base de Datos</div>";
                }
                ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"><h4>Lista de Clientes</h4></div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <div class="table-striped">
                                        <!-- Tabla en la que se listara los clientes de la Base de Datos -->
                                        <table class="table table-striped table-bordered table-condensed table-condensed" id="cliente" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>ACCIONES</th>
                                                    <th>CÓDIGO CLIENTE</th>
                                                    <th>CÉDULA / RUC</th>
                                                    <th>NOMBRES</th>
                                                    <th>APELLIDOS</th>
                                                    <th>FECHA NACIMIENTO</th>
                                                    <th>DIRECCIÓN</th>
                                                    <th>TELÉFONO</th>
                                                    <th>E-MAIL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Verificamos si existe la variable de sesión que contiene la lista de Clientes
                                                if (isset($_SESSION['listadoClientes'])) {
                                                    // Deserializamos y mostraremos los atributos de los clientes usando un ciclo for
                                                    $listado = unserialize($_SESSION['listadoClientes']);
                                                } else {
                                                    $listado = $clientesModel->getClientes();
                                                }
                                                foreach ($listado as $cli) {
                                                    ?>
                                                    <tr>
                                                        <td><a href = "#editCLI" onclick = "obtener_datos_cliente('<?php echo $cli->getCOD_CLI(); ?>')" data-toggle = "modal"><span class = "glyphicon glyphicon-pencil">Editar</span></a></td>
                                                        <td><?php echo $cli->getCOD_CLI(); ?></td>
                                                        <td><?php echo $cli->getCEDULA_CLI(); ?></td>
                                                        <td><?php echo $cli->getNOMBRES_CLI(); ?></td>
                                                        <td><?php echo $cli->getAPELLIDOS_CLI(); ?></td>
                                                        <td><?php echo $cli->getFECHA_NAC_CLI(); ?></td>
                                                        <td><?php echo $cli->getDIRECCION_CLI(); ?></td>
                                                        <td><?php echo $cli->getFONO_CLI(); ?></td>
                                                        <td><?php echo $cli->getE_MAIL_CLI(); ?></td>

                                                <input type="hidden" value="<?php echo $cli->getCOD_CLI(); ?>" id="COD_CLI<?php echo $cli->getCOD_CLI(); ?>">
                                                <input type="hidden" value="<?php echo $cli->getCEDULA_CLI(); ?>" id="CEDULA_CLI<?php echo $cli->getCOD_CLI(); ?>">
                                                <input type="hidden" value="<?php echo $cli->getNOMBRES_CLI(); ?>" id="NOMBRES_CLI<?php echo $cli->getCOD_CLI(); ?>">
                                                <input type="hidden" value="<?php echo $cli->getAPELLIDOS_CLI(); ?>" id="APELLIDOS_CLI<?php echo $cli->getCOD_CLI(); ?>">
                                                <input type="hidden" value="<?php echo $cli->getFECHA_NAC_CLI(); ?>" id="FECHA_NAC_CLI<?php echo $cli->getCOD_CLI(); ?>">
                                                <input type="hidden" value="<?php echo $cli->getDIRECCION_CLI(); ?>" id="DIRECCION_CLI<?php echo $cli->getCOD_CLI(); ?>">
                                                <input type="hidden" value="<?php echo $cli->getFONO_CLI(); ?>" id="FONO_CLI<?php echo $cli->getCOD_CLI(); ?>">
                                                <input type="hidden" value="<?php echo $cli->getE_MAIL_CLI(); ?>" id="E_MAIL_CLI<?php echo $cli->getCOD_CLI(); ?>">

                                                <?php
                                                echo "</tr>";
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Ventana emergente para Nuevo Cliente-->
                <div class="modal fade" id="nuevoCLI">
                    <div class="modal-dialog">
                        <form class="form-horizontal" action="../../Controller/controller.php">
                            <input type="hidden" name="opcion1" value="cliente">
                            <input type="hidden" name="opcion2" value="insertar_cliente">

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
                                                    <input type="text" class="form-control"  name="DIRECCION_CLI" placeholder="Ingrese su Dirección" maxlength="100" onKeyUp="return limitarDireccion(event, this.value, 100)" onKeyDown="return limitarDireccion(event, this.value, 100)" pattern="|^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+(\s?[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.,-º]+)*[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$|" title="Una dirección no admite caracteres especiales a excepción de punto, coma y guión medio. Ni admite espacios innecesarios" />
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
                                        <button id="boton" class="btn btn-success">Guardar Cliente</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <!--Ventana emergente para Editar Cliente-->
                <div class="modal fade" id="editCLI">
                    <div class="modal-dialog">
                        <form class="form-horizontal" action="../../Controller/controller.php">
                            <input type="hidden" name="opcion1" value="cliente">
                            <input type="hidden" name="opcion2" value="guardar_cliente">

                            <div class="modal-content">
                                <!-- Header de la ventana --> 
                                <div class="modal-header bg-success">
                                    <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h3 class="modal-title"><span class="glyphicon glyphicon-cog"></span> Editar Cliente</h3>
                                </div>

                                <!-- Contenido de la ventana -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Código Cliente</label>    
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="hidden" id="mod_id" name="mod_id" value=""  >
                                                    <p id="mod_cod"></p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Cédula / RUC </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input  type="text" readonly="readonly" id="mod_cedula" maxlength="13" minlength="10" class="form-control" name="mod_cedula" required />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Nombres </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input onkeypress="return SoloLetras(event);"type="text" class="form-control" id="mod_nombre" name="mod_nombre"  required pattern="|^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+(\s?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+)*[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$|" title="El campo no admite espacios en blanco innecesarios, ni admite espacios al inicio o final" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Apellidos </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input onkeypress="return SoloLetras(event);"type="text" class="form-control" id="mod_apellido" name="mod_apellido"  required pattern="|^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+(\s?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+)*[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$|" title="El campo no admite espacios en blanco innecesarios, ni admite espacios al inicio o final" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="date" id="mod_fecha" name="mod_fecha" min="1900-01-01" max="<?php echo date("Y-m-d") ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dirección </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" id="mod_direccion" name="mod_direccion" maxlength="100" onKeyUp="return limitarDireccion(event, this.value, 100)" onKeyDown="return limitarDireccion(event, this.value, 100)" required pattern="|^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+(\s?[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.,-º]+)*[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$|" title="Una dirección no admite caracteres especiales a excepción de punto, coma y guión medio. Ni admite espacios innecesarios " />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Teléfono </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input onkeypress="return SoloNumeros(event);" type="text" maxlength="10" class="form-control" id="mod_telefono" name="mod_telefono" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span>E-mail </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="email" class="form-control" id="mod_email" name="mod_email" required pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_-]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,5}" title="Ingrese un e-mail válido. Ejemplo example@hotmail.com" />
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <!-- Footer de la ventana -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" id="boton" class="btn btn-success">Guardar Cliente</button>
                                    </div>
                                </div>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>
        </body>
        <?php
    } else {
        header('Location: ../login.php');
    }
    ?>
</html>