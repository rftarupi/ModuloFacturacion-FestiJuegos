<?php
// Clase que simula una vista de un detalle de factura

class VistaFacturaDetalle {

    // Atributos de Usuarios
    private $COD_DET_FACT;
    private $NOMBRE_SERV;
    private $TIEMPO_DET_FACT;
    private $COSTO_HORA_DET_FACT;
    private $COSTO_TOT_DET_FACT;
    
    // Constructor   
    function __construct($COD_DET_FACT, $NOMBRE_SERV, $TIEMPO_DET_FACT, $COSTO_HORA_DET_FACT, $COSTO_TOT_DET_FACT) {
        $this->COD_DET_FACT = $COD_DET_FACT;
        $this->NOMBRE_SERV = $NOMBRE_SERV;
        $this->TIEMPO_DET_FACT = $TIEMPO_DET_FACT;
        $this->COSTO_HORA_DET_FACT = $COSTO_HORA_DET_FACT;
        $this->COSTO_TOT_DET_FACT = $COSTO_TOT_DET_FACT;
    }

        //Métodos Getter y Setter
        function getCOD_DET_FACT() {
            return $this->COD_DET_FACT;
        }

        function getNOMBRE_SERV() {
            return $this->NOMBRE_SERV;
        }

        function getTIEMPO_DET_FACT() {
            return $this->TIEMPO_DET_FACT;
        }

        function getCOSTO_HORA_DET_FACT() {
            return $this->COSTO_HORA_DET_FACT;
        }

        function getCOSTO_TOT_DET_FACT() {
            return $this->COSTO_TOT_DET_FACT;
        }

        function setCOD_DET_FACT($COD_DET_FACT) {
            $this->COD_DET_FACT = $COD_DET_FACT;
        }

        function setNOMBRE_SERV($NOMBRE_SERV) {
            $this->NOMBRE_SERV = $NOMBRE_SERV;
        }

        function setTIEMPO_DET_FACT($TIEMPO_DET_FACT) {
            $this->TIEMPO_DET_FACT = $TIEMPO_DET_FACT;
        }

        function setCOSTO_HORA_DET_FACT($COSTO_HORA_DET_FACT) {
            $this->COSTO_HORA_DET_FACT = $COSTO_HORA_DET_FACT;
        }

        function setCOSTO_TOT_DET_FACT($COSTO_TOT_DET_FACT) {
            $this->COSTO_TOT_DET_FACT = $COSTO_TOT_DET_FACT;
        }


      
}