<?php

include_once 'DataBase.php';
include_once 'Usuario.php';

// Clase que contiene los métodos CRUD de Usuarios
class UsuariosModel {

    // MÉTODO PARA OBTENER EL USUARIO QUE INICIA LA SESION
    public function getUsuarioInicioSesion($E_MAIL_USU) {
        $pdo = Database::connect();
        $sql = "select * from tab_fac_usuarios where E_MAIL_USU=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($E_MAIL_USU));
        // Se guarda el resultado obtenido en objeto tipo Usuario
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $usuario = new Usuario($res['COD_USU'], $res['COD_TIPO_USU'], $res['CEDULA_USU'], $res['NOMBRES_USU'], $res['APELLIDOS_USU'], $res['FECHA_NAC_USU'], $res['DIRECCION_USU'], $res['FONO_USU'], $res['E_MAIL_USU'], $res['ESTADO_USU'], $res['CLAVE_USU']);
        Database::disconnect();

        // Retorno del Usuario validado
        return $usuario;
    }

    // MÉTODO PARA OBTENER TODOS LOS USUARIOS
    public function getUsuarios() {
        // Obtención de informacion de la Base de Datos mediante consulta sql
        $pdo = Database::connect();
        $sql = 'select * from tab_fac_usuarios order by "COD_USU"';
        $resultado = $pdo->query($sql);

        //transformamos los registros en objetos de tipo Usuario y guardamos en array
        $listadoUsuarios = array();
        foreach ($resultado as $res) {
            $usuario = new Usuario($res['COD_USU'], $res['COD_TIPO_USU'], $res['CEDULA_USU'], $res['NOMBRES_USU'], $res['APELLIDOS_USU'], $res['FECHA_NAC_USU'], $res['DIRECCION_USU'], $res['FONO_USU'], $res['E_MAIL_USU'], $res['ESTADO_USU'], $res['CLAVE_USU']);
            array_push($listadoUsuarios, $usuario);
        }

        // Desconección de la Base de Datos
        Database::disconnect();

        // Retornamos el listado resultante:
        return $listadoUsuarios;
    }

    // MÉTODO PARA OBTENER DATOS DE UN USUARIO EN ESPECÍFICO
    public function getUsuario($COD_USU) {
        //Obtención de informacion de la Base de Datos mediante consulta sql
        $pdo = Database::connect();
        $sql = 'select * from tab_fac_usuarios where COD_USU=?';
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($COD_USU));

        // Guardamos el resultado obtenido en objeto tipo Usuario
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $usuario = new Usuario($res['COD_USU'], $res['COD_TIPO_USU'], $res['CEDULA_USU'], $res['NOMBRES_USU'], $res['APELLIDOS_USU'], $res['FECHA_NAC_USU'], $res['DIRECCION_USU'], $res['FONO_USU'], $res['E_MAIL_USU'], $res['ESTADO_USU'], $res['CLAVE_USU']);
        Database::disconnect();

        // Retornamos el Usuario encontrado
        return $usuario;
    }

    // MÉTODO PARA INSERTAR UN USUARIO
    public function insertarUsuario($COD_USU, $COD_TIPO_USU, $CEDULA_USU, $NOMBRES_USU, $APELLIDOS_USU, $FECHA_NAC_USU, $DIRECCION_USU, $FONO_USU, $E_MAIL_USU, $ESTADO_USU, $CLAVE_USU) {
        // Conexión a Base de Datos y creación de consulta sql
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'insert into tab_fac_usuarios(COD_USU, COD_TIPO_USU, CEDULA_USU, NOMBRES_USU, APELLIDOS_USU, FECHA_NAC_USU, DIRECCION_USU, FONO_USU, E_MAIL_USU, ESTADO_USU, CLAVE_USU) values(?,?,?,?,?,?,?,?,?,?,?)';
        $consulta = $pdo->prepare($sql);

        //Ejecutamos la consulta y pasamos los parametros
        try {
            $consulta->execute(array($COD_USU, $COD_TIPO_USU, $CEDULA_USU, $NOMBRES_USU, $APELLIDOS_USU,
                $FECHA_NAC_USU, $DIRECCION_USU, $FONO_USU, $E_MAIL_USU, $ESTADO_USU, $CLAVE_USU));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }

    // MÉTODO PARA ACTUALIZAR DATOS DE USUARIO
    public function actualizarUsuario($COD_USU, $NOMBRES_USU, $APELLIDOS_USU, $FECHA_NAC_USU, $DIRECCION_USU, $FONO_USU, $E_MAIL_USU, $ESTADO_USU, $CLAVE_USU) {
        // Conexión a BD y creación de consulta sql
        $pdo = Database::connect();
        $sql = 'update tab_fac_usuarios set NOMBRES_USU=?, APELLIDOS_USU=?, FECHA_NAC_USU=?, DIRECCION_USU=?, FONO_USU=?, E_MAIL_USU=?, ESTADO_USU=?, CLAVE_USU=? where COD_USU=?';
        $consulta = $pdo->prepare($sql);

        //Ejecutamos la consulta y pasamos los parametros
        try {
            $consulta->execute(array($NOMBRES_USU, $APELLIDOS_USU,
                $FECHA_NAC_USU, $DIRECCION_USU, $FONO_USU, $E_MAIL_USU, $ESTADO_USU, $CLAVE_USU, $COD_USU));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }
    
    // METODO PARA GENERAR AUTOMATICAMENTE EL CODIGO DE UN USUARIO -- USUA-0001
     public function generarUsuario() {
        $pdo = Database::connect();
        $sql = 'select max(COD_USU) as cod from tab_fac_usuarios';
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $nuevoCod = '';
        if ($res['cod'] == NULL) {
            $nuevoCod = 'USUA-0001';
        } else {  
            $rest=  ((substr($res['cod'], -4))+1).''; // Separacion de la parte numerica USUA-0023  --> 23
            // Ciclo que completa el codigo segun lo retornado para completar los 9 caracteres 
            // USUA-00 --> 67, USUA-0 --> 786
            if($rest >1 && $rest <=9){
                $nuevoCod = 'USUA-000'.$rest;
            }else{
                if($rest >=10 && $rest <=99){
                    $nuevoCod = 'USUA-00'.$rest;
                }else{
                    if($rest >=100 && $rest <=999){
                    $nuevoCod = 'USUA-0'.$rest;
                    }else{
                       $nuevoCod = 'USUA-'.$rest; 
                    }                    
                } 
            }
        }
        Database::disconnect();
        return $nuevoCod; // RETORNO DEL NUEVO CODIGO DE USUARIO
    }
    
    
    
    
    // MÉTODO PARA OBTENER EL ESTADO DEL USUARIO
    public function obtenerEstadoUsuario($COD_USU) {
        $usuario = $this->getUsuario($COD_USU);
        $estado=NULL;
        switch ($usuario->getESTADO_USU()){
            case "A": $estado = "Activo";
                break;
            case "I": $estado = "Inactivo";
                break;
        }
        return $estado;
    }

}
