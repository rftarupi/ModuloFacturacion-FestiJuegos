<?php

include_once 'DataBase.php';
include_once 'Servicio.php';

// Clase que contiene los métodos CRUD de Servicios

class ServiciosModel {

    // MÉTODO PARA OBTENER TODOS LOS SERVICIOS
    public function getServicios() {
        // Obtención de informacion de la Base de Datos mediante consulta sql
        $pdo = Database::connect();
        $sql = 'select * from tab_fac_servicios order by COD_SERV';
        $resultado = $pdo->query($sql);

        //transformamos los registros en objetos de tipo Servicio y guardamos en array
        $listadoServicios = array();
        foreach ($resultado as $res) {
            $servicio = new Servicio($res['COD_SERV'], $res['NOMBRE_SERV'], $res['DESCRIPCION_SERV'], $res['COSTO_SERV']);
            array_push($listadoServicios, $servicio);
        }

        // Desconección de la Base de Datos
        Database::disconnect();

        // Retornamos el listado resultante:
        return $listadoServicios;
    }

    // MÉTODO PARA OBTENER DATOS DE UN SERVICIO EN ESPECÍFICO
    public function getServicio($COD_SERV) {
        //Obtención de informacion de la Base de Datos mediante consulta sql
        $pdo = Database::connect();
        $sql = 'select * from tab_fac_servicios where COD_SERV=?';
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($COD_SERV));

        // Guardamos el resultado obtenido en objeto tipo Servicio
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $servicio = new Servicio($res['COD_SERV'], $res['NOMBRE_SERV'], $res['DESCRIPCION_SERV'], $res['COSTO_SERV']);
        Database::disconnect();

        // Retornamos el Servicio encontrado
        return $servicio;
    }

    // MÉTODO PARA INSERTAR UN SERVICIO
    public function insertarServicio($COD_SERV, $NOMBRE_SERV, $DESCRIPCION_SERV, $COSTO_SERV) {
        // Conexión a Base de Datos y creación de consulta sql
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'insert into tab_fac_servicios(COD_SERV, NOMBRE_SERV, DESCRIPCION_SERV, COSTO_SERV) values(?,?,?,?)';
        $consulta = $pdo->prepare($sql);

        //Ejecutamos la consulta y pasamos los parametros
        try {
            $consulta->execute(array($COD_SERV, $NOMBRE_SERV, $DESCRIPCION_SERV, $COSTO_SERV));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }

    // MÉTODO PARA ACTUALIZAR DATOS DE SERVICIO
    public function actualizarServicio($COD_SERV, $NOMBRE_SERV, $DESCRIPCION_SERV, $COSTO_SERV) {
        // Conexión a BD y creación de consulta sql
        $pdo = Database::connect();
        $sql = 'update tab_fac_servicios set NOMBRE_SERV=?, DESCRIPCION_SERV=?, COSTO_SERV=? where COD_SERV=?';
        $consulta = $pdo->prepare($sql);

        //Ejecutamos la consulta y pasamos los parametros
        try {
            $consulta->execute(array($NOMBRE_SERV, $DESCRIPCION_SERV, $COSTO_SERV, $COD_SERV));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }

    // METODO PARA GENERAR AUTOMATICAMENTE EL CODIGO DE UN SERVICIO -- SERV-0001
    public function generarServicio() {
        $pdo = Database::connect();
        $sql = 'select max(COD_SERV) as cod from tab_fac_servicios';
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $nuevoCod = '';
        if ($res['cod'] == NULL) {
            $nuevoCod = 'SERV-0001';
        } else {
            $rest = ((substr($res['cod'], -4)) + 1) . ''; // Separacion de la parte numerica SERV-0023  --> 23
            // Ciclo que completa el codigo segun lo retornado para completar los 9 caracteres 
            // SERV-00 --> 67, SERV-0 --> 786
            if ($rest > 1 && $rest <= 9) {
                $nuevoCod = 'SERV-000' . $rest;
            } else {
                if ($rest >= 10 && $rest <= 99) {
                    $nuevoCod = 'SERV-00' . $rest;
                } else {
                    if ($rest >= 100 && $rest <= 999) {
                        $nuevoCod = 'SERV-0' . $rest;
                    } else {
                        $nuevoCod = 'SERV-' . $rest;
                    }
                }
            }
        }
        Database::disconnect();
        return $nuevoCod; // RETORNO DEL NUEVO CODIGO DE SERVICIO
    }

}
