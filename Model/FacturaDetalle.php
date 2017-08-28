<?php
// Clase Usuario del Módulo de facturación de Festijuegos

class FacturaDetalle {

    // Atributos de Usuarios
    private $COD_DET_FACT;
    private $COD_SERV;
    private $COD_CAB_FACT;
    private $TIEMPO_DET_FACT;
    private $COSTO_HORA_DET_FACT;
    private $COSTO_TOT_DET_FACT ;
    
    // Constructor de la Clase Usuario    
    function __construct($COD_DET_FACT, $COD_SERV, $COD_CAB_FACT, $TIEMPO_DET_FACT, $COSTO_HORA_DET_FACT, $COSTO_TOT_DET_FACT) {
        $this->COD_DET_FACT = $COD_DET_FACT;
        $this->COD_SERV = $COD_SERV;
        $this->COD_CAB_FACT = $COD_CAB_FACT;
        $this->TIEMPO_DET_FACT = $TIEMPO_DET_FACT;
        $this->COSTO_HORA_DET_FACT = $COSTO_HORA_DET_FACT;
        $this->COSTO_TOT_DET_FACT = $COSTO_TOT_DET_FACT;
    }

    //Métodos Getter y Setter de los atributos de Usuario
    function getCOD_DET_FACT() {
        return $this->COD_DET_FACT;
    }

    function getCOD_SERV() {
        return $this->COD_SERV;
    }

    function getCOD_CAB_FACT() {
        return $this->COD_CAB_FACT;
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

    function setCOD_SERV($COD_SERV) {
        $this->COD_SERV = $COD_SERV;
    }

    function setCOD_CAB_FACT($COD_CAB_FACT) {
        $this->COD_CAB_FACT = $COD_CAB_FACT;
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