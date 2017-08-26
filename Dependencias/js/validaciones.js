function ValId(cedula, boton) {
    var idtipo = document.getElementById("ID_TIPO").value;
    console.log(idtipo);




    if (idtipo == 1) {
        ValidarCedula(cedula, boton);

    }
    {
        if (idtipo == 2) {
            validarRuc(cedula);
        }
    }
//    if(idtipo == 3){
//        validateDNI(cedula);  
//    }



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
            text: "La c\xe9dula no puede tener menos de 10 d\xedgitos \nY solo deben ser numeros",
            type: "error",
            confirmButtonText: "Ok"});
        boton.disabled = true;
        return false;
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

//VALIDAR RUC
function validarRuc(cedula) {
    var number = cedula // document.getElementById('ruc').value;
    var dto = number.length;
    var valor;
    var acu = 0;
    if (number == "") {
//        alert('No has ingresado ningún dato, porfavor ingresar los datos correspondientes.');
        swal({
            title: "No has ingresado ningún dato?",
            text: "Porfavor ingresar los datos correspondientes.!",
            type: "warning",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Si, Ingresar!"});
        return false; //----
    }
    else {
        for (var i = 0; i < dto; i++) {
            valor = number.substring(i, i + 1);
            if (valor == 0 || valor == 1 || valor == 2 || valor == 3 || valor == 4 || valor == 5 || valor == 6 || valor == 7 || valor == 8 || valor == 9) {
                acu = acu + 1;
            }
        }
        if (acu == dto) {
            while (number.substring(10, 13) != 001) {
                swal(
                        'Los tres últimos dígitos?',
                        'No tienen el código del RUC 001.\nEl Ruc no debe tener menos de 13 digitos .',
                        'question');
                return false;
            }
            while (number.substring(0, 2) > 24) {
                swal(
                        'Los dos primeros dígitos?',
                        'No pueden ser mayores a 24..',
                        'question');
                return false; //--
            }
            swal(
                    '¡Buen trabajo!',
                    '¡El RUC está escrito correctamente!',
                    'success'
                    );
            return true; //--
            swal({
                title: "Se procederá a,.!",
                text: "Analizar el respectivo RUC.",
                type: "info, varning",
                confirmButtonColor: '#3085d6',
                confirmButtonText: "Ok"});
            var porcion1 = number.substring(2, 3);
            if (porcion1 < 6) {
                swal({
                    title: "El tercer dígito es menor a 6,.!",
                    text: "Por lo\n\ \ntanto el usuario es una persona natural.\n",
                    type: "warning",
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: "Ok"});
            }
            else {
                if (porcion1 == 6) {
                    swal({
                        title: "El tercer dígito es igual a 6,.!",
                        text: "\n\ por lo \ntanto el usuario es una entidad pública.\n.",
                        type: "warning",
                        confirmButtonText: "Ok"});
                }
                else {
                    if (porcion1 == 9) {
                        swal({
                            title: 'El tercer dígito es igual a 9,!',
                            text: " \n\ por lo \ntanto el usuario es una sociedad privada.\n",
                            type: 'warning',
                            confirmButtonText: "Ok"});
                    }
                }
            }
        }
        else {
            swal({
                title: 'Error...!',
                text: "Por favor no ingrese texto..",
                type: 'error',
                confirmButtonText: "Ok"});
        }
    }
}
////VALIDAR PASAPORTE O DNI
//function validateDNI(dni) {
//    var numero, let, letra;
//    var expresion_regular_dni = /^[XYZ]?\d{5,8}[A-Z]$/;
//
//    dni = dni.toUpperCase();
//
//    if(expresion_regular_dni.test(dni) === true){
//        numero = dni.substr(0,dni.length-1);
//        numero = numero.replace('X', 0);
//        numero = numero.replace('Y', 1);
//        numero = numero.replace('Z', 2);
//        let = dni.substr(dni.length-1, 1);
//        numero = numero % 23;
//        letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
//        letra = letra.substring(numero, numero+1);
//        if (letra != let) {
//            alert('Pasaporte erroneo, la letra del Pasaporte no se corresponde');
//            return false;
//        }else{
//            alert('Pasaporte correcto');
//            return true;
//        }
//    }else{
//        alert('pasaporte erroneo, formato no válido');
//        return false;
//    }
//}
//
//
////function validarRuc() {
//    
//                var number = document.getElementById('ruc').value;
//                var dto = number.length;
//                var valor;
//                var acu = 0;
//                if (number == "") {
//                    alert('No has ingresado ningún dato, porfavor ingresar los datos correspondientes.');
//                }
//                else {
//                    for (var i = 0; i < dto; i++) {
//                        valor = number.substring(i, i + 1);
//                        if (valor == 0 || valor == 1 || valor == 2 || valor == 3 || valor == 4 || valor == 5 || valor == 6 || valor == 7 || valor == 8 || valor == 9) {
//                            acu = acu + 1;
//                        }
//                    }
//                    if (acu == dto) {
//                        while (number.substring(10, 13) != 001) {
//                            alert('Los tres últimos dígitos no tienen el código del RUC 001.');
//                            return;
//                        }
//                        while (number.substring(0, 2) > 24) {
//                            alert('Los dos primeros dígitos no pueden ser mayores a 24.');
//                            return;
//                        }
//                        alert('El RUC está escrito correctamente');
//                        alert('Se procederá a analizar el respectivo RUC.');
//                        var porcion1 = number.substring(2, 3);
//                        if (porcion1 < 6) {
//                            alert('El tercer dígito es menor a 6, por lo \ntanto el usuario es una persona natural.\n');
//                        }
//                        else {
//                            if (porcion1 == 6) {
//                                alert('El tercer dígito es igual a 6, por lo \ntanto el usuario es una entidad pública.\n');
//                            }
//                            else {
//                                if (porcion1 == 9) {
//                                    alert('El tercer dígito es igual a 9, por lo \ntanto el usuario es una sociedad privada.\n');
//                                }
//                            }
//                        }
//                    }
//                    else {
//                        alert("ERROR: Por favor no ingrese texto");
//                    }
//                }
//            }


