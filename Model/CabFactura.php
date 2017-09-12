<?php

// Clase Cabecera Factura del Módulo de facturación de Festijuegos

class CabFactura {

    // Atributos de Cabecera Factura
    private $COD_CAB_FACT;
    private $ESTADO_IMP_FAC;
    private $COD_CLI;
    private $FECHA_CAB_FACT;
    private $COSTO_TOT_CAB_FACT;

    // Constructor de la Clase Cabecera Factura
    function __construct($COD_CAB_FACT, $ESTADO_IMP_FAC, $COD_CLI, $FECHA_CAB_FACT, $COSTO_TOT_CAB_FACT) {
        $this->COD_CAB_FACT = $COD_CAB_FACT;
        $this->ESTADO_IMP_FAC = $ESTADO_IMP_FAC;
        $this->COD_CLI = $COD_CLI;
        $this->FECHA_CAB_FACT = $FECHA_CAB_FACT;
        $this->COSTO_TOT_CAB_FACT = $COSTO_TOT_CAB_FACT;
    }

        //Métodos Getter y Setter de los atributos de Cabecera Factura
        function getCOD_CAB_FACT() {
            return $this->COD_CAB_FACT;
        }

        function getESTADO_IMP_FAC() {
            return $this->ESTADO_IMP_FAC;
        }

        function getCOD_CLI() {
            return $this->COD_CLI;
        }

        function getFECHA_CAB_FACT() {
            return $this->FECHA_CAB_FACT;
        }

        function getCOSTO_TOT_CAB_FACT() {
            return $this->COSTO_TOT_CAB_FACT;
        }

        function setCOD_CAB_FACT($COD_CAB_FACT) {
            $this->COD_CAB_FACT = $COD_CAB_FACT;
        }

        function setESTADO_IMP_FAC($ESTADO_IMP_FAC) {
            $this->ESTADO_IMP_FAC = $ESTADO_IMP_FAC;
        }

        function setCOD_CLI($COD_CLI) {
            $this->COD_CLI = $COD_CLI;
        }

        function setFECHA_CAB_FACT($FECHA_CAB_FACT) {
            $this->FECHA_CAB_FACT = $FECHA_CAB_FACT;
        }

        function setCOSTO_TOT_CAB_FACT($COSTO_TOT_CAB_FACT) {
            $this->COSTO_TOT_CAB_FACT = $COSTO_TOT_CAB_FACT;
        }


}
