<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/db.php';

$app = AppFactory::create();
$app->setBasePath('/~rrd/slim-php-api');        // http://localhost/~rrd/slim-php-api/

$app->addBodyParsingMiddleware();

$app->get('/', function (Request $request, Response $response, $args) {
  $response->getBody()->write("Gauranga!");
  return $response;
});

$app->get('/users', function (Request $request, Response $response, $args) {
  $db = new DB();
  $pdo = $db->connect();
  $stmt = $pdo->prepare('SELECT * FROM users');
  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  // TODO Implement auth
  $response->getBody()->write(json_encode($data));
  return $response
    ->withHeader('content-type', 'application/json')
    ->withStatus(200);
});

$app->post('/users/login', function (Request $request, Response $response, $args) {
  $data = $request->getParsedBody();
  $db = new DB();
  $pdo = $db->connect();
  $stmt = $pdo->prepare('SELECT id, token FROM users WHERE email = ? AND password = ?');
  $stmt->execute([$data['email'], md5($data['password'])]);
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  // TODO Implement auth
  $response->getBody()->write(json_encode($data));
  return $response
    ->withHeader('content-type', 'application/json')
    ->withStatus(200);
});

$app->run();