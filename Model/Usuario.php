<?php
// Clase Usuario del Módulo de facturación de Festijuegos

class Usuario {

    // Atributos de Usuarios
    private $COD_USU;
    private $COD_TIPO_USU;
    private $CEDULA_USU;
    private $NOMBRES_USU;
    private $APELLIDOS_USU;
    private $FECHA_NAC_USU;
    private $DIRECCION_USU;
    private $FONO_USU;
    private $E_MAIL_USU;
    private $ESTADO_USU;
    private $CLAVE_USU;
    
    // Constructor de la Clase Usuario    
    function __construct($COD_USU, $COD_TIPO_USU, $CEDULA_USU, $NOMBRES_USU, $APELLIDOS_USU, $FECHA_NAC_USU, $DIRECCION_USU, $FONO_USU, $E_MAIL_USU, $ESTADO_USU, $CLAVE_USU) {
        $this->COD_USU = $COD_USU;
        $this->COD_TIPO_USU = $COD_TIPO_USU;
        $this->CEDULA_USU = $CEDULA_USU;
        $this->NOMBRES_USU = $NOMBRES_USU;
        $this->APELLIDOS_USU = $APELLIDOS_USU;
        $this->FECHA_NAC_USU = $FECHA_NAC_USU;
        $this->DIRECCION_USU = $DIRECCION_USU;
        $this->FONO_USU = $FONO_USU;
        $this->E_MAIL_USU = $E_MAIL_USU;
        $this->ESTADO_USU = $ESTADO_USU;
        $this->CLAVE_USU = $CLAVE_USU;
    }

        //Métodos Getter y Setter de los atributos de Usuario
   
        function getCOD_USU() {
            return $this->COD_USU;
        }

        function getCOD_TIPO_USU() {
            return $this->COD_TIPO_USU;
        }

        function getCEDULA_USU() {
            return $this->CEDULA_USU;
        }

        function getNOMBRES_USU() {
            return $this->NOMBRES_USU;
        }

        function getAPELLIDOS_USU() {
            return $this->APELLIDOS_USU;
        }

        function getFECHA_NAC_USU() {
            return $this->FECHA_NAC_USU;
        }

        function getDIRECCION_USU() {
            return $this->DIRECCION_USU;
        }

        function getFONO_USU() {
            return $this->FONO_USU;
        }

        function getE_MAIL_USU() {
            return $this->E_MAIL_USU;
        }

        function getESTADO_USU() {
            return $this->ESTADO_USU;
        }

        function getCLAVE_USU() {
            return $this->CLAVE_USU;
        }

        function setCOD_USU($COD_USU) {
            $this->COD_USU = $COD_USU;
        }

        function setCOD_TIPO_USU($COD_TIPO_USU) {
            $this->COD_TIPO_USU = $COD_TIPO_USU;
        }

        function setCEDULA_USU($CEDULA_USU) {
            $this->CEDULA_USU = $CEDULA_USU;
        }

        function setNOMBRES_USU($NOMBRES_USU) {
            $this->NOMBRES_USU = $NOMBRES_USU;
        }

        function setAPELLIDOS_USU($APELLIDOS_USU) {
            $this->APELLIDOS_USU = $APELLIDOS_USU;
        }

        function setFECHA_NAC_USU($FECHA_NAC_USU) {
            $this->FECHA_NAC_USU = $FECHA_NAC_USU;
        }

        function setDIRECCION_USU($DIRECCION_USU) {
            $this->DIRECCION_USU = $DIRECCION_USU;
        }

        function setFONO_USU($FONO_USU) {
            $this->FONO_USU = $FONO_USU;
        }

        function setE_MAIL_USU($E_MAIL_USU) {
            $this->E_MAIL_USU = $E_MAIL_USU;
        }

        function setESTADO_USU($ESTADO_USU) {
            $this->ESTADO_USU = $ESTADO_USU;
        }

        function setCLAVE_USU($CLAVE_USU) {
            $this->CLAVE_USU = $CLAVE_USU;
        }


}