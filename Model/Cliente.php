<?php
// Clase Cliente del Módulo de facturación de Festijuegos

class Cliente {
    // Atributos de Clientes
    private $COD_CLI;
    private $CEDULA_CLI;
    private $NOMBRES_CLI;
    private $APELLIDOS_CLI;
    private $FECHA_NAC_CLI;
    private $DIRECCION_CLI;
    private $FONO_CLI;
    private $E_MAIL_CLI;

    // Constructor de la Clase Cliente  
    public function __construct($COD_CLI, $CEDULA_CLI, $NOMBRES_CLI, $APELLIDOS_CLI, $FECHA_NAC_CLI, $DIRECCION_CLI, $FONO_CLI, $E_MAIL_CLI) {
        $this->COD_CLI = $COD_CLI;
        $this->CEDULA_CLI = $CEDULA_CLI;
        $this->NOMBRES_CLI = $NOMBRES_CLI;
        $this->APELLIDOS_CLI = $APELLIDOS_CLI;
        $this->FECHA_NAC_CLI = $FECHA_NAC_CLI;
        $this->DIRECCION_CLI = $DIRECCION_CLI;
        $this->FONO_CLI = $FONO_CLI;
        $this->E_MAIL_CLI = $E_MAIL_CLI;
    }
    
    //Métodos Getter y Setter de los atributos de Cliente
    
    public function getCOD_CLI() {
        return $this->COD_CLI;
    }

    public function getCEDULA_CLI() {
        return $this->CEDULA_CLI;
    }

    public function getNOMBRES_CLI() {
        return $this->NOMBRES_CLI;
    }

    public function getAPELLIDOS_CLI() {
        return $this->APELLIDOS_CLI;
    }

    public function getFECHA_NAC_CLI() {
        return $this->FECHA_NAC_CLI;
    }

    public function getDIRECCION_CLI() {
        return $this->DIRECCION_CLI;
    }

    public function getFONO_CLI() {
        return $this->FONO_CLI;
    }

    public function getE_MAIL_CLI() {
        return $this->E_MAIL_CLI;
    }

    public function setCOD_CLI($COD_CLI) {
        $this->COD_CLI = $COD_CLI;
    }

    public function setCEDULA_CLI($CEDULA_CLI) {
        $this->CEDULA_CLI = $CEDULA_CLI;
    }

    public function setNOMBRES_CLI($NOMBRES_CLI) {
        $this->NOMBRES_CLI = $NOMBRES_CLI;
    }

    public function setAPELLIDOS_CLI($APELLIDOS_CLI) {
        $this->APELLIDOS_CLI = $APELLIDOS_CLI;
    }

    public function setFECHA_NAC_CLI($FECHA_NAC_CLI) {
        $this->FECHA_NAC_CLI = $FECHA_NAC_CLI;
    }

    public function setDIRECCION_CLI($DIRECCION_CLI) {
        $this->DIRECCION_CLI = $DIRECCION_CLI;
    }

    public function setFONO_CLI($FONO_CLI) {
        $this->FONO_CLI = $FONO_CLI;
    }

    public function setE_MAIL_CLI($E_MAIL_CLI) {
        $this->E_MAIL_CLI = $E_MAIL_CLI;
    }

}
