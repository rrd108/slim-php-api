<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->setBasePath('/~rrd/slim-php-api');        // http://localhost/~rrd/slim-php-api/

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Gauranga!");
    return $response;
});

$app->run();