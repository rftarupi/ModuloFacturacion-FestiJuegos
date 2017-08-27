<?php

//require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/UsuariosModel.php';
////require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/AjustesModel.php';
////require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/ProductosModel.php';

require_once '../Model/UsuariosModel.php';
require_once '../Model/TiposUsuarioModel.php';
//require_once '../Model/AjustesModel.php';
//require_once '../Model/ProductosModel.php';

session_start();
$usuariosModel = new UsuariosModel();
$tiposUsuarioModel = new TiposUsuarioModel();

$opcion1 = $_REQUEST['opcion1'];
$opcion2 = $_REQUEST['opcion2'];

unset($_SESSION['ErrorInicioSesion']);
unset($_SESSION['ErrorBaseDatos']);


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

            default :
                header('Location: ../View/Usuarios/inicioUsuarios.php');
                break;
        }

        break;
    // A J U S T E S
    case "ajuste":


    // S E R V I C I O S
    case "producto":


    default:
        //si no existe la opcion recibida por el controlador, siempre
        //redirigimos la navegacion a la pagina principal:
        header('Location: ../View/login.php');
        break;
}
