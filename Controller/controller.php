<?php

require_once '../Model/ClientesModel.php';
require_once '../Model/ServiciosModel.php';
require_once '../Model/UsuariosModel.php';
require_once '../Model/TiposUsuarioModel.php';
require_once '../Model/FacturaDetallesModel.php';
require_once '../Model/CabFacturasModel.php';

session_start();
$usuariosModel = new UsuariosModel();
$serviciosModel = new ServiciosModel();
$clientesModel = new ClientesModel();
$tiposUsuarioModel = new TiposUsuarioModel();
$facturasModel = new CabFacturasModel();
$detallesModel = new FacturaDetallesModel();

$opcion1 = $_REQUEST['opcion1'];
$opcion2 = $_REQUEST['opcion2'];

unset($_SESSION['ErrorInicioSesion']);
unset($_SESSION['ErrorBaseDatos']);
unset($_SESSION['ErrorDetalleAjuste']);
unset($_SESSION['servicio']);
unset($_SESSION['listadoDetalles']);
//unset ($_SESSION['cliente']);


switch ($opcion1) {
    // S E S I O N E S
    case "iniciar_sesion":
        $E_MAIL_USU = $_REQUEST['email'];
        $CLAVE_USU = $_REQUEST['password'];
        // Verificación de la existencia del usuario
        $usuario = $usuariosModel->getUsuarioInicioSesion($E_MAIL_USU);

        // Verificación del email del usuario (debe ser diferente a vacio)
        if (!empty($usuario->getE_MAIL_USU())) {
            // Verificación de la contraseña del usuario
            if ($usuario->getCLAVE_USU() == $CLAVE_USU) {
                $tipoUsuario = $tiposUsuarioModel->getTipoUsuario($usuario->getCOD_TIPO_USU());
                $_SESSION['NOMBRE_USUARIO'] = $usuario->getNOMBRES_USU();
                $_SESSION['TIPO_USUARIO'] = $tipoUsuario->getDESCRIPCION_TIPO_USU();
                $_SESSION['USUARIO_ACTIVO'] = serialize($usuario);
                // Verifica las facturas incompletas(sin detalles o no finalizadas) y las borra
                $facturasModel->verificarFechaFactura();
                header('Location: ../View/Principal/inicio.php');
            } else {
                $_SESSION['ErrorInicioSesion'] = "Contraseña incorrecta";
                $_SESSION['E_MAIL_USU'] = $usuario->getE_MAIL_USU();
                header('Location: ../View/login.php');
            }
        } else {
            unset($_SESSION['E_MAIL_USU']);
            $_SESSION['ErrorInicioSesion'] = "Usuario incorrecto";
            header('Location: ../View/login.php');
        }
        break;

    case"cerrar_sesion":
        session_destroy();
        header('Location: ../View/login.php');
        break;

    // U S U A R I O 
    case "usuario":
        switch ($opcion2) {
            case "listar":
                // Obtenemos el array que contiene el listado de Usuarios
                $listadoUsuarios = $usuariosModel->getUsuarios();

                // Guardamos los datos en una variable de sesion serializada
                $_SESSION['listadoUsuarios'] = serialize($listadoUsuarios);

                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Usuarios/inicioUsuarios.php#principal');
                break;

            case "insertar_usuario":
                // Obtenemos parámetros enviados desde formulario de creación de Usuario
                $COD_USU = $_REQUEST['COD_USU'];
                $COD_TIPO_USU = $_REQUEST['COD_TIPO_USU'];
                $CEDULA_USU = $_REQUEST['CEDULA_USU'];
                $NOMBRES_USU = $_REQUEST['NOMBRES_USU'];
                $APELLIDOS_USU = $_REQUEST['APELLIDOS_USU'];
                $FECHA_NAC_USU = $_REQUEST['FECHA_NAC_USU'];
                $DIRECCION_USU = $_REQUEST['DIRECCION_USU'];
                $FONO_USU = $_REQUEST['FONO_USU'];
                $E_MAIL_USU = $_REQUEST['E_MAIL_USU'];
                $ESTADO_USU = $_REQUEST['ESTADO_USU'];
                $CLAVE_USU = $_REQUEST['CLAVE_USU'];

                if (empty($FECHA_NAC_USU)) {
                    $FECHA_NAC_USU = NULL;
                }

                // Enviamos parámetros a método de ingresar Usuario
                try {
                    $usuariosModel->insertarUsuario($COD_USU, $COD_TIPO_USU, $CEDULA_USU, $NOMBRES_USU, $APELLIDOS_USU, $FECHA_NAC_USU, $DIRECCION_USU, $FONO_USU, $E_MAIL_USU, $ESTADO_USU, $CLAVE_USU);
                } catch (Exception $e) {
                    $_SESSION['ErrorBaseDatos'] = $e->getMessage();
                }

                // Actualizamos y volvemos a serializar en variable de sesión la lista de Usuarios
                $listadoUsuarios = $usuariosModel->getUsuarios();
                $_SESSION['listadoUsuarios'] = serialize($listadoUsuarios);

                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Usuarios/inicioUsuarios.php#principal');
                break;

            case "guardar_usuario":
                //obtenemos los parametros del formulario
                $COD_USU = $_REQUEST['mod_id'];
                $NOMBRES_USU = $_REQUEST['mod_nombre'];
                $APELLIDOS_USU = $_REQUEST['mod_apellido'];
                $FECHA_NAC_USU = $_REQUEST['mod_fecha'];
                $DIRECCION_USU = $_REQUEST['mod_direccion'];
                $FONO_USU = $_REQUEST['mod_telefono'];
                $E_MAIL_USU = $_REQUEST['mod_email'];
                $ESTADO_USU = $_REQUEST['mod_estado'];
                $CLAVE_USU = $_REQUEST['mod_clave'];

                if (empty($FECHA_NAC_USU)) {
                    $FECHA_NAC_USU = NULL;
                }

                //actualizamos la información del Usuario
                try {
                    $usuariosModel->actualizarUsuario($COD_USU, $NOMBRES_USU, $APELLIDOS_USU, $FECHA_NAC_USU, $DIRECCION_USU, $FONO_USU, $E_MAIL_USU, $ESTADO_USU, $CLAVE_USU);
                } catch (Exception $e) {
                    $_SESSION['ErrorBaseDatos'] = $e->getMessage();
                }

                // Actualizamos y volvemos a serializar en variable de sesión la lista de Usuarios
                $listadoUsuarios = $usuariosModel->getUsuarios();
                $_SESSION['listadoUsuarios'] = serialize($listadoUsuarios);

                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Usuarios/inicioUsuarios.php#principal');
                break;

            case "exportar_pdf":
                $listadoUsuarios = $usuariosModel->getUsuarios();
                $_SESSION['listadoUsuarios'] = serialize($listadoUsuarios);

                header('Location: ../View/Usuarios/pdf_usuarios.php');
                break;

            default :
                header('Location: ../View/Usuarios/inicioUsuarios.php');
                break;
        }

        break;

    // C L I E N T E
    case "cliente":
        switch ($opcion2) {
            case "listar":
                // Obtenemos el array que contiene el listado de Clientes
                $listadoClientes = $clientesModel->getCLIENTES();

                // Guardamos los datos en una variable de sesion serializada
                $_SESSION['listadoClientes'] = serialize($listadoClientes);

                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Clientes/inicioClientes.php#principal');
                break;

            case "insertar_cliente":
                // Obtenemos parámetros enviados desde formulario de creación de cliente
                $COD_CLI = $_REQUEST['COD_CLI'];
                $CEDULA_CLI = $_REQUEST['CEDULA_CLI'];
                $NOMBRES_CLI = $_REQUEST['NOMBRES_CLI'];
                $APELLIDOS_CLI = $_REQUEST['APELLIDOS_CLI'];
                $FECHA_NAC_CLI = $_REQUEST['FECHA_NAC_CLI'];
                $DIRECCION_CLI = $_REQUEST['DIRECCION_CLI'];
                $FONO_CLI = $_REQUEST['FONO_CLI'];
                $E_MAIL_CLI = $_REQUEST['E_MAIL_CLI'];

                if (empty($FECHA_NAC_CLI)) {
                    $FECHA_NAC_CLI = NULL;
                }

                // Enviamos parámetros a método de ingresar cliente
                try {
                    $clientesModel->insertarCliente($COD_CLI, $CEDULA_CLI, $NOMBRES_CLI, $APELLIDOS_CLI, $FECHA_NAC_CLI, $DIRECCION_CLI, $FONO_CLI, $E_MAIL_CLI);
                } catch (Exception $e) {
                    $_SESSION['ErrorBaseDatos'] = $e->getMessage();
                }

                // Actualizamos y volvemos a serializar en variable de sesión la lista de Clientes
                $listadoClientes = $clientesModel->getClientes();
                $_SESSION['listadoClientes'] = serialize($listadoClientes);

                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Clientes/inicioClientes.php#principal');
                break;

            case "insertar_cliente_aux":
                // Obtenemos parámetros enviados desde formulario de creación de cliente
                $COD_CLI = $_REQUEST['COD_CLI'];
                $CEDULA_CLI = $_REQUEST['CEDULA_CLI'];
                $NOMBRES_CLI = $_REQUEST['NOMBRES_CLI'];
                $APELLIDOS_CLI = $_REQUEST['APELLIDOS_CLI'];
                $FECHA_NAC_CLI = $_REQUEST['FECHA_NAC_CLI'];
                $DIRECCION_CLI = $_REQUEST['DIRECCION_CLI'];
                $FONO_CLI = $_REQUEST['FONO_CLI'];
                $E_MAIL_CLI = $_REQUEST['E_MAIL_CLI'];

                if (empty($FECHA_NAC_CLI)) {
                    $FECHA_NAC_CLI = NULL;
                }
                try {
                    $clientesModel->insertarCliente($COD_CLI, $CEDULA_CLI, $NOMBRES_CLI, $APELLIDOS_CLI, $FECHA_NAC_CLI, $DIRECCION_CLI, $FONO_CLI, $E_MAIL_CLI);
                } catch (Exception $e) {
                    $_SESSION['ErrorBaseDatos'] = $e->getMessage();
                }
                $listadoClientes = $clientesModel->getClientes();
                $_SESSION['listadoClientes'] = serialize($listadoClientes);
                header('Location: ../View/Facturas/nuevaFactura.php');
                break;

            case "guardar_cliente":
                //obtenemos los parametros del formulario
                $COD_CLI = $_REQUEST['mod_id'];
                $NOMBRES_CLI = $_REQUEST['mod_nombre'];
                $APELLIDOS_CLI = $_REQUEST['mod_apellido'];
                $FECHA_NAC_CLI = $_REQUEST['mod_fecha'];
                $DIRECCION_CLI = $_REQUEST['mod_direccion'];
                $FONO_CLI = $_REQUEST['mod_telefono'];
                $E_MAIL_CLI = $_REQUEST['mod_email'];

                if (empty($FECHA_NAC_CLI)) {
                    $FECHA_NAC_CLI = NULL;
                }

                //actualizamos la información del cliente
                try {
                    $clientesModel->actualizarCliente($COD_CLI, $NOMBRES_CLI, $APELLIDOS_CLI, $FECHA_NAC_CLI, $DIRECCION_CLI, $FONO_CLI, $E_MAIL_CLI);
                } catch (Exception $e) {
                    $_SESSION['ErrorBaseDatos'] = $e->getMessage();
                }

                // Actualizamos y volvemos a serializar en variable de sesión la lista de Clientes
                $listadoClientes = $clientesModel->getClientes();
                $_SESSION['listadoClientes'] = serialize($listadoClientes);

                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Clientes/inicioClientes.php#principal');
                break;

            case "exportar_pdf":
                $listadoClientes = $clientesModel->getClientes();
                $_SESSION['listadoClientes'] = serialize($listadoClientes);

                header('Location: ../View/Clientes/pdf_clientes.php');
                break;

            default :
                header('Location: ../View/Clientes/inicioClientes.php');
                break;
        }

        break;

    // S E R V I C I O S
    case "servicio":
        switch ($opcion2) {
            case "listar":
                // Obtenemos el array que contiene el listado de Servicios
                $listadoServicios = $serviciosModel->getServicios();

                // Guardamos los datos en una variable de sesion serializada
                $_SESSION['listadoServicios'] = serialize($listadoServicios);

                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Servicios/inicioServicios.php#principal');
                break;

            case "insertar_servicio":
                // Obtenemos parámetros enviados desde formulario de creación de servicio
                $COD_SERV = $_REQUEST['COD_SERV'];
                $NOMBRE_SERV = $_REQUEST['NOMBRE_SERV'];
                $DESCRIPCION_SERV = $_REQUEST['DESCRIPCION_SERV'];
                $COSTO_SERV = $_REQUEST['COSTO_SERV'];

                // Enviamos parámetros a método de ingresar servicio
                try {
                    $serviciosModel->insertarServicio($COD_SERV, $NOMBRE_SERV, $DESCRIPCION_SERV, $COSTO_SERV);
                } catch (Exception $e) {
                    $_SESSION['ErrorBaseDatos'] = $e->getMessage();
                }

                // Actualizamos y volvemos a serializar en variable de sesión la lista de Servicios
                $listadoServicios = $serviciosModel->getServicios();
                $_SESSION['listadoServicios'] = serialize($listadoServicios);

                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Servicios/inicioServicios.php#principal');
                break;

            case "guardar_servicio":
                //obtenemos los parametros del formulario
                $COD_SERV = $_REQUEST['mod_id'];
                $NOMBRE_SERV = $_REQUEST['mod_nombre'];
                $DESCRIPCION_SERV = $_REQUEST['mod_descripcion'];
                $COSTO_SERV = $_REQUEST['mod_costo'];

                //actualizamos la información del servicio
                try {
                    $serviciosModel->actualizarServicio($COD_SERV, $NOMBRE_SERV, $DESCRIPCION_SERV, $COSTO_SERV);
                } catch (Exception $e) {
                    $_SESSION['ErrorBaseDatos'] = $e->getMessage();
                }

                // Actualizamos y volvemos a serializar en variable de sesión la lista de Servicios
                $listadoServicios = $serviciosModel->getServicios();
                $_SESSION['listadoServicios'] = serialize($listadoServicios);

                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Servicios/inicioServicios.php#principal');
                break;

            case "exportar_pdf":
                $listadoServicios = $serviciosModel->getServicios();
                $_SESSION['listadoServicios'] = serialize($listadoServicios);

                header('Location: ../View/Servicios/pdf_servicios.php');
                break;

            default :
                header('Location: ../View/Servicios/inicioServicios.php');
                break;
        }

        break;

    // C A B E C E R A  F A C T U R A
    case "factura":
        switch ($opcion2) {
            case "insertar_factura":
                unset($_SESSION['cliente']);
                $COD_CAB_FACT = $_REQUEST['COD_CAB_FACT'];
                $_SESSION['COD_FACT_TEMP'] = $COD_CAB_FACT;
                try {
                    $facturasModel->insertarCabFactura($COD_CAB_FACT);
                } catch (Exception $e) {
                    $_SESSION['ErrorBaseDatos'] = $e->getMessage();
                }
                $listadoFacturas = $facturasModel->getCabFacturas();
                $_SESSION['listadoFacturas'] = serialize($listadoFacturas);
                header('Location: ../View/Facturas/nuevaFactura.php');
                break;

            case "recargarDatosClienteBusquedaInteligente":
//                unset($_SESSION['ErrorStock']);
                $COD_CLI = $_REQUEST['COD_CLI'];
                $COD_CAB_FACT = $_SESSION['COD_FACT_TEMP'];
                $cliente = $clientesModel->getCliente($COD_CLI);
                $_SESSION['cliente'] = serialize($cliente);
                $COD_CAB_FACT = $_SESSION['COD_FACT_TEMP'];
                $listadoDetalles = $detallesModel->getDetallesFactura($COD_CAB_FACT);
                $_SESSION['listadoDetalles'] = serialize($listadoDetalles);
                $facturasModel->actualizarClienteFactura($COD_CAB_FACT, $COD_CLI);
                header('Location: ../View/Facturas/nuevaFactura.php#inicio');
                break;

            case "recargarDatosServicioBusquedaInteligente":
//                unset($_SESSION['ErrorStock']);
                $COD_SERV = $_REQUEST['COD_SERV'];
                $servicio = $serviciosModel->getServicio($COD_SERV);
                $_SESSION['servicio'] = serialize($servicio);
                $COD_CAB_FACT = $_SESSION['COD_FACT_TEMP'];
                $listadoDetalles = $detallesModel->getDetallesFactura($COD_CAB_FACT);
                $_SESSION['listadoDetalles'] = serialize($listadoDetalles);
                header('Location: ../View/Facturas/nuevaFactura.php#detalle');
                break;

            case "recargarDatosServicio":
                unset($_SESSION['ErrorStock']);
                $COD_SERV = $_REQUEST['COD_SERV'];
                $servicio = $serviciosModel->getServicio($COD_SERV);
                echo "<thead>
                <tr>
                <th width='50%'>SERVICIO</th>
                <th width='50%'>COSTO</th>
                </thead>
                <tbody>
                <tr class = 'info'>
                <td>" . $servicio->getNOMBRE_SERV() . "</td>
                <td>" . $servicio->getCOSTO_SERV() . "</td>         
                </tr>
                </tbody>";
                break;

            case "finalizar_factura":
                $COD_CAB_FACT = $_REQUEST['COD_FACT_TEMP'];
                if ($facturasModel->getCabFactura($COD_CAB_FACT)->getCOD_CLI() == NULL) {
                    $_SESSION['ErrorBaseDatos'] = "Error, no se ha escogido el cliente";
                    $listadoDetalles = $detallesModel->getDetallesFactura($COD_CAB_FACT);
                    $_SESSION['listadoDetalles'] = serialize($listadoDetalles);
                    header('Location: ../View/Facturas/nuevaFactura.php#inicio');
                } else {
                    if ($facturasModel->getCabFactura($COD_CAB_FACT)->getCOSTO_TOT_CAB_FACT() > 0) {
                        try {
                            $facturasModel->actualizarFechaFactura($COD_CAB_FACT);
                        } catch (Exception $e) {
                            $_SESSION['ErrorBaseDatos'] = $e->getMessage();
                        }
                        $listadoFacturas = $facturasModel->getCabFacturas();
                        $_SESSION['listadoFacturas'] = serialize($listadoFacturas);
                        $listadoDet = $detallesModel->getDetallesFactura($COD_CAB_FACT);
                        $_SESSION['listadoDet'] = serialize($listadoDet);
                        $_SESSION['FAC_NOTA_VENTA']= $COD_CAB_FACT;
                        unset($_SESSION['COD_FACT_TEMP']);
                        header('Location: ../View/Facturas/cambio_monetario.php');
                    } else {
                        $_SESSION['ErrorDetalleAjuste'] = "Error, no se encontraron detalles, ingrese al menos un detalle";
                        $listadoDetalles = $detallesModel->getDetallesFactura($COD_CAB_FACT);
                        $_SESSION['listadoDetalles'] = serialize($listadoDetalles);
                        header('Location: ../View/Facturas/nuevaFactura.php#detalle');
                    }
                }

                break;

            case "cancelar_factura":
                unset($_SESSION['COD_FACT_TEMP']);
                $listadoFacturas = $facturasModel->getCabFacturas();
                $_SESSION['listadoFacturas'] = serialize($listadoFacturas);
                header('Location: ../View/Facturas/inicioFacturas.php');
                break;

            case "reporteDia":
                $fecha_inicio = $_REQUEST['fecha_inicio'] . " 00:00:00";
                $fecha_fin = $_REQUEST['fecha_fin'] . " 23:59:59";

                $_SESSION['FECHA_I'] = $_REQUEST['fecha_inicio'];
                $_SESSION['FECHA_F'] = $_REQUEST['fecha_fin'];
                $listadoFiltradoFacturasDiario = $facturasModel->getFiltradoFacturasFecha($fecha_inicio, $fecha_fin);
                $_SESSION['listadoFiltradoFacturasDiario'] = serialize($listadoFiltradoFacturasDiario);
                header('Location: ../View/Facturas/reportesDiarios.php#filtrado');
                break;
            
            case "reporteMensual":
                $mes_inicio = $_REQUEST['mes_inicio'];
                $mes_fin = $_REQUEST['mes_fin'];

                $_SESSION['MES_I'] = $_REQUEST['mes_inicio'];
                $_SESSION['MES_F'] = $_REQUEST['mes_fin'];
                $listadoFiltradoFacturasMensual = $facturasModel->getFiltradoFacturasMensual($mes_inicio, $mes_fin);
                $_SESSION['listadoFiltradoFacturasMensual'] = serialize($listadoFiltradoFacturasMensual);
                header('Location: ../View/Facturas/reportesMensuales.php#filtrado');
                break;
            
            case "reporteAnual":
                $anio_inicio = $_REQUEST['anio_inicio'];
                $anio_fin = $_REQUEST['anio_fin'];

                $_SESSION['ANIO_I'] = $_REQUEST['anio_inicio'];
                $_SESSION['ANIO_F'] = $_REQUEST['anio_fin'];
                $listadoFiltradoFacturasAnual = $facturasModel->getFiltradoFacturasAnual($anio_inicio, $anio_fin);
                $_SESSION['listadoFiltradoFacturasAnual'] = serialize($listadoFiltradoFacturasAnual);
                header('Location: ../View/Facturas/reportesAnuales.php#filtrado');
                break;
            
            case "calculo_monetario":
                $valorBillete=$_REQUEST['BILLETE_RECIBIDO'];
                $codigoFactura=$_SESSION['FAC_NOTA_VENTA'];
                $cabFactura=$facturasModel->getCabFactura($codigoFactura);
                $totalFactura=$cabFactura->getCOSTO_TOT_CAB_FACT();
                if($valorBillete>=$totalFactura){
                    $cambio=$valorBillete-$totalFactura;
                }else{
                    $cambio=-1;
                }
                $_SESSION['cambio']=$cambio;
                $_SESSION['billete']=$valorBillete;
                
                header('Location: ../View/Facturas/VistaPreviaFactura.php');
                break;

            default:
                header('Location: ../View/Facturas/inicioFacturas.php');
                break;
        }
        break;

    // D E T A L L E S  F A C T U R A
    case "detalle":
        switch ($opcion2) {
            case "listar_detalles": //--
                $COD_CAB_FACT = $_REQUEST['COD_CAB_FACT'];
                $listadoDetalles = $detallesModel->getDetallesFactura($COD_CAB_FACT);
                $_SESSION['listadoDetalles'] = serialize($listadoDetalles);
                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Facturas/nuevaFactura.php');
                break;

            case "obtener_detalle": //--
                $COD_CAB_FACT = $_REQUEST['COD_CAB_FACT'];
                $detalle = $detallesModel->getDetalleFactura($COD_CAB_FACT);
                $_SESSION['detalle '] = serialize($detalle);
                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Facturas/nuevaFactura.php');
                break;

            case "insertar_detalle":
                $COD_CAB_FACT = $_SESSION['COD_FACT_TEMP'];
                $TIEMPO_HRS = $_REQUEST['TIEMPO_HRS'];
                $TIEMPO_MIN = $_REQUEST['TIEMPO_MIN'];

                if ($TIEMPO_HRS == 0 && $TIEMPO_MIN == 0) {
                    $_SESSION['ErrorDetalleAjuste'] = "Error, no se puede agragar un detalle con tiempo 0h0m";
                    $listadoDetalles = $detallesModel->getDetallesFactura($COD_CAB_FACT);
                    $_SESSION['listadoDetalles'] = serialize($listadoDetalles);
                    header('Location: ../View/Facturas/nuevaFactura.php#detalle');
                } else {
                    if ($_REQUEST['COD_SERV'] == NULL) {
                        $_SESSION['ErrorDetalleAjuste'] = "Error, no se ha escojido un servicio";
                        $listadoDetalles = $detallesModel->getDetallesFactura($COD_CAB_FACT);
                        $_SESSION['listadoDetalles'] = serialize($listadoDetalles);
                        header('Location: ../View/Facturas/nuevaFactura.php#detalle');
                    } else {
                        $COD_DET_FACT = $_REQUEST['COD_DET_FACT'];
                        $COD_SERV = $_REQUEST['COD_SERV'];
                        $serv = $serviciosModel->getServicio($COD_SERV);
                        $TIEMPO_CALC = $TIEMPO_MIN / 60;
                        $TIEMPO_DET_FACT = $TIEMPO_HRS + $TIEMPO_CALC;
                        $COSTO_HORA_DET_FACT = $serv->getCOSTO_SERV();
                        $COSTO_TOT_DET_FACT = $TIEMPO_DET_FACT * $COSTO_HORA_DET_FACT;

                        $factu = $facturasModel->getCabFactura($COD_CAB_FACT);
                        $cosTot = ($factu->getCOSTO_TOT_CAB_FACT()) + $COSTO_TOT_DET_FACT;
                        $facturasModel->actualizarCostoTotalFactura($COD_CAB_FACT, $cosTot);

                        try {
                            $detallesModel->insertarDetalleFactura($COD_DET_FACT, $COD_SERV, $COD_CAB_FACT, $TIEMPO_DET_FACT, $COSTO_HORA_DET_FACT, $COSTO_TOT_DET_FACT);
                        } catch (Exception $e) {
                            $_SESSION['ErrorDetalleAjuste'] = "Error, no se ha escojido un servicio: " . $e->getMessage();
                        }
                        $listadoDetalles = $detallesModel->getDetallesFactura($COD_CAB_FACT);
                        $_SESSION['listadoDetalles'] = serialize($listadoDetalles);
                        header('Location: ../View/Facturas/nuevaFactura.php#detalle');
                    }
                }
                break;

            case "eliminar_detalle": //--
                $COD_DET_FACT = $_REQUEST['COD_DET_FACT'];
                $COD_CAB_FACT = $_SESSION['COD_FACT_TEMP'];
                $COSTO_TOT_DET_FACT = $_REQUEST['COSTO_TOT_DET_FACT'];
                $cosTot = ($facturasModel->getCabFactura($COD_CAB_FACT)->getCOSTO_TOT_CAB_FACT()) - $COSTO_TOT_DET_FACT;
//                $cosTot=(4.80)-(4.80);

                $facturasModel->actualizarCostoTotalFactura($COD_CAB_FACT, $cosTot);
                $detallesModel->eliminarDetalleFactura($COD_DET_FACT);

                $listadoDetalles = $detallesModel->getDetallesFactura($COD_CAB_FACT);
                $_SESSION['listadoDetalles'] = serialize($listadoDetalles);
                // Redireccionamos a la pagina principal para visualizar
                header('Location: ../View/Facturas/nuevaFactura.php#detalle');
                break;
        }
        break;

    default:
        //si no existe la opcion recibida por el controlador, siempre
        //redirigimos la navegacion a la pagina principal:
        header('Location: ../View/login.php');
        break;
}
