function ValidarIdentificacion(id, boton) {
    var id = id;
    array = id.split("");
    num = array.length;
    if (num <= 10) {
        ValidarCedula(id, boton);
    } else if (num > 10 && num <= 13) {
        ValidarRUC(id, boton);
    }
}

function ValidarCedula(cedula, boton)
{
    var cedula = cedula;
    array = cedula.split("");
    num = array.length;
    if (num == 10)
    {
        total = 0;
        digito = (array[9] * 1);
        for (i = 0; i < (num - 1); i++)
        {
            mult = 0;
            if ((i % 2) != 0) {
                total = total + (array[i] * 1);
            } else
            {
                mult = array[i] * 2;
                if (mult > 9)
                    total = total + (mult - 9);
                else
                    total = total + mult;
            }
        }
        decena = total / 10;
        decena = Math.floor(decena);
        decena = (decena + 1) * 10;
        final = (decena - total);
        if ((final == 10 && digito == 0) || (final == digito)) {
            boton.disabled = false;
            return true;
        } else
        {
            swal({title: "Error!",
                text: "La c\xe9dula NO es v\xe1lida!!!",
                type: "error",
                confirmButtonText: "Ok"});
            boton.disabled = true;
            return false;
        }
    } else {
        swal({title: "Error!",
            text: "La c\xe9dula debe tener 10 d\xedgitos",
            type: "error",
            confirmButtonText: "Ok"});
        boton.disabled = true;
        return false;
    }
}

function ValidarRUC(ruc, boton) {
    var ruc = ruc;
    while (ruc.substring(10, 13) != 001) {
        swal({title: "Error!",
            text: "Los tres últimos dígitos no tienen el código de RUC 001.",
            type: "error",
            confirmButtonText: "Ok"});
        boton.disabled = true;
        return false;
    }
    while (ruc.substring(0, 2) > 24) {
        swal({title: "Error!",
            text: "Los dos primeros dígitos no pueden ser mayores a 24.",
            type: "error",
            confirmButtonText: "Ok"});
        boton.disabled = true;
        return false;
    }
    boton.disabled = false;
    var porcion1 = ruc.substring(2, 3);
    if (porcion1 < 6) {
        swal({
            title: "RUC correcto",
            text: "El RUC es de una persona natural",
            type: "success",
            confirmButtonText: "Ok"});
    } else {
        if (porcion1 == 6) {
            swal({
                title: "RUC correcto",
                text: "El RUC es de una entidad pública",
                type: "success",
                confirmButtonText: "Ok"});
        } else {
            if (porcion1 == 9) {
                swal({
                    title: "RUC correcto",
                    text: "El RUC es de una sociedad privada",
                    type: "success",
                    confirmButtonText: "Ok"});
            }
        }
    }
}


function SoloNumeros(e)
{
    var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8) || (keynum == 46))
        return true;
    return /\d/.test(String.fromCharCode(keynum));
}

function SoloLetras(e)
{
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-39-46";

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
    }
}
