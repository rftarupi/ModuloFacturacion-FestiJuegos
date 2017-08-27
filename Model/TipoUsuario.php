<?php

// Clase Tipo Usuario del Módulo de facturación de Festijuegos
class TipoUsuario {
    
    // Atributos de Usuarios
    private $COD_TIPO_USU;
    private $DESCRIPCION_TIPO_USU;
    
    // Constructor de la Clase Tipo Usuario  
    function __construct($COD_TIPO_USU, $DESCRIPCION_TIPO_USU) {
        $this->COD_TIPO_USU = $COD_TIPO_USU;
        $this->DESCRIPCION_TIPO_USU = $DESCRIPCION_TIPO_USU;
    }
    
    //Métodos Getter y Setter de los atributos de Tipo Usuario

    public function getCOD_TIPO_USU() {
        return $this->COD_TIPO_USU;
    }

    public function getDESCRIPCION_TIPO_USU() {
        return $this->DESCRIPCION_TIPO_USU;
    }

    public function setCOD_TIPO_USU($COD_TIPO_USU) {
        $this->COD_TIPO_USU = $COD_TIPO_USU;
    }

    public function setDESCRIPCION_TIPO_USU($DESCRIPCION_TIPO_USU) {
        $this->DESCRIPCION_TIPO_USU = $DESCRIPCION_TIPO_USU;
    }


}
