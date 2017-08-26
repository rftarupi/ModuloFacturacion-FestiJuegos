/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('#btnExcelBodegueros').on('click', requestDescargarBodegueros);
$('#btnExcelProductos').on('click', requestDescargarProductos);

function requestDescargarBodegueros(){
    
    tableToExcel('example', 'Reporte');
    
}

function requestDescargarProductos(){
    
    tableToExcel('example', 'Reporte');
    
}



