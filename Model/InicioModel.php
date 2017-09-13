<?php

include_once 'DataBase.php';

// Clase que contiene los métodos del calculo de información de la pantalla inicial

class Inicio {

    // MÉTODO PARA OBTENER EL NÚMERO DE CLIENTES
    public function getNumClientes() {
        // Obtención de informacion de la Base de Datos mediante consulta sql
        $pdo = Database::connect();
        $sql = 'select count(*) from tab_fac_clientes';
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        $res = $consulta->fetch(PDO::FETCH_ASSOC);

        Database::disconnect();

        // Retornamos el número encontrado
        return $res['count(*)'];
    }
    
    // MÉTODO PARA OBTENER EL NÚMERO DE SERVICIOS
    public function getNumServicios() {
        // Obtención de informacion de la Base de Datos mediante consulta sql
        $pdo = Database::connect();
        $sql = 'select count(*) from tab_fac_servicios';
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        $res = $consulta->fetch(PDO::FETCH_ASSOC);

        Database::disconnect();

        // Retornamos el número encontrado
        return $res['count(*)'];
    }
    
    // MÉTODO PARA OBTENER EL NÚMERO DE FACTURAS MENSUALES
    public function getTotFact($FECHA_IN, $FECHA_FIN) {
        // Obtención de informacion de la Base de Datos mediante consulta sql
        $pdo = Database::connect();
        $sql = 'select count(*) from tab_fac_cab_facturas where FECHA_CAB_FACT BETWEEN ? and ?';
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($FECHA_IN, $FECHA_FIN));
        $res = $consulta->fetch(PDO::FETCH_ASSOC);

        Database::disconnect();

        // Retornamos el número encontrado
        return $res['count(*)'];
    }
    
    // MÉTODO PARA OBTENER LA SUMA DE FACTURAS MENSUALES
    public function getTotMens($FECHA_IN, $FECHA_FIN) {
        // Obtención de informacion de la Base de Datos mediante consulta sql
        $pdo = Database::connect();
        $sql = 'select sum(COSTO_TOT_CAB_FACT) from tab_fac_cab_facturas where FECHA_CAB_FACT BETWEEN ? and ?';
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($FECHA_IN, $FECHA_FIN));
        $res = $consulta->fetch(PDO::FETCH_ASSOC);

        Database::disconnect();

        // Retornamos el número encontrado
        return $res['sum(COSTO_TOT_CAB_FACT)'];
    }

}
