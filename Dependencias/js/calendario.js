jQuery(function ($) {
                $.datepicker.regional['es'] = {
                    closeText: 'Cerrar',
                    prevText: '&#x3c;Ant-',
                    nextText: 'Sig&#x3e;',
                    currentText: 'Hoy',
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                        'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi&eacute;rcoles', 'Jueves', 'Viernes', 'S&aacute;bado'],
                    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mi&eacute;', 'Juv', 'Vie', 'S&aacute;b'],
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'S&aacute;'],
                    weekHeader: 'Sm',
                    dateFormat: 'yy-mm-dd',
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ''};
                $.datepicker.setDefaults($.datepicker.regional['es']);
            });

            var d = new Date();
            var mes = d.getMonth();
            var dia = d.getDate();
            var año = d.getFullYear();

            var month1=mes;
            var day1=dia;
            var year1=año;

            function Bisiesto() {
                if ((año % 4 == 0) && (año % 100 != 0) || (año % 400 == 0)) {
                    return true;
                } else {
                    return false;
                }
            };

            function DiasMes() {
                if (mes == 2) {
                    if ($(document).ready(Bisiesto))
                        return 29;
                    else
                        return 28;
                }
                if (mes == 4 || mes == 6 || mes == 9 || mes == 11)
                    return 30;
                else
                    return 31;
            };
 
            function Incrementar30Dias() {
                for (var i = 1; i <= 30; i++) {
                    if ($(document).ready(DiasMes) == day1) {
                        day1 = 1;
                        if (month1== 12) {
                            month1 = 1;
                            year1++;
                        } else {
                            month1++;
                        }
                    } else {
                        day1++;
                    }
                }
            }
            
            $(document).ready(Incrementar30Dias);
            $(document).ready(function () {
                $("#datepicker").datepicker(
                        {
                            minDate: new Date(año, mes, dia),
                            maxDate: new Date(year1, month1, day1),
                        }
                );
            });