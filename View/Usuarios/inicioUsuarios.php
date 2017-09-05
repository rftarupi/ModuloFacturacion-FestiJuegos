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
        include_once '../../Model/UsuariosModel.php';
        include_once '../../Model/TipoUsuario.php';
        include_once '../../Model/TiposUsuarioModel.php';

        // Deserializamos el usuario en sesión
        $usuarioSesion = unserialize($_SESSION['USUARIO_ACTIVO']);

        // Creamos la variable para el llamado de los métodos de la tabla Tipo Usuario y Usuario
        $tiposUsuarioModel = new TiposUsuarioModel();
        $usuariosModel = new UsuariosModel();

        $NOM = $_SESSION['NOMBRE_USUARIO'];
        $TIPO = $_SESSION['TIPO_USUARIO'];
        ?>
        <head>
            <meta charset="UTF-8">
            <title>Usuarios</title>
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">				
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

            <!--Importaciones Js-->
            <script src="../../Dependencias/js/jquery-2.1.4.js"></script>
            <script src="../../Dependencias/js/bootstrap.js"></script>
            <script src="../../Dependencias/js/getDatos.js"></script>
            <script src="../../Dependencias/js/bootstrap-table.js"></script>
            <script src = "../../Dependencias/SweetAlert/sweetalert.min.js" type="text/javascript"></script>
            <script src="../../Dependencias/js/validaciones.js"></script>

            <script src="../../Dependencias/DataTables/usuario.js"></script>
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
                            <h1><span class="glyphicon glyphicon-user"></span> USUARIOS</h1></div>
                    </div>
                </div>

                <!--La clase col nos permite que la pagina sea responsive mediante numero de columnas
                     donde el total de columnas es 12 y
                     donde lg es en tamaño de escritorio, md medianos, sm tablets, xs celulares -->

                <div class="row">
                    <div class="col-md-12" style="padding-top: 5px">
                        <!--La class nav nav-pills nos permite hacer menús-->
                        <ul class="nav nav-pills">
                            <?php
                            // Verificamos si es Administrador habilitamos la funcion de crear usuarios
                            if ($usuarioSesion->getCOD_TIPO_USU() == "TUSU-0001") {
                                echo "<li role = 'presentation'><a href = '#nuevoUSU' data-toggle = 'modal'><h4>NUEVO USUARIO</h4></a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <br>

                <?php
                if (isset($_SESSION['ErrorBaseDatos'])) {
                    echo "<div class='alert alert-danger'><strong><span class='glyphicon glyphicon-remove-sign'></span> ERROR:</strong> El Usuario que intenta ingresar ya existe en la Base de Datos y tiene su perfil</div>";
                }
                ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"><h4>Lista de Usuarios</h4></div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <div class="table-striped">
                                        <!-- Tabla en la que se listara los usuarios de la Base de Datos -->
                                        <table class="table table-striped table-bordered table-condensed table-condensed" id="example" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <?php
                                                    if ($usuarioSesion->getCOD_TIPO_USU() == "TUSU-0001") {
                                                        echo "<th>ACCIONES</th>";
                                                    }
                                                    ?>
                                                    <th>CÓDIGO USUARIO</th>
                                                    <th>TIPO USUARIO</th>
                                                    <?php
                                                    if ($usuarioSesion->getCOD_TIPO_USU() == "TUSU-0001") {
                                                        echo "<th>CÉDULA / RUC</th>";
                                                    }
                                                    ?>
                                                    <th>NOMBRES</th>
                                                    <th>APELLIDOS</th>
                                                    <th>FECHA NACIMIENTO</th>
                                                    <th>DIRECCIÓN</th>
                                                    <th>TELÉFONO</th>
                                                    <?php
                                                    if ($usuarioSesion->getCOD_TIPO_USU() == "TUSU-0001") {
                                                        echo "<th>E-MAIL</th>";
                                                    }
                                                    ?>
                                                    <th>ESTADO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Verificamos si existe la variable de sesión que contiene la lista de Usuarios
                                                if (isset($_SESSION['listadoUsuarios'])) {
                                                    // Deserializamos y mostraremos los atributos de los usuarios usando un ciclo for
                                                    $listado = unserialize($_SESSION['listadoUsuarios']);
                                                } else {
                                                    $listado = $usuariosModel->getUsuarios();
                                                }
                                                foreach ($listado as $usu) {
                                                    // Obtenemos datos de tipo usuario de un usuario en específico
                                                    $tipoUsuario = $tiposUsuarioModel->getTipoUsuario($usu->getCOD_TIPO_USU());
                                                    $estado = $usuariosModel->obtenerEstadoUsuario($usu->getCOD_USU());
                                                    ?>
                                                    <tr>
                                                        <?php
                                                        // Un cajero no puede editar datos
                                                        if ($usuarioSesion->getCOD_TIPO_USU() == "TUSU-0001") {
                                                            ?>
                                                            <td><a href = "#editUSU" onclick = "obtener_datos_usuario('<?php echo $usu->getCOD_USU(); ?>')" data-toggle = "modal"><span class = "glyphicon glyphicon-pencil">Editar</span></a></td>
                                                            <?php
                                                        }
                                                        ?>

                                                        <td><?php echo $usu->getCOD_USU(); ?></td>
                                                        <td><?php echo $tipoUsuario->getDESCRIPCION_TIPO_USU(); ?></td>
                                                        <?php
                                                        if ($usuarioSesion->getCOD_TIPO_USU() == "TUSU-0001") {
                                                            echo "<td>".$usu->getCEDULA_USU()."</td>";
                                                        }
                                                        ?>
                                                        <td><?php echo $usu->getNOMBRES_USU(); ?></td>
                                                        <td><?php echo $usu->getAPELLIDOS_USU(); ?></td>
                                                        <td><?php echo $usu->getFECHA_NAC_USU(); ?></td>
                                                        <td><?php echo $usu->getDIRECCION_USU(); ?></td>
                                                        <td><?php echo $usu->getFONO_USU(); ?></td>
                                                        <?php
                                                        if ($usuarioSesion->getCOD_TIPO_USU() == "TUSU-0001") {
                                                            echo "<td>".$usu->getE_MAIL_USU()."</td>";
                                                        }
                                                        ?>
                                                        <td><?php echo $estado; ?></td>


                                                <input type="hidden" value="<?php echo $usu->getCOD_USU(); ?>" id="COD_USU<?php echo $usu->getCOD_USU(); ?>">
                                                <input type="hidden" value="<?php echo $usu->getCOD_TIPO_USU(); ?> " id="TIPO_USU<?php echo $usu->getCOD_TIPO_USU(); ?>" >
                                                <input type="hidden" value="<?php echo $usu->getCEDULA_USU(); ?>" id="CEDULA_USU<?php echo $usu->getCOD_USU(); ?>">
                                                <input type="hidden" value="<?php echo $usu->getNOMBRES_USU(); ?>" id="NOMBRES_USU<?php echo $usu->getCOD_USU(); ?>">
                                                <input type="hidden" value="<?php echo $usu->getAPELLIDOS_USU(); ?>" id="APELLIDOS_USU<?php echo $usu->getCOD_USU(); ?>">
                                                <input type="hidden" value="<?php echo $usu->getFECHA_NAC_USU(); ?>" id="FECHA_NAC_USU<?php echo $usu->getCOD_USU(); ?>">
                                                <input type="hidden" value="<?php echo $usu->getDIRECCION_USU(); ?>" id="DIRECCION_USU<?php echo $usu->getCOD_USU(); ?>">
                                                <input type="hidden" value="<?php echo $usu->getFONO_USU(); ?>" id="FONO_USU<?php echo $usu->getCOD_USU(); ?>">
                                                <input type="hidden" value="<?php echo $usu->getE_MAIL_USU(); ?>" id="E_MAIL_USU<?php echo $usu->getCOD_USU(); ?>">
                                                <input type="hidden" value="<?php echo $usu->getESTADO_USU(); ?>" id="ESTADO_USU<?php echo $usu->getCOD_USU(); ?>">
                                                <input type="hidden" value="<?php echo $usu->getCLAVE_USU(); ?>" id="CLAVE_USU<?php echo $usu->getCOD_USU(); ?>">

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

                <!--Ventana emergente para Nuevo Usuario-->
                <div class="modal fade" id="nuevoUSU">
                    <div class="modal-dialog">
                        <form class="form-horizontal" action="../../Controller/controller.php">
                            <input type="hidden" name="opcion1" value="usuario">
                            <input type="hidden" name="opcion2" value="insertar_usuario">

                            <div class="modal-content">
                                <!-- Header de la ventana -->

                                <div class="modal-header bg-success">
                                    <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h3 class="modal-title"><span class="glyphicon glyphicon-user"></span> Nuevo Usuario </h3>
                                </div>

                                <!-- Contenido de la ventana -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-12" style="text-align: center;">
                                                    <label class="control-label">Los campos con <span class="glyphicon glyphicon-asterisk"></span> son obligatorios</label>    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Código Usuario </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <?php echo $usuariosModel->generarUsuario(); ?>
                                                    <input type="hidden" name="COD_USU" value="<?php echo $usuariosModel->generarUsuario() ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Tipo Usuario </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <select class="form-control" id="COD_TIPO_USU" name="COD_TIPO_USU">
                                                        <?php
                                                        $listado = $tiposUsuarioModel->getTiposUsuario();
                                                        foreach ($listado as $tipoUsuario) {
                                                            ?>
                                                            <option  value="<?php echo $tipoUsuario->getCOD_TIPO_USU(); ?>"><?php echo $tipoUsuario->getDESCRIPCION_TIPO_USU(); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Cédula / RUC </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="text" onkeypress="return SoloNumeros(event);" maxlength="13" minlength="10" class="form-control" name="CEDULA_USU"  placeholder="Ingrese su N° de Cedula o RUC" onchange="ValidarIdentificacion(this.form.CEDULA_USU.value, this.form.boton)" required />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Nombres </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input onkeypress="return SoloLetras(event);" type="text" class="form-control" name="NOMBRES_USU" placeholder="Ingrese sus Nombres" required pattern="|^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+(\s?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+)*[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$|" title="El campo no admite espacios en blanco innecesarios, ni admite espacios al inicio o final" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Apellidos </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input onkeypress="return SoloLetras(event);" type="text" class="form-control" name="APELLIDOS_USU" placeholder="Ingrese sus Apellidos" required="true" required pattern="|^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+(\s?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+)*[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$|" title="El campo no admite espacios en blanco innecesarios, ni admite espacios al inicio o final" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha de Nac. </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="date" class="form-control" name="FECHA_NAC_USU" min="1900-01-01" max="<?php echo date("Y-m-d") ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dirección </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" name="DIRECCION_USU" placeholder="Ingrese su Dirección" pattern="|^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+(\s?[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.,-]+)*[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$|" title="Una dirección no admite caracteres especiales a excepción de punto, coma y guión medio. Ni admite espacios innecesarios" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Teléfono </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input onkeypress="return SoloNumeros(event);" type="text" maxlength="10" class="form-control" name="FONO_USU" placeholder="Ingrese su numero de Teléfono"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> E-mail </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="email" class="form-control" name="E_MAIL_USU" placeholder="Ingrese su Correo" required pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" title="Ingrese un e-mail válido. Ejemplo example@hotmail.com" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk" required="true"></span> Estado </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <select class="form-control" id="ESTADO_USU" name="ESTADO_USU" required="true">
                                                        <option value="A">ACTIVO</option>
                                                        <option value="I">INACTIVO</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Clave </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="password" class="form-control" name="CLAVE_USU" placeholder="Ingrese su Clave" required="true"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Footer de la ventana -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        <button id="boton" class="btn btn-success">Guardar Usuario</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <!--Ventana emergente para Editar Usuario-->
                <div class="modal fade" id="editUSU">
                    <div class="modal-dialog">
                        <form class="form-horizontal" action="../../Controller/controller.php">
                            <input type="hidden" name="opcion1" value="usuario">
                            <input type="hidden" name="opcion2" value="guardar_usuario">

                            <div class="modal-content">
                                <!-- Header de la ventana --> 
                                <div class="modal-header bg-success">
                                    <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h3 class="modal-title"><span class="glyphicon glyphicon-cog"></span> Editar Usuario</h3>
                                </div>

                                <!-- Contenido de la ventana -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-12" style="text-align: center;">
                                                    <label class="control-label">Los campos con <span class="glyphicon glyphicon-asterisk"></span> son obligatorios</label>    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Código Usuario</label>    
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
                                                    <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="date" id="mod_fecha" name="mod_fecha" min="1900-01-01" max="<?php echo date("Y-m-d") ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dirección </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" id="mod_direccion" name="mod_direccion" pattern="|^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+(\s?[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.,-]+)*[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$|" title="Una dirección no admite caracteres especiales a excepción de punto, coma y guión medio. Ni admite espacios innecesarios " />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Teléfono </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input onkeypress="return SoloNumeros(event);" type="text" maxlength="10" class="form-control" id="mod_telefono" name="mod_telefono" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> E-mail </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="email" class="form-control" id="mod_email" name="mod_email" required pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" title="Ingrese un e-mail válido. Ejemplo example@hotmail.com" />
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Estado </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <select class="form-control" id="mod_estado" name="mod_estado">
                                                        <option value="A">ACTIVO</option>
                                                        <option value="I">INACTIVO</option>
                                                    </select>
                                                </div>  
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Clave </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="password" class="form-control" id="mod_clave" name="mod_clave" minlength="8" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Footer de la ventana -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" id="boton" class="btn btn-success">Guardar Usuario</button>
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