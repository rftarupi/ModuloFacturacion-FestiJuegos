$(document).ready(function() {
    $('#cliente').DataTable( {
        "pagingType": "full_numbers",
        "language": {
            "lengthMenu": "Mostrar _MENU_ clientes por página",
            "zeroRecords": "No se encontraron datos :(",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontraron clientes",
            "infoFiltered": "(filtrado de _MAX_ datos)",
            "search": "Buscar Clientes",
            "paginate": {
              "first": "Primero",
              "last": "Último",
              "next": "Siguiente",
             "previous": "Anterior",
    },  
        }  
    } );
} );
