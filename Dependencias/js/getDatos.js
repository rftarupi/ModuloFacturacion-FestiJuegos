
function obtener_datos(id) {
    var cod = $("#ID_AJUSTE_PROD" + id).val();
    var motivo = $("#MOTIVO_AJUSTE_PROD" + id).val();
    var fecha = $("#FECHA_AJUSTE_PROD" + id).val();

    $("#mod_id").val(cod);
    $("#mod_cod").text(id).css("font-weight", "Bold");

    $("#mod_motivo").val(motivo);

    $("#mod_f").text(fecha);
    $("#mod_fecha").val(fecha);
}

function obtener_datos_usuario(id) {
    var cod = $("#COD_USU" + id).val();
    var tipo = $("#COD_TIPO_USU" + id).val();
    var cedula = $("#CEDULA_USU" + id).val();
    var nombre = $("#NOMBRES_USU" + id).val();
    var apellido = $("#APELLIDOS_USU" + id).val();
    var fecha = $("#FECHA_NAC_USU" + id).val();
    var direccion = $("#DIRECCION_USU" + id).val();
    var telefono = $("#FONO_USU" + id).val();
    var email = $("#E_MAIL_USU" + id).val();
    var estado = $("#ESTADO_USU" + id).val();
    var clave = $("#CLAVE_USU" + id).val();

    $("#mod_id").val(cod);
    $("#mod_cod").text(id).css("font-weigth", "Bold");
    $("#mod_tipo_u").val(tipo);
    $("#mod_tipo_u").text(tipo).css("font-weigth", "Bold");
    $("#mod_cedula").val(cedula);
    $("#mod_nombre").val(nombre);
    $("#mod_apellido").val(apellido);
    $("#mod_fecha").val(fecha);
    $("#mod_direccion").val(direccion);
    $("#mod_telefono").val(telefono);
    $("#mod_email").val(email);
    $("#mod_estado").val(estado);
    $("#mod_clave").val(clave);

}

function obtener_datos_cliente(id) {
    var cod = $("#COD_CLI" + id).val();
    var cedula = $("#CEDULA_CLI" + id).val();
    var nombre = $("#NOMBRES_CLI" + id).val();
    var apellido = $("#APELLIDOS_CLI" + id).val();
    var fecha = $("#FECHA_NAC_CLI" + id).val();
    var direccion = $("#DIRECCION_CLI" + id).val();
    var telefono = $("#FONO_CLI" + id).val();
    var email = $("#E_MAIL_CLI" + id).val();

    $("#mod_id").val(cod);
    $("#mod_cod").text(id).css("font-weigth", "Bold");
    $("#mod_cedula").val(cedula);
    $("#mod_nombre").val(nombre);
    $("#mod_apellido").val(apellido);
    $("#mod_fecha").val(fecha);
    $("#mod_direccion").val(direccion);
    $("#mod_telefono").val(telefono);
    $("#mod_email").val(email);

}

function obtener_datos_servicio(id) {
    var cod = $("#COD_SERV" + id).val();
    var nombre = $("#NOMBRE_SERV" + id).val();
    var descripcion = $("#DESCRIPCION_SERV" + id).val();
    var costo = $("#COSTO_SERV" + id).val();
    
    $("#mod_id").val(cod);
    $("#mod_cod").text(id).css("font-weight", "Bold");
    $("#mod_nombre").val(nombre);
    $("#mod_descripcion").val(descripcion);
    $("#mod_costo").val(costo);
}

