
function obtener_datos(id){
	var cod= $("#ID_AJUSTE_PROD"+id).val();
	var motivo= $("#MOTIVO_AJUSTE_PROD"+id).val();
	var fecha= $("#FECHA_AJUSTE_PROD"+id).val();

	$("#mod_id").val(cod);
	$("#mod_cod").text(id).css("font-weight","Bold");
	
        $("#mod_motivo").val(motivo);
        
	$("#mod_f").text(fecha);
        $("#mod_fecha").val(fecha);
}

function obtener_datos_usuario(id){
        var cod= $("#ID_USU"+id).val();
        var tipo= $("#ID_TIPO_USU"+id).val();
        var cedula= $("#CEDULA_USU"+id).val();
        var nombre= $("#NOMBRES_USU"+id).val();
        var apellido= $("#APELLIDOS_USU"+id).val();
        var fecha= $("#FECH_NAC_USU"+id).val(); 
        var ciudad= $("#CIUDAD_NAC_USU"+id).val();
        var direccion= $("#DIRECCION_USU"+id).val();
        var telefono= $("#FONO_USU"+id).val();
        var email= $("#E_MAIL_USU"+id).val();
        var estado= $("#ESTADO_USU"+id).val();
        var clave= $("#CLAVE_USU"+id).val(); 
        
        $("#mod_id").val(cod);
        $("#mod_cod").text(id).css("font-weigth", "Bold");
        $("#mod_tipo_u").val(tipo);
        $("#mod_tipo_u").text(tipo).css("font-weigth", "Bold");
        $("#mod_cedula").val(cedula);
        $("#mod_nombre").val(nombre);
        $("#mod_apellido").val(apellido);
        $("#mod_fecha").val(fecha);    
        $("#mod_ciudad").val(ciudad);
        $("#mod_direccion").val(direccion);
        $("#mod_telefono").val(telefono);
        $("#mod_email").val(email);
        $("#mod_estado").val(estado);
        $("#mod_clave").val(clave);
     
}


function obtener_datosProductos(id){
	var cod= $("#ID_PROD"+id).val();
	var nombre= $("#NOMBRE_PROD"+id).val();
        var descripcion= $("#DESCRIPCION"+id).val();
        var Iva= $("#GRABA_IVA_PROD"+id).val();
        var costo= $("#COSTO_PROD"+id).val();
        var pvp= $("#PVP_PROD"+id).val();
        var estado= $("#ESTADO_PROD"+id).val();
	var stock= $("#STOCK_PROD"+id).val();

	$("#mod_id_pro1").val(cod);
        $("#mod_id_pro2").text(id).css("font-weight","Bold");
        
	$("#mod_nombre").val(nombre);
        $("#mod_descripcion").val(descripcion);
        $("#mod_Iva").val(Iva);
        $("#mod_costo").val(costo);
        $("#mod_pvp").val(pvp);
        $("#mod_estado").val(estado);
        $("#mod_stock").val(stock);
}

