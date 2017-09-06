<?php

// Clase Servicio del Módulo de facturación de Festijuegos

class Servicio {
    // Atributos de Servicios
    private $COD_SERV;
    private $NOMBRE_SERV;
    private $DESCRIPCION_SERV;
    private $COSTO_SERV;
    
    // Constructor de la Clase Servicio
    public function __construct($COD_SERV, $NOMBRE_SERV, $DESCRIPCION_SERV, $COSTO_SERV) {
        $this->COD_SERV = $COD_SERV;
        $this->NOMBRE_SERV = $NOMBRE_SERV;
        $this->DESCRIPCION_SERV = $DESCRIPCION_SERV;
        $this->COSTO_SERV = $COSTO_SERV;
    }
    
    //Métodos Getter y Setter de los atributos de Servicio
    
    public function getCOD_SERV() {
        return $this->COD_SERV;
    }

    public function getNOMBRE_SERV() {
        return $this->NOMBRE_SERV;
    }

    public function getDESCRIPCION_SERV() {
        return $this->DESCRIPCION_SERV;
    }

    public function getCOSTO_SERV() {
        return $this->COSTO_SERV;
    }

    public function setCOD_SERV($COD_SERV) {
        $this->COD_SERV = $COD_SERV;
    }

    public function setNOMBRE_SERV($NOMBRE_SERV) {
        $this->NOMBRE_SERV = $NOMBRE_SERV;
    }

    public function setDESCRIPCION_SERV($DESCRIPCION_SERV) {
        $this->DESCRIPCION_SERV = $DESCRIPCION_SERV;
    }

    public function setCOSTO_SERV($COSTO_SERV) {
        $this->COSTO_SERV = $COSTO_SERV;
    }

}
