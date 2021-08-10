let baseUrl = window.location.href;

function cargarEstudiantes() {
    $.get( baseUrl + '/../api/estudiantes', function( data ) {
        let html;
        $.each(data, function(k, v) {
            html += `
            <tr>
                <td>${v.id}</td>
                <td>${v.nombres}</td>
                <td>${v.apellidos}</td>
                <td>${v.direccion}</td>
                <td>${v.celular}</td>
                <td>${v.email}</td>
                <td><a href="#" id="modificarEstudiante-${v.id}" class="modificarEstudiante text-primary">Editar</a></td>
                <td><a href="#" id="eliminarEstudiante-${v.id}" class="eliminarEstudiante text-danger">Eliminar</a></td>
            </tr>`;
        });

        $('#listaEstudiantes tbody').html(html);
    }, 'json');
}

function cargarDatosEstudiante() {
    $.get( baseUrl + '/../api/estudiantes/' + 1, function( data ) {
        console.log('estudiante:', data);
    }, 'json');
}








// Cargar el listado de estudiantes al seleccionar la opcion estudiantes
cargarEstudiantes();