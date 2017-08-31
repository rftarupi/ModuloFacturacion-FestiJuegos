<?php

// Clase Cabecera Factura del Módulo de facturación de Festijuegos

class CabFactura {

    // Atributos de Cabecera Factura
    private $COD_CAB_FACT;
    private $ESTADO_IMP_FAC;
    private $COD_CLI;
    private $FECHA_CAB_FACT;
    private $SUBT_IVA_CAB_FACT;
    private $IVA_CAB_FACT;
    private $COSTO_TOT_CAB_FACT;

    // Constructor de la Clase Cabecera Factura
    public function __construct($COD_CAB_FACT, $ESTADO_IMP_FAC, $COD_CLI, $FECHA_CAB_FACT, $SUBT_IVA_CAB_FACT, $IVA_CAB_FACT, $COSTO_TOT_CAB_FACT) {
        $this->COD_CAB_FACT = $COD_CAB_FACT;
        $this->ESTADO_IMP_FAC = $ESTADO_IMP_FAC;
        $this->COD_CLI = $COD_CLI;
        $this->FECHA_CAB_FACT = $FECHA_CAB_FACT;
        $this->SUBT_IVA_CAB_FACT = $SUBT_IVA_CAB_FACT;
        $this->IVA_CAB_FACT = $IVA_CAB_FACT;
        $this->COSTO_TOT_CAB_FACT = $COSTO_TOT_CAB_FACT;
    }

    //Métodos Getter y Setter de los atributos de Cabecera Factura
    public function getCOD_CAB_FACT() {
        return $this->COD_CAB_FACT;
    }
    
    public function getESTADO_IMP_FAC() {
        return $this->ESTADO_IMP_FAC;
    }

    public function getCOD_CLI() {
        return $this->COD_CLI;
    }

    public function getFECHA_CAB_FACT() {
        return $this->FECHA_CAB_FACT;
    }

    public function getSUBT_IVA_CAB_FACT() {
        return $this->SUBT_IVA_CAB_FACT;
    }

    public function getIVA_CAB_FACT() {
        return $this->IVA_CAB_FACT;
    }

    public function getCOSTO_TOT_CAB_FACT() {
        return $this->COSTO_TOT_CAB_FACT;
    }

    public function setCOD_CAB_FACT($COD_CAB_FACT) {
        $this->COD_CAB_FACT = $COD_CAB_FACT;
    }
    
    public function setESTADO_IMP_FAC($ESTADO_IMP_FAC) {
        $this->ESTADO_IMP_FAC = $ESTADO_IMP_FAC;
    }

    public function setCOD_CLI($COD_CLI) {
        $this->COD_CLI = $COD_CLI;
    }

    public function setFECHA_CAB_FACT($FECHA_CAB_FACT) {
        $this->FECHA_CAB_FACT = $FECHA_CAB_FACT;
    }

    public function setSUBT_IVA_CAB_FACT($SUBT_IVA_CAB_FACT) {
        $this->SUBT_IVA_CAB_FACT = $SUBT_IVA_CAB_FACT;
    }

    public function setIVA_CAB_FACT($IVA_CAB_FACT) {
        $this->IVA_CAB_FACT = $IVA_CAB_FACT;
    }

    public function setCOSTO_TOT_CAB_FACT($COSTO_TOT_CAB_FACT) {
        $this->COSTO_TOT_CAB_FACT = $COSTO_TOT_CAB_FACT;
    }

}
