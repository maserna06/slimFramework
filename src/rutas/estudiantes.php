<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// GET Obtener informacion de todos los estudiantes
$app->get('/api/estudiantes', function(Request $request, Response $response) {
  $sql = "SELECT * FROM estudiantes";
  try {
    $bd = new BD();
    $bd = $bd->coneccionBD();
    $res = $bd->query($sql);
    if($res->rowcount() > 0) {
      $estudiantes = $res->fetchAll(PDO::FETCH_OBJ);
      echo json_encode($estudiantes);
    } else {
      echo json_encode('No hay estudiantes que mostrar');
    }
    $res = null;
    $bd = null;
  } catch(PDOException $e) {
    echo '{"Error" : {"Text" : '.$e->getMessage().'}}';
  }

  return $response;
});

// GET Obtener informacion de un estudiante con su id
$app->get('/api/estudiantes/{id}', function(Request $request, Response $response) {
  $id = $request->getAttribute('id');

  $sql = "SELECT * FROM estudiantes WHERE id = $id";
  try {
    $bd = new BD();
    $bd = $bd->coneccionBD();
    $res = $bd->query($sql);
    if($res->rowcount() > 0) {
      $estudiante = $res->fetchAll(PDO::FETCH_OBJ);
      echo json_encode($estudiante);
    } else {
      echo 'No hay estudiante que mostrar con este id';
    }
    $res = null;
    $bd = null;
  } catch(PDOException $e) {
    echo '{"Error" : {"Text" : '.$e->getMessage().'}}';
  }

  return $response;
});

// POST crear un estudiante
$app->post('/api/estudiantes/nuevo', function(Request $request, Response $response, array $args) {
  $nombres = $request->getParsedBody()['nombres'];
  $apellidos = $request->getParsedBody()['apellidos'];
  $direccion = $request->getParsedBody()['direccion'];
  $celular = $request->getParsedBody()['celular'];
  $email = $request->getParsedBody()['email'];

  $sql = "INSERT INTO estudiantes
          (nombres, apellidos,  direccion, celular, email)
          VALUES
          (:nombres, :apellidos, :direccion, :celular, :email)";
  try {
    $bd = new BD();
    $bd = $bd->coneccionBD();
    $res = $bd->prepare($sql);

    $res->bindParam(':nombres', $nombres);
    $res->bindParam(':apellidos', $apellidos);
    $res->bindParam(':direccion', $direccion);
    $res->bindParam(':celular', $celular);
    $res->bindParam(':email', $email);

    $res->execute();

    echo 'Nuevo estudiantes creado';

    $res = null;
    $bd = null;
  } catch(PDOException $e) {
    echo '{"Error" : {"Text" : '.$e->getMessage().'}}';
  }

  return $response;
});
