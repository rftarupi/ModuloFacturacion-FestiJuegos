<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    
    <body>
        
         <?php
        
         include_once '../Model/Ajustes/AjusteDet.php'; 
        include_once '../Model/Ajustes/AjustesModel.php';
        include_once '../Model/Ajustes/CabeceraAjuste.php';
        
        session_start();
        $ajustes = unserialize($_SESSION['ajustes']);
       
        ?>
        
         <form action="../Controller/controller.php">
            
            <input type="hidden" value="ajuste" name="opcion1">
            <input type="hidden" value="ingresar_Ajuste" name="opcion2">
            
            <input type="hidden" 
            value="<?php echo $ajustes->getID_AJUSTE_PROD();?>" name="ID_AJUSTE_PROD" class="btn-success">
            Codigo:<b><?php //echo $agentes->getCodigoAg();?></b><br><br>
            
            Nombre:<input type="text" name="nombreAg" 
            value="<?php //echo $agentes->getNombreAg();?>" class="btn-success"><br><br>
            
            Apellido:<input type="text" name="apellidoAg" 
            value="<?php //echo $agentes->getApellidoAg();?>" class="btn-success"><br><br>
            
            Rango:<input type="text" name="rangoAg" 
            value="<?php //echo $agentes->getRangoAg();?>" class="btn-success"><br><br>
            
            Comision:<input type="text" name="comisionAg" 
            value="<?php //echo $agentes->getComisionAg();?>" class="btn-success"><br><br>
            
            <input type="submit" value="Actualizar">
        </form>
           
    </body>
</html>