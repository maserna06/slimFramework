<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/config/BD.php';

// Create App
$app = AppFactory::create();
// Parse json, form data and xml
$app->addBodyParsingMiddleware();
$app->setBasePath('/slimFramework/public');

// Create Twig
$twig = Twig::create(__DIR__ . '/../src/templates', ['cache' => false]);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));

// Incluir las rutas a las entidades
require __DIR__ . '/../src/rutas/estudiantes.php';

// Inicio
$app->get('/', function (Request $request, Response $response) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'inicio.html', [
      'active' => 'inicio'
    ]);
});

$app->get('/usuarios', function (Request $request, Response $response) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'usuarios.html', [
      'active' => 'usuarios'
    ]);
});

$app->get('/usuarios/{id}', function (Request $request, Response $response, array $args) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'usuarios.html', [
      'active' => 'usuarios',
      'nombre' => $args['id']
    ]);
});

// Run app
$app->run();
