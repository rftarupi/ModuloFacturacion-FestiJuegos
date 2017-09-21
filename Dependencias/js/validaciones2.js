function ValId(cedula, boton) {
    var cedula = cedula;
    var idtipo = document.getElementById("ID_TIPO").value;
    console.log(idtipo);
    if (idtipo == 1) {
        ValidarCedula(cedula, boton);
    }
    {
        if (idtipo == 2) {
            ValidarR(cedula, boton);
        }
    }
    if (idtipo == 3) {
        ValidarP(cedula, boton);
    }
}

function ValidarR(ruc, boton) {
    var ruc = ruc;
    array = ruc.split("");
    num = array.length;
    if (num == 13) {

        var ced = ruc.substring(0, 10);
        var aux = ruc.substring(10, 13);

        if (ValidarC(ced)) {
            if (aux != 001) {
                swal({title: "Error!",
                    text: "Los tres últimos dígitos no tienen el código de RUC 001",
                    type: "error",
                    confirmButtonText: "Ok"});
                boton.disabled = true;
                return false;
            } else {
                boton.disabled = false;
                return true;
            }
        } else {
            swal({title: "Error!",
                text: "Ruc no válido",
                type: "error",
                confirmButtonText: "Ok"});
            boton.disabled = true;
            return false;
        }

    } else {
        swal({title: "Error!",
            text: "El RUC no tiene el formato correcto",
            type: "error",
            confirmButtonText: "Ok"});
        boton.disabled = true;
        return false;
    }
}

function ValidarC(cedula)
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
            return false;
        }
    } else {
        return false;
    }
}

function ValidarP(pass, boton) {
    var pass = pass;
    array = pass.split("");
    num = array.length;
    if (num == 8) {
        var col = 0;
        var colT = false;
        for (var i = 0; i < num; i++) {
            if (i == 0 || i == 1) {
                if (esLetra(array[i])) {
                    col++;
                    colT = true;
                } else {
                    swal({title: "Error!",
                        text: "El Pasaporte es incorrecto",
                        type: "error",
                        confirmButtonText: "Ok"});
                    boton.disabled = true;
                    return false;
                }
            } else {
                if (isNaN(array[i]) == false) {
                    col++;
                    colT = true;
                } else {
                    swal({title: "Error!",
                        text: "El Pasaporte es incorrecto",
                        type: "error",
                        confirmButtonText: "Ok"});
                    boton.disabled = true;
                    return false;
                }
            }
            if (i == 7) {
                boton.disabled = false;
                return colT;
            }
        }

    } else {
        if (num == 9) {
            var ven = 0;
            var venT = false;
            for (var i = 0; i < num; i++) {
                if (isNaN(array[i]) == false) {
                    ven++;
                    venT = true;
                } else {
                    swal({title: "Error!",
                        text: "El Pasaporte es incorrecto",
                        type: "error",
                        confirmButtonText: "Ok"});
                    boton.disabled = true;
                    return false;
                }

                if (i == 8) {
                    boton.disabled = false;
                    return venT;
                }
            }

        } else {
            swal({title: "Error!",
                text: "El Pasaporte es incorrecto",
                type: "error",
                confirmButtonText: "Ok"});
            boton.disabled = true;
            return false;
        }
    }
}

function esNum(e) {
    var keynum = e.which;
    if ((keynum == 8) || (keynum == 46))
        return true;
}
function esLetra(texto) {
    var letras = "abcdefghyjklmnñopqrstuvwxyz";
    texto = texto.toLowerCase();
    for (i = 0; i < texto.length; i++) {
        if (letras.indexOf(texto.charAt(i), 0) != -1) {
            return true;
        }
    }
    return false;
}

function TipoEscritura(e) {
    var idtipo = document.getElementById("ID_TIPO").value;
    console.log(idtipo);
    if (idtipo == 1 || idtipo == 2) {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
            return true;
        return /\d/.test(String.fromCharCode(keynum));
    } else {
        if (idtipo == 3) {
            SoloLetras(e);
        }
    }
}