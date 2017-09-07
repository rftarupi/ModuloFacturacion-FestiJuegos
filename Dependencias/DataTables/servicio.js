$(document).ready(function() {
    $('#servicio').DataTable( {
        "pagingType": "full_numbers",
        "language": {
            "lengthMenu": "Mostrar _MENU_ servicios por página",
            "zeroRecords": "No se encontraron datos :(",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontraron servicios",
            "infoFiltered": "(filtrado de _MAX_ datos)",
            "search": "Buscar Servicios",
            "paginate": {
              "first": "Primero",
              "last": "Último",
              "next": "Siguiente",
             "previous": "Anterior",
    },  
        }  
    } );
} );
