<?php

include_once 'DataBase.php';
include_once 'CabFactura.php';


// Clase que contiene los métodos CRUD de Cabecera Facturas

class CabFacturasModel {
    
    // MÉTODO PARA OBTENER TODAS LAS CABECERAS DE FACTURAS
    public function getCabFacturas() {
        // Obtención de informacion de la Base de Datos mediante consulta sql
        $pdo = Database::connect();
        $sql = 'select * from tab_fac_cab_facturas order by COD_CAB_FACT';
        $resultado = $pdo->query($sql);

        //transformamos los registros en objetos de tipo CabFactura y guardamos en array
        $listadoCabFacturas = array();
        foreach ($resultado as $res) {
            $cabFactura = new CabFactura($res['$COD_CAB_FACT'], $res['ESTADO_IMP_FAC'], $res['COD_CLI'], $res['FECHA_CAB_FACT'], $res['SUBT_IVA_CAB_FACT'], $res['IVA_CAB_FACT'], $res['COSTO_TOT_CAB_FACT']);
            array_push($listadoCabFacturas, $cabFactura);
        }

        // Desconección de la Base de Datos
        Database::disconnect();

        // Retornamos el listado resultante:
        return $listadoCabFacturas;
    }

    // MÉTODO PARA OBTENER DATOS DE UNA CABECERA DE FACTURA EN ESPECÍFICO
    public function getCabFactura($COD_CAB_FACT) {
        //Obtención de informacion de la Base de Datos mediante consulta sql
        $pdo = Database::connect();
        $sql = 'select * from tab_fac_cab_facturas where COD_CAB_FACT=?';
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($COD_CAB_FACT));

        // Guardamos el resultado obtenido en objeto tipo CabFactura
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $cabFactura = new CabFactura($res['COD_CAB_FACT'], $res['ESTADO_IMP_FAC'], $res['COD_CLI'], $res['FECHA_CAB_FACT'], $res['SUBT_IVA_CAB_FACT'], $res['IVA_CAB_FACT'], $res['COSTO_TOT_CAB_FACT']);
        Database::disconnect();

        // Retornamos el CabFactura encontrado
        return $cabFactura;
    }
    
    // MÉTODO PARA INSERTAR UNA CABECERA DE FACTURA
    public function insertarCabFactura($COD_CAB_FACT, $COD_CLI, $FECHA_CAB_FACT) {
        // Conexión a Base de Datos y creación de consulta sql
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'insert into tab_fac_cab_facturas(COD_CAB_FACT, COD_CLI, FECHA_CAB_FACT) values(?,?,?)';
        $consulta = $pdo->prepare($sql);

        //Ejecutamos la consulta y pasamos los parametros
        try {
            $consulta->execute(array($COD_CAB_FACT, $COD_CLI, $FECHA_CAB_FACT));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }

}
