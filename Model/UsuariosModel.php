<?php
include_once 'DataBase.php';
include_once 'Usuario.php';

// Clase que contiene los métodos CRUD de Usuarios
class UsuariosModel {
    
     public function getUsuarioInicioSesion($E_MAIL_USU){
        $pdo = Database::connect();
        //$sql = 'select * from tab_fac_usuarios where "E_MAIL_USU"=kevin.rzz18@gmail.com';
        $sql = "select * from tab_fac_usuarios where E_MAIL_USU=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($E_MAIL_USU)); 
        // Se guarda el resultado obtenido en objeto tipo Usuario
        $res = $consulta->fetch(PDO::FETCH_ASSOC);    
        $usuario = new Usuario($res['COD_USU'], $res['COD_TIPO_USU'],$res['CEDULA_USU'], $res['NOMBRES_USU'], $res['APELLIDOS_USU'], $res['FECHA_NAC_USU'], $res['DIRECCION_USU'], $res['FONO_USU'], $res['E_MAIL_USU'], $res['ESTADO_USU'],$res['CLAVE_USU']);
        Database::disconnect();
        // Retorno del Usuario validado
        return $usuario;
    }
    
    public function obtenerTipoUsuario($COD_TIPO_USU){
       $pdo = Database::connect();
        $sql = "select DESCRIPCION_TIPO_USU as nombre from tab_fac_tipo_usu where COD_TIPO_USU='$COD_TIPO_USU'";
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $res['nombre'];
    }
    
    
}
