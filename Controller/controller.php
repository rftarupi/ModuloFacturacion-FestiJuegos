<?php
//require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/UsuariosModel.php';
////require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/AjustesModel.php';
////require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/ProductosModel.php';

require_once '../Model/UsuariosModel.php';
//require_once '../Model/AjustesModel.php';
//require_once '../Model/ProductosModel.php';

session_start();
$usuariosModel = new UsuariosModel();

$opcion1 = $_REQUEST['opcion1'];
$opcion2 = $_REQUEST['opcion2'];

unset($_SESSION['ErrorInicioSesion']);


switch ($opcion1) {
    // S E S I O N E S
    case "iniciar_sesion":
        $E_MAIL_USU = $_REQUEST['email'];
        $CLAVE_USU = $_REQUEST['password'];
        // Verificación de la existencia del usuario
        $usuario=$usuariosModel->getUsuarioInicioSesion($E_MAIL_USU);

        // Verificación del email del usuario (debe ser diferente a vacio)
        if (!empty($usuario->getE_MAIL_USU())) {
            // Verificación de la contraseña del usuario
            if ($usuario->getCLAVE_USU() == $CLAVE_USU) {
                $_SESSION['NOMBRE_USUARIO'] = $usuario->getNOMBRES_USU();
                $_SESSION['TIPO_USUARIO'] = $usuariosModel->obtenerTipoUsuario($usuario->getCOD_TIPO_USU());
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
