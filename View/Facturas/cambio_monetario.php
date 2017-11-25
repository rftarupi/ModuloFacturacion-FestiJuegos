<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['USUARIO_ACTIVO'])) {
    $_SESSION['COD_FACT_TEMP']=$_SESSION['FAC_NOTA_VENTA'];
    
    $listado = unserialize($_SESSION['listadoDet']);
    $_SESSION['listadoDetalles']= serialize($listado);
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title></title>
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">				

            <!--Importación de Dependencias al proyecto-->
            <script src="../../Dependencias/js/jquery-2.1.4.js"></script>
            <script src="../../Dependencias/js/bootstrap.js"></script>
            <script src="../../Dependencias/js/getDatos.js"></script>
            <script src="../../Dependencias/js/bootstrap-table.js"></script>
            <script src = "../../Dependencias/SweetAlert/sweetalert.min.js" type="text/javascript"></script>
            <script src="../../Dependencias/js/validaciones.js"></script>
                <!--<script src="../../Dependencias/DataTables/jquery.dataTables.min.js"></script>-->

            <!--Importaciones Css-->
            <link href="../../Dependencias/css/bootstrap-table.css" rel="stylesheet" />
            <link href="../../Dependencias/css/bootstrap.css" rel="stylesheet" />
            <link href="../../Dependencias/css/bootstrap-theme.css">
            <link href="../../Dependencias/SweetAlert/sweetalert.css" rel="stylesheet" type="text/css">
            <script>
                function window_onload() {
                    $('#IngresoBilleteRecibido').modal('show');
                }
                function block(){
                    window.location.hash="no-back-button";
                    window.location.hash="Again-No-back-button" //chrome
                    window.onhashchange=function(){window.location.hash="no-back-button";}
                }
                
            </script>
        </head>
        <body onload="window_onload();">
            <!--Modal para ingreso de Billete Recibido-->
            <div class="modal fade" id="IngresoBilleteRecibido">
                <div class="modal-dialog">
                    <form class="form-horizontal" action="../../Controller/controller.php">
                        <input type="hidden" name="opcion1" value="factura">
                        <input type="hidden" name="opcion2" value="calculo_monetario">
                        <div class="modal-content">
                            <!-- Header de la ventana -->

                            <div class="modal-header bg-success">
                                <h3 class="modal-title"><span class="glyphicon glyphicon-user"></span> Cálculo de Cambio </h3>
                            </div>

                            <!-- Contenido de la ventana -->
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-3 col-md-offset-1">
                                                <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Dinero Recibido: </label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="number" step="0.01" class="form-control" name="BILLETE_RECIBIDO" placeholder="Ingrese el Valor del Billete Recibido" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer de la ventana -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button class="btn btn-success">Calcular Cambio</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php
            if (isset($_SESSION['cambio'])) {
                if ($_SESSION['cambio'] == -1) {
                    echo "<script>swal({title: 'Cambio Monetario Fallido',
                                    text: 'El billete recibido debe ser mayor al total de la factura',
                                    type: 'error',
                                    confirmButtonText: 'Ok'},
                                    function(){
                                    window.location.href = 'cambio_monetario.php';
                                    });
                                    </script>";
                }
                unset($_SESSION['cambio']);
            }
            ?>

        </body>
    </html>
    <?php
} else {
    header('Location: ../login.php');
}
?>
