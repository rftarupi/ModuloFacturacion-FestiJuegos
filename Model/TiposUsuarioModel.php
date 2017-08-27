<?php

include_once 'Database.php';
include_once 'TipoUsuario.php';

// Clase que contiene los métodos de Tipo Usuario
class TiposUsuarioModel {
    
    public function getTiposUsuario(){
        $pdo = Database::connect();
        $sql = "select * from tab_fac_tipo_usu";
        $resultado = $pdo->query($sql);

        //transformamos los registros en objetos de Tipo Usuario y guardamos en array
        $listadoTiposUsuario = array();
        foreach ($resultado as $res) {
            $tipoUsuario = new TipoUsuario($res['COD_TIPO_USU'], $res['DESCRIPCION_TIPO_USU']);
            array_push($listadoTiposUsuario, $tipoUsuario);
        }
        // Desconección de la Base de Datos
        Database::disconnect();

        // Retornamos el listado resultante:
        return $listadoTiposUsuario;
    }
    
    public function getTipoUsuario($COD_TIPO_USU){
       $pdo = Database::connect();
        $sql = "select * from tab_fac_tipo_usu where COD_TIPO_USU='$COD_TIPO_USU'";
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        
        // Guardamos el resultado obtenido en objeto Tipo Usuario
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $tipoUsuario = new TipoUsuario($res['COD_TIPO_USU'], $res['DESCRIPCION_TIPO_USU']);
        
        Database::disconnect();

        // Retornamos el Tipo Usuario encontrado
        return $tipoUsuario;
    }
}
