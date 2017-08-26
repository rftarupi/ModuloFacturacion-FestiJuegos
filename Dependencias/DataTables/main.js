$(document).ready(function() {
    $('#example').DataTable( {
        "pagingType": "full_numbers",
        "language": {
            "lengthMenu": "Mostrar _MENU_ productos por página",
            "zeroRecords": "No se encontraron datos :(",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontraron productos",
            "infoFiltered": "(filtrado de _MAX_ datos)",
            "search": "Buscar producto",
            "paginate": {
              "first": "Primero",
              "last": "Último",
              "next": "Siguiente",
             "previous": "Anterior",
    },  
        }  
    } );
} );