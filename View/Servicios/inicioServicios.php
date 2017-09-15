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
        include_once '../../Model/Servicio.php';
        include_once '../../Model/ServiciosModel.php';

        // Deserializamos el cliente en sesión
        $usuarioSesion = unserialize($_SESSION['USUARIO_ACTIVO']);

        // Creamos la variable para el llamado de los métodos de la tabla Cliente
        $serviciosModel = new ServiciosModel();

        $NOM = $_SESSION['NOMBRE_USUARIO'];
        $TIPO = $_SESSION['TIPO_USUARIO'];
        ?>
        <head>
            <meta charset="UTF-8">
            <title>Servicios</title>
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">				
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

            <!--Importaciones Js-->
            <script src="../../Dependencias/js/jquery-2.1.4.js"></script>
            <script src="../../Dependencias/js/bootstrap.js"></script>
            <script src="../../Dependencias/js/getDatos.js"></script>
            <script src="../../Dependencias/js/bootstrap-table.js"></script>
            <script src = "../../Dependencias/SweetAlert/sweetalert.min.js" type="text/javascript"></script>
            <script src="../../Dependencias/js/validaciones.js"></script>

            <script src="../../Dependencias/DataTables/servicio.js"></script>
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
            
            <script language="javascript">
                function ValidarLongitud(des) {
                    var des = des;
                    array = des.split("");
                    num = array.length;
                   
                   if(num<=199){
                       return true;
                   }else{
                        swal({
                    title: "Aviso",
                    text: "La longitud en este campo es de máximo 200 caracteres",
                    type: "info",
                    confirmButtonText: "Ok"});
                       return false;
                   }
                }
                function ValidarLongitudNombre(des) {
                    var des = des;
                    array = des.split("");
                    num = array.length;
                   
                   if(num<=49){
                       return true;
                   }else{
                        swal({
                    title: "Aviso",
                    text: "La longitud en este campo es de máximo 50 caracteres",
                    type: "info",
                    confirmButtonText: "Ok"});
                       return false;
                   }
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
                            <h1><span class="glyphicon glyphicon-user"></span> SERVICIOS</h1></div>
                    </div>
                </div>

                <!--La clase col nos permite que la pagina sea responsive mediante numero de columnas
                     donde el total de columnas es 12 y
                     donde lg es en tamaño de escritorio, md medianos, sm tablets, xs celulares -->

                <div class="row">
                    <div class="col-md-12" style="padding-top: 5px">
                        <!--La class nav nav-pills nos permite hacer menús-->
                        <ul class="nav nav-pills">
                            <li role = 'presentation'><a href = '#nuevoSERV' data-toggle = 'modal'><h4>NUEVO SERVICIO</h4></a></li>
                            <li role = 'presentation'><a href='../../Controller/controller.php?opcion1=servicio&opcion2=exportar_pdf' target='_blank' ><h4><span class='glyphicon glyphicon glyphicon-open-file'></span> EXPORTAR A PDF</h4></a></li>
                        </ul>
                    </div>
                </div>
                <br>

                <?php
                if (isset($_SESSION['ErrorBaseDatos'])) {
                    echo "<div class='alert alert-danger'><strong><span class='glyphicon glyphicon-remove-sign'></span> ERROR:</strong> El Servicio que intenta ingresar ya existe en la Base de Datos</div>";
                }
                ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"><h4>Lista de Servicios</h4></div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <div class="table-striped">
                                        <!-- Tabla en la que se listara los servicios de la Base de Datos -->
                                        <table class="table table-striped table-bordered table-condensed table-condensed" id="servicio" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>ACCIONES</th>
                                                    <th>CÓDIGO SERVICIO</th>
                                                    <th>NOMBRE</th>
                                                    <th>DESCRIPCION</th>
                                                    <th>COSTO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Verificamos si existe la variable de sesión que contiene la lista de Servicios
                                                if (isset($_SESSION['listadoServicios'])) {
                                                    // Deserializamos y mostraremos los atributos de los servicios usando un ciclo for
                                                    $listado = unserialize($_SESSION['listadoServicios']);
                                                } else {
                                                    $listado = $serviciosModel->getServicios();
                                                }
                                                foreach ($listado as $serv) {
                                                    ?>
                                                    <tr>
                                                        <td><a href = "#editSERV" onclick = "obtener_datos_servicio('<?php echo $serv->getCOD_SERV(); ?>')" data-toggle = "modal"><span class = "glyphicon glyphicon-pencil">Editar</span></a></td>
                                                        <td><?php echo $serv->getCOD_SERV(); ?></td>
                                                        <td><?php echo $serv->getNOMBRE_SERV(); ?></td>
                                                        <td><?php echo $serv->getDESCRIPCION_SERV(); ?></td>
                                                        <td><?php echo $serv->getCOSTO_SERV(); ?></td>

                                                <input type="hidden" value="<?php echo $serv->getCOD_SERV(); ?>" id="COD_SERV<?php echo $serv->getCOD_SERV(); ?>">
                                                <input type="hidden" value="<?php echo $serv->getNOMBRE_SERV(); ?>" id="NOMBRE_SERV<?php echo $serv->getCOD_SERV(); ?>">
                                                <input type="hidden" value="<?php echo $serv->getDESCRIPCION_SERV(); ?>" id="DESCRIPCION_SERV<?php echo $serv->getCOD_SERV(); ?>">
                                                <input type="hidden" value="<?php echo $serv->getCOSTO_SERV(); ?>" id="COSTO_SERV<?php echo $serv->getCOD_SERV(); ?>">

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

                <!--Ventana emergente para Nuevo Servicio-->
                <div class="modal fade" id="nuevoSERV">
                    <div class="modal-dialog">
                        <form class="form-horizontal" action="../../Controller/controller.php">
                            <input type="hidden" name="opcion1" value="servicio">
                            <input type="hidden" name="opcion2" value="insertar_servicio">

                            <div class="modal-content">
                                <!-- Header de la ventana -->

                                <div class="modal-header bg-success">
                                    <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h3 class="modal-title"><span class="glyphicon glyphicon-user"></span> Nuevo Servicio </h3>
                                </div>

                                <!-- Contenido de la ventana -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Código Servicio </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <?php echo $serviciosModel->generarServicio(); ?>
                                                    <input type="hidden" name="COD_SERV" value="<?php echo $serviciosModel->generarServicio(); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Nombre </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input onkeypress="return ValidarLongitudNombre(this.form.nom.value);" id="nom" name="nom" type="text" class="form-control" name="NOMBRE_SERV" placeholder="Ingrese el Nombre del Servicio" required/>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Descripción </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input onkeypress="return ValidarLongitud(this.form.des.value);" id="des" name="des" type="text" class="form-control" name="DESCRIPCION_SERV" placeholder="Ingrese una descripción para el Servicio" required/>
                                                   
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Costo </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input onkeypress="return SoloNumeros(event);" type="text" class="form-control" name="COSTO_SERV" placeholder="Ingrese el Costo del Servicio" required pattern="[1-9][0-9]{1,9}([.][0-9]{1,2})?" title="el costo debe contener máximo diez enteros y dos decimales separados por punto" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Footer de la ventana -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        <button id="boton" class="btn btn-success">Guardar Servicio</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <!--Ventana emergente para Editar Servicio-->
                <div class="modal fade" id="editSERV">
                    <div class="modal-dialog">
                        <form class="form-horizontal" action="../../Controller/controller.php">
                            <input type="hidden" name="opcion1" value="servicio">
                            <input type="hidden" name="opcion2" value="guardar_servicio">

                            <div class="modal-content">
                                <!-- Header de la ventana --> 
                                <div class="modal-header bg-success">
                                    <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h3 class="modal-title"><span class="glyphicon glyphicon-cog"></span> Editar Servicio</h3>
                                </div>

                                <!-- Contenido de la ventana -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Código Servicio</label>    
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="hidden" id="mod_id" name="mod_id" value=""  >
                                                    <p id="mod_cod"></p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Nombre </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input onkeypress="return SoloLetras(event);"type="text" class="form-control" id="mod_nombre" name="mod_nombre"  required pattern="|^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+(\s?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+)*[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$|" title="El campo no admite espacios en blanco innecesarios, ni admite espacios al inicio o final" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Descripción </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input onkeypress="return SoloLetras(event);"type="text" class="form-control" id="mod_descripcion" name="mod_descripcion"  required pattern="|^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+(\s?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+)*[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$|" title="El campo no admite espacios en blanco innecesarios, ni admite espacios al inicio o final" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-1">
                                                    <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Costo </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input onkeypress="return SoloNumeros(event);" type="text" class="form-control" id="mod_costo" name="mod_costo" required pattern="[1-9][0-9]{1,9}([.][0-9]{1,2})?" title="el costo debe contener máximo diez enteros y dos decimales separados por punto" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Footer de la ventana -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" id="boton" class="btn btn-success">Guardar Servicio</button>
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