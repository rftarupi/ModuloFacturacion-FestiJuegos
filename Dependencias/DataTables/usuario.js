$(document).ready(function() {
    $('#usuario').DataTable( {
        "pagingType": "full_numbers",
        "language": {
            "lengthMenu": "Mostrar _MENU_ usuarios por página",
            "zeroRecords": "No se encontraron datos :(",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontraron usuarios",
            "infoFiltered": "(filtrado de _MAX_ datos)",
            "search": "Buscar Usuarios",
            "paginate": {
              "first": "Primero",
              "last": "Último",
              "next": "Siguiente",
             "previous": "Anterior",
    },  
        }  
    } );
} );
