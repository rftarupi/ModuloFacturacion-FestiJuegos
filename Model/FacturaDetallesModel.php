<?php

include_once 'DataBase.php';
include_once 'FacturaDetalle.php';
include_once 'VistaFacturaDetalle.php';

class FacturaDetallesModel {
    
    // MÉTODO PARA OBTENER LOS DETALLES DE UNA FACTURA ESPECÍFICA (VISTA)
//    public function getDetallesFactura($COD_CAB_FACT) {
//        // Obtención de informacion de la Base de Datos mediante consulta sql
//        $pdo = Database::connect();
//        $sql = "select d.COD_DET_FACT, s.NOMBRE_SERV, d.TIEMPO_DET_FACT, d.COSTO_HORA_DET_FACT, d.COSTO_TOT_DET_FACT"
//              ." from tab_fac_det_facturas d, tab_fac_servicios s"
//              ." where s.COD_SERV=d.COD_SERV and d.COD_CAB_FACT=".$COD_CAB_FACT;
//        $resultado = $pdo->query($sql);
//        //transformamos los registros en objetos de tipo Usuario y guardamos en array
//        $listadoDetallesFact = array();
//        foreach ($resultado as $res) {
//            $detalleFact = new VistaFacturaDetalle($res['COD_DET_FACT'], $res['NOMBRE_SERV'], $res['TIEMPO_DET_FACT'], $res['COSTO_HORA_DET_FACT'], $res['COSTO_TOT_DET_FACT']);
//            array_push($listadoDetallesFact, $detalleFact);
//        }
//        Database::disconnect();
//        return $listadoDetallesFact;
//    }
    
     public function getDetallesFactura($COD_CAB_FACT) {
        // Obtención de informacion de la Base de Datos mediante consulta sql
        $pdo = Database::connect();
        $sql = 'select d.COD_DET_FACT, s.NOMBRE_SERV, d.TIEMPO_DET_FACT, d.COSTO_HORA_DET_FACT, d.COSTO_TOT_DET_FACT'
              .' from tab_fac_det_facturas d, tab_fac_servicios s'
              .' where s.COD_SERV=d.COD_SERV and d.COD_CAB_FACT="'.$COD_CAB_FACT.'"';
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos de tipo Usuario y guardamos en array
        $listadoDetallesFact = array();
        foreach ($resultado as $res) {
            $detalleFact = new VistaFacturaDetalle($res['COD_DET_FACT'], $res['NOMBRE_SERV'], $res['TIEMPO_DET_FACT'], $res['COSTO_HORA_DET_FACT'], $res['COSTO_TOT_DET_FACT']);
            array_push($listadoDetallesFact, $detalleFact);
        }
        Database::disconnect();
        return $listadoDetallesFact;
    }
    
    public function getDetallesFacturaPuro($COD_CAB_FACT) {
        // Obtención de informacion de la Base de Datos mediante consulta sql
        $pdo = Database::connect();
        $sql= 'select * from tab_fac_det_facturas where COD_CAB_FACT="'.$COD_CAB_FACT.'"';
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos de tipo Usuario y guardamos en array
        $listadoDetallesFact = array();
        foreach ($resultado as $res) {
            $detalleFact = new FacturaDetalle($res['COD_DET_FACT'], $res['COD_SERV'], $res['COD_CAB_FACT'], $res['TIEMPO_DET_FACT'], $res['COSTO_HORA_DET_FACT'], $res['COSTO_TOT_DET_FACT']);
            array_push($listadoDetallesFact, $detalleFact);
        }
        Database::disconnect();
        return $listadoDetallesFact;
    }
    
     // MÉTODO PARA OBTENER UN DETALLE ESPECIFICO DE UNA FACTURA (VISTA)
    public function getDetalleFactura ($COD_DET_FACT) {
        $pdo = Database::connect();
         $sql = "select d.COD_DET_FACT, s.NOMBRE_SERV, d.TIEMPO_DET_FACT, d.COSTO_HORA_DET_FACT, d.COSTO_TOT_DET_FACT"
              ." from tab_fac_det_facturas d, tab_fac_servicios s"
              ." where s.COD_SERV=d.COD_SERV and d.COD_DET_FACT=".$COD_DET_FACT;
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($COD_DET_FACT));
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $detalleFact = new VistaFacturaDetalle($res['COD_DET_FACT'], $res['NOMBRE_SERV'], $res['TIEMPO_DET_FACT'], $res['COSTO_HORA_DET_FACT'], $res['COSTO_TOT_DET_FACT']);
        Database::disconnect();
        return $detalleFact;
    }
    
    // MÉTODO PARA INSERTAR UN DETALLE DE UNA FACTURA (TABLA)
     public function insertarDetalleFactura($COD_DET_FACT, $COD_SERV, $COD_CAB_FACT, $TIEMPO_DET_FACT, $COSTO_HORA_DET_FACT, $COSTO_TOT_DET_FACT) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "insert into tab_fac_det_facturas(COD_DET_FACT, COD_SERV, COD_CAB_FACT, TIEMPO_DET_FACT, COSTO_HORA_DET_FACT, COSTO_TOT_DET_FACT) values(?,?,?,?,?,?)";
        $consulta = $pdo->prepare($sql);

        //Ejecutamos la consulta y pasamos los parametros
        try {
            $consulta->execute(array($COD_DET_FACT, $COD_SERV, $COD_CAB_FACT, $TIEMPO_DET_FACT, $COSTO_HORA_DET_FACT, $COSTO_TOT_DET_FACT));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }
    
    // METODO PARA ELIMINAR UN DETALLE DE FACTURA (TABLA)
    public function eliminarDetalleFactura($COD_DET_FACT) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'delete from tab_fac_det_facturas where COD_DET_FACT=?';
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($COD_DET_FACT));
        Database::disconnect();
    }
    
     // METODO PARA GENERAR EL COSTO TOTAL DE UN DETALLE DE FACTURA (TABLA)
     public function actualizarCostoTotalDet($COD_DET_FACT) {
        $pdo = Database::connect();
        $sql = "update tab_fac_det_facturas set COSTO_TOT_DET_FACT= TIEMPO_DET_FACT*COSTO_HORA_DET_FACT  where COD_DET_FACT=?";
        $consulta = $pdo->prepare($sql);
        try {
            $consulta->execute(array($COD_DET_FACT));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }
    
    // METODO PARA GENERAR HORAS Y MINUTOS DEL TIEMPO DE C/DETALLE DEL SERVICIO
     public function GetTiempoDetalle($TIEMPO_DET_FACT) {
        $hora = explode(".", $TIEMPO_DET_FACT);
        $hora[1] = round(($hora[1]*60/100));
        if($hora[1] < 10){
            $hora[1] = '0'.$hora[1];
        }
        $res = $hora[0].'h'.$hora[1];
        return $res;
    }
    
     // METODO QUE BUSCA SI UN DETALLE ESTA DUPLICADO (MISMO SERVICIO IGRESADO DOS VECES)
    public function existeDetalleDuplicado($COD_CAB_FACT, $COD_SERV){
        $validador=false;
        $listado = $this->getDetallesFacturaPuro($COD_CAB_FACT);
        foreach ($listado as $det) {
            if($det->getCOD_SERV() == $COD_SERV){
                $validador=true;
                break;
            }else{
                $validador=false;
            }
        }
        return $validador;
    }
    
    // METODO PARA AGREGAR INFORMACIÓN DE UN DETALLE YA EXISTENTE
    public function editarDetalleDuplicado($tiempoAcumulado, $costoAcumulado,$COD_SERV){
        $pdo = Database::connect();
         $sql = "update tab_fac_det_facturas set TIEMPO_DET_FACT=0 COSTO_TOT_DET_FACT=0  where COD_SERV=?";
        $sql = "update tab_fac_det_facturas set TIEMPO_DET_FACT=TIEMPO_DET_FACT+?, COSTO_TOT_DET_FACT=COSTO_TOT_DET_FACT+?  where COD_SERV=?";
        $consulta = $pdo->prepare($sql);
        try {
            $consulta->execute(array($tiempoAcumulado, $costoAcumulado, $COD_SERV));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }

  // METODO PARA GENERAR AUTOMATICAMENTE EL CODIGO DE UN DETALLE DE FACTURA -- DETF-0001
    public function generarCodDetalle(){
        $pdo = Database::connect();
        $sql = 'select max(COD_DET_FACT) as cod from tab_fac_det_facturas';
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $nuevoCod = '';
        if ($res['cod'] == NULL) {
            $nuevoCod = 'DETF-0001';
        } else {  
            $rest=  ((substr($res['cod'], -4))+1).''; // Separacion de la parte numerica DETF-0023  --> 23
            // Ciclo que completa el codigo segun lo retornado para completar los 9 caracteres 
            // DETF-00 --> 67, DETF-0 --> 786
            if($rest >1 && $rest <=9){
                $nuevoCod = 'DETF-000'.$rest;
            }else{
                if($rest >=10 && $rest <=99){
                    $nuevoCod = 'DETF-00'.$rest;
                }else{
                    if($rest >=100 && $rest <=999){
                    $nuevoCod = 'DETF-0'.$rest;
                    }else{
                       $nuevoCod = 'DETF-'.$rest; 
                    }                    
                } 
            }
        }
        Database::disconnect();
        return $nuevoCod; // RETORNO DEL NUEVO CODIGO DE DETALLE FACTURA
    }
}