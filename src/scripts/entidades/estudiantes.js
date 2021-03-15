var baseUrl = window.location.href;

$.get( baseUrl + '/../api/estudiantes', function( data ) {
    console.log('estudiantes:', data);
}, 'json');

$.get( baseUrl + '/../api/estudiantes/' + 1, function( data ) {
    console.log('estudiante:', data);
}, 'json');