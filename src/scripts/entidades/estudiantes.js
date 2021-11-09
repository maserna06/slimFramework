let baseUrl = window.location.href;

function listarEstudiantes() {
  $.get(`${baseUrl}/../api/estudiantes`, function( data ) {
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
              <td>
                <a href="javascript:;" onClick="cargarEstudiante(${v.id})" id="modificarEstudiante-${v.id}"
                 class="modificarEstudiante text-primary"
                 data-bs-toggle="modal" data-bs-target="#modalEditarEstudiante">
                  Editar
                </a>
              </td>
              <td>
                <a href="javascript:;" onClick="eliminarEstudiante(${v.id})" id="eliminarEstudiante-${v.id}"
                 class="eliminarEstudiante text-danger">
                  Eliminar
                </a>
              </td>
          </tr>`;
      });

      $('#listaEstudiantes tbody').html(html);
  }, 'json');
}

function crearEstudiante(evt) {
  let datosEstudiante = {
    nombres   : document.getElementById('nombres').value.trim(),
    apellidos : document.getElementById('apellidos').value.trim(),
    direccion : document.getElementById('direccion').value.trim(),
    celular   : document.getElementById('celular').value.trim(),
    email     : document.getElementById('email').value.trim()
  }

  $.post(`${baseUrl}/../api/estudiantes/nuevo`, datosEstudiante, function(data) {
    alert(data);
    listarEstudiantes();
    document.getElementById('frmCrearEstudiante').reset();
  });

  return false;
}

function cargarEstudiante(id) {
  $.get(`${baseUrl}/../api/estudiantes/${id}`, function( data ) {
      let dataEst = data[0];
      document.getElementById('idEd').value = dataEst.id;
      document.getElementById('nombresEd').value = dataEst.nombres;
      document.getElementById('apellidosEd').value = dataEst.apellidos;
      document.getElementById('direccionEd').value = dataEst.direccion;
      document.getElementById('celularEd').value = dataEst.celular;
      document.getElementById('emailEd').value = dataEst.email;
  }, 'json');
}

function editarEstudiante(evt) {
  let datosEstudiante = {
    idEd        : document.getElementById('idEd').value.trim(),
    nombresEd   : document.getElementById('nombresEd').value.trim(),
    apellidosEd : document.getElementById('apellidosEd').value.trim(),
    direccionEd : document.getElementById('direccionEd').value.trim(),
    celularEd   : document.getElementById('celularEd').value.trim(),
    emailEd     : document.getElementById('emailEd').value.trim()
  }

  $.post(`${baseUrl}/../api/estudiantes/modificar`, datosEstudiante, function(data) {
    alert(data);
    listarEstudiantes();
  });

  return false;
}

function eliminarEstudiante(id) {
  if(confirm(`Eliminar el estudiante ${id}?`)) {
    $.post(`${baseUrl}/../api/estudiantes/eliminar`,{ id: id }, function( data ) {
      alert(data);
      listarEstudiantes();
    });
  }
}


// Cargar el listado de estudiantes
listarEstudiantes();
