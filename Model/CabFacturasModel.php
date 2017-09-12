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
            $cabFactura = new CabFactura($res['COD_CAB_FACT'], $res['ESTADO_IMP_FAC'], $res['COD_CLI'], $res['FECHA_CAB_FACT'], $res['COSTO_TOT_CAB_FACT']);
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
        $cabFactura = new CabFactura($res['COD_CAB_FACT'], $res['ESTADO_IMP_FAC'], $res['COD_CLI'], $res['FECHA_CAB_FACT'], $res['COSTO_TOT_CAB_FACT']);
        Database::disconnect();

        // Retornamos el CabFactura encontrado
        return $cabFactura;
    }
    
    // MÉTODO PARA INSERTAR UNA CABECERA DE FACTURA
    public function insertarCabFactura($COD_CAB_FACT) {
        // Conexión a Base de Datos y creación de consulta sql
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'insert into tab_fac_cab_facturas(COD_CAB_FACT) values(?)';
        $consulta = $pdo->prepare($sql);

        //Ejecutamos la consulta y pasamos los parametros
        try {
            $consulta->execute(array($COD_CAB_FACT));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }
    
    // MÉTODO PARA INSERTAR(ACTUALIZAR) EL CLIENTE DE UNA FACTURA
    public function actualizarClienteFactura($COD_CAB_FACT, $COD_CLI) {
        $pdo = Database::connect();
        $sql = 'update tab_fac_cab_facturas set COD_CLI=? where COD_CAB_FACT=?';
        $consulta = $pdo->prepare($sql);

        try {
            $consulta->execute(array($COD_CLI,$COD_CAB_FACT));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }
    
     // METODO PARA ELIMINAR UNA FACTURA (SOLO SE LO USA EN EL MODEL)
    	protected function eliminarFactura($COD_CAB_FACT){
	       $pdo = Database::connect();
	        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		        $sql = 'delete from tab_fac_cab_facturas where COD_CAB_FACT=?';
	        $consulta = $pdo->prepare($sql);
	        $consulta->execute(array($COD_CAB_FACT));
	        Database::disconnect();
	    }

	// METODO PARA VERIFICAR SI UNA FECHA NO ES NULA
         public function verificarFechaFactura(){
        $listadoCabFacturas= $this->getCabFacturas();
        foreach ($listadoCabFacturas as $fact) {
            if($fact->getFECHA_CAB_FACT()==NULL){
                $this->eliminarFactura($fact->getCOD_CAB_FACT());
            }
          }
        }
        
        // METODO PARA ACTUALIZAR UNA FECHA DE FACTURA
         public function actualizarFechaFactura($COD_CAB_FACT){
        	$pdo = Database::connect();
	        $sql = 'update tab_fac_cab_facturas set FECHA_CAB_FACT=CURRENT_TIMESTAMP where COD_CAB_FACT=?';
	        $consulta = $pdo->prepare($sql);
	        try {
	            $consulta->execute(array($COD_CAB_FACT));
	        } catch (PDOException $e) {
	            Database::disconnect();
	            throw new Exception($e->getMessage());
	        }
	        Database::disconnect();
	    }
    
    // METODO PARA GENERAR AUTOMATICAMENTE EL CODIGO DE UNA FACTURA -- FACT-0001
    public function generarCodFactura(){
        $pdo = Database::connect();
        $sql = 'select max(COD_CAB_FACT) as cod from tab_fac_cab_facturas';
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $nuevoCod = '';
        if ($res['cod'] == NULL) {
            $nuevoCod = 'FACT-0001';
        } else {  
            $rest=  ((substr($res['cod'], -4))+1).''; // Separacion de la parte numerica FACT-0023  --> 23
            // Ciclo que completa el codigo segun lo retornado para completar los 9 caracteres 
            // FACT-00 --> 67, FACT-0 --> 786
            if($rest >1 && $rest <=9){
                $nuevoCod = 'FACT-000'.$rest;
            }else{
                if($rest >=10 && $rest <=99){
                    $nuevoCod = 'FACT-00'.$rest;
                }else{
                    if($rest >=100 && $rest <=999){
                    $nuevoCod = 'FACT-0'.$rest;
                    }else{
                       $nuevoCod = 'FACT-'.$rest; 
                    }                    
                } 
            }
        }
        Database::disconnect();
        return $nuevoCod; // RETORNO DEL NUEVO CODIGO DE FACTURA
    }

}
