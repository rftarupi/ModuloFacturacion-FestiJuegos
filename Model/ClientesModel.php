<?php

include_once 'DataBase.php';
include_once 'Cliente.php';

// Clase que contiene los métodos CRUD de Clientes

class ClientesModel {

    // MÉTODO PARA OBTENER TODOS LOS CLIENTES
    public function getClientes() {
        // Obtención de informacion de la Base de Datos mediante consulta sql
        $pdo = Database::connect();
        $sql = 'select * from tab_fac_clientes order by COD_CLI';
        $resultado = $pdo->query($sql);

        //transformamos los registros en objetos de tipo Cliente y guardamos en array
        $listadoClientes = array();
        foreach ($resultado as $res) {
            $cliente = new Cliente($res['COD_CLI'], $res['CEDULA_CLI'], $res['NOMBRES_CLI'], $res['APELLIDOS_CLI'], $res['FECHA_NAC_CLI'], $res['DIRECCION_CLI'], $res['FONO_CLI'], $res['E_MAIL_CLI']);
            array_push($listadoClientes, $cliente);
        }

        // Desconección de la Base de Datos
        Database::disconnect();

        // Retornamos el listado resultante:
        return $listadoClientes;
    }

    // MÉTODO PARA OBTENER DATOS DE UN CLIENTE EN ESPECÍFICO
    public function getCliente($COD_CLI) {
        //Obtención de informacion de la Base de Datos mediante consulta sql
        $pdo = Database::connect();
        $sql = 'select * from tab_fac_clientes where COD_CLI=?';
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($COD_CLI));

        // Guardamos el resultado obtenido en objeto tipo Cliente
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $cliente = new Cliente($res['COD_CLI'], $res['CEDULA_CLI'], $res['NOMBRES_CLI'], $res['APELLIDOS_CLI'], $res['FECHA_NAC_CLI'], $res['DIRECCION_CLI'], $res['FONO_CLI'], $res['E_MAIL_CLI']);
        Database::disconnect();

        // Retornamos el Cliente encontrado
        return $cliente;
    }

    // MÉTODO PARA INSERTAR UN CLIENTE
    public function insertarCliente($COD_CLI, $CEDULA_CLI, $NOMBRES_CLI, $APELLIDOS_CLI, $FECHA_NAC_CLI, $DIRECCION_CLI, $FONO_CLI, $E_MAIL_CLI) {
        // Conexión a Base de Datos y creación de consulta sql
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'insert into tab_fac_clientes(COD_CLI, CEDULA_CLI, NOMBRES_CLI, APELLIDOS_CLI, FECHA_NAC_CLI, DIRECCION_CLI, FONO_CLI, E_MAIL_CLI) values(?,?,?,?,?,?,?,?)';
        $consulta = $pdo->prepare($sql);

        //Ejecutamos la consulta y pasamos los parametros
        try {
            $consulta->execute(array($COD_CLI, $CEDULA_CLI, $NOMBRES_CLI, $APELLIDOS_CLI,
                $FECHA_NAC_CLI, $DIRECCION_CLI, $FONO_CLI, $E_MAIL_CLI));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }

    // MÉTODO PARA ACTUALIZAR DATOS DE CLIENTE
    public function actualizarCliente($COD_CLI, $NOMBRES_CLI, $APELLIDOS_CLI, $FECHA_NAC_CLI, $DIRECCION_CLI, $FONO_CLI, $E_MAIL_CLI) {
        // Conexión a BD y creación de consulta sql
        $pdo = Database::connect();
        $sql = 'update tab_fac_clientes set NOMBRES_CLI=?, APELLIDOS_CLI=?, FECHA_NAC_CLI=?, DIRECCION_CLI=?, FONO_CLI=?, E_MAIL_CLI=? where COD_CLI=?';
        $consulta = $pdo->prepare($sql);

        //Ejecutamos la consulta y pasamos los parametros
        try {
            $consulta->execute(array($NOMBRES_CLI, $APELLIDOS_CLI,
                $FECHA_NAC_CLI, $DIRECCION_CLI, $FONO_CLI, $E_MAIL_CLI, $COD_CLI));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }

    // METODO PARA GENERAR AUTOMATICAMENTE EL CODIGO DE UN CLIENTE -- CLIE-0001
    public function generarCliente() {
        $pdo = Database::connect();
        $sql = 'select max(COD_CLI) as cod from tab_fac_clientes';
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $nuevoCod = '';
        if ($res['cod'] == NULL) {
            $nuevoCod = 'CLIE-0001';
        } else {
            $rest = ((substr($res['cod'], -4)) + 1) . ''; // Separacion de la parte numerica CLIE-0023  --> 23
            // Ciclo que completa el codigo segun lo retornado para completar los 9 caracteres 
            // CLIE-00 --> 67, CLIE-0 --> 786
            if ($rest > 1 && $rest <= 9) {
                $nuevoCod = 'CLIE-000' . $rest;
            } else {
                if ($rest >= 10 && $rest <= 99) {
                    $nuevoCod = 'CLIE-00' . $rest;
                } else {
                    if ($rest >= 100 && $rest <= 999) {
                        $nuevoCod = 'CLIE-0' . $rest;
                    } else {
                        $nuevoCod = 'CLIE-' . $rest;
                    }
                }
            }
        }
        Database::disconnect();
        return $nuevoCod; // RETORNO DEL NUEVO CODIGO DE CLIENTE
    }

}
